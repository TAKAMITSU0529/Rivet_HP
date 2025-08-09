<?php
     get_header();
     $options = get_design_plus_option();
?>

<?php get_template_part('template-parts/breadcrumb'); ?>

<article id="single_gallery">

 <?php
      if ( have_posts() ) : while ( have_posts() ) : the_post();
        $cat_id = '';
        $category = wp_get_post_terms( $post->ID, 'gallery_category' , array( 'orderby' => 'term_order' ));
        if ( $category && ! is_wp_error($category) ) {
          foreach ( $category as $cat ) :
            $cat_name = $cat->name;
            $cat_id = $cat->term_id;
            $term_meta = get_option( 'taxonomy_' . $cat_id, array() );
            $headline = isset($term_meta['headline']) ?  $term_meta['headline'] : '';
            if($headline){
              $cat_name = $headline;
            }
            $cat_url = get_term_link($cat_id,'gallery_category');
            break;
          endforeach;
        };
        $gallery_catch = get_post_meta($post->ID, 'gallery_catch', true);
        $gallery_spec1 = get_post_meta($post->ID, 'gallery_spec1', true);
        $gallery_spec2 = get_post_meta($post->ID, 'gallery_spec2', true);
        $gallery_spec3 = get_post_meta($post->ID, 'gallery_spec3', true);
        $gallery_spec4 = get_post_meta($post->ID, 'gallery_spec4', true);
        $gallery_button_label = get_post_meta($post->ID, 'gallery_button_label', true);
        $gallery_button_url = get_post_meta($post->ID, 'gallery_button_url', true);
        $gallery_button_target = get_post_meta($post->ID, 'gallery_button_target', true);
 ?>

 <div id="gallery_header" class="inview">
  <div class="top">
   <?php if ( $options['gallery_use_category'] == 'yes' && $category && ! is_wp_error($category) ) { ?>
   <a class="category" href="<?php echo esc_url($cat_url); ?>"><?php echo esc_html($cat_name); ?></a>
   <?php }; ?>
   <h1 class="title entry-title"><span><?php the_title(); ?></span></h1>
   <?php if($gallery_catch){ ?>
   <p class="catch"><?php echo wp_kses_post(nl2br($gallery_catch)); ?></p>
   <?php }; ?>
  </div>
  <?php if($gallery_catch){ ?>
  <p class="catch_mobile"><?php echo wp_kses_post(nl2br($gallery_catch)); ?></p>
  <?php }; ?>
  <?php
       if(has_post_thumbnail()) {
         $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
  ?>
  <div class="image">
   <img src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
  </div>
  <?php }; ?>
  <?php if($gallery_spec1 || $gallery_spec2 || $gallery_spec3 || $gallery_spec4 || $gallery_button_url){ ?>
  <div class="bottom<?php if($gallery_spec1 && $gallery_spec2 && $gallery_spec3 && $gallery_spec4){ echo ' layout_type2'; }; ?>">
   <?php if($gallery_spec1 || $gallery_spec2 || $gallery_spec3 || $gallery_spec4){ ?>
   <div class="spec_list">
    <?php
         for ( $i = 1; $i <= 4; $i++ ) :
           $gallery_spec = get_post_meta($post->ID, 'gallery_spec'.$i, true);
           if($gallery_spec){
    ?>
    <p><?php echo wp_kses_post($gallery_spec); ?></p>
    <?php
           };
         endfor;
    ?>
   </div>
   <?php }; ?>
   <?php if($gallery_button_url && $gallery_button_label){ ?>
   <a class="button" href="<?php echo esc_attr($gallery_button_url); ?>"<?php if($gallery_button_target){ echo ' target="_blank"'; }; ?>><?php echo esc_html($gallery_button_label); ?></a>
   <?php }; ?>
  </div>
  <?php }; ?>
 </div>

 <?php if($gallery_button_url && $gallery_button_label){ ?>
 <div id="gallery_header_button" class="inview">
  <a class="design_button" href="<?php echo esc_attr($gallery_button_url); ?>"<?php if($gallery_button_target){ echo ' target="_blank"'; }; ?>><?php echo esc_html($gallery_button_label); ?></a>
 </div>
 <?php }; ?>

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
     // 並び替え
     $post_list_order = $options['single_gallery_post_list_order_new'];
       if($post_list_order){
?>
<div id="single_gallery_post_list">

<?php
     foreach ( $post_list_order as $key => $value ) :
       $post_list_name = isset($value['name']) ? $value['name'] : '';

         // プラン一覧 --------------------
         if($post_list_name == 'plan_list'){
           $show_plan_list = get_post_meta($post->ID, 'show_plan_list', true) ?  get_post_meta($post->ID, 'show_plan_list', true) : '';
           if($show_plan_list == 1){
             $post_order = get_post_meta($post->ID, 'plan_list_order', true) ?  get_post_meta($post->ID, 'plan_list_order', true) : 'date';
             $post_num = get_post_meta($post->ID, 'plan_list_num', true) ?  get_post_meta($post->ID, 'plan_list_num', true) : '6';
             if(is_mobile()){
               $post_num = get_post_meta($post->ID, 'plan_list_num_sp', true) ?  get_post_meta($post->ID, 'plan_list_num_sp', true) : '4';
             }
             $current_page_id = get_the_ID();
             $args = array( 'post_type' => 'post', 'posts_per_page' => $post_num, 'orderby' => $post_order, 'meta_query' => array( array( 'key' => 'relation_gallery', 'value' => '"' . $current_page_id . '"', 'compare' => 'LIKE' ) ) );
             $related_post_list = new wp_query($args);
             if($related_post_list->have_posts()):
               $plan_list_headline = get_post_meta($post->ID, 'plan_list_headline', true) ?  get_post_meta($post->ID, 'plan_list_headline', true) : 'PLAN';
               $plan_list_sub_headline = get_post_meta($post->ID, 'plan_list_sub_headline', true) ?  get_post_meta($post->ID, 'plan_list_sub_headline', true) : '';
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
                 $blog_cat_id = $cat->term_id;
                 $cat_url = get_term_link($blog_cat_id,'category');
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

     // 客室一覧 -----------------------------------------
     } elseif($post_list_name == 'gallery_list'){
       if($options['show_recent_gallery']){
?>
<section id="recent_gallery_list">

 <?php if($options['recent_gallery_headline']){ ?>
 <h2 class="design_headline2 inview"><?php echo esc_html($options['recent_gallery_headline']); ?></h2>
 <?php }; ?>

 <?php
      $post_num = $options['recent_gallery_num'];
      if(is_mobile()){
        $post_num = $options['recent_gallery_num_sp'];
      }
      if($options['gallery_use_category'] == 'no'){
        $args = array( 'post_status' => 'publish', 'post_type' => 'gallery', 'posts_per_page' => $post_num, 'orderby' => array('menu_order' => 'ASC', 'date' => 'DESC') );
      } elseif ( $category && ! is_wp_error($category) ) {
        $args = array( 'post_status' => 'publish', 'post_type' => 'gallery', 'posts_per_page' => $post_num, 'orderby' => array('menu_order' => 'ASC', 'date' => 'DESC'), 'tax_query' => array( array( 'taxonomy' => 'gallery_category', 'field' => 'id', 'terms' => $cat_id)) );
      } else {
        $args = array( 'post_status' => 'publish', 'post_type' => 'gallery', 'posts_per_page' => $post_num, 'orderby' => array('menu_order' => 'ASC', 'date' => 'DESC') );
      }
      $post_list = new wp_query($args);
      if($post_list->have_posts()):
 ?>
 <div id="recent_gallery_carousel_wrap" class="inview">
  <div id="recent_gallery_carousel" class="swiper">
   <div class="post_list swiper-wrapper">
    <?php
         while( $post_list->have_posts() ) : $post_list->the_post();
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
    <a class="item animate_background swiper-slide" href="<?php the_permalink(); ?>">
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
    <?php endwhile; wp_reset_query(); ?>
   </div><!-- END .post_list -->
  </div><!-- END #recent_gallery_carousel -->
  <div class="recent_gallery_prev swiper-nav-button type2 swiper-button-prev"></div>
  <div class="recent_gallery_next swiper-nav-button type2 swiper-button-next"></div>
 </div><!-- END #recent_gallery_carousel_wrap -->

 <?php else: ?>

 <p id="no_post" style="text-align:center;"><?php _e('There is no registered post.', 'tcd-canon');  ?></p>

 <?php endif; ?>

</section>
<?php
         };
       };
     endforeach;
?>

</div>
<?php }; ?>

<?php get_footer(); ?>