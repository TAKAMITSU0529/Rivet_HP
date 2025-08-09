<?php

class service_slider_widget extends WP_Widget {

  function __construct() {
    $options = get_design_plus_option();
    $service_label = $options['service_label'] ? esc_html( $options['service_label'] ) : __( 'Service', 'tcd-canon' );
    parent::__construct(
      'service_slider_widget',// ID
      sprintf(__('%s slider (tcd ver)', 'tcd-canon'), $service_label),
      array(
        'classname' => 'service_slider_widget',
        'description' => sprintf(__('Display %s by slider.', 'tcd-canon'), $service_label),
      )
    );
  }

  // Extract Args //
  function widget($args, $instance) {

    global $post;
    $options = get_design_plus_option();

    extract( $args );
    $title = apply_filters('widget_title', $instance['title']);
    $post_num = isset($instance['post_num']) ?  $instance['post_num'] : 6;
    $post_type = isset($instance['post_type']) ?  $instance['post_type'] : 'all_post';
    $post_order = isset($instance['post_order']) ?  $instance['post_order'] : 'menu_order';
    if ($post_order == 'menu_order') {
      $post_order = array();
      $post_order['menu_order'] = 'ASC';
      $post_order['date'] = 'DESC';
    }
    $service_category = get_terms( 'service_category', array('hide_empty' => true) );
    $custom_post_order = isset($instance['custom_post_order']) ?  $instance['custom_post_order'] : '';
    if(!$options['use_service']){
      return;
    }

    // Before widget //
    echo $before_widget;

    // Title of widget //
    if ( $title ) { echo $before_title . $title . $after_title; }

    // Widget output //
    if ( $post_type == 'custom_post') {
      $post_ids = $custom_post_order;
      $post_ids_array = array_map('intval', explode(',', $post_ids));
      $args = array( 'post_status' => 'publish', 'post_type' => 'service', 'posts_per_page' => $post_num, 'post__in' => $post_ids_array, 'orderby' => 'post__in' );
    } else {
      $args = array( 'post_status' => 'publish', 'post_type' => 'service', 'posts_per_page' => $post_num, 'orderby' => $post_order );
    }
    $post_list = new wp_query($args);

    if($post_list->have_posts()):
      $total_post_num = $post_list->found_posts;
?>
<div class="widget_gallery_carousel swiper">
 <div class="widget_gallery swiper-wrapper">
  <?php
       while( $post_list->have_posts() ) : $post_list->the_post();
         if(has_post_thumbnail()) {
           $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size2' );
         } elseif($options['no_image']) {
           $image = wp_get_attachment_image_src( $options['no_image'], 'full' );
         } else {
           $image = array();
           $image[0] = get_bloginfo('template_url') . "/img/no_image2.gif";
           $image[1] = '300';
           $image[2] = '300';
         }
         $service_sub_title = get_post_meta($post->ID, 'service_sub_title', true);
  ?>
  <a class="item animate_background swiper-slide" href="<?php the_permalink(); ?>">
   <div class="image_wrap">
    <img loading="lazy" class="image" src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
   </div>
   <div class="content">
    <?php if($service_sub_title){ ?>
    <p class="sub_title"><?php echo wp_kses_post(nl2br($service_sub_title)); ?></p>
    <?php }; ?>
    <h4 class="title"><span><?php the_title(); ?></span></h4>
   </div>
  </a>
  <?php endwhile; wp_reset_query(); ?>
 </div>
</div>
<div class="widget_gallery_carousel_pagination swiper-pagination"></div>
<?php endif; ?>
<?php

    // After widget //
    echo $after_widget;

  } // end function widget


  // Update Settings //
  function update($new_instance, $old_instance) {
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['post_type'] = $new_instance['post_type'];
    $instance['post_num'] = $new_instance['post_num'];
    $instance['post_order'] = $new_instance['post_order'];
    $instance['custom_post_order'] = $new_instance['custom_post_order'];
    return $instance;
  }

  // Widget Control Panel //
  function form($instance) {
    global $blog_label;
    $options = get_design_plus_option();
    $service_label = $options['service_label'] ? esc_html( $options['service_label'] ) : __( 'Guest room', 'tcd-canon' );
    $defaults = array('title' => '', 'post_num' => 3, 'post_order' => 'menu_order', 'post_type' => 'all_post', 'custom_post_order' => '');
    $instance = wp_parse_args( (array) $instance, $defaults );
?>

<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Title', 'tcd-canon'); ?></h3>
 <input class="widefat" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_html($instance['title']); ?>" />
</div>

<div class="tcd_widget_content news_slider_post_type_wrap1">
 <h3 class="tcd_widget_headline"><?php _e('Post type', 'tcd-canon'); ?></h3>
 <select name="<?php echo $this->get_field_name('post_type'); ?>" class="news_slider_post_type1 widefat" style="width:100%;">
  <option value="all_post" <?php selected('all_post', $instance['post_type']); ?>><?php _e('All post', 'tcd-canon'); ?></option>
  <option value="custom_post" <?php selected('custom_post', $instance['post_type']); ?>><?php _e('Custom', 'tcd-canon'); ?></option>
 </select>
</div>

<div class="tcd_widget_content news_slider_post_num_wrap">
 <h3 class="tcd_widget_headline"><?php _e('Number of post', 'tcd-canon'); ?></h3>
 <input class="widefat" name="<?php echo $this->get_field_name('post_num'); ?>" type="number" value="<?php echo $instance['post_num']; ?>" min="3" />
</div>

<div class="tcd_widget_content normal_post_order1">
 <h3 class="tcd_widget_headline"><?php _e('Post order', 'tcd-canon'); ?></h3>
 <select name="<?php echo $this->get_field_name('post_order'); ?>" class="widefat" style="width:100%;">
  <option value="menu_order" <?php selected('menu_order', $instance['post_order']); ?>><?php _e('Admin order', 'tcd-canon'); ?></option>
  <option value="rand" <?php selected('rand', $instance['post_order']); ?>><?php _e('Random', 'tcd-canon'); ?></option>
 </select>
</div>

<div class="tcd_widget_content custom_post_order">
 <h3 class="tcd_widget_headline"><?php _e('ID of the article you want to display', 'tcd-canon'); ?></h3>
 <div class="theme_option_message2">
  <p><?php _e('Enter article IDs separated by commas.<br>The ID can be found in the administration screen.<br><a href="https://tcd-theme.com/2017/01/check_pageid_categoryid.html#tcd_id" target="_blank">Click here to see the ID display section of the TCD theme.</a>', 'tcd-canon'); ?></p>
 </div>
 <input type="text" placeholder="<?php _e( 'e.g.', 'tcd-canon' ); ?>1,3,10" class="widefat hankaku" name="<?php echo $this->get_field_name('custom_post_order'); ?>" value="<?php echo esc_attr($instance['custom_post_order']); ?>">
</div>

<?php

  } // end function form

} // end class


function register_service_slider_widget() {
	register_widget( 'service_slider_widget' );
}
add_action( 'widgets_init', 'register_service_slider_widget' );


?>
