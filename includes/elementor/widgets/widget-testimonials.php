<?php 
namespace Elementor;
 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Title
class Uhu_Widget_Testimonials extends Widget_Base {
 
   public function get_name() {
      return 'testimonials';
   }
 
   public function get_title() {
      return esc_html__( 'Testimonials', 'uhu' );
   }
 
   public function get_icon() { 
        return 'eicon-testimonial';
   }

   public function get_categories() {
      return [ 'uhu-elements' ];
   }

   protected function _register_controls() {

      $this->start_controls_section(
         'testimonial_section',
         [
            'label' => esc_html__( 'Testimonials', 'uhu' ),
            'type' => Controls_Manager::SECTION,
         ]
      );

      $this->add_control(
         'title',
         [
            'label' => __( 'Title', 'uhu' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('Feedback From our clients.','uhu')
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
            ]
         ]
      );
      
      $repeater->add_control(
         'name',
         [
            'label' => __( 'Name', 'uhu' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __( 'Alexander Graham Bell', 'uhu' ),
            
         ]
      );

      $repeater->add_control(
         'designation',
         [
            'label' => __( 'Designation', 'uhu' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __( 'CEO ot Google', 'uhu' ),
         ]
      );

      $repeater->add_control(
         'testimonial',
         [
            'label' => __( 'Testimonial', 'uhu' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => __( 'In promotion and of advertisin testimonial or show consists of a person\'s written or spoken statement that extolling the virtue of a product The term - Testimonial', 'uhu' ),
         ]
      );

      $repeater->add_control(
        'rating',
        [
          'label' => __( 'Rating', 'uhu' ),
          'type' => \Elementor\Controls_Manager::SELECT,
          'default' => 1,
          'options' => [
            1 => __( 'Star 1', 'uhu' ),
            2 => __( 'Star 2', 'uhu' ),
            3 => __( 'Star 3', 'uhu' ),
            4 => __( 'Star 4', 'uhu' ),
            5 => __( 'Star 5', 'uhu' ),
            'none' => __( 'None', 'uhu' ),
          ]
        ]
      );

      $this->add_control(
         'testimonial_list',
         [
            'label' => __( 'Testimonial List', 'uhu' ),
            'type' => \Elementor\Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'title_field' => '{{name}}',

         ]
      );
      
      $this->end_controls_section();

   }

   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
       
      $settings = $this->get_settings_for_display(); ?>



      <div class="position-relative">

          <!-- testimonial-area -->
          <section class="testimonial-area pt-120 pb-120">
              <div class="container">
                  <div class="testi-wrap">
                      <div class="row testimonial-active">
                      <?php foreach (  $settings['testimonial_list'] as $testimonial_single ): ?>
                        <div class="col-xl-4">
                            <div class="testimonial-item">
                                <div class="testi-head-quote mb-35">
                                    <img src="<?php echo get_template_directory_uri(); ?>/images/testi_top_quote.png" alt="">
                                </div>
                                <div class="testi-content">
                                    <p><?php echo esc_html($testimonial_single['testimonial']); ?></p>
                                </div>
                                <div class="testi-avatar">
                                    <div class="testi-avatar-img">
                                        <img src="<?php echo esc_url($testimonial_single['image']['url']) ?>" alt="img">
                                    </div>
                                    <div class="testi-avatar-info">
                                        <h6><?php echo esc_html($testimonial_single['name']); ?></h6>
                                        <span><?php echo esc_html($testimonial_single['designation']); ?></span>
                                    </div>
                                </div>
                                <div class="testi-overlay-quote"><img src="<?php echo get_template_directory_uri(); ?>/images/testi_overlay_quote.png" alt=""></div>
                            </div>
                        </div>
                      <?php endforeach; ?>
                      </div>
                  </div>
              </div>
          </section>
          <!-- testimonial-area-end -->

            <?php }
 
}

Plugin::instance()->widgets_manager->register_widget_type( new Uhu_Widget_Testimonials );