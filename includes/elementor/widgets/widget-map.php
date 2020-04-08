<?php 
namespace Elementor;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Map
class uhu_Widget_Map extends Widget_Base {
 
   public function get_name() {
      return 'map';
   }
 
   public function get_Map() {
      return esc_html__( 'Map', 'uhu' );
   }
 
   public function get_icon() { 
        return 'eicon-google-maps';
   }
 
   public function get_categories() {
      return [ 'uhu-elements' ];
   }

   protected function _register_controls() {

      $this->start_controls_section(
         'map_section',
         [
            'label' => esc_html__( 'Map', 'uhu' ),
            'type' => Controls_Manager::SECTION,
            'default' => __('Featured Tranding of the week','uhu')
         ]
      );

      $this->add_control(
         'latitude',
         [
            'label' => __( 'Latitude', 'uhu' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '40.6700'
         ]
      );

      $this->add_control(
         'longitude',
         [
            'label' => __( 'Longitude', 'uhu' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => '-73.9400'
         ]
      );

      $this->add_control(
         'zoom',
         [
            'label' => __( 'Zoom', 'uhu' ),
            'type' => Controls_Manager::SLIDER,
            'range' => [
               'step' => 1,
               'min' => 0,
               'max' => 100,
            ],
            'default' => [
               'size' => 11,
            ]
         ]
      );


      $this->add_control(
         'scrollwheel',
         [
            'label' => __( 'Scroll Wheel', 'uhu' ),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => __( 'Enabled', 'uhu' ),
            'label_off' => __( 'Disabled', 'uhu' ),
            'return_value' => true,
            'default' => false,   
         ]
      );

      $this->add_control(
      'marker',
        [
          'label' => __( 'Marker', 'uhu' ),
          'type' => \Elementor\Controls_Manager::MEDIA,
          'default' => [
            'url' => get_template_directory_uri().'/images/map_icon.png',
          ],
        ]
      );

      $this->add_control(
         'title',
         [
            'label' => __( 'Title', 'uhu' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __( 'Uhu', 'uhu' )
         ]
      );
      
      $this->end_controls_section();

   }

   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
       
      $settings = $this->get_settings_for_display(); ?>

      <div id="contact-map" 
         data-lat="<?php echo esc_attr( $settings['latitude'] ) ?>" 
         data-lng="<?php echo esc_attr( $settings['longitude'] ) ?>" 
         data-maptitle="<?php echo esc_attr( $settings['title'] ) ?>" 
         data-marker="<?php echo esc_attr( $settings['marker']['url'] ) ?>" 
         data-zoom="<?php echo esc_attr( $settings['zoom']['size'] ) ?>" 
         data-scroll="<?php echo esc_attr( $settings['scrollwheel'] ) ?>" >  
      </div>

      <?php
   }
 
}

Plugin::instance()->widgets_manager->register_widget_type( new uhu_Widget_Map );