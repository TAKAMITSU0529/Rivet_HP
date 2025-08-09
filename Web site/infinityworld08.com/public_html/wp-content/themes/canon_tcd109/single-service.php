<?php
     get_header();
     $options = get_design_plus_option();
     if(has_post_thumbnail()) {
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
     } else {
        $image = wp_get_attachment_image_src($options['archive_service_header_image'], 'full');
     }
?>

<?php get_template_part('template-parts/breadcrumb'); ?>

<?php if($image) { ?>
<div id="page_header">
 <img class="image" src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>">
</div>
<?php }; ?>

<article id="single_service">

 <?php
      if ( have_posts() ) : while ( have_posts() ) : the_post();
        $service_sub_title = get_post_meta($post->ID, 'service_sub_title', true);
 ?>

 <div id="service_header" class="inview">
  <?php if($service_sub_title){ ?>
  <p class="sub_title"><?php echo wp_kses_post(nl2br($service_sub_title)); ?></p>
  <?php }; ?>
  <h1 class="title entry-title"><span><?php the_title(); ?></span></h1>
 </div>

 <?php // メインコンテンツ -------------------------- ?>
 <div class="post_content clearfix inview">
  <?php
       the_content();
       if ( ! post_password_required() ) {
         custom_wp_link_pages();
       }
  ?>
 </div>

</article>

<?php endwhile; endif; ?>

<?php
     // レストラン一覧 -------------------------------------------------
     $current_page_id = $post->ID;
     $post_num = -1;
     $args = array( 'post_status' => 'publish', 'post_type' => 'service', 'posts_per_page' => $post_num, 'orderby' => array('menu_order' => 'ASC', 'date' => 'DESC') );
     $post_list = new wp_query($args);
     if($post_list->have_posts()):
?>
<section id="service_post_list" class="inview">
 <div class="post_list layout_<?php echo esc_attr($options['service_post_list_layout']); ?> layout_mobile_<?php echo esc_attr($options['service_post_list_layout_mobile']); ?>">
  <?php
       while( $post_list->have_posts() ) : $post_list->the_post();
        $service_sub_title = get_post_meta($post->ID, 'service_sub_title', true);
  ?>
  <a class="item<?php if($current_page_id == $post->ID){ echo ' active'; }; ?>" href="<?php the_permalink(); ?>">
   <?php if($service_sub_title){ ?>
   <p class="sub_title"><?php echo wp_kses_post(nl2br($service_sub_title)); ?></p>
   <?php }; ?>
   <h2 class="title"><?php the_title(); ?></h2>
  </a>
  <?php endwhile; wp_reset_query(); ?>
 </div><!-- END .post_list -->
</section>
<?php endif; ?>


<?php
     // プラン一覧 --------------------
     $show_plan_list = get_post_meta($post->ID, 'show_plan_list', true) ?  get_post_meta($post->ID, 'show_plan_list', true) : '';
     if($show_plan_list == 1){
       $plan_list_headline = get_post_meta($post->ID, 'plan_list_headline', true) ?  get_post_meta($post->ID, 'plan_list_headline', true) : 'PLAN';
       $plan_list_sub_headline = get_post_meta($post->ID, 'plan_list_sub_headline', true) ?  get_post_meta($post->ID, 'plan_list_sub_headline', true) : '';
       $post_order = get_post_meta($post->ID, 'plan_list_order', true) ?  get_post_meta($post->ID, 'plan_list_order', true) : 'date';
       $post_num = get_post_meta($post->ID, 'plan_list_num', true) ?  get_post_meta($post->ID, 'plan_list_num', true) : '6';
       if(is_mobile()){
         $post_num = get_post_meta($post->ID, 'plan_list_num_sp', true) ?  get_post_meta($post->ID, 'plan_list_num_sp', true) : '4';
       }
       $current_page_id = get_the_ID();
       $args = array( 'post_type' => 'post', 'posts_per_page' => $post_num, 'orderby' => $post_order, 'meta_query' => array( array( 'key' => 'relation_service', 'value' => '"' . $current_page_id . '"', 'compare' => 'LIKE' ) ) );
       $related_post_list = new wp_query($args);
       if($related_post_list->have_posts()):
?>
<section id="gallery_category_plan_list">
 <div id="single_related_post" class="inview">
  <?php if($plan_list_headline){ ?><h2 class="headline"><?php echo esc_html($plan_list_headline); ?></h2><?php }; ?>
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
        <h3 class="title"><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></h3>
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
               foreach ( $category as $cat ) :
                 $cat_name = $cat->name;
                 $cat_id = $cat->term_id;
                 $cat_url = get_term_link($cat_id,'category');
          ?>
          <a class="category" href="<?php echo esc_url($cat_url); ?>"><?php echo esc_html($cat_name); ?></a>
          <?php
               endforeach;
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