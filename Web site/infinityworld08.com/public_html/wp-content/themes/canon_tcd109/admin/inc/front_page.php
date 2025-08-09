<?php
/*
 * トップページの設定
 */

// Add default values
add_filter( 'before_getting_design_plus_option', 'add_front_page_dp_default_options' );


// Add label of front page tab
add_action( 'tcd_tab_labels', 'add_front_page_tab_label' );


// Add HTML of front page tab
add_action( 'tcd_tab_panel', 'add_front_page_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_front_page_theme_options_validate' );


// タブの名前
function add_front_page_tab_label( $tab_labels ) {
	$tab_labels['front_page'] = __( 'Front page', 'tcd-canon' );
	return $tab_labels;
}


// 初期値
function add_front_page_dp_default_options( $dp_default_options ) {

  // ヘッダーコンテンツ
	$dp_default_options['show_header_content'] = '1';
	$dp_default_options['index_header_content_type'] = 'type1';
	$dp_default_options['index_header_caption_type'] = 'type2';

  // 画像スライダーB
  $dp_default_options['index_slider'] = false;
  $dp_default_options['index_slider_sp'] = false;
	$dp_default_options['index_slider_animation_type'] = 'zoom_in';

  // 動画・YouTube
	$dp_default_options['index_header_content_video'] = '';
	$dp_default_options['index_header_content_youtube'] = '';

  // その他
	$dp_default_options['index_header_content_catch'] = __( 'Catchphrase', 'tcd-canon' );
	$dp_default_options['index_header_content_catch_font_type'] = 'type2';
	$dp_default_options['index_header_content_catch_font_size'] = '40';
	$dp_default_options['index_header_content_catch_font_size_sp'] = '24';
	$dp_default_options['index_header_content_desc'] = __( 'Description will be displayed here.<br>Description will be displayed here.<br>Description will be displayed here.', 'tcd-canon' );
	$dp_default_options['index_header_content_desc_mobile'] = '';
	$dp_default_options['index_header_content_button'] = __( 'Button', 'tcd-canon' );
  $dp_default_options['index_header_content_button_url'] = 'https://demo.tcd-theme.com/tcd109/';
  $dp_default_options['index_header_content_button_target'] = '1';

	$dp_default_options['index_header_logo_image'] = false;
	$dp_default_options['index_header_logo_image_mobile'] = false;
	$dp_default_options['index_header_logo_retina'] = 'no';

	$dp_default_options['index_header_content_overlay_color'] = '#000000';
	$dp_default_options['index_header_content_overlay_opacity'] = '0.1';

	$dp_default_options['index_header_content_height'] = 'type2';

	// ニュースティッカーの設定
	$dp_default_options['show_header_news'] = '1';
	$dp_default_options['header_news_post_type'] = 'news';
	$dp_default_options['header_news_post_order'] = 'date';

  // コンテンツビルダー
	$dp_default_options['page_content_width_type'] = 'type1';
	$dp_default_options['page_content_width'] = '1000';
	$dp_default_options['index_content_type'] = 'type1';

	$dp_default_options['contents_builder'] = array(
		array(
            "type" => "design_content",
            "show_content" => 1,
            "headline" => __( 'Design content', 'tcd-canon' ),
            "sub_title" => __( 'Sub title', 'tcd-canon' ),
            "desc" => __( 'Description will be displayed here. Description will be displayed here. Description will be displayed here.', 'tcd-canon' ),
            "desc_mobile" => "",
            "button_label" => __( 'Button', 'tcd-canon' ),
            "button_url" => "#",
            "button_target" => 0,
            "layout" => "type1",
            "image_slider" => "",
            "catch" => __( 'Catchphrase will be displayed here.', 'tcd-canon' ),
            "desc2" => __( 'Description will be displayed here. Description will be displayed here. Description will be displayed here.', 'tcd-canon' ),
		),
		array(
            "type" => "three_column",
            "show_content" => 1,
            "headline" => __( 'Three column content', 'tcd-canon' ),
            "sub_title" => __( 'Sub title', 'tcd-canon' ),
            "desc" => __( 'Description will be displayed here. Description will be displayed here. Description will be displayed here.', 'tcd-canon' ),
            "desc_mobile" => "",
            "button_label" => __( 'Button', 'tcd-canon' ),
            "button_url" => "#",
            "button_target" => 0,
            "item_list" => array(
              array(
                "image" => "",
                "title" => 'CONTENT1',
                "url" => "#",
                "target" => 0,
              ),
              array(
                "image" => "",
                "title" => 'CONTENT2',
                "url" => "#",
                "target" => 0,
              ),
              array(
                "image" => "",
                "title" => 'CONTENT3',
                "url" => "#",
                "target" => 0,
              ),
            ),
		),
		array(
            "type" => "blog_list",
            "show_content" => 1,
            "headline" => __( 'Blog', 'tcd-canon' ),
            "sub_title" => __( 'Sub title', 'tcd-canon' ),
            "desc" => __( 'Description will be displayed here. Description will be displayed here. Description will be displayed here.', 'tcd-canon' ),
            "desc_mobile" => "",
            "button_label" => __( 'Blog', 'tcd-canon' ),
            "post_num" => "6",
            "post_num_sp" => "6",
            "show_category_list" => "display",
            "post_type" => "all_post",
            "post_order_custom" => "",
            "category_id" => "",
            "post_order" => "date",
		),
		array(
            "type" => "two_column",
            "show_content" => 1,
            "headline" => __( 'Two column content', 'tcd-canon' ),
            "sub_title" => __( 'Sub title', 'tcd-canon' ),
            "desc" => __( 'Description will be displayed here. Description will be displayed here. Description will be displayed here.', 'tcd-canon' ),
            "desc_mobile" => "",
            "button_label" => __( 'Button', 'tcd-canon' ),
            "button_url" => "#",
            "button_target" => 0,
            "item_list" => array(
              array(
                "headline" => 'CONTENT1',
                "sub_title" => __( 'Sub title', 'tcd-canon' ),
                "desc" => __( 'Description will be displayed here. Description will be displayed here. Description will be displayed here.', 'tcd-canon' ),
                "image" => "",
                "url" => "#",
                "target" => 0,
              ),
              array(
                "headline" => 'CONTENT2',
                "sub_title" => __( 'Sub title', 'tcd-canon' ),
                "desc" => __( 'Description will be displayed here. Description will be displayed here. Description will be displayed here.', 'tcd-canon' ),
                "image" => "",
                "url" => "#",
                "target" => 0,
              ),
            ),
		),
		array(
            "type" => "news_list",
            "show_content" => 1,
            "headline" => __( 'News', 'tcd-canon' ),
            "sub_title" => __( 'Sub title', 'tcd-canon' ),
            "desc" => __( 'Description will be displayed here. Description will be displayed here. Description will be displayed here.', 'tcd-canon' ),
            "desc_mobile" => "",
            "button_label" => __( 'News', 'tcd-canon' ),
            "post_num" => "6",
            "post_num_sp" => "6",
            "post_type" => "all_post",
            "post_order" => "rand",
            "post_order_custom" => "",
            "category_id" => "",
		),
  );

	return $dp_default_options;

}

// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_front_page_tab_panel( $options ) {

  global $blog_label, $dp_default_options, $item_type_options, $font_type_options, $bool_options, $basic_display_options, $index_header_type_options;
  $news_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-canon' );
  $gallery_label = $options['gallery_label'] ? esc_html( $options['gallery_label'] ) : __( 'Guest room', 'tcd-canon' );
  $service_label = $options['service_label'] ? esc_html( $options['service_label'] ) : __( 'Service', 'tcd-canon' );

?>

