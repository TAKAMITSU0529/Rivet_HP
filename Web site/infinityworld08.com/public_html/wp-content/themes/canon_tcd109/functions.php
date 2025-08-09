<?php


// 言語ファイル --------------------------------------------------------------------------------
load_textdomain('tcd-canon', dirname(__FILE__).'/languages/' . get_locale() . '.mo');


// テーマの説明文
__('WordPress theme “CANON” is a template developed for hotel, wedding, and bridal websites. It is designed to take advantage of a luxurious and dynamic design, and includes custom post types for introducing guest rooms and services.', 'tcd-canon');


// 投稿（ブログ）のラベルを変更 --------------------------------------------------------------------------------
$blog_page_id = get_option( 'page_for_posts' );
if($blog_page_id){
  $blog_page_title = esc_html(get_the_title($blog_page_id));
  $blog_label = sprintf(__('Post (%s)', 'tcd-canon'), $blog_page_title);
} else {
  $blog_label = __('Post', 'tcd-canon');
}
// 管理画面のラベルを変更
function change_blog_label( $args, $post_type ) {
  global $blog_label;
  if ( 'post' == $post_type ) {
    $args['label'] = $blog_label;
  }
  return $args;
}
add_filter( 'register_post_type_args', 'change_blog_label', 10, 2 );


// hook wp_head --------------------------------------------------------------------------------
require get_template_directory() . '/functions/head.php';


// テーマオプション --------------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/admin/theme-options.php' );
$options = get_design_plus_option();


// 更新通知 --------------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/functions/update-notifier.php' );


// マニュアル --------------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/functions/manual.php' );


// カスタマイザー設定( 外観 > ウィジェットから設定を取り除く)----------------------------------
require_once  ( dirname(__FILE__) . '/functions/customizer.php' );


// 「トップページ」と「ブログ一覧ページ」用の固定ページ作成機能の実装----------------------------------
require_once  ( dirname(__FILE__) . '/functions/class-page-new.php' );

