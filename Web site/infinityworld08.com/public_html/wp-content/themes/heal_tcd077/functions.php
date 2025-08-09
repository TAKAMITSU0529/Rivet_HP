<?php


// 言語ファイル --------------------------------------------------------------------------------
load_textdomain('tcd-w', get_template_directory().'/languages/tcd-heal-' . determine_locale() . '.mo');
load_textdomain('tcd-heal', get_template_directory().'/languages/tcd-heal-' . determine_locale() . '.mo');

// style.cssのDescriptionをPoedit等に認識させる
__( '"HEAL" is the WordPress theme for beauty salons. It makes it easy to create pages describing course menus and treatment flow. Make sure to use the schedule page that can be linked to the staff\'s workdays.', 'tcd-heal' );

// hook wp_head --------------------------------------------------------------------------------
require get_template_directory() . '/functions/head.php';


// テーマオプション --------------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/admin/theme-options.php' );


// 更新通知 --------------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/functions/update_notifier.php' );


// マニュアル --------------------------------------------------------------------------------
require_once  ( dirname(__FILE__) . '/functions/manual.php' );


// カスタマイザー設定( 外観 > ウィジェットから設定を取り除く)--------------------------------------------------------------------------------
require_once  ( dirname(__FILE__) . '/functions/customizer.php' );


// 「トップページ」と「ブログ一覧ページ」用の固定ページ作成機能の実装----------------------------------
require_once  ( dirname(__FILE__) . '/functions/class-page-new.php' );

// 新フォント機能 --------------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/admin/font/hooks-font.php' );

// Javascriptの読み込み -----------------------------------------------------------------------
function my_admin_scripts() {
  wp_enqueue_script( 'wp-color-picker');
  wp_enqueue_script('thickbox');
  wp_enqueue_script('media-upload');
  wp_enqueue_script('jquery-ui-resizable');//トップページのロゴで使用
  wp_enqueue_script('ml-widget-js', get_template_directory_uri().'/widget/js/script.js', '', '1.1', true);
  wp_enqueue_script('jquery.cookieTab', get_template_directory_uri().'/admin/js/jquery.cookieTab.js', '', '1.0.0', true);
  wp_enqueue_script('my_script', get_template_directory_uri().'/admin/js/my_script.js', '', '1.2.6', true);
  wp_enqueue_script('new_ui', get_template_directory_uri().'/admin/js/new_ui.js', '', '1.0.0', true);
  wp_enqueue_script('ml-rebox-js', get_template_directory_uri().'/admin/js/rebox/jquery-rebox.js', '', '1.0.0', true);
  wp_enqueue_script('font_ui', get_template_directory_uri().'/admin/font/ui/font_ui.js', '', '1.0.4', true);
  wp_localize_script( 'my_script', 'TCD_MESSAGES', array(
    'ajaxSubmitSuccess' => __( 'Settings Saved Successfully', 'tcd-w' ),
    'ajaxSubmitError' => __( 'Can not save data. Please try again', 'tcd-w' ),
    'tabChangeWithoutSave' => __( "Your changes on the current tab have not been saved.\nTo stay on the current tab so that you can save your changes, click Cancel.", 'tcd-w' ),
    'contentBuilderDelete' => __( 'Are you sure you want to delete this content?', 'tcd-w' ),
    'siteDescriptionMessage' => __( '<p>You can set more details from <a href="./admin.php?page=theme_options">theme option page</a> header section.</p>', 'tcd-w' ),
  ) );
  wp_enqueue_media();//画像アップロード用
  wp_enqueue_script('cf-media-field', get_template_directory_uri().'/admin/js/cf-media-field.js', '', '1.0.0', true); //画像アップロード用
  wp_localize_script( 'cf-media-field', 'cfmf_text', array(
    'image_title' => __( 'Please select image', 'tcd-w' ),
    'image_button' => __( 'Use this image', 'tcd-w' ),
    'video_title' => __( 'Please select MP4 file', 'tcd-w' ),
    'video_button' => __( 'Use this MP4 file', 'tcd-w' )
  ) );
}
add_action('admin_print_scripts', 'my_admin_scripts');


// スタイルシートの読み込み -----------------------------------------------------------------------
function my_admin_styles() {
  wp_enqueue_style('imgareaselect');
  wp_enqueue_style('jquery-ui-draggable');
  wp_enqueue_style('wp-color-picker');
  wp_enqueue_style('thickbox');
  wp_enqueue_style('font_ui_css', get_template_directory_uri() . '/admin/font/ui/font_ui.css','','1.0.0');
  wp_enqueue_style('my_widget_css', get_template_directory_uri() . '/widget/css/style.css','','1.0.0');
  wp_enqueue_style('my_admin_css', get_template_directory_uri() .'/admin/css/my_admin.css','','1.2.6');
  wp_enqueue_style('new_ui_css', get_template_directory_uri() .'/admin/css/new_ui.css','','1.0.0');
  wp_enqueue_style('ml-rebox-style', get_template_directory_uri() . '/admin/js/rebox/jquery-rebox.css','','1.0.0');
}
add_action('admin_print_styles', 'my_admin_styles');

// ページビルダー --------------------------------------------------------------------------------
require get_template_directory() . '/pagebuilder/pagebuilder.php';


// カードリンクパーツ --------------------------------------------------------------------------------
require get_template_directory() . '/functions/clink.php';


// おすすめ記事 --------------------------------------------------------------------------------
require get_template_directory() . '/functions/recommend.php';


// meta title meta description  --------------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/functions/seo.php' );


