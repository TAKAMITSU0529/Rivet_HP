<?php
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
// add_shortcode( 'speech_balloon_left1', 'tcd_shortcode_speech_balloon' );
// add_shortcode( 'speech_balloon_left2', 'tcd_shortcode_speech_balloon' );
// add_shortcode( 'speech_balloon_right1', 'tcd_shortcode_speech_balloon' );
// add_shortcode( 'speech_balloon_right2', 'tcd_shortcode_speech_balloon' );


function speech_balloon_template( $content, $i, $type = 'left' ) {

  $options = get_design_plus_option();

  $image = get_template_directory_uri().'/img/no_avatar.png';
  if($options['qt_speech_balloon'.$i.'_user_image']){
    $image = wp_get_attachment_image_src( $options['qt_speech_balloon'.$i.'_user_image'], array( 300, 300, true ) );
    if(!empty($image)) $image = $image[0];
  }
  $name = $options['qt_speech_balloon'.$i.'_user_name'];

  $html = '<div class="speech_balloon '.$type.'">'."\n";
  $html .= '<div class="speech_balloon_user">'."\n";
	$html .= '<img class="speech_balloon_user_image" src="'.esc_attr($image).'" alt="">'."\n";
  if($name) $html .= '<div class="speech_balloon_user_name">' . esc_html($name) . '</div>'."\n";
  $html .= '</div>'."\n";
  $html .= '<div class="speech_balloon_text speech_balloon'.$i.'">'."\n";
  $html .= '<span class="before"></span>';
  $html .= '<div class="speech_balloon_text_inner">'.wpautop( $content ).'</div>'."\n";
  $html .= '<span class="after"></span>';
  $html .= '</div>'."\n";
  $html .= '</div>'."\n";

  return $html;

}


function tcd_speech_balloon1( $attr, $content ) {
  return speech_balloon_template($content, 1, 'left');
}
add_shortcode( 'speech_balloon_left1', 'tcd_speech_balloon1' );

function tcd_speech_balloon2( $attr, $content ) {
  return speech_balloon_template($content, 2, 'left');
}
add_shortcode( 'speech_balloon_left2', 'tcd_speech_balloon2' );

function tcd_speech_balloon3( $attr, $content ) {
  return speech_balloon_template($content, 3, 'right');
}
add_shortcode( 'speech_balloon_right1', 'tcd_speech_balloon3' );

function tcd_speech_balloon4( $attr, $content ) {
  return speech_balloon_template($content, 4, 'right');
}
add_shortcode( 'speech_balloon_right2', 'tcd_speech_balloon4' );





/**
 * 吹き出しクイックタグ用ショートコード（フリー）
 */
function tcd_shortcode_speech_balloon_free( $atts, $content ) {

	$atts = shortcode_atts( array(
		'image' => '',
		'name' => '',
    'type' => 'left',
    'color' => '',
    'bg_color' => '',
    'border_color' => ''
	), $atts );

	// user_image_urlが指定されていればメディアID取得・差し替えを試みる
  $image = get_template_directory_uri().'/img/no_avatar.png';
	$user_image_url = $atts['image'];
	if ( $atts['image'] ) {
		$attachment_id = attachment_url_to_postid( $atts['image'] );
		if ( $attachment_id ) {
			$user_image = wp_get_attachment_image_src( $attachment_id, array( 300, 300, true ) );
			if ( $user_image ) {
				$image = esc_attr($user_image[0]);
			}
		}
	}

  $name = esc_html($atts['name']);
  $type = esc_attr($atts['type']);
  $color = ($atts['color']) ? 'color:'.esc_attr($atts['color']).';' : '';
  $bg_color = ($atts['bg_color']) ? 'background-color:'.esc_attr($atts['bg_color']).';' : '';
  $border_color = ($atts['border_color']) ? 'border-color:'.esc_attr($atts['border_color']).';' : '';

  $border_right_color = ($atts['bg_color']) ? 'border-right-color:'.esc_attr($atts['bg_color']).';' : '';
  $border_left_color = ($atts['border_color']) ? 'border-left-color:'.esc_attr($atts['border_color']).';' : '';

	$html = '<div class="speech_balloon '.$type.'">'."\n";
  $html .= '<div class="speech_balloon_user">'."\n";
	$html .= '<img class="speech_balloon_user_image" src="'.$image.'" alt="">'."\n";
  if($name) $html .= '<div class="speech_balloon_user_name">' . $name . '</div>'."\n";
  $html .= '</div>'."\n";
  $html .= '<div class="speech_balloon_text">' ."\n";
  $html .= '<span class="before" style="'.$border_left_color.'"></span>';
  $html .= '<div class="speech_balloon_text_inner" style="'.$color.$bg_color.$border_color.'">' .  wpautop( $content )   . '</div>'."\n";
  $html .= '<span class="after" style="'.$border_right_color.'"></span>';
  $html .= '</div>'."\n";
  $html .= '</div>'."\n";

	return $html;
}
add_shortcode( 'speech_balloon_free', 'tcd_shortcode_speech_balloon_free' );




