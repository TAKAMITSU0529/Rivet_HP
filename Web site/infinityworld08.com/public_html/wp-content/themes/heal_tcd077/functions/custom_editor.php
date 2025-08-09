<?php

/**
 * エディターに関連する記述をここにまとめる
 *
 * NOTE: TCD Classic Editorの個別対応もここ
 */

/**
 * プラグインが有効化されている場合の処理
 *
 * NOTE: TCDCE_ACTIVEは、プラグインで定義された定数（有効化されていればtrue）
 */
if ( defined( 'TCDCE_ACTIVE' ) && TCDCE_ACTIVE ) {
	/**
	 * スタートガイド
	 */
	// 告知追加： このプラグインを有効化している間、TCDテーマの「クイックタグ」機能は利用できません。
	add_action( 'tcdce_top_menu', 'tcdce_top_menu_common_caution', 9 );
	/**
	 * 基本設定
	 */
	// 告知追加： TCDテーマオプションの設定が本文に反映されるため、基本設定はお使いいただけません。
	add_action( 'tcdce_submenu_tcd_classic_editor_basic', 'tcdce_submenu_basic_common_caution' );
	// 基本設定のスタイルを読み込まない
	remove_filter( 'tcdce_render_quicktag_style', 'tcdce_render_quicktag_basic_style' );
	/**
	 * クイックタグ
	 */
	// フロントの use_quicktagオプションを強制的にオフにする（元テーマの関連スタイルを除去）
	add_filter( 'option_dp_options', 'tcdce_disable_theme_quicktag' );
	/**
	 * Googleマップ
	 */
	// 特に無し
	/**
	 * 目次
	 */
	// スマホ用目次ウィジェットアイコンを表示するブレイクポイント
	add_filter( 'tcdce_toc_show_breakpoint', fn() => 950 );
	// 目次のスタイル調整
	add_filter( 'tcdce_enqueue_inline_style', function( $style ){
		$style .=
		// 目次の背景色
		'.tcdce-body .p-toc, .p-toc--sidebar { background:#fff; border:1px solid #ddd; }' .
		// 目次ウィジェットとヘッダーの距離
		'body.use_header_fix { --tcdce-toc-sticky-top: 110px; }' .
		// スマホフッターバー表示時の対策
		'body:has(#dp-footer-bar) .p-toc-open { margin-bottom: 50px; }' .
		// ドロワーメニュー表示に目次アイコン非表示
		'html.open_menu .p-toc-open { display:none; }';
		return $style;
	} );
	// 目次の投稿タイプから不要なものを削除
	add_filter( 'tcdce_toc_setting_post_types_options', function( $post_types ){
		return array_filter( $post_types, function ( $post_type ) {
			return ! in_array( $post_type, [ 'menu', 'voice', 'staff' ] );
		} );
	} );
	/**
	 * design-plus.cssを取り除く
	 *
	 * NOTE: wp_enqueue_styleで読み込まれていないため、headタグで直接制御
	 */
	/**
	 * エディタ独自スタイル対応
	 */
	add_filter( 'tcdce_enqueue_inline_style', function( $style ){
		$style .=
		// 本文エリア
		'.post_content .tcdce-body { padding-top:0.5em; }' .
		// お客様の声
		'#voice_list .item .tcdce-body { margin-bottom:2.5em; }' .
		// about
		'.about_content .content_area .tcdce-body { margin-bottom:2.5em; }' .
		// テーブル
		// '.post_content :is(td,th) { line-height: 2.4; }' .
		'';
		return $style;
	} );
	/**
	 * 有効化されていれば、ココで処理を止める
	 */
	return;
}
/**
 * 以下はテーマのエディタ周りの機能
 *
 * NOTE: プラグイン有効化時は、以下は実行されない
 * テーマの機能を移設する場合は、この下に追記してください
 */
/**
 * the_contentで実行されているもの
 */
// table スクロール対応 ------------------------------------------------------------------------
add_filter('the_content', function( $content ){
  if( !has_blocks() ){
    $content = str_replace( '<table', '<div class="s_table"><table', $content );
    $content = str_replace( '</table>', '</table></div>', $content );
  }
  return $content;
} );