// 管理画面の記事一覧、クイック編集 --------------------------------------------------------------------------------
require get_template_directory() . '/functions/admin_column.php';
require get_template_directory() . '/functions/quick_edit.php';


// カスタムフィールド --------------------------------------------------------------------------------
require get_template_directory() . '/functions/page_lp.php';
require get_template_directory() . '/functions/page_schedule.php';
require get_template_directory() . '/functions/page_cf.php';
require get_template_directory() . '/functions/blog_cf.php';
require get_template_directory() . '/functions/campaign_cf.php';
require get_template_directory() . '/functions/menu_cf.php';
require get_template_directory() . '/functions/staff_cf.php';


// 並び替え --------------------------------------------------------------------------------
require get_template_directory() . '/functions/post_order.php';


// カスタムjavascript --------------------------------------------------------------------------------
require get_template_directory() . '/functions/custom_script.php';


// ビジュアルエディタにクイックタグを追加 --------------------------------------------------------------------------------
require get_template_directory() . '/functions/custom_editor.php';


// ショートコード --------------------------------------------------------------------------------
require get_template_directory() . '/functions/short_code.php';


// ウィジェット ------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/widget/ad.php' );
require_once ( dirname(__FILE__) . '/widget/styled_post_list1.php' );
require_once ( dirname(__FILE__) . '/widget/google_search.php' );
require_once ( dirname(__FILE__) . '/widget/archive_list.php' );
require_once ( dirname(__FILE__) . '/widget/category_list.php' );
require_once ( dirname(__FILE__) . '/widget/banner.php' );

$options = get_design_plus_option();
$campaign_label = $options['campaign_label'] ? esc_html( $options['campaign_label'] ) : __( 'Recipe', 'tcd-w' );
$news_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-w' );

register_sidebar(array(
  'before_widget' => '<div class="widget_content clearfix %2$s" id="%1$s">'."\n",
  'after_widget' => "</div>\n",
  'before_title' => '<div class="widget_headline"><span>',
  'after_title' => "</span></div>",
  'name' => __('Common widget', 'tcd-w'),
  'description' => __('Widgets set in this area are displayed as basic widget in the sidebar of all pages. If there are individual settings, the widget will be displayed.', 'tcd-w'),
  'id' => 'common_widget'
));
register_sidebar(array(
  'before_widget' => '<div class="widget_content clearfix %2$s" id="%1$s">'."\n",
  'after_widget' => "</div>\n",
  'before_title' => '<div class="widget_headline"><span>',
  'after_title' => "</span></div>",
  'name' => __('Blog page', 'tcd-w'),
  'id' => 'blog_widget'
));
register_sidebar(array(
  'before_widget' => '<div class="widget_content clearfix %2$s" id="%1$s">'."\n",
  'after_widget' => "</div>\n",
  'before_title' => '<div class="widget_headline"><span>',
  'after_title' => "</span></div>",
  'name' => __('Blog page (smartphone)', 'tcd-w'),
  'description' => __('This widget will be replaced with normal widget when a user accesses the site by smartphone.', 'tcd-w'),
  'id' => 'blog_widget_mobile'
));
register_sidebar(array(
  'before_widget' => '<div class="widget_content clearfix %2$s" id="%1$s">'."\n",
  'after_widget' => "</div>\n",
  'before_title' => '<div class="widget_headline"><span>',
  'after_title' => "</span></div>",
  'name' => sprintf(__('%s page', 'tcd-w'),$campaign_label),
  'id' => 'campaign_widget'
));
register_sidebar(array(
  'before_widget' => '<div class="widget_content clearfix %2$s" id="%1$s">'."\n",
  'after_widget' => "</div>\n",
  'before_title' => '<div class="widget_headline"><span>',
  'after_title' => "</span></div>",
  'name' => sprintf(__('%s page (smartphone)', 'tcd-w'),$campaign_label),
  'description' => __('This widget will be replaced with normal widget when a user accesses the site by smartphone.', 'tcd-w'),
  'id' => 'campaign_widget_mobile'
));
register_sidebar(array(
  'before_widget' => '<div class="widget_content clearfix %2$s" id="%1$s">'."\n",
  'after_widget' => "</div>\n",
  'before_title' => '<div class="widget_headline"><span>',
  'after_title' => "</span></div>",
  'name' => sprintf(__('%s page', 'tcd-w'),$news_label),
  'id' => 'news_widget'
));
register_sidebar(array(
  'before_widget' => '<div class="widget_content clearfix %2$s" id="%1$s">'."\n",
  'after_widget' => "</div>\n",
  'before_title' => '<div class="widget_headline"><span>',
  'after_title' => "</span></div>",
  'name' => sprintf(__('%s page (smartphone)', 'tcd-w'),$news_label),
  'description' => __('This widget will be replaced with normal widget when a user accesses the site by smartphone.', 'tcd-w'),
  'id' => 'news_widget_mobile'
));
register_sidebar(array(
  'before_widget' => '<div class="widget_content clearfix %2$s" id="%1$s">'."\n",
  'after_widget' => "</div>\n",
  'before_title' => '<div class="widget_headline"><span>',
  'after_title' => "</span></div>",
  'name' => __('Pages', 'tcd-w'),
  'id' => 'page_widget'
));
register_sidebar(array(
  'before_widget' => '<div class="widget_content clearfix %2$s" id="%1$s">'."\n",
  'after_widget' => "</div>\n",
  'before_title' => '<div class="widget_headline"><span>',
  'after_title' => "</span></div>",
  'name' => __('Pages (smartphone)', 'tcd-w'),
  'description' => __('This widget will be replaced with normal widget when a user accesses the site by smartphone.', 'tcd-w'),
  'id' => 'page_widget_mobile'
));


