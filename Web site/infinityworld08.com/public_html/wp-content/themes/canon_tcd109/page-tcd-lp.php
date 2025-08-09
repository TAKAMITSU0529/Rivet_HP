<?php
/*
Template Name:Landing page
*/
__('Landing page', 'tcd-canon');

     get_header();
     $options = get_design_plus_option();
     $hide_page_header = get_post_meta($post->ID, 'hide_page_header_image', true) ?  get_post_meta($post->ID, 'hide_page_header_image', true) : 'no';
     $page_content_width = get_post_meta($post->ID, 'page_content_width', true) ?  get_post_meta($post->ID, 'page_content_width', true) : '1000';
     $header_style = get_post_meta($post->ID, 'header_style', true) ?  get_post_meta($post->ID, 'header_style', true) : 'type2';
     $catch_layout = get_post_meta($post->ID, 'header_catch_layout', true) ?  get_post_meta($post->ID, 'header_catch_layout', true) : 'type3';

     if($hide_page_header != 'yes'){

     $catch = get_post_meta($post->ID, 'header_catch', true) ?  get_post_meta($post->ID, 'header_catch', true) : get_the_title();
     $catch_mobile = get_post_meta($post->ID, 'header_catch_mobile', true);
     $catch_font_type = get_post_meta($post->ID, 'header_catch_font_type', true) ?  get_post_meta($post->ID, 'header_catch_font_type', true) : 'type3';

     $sub_catch = get_post_meta($post->ID, 'header_sub_catch', true);
     $sub_catch_mobile = get_post_meta($post->ID, 'header_sub_catch_mobile', true);
     $sub_catch_font_type = get_post_meta($post->ID, 'header_sub_catch_font_type', true) ?  get_post_meta($post->ID, 'header_sub_catch_font_type', true) : 'type2';

     $button_label = get_post_meta($post->ID, 'header_button_label', true);
     $button_url = get_post_meta($post->ID, 'header_button_url', true);
     $button_target = get_post_meta($post->ID, 'header_button_target', true);

     $image = wp_get_attachment_image_src(get_post_meta($post->ID, 'header_image', true), 'full');
     $image_mobile = wp_get_attachment_image_src(get_post_meta($post->ID, 'header_image_mobile', true), 'full');
     $overlay_color = get_post_meta($post->ID, 'header_overlay_color', true) ?  get_post_meta($post->ID, 'header_overlay_color', true) : '#000000';
     $overlay_color = hex2rgb($overlay_color);
     $overlay_color = implode(",",$overlay_color);
     $overlay_opacity = get_post_meta($post->ID, 'header_overlay_color_opacity', true) ?  get_post_meta($post->ID, 'header_overlay_color_opacity', true) : '0.3';
     if($overlay_opacity == 'zero'){
       $overlay_opacity = '0';
     }
?>
<?php if($header_style == 'type1'){ echo "<div id='lp_style1_content'>"; }; ?>
<div id="page_header" class="layout_<?php echo esc_attr($header_style); ?>">

 <div class="content layout_<?php echo esc_attr($catch_layout); ?>">
  <?php if($catch_layout == 'type2' || $catch_layout == 'type4' || $catch_layout == 'type6'){ ?>
  <?php if($sub_catch){ ?>
  <p class="sub_catch rich_font_<?php echo esc_attr($sub_catch_font_type); ?>"><?php if($sub_catch_mobile){ echo '<span class="pc">'; }; ?><?php echo wp_kses_post(nl2br($sub_catch)); ?><?php if($sub_catch_mobile){ echo '</span><span class="mobile">' . esc_attr($sub_catch_mobile) . '</span>'; }; ?></p>
  <?php }; ?>
  <?php }; ?>
  <?php if($catch){ ?>
  <h1 class="catch rich_font_<?php echo esc_attr($catch_font_type); ?>"><?php if($catch_mobile){ echo '<span class="pc">'; }; ?><?php echo wp_kses_post(nl2br($catch)); ?><?php if($catch_mobile){ echo '</span><span class="mobile">' . esc_attr($catch_mobile) . '</span>'; }; ?></h1>
  <?php }; ?>
  <?php if($catch_layout == 'type1' || $catch_layout == 'type3' || $catch_layout == 'type5'){ ?>
  <?php if($sub_catch){ ?>
  <p class="sub_catch rich_font_<?php echo esc_attr($sub_catch_font_type); ?>"><?php if($sub_catch_mobile){ echo '<span class="pc">'; }; ?><?php echo wp_kses_post(nl2br($sub_catch)); ?><?php if($sub_catch_mobile){ echo '</span><span class="mobile">' . esc_attr($sub_catch_mobile) . '</span>'; }; ?></p>
  <?php }; ?>
  <?php }; ?>
  <?php if($button_label && $button_url){ ?>
  <div class="link_button">
   <a class="design_button" href="<?php echo esc_url($button_url); ?>"<?php if($button_target){ echo ' target="_blank"'; }; ?>><?php echo esc_html($button_label); ?></a>
  </div>
  <?php }; ?>
 </div>

 <?php if($image) { ?>
 <div class="overlay" style="background:rgba(<?php echo esc_attr($overlay_color); ?>,<?php echo esc_attr($overlay_opacity); ?>);"></div>
 <img class="image<?php if($image_mobile){ echo ' pc'; }; ?>" src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>">
 <?php if($image_mobile){ ?>
 <img class="image mobile" src="<?php echo esc_attr($image_mobile[0]); ?>" alt="" width="<?php echo esc_attr($image_mobile[1]); ?>" height="<?php echo esc_attr($image_mobile[2]); ?>">
 <?php }; ?>
 <?php }; ?>
</div>
<?php }; ?>

<article id="page_contents">

 <div class="post_content clearfix inview">
  <?php
       the_content();
       if ( ! post_password_required() ) {
         custom_wp_link_pages();
       }
  ?>
 </div>

</article><!-- END #page_contents -->

<?php if($header_style == 'type1'){ echo "</div><!-- #lp_style1_content -->"; }; ?>

<?php get_footer(); ?>