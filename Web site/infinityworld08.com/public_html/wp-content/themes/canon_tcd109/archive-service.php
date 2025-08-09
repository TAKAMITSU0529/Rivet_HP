<?php
     get_header();
     $options = get_design_plus_option();
     $headline = $options['service_label'];
     $catch = $options['archive_service_catch'];
     $image = wp_get_attachment_image_src($options['archive_service_header_image'], 'full');
     $overlay_color = hex2rgb($options['archive_service_overlay_color']);
     $overlay_color = implode(",",$overlay_color);
     $overlay_opacity = $options['archive_service_overlay_opacity'];
     $desc = $options['archive_service_desc'];
     $desc_mobile = $options['archive_service_desc_mobile'];
     if($image && $options['service_show_header']){
?>
<div id="page_header">
 <?php if($headline){ ?>
 <h1 class="headline"><span><?php echo wp_kses_post(nl2br($headline)); ?></span></h1>
 <?php }; ?>
 <div class="overlay" style="background:rgba(<?php echo esc_attr($overlay_color); ?>,<?php echo esc_attr($overlay_opacity); ?>);"></div>
 <img class="image" src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>">
</div>
<?php }; ?>

<section id="archive_service">

 <?php if(!$image || !$options['service_show_header']){ ?>
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

 <?php if ( have_posts() ) : ?>

 <div class="service_list inview">
  <?php
       while ( have_posts() ) : the_post();
         if(has_post_thumbnail()) {
           $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
         } elseif($options['no_image']) {
           $image = wp_get_attachment_image_src( $options['no_image'], 'full' );
         } else {
           $image = array();
           $image[0] = get_bloginfo('template_url') . "/img/no_image2.gif";
           $image[1] = '475';
           $image[2] = '235';
         }
         $service_sub_title = get_post_meta($post->ID, 'service_sub_title', true);
  ?>
  <a class="item animate_background" href="<?php the_permalink(); ?>">
   <div class="image_wrap">
    <img loading="lazy" class="image" src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
   </div>
   <div class="content">
    <?php if($service_sub_title){ ?>
    <p class="sub_title"><?php echo wp_kses_post(nl2br($service_sub_title)); ?></p>
    <?php }; ?>
    <h2 class="title"><?php the_title(); ?></h2>
   </div>
  </a>
  <?php endwhile; ?>
 </div><!-- END .service_list -->

 <?php get_template_part('template-parts/navigation'); ?>

 <?php else: ?>

 <p id="no_post"><?php _e('There is no registered post.', 'tcd-canon');  ?></p>

 <?php endif; ?>

</section><!-- END #archive_service -->

<?php get_footer(); ?>