<div id="tab-content-front-page" class="tab-content">

   <?php // ヘッダーコンテンツ ---------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Header content', 'tcd-canon');  ?></h3>
    <div class="theme_option_field_ac_content header_content_setting_area">

     <p class="displayment_checkbox"><label><input name="dp_options[show_header_content]" type="checkbox" value="1" <?php checked( $options['show_header_content'], 1 ); ?>><?php _e( 'Display header content', 'tcd-canon' ); ?></label></p>
     <div style="<?php if($options['show_header_content'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">

     <h4 class="theme_option_headline2"><?php _e('Background type', 'tcd-canon'); ?></h4>
     <ul class="design_radio_button horizontal clearfix">
      <li class="index_header_content_type1">
       <input type="radio" id="index_header_content_type1" name="dp_options[index_header_content_type]" value="type1" <?php checked( $options['index_header_content_type'], 'type1' ); ?> />
       <label for="index_header_content_type1"><?php _e('Image slider', 'tcd-canon');  ?></label>
      </li>
      <li class="index_header_content_type2">
       <input type="radio" id="index_header_content_type2" name="dp_options[index_header_content_type]" value="type2" <?php checked( $options['index_header_content_type'], 'type2' ); ?> />
       <label for="index_header_content_type2"><?php _e('Video', 'tcd-canon');  ?></label>
      </li>
      <li class="index_header_content_type3">
       <input type="radio" id="index_header_content_type3" name="dp_options[index_header_content_type]" value="type3" <?php checked( $options['index_header_content_type'], 'type3' ); ?> />
       <label for="index_header_content_type3"><?php _e('YouTube', 'tcd-canon');  ?></label>
      </li>
     </ul>

     <div class="tab_parent">

      <div class="sub_box_tab">
       <div class="tab active" data-tab="tab1"><span class="label"><?php _e('Content', 'tcd-canon'); ?></span></div>
       <div class="tab" data-tab="tab2"><span class="label index_header_content_type1_option"><?php _e('Image slider', 'tcd-canon'); ?></span><span class="label index_header_content_type2_option"><?php _e('Video', 'tcd-canon'); ?></span><span class="index_header_content_type3_option"><?php _e('YouTube', 'tcd-canon'); ?></span></div>
      </div>

      <?php // コンテンツ ?>
      <div class="sub_box_tab_content active" data-tab-content="tab1">

       <h4 class="theme_option_headline2"><?php _e('Content type', 'tcd-canon'); ?></h4>
       <?php echo tcd_admin_image_radio_button($options, 'index_header_caption_type', $index_header_type_options) ?>

       <?php // ロゴ  ----- ?>
       <div id="index_header_caption_type1_option">
        <h4 class="theme_option_headline2"><?php _e('Logo', 'tcd-canon');  ?></h4>
        <ul class="option_list">
         <li class="cf">
          <span class="label"><?php _e('Logo image', 'tcd-canon'); ?><span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-canon'), '664', '506'); ?></span></span>
          <div class="image_box cf">
           <div class="cf cf_media_field hide-if-no-js index_header_logo_image">
            <input type="hidden" value="<?php echo esc_attr( $options['index_header_logo_image'] ); ?>" id="index_header_logo_image" name="dp_options[index_header_logo_image]" class="cf_media_id">
            <div class="preview_field"><?php if($options['index_header_logo_image']){ echo wp_get_attachment_image($options['index_header_logo_image'], 'full'); }; ?></div>
            <div class="buttton_area">
             <input type="button" value="<?php _e('Select Image', 'tcd-canon'); ?>" class="cfmf-select-img button">
             <input type="button" value="<?php _e('Remove Image', 'tcd-canon'); ?>" class="cfmf-delete-img button <?php if(!$options['index_header_logo_image']){ echo 'hidden'; }; ?>">
            </div>
           </div>
          </div>
         </li>
         <li class="cf">
          <span class="label"><?php _e('Logo image (mobile)', 'tcd-canon'); ?><span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-canon'), '450', '340'); ?></span></span>
          <div class="image_box cf">
           <div class="cf cf_media_field hide-if-no-js index_header_logo_image_mobile">
            <input type="hidden" value="<?php echo esc_attr( $options['index_header_logo_image_mobile'] ); ?>" id="index_header_logo_image_mobile" name="dp_options[index_header_logo_image_mobile]" class="cf_media_id">
            <div class="preview_field"><?php if($options['index_header_logo_image_mobile']){ echo wp_get_attachment_image($options['index_header_logo_image_mobile'], 'full'); }; ?></div>
            <div class="buttton_area">
             <input type="button" value="<?php _e('Select Image', 'tcd-canon'); ?>" class="cfmf-select-img button">
             <input type="button" value="<?php _e('Remove Image', 'tcd-canon'); ?>" class="cfmf-delete-img button <?php if(!$options['index_header_logo_image_mobile']){ echo 'hidden'; }; ?>">
            </div>
           </div>
          </div>
         </li>
         <li class="cf"><span class="label"><?php _e('Use retina display image', 'tcd-canon'); ?></span><?php echo tcd_basic_radio_button($options, 'index_header_logo_retina', $bool_options); ?></li>
        </ul>
       </div><!-- END #index_header_caption_type1_option -->

       <?php // テキストコンテンツ  ----- ?>
       <div id="index_header_caption_type2_option">
        <h4 class="theme_option_headline2"><?php _e('Text content', 'tcd-canon'); ?></h4>
        <div class="front_page_image middle">
         <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/image/index_header.jpg?2.0" alt="" title="" />
        </div>
        <ul class="option_list">
         <li class="cf"><span class="label"><span class="num">1</span><?php _e('Catchphrase', 'tcd-canon'); ?></span><textarea class="full_width" cols="50" rows="3" name="dp_options[index_header_content_catch]"><?php echo esc_textarea(  $options['index_header_content_catch'] ); ?></textarea></li>
         <li class="cf space"><span class="label"><?php _e('Font type', 'tcd-canon'); ?></span><?php echo tcd_basic_radio_button($options, 'index_header_content_catch_font_type', $font_type_options); ?></li>
         <li class="cf space"><span class="label"><?php _e('Font size', 'tcd-canon'); ?></span><?php echo tcd_font_size_option($options, 'index_header_content_catch_font_size'); ?></li>
         <li class="cf"><span class="label"><span class="num">2</span><?php _e('Description', 'tcd-canon'); ?></span><textarea class="full_width" cols="50" rows="3" name="dp_options[index_header_content_desc]"><?php echo esc_textarea(  $options['index_header_content_desc'] ); ?></textarea></li>
         <li class="cf space"><span class="label"><?php _e('Description (mobile)', 'tcd-canon'); ?></span><textarea class="full_width" cols="50" rows="3" placeholder="<?php _e( 'Please indicate if you would like to display a short text for mobile sizes.', 'tcd-canon' ); ?>" name="dp_options[index_header_content_desc_mobile]"><?php echo esc_textarea(  $options['index_header_content_desc_mobile'] ); ?></textarea></li>
         <li class="cf"><span class="label"><span class="num">3</span><?php _e('Button', 'tcd-canon'); ?></span><input type="text" class="full_width" name="dp_options[index_header_content_button]" value="<?php echo esc_attr($options['index_header_content_button']); ?>" /></li>
         <li class="cf space">
          <span class="label"><?php _e('Link URL', 'tcd-canon'); ?></span>
          <div class="admin_link_option">
           <input type="text" name="dp_options[index_header_content_button_url]" placeholder="https://example.com/" value="<?php echo esc_attr( $options['index_header_content_button_url'] ); ?>">
           <input id="index_header_content_button_target" class="admin_link_option_target" name="dp_options[index_header_content_button_target]" type="checkbox" value="1" <?php checked( $options['index_header_content_button_target'], 1 ); ?>>
           <label for="index_header_content_button_target">&#xe920;</label>
          </div>
         </li>
        </ul>
       </div><!-- END #index_header_caption_type2_option -->

      </div><!-- END .sub_box_tab_content -->

      <?php // 背景画像 ----------------------- ?>
      <div class="sub_box_tab_content" data-tab-content="tab2">

       <?php // 画像スライダー --------------------------------------- ?>
       <div class="index_header_content_type1_option">

        <h4 class="theme_option_headline2"><?php _e('Image slider', 'tcd-canon'); ?></h4>
        <ul class="option_list">
         <li class="cf">
          <span class="label"><?php _e( 'Image', 'tcd-canon' ); ?>
            <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-canon'), '1740', '780'); ?></span>
            <span class="recommend_desc"><?php _e('You can register multiple image by clicking images in media library.', 'tcd-canon'); ?></span>
          </span>
          <?php echo tcd_multi_media_uploader( 'index_slider', $options ); ?>
         </li>
         <li class="cf">
          <span class="label"><?php _e( 'Image (mobile)', 'tcd-canon' ); ?>
           <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-canon'), '750', '1050'); ?></span>
          </span>
          <?php echo tcd_multi_media_uploader( 'index_slider_sp', $options ); ?>
         </li>
         <li class="cf">
          <span class="label"><?php _e('Animation type', 'tcd-canon');  ?></span>
          <div class="standard_radio_button">
           <input id="index_slider_animation_type_cross_fade" type="radio" name="dp_options[index_slider_animation_type]" value="cross_fade" <?php checked( $options['index_slider_animation_type'], 'cross_fade' ); ?>>
           <label for="index_slider_animation_type_cross_fade"><?php _e('Cross fade', 'tcd-canon');  ?></label>
           <input id="index_slider_animation_type_zoom_in" type="radio" name="dp_options[index_slider_animation_type]" value="zoom_in" <?php checked( $options['index_slider_animation_type'], 'zoom_in' ); ?>>
           <label for="index_slider_animation_type_zoom_in"><?php _e('Zoom in', 'tcd-canon');  ?></label>
           <input id="index_slider_animation_type_zoom_out" type="radio" name="dp_options[index_slider_animation_type]" value="zoom_out" <?php checked( $options['index_slider_animation_type'], 'zoom_out' ); ?>>
           <label for="index_slider_animation_type_zoom_out"><?php _e('Zoom out', 'tcd-canon');  ?></label>
          </div>
         </li>
        </ul>

       </div><!-- END .index_header_content_type1_option -->

       <?php // 動画 --------------------------------------- ?>
       <div class="index_header_content_type2_option">

        <h4 class="theme_option_headline2"><?php _e('Video', 'tcd-canon'); ?></h4>
        <div class="theme_option_message2">
         <p><?php _e('Please upload MP4 format file.', 'tcd-canon');  ?><br>
         <?php _e('Web browser takes few second to load the data of video so we recommend to use loading screen if you want to display video.', 'tcd-canon'); ?><br>
         <?php _e('Recommended MP4 file size: 10 MB or less.<br>The screen ratio of the video is assumed to be 16:9.', 'tcd-canon'); ?></p>
        </div>
        <div class="cf cf_media_field hide-if-no-js index_header_content_video">
         <input type="hidden" value="<?php if($options['index_header_content_video']) { echo esc_attr( $options['index_header_content_video'] ); }; ?>" id="index_header_content_video" name="dp_options[index_header_content_video]" class="cf_media_id">
         <div class="preview_field preview_field_video">
          <?php if($options['index_header_content_video']){ ?>
          <h4><?php _e( 'Uploaded MP4 file', 'tcd-canon' ); ?></h4>
          <p><?php echo esc_url(wp_get_attachment_url($options['index_header_content_video'])); ?></p>
          <?php }; ?>
         </div>
         <div class="buttton_area">
          <input type="button" value="<?php _e('Select MP4 file', 'tcd-canon'); ?>" class="cfmf-select-video button">
          <input type="button" value="<?php _e('Remove MP4 file', 'tcd-canon'); ?>" class="cfmf-delete-video button <?php if(!$options['index_header_content_video']){ echo 'hidden'; }; ?>">
         </div>
        </div>

       </div><!-- END .index_header_content_type2_option -->

       <?php // YouTube --------------------------------------- ?>
       <div class="index_header_content_type3_option">

        <h4 class="theme_option_headline2"><?php _e('YouTube', 'tcd-canon'); ?></h4>
        <div class="theme_option_message2">
         <p><?php _e('Please enter YouTube URL.', 'tcd-canon');  ?></p>
         <p><?php _e('Web browser takes few second to load the data of video so we recommend to use loading screen if you want to display video.', 'tcd-canon'); ?></p>
        </div>
        <input class="full_width" type="text" name="dp_options[index_header_content_youtube]" value="<?php echo esc_attr( $options['index_header_content_youtube'] ); ?>">

       </div><!-- END .index_header_content_type3_option -->

       <?php // オーバーレイ（共通） ?>
       <h4 class="theme_option_headline2"><?php _e('Overlay', 'tcd-canon'); ?></h4>
       <ul class="option_list">
        <li class="cf"><span class="label"><?php _e('Color', 'tcd-canon'); ?></span><input type="text" name="dp_options[index_header_content_overlay_color]" value="<?php echo esc_attr( $options['index_header_content_overlay_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
        <li class="cf">
         <span class="label"><?php _e('Transparency of overlay', 'tcd-canon'); ?></span><input class="hankaku" style="width:70px;" type="number" min="0" max="1" step="0.1" name="dp_options[index_header_content_overlay_opacity]" value="<?php echo esc_attr( $options['index_header_content_overlay_opacity'] ); ?>" />
         <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
          <p><?php _e('Please specify the number of 0 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-canon');  ?>
          <?php _e('Please enter 0 if you don\'t want to use overlay.', 'tcd-canon');  ?></p>
         </div>
        </li>
       </ul>

       <?php // スライダーの高さ ?>
       <h4 class="theme_option_headline2"><?php _e('Other setting', 'tcd-canon'); ?></h4>
       <div class="theme_option_message2 index_header_content_type1_option">
        <p><?php _e('"original size" ratio of the image will be maintained and can be displayed without being out of screen view.<br>If option "Image (mobile)" is not registered, the PC image will be cropped and displayed in mobile device.', 'tcd-canon'); ?></p>
       </div>
       <ul class="option_list">
        <li class="cf">
         <span class="label"><?php _e('Slider height', 'tcd-canon');  ?></span>
         <div id="index_header_content_height_option" class="standard_radio_button">
          <input id="index_header_content_height_type1" type="radio" name="dp_options[index_header_content_height]" value="type1" <?php checked( $options['index_header_content_height'], 'type1' ); ?>>
          <label for="index_header_content_height_type1"><?php _e('Full size', 'tcd-canon');  ?></label>
          <input id="index_header_content_height_type2" type="radio" name="dp_options[index_header_content_height]" value="type2" <?php checked( $options['index_header_content_height'], 'type2' ); ?>>
          <label for="index_header_content_height_type2"><span class="index_header_content_type1_option"><?php _e('Original size', 'tcd-canon');  ?></span><span class="non_index_header_content_type1_option"><?php _e('Aspect ratio 16:9', 'tcd-canon');  ?></span></label>
         </div>
        </li>
       </ul>

      </div><!-- END .sub_box_tab_content -->

     </div><!-- END .non_index_header_content_type1_option -->

     </div><!-- END show header content -->

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-canon' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-canon' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // ニュースティッカー設定 ----------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('News ticker', 'tcd-canon');  ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="front_page_image">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/image/index_news.jpg" alt="" title="" />
     </div>

     <p class="displayment_checkbox"><label><input name="dp_options[show_header_news]" type="checkbox" value="1" <?php checked( $options['show_header_news'], 1 ); ?>><?php _e( 'Display news ticker', 'tcd-canon' ); ?></label></p>
     <div style="<?php if($options['show_header_news'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <ul class="option_list">
       <li class="cf" style="border-top:1px dotted #ccc;<?php if(!$options['use_news']){ echo ' display:none;'; }; ?>">
        <span class="label"><?php _e('Post type', 'tcd-canon');  ?></span>
        <div class="standard_radio_button">
         <input id="header_news_post_type_post" type="radio" name="dp_options[header_news_post_type]" value="post" <?php checked( $options['header_news_post_type'], 'post' ); ?>>
         <label for="header_news_post_type_post"><?php echo esc_html($blog_label); ?></label>
         <input id="header_news_post_type_news" type="radio" name="dp_options[header_news_post_type]" value="news" <?php checked( $options['header_news_post_type'], 'news' ); ?>>
         <label for="header_news_post_type_news"><?php echo esc_html($news_label); ?></label>
        </div>
       </li>
       <li class="cf"<?php if(!$options['use_news']){ echo ' style="border-top:1px dotted #ccc;"'; }; ?>>
        <span class="label"><?php _e('Post order', 'tcd-canon');  ?></span>
        <div class="standard_radio_button">
         <input id="header_news_post_order_date" type="radio" name="dp_options[header_news_post_order]" value="date" <?php checked( $options['header_news_post_order'], 'date' ); ?>>
         <label for="header_news_post_order_date"><?php _e('Date', 'tcd-canon'); ?></label>
         <input id="header_news_post_order_rand" type="radio" name="dp_options[header_news_post_order]" value="rand" <?php checked( $options['header_news_post_order'], 'rand' ); ?>>
         <label for="header_news_post_order_rand"><?php _e('Random', 'tcd-canon'); ?></label>
        </div>
       </li>
      </ul>
     </div><!-- END .displayment_checkbox -->

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-canon' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-canon' ); ?></a></li>
     </ul>

    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // コンテンツビルダー ここから ■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■ ?>
   <div class="theme_option_field theme_option_field_ac open active">
    <h3 class="theme_option_headline"><?php _e('Content builder', 'tcd-canon');  ?></h3>
    <div class="theme_option_field_ac_content">

     <ul class="design_radio_button" style="margin-bottom:25px;">
      <li class="index_content_type1_button">
       <input type="radio" id="index_content_type1" name="dp_options[index_content_type]" value="type1" <?php checked( $options['index_content_type'], 'type1' ); ?> />
       <label for="index_content_type1"><?php _e('Use content builder', 'tcd-canon');  ?></label>
      </li>
      <li class="index_content_type2_button">
       <input type="radio" id="index_content_type2" name="dp_options[index_content_type]" value="type2" <?php checked( $options['index_content_type'], 'type2' ); ?> />
       <label for="index_content_type2"><?php _e('Use page content instead of content builder', 'tcd-canon');  ?></label>
      </li>
     </ul>

     <?php
          // コンテンツビルダーの代わりに使う固定ページのコンテンツ
          $front_page_id = get_option('page_on_front');
          if($front_page_id){
     ?>
     <div class="index_content_type2_option" style="<?php if($options['index_content_type'] == 'type2') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <div class="theme_option_message2">
       <p><?php printf(__('Please set content from <a href="post.php?post=%s&action=edit" target="_blank">Front page edit screen</a>.', 'tcd-canon'), $front_page_id); ?></p>
      </div>
      <h4 class="theme_option_headline2"><?php _e('Content width', 'tcd-canon');  ?></h4>
      <ul class="option_list">
       <li class="cf">
        <span class="label"><?php _e('Content width type', 'tcd-canon'); ?></span>
        <div class="standard_radio_button">
         <input id="page_content_width_type1" type="radio" name="dp_options[page_content_width_type]" value="type1" <?php checked( $options['page_content_width_type'], 'type1' ); ?>>
         <label for="page_content_width_type1"><?php _e('Any width', 'tcd-canon'); ?></label>
         <input id="page_content_width_type2" type="radio" name="dp_options[page_content_width_type]" value="type2" <?php checked( $options['page_content_width_type'], 'type2' ); ?>>
         <label for="page_content_width_type2"><?php _e('Full screen width', 'tcd-canon'); ?></label>
        </div>
       </li>
       <li class="cf page_content_width_type1_option" style="<?php if($options['page_content_width_type'] == 'type1'){ echo 'display:block;'; } else {  echo 'display:none;'; }; ?>">
        <span class="label"><?php _e('Content width', 'tcd-canon'); ?></span><input class="hankaku page_content_width_input" style="width:100px;" type="number" name="dp_options[page_content_width]" value="<?php echo esc_attr($options['page_content_width']); ?>" /><span>px</span>
       </li>
      </ul>
     </div>
     <?php }; ?>

     <?php // コンテンツビルダー ------------------------------------------------------------------------------------- ?>
     <div class="index_content_type1_option" style="<?php if($options['index_content_type'] == 'type1') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">

      <h4 class="theme_option_headline2"><?php _e( 'Contents Builder', 'tcd-canon' ); ?></h4>

      <div class="js-contents-builder admin-contents-builder">
       <input type="hidden" name="dp_options[contents_builder]" value="">
       <div class="admin-contents-builder__list js-contents-builder-list">
        <?php
             if ( !empty( $options['contents_builder'] ) ) {
               foreach( $options['contents_builder'] as $key => $values ) :
                 admin_contents_builder_start( $key, $values );
                 switch( true ){
                   case $values['type'] == 'image_slider' :
                     admin_contents_builder_image_slider( $key, $values );
                     break;
                   case $values['type'] == 'design_content' :
                     admin_contents_builder_design_content( $key, $values );
                     break;
                   case $values['type'] == 'content_carousel' :
                     admin_contents_builder_content_carousel( $key, $values );
                     break;
                   case $values['type'] == 'two_column' :
                     admin_contents_builder_two_column( $key, $values );
                     break;
                   case $values['type'] == 'three_column' :
                     admin_contents_builder_three_column( $key, $values );
                     break;
                   case $values['type'] == 'blog_list' :
                     admin_contents_builder_blog_list( $key, $values );
                     break;
                   case $values['type'] == 'news_list' :
                     admin_contents_builder_news_list( $key, $values );
                     break;
                   case $values['type'] == 'free_space' :
                     admin_contents_builder_free_space( $key, $values );
                     break;
                 }
                 admin_contents_builder_end();
               endforeach;
             }
        ?>
       </div>
       <div class="admin-contents-builder__add">
        <div class="admin-contents-builder__add-info">
         <span><?php _e( 'Additional Items', 'tcd-canon' ); ?></span>
         <p><?php _e( 'The following items can be added by clicking on them', 'tcd-canon' ); ?></p>
        </div>
        <div class="admin-contents-builder__add-list">
         <?php
              $content_types = array('image_slider', 'design_content', 'content_carousel', 'two_column', 'three_column', 'blog_list', 'news_list', 'free_space');
              foreach( $content_types as $type ){
                ob_start();
                $key = 'cb-index';
                admin_contents_builder_start( $key, array( 'type' => $type ) );
                switch( true ){
                  case $type == 'image_slider' :
                    $title = __( 'Image slider', 'tcd-canon' );
                    $is_active = 'is-active';
                    $image_name = 'image_slider';
                    admin_contents_builder_image_slider( $key, array() );
                    break;
                  case $type == 'design_content' :
                    $title = __( 'Design content', 'tcd-canon' );
                    $is_active = 'is-active';
                    $image_name = 'design_content';
                    admin_contents_builder_design_content( $key, array() );
                    break;
                  case $type == 'content_carousel':
                    $title = __('Content carousel', 'tcd-canon');
                    $is_active = 'is-active';
                    $image_name = 'content_carousel';
                    admin_contents_builder_content_carousel( $key, array() );
                    break;
                  case $type == 'two_column':
                    $title = __('Two column content', 'tcd-canon');
                    $is_active = 'is-active';
                    $image_name = 'two_column';
                    admin_contents_builder_two_column( $key, array() );
                    break;
                  case $type == 'three_column':
                    $title = __('Three column content', 'tcd-canon');
                    $is_active = 'is-active';
                    $image_name = 'three_column';
                    admin_contents_builder_three_column( $key, array() );
                    break;
                  case $type == 'blog_list' :
                    $title = sprintf(__('%s list', 'tcd-canon'), $blog_label);
                    $is_active = 'is-active';
                    $image_name = 'blog_list';
                    admin_contents_builder_blog_list( $key, array() );
                    break;
                  case $type == 'news_list' :
                    $title = sprintf(__('%s list', 'tcd-canon'), $news_label);
                    $is_active = $options['use_news'] ? 'is-active' : '';
                    $image_name = 'news_list';
                    admin_contents_builder_news_list( $key, array() );
                    break;
                  case $type == 'free_space' :
                    $title = __( 'Free space', 'tcd-canon' );
                    $is_active = 'is-active';
                    $image_name = 'free_space';
                    admin_contents_builder_free_space( $key, array() );
                    break;
                }
                admin_contents_builder_end();
                $clone = ob_get_clean();
         ?>
         <div class="admin-contents-builder__add-item js-contents-builder-add <?php echo $is_active; ?>" data-clone="<?php echo esc_attr( $clone ); ?>">
          <div class="admin-contents-builder__add-item__inner">
           <div class="admin-contents-builder__add-item__overlay">
            <?php if( $is_active ){ ?>
            <span class="admin-contents-builder__add-item__icon c-icon">&#xe145;</span>
            <?php _e( 'Add this item', 'tcd-canon' ); ?>
            <?php } else { ?>
            <?php _e( 'Not available now', 'tcd-canon' ); ?>
            <?php } ?>
           </div>
           <img class="admin-contents-builder__add-item__image" src="<?php echo get_template_directory_uri() . '/admin/img/image/index/cb_' . $image_name . '.jpg'; ?>?1.1" width="" height="" />
          </div>
          <span class="admin-contents-builder__add-item__label"><?php echo $title; ?></span>
         </div>
         <?php
              } // END foreach
         ?>
        </div><!-- END .admin-contents-builder__add-list -->
       </div><!-- END .admin-contents-builder__add -->
      </div><!-- END .admin-contents-builder -->

     </div><!-- END .index_content_type1_option -->

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-canon' ); ?>" /></li>
     </ul>

    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->

