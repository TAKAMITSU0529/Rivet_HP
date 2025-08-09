<?php

class tab_post_list_widget extends WP_Widget {

  function __construct() {
    parent::__construct(
      'tab_post_list_widget',// ID
      __('Tab post list (tcd ver)', 'tcd-canon'),
      array(
        'classname' => 'tab_post_list_widget',
        'description' => __('Display two type of post list by tab.', 'tcd-canon')
      )
    );
  }

  // Extract Args //
  function widget($args, $instance) {

    global $post;
    $options = get_design_plus_option();

    extract( $args );

    // Title of widget //
    $title1 = $instance['title1'];
    $title2 = $instance['title2'];
    $content_type1 = $instance['content_type1'];
    $content_type2 = $instance['content_type2'];

    if( (!$options['use_news'] && $content_type1 == 'news') && (!$options['use_news'] && $content_type2 == 'news') ){
      return;
    } else {
      if(!$title1 && !$title2){
        return;
      }
    }

    // Before widget //
    echo $before_widget;

    if( $title1 && ( ($options['use_news'] && $content_type1 == 'news') || ($content_type1 == 'post') ) && $title2 && ( ($options['use_news'] && $content_type2 == 'news') || ($content_type2 == 'post') ) ){
?>

<div class="widget_tab_post_list_button clearfix">
 <?php
      $tab_num = 1;
      for ( $i = 1; $i <= 2; $i++ ) :
        $tab_title = $instance['title'.$i];
        $content_type = $instance['content_type'.$i];
        if($tab_title){
          if(!$options['use_news'] && $content_type == 'news'){
            continue;
          }
 ?>
 <div class="tab<?php echo $tab_num; if($tab_num == 1){ echo ' active'; }; ?>"><?php echo esc_html($tab_title); ?></div>
 <?php
          $tab_num++;
        };
      endfor;
 ?>
</div>

<?php
      } else {
        $tab_title = $title1 ?  $title1 : $title2;
        if ( $tab_title ) {
          echo '<div class="no_tab">' . $before_title . $tab_title . $after_title . '</div>';
        }
      };
?>

<?php
      $tab_num = 1;
      $post_num = $instance['post_num'];
      for ( $i = 1; $i <= 2; $i++ ) :
        $tab_title = $instance['title'.$i];
        if($tab_title){
          $content_type = isset($instance['content_type'.$i]) ?  $instance['content_type'.$i] : 'post';
          $post_type = isset($instance['post_type'.$i]) ?  $instance['post_type'.$i] : 'all_post';
          $post_order = isset($instance['post_order'.$i]) ?  $instance['post_order'.$i] : 'date';
          $blog_category_id = isset($instance['blog_category_id'.$i]) ?  $instance['blog_category_id'.$i] : -1;
          $blog_category = get_terms( 'category', array('hide_empty' => true) );
          $news_category_id = isset($instance['news_category_id'.$i]) ?  $instance['news_category_id'.$i] : -1;
          $news_category = get_terms( 'news_category', array('hide_empty' => true) );
          $custom_post_order = isset($instance['custom_post_order'.$i]) ?  $instance['custom_post_order'.$i] : '';
          if(!$options['use_news'] && $content_type == 'news'){
            continue;
          }
          if ( $post_type == 'category_post') {
            if ( $content_type == 'post' && $blog_category ) {
              $args = array( 'post_status' => 'publish', 'post_type' => 'post', 'posts_per_page' => $post_num, 'orderby' => $post_order, 'tax_query' => array( array( 'taxonomy' => 'category', 'field' => 'term_id', 'terms' => $blog_category_id ), ) );
            } elseif( $content_type == 'news' && $news_category ){
              $args = array( 'post_status' => 'publish', 'post_type' => 'news', 'posts_per_page' => $post_num, 'orderby' => $post_order, 'tax_query' => array( array( 'taxonomy' => 'news_category', 'field' => 'term_id', 'terms' => $news_category_id ), ) );
            } else {
              $args = array( 'post_status' => 'publish', 'post_type' => $content_type, 'posts_per_page' => $post_num, 'orderby' => $post_order );
            }
          } elseif ( $post_type == 'recommend_post' || $post_type == 'recommend_post2' || $post_type == 'recommend_post3' ) {
            $args = array('post_type' => $content_type, 'posts_per_page' => $post_num, 'orderby' => $post_order, 'meta_key' => $post_type, 'meta_value' => 'on');
          } elseif ( $post_type == 'custom_post') {
            $post_ids = $custom_post_order;
            $post_ids_array = array_map('intval', explode(',', $post_ids));
            $args = array( 'post_status' => 'publish', 'post_type' => $content_type, 'posts_per_page' => $post_num, 'post__in' => $post_ids_array, 'orderby' => 'post__in' );
          } else {
            $args = array( 'post_status' => 'publish', 'post_type' => $content_type, 'posts_per_page' => $post_num, 'orderby' => $post_order );
          }
          $post_list = new wp_query($args);
?>
<ol class="widget_tab_post_list widget_tab_post_list<?php echo $tab_num; if($tab_num == 1){ echo ' active'; }; if($content_type == 'news' && $options['news_show_image'] == 'hide'){ echo ' no_image'; }; ?>">
 <?php
      if ($post_list->have_posts()) {
        while ($post_list->have_posts()) : $post_list->the_post();
          if(has_post_thumbnail()) {
            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size1' );
          } elseif($options['no_image']) {
            $image = wp_get_attachment_image_src( $options['no_image'], 'full' );
          } else {
            $image = array();
            $image[0] = get_bloginfo('template_url') . "/img/no_image1.gif";
            $image[1] = '100';
            $image[2] = '100';
          }
 ?>
 <li>
  <a class="animate_background" href="<?php the_permalink(); ?>">
   <?php if($content_type == 'news' && $options['news_show_image'] == 'hide'){ } else { ?>
   <div class="image_wrap">
    <img loading="lazy" class="image" src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
   </div>
   <?php }; ?>
   <div class="title_area">
    <p class="title"><span><?php the_title_attribute(); ?></span></p>
   </div>
  </a>
 </li>
<?php endwhile; wp_reset_query(); } else { ?>
 <li class="no_post" style="width:100%; margin-right:0;"><?php _e('There is no registered post.', 'tcd-canon');  ?></li>
<?php }; ?>
</ol>
<?php
         $tab_num++;
       }; // if has title

     endfor;

    // After widget //
    echo $after_widget;

  } // end function widget