// メガメニュー --------------------------------------------------------------------------------
require get_template_directory() . '/functions/menu.php';
if ( ! function_exists( 'wp_get_nav_menu_name' ) ) {
  function wp_get_nav_menu_name( $location ) {
    $menu_name = '';
    $locations = get_nav_menu_locations();
    if ( isset( $locations[ $location ] ) ) {
      $menu = wp_get_nav_menu_object( $locations[ $location ] );
      if ( $menu && $menu->name ) {
        $menu_name = $menu->name;
      }
    }
    return apply_filters( 'wp_get_nav_menu_name', $menu_name, $location );
  }
}


// カスタムページリンク  --------------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/functions/custom_page_link.php' );


// OGP tag  -------------------------------------------------------------------------------------------
require get_template_directory() . '/functions/ogp.php';


// 次のページリンク  --------------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/functions/next_prev.php' );


//ロゴ用関数 --------------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/functions/logo.php' );


// プロフィール追加情報 --------------------------------------------------------------------------------
require get_template_directory() . '/functions/user-profile.php';


// アクセス数 --------------------------------------------------------------------------------
//require_once ( dirname(__FILE__) . '/functions/views.php' );


// ロードアイコン -----------------------------------------------------------------------------
require get_template_directory() . '/functions/load_icon.php';
require get_template_directory() . '/functions/loading_script.php';


// パスワード保護 -----------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/functions/password_form.php' );


// 高速化 --------------------------------------------------------------------------------
require ( dirname(__FILE__) . '/functions/acceleration.php' );


// ico形式のファイルをアップロードできるようにする（ファビコンに利用）---------------------------------------------------------------------
function my_myme_types($mime_types){
  $existing_mimes['ico'] = 'images/ico';
  return $mime_types;
}
add_filter('upload_mimes', 'my_myme_types', 1, 1);


// ユーザーエージェントを判定するための関数---------------------------------------------------------------------
function is_mobile() {
  if ( isset( $_SERVER['HTTP_SEC_CH_UA_MOBILE'] ) ) {
      $is_mobile = ( '?1' === $_SERVER['HTTP_SEC_CH_UA_MOBILE'] );
  } elseif ( empty( $_SERVER['HTTP_USER_AGENT'] ) ) {
      $is_mobile = false;
  } elseif (
      (str_contains( $_SERVER['HTTP_USER_AGENT'], 'Mobile' ) && !str_contains( $_SERVER['HTTP_USER_AGENT'], 'iPad' )) // iPad を除外
      || (str_contains( $_SERVER['HTTP_USER_AGENT'], 'Android' ) && !str_contains( $_SERVER['HTTP_USER_AGENT'], 'Tablet' )) // Android タブレットを除外
      || str_contains( $_SERVER['HTTP_USER_AGENT'], 'iPhone' ) // iPhone を明示的に含む
      || str_contains( $_SERVER['HTTP_USER_AGENT'], 'BlackBerry' )
      || str_contains( $_SERVER['HTTP_USER_AGENT'], 'Opera Mini' )
      || str_contains( $_SERVER['HTTP_USER_AGENT'], 'Opera Mobi' )
  ) {
      $is_mobile = true;
  } else {
      $is_mobile = false;
  }

return $is_mobile;

}



// videoタグやyoutubeの自動再生に対応しているか判定 ----------------------------------------------
// Android 標準ブラウザは不可、Android版 Chrome ver53以下は不可、iOS ver10以下は不可、それ以外は再生を許可
function auto_play_movie() {
  $ua = mb_strtolower($_SERVER['HTTP_USER_AGENT']);
  // Android -----------------------------------
  if( preg_match('/android/ui', $ua) ) {
    //echo 'Android<br />';
    // 標準ブラウザ
    if (strpos($ua, 'android') !== false && strpos($ua, 'linux; u;') !== false && strpos($ua, 'chrome') === false) {
      return FALSE;
    // Chrome
    } elseif ( preg_match('/(chrome)\/([0-9\.]+)/', $ua , $matches) ){
      $match = (float) $matches[2];
      $version = floor($match);
      if($version < 53){
        return FALSE;
      } else {
        return TRUE;
      }
    } else {
      return TRUE;
    }
  // iOS ---------------------------------------
  } elseif(preg_match('/iphone|ipod|ipad/ui', $ua)) {
    //echo 'iOS<br />';
    if ( preg_match('/(iphone|ipod|ipad) os ([0-9_]+)/', $ua, $matches) ) {
      $matches[2] = (float) str_replace('_', '.', $matches[2]);
      $version = floor($matches[2]);
      if($version < 10){
        return FALSE;
      } else {
        return TRUE;
      }
    } else {
      return TRUE;
    }
  // PC等、その他のOS ---------------------------------------
  } else {
    //echo 'OTHER OS<br />';
    return TRUE;
  }
}



// スクリプトのバージョン管理 ----------------------------------------------------------------------------------------------
function version_num() {

 if (function_exists('wp_get_theme')) {
   $theme_data = wp_get_theme();
 } else {
   $theme_data = get_theme_data(TEMPLATEPATH . '/style.css');
 };

 $current_version = $theme_data['Version'];

 return $current_version;

};


