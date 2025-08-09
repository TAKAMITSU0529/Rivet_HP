<?php
     get_header();
     $options = get_design_plus_option();
     $query_obj = get_queried_object();
     $current_cat_id = $query_obj->term_id;
     $cat_name = $query_obj->name;
     $term_meta = get_option( 'taxonomy_' . $current_cat_id, array() );
     $image = !empty($term_meta['image']) ? $term_meta['image'] : $options['archive_gallery_header_image'];
     $image = wp_get_attachment_image_src($image, 'full');
     $sub_title = isset($term_meta['sub_title']) ?  $term_meta['sub_title'] : '';
     $desc = isset($term_meta['desc']) ?  $term_meta['desc'] : '';
     $desc_mobile = isset($term_meta['desc_mobile']) ?  $term_meta['desc_mobile'] : '';
     $content = isset($term_meta['content']) ?  $term_meta['content'] : '';
     $content_mobile = isset($term_meta['content_mobile']) ?  $term_meta['content_mobile'] : '';
?>
<?php get_template_part('template-parts/breadcrumb'); ?>

<?php if($image) { ?>
<div id="page_header">
 <img class="image" src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>">
</div>
<?php }; ?>

<section id="gallery_category">

 <?php
      // タイトルエリア --------------------
 ?>
 <div class="header">
  <div class="headline_area inview">
   <h2 class="headline"><?php echo esc_html($cat_name); ?></h2>
   <?php if($sub_title){ ?>
   <p class="sub_title"><?php echo esc_html($sub_title); ?></p>
   <?php }; ?>
  </div>
  <?php if($desc){ ?>
  <p class="desc inview"><?php if($desc_mobile){ echo '<span class="pc">'; }; echo wp_kses_post(nl2br($desc)); if($desc_mobile){ echo '</span><span class="mobile">' . wp_kses_post(nl2br($desc_mobile)) . "</span>"; }; ?></p>
  <?php }; ?>
 </div>

 <?php
      // スライダー --------------------
      $image_slider = isset($term_meta['gallery_image_slider']) ?  $term_meta['gallery_image_slider'] : '';
      if($image_slider){
        $image_slider = !empty($image_slider) ? explode( ',', $image_slider ) : array();
 ?>
 <div class="sc_image_carousel_container layout_type2 inview">
  <div class="sc_image_carousel_wrap swiper">
   <div class="sc_image_carousel swiper-wrapper">
    <?php
         foreach( $image_slider as $image_id ):
           $slider_image = wp_get_attachment_image_src( $image_id, 'full' );
           if($slider_image){
    ?>
    <div class="item swiper-slide">
     <img src="<?php echo esc_attr($slider_image[0]); ?>" alt="" width="<?php echo esc_attr($slider_image[1]); ?>" height="<?php echo esc_attr($slider_image[2]); ?>">
    </div>
    <?php
           };
         endforeach;
    ?>
   </div><!-- END .sc_image_carousel -->
  </div><!-- END .sc_image_carousel_wrap -->
  <div class="sc_image_carousel_nav swiper">
   <div class="swiper-wrapper">
    <?php
         foreach( $image_slider as $image_id ):
           $slider_image = wp_get_attachment_image_src( $image_id, 'full' );
           if($slider_image){
    ?>
    <div class="swiper-slide"></div>
    <?php
           };
         endforeach;
    ?>
   </div>
  </div>
 </div><!-- END .sc_image_carousel_container -->
 <?php }; ?>

 <?php
      // 本文 --------------------
 ?>
 <?php if($content){ ?>
 <div class="post_content clearfix inview<?php if($content_mobile){ echo ' pc'; }; ?>">
  <?php echo apply_filters('the_content', $content ); ?>
 </div>
 <?php }; ?>
 <?php if($content_mobile){ ?>
 <div class="post_content mobile clearfix inview">
  <?php echo apply_filters('the_content', $content_mobile ); ?>
 </div>
 <?php }; ?>

</section><!-- END #gallery_category -->

