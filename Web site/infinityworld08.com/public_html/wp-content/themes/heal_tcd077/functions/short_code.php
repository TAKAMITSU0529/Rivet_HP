<?php

/**
 * 広告
 */
function theme_option_single_banner() {

	$options = get_design_plus_option();

    if( $options['single_shortcode_ad_code1'] || $options['single_shortcode_ad_image1'] || $options['single_shortcode_ad_code2'] || $options['single_shortcode_ad_image2'] ) {

      $html = '';

      if( !$options['single_shortcode_ad_code2'] && !$options['single_shortcode_ad_image2'] ) {
        $html .= '<div id="single_banner_shortcode" class="single_banner_area clearfix one_banner">' . "\n";
      } else {
        $html .= '<div id="single_banner_shortcode" class="single_banner_area clearfix">' . "\n";
      }

      if ($options['single_shortcode_ad_code1']) {
        $html .= '<div class="single_banner single_banner_left">' . "\n";
        $html .= $options['single_shortcode_ad_code1'] . "\n";
        $html .= '</div>' . "\n";
      } else {
        $single_image3 = wp_get_attachment_image_src( $options['single_shortcode_ad_image1'], 'full' );
        $html .= '<div class="single_banner single_banner_left">' . "\n";
        $html .= '<a href="' . $options['single_shortcode_ad_url1'] . '" target="_blank"><img src="' . $single_image3[0] . '" alt="" title="" /></a>' . "\n";
        $html .= '</div>' . "\n";
      }

      if ($options['single_shortcode_ad_code2']) {
        $html .= '<div class="single_banner single_banner_right">' . "\n";
        $html .= $options['single_shortcode_ad_code2'] . "\n";
        $html .= '</div>' . "\n";
      } else {
        $single_image4 = wp_get_attachment_image_src( $options['single_shortcode_ad_image2'], 'full' );
        $html .= '<div class="single_banner single_banner_right">' . "\n";
        $html .= '<a href="' . $options['single_shortcode_ad_url2'] . '" target="_blank"><img src="' . $single_image4[0] . '" alt="" title="" /></a>' . "\n";
        $html .= '</div>' . "\n";
      }

      $html .= '</div>' . "\n";

      return $html;

    };

}
add_shortcode('s_ad', 'theme_option_single_banner');


/**
 * 広告（お知らせ用）
 */
function theme_option_news_single_banner() {

	$options = get_design_plus_option();

    if( $options['news_single_shortcode_ad_code1'] || $options['news_single_shortcode_ad_image1'] || $options['news_single_shortcode_ad_code2'] || $options['news_single_shortcode_ad_image2'] ) {

      $html = '';

      if( !$options['news_single_shortcode_ad_code2'] && !$options['news_single_shortcode_ad_image2'] ) {
        $html .= '<div id="single_banner_shortcode" class="single_banner_area clearfix one_banner">' . "\n";
      } else {
        $html .= '<div id="single_banner_shortcode" class="single_banner_area clearfix">' . "\n";
      }

      if ($options['news_single_shortcode_ad_code1']) {
        $html .= '<div class="single_banner single_banner_left">' . "\n";
        $html .= $options['news_single_shortcode_ad_code1'] . "\n";
        $html .= '</div>' . "\n";
      } else {
        $single_image3 = wp_get_attachment_image_src( $options['news_single_shortcode_ad_image1'], 'full' );
        $html .= '<div class="single_banner single_banner_left">' . "\n";
        $html .= '<a href="' . $options['news_single_shortcode_ad_url1'] . '" target="_blank"><img src="' . $single_image3[0] . '" alt="" title="" /></a>' . "\n";
        $html .= '</div>' . "\n";
      }

      if ($options['news_single_shortcode_ad_code2']) {
        $html .= '<div class="single_banner single_banner_right">' . "\n";
        $html .= $options['news_single_shortcode_ad_code2'] . "\n";
        $html .= '</div>' . "\n";
      } else {
        $single_image4 = wp_get_attachment_image_src( $options['news_single_shortcode_ad_image2'], 'full' );
        $html .= '<div class="single_banner single_banner_right">' . "\n";
        $html .= '<a href="' . $options['news_single_shortcode_ad_url2'] . '" target="_blank"><img src="' . $single_image4[0] . '" alt="" title="" /></a>' . "\n";
        $html .= '</div>' . "\n";
      }

      $html .= '</div>' . "\n";

      return $html;

    };

}
add_shortcode('news_s_ad', 'theme_option_news_single_banner');


/**
 * 吹き出しクイックタグ用ショートコード
 */
function tcd_shortcode_speech_balloon( $atts, $content, $tag ) {
	global $dp_options;
	if ( ! $dp_options ) $dp_options = get_design_plus_option();

	$atts = shortcode_atts( array(
		'user_image_url' => '',
		'user_name' => ''
	), $atts );

	// user_image_urlが指定されていればメディアID取得・差し替えを試みる
	$user_image_url = $atts['user_image_url'];
	if ( $atts['user_image_url'] ) {
		$attachment_id = attachment_url_to_postid( $atts['user_image_url'] );
		if ( $attachment_id ) {
			$user_image = wp_get_attachment_image_src( $attachment_id, array( 300, 300, true ) );
			if ( $user_image ) {
				$atts['user_image_url'] = $user_image[0];
			}
		}
	}

	$html = '<div class="speach_balloon ' . esc_attr( $tag ) . '">'
		  . '<div class="speach_balloon_user">';

	if ( $atts['user_image_url'] ) {
		$html .= '<img class="speach_balloon_user_image" src="' . esc_attr( $atts['user_image_url'] ) . '" alt="' . esc_attr( $atts['user_image_url'] ) . '">';
	}

	$html .= '<div class="speach_balloon_user_name">' . esc_html( $atts['user_name'] ) . '</div>'
		  . '</div>'
		  . '<div class="speach_balloon_text">' .  wpautop( $content )   . '</div>'
		  .  '</div>';

	return $html;
}
add_shortcode( 'speech_balloon_left1', 'tcd_shortcode_speech_balloon' );
add_shortcode( 'speech_balloon_left2', 'tcd_shortcode_speech_balloon' );
add_shortcode( 'speech_balloon_right1', 'tcd_shortcode_speech_balloon' );
add_shortcode( 'speech_balloon_right2', 'tcd_shortcode_speech_balloon' );


?>