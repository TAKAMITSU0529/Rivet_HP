<?php

/**
 * 高速化処理
 *
 * @TODO キャッシュ系プラグイン等への対応
 */

/**
 * initialize
 *
 * @return void
 */
function tcd_acceleration_wp() {
	global $dp_options;

	// feed・管理画面・ajaxは終了
	if ( is_feed() || is_comment_feed() || is_trackback() || is_preview() || is_robots() || get_query_var( 'sitemap' ) || get_query_var( 'sitemap-stylesheet' ) || is_admin() || wp_doing_ajax() )
		return;

	if ( ! $dp_options ) $dp_options = get_design_plus_option();

	// DOMDocumentクラスが無ければ終了
	if ( ! class_exists( 'DOMDocument' ) )
		return;

	// WordPressデフォルトで有効化になっているのshutdownアクションのwp_ob_end_flush_allを削除
	$priority = has_action( 'shutdown', 'wp_ob_end_flush_all' );
	if ( false === $priority )
		return;

	remove_action( 'shutdown', 'wp_ob_end_flush_all', $priority );

	// アクション・フィルター
	add_action( 'template_redirect', 'tcd_acceleration_ob_start', 1 );
	add_action( 'shutdown', 'wp_ob_end_flush_all', 2 );

}
add_action( 'wp', 'tcd_acceleration_wp' );

/**
 * html操作するためのob_start用関数
 *
 * @return void
 */
function tcd_acceleration_ob_start() {
	global $tcd_acceleration_ob_level;
	ob_start();
	$tcd_acceleration_ob_level = ob_get_level();

	// ob_startしてからアクション追加する
	add_action( 'shutdown', 'tcd_acceleration_ob_end', 1 );
}

/**
 * HTML操作するためのob_get_contents用関数
 *
 * @return void
 */
function tcd_acceleration_ob_end() {
	global $tcd_acceleration_ob_level;

	// tcd_acceleration_ob_start()後でなければ終了
	if ( ! $tcd_acceleration_ob_level )
		return;

	// tcd_acceleration_ob_start後のob_startがあればフラッシュする
	while ( ob_get_level() > $tcd_acceleration_ob_level ) {
		ob_end_flush();
	}

	if ( WP_DEBUG ) {
		$debug_massage = "\n<!-- Memory usage before filter: " . ( floor( memory_get_usage() / ( 1024 * 1024 ) * 1000 ) / 1000 )."MB -->";
	}

	// バッファー取得
	$html = ob_get_contents();
	ob_end_clean();

	// フィルター
	$html = apply_filters( 'tcd_acceleration_html', $html );

	if ( WP_DEBUG ) {
		$debug_massage .= "\n<!-- Memory usage after filter: " . ( floor( memory_get_usage() / ( 1024 * 1024 ) * 1000 ) / 1000 )."MB -->";
		$debug_massage = apply_filters( 'tcd_acceleration_debug_massage', $debug_massage );

		$html = rtrim( $html ) . $debug_massage;
	}else{
		$html .= "\n<!-- Compressed by TCD -->";
	}

	echo $html;
}
