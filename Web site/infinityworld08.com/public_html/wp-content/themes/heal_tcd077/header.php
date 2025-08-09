<?php $options = get_design_plus_option(); ?>
<!DOCTYPE html>
<html class="pc" <?php language_attributes(); ?>>
<?php if($options['use_ogp']) { ?>
<head prefix="og: https://ogp.me/ns# fb: https://ogp.me/ns/fb#">
<?php } else { ?>
<head>
<?php }; ?>
<meta charset="<?php bloginfo('charset'); ?>">
<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
<meta name="viewport" content="width=device-width">
<title><?php wp_title('|', true, 'right'); ?></title>
<meta name="description" content="<?php seo_description(); ?>">
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
<?php
     if ( $options['favicon'] ) {
       $favicon_image = wp_get_attachment_image_src( $options['favicon'], 'full');
       if(!empty($favicon_image)) {
?>
<link rel="shortcut icon" href="<?php echo esc_url($favicon_image[0]); ?>">
<?php }; }; ?>
<?php wp_enqueue_style('style', get_stylesheet_uri(), false, version_num(), 'all'); wp_enqueue_script( 'jquery' ); if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>
</head>
<body id="body" <?php body_class(); ?>>

<?php
     if ($options['show_load_screen'] == 'type2') {
       if(is_front_page()){
         load_icon();
       }
     } elseif ($options['show_load_screen'] == 'type3') {
       if(is_front_page() || is_home() || is_archive() ){
         load_icon();
       }
     } elseif ($options['show_load_screen'] == 'type4' && !isset($_COOKIE['first_visit'])) {
       if(is_front_page() || is_home() || is_archive() ){
         load_icon();
       }
     };
     $header_desc_font_type_raw = $options['header_desc_font_type'];
     $header_desc_font_type_mobile_raw = $options['header_desc_font_type_mobile'];
     $global_menu_font_type_raw = $options['global_menu_font_type'];
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
    $header_desc_font_type = $map[$header_desc_font_type_raw] ?? 1;
    $header_desc_font_type_mobile = $map[$header_desc_font_type_mobile_raw] ?? 1;
    $global_menu_font_type = $map[$global_menu_font_type_raw] ?? 1;
?>