</div><!-- END .tab-content -->

<?php
} // END add_front_page_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_front_page_theme_options_validate( $input ) {

  global $dp_default_options, $item_type_options, $font_type_options;


  // ヘッダーコンテンツ
  $input['show_header_content'] = ! empty( $input['show_header_content'] ) ? 1 : 0;
  $input['index_header_content_type'] = wp_filter_nohtml_kses( $input['index_header_content_type'] );
  $input['index_header_caption_type'] = wp_filter_nohtml_kses( $input['index_header_caption_type'] );

  // 画像スライダー
  $input['index_slider'] = wp_filter_nohtml_kses( $input['index_slider'] );
  $input['index_slider_sp'] = wp_filter_nohtml_kses( $input['index_slider_sp'] );
  $input['index_slider_animation_type'] = wp_filter_nohtml_kses( $input['index_slider_animation_type'] );

  // 動画・YouTube
  $input['index_header_content_video'] = wp_filter_nohtml_kses( $input['index_header_content_video'] );
  $input['index_header_content_youtube'] = wp_filter_nohtml_kses( $input['index_header_content_youtube'] );

  $input['index_header_content_catch'] = wp_kses_post( $input['index_header_content_catch'] );
  $input['index_header_content_catch_font_type'] = wp_filter_nohtml_kses( $input['index_header_content_catch_font_type'] );
  $input['index_header_content_catch_font_size'] = wp_filter_nohtml_kses( $input['index_header_content_catch_font_size'] );
  $input['index_header_content_catch_font_size_sp'] = wp_filter_nohtml_kses( $input['index_header_content_catch_font_size_sp'] );
  $input['index_header_content_desc'] = wp_kses_post( $input['index_header_content_desc'] );
  $input['index_header_content_desc_mobile'] = wp_kses_post( $input['index_header_content_desc_mobile'] );
  $input['index_header_content_button'] = wp_kses_post( $input['index_header_content_button'] );
  $input['index_header_content_button_url'] = wp_kses_post( $input['index_header_content_button_url'] );
  $input['index_header_content_button_target'] = wp_kses_post( $input['index_header_content_button_target'] );

  $input['index_header_content_overlay_color'] = wp_filter_nohtml_kses( $input['index_header_content_overlay_color'] );
  $input['index_header_content_overlay_opacity'] = wp_filter_nohtml_kses( $input['index_header_content_overlay_opacity'] );

  $input['index_header_logo_image'] = wp_filter_nohtml_kses( $input['index_header_logo_image'] );
  $input['index_header_logo_image_mobile'] = wp_filter_nohtml_kses( $input['index_header_logo_image_mobile'] );
  $input['index_header_logo_retina'] = wp_filter_nohtml_kses( $input['index_header_logo_retina'] );

  $input['index_header_content_height'] = wp_kses_post( $input['index_header_content_height'] );

  // ニュースティッカーの設定
  $input['show_header_news'] = ! empty( $input['show_header_news'] ) ? 1 : 0;
  $input['header_news_post_type'] = wp_kses_post( $input['header_news_post_type'] );
  $input['header_news_post_order'] = wp_filter_nohtml_kses( $input['header_news_post_order'] );

  // コンテンツビルダーの代わりに使う固定ページのコンテンツ
  $input['index_content_type'] = wp_filter_nohtml_kses( $input['index_content_type'] );
  $input['page_content_width'] = wp_filter_nohtml_kses( $input['page_content_width'] );


  // コンテンツビルダー -----------------------------------------------------------------------------
  $contents_builder = array();
  if ( isset( $input['contents_builder'] ) && is_array( $input['contents_builder'] ) ) {
    foreach ( $input['contents_builder'] as $key => $value ) {

      if( !isset( $value['type'] ) || !$value['type'] )
        continue;

      switch( $value['type'] ){

        case 'image_slider' :
          $contents_builder[] = array(
            'type' => $value['type'],
            'show_content' => ! empty( $input['contents_builder'][$key]['show_content'] ) ? 1 : 0,
            'headline' => isset( $input['contents_builder'][$key]['headline'] ) ? wp_kses_post( $input['contents_builder'][$key]['headline'] ) : '',
            'sub_title' => isset( $input['contents_builder'][$key]['sub_title'] ) ? wp_kses_post( $input['contents_builder'][$key]['sub_title'] ) : '',
            'desc' => isset( $input['contents_builder'][$key]['desc'] ) ? wp_kses_post( $input['contents_builder'][$key]['desc'] ) : '',
            'desc_mobile' => isset( $input['contents_builder'][$key]['desc_mobile'] ) ? wp_kses_post( $input['contents_builder'][$key]['desc_mobile'] ) : '',
            'layout' => isset( $input['contents_builder'][$key]['layout'] ) ? wp_kses_post( $input['contents_builder'][$key]['layout'] ) : 'type1',
            'image_slider' => isset( $input['contents_builder'][$key]['image_slider'] ) ? wp_kses_post( $input['contents_builder'][$key]['image_slider'] ) : '',
            'button_label' => isset( $input['contents_builder'][$key]['button_label'] ) ? wp_kses_post( $input['contents_builder'][$key]['button_label'] ) : '',
            'button_url' => isset( $input['contents_builder'][$key]['button_url'] ) ? wp_kses_post( $input['contents_builder'][$key]['button_url'] ) : '',
            'button_target' => ! empty( $input['contents_builder'][$key]['button_target'] ) ? 1 : 0,
          );
          break;

        case 'design_content' :
          $contents_builder[] = array(
            'type' => $value['type'],
            'show_content' => ! empty( $input['contents_builder'][$key]['show_content'] ) ? 1 : 0,
            'headline' => isset( $input['contents_builder'][$key]['headline'] ) ? wp_kses_post( $input['contents_builder'][$key]['headline'] ) : '',
            'sub_title' => isset( $input['contents_builder'][$key]['sub_title'] ) ? wp_kses_post( $input['contents_builder'][$key]['sub_title'] ) : '',
            'desc' => isset( $input['contents_builder'][$key]['desc'] ) ? wp_kses_post( $input['contents_builder'][$key]['desc'] ) : '',
            'desc_mobile' => isset( $input['contents_builder'][$key]['desc_mobile'] ) ? wp_kses_post( $input['contents_builder'][$key]['desc_mobile'] ) : '',
            'layout' => isset( $input['contents_builder'][$key]['layout'] ) ? wp_kses_post( $input['contents_builder'][$key]['layout'] ) : 'type1',
            'image_slider' => isset( $input['contents_builder'][$key]['image_slider'] ) ? wp_kses_post( $input['contents_builder'][$key]['image_slider'] ) : '',
            'catch' => isset( $input['contents_builder'][$key]['catch'] ) ? wp_kses_post( $input['contents_builder'][$key]['catch'] ) : '',
            'desc2' => isset( $input['contents_builder'][$key]['desc2'] ) ? wp_kses_post( $input['contents_builder'][$key]['desc2'] ) : '',
            'button_label' => isset( $input['contents_builder'][$key]['button_label'] ) ? wp_kses_post( $input['contents_builder'][$key]['button_label'] ) : '',
            'button_url' => isset( $input['contents_builder'][$key]['button_url'] ) ? wp_kses_post( $input['contents_builder'][$key]['button_url'] ) : '',
            'button_target' => ! empty( $input['contents_builder'][$key]['button_target'] ) ? 1 : 0,
          );
          break;

        case 'content_carousel' :
          $contents_builder[] = array(
            'type' => $value['type'],
            'show_content' => ! empty( $input['contents_builder'][$key]['show_content'] ) ? 1 : 0,
            'headline' => isset( $input['contents_builder'][$key]['headline'] ) ? wp_kses_post( $input['contents_builder'][$key]['headline'] ) : '',
            'sub_title' => isset( $input['contents_builder'][$key]['sub_title'] ) ? wp_kses_post( $input['contents_builder'][$key]['sub_title'] ) : '',
            'desc' => isset( $input['contents_builder'][$key]['desc'] ) ? wp_kses_post( $input['contents_builder'][$key]['desc'] ) : '',
            'desc_mobile' => isset( $input['contents_builder'][$key]['desc_mobile'] ) ? wp_kses_post( $input['contents_builder'][$key]['desc_mobile'] ) : '',
            'button_label' => isset( $input['contents_builder'][$key]['button_label'] ) ? wp_kses_post( $input['contents_builder'][$key]['button_label'] ) : '',
            'button_url' => isset( $input['contents_builder'][$key]['button_url'] ) ? wp_kses_post( $input['contents_builder'][$key]['button_url'] ) : '',
            'button_target' => ! empty( $input['contents_builder'][$key]['button_target'] ) ? 1 : 0,
            'item_list' => isset( $input['contents_builder'][$key]['item_list'] ) ? $input['contents_builder'][$key]['item_list'] : '',
          );
          break;

        case 'two_column' :
          $contents_builder[] = array(
            'type' => $value['type'],
            'show_content' => ! empty( $input['contents_builder'][$key]['show_content'] ) ? 1 : 0,
            'headline' => isset( $input['contents_builder'][$key]['headline'] ) ? wp_kses_post( $input['contents_builder'][$key]['headline'] ) : '',
            'sub_title' => isset( $input['contents_builder'][$key]['sub_title'] ) ? wp_kses_post( $input['contents_builder'][$key]['sub_title'] ) : '',
            'desc' => isset( $input['contents_builder'][$key]['desc'] ) ? wp_kses_post( $input['contents_builder'][$key]['desc'] ) : '',
            'desc_mobile' => isset( $input['contents_builder'][$key]['desc_mobile'] ) ? wp_kses_post( $input['contents_builder'][$key]['desc_mobile'] ) : '',
            'button_label' => isset( $input['contents_builder'][$key]['button_label'] ) ? wp_kses_post( $input['contents_builder'][$key]['button_label'] ) : '',
            'button_url' => isset( $input['contents_builder'][$key]['button_url'] ) ? wp_kses_post( $input['contents_builder'][$key]['button_url'] ) : '',
            'button_target' => ! empty( $input['contents_builder'][$key]['button_target'] ) ? 1 : 0,
            'item_list' => isset( $input['contents_builder'][$key]['item_list'] ) ? $input['contents_builder'][$key]['item_list'] : '',
          );
          break;

        case 'three_column' :
          $contents_builder[] = array(
            'type' => $value['type'],
            'show_content' => ! empty( $input['contents_builder'][$key]['show_content'] ) ? 1 : 0,
            'headline' => isset( $input['contents_builder'][$key]['headline'] ) ? wp_kses_post( $input['contents_builder'][$key]['headline'] ) : '',
            'sub_title' => isset( $input['contents_builder'][$key]['sub_title'] ) ? wp_kses_post( $input['contents_builder'][$key]['sub_title'] ) : '',
            'desc' => isset( $input['contents_builder'][$key]['desc'] ) ? wp_kses_post( $input['contents_builder'][$key]['desc'] ) : '',
            'desc_mobile' => isset( $input['contents_builder'][$key]['desc_mobile'] ) ? wp_kses_post( $input['contents_builder'][$key]['desc_mobile'] ) : '',
            'button_label' => isset( $input['contents_builder'][$key]['button_label'] ) ? wp_kses_post( $input['contents_builder'][$key]['button_label'] ) : '',
            'button_url' => isset( $input['contents_builder'][$key]['button_url'] ) ? wp_kses_post( $input['contents_builder'][$key]['button_url'] ) : '',
            'button_target' => ! empty( $input['contents_builder'][$key]['button_target'] ) ? 1 : 0,
            'item_list' => isset( $input['contents_builder'][$key]['item_list'] ) ? $input['contents_builder'][$key]['item_list'] : '',
          );
          break;

        case 'blog_list' :
          $contents_builder[] = array(
            'type' => $value['type'],
            'show_content' => ! empty( $input['contents_builder'][$key]['show_content'] ) ? 1 : 0,
            'headline' => isset( $input['contents_builder'][$key]['headline'] ) ? wp_kses_post( $input['contents_builder'][$key]['headline'] ) : '',
            'sub_title' => isset( $input['contents_builder'][$key]['sub_title'] ) ? wp_kses_post( $input['contents_builder'][$key]['sub_title'] ) : '',
            'desc' => isset( $input['contents_builder'][$key]['desc'] ) ? wp_kses_post( $input['contents_builder'][$key]['desc'] ) : '',
            'desc_mobile' => isset( $input['contents_builder'][$key]['desc_mobile'] ) ? wp_kses_post( $input['contents_builder'][$key]['desc_mobile'] ) : '',
            'button_label' => isset( $input['contents_builder'][$key]['button_label'] ) ? wp_kses_post( $input['contents_builder'][$key]['button_label'] ) : '',
            'post_num' => isset( $input['contents_builder'][$key]['post_num'] ) ? wp_kses_post( $input['contents_builder'][$key]['post_num'] ) : '6',
            'post_num_sp' => isset( $input['contents_builder'][$key]['post_num_sp'] ) ? wp_kses_post( $input['contents_builder'][$key]['post_num_sp'] ) : '6',
            'show_category_list' => isset( $input['contents_builder'][$key]['show_category_list'] ) ? wp_kses_post( $input['contents_builder'][$key]['show_category_list'] ) : 'display',
            'post_type' => isset( $input['contents_builder'][$key]['post_type'] ) ? wp_kses_post( $input['contents_builder'][$key]['post_type'] ) : 'recent_post',
            'post_order_custom' => isset( $input['contents_builder'][$key]['post_order_custom'] ) ? wp_kses_post( $input['contents_builder'][$key]['post_order_custom'] ) : '',
            'category_id' => isset( $input['contents_builder'][$key]['category_id'] ) ? wp_kses_post( $input['contents_builder'][$key]['category_id'] ) : '',
            'post_order' => isset( $input['contents_builder'][$key]['post_order'] ) ? wp_kses_post( $input['contents_builder'][$key]['post_order'] ) : 'date',
          );
          break;

        case 'news_list' :
          $contents_builder[] = array(
            'type' => $value['type'],
            'show_content' => ! empty( $input['contents_builder'][$key]['show_content'] ) ? 1 : 0,
            'headline' => isset( $input['contents_builder'][$key]['headline'] ) ? wp_kses_post( $input['contents_builder'][$key]['headline'] ) : '',
            'sub_title' => isset( $input['contents_builder'][$key]['sub_title'] ) ? wp_kses_post( $input['contents_builder'][$key]['sub_title'] ) : '',
            'desc' => isset( $input['contents_builder'][$key]['desc'] ) ? wp_kses_post( $input['contents_builder'][$key]['desc'] ) : '',
            'desc_mobile' => isset( $input['contents_builder'][$key]['desc_mobile'] ) ? wp_kses_post( $input['contents_builder'][$key]['desc_mobile'] ) : '',
            'button_label' => isset( $input['contents_builder'][$key]['button_label'] ) ? wp_kses_post( $input['contents_builder'][$key]['button_label'] ) : '',
            'post_num' => isset( $input['contents_builder'][$key]['post_num'] ) ? wp_kses_post( $input['contents_builder'][$key]['post_num'] ) : '6',
            'post_num_sp' => isset( $input['contents_builder'][$key]['post_num_sp'] ) ? wp_kses_post( $input['contents_builder'][$key]['post_num_sp'] ) : '6',
            'post_type' => isset( $input['contents_builder'][$key]['post_type'] ) ? wp_kses_post( $input['contents_builder'][$key]['post_type'] ) : 'recent_post',
            'post_order' => isset( $input['contents_builder'][$key]['post_order'] ) ? wp_kses_post( $input['contents_builder'][$key]['post_order'] ) : 'date',
            'post_order_custom' => isset( $input['contents_builder'][$key]['post_order_custom'] ) ? wp_kses_post( $input['contents_builder'][$key]['post_order_custom'] ) : '',
            'category_id' => isset( $input['contents_builder'][$key]['category_id'] ) ? wp_kses_post( $input['contents_builder'][$key]['category_id'] ) : '',
          );
          break;

        case 'free_space' :
          $contents_builder[] = array(
            'type' => $value['type'],
            'show_content' => ! empty( $input['contents_builder'][$key]['show_content'] ) ? 1 : 0,
            'headline' => isset( $input['contents_builder'][$key]['headline'] ) ? wp_kses_post( $input['contents_builder'][$key]['headline'] ) : '',
            'sub_title' => isset( $input['contents_builder'][$key]['sub_title'] ) ? wp_kses_post( $input['contents_builder'][$key]['sub_title'] ) : '',
            'desc' => isset( $input['contents_builder'][$key]['desc'] ) ? wp_kses_post( $input['contents_builder'][$key]['desc'] ) : '',
            'desc_mobile' => isset( $input['contents_builder'][$key]['desc_mobile'] ) ? wp_kses_post( $input['contents_builder'][$key]['desc_mobile'] ) : '',
            'content_width' => isset( $input['contents_builder'][$key]['content_width'] ) ? wp_kses_post( $input['contents_builder'][$key]['content_width'] ) : 'type1',
            'free_space' => isset( $input['contents_builder'][$key]['free_space'] ) ? $input['contents_builder'][$key]['free_space'] : '',
          );
          break;

      }

    }
  };
  $input['contents_builder'] = $contents_builder;


  return $input;

};


