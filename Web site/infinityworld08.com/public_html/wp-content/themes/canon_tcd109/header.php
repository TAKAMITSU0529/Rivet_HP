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
<meta name="description" content="<?php echo get_seo_description(); ?>">
<?php if(is_attachment() && (get_option( 'blog_public' ) != 0)) { ?>
<meta name='robots' content='noindex, nofollow' />
<?php }; ?>
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
<?php wp_head(); ?>
</head>
<body id="body" <?php body_class(); ?>>
<div id="js-body-start"></div>

<?php
     // ロード画面 --------------------------------------------------------------------
     if(
       $options['show_loading'] && is_front_page() && $options['loading_display_page'] == 'type1' && $options['loading_display_time'] == 'type1' && !isset($_COOKIE['first_visit']) ||
       $options['show_loading'] && is_front_page() && $options['loading_display_page'] == 'type1' && $options['loading_display_time'] == 'type2' ||
       $options['show_loading'] && $options['loading_display_page'] == 'type2' && $options['loading_display_time'] == 'type1' && !isset($_COOKIE['first_visit']) ||
       $options['show_loading'] && $options['loading_display_page'] == 'type2' && $options['loading_display_time'] == 'type2'
     ){
       load_icon();
     };

     // メッセージ --------------------------------------------------------------------
     if( is_404() || ((is_search() && isset($_GET['s']) && empty($_GET['s'])) || (is_search() && !have_posts())) ){ } else {
       if( (is_front_page() && $options['show_header_message'] == 'display') || (!is_page() && $options['show_header_message'] == 'display') || (is_page() && !is_page_template('page-tcd-lp.php') && $options['show_header_message'] == 'display') || (is_page() && is_page_template('page-tcd-lp.php') && (get_post_meta($post->ID, 'hide_header_message', true)) == 'no') ) {
         $message = $options['header_message'];
         $url = $options['header_message_url'];
         $target = $options['header_message_target'];
         if(is_page_template('page-tcd-lp.php') && get_post_meta($post->ID, 'header_message', true)){
           $message = get_post_meta($post->ID, 'header_message', true);
           $url = get_post_meta($post->ID, 'header_message_url', true);
           $target = get_post_meta($post->ID, 'header_message_target', true);
         }
         if($message){
?>
<div id="header_message">
 <?php if($url){ ?>
 <a href="<?php echo esc_url($url); ?>"<?php if($target){ echo ' target="_blank" rel="nofollow noopener"'; }; ?> class="label"><?php echo wp_kses_post(nl2br($message)); ?></a>
 <?php }else{ ?>
 <p class="label"><?php echo wp_kses_post(nl2br($message)); ?></p>
 <?php } ?>
</div>
<?php
         };
       };
     };
?>

