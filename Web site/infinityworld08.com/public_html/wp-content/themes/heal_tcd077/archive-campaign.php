<?php
     get_header();
     $options = get_design_plus_option();
     $headline = $options['campaign_title'];
     $headline_color = $options['campaign_title_color'];
     $sub_title = $options['campaign_sub_title'];
     $image_id = $options['campaign_bg_image'];
     if(!empty($image_id)) {
       $image = wp_get_attachment_image_src($image_id, 'full');
     }
     $use_overlay = $options['campaign_use_overlay'];
     if($use_overlay) {
       $overlay_color = hex2rgb($options['campaign_overlay_color']);
       $overlay_color = implode(",",$overlay_color);
       $overlay_opacity = $options['campaign_overlay_opacity'];
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

<div id="main_contents" class="clearfix">

 <div id="main_col" class="clearfix">

 <?php if ( have_posts() ) : ?>

 <div id="campaign_list" class="clearfix">
  <?php
       while ( have_posts() ) : the_post();
         $campaign_label = get_post_meta($post->ID, 'campaign_label', true);
         $campaign_label_font_color = get_post_meta($post->ID, 'campaign_label_font_color', true);
           if(empty($campaign_label_font_color)){ $campaign_label_font_color = '#ffffff'; }
         $campaign_label_bg_color = get_post_meta($post->ID, 'campaign_label_bg_color', true);
           if(empty($campaign_label_bg_color)){ $campaign_label_bg_color = '#eb7145'; }
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
     <?php if($campaign_label){ ?><p class="label" style="background:<?php echo esc_html($campaign_label_bg_color); ?>; color:<?php echo esc_html($campaign_label_font_color); ?>;"><?php echo esc_html($campaign_label); ?></p><?php }; ?>
     <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
    </div>
    <div class="title_area">
     <h2 class="title"><span><?php the_title(); ?></span></h2>
     <?php if ($options['show_archive_campaign_date']){ ?><p class="date"><time class="entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time></p><?php }; ?>
    </div>
   </a>
  </article>
  <?php endwhile; ?>
 </div><!-- END .campaign_list -->

 <?php get_template_part('template-parts/navigation'); ?>

 <?php else: ?>

 <p id="no_post"><?php _e('There is no registered post.', 'tcd-w');  ?></p>

 <?php endif; ?>

 </div><!-- END #main_col -->

 <?php get_sidebar(); ?>

</div><!-- END #main_contents -->

<?php get_footer(); ?>