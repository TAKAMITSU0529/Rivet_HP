<?php
     get_header();
     $options = get_design_plus_option();
     $bg_image = wp_get_attachment_image_src($options['page_404_bg_image'], 'full');
     $overlay_color = hex2rgb($options['page_404_overlay_color']);
     $overlay_opacity = $options['page_404_overlay_opacity'];
     $overlay_color = implode(",",$overlay_color);
     $headline = $options['page_404_headline'] ?  $options['page_404_headline'] : '404 NOT FOUND';

?>

<div id="no_search_result"<?php if($bg_image){ echo ' class="has_image"'; }; ?>>

 <div class="content">

  <h2 class="headline"><?php echo nl2br(esc_html($options['page_404_headline'])); ?></h2>

  <?php if ($options['page_404_desc']) { ?>
  <div class="desc post_content"><?php echo apply_filters('the_content', $options['page_404_desc'] ); ?></div>
  <?php } ?>

  <?php if ($options['page_404_display_search_form']) { ?>
  <div class="search_form">
   <form role="search" method="get" action="<?php echo esc_url(home_url()); ?>">
    <div class="input_area"><input <?php if($options['page_404_search_placeholder']){ echo 'placeholder="' . esc_html($options['page_404_search_placeholder']) . '"'; }; ?> type="text" value="" name="s" autocomplete="off"></div>
    <div class="search_button"><label for="no_search_result_button"></label><input type="submit" id="no_search_result_button" value=""></div>
   </form>
  </div>
  <?php } ?>

  <?php if ($options['page_404_display_post_tag']) { ?>
  <div class="tag_list">
   <?php wp_tag_cloud( array( 'smallest' => 14, 'largest' => 14, 'unit' => 'px', 'format' => 'list', 'include' => $options['page_404_post_tag_list'], 'number' => 0 ) ); ?>
  </div>
  <?php }; ?>

 </div>

 <?php if($options['page_404_overlay_opacity'] != 0 && !empty($bg_image)){ ?>
 <div class="overlay" style="background-color:rgba(<?php echo esc_attr($overlay_color); ?>,<?php echo esc_attr($overlay_opacity); ?>);"></div>
 <?php }; ?>

 <?php if(!empty($bg_image)) { ?>
 <div class="bg_image" style="background:url(<?php echo esc_attr($bg_image[0]); ?>) no-repeat center top; background-size:cover;"></div>
 <?php }; ?>

 <?php
      // コピーライト -------------------------------
      if($options['copyright']){
 ?>
 <p class="copyright"><span><?php echo wp_kses_post($options['copyright']); ?></span></p>
 <?php }; ?>

</div>

<?php get_footer(); ?>