/**
 * mce関連のカスタマイズ
 */
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
    array('title' => __('Default style', 'tcd-w'), 'value' => ''),
    array('title' => __('No border', 'tcd-w'), 'value' => 'table_no_border'),
    array('title' => __('Display only horizontal border', 'tcd-w'), 'value' => 'table_border_horizontal')
  );
  $settings['table_class_list'] = json_encode($styles);
  return $settings;
}
add_filter('tiny_mce_before_init', 'bootstrap_classes_tinymce');

// ビジュアルエディタにページ分割ボタンを追加 -----------------------------------------------
add_filter("mce_buttons", "add_nextpage_buttons");

/**
 * ビジュアルエディタ用スタイルシートの読み込みを移設
 */
function wpdocs_theme_add_editor_styles() {
  add_theme_support('editor-styles');
  add_editor_style( get_template_directory_uri()."/admin/css/editor-style.css?d=".date('YmdGis', filemtime(get_template_directory().'/admin/css/editor-style.css')) );
}
add_action( 'admin_init', 'wpdocs_theme_add_editor_styles' );


/**
 * TCDCE有効化時に無効化したいテーマのスタイル、スクリプトをココに記載
 */
add_action( 'wp_head', function(){
	/**
	 * エディタに使われているhead内のスタイルがあればココに移設
	 *
	 * NOTE: use_quicktagsをオフにするので、head内のクイックタグスタイルは移設不要（要確認）
	 * NOTE: その他styleの上書きが必要なら
	 */
	/**
	 * エディタに使われているスクリプトをココに移設
	 *
	 * NOTE: マーカーは干渉するので移設が必要
	 */
?>
<script>
jQuery(function ($) {
	var $window = $(window);
	var $body = $('body');
  // クイックタグ - underline ------------------------------------------
  if ($('.q_underline').length) {
    var gradient_prefix = null;
    $('.q_underline').each(function(){
      var bbc = $(this).css('borderBottomColor');
      if (jQuery.inArray(bbc, ['transparent', 'rgba(0, 0, 0, 0)']) == -1) {
        if (gradient_prefix === null) {
          gradient_prefix = '';
          var ua = navigator.userAgent.toLowerCase();
          if (/webkit/.test(ua)) {
            gradient_prefix = '-webkit-';
          } else if (/firefox/.test(ua)) {
            gradient_prefix = '-moz-';
          } else {
            gradient_prefix = '';
          }
        }
        $(this).css('borderBottomColor', 'transparent');
        if (gradient_prefix) {
          $(this).css('backgroundImage', gradient_prefix+'linear-gradient(left, transparent 50%, '+bbc+ ' 50%)');
        } else {
          $(this).css('backgroundImage', 'linear-gradient(to right, transparent 50%, '+bbc+ ' 50%)');
        }
      }
    });
    $window.on('scroll.q_underline', function(){
      $('.q_underline:not(.is-active)').each(function(){
        if ($body.hasClass('show-serumtal')) {
          var left = $(this).offset().left;
          if (window.scrollX > left - window.innerHeight) {
            $(this).addClass('is-active');
          }
        } else {
          var top = $(this).offset().top;
          if (window.scrollY > top - window.innerHeight) {
            $(this).addClass('is-active');
          }
        }
      });
      if (!$('.q_underline:not(.is-active)').length) {
        $window.off('scroll.q_underline');
      }
    });
  }
} );
</script>
<?php
} );
/**
 * テーマのクイックタグの登録
 */

function tcd_quicktag_admin_init() {
	global $dp_options;
	if ( ! $dp_options ) $dp_options = get_design_plus_option();

	if ( $dp_options['use_quicktags'] && ( current_user_can( 'edit_posts' ) || current_user_can( 'edit_pages' ) ) ) {
		add_filter( 'mce_external_plugins', 'tcd_add_tinymce_plugin' );

		add_filter( 'mce_buttons', 'tcd_register_mce_button' );
		
		add_action( 'admin_print_footer_scripts', 'tcd_add_quicktags' );

		// Dynamic css for classic visual editor
		add_filter( 'editor_stylesheets', 'editor_stylesheets_tcd_visual_editor_dynamic_css' );

		// Dymamic css for visual editor on block editor
		wp_enqueue_style( 'tcd-quicktags', get_tcd_quicktags_dynamic_css_url(), false, version_num() );
	}
}
add_action( 'admin_init', 'tcd_quicktag_admin_init' );

