<?php
     get_header();
     $options = get_design_plus_option();
     $headline = $options['menu_title'];
     $headline_color = $options['menu_title_color'];
     $sub_title = $options['menu_sub_title'];
     $image_id = $options['menu_bg_image'];
     if(!empty($image_id)) {
       $image = wp_get_attachment_image_src($image_id, 'full');
     }
     $use_overlay = $options['menu_use_overlay'];
     if($use_overlay) {
       $overlay_color = hex2rgb($options['menu_overlay_color']);
       $overlay_color = implode(",",$overlay_color);
       $overlay_opacity = $options['menu_overlay_opacity'];
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

<div id="menu_archive">

 <?php
      $catch = $options['menu_catch'];
      $desc = $options['menu_desc'];
      if($catch || $desc) {
 ?>
 <div id="catch_area">
  <?php if($catch) { ?><h2 class="catch rich_font"><?php echo nl2br(esc_html($catch)); ?></h2><?php }; ?>
  <?php if($desc) { ?><p class="desc"><?php echo nl2br(esc_html($desc)); ?></p><?php }; ?>
 </div>
 <?php }; ?>

 <?php if ( have_posts() ) : ?>
 <div id="menu_list" class="clearfix">
  <?php
       while ( have_posts() ) : the_post();
         $title = get_post_meta($post->ID, 'menu_header_title', true);
         $sub_title = get_post_meta($post->ID, 'menu_header_sub_title', true);
         $desc = get_post_meta($post->ID, 'menu_header_desc', true);
         $image = get_post_meta($post->ID, 'menu_archive_image', true);
         if($image) {
           $image = wp_get_attachment_image_src( $image, 'full' );
         } elseif($options['no_image2']) {
           $image = wp_get_attachment_image_src( $options['no_image2'], 'full' );
         } else {
           $image = array();
           $image[0] = esc_url(get_bloginfo('template_url')) . "/img/common/no_image2.gif";
         }
  ?>
  <article class="item">
   <a class="link animate_background" href="<?php the_permalink(); ?>">
    <div class="image_wrap">
     <div class="title_area rich_font">
      <?php if($title) { ?><h3 class="title"><?php echo esc_html($title); ?><?php if($sub_title) { ?><span><?php echo esc_html($sub_title); ?></span><?php }; ?></h3><?php }; ?>
     </div>
     <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
    </div>
    <div class="desc">
     <?php if($desc) { ?><p><span><?php echo esc_html($desc); ?></span></p><?php }; ?>
    </div>
   </a>
  </article>
  <?php endwhile; ?>
 </div><!-- END #menu_list -->

 <?php get_template_part('template-parts/navigation'); ?>

 <?php else: ?>

 <p id="no_post"><?php _e('There is no registered post.', 'tcd-w');  ?></p>

 <?php endif; ?>

</div><!-- END #menu_archive -->

<?php get_footer(); ?>