<?php 
namespace Elementor;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Title
class uhu_Widget_Partner extends Widget_Base {
 
   public function get_name() {
      return 'partner';
   }
 
   public function get_title() {
      return esc_html__( 'Partner', 'uhu' );
   }
 
   public function get_icon() { 
        return 'eicon-logo';
   }
 
   public function get_categories() {
      return [ 'uhu-elements' ];
   }

   protected function _register_controls() {

      $this->start_controls_section(
         'partner_section',
         [
            'label' => esc_html__( 'partner', 'uhu' ),
            'type' => Controls_Manager::SECTION,
         ]
      );


      $repeater = new \Elementor\Repeater();

      $repeater->add_control(
         'image',
         [
            'label' => __( 'Choose Photo', 'uhu' ),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
               'url' => \Elementor\Utils::get_placeholder_image_src()
            ],
         ]
      );

      $repeater->add_control(
         'url',
         [
            'label' => __( 'URL', 'uhu' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '#',
         ]
      );

      $this->add_control(
         'partner_list',
         [
            'label' => __( 'Partner List', 'uhu' ),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls()

         ]
      );
      
      $this->end_controls_section();

   }

   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
      $settings = $this->get_settings_for_display(); ?>

      <div class="plugin-wrap">
        <div class="row justify-content-center">
            <?php foreach (  $settings['partner_list'] as $partner_single ): ?>
            <div class="single-plugin text-center">
                <a href="<?php echo esc_url( $partner_single['url'] ); ?>">
                  <img src="<?php echo esc_url( $partner_single['image']['url'] ); ?>" alt="img">
                </a>
            </div>
            <?php endforeach; ?>
        </div>
      </div>

   <?php } 
 
}

Plugin::instance()->widgets_manager->register_widget_type( new uhu_Widget_Partner );