// Declare script for new button
function tcd_add_tinymce_plugin( $plugin_array ) {
	$plugin_array['tcd_mce_button'] = get_template_directory_uri() . '/admin/js/mce-button.js?ver=' . version_num();
	return $plugin_array;
}

// Register new button in the editor
function tcd_register_mce_button( $buttons ) {
	array_push( $buttons, 'tcd_mce_button' );
	return $buttons;
}

function tcd_add_quicktags() {
	global $dp_options;
	if ( ! $dp_options ) $dp_options = get_design_plus_option();

	$custom_buttons = array();
	for ( $i = 1; $i <= 3; $i++ ) {
		$custom_button_class = 'q_custom_button' . $i;

		if ( 'type2' === $dp_options['qt_custom_button_type' . $i] ) {
			$custom_button_class .= ' rounded';
		} elseif ( 'type3' === $dp_options['qt_custom_button_type' . $i] ) {
			$custom_button_class .= ' pill';
		}
		if ( 'type1' === $dp_options['qt_custom_button_size' . $i] ) {
			$custom_button_size = 'width:130px; height:40px;';
		} elseif ( 'type2' === $dp_options['qt_custom_button_size' . $i] ) {
			$custom_button_size = 'width:240px; height:60px;';
		} elseif ( 'type3' === $dp_options['qt_custom_button_size' . $i] ) {
			$custom_button_size = 'width:400px; height:70px;';
		}

		$custom_buttons[$i] = '<div class="q_button_wrap"><a href="#" class="' . $custom_button_class . '" style="' . $custom_button_size . '">' . sprintf( __( 'Button %d', 'tcd-w' ), $i ) . '</a></div>';
	}

	$speech_balloons = array();
	for ( $i = 1; $i <= 4; $i++ ) {
		$user_image = null;
		if ( $dp_options['qt_speech_balloon_user_image' . $i] ) {
			$user_image = wp_get_attachment_url( $dp_options['qt_speech_balloon_user_image' . $i] );
		}

		if ( $user_image ) {
			$user_image_url = $user_image;
		} else {
			$user_image_url = get_template_directory_uri() . '/img/common/no_avatar.png';
		}

		if ( 2 === $i ) {
			$tag = 'speech_balloon_left2';
		} elseif ( 3 === $i ) {
			$tag = 'speech_balloon_right1';
		} elseif ( 4 === $i ) {
			$tag = 'speech_balloon_right2';
		} elseif ( 1 === $i ) {
			$tag = 'speech_balloon_left1';
		}

		$speech_balloons[$i][0] = esc_attr( $user_image_url );
		$speech_balloons[$i][1] = esc_attr( $dp_options['qt_speech_balloon_user_name' . $i] );
	}

	$tcdQuicktagsL10n = array(
		'pulldown_title' => array(
			'display' => __( 'quicktags', 'tcd-w' ),
		),
		'ytube' => array(
			'display' => __( 'Youtube', 'tcd-w' ),
			'tag' => __( '<div class="ytube">Youtube code here</div>', 'tcd-w' )
		),
		'relatedcardlink' => array(
			'display' => __( 'Cardlink', 'tcd-w' ),
			'tag' => __( '[clink url="Post URL to display"]', 'tcd-w' )
		),
		'post_col-2' => array(
			'display' => __( '2 column', 'tcd-w' ),
			'tag' => __( '<div class="post_row"><div class="post_col post_col-2">Text and image tags to display in the left column</div><div class="post_col post_col-2">Text and image tags to display in the right column</div></div>', 'tcd-w' )
		),
		'post_col-3' => array(
			'display' => __( '3 column', 'tcd-w' ),
			'tag' => __( '<div class="post_row"><div class="post_col post_col-3">Text and image tags to display in the left column</div><div class="post_col post_col-3">Text and image tags to display in the center column</div><div class="post_col post_col-3">Text and image tags to display in the right column</div></div>', 'tcd-w' )
		),
		'q_styled_ol' => array(
			'display' => __( 'Numbered list', 'tcd-w' ),
			'tag' => __( "<ol class='q_styled_ol'>\n<li>List1</li>\n<li>List2</li>\n<li>List3</li>\n</ol>", 'tcd-w' )
		),
		'q_comment_out' => array(
			'display' => __( 'Comment out', 'tcd-w' ),
			'tagStart' => '<div class="hidden"><!-- ',
			'tagEnd' => ' --></div>'
		),
		'q_h2' => array(
			'display' => __( 'Styled h2 tag', 'tcd-w' ),
			'tagStart' => '<h2 class="styled_h2">',
			'tagEnd' => '</h2>'
		),
		'q_h3' => array(
			'display' => __( 'Styled h3 tag', 'tcd-w' ),
			'tagStart' => '<h3 class="styled_h3">',
			'tagEnd' => '</h3>'
		),
		'q_h4' => array(
			'display' => __( 'Styled h4 tag', 'tcd-w' ),
			'tagStart' => '<h4 class="styled_h4">',
			'tagEnd' => '</h4>'
		),
		'q_h5' => array(
			'display' => __( 'Styled h5 tag', 'tcd-w' ),
			'tagStart' => '<h5 class="styled_h5">',
			'tagEnd' => '</h5>'
		),
		'well' => array(
			'display' => __( 'Frame styleA', 'tcd-w' ),
			'tagStart' => '<div class="well">',
			'tagEnd' => '</div>'
		),
		'well2' => array(
			'display' => __( 'Frame styleB', 'tcd-w' ),
			'tagStart' => '<div class="well2">',
			'tagEnd' => '</div>'
		),
		'well3' => array(
			'display' => __( 'Frame styleC', 'tcd-w' ),
			'tagStart' => '<div class="well3">',
			'tagEnd' => '</div>'
		),
		'q_custom_button1' => array(
			'display' => sprintf( __( 'Button %d', 'tcd-w' ), 1 ),
			'tag' => $custom_buttons[1]
		),
		'q_custom_button2' => array(
			'display' => sprintf( __( 'Button %d', 'tcd-w' ), 2 ),
			'tag' => $custom_buttons[2]
		),
		'q_custom_button3' => array(
			'display' => sprintf( __( 'Button %d', 'tcd-w' ), 3 ),
			'tag' => $custom_buttons[3]
		),
		'q_underline1' => array(
			'display' => sprintf( __( 'Underline %d', 'tcd-w' ), 1 ),
			'tagStart' => '<span class="q_underline q_underline1" style="border-bottom-color: ' . esc_attr( $dp_options['qt_underline_color1'] ) . ';">',
			'tagEnd' => '</span>'
		),
		'q_underline2' => array(
			'display' => sprintf( __( 'Underline %d', 'tcd-w' ), 2 ),
			'tagStart' => '<span class="q_underline q_underline2" style="border-bottom-color: ' . esc_attr( $dp_options['qt_underline_color2'] ) . ';">',
			'tagEnd' => '</span>'
		),
		'q_underline3' => array(
			'display' => sprintf( __( 'Underline %d', 'tcd-w' ), 3 ),
			'tagStart' => '<span class="q_underline q_underline3" style="border-bottom-color: ' . esc_attr( $dp_options['qt_underline_color3'] ) . ';">',
			'tagEnd' => '</span>'
		),
		'speech_balloon_left1' => array(
			'display' => __( 'Speech balloon left 1', 'tcd-w' ),
			'tagStart' => '[speech_balloon_left1 user_image_url="'. $speech_balloons[1][0] .'" user_name="'. $speech_balloons[1][1] .'"]',
			'tagEnd' => '[/speech_balloon_left1]'
		),
		'speech_balloon_left2' => array(
			'display' => __( 'Speech balloon left 2', 'tcd-w' ),
			'tagStart' => '[speech_balloon_left2 user_image_url="'. $speech_balloons[2][0] .'" user_name="'. $speech_balloons[2][1] .'"]',
			'tagEnd' => '[/speech_balloon_left2]'
		),
		'speech_balloon_right1' => array(
			'display' => __( 'Speech balloon right 1', 'tcd-w' ),
			'tagStart' => '[speech_balloon_right1 user_image_url="'. $speech_balloons[3][0] .'" user_name="'. $speech_balloons[3][1] .'"]',
			'tagEnd' => '[/speech_balloon_right1]'
		),
		'speech_balloon_right2' => array(
			'display' => __( 'Speech balloon right 2', 'tcd-w' ),
			'tagStart' => '[speech_balloon_right2 user_image_url="'. $speech_balloons[4][0] .'" user_name="'. $speech_balloons[4][1] .'"]',
			'tagEnd' => '[/speech_balloon_right2]'
		),
		'single_banner' => array(
			'display' => __( 'advertisement', 'tcd-w' ),
			'tag' => '[s_ad]'
		),
		'page_break' => array(
			'display' => __( 'Page break' ),
			'tag' => '<!--nextpage-->'
		)
	);
?>
<script type="text/javascript">
<?php
	// check if WYSIWYG is enabled
	if ( 'true' == get_user_option( 'rich_editing' ) ) {
		echo "var tcdQuicktagsL10n = " . json_encode( $tcdQuicktagsL10n ) . ";\n";
	}
	if ( wp_script_is( 'quicktags' ) ) {
		foreach ( $tcdQuicktagsL10n as $key => $value ) {
			if ( is_numeric( $key ) || empty( $value['display'] ) ) continue;
			if ( empty( $value['tag'] ) && empty( $value['tagStart'] ) ) continue;

			if ( isset( $value['tag'] ) && ! isset( $value['tagStart'] ) ) {
				$value['tagStart'] = $value['tag'] . "\n\n";
			}
			if ( ! isset( $value['tagEnd'] ) ) {
				$value['tagEnd'] = '';
			}

			$key = json_encode( $key );
			$display = json_encode( $value['display'] );
			$tagStart = json_encode( $value['tagStart'] );
			$tagEnd = json_encode( $value['tagEnd'] );
			echo "QTags.addButton($key, $display, $tagStart, $tagEnd);\n";
		}
	}
?>
</script>
<?php
}