/**
 * コンテンツビルダー用 コンテンツ設定　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
 */
// コンテンツビルダー
function admin_contents_builder_start( $key, $values = array() ){

  global $blog_label, $font_type_options, $button_type_options, $button_border_radius_options, $button_size_options, $button_animation_options, $post;
  $options = get_design_plus_option();
  $news_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-canon' );

  $title = '';
  switch( $values['type'] ?? '' ){

    case 'image_slider' :
      $title = __( 'Image slider', 'tcd-canon' );
      break;
    case 'design_content' :
      $title = __( 'Design content', 'tcd-canon' );
      break;
    case 'content_carousel' :
      $title = __('Content carousel', 'tcd-canon');
      break;
    case 'two_column' :
      $title = __('Two column content', 'tcd-canon');
      break;
    case 'three_column' :
      $title = __('Three column content', 'tcd-canon');
      break;
    case 'blog_list' :
      $title = sprintf(__('%s list', 'tcd-canon'), $blog_label);
      break;
    case 'news_list' :
      if($options['use_news']){
        $title = sprintf(__('%s list', 'tcd-canon'), $news_label);
      } else {
        $title = __('(N/A) ', 'tcd-canon') . sprintf(__('%s list', 'tcd-canon'), $news_label);
      }
      break;
    case 'free_space' :
      $title = __( 'Free space', 'tcd-canon' );
      break;

  }

?>
<div class="js-contents-builder-item admin-contents-builder__item">
 <div class="admin-contents-builder__item-headline">
  <span class="admin-contents-builder__item-headline__handle c-icon js-contents-builder-handle">&#xe93e;</span>
  <label class="admin-contents-builder__item-headline__status">
   <input class="js-contents-builder-status" name="dp_options[contents_builder][<?php echo esc_attr( $key ); ?>][show_content]" type="checkbox" value="1" <?php checked( $values['show_content'] ?? 1, 1 ); ?> style="display:none;">
  </label>
  <h4 class="admin-contents-builder__item-headline__label"><?php echo $title; ?></h4>
  <p class="admin-contents-builder__item-headline__info js-contents-builder-item-label-target"></p>
  <span class="admin-contents-builder__item-headline__delete c-icon js-contents-builder-delete" data-alert-msg="<?php _e( 'Are you sure you want to delete this content?', 'tcd-canon' ); ?>">&#xe93f;</span>
  <span class="admin-contents-builder__item-headline__arrow c-icon" style="margin-right:10px;">&#xe940;</span>
 </div>
 <div class="admin-contents-builder__item-content">
  <div class="admin-contents-builder__item-content__inner">
<?php

}

function admin_contents_builder_end(){

?>
   <ul class="button_list cf">
    <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-canon' ); ?>" /></li>
   </ul>
  </div>
 </div>
</div>
<?php
}


// 画像スライダー
function admin_contents_builder_image_slider( $key, $values ){

  $values = !empty( $values ) ? $values : array(
    'headline' => '',
    'sub_title' => '',
    'desc' => '',
    'desc_mobile' => '',
    'layout' => 'type1',
    'image_slider' => '',
    'button_label' => '',
    'button_url' => '',
    'button_target' => '',
  );
?>
   <input type="hidden" name="dp_options[contents_builder][<?php echo esc_attr( $key ); ?>][type]" value="image_slider">

   <div class="cb_image">
    <img src="<?php bloginfo('template_url'); ?>/admin/img/image/index/cb_image_slider2.jpg?1.1" width="" height="" />
   </div>

   <h4 class="theme_option_headline2"><?php _e('Basic setting', 'tcd-canon'); ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><span class="num">1</span><?php _e('Catchphrase', 'tcd-canon'); ?></span><input class="js-contents-builder-item-label full_width" type="text" name="dp_options[contents_builder][<?php echo $key; ?>][headline]" value="<?php echo esc_attr($values['headline']); ?>" /></li>
    <li class="cf space"><span class="label"><?php _e('Subtitle', 'tcd-canon'); ?></span><input class="full_width" type="text" name="dp_options[contents_builder][<?php echo $key; ?>][sub_title]" value="<?php echo esc_attr($values['sub_title']); ?>" /></li>
    <li class="cf"><span class="label"><span class="num">2</span><?php _e('Description', 'tcd-canon'); ?></span><textarea class="full_width" cols="50" rows="4" name="dp_options[contents_builder][<?php echo $key; ?>][desc]"><?php echo esc_textarea($values['desc']); ?></textarea></li>
    <li class="cf space"><span class="label"><?php _e('Description (mobile)', 'tcd-canon'); ?></span><textarea placeholder="<?php _e( 'Please indicate if you would like to display a short text for mobile sizes.', 'tcd-canon' ); ?>" class="full_width" cols="50" rows="4" name="dp_options[contents_builder][<?php echo $key; ?>][desc_mobile]"><?php if(isset($values['desc_mobile'])){ echo esc_textarea( $values['desc_mobile'] ); }; ?></textarea></li>
    <li class="cf">
     <span class="label">
      <span class="num">3</span><?php _e('Link button label', 'tcd-canon'); ?>
      <span class="recommend_desc space"><?php _e('Leave this field blank if you don\'t want to display button.', 'tcd-canon'); ?></span>
     </span>
     <input type="text" class="full_width" name="dp_options[contents_builder][<?php echo $key; ?>][button_label]" value="<?php echo esc_attr($values['button_label']); ?>" />
    </li>
    <li class="cf space">
     <span class="label"><?php _e('Button URL', 'tcd-canon'); ?></span>
     <div class="admin_link_option">
      <input class="full_width" type="text" name="dp_options[contents_builder][<?php echo $key; ?>][button_url]" placeholder="https://example.com/" value="<?php echo esc_attr( $values['button_url'] ); ?>">
      <input id="button_target_<?php echo $key; ?>" name="dp_options[contents_builder][<?php echo $key; ?>][button_target]" type="checkbox" value="1" <?php checked( $values['button_target'], 1 ); ?>>
      <label for="button_target_<?php echo $key; ?>">&#xe920;</label>
     </div>
    </li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Image slider', 'tcd-canon'); ?></h4>

   <div class="theme_option_message2">
    <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-canon'), '1000', '550'); ?><br>
    <?php _e('You can register multiple image by clicking images in media library.', 'tcd-canon'); ?><br>
    <?php _e('Please register more than 4 images if you want to display by layout TypeB.', 'tcd-canon'); ?></p>
   </div>

   <ul class="option_list">
    <li class="cf">
     <span class="label"><?php _e('Layout', 'tcd-canon');  ?></span>
     <div class="option_list_right_content item_list cf">
      <div class="item">
       <input class="tcd_admin_image_radio_button" id="image_slider_type1_<?php echo $key; ?>" type="radio" name="dp_options[contents_builder][<?php echo $key; ?>][layout]" value="type1"<?php if($values['layout'] == 'type1'){ echo ' checked="checked"'; }; ?>>
       <label for="image_slider_type1_<?php echo $key; ?>">
        <span class="image_wrap">
         <img src="<?php bloginfo('template_url'); ?>/admin/img/image/image_slider.jpg" alt="">
        </span>
        <span class="title_wrap">
         <span class="title"><?php _e('TypeA', 'tcd-canon');  ?></span>
        </span>
       </label>
      </div>
      <div class="item">
       <input class="tcd_admin_image_radio_button" id="image_slider_type2_<?php echo $key; ?>" type="radio" name="dp_options[contents_builder][<?php echo $key; ?>][layout]" value="type2"<?php if($values['layout'] == 'type2'){ echo ' checked="checked"'; }; ?>>
       <label for="image_slider_type2_<?php echo $key; ?>">
        <span class="image_wrap">
         <img src="<?php bloginfo('template_url'); ?>/admin/img/image/image_slider2.jpg" alt="">
        </span>
        <span class="title_wrap">
         <span class="title"><?php _e('TypeB', 'tcd-canon');  ?></span>
        </span>
       </label>
      </div>
     </div>
    </li>
    <li class="cf">
     <span class="label"><?php _e('Image slider', 'tcd-canon');  ?></span>
     <div class="multi-media-uploader">
      <ul>
       <?php
            $image_slider = $values['image_slider'];
            $image_ids = explode( ',', $image_slider );
            $display = 'none';
            if ( $image_slider && !empty( $image_ids ) ) {
              $display = 'inline-block';
              foreach ( $image_ids as $image_id ) {
                if ( $image_attributes = wp_get_attachment_image_src( $image_id, 'full' ) ) {
       ?>
       <li data-attechment-id="<?php echo $image_id; ?>">
        <div class="image"><img loading="lazy" src="<?php echo $image_attributes[0]; ?>" /></div>
        <span class="delete-img"></span>
       </li>
       <?php
               }
             }
           }
       ?>
      </ul>
      <a id="cb_image_slider_<?php echo $key; ?>" href="#" class="js-multi-media-upload-button button">
       <?php _e( 'Select Image', 'tcd-canon' ); ?>
      </a>
      <input type="hidden" class="attechments-ids image_slider<?php echo $key; ?>" name="dp_options[contents_builder][<?php echo $key; ?>][image_slider]" value="<?php echo esc_attr( implode( ',', $image_ids ) ); ?>" />
      <a href="#" class="js-multi-media-remove-button button" style="display:<?php echo $display; ?>;">
       <?php _e( 'Delete all images', 'tcd-canon' ); ?>
      </a>
     </div>
    </li>
   </ul>

<?php
}