<div id="container">

 <header id="header">

  <?php if ($options['header_show_desc'] == 'type2' && is_front_page()) { ?>
  <div id="site_desc" class="rich_font_<?php echo esc_attr($header_desc_font_type); ?>"><span<?php if ($options['header_desc_mobile']) { echo ' class="pc"'; }; ?>><?php echo esc_html(get_bloginfo('description')); ?></span><?php if ($options['header_desc_mobile']) { echo '<span class="mobile rich_font_' . esc_attr($header_desc_font_type_mobile) . '">' . nl2br(esc_html($options['header_desc_mobile'])) . "</span>"; }; ?></div>
  <?php } elseif ($options['header_show_desc'] == 'type3') { ?>
  <div id="site_desc" class="rich_font_<?php echo esc_attr($header_desc_font_type); ?>"><span <?php if ($options['header_desc_mobile']) { echo ' class="pc"'; }; ?>><?php echo esc_html(get_bloginfo('description')); ?></span><?php if ($options['header_desc_mobile']) { echo '<span class="mobile rich_font_' . esc_attr($header_desc_font_type_mobile) . '">' . nl2br(esc_html($options['header_desc_mobile'])) . "</span>"; }; ?></div>
  <?php }; ?>

  <div id="header_top">
   <div id="header_logo">
    <?php header_logo(); ?>
   </div>
   <?php
        $facebook = $options['header_facebook_url'];
        $twitter = $options['header_twitter_url'];
        $insta = $options['header_instagram_url'];
        $tiktok = $options['header_tiktok_url'];
        $pinterest = $options['header_pinterest_url'];
        $youtube = $options['header_youtube_url'];
        $contact = $options['header_contact_url'];
        $show_rss = $options['header_show_rss'];
   ?>
   <?php if($facebook || $twitter || $insta || $pinterest || $youtube || $contact || $show_rss || $tiktok) { ?>
   <ul id="header_social_link" class="clearfix">
    <?php if($insta) { ?><li class="insta"><a href="<?php echo esc_url($insta); ?>" rel="nofollow" target="_blank" title="Instagram"><span>Instagram</span></a></li><?php }; ?>
    <?php if($tiktok) { ?><li class="tiktok"><a href="<?php echo esc_url($tiktok); ?>" rel="nofollow" target="_blank" title="TikTok"><span>TikTok</span></a></li><?php }; ?>
    <?php if($twitter) { ?><li class="twitter"><a href="<?php echo esc_url($twitter); ?>" rel="nofollow" target="_blank" title="X"><span>X</span></a></li><?php }; ?>
    <?php if($facebook) { ?><li class="facebook"><a href="<?php echo esc_url($facebook); ?>" rel="nofollow" target="_blank" title="Facebook"><span>Facebook</span></a></li><?php }; ?>
    <?php if($pinterest) { ?><li class="pinterest"><a href="<?php echo esc_url($pinterest); ?>" rel="nofollow" target="_blank" title="Pinterest"><span>Pinterest</span></a></li><?php }; ?>
    <?php if($youtube) { ?><li class="youtube"><a href="<?php echo esc_url($youtube); ?>" rel="nofollow" target="_blank" title="Youtube"><span>Youtube</span></a></li><?php }; ?>
    <?php if($contact) { ?><li class="contact"><a href="<?php echo esc_url($contact); ?>" rel="nofollow" target="_blank" title="Contact"><span>Contact</span></a></li><?php }; ?>
    <?php if($show_rss) { ?><li class="rss"><a href="<?php bloginfo('rss2_url'); ?>" rel="nofollow noopener" target="_blank" title="RSS"><span>RSS</span></a></li><?php }; ?>
   </ul>
   <?php }; ?>
  </div>

  <?php if (has_nav_menu('global-menu')) { ?>
  <a href="#" id="menu_button"><span><?php _e('menu', 'tcd-w'); ?></span></a>
  <nav id="global_menu" class="rich_font_<?php echo esc_attr($global_menu_font_type); ?>">
   <?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'theme_location' => 'global-menu' , 'container' => '' ) ); ?>
  </nav>
  <?php }; ?>

  <?php get_template_part( 'template-parts/megamenu' ); ?>

 </header>

 <?php if(is_front_page()) { ?>
  <div id="index_header_content">
  <?php
       // 画像スライダー ***********************************************************************************************************************
       if($options['index_header_content_type'] == 'type1') {
         $index_slider_mobile_content_type = $options['index_slider_mobile_content_type'];
  ?>
  <div id="index_slider_wrap"<?php if($index_slider_mobile_content_type != 'type1') { echo ' class="use_mobile_caption"'; }; ?>>
   <div id="index_slider">
    <?php
         // mobile caption
         if($index_slider_mobile_content_type != 'type1') {
           $num = 1;
           $catch = $options['index_slider_mobile_catch'];
           $desc = $options['index_slider_mobile_desc'];
           $font_type_raw = $options['index_slider_mobile_catch_font_type'];
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
          $font_type = $map[$font_type_raw] ?? 1;

           $show_button = $options['index_slider_mobile_show_button'];
           $url = $options['index_slider_mobile_url'];
           $target = $options['index_slider_mobile_target'];
           $button_label = $options['index_slider_mobile_button_label'];
    ?>
    <div class="caption mobile">
     <div class="caption_inner">
      <?php if($catch) { ?>
      <h2 class="catch rich_font_<?php echo esc_attr($font_type); ?> animate<?php echo $num; $num++; ?>"><span><?php echo nl2br(esc_html($catch)); ?></span></h2>
      <?php }; ?>
      <?php if($desc) { ?>
      <p class="desc animate<?php echo $num; $num++; ?>"><span><?php echo nl2br(esc_html($desc)); ?></span></p>
      <?php }; ?>
      <?php if( $show_button ) { ?>
      <a class="button button_font animate<?php echo $num; $num++; ?>" href="<?php echo esc_url($url); ?>"<?php if($target == 1) { echo ' target="_blank"'; }; ?>><span><?php echo esc_html($button_label); ?></span></a>
      <?php }; ?>
     </div>
    </div>
    <?php }; ?>
    <?php
         // item loop start
         for($i=1; $i<= 3; $i++):
           $image_id = $options['index_slider_image'.$i];
           if(!empty($image_id)) {
             // image
             $image = wp_get_attachment_image_src($image_id, 'full');
             $image_url = $image[0];
    ?>
    <div class="item item<?php echo $i; if($i == 1){ echo ' first_item'; }; ?> animation_<?php echo esc_attr($options['index_slider_animation_type'.$i]); ?>">
     <?php
          // caption
          $num = 1;
          $catch = $options['index_slider_catch'.$i];
          $desc = $options['index_slider_desc'.$i];
          $font_type_raw = $options['index_slider_catch_font_type'.$i];
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
          $font_type = $map[$font_type_raw] ?? 1;
          $show_button = $options['index_slider_show_button'.$i];
          $url = $options['index_slider_url'.$i];
          $target = $options['index_slider_target'.$i];
          $button_label = $options['index_slider_button_label'.$i];
          if($catch || $desc || $show_button){
     ?>
     <div class="caption direction_<?php echo esc_attr($options['index_slider_content_direction'.$i]); ?> <?php if($index_slider_mobile_content_type != 'type1') { echo 'pc'; }; ?>">
      <div class="caption_inner">
       <?php if($catch) { ?>
       <h2 class="catch rich_font_<?php echo esc_attr($font_type); ?> animate<?php echo $num; $num++; ?>"><span><?php echo nl2br(esc_html($catch)); ?></span></h2>
       <?php }; ?>
       <?php if($desc) { ?>
       <p class="desc animate<?php echo $num; $num++; ?>"><span><?php echo nl2br(esc_html($desc)); ?></span></p>
       <?php }; ?>
       <?php if( $show_button ) { ?>
       <a class="button button_font animate<?php echo $num; $num++; ?>" href="<?php echo esc_url($url); ?>"<?php if($target == 1) { echo ' target="_blank"'; }; ?>><span><?php echo esc_html($button_label); ?></span></a>
       <?php }; ?>
      </div>
     </div><!-- END .caption -->
     <?php
          };
          // overlay
          if($options['index_slider_use_overlay'.$i] || $options['index_slider_use_overlay_mobile'.$i]) {
     ?>
     <div class="overlay"></div>
     <?php
          };
          // image
          $image_mobile_id = $options['index_slider_image_mobile'.$i];
     ?>
     <div class="image <?php if(!empty($image_mobile_id)) { echo 'pc'; }; ?>" style="background:url(<?php echo esc_attr($image_url); ?>) no-repeat center center; background-size:cover;"></div>
     <?php
          // image mobile
          if(!empty($image_mobile_id)) {
             $image_mobile = wp_get_attachment_image_src($image_mobile_id, 'full');
             $image_url_mobile = $image_mobile[0];
     ?>
     <div class="image <?php if(!empty($image_mobile_id)) { echo 'mobile'; }; ?>" style="background:url(<?php echo esc_attr($image_url_mobile); ?>) no-repeat center center; background-size:cover;"></div>
     <?php }; ?>
    </div><!-- END .item -->
    <?php
           };// END if image
         endfor; // END item loop
    ?>
   </div><!-- END #index_slider -->
  </div><!-- END #index_slider_wrap -->
  <?php
       // 動画, YouTube ***********************************************************************************************************************
       } elseif($options['index_header_content_type'] == 'type2' || $options['index_header_content_type'] == 'type3') {
  ?>
  <div id="index_slider_wrap">
   <div id="index_slider" class="video">

    <?php
         // pc catchphrase
         $num = 1;
         $catch = $options['index_movie_catch'];
         $desc = $options['index_movie_desc'];
         $font_type_raw = $options['index_movie_catch_font_type'];
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
        $font_type = $map[$font_type_raw] ?? 1;
         $show_button = $options['index_movie_show_button'];
         $url = $options['index_movie_url'];
         $target = $options['index_movie_target'];
         $button_label = $options['index_movie_button_label'];
         if($catch || $desc || $show_button){
    ?>
    <div class="caption <?php if($options['index_movie_mobile_content_type'] == 'type2') { echo 'pc'; }; ?>">
     <div class="caption_inner">
      <?php if($catch) { ?>
      <h2 class="catch rich_font_<?php echo esc_attr($font_type); ?> animate<?php echo $num; $num++; ?>"><span><?php echo nl2br(esc_html($catch)); ?></span></h2>
      <?php }; ?>
      <?php if($desc) { ?>
      <p class="desc animate<?php echo $num; $num++; ?>"><span><?php echo nl2br(esc_html($desc)); ?></span></p>
      <?php }; ?>
      <?php if($show_button) { ?>
      <a class="button button_font animate<?php echo $num; $num++; ?>" href="<?php echo esc_url($url); ?>"<?php if($target == 1) { echo ' target="_blank"'; }; ?>><span><?php echo esc_html($button_label); ?></span></a>
      <?php }; ?>
     </div>
    </div><!-- END .caption -->
    <?php }; ?>

    <?php
         // mobile catchphrase
         if($options['index_movie_mobile_content_type'] == 'type2') {
           $catch = $options['index_movie_catch_mobile'];
           $font_type_raw = $options['index_movie_catch_font_type_mobile'];
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
          $font_type = $map[$font_type_raw] ?? 1;
           if($catch){
    ?>
    <div class="caption mobile">
     <div class="caption_inner">
      <?php if($catch) { ?>
      <h2 class="catch rich_font_<?php echo esc_attr($font_type); ?> animate1"><span><?php echo nl2br(esc_html($catch)); ?></span></h2>
      <?php }; ?>
     </div>
    </div><!-- END .caption -->
    <?php }; }; ?>

    <?php
         // overlay
         if($options['index_movie_use_overlay']) {
    ?>
    <div class="overlay"></div>
    <?php }; ?>

    <?php
         // 動画 ---------------------------------------------------------
         if($options['index_header_content_type'] == 'type2') {
           $video = $options['index_video'];
           if(!empty($video)) {
             $video_image_id = $options['index_movie_image'];
             if($video_image_id) {
               $video_image = wp_get_attachment_image_src($video_image_id, 'full');
             }
    ?>
    <div id="index_video">
     <?php if (auto_play_movie()) { ?>
     <video src="<?php echo esc_url(wp_get_attachment_url($options['index_video'])); ?>" id="index_video_mp4" playsinline autoplay loop muted></video>
     <?php
          } else {
            if($video_image_id) {
     ?>
     <div id="video_poster" style="background:url(<?php echo esc_attr($video_image[0]); ?>) no-repeat center center; background-size:cover;"></div>
     <?php }; }; ?>
    </div>
    <?php
           };
           // YouTube ---------------------------------------------------------
         } elseif($options['index_header_content_type'] == 'type3') {
           $youtube_url = $options['index_youtube_url'];
           if(!empty($youtube_url)) {
             $video_image_id = $options['index_movie_image'];
             if($video_image_id) {
               $video_image = wp_get_attachment_image_src($video_image_id, 'full');
             } 
             if(auto_play_movie()){
    ?>
    <div id="index_video">
     <div id="youtube_video_wrap">
      <div id="youtube_video_wrap_inner">
       <div id="youtube_video_player"></div>
      </div>
     </div>
    </div>
    <?php
         } else {
         if($video_image_id) {
    ?>
    <div id="video_poster" style="background:url(<?php echo esc_attr($video_image[0]); ?>) no-repeat center center; background-size:cover;"></div>
    <?php }; }; ?>
    <?php
           };
         };
    ?>
   </div><!-- END #index_slider -->
  </div><!-- END #index_slider_wrap -->
  <?php }; // END header content type ?>

 </div><!-- END #index_header_content -->

 <?php
      // Box content --------------------------------------------------------------------
      if( $options['index_box_content_image1'] || $options['index_box_content_image2'] || $options['index_box_content_image3'] ) {
 ?>
 <div id="index_box_content" class="clearfix">
  <?php
       for ( $i = 1; $i <= 3; $i++ ) :
         $image = wp_get_attachment_image_src( $options['index_box_content_image'.$i], 'full' );
         if($image) {
  ?>
  <div class="item">
   <a class="link animate_background" href="<?php echo esc_url($options['index_box_content_url'.$i]); ?>">
    <div class="image_wrap">
     <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
    </div>
    <p class="title rich_font"><?php echo esc_html($options['index_box_content_title'.$i]); ?></p>
    <div class="desc">
     <p><?php echo esc_html($options['index_box_content_desc'.$i]); ?></p>
    </div>
   </a>
  </div>
  <?php }; endfor; ?>
 </div><!-- END #index_box_content -->
 <?php }; ?>

 <?php }; // END if is front page ?>