<?php
     // 並び替え
     $post_list_order = $options['archive_gallery_post_list_order_new'];
       if($post_list_order){
?>
<div id="single_gallery_post_list">

<?php
     foreach ( $post_list_order as $key => $value ) :
       $post_list_name = isset($value['name']) ? $value['name'] : '';

       // プラン一覧 --------------------
       if($post_list_name == 'plan_list'){
         $show_gallery_plan_list = isset($term_meta['show_gallery_plan_list']) ?  $term_meta['show_gallery_plan_list'] : '';
         if($show_gallery_plan_list == 1){
         $post_num = isset($term_meta['gallery_plan_list_num']) ?  $term_meta['gallery_plan_list_num'] : '6';
         if(is_mobile()){
           $post_num = isset($term_meta['gallery_plan_list_num_sp']) ?  $term_meta['gallery_plan_list_num_sp'] : '6';
         }
         $post_order = isset($term_meta['gallery_plan_list_order']) ?  $term_meta['gallery_plan_list_order'] : 'rand';
         $args = array( 'post_type' => 'post', 'posts_per_page' => $post_num, 'orderby' => $post_order, 'meta_query' => array( array( 'key' => 'relation_gallery_category', 'value' => '"' . $current_cat_id . '"', 'compare' => 'LIKE' ) ) );
         $related_post_list = new wp_query($args);
         if($related_post_list->have_posts()):
           $gallery_plan_list_headline = isset($term_meta['gallery_plan_list_headline']) ?  $term_meta['gallery_plan_list_headline'] : '';
           $gallery_plan_list_sub_headline = isset($term_meta['gallery_plan_list_sub_headline']) ?  $term_meta['gallery_plan_list_sub_headline'] : '';
?>
<section id="gallery_category_plan_list">
 <div id="single_related_post" class="inview">
  <?php if($gallery_plan_list_headline){ ?><h2 class="headline"><?php echo esc_html($gallery_plan_list_headline); ?></h2><?php }; ?>
  <?php if($gallery_plan_list_sub_headline){ ?><p class="sub_title"><?php echo esc_html($gallery_plan_list_sub_headline); ?></p><?php }; ?>
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
  </div><!-- END #single_related_post_wrap -->
 </div><!-- END #single_related_post -->
</section>
<?php
         endif;
       };

     // 客室一覧 -----------------------------------------
     } elseif($post_list_name == 'gallery_list'){
?>
<section id="category_gallery_list">

 <?php if($options['archive_gallery_headline']){ ?>
 <h2 class="design_headline2 inview"><?php echo esc_html($options['archive_gallery_headline']); ?></h2>
 <?php }; ?>

<?php if ( have_posts() ) : ?>

 <div class="gallery_list inview">
  <?php
       while ( have_posts() ) : the_post();
         if(has_post_thumbnail()) {
           $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size3' );
         } elseif($options['no_image']) {
           $image = wp_get_attachment_image_src( $options['no_image'], 'full' );
         } else {
           $image = array();
           $image[0] = get_bloginfo('template_url') . "/img/no_image2.gif";
           $image[1] = '620';
           $image[2] = '400';
         }
         $gallery_catch = get_post_meta($post->ID, 'gallery_catch', true);
  ?>
  <a class="item animate_background" href="<?php the_permalink(); ?>">
   <div class="image_wrap">
    <img loading="lazy" class="image" src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
   </div>
   <div class="content">
    <h3 class="title"><span><?php the_title(); ?></span></h3>
    <?php if($gallery_catch){ ?>
    <p class="desc"><?php echo wp_kses_post(nl2br($gallery_catch)); ?></p>
    <?php }; ?>
   </div>
  </a>
  <?php endwhile; ?>
 </div><!-- END .news_list -->

 <?php get_template_part('template-parts/navigation'); ?>

 <?php else: ?>

 <p id="no_post"><?php _e('There is no registered post.', 'tcd-canon');  ?></p>

 <?php endif; ?>

</section>

<?php
       };
     endforeach;
?>

</div><!-- END #single_gallery_post_list -->
<?php }; ?>

<?php get_footer(); ?>