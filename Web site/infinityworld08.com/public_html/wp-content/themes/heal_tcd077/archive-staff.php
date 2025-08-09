<?php
     get_header();
     $options = get_design_plus_option();
     $headline = $options['staff_title'];
     $headline_color = $options['staff_title_color'];
     $sub_title = $options['staff_sub_title'];
     $image_id = $options['staff_bg_image'];
     if(!empty($image_id)) {
       $image = wp_get_attachment_image_src($image_id, 'full');
     }
     $use_overlay = $options['staff_use_overlay'];
     if($use_overlay) {
       $overlay_color = hex2rgb($options['staff_overlay_color']);
       $overlay_color = implode(",",$overlay_color);
       $overlay_opacity = $options['staff_overlay_opacity'];
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

<div id="staff_archive">

 <?php
      $catch = $options['staff_catch'];
      $desc = $options['staff_desc'];
      if($catch || $desc) {
 ?>
 <div id="catch_area">
  <?php if($catch) { ?><h2 class="catch rich_font"><?php echo nl2br(esc_html($catch)); ?></h2><?php }; ?>
  <?php if($desc) { ?><p class="desc"><?php echo nl2br(esc_html($desc)); ?></p><?php }; ?>
 </div>
 <?php }; ?>

 <?php if ( have_posts() ) : ?>
 <div id="staff_list" class="clearfix">
  <?php
       while ( have_posts() ) : the_post();
         $staff_position = get_post_meta($post->ID, 'staff_position', true);
         $staff_catch = get_post_meta($post->ID, 'staff_catch', true);
         if(has_post_thumbnail()) {
           $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size1' );
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
     <div class="title_area">
      <?php if($staff_position) { ?><p class="sub_title"><?php echo esc_html($staff_position); ?></p><?php }; ?>
      <h3 class="title rich_font"><span><?php the_title(); ?></span></h3>
     </div>
     <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
    </div>
    <div class="desc">
     <?php if($staff_catch) { ?><p><span><?php echo esc_html($staff_catch); ?></span></p><?php }; ?>
    </div>
   </a>
  </article>
  <?php endwhile; ?>
 </div><!-- END #staff_list -->

 <?php else: ?>

 <p id="no_post"><?php _e('There is no registered post.', 'tcd-w');  ?></p>

 <?php endif; ?>

</div><!-- END #staff_archive -->

<?php get_footer(); ?>