// オリジナルの抜粋記事 --------------------------------------------------------------------------------
function trim_excerpt($a) {

 if(has_excerpt()) { 

   $base_content = get_the_excerpt();
   $base_content = str_replace(array("\r\n", "\r", "\n"), "", $base_content);
   $trim_content = mb_substr($base_content, 0, $a ,"utf-8");

 } else {

   $base_content = get_the_content();
   $base_content = preg_replace('!<style.*?>.*?</style.*?>!is', '', $base_content);
   $base_content = preg_replace('!<script.*?>.*?</script.*?>!is', '', $base_content);
   $base_content = preg_replace('/\[.+\]/','', $base_content);
   $base_content = strip_tags($base_content);
   $trim_content = mb_substr($base_content, 0, $a,"utf-8");
   $trim_content = str_replace(']]>', ']]&gt;', $trim_content);
   $trim_content = str_replace(array("\r\n", "\r", "\n" , "&nbsp;"), "", $trim_content);
   $trim_content = htmlspecialchars($trim_content);

 };

 return $trim_content;

};
function trim_desc($desc,$num) {

  $trim_desc = mb_substr($desc, 0, $num ,"utf-8");
  $count_word = mb_strlen($trim_desc,"utf-8");
  return $trim_desc;

};

//抜粋からPタグを取り除く
remove_filter( 'the_excerpt', 'wpautop' );


// 記事タイトルの文字数制限 --------------------------------------------------------------------------------
function trim_title($num) {
 $base_title = strip_tags(get_the_title());
 $trim_title = mb_substr($base_title, 0, $num ,"utf-8");
 $count_title = mb_strlen($trim_title,"utf-8");
 if($count_title > $num-1) {
  echo $trim_title . '…';
 } else {
  echo $trim_title;
 };
};

function trim_title2($num) {
 $base_title = strip_tags(get_the_title());
 $trim_title = mb_substr($base_title, 0, $num ,"utf-8");
 $count_title = mb_strlen($trim_title,"utf-8");
 if($count_title > $num-1) {
  return $trim_title . '…';
 } else {
  return $trim_title;
 };
};

/* ショートコード用 */
function trim_title_sc($num) {
 $base_title = get_the_title();
 $trim_title = mb_substr($base_title, 0, $num ,"utf-8");
 $count_title = mb_strwidth($trim_title,"utf-8");
 if($count_title > $num-1) {
  return $trim_title . '…';
 } else {
  return $trim_title;
 };
};


// タイトルをエンコード --------------------------------------------------------------------------------
function get_encoded_title($title){
  return urlencode(mb_convert_encoding($title, "UTF-8"));
}


// セルフピンバックを禁止する -------------------------------------------------------------------------------------
function no_self_ping( &$links ) {
  $home = home_url();
  foreach ( $links as $l => $link )
  if ( 0 === strpos( $link, $home ) )
  unset($links[$l]);
}
add_action( 'pre_ping', 'no_self_ping' );


// RSS用のフィードを追加 ---------------------------------------------------------------------------------------------------
add_theme_support( 'automatic-feed-links' );


//　ヘッダーから余分なMETA情報を削除 --------------------------------------------------------------------
remove_action( 'wp_head', 'wp_generator' ); 
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );


// インラインスタイルを取り除く --------------------------------------------------------------------------------
function remove_recent_comments_style() {
  global $wp_widget_factory;
  if ( isset( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'] ) ) {
    remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
  }
}
add_action( 'widgets_init', 'remove_recent_comments_style' );

function remove_adminbar_inline_style() {
  remove_action( 'wp_head', '_admin_bar_bump_cb' );
  remove_action( 'wp_head', 'wp_admin_bar_header' );
  remove_action( 'wp_enqueue_scripts', 'wp_enqueue_admin_bar_bump_styles' );
  remove_action( 'wp_enqueue_scripts', 'wp_enqueue_admin_bar_header_styles' );
}
add_action('get_header', 'remove_adminbar_inline_style');


// ウィジェットブロックエディターを無効化 --------------------------------------------------------------------------------
function exclude_theme_support() {
    remove_theme_support( 'widgets-block-editor' );
}
add_action( 'after_setup_theme', 'exclude_theme_support' );


//　サムネイルの設定 --------------------------------------------------------------------------------
//require get_template_directory() . '/functions/blur_image.php';
if ( function_exists('add_theme_support') ) {
  add_theme_support( 'post-thumbnails' );
  add_image_size( 'size1', 520, 520, true );
  add_image_size( 'size2', 250, 250, true );
  add_image_size( 'size3', 650, 410, true ); // blog single page
  add_image_size( 'slider_size', 1180, 680, true ); //画像スライダー用
}
function message_featured_image_meta_box($content, $post_id, $thumbnail_id) {
  $post = get_post($post_id);
  if ( $post->post_type == 'post' || $post->post_type == 'campaign' || $post->post_type == 'news') {
    $content .= '<p>' . sprintf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '650', '410') . '</p>';
    return $content;
  }
  if ($post->post_type == 'menu') {
    $content .= '<p>' . sprintf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '1450', '430') . '</p>';
    return $content;
  }
  if ($post->post_type == 'staff') {
    $content .= '<p>' . sprintf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '500', '500') . '</p>';
    return $content;
  }
  if ($post->post_type == 'voice') {
    $content .= '<p>' . __('You can optionally set customer photo.', 'tcd-w') . '</p>';
    return $content;
  }
  return $content;
}
add_filter('admin_post_thumbnail_html', 'message_featured_image_meta_box', 10, 3);


// カスタムメニューの設定 --------------------------------------------------------------------------------
if(function_exists('register_nav_menu')) {
  register_nav_menu( 'global-menu', __( 'Global menu', 'tcd-w' ) );
  register_nav_menu( 'footer-menu', __( 'Footer menu', 'tcd-w' ) );
}