<?php
     // ヘッダー ----------------------------------------------------------------------
      if(is_page_template('page-tcd-lp.php')){ 
        $hide_page_header = get_post_meta($post->ID, 'hide_page_header', true) ?  get_post_meta($post->ID, 'hide_page_header', true) : 'no';
      } else {
        $hide_page_header = 'no';
      }
      if( $hide_page_header != 'yes' ) {
?>
<header id="header" class="mobile_logo_position_<?php echo esc_attr($options['header_logo_position']); ?>">

 <?php
      // ロゴ ----------------------------------------
      header_logo();
 ?>

 <div class="menu_area">

  <div class="top">
   <?php
        // 検索フォーム --------------------------------------------------------------------
        if( $options['header_search'] == 'display') {
          if(is_search() && isset($_GET['s']) && !empty($_GET['s'])){
            $search_keyword = $_GET['s'];
          } else {
            $search_keyword = '';
          };
   ?>
   <div id="header_search">
    <form role="search" method="get" action="<?php echo esc_url(home_url()); ?>">
     <div class="input_area"><input class="stop_scroll" type="text" value="<?php echo esc_attr($search_keyword); ?>" name="s" autocomplete="off"></div>
     <div class="search_button"><input type="submit" value=""></div>
    </form>
   </div>
   <?php }; ?>
   <?php
        // ボタン --------------------------------------------------
        if( $options['header_button_url1'] || $options['header_button_url2']){
   ?>
   <div id="header_button">
    <?php
         for ( $i = 1; $i <= 2; $i++ ) :
           $url = $options['header_button_url'.$i];
           if($url){
             $title = $options['header_button_title'.$i];
             $target = $options['header_button_target'.$i];
             $color = $options['header_button_color'.$i] ?  $options['header_button_color'.$i] : '#000000';
    ?>
    <a style="background:<?php echo esc_attr($color); ?>;" href="<?php echo esc_attr($url); ?>"<?php if($target){ echo ' target="_blank"'; }; ?>><?php echo esc_html($title); ?></a>
    <?php }; endfor; ?>
   </div>
   <?php }; ?>
  </div>

  <div class="bottom">

   <?php
        // グローバルメニュー ----------------------------------------------------------------
        if (has_nav_menu('global-menu')) {
          wp_nav_menu( array( 'sort_column' => 'menu_order', 'theme_location' => 'global-menu' , 'container' => 'nav', 'container_id' => 'global_menu' ) );
        };

        // 言語ボタン --------------------------------------------------
        if( $options['lang_button_url1'] || $options['lang_button_url2'] || $options['lang_button_url3'] || $options['lang_button_url4']){
   ?>
   <div id="lang_button">
    <?php
         $active_menu = true;
         for ( $i = 1; $i <= 4; $i++ ) :
           $url = $options['lang_button_url'.$i];
           if($url){
             $title = $options['lang_button_title'.$i];
             $target = $options['lang_button_target'.$i];
             if($active_menu == true){
               $active_menu = false;
    ?>
    <a class="active_menu" href="<?php echo esc_attr($url); ?>"<?php if($target){ echo ' target="_blank"'; }; ?>><span><?php echo esc_html($title); ?></span></a>
    <div class="sub_menu">
    <?php
             } else {
    ?>
     <a href="<?php echo esc_attr($url); ?>"<?php if($target){ echo ' target="_blank"'; }; ?>><span><?php echo esc_html($title); ?></span></a>
    <?php
             };
           };
         endfor;
    ?>
    </div>
   </div>
   <?php }; ?>
  </div>

 </div><!-- END .menu_area -->

 <?php
      // ドロワーメニュー ----------------------------------------------------------------
      if (has_nav_menu('global-menu')) {
 ?>
 <div id="drawer_menu_button"><span></span><span></span><span></span></div>
 <?php }; ?>

 <?php get_template_part( 'template-parts/megamenu' ); ?>

</header>
<?php }; ?>

<?php
     // サイドボタン --------------------------------------------------
     if( $options['side_button_url1'] || $options['side_button_url2'] || $options['side_button_url3']){
       if(!is_page_template('page-tcd-lp.php')){
         global $web_icon_options;
?>
<div id="side_icon_button" class="position_<?php echo esc_attr($options['side_button_position']); ?>">
  <?php
       for ( $i = 1; $i <= 3; $i++ ) :
         $url = $options['side_button_url'.$i];
         if($url){
           $title = $options['side_button_title'.$i];
           $icon = isset($options['side_button_icon'.$i]) ?  $options['side_button_icon'.$i] : 'e80d';
           $target = $options['side_button_target'.$i];
           if($icon != 'no_icon'){
             $icon_type = $icon ? $web_icon_options[$icon]['type'] : '';
             $icon_label = $icon ? $web_icon_options[$icon]['label'] : '';
           } else {
             $icon_type = 'none';
             $icon_label = 'no_icon';
           }
  ?>
  <a class="item num<?php echo $i; ?>" href="<?php echo esc_attr($url); ?>"<?php if($target){ echo ' target="_blank"'; }; ?>>
   <span class="icon icon_type_<?php echo esc_attr($icon_type); ?> <?php echo esc_attr($icon_label); ?>">&#x<?php echo esc_attr($icon); ?>;</span>
   <span class="label"><?php echo wp_kses_post($title); ?></span>
  </a>
  <?php }; endfor; ?>
</div>
<?php
       };
     };
?>