  // Update Settings //
  function update($new_instance, $old_instance) {
    $instance['post_num'] = $new_instance['post_num'];
    $instance['title1'] = strip_tags($new_instance['title1']);
    $instance['title2'] = strip_tags($new_instance['title2']);
    $instance['content_type1'] = $new_instance['content_type1'];
    $instance['content_type2'] = $new_instance['content_type2'];
    $instance['post_type1'] = $new_instance['post_type1'];
    $instance['post_type2'] = $new_instance['post_type2'];
    $instance['post_order1'] = $new_instance['post_order1'];
    $instance['post_order2'] = $new_instance['post_order2'];
    $instance['blog_category_id1'] = $new_instance['blog_category_id1'];
    $instance['blog_category_id2'] = $new_instance['blog_category_id2'];
    $instance['news_category_id1'] = $new_instance['news_category_id1'];
    $instance['news_category_id2'] = $new_instance['news_category_id2'];
    $instance['custom_post_order1'] = $new_instance['custom_post_order1'];
    $instance['custom_post_order2'] = $new_instance['custom_post_order2'];
    return $instance;
  }

  // Widget Control Panel //
  function form($instance) {
    $options = get_design_plus_option();
    $defaults = array(
      'title1' => __('Recent post', 'tcd-canon'), 'post_num' => 3, 'content_type1' => 'post', 'post_order1' => 'date', 'post_type1' => 'all_post', 'blog_category_id1' => -1, 'news_category_id1' => -1, 'custom_post_order1' => '',
      'title2' => __('Recommend post', 'tcd-canon'), 'content_type2' => 'post', 'post_order2' => 'date', 'post_type2' => 'all_post', 'blog_category_id2' => -1, 'news_category_id2' => -1, 'custom_post_order2' => '',
    );
    $instance = wp_parse_args( (array) $instance, $defaults );
    global $blog_label;
    $options = get_design_plus_option();
    $news_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-canon' );
?>

<div class="tcd_widget_tab_content_wrap">

<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Number of post', 'tcd-canon'); ?></h3>
 <input class="widefat" name="<?php echo $this->get_field_name('post_num'); ?>" type="number" value="<?php echo $instance['post_num']; ?>" />
</div>

<h3 class="tcd_widget_tab_content_headline"><?php _e('First tab setting', 'tcd-canon'); ?></h3>
<div class="tcd_widget_tab_content">

<div class="theme_option_message2" style="margin-bottom:20px;">
 <p><?php _e('Leave the title field blank if you don\'t want to display this tab.', 'tcd-canon'); ?></p>
</div>

<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Title', 'tcd-canon'); ?></h3>
 <input class="widefat" name="<?php echo $this->get_field_name('title1'); ?>" type="text" value="<?php echo $instance['title1']; ?>" />
</div>

<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Content type', 'tcd-canon'); ?></h3>
 <select name="<?php echo $this->get_field_name('content_type1'); ?>" class="tab_post_list_content_type widefat" style="width:100%;">
  <option value="post" <?php selected('post', $instance['content_type1']); ?>><?php echo esc_html($blog_label); ?></option>
  <option value="news" <?php selected('news', $instance['content_type1']); ?>><?php if(!$options['use_news']){ _e('(N/A) ', 'tcd-canon'); }; echo esc_html($news_label); ?></option>
 </select>
</div>

<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Post type', 'tcd-canon'); ?></h3>
 <select name="<?php echo $this->get_field_name('post_type1'); ?>" class="tab_post_list_post_type widefat" style="width:100%;">
  <option value="all_post" <?php selected('all_post', $instance['post_type1']); ?>><?php _e('All post', 'tcd-canon'); ?></option>
  <option value="category_post" <?php selected('category_post', $instance['post_type1']); ?>><?php _e('Category post', 'tcd-canon'); ?></option>
  <option value="recommend_post" <?php selected('recommend_post', $instance['post_type1']); ?>><?php _e('Recommend post', 'tcd-canon'); ?>1</option>
  <option value="recommend_post2" <?php selected('recommend_post2', $instance['post_type1']); ?>><?php _e('Recommend post', 'tcd-canon'); ?>2</option>
  <option value="recommend_post3" <?php selected('recommend_post3', $instance['post_type1']); ?>><?php _e('Recommend post', 'tcd-canon'); ?>3</option>
  <option value="custom_post" <?php selected('custom_post', $instance['post_type1']); ?>><?php _e('Custom', 'tcd-canon'); ?></option>
 </select>
</div>

<div class="tcd_widget_content news_category_wrap">
 <h3 class="tcd_widget_headline"><?php _e('Category', 'tcd-canon'); ?></h3>
 <?php
      $category_list = get_terms( 'news_category', array( 'hide_empty' => true ) );
      if ( $category_list && ! is_wp_error( $category_list ) ) {
        $category_field_name = $this->get_field_name('news_category_id1');
        $selected_value = $instance['news_category_id1'];
        wp_dropdown_categories( array(
//         'show_option_none' => __('Please select category', 'tcd-canon'),
         'taxonomy' => 'news_category',
         'class' => 'news_category',
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

<div class="tcd_widget_content blog_category_wrap">
 <h3 class="tcd_widget_headline"><?php _e('Category', 'tcd-canon'); ?></h3>
 <?php
      $category_list = get_terms( 'category', array( 'hide_empty' => true ) );
      if ( $category_list && ! is_wp_error( $category_list ) ) {
        $category_field_name = $this->get_field_name('blog_category_id1');
        $selected_value = $instance['blog_category_id1'];
        wp_dropdown_categories( array(
//         'show_option_none' => __('Please select category', 'tcd-canon'),
         'taxonomy' => 'category',
         'class' => 'blog_category',
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

<div class="tcd_widget_content normal_post_order">
 <h3 class="tcd_widget_headline"><?php _e('Post order', 'tcd-canon'); ?></h3>
 <select name="<?php echo $this->get_field_name('post_order1'); ?>" class="widefat" style="width:100%;">
  <option value="date" <?php selected('date', $instance['post_order1']); ?>><?php _e('Date', 'tcd-canon'); ?></option>
  <option value="rand" <?php selected('rand', $instance['post_order1']); ?>><?php _e('Random', 'tcd-canon'); ?></option>
 </select>
</div>

<div class="tcd_widget_content custom_post_order">
 <h3 class="tcd_widget_headline"><?php _e('ID of the article you want to display', 'tcd-canon'); ?></h3>
 <div class="theme_option_message2">
  <p><?php _e('Enter article IDs separated by commas.<br>The ID can be found in the administration screen.<br><a href="https://tcd-theme.com/2017/01/check_pageid_categoryid.html#tcd_id" target="_blank">Click here to see the ID display section of the TCD theme.</a>', 'tcd-canon'); ?></p>
 </div>
 <input type="text" placeholder="<?php _e( 'e.g.', 'tcd-canon' ); ?>1,3,10" class="widefat hankaku" name="<?php echo $this->get_field_name('custom_post_order1'); ?>" value="<?php echo esc_attr($instance['custom_post_order1']); ?>">
</div>

</div><!-- END .tcd_ad_widget_box -->

<h3 class="tcd_widget_tab_content_headline"><?php _e('Second tab setting', 'tcd-canon'); ?></h3>
<div class="tcd_widget_tab_content">

<div class="theme_option_message2" style="margin-bottom:20px;">
 <p><?php _e('Leave the title field blank if you don\'t want to display this tab.', 'tcd-canon'); ?></p>
</div>

<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Title', 'tcd-canon'); ?></h3>
 <input class="widefat" name="<?php echo $this->get_field_name('title2'); ?>'" type="text" value="<?php echo $instance['title2']; ?>" />
</div>

<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Content type', 'tcd-canon'); ?></h3>
 <select name="<?php echo $this->get_field_name('content_type2'); ?>" class="tab_post_list_content_type widefat" style="width:100%;">
  <option value="post" <?php selected('post', $instance['content_type2']); ?>><?php echo esc_html($blog_label); ?></option>
  <option value="news" <?php selected('news', $instance['content_type2']); ?>><?php if(!$options['use_news']){ _e('(N/A) ', 'tcd-canon'); }; echo esc_html($news_label); ?></option>
 </select>
</div>

<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Post type', 'tcd-canon'); ?></h3>
 <select name="<?php echo $this->get_field_name('post_type2'); ?>" class="tab_post_list_post_type widefat" style="width:100%;">
  <option value="all_post" <?php selected('all_post', $instance['post_type2']); ?>><?php _e('All post', 'tcd-canon'); ?></option>
  <option value="category_post" <?php selected('category_post', $instance['post_type2']); ?>><?php _e('Category post', 'tcd-canon'); ?></option>
  <option value="recommend_post" <?php selected('recommend_post', $instance['post_type2']); ?>><?php _e('Recommend post', 'tcd-canon'); ?>1</option>
  <option value="recommend_post2" <?php selected('recommend_post2', $instance['post_type2']); ?>><?php _e('Recommend post', 'tcd-canon'); ?>2</option>
  <option value="recommend_post3" <?php selected('recommend_post3', $instance['post_type2']); ?>><?php _e('Recommend post', 'tcd-canon'); ?>3</option>
  <option value="custom_post" <?php selected('custom_post', $instance['post_type2']); ?>><?php _e('Custom', 'tcd-canon'); ?></option>
 </select>
</div>

<div class="tcd_widget_content news_category_wrap">
 <h3 class="tcd_widget_headline"><?php _e('Category', 'tcd-canon'); ?></h3>
 <?php
      $category_list = get_terms( 'news_category', array( 'hide_empty' => true ) );
      if ( $category_list && ! is_wp_error( $category_list ) ) {
        $category_field_name = $this->get_field_name('news_category_id2');
        $selected_value = $instance['news_category_id2'];
        wp_dropdown_categories( array(
//         'show_option_none' => __('Please select category', 'tcd-canon'),
         'taxonomy' => 'news_category',
         'class' => 'news_category',
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

<div class="tcd_widget_content blog_category_wrap">
 <h3 class="tcd_widget_headline"><?php _e('Category', 'tcd-canon'); ?></h3>
 <?php
      $category_list = get_terms( 'category', array( 'hide_empty' => true ) );
      if ( $category_list && ! is_wp_error( $category_list ) ) {
        $category_field_name = $this->get_field_name('blog_category_id2');
        $selected_value = $instance['blog_category_id2'];
        wp_dropdown_categories( array(
//         'show_option_none' => __('Please select category', 'tcd-canon'),
         'taxonomy' => 'category',
         'class' => 'blog_category',
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

<div class="tcd_widget_content normal_post_order">
 <h3 class="tcd_widget_headline"><?php _e('Post order', 'tcd-canon'); ?></h3>
 <select name="<?php echo $this->get_field_name('post_order2'); ?>" class="widefat" style="width:100%;">
  <option value="date" <?php selected('date', $instance['post_order2']); ?>><?php _e('Date', 'tcd-canon'); ?></option>
  <option value="rand" <?php selected('rand', $instance['post_order2']); ?>><?php _e('Random', 'tcd-canon'); ?></option>
 </select>
</div>

<div class="tcd_widget_content custom_post_order">
 <h3 class="tcd_widget_headline"><?php _e('ID of the article you want to display', 'tcd-canon'); ?></h3>
 <div class="theme_option_message2">
  <p><?php _e('Enter article IDs separated by commas.<br>The ID can be found in the administration screen.<br><a href="https://tcd-theme.com/2017/01/check_pageid_categoryid.html#tcd_id" target="_blank">Click here to see the ID display section of the TCD theme.</a>', 'tcd-canon'); ?></p>
 </div>
 <input type="text" placeholder="<?php _e( 'e.g.', 'tcd-canon' ); ?>1,3,10" class="widefat hankaku" name="<?php echo $this->get_field_name('custom_post_order2'); ?>" value="<?php echo esc_attr($instance['custom_post_order2']); ?>">
</div>

</div><!-- END .tcd_ad_widget_box -->

</div><!-- END .tcd_ad_widget_box_wrap -->

<?php

  } // end function form

} // end class


function register_tab_post_list_widget() {
  register_widget( 'tab_post_list_widget' );
}
add_action( 'widgets_init', 'register_tab_post_list_widget' );


?>