// 絵文字を消す ------------------------------------------------------------------
function disable_emoji() {
  $options = get_design_plus_option();
  if ( $options['use_emoji'] == 0 ) {

    // remove inline script
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    // remove inline style
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    // remove inline style  6.4 later
    if ( function_exists( 'wp_enqueue_emoji_styles' ) ) {
      remove_action( 'wp_enqueue_scripts', 'wp_enqueue_emoji_styles' );
      remove_action( 'admin_enqueue_scripts', 'wp_enqueue_emoji_styles' );
    }

    // initだと早いため、admin_initで実行
    add_action( 'admin_init', function(){
      // remove inline script
      remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
      // remove inline style
      remove_action( 'admin_print_styles', 'print_emoji_styles' );
      // remove inline style 6.4 later
      if ( function_exists( 'wp_enqueue_emoji_styles' ) ) {
        remove_action( 'admin_enqueue_scripts', 'wp_enqueue_emoji_styles' );
      }
    } );

  }
}
add_action( 'init', 'disable_emoji' );



// bodyタグにclassを追加 --------------------------------------------------------------------------------
function tcd_body_classes($classes) {
    global $wp_query, $post;
    $options = get_design_plus_option();
    if (wp_is_mobile()) { $classes[] = 'mobile_device'; };

    if ($options['header_show_desc'] == 'type1') { $classes[] = 'no_site_desc'; };
    if (!$options['show_header_desc_mobile']) { $classes[] = 'hide_site_desc_mobile'; };
    if (!is_front_page() && $options['header_show_desc'] == 'type2') { $classes[] = 'no_site_desc'; };
    if ($options['header_fix'] != 'type1') { $classes[] = 'use_header_fix'; };
    if ($options['mobile_header_fix'] == 'type2') { $classes[] = 'use_mobile_header_fix'; };
    if ( is_mobile() && ($options['footer_bar_display'] == 'type1') ) { $classes[] = 'show_footer_bar dp-footer-bar-type1'; };
    if ( is_mobile() && ($options['footer_bar_display'] == 'type2') ) { $classes[] = 'show_footer_bar dp-footer-bar-type2'; };
    return array_unique($classes);
};
add_filter('body_class','tcd_body_classes');


// HEXをRGBに変換 ------------------------------------------------------------------
function hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   return $rgb;
}


// archive_title() 関数をカスタマイズ --------------------------------------------------------------------------------
function monolith_archive_title( $title ) {
	global $author, $post, $wp_query;
	if ( is_author() ) {
		$title = get_the_author_meta( 'display_name', $author );
	} elseif ( is_category() || is_tag() ) {
		$title = single_term_title( '', false );
	} elseif ( is_day() ) {
		$title = get_the_time( __( 'F jS, Y', 'tcd-w' ), $post );
	} elseif ( is_month() ) {
		$title = get_the_time( __( 'F, Y', 'tcd-w' ), $post );
	} elseif ( is_year() ) {
		$title = get_the_time( __( 'Y', 'tcd-w' ), $post );
	} elseif ( is_search() ) {
		if ( $wp_query->found_posts ) {
			//$title = sprintf( __( 'Search results for - ', 'tcd-w' ) . get_search_query() 
		} else {
			$title = __( 'Search result', 'tcd-w' );
		}
	}
	return $title;
}
add_filter( 'get_the_archive_title', 'monolith_archive_title', 10 );


// カスタムコメント --------------------------------------------------------------------------------------

if (function_exists('wp_list_comments')) {
	// comment count
	add_filter('get_comments_number', 'comment_count', 0);
	function comment_count( $commentcount ) {
		global $id;
		$_commnets = get_comments('post_id=' . $id);
		$comments_by_type = separate_comments($_commnets);
		return count($comments_by_type['comment']);
	}
}


function custom_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	global $commentcount;
	if(!$commentcount) {
		$commentcount = 0;
	}
?>

 <li class="comment <?php if($comment->comment_author_email == get_the_author_meta('email')) {echo 'admin-comment';} else {echo 'guest-comment';} ?>" id="comment-<?php comment_ID() ?>">
  <div class="comment-meta clearfix">
   <div class="comment-meta-left">
  <?php if (function_exists('get_avatar') && get_option('show_avatars')) { echo get_avatar($comment, 35); } ?>
  
    <ul class="comment-name-date">
     <li class="comment-name">
<?php if (get_comment_author_url()) : ?>
<a id="commentauthor-<?php comment_ID() ?>" class="url <?php if($comment->comment_author_email == get_the_author_meta('email')) {echo 'admin-url';} else {echo 'guest-url';} ?>" href="<?php comment_author_url() ?>" rel="nofollow">
<?php else : ?>
<span id="commentauthor-<?php comment_ID() ?>">
<?php endif; ?>

<?php comment_author(); ?>

<?php if(get_comment_author_url()) : ?>
</a>
<?php else : ?>
</span>
<?php endif; ?>
     <li class="comment-date"><?php echo get_comment_time('Y.m.d'); echo get_comment_time(' g:ia'); ?></li>
    </ul>
   </div>

   <ul class="comment-act">