// デザインコンテンツ
function admin_contents_builder_design_content( $key, $values ){

  $values = !empty( $values ) ? $values : array(
    'headline' => '',
    'sub_title' => '',
    'desc' => '',
    'desc_mobile' => '',
    'layout' => 'type1',
    'image_slider' => '',
    'catch' => '',
    'desc2' => '',
    'button_label' => '',
    'button_url' => '',
    'button_target' => '',
  );
?>
   <input type="hidden" name="dp_options[contents_builder][<?php echo esc_attr( $key ); ?>][type]" value="design_content">

   <div class="cb_image">
    <img src="<?php bloginfo('template_url'); ?>/admin/img/image/index/cb_design_content2.jpg" width="" height="" />
   </div>

   <h4 class="theme_option_headline2"><?php _e('Basic setting', 'tcd-canon'); ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><span class="num">1</span><?php _e('Catchphrase', 'tcd-canon'); ?></span><input class="js-contents-builder-item-label full_width" type="text" name="dp_options[contents_builder][<?php echo $key; ?>][headline]" value="<?php echo esc_attr($values['headline']); ?>" /></li>
    <li class="cf space"><span class="label"><?php _e('Subtitle', 'tcd-canon'); ?></span><input class="full_width" type="text" name="dp_options[contents_builder][<?php echo $key; ?>][sub_title]" value="<?php echo esc_attr($values['sub_title']); ?>" /></li>
    <li class="cf"><span class="label"><span class="num">2</span><?php _e('Description', 'tcd-canon'); ?></span><textarea class="full_width" cols="50" rows="4" name="dp_options[contents_builder][<?php echo $key; ?>][desc]"><?php echo esc_textarea($values['desc']); ?></textarea></li>
    <li class="cf space"><span class="label"><?php _e('Description (mobile)', 'tcd-canon'); ?></span><textarea placeholder="<?php _e( 'Please indicate if you would like to display a short text for mobile sizes.', 'tcd-canon' ); ?>" class="full_width" cols="50" rows="4" name="dp_options[contents_builder][<?php echo $key; ?>][desc_mobile]"><?php if(isset($values['desc_mobile'])){ echo esc_textarea( $values['desc_mobile'] ); }; ?></textarea></li>
    <li class="cf">
     <span class="label">
      <span class="num">3</span><?php _e('Link button label', 'tcd-canon'); ?>
      <span class="recommend_desc space"><?php _e('Leave this field blank if you don\'t want to display button.', 'tcd-canon'); ?></span>
     </span>
     <input type="text" class="full_width" name="dp_options[contents_builder][<?php echo $key; ?>][button_label]" value="<?php echo esc_attr($values['button_label']); ?>" />
    </li>
    <li class="cf space">
     <span class="label"><?php _e('Button URL', 'tcd-canon'); ?></span>
     <div class="admin_link_option">
      <input class="full_width" type="text" name="dp_options[contents_builder][<?php echo $key; ?>][button_url]" placeholder="https://example.com/" value="<?php echo esc_attr( $values['button_url'] ); ?>">
      <input id="button_target_<?php echo $key; ?>" name="dp_options[contents_builder][<?php echo $key; ?>][button_target]" type="checkbox" value="1" <?php checked( $values['button_target'], 1 ); ?>>
      <label for="button_target_<?php echo $key; ?>">&#xe920;</label>
     </div>
    </li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Main content', 'tcd-canon'); ?></h4>

   <div class="theme_option_message2">
    <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-canon'), '645', '600'); ?><br>
    <?php _e('You can register multiple image by clicking images in media library but all images to be registered must be the same size.', 'tcd-canon'); ?></p>
   </div>

   <ul class="option_list">
    <li class="cf">
     <span class="label"><?php _e('Image slider', 'tcd-canon');  ?></span>
     <div class="multi-media-uploader">
      <ul>
       <?php
            $image_slider = $values['image_slider'];
            $image_ids = explode( ',', $image_slider );
            $display = 'none';
            if ( $image_slider && !empty( $image_ids ) ) {
              $display = 'inline-block';
              foreach ( $image_ids as $image_id ) {
                if ( $image_attributes = wp_get_attachment_image_src( $image_id, 'full' ) ) {
       ?>
       <li data-attechment-id="<?php echo $image_id; ?>">
        <div class="image"><img loading="lazy" src="<?php echo $image_attributes[0]; ?>" /></div>
        <span class="delete-img"></span>
       </li>
       <?php
               }
             }
           }
       ?>
      </ul>
      <a id="cb_image_slider_<?php echo $key; ?>" href="#" class="js-multi-media-upload-button button">
       <?php _e( 'Select Image', 'tcd-canon' ); ?>
      </a>
      <input type="hidden" class="attechments-ids image_slider<?php echo $key; ?>" name="dp_options[contents_builder][<?php echo $key; ?>][image_slider]" value="<?php echo esc_attr( implode( ',', $image_ids ) ); ?>" />
      <a href="#" class="js-multi-media-remove-button button" style="display:<?php echo $display; ?>;">
       <?php _e( 'Delete all images', 'tcd-canon' ); ?>
      </a>
     </div>
    </li>
    <li class="cf">
     <span class="label"><?php _e('Position', 'tcd-canon');  ?></span>
     <div class="standard_radio_button">
      <input id="layout_type1<?php echo $key; ?>" type="radio" name="dp_options[contents_builder][<?php echo $key; ?>][layout]" value="type1" <?php checked( $values['layout'], 'type1' ); ?>>
      <label for="layout_type1<?php echo $key; ?>"><?php _e('Display on left side', 'tcd-canon'); ?></label>
      <input id="layout_type2<?php echo $key; ?>" type="radio" name="dp_options[contents_builder][<?php echo $key; ?>][layout]" value="type2" <?php checked( $values['layout'], 'type2' ); ?>>
      <label for="layout_type2<?php echo $key; ?>"><?php _e('Display on right side', 'tcd-canon'); ?></label>
     </div>
    </li>
    <li class="cf"><span class="label"><?php _e('Catchphrase', 'tcd-canon'); ?></span><textarea class="full_width" cols="50" rows="2" name="dp_options[contents_builder][<?php echo $key; ?>][catch]"><?php echo esc_textarea($values['catch']); ?></textarea></li>
    <li class="cf"><span class="label"><?php _e('Description', 'tcd-canon'); ?></span><textarea class="full_width" cols="50" rows="4" name="dp_options[contents_builder][<?php echo $key; ?>][desc2]"><?php echo esc_textarea($values['desc2']); ?></textarea></li>
   </ul>

<?php
}


// コンテンツカルーセル
function admin_contents_builder_content_carousel( $key, $values ){

  $values = !empty( $values ) ? $values : array(
    'headline' => '',
    'sub_title' => '',
    'desc' => '',
    'desc_mobile' => '',
    'button_label' => '',
    'button_url' => '',
    'button_target' => '',
    'item_list' => array(),
  );
?>
   <input type="hidden" name="dp_options[contents_builder][<?php echo esc_attr( $key ); ?>][type]" value="content_carousel">

   <div class="cb_image">
    <img src="<?php bloginfo('template_url'); ?>/admin/img/image/index/cb_content_carousel2.jpg" width="" height="" />
   </div>

   <h4 class="theme_option_headline2"><?php _e('Basic setting', 'tcd-canon'); ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><span class="num">1</span><?php _e('Catchphrase', 'tcd-canon'); ?></span><input class="js-contents-builder-item-label full_width" type="text" name="dp_options[contents_builder][<?php echo $key; ?>][headline]" value="<?php echo esc_attr($values['headline']); ?>" /></li>
    <li class="cf space"><span class="label"><?php _e('Subtitle', 'tcd-canon'); ?></span><input class="full_width" type="text" name="dp_options[contents_builder][<?php echo $key; ?>][sub_title]" value="<?php echo esc_attr($values['sub_title']); ?>" /></li>
    <li class="cf"><span class="label"><span class="num">2</span><?php _e('Description', 'tcd-canon'); ?></span><textarea class="full_width" cols="50" rows="4" name="dp_options[contents_builder][<?php echo $key; ?>][desc]"><?php echo esc_textarea($values['desc']); ?></textarea></li>
    <li class="cf space"><span class="label"><?php _e('Description (mobile)', 'tcd-canon'); ?></span><textarea placeholder="<?php _e( 'Please indicate if you would like to display a short text for mobile sizes.', 'tcd-canon' ); ?>" class="full_width" cols="50" rows="4" name="dp_options[contents_builder][<?php echo $key; ?>][desc_mobile]"><?php if(isset($values['desc_mobile'])){ echo esc_textarea( $values['desc_mobile'] ); }; ?></textarea></li>
    <li class="cf">
     <span class="label">
      <span class="num">3</span><?php _e('Link button label', 'tcd-canon'); ?>
      <span class="recommend_desc space"><?php _e('Leave this field blank if you don\'t want to display button.', 'tcd-canon'); ?></span>
     </span>
     <input type="text" class="full_width" name="dp_options[contents_builder][<?php echo $key; ?>][button_label]" value="<?php echo esc_attr($values['button_label']); ?>" />
    </li>
    <li class="cf space">
     <span class="label"><?php _e('Button URL', 'tcd-canon'); ?></span>
     <div class="admin_link_option">
      <input class="full_width" type="text" name="dp_options[contents_builder][<?php echo $key; ?>][button_url]" placeholder="https://example.com/" value="<?php echo esc_attr( $values['button_url'] ); ?>">
      <input id="button_target_<?php echo $key; ?>" name="dp_options[contents_builder][<?php echo $key; ?>][button_target]" type="checkbox" value="1" <?php checked( $values['button_target'], 1 ); ?>>
      <label for="button_target_<?php echo $key; ?>">&#xe920;</label>
     </div>
    </li>
   </ul>

   <?php // リピーターここから -------------------------- ?>
   <h4 class="theme_option_headline2"><?php _e('Carousel', 'tcd-canon');  ?></h4>
   <div class="theme_option_message2">
    <p><?php _e('Click add item button to start this option.<br />You can change order by dragging each headline of option field.', 'tcd-canon');  ?></p>
   </div>
   <div class="repeater-wrapper">
    <div class="repeater sortable" data-delete-confirm="<?php _e( 'Delete?', 'tcd-canon' ); ?>">
     <?php
          if ( $values['item_list'] && is_array( $values['item_list'] ) ) :
            foreach ( $values['item_list'] as $repeater_key => $repeater_value ) :
     ?>
     <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $repeater_key ); ?>">
      <h4 class="theme_option_subbox_headline"><?php _e( 'Content', 'tcd-canon' ); ?></h4>
      <div class="sub_box_content">

       <ul class="option_list">
        <li class="cf">
         <span class="label">
          <?php _e('Image', 'tcd-canon'); ?>
          <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-canon'), '300', '300'); ?></span>
         </span>
         <div class="image_box cf">
          <div class="cf cf_media_field hide-if-no-js image_<?php echo $key; ?>_<?php echo esc_attr( $repeater_key ); ?>">
           <input type="hidden" value="<?php if ( isset($repeater_value['image']) ) echo esc_attr( $repeater_value['image'] ); ?>" id="image_<?php echo $key; ?>_<?php echo esc_attr( $repeater_key ); ?>" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][image]" class="cf_media_id">
           <div class="preview_field"><?php if ( isset($repeater_value['image']) ) echo wp_get_attachment_image( $repeater_value['image'], 'full'); ?></div>
           <div class="button_area">
            <input type="button" value="<?php _e( 'Select Image', 'tcd-canon' ); ?>" class="cfmf-select-img button">
            <input type="button" value="<?php _e( 'Remove Image', 'tcd-canon' ); ?>" class="cfmf-delete-img button <?php if ( isset($repeater_value['image']) && !$repeater_value['image'] ) echo 'hidden'; ?>">
           </div>
          </div>
         </div>
        </li>
        <li class="cf"><span class="label"><?php _e('Catchphrase', 'tcd-canon'); ?></span><input class="repeater-label full_width" type="text" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][title]" value="<?php echo esc_attr($repeater_value['title']); ?>" /></li>
        <li class="cf"><span class="label"><?php _e('Subtitle', 'tcd-canon'); ?></span><input class="full_width" type="text" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][sub_title]" value="<?php echo esc_attr($repeater_value['sub_title']); ?>" /></li>
        <li class="cf">
         <span class="label"><?php _e('Link URL', 'tcd-canon'); ?></span>
         <div class="admin_link_option">
          <input type="text" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][url]" placeholder="https://example.com/" value="<?php esc_attr_e( $repeater_value['url'] ); ?>">
          <input id="content_carousel_item_list_target<?php echo esc_attr( $key ); ?>_<?php echo esc_attr( $repeater_key ); ?>" class="admin_link_option_target" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][target]" type="checkbox" value="1" <?php checked( $repeater_value['target'], 1 ); ?>>
          <label for="content_carousel_item_list_target<?php echo esc_attr( $key ); ?>_<?php echo esc_attr( $repeater_key ); ?>">&#xe920;</label>
         </div>
        </li>
       </ul>

       <ul class="button_list cf">
        <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-canon' ); ?></a></li>
        <li class="delete-row"><a class="button-delete-row button-ml red_button" href="#"><?php echo __( 'Delete item', 'tcd-canon' ); ?></a></li>
       </ul>
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->
     <?php
            endforeach;
          endif;

          $repeater_key = 'addindex';
          $repeater_value = array(
            'title' => '',
            'sub_title' => '',
            'image' => '',
            'target' => '',
            'url' => '',
          );
          ob_start();
     ?>
     <!-- repeater start -->
     <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $repeater_key ); ?>">
      <h4 class="theme_option_subbox_headline"><?php _e( 'New content', 'tcd-canon' ); ?></h4>
      <div class="sub_box_content">

       <ul class="option_list">
        <li class="cf">
         <span class="label">
          <?php _e('Image', 'tcd-canon'); ?>
          <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-canon'), '300', '300'); ?></span>
         </span>
         <div class="image_box cf">
          <div class="cf cf_media_field hide-if-no-js image_<?php echo $key; ?>_<?php echo esc_attr( $repeater_key ); ?>">
           <input type="hidden" value="<?php if ( isset($repeater_value['image']) ) echo esc_attr( $repeater_value['image'] ); ?>" id="image_<?php echo $key; ?>_<?php echo esc_attr( $repeater_key ); ?>" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][image]" class="cf_media_id">
           <div class="preview_field"><?php if ( isset($repeater_value['image']) ) echo wp_get_attachment_image( $repeater_value['image'], 'full'); ?></div>
           <div class="button_area">
            <input type="button" value="<?php _e( 'Select Image', 'tcd-canon' ); ?>" class="cfmf-select-img button">
            <input type="button" value="<?php _e( 'Remove Image', 'tcd-canon' ); ?>" class="cfmf-delete-img button <?php if ( isset($repeater_value['image']) && !$repeater_value['image'] ) echo 'hidden'; ?>">
           </div>
          </div>
         </div>
        </li>
        <li class="cf"><span class="label"><?php _e('Catchphrase', 'tcd-canon'); ?></span><input class="repeater-label full_width" type="text" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][title]" value="<?php echo esc_attr($repeater_value['title']); ?>" /></li>
        <li class="cf"><span class="label"><?php _e('Subtitle', 'tcd-canon'); ?></span><input class="full_width" type="text" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][sub_title]" value="<?php echo esc_attr($repeater_value['sub_title']); ?>" /></li>
        <li class="cf">
         <span class="label"><?php _e('Link URL', 'tcd-canon'); ?></span>
         <div class="admin_link_option">
          <input type="text" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][url]" placeholder="https://example.com/" value="<?php esc_attr_e( $repeater_value['url'] ); ?>">
          <input id="content_carousel_item_list_target<?php echo esc_attr( $key ); ?>_<?php echo esc_attr( $repeater_key ); ?>" class="admin_link_option_target" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][target]" type="checkbox" value="1" <?php checked( $repeater_value['target'], 1 ); ?>>
          <label for="content_carousel_item_list_target<?php echo esc_attr( $key ); ?>_<?php echo esc_attr( $repeater_key ); ?>">&#xe920;</label>
         </div>
        </li>
       </ul>

       <ul class="button_list cf">
        <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-canon' ); ?></a></li>
        <li class="delete-row"><a class="button-delete-row button-ml red_button" href="#"><?php echo __( 'Delete item', 'tcd-canon' ); ?></a></li>
       </ul>
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->
     <!-- repeater end -->
     <?php
          $repeater_content_clone = ob_get_clean();
     ?>
    </div><!-- END .repeater -->
    <a href="#" class="button button-secondary button-add-row" data-clone="<?php echo esc_attr( $repeater_content_clone ); ?>"><?php _e( 'Add item', 'tcd-canon' ); ?></a>
   </div><!-- END .repeater-wrapper -->
   <?php // リピーターここまで -------------------------- ?>


