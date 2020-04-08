<?php 
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
// Product
class Uhu_Widget_Product extends Widget_Base {
 
   public function get_name() {
      return 'product';
   }
 
   public function get_title() {
      return esc_html__( 'Products', 'uhu' );
   }
 
   public function get_icon() { 
        return 'eicon-posts-carousel';
   }
 
   public function get_categories() {
      return [ 'uhu-elements' ];
   }
   protected function _register_controls() {

      $this->start_controls_section(
         'product_section',
         [
            'label' => esc_html__( 'Products', 'uhu' ),
            'type' => Controls_Manager::SECTION,
         ]
      );
      

      $this->add_control(
         'sub-title',
         [
            'label' => __( 'Sub Title', 'uhu' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => __('Let\'s Check Out','uhu')
         ]
      );

      $this->add_control(
         'title',
         [
            'label' => __( 'Title', 'uhu' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __('Newest Release Items','uhu')
         ]
      );



      $this->add_control(
         'text',
         [
            'label' => __( 'Text', 'uhu' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => __('Business plan template presented here will get you started. A standard business plan consists of a single document divided into several sections','uhu')
         ]
      );
      

      $this->add_control(
         'ppp',
         [
            'label' => __( 'Post per page', 'uhu' ),
            'type' => \Elementor\Controls_Manager::NUMBER,
            'default' => 8,
            'min' => 5,
            'max' => 100,
            'step' => 1
         ]
      );


      $this->add_control(
         'order',
         [
            'label' => __( 'Order', 'uhu' ),
            'type' => \Elementor\Controls_Manager::SELECT,
            'default' => 'DESC',
            'options' => [
               'ASC'  => __( 'Ascending', 'uhu' ),
               'DESC' => __( 'Descending', 'uhu' )
            ],
         ]
      );
      
      $this->end_controls_section();
   }

   protected function render( $instance = [] ) {
 
      // get our input from the widget settings.
       
      $settings = $this->get_settings_for_display(); ?>

      <!-- product-area -->
      <section class="product-area pt-80 pb-80">
          <div class="container">
              <div class="row justify-content-center">
                  <div class="col-xl-8 col-lg-9">
                      <div class="section-title text-center mb-65">
                          <span><?php echo esc_html($settings['sub-title']); ?></span>
                          <h2><?php echo esc_html($settings['title']); ?></h2>
                          <p><?php echo esc_html($settings['text']); ?></p>
                      </div>
                  </div>
              </div>
              <div class="row justify-content-center">
                  <div class="col-xl-9 text-center">
                      <div class="product-menu mb-60">
                          <button class="active" data-filter="*">All</button>
                          <?php  $product_menu_terms = get_terms( array(
                             'taxonomy' => 'product_cat',
                             'hide_empty' => false,  
                          ) ); 

                          foreach ( $product_menu_terms as $portfolio_menu_term ) { ?>
                            <button class="" data-filter=".<?php echo esc_attr( $portfolio_menu_term->slug ) ?>"><?php echo esc_html( $portfolio_menu_term->name ) ?></button>
                          <?php } ?>
                      </div>
                  </div>
              </div>
              <div class="row product-active">
                 <?php
                $products = new \WP_Query( array( 
                  'post_type' => 'product',
                  'posts_per_page' => $settings['ppp'],
                  'ignore_sticky_posts' => true,
                  'order' => $settings['order'],
                ));
                 /* Start the Loop */
                while ( $products->have_posts() ) : $products->the_post();
                $product_terms = get_the_terms( get_the_ID() , 'product_cat' ); 
                $categories = get_the_category();
                global $product;?>
                  <div class="col-lg-4 col-md-6 grid-item <?php foreach ($product_terms as $portfolio_term) { echo esc_attr( $portfolio_term->slug ); } ?>">
                      <div class="product-item mb-40">
                          <div class="product-thumb">
                              <a href="<?php the_permalink() ?>"><?php the_post_thumbnail( 'uhu-503x320' ) ?></a>
                          </div>
                          <div class="product-item-content">
                              <h4><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>
                              <p><?php echo esc_html( get_post_meta( get_the_ID(), 'uhu_sub_title', 1 ) ) ?></p>
                              <div class="product-cat">
                                  <ul>
                                    <li><a href="#"><?php echo esc_html( $portfolio_term->name ); ?></a></li>
                                    <li><?php echo get_woocommerce_currency_symbol().get_post_meta( get_the_ID(), '_regular_price', true ); ?></li>
                                  </ul>
                              </div>
                          </div>
                          <div class="product-meta">
                              <ul>
                                  <li><?php echo get_avatar( get_the_author_meta( 'ID' ), '29'); ?><?php echo esc_html__( 'By ','uhu' ) ?> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a></li>
                                  <li>
                                      <div class="product-addCart">
                                          <a href="<?php echo do_shortcode('[add_to_cart_url id="'.get_the_ID().'"]'); ?>"><i class="fas fa-plus"></i></a>
                                      </div>
                                  </li>
                              </ul>
                          </div>
                      </div>
                  </div>
                <?php endwhile; wp_reset_postdata(); ?>
              </div>
          </div>
      </section>
      <!-- product-area-end -->

      <?php
   }
 
}
Plugin::instance()->widgets_manager->register_widget_type( new Uhu_Widget_Product );