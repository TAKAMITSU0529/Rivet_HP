<?php
/*
 * オプションの設定
 */

//フォントの縦方向
global $font_direction_options;
$font_direction_options = array(
  'type1' => array('value' => 'type1','label' => __( 'Horizontal', 'tcd-canon' )),
  'type2' => array('value' => 'type2','label' => __( 'Vertical', 'tcd-canon' )),
);


// コンテンツの方向
global $content_direction_options;
$content_direction_options = array(
 'type1' => array('value' => 'type1', 'label' => __( 'Align left', 'tcd-canon' )),
 'type2' => array('value' => 'type2', 'label' => __( 'Align center', 'tcd-canon' )),
 'type3' => array('value' => 'type3', 'label' => __( 'Align right', 'tcd-canon' ))
);


// コンテンツの方向（縦方向）
global $content_direction_options2;
$content_direction_options2 = array(
 'type1' => array('value' => 'type1', 'label' => __( 'Align top', 'tcd-canon' )),
 'type2' => array('value' => 'type2', 'label' => __( 'Align middle', 'tcd-canon' )),
 'type3' => array('value' => 'type3', 'label' => __( 'Align bottom', 'tcd-canon' ))
);


// hover effect
global $hover_type_options;
$hover_type_options = array(
  'type1' => array('value' => 'type1','label' => __( 'Zoom in', 'tcd-canon' )),
  'type2' => array('value' => 'type2','label' => __( 'Zoom out', 'tcd-canon' )),
  'type3' => array('value' => 'type3','label' => __( 'Slide', 'tcd-canon' )),
  'type4' => array('value' => 'type4','label' => __( 'Fade', 'tcd-canon' )),
  'type5' => array('value' => 'type5','label' => __( 'No animation', 'tcd-canon' ))
);
global $hover3_direct_options;
$hover3_direct_options = array(
  'type2' => array('value' => 'type2','label' => __( 'Right to Left', 'tcd-canon' )),
  'type1' => array('value' => 'type1','label' => __( 'Left to Right', 'tcd-canon' )),
);


//フォントタイプ
global $font_type_options;
$font_type_options = array(
  'type1' => array('value' => 'type1','label' => __( 'Meiryo', 'tcd-canon' ),'label_en' => 'Arial'),
  'type2' => array('value' => 'type2','label' => __( 'YuGothic', 'tcd-canon' ),'label_en' => 'San Serif'),
  'type3' => array('value' => 'type3','label' => __( 'YuMincho', 'tcd-canon' ),'label_en' => 'Times New Roman')
);


// ソーシャルボタンの設定
global $sns_type_options;
$sns_type_options = array(
  'type1' => array( 'value' => 'type1', 'label' => __( 'Type1 (color)', 'tcd-canon' ), 'img' => 'share_type1.jpg'),
  'type2' => array( 'value' => 'type2', 'label' => __( 'Type2 (mono)', 'tcd-canon' ), 'img' => 'share_type2.jpg'),
  'type3' => array( 'value' => 'type3', 'label' => __( 'Type3 (4 column - color)', 'tcd-canon' ), 'img' => 'share_type3.jpg'),
  'type4' => array( 'value' => 'type4', 'label' => __( 'Type4 (4 column - mono)', 'tcd-canon' ), 'img' => 'share_type4.jpg'),
  'type5' => array( 'value' => 'type5', 'label' => __( 'Type5 (official design)', 'tcd-canon' ), 'img' => 'share_type5.jpg')
);


// ロゴに画像を使うか否か
global $logo_type_options;
$logo_type_options = array(
  'type1' => array(
    'value' => 'type1',
    'label' => __( 'Use text for logo', 'tcd-canon' ),
    'image' => get_template_directory_uri() . '/admin/img/header_logo_type1.gif'
  ),
  'type2' => array(
    'value' => 'type2',
    'label' => __( 'Use image for logo', 'tcd-canon' ),
    'image' => get_template_directory_uri() . '/admin/img/header_logo_type2.gif'
  )
);