<div id="container">

 <?php
      //  トップページ -------------------------------------------------------------------------
      if(is_front_page()) {

        //  ヘッダースライダー -------------------------------------------------------------------------
        if($options['show_header_content']){
          $index_header_content_type = $options['index_header_content_type'];
          $index_header_height = $options['index_header_content_height'];
 ?>
 <div id="header_slider_container" class="header_content_<?php echo esc_attr($index_header_content_type); ?> height_<?php echo esc_attr($index_header_height); ?>">

  <?php
       if($options['index_header_caption_type'] == 'type1') {

         $logo_image = wp_get_attachment_image_src( $options['index_header_logo_image'], 'full' );
         if($logo_image) {
           $pc_image_width = $logo_image[1];
           $pc_image_height = $logo_image[2];
           if($options['index_header_logo_retina'] == 'yes') {
             $pc_image_width = round($pc_image_width / 2);
             $pc_image_height = round($pc_image_height / 2);
           };
         };
         $logo_image_mobile = wp_get_attachment_image_src( $options['index_header_logo_image_mobile'], 'full' );
         if($logo_image_mobile) {
           $mobile_image_width = $logo_image_mobile[1];
           $mobile_image_height = $logo_image_mobile[2];
           if($options['index_header_logo_retina'] == 'yes') {
             $mobile_image_width = round($mobile_image_width / 2);
             $mobile_image_height = round($mobile_image_height / 2);
           };
         };

       } else {

         $catch = $options['index_header_content_catch'];
         $catch_font_type = $options['index_header_content_catch_font_type'];
         $desc = $options['index_header_content_desc'];
         if(is_mobile() && $options['index_header_content_desc_mobile']){
           $desc = $options['index_header_content_desc_mobile'];
         }
         $button_label = $options['index_header_content_button'];
         $button_url = $options['index_header_content_button_url'] ?  $options['index_header_content_button_url'] : '';
         $button_target = $options['index_header_content_button_target'];

       };
  ?>
  <div id="header_slider_fixed_content">
   <div class="header_slider_content">
    <?php if($options['index_header_caption_type'] == 'type1' && $logo_image) { ?>
    <div class="logo">
     <img<?php if($logo_image_mobile){ echo ' class="pc"'; }; ?> src="<?php echo esc_attr($logo_image[0]); ?>" alt="<?php echo esc_attr($title); ?>" title="<?php echo esc_attr($title); ?>" width="<?php echo esc_attr($pc_image_width); ?>" height="<?php echo esc_attr($pc_image_height); ?>" />
     <?php if($logo_image_mobile){ ?>
     <img class="mobile" src="<?php echo esc_attr($logo_image_mobile[0]); ?>" alt="<?php echo esc_attr($title); ?>" title="<?php echo esc_attr($title); ?>" width="<?php echo esc_attr($mobile_image_width); ?>" height="<?php echo esc_attr($mobile_image_height); ?>" />
     <?php }; ?>
    </div>
    <?php } elseif($options['index_header_caption_type'] == 'type2'){ ?>
    <?php if($catch){ ?>
    <h2 class="catch rich_font_<?php echo esc_attr($catch_font_type); ?>"><?php echo wp_kses_post(nl2br($catch)); ?></h2>
    <?php }; ?>
    <?php if($desc){ ?>
    <p class="desc"><?php echo wp_kses_post(nl2br($desc)); ?></p>
    <?php }; ?>
    <?php if($button_label && $button_url){ ?>
    <a class="button" href="<?php echo esc_url($button_url); ?>"<?php if($button_target){ echo ' target="_blank" rel="nofollow noopener"'; }; ?>><?php echo wp_kses_post(nl2br($button_label)); ?></a>
    <?php }; ?>
    <?php }; ?>
   </div>
  </div>

  <?php
       $overlay = hex2rgb($options['index_header_content_overlay_color']);
       $overlay = implode(",",$overlay);
       $overlay_opacity = $options['index_header_content_overlay_opacity'];
       $animation_type = $options['index_slider_animation_type'];
  ?>
  <div id="header_slider" class="swiper<?php if($index_header_content_type == 'type1') { ?> animation_type_<?php echo esc_attr($animation_type); }; ?>" data-fade_speed="<?php if($index_header_content_type == 'type1') { echo '3000'; } else { echo '1500'; }; ?>">
   <div class="swiper-wrapper">
    <?php
         // 画像スライダー
         if($index_header_content_type == 'type1') {
           $i = 1;
           $images = $options['index_slider'];
           if(is_mobile() && $options['index_slider_sp']){
             $images = $options['index_slider_sp'];
           }
           $images = $images ? explode( ',', $images ) : array();
           if( !empty( $images ) ){
             foreach( $images as $image_id ):
               $image = wp_get_attachment_image_src( $image_id, 'full' );
               if( $image ){
    ?>
    <div class="swiper-slide item item<?php echo $i; ?> <?php echo $i; if($i == 1){ echo ' first_item'; }; ?>" data-item-type="type1">
     <div class="item_inner">
      <div class="overlay" style="background:rgba(<?php echo esc_attr($overlay); ?>,<?php echo esc_attr($overlay_opacity); ?>);"></div>
      <div class="bg_image">
       <img src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>">
      </div>
     </div>
    </div><!-- END .item -->
    <?php
               };
               $i++;
             endforeach;
           } else {
    ?>
    <div class="swiper-slide item item1 first_item" data-item-type="type1">
     <div class="item_inner">
      <div class="overlay" style="background:rgba(<?php echo esc_attr($overlay); ?>,1);"></div>
     </div>
    </div><!-- END .item -->
    <?php
           };

         // 動画
         } elseif($index_header_content_type == 'type2') {
           $video_url = $options['index_header_content_video'];
           if($video_url){
    ?>
    <div class="swiper-slide item first_item" data-item-type="type2">
     <div class="item_inner">
      <div class="overlay" style="background:rgba(<?php echo esc_attr($overlay); ?>,<?php echo esc_attr($overlay_opacity); ?>);"></div>
      <video class="bg_video" src="<?php echo esc_url(wp_get_attachment_url($video_url)); ?>" playsinline muted></video>
     </div>
    </div><!-- END .item -->
    <?php
           };

         // YouTube
         } elseif($index_header_content_type == 'type3') {
           if ( $options['index_header_content_youtube'] && preg_match( '%(?:youtube(?:-nocookie)?\.com/(?:[\w\-?&!#=,;]+/[\w\-?&!#=/,;]+/|(?:v|e(?:mbed)?)/|[\w\-?&!#=,;]*[?&]v=)|youtu\.be/)([\w-]{11})(?:[^\w-]|\Z)%i', $options['index_header_content_youtube'], $matches ) ) {
             $youtube_id = $matches[1];
    ?>
    <div class="swiper-slide item first_item" data-item-type="type3">
     <div class="item_inner">
      <div class="overlay" style="background:rgba(<?php echo esc_attr($overlay); ?>,<?php echo esc_attr($overlay_opacity); ?>);"></div>
      <div class="bg_youtube" data-video-id="<?php echo esc_attr( $youtube_id ); ?>"></div>
     </div><!-- END .item_inner -->
    </div><!-- END .item -->
    <?php
           };
         };
    ?>
   </div><!-- END .swiper-wrapper -->
   <div class="header_slider_pagination swiper-pagination"></div>
  </div><!-- END #header_slider -->

  <?php
       // ニュースティッカー
       if($options['show_header_news']){
         $post_num = 5;
         $post_type = $options['header_news_post_type'];
         if($post_type == 'post' || ($options['use_news'] && $post_type == 'news')){
           if($post_type == 'news'){
             $category_name = 'news_category';
           } else {
             $category_name = 'category';
           }
           $post_order = $options['header_news_post_order'];
           $args = array( 'post_type' => $post_type, 'posts_per_page' => $post_num, 'orderby' => $post_order );
           $post_list = new wp_query($args);
           if($post_list->have_posts()):
  ?>
  <div id="news_ticker" class="post_type_<?php echo esc_attr($post_type); ?>">
   <div id="news_ticker_inner">
    <div id="news_ticker_carousel" class="swiper">
     <div class="post_list swiper-wrapper">
      <?php  while( $post_list->have_posts() ) : $post_list->the_post(); ?>
      <a href="<?php the_permalink(); ?>" class="item swiper-slide">
       <div class="content">
        <time class="date entry-date published" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
        <p class="title"><?php the_title_attribute(); ?></p>
       </div>
      </a>
      <?php endwhile; wp_reset_query(); ?>
     </div>
    </div>
   </div>
  </div>
  <?php
           endif;
         };
       };
  ?>

 </div><!-- END #header_slider_container -->
 <?php }; ?>

 <?php
      }; // END front page

