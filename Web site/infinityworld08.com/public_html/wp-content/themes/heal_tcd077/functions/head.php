<?php
     function tcd_head() {
       $options = get_design_plus_option();
?>
<?php if ( ! defined( 'TCDCE_ACTIVE' ) || ! TCDCE_ACTIVE ) { ?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/design-plus.css?ver=<?php echo version_num(); ?>">
<?php } ?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/sns-botton.css?ver=<?php echo version_num(); ?>">
<link rel="stylesheet" media="screen and (max-width:1151px)" href="<?php echo get_template_directory_uri(); ?>/css/responsive.css?ver=<?php echo version_num(); ?>">
<link rel="stylesheet" media="screen and (max-width:1151px)" href="<?php echo get_template_directory_uri(); ?>/css/footer-bar.css?ver=<?php echo version_num(); ?>">
<?php if(is_mobile()) { ?>
<link rel='stylesheet' id='google-material-icon-css' href='https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200' type='text/css' media='all' />
<?php }; ?>

<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.easing.1.4.js?ver=<?php echo version_num(); ?>"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jscript.js?ver=<?php echo version_num(); ?>"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/comment.js?ver=<?php echo version_num(); ?>"></script>

<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/simplebar.css?ver=<?php echo version_num(); ?>">
<script src="<?php echo get_template_directory_uri(); ?>/js/simplebar.min.js?ver=<?php echo version_num(); ?>"></script>

<?php if(is_mobile()) { ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/footer-bar.js?ver=<?php echo version_num(); ?>"></script>
<?php }; ?>

<?php
     if($options['header_fix'] != 'type1') {
?>
<script src="<?php echo get_template_directory_uri(); ?>/js/header_fix.js?ver=<?php echo version_num(); ?>"></script>
<?php }; ?>
<?php
     if($options['mobile_header_fix'] == 'type2') {
?>
<script src="<?php echo get_template_directory_uri(); ?>/js/header_fix_mobile.js?ver=<?php echo version_num(); ?>"></script>
<?php };  ?>

<?php
     // Googleマップ
     if(is_page_template('page-lp.php')) {
       global $post;
       $lp_content = get_post_meta( $post->ID, 'lp_content', true );
       if ( $lp_content && is_array( $lp_content ) ) :
         foreach( $lp_content as $key => $content ) :
           if ( ($content['cb_content_select'] == 'content2') && $content['show_content']) {
             if($content['access_address']){
?>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo esc_attr( $options['gmap_api_key'] ); ?>" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/pagebuilder/assets/js/googlemap.js?ver=<?php echo version_num(); ?>"></script>
<?php
             break;
             };
           };
         endforeach;
       endif;
     };
?>

<style type="text/css">
<?php
     // フォントタイプの設定　------------------------------------------------------------------
                // フォントタイプの旧値（type1 など）を新値（1や2）にマッピング
$convert_font_type = function($value) {
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
  return $map[$value] ?? 1;
};

$font_type = $convert_font_type($options['font_type'] ?? 1);
$content_font_type = $convert_font_type($options['content_font_type'] ?? 1);
$headline_font_type = $convert_font_type($options['headline_font_type'] ?? 1);
$widget_headline_font_type = $convert_font_type($options['widget_headline_font_type'] ?? 1);
$button_font_type = $convert_font_type($options['button_font_type'] ?? 1);
?>

<?php
     // 基本のフォントタイプ
     if($font_type == 1) {
?>
body, input, textarea { font-family: var(--tcd-font-type1); }
<?php } elseif($font_type == 2) { ?>
body, input, textarea { font-family: var(--tcd-font-type2); }
<?php } else { ?>
body, input, textarea { font-family:var(--tcd-font-type3); }
<?php }; ?>


<?php
     // 見出しのフォントタイプ
     if($headline_font_type == 1) {
?>
.rich_font, .p-vertical { font-family: var(--tcd-font-type1);  }
<?php } elseif($headline_font_type == 2) { ?>
.rich_font, .p-vertical { font-family: var(--tcd-font-type2); font-weight:500; }
<?php } else { ?>
.rich_font, .p-vertical { font-family: var(--tcd-font-type3); font-weight:500; }
<?php }; ?>

<?php
     // ウィジェットの見出しのフォントタイプ
     if($widget_headline_font_type == 1) {
?>
.widget_headline { font-family:  var(--tcd-font-type1); }
<?php } elseif($widget_headline_font_type == 2) { ?>
.widget_headline { font-family:  var(--tcd-font-type2); font-weight:500; }
<?php } else { ?>
.widget_headline { font-family:  var(--tcd-font-type3);font-weight:500; }
<?php }; ?>


<?php
     // ボタンのフォントタイプ
     if($button_font_type == 1) {
?>
.button_font { font-family: var(--tcd-font-type1); }
<?php } elseif($button_font_type == 2) { ?>
.button_font { font-family: var(--tcd-font-type2); font-weight:500; }
<?php } else { ?>
.button_font { font-family: var(--tcd-font-type3); font-weight:500; }
<?php }; ?>

.rich_font_1 { font-family: var(--tcd-font-type1); }
.rich_font_2 { font-family: var(--tcd-font-type2); font-weight:500; }
.rich_font_3 { font-family: var(--tcd-font-type3); font-weight:500; }
.rich_font_logo { font-family: var(--tcd-font-type-logo); font-weight: <?php echo esc_html( $options['font_list']['logo']['weight'] ?? 'bold' ); ?> !important;}

<?php
     // 本文のフォントタイプ
     if(is_single()) {
       if($content_font_type == 1) {
?>
.post_content, #next_prev_post { font-family: var(--tcd-font-type1); }
<?php } elseif($content_font_type == 2) { ?>
.post_content, #next_prev_post { font-family: var(--tcd-font-type2);  }
<?php } else { ?>
.post_content, #next_prev_post { font-family: var(--tcd-font-type3); }
<?php }; }; ?>

<?php
     // サイトの説明文
?>
#site_desc { font-size:<?php echo esc_attr($options['header_desc_font_size']); ?>px; }
@media screen and (max-width:750px) {
  #site_desc { font-size:<?php echo esc_attr($options['header_desc_font_size_mobile']); ?>px; }
}
<?php
     // グローバルメニュー
?>
#global_menu { background:<?php echo esc_html($options['global_menu_bg_color']); ?>; }
#global_menu > ul { border-color:<?php echo esc_html($options['global_menu_border_color']); ?>; }
#global_menu > ul > li { border-color:<?php echo esc_html($options['global_menu_border_color']); ?>; }
#global_menu > ul > li > a { color:<?php echo esc_html($options['global_menu_font_color']); ?>; }
#global_menu > ul > li > a:hover, #global_menu > ul > li.megamenu_parent.active_button > a { color:<?php echo esc_html($options['global_menu_font_color_hover']); ?>; }
#global_menu ul ul { font-family: "Hiragino Sans", "ヒラギノ角ゴ ProN", "Hiragino Kaku Gothic ProN", "游ゴシック", YuGothic, "メイリオ", Meiryo, sans-serif !important; }
#global_menu ul ul a { color:<?php echo esc_html($options['global_menu_child_font_color']); ?>; background:<?php echo esc_html($options['global_menu_child_bg_color']); ?>; }
#global_menu ul ul a:hover { background:<?php echo esc_html($options['global_menu_child_bg_color_hover']); ?>; }
#global_menu ul ul li.menu-item-has-children > a:before { color:<?php echo esc_html($options['global_menu_child_font_color']); ?>; }
<?php
     // ドロワーメニュー
?>
#drawer_menu { background:<?php echo esc_html($options['mobile_menu_bg_color']); ?>; }
#mobile_menu a { color:<?php echo esc_html($options['mobile_menu_font_color']); ?>; background:<?php echo esc_html($options['mobile_menu_bg_color']); ?>; border-bottom:1px solid <?php echo esc_html($options['mobile_menu_border_color']); ?>; }
#mobile_menu li li a { color:<?php echo esc_html($options['mobile_menu_child_font_color']); ?>; background:<?php echo esc_html($options['mobile_menu_sub_menu_bg_color']); ?>; }
#mobile_menu a:hover, #drawer_menu .close_button:hover, #mobile_menu .child_menu_button:hover { color:<?php echo esc_html($options['mobile_menu_font_hover_color']); ?>; background:<?php echo esc_html($options['mobile_menu_bg_hover_color']); ?>; }
#mobile_menu li li a:hover { color:<?php echo esc_html($options['mobile_menu_child_font_hover_color']); ?>; }
<?php
     // メガメニュー
     $mega_menu_a_bg_color = hex2rgb($options['mega_menu_a_bg_color']);
     $mega_menu_a_bg_color = implode(",",$mega_menu_a_bg_color);
     $mega_menu_a_title_bg_color = hex2rgb($options['mega_menu_a_title_bg_color']);
     $mega_menu_a_title_bg_color = implode(",",$mega_menu_a_title_bg_color);
     $mega_menu_b_bg_color = hex2rgb($options['mega_menu_b_bg_color']);
     $mega_menu_b_bg_color = implode(",",$mega_menu_b_bg_color);
     $mega_menu_b_title_bg_color = hex2rgb($options['mega_menu_b_title_bg_color']);
     $mega_menu_b_title_bg_color = implode(",",$mega_menu_b_title_bg_color);
?>
.megamenu_menu_list { background:rgba(<?php echo esc_html($mega_menu_a_bg_color); ?>,<?php echo esc_html($options['mega_menu_a_bg_opacity']); ?>); }
.megamenu_menu_list .title_area { background:rgba(<?php echo esc_html($mega_menu_a_title_bg_color); ?>,<?php echo esc_html($options['mega_menu_a_title_bg_opacity']); ?>); }
.megamenu_menu_list .title { font-size:<?php echo esc_html($options['mega_menu_a_title_font_size']); ?>px; }
.megamenu_menu_list .title span { font-size:<?php echo esc_html($options['mega_menu_a_sub_title_font_size']); ?>px; }
.megamenu_blog_list { background:rgba(<?php echo esc_html($mega_menu_b_bg_color); ?>,<?php echo esc_html($options['mega_menu_b_bg_opacity']); ?>); }
.megamenu_blog_list .post_list .title_area {
  background: -moz-linear-gradient(top,  rgba(0,0,0,0) 0%, rgba(<?php echo esc_html($mega_menu_b_title_bg_color); ?>,<?php echo esc_html($options['mega_menu_b_title_bg_opacity']); ?>) 100%);
  background: -webkit-linear-gradient(top,  rgba(0,0,0,0) 0%,rgba(<?php echo esc_html($mega_menu_b_title_bg_color); ?>,<?php echo esc_html($options['mega_menu_b_title_bg_opacity']); ?>) 100%);
  background: linear-gradient(to bottom,  rgba(0,0,0,0) 0%,rgba(<?php echo esc_html($mega_menu_b_title_bg_color); ?>,<?php echo esc_html($options['mega_menu_b_title_bg_opacity']); ?>) 100%);
}
.megamenu_blog_list .post_list .title { font-size:<?php echo esc_html($options['mega_menu_b_title_font_size']); ?>px; }
.megamenu_blog_list .menu_area a:hover, .megamenu_blog_list .menu_area li.active a { color:<?php echo esc_html($options['global_menu_font_color_hover']); ?>; }
<?php
     // パンくずリンク
     $bread_bg_color = hex2rgb($options['bread_bg_color']);
     $bread_bg_color = implode(",",$bread_bg_color);
?>
#bread_crumb { background:rgba(<?php echo esc_html($bread_bg_color); ?>,<?php echo esc_html($options['bread_bg_opacity']); ?>); }
<?php
     // フッター -----------------------------------------------------------------------------------
     $footer_banner_bg_color = hex2rgb($options['footer_banner_bg_color']);
     $footer_banner_bg_color = implode(",",$footer_banner_bg_color);
?>
#footer_banner .title { font-size:<?php echo esc_html($options['footer_banner_font_size']); ?>px; color:<?php echo esc_html($options['footer_banner_font_color']); ?>; background:rgba(<?php echo esc_html($footer_banner_bg_color); ?>,<?php echo esc_html($options['footer_banner_bg_opacity']); ?>); }
@media screen and (max-width:750px) {
  #footer_banner .title { font-size:<?php echo esc_html($options['footer_banner_font_size_mobile']); ?>px; }
}
<?php
     if( $options['show_footer_button'] ) {
?>
#footer_button a { color:<?php echo esc_html($options['footer_button_font_color']); ?>  !important; border-color:<?php echo esc_html($options['footer_button_border_color']); ?>; }
#footer_button a:hover { color:<?php echo esc_html($options['footer_button_font_color_hover']); ?> !important; background:<?php echo esc_html($options['footer_button_bg_color_hover']); ?>; border-color:<?php echo esc_html($options['footer_button_border_color_hover']); ?>; }
<?php }; ?>

<?php
     // お知らせアーカイブページ -----------------------------------------------------------------------------
     if(is_post_type_archive('news') || is_singular('news')) {
       $page_header_color = $options['news_title_color'];
       $page_header_headline_font_size = $options['news_title_font_size'];
       $page_header_sub_title_font_size = $options['news_sub_title_font_size'];
       $page_header_headline_font_size_mobile = $options['news_title_font_size_mobile'];
       $page_header_sub_title_font_size_mobile = $options['news_sub_title_font_size_mobile'];
?>
#page_header .headline_area { color:<?php echo esc_attr($page_header_color); ?>; }
#page_header .headline { font-size:<?php echo esc_attr($page_header_headline_font_size); ?>px; }
#page_header .sub_title { font-size:<?php echo esc_attr($page_header_sub_title_font_size); ?>px; }
#campaign_list .title { font-size:<?php echo esc_html($options['archive_news_title_font_size']); ?>px; }
<?php if(is_singular('news')) { ?>
#campaign_title_area .title { font-size:<?php echo esc_html($options['single_news_title_font_size']); ?>px; }
#campaign_article .post_content { font-size:<?php echo esc_html($options['single_news_content_font_size']); ?>px; }
#recent_news .headline { font-size:<?php echo esc_html($options['recent_news_headline_font_size']); ?>px; color:<?php echo esc_attr($options['recent_news_headline_font_color']); ?>; background:<?php echo esc_attr($options['recent_news_headline_bg_color']); ?>; }
#recent_news .button a { color:<?php echo esc_html($options['recent_news_button_color']); ?>; border-color:<?php echo esc_html($options['recent_news_button_border_color']); ?>; }
#recent_news .button a:hover { color:<?php echo esc_html($options['recent_news_button_color_hover']); ?>; border-color:<?php echo esc_html($options['recent_news_button_border_color_hover']); ?>; background:<?php echo esc_html($options['recent_news_button_bg_color_hover']); ?>; }
<?php }; ?>
@media screen and (max-width:750px) {
  #page_header .headline { font-size:<?php echo esc_attr($page_header_headline_font_size_mobile); ?>px; }
  #page_header .sub_title { font-size:<?php echo esc_attr($page_header_sub_title_font_size_mobile); ?>px; }
  #campaign_list .title { font-size:<?php echo esc_html($options['archive_news_title_font_size_mobile']); ?>px; }
<?php if(is_singular('news')) { ?>
  #campaign_title_area .title { font-size:<?php echo esc_html($options['single_news_title_font_size_mobile']); ?>px; }
  #campaign_article .post_content { font-size:<?php echo esc_html($options['single_news_content_font_size_mobile']); ?>px; }
  #recent_news .headline { font-size:<?php echo esc_html($options['recent_news_headline_font_size_mobile']); ?>px; }
<?php }; ?>
}
<?php
     // メニューアーカイブページ・詳細ページ -----------------------------------------------------------------------------
     } elseif(is_post_type_archive('menu') || is_singular('menu')) {
      global $post;
      $page_header_color = $options['menu_title_color'];
      $page_header_headline_font_size = $options['menu_title_font_size'];
      $page_header_sub_title_font_size = $options['menu_sub_title_font_size'];
      $page_header_headline_font_size_mobile = $options['menu_title_font_size_mobile'];
      $page_header_sub_title_font_size_mobile = $options['menu_sub_title_font_size_mobile'];
      $page_header_catch_font_size = $options['menu_catch_font_size'];
      $page_header_catch_font_color = $options['menu_catch_font_color'];
      $page_header_desc_font_size = $options['menu_desc_font_size'];
      $page_header_catch_font_size_mobile = $options['menu_catch_font_size_mobile'];
      $page_header_desc_font_size_mobile = $options['menu_desc_font_size_mobile'];

      $archive_menu_title_font_size = $options['archive_menu_title_font_size'];
      $archive_menu_title_font_size_mobile = $options['archive_menu_title_font_size_mobile'];
      $archive_menu_sub_title_font_size = $options['archive_menu_sub_title_font_size'];
      $archive_menu_sub_title_font_size_mobile = $options['archive_menu_sub_title_font_size_mobile'];
      $archive_menu_desc_font_size = $options['archive_menu_desc_font_size'];
      $archive_menu_desc_font_size_mobile = $options['archive_menu_desc_font_size_mobile'];

      $archive_menu_title_bg_color = hex2rgb($options['archive_menu_title_bg_color']);
      $archive_menu_title_bg_color = implode(",",$archive_menu_title_bg_color);
?>
#page_header .headline_area { color:<?php echo esc_attr($page_header_color); ?>; }
#page_header .headline { font-size:<?php echo esc_attr($page_header_headline_font_size); ?>px; }
#page_header .sub_title { font-size:<?php echo esc_attr($page_header_sub_title_font_size); ?>px; }
#catch_area .catch { font-size:<?php echo esc_attr($page_header_catch_font_size); ?>px; color:<?php echo esc_attr($page_header_catch_font_color); ?>; }
#catch_area .desc { font-size:<?php echo esc_attr($page_header_desc_font_size); ?>px; }
#menu_list .title_area { background:rgba(<?php echo esc_html($archive_menu_title_bg_color); ?>,<?php echo esc_html($options['archive_menu_title_bg_opacity']); ?>); }
#menu_list .title { font-size:<?php echo esc_attr($archive_menu_title_font_size); ?>px; }
#menu_list .title span { font-size:<?php echo esc_attr($archive_menu_sub_title_font_size); ?>px; }
#menu_list .desc { font-size:<?php echo esc_attr($archive_menu_desc_font_size); ?>px; }
@media screen and (max-width:750px) {
  #page_header .headline { font-size:<?php echo esc_attr($page_header_headline_font_size_mobile); ?>px; }
  #page_header .sub_title { font-size:<?php echo esc_attr($page_header_sub_title_font_size_mobile); ?>px; }
  #catch_area .catch { font-size:<?php echo esc_attr($page_header_catch_font_size_mobile); ?>px; }
  #catch_area .desc { font-size:<?php echo esc_attr($page_header_desc_font_size_mobile); ?>px; }
  #menu_list .title { font-size:<?php echo esc_attr($archive_menu_title_font_size_mobile); ?>px; }
  #menu_list .title span { font-size:<?php echo esc_attr($archive_menu_sub_title_font_size_mobile); ?>px; }
  #menu_list .desc { font-size:<?php echo esc_attr($archive_menu_desc_font_size_mobile); ?>px; }
}
<?php
     if(is_singular('menu')){
       $menu_cf = get_post_meta( $post->ID, 'menu_cf', true );
       if ( $menu_cf && is_array( $menu_cf ) ) :
         foreach( $menu_cf as $key => $content ) :

           // コンテンツ1 -----------------------------------------------------------------
           if ( ($content['cb_content_select'] == 'content1') && $content['show_content'] ) {
             $headline_font_size = $content['headline_font_size'] ? esc_html( $content['headline_font_size'] ) : '38';
             $headline_font_size_mobile = $content['headline_font_size_mobile'] ? esc_html( $content['headline_font_size_mobile'] ) : '20';
             $sub_headline_font_size = $content['sub_headline_font_size'] ? esc_html( $content['sub_headline_font_size'] ) : '18';
             $sub_headline_font_size_mobile = $content['sub_headline_font_size_mobile'] ? esc_html( $content['sub_headline_font_size_mobile'] ) : '15';
             $headline_font_color = $content['headline_font_color'] ? esc_html( $content['headline_font_color'] ) : '#593306';
             $desc_font_size = $content['desc_font_size'] ? esc_html( $content['desc_font_size'] ) : '16';
             $desc_font_size_mobile = $content['desc_font_size_mobile'] ? esc_html( $content['desc_font_size_mobile'] ) : '14';
?>
.menu_content1.num<?php echo esc_attr($key); ?> .headline { font-size:<?php echo $headline_font_size; ?>px; color:<?php echo $headline_font_color; ?>; }
.menu_content1.num<?php echo esc_attr($key); ?> .headline span { font-size:<?php echo $sub_headline_font_size; ?>px; }
.menu_content1.num<?php echo esc_attr($key); ?> .post_content { font-size:<?php echo $desc_font_size; ?>px; }
@media screen and (max-width:750px) {
  .menu_content1.num<?php echo esc_attr($key); ?> .headline { font-size:<?php echo $headline_font_size_mobile; ?>px; }
  .menu_content1.num<?php echo esc_attr($key); ?> .headline span { font-size:<?php echo $sub_headline_font_size_mobile; ?>px; }
  .menu_content1.num<?php echo esc_attr($key); ?> .post_content { font-size:<?php echo $desc_font_size_mobile; ?>px; }
}
<?php
           // コンテンツ2 -----------------------------------------------------------------
           } elseif ( ($content['cb_content_select'] == 'content2') && $content['show_content']) {
             $headline_font_size = $content['headline_font_size'] ? esc_html( $content['headline_font_size'] ) : '38';
             $headline_font_size_mobile = $content['headline_font_size_mobile'] ? esc_html( $content['headline_font_size_mobile'] ) : '20';
             $sub_headline_font_size = $content['sub_headline_font_size'] ? esc_html( $content['sub_headline_font_size'] ) : '18';
             $sub_headline_font_size_mobile = $content['sub_headline_font_size_mobile'] ? esc_html( $content['sub_headline_font_size_mobile'] ) : '15';
             $headline_font_color = $content['headline_font_color'] ? esc_html( $content['headline_font_color'] ) : '#593306';
             $desc_font_size = $content['desc_font_size'] ? esc_html( $content['desc_font_size'] ) : '16';
             $desc_font_size_mobile = $content['desc_font_size_mobile'] ? esc_html( $content['desc_font_size_mobile'] ) : '14';
             $price_list1_headline_font_size = $content['price_list1_headline_font_size'] ? esc_html( $content['price_list1_headline_font_size'] ) : '22';
             $price_list1_headline_font_size_mobile = $content['price_list1_headline_font_size_mobile'] ? esc_html( $content['price_list1_headline_font_size_mobile'] ) : '16';
             $price_list1_headline_font_color = $content['price_list1_headline_font_color'] ? esc_html( $content['price_list1_headline_font_color'] ) : '#ffffff';
             $price_list1_headline_bg_color = $content['price_list1_headline_bg_color'] ? esc_html( $content['price_list1_headline_bg_color'] ) : '#58330d';
             $price_list2_headline_font_size = $content['price_list2_headline_font_size'] ? esc_html( $content['price_list2_headline_font_size'] ) : '22';
             $price_list2_headline_font_size_mobile = $content['price_list2_headline_font_size_mobile'] ? esc_html( $content['price_list2_headline_font_size_mobile'] ) : '16';
             $price_list2_headline_font_color = $content['price_list2_headline_font_color'] ? esc_html( $content['price_list2_headline_font_color'] ) : '#ffffff';
             $price_list2_headline_bg_color = $content['price_list2_headline_bg_color'] ? esc_html( $content['price_list2_headline_bg_color'] ) : '#ad9981';
             $price_list3_headline_font_size = $content['price_list3_headline_font_size'] ? esc_html( $content['price_list3_headline_font_size'] ) : '22';
             $price_list3_headline_font_size_mobile = $content['price_list3_headline_font_size_mobile'] ? esc_html( $content['price_list3_headline_font_size_mobile'] ) : '16';
             $price_list3_headline_font_color = $content['price_list3_headline_font_color'] ? esc_html( $content['price_list3_headline_font_color'] ) : '#ffffff';
             $price_list3_headline_bg_color = $content['price_list3_headline_bg_color'] ? esc_html( $content['price_list3_headline_bg_color'] ) : '#ad9981';
?>
.menu_content2.num<?php echo esc_attr($key); ?> .headline { font-size:<?php echo $headline_font_size; ?>px; color:<?php echo $headline_font_color; ?>; }
.menu_content2.num<?php echo esc_attr($key); ?> .headline span { font-size:<?php echo $sub_headline_font_size; ?>px; }
.menu_content2.num<?php echo esc_attr($key); ?> .post_content { font-size:<?php echo $desc_font_size; ?>px; }
.menu_content2.num<?php echo esc_attr($key); ?> .menu_price_list1 .list_headline { font-size:<?php echo $price_list1_headline_font_size; ?>px; color:<?php echo $price_list1_headline_font_color; ?>; background:<?php echo $price_list1_headline_bg_color; ?>; }
.menu_content2.num<?php echo esc_attr($key); ?> .menu_price_list2 .list_headline { font-size:<?php echo $price_list2_headline_font_size; ?>px; color:<?php echo $price_list2_headline_font_color; ?>; background:<?php echo $price_list2_headline_bg_color; ?>; }
.menu_content2.num<?php echo esc_attr($key); ?> .menu_price_list3 .list_headline { font-size:<?php echo $price_list3_headline_font_size; ?>px; color:<?php echo $price_list3_headline_font_color; ?>; background:<?php echo $price_list3_headline_bg_color; ?>; }
@media screen and (max-width:750px) {
  .menu_content2.num<?php echo esc_attr($key); ?> .headline { font-size:<?php echo $headline_font_size_mobile; ?>px; }
  .menu_content2.num<?php echo esc_attr($key); ?> .headline span { font-size:<?php echo $sub_headline_font_size_mobile; ?>px; }
  .menu_content2.num<?php echo esc_attr($key); ?> .post_content { font-size:<?php echo $desc_font_size_mobile; ?>px; }
  .menu_content2.num<?php echo esc_attr($key); ?> .menu_price_list1 .list_headline { font-size:<?php echo $price_list1_headline_font_size_mobile; ?>px; }
  .menu_content2.num<?php echo esc_attr($key); ?> .menu_price_list2 .list_headline { font-size:<?php echo $price_list2_headline_font_size_mobile; ?>px; }
  .menu_content2.num<?php echo esc_attr($key); ?> .menu_price_list3 .list_headline { font-size:<?php echo $price_list3_headline_font_size_mobile; ?>px; }
}
<?php
           // コンテンツ3 -----------------------------------------------------------------
           } elseif ( ($content['cb_content_select'] == 'content3') && $content['show_content'] ) {
             $headline_font_size = $content['headline_font_size'] ? esc_html( $content['headline_font_size'] ) : '22';
             $headline_font_size_mobile = $content['headline_font_size_mobile'] ? esc_html( $content['headline_font_size_mobile'] ) : '16';
             $headline_font_color = $content['headline_font_color'] ? esc_html( $content['headline_font_color'] ) : '#ffffff';
             $headline_bg_color = $content['headline_bg_color'] ? esc_html( $content['headline_bg_color'] ) : '#58330d';
?>
.menu_content3.num<?php echo esc_attr($key); ?> .list_headline { font-size:<?php echo $headline_font_size; ?>px; color:<?php echo $headline_font_color; ?>; background:<?php echo $headline_bg_color; ?>; }
@media screen and (max-width:750px) {
  .menu_content3.num<?php echo esc_attr($key); ?> .list_headline { font-size:<?php echo $headline_font_size_mobile; ?>px; }
}
<?php
           // コンテンツ4 -----------------------------------------------------------------
           } elseif ( ($content['cb_content_select'] == 'content4') && $content['show_content'] ) {
             $desc_font_size = $content['desc_font_size'] ? esc_html( $content['desc_font_size'] ) : '14';
             $desc_font_size_mobile = $content['desc_font_size_mobile'] ? esc_html( $content['desc_font_size_mobile'] ) : '12';
?>
.menu_content4.num<?php echo esc_attr($key); ?> .post_content { font-size:<?php echo $desc_font_size; ?>px; }
@media screen and (max-width:750px) {
  .menu_content4.num<?php echo esc_attr($key); ?> .post_content { font-size:<?php echo $desc_font_size_mobile; ?>px; }
}
<?php
           };
         endforeach;
       endif;
       $single_menu_list_title_bg_color = hex2rgb($options['single_menu_list_title_bg_color']);
       $single_menu_list_title_bg_color = implode(",",$single_menu_list_title_bg_color);
?>
#single_menu_list .headline { font-size:<?php echo esc_html($options['single_menu_list_headline_font_size']); ?>px; color:<?php echo esc_html($options['single_menu_list_headline_color']); ?>; }
#single_menu_list .headline span { font-size:<?php echo esc_html($options['single_menu_list_sub_headline_font_size']); ?>px; }
#single_menu_list .menu_list .title_area { background:rgba(<?php echo esc_html($single_menu_list_title_bg_color); ?>,<?php echo esc_html($options['single_menu_list_title_bg_opacity']); ?>); }
#single_menu_list .menu_list .title { font-size:<?php echo esc_html($options['single_menu_list_title_font_size']); ?>px; }
#single_menu_list .menu_list .title span { font-size:<?php echo esc_html($options['single_menu_list_sub_title_font_size']); ?>px; }
@media screen and (max-width:750px) {
  #single_menu_list .headline { font-size:<?php echo esc_html($options['single_menu_list_headline_font_size_mobile']); ?>px; }
  #single_menu_list .headline span { font-size:<?php echo esc_html($options['single_menu_list_sub_headline_font_size_mobile']); ?>px; }
  #single_menu_list .menu_list .title { font-size:<?php echo esc_html($options['single_menu_list_title_font_size_mobile']); ?>px; }
  #single_menu_list .menu_list .title span { font-size:<?php echo esc_html($options['single_menu_list_sub_title_font_size_mobile']); ?>px; }
}
<?php
     }; // END single menu

     // キャンペーンアーカイブページ・詳細ページ -----------------------------------------------------------------------------
     } elseif(is_post_type_archive('campaign') || is_singular('campaign')) {
      global $post;
      $page_header_color = $options['campaign_title_color'];
      $page_header_headline_font_size = $options['campaign_title_font_size'];
      $page_header_sub_title_font_size = $options['campaign_sub_title_font_size'];
      $page_header_headline_font_size_mobile = $options['campaign_title_font_size_mobile'];
      $page_header_sub_title_font_size_mobile = $options['campaign_sub_title_font_size_mobile'];
?>
#page_header .headline_area { color:<?php echo esc_attr($page_header_color); ?>; }
#page_header .headline { font-size:<?php echo esc_attr($page_header_headline_font_size); ?>px; }
#page_header .sub_title { font-size:<?php echo esc_attr($page_header_sub_title_font_size); ?>px; }
<?php if(is_post_type_archive('campaign')){ ?>
#campaign_list .title { font-size:<?php echo esc_html($options['archive_campaign_title_font_size']); ?>px; }
<?php } else { ?>
#campaign_title_area .title { font-size:<?php echo esc_html($options['single_campaign_title_font_size']); ?>px; }
#campaign_article .post_content { font-size:<?php echo esc_html($options['single_campaign_content_font_size']); ?>px; }
#campaign_list .title { font-size:<?php echo esc_html($options['related_campaign_list_title_font_size']); ?>px; }
#related_campaign_list .headline { font-size:<?php echo esc_html($options['related_campaign_headline_font_size']); ?>px; color:<?php echo esc_attr($options['related_campaign_headline_font_color']); ?>; background:<?php echo esc_attr($options['related_campaign_headline_bg_color']); ?>; }
#related_campaign_list .button a { color:<?php echo esc_html($options['related_campaign_button_color']); ?>; border-color:<?php echo esc_html($options['related_campaign_button_border_color']); ?>; }
#related_campaign_list .button a:hover { color:<?php echo esc_html($options['related_campaign_button_color_hover']); ?>; border-color:<?php echo esc_html($options['related_campaign_button_border_color_hover']); ?>; background:<?php echo esc_html($options['related_campaign_button_bg_color_hover']); ?>; }
<?php }; ?>
@media screen and (max-width:750px) {
  #page_header .headline { font-size:<?php echo esc_attr($page_header_headline_font_size_mobile); ?>px; }
  #page_header .sub_title { font-size:<?php echo esc_attr($page_header_sub_title_font_size_mobile); ?>px; }
<?php if(is_post_type_archive('campaign')){ ?>
  #campaign_list .title { font-size:<?php echo esc_html($options['archive_campaign_title_font_size_mobile']); ?>px; }
<?php } else { ?>
  #campaign_title_area .title { font-size:<?php echo esc_html($options['single_campaign_title_font_size_mobile']); ?>px; }
  #campaign_article .post_content { font-size:<?php echo esc_html($options['single_campaign_content_font_size_mobile']); ?>px; }
  #campaign_list .title { font-size:<?php echo esc_html($options['related_campaign_list_title_font_size_mobile']); ?>px; }
  #related_campaign_list .headline { font-size:<?php echo esc_html($options['related_campaign_headline_font_size_mobile']); ?>px; }
<?php }; ?>
}
<?php
     // お客様の声アーカイブページ -----------------------------------------------------------------------------
     } elseif(is_post_type_archive('voice')) {
      global $post;
      $page_header_color = $options['voice_title_color'];
      $page_header_headline_font_size = $options['voice_title_font_size'];
      $page_header_sub_title_font_size = $options['voice_sub_title_font_size'];
      $page_header_headline_font_size_mobile = $options['voice_title_font_size_mobile'];
      $page_header_sub_title_font_size_mobile = $options['voice_sub_title_font_size_mobile'];
      $page_header_catch_font_size = $options['voice_catch_font_size'];
      $page_header_catch_font_color = $options['voice_catch_font_color'];
      $page_header_desc_font_size = $options['voice_desc_font_size'];
      $page_header_catch_font_size_mobile = $options['voice_catch_font_size_mobile'];
      $page_header_desc_font_size_mobile = $options['voice_desc_font_size_mobile'];
?>
#page_header .headline_area { color:<?php echo esc_attr($page_header_color); ?>; }
#page_header .headline { font-size:<?php echo esc_attr($page_header_headline_font_size); ?>px; }
#page_header .sub_title { font-size:<?php echo esc_attr($page_header_sub_title_font_size); ?>px; }
#catch_area .catch { font-size:<?php echo esc_attr($page_header_catch_font_size); ?>px; color:<?php echo esc_attr($page_header_catch_font_color); ?>; }
#catch_area .desc { font-size:<?php echo esc_attr($page_header_desc_font_size); ?>px; }
#voice_list .title { font-size:<?php echo esc_html($options['archive_voice_title_font_size']); ?>px; color:<?php echo esc_html($options['archive_voice_title_font_color']); ?>; }
#voice_list .post_content { font-size:<?php echo esc_html($options['archive_voice_content_font_size']); ?>px; }
@media screen and (max-width:750px) {
  #page_header .headline { font-size:<?php echo esc_attr($page_header_headline_font_size_mobile); ?>px; }
  #page_header .sub_title { font-size:<?php echo esc_attr($page_header_sub_title_font_size_mobile); ?>px; }
  #catch_area .catch { font-size:<?php echo esc_attr($page_header_catch_font_size_mobile); ?>px; }
  #catch_area .desc { font-size:<?php echo esc_attr($page_header_desc_font_size_mobile); ?>px; }
  #voice_list .title { font-size:<?php echo esc_html($options['archive_voice_title_font_size_mobile']); ?>px; }
  #voice_list .post_content { font-size:<?php echo esc_html($options['archive_voice_content_font_size_mobile']); ?>px; }
}
<?php
     // スタッフアーカイブページ・詳細ページ -----------------------------------------------------------------------------
     } elseif(is_post_type_archive('staff') || is_singular('staff')) {
      global $post;
      $page_header_color = $options['staff_title_color'];
      $page_header_headline_font_size = $options['staff_title_font_size'];
      $page_header_sub_title_font_size = $options['staff_sub_title_font_size'];
      $page_header_headline_font_size_mobile = $options['staff_title_font_size_mobile'];
      $page_header_sub_title_font_size_mobile = $options['staff_sub_title_font_size_mobile'];
      $page_header_catch_font_size = $options['staff_catch_font_size'];
      $page_header_catch_font_color = $options['staff_catch_font_color'];
      $page_header_desc_font_size = $options['staff_desc_font_size'];
      $page_header_catch_font_size_mobile = $options['staff_catch_font_size_mobile'];
      $page_header_desc_font_size_mobile = $options['staff_desc_font_size_mobile'];
      $archive_staff_overlay_color = hex2rgb($options['archive_staff_overlay_color']);
      $archive_staff_overlay_color = implode(",",$archive_staff_overlay_color);
      $archive_staff_overlay_opacity = $options['archive_staff_overlay_opacity'];

      // 詳細ページ
      if(is_singular('staff')) {

      $staff_catch_font_size = get_post_meta($post->ID, 'staff_catch_font_size', true);
        if(empty($staff_catch_font_size)){ $staff_catch_font_size = '22'; };
      $staff_catch_font_size_mobile = get_post_meta($post->ID, 'staff_catch_font_size_mobile', true);
        if(empty($staff_catch_font_size_mobile)){ $staff_catch_font_size_mobile = '18'; };
      $staff_catch_color = get_post_meta($post->ID, 'staff_catch_color', true);
        if(empty($staff_catch_color)){ $staff_catch_color = '#d4bc9c'; };

      $staff_desc_font_size = get_post_meta($post->ID, 'staff_desc_font_size', true);
        if(empty($staff_desc_font_size)){ $staff_desc_font_size = '16'; };
      $staff_desc_font_size_mobile = get_post_meta($post->ID, 'staff_desc_font_size_mobile', true);
        if(empty($staff_desc_font_size_mobile)){ $staff_desc_font_size_mobile = '14'; };
      $staff_desc_color = get_post_meta($post->ID, 'staff_desc_color', true);
        if(empty($staff_desc_color)){ $staff_desc_color = '#ffffff'; };

      $staff_content_headline_font_size = get_post_meta($post->ID, 'staff_content_headline_font_size', true);
       if(empty($staff_content_headline_font_size)){ $staff_content_headline_font_size = '18'; };
      $staff_content_headline_font_size_mobile = get_post_meta($post->ID, 'staff_content_headline_font_size_mobile', true);
       if(empty($staff_content_headline_font_size_mobile)){ $staff_content_headline_font_size_mobile = '15'; };
      $staff_content_desc_font_size = get_post_meta($post->ID, 'staff_content_desc_font_size', true);
       if(empty($staff_content_desc_font_size)){ $staff_content_desc_font_size = '16'; };
      $staff_content_desc_font_size_mobile = get_post_meta($post->ID, 'staff_content_desc_font_size_mobile', true);
       if(empty($staff_content_desc_font_size_mobile)){ $staff_content_desc_font_size_mobile = '14'; };
      $staff_content_headline_font_color = get_post_meta($post->ID, 'staff_content_headline_font_color', true);
       if(empty($staff_content_headline_font_color)){ $staff_content_headline_font_color = '#58330d'; };
      $staff_content_headline_border_color = get_post_meta($post->ID, 'staff_content_headline_border_color', true);
       if(empty($staff_content_headline_border_color)){ $staff_content_headline_border_color = '#ae9982'; };

      };

?>
#page_header .headline_area { color:<?php echo esc_attr($page_header_color); ?>; }
#page_header .headline { font-size:<?php echo esc_attr($page_header_headline_font_size); ?>px; }
#page_header .sub_title { font-size:<?php echo esc_attr($page_header_sub_title_font_size); ?>px; }
#catch_area .catch { font-size:<?php echo esc_attr($page_header_catch_font_size); ?>px; color:<?php echo esc_attr($page_header_catch_font_color); ?>; }
#catch_area .desc { font-size:<?php echo esc_attr($page_header_desc_font_size); ?>px; }
#staff_list .title_area {
  background: -moz-linear-gradient(top,  rgba(0,0,0,0) 0%, rgba(<?php echo esc_attr($archive_staff_overlay_color); ?>,<?php echo esc_attr($archive_staff_overlay_opacity); ?>) 100%);
  background: -webkit-linear-gradient(top,  rgba(0,0,0,0) 0%,rgba(<?php echo esc_attr($archive_staff_overlay_color); ?>,<?php echo esc_attr($archive_staff_overlay_opacity); ?>) 100%);
  background: linear-gradient(to bottom,  rgba(0,0,0,0) 0%,rgba(<?php echo esc_attr($archive_staff_overlay_color); ?>,<?php echo esc_attr($archive_staff_overlay_opacity); ?>) 100%);
}
#staff_list .title { font-size:<?php echo esc_html($options['archive_staff_title_font_size']); ?>px; }
#staff_list .sub_title { font-size:<?php echo esc_html($options['archive_staff_sub_title_font_size']); ?>px; }
#staff_list .desc { font-size:<?php echo esc_html($options['archive_staff_desc_font_size']); ?>px; }
<?php if(is_singular('staff')){ ?>
#staff_single_desc .catch { font-size:<?php echo esc_attr($staff_catch_font_size); ?>px; color:<?php echo esc_attr($staff_catch_color); ?>; }
#staff_single_desc .desc { font-size:<?php echo esc_attr($staff_desc_font_size); ?>px; color:<?php echo esc_attr($staff_desc_color); ?>; }
#single_staff_list .headline_area .headline { font-size:<?php echo esc_html($options['single_staff_headline_font_size']); ?>px; color:<?php echo esc_html($options['single_staff_headline_font_color']); ?>; }
#single_staff_list .headline_area .sub_title { font-size:<?php echo esc_html($options['single_staff_sub_headline_font_size']); ?>px; color:<?php echo esc_html($options['single_staff_headline_font_color']); ?>; }
#single_staff_list .button a { color:<?php echo esc_html($options['single_staff_button_color']); ?>; border-color:<?php echo esc_html($options['single_staff_button_border_color']); ?>; }
#single_staff_list .button a:hover { color:<?php echo esc_html($options['single_staff_button_color_hover']); ?>; border-color:<?php echo esc_html($options['single_staff_button_border_color_hover']); ?>; background:<?php echo esc_html($options['single_staff_button_bg_color_hover']); ?>; }
#staff_banner_content a { color:<?php echo esc_html($options['single_staff_banner_title_color']); ?>; }
#staff_banner_content .banner_headline { font-size:<?php echo esc_html($options['single_staff_banner_title_font_size']); ?>px; }
#staff_banner_content .banner_headline span { font-size:<?php echo esc_html($options['single_staff_banner_sub_title_font_size']); ?>px; }
#staff_banner_content .banner_desc { font-size:<?php echo esc_html($options['single_staff_banner_desc_font_size']); ?>px; }
.staff_content .headline { color:<?php echo esc_html($staff_content_headline_font_color); ?>; border-top:3px solid <?php echo esc_html($staff_content_headline_border_color); ?>; font-size:<?php echo esc_html($staff_content_headline_font_size); ?>px; }
.staff_content .post_content { font-size:<?php echo esc_html($staff_content_desc_font_size); ?>px; }
<?php }; ?>
@media screen and (max-width:750px) {
  #page_header .headline { font-size:<?php echo esc_attr($page_header_headline_font_size_mobile); ?>px; }
  #page_header .sub_title { font-size:<?php echo esc_attr($page_header_sub_title_font_size_mobile); ?>px; }
  #catch_area .catch { font-size:<?php echo esc_attr($page_header_catch_font_size_mobile); ?>px; }
  #catch_area .desc { font-size:<?php echo esc_attr($page_header_desc_font_size_mobile); ?>px; }
  #staff_list .title { font-size:<?php echo esc_html($options['archive_staff_title_font_size_mobile']); ?>px; }
  #staff_list .sub_title { font-size:<?php echo esc_html($options['archive_staff_sub_title_font_size_mobile']); ?>px; }
  #staff_list .desc { font-size:<?php echo esc_html($options['archive_staff_desc_font_size_mobile']); ?>px; }
<?php if(is_singular('staff')){ ?>
  #staff_single_desc .catch { font-size:<?php echo esc_attr($staff_catch_font_size_mobile); ?>px; }
  #staff_single_desc .desc { font-size:<?php echo esc_attr($staff_desc_font_size_mobile); ?>px; }
  #single_staff_list .headline_area .headline { font-size:<?php echo esc_html($options['single_staff_headline_font_size_mobile']); ?>px; }
  #single_staff_list .headline_area .sub_title { font-size:<?php echo esc_html($options['single_staff_sub_headline_font_size_mobile']); ?>px; }
  #staff_banner_content .banner_headline { font-size:<?php echo esc_html($options['single_staff_banner_title_font_size_mobile']); ?>px; }
  #staff_banner_content .banner_headline span { font-size:<?php echo esc_html($options['single_staff_banner_sub_title_font_size_mobile']); ?>px; }
  #staff_banner_content .banner_desc { font-size:<?php echo esc_html($options['single_staff_banner_desc_font_size_mobile']); ?>px; }
  .staff_content .headline { font-size:<?php echo esc_html($staff_content_headline_font_size_mobile); ?>px; }
  .staff_content .post_content { font-size:<?php echo esc_html($staff_content_desc_font_size_mobile); ?>px; }
<?php }; ?>
}
<?php
     // トップページ -----------------------------------------------------------------------------
     } elseif(is_front_page()) {
       // 画像スライダー
       if($options['index_header_content_type'] == 'type1') {
         for($i=1; $i<= 3; $i++):
           $use_text_shadow = $options['index_slider_use_shadow'.$i];
           if($use_text_shadow) {
             $shadow1 = $options['index_slider_shadow_h'.$i];
             $shadow2 = $options['index_slider_shadow_v'.$i];
             $shadow3 = $options['index_slider_shadow_b'.$i];
             $shadow4 = $options['index_slider_shadow_c'.$i];
           };
           // キャッチフレーズ、説明文
?>
#index_slider .item<?php echo $i; ?> .catch { font-size:<?php echo esc_html($options['index_slider_catch_font_size'.$i]); ?>px; color:<?php echo esc_html($options['index_slider_catch_color'.$i]); ?>; <?php if($use_text_shadow) { ?>text-shadow:<?php echo esc_attr($shadow1); ?>px <?php echo esc_attr($shadow2); ?>px <?php echo esc_attr($shadow3); ?>px <?php echo esc_attr($shadow4); ?>;<?php }; ?> }
#index_slider .item<?php echo $i; ?> .desc { font-size:<?php echo esc_html($options['index_slider_desc_font_size'.$i]); ?>px; color:<?php echo esc_html($options['index_slider_desc_color'.$i]); ?>; <?php if($use_text_shadow) { ?>text-shadow:<?php echo esc_attr($shadow1); ?>px <?php echo esc_attr($shadow2); ?>px <?php echo esc_attr($shadow3); ?>px <?php echo esc_attr($shadow4); ?>;<?php }; ?> }
@media screen and (max-width:950px) {
  #index_slider .item<?php echo $i; ?> .catch { font-size:<?php echo esc_html($options['index_slider_catch_font_size_mobile'.$i]); ?>px; }
  #index_slider .item<?php echo $i; ?> .desc { font-size:<?php echo esc_html($options['index_slider_desc_font_size_mobile'.$i]); ?>px; }
}
<?php
     // ボタン
     if($options['index_slider_show_button'.$i]) {
       $index_slider_button_border_color = hex2rgb($options['index_slider_button_border_color'.$i]);
       $index_slider_button_border_color = implode(",",$index_slider_button_border_color);
?>
#index_slider .item<?php echo $i; ?> .button { color:<?php echo esc_html($options['index_slider_button_font_color'.$i]); ?>; border-color:rgba(<?php echo esc_html($index_slider_button_border_color); ?>,<?php echo esc_html($options['index_slider_button_border_opacity'.$i]); ?>); }
#index_slider .item<?php echo $i; ?> .button:hover { color:<?php echo esc_html($options['index_slider_button_font_color_hover'.$i]); ?>; border-color:<?php echo esc_html($options['index_slider_button_border_color_hover'.$i]); ?>; background:<?php echo esc_html($options['index_slider_button_bg_color_hover'.$i]); ?>; }
<?php
     };
     // オーバーレイ
     if($options['index_slider_use_overlay'.$i] || $options['index_slider_use_overlay_mobile'.$i]) {
       $overlay_color = hex2rgb($options['index_slider_overlay_color'.$i]);
       $overlay_color = implode(",",$overlay_color);
       $overlay_opacity = $options['index_slider_overlay_opacity'.$i];
       if(is_mobile() && $options['index_slider_use_overlay_mobile'.$i]) {
         $overlay_color = hex2rgb($options['index_slider_overlay_color_mobile'.$i]);
         $overlay_color = implode(",",$overlay_color);
         $overlay_opacity = $options['index_slider_overlay_opacity_mobile'.$i];
       }
?>
#index_slider .item<?php echo $i; ?> .overlay { background:rgba(<?php echo esc_html($overlay_color); ?>,<?php echo esc_html($overlay_opacity); ?>); }
<?php
       };
     endfor;
       // 画像スライダー　スマホ用　テキストシャドウ
       if($options['index_slider_mobile_content_type'] != 'type1') {
         $use_text_shadow = $options['index_slider_mobile_use_shadow'];
         if($use_text_shadow) {
           $shadow1 = $options['index_slider_mobile_shadow_h'];
           $shadow2 = $options['index_slider_mobile_shadow_v'];
           $shadow3 = $options['index_slider_mobile_shadow_b'];
           $shadow4 = $options['index_slider_mobile_shadow_c'];
         }
?>
#index_slider .caption.mobile .catch { font-size:<?php echo esc_attr($options['index_slider_mobile_catch_font_size']); ?>px; color:<?php echo esc_attr($options['index_slider_mobile_catch_color']); ?>; <?php if($use_text_shadow) { ?>text-shadow:<?php echo esc_attr($shadow1); ?>px <?php echo esc_attr($shadow2); ?>px <?php echo esc_attr($shadow3); ?>px <?php echo esc_attr($shadow4); ?>;<?php }; ?> }
#index_slider .caption.mobile .desc { font-size:<?php echo esc_attr($options['index_slider_mobile_desc_font_size']); ?>px; color:<?php echo esc_attr($options['index_slider_mobile_catch_color']); ?>; <?php if($use_text_shadow) { ?>text-shadow:<?php echo esc_attr($shadow1); ?>px <?php echo esc_attr($shadow2); ?>px <?php echo esc_attr($shadow3); ?>px <?php echo esc_attr($shadow4); ?>;<?php }; ?> }
<?php
     if($options['index_slider_mobile_show_button']) {
       $index_slider_mobile_button_border_color = hex2rgb($options['index_slider_mobile_button_border_color']);
       $index_slider_mobile_button_border_color = implode(",",$index_slider_mobile_button_border_color);
?>
#index_slider .caption.mobile .button { color:<?php echo esc_html($options['index_slider_mobile_button_font_color']); ?>; border-color:rgba(<?php echo esc_html($index_slider_mobile_button_border_color); ?>,<?php echo esc_html($options['index_slider_mobile_button_border_opacity']); ?>); }
#index_slider .caption.mobile .button:hover { color:<?php echo esc_html($options['index_slider_mobile_button_font_color_hover']); ?>; border-color:<?php echo esc_html($options['index_slider_mobile_button_border_color_hover']); ?>; background:<?php echo esc_html($options['index_slider_mobile_button_bg_color_hover']); ?>; }
<?php
     };

       };
     }; // END 画像スライダー

     // 動画 ---------------------------------------------------------------------------------------------------------------------------------------
     if($options['index_header_content_type'] == 'type2' || $options['index_header_content_type'] == 'type3') {
       $use_text_shadow = $options['index_movie_use_shadow'];
       if($use_text_shadow) {
         $shadow1 = $options['index_movie_shadow_h'];
         $shadow2 = $options['index_movie_shadow_v'];
         $shadow3 = $options['index_movie_shadow_b'];
         $shadow4 = $options['index_movie_shadow_c'];
       };
?>
#index_slider .catch { font-size:<?php echo esc_html($options['index_movie_catch_font_size']); ?>px; color:<?php echo esc_html($options['index_movie_catch_color']); ?>; <?php if($use_text_shadow) { ?>text-shadow:<?php echo esc_attr($shadow1); ?>px <?php echo esc_attr($shadow2); ?>px <?php echo esc_attr($shadow3); ?>px <?php echo esc_attr($shadow4); ?>;<?php }; ?> }
#index_slider .desc { font-size:<?php echo esc_html($options['index_movie_desc_font_size']); ?>px; color:<?php echo esc_html($options['index_movie_desc_color']); ?>; <?php if($use_text_shadow) { ?>text-shadow:<?php echo esc_attr($shadow1); ?>px <?php echo esc_attr($shadow2); ?>px <?php echo esc_attr($shadow3); ?>px <?php echo esc_attr($shadow4); ?>;<?php }; ?> }
<?php
     // ボタン
     if($options['index_movie_show_button']){
       $index_movie_button_border_color = hex2rgb($options['index_movie_button_border_color']);
       $index_movie_button_border_color = implode(",",$index_movie_button_border_color);
?>
#index_slider .button { color:<?php echo esc_html($options['index_movie_button_font_color']); ?>; border-color:rgba(<?php echo esc_html($index_movie_button_border_color); ?>,<?php echo esc_html($options['index_movie_button_border_opacity']); ?>); }
#index_slider .button:hover { color:<?php echo esc_html($options['index_movie_button_font_color_hover']); ?>; border-color:<?php echo esc_html($options['index_movie_button_border_color_hover']); ?>; background:<?php echo esc_html($options['index_movie_button_bg_color_hover']); ?>; }
<?php
     };
     // オーバーレイ
     if($options['index_movie_use_overlay']) {
       $overlay_color = hex2rgb($options['index_movie_overlay_color']);
       $overlay_color = implode(",",$overlay_color);
       $overlay_opacity = $options['index_movie_overlay_opacity'];
?>
#index_slider .overlay { background:rgba(<?php echo esc_html($overlay_color); ?>,<?php echo esc_html($overlay_opacity); ?>); }
<?php }; ?>
@media screen and (max-width:750px) {
  #index_slider .catch { font-size:<?php echo esc_html($options['index_movie_catch_font_size_mobile']); ?>px; }
  #index_slider .desc { font-size:<?php echo esc_html($options['index_movie_desc_font_size_mobile']); ?>px; }
}
<?php
     // モバイルサイズ時に別のコンテンツを表示する場合 ---------------
     if($options['index_movie_mobile_content_type'] == 'type2') {
       $use_text_shadow = $options['index_movie_use_shadow_mobile'];
       if($use_text_shadow) {
         $shadow1 = $options['index_movie_shadow_h_mobile'];
         $shadow2 = $options['index_movie_shadow_v_mobile'];
         $shadow3 = $options['index_movie_shadow_b_mobile'];
         $shadow4 = $options['index_movie_shadow_c_mobile'];
       };
?>
@media screen and (max-width:750px) {
  #index_slider .catch { font-size:<?php echo esc_html($options['index_movie_mobile_catch_font_size']); ?>px; color:<?php echo esc_html($options['index_movie_catch_color_mobile']); ?>; <?php if($use_text_shadow) { ?>text-shadow:<?php echo esc_attr($shadow1); ?>px <?php echo esc_attr($shadow2); ?>px <?php echo esc_attr($shadow3); ?>px <?php echo esc_attr($shadow4); ?>;<?php }; ?> }
}
<?php
       }; // END content type2
     }; // END 動画

     // ボックスコンテンツ -------------------------------------------------------------------------------------------------------------
       $image = wp_get_attachment_image_src( $options['index_box_content_image1'], 'full' );
       $index_box_content_title_bg_color = hex2rgb($options['index_box_content_title_bg_color']);
       $index_box_content_title_bg_color = implode(",",$index_box_content_title_bg_color);
       if($image) {
?>
#index_box_content .title { font-size:<?php echo esc_html($options['index_box_content_title_font_size']); ?>px; color:<?php echo esc_html($options['index_box_content_title_font_color']); ?>; background:rgba(<?php echo esc_html($index_box_content_title_bg_color); ?>,<?php echo esc_html($options['index_box_content_title_bg_opacity']); ?>); }
#index_box_content .desc { font-size:<?php echo esc_html($options['index_box_content_desc_font_size']); ?>px; }
@media screen and (max-width:750px) {
  #index_box_content .title { font-size:<?php echo esc_html($options['index_box_content_title_font_size_mobile']); ?>px; }
  #index_box_content .desc { font-size:<?php echo esc_html($options['index_box_content_desc_font_size_mobile']); ?>px; }
}
<?php
       }

     // コンテンツビルダー -------------------------------------------------------------------------------------------------------------
     if (!empty($options['contents_builder'])) :
       $content_count = 1;
       foreach($options['contents_builder'] as $content) :

         // デザインコンテンツ１
         if ( ($content['cb_content_select'] == 'design_content1') && $content['show_dc1'] ) {
?>
.index_design_content1.num<?php echo $content_count; ?> .catch { font-size:<?php echo esc_html($content['dc1_catch_font_size']); ?>px; color:<?php echo esc_attr($content['dc1_catch_font_color']); ?>; }
.index_design_content1.num<?php echo $content_count; ?> .desc { font-size:<?php echo esc_html($content['dc1_desc_font_size']); ?>px; }
.index_design_content1.num<?php echo $content_count; ?> .button a { color:<?php echo esc_attr($content['dc1_button_font_color']); ?>; border-color:<?php echo esc_attr($content['dc1_button_border_color']); ?>; }
.index_design_content1.num<?php echo $content_count; ?> .button a:hover { color:<?php echo esc_attr($content['dc1_button_font_color_hover']); ?>; background:<?php echo esc_attr($content['dc1_button_bg_color_hover']); ?>; border-color:<?php echo esc_attr($content['dc1_button_border_color_hover']); ?>; }
@media screen and (max-width:750px) {
  .index_design_content1.num<?php echo $content_count; ?> .catch { font-size:<?php echo esc_html($content['dc1_catch_font_size_mobile']); ?>px; }
  .index_design_content1.num<?php echo $content_count; ?> .desc { font-size:<?php echo esc_html($content['dc1_desc_font_size_mobile']); ?>px; }
}
<?php
     // デザインコンテンツ２
     } elseif ( ($content['cb_content_select'] == 'design_content2') && $content['show_dc2'] ) {
?>
.index_design_content2.num<?php echo $content_count; ?> .catch { font-size:<?php echo esc_html($content['dc2_catch_font_size']); ?>px; color:<?php echo esc_attr($content['dc2_catch_font_color']); ?>; }
.index_design_content2.num<?php echo $content_count; ?> .desc { font-size:<?php echo esc_html($content['dc2_desc_font_size']); ?>px; }
.index_design_content2.num<?php echo $content_count; ?> .banner_content a { color:<?php echo esc_attr($content['dc2_banner_font_color']); ?>; }
.index_design_content2.num<?php echo $content_count; ?> .banner_headline { font-size:<?php echo esc_html($content['dc2_banner_headline_font_size']); ?>px; }
.index_design_content2.num<?php echo $content_count; ?> .banner_headline span { font-size:<?php echo esc_html($content['dc2_banner_sub_title_font_size']); ?>px; }
.index_design_content2.num<?php echo $content_count; ?> .banner_desc { font-size:<?php echo esc_html($content['dc2_banner_desc_font_size']); ?>px; }
@media screen and (max-width:750px) {
  .index_design_content2.num<?php echo $content_count; ?> .catch { font-size:<?php echo esc_html($content['dc2_catch_font_size_mobile']); ?>px; }
  .index_design_content2.num<?php echo $content_count; ?> .desc { font-size:<?php echo esc_html($content['dc2_desc_font_size_mobile']); ?>px; }
  .index_design_content2.num<?php echo $content_count; ?> .banner_headline { font-size:<?php echo esc_html($content['dc2_banner_headline_font_size_mobile']); ?>px; }
  .index_design_content2.num<?php echo $content_count; ?> .banner_headline span { font-size:<?php echo esc_html($content['dc2_banner_sub_title_font_size_mobile']); ?>px; }
  .index_design_content2.num<?php echo $content_count; ?> .banner_desc { font-size:<?php echo esc_html($content['dc2_banner_desc_font_size_mobile']); ?>px; }
}
<?php
     // キャンペーン一覧
     } elseif ( ($content['cb_content_select'] == 'campaign_list') && $content['show_campaign'] ) {
       $campaign_border_color = hex2rgb($content['campaign_border_color']);
       $campaign_border_color = implode(",",$campaign_border_color);
       $campaign_button_border_color = hex2rgb($content['campaign_button_border_color']);
       $campaign_button_border_color = implode(",",$campaign_button_border_color);
       if($content['campaign_use_overlay']) {
         $campaign_overlay_color = hex2rgb($content['campaign_overlay_color']);
         $campaign_overlay_color = implode(",",$campaign_overlay_color);
         $campaign_overlay_opacity = $content['campaign_overlay_opacity'];
       }
?>
.index_campaign.num<?php echo $content_count; ?> .headline { font-size:<?php echo esc_html($content['campaign_headline_font_size']); ?>px; color:<?php echo esc_attr($content['campaign_headline_font_color']); ?>; }
.index_campaign.num<?php echo $content_count; ?> .index_campaign_slider { border-color:rgba(<?php echo esc_html($campaign_border_color); ?>,<?php echo esc_html($content['campaign_border_color_opacity']); ?>); }
.index_campaign.num<?php echo $content_count; ?> .index_campaign_slider .item { border-color:rgba(<?php echo esc_html($campaign_border_color); ?>,<?php echo esc_html($content['campaign_border_color_opacity']); ?>); }
.index_campaign.num<?php echo $content_count; ?> .index_campaign_slider .item a { font-size:<?php echo esc_html($content['campaign_title_font_size']); ?>px; color:<?php echo esc_attr($content['campaign_title_font_color']); ?>; }
.index_campaign.num<?php echo $content_count; ?> .button a { color:<?php echo esc_attr($content['campaign_button_font_color']); ?>; border-color:rgba(<?php echo esc_html($campaign_button_border_color); ?>,<?php echo esc_html($content['campaign_button_border_opacity']); ?>); }
.index_campaign.num<?php echo $content_count; ?> .button a:hover { color:<?php echo esc_attr($content['campaign_button_font_color_hover']); ?>; background:<?php echo esc_attr($content['campaign_button_bg_color_hover']); ?>; border-color:<?php echo esc_attr($content['campaign_button_border_color_hover']); ?>; }
<?php if($content['campaign_use_overlay']) { ?>
.index_campaign.num<?php echo $content_count; ?> .overlay { background:rgba(<?php echo esc_html($campaign_overlay_color); ?>,<?php echo esc_html($campaign_overlay_opacity); ?>); }
<?php }; ?>
@media screen and (max-width:750px) {
  .index_campaign.num<?php echo $content_count; ?> .headline { font-size:<?php echo esc_html($content['campaign_headline_font_size_mobile']); ?>px; }
  .index_campaign.num<?php echo $content_count; ?> .index_campaign_slider .title a { font-size:<?php echo esc_html($content['campaign_title_font_size_mobile']); ?>px; }
}
<?php
     // 新着ブログ
     } elseif ( ($content['cb_content_select'] == 'recent_blog_list') && $content['show_blog'] ) {
?>
.index_blog.num<?php echo $content_count; ?> .headline { font-size:<?php echo esc_html($content['recent_blog_headline_font_size']); ?>px; color:<?php echo esc_attr($content['recent_blog_headline_font_color']); ?>; }
.index_blog.num<?php echo $content_count; ?> .headline span { font-size:<?php echo esc_html($content['recent_blog_sub_title_font_size']); ?>px; }
.index_blog.num<?php echo $content_count; ?> .title { font-size:<?php echo esc_attr($content['recent_blog_title_font_size']); ?>px; }
.index_blog.num<?php echo $content_count; ?> .button a { color:<?php echo esc_attr($content['recent_blog_button_font_color']); ?>; border-color:<?php echo esc_attr($content['recent_blog_button_border_color']); ?>; }
.index_blog.num<?php echo $content_count; ?> .button a:hover { color:<?php echo esc_attr($content['recent_blog_button_font_color_hover']); ?>; background:<?php echo esc_attr($content['recent_blog_button_bg_color_hover']); ?>; border-color:<?php echo esc_attr($content['recent_blog_button_border_color_hover']); ?>; }
@media screen and (max-width:750px) {
  .index_blog.num<?php echo $content_count; ?> .headline { font-size:<?php echo esc_html($content['recent_blog_headline_font_size_mobile']); ?>px; }
  .index_blog.num<?php echo $content_count; ?> .headline span { font-size:<?php echo esc_html($content['recent_blog_sub_title_font_size_mobile']); ?>px; }
  .index_blog.num<?php echo $content_count; ?> .title { font-size:<?php echo esc_attr($content['recent_blog_title_font_size_mobile']); ?>px; }
}
<?php
     // お知らせ
     } elseif ( ($content['cb_content_select'] == 'news_list') && $content['show_news'] ) {
?>
.index_news.num<?php echo $content_count; ?> .headline { font-size:<?php echo esc_html($content['news_headline_font_size']); ?>px; color:<?php echo esc_attr($content['news_headline_font_color']); ?>; }
.index_news.num<?php echo $content_count; ?> .headline span { font-size:<?php echo esc_html($content['news_sub_title_font_size']); ?>px; }
.index_news.num<?php echo $content_count; ?> .button a { color:<?php echo esc_attr($content['news_button_font_color']); ?>; border-color:<?php echo esc_attr($content['news_button_border_color']); ?>; }
.index_news.num<?php echo $content_count; ?> .button a:hover { color:<?php echo esc_attr($content['news_button_font_color_hover']); ?>; background:<?php echo esc_attr($content['news_button_bg_color_hover']); ?>; border-color:<?php echo esc_attr($content['news_button_border_color_hover']); ?>; }
@media screen and (max-width:750px) {
  .index_news.num<?php echo $content_count; ?> .headline { font-size:<?php echo esc_html($content['news_headline_font_size_mobile']); ?>px; }
  .index_news.num<?php echo $content_count; ?> .headline span { font-size:<?php echo esc_html($content['news_sub_title_font_size_mobile']); ?>px; }
}
<?php
     };
       $content_count++;
       endforeach;
     endif; // END コンテンツビルダーここまで

     // ブログ -----------------------------------------------------------------------------
     } elseif(is_archive() || is_home() || is_search() || is_single() ) {
?>
#page_header .headline { color:<?php echo esc_html($options['blog_title_color']); ?>; }
#page_header .headline { font-size:<?php echo esc_html($options['blog_title_font_size']); ?>px; }
#catch_area .catch { font-size:<?php echo esc_html($options['blog_catch_font_size']); ?>px; color:<?php echo esc_html($options['blog_catch_font_color']); ?>; }
#catch_area .desc { font-size:<?php echo esc_html($options['blog_desc_font_size']); ?>px; }
.blog_list .title { font-size:<?php echo esc_html($options['archive_blog_title_font_size']); ?>px; }
#post_title_area .title { font-size:<?php echo esc_html($options['single_blog_title_font_size']); ?>px; }
#article .post_content { font-size:<?php echo esc_html($options['single_blog_content_font_size']); ?>px; }
#related_post .headline, #comments .headline { font-size:<?php echo esc_html($options['related_post_headline_font_size']); ?>px; color:<?php echo esc_attr($options['related_post_headline_font_color']); ?>; background:<?php echo esc_attr($options['related_post_headline_bg_color']); ?>; }
@media screen and (max-width:750px) {
  #page_header .headline { font-size:<?php echo esc_html($options['blog_title_font_size_mobile']); ?>px; }
  #page_header .sub_title { font-size:<?php echo esc_html($options['blog_sub_title_font_size_mobile']); ?>px; }
  #catch_area .catch { font-size:<?php echo esc_html($options['blog_catch_font_size_mobile']); ?>px; }
  #catch_area .desc { font-size:<?php echo esc_html($options['blog_desc_font_size_mobile']); ?>px; }
  .blog_list .title { font-size:<?php echo esc_html($options['archive_blog_title_font_size_mobile']); ?>px; }
  #post_title_area .title { font-size:<?php echo esc_html($options['single_blog_title_font_size_mobile']); ?>px; }
  #article .post_content { font-size:<?php echo esc_html($options['single_blog_content_font_size_mobile']); ?>px; }
  #related_post .headline, #comments .headline { font-size:<?php echo esc_html($options['related_post_headline_font_size_mobile']); ?>px; }
}
<?php
     // スケジュールページ --------------------------------------------------------------------
     } elseif(is_page_template('page-schedule.php')) {

      $archive_staff_overlay_color = hex2rgb($options['archive_staff_overlay_color']);
      $archive_staff_overlay_color = implode(",",$archive_staff_overlay_color);
      $archive_staff_overlay_opacity = $options['archive_staff_overlay_opacity'];

       global $post;

       $schedule_header_font_color = get_post_meta($post->ID, 'schedule_header_font_color', true);
         if(empty($schedule_header_font_color)){ $schedule_header_font_color = '#ffffff'; }
       $schedule_header_title_font_size = get_post_meta($post->ID, 'schedule_header_title_font_size', true);
         if(empty($schedule_header_title_font_size)){ $schedule_header_title_font_size = '38'; }
       $schedule_header_title_font_size_mobile = get_post_meta($post->ID, 'schedule_header_title_font_size_mobile', true);
         if(empty($schedule_header_title_font_size_mobile)){ $schedule_header_title_font_size_mobile = '20'; }
       $schedule_header_sub_title_font_size = get_post_meta($post->ID, 'schedule_header_sub_title_font_size', true);
         if(empty($schedule_header_sub_title_font_size)){ $schedule_header_sub_title_font_size = '18'; }
       $schedule_header_sub_title_font_size_mobile = get_post_meta($post->ID, 'schedule_header_sub_title_font_size_mobile', true);
         if(empty($schedule_header_sub_title_font_size_mobile)){ $schedule_header_sub_title_font_size_mobile = '15'; }

       $schedule_catch_font_size = get_post_meta($post->ID, 'schedule_catch_font_size', true);
         if(empty($schedule_catch_font_size)){ $schedule_catch_font_size = '38'; }
       $schedule_catch_font_size_mobile = get_post_meta($post->ID, 'schedule_catch_font_size_mobile', true);
         if(empty($schedule_catch_font_size_mobile)){ $schedule_catch_font_size_mobile = '20'; }
       $schedule_catch_font_color = get_post_meta($post->ID, 'schedule_catch_font_color', true);
         if(empty($schedule_catch_font_color)){ $schedule_catch_font_color = '#593306'; }
       $schedule_desc_font_size = get_post_meta($post->ID, 'schedule_desc_font_size', true);
         if(empty($schedule_desc_font_size)){ $schedule_desc_font_size = '16'; }
       $schedule_desc_font_size_mobile = get_post_meta($post->ID, 'schedule_desc_font_size_mobile', true);
         if(empty($schedule_desc_font_size_mobile)){ $schedule_desc_font_size_mobile = '14'; }

       $staff_schedule_header_font_color = get_post_meta($post->ID, 'staff_schedule_header_font_color', true);
         if(empty($staff_schedule_header_font_color)){ $staff_schedule_header_font_color = '#ffffff'; };
       $staff_schedule_header_bg_color = get_post_meta($post->ID, 'staff_schedule_header_bg_color', true);
         if(empty($staff_schedule_header_bg_color)){ $staff_schedule_header_bg_color = '#ad9983'; };

       $schedule_banner_title_font_size = get_post_meta($post->ID, 'schedule_banner_title_font_size', true);
         if(empty($schedule_banner_title_font_size)){ $schedule_banner_title_font_size = '38'; }
       $schedule_banner_title_font_size_mobile = get_post_meta($post->ID, 'schedule_banner_title_font_size_mobile', true);
         if(empty($schedule_banner_title_font_size_mobile)){ $schedule_banner_title_font_size_mobile = '20'; }
       $schedule_banner_sub_title_font_size = get_post_meta($post->ID, 'schedule_banner_sub_title_font_size', true);
         if(empty($schedule_banner_sub_title_font_size)){ $schedule_banner_sub_title_font_size = '18'; }
       $schedule_banner_sub_title_font_size_mobile = get_post_meta($post->ID, 'schedule_banner_sub_title_font_size_mobile', true);
         if(empty($schedule_banner_sub_title_font_size_mobile)){ $schedule_banner_sub_title_font_size_mobile = '15'; }
       $schedule_banner_desc_font_size = get_post_meta($post->ID, 'schedule_banner_desc_font_size', true);
         if(empty($schedule_banner_desc_font_size)){ $schedule_banner_desc_font_size = '16'; }
       $schedule_banner_desc_font_size_mobile = get_post_meta($post->ID, 'schedule_banner_desc_font_size_mobile', true);
         if(empty($schedule_banner_desc_font_size_mobile)){ $schedule_banner_desc_font_size_mobile = '14'; }
       $schedule_banner_title_color = get_post_meta($post->ID, 'schedule_banner_title_color', true);
         if(empty($schedule_banner_title_color)){ $schedule_banner_title_color = '#ffffff'; }
?>
#page_header .headline_area { color:<?php echo esc_attr($schedule_header_font_color); ?>; }
#page_header .headline { font-size:<?php echo esc_attr($schedule_header_title_font_size); ?>px; }
#page_header .sub_title { font-size:<?php echo esc_attr($schedule_header_sub_title_font_size); ?>px; }
#catch_area .catch { font-size:<?php echo esc_attr($schedule_catch_font_size); ?>px; color:<?php echo esc_attr($schedule_catch_font_color); ?>; }
#catch_area .desc { font-size:<?php echo esc_attr($schedule_desc_font_size); ?>px; }
#schedule_list_header, #schedule_list_headline_mobile, #schedule_list_headline_mobile a:before { color:<?php echo esc_html($staff_schedule_header_font_color); ?>; background:<?php echo esc_html($staff_schedule_header_bg_color); ?>; }
#staff_banner_content a { color:<?php echo esc_html($schedule_banner_title_color); ?>; }
#staff_banner_content .banner_headline { font-size:<?php echo esc_html($schedule_banner_title_font_size); ?>px; }
#staff_banner_content .banner_headline span { font-size:<?php echo esc_html($schedule_banner_sub_title_font_size); ?>px; }
#staff_banner_content .banner_desc { font-size:<?php echo esc_html($schedule_banner_desc_font_size); ?>px; }
#schedule_list .title {
  background: -moz-linear-gradient(top,  rgba(0,0,0,0) 0%, rgba(<?php echo esc_attr($archive_staff_overlay_color); ?>,<?php echo esc_attr($archive_staff_overlay_opacity); ?>) 100%);
  background: -webkit-linear-gradient(top,  rgba(0,0,0,0) 0%,rgba(<?php echo esc_attr($archive_staff_overlay_color); ?>,<?php echo esc_attr($archive_staff_overlay_opacity); ?>) 100%);
  background: linear-gradient(to bottom,  rgba(0,0,0,0) 0%,rgba(<?php echo esc_attr($archive_staff_overlay_color); ?>,<?php echo esc_attr($archive_staff_overlay_opacity); ?>) 100%);
}
@media screen and (max-width:750px) {
  #page_header .headline { font-size:<?php echo esc_attr($schedule_header_title_font_size_mobile); ?>px; }
  #page_header .sub_title { font-size:<?php echo esc_attr($schedule_header_sub_title_font_size_mobile); ?>px; }
  #catch_area .catch { font-size:<?php echo esc_attr($schedule_catch_font_size_mobile); ?>px; }
  #catch_area .desc { font-size:<?php echo esc_attr($schedule_desc_font_size_mobile); ?>px; }
  #staff_banner_content .banner_headline { font-size:<?php echo esc_html($schedule_banner_title_font_size_mobile); ?>px; }
  #staff_banner_content .banner_headline span { font-size:<?php echo esc_html($schedule_banner_sub_title_font_size_mobile); ?>px; }
  #staff_banner_content .banner_desc { font-size:<?php echo esc_html($schedule_banner_desc_font_size_mobile); ?>px; }
}
<?php
     // ABOUTページ --------------------------------------------------------------------
     } elseif(is_page_template('page-lp.php')) {

       global $post;

       $lp_header_title_font_size = get_post_meta($post->ID, 'lp_header_title_font_size', true) ? esc_html( get_post_meta($post->ID, 'lp_header_title_font_size', true) ) : '38';
       $lp_header_title_font_size_mobile = get_post_meta($post->ID, 'lp_header_title_font_size_mobile', true) ? esc_html( get_post_meta($post->ID, 'lp_header_title_font_size_mobile', true) ) : '20';
       $lp_header_sub_title_font_size = get_post_meta($post->ID, 'lp_header_sub_title_font_size', true) ? esc_html( get_post_meta($post->ID, 'lp_header_sub_title_font_size', true) ) : '18';
       $lp_header_sub_title_font_size_mobile = get_post_meta($post->ID, 'lp_header_sub_title_font_size_mobile', true) ? esc_html( get_post_meta($post->ID, 'lp_header_sub_title_font_size_mobile', true) ) : '15';
       $lp_header_font_color = get_post_meta($post->ID, 'lp_header_font_color', true) ? esc_html( get_post_meta($post->ID, 'lp_header_font_color', true) ) : '#ffffff';
?>
#page_header .headline_area { color:<?php echo esc_attr($lp_header_font_color); ?>; }
#page_header .headline { font-size:<?php echo esc_attr($lp_header_title_font_size); ?>px; }
#page_header .sub_title { font-size:<?php echo esc_attr($lp_header_sub_title_font_size); ?>px; }
@media screen and (max-width:750px) {
  #page_header .headline { font-size:<?php echo esc_attr($lp_header_title_font_size_mobile); ?>px; }
  #page_header .sub_title { font-size:<?php echo esc_attr($lp_header_sub_title_font_size_mobile); ?>px; }
}
<?php
     $lp_content = get_post_meta( $post->ID, 'lp_content', true );
     if ( $lp_content && is_array( $lp_content ) ) :
       foreach( $lp_content as $key => $content ) :

       // コンテンツ１ -----------------------------------------------------------------
       if ( ($content['cb_content_select'] == 'content1') && $content['show_content']) {
         $headline_font_size = $content['headline_font_size'] ? esc_html( $content['headline_font_size'] ) : '48';
         $headline_font_size_mobile = $content['headline_font_size_mobile'] ? esc_html( $content['headline_font_size_mobile'] ) : '24';
         $headline_font_color = $content['headline_font_color'] ? esc_html( $content['headline_font_color'] ) : '#58330d';
         $sub_headline_font_size = $content['sub_headline_font_size'] ? esc_html( $content['sub_headline_font_size'] ) : '18';
         $sub_headline_font_size_mobile = $content['sub_headline_font_size_mobile'] ? esc_html( $content['sub_headline_font_size_mobile'] ) : '15';
         $catch_font_size = $content['catch_font_size'] ? esc_html( $content['catch_font_size'] ) : '38';
         $catch_font_size_mobile = $content['catch_font_size_mobile'] ? esc_html( $content['catch_font_size_mobile'] ) : '20';
         $catch_font_color = $content['catch_font_color'] ? esc_html( $content['catch_font_color'] ) : '#58330d';
         $desc_font_size = $content['desc_font_size'] ? esc_html( $content['desc_font_size'] ) : '16';
         $desc_font_size_mobile = $content['desc_font_size_mobile'] ? esc_html( $content['desc_font_size_mobile'] ) : '14';
?>
.about_content1.num<?php echo esc_attr($key); ?> .headline { font-size:<?php echo $headline_font_size; ?>px; color:<?php echo $headline_font_color; ?>; }
.about_content1.num<?php echo esc_attr($key); ?> .headline span { font-size:<?php echo $sub_headline_font_size; ?>px; }
.about_content1.num<?php echo esc_attr($key); ?> .catch { font-size:<?php echo $catch_font_size; ?>px; color:<?php echo $catch_font_color; ?>; }
.about_content1.num<?php echo esc_attr($key); ?> .content_area .post_content { font-size:<?php echo esc_attr($desc_font_size); ?>px; }
@media screen and (max-width:750px) {
  .about_content1.num<?php echo esc_attr($key); ?> .headline { font-size:<?php echo $headline_font_size_mobile; ?>px; }
  .about_content1.num<?php echo esc_attr($key); ?> .headline span { font-size:<?php echo $sub_headline_font_size_mobile; ?>px; }
  .about_content1.num<?php echo esc_attr($key); ?> .catch { font-size:<?php echo $catch_font_size_mobile; ?>px; }
  .about_content1.num<?php echo esc_attr($key); ?> .content_area .post_content { font-size:<?php echo esc_attr($desc_font_size_mobile); ?>px; }
}
<?php
       // コンテンツ２ -----------------------------------------------------------------
       } elseif ( ($content['cb_content_select'] == 'content2') && $content['show_content']) {
         $headline_font_size = $content['headline_font_size'] ? esc_html( $content['headline_font_size'] ) : '48';
         $headline_font_size_mobile = $content['headline_font_size_mobile'] ? esc_html( $content['headline_font_size_mobile'] ) : '24';
         $headline_font_color = $content['headline_font_color'] ? esc_html( $content['headline_font_color'] ) : '#58330d';
         $sub_headline_font_size = $content['sub_headline_font_size'] ? esc_html( $content['sub_headline_font_size'] ) : '18';
         $sub_headline_font_size_mobile = $content['sub_headline_font_size_mobile'] ? esc_html( $content['sub_headline_font_size_mobile'] ) : '15';
         $catch_font_size = $content['catch_font_size'] ? esc_html( $content['catch_font_size'] ) : '38';
         $catch_font_size_mobile = $content['catch_font_size_mobile'] ? esc_html( $content['catch_font_size_mobile'] ) : '20';
         $catch_font_color = $content['catch_font_color'] ? esc_html( $content['catch_font_color'] ) : '#58330d';
         $desc_font_size = $content['desc_font_size'] ? esc_html( $content['desc_font_size'] ) : '16';
         $desc_font_size_mobile = $content['desc_font_size_mobile'] ? esc_html( $content['desc_font_size_mobile'] ) : '14';

         $access_button_font_color = $content['access_button_font_color'] ? esc_html( $content['access_button_font_color'] ) : '#5b3401';
         $access_button_bg_color = $content['access_button_bg_color'] ? esc_html( $content['access_button_bg_color'] ) : '#ffffff';
         $access_button_border_color = $content['access_button_border_color'] ? esc_html( $content['access_button_border_color'] ) : '#5b3401';
         $access_button_font_color_hover = $content['access_button_font_color_hover'] ? esc_html( $content['access_button_font_color_hover'] ) : '#ffffff';
         $access_button_bg_color_hover = $content['access_button_bg_color_hover'] ? esc_html( $content['access_button_bg_color_hover'] ) : '#5b3401';
         $access_button_border_color_hover = $content['access_button_border_color_hover'] ? esc_html( $content['access_button_border_color_hover'] ) : '#5b3401';

         $access_date_headline_color = $content['access_date_headline_color'] ? esc_html( $content['access_date_headline_color'] ) : '#593300';
         $access_tel_color = $content['access_tel_color'] ? esc_html( $content['access_tel_color'] ) : '#593300';

         $gmap_marker_color = $content['gmap_marker_color'] ? esc_html( $content['gmap_marker_color'] ) : '#ffffff';
         $gmap_marker_bg = $content['gmap_marker_bg'] ? esc_html( $content['gmap_marker_bg'] ) : '#000000';


?>
.about_content2.num<?php echo esc_attr($key); ?> .headline { font-size:<?php echo $headline_font_size; ?>px; color:<?php echo $headline_font_color; ?>; }
.about_content2.num<?php echo esc_attr($key); ?> .headline span { font-size:<?php echo $sub_headline_font_size; ?>px; }
.about_content2.num<?php echo esc_attr($key); ?> .catch { font-size:<?php echo $catch_font_size; ?>px; color:<?php echo $catch_font_color; ?>; }
.about_content2.num<?php echo esc_attr($key); ?> .content_area .post_content,
.about_content2.num<?php echo esc_attr($key); ?> .access_data .desc,
.about_content2.num<?php echo esc_attr($key); ?> .access_date_info,
.about_content2.num<?php echo esc_attr($key); ?> .access_tel_info { font-size:<?php echo esc_attr($desc_font_size); ?>px; }
.about_content2.num<?php echo esc_attr($key); ?> .access_data .link_button a { color:<?php echo esc_attr($access_button_font_color); ?>; border-color:<?php echo esc_attr($access_button_border_color); ?>; background:<?php echo esc_attr($access_button_bg_color); ?>;  }
.about_content2.num<?php echo esc_attr($key); ?> .access_data .link_button a:hover { color:<?php echo esc_attr($access_button_font_color_hover); ?>; border-color:<?php echo esc_attr($access_button_border_color_hover); ?>; background:<?php echo esc_attr($access_button_bg_color_hover); ?>; }
.about_content2.num<?php echo esc_attr($key); ?> .access_date_info .sub_headline { color:<?php echo $access_date_headline_color; ?>; }
.about_content2.num<?php echo esc_attr($key); ?> .access_tel_info,
.about_content2.num<?php echo esc_attr($key); ?> .access_tel_info a[href^=tel] { color:<?php echo esc_attr($access_tel_color); ?>; }
.about_content2.num<?php echo esc_attr($key); ?> .access_google_map .pb_googlemap_custom-overlay-inner { background:<?php echo $gmap_marker_bg; ?>; color:<?php echo $gmap_marker_color; ?>; }
.about_content2.num<?php echo esc_attr($key); ?> .access_google_map .pb_googlemap_custom-overlay-inner::after { border-color:<?php echo $gmap_marker_bg; ?> transparent transparent transparent; }
@media screen and (max-width:750px) {
  .about_content2.num<?php echo esc_attr($key); ?> .headline { font-size:<?php echo $headline_font_size_mobile; ?>px; }
  .about_content2.num<?php echo esc_attr($key); ?> .headline span { font-size:<?php echo $sub_headline_font_size_mobile; ?>px; }
  .about_content2.num<?php echo esc_attr($key); ?> .catch { font-size:<?php echo $catch_font_size_mobile; ?>px; }
  .about_content2.num<?php echo esc_attr($key); ?> .content_area .post_content,
  .about_content2.num<?php echo esc_attr($key); ?> .access_data .desc,
  .about_content2.num<?php echo esc_attr($key); ?> .access_date_info,
  .about_content2.num<?php echo esc_attr($key); ?> .access_tel_info { font-size:<?php echo esc_attr($desc_font_size_mobile); ?>px; }
}
<?php
       // コンテンツ３ -----------------------------------------------------------------
       } elseif ( ($content['cb_content_select'] == 'content3') && $content['show_content']) {
         $catch_font_size = $content['catch_font_size'] ? esc_html( $content['catch_font_size'] ) : '38';
         $catch_font_size_mobile = $content['catch_font_size_mobile'] ? esc_html( $content['catch_font_size_mobile'] ) : '20';
         $catch_font_color = $content['catch_font_color'] ? esc_html( $content['catch_font_color'] ) : '#58330d';
         $desc_font_size = $content['desc_font_size'] ? esc_html( $content['desc_font_size'] ) : '16';
         $desc_font_size_mobile = $content['desc_font_size_mobile'] ? esc_html( $content['desc_font_size_mobile'] ) : '14';
?>
.about_content3.num<?php echo esc_attr($key); ?> .catch { font-size:<?php echo $catch_font_size; ?>px; color:<?php echo $catch_font_color; ?>; }
.about_content3.num<?php echo esc_attr($key); ?> .content_area .post_content { font-size:<?php echo esc_attr($desc_font_size); ?>px; }
@media screen and (max-width:750px) {
  .about_content3.num<?php echo esc_attr($key); ?> .catch { font-size:<?php echo $catch_font_size_mobile; ?>px; }
  .about_content3.num<?php echo esc_attr($key); ?> .content_area .post_content { font-size:<?php echo esc_attr($desc_font_size_mobile); ?>px; }
}
<?php
         };
       endforeach;
     endif; // END コンテンツビルダー
?>
<?php
     // 固定ページ --------------------------------------------------------------------
     } elseif(is_page()) {

       global $post;

       $page_title_font_size = get_post_meta($post->ID, 'page_title_font_size', true);
         if(empty($page_title_font_size)){ $page_title_font_size = '38'; }
       $page_title_font_size_mobile = get_post_meta($post->ID, 'page_title_font_size_mobile', true);
         if(empty($page_title_font_size_mobile)){ $page_title_font_size_mobile = '20'; }
       $page_sub_title_font_size = get_post_meta($post->ID, 'page_sub_title_font_size', true);
         if(empty($page_sub_title_font_size)){ $page_sub_title_font_size = '18'; }
       $page_sub_title_font_size_mobile = get_post_meta($post->ID, 'page_sub_title_font_size_mobile', true);
         if(empty($page_sub_title_font_size_mobile)){ $page_sub_title_font_size_mobile = '13'; }
       $page_font_color = get_post_meta($post->ID, 'page_font_color', true);
         if(empty($page_font_color)){ $page_font_color = '#ffffff'; }
?>
#page_header .headline { font-size:<?php echo esc_html($page_title_font_size); ?>px; color:<?php echo $page_font_color; ?>; }
#page_header .sub_title { font-size:<?php echo esc_html($page_sub_title_font_size); ?>px; color:<?php echo $page_font_color; ?>; }
#article .post_content { font-size:<?php echo esc_html($options['single_blog_content_font_size']); ?>px; }
@media screen and (max-width:750px) {
  #page_header .headline { font-size:<?php echo esc_html($page_title_font_size_mobile); ?>px; }
  #page_header .sub_title { font-size:<?php echo esc_html($page_sub_title_font_size_mobile); ?>px; }
  #article .post_content { font-size:<?php echo esc_html($options['single_blog_content_font_size_mobile']); ?>px; }
}
<?php
     // 404ページ -----------------------------------------------------------------------------
     } elseif( is_404()) {
       $title_font_size_pc = ( ! empty( $options['header_txt_size_404'] ) ) ? $options['header_txt_size_404'] : 38;
       $sub_title_font_size_pc = ( ! empty( $options['header_sub_txt_size_404'] ) ) ? $options['header_sub_txt_size_404'] : 16;
       $title_font_size_mobile = ( ! empty( $options['header_txt_size_404_mobile'] ) ) ? $options['header_txt_size_404_mobile'] : 28;
       $sub_title_font_size_mobile = ( ! empty( $options['header_sub_txt_size_404_mobile'] ) ) ? $options['header_sub_txt_size_404_mobile'] : 14;
?>
#page_404_header .catch { font-size:<?php echo esc_html($title_font_size_pc); ?>px; }
#page_404_header .desc { font-size:<?php echo esc_html($sub_title_font_size_pc); ?>px; }
@media screen and (max-width:750px) {
  #page_404_header .catch { font-size:<?php echo esc_html($title_font_size_mobile); ?>px; }
  #page_404_header .desc { font-size:<?php echo esc_html($sub_title_font_size_mobile); ?>px; }
}
<?php
     }; //END page setting
