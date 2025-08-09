<?php
     get_header();
     $options = get_design_plus_option();
     $headline = $options['voice_title'];
     $headline_color = $options['voice_title_color'];
     $sub_title = $options['voice_sub_title'];
     $image_id = $options['voice_bg_image'];
     if(!empty($image_id)) {
       $image = wp_get_attachment_image_src($image_id, 'full');
     }
     $use_overlay = $options['voice_use_overlay'];
     if($use_overlay) {
       $overlay_color = hex2rgb($options['voice_overlay_color']);
       $overlay_color = implode(",",$overlay_color);
       $overlay_opacity = $options['voice_overlay_opacity'];
     }
     $page_header_font_type_raw = $options['page_header_font_type'];
     $map = [
      'type1' => 1,
      'type2' => 1,
      'type3' => 2,
      '1'     => 1,
      '2'     => 2,
      '3'     => 3,
      1       => 1,
      2       => 2,
      3       => 3,
    ];
    
    // 不明な値は 1 にフォールバック
    $page_header_font_type = $map[$page_header_font_type_raw] ?? 1;
?>
<div id="page_header" <?php if($image_id) { ?>style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"<?php }; ?>>
 <div class="headline_area rich_font_<?php echo esc_attr($page_header_font_type); ?>">
  <?php if($headline){ ?><h1 class="headline"><?php echo wp_kses_post(nl2br($headline)); ?></h1><?php }; ?>
  <?php if($sub_title){ ?><p class="sub_title"><?php echo wp_kses_post(nl2br($sub_title)); ?></p><?php }; ?>
 </div>
 <?php get_template_part('template-parts/breadcrumb'); ?>
 <?php if($use_overlay) { ?><div class="overlay" style="background:rgba(<?php echo esc_html($overlay_color); ?>,<?php echo esc_html($overlay_opacity); ?>);"></div><?php }; ?>
</div>

<div id="voice_archive">

 <?php
      $catch = $options['voice_catch'];
      $desc = $options['voice_desc'];
      if($catch || $desc) {
 ?>
 <div id="catch_area">
  <?php if($catch) { ?><h2 class="catch rich_font"><?php echo nl2br(esc_html($catch)); ?></h2><?php }; ?>
  <?php if($desc) { ?><p class="desc"><?php echo nl2br(esc_html($desc)); ?></p><?php }; ?>
 </div>
 <?php }; ?>

 <?php if ( have_posts() ) : ?>
 <div id="voice_list" class="clearfix">
  <?php
       while ( have_posts() ) : the_post();
         if(has_post_thumbnail()) {
           $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size2' );
         }
  ?>
  <article class="item clearfix<?php if(!has_post_thumbnail()) { echo ' no_image'; }; ?>">
   <?php if(has_post_thumbnail()) { ?>
   <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
   <?php }; ?>
   <div class="title_area">
    <h3 class="title rich_font"><span><?php the_title(); ?></span></h3>
    <div class="post_content clearfix">
     <?php the_content(); ?>
    </div>
   </div>
  </article>
  <?php endwhile; ?>
 </div><!-- END #voice_list -->

 <?php get_template_part('template-parts/navigation'); ?>

 <?php else: ?>

 <p id="no_post"><?php _e('There is no registered post.', 'tcd-w');  ?></p>

 <?php endif; ?>

</div><!-- END #voice_archive -->

<?php get_footer(); ?>