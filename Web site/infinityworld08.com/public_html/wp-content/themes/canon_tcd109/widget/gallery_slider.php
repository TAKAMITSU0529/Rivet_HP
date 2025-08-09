<?php

class gallery_slider_widget extends WP_Widget {

  function __construct() {
    $options = get_design_plus_option();
    $gallery_label = $options['gallery_label'] ? esc_html( $options['gallery_label'] ) : __( 'Guest room', 'tcd-canon' );
    parent::__construct(
      'gallery_slider_widget',// ID
      sprintf(__('%s slider (tcd ver)', 'tcd-canon'), $gallery_label),
      array(
        'classname' => 'gallery_slider_widget',
        'description' => sprintf(__('Display %s by slider.', 'tcd-canon'), $gallery_label),
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
    $gallery_category_id = isset($instance['gallery_category_id']) ?  $instance['gallery_category_id'] : -1;
    $gallery_category = get_terms( 'gallery_category', array('hide_empty' => true) );
    $custom_post_order = isset($instance['custom_post_order']) ?  $instance['custom_post_order'] : '';
    if(!$options['use_gallery']){
      return;
    }

    // Before widget //
    echo $before_widget;

    // Title of widget //
    if ( $title ) { echo $before_title . $title . $after_title; }

    // Widget output //
    if ( $post_type == 'category_post') {
      if( $gallery_category ){
        $args = array( 'post_status' => 'publish', 'post_type' => 'gallery', 'posts_per_page' => $post_num, 'orderby' => $post_order, 'tax_query' => array( array( 'taxonomy' => 'gallery_category', 'field' => 'term_id', 'terms' => $gallery_category_id ), ) );
      } else {
        $args = array( 'post_status' => 'publish', 'post_type' => 'gallery', 'posts_per_page' => $post_num, 'orderby' => $post_order );
      }
    } elseif ( $post_type == 'custom_post') {
      $post_ids = $custom_post_order;
      $post_ids_array = array_map('intval', explode(',', $post_ids));
      $args = array( 'post_status' => 'publish', 'post_type' => 'gallery', 'posts_per_page' => $post_num, 'post__in' => $post_ids_array, 'orderby' => 'post__in' );
    } else {
      $args = array( 'post_status' => 'publish', 'post_type' => 'gallery', 'posts_per_page' => $post_num, 'orderby' => $post_order );
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
  ?>
  <a class="item animate_background swiper-slide" href="<?php the_permalink(); ?>">
   <div class="content">
    <h4 class="title"><span><?php the_title(); ?></span></h4>
   </div>
   <div class="image_wrap">
    <img loading="lazy" class="image" src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
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
    $instance['gallery_category_id'] = $new_instance['gallery_category_id'];
    $instance['custom_post_order'] = $new_instance['custom_post_order'];
    return $instance;
  }

  // Widget Control Panel //
  function form($instance) {
    global $blog_label;
    $options = get_design_plus_option();
    $gallery_label = $options['gallery_label'] ? esc_html( $options['gallery_label'] ) : __( 'Guest room', 'tcd-canon' );
    $defaults = array('title' => '', 'post_num' => 3, 'post_order' => 'menu_order', 'gallery_category_id' => '-1', 'post_type' => 'all_post', 'custom_post_order' => '');
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
  <option value="category_post" <?php selected('category_post', $instance['post_type']); ?>><?php _e('Category post', 'tcd-canon'); ?></option>
  <option value="custom_post" <?php selected('custom_post', $instance['post_type']); ?>><?php _e('Custom', 'tcd-canon'); ?></option>
 </select>
</div>

<div class="tcd_widget_content news_slider_post_num_wrap">
 <h3 class="tcd_widget_headline"><?php _e('Number of post', 'tcd-canon'); ?></h3>
 <input class="widefat" name="<?php echo $this->get_field_name('post_num'); ?>" type="number" value="<?php echo $instance['post_num']; ?>" min="3" />
</div>

<div class="tcd_widget_content news_category_wrap">
 <h3 class="tcd_widget_headline"><?php _e('Category', 'tcd-canon'); ?></h3>
 <?php
      $category_list = get_terms( 'gallery_category', array( 'orderby' => 'order', 'hide_empty' => true ) );
      if ( $category_list && ! is_wp_error( $category_list ) ) {
        $category_field_name = $this->get_field_name('gallery_category_id');
        $selected_value = $instance['gallery_category_id'];
        wp_dropdown_categories( array(
//         'show_option_none' => __('Please select category', 'tcd-canon'),
         'taxonomy' => 'gallery_category',
         'class' => 'gallery_category',
         'hierarchical' => true,
         'id' => '',
         'name' => $category_field_name,
         'selected' => $selected_value,
         'value_field' => 'term_id'
        ) );
      } else {
 ?>
 <p><?php _e('No category is registered', 'tcd-canon');  ?></p>
 <?php }; ?>
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


function register_gallery_slider_widget() {
	register_widget( 'gallery_slider_widget' );
}
add_action( 'widgets_init', 'register_gallery_slider_widget' );


?>