?>

<?php
     // サムネイルのアニメーション設定　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
     if($options['hover_type']!="type4"){

       // ズーム ------------------------------------------------------------------------------
       if($options['hover_type']=="type1"){
?>
.author_profile a.avatar img, .animate_image img, .animate_background .image, #recipe_archive .blur_image {
  width:100%; height:auto;
  -webkit-transition: transform  0.75s ease;
  transition: transform  0.75s ease;
}
.author_profile a.avatar:hover img, .animate_image:hover img, .animate_background:hover .image, #recipe_archive a:hover .blur_image {
  -webkit-transform: scale(<?php echo $options['hover1_zoom']; ?>);
  transform: scale(<?php echo $options['hover1_zoom']; ?>);
}


<?php
     // スライド ------------------------------------------------------------------------------
     } elseif($options['hover_type']=="type2"){
?>
.author_profile a.avatar, .animate_image, .animate_background, .animate_background .image_wrap {
  background: <?php echo $options['hover2_bgcolor']; ?>;
}
.animate_image img, .animate_background .image {
  -webkit-width:calc(100% + 30px) !important; width:calc(100% + 30px) !important; height:auto; max-width:inherit !important; position:relative;
  <?php if($options['hover2_direct']=='type1'): ?>
  -webkit-transform: translate(-15px, 0px); -webkit-transition-property: opacity, translateX; -webkit-transition: 0.5s;
  transform: translate(-15px, 0px); transition-property: opacity, translateX; transition: 0.5s;
  <?php else: ?>
  -webkit-transform: translate(-15px, 0px); -webkit-transition-property: opacity, translateX; -webkit-transition: 0.5s;
  transform: translate(-15px, 0px); transition-property: opacity, translateX; transition: 0.5s;
  <?php endif; ?>
}
.animate_image:hover img, .animate_background:hover .image {
  opacity:<?php echo $options['hover2_opacity']; ?>;
  <?php if($options['hover2_direct']=='type1'): ?>
  -webkit-transform: translate(0px, 0px);
  transform: translate(0px, 0px);
  <?php else: ?>
  -webkit-transform: translate(-30px, 0px);
  transform: translate(-30px, 0px);
  <?php endif; ?>
}
.animate_image.square img {
  -webkit-width:calc(100% + 30px) !important; width:calc(100% + 30px) !important; height:auto; max-width:inherit !important; position:relative;
  <?php if($options['hover2_direct']=='type1'): ?>
  -webkit-transform: translate(-15px, -15px); -webkit-transition-property: opacity, translateX; -webkit-transition: 0.5s;
  transform: translate(-15px, -15px); transition-property: opacity, translateX; transition: 0.5s;
  <?php else: ?>
  -webkit-transform: translate(-15px, -15px); -webkit-transition-property: opacity, translateX; -webkit-transition: 0.5s;
  transform: translate(-15px, -15px); transition-property: opacity, translateX; transition: 0.5s;
  <?php endif; ?>
}
.animate_image.square:hover img {
  opacity:<?php echo $options['hover2_opacity']; ?>;
  <?php if($options['hover2_direct']=='type1'): ?>
  -webkit-transform: translate(0px, -15px);
  transform: translate(0px, -15px);
  <?php else: ?>
  -webkit-transform: translate(-30px, -15px);
  transform: translate(-30px, -15px);
  <?php endif; ?>
}
<?php
     // フェードアウト ------------------------------------------------------------------------------
     } elseif($options['hover_type']=="type3"){
?>
.author_profile a.avatar, .animate_image, .animate_background, .animate_background .image_wrap {
  background: <?php echo $options['hover3_bgcolor']; ?>;
}
.author_profile a.avatar img, .animate_image img, .animate_background .image {
  -webkit-transition-property: opacity; -webkit-transition: 0.5s;
  transition-property: opacity; transition: 0.5s;
}
.author_profile a.avatar:hover img, .animate_image:hover img, .animate_background:hover .image {
  opacity: <?php echo $options['hover3_opacity']; ?>;
}
<?php }; }; // アニメーションここまで ?>


