<?php
     get_header();
     $options = get_design_plus_option();
     $hide_sidebar = get_post_meta($post->ID, 'hide_sidebar', true) ?  get_post_meta($post->ID, 'hide_sidebar', true) : 'hide';
     $hide_breadcrumb = get_post_meta($post->ID, 'hide_breadcrumb', true) ?  get_post_meta($post->ID, 'hide_breadcrumb', true) : 'no';
     $headline = get_the_title();
     $image = wp_get_attachment_image_src(get_post_meta($post->ID, 'header_image', true), 'full');
     $image_mobile = wp_get_attachment_image_src(get_post_meta($post->ID, 'header_image_mobile', true), 'full');
     $overlay_color = get_post_meta($post->ID, 'header_overlay_color', true) ?  get_post_meta($post->ID, 'header_overlay_color', true) : '#000000';
     $overlay_color = hex2rgb($overlay_color);
     $overlay_color = implode(",",$overlay_color);
     $overlay_opacity = get_post_meta($post->ID, 'header_overlay_color_opacity', true) ?  get_post_meta($post->ID, 'header_overlay_color_opacity', true) : '0.3';
     if($overlay_opacity == 'zero'){
       $overlay_opacity = '0';
     }
     if($image){
?>
<div id="page_header">
 <h1 class="headline"><span><?php echo wp_kses_post(nl2br($headline)); ?></span></h1>
 <div class="overlay" style="background:rgba(<?php echo esc_attr($overlay_color); ?>,<?php echo esc_attr($overlay_opacity); ?>);"></div>
 <img class="image<?php if($image_mobile){ echo ' pc'; }; ?>" src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>">
 <?php if($image_mobile){ ?>
 <img class="image mobile" src="<?php echo esc_attr($image_mobile[0]); ?>" alt="" width="<?php echo esc_attr($image_mobile[1]); ?>" height="<?php echo esc_attr($image_mobile[2]); ?>">
 <?php }; ?>
</div>
<?php }; ?>

<?php if($hide_breadcrumb != 'yes'){ get_template_part('template-parts/breadcrumb'); }; ?>

<?php if(!$image){ ?>
<h1 id="page_headline"><?php echo wp_kses_post(nl2br($headline)); ?></h1>
<?php }; ?>

<?php if($hide_sidebar == 'hide'){ ?>

<article id="page_contents">

 <div class="post_content clearfix inview">
  <?php
       the_content();
       if ( ! post_password_required() ) {
         custom_wp_link_pages();
       }
  ?>
 </div>

</article><!-- END #page_contents -->

<?php } else { ?>

<div id="main_content">

 <div id="main_col">

  <article id="article">

   <div class="post_content clearfix inview">
    <?php
         the_content();
         if ( ! post_password_required() ) {
           custom_wp_link_pages();
         }
    ?>
   </div>

 </div><!-- END #main_col -->

 <?php get_sidebar(); ?>

</div><!-- END #main_contents -->

<?php }; ?>