/**
 * Google Map用ショートコード
 */
function tcd_google_map($atts) {
  global $options;
  if ( ! $options ) $options = get_design_plus_option();

  $atts = shortcode_atts( array(
    'address' => '',
  ), $atts );

  $html = '';

  if ( $atts['address'] ) {

    $use_custom_overlay = 'type1' !== $options['qt_gmap_marker_type'] ? 1 : 0;
    $custom_marker_type = $options['qt_gmap_marker_type'] ? $options['qt_gmap_marker_type'] : 'type2';

    $marker_img = $options['qt_gmap_marker_img'] ? wp_get_attachment_url( $options['qt_gmap_marker_img'] ) : get_template_directory_uri().'/img/gmap_no_image.png';
    if(($custom_marker_type == 'type3') && !empty($marker_img)) {
      $marker_text = '';
    } else {
      $marker_text = $options['qt_gmap_marker_text'];
    }
    if($options['qt_access_saturation'] == 'default'){
      $access_saturation = 0;
    }else{
      $access_saturation = -100;
    }
    $rand = rand();

    $html .= "<div class='qt_google_map'>\n";
    $html .= " <div class='qt_googlemap clearfix'>\n";
    $html .= "  <div id='qt_google_map" . $rand . "' class='qt_googlemap_embed'></div>\n";
    $html .= " </div>\n";
    $html .= " <script>\n";
    $html .= " jQuery(window).on('load', function() {\n";
    $html .= "  initMap('qt_google_map" . $rand . "', '" . esc_js( $atts['address'] ) . "', " . esc_js( $access_saturation ) . ", " . esc_js( $use_custom_overlay ) . ", '" . esc_js( $marker_img ) . "', '" . esc_js( $marker_text ) . "');\n";
    $html .= " });\n";
    $html .= " </script>\n";
    $html .= "</div>\n";

    if ( ! wp_script_is( 'qt_google_map_api', 'enqueued' ) ) {
      wp_enqueue_script( 'qt_google_map_api', 'https://maps.googleapis.com/maps/api/js?key=' . esc_attr( $options['qt_gmap_api_key'] ), array(), version_num(), true );
      wp_enqueue_script( 'qt_google_map', get_template_directory_uri() . '/js/googlemap.js', array(), version_num(), true );
    }
  }

	return $html;
}
add_shortcode( 'qt_google_map', 'tcd_google_map' );




/**
 * FAQ用ショートコード
 */
function sc_faq ( $atts, $content, $i ) {

  global $post;

  $atts = shortcode_atts( array(
    'post_id' => '',
  ), $atts );

  if($atts['post_id']){
    $post_id = intval($atts['post_id']);
  } else {
    $post_id = intval($post->ID);
  }

  $faq_list = get_post_meta($post_id, 'faq_list'.$i, true);

  $html = '';

  if ( $faq_list ) {
    $html .= "<div class='faq_list'>\n";
    foreach ( $faq_list as $key => $value ) :
      $question = $value['question'];
      $answer = $value['answer'];
      if ( $question && $answer) {
        $html .= "<div class='item'>\n";
        $html .= '<h4 class="title no_editor_style"><span>' . esc_html($question) . "</span></h4>\n";
        $html .= '<div class="desc_area"><p class="desc no_editor_style"><span>' . wp_kses_post(nl2br($answer)) . "</span></p></div>\n";
        $html .= "</div>\n";
      }
    endforeach;
    $html .= "</div>\n";
  }

	return $html;
}