<?php
     // 色関連のスタイル　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■

     // メインカラー ----------------------------------
     $main_color = esc_html($options['main_color']);
?>
a { color:#000; }

#header_logo a, #footer_logo a, #comment_headline, .tcd_category_list a:hover, .tcd_category_list .child_menu_button:hover, #post_title_area .post_meta a:hover, #news_list a:hover .date, .index_blog .blog_list .post_meta li a:hover,
  .cardlink_title a:hover, #related_post .item a:hover, .comment a:hover, .comment_form_wrapper a:hover, .author_profile a:hover, .author_profile .author_link li a:hover:before, #post_meta_bottom a:hover,
    #searchform .submit_button:hover:before, .styled_post_list1 a:hover .title_area, .styled_post_list1 a:hover .date, .p-dropdown__title:hover:after, .p-dropdown__list li a:hover, #menu_button:hover:before
  { color: <?php echo $main_color; ?>; }

#submit_comment:hover, #cancel_comment_reply a:hover, #wp-calendar #prev a:hover, #wp-calendar #next a:hover, #wp-calendar td a:hover, #p_readmore .button, .page_navi span.current, .page_navi a:hover, #post_pagination p, #post_pagination a:hover, .c-pw__btn:hover, #post_pagination a:hover, .q_styled_ol li:before, .widget_tag_cloud .tagcloud a:hover
  { background-color: <?php echo $main_color; ?>; }

#header, #comment_textarea textarea:focus, .c-pw__box-input:focus, .page_navi span.current, .page_navi a:hover, #post_pagination p, #post_pagination a:hover
  { border-color: <?php echo $main_color; ?>; }

<?php
     // サブカラー ----------------------------------
     $sub_color = esc_html($options['sub_color']);
?>
a:hover, #header_logo a:hover, #footer_logo a:hover, #bread_crumb a:hover, #bread_crumb li.home a:hover:before, #next_prev_post a:hover, #next_prev_post a:hover:before, #schedule_list_headline_pc a:hover:before, #staff_single_header li a:hover:before, #header_social_link li a:hover:before, .blog_list .post_meta li a:hover
  { color: <?php echo $sub_color; ?>; }
#p_readmore .button:hover
  { background-color: <?php echo $sub_color; ?>; }
<?php
     // その他のカラー ----------------------------------
?>
.post_content a, .custom-html-widget a { color:<?php echo esc_html($options['content_link_color']); ?>; }
.post_content a:hover, .custom-html-widget a:hover { color:<?php echo esc_html($options['content_link_hover_color']); ?>; }
<?php
     // その他のスタイル ■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
?>
body { background:<?php echo esc_html($options['bg_color']); ?>; }
<?php
     // ロード画面 -----------------------------------------
     get_template_part('functions/loader');
     if($options['load_icon'] == 'type4'){
?>
#site_loader_logo_inner p { font-size:<?php echo esc_html($options['load_type4_catch_font_size']); ?>px; color:<?php echo esc_html($options['load_type4_catch_color']); ?>; }
@media screen and (max-width:750px) {
  #site_loader_logo_inner p { font-size:<?php echo esc_html($options['load_type4_catch_font_size_sp']); ?>px; }
}
<?php
     };

     //フッターバー --------------------------------------------
     if(is_mobile()) {
       if($options['footer_bar_display'] == 'type1' || $options['footer_bar_display'] == 'type2') {
?>
.dp-footer-bar { background: <?php echo 'rgba('.implode(',', hex2rgb($options['footer_bar_bg'])).', '.esc_html($options['footer_bar_tp']).');'; ?> border-top: solid 1px <?php echo esc_html($options['footer_bar_border']); ?>; color: <?php echo esc_html($options['footer_bar_color']); ?>; display: flex; flex-wrap: wrap; }
.dp-footer-bar a { color: <?php echo esc_html($options['footer_bar_color']); ?>; }
.dp-footer-bar-item + .dp-footer-bar-item { border-left: solid 1px <?php echo esc_html($options['footer_bar_border']); ?>; }
<?php
       };
     };
?>

<?php
     // カスタムCSS --------------------------------------------
     if($options['css_code']) {
       echo $options['css_code'];
     };
     if(is_single() || is_page()) {
       global $post;
       $custom_css = get_post_meta($post->ID, 'custom_css', true);
       if($custom_css) {
         echo wp_kses_post($custom_css);
       };
     }

     // クイックタグ --------------------------------------------
     if ( $options['use_quicktags'] ) :

     // 見出し
?>
.styled_h2 {
  font-size:<?php echo esc_attr($options['qt_h2_font_size']); ?>px !important; text-align:<?php echo esc_attr($options['qt_h2_text_align']); ?>; color:<?php echo esc_attr($options['qt_h2_font_color']); ?>; <?php if($options['show_qt_h2_bg_color']) { ?>background:<?php echo esc_attr($options['qt_h2_bg_color']); ?>;<?php }; ?>
  border-top:<?php echo esc_attr($options['qt_h2_border_top_width']); ?>px solid <?php echo esc_attr($options['qt_h2_border_top_color']); ?>;
  border-bottom:<?php echo esc_attr($options['qt_h2_border_bottom_width']); ?>px solid <?php echo esc_attr($options['qt_h2_border_bottom_color']); ?>;
  border-left:<?php echo esc_attr($options['qt_h2_border_left_width']); ?>px solid <?php echo esc_attr($options['qt_h2_border_left_color']); ?>;
  border-right:<?php echo esc_attr($options['qt_h2_border_right_width']); ?>px solid <?php echo esc_attr($options['qt_h2_border_right_color']); ?>;
  padding:<?php echo esc_attr($options['qt_h2_padding_top']); ?>px <?php echo esc_attr($options['qt_h2_padding_right']); ?>px <?php echo esc_attr($options['qt_h2_padding_bottom']); ?>px <?php echo esc_attr($options['qt_h2_padding_left']); ?>px !important;
  margin:<?php echo esc_attr($options['qt_h2_margin_top']); ?>px 0px <?php echo esc_attr($options['qt_h2_margin_bottom']); ?>px !important;
}
.styled_h3 {
  font-size:<?php echo esc_attr($options['qt_h3_font_size']); ?>px !important; text-align:<?php echo esc_attr($options['qt_h3_text_align']); ?>; color:<?php echo esc_attr($options['qt_h3_font_color']); ?>; <?php if($options['show_qt_h3_bg_color']) { ?>background:<?php echo esc_attr($options['qt_h3_bg_color']); ?>;<?php }; ?>
  border-top:<?php echo esc_attr($options['qt_h3_border_top_width']); ?>px solid <?php echo esc_attr($options['qt_h3_border_top_color']); ?>;
  border-bottom:<?php echo esc_attr($options['qt_h3_border_bottom_width']); ?>px solid <?php echo esc_attr($options['qt_h3_border_bottom_color']); ?>;
  border-left:<?php echo esc_attr($options['qt_h3_border_left_width']); ?>px solid <?php echo esc_attr($options['qt_h3_border_left_color']); ?>;
  border-right:<?php echo esc_attr($options['qt_h3_border_right_width']); ?>px solid <?php echo esc_attr($options['qt_h3_border_right_color']); ?>;
  padding:<?php echo esc_attr($options['qt_h3_padding_top']); ?>px <?php echo esc_attr($options['qt_h3_padding_right']); ?>px <?php echo esc_attr($options['qt_h3_padding_bottom']); ?>px <?php echo esc_attr($options['qt_h3_padding_left']); ?>px !important;
  margin:<?php echo esc_attr($options['qt_h3_margin_top']); ?>px 0px <?php echo esc_attr($options['qt_h3_margin_bottom']); ?>px !important;
}
.styled_h4 {
  font-size:<?php echo esc_attr($options['qt_h4_font_size']); ?>px !important; text-align:<?php echo esc_attr($options['qt_h4_text_align']); ?>; color:<?php echo esc_attr($options['qt_h4_font_color']); ?>; <?php if($options['show_qt_h4_bg_color']) { ?>background:<?php echo esc_attr($options['qt_h4_bg_color']); ?>;<?php }; ?>
  border-top:<?php echo esc_attr($options['qt_h4_border_top_width']); ?>px solid <?php echo esc_attr($options['qt_h4_border_top_color']); ?>;
  border-bottom:<?php echo esc_attr($options['qt_h4_border_bottom_width']); ?>px solid <?php echo esc_attr($options['qt_h4_border_bottom_color']); ?>;
  border-left:<?php echo esc_attr($options['qt_h4_border_left_width']); ?>px solid <?php echo esc_attr($options['qt_h4_border_left_color']); ?>;
  border-right:<?php echo esc_attr($options['qt_h4_border_right_width']); ?>px solid <?php echo esc_attr($options['qt_h4_border_right_color']); ?>;
  padding:<?php echo esc_attr($options['qt_h4_padding_top']); ?>px <?php echo esc_attr($options['qt_h4_padding_right']); ?>px <?php echo esc_attr($options['qt_h4_padding_bottom']); ?>px <?php echo esc_attr($options['qt_h4_padding_left']); ?>px !important;
  margin:<?php echo esc_attr($options['qt_h4_margin_top']); ?>px 0px <?php echo esc_attr($options['qt_h4_margin_bottom']); ?>px !important;
}
.styled_h5 {
  font-size:<?php echo esc_attr($options['qt_h5_font_size']); ?>px !important; text-align:<?php echo esc_attr($options['qt_h5_text_align']); ?>; color:<?php echo esc_attr($options['qt_h5_font_color']); ?>; <?php if($options['show_qt_h5_bg_color']) { ?>background:<?php echo esc_attr($options['qt_h5_bg_color']); ?>;<?php }; ?>
  border-top:<?php echo esc_attr($options['qt_h5_border_top_width']); ?>px solid <?php echo esc_attr($options['qt_h5_border_top_color']); ?>;
  border-bottom:<?php echo esc_attr($options['qt_h5_border_bottom_width']); ?>px solid <?php echo esc_attr($options['qt_h5_border_bottom_color']); ?>;
  border-left:<?php echo esc_attr($options['qt_h5_border_left_width']); ?>px solid <?php echo esc_attr($options['qt_h5_border_left_color']); ?>;
  border-right:<?php echo esc_attr($options['qt_h5_border_right_width']); ?>px solid <?php echo esc_attr($options['qt_h5_border_right_color']); ?>;
  padding:<?php echo esc_attr($options['qt_h5_padding_top']); ?>px <?php echo esc_attr($options['qt_h5_padding_right']); ?>px <?php echo esc_attr($options['qt_h5_padding_bottom']); ?>px <?php echo esc_attr($options['qt_h5_padding_left']); ?>px !important;
  margin:<?php echo esc_attr($options['qt_h5_margin_top']); ?>px 0px <?php echo esc_attr($options['qt_h5_margin_bottom']); ?>px !important;
}
<?php
     // ボタン
     for ( $i = 1; $i <= 3; $i++ ) :
       echo '.q_custom_button' . $i . ' { background: ' . esc_attr( $options['qt_custom_button_bg_color' . $i] ) . '; color: ' . esc_attr( $options['qt_custom_button_font_color' . $i] ) . ' !important; border-color: ' . esc_attr( $options['qt_custom_button_border_color' . $i] ) . ' !important; }' . "\n";
       echo '.q_custom_button' . $i . ':hover, .q_custom_button' . $i . ':focus { background: ' . esc_attr( $options['qt_custom_button_bg_color_hover' . $i] ) . '; color: ' . esc_attr( $options['qt_custom_button_font_color_hover' . $i] ) . ' !important; border-color: ' . esc_attr( $options['qt_custom_button_border_color_hover' . $i] ) . ' !important; }' . "\n";
     endfor;

     // 吹き出し
?>
.speech_balloon_left1 .speach_balloon_text { background-color: <?php echo esc_html( $options['qt_speech_balloon_bg_color1'] ); ?>; border-color: <?php echo esc_html( $options['qt_speech_balloon_border_color1'] ); ?>; color: <?php echo esc_html( $options['qt_speech_balloon_font_color1'] ); ?> }
.speech_balloon_left1 .speach_balloon_text::before { border-right-color: <?php echo esc_html( $options['qt_speech_balloon_border_color1'] ); ?> }
.speech_balloon_left1 .speach_balloon_text::after { border-right-color: <?php echo esc_html( $options['qt_speech_balloon_bg_color1'] ); ?> }
.speech_balloon_left2 .speach_balloon_text { background-color: <?php echo esc_html( $options['qt_speech_balloon_bg_color2'] ); ?>; border-color: <?php echo esc_html( $options['qt_speech_balloon_border_color2'] ); ?>; color: <?php echo esc_html( $options['qt_speech_balloon_font_color2'] ); ?> }
.speech_balloon_left2 .speach_balloon_text::before { border-right-color: <?php echo esc_html( $options['qt_speech_balloon_border_color2'] ); ?> }
.speech_balloon_left2 .speach_balloon_text::after { border-right-color: <?php echo esc_html( $options['qt_speech_balloon_bg_color2'] ); ?> }
.speech_balloon_right1 .speach_balloon_text { background-color: <?php echo esc_html( $options['qt_speech_balloon_bg_color3'] ); ?>; border-color: <?php echo esc_html( $options['qt_speech_balloon_border_color3'] ); ?>; color: <?php echo esc_html( $options['qt_speech_balloon_font_color3'] ); ?> }
.speech_balloon_right1 .speach_balloon_text::before { border-left-color: <?php echo esc_html( $options['qt_speech_balloon_border_color3'] ); ?> }
.speech_balloon_right1 .speach_balloon_text::after { border-left-color: <?php echo esc_html( $options['qt_speech_balloon_bg_color3'] ); ?> }
.speech_balloon_right2 .speach_balloon_text { background-color: <?php echo esc_html( $options['qt_speech_balloon_bg_color4'] ); ?>; border-color: <?php echo esc_html( $options['qt_speech_balloon_border_color4'] ); ?>; color: <?php echo esc_html( $options['qt_speech_balloon_font_color4'] ); ?> }
.speech_balloon_right2 .speach_balloon_text::before { border-left-color: <?php echo esc_html( $options['qt_speech_balloon_border_color4'] ); ?> }
.speech_balloon_right2 .speach_balloon_text::after { border-left-color: <?php echo esc_html( $options['qt_speech_balloon_bg_color4'] ); ?> }
<?php endif; ?>

</style>

<?php
     // JavaScriptの設定はここから　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■

     // トップページ
     if(is_front_page()) {
       // 画像スライダー --------------------------------------------------
       if($options['index_header_content_type'] == 'type1'){
         wp_enqueue_style('slick-style', apply_filters('page_builder_slider_slick_style_url', get_template_directory_uri().'/js/slick.css'), '', '1.0.0');
         wp_enqueue_script('slick-script', apply_filters('page_builder_slider_slick_script_url', get_template_directory_uri().'/js/slick.min.js'), '', '1.0.0', true);
?>
<script type="text/javascript">
jQuery(document).ready(function($){

  $('#index_slider').slick({
    infinite: true,
    dots: false,
    arrows: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    adaptiveHeight: false,
    pauseOnFocus: false,
    pauseOnHover: false,
    autoplay: true,
    fade: true,
    slide: '.item',
    easing: 'easeOutExpo',
    speed: 2000,
    autoplaySpeed: <?php echo esc_html($options['index_slider_time']); ?>
  });
  $('#index_slider').on("beforeChange", function(event, slick, currentSlide, nextSlide) {
    $('#index_slider .item').eq(nextSlide).addClass('animate');
  });
  $('#index_slider').on("afterChange", function(event, slick, currentSlide, nextSlide) {
    $('#index_slider .item').not(':eq(' + currentSlide + ')').removeClass('animate');
  });

});
</script>
<?php
     };
     // mp4 ------------------------------------------------------------
     if($options['index_header_content_type'] == 'type2') {
       if(auto_play_movie()) {
?>
<script type="text/javascript">
jQuery(document).ready(function($) {

   $(window).on('load',function(){
     setBgImg($('#index_video_mp4'));
   });

   $(window).on('resize',function(){
     setBgImg($('#index_video_mp4'));
   });

   function setBgImg(object){
     var imgW = object.width();
     var imgH = object.height();
     var winW = $(window).width();
     var winH = $('#index_video').innerHeight();
     var scaleW = winW / imgW;
     var scaleH = winH / imgH;
     var fixScale = Math.max(scaleW, scaleH);
     var setW = imgW * fixScale;
     var setH = imgH * fixScale;
     var moveX = Math.floor((winW - setW) / 2);
     var moveY = Math.floor((winH - setH) / 2);
     object.css({'width': setW, 'height': setH, 'left' : moveX, 'top' : moveY });
   }
});
</script>
<?php
       };
     };
     // Youtube ------------------------------------------------------------
     if($options['index_header_content_type'] == 'type3') {
       $youtube_url = $options['index_youtube_url'];
       if($youtube_url && auto_play_movie()) {
         $matches = array();
         if(preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[\w\-?&!#=,;]+/[\w\-?&!#=/,;]+/|(?:v|e(?:mbed)?)/|[\w\-?&!#=,;]*[?&]v=)|youtu\.be/)([\w-]{11})(?:[^\w-]|\Z)%i', $youtube_url, $matches)) {
           $video_id = $matches[1];
         }
         if($video_id) {
?>
<script src="https://www.youtube.com/iframe_api"></script>
<script type="text/javascript">
function onYouTubeIframeAPIReady() {
  ytPlayer = new YT.Player(
    'youtube_video_player',{
      videoId: '<?php echo esc_html($video_id); ?>',
      playerVars: {
        playsinline: 1,
        loop: 1,
        playlist: '<?php echo esc_html($video_id); ?>',
        controls: 0,
        autoplay: 1,
        showinfo: 0
      },
      events: {
       'onReady': onPlayerReady
      }
    }
  );
}
function onPlayerReady(event) {
  event.target.playVideo();
  event.target.mute();
}
jQuery(document).ready(function($) {

   $(window).on('load',function(){
     set_youtube_width_height($('#youtube_video_wrap'));
   });

   $(window).on('resize',function(){
     set_youtube_width_height($('#youtube_video_wrap'));
   });

   function set_youtube_width_height(object){
     var slider_height = $('#index_video').innerHeight();
     var slider_width = slider_height*(16/9);
     var win_width = $(window).width();
     var win_height = win_width*(9/16);
     if(win_width > slider_width) {
       object.addClass('type1');
       object.removeClass('type2');
       object.css({'width': '100%', 'height': win_height});
     } else {
       object.removeClass('type1');
       object.addClass('type2');
       object.css({'width':slider_width, 'height':slider_height });
     }
   }

});
</script>
<?php
         };
       };
     };

     // コンテンツビルダー ------------------------------------------------------------
     if (!empty($options['contents_builder'])) :
       foreach($options['contents_builder'] as $content) :
         if ( ($content['cb_content_select'] == 'campaign_list') && $content['show_campaign'] ) {
           wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.css','','1.0.0');
           wp_enqueue_style('owl-theme-default', get_template_directory_uri() . '/js/owl.theme.default.min.css','','1.0.0');
           wp_enqueue_script('owl-carousel-js', get_template_directory_uri().'/js/owl.carousel.min.js', '', '1.0.0', true);
?>
<script type="text/javascript">
jQuery(document).ready(function($){

  var owl = $('.index_campaign_slider');
  owl.owlCarousel({
    loop: true,
    rewind: false,
    stagePadding: -1,
    margin: 0,
    dots: false,
    nav: false,
    autoplay: true,
    autoplayTimeout: 5000,
    autoplaySpeed: 1000,
    autoplayHoverPause: true,
    responsive : {
      0 : { items: 1, stagePadding:0 },
      550 : { items: 2 },
      950 : { items: 3 },
      1150 : { items: 4 }
    }
  });
  $('.slider_next_item').click(function() {
    owl.trigger('stop.owl.autoplay');
    owl.trigger('next.owl.carousel', [1000]);
    owl.trigger('play.owl.autoplay');
  })
  $('.slider_prev_item').click(function() {
    owl.trigger('stop.owl.autoplay');
    owl.trigger('prev.owl.carousel', [1000]);
    owl.trigger('play.owl.autoplay');
  })

});
</script>
<?php
             break;
             };
           endforeach;
         endif;

       }; // END front page

       // カスタムスクリプト--------------------------------------------
       if($options['script_code']) {
         echo $options['script_code'];
       };
       if(is_single() || is_page()) {
         global $post;
         $custom_script = get_post_meta($post->ID, 'custom_script', true);
         if($custom_script) {
           echo $custom_script;
         };
       };

     }; // END function tcd_head()

     add_action("wp_head", "tcd_head");
?>