<?php if (function_exists('comment_reply_link')) { 
        if ( get_option('thread_comments') == '1' ) { ?>
    <li class="comment-reply"><?php comment_reply_link(array_merge( $args, array('add_below' => 'comment-content', 'depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => '<span><span>'.__('REPLY','tcd-w').'</span></span>'))) ?></li>
<?php   } else { ?>
    <li class="comment-reply"><a href="javascript:void(0);" onclick="MGJS_CMT.reply('commentauthor-<?php comment_ID() ?>', 'comment-<?php comment_ID() ?>', 'comment');"><?php _e('REPLY', 'tcd-w'); ?></a></li>
<?php   }
      } else { ?>
    <li class="comment-reply"><a href="javascript:void(0);" onclick="MGJS_CMT.reply('commentauthor-<?php comment_ID() ?>', 'comment-<?php comment_ID() ?>', 'comment');"><?php _e('REPLY', 'tcd-w'); ?></a></li>
<?php } ?>
    <li class="comment-quote"><a href="javascript:void(0);" onclick="MGJS_CMT.quote('commentauthor-<?php comment_ID() ?>', 'comment-<?php comment_ID() ?>', 'comment-content-<?php comment_ID() ?>', 'comment');"><?php _e('QUOTE', 'tcd-w'); ?></a></li>
    <?php edit_comment_link(__('EDIT', 'tcd-w'), '<li class="comment-edit">', '</li>'); ?>
   </ul>

  </div>
  <div class="comment-content post_content" id="comment-content-<?php comment_ID() ?>">
  <?php if ($comment->comment_approved == '0') : ?>
   <span class="comment-note"><?php _e('Your comment is awaiting moderation.', 'tcd-w'); ?></span>
  <?php endif; ?>
  <?php comment_text(); ?>
  </div>

<?php

}


/* 記事編集画面のカテゴリー階層を保つ */
function lig_wp_category_terms_checklist_no_top( $args, $post_id = null ) {
  $args['checked_ontop'] = false;
  return $args;
}
add_action( 'wp_terms_checklist_args', 'lig_wp_category_terms_checklist_no_top' );


// カスタム投稿とタクソノミーの追加 --------------------------------------------------------------------------------

function custom_post_type_init() {

$options = get_design_plus_option();


// カスタム投稿「メニュー」 --------------------------------------------------------------------------------
$menu_label = $options['menu_label'] ? esc_html( $options['menu_label'] ) : __( 'Menu', 'tcd-w' );
$menu_slug = $options['menu_slug'] ? esc_html( $options['menu_slug'] ) : 'menu';
$menu_labels = array(
  'name' => $menu_label,
  'add_new' => __( 'Add New', 'tcd-w' ),
  'add_new_item' => __( 'Add New Item', 'tcd-w' ),
  'edit_item' => __( 'Edit', 'tcd-w' ),
  'new_item' => __( 'New item', 'tcd-w' ),
  'view_item' => __( 'View Item', 'tcd-w' ),
  'search_items' => __( 'Search Items', 'tcd-w' ),
  'not_found' => __( 'Not Found', 'tcd-w' ),
  'not_found_in_trash' => __( 'Not found in trash', 'tcd-w' ),
  'parent_item_colon' => ''
);

register_post_type( 'menu', array(
  'label' => $menu_label,
  'labels' => $menu_labels,
  'public' => true,
  'publicly_queryable' => true,
  'menu_position' => 5,
  'show_ui' => true,
  'query_var' => true,
  'rewrite' => array( 'slug' => $menu_slug ),
  'capability_type' => 'post',
  'has_archive' => true,
  'hierarchical' => false,
  'supports' => array( 'title', 'thumbnail' ),
  'show_in_rest' => false	// ブロックエディターを使用しない、REST APIで表示しない
));


// カスタム投稿「キャンペーン」 --------------------------------------------------------------------------------
$campaign_label = $options['campaign_label'] ? esc_html( $options['campaign_label'] ) : __( 'Campaign', 'tcd-w' );
$campaign_slug = $options['campaign_slug'] ? esc_html( $options['campaign_slug'] ) : 'campaign';
$campaign_labels = array(
  'name' => $campaign_label,
  'add_new' => __( 'Add New', 'tcd-w' ),
  'add_new_item' => __( 'Add New Item', 'tcd-w' ),
  'edit_item' => __( 'Edit', 'tcd-w' ),
  'new_item' => __( 'New item', 'tcd-w' ),
  'view_item' => __( 'View Item', 'tcd-w' ),
  'search_items' => __( 'Search Items', 'tcd-w' ),
  'not_found' => __( 'Not Found', 'tcd-w' ),
  'not_found_in_trash' => __( 'Not found in trash', 'tcd-w' ),
  'parent_item_colon' => ''
);

register_post_type( 'campaign', array(
  'label' => $campaign_label,
  'labels' => $campaign_labels,
  'public' => true,
  'publicly_queryable' => true,
  'menu_position' => 5,
  'show_ui' => true,
  'query_var' => true,
  'rewrite' => array( 'slug' => $campaign_slug ),
  'capability_type' => 'post',
  'has_archive' => true,
  'hierarchical' => false,
  'supports' => array( 'title', 'editor', 'thumbnail' ),
  'show_in_rest' => true	// ブロックエディターを使用しない、REST APIで表示しない
));


// カスタム投稿スタッフ --------------------------------------------------------------------------------
$options = get_design_plus_option();
$staff_label = $options['staff_label'] ? esc_html( $options['staff_label'] ) : __( 'Staff', 'tcd-w' );
$staff_slug = $options['staff_slug'] ? esc_html( $options['staff_slug'] ) : 'staff';
$staff_labels = array(
  'name' => $staff_label,
  'add_new' => __( 'Add New', 'tcd-w' ),
  'add_new_item' => __( 'Add New Item', 'tcd-w' ),
  'edit_item' => __( 'Edit', 'tcd-w' ),
  'new_item' => __( 'New item', 'tcd-w' ),
  'view_item' => __( 'View Item', 'tcd-w' ),
  'search_items' => __( 'Search Items', 'tcd-w' ),
  'not_found' => __( 'Not Found', 'tcd-w' ),
  'not_found_in_trash' => __( 'Not found in trash', 'tcd-w' ),
  'parent_item_colon' => ''
);

register_post_type( 'staff', array(
  'label' => $staff_label,
  'labels' => $staff_labels,
  'public' => true,
  'publicly_queryable' => true,
  'menu_position' => 5,
  'show_ui' => true,
  'query_var' => true,
  'rewrite' => array( 'slug' => $staff_slug ),
  'capability_type' => 'post',
  'has_archive' => true,
  'hierarchical' => false,
  'supports' => array( 'title', 'thumbnail' ),
  'show_in_rest' => false	// ブロックエディターを使用しない、REST APIで表示しない
));


// カスタム投稿お客様の声 --------------------------------------------------------------------------------
$options = get_design_plus_option();
$voice_label = $options['voice_label'] ? esc_html( $options['voice_label'] ) : __( 'Voice', 'tcd-w' );
$voice_slug = $options['voice_slug'] ? esc_html( $options['voice_slug'] ) : 'voice';
$voice_labels = array(
  'name' => $voice_label,
  'add_new' => __( 'Add New', 'tcd-w' ),
  'add_new_item' => __( 'Add New Item', 'tcd-w' ),
  'edit_item' => __( 'Edit', 'tcd-w' ),
  'new_item' => __( 'New item', 'tcd-w' ),
  'view_item' => __( 'View Item', 'tcd-w' ),
  'search_items' => __( 'Search Items', 'tcd-w' ),
  'not_found' => __( 'Not Found', 'tcd-w' ),
  'not_found_in_trash' => __( 'Not found in trash', 'tcd-w' ),
  'parent_item_colon' => ''
);

register_post_type( 'voice', array(
  'label' => $voice_label,
  'labels' => $voice_labels,
  'public' => true,
  'publicly_queryable' => true,
  'menu_position' => 5,
  'show_ui' => true,
  'query_var' => true,
  'rewrite' => array( 'slug' => $voice_slug ),
  'capability_type' => 'post',
  'has_archive' => true,
  'hierarchical' => false,
  'supports' => array( 'title', 'editor', 'thumbnail' ),
  'show_in_rest' => false	// ブロックエディターを使用しない、REST APIで表示しない
));


// カスタム投稿お知らせ --------------------------------------------------------------------------------
$options = get_design_plus_option();
$news_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-w' );
$news_slug = $options['news_slug'] ? esc_html( $options['news_slug'] ) : 'news';
$news_labels = array(
  'name' => $news_label,
  'add_new' => __( 'Add New', 'tcd-w' ),
  'add_new_item' => __( 'Add New Item', 'tcd-w' ),
  'edit_item' => __( 'Edit', 'tcd-w' ),
  'new_item' => __( 'New item', 'tcd-w' ),
  'view_item' => __( 'View Item', 'tcd-w' ),
  'search_items' => __( 'Search Items', 'tcd-w' ),
  'not_found' => __( 'Not Found', 'tcd-w' ),
  'not_found_in_trash' => __( 'Not found in trash', 'tcd-w' ),
  'parent_item_colon' => ''
);

register_post_type( 'news', array(
  'label' => $news_label,
  'labels' => $news_labels,
  'public' => true,
  'publicly_queryable' => true,
  'menu_position' => 5,
  'show_ui' => true,
  'query_var' => true,
  'rewrite' => array( 'slug' => $news_slug ),
  'capability_type' => 'post',
  'has_archive' => true,
  'hierarchical' => false,
  'supports' => array( 'title', 'editor', 'thumbnail' ),
  'show_in_rest' => true	// ブロックエディターを使用しない、REST APIで表示しない
));


// カスタム投稿ここまで

}
add_action( 'init', 'custom_post_type_init' );


/* メニューアーカイブページの記事数を変更 */
function change_smenu_num( $query ) {
  $post_num = -1;
  if( !is_admin() && is_post_type_archive('menu')) {
    if($query->is_main_query()) {
      $query->set('posts_per_page', $post_num);
      return;
    };
  }
}
add_action( 'pre_get_posts', 'change_staff_num' );


/* キャンペーンアーカイブ・カテゴリーページの記事数を変更 */
function change_campaign_num( $query ) {
  $options = get_design_plus_option();
  if(!empty($options['archive_campaign_num'])) {
    $post_num = $options['archive_campaign_num'];
  } else {
    $post_num = 18;
  };
  if( !is_admin() && is_post_type_archive('campaign')) {
    if($query->is_main_query()) {
      $query->set('posts_per_page', $post_num);
      return;
    };
  }
}
add_action( 'pre_get_posts', 'change_campaign_num' );


/* スタッフアーカイブページの記事数を変更 */
function change_staff_num( $query ) {
  $options = get_design_plus_option();
  $post_num = -1;
  if( !is_admin() && is_post_type_archive('staff')) {
    if($query->is_main_query()) {
      $query->set('posts_per_page', $post_num);
      return;
    };
  }
}
add_action( 'pre_get_posts', 'change_staff_num' );


/* お客様の声アーカイブページの記事数を変更 */
function change_voice_num( $query ) {
  $options = get_design_plus_option();
  if(!empty($options['archive_voice_num'])) {
    $post_num = $options['archive_voice_num'];
  } else {
    $post_num = 10;
  };
  if( !is_admin() && is_post_type_archive('voice')) {
    if($query->is_main_query()) {
      $query->set('posts_per_page', $post_num);
      return;
    };
  }
}
add_action( 'pre_get_posts', 'change_voice_num' );


/* お知らせアーカイブページの記事数を変更 */
function change_news_num( $query ) {
  $options = get_design_plus_option();
  if(!empty($options['archive_news_num'])) {
    $post_num = $options['archive_news_num'];
  } else {
    $post_num = 10;
  };
  if( !is_admin() && is_post_type_archive('news')) {
    if($query->is_main_query()) {
      $query->set('posts_per_page', $post_num);
      return;
    };
  }
}
add_action( 'pre_get_posts', 'change_news_num' );


// カスタム投稿の数が多い為、メディアメニューの位置を変更 ----------------------------------------------------------
function customize_menus(){
  global $menu;
  $menu[19] = $menu[10];
  unset($menu[10]);
}
add_action( 'admin_menu', 'customize_menus' );


// 全てのカスタムフィールドを検索対象に含める --------------------------------------------------------------------------------
function cf_search_join($join, $query) {
    global $wpdb;
    if ( ! is_admin() && $query->is_main_query() && $query->is_search() ) {
        $join .=' LEFT JOIN '.$wpdb->postmeta. ' AS tcd_pm_search ON '. $wpdb->posts . '.ID = tcd_pm_search.post_id ';
    }
    return $join;
}
add_filter('posts_join', 'cf_search_join', 10, 2);

function cf_search_where($where, $query) {
    global $wpdb;
    if ( ! is_admin() && $query->is_main_query() && $query->is_search() ) {
        $where = preg_replace(
            "/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
            "(".$wpdb->posts.".post_title LIKE $1) OR (tcd_pm_search.meta_value LIKE $1)", $where);
    }
    return $where;
}
add_filter('posts_where', 'cf_search_where', 10, 2);

function cf_search_distinct($distinct, $query) {
    global $wpdb;
    if ( ! is_admin() && $query->is_main_query() && $query->is_search() ) {
        return "DISTINCT";
    }
    return $distinct;
}
add_filter('posts_distinct', 'cf_search_distinct', 10, 2);


// タイトルとurlをコピーのスクリプト --------------------------------------------------------------------------------
function copy_title_url_script() {
  global $options;
  if ( ! $options ) $options = get_design_plus_option();

  if ( ( is_singular( 'post' ) && ( $options['show_copy_top'] || $options['show_copy_btm'] ) ) || is_singular( 'news' ) && ($options['show_copy_top_news'] || $options['show_copy_btm_news']) || is_singular( 'campaign' ) && ($options['show_copy_top_campaign'] || $options['show_copy_btm_campaign']) ) {
    wp_enqueue_script( 'copy_title_url', get_template_directory_uri().'/js/copy_title_url.js', array(), version_num(), true );
  }
}
add_action( 'wp_enqueue_scripts', 'copy_title_url_script' );


// 埋め込みコンテンツのレスポンシブ化
add_theme_support( 'responsive-embeds' );


/**
 * 管理画面 サイトヘルスのWP情報にユーザーエージェント追加
 *
 * NOTE: カスタマーサポート対策
 */
add_filter( 'debug_information', 'tcd_add_debug_information' );
function tcd_add_debug_information( $info ) {
  if( isset( $info['wp-core']['fields'] ) ){
    $info['wp-core']['fields']['user_agent'] = [
      'label' => 'User Agent',
      'value' => $_SERVER['HTTP_USER_AGENT'] ?? 'UA could not be retrieved',
    ];
  }
  return $info;
}


/**
 * PWAプラグイン未インストール時のメッセージ
 *
 * NOTE: TCDユーザーがPWAプラグインを知る・使うための導線を作るために用意
 */
add_action( 'admin_notices', 'tcd_pwa_admin_notice' );
function tcd_pwa_admin_notice(){
  global $plugin_page;

  // テーマオプションページ以外では表示しない
  if( $plugin_page !== 'theme_options' ){
    return;
  }

  // TCD PWA が有効化されていれば表示しない
  if( defined( 'TCDPWA_ACTIVE' ) && TCDPWA_ACTIVE ){
    return;
  }

  // チェックしたいプラグインのメインファイルを指定
  $target_plugin_file = 'tcd-pwa/tcd-pwa.php';

  // すべてのインストール済みプラグインを取得
  $installed_plugins = get_plugins();

  // インストール済みなら終了
  if( isset( $installed_plugins[$target_plugin_file] ) ){
    return;
  }

  // notice作成
  printf(
    '<div class="notice notice-info is-dismissible">
      <p>%1$s</p>
      <p>
        <a class="button" href="%2$s" target="_blank">%3$s</a>
        <a class="button button-primary" href="%4$s" target="_blank">%5$s</a>
      </p>
    </div>',
    // TCDテーマをPWA化できるプラグイン「TCD Progressive Web Apps」を利用できます。
    __( 'The TCD Progressive Web Apps plugin is available to convert TCD themes into PWAs.', 'tcd-w' ),
    // 解説記事URL
    'https://tcd-theme.com/2025/05/tcd-pwa.html',
    // 設定・使い方
    __( 'Settings/How to use', 'tcd-w' ),
    // マイページの商品URL
    'https://tcd.style/order-history?pname=TCD+Progressive+Web+Apps',
    // 今すぐインストール
    __( 'Install Now', 'tcd-w' )
  );
}

?>