// Get dymamic css url
function get_tcd_quicktags_dynamic_css_url() {
	return admin_url( 'admin-ajax.php?action=tcd_quicktags_dynamic_css' );
}

// Dymamic css for visual editor
function tcd_ajax_quicktags_dynamic_css() {
	global $dp_options;
	if ( ! $dp_options ) $dp_options = get_design_plus_option();

	header( 'Content-Type: text/css; charset=UTF-8' );

?>
.styled_h2 {
  font-size:<?php echo esc_attr($dp_options['qt_h2_font_size']); ?>px; text-align:<?php echo esc_attr($dp_options['qt_h2_text_align']); ?>; color:<?php echo esc_attr($dp_options['qt_h2_font_color']); ?>; <?php if($dp_options['show_qt_h2_bg_color']) { ?>background:<?php echo esc_attr($dp_options['qt_h2_bg_color']); ?>;<?php }; ?>
  border-top:<?php echo esc_attr($dp_options['qt_h2_border_top_width']); ?>px solid <?php echo esc_attr($dp_options['qt_h2_border_top_color']); ?>;
  border-bottom:<?php echo esc_attr($dp_options['qt_h2_border_bottom_width']); ?>px solid <?php echo esc_attr($dp_options['qt_h2_border_bottom_color']); ?>;
  border-left:<?php echo esc_attr($dp_options['qt_h2_border_left_width']); ?>px solid <?php echo esc_attr($dp_options['qt_h2_border_left_color']); ?>;
  border-right:<?php echo esc_attr($dp_options['qt_h2_border_right_width']); ?>px solid <?php echo esc_attr($dp_options['qt_h2_border_right_color']); ?>;
  padding:<?php echo esc_attr($dp_options['qt_h2_padding_top']); ?>px <?php echo esc_attr($dp_options['qt_h2_padding_right']); ?>px <?php echo esc_attr($dp_options['qt_h2_padding_bottom']); ?>px <?php echo esc_attr($dp_options['qt_h2_padding_left']); ?>px;
  margin:<?php echo esc_attr($dp_options['qt_h2_margin_top']); ?>px 0px <?php echo esc_attr($dp_options['qt_h2_margin_bottom']); ?>px;
}
.styled_h3 {
  font-size:<?php echo esc_attr($dp_options['qt_h3_font_size']); ?>px; text-align:<?php echo esc_attr($dp_options['qt_h3_text_align']); ?>; color:<?php echo esc_attr($dp_options['qt_h3_font_color']); ?>; <?php if($dp_options['show_qt_h3_bg_color']) { ?>background:<?php echo esc_attr($dp_options['qt_h3_bg_color']); ?>;<?php }; ?>
  border-top:<?php echo esc_attr($dp_options['qt_h3_border_top_width']); ?>px solid <?php echo esc_attr($dp_options['qt_h3_border_top_color']); ?>;
  border-bottom:<?php echo esc_attr($dp_options['qt_h3_border_bottom_width']); ?>px solid <?php echo esc_attr($dp_options['qt_h3_border_bottom_color']); ?>;
  border-left:<?php echo esc_attr($dp_options['qt_h3_border_left_width']); ?>px solid <?php echo esc_attr($dp_options['qt_h3_border_left_color']); ?>;
  border-right:<?php echo esc_attr($dp_options['qt_h3_border_right_width']); ?>px solid <?php echo esc_attr($dp_options['qt_h3_border_right_color']); ?>;
  padding:<?php echo esc_attr($dp_options['qt_h3_padding_top']); ?>px <?php echo esc_attr($dp_options['qt_h3_padding_right']); ?>px <?php echo esc_attr($dp_options['qt_h3_padding_bottom']); ?>px <?php echo esc_attr($dp_options['qt_h3_padding_left']); ?>px;
  margin:<?php echo esc_attr($dp_options['qt_h3_margin_top']); ?>px 0px <?php echo esc_attr($dp_options['qt_h3_margin_bottom']); ?>px;
}
.styled_h4 {
  font-size:<?php echo esc_attr($dp_options['qt_h4_font_size']); ?>px; text-align:<?php echo esc_attr($dp_options['qt_h4_text_align']); ?>; color:<?php echo esc_attr($dp_options['qt_h4_font_color']); ?>; <?php if($dp_options['show_qt_h4_bg_color']) { ?>background:<?php echo esc_attr($dp_options['qt_h4_bg_color']); ?>;<?php }; ?>
  border-top:<?php echo esc_attr($dp_options['qt_h4_border_top_width']); ?>px solid <?php echo esc_attr($dp_options['qt_h4_border_top_color']); ?>;
  border-bottom:<?php echo esc_attr($dp_options['qt_h4_border_bottom_width']); ?>px solid <?php echo esc_attr($dp_options['qt_h4_border_bottom_color']); ?>;
  border-left:<?php echo esc_attr($dp_options['qt_h4_border_left_width']); ?>px solid <?php echo esc_attr($dp_options['qt_h4_border_left_color']); ?>;
  border-right:<?php echo esc_attr($dp_options['qt_h4_border_right_width']); ?>px solid <?php echo esc_attr($dp_options['qt_h4_border_right_color']); ?>;
  padding:<?php echo esc_attr($dp_options['qt_h4_padding_top']); ?>px <?php echo esc_attr($dp_options['qt_h4_padding_right']); ?>px <?php echo esc_attr($dp_options['qt_h4_padding_bottom']); ?>px <?php echo esc_attr($dp_options['qt_h4_padding_left']); ?>px;
  margin:<?php echo esc_attr($dp_options['qt_h4_margin_top']); ?>px 0px <?php echo esc_attr($dp_options['qt_h4_margin_bottom']); ?>px;
}
.styled_h5 {
  font-size:<?php echo esc_attr($dp_options['qt_h5_font_size']); ?>px; text-align:<?php echo esc_attr($dp_options['qt_h5_text_align']); ?>; color:<?php echo esc_attr($dp_options['qt_h5_font_color']); ?>; <?php if($dp_options['show_qt_h5_bg_color']) { ?>background:<?php echo esc_attr($dp_options['qt_h5_bg_color']); ?>;<?php }; ?>
  border-top:<?php echo esc_attr($dp_options['qt_h5_border_top_width']); ?>px solid <?php echo esc_attr($dp_options['qt_h5_border_top_color']); ?>;
  border-bottom:<?php echo esc_attr($dp_options['qt_h5_border_bottom_width']); ?>px solid <?php echo esc_attr($dp_options['qt_h5_border_bottom_color']); ?>;
  border-left:<?php echo esc_attr($dp_options['qt_h5_border_left_width']); ?>px solid <?php echo esc_attr($dp_options['qt_h5_border_left_color']); ?>;
  border-right:<?php echo esc_attr($dp_options['qt_h5_border_right_width']); ?>px solid <?php echo esc_attr($dp_options['qt_h5_border_right_color']); ?>;
  padding:<?php echo esc_attr($dp_options['qt_h5_padding_top']); ?>px <?php echo esc_attr($dp_options['qt_h5_padding_right']); ?>px <?php echo esc_attr($dp_options['qt_h5_padding_bottom']); ?>px <?php echo esc_attr($dp_options['qt_h5_padding_left']); ?>px;
  margin:<?php echo esc_attr($dp_options['qt_h5_margin_top']); ?>px 0px <?php echo esc_attr($dp_options['qt_h5_margin_bottom']); ?>px;
}
<?php
	for ( $i = 1; $i <= 5; $i++ ) {
		echo '.q_custom_button' . $i . ' { background: ' . esc_attr( $dp_options['qt_custom_button_bg_color' . $i] ) . '; color: ' . esc_attr( $dp_options['qt_custom_button_font_color' . $i] ) . '; border-color: ' . esc_attr( $dp_options['qt_custom_button_border_color' . $i] ) . '; }' . "\n";
		echo '.q_custom_button' . $i . ':hover, .q_custom_button' . $i . ':focus { background: ' . esc_attr( $dp_options['qt_custom_button_bg_color_hover' . $i] ) . '; color: ' . esc_attr( $dp_options['qt_custom_button_font_color_hover' . $i] ) . '; border-color: ' . esc_attr( $dp_options['qt_custom_button_border_color_hover' . $i] ) . '; }' . "\n";
	}

     // デザイン番号付きリスト
?>
.q_styled_ol { counter-reset: item; list-style-type: none; margin-left:0 !important; margin-bottom:2em; }
.q_styled_ol li { display:-webkit-box; display:-webkit-flex; display:flex; margin-bottom:0.4em; }
.q_styled_ol li:before {
  counter-increment: item; content: counter(item);
  display:-webkit-box; display:-webkit-flex; display:flex;
  -webkit-box-align: center; -ms-flex-align: center; align-items: center;
  -webkit-box-pack: center; -ms-flex-pack: center; justify-content: center;
  width:1.5em; min-width: 1.5em; height: 1.5em; background:<?php echo esc_attr($dp_options['main_color']); ?>;
  color: #fff; border-radius: 50%; line-height: 1; margin-top: 0.3em; margin-right: 0.7em;
}
<?php
	exit;
}
add_action( 'wp_ajax_tcd_quicktags_dynamic_css', 'tcd_ajax_quicktags_dynamic_css' );

// add_editor_style()だとテーマ内のcssが最後になるためここで最後尾にcss追加
function editor_stylesheets_tcd_visual_editor_dynamic_css( $stylesheets ) {
	$stylesheets[] = get_tcd_quicktags_dynamic_css_url();
	$stylesheets = array_unique( $stylesheets );
	return $stylesheets;
}