function sc_faq1( $atts, $content ) {
  return sc_faq($atts, $content, 1);
}
add_shortcode( 'tcd_faq1', 'sc_faq1' );

function sc_faq2( $atts, $content ) {
  return sc_faq($atts, $content, 2);
}
add_shortcode( 'tcd_faq2', 'sc_faq2' );

function sc_faq3( $atts, $content ) {
  return sc_faq($atts, $content, 3);
}
add_shortcode( 'tcd_faq3', 'sc_faq3' );

function sc_faq4( $atts, $content ) {
  return sc_faq($atts, $content, 4);
}
add_shortcode( 'tcd_faq4', 'sc_faq4' );

function sc_faq5( $atts, $content ) {
  return sc_faq($atts, $content, 5);
}
add_shortcode( 'tcd_faq5', 'sc_faq5' );


/**
 * タブコンテンツ
 */
function qt_tab_content($atts) {

  $atts = shortcode_atts( array(
    'tab1' => '',
    'img1' => '',
    'tab2' => '',
    'img2' => '',
  ), $atts );


  $html = '';

  if ( $atts['tab1'] || $atts['tab2']) {

  $html .= "<div class='qt_tab_content_wrap'>\n";

  $html .= "<div class='qt_tab_content_header'>\n";

  if ( $atts['tab1'] ) {
    $html .= '<div class="item active" data-tab-target=".qt_tab_content1">' . esc_html($atts['tab1']) . "</div>\n";
  }
  if ( $atts['tab2'] ) {
    $html .= '<div class="item" data-tab-target=".qt_tab_content2">' . esc_html($atts['tab2']) . "</div>\n";
  }

  $html .= "</div>\n";

  $html .= "<div class='qt_tab_content_main'>\n";

  if ( $atts['img1'] ) {
    $html .= '<div class="qt_tab_content active qt_tab_content1">' . "\n";
    if ( $atts['img1'] ) {
      $html .= '<img src="' . esc_url($atts['img1']) . '" title="" alt="">' . "\n";
      $image_id = attachment_url_to_postid($atts['img1']);
      $image_caption = $image_id ?  get_post($image_id)->post_excerpt : '';
      if ($image_caption) {
        $html .= '<p class="desc">' . wp_kses_post($image_caption) . "</p>\n";
      }
    }
    $html .= "</div>\n";
  }

  if ( $atts['img2'] ) {
    $html .= '<div class="qt_tab_content qt_tab_content2">' . "\n";
    if ( $atts['img2'] ) {
      $html .= '<img src="' . esc_url($atts['img2']) . '" title="" alt="">' . "\n";
      $image_id = attachment_url_to_postid($atts['img2']);
      $image_caption = $image_id ?  get_post($image_id)->post_excerpt : '';
      if ($image_caption) {
        $html .= '<p class="desc">' . wp_kses_post($image_caption) . "</p>\n";
      }
    }
    $html .= "</div>\n";
  }

  $html .= "</div>\n";

  $html .= "</div>\n";

  };

	return $html;
}
add_shortcode( 'tcd_tab', 'qt_tab_content' );


/**
 * 画像スライダー
 */