// フロントページ用スクリプト --------------------------------------------------------------
function front_page_scripts(){

  $options = get_design_plus_option();

  wp_enqueue_style( 'swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), '11.0.0' );
  wp_enqueue_script('swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), '11.0.0', true);
  if( is_front_page() && $options['show_header_content']) {
    wp_enqueue_script( 'header-slider', get_template_directory_uri() . '/js/header-slider.js', array(), version_num(), true );
  }

  wp_enqueue_style( 'main-style', get_stylesheet_uri(), false, version_num(), 'all');
  wp_enqueue_style( 'design-plus', get_template_directory_uri() . '/css/design-plus.css', array('main-style'),version_num() );
  wp_enqueue_style( 'responsive', get_template_directory_uri() . '/css/responsive.css', array('main-style'),version_num(), 'screen and (max-width:1391px)' );
  wp_enqueue_style( 'footer-bar', get_template_directory_uri() . '/css/footer-bar.css', array('main-style'),version_num(), 'screen and (max-width:1391px)' );

  wp_enqueue_script( 'jquery' );
  if ( is_single() ) {
    wp_enqueue_script('comment-reply');
    wp_enqueue_script( 'comment', get_template_directory_uri() . '/js/comment.js', array(), version_num(), true );
  }
  wp_enqueue_script( 'jquery.easing.1.4', get_template_directory_uri() . '/js/jquery.easing.1.4.js', array(), version_num(), true );
  wp_enqueue_script( 'jscript', get_template_directory_uri() . '/js/jscript.js', array(), version_num(), true );
  wp_enqueue_script( 'tcd.cookie.min', get_template_directory_uri() . '/js/tcd.cookie.min.js', array(), version_num(), true );
}
add_action('wp_enqueue_scripts', 'front_page_scripts', 8); //8が無いとブロックエディタによって上書きされる


// 管理画面用スクリプト --------------------------------------------------------------------------
function my_admin_scripts() {
  $options = get_design_plus_option();
  wp_enqueue_script( 'wp-color-picker');
  wp_enqueue_script('thickbox');
  wp_enqueue_script('media-upload');
  wp_enqueue_script('ml-widget-js', get_template_directory_uri().'/widget/js/script.js', '', '1.0.1', true);
  wp_enqueue_script('jquery.cookieTab', get_template_directory_uri().'/admin/js/jquery.cookieTab.js', '', '1.0.0', true);
  wp_enqueue_script('jquery.cookie', get_template_directory_uri().'/js/tcd.cookie.min.js', '', '1.0.0', true);
  wp_enqueue_script('my_script', get_template_directory_uri().'/admin/js/my_script.js', '', '1.0.8', true);
  wp_enqueue_script('new_ui', get_template_directory_uri().'/admin/js/new_ui.js', '', '1.0.0', true);
  wp_enqueue_script('lightcase_script', get_template_directory_uri().'/admin/js/lightcase/lightcase.js', '', '1.0.0', true);
  wp_localize_script( 'my_script', 'TCD_MESSAGES', array(
    'cookieResetSuccess' => __( 'Cookie has been deleted', 'tcd-canon' ),
    'ajaxSubmitSuccess' => __( 'Settings Saved Successfully', 'tcd-canon' ),
    'ajaxSubmitError' => __( 'Can not save data. Please try again', 'tcd-canon' ),
    'tabChangeWithoutSave' => __( "Your changes on the current tab have not been saved.\nTo stay on the current tab so that you can save your changes, click Cancel.", 'tcd-canon' ),
    'contentBuilderDelete' => __( 'Are you sure you want to delete this content?', 'tcd-canon' ),
    'imageContentWidthMessage' => __( '<span>You can display image by content width when you displaying border around the content on LP page.</span>', 'tcd-canon' ),
    'mainColor' => $options['main_color'],
    'deleteCookie' => __( 'Cookie is deleted', 'tcd-canon' ),
    'font_color_picker' => __( 'Font color', 'tcd-canon' ),
    'bg_color_picker' => __( 'Background color', 'tcd-canon' ),
    'font_color_picker_hover' => __( 'Font hover color', 'tcd-canon' ),
    'bg_color_picker_hover' => __( 'Background hover color', 'tcd-canon' ),
  ) );
  wp_enqueue_media();//画像アップロード用
  wp_enqueue_script('cf-media-field', get_template_directory_uri().'/admin/js/cf-media-field.js', '', '1.0.0', true); //画像アップロード用
  wp_localize_script( 'cf-media-field', 'cfmf_text', array(
    'image_title' => __( 'Please select image', 'tcd-canon' ),
    'image_button' => __( 'Use this image', 'tcd-canon' ),
    'video_title' => __( 'Please select MP4 file', 'tcd-canon' ),
    'video_button' => __( 'Use this MP4 file', 'tcd-canon' ),
    'image_save' => __( 'Save', 'tcd-canon' ),
  ) );
  wp_enqueue_script('multi-media-uploader', get_template_directory_uri().'/admin/js/multi-media-uploader.js', '', '1.0.0', true); //複数画像アップロード用
  wp_localize_script( 'multi-media-uploader', 'MULTI_UPLOADER_TEXTS', array(
    'image_title' => __( 'Please select image', 'tcd-canon' ),
    'image_button' => __( 'Use this image', 'tcd-canon' ),
    'image_save' => __( 'Save', 'tcd-canon' ),
  ) );

}
add_action('admin_print_scripts', 'my_admin_scripts');


// 管理画面用スタイルシートの読み込み -----------------------------------------------------------------------
function my_admin_styles() {
  wp_enqueue_style('imgareaselect');
  wp_enqueue_style('jquery-ui-draggable');
  wp_enqueue_style('wp-color-picker');
  wp_enqueue_style('thickbox');
  wp_enqueue_style('my_widget_css', get_template_directory_uri() . '/widget/css/style.css','','1.0.0');
  wp_enqueue_style('my_admin_css', get_template_directory_uri() .'/admin/css/my_admin.css','','1.1.0');
  wp_enqueue_style('new_ui_css', get_template_directory_uri() .'/admin/css/new_ui.css','','1.0.0');
  wp_enqueue_style('lightcase_style', get_template_directory_uri() . '/admin/js/lightcase/lightcase.css','','1.0.0');
  wp_enqueue_style( 'editor-buttons' );
  wp_enqueue_editor();
}
add_action('admin_print_styles', 'my_admin_styles');


//　サムネイルの設定 --------------------------------------------------------------------------------
add_theme_support( 'post-thumbnails' );
add_image_size( 'size1', 400, 400, true );
add_image_size( 'size2', 620, 400, true );// ブログ一覧
add_image_size( 'size3', 950, 472, true );// ギャラリー一覧


// アイキャッチ画像登録エリアに推奨サイズを表示する
function message_image_meta_box($content, $post_id, $thumbnail_id) {
  $post = get_post($post_id);
  $options = get_design_plus_option();
  if ( $post->post_type == 'post' ) {
    $content .= '<p>' . sprintf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-canon'), '900', '580') . '</p>';
    return $content;
  }
  if ( $post->post_type == 'news' ) {
    $content .= '<p>' . sprintf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-canon'), '710', '460') . '</p>';
    return $content;
  }
  if ( $post->post_type == 'gallery') {
    $content .= '<p>' . sprintf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-canon'), '1290', '640') . '</p>';
    return $content;
  }
  if ( $post->post_type == 'service') {
    $content .= '<p>' . sprintf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-canon'), '1450', '560') . '</p>';
    return $content;
  }
  if ( $post->post_type == 'page') {
    $content .= '<p>' . sprintf(__('Recommend image size. Width:%1$spx, Height:%2$spx.<br>This image will be used in search result and OGP tag.', 'tcd-canon'),'1200','630') . '</p>';
    return $content;
  }
  return $content;
}
add_filter('admin_post_thumbnail_html', 'message_image_meta_box', 10, 3);


// 添付ファイルページを無効
add_filter( 'option_wp_attachment_pages_enabled', '__return_false' );


// ウィジェット ------------------------------------------------------------------------
$news_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-canon' );
require_once ( dirname(__FILE__) . '/widget/news_slider.php' );
require_once ( dirname(__FILE__) . '/widget/tab_post_list.php' );
if($options['use_gallery']){
  require_once ( dirname(__FILE__) . '/widget/gallery_slider.php' );
}
if($options['use_service']){
  require_once ( dirname(__FILE__) . '/widget/service_slider.php' );
}
register_sidebar(array(
  'before_widget' => '<div class="widget_content %2$s" id="%1$s">'."\n",
  'after_widget' => "</div>\n",
  'before_title' => '<h3 class="widget_headline"><span>',
  'after_title' => "</span></h3>",
  'name' => __('Common widget', 'tcd-canon'),
  'description' => __('Widgets set in this area are displayed as basic widget in the sidebar of all pages. If there are individual settings, the widget will be displayed.', 'tcd-canon'),
  'id' => 'common_widget'
));
register_sidebar(array(
  'before_widget' => '<div class="widget_content %2$s" id="%1$s">'."\n",
  'after_widget' => "</div>\n",
  'before_title' => '<h3 class="widget_headline"><span>',
  'after_title' => "</span></h3>",
  'name' => __('Common widget (smarphone)', 'tcd-canon'),
  'description' => __('Widgets set in this area are displayed as basic widget in the sidebar of all pages. If there are individual settings, the widget will be displayed.', 'tcd-canon'),
  'id' => 'common_widget_mobile'
));
register_sidebar(array(
  'before_widget' => '<div class="widget_content %2$s" id="%1$s">'."\n",
  'after_widget' => "</div>\n",
  'before_title' => '<h3 class="widget_headline"><span>',
  'after_title' => "</span></h3>",
  'name' => sprintf(__('%s page', 'tcd-canon'), $blog_label),
  'id' => 'post_single_widget'
));
register_sidebar(array(
  'before_widget' => '<div class="widget_content %2$s" id="%1$s">'."\n",
  'after_widget' => "</div>\n",
  'before_title' => '<h3 class="widget_headline"><span>',
  'after_title' => "</span></h3>",
  'name' => sprintf(__('%s page (smartphone)', 'tcd-canon'), $blog_label),
  'description' => __('This widget will be replaced with normal widget when a user accesses the site by smartphone.', 'tcd-canon'),
  'id' => 'post_single_widget_mobile'
));
register_sidebar(array(
  'before_widget' => '<div class="widget_content %2$s" id="%1$s">'."\n",
  'after_widget' => "</div>\n",
  'before_title' => '<h3 class="widget_headline"><span>',
  'after_title' => "</span></h3>",
  'name' => sprintf(__('%s page', 'tcd-canon'), $news_label),
  'id' => 'news_single_widget'
));
register_sidebar(array(
  'before_widget' => '<div class="widget_content %2$s" id="%1$s">'."\n",
  'after_widget' => "</div>\n",
  'before_title' => '<h3 class="widget_headline"><span>',
  'after_title' => "</span></h3>",
  'name' => sprintf(__('%s page (smartphone)', 'tcd-canon'), $news_label),
  'description' => __('This widget will be replaced with normal widget when a user accesses the site by smartphone.', 'tcd-canon'),
  'id' => 'news_single_widget_mobile'
));
register_sidebar(array(
  'before_widget' => '<div class="widget_content %2$s" id="%1$s">'."\n",
  'after_widget' => "</div>\n",
  'before_title' => '<h3 class="widget_headline"><span>',
  'after_title' => "</span></h3>",
  'name' => __('Page', 'tcd-canon'),
  'id' => 'page_single_widget'
));
register_sidebar(array(
  'before_widget' => '<div class="widget_content %2$s" id="%1$s">'."\n",
  'after_widget' => "</div>\n",
  'before_title' => '<h3 class="widget_headline"><span>',
  'after_title' => "</span></h3>",
  'name' => __('Page (smartphone)', 'tcd-canon'),
  'description' => __('This widget will be replaced with normal widget when a user accesses the site by smartphone.', 'tcd-canon'),
  'id' => 'page_single_widget_mobile'
));


// ウィジェットのブロックエディタ無効化
function example_theme_support() {
  remove_theme_support( 'widgets-block-editor' );
}
add_action( 'after_setup_theme', 'example_theme_support' );


// アーカイブウィジェットのタイトルが空の場合見出しを表示しない
function filter_wp_widget_archives_widget_title ( $title, $instance = array(), $id_base = null ) {
	if ( 'archives' === $id_base && empty( $instance['title'] ) || 'categories' === $id_base && empty( $instance['title'] )) {
		$title = '';
	}
	return $title;
}
add_filter( 'widget_title', 'filter_wp_widget_archives_widget_title', 10, 3 );


// アーカイブ・カテゴリーウィジェットの文言を変更
function change_widget_text( $translated, $original, $domain ) {
  if ( $translated == "月を選択" ) {
    $translated = "アーカイブ";
  }
  if ( $translated == "カテゴリーを選択" ) {
    $translated = "カテゴリー";
  }
  return $translated;
}
add_filter( 'gettext', 'change_widget_text', 10, 3 );


// カテゴリーウィジェットの記事数をspanで囲む
function smittenkitchen_cat_count_span( $links ) {
	$links = str_replace( '</a> (', '</a><span class="post-count">', $links );
	$links = str_replace( ')', '</span>', $links );
	return $links;
}
add_filter( 'wp_list_categories', 'smittenkitchen_cat_count_span' );


// アーカイブウィジェットの記事数をspanで囲む
function smittenkitchen_archive_count_span( $links ) {
	$links = str_replace( '</a>&nbsp;(', '</a><span class="post-count">', $links );
	$links = str_replace( ')</li>', '</span></li>', $links );
	return $links;
}
add_filter( 'get_archives_link', 'smittenkitchen_archive_count_span' );


// カードリンクパーツ --------------------------------------------------------------------------------
require get_template_directory() . '/functions/clink.php';


// フッターバー --------------------------------------------------------------------------------
require get_template_directory() . '/functions/footer-bar.php';


// おすすめ記事 --------------------------------------------------------------------------------
require get_template_directory() . '/functions/recommend.php';
require get_template_directory() . '/functions/recommend_news.php';


// アクセス数 --------------------------------------------------------------------------------------
//require get_template_directory() . '/functions/views.php';


// meta title meta description  --------------------------------------------------------------------------------
add_theme_support('title-tag');
require_once ( dirname(__FILE__) . '/functions/seo.php' );


// 管理画面の記事一覧、クイック編集 --------------------------------------------------------------------------------
require get_template_directory() . '/functions/admin_column.php';
require get_template_directory() . '/functions/quick_edit.php';


// カスタムフィールド --------------------------------------------------------------------------------
require get_template_directory() . '/functions/page_cf.php';
require get_template_directory() . '/functions/blog_gallery_cf.php';
require get_template_directory() . '/functions/blog_gallery_category_cf.php';
require get_template_directory() . '/functions/blog_service_cf.php';
require get_template_directory() . '/functions/blog_category_cf.php';
require get_template_directory() . '/functions/news_category_cf.php';
require get_template_directory() . '/functions/gallery_cf.php';
require get_template_directory() . '/functions/gallery_category_cf.php';
require get_template_directory() . '/functions/service_cf.php';


// 並び替え --------------------------------------------------------------------------------
require get_template_directory() . '/functions/post_order.php';


// カスタムCSS・スクリプト --------------------------------------------------------------------------------
require get_template_directory() . '/functions/custom_script.php';


// ビジュアルエディタにクイックタグを追加 --------------------------------------------------------------------------------
require get_template_directory() . '/functions/custom_editor.php';


// ショートコード --------------------------------------------------------------------------------
require get_template_directory() . '/functions/short_code.php';


// ショートコードがpタグで包まれる・brタグが後ろに入る現象を回避
function remove_p_tags_from_shortcodes($the_content){
  $array = array (
    '<p>[' => '[',
    ']</p>' => ']',
    ']<br />' => ']'
  );
  $the_content = strtr($the_content, $array);
  return $the_content;
}
add_filter('the_content', 'remove_p_tags_from_shortcodes');


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


// ロードアイコン -----------------------------------------------------------------------------
require get_template_directory() . '/functions/load_icon.php';
require get_template_directory() . '/functions/footer_script.php';


// パスワード保護 -----------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/functions/password_form.php' );


// 高速化 --------------------------------------------------------------------------------
require ( dirname(__FILE__) . '/functions/acceleration.php' );


// ビジュアルエディタに表(テーブル)の機能を追加 -----------------------------------------------
function mce_external_plugins_table($plugins) {
    $plugins['table'] = 'https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.7.4/plugins/table/plugin.min.js';
    return $plugins;
}
add_filter( 'mce_external_plugins', 'mce_external_plugins_table' );

// tinymceのtableボタンにclass属性プルダウンメニューを追加
function mce_buttons_table($buttons) {
    $buttons[] = 'table';
    return $buttons;
}
add_filter( 'mce_buttons', 'mce_buttons_table' );

function bootstrap_classes_tinymce($settings) {
  $styles = array(
    array('title' => __('Default style', 'tcd-canon'), 'value' => ''),
    array('title' => __('Colored table', 'tcd-canon'), 'value' => 'colored_table'),
    array('title' => __('No border', 'tcd-canon'), 'value' => 'table_no_border'),
    array('title' => __('Display only horizontal border', 'tcd-canon'), 'value' => 'table_border_horizontal'),
  );
  $settings['table_class_list'] = json_encode($styles);
  return $settings;
}
add_filter('tiny_mce_before_init', 'bootstrap_classes_tinymce');


// ビジュアルエディタに文字サイズを追加 ---------------------------------------------------------------------
add_filter('mce_buttons', function ($buttons){
  array_unshift($buttons, 'fontsizeselect');
  return $buttons;
});
add_filter( 'tiny_mce_before_init', function ($settings) {
  $settings['fontsize_formats'] = '10px 12px 14px 16px 18px 20px 24px 28px 32px 36px 42px 48px';
  return $settings;
});


// <table>タグを<div class="s_table">で囲む　ブロックが使われていないエディターのみで動作
// s_tableを使いたくない場合は、tableタグにno_s_tableクラスを付ければ回避できる
function add_classes_to_p_tags($content) {
  if( !has_blocks() ){
    $content = preg_replace_callback('/<table(.*?)>(.*?)<\/table>/s', function($matches) {
      if (preg_match('/class=".*?\bno_s_table\b.*?"/', $matches[1])) {
        return $matches[0];
      } else {
        return '<div class="s_table">' . $matches[0] . '</div>';
      }
    }, $content);
  }
  return $content;
}
add_filter('the_content', 'add_classes_to_p_tags');


// エディタのビジュアル・テキスト切替でコード消滅を防止
function stop_clear_tags( $init_array ) {
  $init_array['valid_elements'] = '*[*]';
  $init_array['extended_valid_elements'] = '*[*]';
  return $init_array;
}
add_filter( 'tiny_mce_before_init' , 'stop_clear_tags' );


// ビジュアルエディタに切り替えで、空の span タグや div タグが消されるのを防止
if ( ! function_exists('tinymce_init') ) {
  function tinymce_init( $init ) {
    $init['verify_html'] = false; // 空タグや属性なしのタグを消させない
    $initArray['valid_children'] = '+body[style], +div[div|span|a], +span[span]'; // 指定の子要素を消させない
    return $init;
  }
  add_filter( 'tiny_mce_before_init', 'tinymce_init', 100 );
}


// 埋め込みコンテンツのレスポンシブ化
add_theme_support( 'responsive-embeds' );


// ユーザーエージェントを判定するための関数---------------------------------------------------------------------
function is_mobile() {

  //wp_is_mobile()が最新のiPhoneを判定できないためこの関数を使う

  $match = 0;

  $ua = array(
   'iPhone', // iPhone
   'iPod', // iPod touch
   'Android.*Mobile', // 1.5+ Android *** Only mobile
   'Windows.*Phone', // *** Windows Phone
   'dream', // Pre 1.5 Android
   'CUPCAKE', // 1.5+ Android
   'BlackBerry', // BlackBerry
   'BB10', // BlackBerry10
   'webOS', // Palm Pre Experimental
   'incognito', // Other iPhone browser
   'webmate', // Other iPhone browser
   'iPad', // タブレットを追加
   'Kindle',
   'Silk',
  );

  $pattern = '/' . implode( '|', $ua ) . '/i';
  $match   = preg_match( $pattern, $_SERVER['HTTP_USER_AGENT'] );

  if ( $match === 1 ) {
    return TRUE;
  } else {
    return FALSE;
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
  remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'remove_recent_comments_style' );

function remove_adminbar_inline_style() {
  remove_action( 'wp_head', '_admin_bar_bump_cb' );
  remove_action( 'wp_head', 'wp_admin_bar_header' );
  remove_action( 'wp_enqueue_scripts', 'wp_enqueue_admin_bar_bump_styles' );
  remove_action( 'wp_enqueue_scripts', 'wp_enqueue_admin_bar_header_styles' );
}
add_action('get_header', 'remove_adminbar_inline_style');


// カスタムメニューの設定 --------------------------------------------------------------------------------
if(function_exists('register_nav_menu')) {
  register_nav_menu( 'global-menu', __( 'Global menu', 'tcd-canon' ));
  register_nav_menu( 'footer-menu1', __( 'Footer menu1', 'tcd-canon' ));
  register_nav_menu( 'footer-menu2', __( 'Footer menu2', 'tcd-canon' ));
  register_nav_menu( 'footer-menu3', __( 'Footer menu3', 'tcd-canon' ));
  register_nav_menu( 'footer-menu4', __( 'Footer menu4', 'tcd-canon' ));
  register_nav_menu( 'footer-menu-mobile1', __( 'Footer menu1 (smartphone)', 'tcd-canon' ));
  register_nav_menu( 'footer-menu-mobile2', __( 'Footer menu2 (smartphone)', 'tcd-canon' ));
}

// current-menu-itemを付ける
function custom_active_item_classes($classes, $menu_item) {
  if(is_tax('news_category') || is_singular('news')){
    $news_archive_page_url = get_post_type_archive_link('news');
    if($menu_item->url == $news_archive_page_url){
      $classes[] = 'current-menu-item';
    }
  }
  if(is_tax('gallery_category') || is_singular('gallery')){
    $case_archive_page_url = get_post_type_archive_link('gallery');
    if($menu_item->url == $case_archive_page_url){
      $classes[] = 'current-menu-item';
    }
  }
  if(is_tax('service_category') || is_singular('service')){
    $case_archive_page_url = get_post_type_archive_link('service');
    if($menu_item->url == $case_archive_page_url){
      $classes[] = 'current-menu-item';
    }
  }
  if(is_singular('post')){
    $blog_page_url = get_permalink(get_option('page_for_posts'));
    if($menu_item->url == $blog_page_url){
      $classes[] = 'current-menu-item';
    }
  }
  if(is_category() || is_tag() || is_day() || is_month() || is_year()){
    $blog_page_url = get_permalink(get_option('page_for_posts'));
    if($menu_item->url == $blog_page_url){
      $classes[] = 'current-menu-item';
    }
  }
  return $classes;
}
add_filter( 'nav_menu_css_class', 'custom_active_item_classes', 10, 2 );


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


// wp_nav_menuのliにclass追加 ------------------------------------------------------------------
function add_additional_class_on_li($classes, $item, $args)
{
  if (isset($args->add_li_class)) {
    $classes['class'] = $args->add_li_class;
  }
  return $classes;
}
add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);


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
    });
  }
}
add_action( 'init', 'disable_emoji' );