<?php
}


// 2カラム
function admin_contents_builder_two_column( $key, $values ){

  $values = !empty( $values ) ? $values : array(
    'headline' => '',
    'sub_title' => '',
    'desc' => '',
    'desc_mobile' => '',
    'button_label' => '',
    'button_url' => '',
    'button_target' => '',
    'item_list' => array(),
  );
?>
   <input type="hidden" name="dp_options[contents_builder][<?php echo esc_attr( $key ); ?>][type]" value="two_column">

   <div class="cb_image">
    <img src="<?php bloginfo('template_url'); ?>/admin/img/image/index/cb_two_column2.jpg" width="" height="" />
   </div>

   <h4 class="theme_option_headline2"><?php _e('Basic setting', 'tcd-canon'); ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><span class="num">1</span><?php _e('Catchphrase', 'tcd-canon'); ?></span><input class="js-contents-builder-item-label full_width" type="text" name="dp_options[contents_builder][<?php echo $key; ?>][headline]" value="<?php echo esc_attr($values['headline']); ?>" /></li>
    <li class="cf space"><span class="label"><?php _e('Subtitle', 'tcd-canon'); ?></span><input class="full_width" type="text" name="dp_options[contents_builder][<?php echo $key; ?>][sub_title]" value="<?php echo esc_attr($values['sub_title']); ?>" /></li>
    <li class="cf"><span class="label"><span class="num">2</span><?php _e('Description', 'tcd-canon'); ?></span><textarea class="full_width" cols="50" rows="4" name="dp_options[contents_builder][<?php echo $key; ?>][desc]"><?php echo esc_textarea($values['desc']); ?></textarea></li>
    <li class="cf space"><span class="label"><?php _e('Description (mobile)', 'tcd-canon'); ?></span><textarea placeholder="<?php _e( 'Please indicate if you would like to display a short text for mobile sizes.', 'tcd-canon' ); ?>" class="full_width" cols="50" rows="4" name="dp_options[contents_builder][<?php echo $key; ?>][desc_mobile]"><?php if(isset($values['desc_mobile'])){ echo esc_textarea( $values['desc_mobile'] ); }; ?></textarea></li>
    <li class="cf">
     <span class="label">
      <span class="num">3</span><?php _e('Link button label', 'tcd-canon'); ?>
      <span class="recommend_desc space"><?php _e('Leave this field blank if you don\'t want to display button.', 'tcd-canon'); ?></span>
     </span>
     <input type="text" class="full_width" name="dp_options[contents_builder][<?php echo $key; ?>][button_label]" value="<?php echo esc_attr($values['button_label']); ?>" />
    </li>
    <li class="cf space">
     <span class="label"><?php _e('Button URL', 'tcd-canon'); ?></span>
     <div class="admin_link_option">
      <input class="full_width" type="text" name="dp_options[contents_builder][<?php echo $key; ?>][button_url]" placeholder="https://example.com/" value="<?php echo esc_attr( $values['button_url'] ); ?>">
      <input id="button_target_<?php echo $key; ?>" name="dp_options[contents_builder][<?php echo $key; ?>][button_target]" type="checkbox" value="1" <?php checked( $values['button_target'], 1 ); ?>>
      <label for="button_target_<?php echo $key; ?>">&#xe920;</label>
     </div>
    </li>
   </ul>

   <?php // リピーターここから -------------------------- ?>
   <h4 class="theme_option_headline2"><?php _e('Content list', 'tcd-canon');  ?></h4>
   <div class="theme_option_message2">
    <p><?php _e('Click add item button to start this option.<br />You can change order by dragging each headline of option field.', 'tcd-canon');  ?></p>
   </div>
   <div class="repeater-wrapper">
    <div class="repeater sortable" data-delete-confirm="<?php _e( 'Delete?', 'tcd-canon' ); ?>">
     <?php
          if ( $values['item_list'] && is_array( $values['item_list'] ) ) :
            foreach ( $values['item_list'] as $repeater_key => $repeater_value ) :
     ?>
     <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $repeater_key ); ?>">
      <h4 class="theme_option_subbox_headline"><?php _e( 'Content', 'tcd-canon' ); ?></h4>
      <div class="sub_box_content">

       <ul class="option_list">
        <li class="cf">
         <span class="label">
          <?php _e('Image', 'tcd-canon'); ?>
          <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-canon'), '500', '350'); ?></span>
         </span>
         <div class="image_box cf">
          <div class="cf cf_media_field hide-if-no-js image_<?php echo $key; ?>_<?php echo esc_attr( $repeater_key ); ?>">
           <input type="hidden" value="<?php if ( isset($repeater_value['image']) ) echo esc_attr( $repeater_value['image'] ); ?>" id="image_<?php echo $key; ?>_<?php echo esc_attr( $repeater_key ); ?>" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][image]" class="cf_media_id">
           <div class="preview_field"><?php if ( isset($repeater_value['image']) ) echo wp_get_attachment_image( $repeater_value['image'], 'full'); ?></div>
           <div class="button_area">
            <input type="button" value="<?php _e( 'Select Image', 'tcd-canon' ); ?>" class="cfmf-select-img button">
            <input type="button" value="<?php _e( 'Remove Image', 'tcd-canon' ); ?>" class="cfmf-delete-img button <?php if ( isset($repeater_value['image']) && !$repeater_value['image'] ) echo 'hidden'; ?>">
           </div>
          </div>
         </div>
        </li>
        <li class="cf"><span class="label"><?php _e('Headline', 'tcd-canon'); ?></span><input class="repeater-label full_width" type="text" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][headline]" value="<?php echo esc_attr($repeater_value['headline']); ?>" /></li>
        <li class="cf"><span class="label"><?php _e('Subtitle', 'tcd-canon'); ?></span><input class="full_width" type="text" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][sub_title]" value="<?php echo esc_attr($repeater_value['sub_title']); ?>" /></li>
        <li class="cf"><span class="label"><?php _e('Description', 'tcd-canon'); ?></span><textarea class="full_width" cols="50" rows="4" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][desc]"><?php echo esc_textarea($repeater_value['desc']); ?></textarea></li>
        <li class="cf">
         <span class="label"><?php _e('Link URL', 'tcd-canon'); ?></span>
         <div class="admin_link_option">
          <input type="text" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][url]" placeholder="https://example.com/" value="<?php esc_attr_e( $repeater_value['url'] ); ?>">
          <input id="two_column_item_list_target<?php echo esc_attr( $key ); ?>_<?php echo esc_attr( $repeater_key ); ?>" class="admin_link_option_target" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][target]" type="checkbox" value="1" <?php checked( $repeater_value['target'], 1 ); ?>>
          <label for="two_column_item_list_target<?php echo esc_attr( $key ); ?>_<?php echo esc_attr( $repeater_key ); ?>">&#xe920;</label>
         </div>
        </li>
       </ul>

       <ul class="button_list cf">
        <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-canon' ); ?></a></li>
        <li class="delete-row"><a class="button-delete-row button-ml red_button" href="#"><?php echo __( 'Delete item', 'tcd-canon' ); ?></a></li>
       </ul>
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->
     <?php
            endforeach;
          endif;

          $repeater_key = 'addindex';
          $repeater_value = array(
            'headline' => '',
            'sub_title' => '',
            'desc' => '',
            'image' => '',
            'url' => '',
            'target' => '',
          );
          ob_start();
     ?>
     <!-- repeater start -->
     <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $repeater_key ); ?>">
      <h4 class="theme_option_subbox_headline"><?php _e( 'New content', 'tcd-canon' ); ?></h4>
      <div class="sub_box_content">

       <ul class="option_list">
        <li class="cf">
         <span class="label">
          <?php _e('Image', 'tcd-canon'); ?>
          <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-canon'), '500', '350'); ?></span>
         </span>
         <div class="image_box cf">
          <div class="cf cf_media_field hide-if-no-js image_<?php echo $key; ?>_<?php echo esc_attr( $repeater_key ); ?>">
           <input type="hidden" value="<?php if ( isset($repeater_value['image']) ) echo esc_attr( $repeater_value['image'] ); ?>" id="image_<?php echo $key; ?>_<?php echo esc_attr( $repeater_key ); ?>" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][image]" class="cf_media_id">
           <div class="preview_field"><?php if ( isset($repeater_value['image']) ) echo wp_get_attachment_image( $repeater_value['image'], 'full'); ?></div>
           <div class="button_area">
            <input type="button" value="<?php _e( 'Select Image', 'tcd-canon' ); ?>" class="cfmf-select-img button">
            <input type="button" value="<?php _e( 'Remove Image', 'tcd-canon' ); ?>" class="cfmf-delete-img button <?php if ( isset($repeater_value['image']) && !$repeater_value['image'] ) echo 'hidden'; ?>">
           </div>
          </div>
         </div>
        </li>
        <li class="cf"><span class="label"><?php _e('Headline', 'tcd-canon'); ?></span><input class="repeater-label full_width" type="text" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][headline]" value="<?php echo esc_attr($repeater_value['headline']); ?>" /></li>
        <li class="cf"><span class="label"><?php _e('Subtitle', 'tcd-canon'); ?></span><input class="full_width" type="text" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][sub_title]" value="<?php echo esc_attr($repeater_value['sub_title']); ?>" /></li>
        <li class="cf"><span class="label"><?php _e('Description', 'tcd-canon'); ?></span><textarea class="full_width" cols="50" rows="4" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][desc]"><?php echo esc_textarea($repeater_value['desc']); ?></textarea></li>
        <li class="cf">
         <span class="label"><?php _e('Link URL', 'tcd-canon'); ?></span>
         <div class="admin_link_option">
          <input type="text" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][url]" placeholder="https://example.com/" value="<?php esc_attr_e( $repeater_value['url'] ); ?>">
          <input id="two_column_item_list_target<?php echo esc_attr( $key ); ?>_<?php echo esc_attr( $repeater_key ); ?>" class="admin_link_option_target" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][target]" type="checkbox" value="1" <?php checked( $repeater_value['target'], 1 ); ?>>
          <label for="two_column_item_list_target<?php echo esc_attr( $key ); ?>_<?php echo esc_attr( $repeater_key ); ?>">&#xe920;</label>
         </div>
        </li>
       </ul>

       <ul class="button_list cf">
        <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-canon' ); ?></a></li>
        <li class="delete-row"><a class="button-delete-row button-ml red_button" href="#"><?php echo __( 'Delete item', 'tcd-canon' ); ?></a></li>
       </ul>
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->
     <!-- repeater end -->
     <?php
          $repeater_content_clone = ob_get_clean();
     ?>
    </div><!-- END .repeater -->
    <a href="#" class="button button-secondary button-add-row" data-clone="<?php echo esc_attr( $repeater_content_clone ); ?>"><?php _e( 'Add item', 'tcd-canon' ); ?></a>
   </div><!-- END .repeater-wrapper -->
   <?php // リピーターここまで -------------------------- ?>


<?php
}


