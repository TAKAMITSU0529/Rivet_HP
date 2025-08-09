<?php
     get_header();
     $options = get_design_plus_option();
     $headline = $options['gallery_label'];
     $catch = $options['archive_gallery_catch'];
     $image = wp_get_attachment_image_src($options['archive_gallery_header_image'], 'full');
     $overlay_color = hex2rgb($options['archive_gallery_overlay_color']);
     $overlay_color = implode(",",$overlay_color);
     $overlay_opacity = $options['archive_gallery_overlay_opacity'];
     $desc = $options['archive_gallery_desc'];
     $desc_mobile = $options['archive_gallery_desc_mobile'];
     if($image && $options['gallery_show_header']){
?>
<div id="page_header">
 <?php if($headline){ ?>
 <h1 class="headline"><span><?php echo wp_kses_post(nl2br($headline)); ?></span></h1>
 <?php }; ?>
 <div class="overlay" style="background:rgba(<?php echo esc_attr($overlay_color); ?>,<?php echo esc_attr($overlay_opacity); ?>);"></div>
 <img class="image" src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>">
</div>
<?php }; ?>

<section id="archive_gallery">

 <?php if(!$image || !$options['gallery_show_header']){ ?>
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

 <?php if($options['gallery_use_category'] == 'no'){ ?>

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
    <h2 class="title"><span><?php the_title(); ?></span></h2>
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

 <?php } else { ?>

 <?php
      $category_list = get_terms( 'gallery_category', array( 'orderby' => 'order' ) );
      if ( $category_list && ! is_wp_error( $category_list ) ) :
 ?>
 <div id="gallery_category_list">
  <?php
       foreach ( $category_list as $cat ):
         $cat_id = $cat->term_id;
         $cat_name = $cat->name;
         $cat_url = get_term_link($cat_id,'gallery_category');
         $term_meta = get_option( 'taxonomy_' . $cat_id, array() );
         $sub_title = isset($term_meta['sub_title']) ?  $term_meta['sub_title'] : '';
         $desc = isset($term_meta['desc']) ?  $term_meta['desc'] : '';
         $desc_mobile = isset($term_meta['desc_mobile']) ?  $term_meta['desc_mobile'] : '';
         $image = isset($term_meta['image']) ? wp_get_attachment_image_src( $term_meta['image'], 'full' ) : '';
  ?>
  <div class="content">
   <div class="header inview">
    <div class="headline_area">
     <h2 class="headline"><?php echo esc_html($cat_name); ?></h2>
     <?php if($sub_title){ ?>
     <p class="sub_title"><?php echo esc_html($sub_title); ?></p>
     <?php }; ?>
    </div>
    <?php if($image) { ?>
    <img class="image" loading="lazy" src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
    <?php }; ?>
   </div>
   <?php if($desc){ ?>
   <p class="desc inview"><?php if($desc_mobile){ echo '<span class="pc">'; }; echo wp_kses_post(nl2br($desc)); if($desc_mobile){ echo '</span><span class="mobile">' . wp_kses_post(nl2br($desc_mobile)) . '</span>'; }; ?></p>
   <?php }; ?>
   <div class="link_button inview">
    <a class="design_button" href="<?php echo esc_url($cat_url); ?>"><?php echo esc_html($cat_name); ?></a>
   </div>
  </div>
  <?php endforeach; ?>
 </div>
 <?php endif; ?>

 <?php }; ?>

</section><!-- END #archive_gallery -->

<?php get_footer(); ?>