// Google Maps
global $gmap_marker_type_options;
$gmap_marker_type_options = array(
  'type1' => array( 'value' => 'type1', 'label' => __( 'Use default marker', 'tcd-canon' ), 'img' => 'gmap_marker_type1.jpg'),
  'type2' => array( 'value' => 'type2', 'label' => __( 'Use custom marker', 'tcd-canon' ), 'img' => 'gmap_marker_type2.jpg' )
);
global $gmap_custom_marker_type_options;
$gmap_custom_marker_type_options = array(
  'type1' => array( 'value' => 'type1', 'label' => __( 'Text', 'tcd-canon' ) ),
  'type2' => array( 'value' => 'type2', 'label' => __( 'Image', 'tcd-canon' ) )
);


// アイテムのタイプ
global $item_type_options;
$item_type_options = array(
  'type1' => array('value' => 'type1','label' => __( 'Image', 'tcd-canon' )),
  'type2' => array('value' => 'type2','label' => __( 'Video', 'tcd-canon' )),
  'type3' => array('value' => 'type3','label' => __( 'Youtube', 'tcd-canon' )),
);


// スライダーのコンテンツタイプ
global $index_slider_content_type_options;
$index_slider_content_type_options = array(
  'type1' => array('value' => 'type1','label' => __( 'Same as PC setting', 'tcd-canon' )),
  'type2' => array('value' => 'type2','label' => __( 'Display diffrent content in mobile size', 'tcd-canon' )),
);


// 表示設定
global $basic_display_options;
$basic_display_options = array(
	'display' => array(
		'value' => 'display',
		'label' => __( 'Display', 'tcd-canon' ),
	),
	'hide' => array(
		'value' => 'hide',
		'label' => __( 'Hide', 'tcd-canon' ),
	)
);


// 表示設定
global $single_page_display_options;
$single_page_display_options = array(
	'top' => array(
		'value' => 'top',
		'label' => __( 'Above post', 'tcd-canon' ),
	),
	'bottom' => array(
		'value' => 'bottom',
		'label' => __( 'Under post', 'tcd-canon' ),
	),
	'both' => array(
		'value' => 'both',
		'label' => __( 'Both above and bottom', 'tcd-canon' ),
	),
	'hide' => array(
		'value' => 'hide',
		'label' => __( 'Hide', 'tcd-canon' ),
	),
);


// クイックタグ関連 -------------------------------------------------------------------------------------------


// テキストの方向（クイックタグで利用中）
global $text_align_options;
$text_align_options = array(
 'left' => array('value' => 'left', 'label' => __( 'Align left', 'tcd-canon' )),
 'center' => array('value' => 'center', 'label' => __( 'Align center', 'tcd-canon' )),
);


// 見出し
global $font_weight_options;
$font_weight_options = array(
	'400' => array('value' => '400','label' => __( 'Normal', 'tcd-canon' )),
	'600' => array('value' => '600','label' => __( 'Bold', 'tcd-canon' ))
);
global $border_potition_options;
$border_potition_options = array(
	'left' => array('value' => 'left','label' => __( 'Left', 'tcd-canon' )),
	'top' => array('value' => 'top','label' => __( 'Top', 'tcd-canon' )),
	'bottom' => array('value' => 'bottom','label' => __( 'Bottom', 'tcd-canon' )),
	'right' => array('value' => 'right','label' => __( 'Right', 'tcd-canon' ))
);
global $border_style_options;
$border_style_options = array(
	'solid' => array('value' => 'solid','label' => __( 'Solid line', 'tcd-canon' )),
	'dotted' => array('value' => 'dotted','label' => __( 'Dot line', 'tcd-canon' )),
	'double' => array('value' => 'double','label' => __( 'Double line', 'tcd-canon' ))
);