function sc_image_slider( $atts) {

  global $post;

  $display_flag = true;

  if( (is_page() && get_post_meta($post->ID, 'hide_sidebar', true) != 'hide') ){
    $display_flag = false;
  }
  if(is_page_template('page-tcd-lp.php')){
    $header_style = get_post_meta($post->ID, 'header_style', true) ?  get_post_meta($post->ID, 'header_style', true) : 'type2';
    if($header_style == 'type1'){
      $display_flag = false;
    } else {
      $display_flag = true;
    }
  }

  $atts = shortcode_atts( array(
    'post_id' => '',
  ), $atts );

  if($atts['post_id']){
    $post_id = intval($atts['post_id']);
  } else {
    $post_id = intval($post->ID);
  }

  $image_slider = get_post_meta($post_id, 'image_slider', true) ?  get_post_meta($post_id, 'image_slider', true) : '';
  $image_slider_type = get_post_meta($post_id, 'image_slider_type', true) ?  get_post_meta($post_id, 'image_slider_type', true) : 'type1';
  $total_image_num = 0;

  $html = '';

  if($display_flag == true){

  if($image_slider){
    $image_slider = !empty($image_slider) ? explode( ',', $image_slider ) : array();
    foreach( $image_slider as $image_id ):
      $slider_image = wp_get_attachment_image_src( $image_id, 'full' );
      if($slider_image){
        $total_image_num++;
      };
    endforeach;
    $html .= "</div>\n";
    $html .= "<div class='sc_image_carousel_container layout_" . esc_attr($image_slider_type) . " inview'>\n";
    $html .= "<div class='sc_image_carousel_wrap sc_image_carousel_" . $post_id . " swiper'>\n";
    $html .= "<div class='sc_image_carousel swiper-wrapper'>\n";
    foreach( $image_slider as $image_id ):
      $slider_image = wp_get_attachment_image_src( $image_id, 'full' );
      if($slider_image){
        $html .= "<div class='item swiper-slide'>\n";
        $html .= "<img class='image' loading='lazy' src='" . esc_attr($slider_image[0]) . "' width='" . esc_attr($slider_image[1]) . "' height='" . esc_attr($slider_image[2]) . "' />\n";
        $html .= "</div>\n";
      };
    endforeach;
    $html .= "</div>\n";
    $html .= "</div>\n";
    if($image_slider_type == 'type1'){
      $html .= "<div class='sc_image_carousel_pagination sc_image_carousel_pagination_" . $post_id . " swiper-pagination'></div>\n";
    } else {
      if($total_image_num != 1){
        $html .= "<div class='sc_image_carousel_nav sc_image_carousel_nav_" . $post_id . " swiper'>\n";
        $html .= "<div class='swiper-wrapper'>\n";
        foreach( $image_slider as $image_id ):
          $slider_image = wp_get_attachment_image_src( $image_id, 'full' );
          if($slider_image){
            $html .= "<div class='swiper-slide'></div>\n";
          };
        endforeach;
        $html .= "</div>\n";
        $html .= "</div>\n";
      }
    }
    $html .= "</div>\n";
    $html .= "<div class='post_content clearfix inview'>\n";

    // JavaScriptコードを一時的に保存
    $script = "<script>\n";
    $script .= "(function($) {\n";
    $script .= "if( $('.sc_image_carousel_wrap').length ){\n";
    if($image_slider_type == 'type2'){
      $script .= "let sc_image_carousel_nav_" . $post_id . " = new Swiper('.sc_image_carousel_nav_" . $post_id . "', {\n";
      $script .= "slidesPerView: " . esc_attr($total_image_num) . ",\n";
      $script .= "watchSlidesProgress: true,\n";
      $script .= "});\n";
    };
    $script .= "let sc_image_carousel_" . $post_id . " = new Swiper('.sc_image_carousel_" . $post_id . "', {\n";
    if($image_slider_type == 'type1'){
$script .= <<<SCRIPT
      effect:'fade',
      fadeEffect: {
        crossFade: true
      },
      loop: true,
      speed: 1000,
      slidesPerView: 1,
      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },
      pagination: {
SCRIPT;
      $script .= "\n";
      $script .= "el: '.sc_image_carousel_pagination_" . $post_id . "',\n";
      $script .= "clickable: true,\n";
      $script .= "},\n";
    } else {
$script .= <<<SCRIPT
      loop: true,
      speed: 600,
      slidesPerView: "auto",
      spaceBetween: '0',
      centeredSlides: true,
      grabCursor: true,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
      thumbs: {
SCRIPT;
      $script .= "\n";
      $script .= "swiper: sc_image_carousel_nav_" . $post_id . ",\n";
      $script .= "}\n";
    };
$script .= <<<SCRIPT
    });
  }
})(jQuery);
</script>
SCRIPT;
    $script .= "\n";
    // フッターにJavaScriptコードを出力
    add_action('wp_footer', function() use ($script) {
      echo $script;
    },20);

  }

  } //$display_flag

	return $html;
}
add_shortcode( 'tcd_image_slider', 'sc_image_slider' );


?>