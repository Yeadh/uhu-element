<?php 
namespace Elementor;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// CTA
class Uhu_Widget_CTA extends Widget_Base {
 
   public function get_name() {
      return 'calltoaction';
   }
 
   public function get_title() {
      return esc_html__( 'Call To Action', 'uhu' );
   }
 
   public function get_icon() { 
        return 'eicon-call-to-action';
   }
 
   public function get_categories() {
      return [ 'uhu-elements' ];
   }

   protected function _register_controls() {

      $this->start_controls_section(
         'cta_section',
         [
            'label' => __( 'Call To Action', 'uhu' ),
            'type' => Controls_Manager::SECTION
         ]
      );


      $this->add_control(
         'title',
         [
            'label' => __( 'Title', 'uhu' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('Get Our App From App Store','uhu')
         ]
      );

      $this->add_control(
         'desc',
         [
            'label' => __( 'Description', 'uhu' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => __('Online marketplace every hour of every day across e-commerce where product service information provided multiple third parties.','uhu')
         ]
      );

      $button = new \Elementor\Repeater();
      
      $button->add_control(
         'icon',
         [
            'label' => __( 'Icon', 'uhu' ),
            'type' => \Elementor\Controls_Manager::ICON
         ]
      );

      $button->add_control(
         'title',
         [
            'label' => __( 'Title', 'uhu' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('App Store','uhu')
         ]
      );

      $button->add_control(
         'url',
         [
            'label' => __( 'URL', 'uhu' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '#',
         ]
      );

      $this->add_control(
         'button_list',
         [
            'label' => __( 'Buttons', 'uhu' ),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $button->get_controls()

         ]
      );

      $this->end_controls_section();

   }

   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
       
      $settings = $this->get_settings_for_display(); ?>

      <!-- download-area -->
      <section class="download-area">
          <div class="container">
              <div class="row justify-content-center">
                  <div class="col-xl-8">
                      <div class="section-title text-center white-title mb-45">
                          <h2><?php echo esc_html($settings['title']); ?></h2>
                          <p><?php echo esc_html($settings['desc']); ?></p>
                      </div>
                      <div class="download-btn text-center">
                        <?php foreach( $settings['button_list'] as $index => $btn ) { ?>
                          <a href="<?php echo esc_url($btn['url']); ?>" class="btn"><i class="fab fa <?php echo esc_attr($btn['icon']); ?>"></i><?php echo esc_html($btn['title']); ?></a>
                        <?php } ?>
                      </div>
                  </div>
              </div>
          </div>
      </section>
      <!-- download-area-end -->
      <?php
   }
 
}

Plugin::instance()->widgets_manager->register_widget_type( new Uhu_Widget_CTA );