// ボタン
global $button_type_options;
$button_type_options = array(
	'type1' => array('value' => 'type1','label' => __( 'Normal', 'tcd-canon' )),
	'type2' => array('value' => 'type2','label' => __( 'Ghost', 'tcd-canon' )),
	'type3' => array('value' => 'type3','label' => __( 'Reverse', 'tcd-canon' ))
);
global $button_border_radius_options;
$button_border_radius_options = array(
	'flat' => array('value' => 'flat','label' => __( 'Square', 'tcd-canon' )),
	'rounded' => array('value' => 'rounded','label' => __( 'Rounded', 'tcd-canon' )),
	'oval' => array('value' => 'oval','label' => __( 'Pill', 'tcd-canon' ))
);
global $button_size_options;
$button_size_options = array(
	'small' => array('value' => 'small','label' => __( 'Small', 'tcd-canon' )),
	'medium' => array('value' => 'medium','label' => __( 'Medium', 'tcd-canon' )),
	'large' => array('value' => 'large','label' => __( 'Large', 'tcd-canon' ))
);
global $button_animation_options;
$button_animation_options = array(
	'animation_type1' => array('value' => 'animation_type1','label' => __( 'Fade', 'tcd-canon' )),
	'animation_type2' => array('value' => 'animation_type2','label' => __( 'Swipe', 'tcd-canon' )),
	'animation_type3' => array('value' => 'animation_type3','label' => __( 'Diagonal swipe', 'tcd-canon' ))
);


// 囲み枠
global $flame_border_radius_options;
$flame_border_radius_options = array(
	'0' => array('value' => '0','label' => __( 'Square', 'tcd-canon' )),
	'10' => array('value' => '10','label' => __( 'Rounded', 'tcd-canon' ))
);


// アンダーライン
global $bool_options;
$bool_options = array(
	'yes' => array('value' => 'yes','label' => __( 'Yes', 'tcd-canon' )),
	'no' => array('value' => 'no','label' => __( 'No', 'tcd-canon' ))
);


// Google Map
global $google_map_design_options;
$google_map_design_options = array(
	'default' => array('value' => 'default','label' => __( 'Default', 'tcd-canon' )),
	'monochrome' => array('value' => 'monochrome','label' => __( 'Monochrome', 'tcd-canon' ))
);
global $google_map_marker_options;
$google_map_marker_options = array(
	'type1' => array('value' => 'type1','label' => __( 'Default', 'tcd-canon' )),
	'type2' => array('value' => 'type2','label' => __( 'Text', 'tcd-canon' )),
	'type3' => array('value' => 'type3','label' => __( 'Image', 'tcd-canon' ))
);



// ロード画面関連 -------------------------------------------------------------------------------------------


// ロードアイコンの表示時間
global $time_options;
$time_options = array(
  '1000' => array('value' => '1000','label' => sprintf(__('%s second', 'tcd-canon'), 1)),
  '2000' => array('value' => '2000','label' => sprintf(__('%s second', 'tcd-canon'), 2)),
  '3000' => array('value' => '3000','label' => sprintf(__('%s second', 'tcd-canon'), 3)),
  '4000' => array('value' => '4000','label' => sprintf(__('%s second', 'tcd-canon'), 4)),
  '5000' => array('value' => '5000','label' => sprintf(__('%s second', 'tcd-canon'), 5)),
);


// ローディングアイコンの種類の設定
global $loading_type;
$loading_type = array(
	'type1' => array(
		'value' => 'type1',
		'label' => __( 'Circle', 'tcd-canon' ),
		'image' => get_template_directory_uri() . '/admin/img/load_smaple.jpg'
	),
	'type2' => array(
		'value' => 'type2',
		'label' => __( 'Square', 'tcd-canon' ),
		'image' => get_template_directory_uri() . '/admin/img/load_smaple.jpg'
	),
	'type3' => array(
		'value' => 'type3',
		'label' => __( 'Dot circle', 'tcd-canon' ),
		'image' => get_template_directory_uri() . '/admin/img/load_smaple.jpg'
	),
	'type4' => array(
		'value' => 'type4',
		'label' => __( 'Logo', 'tcd-canon' ),
		'image' => get_template_directory_uri() . '/admin/img/load_smaple.jpg'
	),
	'type5' => array(
		'value' => 'type5',
		'label' => __( 'Catchphrase', 'tcd-canon' ),
		'image' => get_template_directory_uri() . '/admin/img/load_smaple.jpg'
	)
);


global $loading_display_page_options;
$loading_display_page_options = array(
 'type1' => array('value' => 'type1','label' => __( 'Front page', 'tcd-canon' )),
 'type2' => array('value' => 'type2','label' => __( 'All pages', 'tcd-canon' ))
);