// 3カラム
function admin_contents_builder_three_column( $key, $values ){

  $values = !empty( $values ) ? $values : array(
    'headline' => '',
    'sub_title' => '',
    'desc' => '',
    'desc_mobile' => '',
    'button_label' => '',
    'button_url' => '',
    'button_target' => '',
    'item_list' => array(),
  );
?>
   <input type="hidden" name="dp_options[contents_builder][<?php echo esc_attr( $key ); ?>][type]" value="three_column">

   <div class="cb_image">
    <img src="<?php bloginfo('template_url'); ?>/admin/img/image/index/cb_three_column2.jpg" width="" height="" />
   </div>

   <h4 class="theme_option_headline2"><?php _e('Basic setting', 'tcd-canon'); ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><span class="num">1</span><?php _e('Catchphrase', 'tcd-canon'); ?></span><input class="js-contents-builder-item-label full_width" type="text" name="dp_options[contents_builder][<?php echo $key; ?>][headline]" value="<?php echo esc_attr($values['headline']); ?>" /></li>
    <li class="cf space"><span class="label"><?php _e('Subtitle', 'tcd-canon'); ?></span><input class="full_width" type="text" name="dp_options[contents_builder][<?php echo $key; ?>][sub_title]" value="<?php echo esc_attr($values['sub_title']); ?>" /></li>
    <li class="cf"><span class="label"><span class="num">2</span><?php _e('Description', 'tcd-canon'); ?></span><textarea class="full_width" cols="50" rows="4" name="dp_options[contents_builder][<?php echo $key; ?>][desc]"><?php echo esc_textarea($values['desc']); ?></textarea></li>
    <li class="cf space"><span class="label"><?php _e('Description (mobile)', 'tcd-canon'); ?></span><textarea placeholder="<?php _e( 'Please indicate if you would like to display a short text for mobile sizes.', 'tcd-canon' ); ?>" class="full_width" cols="50" rows="4" name="dp_options[contents_builder][<?php echo $key; ?>][desc_mobile]"><?php if(isset($values['desc_mobile'])){ echo esc_textarea( $values['desc_mobile'] ); }; ?></textarea></li>
    <li class="cf">
     <span class="label">
      <span class="num">3</span><?php _e('Link button label', 'tcd-canon'); ?>
      <span class="recommend_desc space"><?php _e('Leave this field blank if you don\'t want to display button.', 'tcd-canon'); ?></span>
     </span>
     <input type="text" class="full_width" name="dp_options[contents_builder][<?php echo $key; ?>][button_label]" value="<?php echo esc_attr($values['button_label']); ?>" />
    </li>
    <li class="cf space">
     <span class="label"><?php _e('Button URL', 'tcd-canon'); ?></span>
     <div class="admin_link_option">
      <input class="full_width" type="text" name="dp_options[contents_builder][<?php echo $key; ?>][button_url]" placeholder="https://example.com/" value="<?php echo esc_attr( $values['button_url'] ); ?>">
      <input id="button_target_<?php echo $key; ?>" name="dp_options[contents_builder][<?php echo $key; ?>][button_target]" type="checkbox" value="1" <?php checked( $values['button_target'], 1 ); ?>>
      <label for="button_target_<?php echo $key; ?>">&#xe920;</label>
     </div>
    </li>
   </ul>

   <?php // リピーターここから -------------------------- ?>
   <h4 class="theme_option_headline2"><?php _e('Content list', 'tcd-canon');  ?></h4>
   <div class="theme_option_message2">
    <p><?php _e('Click add item button to start this option.<br />You can change order by dragging each headline of option field.', 'tcd-canon');  ?></p>
   </div>
   <div class="repeater-wrapper">
    <div class="repeater sortable" data-delete-confirm="<?php _e( 'Delete?', 'tcd-canon' ); ?>">
     <?php
          if ( $values['item_list'] && is_array( $values['item_list'] ) ) :
            foreach ( $values['item_list'] as $repeater_key => $repeater_value ) :
     ?>
     <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $repeater_key ); ?>">
      <h4 class="theme_option_subbox_headline"><?php _e( 'Content', 'tcd-canon' ); ?></h4>
      <div class="sub_box_content">

       <ul class="option_list">
        <li class="cf">
         <span class="label">
          <?php _e('Image', 'tcd-canon'); ?>
          <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-canon'), '330', '520'); ?></span>
         </span>
         <div class="image_box cf">
          <div class="cf cf_media_field hide-if-no-js image_<?php echo $key; ?>_<?php echo esc_attr( $repeater_key ); ?>">
           <input type="hidden" value="<?php if ( isset($repeater_value['image']) ) echo esc_attr( $repeater_value['image'] ); ?>" id="image_<?php echo $key; ?>_<?php echo esc_attr( $repeater_key ); ?>" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][image]" class="cf_media_id">
           <div class="preview_field"><?php if ( isset($repeater_value['image']) ) echo wp_get_attachment_image( $repeater_value['image'], 'full'); ?></div>
           <div class="button_area">
            <input type="button" value="<?php _e( 'Select Image', 'tcd-canon' ); ?>" class="cfmf-select-img button">
            <input type="button" value="<?php _e( 'Remove Image', 'tcd-canon' ); ?>" class="cfmf-delete-img button <?php if ( isset($repeater_value['image']) && !$repeater_value['image'] ) echo 'hidden'; ?>">
           </div>
          </div>
         </div>
        </li>
        <li class="cf"><span class="label"><?php _e('Catchphrase', 'tcd-canon'); ?></span><input class="repeater-label full_width" type="text" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][title]" value="<?php echo esc_attr($repeater_value['title']); ?>" /></li>
        <li class="cf">
         <span class="label"><?php _e('Link URL', 'tcd-canon'); ?></span>
         <div class="admin_link_option">
          <input type="text" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][url]" placeholder="https://example.com/" value="<?php esc_attr_e( $repeater_value['url'] ); ?>">
          <input id="three_column_item_list_target<?php echo esc_attr( $key ); ?>_<?php echo esc_attr( $repeater_key ); ?>" class="admin_link_option_target" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][target]" type="checkbox" value="1" <?php checked( $repeater_value['target'], 1 ); ?>>
          <label for="three_column_item_list_target<?php echo esc_attr( $key ); ?>_<?php echo esc_attr( $repeater_key ); ?>">&#xe920;</label>
         </div>
        </li>
       </ul>

       <ul class="button_list cf">
        <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-canon' ); ?></a></li>
        <li class="delete-row"><a class="button-delete-row button-ml red_button" href="#"><?php echo __( 'Delete item', 'tcd-canon' ); ?></a></li>
       </ul>
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->
     <?php
            endforeach;
          endif;

          $repeater_key = 'addindex';
          $repeater_value = array(
            'title' => '',
            'image' => '',
            'url' => '',
            'target' => '',
          );
          ob_start();
     ?>
     <!-- repeater start -->
     <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $repeater_key ); ?>">
      <h4 class="theme_option_subbox_headline"><?php _e( 'New content', 'tcd-canon' ); ?></h4>
      <div class="sub_box_content">

       <ul class="option_list">
        <li class="cf">
         <span class="label">
          <?php _e('Image', 'tcd-canon'); ?>
          <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-canon'), '330', '520'); ?></span>
         </span>
         <div class="image_box cf">
          <div class="cf cf_media_field hide-if-no-js image_<?php echo $key; ?>_<?php echo esc_attr( $repeater_key ); ?>">
           <input type="hidden" value="<?php if ( isset($repeater_value['image']) ) echo esc_attr( $repeater_value['image'] ); ?>" id="image_<?php echo $key; ?>_<?php echo esc_attr( $repeater_key ); ?>" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][image]" class="cf_media_id">
           <div class="preview_field"><?php if ( isset($repeater_value['image']) ) echo wp_get_attachment_image( $repeater_value['image'], 'full'); ?></div>
           <div class="button_area">
            <input type="button" value="<?php _e( 'Select Image', 'tcd-canon' ); ?>" class="cfmf-select-img button">
            <input type="button" value="<?php _e( 'Remove Image', 'tcd-canon' ); ?>" class="cfmf-delete-img button <?php if ( isset($repeater_value['image']) && !$repeater_value['image'] ) echo 'hidden'; ?>">
           </div>
          </div>
         </div>
        </li>
        <li class="cf"><span class="label"><?php _e('Catchphrase', 'tcd-canon'); ?></span><input class="repeater-label full_width" type="text" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][title]" value="<?php echo esc_attr($repeater_value['title']); ?>" /></li>
        <li class="cf">
         <span class="label"><?php _e('Link URL', 'tcd-canon'); ?></span>
         <div class="admin_link_option">
          <input type="text" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][url]" placeholder="https://example.com/" value="<?php esc_attr_e( $repeater_value['url'] ); ?>">
          <input id="three_column_item_list_target<?php echo esc_attr( $key ); ?>_<?php echo esc_attr( $repeater_key ); ?>" class="admin_link_option_target" name="dp_options[contents_builder][<?php echo $key; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][target]" type="checkbox" value="1" <?php checked( $repeater_value['target'], 1 ); ?>>
          <label for="three_column_item_list_target<?php echo esc_attr( $key ); ?>_<?php echo esc_attr( $repeater_key ); ?>">&#xe920;</label>
         </div>
        </li>
       </ul>

       <ul class="button_list cf">
        <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-canon' ); ?></a></li>
        <li class="delete-row"><a class="button-delete-row button-ml red_button" href="#"><?php echo __( 'Delete item', 'tcd-canon' ); ?></a></li>
       </ul>
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->
     <!-- repeater end -->
     <?php
          $repeater_content_clone = ob_get_clean();
     ?>
    </div><!-- END .repeater -->
    <a href="#" class="button button-secondary button-add-row" data-clone="<?php echo esc_attr( $repeater_content_clone ); ?>"><?php _e( 'Add item', 'tcd-canon' ); ?></a>
   </div><!-- END .repeater-wrapper -->
   <?php // リピーターここまで -------------------------- ?>


<?php
}


// ブログ一覧
function admin_contents_builder_blog_list( $key, $values ){

  global $blog_label;
  $options = get_design_plus_option();
  $news_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-canon' );

  $values = !empty( $values ) ? $values : array(
    'headline' => '',
    'sub_title' => '',
    'desc' => '',
    'desc_mobile' => '',
    'button_label' => __( 'Blog', 'tcd-canon' ),
    'post_num' => '6',
    'post_num_sp' => '6',
    'show_category_list' => 'display',
    'post_type' => 'all_post',
    'post_order_custom' => '',
    'category_id' => '',
    'post_order' => 'date',
  );
  if(!isset($values['post_type'])){ $values['post_type'] = 'all_post'; };
  if(!isset($values['post_order_custom'])){ $values['post_order_custom'] = ''; };
  if(!isset($values['post_order'])){ $values['post_order'] = 'date'; };

?>
   <input type="hidden" name="dp_options[contents_builder][<?php echo esc_attr( $key ); ?>][type]" value="blog_list">

   <div class="cb_image">
    <img src="<?php bloginfo('template_url'); ?>/admin/img/image/index/cb_blog_list2.jpg" width="" height="" />
   </div>

   <div class="theme_option_message2">
    <p><?php _e('Display <a href="./edit.php?post_type=post" target="_blank">post article</a> by carousel.', 'tcd-canon'); ?></p>
   </div>


   <h4 class="theme_option_headline2"><?php _e('Basic settings', 'tcd-canon');  ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><span class="num">1</span><?php _e('Catchphrase', 'tcd-canon'); ?></span><input class="js-contents-builder-item-label full_width" type="text" name="dp_options[contents_builder][<?php echo $key; ?>][headline]" value="<?php echo esc_attr($values['headline']); ?>" /></li>
    <li class="cf space"><span class="label"><?php _e('Subtitle', 'tcd-canon'); ?></span><input class="full_width" type="text" name="dp_options[contents_builder][<?php echo $key; ?>][sub_title]" value="<?php echo esc_attr($values['sub_title']); ?>" /></li>
    <li class="cf"><span class="label"><span class="num">2</span><?php _e('Description', 'tcd-canon'); ?></span><textarea class="full_width" cols="50" rows="4" name="dp_options[contents_builder][<?php echo $key; ?>][desc]"><?php echo esc_textarea($values['desc']); ?></textarea></li>
    <li class="cf space"><span class="label"><?php _e('Description (mobile)', 'tcd-canon'); ?></span><textarea placeholder="<?php _e( 'Please indicate if you would like to display a short text for mobile sizes.', 'tcd-canon' ); ?>" class="full_width" cols="50" rows="4" name="dp_options[contents_builder][<?php echo $key; ?>][desc_mobile]"><?php if(isset($values['desc_mobile'])){ echo esc_textarea( $values['desc_mobile'] ); }; ?></textarea></li>
    <li class="cf">
     <span class="label">
      <span class="num">3</span><?php _e('Link button label', 'tcd-canon'); ?>
      <span class="recommend_desc space"><?php _e('Leave this field blank if you don\'t want to display button.', 'tcd-canon'); ?></span>
     </span>
     <input type="text" class="full_width" name="dp_options[contents_builder][<?php echo $key; ?>][button_label]" value="<?php echo esc_attr($values['button_label']); ?>" />
    </li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Post list', 'tcd-canon');  ?></h4>
   <ul class="option_list">
    <li class="cf">
     <span class="label"><?php _e('Category list', 'tcd-canon');  ?></span>
     <div class="standard_radio_button">
      <input id="show_category_list_type1_<?php echo $key; ?>" class="show_category_list" type="radio" name="dp_options[contents_builder][<?php echo $key; ?>][show_category_list]" value="display" <?php checked( $values['show_category_list'], 'display' ); ?>>
      <label for="show_category_list_type1_<?php echo $key; ?>"><?php _e('Display', 'tcd-canon'); ?></label>
      <input id="show_category_list_type2_<?php echo $key; ?>" class="show_category_list" type="radio" name="dp_options[contents_builder][<?php echo $key; ?>][show_category_list]" value="hide" <?php checked( $values['show_category_list'], 'hide' ); ?>>
      <label for="show_category_list_type2_<?php echo $key; ?>"><?php _e('Hide', 'tcd-canon'); ?></label>
     </div>
    </li>
    <li class="cf show_category_list_hide_option"<?php if($values['show_category_list'] == 'display'){ echo ' style="display:none"'; }; ?>>
     <span class="label"><?php _e('Post type', 'tcd-canon');  ?></span>
     <select class="post_list_type" name="dp_options[contents_builder][<?php echo $key; ?>][post_type]">
      <option style="padding-right: 10px;" value="all_post" <?php selected( $values['post_type'], 'all_post' ); ?>><?php _e('All post', 'tcd-canon'); ?></option>
      <option style="padding-right: 10px;" value="category_post" <?php selected( $values['post_type'], 'category_post' ); ?>><?php _e('Category post', 'tcd-canon'); ?></option>
      <option style="padding-right: 10px;" value="recommend_post" <?php selected( $values['post_type'], 'recommend_post' ); ?>><?php _e('Recommend post', 'tcd-canon'); ?>1</option>
      <option style="padding-right: 10px;" value="recommend_post2" <?php selected( $values['post_type'], 'recommend_post2' ); ?>><?php _e('Recommend post', 'tcd-canon'); ?>2</option>
      <option style="padding-right: 10px;" value="recommend_post3" <?php selected( $values['post_type'], 'recommend_post3' ); ?>><?php _e('Recommend post', 'tcd-canon'); ?>3</option>
      <option style="padding-right: 10px;" value="custom" <?php selected( $values['post_type'], 'custom' ); ?>><?php _e('Custom', 'tcd-canon'); ?></option>
     </select>
    </li>
    <li class="cf post_list_type_category_option show_category_list_hide_option"<?php if(!($values['show_category_list'] == 'hide' && $values['post_type'] == 'category_post')){ echo ' style="display:none"'; }; ?>>
     <span class="label"><?php _e('Category', 'tcd-canon'); ?></span>
     <?php
          $category_list = get_terms( 'category', array( 'orderby' => 'order', 'hide_empty' => true ) );
          if ( $category_list && ! is_wp_error( $category_list ) ) {
            $selected_value = isset($values['category_id']) ?  $values['category_id'] : '';
            wp_dropdown_categories( array(
             'taxonomy' => 'category',
             'class' => 'category',
             'hierarchical' => true,
             'id' => '',
             'name' => 'dp_options[contents_builder][' . $key . '][category_id]',
             'selected' => $selected_value,
             'value_field' => 'term_id'
            ) );
          } else {
     ?>
     <p><?php _e('No category is registered', 'tcd-canon');  ?></p>
     <?php }; ?>
    </li>
    <li class="cf post_list_type_normal_option show_category_list_display_option"<?php if($values['show_category_list'] == 'hide' && $values['post_type'] == 'custom'){ echo ' style="display:none"'; }; ?>>
     <span class="label"><?php _e('Number of post to display', 'tcd-canon'); ?></span>
     <div class="display_post_num_option">
      <label for="cb_post_list_post_num_<?php echo $key; ?>"><input type="number" id="cb_post_list_post_num_<?php echo $key; ?>" name="dp_options[contents_builder][<?php echo $key; ?>][post_num]" value="<?php echo esc_attr($values['post_num']); ?>"><span class="icon icon_pc"></span></label>
      <label for="cb_post_list_post_num_sp_<?php echo $key; ?>"><input type="number" id="cb_post_list_post_num_sp_<?php echo $key; ?>" name="dp_options[contents_builder][<?php echo $key; ?>][post_num_sp]" value="<?php echo esc_attr($values['post_num_sp']); ?>"><span class="icon icon_sp"></span></label>
     </div>
    </li>
    <li class="cf post_list_type_normal_option">
     <span class="label"><?php _e('Post order', 'tcd-canon');  ?></span>
     <div class="standard_radio_button">
      <input id="carousel_news_order_date_<?php echo $key; ?>" type="radio" name="dp_options[contents_builder][<?php echo $key; ?>][post_order]" value="date" <?php checked( $values['post_order'], 'date' ); ?>>
      <label for="carousel_news_order_date_<?php echo $key; ?>"><?php _e('Date', 'tcd-canon'); ?></label>
      <input id="carousel_news_order_rand_<?php echo $key; ?>" type="radio" name="dp_options[contents_builder][<?php echo $key; ?>][post_order]" value="rand" <?php checked( $values['post_order'], 'rand' ); ?>>
      <label for="carousel_news_order_rand_<?php echo $key; ?>"><?php _e('Random', 'tcd-canon'); ?></label>
     </div>
    </li>
    <li class="cf post_list_type_custom_option show_category_list_hide_option"<?php if(!($values['show_category_list'] == 'hide' && $values['post_type'] == 'custom')){ echo ' style="display:none"'; }; ?>>
     <span class="label"><?php _e('ID of the article you want to display', 'tcd-canon');  ?><span class="recommend_desc"><?php _e('Please enter post ids by comma separated.', 'tcd-canon'); ?></span></span>
     <input type="text" placeholder="<?php _e( 'e.g.', 'tcd-canon' ); ?>1,3,10" class="full_width hankaku" name="dp_options[contents_builder][<?php echo $key; ?>][post_order_custom]" value="<?php echo esc_attr($values['post_order_custom']); ?>">
    </li>
   </ul>

<?php
}


