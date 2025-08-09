<?php
     get_header();
     $options = get_design_plus_option();
     $headline = $options['news_label'];
     $catch = $options['archive_news_catch'];
     $image = wp_get_attachment_image_src($options['archive_news_header_image'], 'full');
     $overlay_color = hex2rgb($options['archive_news_overlay_color']);
     $overlay_color = implode(",",$overlay_color);
     $overlay_opacity = $options['archive_news_overlay_opacity'];
     $desc = $options['archive_news_desc'];
     $desc_mobile = $options['archive_news_desc_mobile'];
     if($image && $options['news_show_header']){
?>
<div id="page_header">
 <?php if($headline){ ?>
 <h1 class="headline"><span><?php echo wp_kses_post(nl2br($headline)); ?></span></h1>
 <?php }; ?>
 <div class="overlay" style="background:rgba(<?php echo esc_attr($overlay_color); ?>,<?php echo esc_attr($overlay_opacity); ?>);"></div>
 <img class="image" src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>">
</div>
<?php }; ?>

<section id="archive_news">

 <?php if(!$image || !$options['news_show_header']){ ?>
 <h1 id="page_headline"><?php echo wp_kses_post(nl2br($headline)); ?></h1>
 <?php }; ?>

 <?php if(!is_paged() && ($catch || $desc || $desc_mobile)){ ?>
 <div id="page_header_desc">
  <?php if(!is_paged() && $catch){ ?>
  <h2 class="catch inview"><?php echo wp_kses_post(nl2br($catch)); ?></h2>
  <?php }; ?>
  <?php if(!is_paged() && $desc){ ?>
  <div class="desc<?php if($desc_mobile){ echo ' pc'; }; ?> post_content inview"><p><?php echo wp_kses_post(nl2br($desc)); ?></p></div>
  <?php }; ?>
  <?php if(!is_paged() && $desc_mobile){ ?>
  <div class="desc mobile post_content inview"><p><?php echo wp_kses_post(nl2br($desc_mobile)); ?></p></div>
  <?php }; ?>
 </div>
 <?php }; ?>

 <?php
      // カテゴリーソートタブ ----------------------------------------------------------------
      if($options['archive_news_show_category_list'] == 'display'){
        $category = get_terms( 'news_category', array('parent' => 0,'hide_empty' => true) );
        if ($category) {
          $total_category = count($category);
 ?>
 <div class="category_sort_button_wrap inview<?php if($total_category < 6){ echo ' small_size'; }; ?>">
  <div class="category_sort_button_slider swiper">
   <div class="category_sort_button swiper-wrapper">
    <?php
         $i = 1;
         foreach ( $category as $cat ) :
           $cat_id = $cat->term_id;
           $cat_url = get_term_link($cat_id,'news_category');
    ?>
    <div class="item swiper-slide<?php if(is_category()){ if($cat_id == $current_cat_id){ echo ' active_menu'; }; }; ?>">
     <a href="<?php echo esc_url($cat_url); ?>/#bread_crumb"><?php echo esc_html($cat->name); ?></a>
    </div>
    <?php $i++; endforeach; ?>
   </div>
  </div>
  <div class="category_sort_button_prev swiper-nav-button type2 swiper-button-prev"></div>
  <div class="category_sort_button_next swiper-nav-button type2 swiper-button-next"></div>
 </div>
 <?php
        };
      };
 ?>

 <?php if ( have_posts() ) : ?>

 <div class="news_list inview">
  <?php
       while ( have_posts() ) : the_post();
         if($options['news_show_image'] == 'display'){
           if(has_post_thumbnail()) {
             $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size1' );
           } elseif($options['no_image']) {
             $image = wp_get_attachment_image_src( $options['no_image'], 'full' );
           } else {
             $image = array();
             $image[0] = get_bloginfo('template_url') . "/img/no_image1.gif";
             $image[1] = '180';
             $image[2] = '180';
           }
         };
  ?>
  <div class="item">
   <?php if($options['news_show_image'] == 'display'){ ?>
   <a class="animate_background" href="<?php the_permalink(); ?>">
    <div class="image_wrap">
     <img loading="lazy" class="image" src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
    </div>
   </a>
   <?php }; ?>
   <div class="content">
    <div class="date_list">
     <time class="date entry-date published" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
     <?php
          $post_date = get_the_time('Ymd');
          $modified_date = get_the_modified_date('Ymd');
          if($post_date < $modified_date && $options['news_show_update'] == 'display'){
     ?>
     <time class="update entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_modified_date('Y.m.d'); ?></time>
     <?php }; ?>
    </div>
    <h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php
         $category = wp_get_post_terms($post->ID, 'news_category');
         if ( $category && ! is_wp_error($category) ) {
    ?>
    <div class="category">
     <?php
          foreach ( $category as $cat ) :
            $cat_name = $cat->name;
            $cat_id = $cat->term_id;
            $cat_url = get_term_link($cat_id,'news_category');
     ?>
     <a href="<?php echo esc_url($cat_url); ?>"><?php echo esc_html($cat_name); ?></a>
     <?php endforeach; ?>
    </div>
    <?php }; ?>
   </div>
  </div>
  <?php endwhile; ?>
 </div><!-- END .news_list -->

 <?php get_template_part('template-parts/navigation'); ?>

 <?php else: ?>

 <p id="no_post"><?php _e('There is no registered post.', 'tcd-canon');  ?></p>

 <?php endif; ?>

</section><!-- END #archive_news -->

<?php get_footer(); ?>