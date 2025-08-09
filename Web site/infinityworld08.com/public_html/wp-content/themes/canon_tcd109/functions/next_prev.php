<?php

function next_prev_post_link() {

  $options = get_design_plus_option();
  $prev_post = get_adjacent_post(false, '', true);
  $next_post = get_adjacent_post(false, '', false);

  if ($prev_post) {
    $post_id = $prev_post->ID;
    if(has_post_thumbnail($post_id)) {
      $image = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'size1' );
    } elseif($options['no_image']) {
      $image = wp_get_attachment_image_src( $options['no_image'], 'full' );
    } else {
      $image = array();
      $image[0] = get_bloginfo('template_url') . "/img/no_image1.gif";
      $image[1] = '200';
      $image[2] = '200';
    }
?>
<a class="item prev_post animate_background" href="<?php echo get_permalink($post_id); ?>">
 <div class="image_wrap">
  <img loading="lazy" class="image" src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
 </div>
 <div class="content">
  <p class="title"><span><?php the_title_attribute('post='.$post_id); ?></span></p>
  <p class="nav"><?php echo __('Prev post', 'tcd-canon'); ?></p>
 </div>
</a>
<?php
  };
  if ($next_post) {
    $post_id = $next_post->ID;
    if(has_post_thumbnail($post_id)) {
      $image = wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'size1' );
    } elseif($options['no_image']) {
      $image = wp_get_attachment_image_src( $options['no_image'], 'full' );
    } else {
      $image = array();
      $image[0] = get_bloginfo('template_url') . "/img/no_image1.gif";
      $image[1] = '200';
      $image[2] = '200';
    }
?>
<a class="item next_post animate_background" href="<?php echo get_permalink($post_id); ?>">
 <div class="image_wrap">
  <img loading="lazy" class="image" src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
 </div>
 <div class="content">
  <p class="title"><span><?php the_title_attribute('post='.$post_id); ?></span></p>
  <p class="nav"><?php echo __('Next post', 'tcd-canon'); ?></p>
 </div>
</a>
<?php
  };

}


function next_prev_post_link2() {

  $options = get_design_plus_option();
  $prev_post = get_adjacent_post(false, '', true);
  $next_post = get_adjacent_post(false, '', false);

  if ($prev_post) {
    $post_id = $prev_post->ID;
?>
<a class="item prev_post" href="<?php echo get_permalink($post_id); ?>">
 <p class="title"><span><?php the_title_attribute('post='.$post_id); ?></span></p>
 <p class="nav"><?php echo __('Prev post', 'tcd-canon'); ?></p>
</a>
<?php
  };
  if ($next_post) {
    $post_id = $next_post->ID;
?>
<a class="item next_post" href="<?php echo get_permalink($post_id); ?>">
 <p class="title"><span><?php the_title_attribute('post='.$post_id); ?></span></p>
 <p class="nav"><?php echo __('Next post', 'tcd-canon'); ?></p>
</a>
<?php
  };

}


// スタイル
function style_next_prev_post() {

  $options = get_design_plus_option();
  $gallery_label = $options['gallery_label'] ? esc_html( $options['gallery_label'] ) : __( 'Guest room', 'tcd-canon' );

  $prev_post = get_adjacent_post( false, '', true );
  $next_post = get_adjacent_post( false, '', false );

  if ($prev_post) {
    $post_id = $prev_post->ID;
?>
<a class="item" href="<?php echo get_permalink($post_id); ?>"><?php printf(__('Prev %s', 'tcd-canon'), $gallery_label); ?></a>
<?php
  };

  if ($next_post) {
    $post_id = $next_post->ID;
?>
<a class="item" href="<?php echo get_permalink($post_id); ?>"><?php printf(__('Next %s', 'tcd-canon'), $gallery_label);; ?></a>
<?php
  };

}


// add class to posts_nav_link()
add_filter('next_posts_link_attributes', 'posts_link_attributes_1');
add_filter('previous_posts_link_attributes', 'posts_link_attributes_2');

function posts_link_attributes_1() {
    return 'class="next"';
}
function posts_link_attributes_2() {
    return 'class="prev"';
}


?>