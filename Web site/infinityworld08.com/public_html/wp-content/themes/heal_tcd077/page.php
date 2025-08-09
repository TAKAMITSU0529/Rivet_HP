<?php
     get_header();
     $options = get_design_plus_option();
     $headline = get_the_title();
     $headline_color = get_post_meta($post->ID, 'page_font_color', true);
     if(empty($headline_color)){
       $headline_color = '#ffffff';
     }
     $sub_title = get_post_meta($post->ID, 'page_sub_title', true);
     $image_id = get_post_meta($post->ID, 'page_bg_image', true);
     if(!empty($image_id)) {
       $image = wp_get_attachment_image_src($image_id, 'full');
     }
     $use_overlay = get_post_meta($post->ID, 'page_use_overlay', true);
     if($use_overlay) {
       $overlay_color = get_post_meta($post->ID, 'page_overlay_color', true);
       if(empty($overlay_color)) {
         $overlay_color = '#000000';
       }
       $overlay_color = hex2rgb($overlay_color);
       $overlay_color = implode(",",$overlay_color);
       $overlay_opacity = get_post_meta($post->ID, 'page_overlay_opacity', true);
       if(empty($overlay_opacity)) {
         $overlay_opacity = '0.5';
       }
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
 <?php if($use_overlay) { ?><div class="overlay" style="background:rgba(<?php echo esc_html($overlay_color); ?>,<?php echo esc_html($overlay_opacity); ?>);"></div><?php }; ?>
</div>

<div id="main_contents" class="clearfix">

 <div id="main_col" class="clearfix">

  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

  <article id="article" class="page">

   <?php // post content ------------------------------------------------------------------------------------------------------------------------ ?>
   <div class="post_content clearfix">
    <?php
         the_content();
         if ( ! post_password_required() ) {
           $pagenation_type = $options['pagenation_type'];
           if ( $pagenation_type == 'type2' ) {
             if ( $page < $numpages && preg_match( '/href="(.*?)"/', _wp_link_page( $page + 1 ), $matches ) ) :
    ?>
    <div id="p_readmore">
     <a class="button" href="<?php echo esc_url( $matches[1] ); ?>"><?php _e( 'Read more', 'tcd-w' ); ?></a>
     <p class="num"><?php echo $page . ' / ' . $numpages; ?></p>
    </div>
    <?php
             endif;
           } else {
             custom_wp_link_pages();
           }
         }
    ?>
   </div>

  </article><!-- END #article -->

  <?php endwhile; endif; ?>

 </div><!-- END #main_col -->

 <?php get_sidebar(); ?>

</div><!-- END #main_contents -->

<?php get_footer(); ?>