global $loading_display_time_options;
$loading_display_time_options = array(
 'type1' => array('value' => 'type1','label' => __( 'Only once', 'tcd-canon' )),
 'type2' => array('value' => 'type2','label' => __( 'Every time', 'tcd-canon' ))
);


global $loading_animation_type_options;
$loading_animation_type_options = array(
  'type1' => array('value' => 'type1','label' => __( 'Fade', 'tcd-canon' )),
  'type2' => array('value' => 'type2','label' => __( 'Float', 'tcd-canon' )),
  'type3' => array('value' => 'type3','label' => sprintf( __( 'Slides(%s)', 'tcd-canon' ), '&#x2192;' ) ),
  'type4' => array('value' => 'type4','label' => sprintf( __( 'Slides(%s)', 'tcd-canon' ), '&#x2191;' ) ),
);


global $footer_bar_type_options;
$footer_bar_type_options = array(
	'type1' => array(
		'value' => 'type1',
		'label' => __( 'Hide', 'tcd-canon' ),
		'image' => get_template_directory_uri() . '/admin/img/footer_bar_type1.jpg'
	),
	'type2' => array(
		'value' => 'type2',
		'label' => __( 'Button with icon (Dark color)', 'tcd-canon' ),
		'image' => get_template_directory_uri() . '/admin/img/footer_bar_type2.jpg'
	),
	'type3' => array(
		'value' => 'type3',
		'label' => __( 'Button with icon (Light color)', 'tcd-canon' ),
		'image' => get_template_directory_uri() . '/admin/img/footer_bar_type3.jpg'
	),
	'type4' => array(
		'value' => 'type4',
		'label' => __( 'Button without icon', 'tcd-canon' ),
		'image' => get_template_directory_uri() . '/admin/img/footer_bar_type4.jpg'
	)
);


// フッターの固定メニュー ボタンのタイプ
global $footer_bar_button_options;
$footer_bar_button_options = array(
  'type1' => array('value' => 'type1', 'label' => __( 'Default', 'tcd-canon' )),
  'type2' => array('value' => 'type2', 'label' => __( 'Share', 'tcd-canon' )),
  'type3' => array('value' => 'type3', 'label' => __( 'Telephone', 'tcd-canon' ))
);


// ウェブアイコン
global $web_icon_options;
$web_icon_options = array(
	'e937' =>  array( 'type' => 'google', 'label' => 'Telephone' ), // 電話
	'e919' =>  array( 'type' => 'google', 'label' => 'Smartphone' ), // スマホ
	'e92b' =>  array( 'type' => 'google', 'label' => 'Mail' ), // メール
	'e93c' =>  array( 'type' => 'google', 'label' => 'Calendar' ), // カレンダー
	'e91d' =>  array( 'type' => 'google', 'label' => 'User' ), // ユーザー
	'e90b' =>  array( 'type' => 'google', 'label' => 'Cart' ), // カート
	'e939' =>  array( 'type' => 'google', 'label' => 'Bed' ), // ベッド
	'e938' =>  array( 'type' => 'google', 'label' => 'Restaurant' ), // レストラン
	'e92a' =>  array( 'type' => 'google', 'label' => 'Cafe' ), // カフェ
	'e927' =>  array( 'type' => 'google', 'label' => 'Bar' ), // バー
	'e941' =>  array( 'type' => 'google', 'label' => 'HotSpring' ), // 温泉
	'e931' =>  array( 'type' => 'google', 'label' => 'Heart' ), // ハート
	'e93d' =>  array( 'type' => 'google', 'label' => 'Bookmark' ), // ブックマーク
	'e92d' =>  array( 'type' => 'google', 'label' => 'Map' ), // マップ
	'e928' =>  array( 'type' => 'google', 'label' => 'Menu' ), // メニュー（3本線）
	'e92f' =>  array( 'type' => 'google', 'label' => 'Info' ), // インフォ
	'e916' =>  array( 'type' => 'google', 'label' => 'Share' ), // シェア
	'e909' =>  array( 'type' => 'sns', 'label' => 'LINE' ), // Line
	'ea92' =>  array( 'type' => 'sns', 'label' => 'Instagram' ), // Instagram
	'e94d' =>  array( 'type' => 'sns', 'label' => 'TikTok' ), // TikTok
	'e950' =>  array( 'type' => 'sns', 'label' => 'Twitter' ), // Twitter
	'e944' =>  array( 'type' => 'sns', 'label' => 'Facebook' ), // Facebook
	'ea9d' =>  array( 'type' => 'sns', 'label' => 'YouTube' ), // YouTube
);