// お知らせ一覧
function admin_contents_builder_news_list( $key, $values ){

  global $blog_label;
  $options = get_design_plus_option();
  $news_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-canon' );

  $values = !empty( $values ) ? $values : array(
    'headline' => '',
    'sub_title' => '',
    'desc' => '',
    'desc_mobile' => '',
    'button_label' => __( 'News', 'tcd-canon' ),
    'post_num' => '6',
    'post_num_sp' => '6',
    'post_type' => 'all_post',
    'post_order' => 'date',
    'post_order_custom' => '',
    'category_id' => '',
  );

?>
   <input type="hidden" name="dp_options[contents_builder][<?php echo esc_attr( $key ); ?>][type]" value="news_list">

   <div class="cb_image">
    <img src="<?php bloginfo('template_url'); ?>/admin/img/image/index/cb_news_list2.jpg" width="" height="" />
   </div>

   <div class="theme_option_message2">
    <p><?php printf(__('Displays content created with the custom post type "<a href="./edit.php?post_type=news" target="_blank">%s</a>" by carousel.<br>Displayment setting of featured images is linked to "%s > Common setting > Featured image".', 'tcd-canon'), $news_label, $news_label); ?></p>
   </div>

   <h4 class="theme_option_headline2"><?php _e('Basic settings', 'tcd-canon');  ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><span class="num">1</span><?php _e('Catchphrase', 'tcd-canon'); ?></span><input class="js-contents-builder-item-label full_width" type="text" name="dp_options[contents_builder][<?php echo $key; ?>][headline]" value="<?php echo esc_attr($values['headline']); ?>" /></li>
    <li class="cf space"><span class="label"><?php _e('Subtitle', 'tcd-canon'); ?></span><input class="full_width" type="text" name="dp_options[contents_builder][<?php echo $key; ?>][sub_title]" value="<?php echo esc_attr($values['sub_title']); ?>" /></li>
    <li class="cf"><span class="label"><span class="num">2</span><?php _e('Description', 'tcd-canon'); ?></span><textarea class="full_width" cols="50" rows="4" name="dp_options[contents_builder][<?php echo $key; ?>][desc]"><?php echo esc_textarea($values['desc']); ?></textarea></li>
    <li class="cf space"><span class="label"><?php _e('Description (mobile)', 'tcd-canon'); ?></span><textarea placeholder="<?php _e( 'Please indicate if you would like to display a short text for mobile sizes.', 'tcd-canon' ); ?>" class="full_width" cols="50" rows="4" name="dp_options[contents_builder][<?php echo $key; ?>][desc_mobile]"><?php if(isset($values['desc_mobile'])){ echo esc_textarea( $values['desc_mobile'] ); }; ?></textarea></li>
    <li class="cf">
     <span class="label">
      <span class="num">3</span><?php _e('Link button label', 'tcd-canon'); ?>
      <span class="recommend_desc space"><?php _e('Leave this field blank if you don\'t want to display button.', 'tcd-canon'); ?></span>
     </span>
     <input type="text" class="full_width" name="dp_options[contents_builder][<?php echo $key; ?>][button_label]" value="<?php echo esc_attr($values['button_label']); ?>" />
    </li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Post list', 'tcd-canon');  ?></h4>
   <ul class="option_list">
    <li class="cf">
     <span class="label"><?php _e('Post type', 'tcd-canon');  ?></span>
     <select class="post_list_type news" name="dp_options[contents_builder][<?php echo $key; ?>][post_type]">
      <option style="padding-right: 10px;" value="all_post" <?php selected( $values['post_type'], 'all_post' ); ?>><?php _e('All post', 'tcd-canon'); ?></option>
      <option style="padding-right: 10px;" value="category_post" <?php selected( $values['post_type'], 'category_post' ); ?>><?php _e('Category post', 'tcd-canon'); ?></option>
      <option style="padding-right: 10px;" value="recommend_post" <?php selected( $values['post_type'], 'recommend_post' ); ?>><?php _e('Recommend post', 'tcd-canon'); ?>1</option>
      <option style="padding-right: 10px;" value="recommend_post2" <?php selected( $values['post_type'], 'recommend_post2' ); ?>><?php _e('Recommend post', 'tcd-canon'); ?>2</option>
      <option style="padding-right: 10px;" value="recommend_post3" <?php selected( $values['post_type'], 'recommend_post3' ); ?>><?php _e('Recommend post', 'tcd-canon'); ?>3</option>
      <option style="padding-right: 10px;" value="custom" <?php selected( $values['post_type'], 'custom' ); ?>><?php _e('Custom', 'tcd-canon'); ?></option>
     </select>
    </li>
    <li class="cf post_list_type_category_option" style="display:none">
     <span class="label"><?php _e('Category', 'tcd-canon'); ?></span>
     <?php
          $category_list = get_terms( 'news_category', array( 'orderby' => 'order', 'hide_empty' => true ) );
          if ( $category_list && ! is_wp_error( $category_list ) ) {
            $selected_value = isset($values['category_id']) ?  $values['category_id'] : '';
            wp_dropdown_categories( array(
             'taxonomy' => 'news_category',
             'class' => 'category',
             'hierarchical' => true,
             'id' => '',
             'name' => 'dp_options[contents_builder][' . $key . '][category_id]',
             'selected' => $selected_value,
             'value_field' => 'term_id'
            ) );
          } else {
     ?>
     <p><?php _e('No category is registered', 'tcd-canon');  ?></p>
     <?php }; ?>
    </li>
    <li class="cf post_list_type_normal_option">
     <span class="label"><?php _e('Number of post to display', 'tcd-canon'); ?></span>
     <div class="display_post_num_option">
      <label for="cb_news_list_post_num_<?php echo $key; ?>"><input type="number" id="cb_news_list_post_num_<?php echo $key; ?>" name="dp_options[contents_builder][<?php echo $key; ?>][post_num]" value="<?php echo esc_attr($values['post_num']); ?>"><span class="icon icon_pc"></span></label>
      <label for="cb_news_list_post_num_sp_<?php echo $key; ?>"><input type="number" id="cb_news_list_post_num_sp_<?php echo $key; ?>" name="dp_options[contents_builder][<?php echo $key; ?>][post_num_sp]" value="<?php echo esc_attr($values['post_num_sp']); ?>"><span class="icon icon_sp"></span></label>
     </div>
    </li>
    <li class="cf post_list_type_normal_option">
     <span class="label"><?php _e('Post order', 'tcd-canon');  ?></span>
     <div class="standard_radio_button">
      <input id="carousel_news_order_date_<?php echo $key; ?>" type="radio" name="dp_options[contents_builder][<?php echo $key; ?>][post_order]" value="date" <?php checked( $values['post_order'], 'date' ); ?>>
      <label for="carousel_news_order_date_<?php echo $key; ?>"><?php _e('Date', 'tcd-canon'); ?></label>
      <input id="carousel_news_order_rand_<?php echo $key; ?>" type="radio" name="dp_options[contents_builder][<?php echo $key; ?>][post_order]" value="rand" <?php checked( $values['post_order'], 'rand' ); ?>>
      <label for="carousel_news_order_rand_<?php echo $key; ?>"><?php _e('Random', 'tcd-canon'); ?></label>
     </div>
    </li>
    <li class="cf post_list_type_custom_option" style="display:none;">
     <span class="label"><?php _e('ID of the article you want to display', 'tcd-canon');  ?><span class="recommend_desc"><?php _e('Please enter post ids by comma separated.', 'tcd-canon'); ?></span></span>
     <input type="text" placeholder="<?php _e( 'e.g.', 'tcd-canon' ); ?>1,3,10" class="full_width hankaku" name="dp_options[contents_builder][<?php echo $key; ?>][post_order_custom]" value="<?php echo esc_attr($values['post_order_custom']); ?>">
    </li>
   </ul>

<?php
}


// フリースペース
function admin_contents_builder_free_space( $key, $values ){

  $values = !empty( $values ) ? $values : array(
    'headline' => '',
    'sub_title' => '',
    'desc' => '',
    'desc_mobile' => '',
    'free_space' => '',
    'content_width' => 'type1',
  );

?>
   <input type="hidden" name="dp_options[contents_builder][<?php echo esc_attr( $key ); ?>][type]" value="free_space">

   <div class="cb_image">
    <img src="<?php bloginfo('template_url'); ?>/admin/img/image/index/cb_free_space2.jpg" width="" height="" />
   </div>

   <div class="theme_option_message2">
    <p><?php _e('You can create free content using the WordPress Classic Editor.', 'tcd-canon'); ?></p>
   </div>

   <h4 class="theme_option_headline2"><?php _e('Basic setting', 'tcd-canon'); ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><span class="num">1</span><?php _e('Catchphrase', 'tcd-canon'); ?></span><input class="js-contents-builder-item-label full_width" type="text" name="dp_options[contents_builder][<?php echo $key; ?>][headline]" value="<?php echo esc_attr($values['headline']); ?>" /></li>
    <li class="cf space"><span class="label"><?php _e('Subtitle', 'tcd-canon'); ?></span><input class="full_width" type="text" name="dp_options[contents_builder][<?php echo $key; ?>][sub_title]" value="<?php echo esc_attr($values['sub_title']); ?>" /></li>
    <li class="cf"><span class="label"><span class="num">2</span><?php _e('Description', 'tcd-canon'); ?></span><textarea class="full_width" cols="50" rows="4" name="dp_options[contents_builder][<?php echo $key; ?>][desc]"><?php echo esc_textarea($values['desc']); ?></textarea></li>
    <li class="cf space"><span class="label"><?php _e('Description (mobile)', 'tcd-canon'); ?></span><textarea placeholder="<?php _e( 'Please indicate if you would like to display a short text for mobile sizes.', 'tcd-canon' ); ?>" class="full_width" cols="50" rows="4" name="dp_options[contents_builder][<?php echo $key; ?>][desc_mobile]"><?php if(isset($values['desc_mobile'])){ echo esc_textarea( $values['desc_mobile'] ); }; ?></textarea></li>
    <li class="cf">
     <span class="label"><span class="num">3</span><?php _e('Content width', 'tcd-canon'); ?></span>
     <div class="standard_radio_button">
      <input id="cb_content_width_type1_<?php echo $key; ?>" type="radio" name="dp_options[contents_builder][<?php echo $key; ?>][content_width]" value="type1" <?php checked( $values['content_width'], 'type1' ); ?>>
      <label for="cb_content_width_type1_<?php echo $key; ?>">1000px</label>
      <input id="cb_content_width_type2_<?php echo $key; ?>" type="radio" name="dp_options[contents_builder][<?php echo $key; ?>][content_width]" value="type2" <?php checked( $values['content_width'], 'type2' ); ?>>
      <label for="cb_content_width_type2_<?php echo $key; ?>"><?php _e('Full size', 'tcd-canon'); ?></label>
     </div>
    </li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Content', 'tcd-canon');  ?></h4>
   <?php
        wp_editor(
          $values['free_space'],
          'cb_wysiwyg_editor-' . $key,
          array (
            'textarea_name' => 'dp_options[contents_builder][' . $key . '][free_space]',
            //'editor_class' => 'js-contents-builder-item-label'
          )
       );
   ?>

<?php
}

?>