// bodyにclassを追加 --------------------------------------------------------------------------------
function tcd_body_classes($classes) {
    global $wp_query, $post;
    $options = get_design_plus_option();

    if(is_mobile()){
      $classes[] = 'mobile_device';
    }

    if (is_page()) {
      $page = get_post();
      $classes[] = 'page_' . esc_attr($page->post_name);
    }

    if( (is_search() && isset($_GET['s']) && empty($_GET['s'])) || (is_search() && !have_posts()) ){
      $classes[] = 'search-no-results';
    };

    if( is_404() || (is_search() && isset($_GET['s']) && empty($_GET['s'])) || (is_search() && !have_posts()) ){
      $classes[] = 'header_fix';
    };

    if($options['show_header_message'] == 'display') {
      $classes[] = 'show_header_message';
    }

    $classes[] = esc_attr($options['megamenu_color_type']);

    if(
       $options['show_loading'] && is_front_page() && $options['loading_display_page'] == 'type1' && $options['loading_display_time'] == 'type1' && !isset($_COOKIE['first_visit']) ||
       $options['show_loading'] && is_front_page() && $options['loading_display_page'] == 'type1' && $options['loading_display_time'] == 'type2' ||
       $options['show_loading'] && $options['loading_display_page'] == 'type2' && $options['loading_display_time'] == 'type1' && !isset($_COOKIE['first_visit']) ||
       $options['show_loading'] && $options['loading_display_page'] == 'type2' && $options['loading_display_time'] == 'type2'
    ){
      $classes[] = 'use_loading_screen';
      $classes[] = 'loading_animation_' . esc_attr($options['loading_animation_type']);
    };

    if($options['site_animation'] == 'type1' || is_front_page() && $options['site_animation'] == 'type2' || (is_front_page() || is_home() || is_archive()) && $options['site_animation'] == 'type3'){
      $classes[] = 'use_page_animation';
    } else {
      $classes[] = 'no_page_animation';
    }

    if(!is_front_page()){
      if( is_page() && (get_post_meta($post->ID, 'hide_sidebar', true) == 'left') ) {
        $classes[] = 'show_sidebar show_sidebar_left';
      } elseif( is_page() && (get_post_meta($post->ID, 'hide_sidebar', true) == 'right') ) {
        $classes[] = 'show_sidebar';
      } elseif( is_page() && (get_post_meta($post->ID, 'hide_sidebar', true) == 'hide') ) {
        $classes[] = 'hide_sidebar';
      };
    }

    if( is_singular('post') && ($options['single_blog_show_side_bar'] == 'left') ) {
      $classes[] = 'show_sidebar show_sidebar_left';
    } elseif( is_singular('post') && ($options['single_blog_show_side_bar'] == 'right') ) {
      $classes[] = 'show_sidebar';
    } elseif( is_singular('post') && ($options['single_blog_show_side_bar'] == 'hide') ) {
      $classes[] = 'hide_sidebar';
    };

    if( is_singular('news') && ($options['single_news_show_side_bar'] == 'left') ) {
      $classes[] = 'show_sidebar show_sidebar_left';
    } elseif( is_singular('news') && ($options['single_news_show_side_bar'] == 'right') ) {
      $classes[] = 'show_sidebar';
    } elseif( is_singular('news') && ($options['single_news_show_side_bar'] == 'hide') ) {
      $classes[] = 'hide_sidebar';
    };

    if(is_page_template('page-tcd-lp.php')){
      if( get_post_meta($post->ID, 'use_page_animation', true) == 'no' ) {
        $classes[] = 'no_page_animation';
      } else {
        $classes[] = 'use_page_animation';
      }
    }

    if( is_page_template('page-tcd-lp.php') && (get_post_meta($post->ID, 'header_height', true) == 'type1') ) {
      $classes[] = 'normal_header_height';
    } elseif( is_page_template('page-tcd-lp.php') && (get_post_meta($post->ID, 'header_height', true) == 'type2')) {
      $classes[] = 'large_header_height';
    };

    if( is_page_template('page-tcd-lp.php') && (get_post_meta($post->ID, 'hide_header_message', true) == 'yes') ) {
      $classes[] = 'hide_header_message';
    };

    if( is_page_template('page-tcd-lp.php') && (get_post_meta($post->ID, 'hide_header_message', true) == 'no') ) {
      $classes[] = 'show_header_message';
    };

    if( is_page_template('page-tcd-lp.php') && (get_post_meta($post->ID, 'hide_page_header', true) == 'yes') ) {
      $classes[] = 'hide_page_header';
    } elseif(is_page_template('page-tcd-lp.php') && (get_post_meta($post->ID, 'hide_page_header', true) != 'yes')) {
      $classes[] = 'show_page_header';
    };

    if( is_page_template('page-tcd-lp.php') && (get_post_meta($post->ID, 'page_hide_footer', true) == 'yes') ) {
      $classes[] = 'hide_footer';
    };

    if(is_archive()) {
      global $wp_query;
      if($wp_query->max_num_pages == 1) {
        $classes[] = 'no_page_nav';
      }
    }

    if( is_single() && (!comments_open() && !pings_open()) ) {
      $classes[] = 'no_comment_form';
    };

    if ( is_mobile() && ($options['footer_bar_type'] != 'type1') ) {
      if(is_404() || (is_search() && isset($_GET['s']) && empty($_GET['s'])) || (is_search() && !have_posts()) ){ } else {
        $classes[] = 'show_footer_bar';
      }
    };

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


// RGBAカラーの明るさを変更する関数 ----------------------------------------------------------------
function adjustBrightness($hex, $steps) {
    // Steps should be between -255 and 255. Negative = darker, positive = lighter
    $steps = max(-255, min(255, $steps));

    // Normalize into a six character long hex string
    $hex = str_replace('#', '', $hex);
    if (strlen($hex) == 3) {
        $hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
    }

    // Split into three parts: R, G and B
    $color_parts = str_split($hex, 2);
    $return = '#';

    foreach ($color_parts as $color) {
        $color   = hexdec($color); // Convert to decimal
        $color   = max(0,min(255,$color + $steps)); // Adjust color
        $return .= str_pad(dechex($color), 2, '0', STR_PAD_LEFT); // Make two char hex code
    }

    return $return;
}


// RGBAカラーの彩度を下げる関数 ----------------------------------------------------------------
function lowerSaturation($hex, $percentage) {
    // Convert HEX to RGB
    list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");

    // Convert RGB to HSL
    $r /= 255;
    $g /= 255;
    $b /= 255;
    $max = max($r, $g, $b);
    $min = min($r, $g, $b);
    $l = ($max + $min) / 2;
    $d = $max - $min;

    if ($d == 0) {
        $h = $s = 0; // achromatic
    } else {
        $s = $d / (1 - abs(2 * $l - 1));
        switch ($max) {
            case $r:
                $h = 60 * fmod((($g - $b) / $d), 6); 
                break;
            case $g: 
                $h = 60 * (($b - $r) / $d + 2); 
                break;
            case $b: 
                $h = 60 * (($r - $g) / $d + 4); 
                break;
        }
    }

    // Lower the saturation
    $s *= (1 - $percentage / 100);

    // Convert HSL back to RGB
    $c = (1 - abs(2 * $l - 1)) * $s;
    $x = $c * (1 - abs(fmod(($h / 60), 2) - 1));
    $m = $l - $c / 2;

    if ($h < 60) {
        $r = $c; $g = $x; $b = 0;
    } else if ($h < 120) {
        $r = $x; $g = $c; $b = 0;          
    } else if ($h < 180) {
        $r = 0; $g = $c; $b = $x;                    
    } else if ($h < 240) {
        $r = 0; $g = $x; $b = $c;
    } else if ($h < 300) {
        $r = $x; $g = 0; $b = $c;
    } else {
        $r = $c; $g = 0; $b = $x;
    }

    $r = ($r + $m) * 255;
    $g = ($g + $m) * 255;
    $b = ($b + $m) * 255;

    // Convert the RGB values to HEX
    $hex = sprintf("#%02x%02x%02x", $r, $g, $b);

    return $hex;
}


// archive_title() 関数をカスタマイズ --------------------------------------------------------------------------------
function monolith_archive_title( $title ) {
	global $author, $post, $wp_query;
	if ( is_author() ) {
		$title = get_the_author_meta( 'display_name', $author );
	} elseif ( is_category() || is_tag() ) {
		$title = single_term_title( '', false );
	} elseif ( is_day() ) {
		$title = get_the_time( __( 'F jS, Y', 'tcd-canon' ), $post );
	} elseif ( is_month() ) {
		$title = get_the_time( __( 'F, Y', 'tcd-canon' ), $post );
	} elseif ( is_year() ) {
		$title = get_the_time( __( 'Y', 'tcd-canon' ), $post );
	} elseif ( is_search() ) {
		if ( $wp_query->found_posts ) {
			//$title = sprintf( __( 'Search results for - ', 'tcd-canon' ) . get_search_query() 
		} else {
			$title = __( 'Search result', 'tcd-canon' );
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
  <?php if (function_exists('get_avatar') && get_option('show_avatars')) { echo get_avatar($comment, 60); } ?>
  
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
    <li class="comment-reply"><?php comment_reply_link(array_merge( $args, array('add_below' => 'comment-content', 'depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => '<span><span>'.__('REPLY','tcd-canon').'</span></span>'))) ?></li>
<?php   } else { ?>
    <li class="comment-reply"><a href="javascript:void(0);" onclick="tcd_comment_function.replyToComment('commentauthor-<?php comment_ID() ?>', 'comment-<?php comment_ID() ?>', 'comment');"><?php _e('REPLY', 'tcd-canon'); ?></a></li>
<?php   }
      } else { ?>
    <li class="comment-reply"><a href="javascript:void(0);" onclick="tcd_comment_function.replyToComment('commentauthor-<?php comment_ID() ?>', 'comment-<?php comment_ID() ?>', 'comment');"><?php _e('REPLY', 'tcd-canon'); ?></a></li>
<?php } ?>
    <li class="comment-quote"><a href="javascript:void(0);" onclick="tcd_comment_function.quoteComment('commentauthor-<?php comment_ID() ?>', 'comment-<?php comment_ID() ?>', 'comment-content-<?php comment_ID() ?>', 'comment');"><?php _e('QUOTE', 'tcd-canon'); ?></a></li>
    <?php edit_comment_link(__('EDIT', 'tcd-canon'), '<li class="comment-edit">', '</li>'); ?>
   </ul>

  </div>
  <div class="comment-content post_content" id="comment-content-<?php comment_ID() ?>">
  <?php if ($comment->comment_approved == '0') : ?>
   <span class="comment-note"><?php _e('Your comment is awaiting moderation.', 'tcd-canon'); ?></span>
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


// カスタム投稿の数が多い為、メディアメニューの位置を変更 ----------------------------------------------------------
function customize_menus(){
  global $menu;
  $menu[19] = $menu[10];
  unset($menu[10]);
}
add_action( 'admin_menu', 'customize_menus' );


// カスタム投稿とタクソノミーの追加 --------------------------------------------------------------------------------

function custom_post_type_init() {

$options = get_design_plus_option();

// カスタム投稿「お知らせ」 --------------------------------------------------------------------------------
if($options['use_news']){
$news_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-canon' );
$news_slug = $options['news_slug'] ? sanitize_title( $options['news_slug'] ) : 'news';
$news_labels = array(
  'name' => $news_label,
  'add_new' => __( 'Add New', 'tcd-canon' ),
  'add_new_item' => __( 'Add New Item', 'tcd-canon' ),
  'edit_item' => __( 'Edit', 'tcd-canon' ),
  'new_item' => __( 'New item', 'tcd-canon' ),
  'view_item' => __( 'View Item', 'tcd-canon' ),
  'search_items' => __( 'Search Items', 'tcd-canon' ),
  'not_found' => __( 'Not Found', 'tcd-canon' ),
  'not_found_in_trash' => __( 'Not found in trash', 'tcd-canon' ),
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
  'supports' => array( 'title', 'editor', 'thumbnail', 'author' ),
  'show_in_rest' => true
));


// 「お知らせ」カテゴリー
$news_category_label = sprintf(__('%s category', 'tcd-canon'), $news_label);
$news_category_slug = $news_slug . '_category';
$news_category_labels = array(
  'name' => $news_category_label,
  'singular_name' => $news_category_label
);
register_taxonomy( 'news_category', 'news', array(
  'labels' => $news_category_labels,
  'hierarchical' => true,
  'rewrite' => array( 'slug' => $news_category_slug ),
  'show_in_rest' => true
));


}; //end if use news


// カスタム投稿「ギャラリー」 --------------------------------------------------------------------------------
if($options['use_gallery']){

$gallery_label = $options['gallery_label'] ? esc_html( $options['gallery_label'] ) : __( 'Guest room', 'tcd-canon' );
$gallery_slug = $options['gallery_slug'] ? sanitize_title( $options['gallery_slug'] ) : 'gallery';
$gallery_labels = array(
  'name' => $gallery_label,
  'add_new' => __( 'Add New', 'tcd-canon' ),
  'add_new_item' => __( 'Add New Item', 'tcd-canon' ),
  'edit_item' => __( 'Edit', 'tcd-canon' ),
  'new_item' => __( 'New item', 'tcd-canon' ),
  'view_item' => __( 'Display post', 'tcd-canon' ),
  'search_items' => __( 'Search Items', 'tcd-canon' ),
  'not_found' => __( 'Not Found', 'tcd-canon' ),
  'not_found_in_trash' => __( 'Not found in trash', 'tcd-canon' ),
  'parent_item_colon' => ''
);

register_post_type( 'gallery', array(
  'label' => $gallery_label,
  'labels' => $gallery_labels,
  'public' => true,
  'publicly_queryable' => true,
  'menu_position' => 5,
  'show_ui' => true,
  'query_var' => true,
  'rewrite' => array( 'slug' => $gallery_slug ),
  'capability_type' => 'post',
  'has_archive' => true,
  'hierarchical' => false,
  'supports' => array( 'title', 'editor', 'thumbnail'),
  'show_in_rest' => true
));

// 「ギャラリー」カテゴリー
if($options['gallery_use_category'] == 'yes'){

$gallery_category_label = sprintf(__('%s category', 'tcd-canon'), $gallery_label);
$gallery_category_slug = $gallery_slug . '_category';
$gallery_category_labels = array(
  'name' => $gallery_category_label,
  'singular_name' => $gallery_category_label
);
register_taxonomy( 'gallery_category', 'gallery', array(
  'labels' => $gallery_category_labels,
  'hierarchical' => true,
  'rewrite' => array( 'slug' => $gallery_category_slug ),
  'show_in_rest' => true
));

// 説明文を消す
add_filter('manage_edit-gallery_category_columns', 'remove_gallery_category_description_column');
function remove_gallery_category_description_column($columns) {
    if (isset($columns['description'])) {
        unset($columns['description']);
    }
    return $columns;
}

}

}; //end if use gallery


// カスタム投稿「サービス」 --------------------------------------------------------------------------------
if($options['use_service']){

$service_label = $options['service_label'] ? esc_html( $options['service_label'] ) : __( 'Service', 'tcd-canon' );
$service_slug = $options['service_slug'] ? sanitize_title( $options['service_slug'] ) : 'service';
$service_labels = array(
  'name' => $service_label,
  'add_new' => __( 'Add New', 'tcd-canon' ),
  'add_new_item' => __( 'Add New Item', 'tcd-canon' ),
  'edit_item' => __( 'Edit', 'tcd-canon' ),
  'new_item' => __( 'New item', 'tcd-canon' ),
  'view_item' => __( 'Display post', 'tcd-canon' ),
  'search_items' => __( 'Search Items', 'tcd-canon' ),
  'not_found' => __( 'Not Found', 'tcd-canon' ),
  'not_found_in_trash' => __( 'Not found in trash', 'tcd-canon' ),
  'parent_item_colon' => ''
);

register_post_type( 'service', array(
  'label' => $service_label,
  'labels' => $service_labels,
  'public' => true,
  'publicly_queryable' => true,
  'menu_position' => 5,
  'show_ui' => true,
  'query_var' => true,
  'rewrite' => array( 'slug' => $service_slug ),
  'capability_type' => 'post',
  'has_archive' => true,
  'hierarchical' => false,
  'supports' => array( 'title', 'thumbnail', 'editor'),
  'show_in_rest' => true
));


}; //end if use service


// カスタム投稿ここまで

}
add_action( 'init', 'custom_post_type_init' );


/* ブログアーカイブページの表示数を変更 */
function change_blog_num( $query ) {
  if( (!is_admin() && is_archive()) || (!is_admin() && is_home()) || (!is_admin() && is_search())) {
    if($query->is_main_query()) {
      $post_num = get_option('posts_per_page');
      if(!is_mobile()){
        $query->set('posts_per_page', $post_num);
      }
      return;
    };
  }
}
add_action( 'pre_get_posts', 'change_blog_num' );


/* お知らせアーカイブページの記事数を変更 */
function change_news_num( $query ) {
  $options = get_design_plus_option();
  if(is_mobile()){
    $post_num = $options['archive_news_num_sp'];
  } else {
    $post_num = $options['archive_news_num'];
  }
  if( !is_admin() && is_post_type_archive('news') || !is_admin() && is_tax('news_category') ) {
    if($query->is_main_query()) {
      $query->set('posts_per_page', $post_num);
      return;
    };
  }
}
add_action( 'pre_get_posts', 'change_news_num' );


/* ギャラリーアーカイブページの記事数を変更 */
function change_gallery_archive_num( $query ) {
  $options = get_design_plus_option();
  if($options['gallery_use_category'] == 'no'){
    if(is_mobile()){
      $post_num = $options['archive_gallery_non_category_num_sp'];
    } else {
      $post_num = $options['archive_gallery_non_category_num'];
    }
    if( !is_admin() && is_post_type_archive('gallery') ) {
      if($query->is_main_query()) {
        $query->set('posts_per_page', $post_num);
        return;
      };
    }
  }
}
add_action( 'pre_get_posts', 'change_gallery_archive_num' );


/* ギャラリーカテゴリーページの記事数を変更 */
function change_gallery_category_num( $query ) {
  $options = get_design_plus_option();
  if(is_mobile()){
    $post_num = $options['archive_gallery_num_sp'];
  } else {
    $post_num = $options['archive_gallery_num'];
  }
  if( !is_admin() && is_tax('gallery_category')) {
    if($query->is_main_query()) {
      $query->set('posts_per_page', $post_num);
      return;
    };
  }
}
add_action( 'pre_get_posts', 'change_gallery_category_num' );


/* サービスアーカイブページの記事数を変更 */
function change_service_num( $query ) {
  $options = get_design_plus_option();
  if(is_mobile()){
    $post_num = $options['archive_service_num_sp'];
  } else {
    $post_num = $options['archive_service_num'];
  }
  if( !is_admin() && is_post_type_archive('service')) {
    if($query->is_main_query()) {
      $query->set('posts_per_page', $post_num);
      return;
    };
  }
}
add_action( 'pre_get_posts', 'change_service_num' );


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


// 検索対象にする記事タイプを設定 --------------------------------------------------------------------------------
function SearchFilter($query) {
  $options = get_design_plus_option();
  if ( !is_admin() && $query->is_main_query() && $query->is_search() ) {
    $post_types = array();
    if($options['search_type_post'] == 'yes'){
      array_push($post_types,'post');
    }
    if($options['search_type_page'] == 'yes'){
      array_push($post_types,'page');
    }
    if($options['use_news'] && $options['search_type_news'] == 'yes'){
      array_push($post_types,'news');
    }
    if($options['use_gallery'] && $options['search_type_gallery'] == 'yes'){
      array_push($post_types,'gallery');
    }
    if($options['use_service'] && $options['search_type_service'] == 'yes'){
      array_push($post_types,'service');
    }
    $query->set('post_type', $post_types );

    if($options['search_type_post'] == 'no' && $options['search_type_page'] == 'no' && $options['search_type_news'] == 'no' && $options['search_type_gallery'] == 'no' && $options['search_type_service'] == 'no'){
      $query->set('name', 'set_dummy_page_id' );
    }

    if($options['search_type_page'] == 'yes'){
      $front_page_id = get_option('page_on_front');
      if($front_page_id){
        $query->set('post__not_in', array($front_page_id) );
      }
    }
  }
}
add_action( 'pre_get_posts','SearchFilter' );


// タイトルとurlをコピーのスクリプト --------------------------------------------------------------------------------
function copy_title_url_script() {
  global $options;
  if ( ! $options ) $options = get_design_plus_option();

  if ( (is_singular('post') && $options['single_blog_show_copy'] != 'hide') || (is_singular('news') && $options['single_news_show_copy'] != 'hide') ) {
    wp_enqueue_script( 'copy_title_url', get_template_directory_uri().'/js/copy_title_url.js', array(), version_num(), true );
  }
}
add_action( 'wp_enqueue_scripts', 'copy_title_url_script' );


// カテゴリー編集画面にIDを表示する ------------------------------------------------------------------------------------
function add_category_columns( $columns ) {
  echo '<style>
  .taxonomy-category .manage-column.num {width: 90px;}
  .taxonomy-category .manage-column.column-id {width: 60px;}
  </style>';

  $columns['id'] = 'ID';
  return $columns;
}
function add_category_sortable_columns( $columns ) {
  $columns['id'] = 'ID';
  return $columns;
}
function custom_category_column( $content, $column_name, $term_id ) {
  if ( $column_name == 'id' ) {
    echo $term_id;
  }
}
add_filter( 'manage_edit-category_columns', 'add_category_columns' );
add_filter( 'manage_edit-category_sortable_columns', 'add_category_sortable_columns' );
add_action( 'manage_category_custom_column', 'custom_category_column', 10, 3 );


// ページのナビの有無をチェック ---------------------------------------------------------------------------------------
function show_posts_nav() {
  global $wp_query;
  return ($wp_query->max_num_pages > 1);
};


// ブログ用固定ページからメタボックス削除 ------------------------------------------------------------------------
function tcd_remove_meta_boxes() {
  global $typenow, $post;

  // ホームページ・投稿ページ表示に設定されているに固定ページ編集時
  if ( 'page' === $typenow && ! empty( $post->ID ) && 'page' === get_option('show_on_front') && in_array( $post->ID, array( get_option( 'page_on_front' ), get_option( 'page_for_posts' ) ) ) ) {
    remove_meta_box( 'tcd_meta_box1', 'page', 'normal' );
    remove_meta_box( 'select_pw_meta_box', 'page', 'normal' );
    remove_meta_box( 'postexcerpt', 'page', 'normal' );
    remove_meta_box( 'pageparentdiv', 'page', 'normal' );
  }

}
add_action( 'add_meta_boxes', 'tcd_remove_meta_boxes', 999 );


// 子カテゴリーや孫カテゴリーが存在するかチェック ------------------------------------------------------------------------
function taxonomy_has_descendant_categories($taxonomy) {
  // すべてのタームを取得
  $terms = get_terms(array(
    'taxonomy' => $taxonomy,
    'hide_empty' => true,
  ));
  // 各タームについて子カテゴリーをチェック
  foreach ($terms as $term) {
    $child_categories = get_terms(array(
      'taxonomy' => $taxonomy,
      'parent' => $term->term_id,
      'hide_empty' => true,
    ));
    if (!empty($child_categories) && !is_wp_error($child_categories)) {
      return true;
     }
     // 再帰的に孫カテゴリー以下をチェック
     foreach ($child_categories as $child) {
       if (taxonomy_has_descendant_categories_recursive($child->term_id, $taxonomy)) {
         return true;
       }
     }
  }
  return false;
}


?>