// カラープリセット
define( 'TCD_COLOR_PRESET', array(
	__('Navy', 'tcd-canon') => array(
		'main' => '#000c2e',
		'bg' => '#eceff4'
	),
	__('Green', 'tcd-canon') => array(
		'main' => '#004000',
		'bg' => '#ecf4f0'
	),
	__('Olive', 'tcd-canon') => array(
		'main' => '#553D07',
		'bg' => '#f4f3ec'
	),
	__('Bourdeax', 'tcd-canon') => array(
		'main' => '#660000',
		'bg' => '#f4ecec'
	),
	__('Brown', 'tcd-canon') => array(
		'main' => '#371c00',
		'bg' => '#f4f1ec'
	),
) );


// ツイッターのサムネイルサイズ
$twitter_image_options = array(
	'summary' => array('value' => 'summary','label' => __( 'Normal', 'tcd-canon' )),
	'summary_large_image' => array('value' => 'summary_large_image','label' => __( 'Largish', 'tcd-canon' ))
);


// リスト用　カラープリセット
define( 'TCD_COLOR_PRESET_FOR_LIST', array(
	'color0' => array(
		'main' => '#ffffff',
	),
	'color1' => array(
		'main' => '#f4f1ec',
	),
	'color2' => array(
		'main' => '#f4f3ec',
	),
	'color3' => array(
		'main' => '#f4ecec',
	),
	'color4' => array(
		'main' => '#ecf4f0',
	),
	'color5' => array(
		'main' => '#eceff4',
	)
) );


// フッター用　カラープリセット
define( 'TCD_COLOR_PRESET_FOR_FOOTER', array(
	'color0' => array(
		'main' => '#000000',
	),
	'color1' => array(
		'main' => '#371C00',
	),
	'color2' => array(
		'main' => '#553D07',
	),
	'color3' => array(
		'main' => '#660000',
	),
	'color4' => array(
		'main' => '#114701',
	),
	'color5' => array(
		'main' => '#002040',
	)
) );


// トップページ　ヘッダーコンテンツ
global $index_header_type_options;
$index_header_type_options = array(
  'type1' => array(
    'value' => 'type1',
    'label' => __( 'Logo', 'tcd-canon' ),
    'image' => get_template_directory_uri() . '/admin/img/index_header_type1.jpg'
  ),
  'type2' => array(
    'value' => 'type2',
    'label' => __( 'Text content', 'tcd-canon' ),
    'image' => get_template_directory_uri() . '/admin/img/index_header_type2.jpg'
  )
);


// メガメニューのカラータイプ
global $megamenu_color_type_options;
$megamenu_color_type_options = array(
  'megamenu_light_color' => array(
    'value' => 'megamenu_light_color',
    'label' => __( 'Light color', 'tcd-canon' ),
    'image' => get_template_directory_uri() . '/admin/img/megamenu_light_ver.jpg'
  ),
  'megamenu_dark_color' => array(
    'value' => 'megamenu_dark_color',
    'label' => __( 'Dark color', 'tcd-canon' ),
    'image' => get_template_directory_uri() . '/admin/img/megamenu_dark_ver.jpg'
  )
);


// ドロワーメニュー
global $drawer_menu_color_options;
$drawer_menu_color_options = array(
  'type1' => array(
    'value' => 'type1',
    'label' => __( 'Light color', 'tcd-canon' ),
    'image' => get_template_directory_uri() . '/admin/img/drawer_menu1.jpg'
  ),
  'type2' => array(
    'value' => 'type2',
    'label' => __( 'Dark color', 'tcd-canon' ),
    'image' => get_template_directory_uri() . '/admin/img/drawer_menu2.jpg'
  )
);


?>