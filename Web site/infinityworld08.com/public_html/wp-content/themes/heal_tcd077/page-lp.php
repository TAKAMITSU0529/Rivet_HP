<?php
/*
Template Name:LP page
*/
__('LP page', 'tcd-w');
?>
<?php
     get_header();
     $options = get_design_plus_option();
     $headline = get_post_meta($post->ID, 'lp_header_title', true);
     $headline_color = get_post_meta($post->ID, 'lp_header_font_color', true);
     if(empty($headline_color)){
       $headline_color = '#ffffff';
     }
     $sub_title = get_post_meta($post->ID, 'lp_header_sub_title', true);
     $image_id = get_post_meta($post->ID, 'lp_header_image', true);
     if(!empty($image_id)) {
       $image = wp_get_attachment_image_src($image_id, 'full');
     }
     $use_overlay = get_post_meta($post->ID, 'use_lp_header_overlay', true);
     if($use_overlay) {
       $overlay_color = get_post_meta($post->ID, 'lp_header_overlay_color', true);
       if(empty($overlay_color)) {
         $overlay_color = '#000000';
       }
       $overlay_color = hex2rgb($overlay_color);
       $overlay_color = implode(",",$overlay_color);
       $overlay_opacity = get_post_meta($post->ID, 'lp_header_overlay_opacity', true);
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
 <?php if(get_post_meta($post->ID, 'show_breadcrumb_link', true)) { get_template_part('template-parts/breadcrumb'); }; ?>
 <?php if($use_overlay) { ?><div class="overlay" style="background:rgba(<?php echo esc_html($overlay_color); ?>,<?php echo esc_html($overlay_opacity); ?>);"></div><?php }; ?>
</div>

<div id="about_page">

 <?php
      // コンテンツビルダー
      $lp_content = get_post_meta( $post->ID, 'lp_content', true );
      if ( $lp_content && is_array( $lp_content ) ) :
        foreach( $lp_content as $key => $content ) :

        // コンテンツ１ -----------------------------------------------------------------
        if ( ($content['cb_content_select'] == 'content1') && $content['show_content']) {

          $image1 = $content['image1'] ? wp_get_attachment_image_src( $content['image1'], 'full' ) : '';
          $image2 = $content['image2'] ? wp_get_attachment_image_src( $content['image2'], 'full' ) : '';
          $image3 = $content['image3'] ? wp_get_attachment_image_src( $content['image3'], 'full' ) : '';
          $image4 = $content['image4'] ? wp_get_attachment_image_src( $content['image4'], 'full' ) : '';
          $image5 = $content['image5'] ? wp_get_attachment_image_src( $content['image5'], 'full' ) : '';
          $image6 = $content['image6'] ? wp_get_attachment_image_src( $content['image6'], 'full' ) : '';
          $image7 = $content['image7'] ? wp_get_attachment_image_src( $content['image7'], 'full' ) : '';
          $image8 = $content['image8'] ? wp_get_attachment_image_src( $content['image8'], 'full' ) : '';
  ?>
  <div class="about_content about_content1 num<?php echo esc_attr($key); ?>">

   <?php if(!empty($content['headline'])) { ?>
   <h2 class="headline rich_font"><?php echo esc_html($content['headline']); ?><?php if(!empty($content['sub_headline'])) { ?><span><?php echo esc_html($content['sub_headline']); ?></span><?php }; ?></h2>
   <?php }; ?>

   <?php if($image1 || $image2){ ?>
   <div class="image_area top">
    <?php if($image1){ ?><div><img src="<?php echo esc_attr($image1[0]); ?>" alt="" title="" /></div><?php }; ?>
    <?php if($image2){ ?><div><img src="<?php echo esc_attr($image2[0]); ?>" alt="" title="" /></div><?php }; ?>
   </div>
   <?php }; ?>
   <?php if($image3 || $image4){ ?>
   <div class="image_area bottom">
    <?php if($image3){ ?><div><img src="<?php echo esc_attr($image3[0]); ?>" alt="" title="" /></div><?php }; ?>
    <?php if($image4){ ?><div><img src="<?php echo esc_attr($image4[0]); ?>" alt="" title="" /></div><?php }; ?>
   </div>
   <?php }; ?>

   <?php if($content['catch'] || $content['desc']){ ?>
   <div class="content_area">
    <?php if(!empty($content['catch'])) { ?>
    <h3 class="catch rich_font"><?php echo esc_html($content['catch']); ?></h3>
    <?php }; ?>
    <?php if(!empty($content['desc'])) { ?>
    <div class="post_content clearfix">
     <?php echo apply_filters('the_content', $content['desc'] ); ?>
    </div>
    <?php }; ?>
   </div>
   <?php }; ?>

   <?php if($image5 || $image6){ ?>
   <div class="image_area top">
    <?php if($image5){ ?><div><img src="<?php echo esc_attr($image5[0]); ?>" alt="" title="" /></div><?php }; ?>
    <?php if($image6){ ?><div><img src="<?php echo esc_attr($image6[0]); ?>" alt="" title="" /></div><?php }; ?>
   </div>
   <?php }; ?>
   <?php if($image7 || $image8){ ?>
   <div class="image_area bottom">
    <?php if($image7){ ?><div><img src="<?php echo esc_attr($image7[0]); ?>" alt="" title="" /></div><?php }; ?>
    <?php if($image8){ ?><div><img src="<?php echo esc_attr($image8[0]); ?>" alt="" title="" /></div><?php }; ?>
   </div>
   <?php }; ?>

  </div><!-- END .about_content1 -->

  <?php
       // コンテンツ２ -----------------------------------------------------------------
       } elseif ( ($content['cb_content_select'] == 'content2') && $content['show_content']) {

          $image1 = $content['image1'] ? wp_get_attachment_image_src( $content['image1'], 'full' ) : '';
          $image2 = $content['image2'] ? wp_get_attachment_image_src( $content['image2'], 'full' ) : '';
          $image3 = $content['image3'] ? wp_get_attachment_image_src( $content['image3'], 'full' ) : '';

          $use_custom_overlay = 'type2' === $content['gmap_marker_type'] ? 1 : 0;
          $marker_img = $content['gmap_marker_img'] ? wp_get_attachment_url( $content['gmap_marker_img'] ) : '';
          $marker_text = $content['gmap_marker_text'];

          $access_logo_image = $content['access_logo_image'] ? wp_get_attachment_image_src( $content['access_logo_image'], 'full' ) : '';
          $access_logo_image_mobile = $content['access_logo_image_mobile'] ? wp_get_attachment_image_src( $content['access_logo_image_mobile'], 'full' ) : '';
          $access_saturation = $content['access_saturation'] ? esc_html( $content['access_saturation'] ) : '-100';
  ?>
  <div class="about_content about_content2 num<?php echo esc_attr($key); ?>">

   <?php if(!empty($content['headline'])) { ?>
   <h2 class="headline rich_font"><?php echo esc_html($content['headline']); ?><?php if(!empty($content['sub_headline'])) { ?><span><?php echo esc_html($content['sub_headline']); ?></span><?php }; ?></h2>
   <?php }; ?>

   <?php if($content['catch'] || $content['desc']){ ?>
   <div class="content_area">
    <?php if(!empty($content['catch'])) { ?>
    <h3 class="catch rich_font"><?php echo esc_html($content['catch']); ?></h3>
    <?php }; ?>
    <?php if(!empty($content['desc'])) { ?>
    <div class="post_content clearfix">
     <?php echo apply_filters('the_content', $content['desc'] ); ?>
    </div>
    <?php }; ?>
   </div>
   <?php }; ?>

   <?php
        // access map ------------------------------------------------------------
         if ($content['access_address']){
   ?>
   <div class="access_google_map">
    <div class="pb_googlemap clearfix">
     <div id="dc_google_map<?php echo esc_attr($key); ?>" class="pb_googlemap_embed"></div>
    </div><!-- END .pb_googlemap -->
    <script>
    jQuery(function($) {
      $(window).on('load',function () {
        initMap('dc_google_map<?php echo esc_attr($key); ?>', '<?php echo esc_js( $content['access_address'] ); ?>', <?php echo esc_js( $access_saturation ); ?>, <?php echo esc_js( $use_custom_overlay ); ?>, '<?php echo esc_js( $marker_img ); ?>', '<?php echo esc_js( $marker_text ); ?>');
      });
    });
    </script>
    </div><!-- END .access_google_map -->

    <div class="access_data">
     <?php
          if(!empty($access_logo_image)) {
            $access_logo_image_width = $access_logo_image[1];
            $access_logo_image_height = $access_logo_image[2];
            if($content['access_logo_retina']) {
              $access_logo_image_width = round($access_logo_image_width / 2);
              $access_logo_image_height = round($access_logo_image_height / 2);
            };
     ?>
     <img class="logo <?php if(!empty($access_logo_image_mobile)) { echo 'pc'; }; ?>" src="<?php echo esc_attr($access_logo_image[0]); ?>" alt="" title="" width="<?php echo esc_attr($access_logo_image_width); ?>" height="<?php echo esc_attr($access_logo_image_height); ?>" />
     <?php }; ?>
     <?php
          if(!empty($access_logo_image_mobile)) {
            $access_logo_image_width_mobile = $access_logo_image_mobile[1];
            $access_logo_image_height_mobile = $access_logo_image_mobile[2];
            if($content['access_logo_retina_mobile']) {
              $access_logo_image_width_mobile = round($access_logo_image_width_mobile / 2);
              $access_logo_image_height_mobile = round($access_logo_image_height_mobile / 2);
            };
     ?>
     <img class="logo mobile" src="<?php echo esc_attr($access_logo_image_mobile[0]); ?>" alt="" title="" width="<?php echo esc_attr($access_logo_image_width_mobile); ?>" height="<?php echo esc_attr($access_logo_image_height_mobile); ?>" />
     <?php }; ?>

     <?php if($content['access_desc1']){ ?>
     <p class="desc"><?php echo wp_kses_post(nl2br($content['access_desc1'])); ?></p>
     <?php }; ?>
     <?php if($content['show_access_button'] && $content['access_button_url']) { ?>
     <div class="link_button button_font">
      <a href="<?php echo esc_url($content['access_button_url']); ?>" target="_blank"><span><?php echo esc_html($content['access_button_label']); ?></span></a>
     </div>
     <?php }; ?>
     <?php if($image1 || $image2 || $image3){ ?>
     <div class="image_area clearfix">
      <?php if($image1){ ?><div><img src="<?php echo esc_attr($image1[0]); ?>" alt="" title="" /></div><?php }; ?>
      <?php if($image2){ ?><div><img src="<?php echo esc_attr($image2[0]); ?>" alt="" title="" /></div><?php }; ?>
      <?php if($image3){ ?><div><img src="<?php echo esc_attr($image3[0]); ?>" alt="" title="" /></div><?php }; ?>
     </div>
     <?php }; ?>
     <?php if($content['access_date_headline'] || $content['access_date']){ ?>
     <div class="access_date_info">
      <?php if($content['access_date_headline']){ ?><h3 class="sub_headline"><?php echo esc_html($content['access_date_headline']); ?></h3><?php }; ?>
      <?php if($content['access_date']){ ?><p class="date"><?php echo wp_kses_post(nl2br($content['access_date'])); ?></p><?php }; ?>
     </div>
     <?php }; ?>
     <?php if($content['access_tel_headline'] || $content['access_tel']){ ?>
     <div class="access_tel_info">
      <?php if($content['access_tel_headline']){ ?><h3 class="sub_headline"><?php echo esc_html($content['access_tel_headline']); ?></h3><?php }; ?>
      <?php if($content['access_tel']){ ?><p class="tel rich_font"><span>TEL.</span><a href="tel:<?php echo esc_html($content['access_tel']); ?>"><?php echo esc_html($content['access_tel']); ?></a></p><?php }; ?>
     </div>
     <?php }; ?>
    </div><!-- END #access_data -->

   <?php }; ?>

  </div><!-- END .about_content2 -->

  <?php
       // コンテンツ３ -----------------------------------------------------------------
       } elseif ( ($content['cb_content_select'] == 'content3') && $content['show_content']) {
  ?>
  <div class="about_content about_content3 num<?php echo esc_attr($key); ?>">

   <?php if($content['catch'] || $content['desc']){ ?>
   <div class="content_area">
    <?php if(!empty($content['catch'])) { ?>
    <h3 class="catch rich_font"><?php echo esc_html($content['catch']); ?></h3>
    <?php }; ?>
    <?php if(!empty($content['desc'])) { ?>
    <div class="post_content clearfix">
     <?php echo apply_filters('the_content', $content['desc'] ); ?>
    </div>
    <?php }; ?>
   </div>
   <?php }; ?>

  </div><!-- END .about_content3 -->

  <?php
           };
         endforeach; // END 並び替え
       endif;
  ?>

</div><!-- #about_page -->

<?php get_footer(); ?>