<?php
     // プラン一覧 --------------------
     $hide_plan_list = get_post_meta($post->ID, 'hide_plan_list', true) ?  get_post_meta($post->ID, 'hide_plan_list', true) : 'yes';
     $plan_list_headline = get_post_meta($post->ID, 'plan_list_headline', true) ?  get_post_meta($post->ID, 'plan_list_headline', true) : 'PLAN';
     $plan_list_sub_headline = get_post_meta($post->ID, 'plan_list_sub_headline', true) ?  get_post_meta($post->ID, 'plan_list_sub_headline', true) : '';
     $plan_list_num = get_post_meta($post->ID, 'plan_list_num', true) ?  get_post_meta($post->ID, 'plan_list_num', true) : '6';
     $plan_list_num_sp = get_post_meta($post->ID, 'plan_list_num_sp', true) ?  get_post_meta($post->ID, 'plan_list_num_sp', true) : '4';
     $plan_list_type = get_post_meta($post->ID, 'plan_list_type', true) ?  get_post_meta($post->ID, 'plan_list_type', true) : 'all_post';
     $plan_list_order = get_post_meta($post->ID, 'plan_list_order', true) ?  get_post_meta($post->ID, 'plan_list_order', true) : 'rand';
     $plan_list_order_custom = get_post_meta($post->ID, 'plan_list_order_custom', true) ?  get_post_meta($post->ID, 'plan_list_order_custom', true) : '';
     $plan_list_category_id = get_post_meta($post->ID, 'plan_list_category_id', true) ?  get_post_meta($post->ID, 'plan_list_category_id', true) : '';

     if($hide_plan_list != 'yes'){
       $post_num = $plan_list_num;
       if(is_mobile()){
         $post_num = $plan_list_num_sp;
       }
       $post_type = $plan_list_type;
       $post_order = $plan_list_order;
       $post_category = get_terms( 'category', array('hide_empty' => true) );
       $category_id = intval($plan_list_category_id);
       if ( $post_type == 'category_post' && $post_category && $category_id) {
         $args = array( 'post_status' => 'publish', 'post_type' => 'post', 'posts_per_page' => $post_num, 'orderby' => $post_order, 'tax_query' => array( array( 'taxonomy' => 'category', 'field' => 'term_id', 'terms' => $category_id ), ) );
       } elseif ( $post_type == 'recommend_post' || $post_type == 'recommend_post2' || $post_type == 'recommend_post3' ) {
         $args = array('post_type' => 'post', 'posts_per_page' => $post_num, 'orderby' => $post_order, 'meta_key' => $post_type, 'meta_value' => 'on');
       } elseif ( $post_type == 'custom' ) {
         $post_ids = $plan_list_order_custom;
         $post_ids_array = array_map('intval', explode(',', $post_ids));
         $args = array( 'post_type' => 'post', 'posts_per_page' => $post_num, 'post__in' => $post_ids_array, 'orderby' => 'post__in' );
       } else {
         $args = array( 'post_type' => 'post', 'posts_per_page' => $post_num, 'orderby' => $post_order );
       }
       $related_post_list = new wp_query($args);
       if($related_post_list->have_posts()):
?>
<section id="gallery_category_plan_list">
 <div id="single_related_post" class="inview">
  <?php if($plan_list_headline){ ?><h3 class="headline"><?php echo esc_html($plan_list_headline); ?></h3><?php }; ?>
  <?php if($plan_list_sub_headline){ ?><p class="sub_title"><?php echo esc_html($plan_list_sub_headline); ?></p><?php }; ?>
  <div id="related_post_carousel_wrap">
   <div id="related_post_carousel" class="swiper">
    <div class="blog_list swiper-wrapper">
     <?php
          while( $related_post_list->have_posts() ) : $related_post_list->the_post();
            if(has_post_thumbnail()) {
              $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size2' );
            } elseif($options['no_image']) {
              $image = wp_get_attachment_image_src( $options['no_image'], 'full' );
            } else {
              $image = array();
              $image[0] = get_bloginfo('template_url') . "/img/no_image2.gif";
              $image[1] = '720';
              $image[2] = '460';
            }
     ?>
     <div class="item swiper-slide">
      <a class="animate_background" href="<?php the_permalink(); ?>">
       <div class="image_wrap">
        <img loading="lazy" class="image" src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
       </div>
      </a>
      <div class="content">
       <div class="content_inner">
        <h4 class="title"><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></h4>
        <div class="meta">
         <?php if($options['blog_show_date'] == 'display'){ ?>
         <div class="date_list">
          <time class="date entry-date published" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
          <?php
                 $post_date = get_the_time('Ymd');
                 $modified_date = get_the_modified_date('Ymd');
                 if($post_date < $modified_date && $options['blog_show_update'] == 'display'){
          ?>
          <time class="update entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_modified_date('Y.m.d'); ?></time>
          <?php }; ?>
         </div>
         <?php
              };
              $category = wp_get_post_terms($post->ID, 'category');
              if ( $category && ! is_wp_error($category) ) {
         ?>
         <div class="category_list">
          <?php
               if ( $post_type == 'category_post' && $category_id) {
                 $cat_name = get_cat_name($category_id);
                 $cat_url = get_term_link($category_id,'category');
          ?>
          <a class="category" href="<?php echo esc_url($cat_url); ?>"><?php echo esc_html($cat_name); ?></a>
          <?php
               } else {
                 foreach ( $category as $cat ) :
                   $cat_name = $cat->name;
                   $cat_id = $cat->term_id;
                   $cat_url = get_term_link($cat_id,'category');
          ?>
          <a class="category" href="<?php echo esc_url($cat_url); ?>"><?php echo esc_html($cat_name); ?></a>
          <?php
                 endforeach;
               };
          ?>
         </div>
         <?php }; ?>
        </div>
       </div>
      </div>
     </div>
     <?php endwhile; wp_reset_query(); ?>
    </div><!-- END .blog_list -->
   </div><!-- END #related_post_carousel -->
   <div class="related_post_prev swiper-nav-button type2 swiper-button-prev"></div>
   <div class="related_post_next swiper-nav-button type2 swiper-button-next"></div>
  </div><!-- END #related_post_carousel_wrap -->
 </div><!-- END #single_related_post -->
</section>
<?php
       endif;
     };
?>

<?php get_footer(); ?>