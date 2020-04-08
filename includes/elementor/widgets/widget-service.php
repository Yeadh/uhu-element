<?php 
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
// service item
class uhu_Widget_Service extends Widget_Base {
 
   public function get_name() {
      return 'service item';
   }
 
   public function get_title() {
      return esc_html__( 'Service Item', 'uhu' );
   }
 
   public function get_icon() { 
        return 'eicon-facebook-comments';
   }
 
   public function get_categories() {
      return [ 'uhu-elements' ];
   }

   protected function _register_controls() {
    
      $this->start_controls_section(
         'service_section',
         [
            'label' => esc_html__( 'Service Item', 'uhu' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $this->add_control(
         'image',
         [
            'label' => __( 'Choose icon', 'uhu' ),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [
               'url' => \Elementor\Utils::get_placeholder_image_src()
            ]
         ]
      );

      $this->add_control(
         'title',
         [
            'label' => __( 'Title', 'uhu' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __( 'Secure Transaction Custo Traffic generation', 'uhu' ),
         ]
      );

      $this->add_control(
         'desc',
         [
            'label' => __( 'Description', 'uhu' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => __( 'Annual Performance Statistics that Report provides detailed statistical information our performance stakeh.', 'uhu' ),
         ]
      );

       $this->add_control(
           'btn_text',
           [
               'label' => __( 'button text', 'uhu' ),
               'type' => \Elementor\Controls_Manager::TEXT,
               'default' => 'Check it now',
           ]
       );

       $this->add_control(
           'btn_url',
           [
               'label' => __( 'button URL', 'uhu' ),
               'type' => \Elementor\Controls_Manager::TEXT,
               'default' => '#',
           ]
       );


      $this->end_controls_section();
   }
   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
       
      $settings = $this->get_settings_for_display(); ?>

      <div class="services-box">
          <div class="services-box-head">
              <img src="<?php echo esc_html($settings['image']['url']); ?>" alt="<?php echo esc_attr($settings['title']); ?>">
              <h4><?php echo esc_html($settings['title']); ?></h4>
          </div>
          <div class="services-box-content">
              <p><?php echo esc_html($settings['desc']); ?></p>
              <a href="<?php echo ($settings['btn_url']); ?>"><?php echo ($settings['btn_text']); ?></a>
          </div>
      </div>

      <?php
   }
 
}
Plugin::instance()->widgets_manager->register_widget_type( new uhu_Widget_Service );