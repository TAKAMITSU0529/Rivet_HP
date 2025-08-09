<?php
/*
 * トップページの設定
 */

 use TCD\Helper\UI;
 use TCD\Helper\Sanitization as San;

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
	$tab_labels['front_page'] = __( 'Front page', 'tcd-w' );
	return $tab_labels;
}


// 初期値
function add_front_page_dp_default_options( $dp_default_options ) {

  // ヘッダーコンテンツ
	$dp_default_options['index_header_content_type'] = 'type1';

  // 画像スライダー
	$dp_default_options['index_slider_time'] = '7000';
	for ( $i = 1; $i <= 3; $i++ ) {
		$dp_default_options['index_slider_image' . $i] = false;
		$dp_default_options['index_slider_image_mobile' . $i] = false;

		$dp_default_options['index_slider_catch' . $i] = __( 'Catchprase will be displayed here.', 'tcd-w' );
		$dp_default_options['index_slider_catch_font_type' . $i] = 2;
		$dp_default_options['index_slider_catch_font_size' . $i] = '38';
		$dp_default_options['index_slider_catch_font_size_mobile' . $i] = '22';
		$dp_default_options['index_slider_catch_color' . $i] = '#FFFFFF';

		$dp_default_options['index_slider_desc' . $i] = __( 'Description will be displayed here.<br />Description will be displayed here.', 'tcd-w' );
		$dp_default_options['index_slider_desc_font_size' . $i] = '16';
		$dp_default_options['index_slider_desc_font_size_mobile' . $i] = '14';
		$dp_default_options['index_slider_desc_color' . $i] = '#FFFFFF';

		$dp_default_options['index_slider_use_shadow' . $i] = 0;
		$dp_default_options['index_slider_shadow_h'.$i] = 0;
		$dp_default_options['index_slider_shadow_v'.$i] = 0;
		$dp_default_options['index_slider_shadow_b'.$i] = 0;
		$dp_default_options['index_slider_shadow_c'.$i] = '#888888';

		$dp_default_options['index_slider_content_direction' . $i] = 'type2';
		$dp_default_options['index_slider_animation_type' . $i] = 'type3';

		$dp_default_options['index_slider_show_button' . $i] = 1;
		$dp_default_options['index_slider_button_label' . $i] = 'MORE DETAIL';
		$dp_default_options['index_slider_button_font_color' . $i] = '#ffffff';
		$dp_default_options['index_slider_button_border_color' . $i] = '#ffffff';
		$dp_default_options['index_slider_button_border_opacity' . $i] = '0.5';
		$dp_default_options['index_slider_button_font_color_hover' . $i] = '#ffffff';
		$dp_default_options['index_slider_button_bg_color_hover' . $i] = '#472805';
		$dp_default_options['index_slider_button_border_color_hover' . $i] = '#472805';
		$dp_default_options['index_slider_url' . $i] = '#';
		$dp_default_options['index_slider_target' . $i] = 1;

		$dp_default_options['index_slider_use_overlay' . $i] = 1;
		$dp_default_options['index_slider_overlay_color' . $i] = '#000000';
		$dp_default_options['index_slider_overlay_opacity' . $i] = '0.3';
		$dp_default_options['index_slider_use_overlay_mobile' . $i] = '';
		$dp_default_options['index_slider_overlay_color_mobile' . $i] = '#000000';
		$dp_default_options['index_slider_overlay_opacity_mobile' . $i] = '0.3';
	}

  //画像スライダースマホ用設定
	$dp_default_options['index_slider_mobile_content_type'] = 'type1';
	$dp_default_options['index_slider_mobile_logo_image'] = '';
	$dp_default_options['index_slider_mobile_logo_image_width'] = '';

	$dp_default_options['index_slider_mobile_catch'] = '';
	$dp_default_options['index_slider_mobile_catch_font_type'] = 2;
	$dp_default_options['index_slider_mobile_catch_font_size'] = '22';
	$dp_default_options['index_slider_mobile_catch_color'] = '#FFFFFF';
	$dp_default_options['index_slider_mobile_desc'] = '';
	$dp_default_options['index_slider_mobile_desc_font_size'] = '14';
	$dp_default_options['index_slider_mobile_desc_color'] = '#FFFFFF';
	$dp_default_options['index_slider_mobile_show_button'] = '';
	$dp_default_options['index_slider_mobile_button_label'] = 'MORE DETAIL';
	$dp_default_options['index_slider_mobile_button_font_color'] = '#ffffff';
	$dp_default_options['index_slider_mobile_button_border_color'] = '#ffffff';
	$dp_default_options['index_slider_mobile_button_border_opacity'] = '0.5';
	$dp_default_options['index_slider_mobile_button_font_color_hover'] = '#ffffff';
	$dp_default_options['index_slider_mobile_button_bg_color_hover'] = '#472805';
	$dp_default_options['index_slider_mobile_button_border_color_hover'] = '#472805';
	$dp_default_options['index_slider_mobile_url'] = '#';
	$dp_default_options['index_slider_mobile_target'] = 1;

	$dp_default_options['index_slider_mobile_use_shadow'] = 0;
	$dp_default_options['index_slider_mobile_shadow_h'] = 0;
	$dp_default_options['index_slider_mobile_shadow_v'] = 0;
	$dp_default_options['index_slider_mobile_shadow_b'] = 0;
	$dp_default_options['index_slider_mobile_shadow_c'] = '#888888';

  // 動画
	$dp_default_options['index_video'] = false;

  // Youtube
	$dp_default_options['index_youtube_url'] = '';

	// 代替画像
	$dp_default_options['index_movie_image'] = false;

  // 動画用コンテンツ
	$dp_default_options['index_movie_content_type'] = 'type3';
	$dp_default_options['index_movie_bottom_content_type'] = 'type1';

	$dp_default_options['index_movie_catch'] = __( 'Catchprase will be displayed here.', 'tcd-w' );
	$dp_default_options['index_movie_catch_font_type'] = 2;
	$dp_default_options['index_movie_catch_font_size'] = '38';
	$dp_default_options['index_movie_catch_font_size_mobile'] = '20';
	$dp_default_options['index_movie_catch_color'] = '#FFFFFF';

	$dp_default_options['index_movie_desc'] = __( 'Description will be displayed here.<br />Description will be displayed here.', 'tcd-w' );
	$dp_default_options['index_movie_desc_font_size'] = '16';
	$dp_default_options['index_movie_desc_font_size_mobile'] = '13';
	$dp_default_options['index_movie_desc_color'] = '#FFFFFF';

	$dp_default_options['index_movie_use_shadow'] = 0;
	$dp_default_options['index_movie_shadow_h'] = 0;
	$dp_default_options['index_movie_shadow_v'] = 0;
	$dp_default_options['index_movie_shadow_b'] = 0;
	$dp_default_options['index_movie_shadow_c'] = '#888888';

	$dp_default_options['index_movie_show_button'] = 0;
	$dp_default_options['index_movie_button_label'] = 'MORE DETAIL';
	$dp_default_options['index_movie_button_font_color'] = '#ffffff';
	$dp_default_options['index_movie_button_border_color'] = '#ffffff';
	$dp_default_options['index_movie_button_border_opacity'] = '0.5';
	$dp_default_options['index_movie_button_font_color_hover'] = '#ffffff';
	$dp_default_options['index_movie_button_bg_color_hover'] = '#472805';
	$dp_default_options['index_movie_button_border_color_hover'] = '#472805';
	$dp_default_options['index_movie_url'] = '#';
	$dp_default_options['index_movie_target'] = 1;

	$dp_default_options['index_movie_use_overlay'] = 1;
	$dp_default_options['index_movie_overlay_color'] = '#000000';
	$dp_default_options['index_movie_overlay_opacity'] = '0.3';

  // 動画用コンテンツ（スマホ用）
	$dp_default_options['index_movie_mobile_content_type'] = 'type1';

	$dp_default_options['index_movie_content_type_mobile'] = 'type3';

	$dp_default_options['index_movie_catch_mobile'] = __( 'Catchprase will be displayed here.', 'tcd-w' );
	$dp_default_options['index_movie_catch_font_type_mobile'] = 2;
	$dp_default_options['index_movie_mobile_catch_font_size'] = '20';
	$dp_default_options['index_movie_catch_color_mobile'] = '#FFFFFF';

	$dp_default_options['index_movie_use_shadow_mobile'] = 0;
	$dp_default_options['index_movie_shadow_h_mobile'] = 0;
	$dp_default_options['index_movie_shadow_v_mobile'] = 0;
	$dp_default_options['index_movie_shadow_b_mobile'] = 0;
	$dp_default_options['index_movie_shadow_c_mobile'] = '#888888';

  // ボックスコンテンツ
	$dp_default_options['index_box_content_title_font_size'] = '22';
	$dp_default_options['index_box_content_title_font_size_mobile'] = '20';
	$dp_default_options['index_box_content_title_font_color'] = '#ffffff';
	$dp_default_options['index_box_content_title_bg_color'] = '#341e09';
	$dp_default_options['index_box_content_title_bg_opacity'] = '0.5';
	$dp_default_options['index_box_content_desc_font_size'] = '16';
	$dp_default_options['index_box_content_desc_font_size_mobile'] = '14';
	for ( $i = 1; $i <= 3; $i++ ) {
		$dp_default_options['index_box_content_image' . $i] = false;
		$dp_default_options['index_box_content_title' . $i] = __( 'Title', 'tcd-w' );
		$dp_default_options['index_box_content_desc' . $i] = __( 'Description will be displayed here.<br />Description will be displayed here.', 'tcd-w' );;
		$dp_default_options['index_box_content_url' . $i] = '#';
	}

  // コンテンツビルダー
	$dp_default_options['contents_builder'] = array(
		array(
			"cb_content_select" => "design_content1",
			"show_dc1" => 1,
			"dc1_image_type" => 'type3',
			"dc1_catch" => __( 'Catchphrase', 'tcd-w' ),
			"dc1_catch_font_size" => '38',
			"dc1_catch_font_size_mobile" => '22',
			"dc1_catch_font_color" => "#58330d",
			"dc1_desc" => __( 'Description will be displayed here.<br />Description will be displayed here.', 'tcd-w' ),
			"dc1_desc_font_size" => '16',
			"dc1_desc_font_size_mobile" => '14',
			"show_dc1_button" => 1,
			"dc1_button_label" => 'BUTTON',
			"dc1_button_url" => '#',
			"dc1_button_font_color" => '#58330c',
			"dc1_button_border_color" => '#59340e',
			"dc1_button_font_color_hover" => '#ffffff',
			"dc1_button_bg_color_hover" => '#472805',
			"dc1_button_border_color_hover" => '#472805',
			"dc1_button_target" => 1,
		),
		array(
			"cb_content_select" => "design_content2",
			"show_dc2" => 1,
			"dc2_catch" => '',
			"dc2_catch_font_size" => '38',
			"dc2_catch_font_size_mobile" => '22',
			"dc2_desc" => '',
			"dc2_desc_font_size" => '16',
			"dc2_desc_font_size_mobile" => '14',
			"dc2_banner_headline" => __( 'Headline', 'tcd-w' ),
			"dc2_banner_headline_font_size" => '38',
			"dc2_banner_headline_font_size_mobile" => '22',
			"dc2_banner_sub_title" => __( 'Subtitle', 'tcd-w' ),
			"dc2_banner_sub_title_font_size" => '18',
			"dc2_banner_sub_title_font_size_mobile" => '12',
			"dc2_banner_desc" => __( 'Description will be displayed here.<br />Description will be displayed here.', 'tcd-w' ),
			"dc2_banner_desc_font_size" => '16',
			"dc2_banner_desc_font_size_mobile" => '14',
			"dc2_banner_font_color" => '#ffffff',
			"dc2_banner_use_overlay" => 1,
			"dc2_banner_overlay_color" => '#000000',
			"dc2_banner_overlay_opacity" => '0.3',
			"dc2_banner_target" => 1
		),
		array(
			"cb_content_select" => "news_list",
			"show_news" => 1,
			"news_headline" => 'NEWS',
			"news_headline_font_size" => '38',
			"news_headline_font_size_mobile" => '22',
			"news_headline_font_color" => '#58330d',
			"news_sub_title" => '',
			"news_sub_title_font_size" => '18',
			"news_sub_title_font_size_mobile" => '12',
			"news_post_type" => 'news',
			"news_num" => '3',
			"news_date_color" => '593306',
			"show_news_button" => 1,
			"news_button_label" => 'BUTTON',
			"news_button_font_color" => '#58330c',
			"news_button_border_color" => '#59340e',
			"news_button_font_color_hover" => '#ffffff',
			"news_button_bg_color_hover" => '#472805',
			"news_button_border_color_hover" => '#472805',
		),
		array(
			"cb_content_select" => "campaign_list",
			"show_campaign" => 1,
			"campaign_headline" => 'CAMPAIGN',
			"campaign_headline_font_size" => '38',
			"campaign_headline_font_size_mobile" => '22',
			"campaign_headline_font_color" => '#ffffff',
			"campaign_sub_title" => '',
			"campaign_sub_title_font_size" => '18',
			"campaign_sub_title_font_size_mobile" => '12',
			"campaign_post_type" => 'campaign',
			"campaign_num" => '6',
			"campaign_title_font_size" => '16',
			"campaign_title_font_size_mobile" => '14',
			"campaign_title_font_color" => '#ffffff',
			"campaign_border_color_opacity" => '0.5',
			"show_campaign_button" => 1,
			"campaign_button_label" => 'BUTTON',
			"campaign_button_font_color" => '#ffffff',
			"campaign_button_border_color" => '#ffffff',
			"campaign_button_border_opacity" => '0.5',
			"campaign_button_font_color_hover" => '#ffffff',
			"campaign_button_bg_color_hover" => '#472805',
			"campaign_button_border_color_hover" => '#472805',
			"campaign_bg_type" => 'type1',
			"campaign_video" => '',
			"campaign_video_image" => '',
			"campaign_use_overlay" => 1,
			"campaign_overlay_color" => '#000000',
			"campaign_overlay_opacity" => '0.3',
		),
		array(
			"cb_content_select" => "recent_blog_list",
			"show_blog" => 1,
			"recent_blog_headline" => 'BLOG',
			"recent_blog_headline_font_size" => '38',
			"recent_blog_headline_font_size_mobile" => '22',
			"recent_blog_headline_font_color" => '#58330d',
			"recent_blog_sub_title" => '',
			"recent_blog_sub_title_font_size" => '18',
			"recent_blog_sub_title_font_size_mobile" => '12',
			"recent_blog_post_type" => 'post',
			"recent_blog_num" => '6',
			"recent_blog_title_font_size" => '16',
			"recent_blog_title_font_size_mobile" => '14',
			"recent_blog_show_date" => 1,
			"recent_blog_show_category" => 1,
			"show_recent_blog_button" => 1,
			"recent_blog_button_label" => 'BUTTON',
			"recent_blog_button_font_color" => '#58330c',
			"recent_blog_button_border_color" => '#59340e',
			"recent_blog_button_font_color_hover" => '#ffffff',
			"recent_blog_button_bg_color_hover" => '#472805',
			"recent_blog_button_border_color_hover" => '#472805',
		)
	);

	return $dp_default_options;

}

// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_front_page_tab_panel( $options ) {

  global $dp_default_options, $index_content_type_options, $time_options, $font_type_options, $content_direction_options, $index_slider_content_type_options, $slider_animation_options;
  $campaign_label = $options['campaign_label'] ? esc_html( $options['campaign_label'] ) : __( 'Campaign', 'tcd-w' );
  $news_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-w' );

?>

<div id="tab-content-logo" class="tab-content">

   <?php // ヘッダーコンテンツの設定 ---------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Header content', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <?php // コンテンツのタイプ ---------- ?>
     <h4 class="theme_option_headline2"><?php _e('Background type', 'tcd-w');  ?></h4>
     <ul class="design_radio_button horizontal cf">
      <?php foreach ( $index_content_type_options as $option ) { ?>
      <li>
       <input type="radio" id="index_header_content_button_<?php esc_attr_e( $option['value'] ); ?>" name="dp_options[index_header_content_type]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $options['index_header_content_type'], $option['value'] ); ?> />
       <label for="index_header_content_button_<?php esc_attr_e( $option['value'] ); ?>"><?php echo $option['label']; ?></label>
      </li>
      <?php } ?>
     </ul>

     <?php // 画像スライダー ■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■ ?>
     <div id="index_content_slider" style="<?php if($options['index_header_content_type'] == 'type1') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <h4 class="theme_option_headline2"><?php _e('Image slider', 'tcd-w');  ?></h4>

      <?php // PCの設定----- ?>
      <div class="sub_box cf"> 
       <h3 class="theme_option_subbox_headline"><?php _e('PC size setting', 'tcd-w'); ?></h3>
       <div class="sub_box_content tab_parent">

        <div class="sub_box_tab">
         <div class="tab active" data-tab="tab1"><?php _e('Slide', 'tcd-w'); ?>1</div>
         <div class="tab" data-tab="tab2"><?php _e('Slide', 'tcd-w'); ?>2</div>
         <div class="tab" data-tab="tab3"><?php _e('Slide', 'tcd-w'); ?>3</div>
        </div>

        <?php for($i = 1; $i <= 3; $i++) : ?>
        <div class="sub_box_tab_content<?php if($i == 1){ echo ' active'; }; ?>" data-tab-content="tab<?php echo $i; ?>">

        <?php // 画像の設定 ----------------------- ?>
        <h4 class="theme_option_headline2"><?php _e( 'Image', 'tcd-w' ); ?></h4>
        <ul class="option_list">
         <li class="cf">
          <span class="label">
           <?php _e('Image', 'tcd-w'); ?>
           <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '1450', '550'); ?></span>
          </span>
          <div class="image_box cf index_slider_image<?php echo $i; ?>">
           <div class="cf cf_media_field hide-if-no-js index_slider_image<?php echo $i; ?>">
            <input type="hidden" value="<?php echo esc_attr( $options['index_slider_image'.$i] ); ?>" id="index_slider_image<?php echo $i; ?>" name="dp_options[index_slider_image<?php echo $i; ?>]" class="cf_media_id">
            <div class="preview_field"><?php if($options['index_slider_image'.$i]){ echo wp_get_attachment_image($options['index_slider_image'.$i], 'full'); }; ?></div>
            <div class="buttton_area">
             <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
             <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['index_slider_image'.$i]){ echo 'hidden'; }; ?>">
            </div>
           </div>
          </div>
         </li>
        </ul>

        <?php // キャッチフレーズ ----------------------- ?>
        <h4 class="theme_option_headline2"><?php _e( 'Catchphrase', 'tcd-w' ); ?></h4>
        <textarea class="large-text" cols="50" rows="3" name="dp_options[index_slider_catch<?php echo $i; ?>]"><?php echo esc_textarea(  $options['index_slider_catch'.$i] ); ?></textarea>
        <ul class="option_list">
         <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w'); ?></span>
         <?php echo UI\font_select( 'dp_options[index_slider_catch_font_type'. $i .']', $options['index_slider_catch_font_type'.$i] ); ?>
         </li>
         <li class="cf">
          <span class="label"><?php _e('Font size', 'tcd-w'); ?></span>
          <div class="font_size_option">
           <label class="font_size_label number_option">
            <input class="hankaku input_font_size" type="number" name="dp_options[index_slider_catch_font_size<?php echo $i; ?>]" value="<?php esc_attr_e( $options['index_slider_catch_font_size'.$i] ); ?>"><span class="icon icon_pc"></span>
           </label>
           <label class="font_size_label number_option">
            <input class="hankaku input_font_size_sp" type="number" name="dp_options[index_slider_catch_font_size_mobile<?php echo $i; ?>]" value="<?php esc_attr_e( $options['index_slider_catch_font_size_mobile'.$i] ); ?>"><span class="icon icon_sp"></span>
           </label>
          </div>
         </li>
         <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[index_slider_catch_color<?php echo $i; ?>]" value="<?php echo esc_attr( $options['index_slider_catch_color'.$i] ); ?>" data-default-color="#FFFFFF" class="c-color-picker"></li>
        </ul>

        <?php // 説明文 ----------------------- ?>
        <h4 class="theme_option_headline2"><?php _e('Description', 'tcd-w');  ?></h4>
        <textarea class="large-text" cols="50" rows="3" name="dp_options[index_slider_desc<?php echo $i; ?>]"><?php echo esc_textarea(  $options['index_slider_desc'.$i] ); ?></textarea>
        <ul class="option_list">
         <li class="cf">
          <span class="label"><?php _e('Font size', 'tcd-w'); ?></span>
          <div class="font_size_option">
           <label class="font_size_label number_option">
            <input class="hankaku input_font_size" type="number" name="dp_options[index_slider_desc_font_size<?php echo $i; ?>]" value="<?php esc_attr_e( $options['index_slider_desc_font_size'.$i] ); ?>"><span class="icon icon_pc"></span>
           </label>
           <label class="font_size_label number_option">
            <input class="hankaku input_font_size_sp" type="number" name="dp_options[index_slider_desc_font_size_mobile<?php echo $i; ?>]" value="<?php esc_attr_e( $options['index_slider_desc_font_size_mobile'.$i] ); ?>"><span class="icon icon_sp"></span>
           </label>
          </div>
         </li>
         <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[index_slider_desc_color<?php echo $i; ?>]" value="<?php echo esc_attr( $options['index_slider_desc_color'.$i] ); ?>" data-default-color="#FFFFFF" class="c-color-picker"></li>
        </ul>

        <?php // テキストシャドウ ----------------------- ?>
        <h4 class="theme_option_headline2"><?php _e( 'Dropshadow', 'tcd-w' ); ?></h4>
        <p class="displayment_checkbox"><label><input name="dp_options[index_slider_use_shadow<?php echo $i; ?>]" type="checkbox" value="1" <?php checked( $options['index_slider_use_shadow'.$i], 1 ); ?>><?php _e( 'Use dropshadow on text content', 'tcd-w' ); ?></label></p>
        <div style="<?php if($options['index_slider_use_shadow'.$i] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
         <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
          <li class="cf"><span class="label"><?php _e('Dropshadow position (left)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[index_slider_shadow_h<?php echo $i; ?>]" value="<?php echo esc_attr( $options['index_slider_shadow_h'.$i] ); ?>"><span>px</span></li>
          <li class="cf"><span class="label"><?php _e('Dropshadow position (top)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[index_slider_shadow_v<?php echo $i; ?>]" value="<?php echo esc_attr( $options['index_slider_shadow_v'.$i] ); ?>"><span>px</span></li>
          <li class="cf"><span class="label"><?php _e('Dropshadow size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[index_slider_shadow_b<?php echo $i; ?>]" value="<?php echo esc_attr( $options['index_slider_shadow_b'.$i] ); ?>"><span>px</span></li>
          <li class="cf"><span class="label"><?php _e('Dropshadow color', 'tcd-w'); ?></span><input type="text" name="dp_options[index_slider_shadow_c<?php echo $i; ?>]" value="<?php echo esc_attr( $options['index_slider_shadow_c'.$i] ); ?>" data-default-color="#FFFFFF" class="c-color-picker"></li>
         </ul>
        </div>

        <?php // ボタン ----------------------- ?>
        <h4 class="theme_option_headline2"><?php _e('Button', 'tcd-w');  ?></h4>
        <p class="displayment_checkbox"><label><input class="index_slider_show_button<?php echo $i; ?>" name="dp_options[index_slider_show_button<?php echo $i; ?>]" type="checkbox" value="1" <?php checked( $options['index_slider_show_button'.$i], 1 ); ?>><?php _e( 'Display button', 'tcd-w' ); ?></label></p>
        <div style="<?php if($options['index_slider_show_button'.$i] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
         <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
          <li class="cf"><span class="label"><?php _e('label', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[index_slider_button_label<?php echo $i; ?>]" value="<?php echo esc_attr( $options['index_slider_button_label'.$i] ); ?>" /></li>
          <li class="cf button_option">
           <span class="label"><?php _e('URL', 'tcd-w'); ?></span>
           <div class="admin_link_option">
            <input type="text" name="dp_options[index_slider_url<?php echo $i; ?>]" placeholder="https://example.com/" value="<?php esc_attr_e( $options['index_slider_url'.$i] ); ?>">
            <input id="index_slider_target<?php echo $i; ?>" class="admin_link_option_target" name="dp_options[index_slider_target<?php echo $i; ?>]" type="checkbox" value="1" <?php checked( $options['index_slider_target'.$i], 1 ); ?>>
            <label for="index_slider_target<?php echo $i; ?>">&#xe92a;</label>
           </div>
          </li>
          <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[index_slider_button_font_color<?php echo $i; ?>]" value="<?php echo esc_attr( $options['index_slider_button_font_color'.$i] ); ?>" data-default-color="#FFFFFF" class="c-color-picker"></li>
          <li class="cf"><span class="label"><?php _e('Border color', 'tcd-w'); ?></span><input type="text" name="dp_options[index_slider_button_border_color<?php echo $i; ?>]" value="<?php echo esc_attr( $options['index_slider_button_border_color'.$i] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
          <li class="cf">
           <span class="label"><?php _e('Transparency of border', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[index_slider_button_border_opacity<?php echo $i; ?>]" value="<?php echo esc_attr( $options['index_slider_button_border_opacity'.$i] ); ?>" />
           <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
            <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
           </div>
          </li>
          <li class="cf"><span class="label"><?php _e('Font color on mouse over', 'tcd-w'); ?></span><input type="text" name="dp_options[index_slider_button_font_color_hover<?php echo $i; ?>]" value="<?php echo esc_attr( $options['index_slider_button_font_color_hover'.$i] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
          <li class="cf"><span class="label"><?php _e('Background color on mouse over', 'tcd-w'); ?></span><input type="text" name="dp_options[index_slider_button_bg_color_hover<?php echo $i; ?>]" value="<?php echo esc_attr( $options['index_slider_button_bg_color_hover'.$i] ); ?>" data-default-color="#472805" class="c-color-picker"></li>
          <li class="cf"><span class="label"><?php _e('Border color on mouse over', 'tcd-w'); ?></span><input type="text" name="dp_options[index_slider_button_border_color_hover<?php echo $i; ?>]" value="<?php echo esc_attr( $options['index_slider_button_border_color_hover'.$i] ); ?>" data-default-color="#472805" class="c-color-picker"></li>
         </ul>
        </div>

        <?php // オーバーレイ ----------------------- ?>
        <h4 class="theme_option_headline2"><?php _e( 'Overlay', 'tcd-w' ); ?></h4>
        <p class="displayment_checkbox"><label><input class="index_slider_use_overlay<?php echo $i; ?>" name="dp_options[index_slider_use_overlay<?php echo $i; ?>]" type="checkbox" value="1" <?php checked( $options['index_slider_use_overlay'.$i], 1 ); ?>><?php _e( 'Use overlay', 'tcd-w' ); ?></label></p>
        <div style="<?php if($options['index_slider_use_overlay'.$i] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
         <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
          <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-w'); ?></span><input class="c-color-picker index_slider_overlay_color<?php echo $i; ?>" type="text" name="dp_options[index_slider_overlay_color<?php echo $i; ?>]" value="<?php echo esc_attr( $options['index_slider_overlay_color'.$i] ); ?>" data-default-color="#000000"></li>
          <li class="cf">
           <span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span>
           <input class="hankaku" style="width:70px;" type="number" step="0.1" name="dp_options[index_slider_overlay_opacity<?php echo $i; ?>]" value="<?php echo esc_attr( $options['index_slider_overlay_opacity'.$i] ); ?>" />
           <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
            <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
           </div>
          </li>
         </ul>
        </div>

        <?php // アニメーション ----------------------- ?>
        <h4 class="theme_option_headline2"><?php _e('Animation type', 'tcd-w');  ?></h4>
        <select name="dp_options[index_slider_animation_type<?php echo $i; ?>]">
         <?php foreach ( $slider_animation_options as $option ) { ?>
         <option style="padding-right: 10px;" value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $options['index_slider_animation_type'.$i], $option['value'] ); ?>><?php echo esc_html($option['label']); ?></option>
         <?php } ?>
        </select>

        <?php // コンテンツの方向 ----------------------- ?>
        <h4 class="theme_option_headline2"><?php _e('Direction of content', 'tcd-w');  ?></h4>
        <?php echo tcd_basic_radio_button($options, 'index_slider_content_direction'.$i, $content_direction_options); ?>
        <br style="clear:both;">

        </div>
        <?php endfor; ?>

        <ul class="button_list cf">
         <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
         <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
        </ul>

       </div><!-- END .sub_box_content -->
      </div><!-- END .sub_box -->

      <?php // モバイルサイズ専用設定 ---------------------------------------------------------------------------------------------------------------- ?>
      <div class="sub_box cf">
       <h3 class="theme_option_subbox_headline"><?php _e('Mobile size setting', 'tcd-w'); ?></h3>
       <div class="sub_box_content tab_parent">

        <div class="theme_option_message2" style="margin-top:15px;">
         <p><?php _e( 'This content will be replaced by content above when the web browser become mobile size.', 'tcd-w' ); ?></p>
        </div>

        <?php //コンテンツの設定 -------------------------- ?>
        <h4 class="theme_option_headline2"><?php _e( 'Content type', 'tcd-w' ); ?></h4>
        <ul class="design_radio_button">
         <?php foreach ( $index_slider_content_type_options as $option ) { ?>
         <li class="index_slider_mobile_content_<?php esc_attr_e( $option['value'] ); ?>_button">
          <input type="radio" id="index_slider_mobile_content_type_<?php esc_attr_e( $option['value'] ); ?>" name="dp_options[index_slider_mobile_content_type]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $options['index_slider_mobile_content_type'], $option['value'] ); ?> />
          <label for="index_slider_mobile_content_type_<?php esc_attr_e( $option['value'] ); ?>"><?php echo $option['label']; ?></label>
         </li>
         <?php } ?>
        </ul>

        <?php // スマホ専用キャッチフレーズ ------------------------ ?>
        <div class="index_slider_catch_area_mobile" style="<?php if($options['index_slider_mobile_content_type'] == 'type2') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
         <h4 class="theme_option_headline2"><?php _e( 'Catchphrase', 'tcd-w' ); ?></h4>
         <textarea class="large-text" cols="50" rows="3" name="dp_options[index_slider_mobile_catch]"><?php echo esc_textarea(  $options['index_slider_mobile_catch'] ); ?></textarea>
         <ul class="option_list">
          <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w'); ?></span>
          <?php echo UI\font_select( 'dp_options[index_slider_mobile_catch_font_type]', $options['index_slider_mobile_catch_font_type'] ); ?>
          </li>
          <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[index_slider_mobile_catch_font_size]" value="<?php echo esc_attr( $options['index_slider_mobile_catch_font_size'] ); ?>" /><span>px</span></li>
          <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[index_slider_mobile_catch_color]" value="<?php echo esc_attr( $options['index_slider_mobile_catch_color'] ); ?>" data-default-color="#FFFFFF" class="c-color-picker"></li>
         </ul>

         <?php // 説明文 ----------------------- ?>
         <h4 class="theme_option_headline2"><?php _e('Description', 'tcd-w');  ?></h4>
         <textarea class="large-text" cols="50" rows="3" name="dp_options[index_slider_mobile_desc]"><?php echo esc_textarea(  $options['index_slider_mobile_desc'] ); ?></textarea>
         <ul class="option_list">
          <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[index_slider_mobile_desc_font_size]" value="<?php echo esc_attr( $options['index_slider_mobile_desc_font_size'] ); ?>" /><span>px</span></li>
          <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[index_slider_mobile_desc_color]" value="<?php echo esc_attr( $options['index_slider_mobile_desc_color'] ); ?>" data-default-color="#FFFFFF" class="c-color-picker"></li>
         </ul>

         <?php // テキストシャドウ ----------------------- ?>
         <h4 class="theme_option_headline2"><?php _e( 'Dropshadow', 'tcd-w' ); ?></h4>
         <p class="displayment_checkbox"><label><input name="dp_options[index_slider_mobile_use_shadow]" type="checkbox" value="1" <?php checked( $options['index_slider_mobile_use_shadow'], 1 ); ?>><?php _e( 'Use dropshadow on text content', 'tcd-w' ); ?></label></p>
         <div style="<?php if($options['index_slider_mobile_use_shadow'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
          <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
           <li class="cf"><span class="label"><?php _e('Dropshadow position (left)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[index_slider_mobile_shadow_h]" value="<?php echo esc_attr( $options['index_slider_mobile_shadow_h'] ); ?>"><span>px</span></li>
           <li class="cf"><span class="label"><?php _e('Dropshadow position (top)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[index_slider_mobile_shadow_v]" value="<?php echo esc_attr( $options['index_slider_mobile_shadow_v'] ); ?>"><span>px</span></li>
           <li class="cf"><span class="label"><?php _e('Dropshadow size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[index_slider_mobile_shadow_b]" value="<?php echo esc_attr( $options['index_slider_mobile_shadow_b'] ); ?>"><span>px</span></li>
           <li class="cf"><span class="label"><?php _e('Dropshadow color', 'tcd-w'); ?></span><input type="text" name="dp_options[index_slider_mobile_shadow_c]" value="<?php echo esc_attr( $options['index_slider_mobile_shadow_c'] ); ?>" data-default-color="#FFFFFF" class="c-color-picker"></li>
          </ul>
         </div>

         <?php // ボタン ----------------------- ?>
         <h4 class="theme_option_headline2"><?php _e('Button', 'tcd-w');  ?></h4>
         <p class="displayment_checkbox"><label><input class="index_slider_mobile_show_button" name="dp_options[index_slider_mobile_show_button]" type="checkbox" value="1" <?php checked( $options['index_slider_mobile_show_button'], 1 ); ?>><?php _e( 'Display button', 'tcd-w' ); ?></label></p>
         <div style="<?php if($options['index_slider_mobile_show_button'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
          <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
           <li class="cf"><span class="label"><?php _e('label', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[index_slider_mobile_button_label]" value="<?php echo esc_attr( $options['index_slider_mobile_button_label'] ); ?>" /></li>
           <li class="cf button_option">
            <span class="label"><?php _e('URL', 'tcd-w'); ?></span>
            <div class="admin_link_option">
             <input type="text" name="dp_options[index_slider_mobile_url]" placeholder="https://example.com/" value="<?php esc_attr_e( $options['index_slider_mobile_url'] ); ?>">
             <input id="index_slider_mobile_target" class="admin_link_option_target" name="dp_options[index_slider_mobile_target]" type="checkbox" value="1" <?php checked( $options['index_slider_mobile_target'], 1 ); ?>>
             <label for="index_slider_mobile_target">&#xe92a;</label>
            </div>
           </li>
           <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[index_slider_mobile_button_font_color]" value="<?php echo esc_attr( $options['index_slider_mobile_button_font_color'] ); ?>" data-default-color="#FFFFFF" class="c-color-picker"></li>
           <li class="cf"><span class="label"><?php _e('Border color', 'tcd-w'); ?></span><input type="text" name="dp_options[index_slider_mobile_button_border_color]" value="<?php echo esc_attr( $options['index_slider_mobile_button_border_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
           <li class="cf">
            <span class="label"><?php _e('Transparency of border', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[index_slider_mobile_button_border_opacity]" value="<?php echo esc_attr( $options['index_slider_mobile_button_border_opacity'] ); ?>" />
            <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
             <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
            </div>
           </li>
           <li class="cf"><span class="label"><?php _e('Font color on mouse over', 'tcd-w'); ?></span><input type="text" name="dp_options[index_slider_mobile_button_font_color_hover]" value="<?php echo esc_attr( $options['index_slider_mobile_button_font_color_hover'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
           <li class="cf"><span class="label"><?php _e('Background color on mouse over', 'tcd-w'); ?></span><input type="text" name="dp_options[index_slider_mobile_button_bg_color_hover]" value="<?php echo esc_attr( $options['index_slider_mobile_button_bg_color_hover'] ); ?>" data-default-color="#472805" class="c-color-picker"></li>
           <li class="cf"><span class="label"><?php _e('Border color on mouse over', 'tcd-w'); ?></span><input type="text" name="dp_options[index_slider_mobile_button_border_color_hover]" value="<?php echo esc_attr( $options['index_slider_mobile_button_border_color_hover'] ); ?>" data-default-color="#472805" class="c-color-picker"></li>
          </ul>
         </div>

        </div><!-- END .index_slider_catch_area_mobile -->

        <h4 class="theme_option_headline2"><?php _e('Image', 'tcd-w');  ?></h4>
        <div class="theme_option_message2">
         <p><?php _e( 'You can set images for mobile size. If it is not specified, PC image will be displayed instead.', 'tcd-w' ); ?></p>
        </div>

        <div class="sub_box_tab">
         <div class="tab active" data-tab="tab1"><?php _e('Slide', 'tcd-w'); ?>1</div>
         <div class="tab" data-tab="tab2"><?php _e('Slide', 'tcd-w'); ?>2</div>
         <div class="tab" data-tab="tab3"><?php _e('Slide', 'tcd-w'); ?>3</div>
        </div>

        <?php // 繰り返し 画像の設定 ----------------------------- ?>
        <?php for($i = 1; $i <= 3; $i++) : ?>
        <div class="sub_box_tab_content<?php if($i == 1){ echo ' active'; }; ?>" data-tab-content="tab<?php echo $i; ?>">

          <h4 class="theme_option_headline2"><?php _e( 'Image', 'tcd-w' ); ?></h4>
          <ul class="option_list">
           <li class="cf">
            <span class="label">
             <?php _e('Image', 'tcd-w'); ?>
             <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '750', '800'); ?></span>
            </span>
            <div class="image_box cf">
             <div class="cf cf_media_field hide-if-no-js index_slider_image_mobile<?php echo $i; ?>">
              <input type="hidden" value="<?php echo esc_attr( $options['index_slider_image_mobile'.$i] ); ?>" id="index_slider_image_mobile<?php echo $i; ?>" name="dp_options[index_slider_image_mobile<?php echo $i; ?>]" class="cf_media_id">
              <div class="preview_field"><?php if($options['index_slider_image_mobile'.$i]){ echo wp_get_attachment_image($options['index_slider_image_mobile'.$i], 'full'); }; ?></div>
              <div class="buttton_area">
               <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
               <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['index_slider_image_mobile'.$i]){ echo 'hidden'; }; ?>">
              </div>
             </div>
            </div>
           </li>
          </ul>

          <?php // オーバーレイ ----------------------- ?>
          <h4 class="theme_option_headline2"><?php _e( 'Overlay', 'tcd-w' ); ?></h4>
          <p class="displayment_checkbox"><label><input class="index_slider_use_overlay_mobile<?php echo $i; ?>" name="dp_options[index_slider_use_overlay_mobile<?php echo $i; ?>]" type="checkbox" value="1" <?php checked( $options['index_slider_use_overlay_mobile'.$i], 1 ); ?>><?php _e( 'Use overlay', 'tcd-w' ); ?></label></p>
          <div class="index_slider_show_overlay_mobile" style="<?php if($options['index_slider_use_overlay_mobile'.$i] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
           <ul class="color_field" style="border-top:1px dotted #ccc; padding-top:12px;">
            <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-w'); ?></span><input class="c-color-picker index_slider_overlay_color_mobile<?php echo $i; ?>" type="text" name="dp_options[index_slider_overlay_color_mobile<?php echo $i; ?>]" value="<?php echo esc_attr( $options['index_slider_overlay_color_mobile'.$i] ); ?>" data-default-color="#000000"></li>
            <li class="cf">
             <span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span>
             <input class="hankaku" style="width:70px;" type="number" step="0.1" name="dp_options[index_slider_overlay_opacity_mobile<?php echo $i; ?>]" value="<?php echo esc_attr( $options['index_slider_overlay_opacity_mobile'.$i] ); ?>" />
             <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
              <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
             </div>
            </li>
           </ul>
          </div><!-- END .index_slider_show_overlay_mobile -->

        </div>
        <?php endfor; ?>
        <?php // 繰り返し ここまで ----- ?>

        <ul class="button_list cf">
         <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
         <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
        </ul>

       </div><!-- END .sub_box_content -->
      </div><!-- END .sub_box -->
      <?php // モバイルサイズ用設定ここまで --------------- ?>

      <?php // スピードの設定 ---------- ?>
      <h4 class="theme_option_headline2"><?php _e('Slider speed', 'tcd-w');  ?></h4>
      <select name="dp_options[index_slider_time]">
       <?php
            $i = 1;
            foreach ( $time_options as $option ):
              if( $i >= 5 && $i <= 10 ){
       ?>
       <option style="padding-right: 10px;" value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $options['index_slider_time'], $option['value'] ); ?>><?php echo esc_html($option['label']); ?></option>
       <?php
              }
              $i++;
           endforeach;
       ?>
      </select>

     </div><!-- END #header_content_slider スライダーの設定はここまで-->

     <?php // 動画 ■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■ ?>
     <div id="index_content_video" style="<?php if($options['index_header_content_type'] == 'type2') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <h4 class="theme_option_headline2"><?php _e('Video', 'tcd-w');  ?></h4>
      <div class="theme_option_message2">
       <p><?php _e('Please upload MP4 format file.', 'tcd-w');  ?></p>
       <p><?php _e( 'Register within 10 MB.', 'tcd-w' ); ?><br>
       <?php _e( 'The screen ratio for video is assumed to be 16:9.', 'tcd-w' ); ?></p>
       <p><?php _e('Web browser takes few second to load the data of video so we recommend to use loading screen if you want to display video.', 'tcd-w'); ?></p>
      </div>
      <div class="image_box cf">
       <div class="cf cf_media_field hide-if-no-js index_video">
        <input type="hidden" value="<?php echo esc_attr( $options['index_video'] ); ?>" id="index_video" name="dp_options[index_video]" class="cf_media_id">
        <div class="preview_field preview_field_video">
         <?php if($options['index_video']){ ?>
         <h4><?php _e( 'Uploaded MP4 file', 'tcd-w' ); ?></h4>
         <p><?php echo esc_url(wp_get_attachment_url($options['index_video'])); ?></p>
         <?php }; ?>
        </div>
        <div class="buttton_area">
         <input type="button" value="<?php _e('Select MP4 file', 'tcd-w'); ?>" class="cfmf-select-video button">
         <input type="button" value="<?php _e('Remove MP4 file', 'tcd-w'); ?>" class="cfmf-delete-video button <?php if(!$options['index_video']){ echo 'hidden'; }; ?>">
        </div>
       </div>
      </div>
     </div><!-- END #header_content_video 動画の設定はここまで -->

     <?php // YouTube ■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■ ?>
     <div id="index_content_youtube" style="<?php if($options['index_header_content_type'] == 'type3') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <h4 class="theme_option_headline2"><?php _e('YouTube', 'tcd-w');  ?></h4>
      <div class="theme_option_message2">
       <p><?php _e('Please enter YouTube URL.', 'tcd-w');  ?></p>
       <p><?php _e('Web browser takes few second to load the data of video so we recommend to use loading screen if you want to display video.', 'tcd-w'); ?></p>
      </div>
      <input id="dp_options[index_youtube_url]" class="regular-text" type="text" name="dp_options[index_youtube_url]" value="<?php esc_attr_e( $options['index_youtube_url'] ); ?>" />
     </div><!-- END #header_content_youtube YouTubeの設定はここまで -->

     <?php // 代替画像、動画用キャッチフレーズ ■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■ ?>
     <div id="index_movie_content" style="<?php if($options['index_header_content_type'] != 'type1') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <?php // 代替画像 ----------- ?>
      <h4 class="theme_option_headline2"><?php _e('Substitute image', 'tcd-w');  ?></h4>
      <div class="theme_option_message2">
       <p><?php _e('If the mobile device can\'t play video this image will be displayed instead.', 'tcd-w');  ?></p>
      </div>
      <div class="image_box cf">
       <div class="cf cf_media_field hide-if-no-js index_movie_image">
        <input type="hidden" value="<?php echo esc_attr( $options['index_movie_image'] ); ?>" id="index_movie_image" name="dp_options[index_movie_image]" class="cf_media_id">
        <div class="preview_field"><?php if($options['index_movie_image']){ echo wp_get_attachment_image($options['index_movie_image'], 'full'); }; ?></div>
        <div class="buttton_area">
         <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
         <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['index_movie_image']){ echo 'hidden'; }; ?>">
        </div>
       </div>
      </div>

      <h4 class="theme_option_headline2"><?php _e('Contents setting', 'tcd-w');  ?></h4>
      <?php // PC用キャッチフレーズ ■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■ ?>
      <div class="sub_box cf">
       <h3 class="theme_option_subbox_headline"><?php _e('Default content', 'tcd-w'); ?></h3>
       <div class="sub_box_content">

        <?php // キャッチフレーズ ----------------------- ?>
        <h4 class="theme_option_headline2"><?php _e( 'Catchphrase', 'tcd-w' ); ?></h4>
        <textarea class="large-text" cols="50" rows="3" name="dp_options[index_movie_catch]"><?php echo esc_textarea(  $options['index_movie_catch'] ); ?></textarea>
        <ul class="option_list">
         <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w'); ?></span>
         <?php echo UI\font_select( 'dp_options[index_movie_catch_font_type]', $options['index_movie_catch_font_type'] ); ?>
         </li>
         <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'index_movie_catch_font_size'); ?></li>
         <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[index_movie_catch_color]" value="<?php echo esc_attr( $options['index_movie_catch_color'] ); ?>" data-default-color="#FFFFFF" class="c-color-picker"></li>
        </ul>

        <?php // 説明文 ----------------------- ?>
        <h4 class="theme_option_headline2"><?php _e('Description', 'tcd-w');  ?></h4>
        <textarea class="large-text" cols="50" rows="3" name="dp_options[index_movie_desc]"><?php echo esc_textarea(  $options['index_movie_desc'] ); ?></textarea>
        <ul class="option_list">
         <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'index_movie_desc_font_size'); ?></li>
         <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[index_movie_desc_color]" value="<?php echo esc_attr( $options['index_movie_desc_color'] ); ?>" data-default-color="#FFFFFF" class="c-color-picker"></li>
        </ul>

        <?php // テキストシャドウ ----------------------- ?>
        <h4 class="theme_option_headline2"><?php _e( 'Dropshadow', 'tcd-w' ); ?></h4>
        <p class="displayment_checkbox"><label><input name="dp_options[index_movie_use_shadow]" type="checkbox" value="1" <?php checked( $options['index_movie_use_shadow'], 1 ); ?>><?php _e( 'Use dropshadow on text content', 'tcd-w' ); ?></label></p>
        <div style="<?php if($options['index_movie_use_shadow'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
         <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
          <li class="cf"><span class="label"><?php _e('Dropshadow position (left)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[index_movie_shadow_h]" value="<?php echo esc_attr( $options['index_movie_shadow_h'] ); ?>"><span>px</span></li>
          <li class="cf"><span class="label"><?php _e('Dropshadow position (top)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[index_movie_shadow_v]" value="<?php echo esc_attr( $options['index_movie_shadow_v'] ); ?>"><span>px</span></li>
          <li class="cf"><span class="label"><?php _e('Dropshadow size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[index_movie_shadow_b]" value="<?php echo esc_attr( $options['index_movie_shadow_b'] ); ?>"><span>px</span></li>
          <li class="cf"><span class="label"><?php _e('Dropshadow color', 'tcd-w'); ?></span><input type="text" name="dp_options[index_movie_shadow_c]" value="<?php echo esc_attr( $options['index_movie_shadow_c'] ); ?>" data-default-color="#888888" class="c-color-picker"></li>
         </ul>
        </div>

        <?php // ボタン ----------------------- ?>
        <h4 class="theme_option_headline2"><?php _e('Button', 'tcd-w');  ?></h4>
        <p class="displayment_checkbox"><label><input class="index_movie_show_button" name="dp_options[index_movie_show_button]" type="checkbox" value="1" <?php checked( $options['index_movie_show_button'], 1 ); ?>><?php _e( 'Display button', 'tcd-w' ); ?></label></p>
        <div style="<?php if($options['index_movie_show_button'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
         <ul class="option_list">
          <li class="cf"><span class="label"><?php _e('label', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[index_movie_button_label]" value="<?php echo esc_attr( $options['index_movie_button_label'] ); ?>" /></li>
          <li class="cf button_option">
           <span class="label"><?php _e('URL', 'tcd-w'); ?></span>
           <div class="admin_link_option">
            <input type="text" name="dp_options[index_movie_url]" placeholder="https://example.com/" value="<?php esc_attr_e( $options['index_movie_url'] ); ?>">
            <input id="index_movie_target" class="admin_link_option_target" name="dp_options[index_movie_target]" type="checkbox" value="1" <?php checked( $options['index_movie_target'], 1 ); ?>>
            <label for="index_movie_target">&#xe92a;</label>
           </div>
          </li>
          <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[index_movie_button_font_color]" value="<?php echo esc_attr( $options['index_movie_button_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
          <li class="cf"><span class="label"><?php _e('Border color', 'tcd-w'); ?></span><input type="text" name="dp_options[index_movie_button_border_color]" value="<?php echo esc_attr( $options['index_movie_button_border_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
          <li class="cf">
           <span class="label"><?php _e('Transparency of border', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[index_movie_button_border_opacity]" value="<?php echo esc_attr( $options['index_movie_button_border_opacity'] ); ?>" />
           <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
            <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
           </div>
          </li>
          <li class="cf"><span class="label"><?php _e('Font color on mouse over', 'tcd-w'); ?></span><input type="text" name="dp_options[index_movie_button_font_color_hover]" value="<?php echo esc_attr( $options['index_movie_button_font_color_hover'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
          <li class="cf"><span class="label"><?php _e('Border color on mouse over', 'tcd-w'); ?></span><input type="text" name="dp_options[index_movie_button_border_color_hover]" value="<?php echo esc_attr( $options['index_movie_button_border_color_hover'] ); ?>" data-default-color="#472805" class="c-color-picker"></li>
          <li class="cf"><span class="label"><?php _e('Background color on mouse over', 'tcd-w'); ?></span><input type="text" name="dp_options[index_movie_button_bg_color_hover]" value="<?php echo esc_attr( $options['index_movie_button_bg_color_hover'] ); ?>" data-default-color="#472805" class="c-color-picker"></li>
         </ul>
        </div>

        <?php // オーバーレイ ----------------------- ?>
        <h4 class="theme_option_headline2"><?php _e( 'Overlay', 'tcd-w' ); ?></h4>
        <p class="displayment_checkbox"><label><input class="index_movie_use_overlay" name="dp_options[index_movie_use_overlay]" type="checkbox" value="1" <?php checked( $options['index_movie_use_overlay'], 1 ); ?>><?php _e( 'Use overlay', 'tcd-w' ); ?></label></p>
        <div style="<?php if($options['index_movie_use_overlay'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
         <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
          <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-w'); ?></span><input class="c-color-picker index_movie_overlay_color" type="text" name="dp_options[index_movie_overlay_color]" value="<?php echo esc_attr( $options['index_movie_overlay_color'] ); ?>" data-default-color="#000000"></li>
          <li class="cf">
           <span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span>
           <input class="hankaku" style="width:70px;" type="number" step="0.1" name="dp_options[index_movie_overlay_opacity]" value="<?php echo esc_attr( $options['index_movie_overlay_opacity'] ); ?>" />
           <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
            <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
           </div>
          </li>
         </ul>
        </div>

        <ul class="button_list cf">
         <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
         <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
        </ul>

       </div><!-- END .sub_box_content -->
      </div><!-- END .sub_box -->

      <?php // モバイルサイズ用キャッチフレーズ ■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■ ?>
      <div class="sub_box cf">
       <h3 class="theme_option_subbox_headline"><?php _e('Content for mobile size', 'tcd-w'); ?></h3>
       <div class="sub_box_content">

        <?php //コンテンツの設定 -------------------------- ?>
        <h4 class="theme_option_headline2"><?php _e( 'Content type', 'tcd-w' ); ?></h4>
        <div class="theme_option_message2" style="margin-top:15px;">
         <p><?php _e( 'This content will be replaced by content above when the web browser become mobile size.', 'tcd-w' ); ?></p>
        </div>
        <ul class="design_radio_button">
         <?php foreach ( $index_slider_content_type_options as $option ) { ?>
         <li class="index_movie_mobile_content_<?php esc_attr_e( $option['value'] ); ?>_button">
          <input type="radio" id="index_movie_mobile_content_type_<?php esc_attr_e( $option['value'] ); ?>" name="dp_options[index_movie_mobile_content_type]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $options['index_movie_mobile_content_type'], $option['value'] ); ?> />
          <label for="index_movie_mobile_content_type_<?php esc_attr_e( $option['value'] ); ?>"><?php echo $option['label']; ?></label>
         </li>
         <?php } ?>
        </ul>

        <div id="index_movie_mobile_content_type2_area" style="<?php if($options['index_movie_mobile_content_type'] == 'type2') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">

         <?php // キャッチフレーズ ----------------------- ?>
         <h4 class="theme_option_headline2"><?php _e( 'Catchphrase', 'tcd-w' ); ?></h4>
         <textarea class="large-text" cols="50" rows="3" name="dp_options[index_movie_catch_mobile]"><?php echo esc_textarea(  $options['index_movie_catch_mobile'] ); ?></textarea>
         <ul class="option_list">
          <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w'); ?></span>
          <?php echo UI\font_select( 'dp_options[index_movie_catch_font_type_mobile]', $options['index_movie_catch_font_type_mobile'] ); ?>
         </li>
          <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[index_movie_mobile_catch_font_size]" value="<?php echo esc_attr( $options['index_movie_mobile_catch_font_size'] ); ?>" /><span>px</span></li>
          <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[index_movie_catch_color_mobile]" value="<?php echo esc_attr( $options['index_movie_catch_color_mobile'] ); ?>" data-default-color="#FFFFFF" class="c-color-picker"></li>
         </ul>

         <?php // テキストシャドウ ----------------------- ?>
         <h4 class="theme_option_headline2"><?php _e( 'Dropshadow', 'tcd-w' ); ?></h4>
         <p class="displayment_checkbox"><label><input name="dp_options[index_movie_use_shadow_mobile]" type="checkbox" value="1" <?php checked( $options['index_movie_use_shadow_mobile'], 1 ); ?>><?php _e( 'Use dropshadow on text content', 'tcd-w' ); ?></label></p>
         <div style="<?php if($options['index_movie_use_shadow_mobile'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
          <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
           <li class="cf"><span class="label"><?php _e('Dropshadow position (left)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[index_movie_shadow_h_mobile]" value="<?php echo esc_attr( $options['index_movie_shadow_h_mobile'] ); ?>"><span>px</span></li>
           <li class="cf"><span class="label"><?php _e('Dropshadow position (top)', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[index_movie_shadow_v_mobile]" value="<?php echo esc_attr( $options['index_movie_shadow_v_mobile'] ); ?>"><span>px</span></li>
           <li class="cf"><span class="label"><?php _e('Dropshadow size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[index_movie_shadow_b_mobile]" value="<?php echo esc_attr( $options['index_movie_shadow_b_mobile'] ); ?>"><span>px</span></li>
           <li class="cf"><span class="label"><?php _e('Dropshadow color', 'tcd-w'); ?></span><input type="text" name="dp_options[index_movie_shadow_c_mobile]" value="<?php echo esc_attr( $options['index_movie_shadow_c_mobile'] ); ?>" data-default-color="#888888" class="c-color-picker"></li>
          </ul>
         </div>

         <ul class="button_list cf">
          <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
          <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
         </ul>

        </div><!-- END use same setting -->

       </div><!-- END .sub_box_content -->
      </div><!-- END .sub_box -->

     </div><!-- END index_movie_content -->

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>

    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->
   <?php // ヘッダーコンテンツここまで -- ?>


   <?php // ボックスコンテンツの設定 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Box contents', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content tab_parent">

     <h4 class="theme_option_headline2"><?php _e('Basic setting', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'index_box_content_title_font_size'); ?></li>
      <li class="cf"><span class="label"><?php _e('Font color of title', 'tcd-w'); ?></span><input type="text" name="dp_options[index_box_content_title_font_color]" value="<?php echo esc_attr( $options['index_box_content_title_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Background color of title', 'tcd-w'); ?></span><input class="c-color-picker" type="text" name="dp_options[index_box_content_title_bg_color]" value="<?php echo esc_attr( $options['index_box_content_title_bg_color'] ); ?>" data-default-color="#341e09"></li>
      <li class="cf">
       <span class="label"><?php _e('Transparency of background color', 'tcd-w'); ?></span>
       <input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[index_box_content_title_bg_opacity]" value="<?php echo esc_attr( $options['index_box_content_title_bg_opacity'] ); ?>" />
       <div class="theme_option_message2">
        <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
       </div>
      </li>
      <li class="cf"><span class="label"><?php _e('Font size of description', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'index_box_content_desc_font_size'); ?></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Content', 'tcd-w');  ?></h4>

     <div class="sub_box_tab">
      <div class="tab active" data-tab="tab1"><?php _e('Content', 'tcd-w'); ?>1</div>
      <div class="tab" data-tab="tab2"><?php _e('Content', 'tcd-w'); ?>2</div>
      <div class="tab" data-tab="tab3"><?php _e('Content', 'tcd-w'); ?>3</div>
     </div>

     <?php for($i = 1; $i <= 3; $i++) : ?>
     <div class="sub_box_tab_content<?php if($i == 1){ echo ' active'; }; ?>" data-tab-content="tab<?php echo $i; ?>">

       <ul class="option_list">
        <li class="cf"><span class="label"><?php _e('Title', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[index_box_content_title<?php echo $i; ?>]" value="<?php esc_attr_e( $options['index_box_content_title'.$i] ); ?>" /></li>
        <li class="cf"><span class="label"><?php _e('Description', 'tcd-w'); ?></span><textarea class="full_width" cols="50" rows="2" name="dp_options[index_box_content_desc<?php echo $i; ?>]"><?php echo esc_textarea( $options['index_box_content_desc'.$i] ); ?></textarea></li>
        <li class="cf">
         <span class="label">
          <?php _e('Image', 'tcd-w'); ?>
          <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '480', '300'); ?></span>
         </span>
         <div class="image_box cf">
          <div class="cf cf_media_field hide-if-no-js index_box_content_image<?php echo $i; ?>">
           <input type="hidden" value="<?php echo esc_attr( $options['index_box_content_image'.$i] ); ?>" id="index_box_content_image<?php echo $i; ?>" name="dp_options[index_box_content_image<?php echo $i; ?>]" class="cf_media_id">
           <div class="preview_field"><?php if($options['index_box_content_image'.$i]){ echo wp_get_attachment_image($options['index_box_content_image'.$i], 'medium'); }; ?></div>
           <div class="buttton_area">
            <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
            <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['index_box_content_image'.$i]){ echo 'hidden'; }; ?>">
           </div>
          </div>
         </div>
        </li>
        <li class="cf"><span class="label"><?php _e('URL', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[index_box_content_url<?php echo $i; ?>]" value="<?php esc_attr_e( $options['index_box_content_url'.$i] ); ?>" /></li>
       </ul>

     </div>
     <?php endfor; ?>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>

    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // コンテンツビルダー ■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■ ?>
   <div class="theme_option_field theme_option_field_ac open active show_arrow">
    <h3 class="theme_option_headline"><?php _e('Content builder', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <div class="theme_option_message no_arrow">
      <?php echo __( '<p>You can build contents freely with this function.</p><br /><p>STEP1: Click Add content button.<br />STEP2: Select content from dropdown menu.<br />STEP3: Input data and save the option.</p><br /><p>You can change order by dragging MOVE button and you can delete content by clicking DELETE button.</p>', 'tcd-w' ); ?>
     </div>
     <h4 class="theme_option_headline2"><?php _e( 'Content image', 'tcd-w' ); ?></h4>
     <ul class="design_button_list cf rebox_group">
      <li><a href="<?php bloginfo('template_url'); ?>/admin/img/cb_content1.jpg" title="<?php _e( 'Designed content', 'tcd-w' ); ?>1"><?php _e( 'Designed content', 'tcd-w' ); ?>1</a></li>
      <li><a href="<?php bloginfo('template_url'); ?>/admin/img/cb_content2.jpg" title="<?php _e( 'Designed content', 'tcd-w' ); ?>2"><?php _e( 'Designed content', 'tcd-w' ); ?>2</a></li>
      <li><a href="<?php bloginfo('template_url'); ?>/admin/img/cb_content3.jpg" title="<?php _e( 'Carousel content', 'tcd-w' ); ?>"><?php _e( 'Carousel content', 'tcd-w' ); ?></a></li>
      <li><a href="<?php bloginfo('template_url'); ?>/admin/img/cb_content4.jpg" title="<?php _e( 'Content list1 (Image + Title)', 'tcd-w'); ?>"><?php _e( 'Content list1 (Image + Title)', 'tcd-w'); ?></a></li>
      <li><a href="<?php bloginfo('template_url'); ?>/admin/img/cb_content5.jpg" title="<?php _e( 'Content list2 (Title + Date)', 'tcd-w'); ?>"><?php _e( 'Content list2 (Title + Date)', 'tcd-w'); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->

   <div id="contents_builder_wrap">
    <div id="contents_builder">
     <p class="cb_message"><?php _e( 'Click Add content button to start content builder', 'tcd-w' ); ?></p>
     <?php
          if (!empty($options['contents_builder'])) {
            foreach($options['contents_builder'] as $key => $content) :
              $cb_index = 'cb_'.$key.'_'.mt_rand(0,999999);
     ?>
     <div class="cb_row">
      <ul class="cb_button cf">
       <li><span class="cb_move"><?php echo __('Move', 'tcd-w'); ?></span></li>
       <li><span class="cb_delete"><?php echo __('Delete', 'tcd-w'); ?></span></li>
      </ul>
      <div class="cb_column_area cf">
       <div class="cb_column">
        <input type="hidden" class="cb_index" value="<?php echo $cb_index; ?>" />
        <?php the_cb_content_select($cb_index, $content['cb_content_select']); ?>
        <?php if (!empty($content['cb_content_select'])) the_cb_content_setting($cb_index, $content['cb_content_select'], $content); ?>
       </div>
      </div><!-- END .cb_column_area -->
     </div><!-- END .cb_row -->
     <?php
          endforeach;
         };
     ?>
    </div><!-- END #contents_builder -->
    <ul class="button_list cf" id="cb_add_row_buttton_area">
     <li><input type="button" value="<?php echo __( 'Add content', 'tcd-w' ); ?>" class="button-ml add_row"></li>
     <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
    </ul>
   </div><!-- END #contents_builder_wrap -->

   <?php // コンテンツビルダー追加用 非表示 ?>
   <div id="contents_builder-clone" class="hidden">
    <div class="cb_row">
     <ul class="cb_button cf">
      <li><span class="cb_move"><?php echo __('Move', 'tcd-w'); ?></span></li>
      <li><span class="cb_delete"><?php echo __('Delete', 'tcd-w'); ?></span></li>
     </ul>
     <div class="cb_column_area cf">
      <div class="cb_column">
       <input type="hidden" class="cb_index" value="cb_cloneindex" />
       <?php the_cb_content_select('cb_cloneindex'); ?>
      </div>
     </div><!-- END .cb_column_area -->
    </div><!-- END .cb_row -->
    <?php
         the_cb_content_setting('cb_cloneindex', 'design_content1');
         the_cb_content_setting('cb_cloneindex', 'design_content2');
         the_cb_content_setting('cb_cloneindex', 'campaign_list');
         the_cb_content_setting('cb_cloneindex', 'recent_blog_list');
         the_cb_content_setting('cb_cloneindex', 'news_list');
         the_cb_content_setting('cb_cloneindex', 'free_space');
    ?>
   </div><!-- END #contents_builder-clone.hidden -->
   <?php // コンテンツビルダーここまで ■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■ ?>


</div><!-- END .tab-content -->

<?php
} // END add_front_page_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_front_page_theme_options_validate( $input ) {

  global $dp_default_options, $index_content_type_options, $time_options, $font_type_options, $content_direction_options, $index_slider_content_type_options, $slider_animation_options, $index_slider_content_type_options;

  // ヘッダーコンテンツ
  if ( ! isset( $input['index_header_content_type'] ) )
    $input['index_header_content_type'] = null;
  if ( ! array_key_exists( $input['index_header_content_type'], $index_content_type_options ) )
    $input['index_header_content_type'] = null;

  // 画像スライダーの時間
  if ( ! isset( $value['index_slider_time'] ) )
    $value['index_slider_time'] = null;
  if ( ! array_key_exists( $value['index_slider_time'], $time_options ) )
    $value['index_slider_time'] = null;

  // 画像スライダー
  for ( $i = 1; $i <= 3; $i++ ) {
    // 画像の設定
    $input['index_slider_image'.$i] = wp_filter_nohtml_kses( $input['index_slider_image'.$i] );
    $input['index_slider_image_mobile'.$i] = wp_filter_nohtml_kses( $input['index_slider_image_mobile'.$i] );

    // キャッチフレーズ
    $input['index_slider_catch'.$i] = wp_filter_nohtml_kses( $input['index_slider_catch'.$i] );
    $value['index_slider_catch_font_type'.$i] = San\choice( $value['index_slider_catch_font_type'.$i], [ '1', '2', '3' ] );

    $input['index_slider_catch_font_size'.$i] = wp_filter_nohtml_kses( $input['index_slider_catch_font_size'.$i] );
    $input['index_slider_catch_font_size_mobile'.$i] = wp_filter_nohtml_kses( $input['index_slider_catch_font_size_mobile'.$i] );
    $input['index_slider_catch_color'.$i] = wp_filter_nohtml_kses( $input['index_slider_catch_color'.$i] );

    // 説明文
    $input['index_slider_desc'.$i] = wp_filter_nohtml_kses( $input['index_slider_desc'.$i] );
    $input['index_slider_desc_font_size'.$i] = wp_filter_nohtml_kses( $input['index_slider_desc_font_size'.$i] );
    $input['index_slider_desc_font_size_mobile'.$i] = wp_filter_nohtml_kses( $input['index_slider_desc_font_size_mobile'.$i] );
    $input['index_slider_desc_color'.$i] = wp_filter_nohtml_kses( $input['index_slider_desc_color'.$i] );

    // テキストシャドウ
    if ( ! isset( $input['index_slider_use_shadow'.$i] ) )
      $input['index_slider_use_shadow'.$i] = null;
      $input['index_slider_use_shadow'.$i] = ( $input['index_slider_use_shadow'.$i] == 1 ? 1 : 0 );
    $input['index_slider_shadow_h'.$i] = wp_filter_nohtml_kses( $input['index_slider_shadow_h'.$i] );
    $input['index_slider_shadow_v'.$i] = wp_filter_nohtml_kses( $input['index_slider_shadow_v'.$i] );
    $input['index_slider_shadow_b'.$i] = wp_filter_nohtml_kses( $input['index_slider_shadow_b'.$i] );
    $input['index_slider_shadow_c'.$i] = wp_filter_nohtml_kses( $input['index_slider_shadow_c'.$i] );

    // ボタン
    if ( ! isset( $input['index_slider_show_button'.$i] ) )
      $input['index_slider_show_button'.$i] = null;
      $input['index_slider_show_button'.$i] = ( $input['index_slider_show_button'.$i] == 1 ? 1 : 0 );
    $input['index_slider_button_label'.$i] = wp_filter_nohtml_kses( $input['index_slider_button_label'.$i] );
    $input['index_slider_button_border_color'.$i] = wp_filter_nohtml_kses( $input['index_slider_button_border_color'.$i] );
    $input['index_slider_button_border_opacity'.$i] = wp_filter_nohtml_kses( $input['index_slider_button_border_opacity'.$i] );
    $input['index_slider_button_font_color'.$i] = wp_filter_nohtml_kses( $input['index_slider_button_font_color'.$i] );
    $input['index_slider_button_border_color_hover'.$i] = wp_filter_nohtml_kses( $input['index_slider_button_border_color_hover'.$i] );
    $input['index_slider_button_font_color_hover'.$i] = wp_filter_nohtml_kses( $input['index_slider_button_font_color_hover'.$i] );
    $input['index_slider_url'.$i] = wp_filter_nohtml_kses( $input['index_slider_url'.$i] );
    if ( ! isset( $input['index_slider_target'.$i] ) )
      $input['index_slider_target'.$i] = null;
      $input['index_slider_target'.$i] = ( $input['index_slider_target'.$i] == 1 ? 1 : 0 );

    // オーバーレイ
    if ( ! isset( $input['index_slider_use_overlay'.$i] ) )
      $input['index_slider_use_overlay'.$i] = null;
      $input['index_slider_use_overlay'.$i] = ( $input['index_slider_use_overlay'.$i] == 1 ? 1 : 0 );
    $input['index_slider_overlay_color'.$i] = wp_filter_nohtml_kses( $input['index_slider_overlay_color'.$i] );
    $input['index_slider_overlay_opacity'.$i] = wp_filter_nohtml_kses( $input['index_slider_overlay_opacity'.$i] );
    if ( ! isset( $input['index_slider_use_overlay_mobile'.$i] ) )
      $input['index_slider_use_overlay_mobile'.$i] = null;
      $input['index_slider_use_overlay_mobile'.$i] = ( $input['index_slider_use_overlay_mobile'.$i] == 1 ? 1 : 0 );
    $input['index_slider_overlay_color_mobile'.$i] = wp_filter_nohtml_kses( $input['index_slider_overlay_color_mobile'.$i] );
    $input['index_slider_overlay_opacity_mobile'.$i] = wp_filter_nohtml_kses( $input['index_slider_overlay_opacity_mobile'.$i] );

    // アニメーションのタイプ
    if ( ! isset( $value['index_slider_animation_type'.$i] ) )
      $value['index_slider_animation_type'.$i] = null;
    if ( ! array_key_exists( $value['index_slider_animation_type'.$i], $slider_animation_options ) )
      $value['index_slider_animation_type'.$i] = null;

    // コンテンツの方向
    if ( ! isset( $value['index_slider_content_direction'.$i] ) )
      $value['index_slider_content_direction'.$i] = null;
    if ( ! array_key_exists( $value['index_slider_content_direction'.$i], $content_direction_options ) )
      $value['index_slider_content_direction'.$i] = null;

  }

  // 画像スライダー　スマホ用　コンテンツのタイプ
  if ( ! isset( $value['index_slider_mobile_content_type'] ) )
    $value['index_slider_mobile_content_type'] = null;
  if ( ! array_key_exists( $value['index_slider_mobile_content_type'], $index_slider_content_type_options ) )
    $value['index_slider_mobile_content_type'] = null;

  // 画像スライダー　スマホ用　キャッチフレーズ
  $input['index_slider_mobile_catch'] = wp_filter_nohtml_kses( $input['index_slider_mobile_catch'] );
  $value['index_slider_mobile_catch_font_type'] = San\choice( $value['index_slider_mobile_catch_font_type'], [ '1', '2', '3' ] );

  $input['index_slider_mobile_catch_font_size'] = wp_filter_nohtml_kses( $input['index_slider_mobile_catch_font_size'] );
  $input['index_slider_mobile_catch_color'] = wp_filter_nohtml_kses( $input['index_slider_mobile_catch_color'] );

  // 説明文
  $input['index_slider_mobile_desc'] = wp_filter_nohtml_kses( $input['index_slider_mobile_desc'] );
  $input['index_slider_mobile_desc_font_size'] = wp_filter_nohtml_kses( $input['index_slider_mobile_desc_font_size'] );
  $input['index_slider_mobile_desc_color'] = wp_filter_nohtml_kses( $input['index_slider_mobile_desc_color'] );

  // ボタン
  if ( ! isset( $input['index_slider_mobile_show_button'] ) )
    $input['index_slider_mobile_show_button'] = null;
    $input['index_slider_mobile_show_button'] = ( $input['index_slider_mobile_show_button'] == 1 ? 1 : 0 );
  $input['index_slider_mobile_button_label'] = wp_filter_nohtml_kses( $input['index_slider_mobile_button_label'] );
  $input['index_slider_mobile_button_border_color'] = wp_filter_nohtml_kses( $input['index_slider_mobile_button_border_color'] );
  $input['index_slider_mobile_button_border_opacity'] = wp_filter_nohtml_kses( $input['index_slider_mobile_button_border_opacity'] );
  $input['index_slider_mobile_button_font_color'] = wp_filter_nohtml_kses( $input['index_slider_mobile_button_font_color'] );
  $input['index_slider_mobile_button_border_color_hover'] = wp_filter_nohtml_kses( $input['index_slider_mobile_button_border_color_hover'] );
  $input['index_slider_mobile_button_font_color_hover'] = wp_filter_nohtml_kses( $input['index_slider_mobile_button_font_color_hover'] );
  $input['index_slider_mobile_url'] = wp_filter_nohtml_kses( $input['index_slider_mobile_url'] );
  if ( ! isset( $input['index_slider_mobile_target'] ) )
    $input['index_slider_mobile_target'] = null;
    $input['index_slider_mobile_target'] = ( $input['index_slider_mobile_target'] == 1 ? 1 : 0 );

  // 画像スライダー　スマホ用　ロゴ
  $input['index_slider_mobile_logo_image'] = absint( $input['index_slider_mobile_logo_image'] );
  $input['index_slider_mobile_logo_image_width'] = absint( $input['index_slider_mobile_logo_image_width'] );

  // 画像スライダー　スマホ用　テキストシャドウ
  if ( ! isset( $input['index_slider_mobile_use_shadow'] ) )
    $input['index_slider_mobile_use_shadow'] = null;
    $input['index_slider_mobile_use_shadow'] = ( $input['index_slider_mobile_use_shadow'] == 1 ? 1 : 0 );
  $input['index_slider_mobile_shadow_h'] = wp_filter_nohtml_kses( $input['index_slider_mobile_shadow_h'] );
  $input['index_slider_mobile_shadow_v'] = wp_filter_nohtml_kses( $input['index_slider_mobile_shadow_v'] );
  $input['index_slider_mobile_shadow_b'] = wp_filter_nohtml_kses( $input['index_slider_mobile_shadow_b'] );
  $input['index_slider_mobile_shadow_c'] = wp_filter_nohtml_kses( $input['index_slider_mobile_shadow_c'] );

  // 動画 ----------------------------------------------------------------
  $input['index_video'] = wp_filter_nohtml_kses( $input['index_video'] );

  // Youtube --------------------------------------------------------------
  $input['index_youtube_url'] = wp_filter_nohtml_kses( $input['index_youtube_url'] );

  // 動画用コンテンツ PC用 -----------------------------------------------------
  // 代替画像
  $input['index_movie_image'] = wp_filter_nohtml_kses( $input['index_movie_image'] );

  // キャッチフレーズ
  $input['index_movie_catch'] = wp_filter_nohtml_kses( $input['index_movie_catch'] );
  $value['index_movie_catch_font_type'] = San\choice( $value['index_movie_catch_font_type'], [ '1', '2', '3' ] );
  $input['index_movie_catch_font_size'] = wp_filter_nohtml_kses( $input['index_movie_catch_font_size'] );
  $input['index_movie_catch_font_size_mobile'] = wp_filter_nohtml_kses( $input['index_movie_catch_font_size_mobile'] );
  $input['index_movie_catch_color'] = wp_filter_nohtml_kses( $input['index_movie_catch_color'] );

  // 説明文
  $input['index_movie_desc'] = wp_filter_nohtml_kses( $input['index_movie_desc'] );
  $input['index_movie_desc_font_size'] = wp_filter_nohtml_kses( $input['index_movie_desc_font_size'] );
  $input['index_movie_desc_font_size_mobile'] = wp_filter_nohtml_kses( $input['index_movie_desc_font_size_mobile'] );
  $input['index_movie_desc_color'] = wp_filter_nohtml_kses( $input['index_movie_desc_color'] );

  // テキストシャドウ
  if ( ! isset( $input['index_movie_use_shadow'] ) )
    $input['index_movie_use_shadow'] = null;
    $input['index_movie_use_shadow'] = ( $input['index_movie_use_shadow'] == 1 ? 1 : 0 );
  $input['index_movie_shadow_h'] = wp_filter_nohtml_kses( $input['index_movie_shadow_h'] );
  $input['index_movie_shadow_v'] = wp_filter_nohtml_kses( $input['index_movie_shadow_v'] );
  $input['index_movie_shadow_b'] = wp_filter_nohtml_kses( $input['index_movie_shadow_b'] );
  $input['index_movie_shadow_c'] = wp_filter_nohtml_kses( $input['index_movie_shadow_c'] );

  // ボタン
  if ( ! isset( $input['index_movie_show_button'] ) )
    $input['index_movie_show_button'] = null;
    $input['index_movie_show_button'] = ( $input['index_movie_show_button'] == 1 ? 1 : 0 );
  $input['index_movie_button_label'] = wp_filter_nohtml_kses( $input['index_movie_button_label'] );
  $input['index_movie_button_font_color'] = wp_filter_nohtml_kses( $input['index_movie_button_font_color'] );
  $input['index_movie_button_border_color'] = wp_filter_nohtml_kses( $input['index_movie_button_border_color'] );
  $input['index_movie_button_border_opacity'] = wp_filter_nohtml_kses( $input['index_movie_button_border_opacity'] );
  $input['index_movie_button_font_color_hover'] = wp_filter_nohtml_kses( $input['index_movie_button_font_color_hover'] );
  $input['index_movie_button_bg_color_hover'] = wp_filter_nohtml_kses( $input['index_movie_button_bg_color_hover'] );
  $input['index_movie_button_border_color_hover'] = wp_filter_nohtml_kses( $input['index_movie_button_border_color_hover'] );
  $input['index_movie_url'] = wp_filter_nohtml_kses( $input['index_movie_url'] );
  if ( ! isset( $input['index_movie_target'] ) )
    $input['index_movie_target'] = null;
    $input['index_movie_target'] = ( $input['index_movie_target'] == 1 ? 1 : 0 );

  // オーバーレイ
  if ( ! isset( $input['index_movie_use_overlay'] ) )
    $input['index_movie_use_overlay'] = null;
    $input['index_movie_use_overlay'] = ( $input['index_movie_use_overlay'] == 1 ? 1 : 0 );
  $input['index_movie_overlay_color'] = wp_filter_nohtml_kses( $input['index_movie_overlay_color'] );
  $input['index_movie_overlay_opacity'] = wp_filter_nohtml_kses( $input['index_movie_overlay_opacity'] );

  // 動画用コンテンツ スマホ用 -----------------------------------------------------
  if ( ! isset( $value['index_movie_mobile_content_type'] ) )
    $value['index_movie_mobile_content_type'] = null;
  if ( ! array_key_exists( $value['index_movie_mobile_content_type'], $index_slider_content_type_options ) )
    $value['index_movie_mobile_content_type'] = null;

  // キャッチフレーズ
  $input['index_movie_catch_mobile'] = wp_filter_nohtml_kses( $input['index_movie_catch_mobile'] );
  $value['index_movie_catch_font_type_mobile'] = San\choice( $value['index_movie_catch_font_type_mobile'], [ '1', '2', '3' ] );

  $input['index_movie_mobile_catch_font_size'] = wp_filter_nohtml_kses( $input['index_movie_mobile_catch_font_size'] );
  $input['index_movie_catch_color_mobile'] = wp_filter_nohtml_kses( $input['index_movie_catch_color_mobile'] );

  // テキストシャドウ
  if ( ! isset( $input['index_movie_use_shadow_mobile'] ) )
    $input['index_movie_use_shadow_mobile'] = null;
    $input['index_movie_use_shadow_mobile'] = ( $input['index_movie_use_shadow_mobile'] == 1 ? 1 : 0 );
  $input['index_movie_shadow_h_mobile'] = wp_filter_nohtml_kses( $input['index_movie_shadow_h_mobile'] );
  $input['index_movie_shadow_v_mobile'] = wp_filter_nohtml_kses( $input['index_movie_shadow_v_mobile'] );
  $input['index_movie_shadow_b_mobile'] = wp_filter_nohtml_kses( $input['index_movie_shadow_b_mobile'] );
  $input['index_movie_shadow_c_mobile'] = wp_filter_nohtml_kses( $input['index_movie_shadow_c_mobile'] );


  // ボックスコンテンツの設定
  $input['index_box_content_title_font_size'] = wp_filter_nohtml_kses( $input['index_box_content_title_font_size'] );
  $input['index_box_content_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['index_box_content_title_font_size_mobile'] );
  $input['index_box_content_title_font_color'] = wp_filter_nohtml_kses( $input['index_box_content_title_font_color'] );
  $input['index_box_content_title_bg_color'] = wp_filter_nohtml_kses( $input['index_box_content_title_bg_color'] );
  $input['index_box_content_title_bg_opacity'] = wp_filter_nohtml_kses( $input['index_box_content_title_bg_opacity'] );
  $input['index_box_content_desc_font_size'] = wp_filter_nohtml_kses( $input['index_box_content_desc_font_size'] );
  $input['index_box_content_desc_font_size_mobile'] = wp_filter_nohtml_kses( $input['index_box_content_desc_font_size_mobile'] );
  for ( $i = 1; $i <= 3; $i++ ) {
    $input['index_box_content_image'.$i] = wp_filter_nohtml_kses( $input['index_box_content_image'.$i] );
    $input['index_box_content_title'.$i] = wp_filter_nohtml_kses( $input['index_box_content_title'.$i] );
    $input['index_box_content_desc'.$i] = wp_filter_nohtml_kses( $input['index_box_content_desc'.$i] );
    $input['index_box_content_url'.$i] = wp_filter_nohtml_kses( $input['index_box_content_url'.$i] );
  }


  // コンテンツビルダー -----------------------------------------------------------------------------
  if (!empty($input['contents_builder'])) {

    $input_cb = $input['contents_builder'];
    $input['contents_builder'] = array();

    foreach($input_cb as $key => $value) {

      // クローン用はスルー
      //if (in_array($key, array('cb_cloneindex', 'cb_cloneindex2'))) continue;
      if (in_array($key, array('cb_cloneindex', 'cb_cloneindex2'), true)) continue;

      // デザインコンテンツ1 -----------------------------------------------------------------------
      if ($value['cb_content_select'] == 'design_content1') {

        if ( ! isset( $value['show_dc1'] ) )
          $value['show_dc1'] = null;
          $value['show_dc1'] = ( $value['show_dc1'] == 1 ? 1 : 0 );

        $value['dc1_image_type'] = wp_filter_nohtml_kses( $value['dc1_image_type'] );

        $value['dc1_image1'] = wp_filter_nohtml_kses( $value['dc1_image1'] );
        $value['dc1_image2'] = wp_filter_nohtml_kses( $value['dc1_image2'] );
        $value['dc1_image3'] = wp_filter_nohtml_kses( $value['dc1_image3'] );

        $value['dc1_catch'] = wp_filter_nohtml_kses( $value['dc1_catch'] );
        $value['dc1_catch_font_size'] = wp_filter_nohtml_kses( $value['dc1_catch_font_size'] );
        $value['dc1_catch_font_size_mobile'] = wp_filter_nohtml_kses( $value['dc1_catch_font_size_mobile'] );
        $value['dc1_catch_font_color'] = wp_filter_nohtml_kses( $value['dc1_catch_font_color'] );

        $value['dc1_desc'] = wp_filter_nohtml_kses( $value['dc1_desc'] );
        $value['dc1_desc_font_size'] = wp_filter_nohtml_kses( $value['dc1_desc_font_size'] );
        $value['dc1_desc_font_size_mobile'] = wp_filter_nohtml_kses( $value['dc1_desc_font_size_mobile'] );

        if ( ! isset( $value['show_dc1_button'] ) )
          $value['show_dc1_button'] = null;
          $value['show_dc1_button'] = ( $value['show_dc1_button'] == 1 ? 1 : 0 );
        $value['dc1_button_label'] = wp_filter_nohtml_kses( $value['dc1_button_label'] );
        $value['dc1_button_url'] = wp_filter_nohtml_kses( $value['dc1_button_url'] );
        $value['dc1_button_font_color'] = wp_filter_nohtml_kses( $value['dc1_button_font_color'] );
        $value['dc1_button_border_color'] = wp_filter_nohtml_kses( $value['dc1_button_border_color'] );
        $value['dc1_button_font_color_hover'] = wp_filter_nohtml_kses( $value['dc1_button_font_color_hover'] );
        $value['dc1_button_bg_color_hover'] = wp_filter_nohtml_kses( $value['dc1_button_bg_color_hover'] );
        $value['dc1_button_border_color_hover'] = wp_filter_nohtml_kses( $value['dc1_button_border_color_hover'] );
		    if ( ! isset( $value['dc1_button_target'] ) )
		      $value['dc1_button_target'] = null;
		      $value['dc1_button_target'] = ( $value['dc1_button_target'] == 1 ? 1 : 0 );




      // デザインコンテンツ2 -----------------------------------------------------------------------
      } elseif ($value['cb_content_select'] == 'design_content2') {

        if ( ! isset( $value['show_dc2'] ) )
          $value['show_dc2'] = null;
          $value['show_dc2'] = ( $value['show_dc2'] == 1 ? 1 : 0 );

        $value['dc2_catch'] = wp_filter_nohtml_kses( $value['dc2_catch'] );
        $value['dc2_catch_font_size'] = wp_filter_nohtml_kses( $value['dc2_catch_font_size'] );
        $value['dc2_catch_font_size_mobile'] = wp_filter_nohtml_kses( $value['dc2_catch_font_size_mobile'] );
        $value['dc2_catch_font_color'] = wp_filter_nohtml_kses( $value['dc2_catch_font_color'] );

        $value['dc2_desc'] = wp_filter_nohtml_kses( $value['dc2_desc'] );
        $value['dc2_desc_font_size'] = wp_filter_nohtml_kses( $value['dc2_desc_font_size'] );
        $value['dc2_desc_font_size_mobile'] = wp_filter_nohtml_kses( $value['dc2_desc_font_size_mobile'] );

        $value['dc2_banner_headline'] = wp_filter_nohtml_kses( $value['dc2_banner_headline'] );
        $value['dc2_banner_headline_font_size'] = wp_filter_nohtml_kses( $value['dc2_banner_headline_font_size'] );
        $value['dc2_banner_headline_font_size_mobile'] = wp_filter_nohtml_kses( $value['dc2_banner_headline_font_size_mobile'] );

        $value['dc2_banner_sub_title'] = wp_filter_nohtml_kses( $value['dc2_banner_sub_title'] );
        $value['dc2_banner_sub_title_font_size'] = wp_filter_nohtml_kses( $value['dc2_banner_sub_title_font_size'] );
        $value['dc2_banner_sub_title_font_size_mobile'] = wp_filter_nohtml_kses( $value['dc2_banner_sub_title_font_size_mobile'] );

        $value['dc2_banner_desc'] = wp_filter_nohtml_kses( $value['dc2_banner_desc'] );
        $value['dc2_banner_desc_font_size'] = wp_filter_nohtml_kses( $value['dc2_banner_desc_font_size'] );
        $value['dc2_banner_desc_font_size_mobile'] = wp_filter_nohtml_kses( $value['dc2_banner_desc_font_size_mobile'] );

        $value['dc2_banner_image'] = wp_filter_nohtml_kses( $value['dc2_banner_image'] );
        if ( ! isset( $value['dc2_banner_use_overlay'] ) )
          $value['dc2_banner_use_overlay'] = null;
          $value['dc2_banner_use_overlay'] = ( $value['dc2_banner_use_overlay'] == 1 ? 1 : 0 );
        $value['dc2_banner_overlay_color'] = wp_filter_nohtml_kses( $value['dc2_banner_overlay_color'] );
        $value['dc2_banner_overlay_opacity'] = wp_filter_nohtml_kses( $value['dc2_banner_overlay_opacity'] );
        $value['dc2_banner_font_color'] = wp_filter_nohtml_kses( $value['dc2_banner_font_color'] );
        $value['dc2_banner_url'] = wp_filter_nohtml_kses( $value['dc2_banner_url'] );
		    if ( ! isset( $value['dc2_banner_target'] ) )
		      $value['dc2_banner_target'] = null;
		      $value['dc2_banner_target'] = ( $value['dc2_banner_target'] == 1 ? 1 : 0 );


      // キャンペーン一覧 -----------------------------------------------------------------------
      } elseif ($value['cb_content_select'] == 'campaign_list') {

        if ( ! isset( $value['show_campaign'] ) )
          $value['show_campaign'] = null;
          $value['show_campaign'] = ( $value['show_campaign'] == 1 ? 1 : 0 );

        $value['campaign_post_type'] = wp_filter_nohtml_kses( $value['campaign_post_type'] );

        $value['campaign_headline'] = wp_filter_nohtml_kses( $value['campaign_headline'] );
        $value['campaign_headline_font_size'] = wp_filter_nohtml_kses( $value['campaign_headline_font_size'] );
        $value['campaign_headline_font_size_mobile'] = wp_filter_nohtml_kses( $value['campaign_headline_font_size_mobile'] );

        $value['campaign_sub_title'] = wp_filter_nohtml_kses( $value['campaign_sub_title'] );
        $value['campaign_sub_title_font_size'] = wp_filter_nohtml_kses( $value['campaign_sub_title_font_size'] );
        $value['campaign_sub_title_font_size_mobile'] = wp_filter_nohtml_kses( $value['campaign_sub_title_font_size_mobile'] );

        $value['campaign_num'] = wp_filter_nohtml_kses( $value['campaign_num'] );

        $value['campaign_title_font_size'] = wp_filter_nohtml_kses( $value['campaign_title_font_size'] );
        $value['campaign_title_font_size_mobile'] = wp_filter_nohtml_kses( $value['campaign_title_font_size_mobile'] );

        $value['campaign_border_color'] = wp_filter_nohtml_kses( $value['campaign_border_color'] );
        $value['campaign_border_color_opacity'] = wp_filter_nohtml_kses( $value['campaign_border_color_opacity'] );

        if ( ! isset( $value['show_campaign_button'] ) )
          $value['show_campaign_button'] = null;
          $value['show_campaign_button'] = ( $value['show_campaign_button'] == 1 ? 1 : 0 );
        $value['campaign_button_label'] = wp_filter_nohtml_kses( $value['campaign_button_label'] );
        $value['campaign_button_font_color'] = wp_filter_nohtml_kses( $value['campaign_button_font_color'] );
        $value['campaign_button_border_color'] = wp_filter_nohtml_kses( $value['campaign_button_border_color'] );
        $value['campaign_button_border_opacity'] = wp_filter_nohtml_kses( $value['campaign_button_border_opacity'] );
        $value['campaign_button_font_color_hover'] = wp_filter_nohtml_kses( $value['campaign_button_font_color_hover'] );
        $value['campaign_button_bg_color_hover'] = wp_filter_nohtml_kses( $value['campaign_button_bg_color_hover'] );
        $value['campaign_button_border_color_hover'] = wp_filter_nohtml_kses( $value['campaign_button_border_color_hover'] );

        $value['campaign_bg_type'] = wp_filter_nohtml_kses( $value['campaign_bg_type'] );
        $value['campaign_video'] = wp_filter_nohtml_kses( $value['campaign_video'] );
        $value['campaign_video_image'] = wp_filter_nohtml_kses( $value['campaign_video_image'] );
        $value['campaign_image'] = wp_filter_nohtml_kses( $value['campaign_image'] );
        if ( ! isset( $value['campaign_use_overlay'] ) )
          $value['campaign_use_overlay'] = null;
          $value['campaign_use_overlay'] = ( $value['campaign_use_overlay'] == 1 ? 1 : 0 );
        $value['campaign_overlay_color'] = wp_filter_nohtml_kses( $value['campaign_overlay_color'] );
        $value['campaign_overlay_opacity'] = wp_filter_nohtml_kses( $value['campaign_overlay_opacity'] );


      // 新着ブログ -----------------------------------------------------------------------
      } elseif ($value['cb_content_select'] == 'recent_blog_list') {

        if ( ! isset( $value['show_blog'] ) )
          $value['show_blog'] = null;
          $value['show_blog'] = ( $value['show_blog'] == 1 ? 1 : 0 );

        $value['recent_blog_post_type'] = wp_filter_nohtml_kses( $value['recent_blog_post_type'] );

        $value['recent_blog_headline'] = wp_filter_nohtml_kses( $value['recent_blog_headline'] );
        $value['recent_blog_headline_font_size'] = wp_filter_nohtml_kses( $value['recent_blog_headline_font_size'] );
        $value['recent_blog_headline_font_size_mobile'] = wp_filter_nohtml_kses( $value['recent_blog_headline_font_size_mobile'] );

        $value['recent_blog_sub_title'] = wp_filter_nohtml_kses( $value['recent_blog_sub_title'] );
        $value['recent_blog_sub_title_font_size'] = wp_filter_nohtml_kses( $value['recent_blog_sub_title_font_size'] );
        $value['recent_blog_sub_title_font_size_mobile'] = wp_filter_nohtml_kses( $value['recent_blog_sub_title_font_size_mobile'] );

        $value['recent_blog_headline_font_color'] = wp_filter_nohtml_kses( $value['recent_blog_headline_font_color'] );

        $value['recent_blog_num'] = wp_filter_nohtml_kses( $value['recent_blog_num'] );

        $value['recent_blog_title_font_size'] = wp_filter_nohtml_kses( $value['recent_blog_title_font_size'] );
        $value['recent_blog_title_font_size_mobile'] = wp_filter_nohtml_kses( $value['recent_blog_title_font_size_mobile'] );

        if ( ! isset( $value['recent_blog_show_date'] ) )
          $value['recent_blog_show_date'] = null;
          $value['recent_blog_show_date'] = ( $value['recent_blog_show_date'] == 1 ? 1 : 0 );
        if ( ! isset( $value['recent_blog_show_category'] ) )
          $value['recent_blog_show_category'] = null;
          $value['recent_blog_show_category'] = ( $value['recent_blog_show_category'] == 1 ? 1 : 0 );

        if ( ! isset( $value['show_recent_blog_button'] ) )
          $value['show_recent_blog_button'] = null;
          $value['show_recent_blog_button'] = ( $value['show_recent_blog_button'] == 1 ? 1 : 0 );
        $value['recent_blog_button_label'] = wp_filter_nohtml_kses( $value['recent_blog_button_label'] );
        $value['recent_blog_button_font_color'] = wp_filter_nohtml_kses( $value['recent_blog_button_font_color'] );
        $value['recent_blog_button_border_color'] = wp_filter_nohtml_kses( $value['recent_blog_button_border_color'] );
        $value['recent_blog_button_font_color_hover'] = wp_filter_nohtml_kses( $value['recent_blog_button_font_color_hover'] );
        $value['recent_blog_button_bg_color_hover'] = wp_filter_nohtml_kses( $value['recent_blog_button_bg_color_hover'] );
        $value['recent_blog_button_border_color_hover'] = wp_filter_nohtml_kses( $value['recent_blog_button_border_color_hover'] );


      // お知らせ -----------------------------------------------------------------------
      } elseif ($value['cb_content_select'] == 'news_list') {

        if ( ! isset( $value['show_news'] ) )
          $value['show_news'] = null;
          $value['show_news'] = ( $value['show_news'] == 1 ? 1 : 0 );

        $value['news_post_type'] = wp_filter_nohtml_kses( $value['news_post_type'] );

        $value['news_headline'] = wp_filter_nohtml_kses( $value['news_headline'] );
        $value['news_headline_font_size'] = wp_filter_nohtml_kses( $value['news_headline_font_size'] );
        $value['news_headline_font_size_mobile'] = wp_filter_nohtml_kses( $value['news_headline_font_size_mobile'] );

        $value['news_sub_title'] = wp_filter_nohtml_kses( $value['news_sub_title'] );
        $value['news_sub_title_font_size'] = wp_filter_nohtml_kses( $value['news_sub_title_font_size'] );
        $value['news_sub_title_font_size_mobile'] = wp_filter_nohtml_kses( $value['news_sub_title_font_size_mobile'] );

        $value['news_headline_font_color'] = wp_filter_nohtml_kses( $value['news_headline_font_color'] );

        $value['news_num'] = wp_filter_nohtml_kses( $value['news_num'] );
        $value['news_date_color'] = wp_filter_nohtml_kses( $value['news_date_color'] );

        if ( ! isset( $value['show_news_button'] ) )
          $value['show_news_button'] = null;
          $value['show_news_button'] = ( $value['show_news_button'] == 1 ? 1 : 0 );
        $value['news_button_label'] = wp_filter_nohtml_kses( $value['news_button_label'] );
        $value['news_button_font_color'] = wp_filter_nohtml_kses( $value['news_button_font_color'] );
        $value['news_button_border_color'] = wp_filter_nohtml_kses( $value['news_button_border_color'] );
        $value['news_button_font_color_hover'] = wp_filter_nohtml_kses( $value['news_button_font_color_hover'] );
        $value['news_button_bg_color_hover'] = wp_filter_nohtml_kses( $value['news_button_bg_color_hover'] );
        $value['news_button_border_color_hover'] = wp_filter_nohtml_kses( $value['news_button_border_color_hover'] );


      //自由入力欄 -----------------------------------------------------------------------
      } elseif ($value['cb_content_select'] == 'free_space') {

        if ( ! isset( $value['show_free'] ) )
          $value['show_free'] = null;
          $value['show_free'] = ( $value['show_free'] == 1 ? 1 : 0 );

        if ( ! isset( $value['free_space'] )) {
          $value['free_space'] = null;
        } else {
          $value['free_space'] = $value['free_space'];
        }

      }

      $input['contents_builder'][] = $value;

    }

  } //コンテンツビルダーここまで -----------------------------------------------------------------------

  return $input;

};


/**
 * コンテンツビルダー用 コンテンツ選択プルダウン　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
 */
function the_cb_content_select($cb_index = 'cb_cloneindex', $selected = null) {

  $options = get_design_plus_option();

	$cb_content_select = array(
		'design_content1' => __('Designed content', 'tcd-w') . '1',
		'design_content2' => __('Designed content', 'tcd-w') . '2',
		'campaign_list' => __('Carousel content', 'tcd-w'),
		'recent_blog_list' => __('Content list', 'tcd-w') . '1',
		'news_list' => __('Content list', 'tcd-w') . '2',
		'free_space' => __('Free space', 'tcd-w')
	);

	if ($selected && isset($cb_content_select[$selected])) {
		$add_class = ' hidden';
	} else {
		$add_class = '';
	}

	$out = '<select name="dp_options[contents_builder]['.esc_attr($cb_index).'][cb_content_select]" class="cb_content_select'.$add_class.'">';
	$out .= '<option value="" style="padding-right: 10px;">'.__("Choose the content", "tcd-w").'</option>';

	foreach($cb_content_select as $key => $value) {
		$attr = '';
		if ($key == $selected) {
			$attr = ' selected="selected"';
		}
		$out .= '<option value="'.esc_attr($key).'"'.$attr.' style="padding-right: 10px;">'.esc_html($value).'</option>';
	}

	$out .= '</select>';

	echo $out; 
}

/**
 * コンテンツビルダー用 コンテンツ設定　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
 */
function the_cb_content_setting($cb_index = 'cb_cloneindex', $cb_content_select = null, $value = array()) {

  global $content_direction_options, $font_type_options;
  $options = get_design_plus_option();
  $campaign_label = $options['campaign_label'] ? esc_html( $options['campaign_label'] ) : __( 'Campaign', 'tcd-w' );
  $news_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-w' );

?>

<div class="cb_content_wrap cf <?php echo esc_attr($cb_content_select); ?>">

<?php
     // デザインコンテンツ1　-------------------------------------------------------------
     if ($cb_content_select == 'design_content1') {

       if (!isset($value['show_dc1'])) { $value['show_dc1'] = 1; }

       if (!isset($value['dc1_image_type'])) { $value['dc1_image_type'] = 'type3'; }

       if (!isset($value['dc1_image1'])) { $value['dc1_image1'] = false; }
       if (!isset($value['dc1_image2'])) { $value['dc1_image2'] = false; }
       if (!isset($value['dc1_image3'])) { $value['dc1_image3'] = false; }

       if (!isset($value['dc1_catch'])) { $value['dc1_catch'] = ''; }
       if (!isset($value['dc1_catch_font_size'])) { $value['dc1_catch_font_size'] = '38'; }
       if (!isset($value['dc1_catch_font_size_mobile'])) { $value['dc1_catch_font_size_mobile'] = '22'; }
       if (!isset($value['dc1_catch_font_color'])) { $value['dc1_catch_font_color'] = '#58330d'; }

       if (!isset($value['dc1_desc'])) { $value['dc1_desc'] = ''; }
       if (!isset($value['dc1_desc_font_size'])) { $value['dc1_desc_font_size'] = '16'; }
       if (!isset($value['dc1_desc_font_size_mobile'])) { $value['dc1_desc_font_size_mobile'] = '14'; }

       if (!isset($value['show_dc1_button'])) { $value['show_dc1_button'] = ''; }
       if (!isset($value['dc1_button_label'])) { $value['dc1_button_label'] = ''; }
       if (!isset($value['dc1_button_url'])) { $value['dc1_button_url'] = ''; }
       if (!isset($value['dc1_button_font_color'])) { $value['dc1_button_font_color'] = '#58330c'; }
       if (!isset($value['dc1_button_border_color'])) { $value['dc1_button_border_color'] = '#59340e'; }
       if (!isset($value['dc1_button_font_color_hover'])) { $value['dc1_button_font_color_hover'] = '#ffffff'; }
       if (!isset($value['dc1_button_bg_color_hover'])) { $value['dc1_button_bg_color_hover'] = '#472805'; }
       if (!isset($value['dc1_button_border_color_hover'])) { $value['dc1_button_border_color_hover'] = '#472805'; }

       if (!isset($value['dc1_button_target'])) { $value['dc1_button_target'] = 1; }

?>

  <h3 class="cb_content_headline"><?php _e('Designed content', 'tcd-w'); ?>1<span><?php if(!empty($value['dc1_catch'])){?>：<?php echo esc_textarea( strip_tags( $value['dc1_catch']) ); ?><?php } ?></span></h3>
  <div class="cb_content">

   <p><label><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][show_dc1]" type="checkbox" value="1" <?php checked( $value['show_dc1'], 1 ); ?>><?php _e('Display designed content', 'tcd-w'); ?></label></p>

   <h4 class="theme_option_headline2"><?php _e('Image list type', 'tcd-w');  ?></h4>
   <ul class="design_radio_button horizontal cf">
    <li>
     <input type="radio" class="dc1_image_type1" id="dc1_image_type<?php echo $cb_index; ?>_type1" name="dp_options[contents_builder][<?php echo $cb_index; ?>][dc1_image_type]" value="type1" <?php checked( $value['dc1_image_type'], 'type1' ); ?> />
     <label for="dc1_image_type<?php echo $cb_index; ?>_type1"><?php _e('Display one image', 'tcd-w'); ?></label>
    </li>
    <li>
     <input type="radio" class="dc1_image_type2" id="dc1_image_type<?php echo $cb_index; ?>_type2" name="dp_options[contents_builder][<?php echo $cb_index; ?>][dc1_image_type]" value="type2" <?php checked( $value['dc1_image_type'], 'type2' ); ?> />
     <label for="dc1_image_type<?php echo $cb_index; ?>_type2"><?php _e('Display two images', 'tcd-w'); ?></label>
    </li>
    <li>
     <input type="radio" class="dc1_image_type3" id="dc1_image_type<?php echo $cb_index; ?>_type3" name="dp_options[contents_builder][<?php echo $cb_index; ?>][dc1_image_type]" value="type3" <?php checked( $value['dc1_image_type'], 'type3' ); ?> />
     <label for="dc1_image_type<?php echo $cb_index; ?>_type3"><?php _e('Display three images', 'tcd-w'); ?></label>
    </li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Image', 'tcd-w');  ?></h4>
   <ul class="option_list">
    <li class="cf">
     <span class="label">
      <?php _e('Image', 'tcd-w'); ?>1
      <span class="recommend_desc dc1_image_type1_image_size" style="<?php if($value['dc1_image_type'] == 'type1') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
       <?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '1000', '300'); ?>
      </span>
      <span class="recommend_desc dc1_image_type2_image_size" style="<?php if($value['dc1_image_type'] == 'type2') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
       <?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '500', '300'); ?>
      </span> 
      <span class="recommend_desc dc1_image_type3_image_size" style="<?php if($value['dc1_image_type'] == 'type3') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
       <?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '333', '300'); ?>
      </span> 
     </span>
     <div class="image_box cf">
      <div class="cf cf_media_field hide-if-no-js dc1_image1">
       <input type="hidden" value="<?php echo esc_attr( $value['dc1_image1'] ); ?>" id="dc1_image1-<?php echo $cb_index; ?>" name="dp_options[contents_builder][<?php echo $cb_index; ?>][dc1_image1]" class="cf_media_id">
       <div class="preview_field"><?php if($value['dc1_image1']){ echo wp_get_attachment_image($value['dc1_image1'], 'medium'); }; ?></div>
       <div class="buttton_area">
        <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
        <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$value['dc1_image1']){ echo 'hidden'; }; ?>">
       </div>
      </div>
     </div>
    </li>
    <li class="cf dc1_image_type2_area" style="<?php if($value['dc1_image_type'] == 'type2' || $value['dc1_image_type'] == 'type3') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
     <span class="label">
      <?php _e('Image', 'tcd-w'); ?>2
      <span class="recommend_desc dc1_image_type1_image_size" style="<?php if($value['dc1_image_type'] == 'type1') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
       <?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '1000', '300'); ?>
      </span>
      <span class="recommend_desc dc1_image_type2_image_size" style="<?php if($value['dc1_image_type'] == 'type2') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
       <?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '500', '300'); ?>
      </span> 
      <span class="recommend_desc dc1_image_type3_image_size" style="<?php if($value['dc1_image_type'] == 'type3') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
       <?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '333', '300'); ?>
      </span> 
     </span>
     <div class="image_box cf">
      <div class="cf cf_media_field hide-if-no-js dc1_image2">
       <input type="hidden" value="<?php echo esc_attr( $value['dc1_image2'] ); ?>" id="dc1_image2-<?php echo $cb_index; ?>" name="dp_options[contents_builder][<?php echo $cb_index; ?>][dc1_image2]" class="cf_media_id">
       <div class="preview_field"><?php if($value['dc1_image2']){ echo wp_get_attachment_image($value['dc1_image2'], 'medium'); }; ?></div>
       <div class="buttton_area">
        <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
        <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$value['dc1_image2']){ echo 'hidden'; }; ?>">
       </div>
      </div>
     </div>
    </li>
    <li class="cf dc1_image_type3_area" style="<?php if($value['dc1_image_type'] == 'type3') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
     <span class="label">
      <?php _e('Image', 'tcd-w'); ?>3
      <span class="recommend_desc dc1_image_type1_image_size" style="<?php if($value['dc1_image_type'] == 'type1') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
       <?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '1000', '300'); ?>
      </span>
      <span class="recommend_desc dc1_image_type2_image_size" style="<?php if($value['dc1_image_type'] == 'type2') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
       <?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '500', '300'); ?>
      </span> 
      <span class="recommend_desc dc1_image_type3_image_size" style="<?php if($value['dc1_image_type'] == 'type3') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
       <?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '333', '300'); ?>
      </span> 
     </span>
     <div class="image_box cf">
      <div class="cf cf_media_field hide-if-no-js dc1_image3">
       <input type="hidden" value="<?php echo esc_attr( $value['dc1_image3'] ); ?>" id="dc1_image3-<?php echo $cb_index; ?>" name="dp_options[contents_builder][<?php echo $cb_index; ?>][dc1_image3]" class="cf_media_id">
       <div class="preview_field"><?php if($value['dc1_image3']){ echo wp_get_attachment_image($value['dc1_image3'], 'medium'); }; ?></div>
       <div class="buttton_area">
        <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
        <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$value['dc1_image3']){ echo 'hidden'; }; ?>">
       </div>
      </div>
     </div>
    </li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Catchphrase', 'tcd-w');  ?></h4>
   <textarea class="large-text cb-repeater-label" cols="50" rows="3" name="dp_options[contents_builder][<?php echo $cb_index; ?>][dc1_catch]"><?php echo esc_textarea(  $value['dc1_catch'] ); ?></textarea>
   <ul class="option_list">
    <li class="cf">
     <span class="label"><?php _e('Font size', 'tcd-w'); ?></span>
     <div class="font_size_option">
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="dp_options[contents_builder][<?php echo $cb_index; ?>][dc1_catch_font_size]" value="<?php echo esc_attr( $value['dc1_catch_font_size'] ); ?>" />
       <span class="icon icon_pc"></span>
      </label>
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="dp_options[contents_builder][<?php echo $cb_index; ?>][dc1_catch_font_size_mobile]" value="<?php echo esc_attr( $value['dc1_catch_font_size_mobile'] ); ?>" />
       <span class="icon icon_sp"></span>
      </label>
     </div>
    </li>
    <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][dc1_catch_font_color]" value="<?php echo esc_attr( $value['dc1_catch_font_color'] ); ?>" data-default-color="#58330d" class="c-color-picker"></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Description', 'tcd-w');  ?></h4>
   <textarea class="large-text" cols="50" rows="3" name="dp_options[contents_builder][<?php echo $cb_index; ?>][dc1_desc]"><?php echo esc_textarea(  $value['dc1_desc'] ); ?></textarea>
   <ul class="option_list">
    <li class="cf">
     <span class="label"><?php _e('Font size', 'tcd-w'); ?></span>
     <div class="font_size_option">
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="dp_options[contents_builder][<?php echo $cb_index; ?>][dc1_desc_font_size]" value="<?php echo esc_attr( $value['dc1_desc_font_size'] ); ?>" />
       <span class="icon icon_pc"></span>
      </label>
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="dp_options[contents_builder][<?php echo $cb_index; ?>][dc1_desc_font_size_mobile]" value="<?php echo esc_attr( $value['dc1_desc_font_size_mobile'] ); ?>" />
       <span class="icon icon_sp"></span>
      </label>
     </div>
    </li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Button', 'tcd-w');  ?></h4>
   <p class="displayment_checkbox"><label><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][show_dc1_button]" type="checkbox" value="1" <?php checked( $value['show_dc1_button'], 1 ); ?>><?php _e( 'Display button', 'tcd-w' ); ?></label></p>
   <div style="<?php if($value['show_dc1_button'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
    <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
     <li class="cf"><span class="label"><?php _e('label', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][dc1_button_label]" value="<?php echo esc_attr( $value['dc1_button_label'] ); ?>" /></li>
     <li class="cf">
     	<span class="label"><?php _e('URL', 'tcd-w'); ?></span>
	     <div class="admin_link_option">
	      <input type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][dc1_button_url]" placeholder="https://example.com/" value="<?php echo esc_attr( $value['dc1_button_url'] ); ?>">
	      <input id="dc1_button_target<?php echo $cb_index; ?>" class="admin_link_option_target" name="dp_options[contents_builder][<?php echo $cb_index; ?>][dc1_button_target]" type="checkbox" value="1" <?php checked( $value['dc1_button_target'], 1 ); ?>>
	      <label for="dc1_button_target<?php echo $cb_index; ?>">&#xe92a;</label>
	     </div>
     </li>
     <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][dc1_button_font_color]" value="<?php echo esc_attr( $value['dc1_button_font_color'] ); ?>" data-default-color="#58330c" class="c-color-picker"></li>
     <li class="cf"><span class="label"><?php _e('Border color', 'tcd-w'); ?></span><input type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][dc1_button_border_color]" value="<?php echo esc_attr( $value['dc1_button_border_color'] ); ?>" data-default-color="#59340e" class="c-color-picker"></li>
     <li class="cf color_picker_bottom"><span class="label"><?php _e('Font color on mouse over', 'tcd-w'); ?></span><input type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][dc1_button_font_color_hover]" value="<?php echo esc_attr( $value['dc1_button_font_color_hover'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
     <li class="cf color_picker_bottom"><span class="label"><?php _e('Background color on mouse over', 'tcd-w'); ?></span><input type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][dc1_button_bg_color_hover]" value="<?php echo esc_attr( $value['dc1_button_bg_color_hover'] ); ?>" data-default-color="#472805" class="c-color-picker"></li>
     <li class="cf color_picker_bottom"><span class="label"><?php _e('Border color on mouse over', 'tcd-w'); ?></span><input type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][dc1_button_border_color_hover]" value="<?php echo esc_attr( $value['dc1_button_border_color_hover'] ); ?>" data-default-color="#472805" class="c-color-picker"></li>
    </ul>
   </div>

<?php
     // デザインコンテンツ2　-------------------------------------------------------------
     } elseif ($cb_content_select == 'design_content2') {

       if (!isset($value['show_dc2'])) { $value['show_dc2'] = 1; }

       if (!isset($value['dc2_catch'])) { $value['dc2_catch'] = ''; }
       if (!isset($value['dc2_catch_font_size'])) { $value['dc2_catch_font_size'] = '38'; }
       if (!isset($value['dc2_catch_font_size_mobile'])) { $value['dc2_catch_font_size_mobile'] = '22'; }
       if (!isset($value['dc2_catch_font_color'])) { $value['dc2_catch_font_color'] = '#58330d'; }

       if (!isset($value['dc2_desc'])) { $value['dc2_desc'] = ''; }
       if (!isset($value['dc2_desc_font_size'])) { $value['dc2_desc_font_size'] = '16'; }
       if (!isset($value['dc2_desc_font_size_mobile'])) { $value['dc2_desc_font_size_mobile'] = '14'; }

       if (!isset($value['dc2_banner_headline'])) { $value['dc2_banner_headline'] = ''; }
       if (!isset($value['dc2_banner_headline_font_size'])) { $value['dc2_banner_headline_font_size'] = '38'; }
       if (!isset($value['dc2_banner_headline_font_size_mobile'])) { $value['dc2_banner_headline_font_size_mobile'] = '22'; }

       if (!isset($value['dc2_banner_sub_title'])) { $value['dc2_banner_sub_title'] = ''; }
       if (!isset($value['dc2_banner_sub_title_font_size'])) { $value['dc2_banner_sub_title_font_size'] = '18'; }
       if (!isset($value['dc2_banner_sub_title_font_size_mobile'])) { $value['dc2_banner_sub_title_font_size_mobile'] = '12'; }

       if (!isset($value['dc2_banner_desc'])) { $value['dc2_banner_desc'] = ''; }
       if (!isset($value['dc2_banner_desc_font_size'])) { $value['dc2_banner_desc_font_size'] = '16'; }
       if (!isset($value['dc2_banner_desc_font_size_mobile'])) { $value['dc2_banner_desc_font_size_mobile'] = '14'; }

       if (!isset($value['dc2_banner_image'])) { $value['dc2_banner_image'] = false; }

       if (!isset($value['dc2_banner_use_overlay'])) { $value['dc2_banner_use_overlay'] = ''; }
       if (!isset($value['dc2_banner_overlay_color'])) { $value['dc2_banner_overlay_color'] = '#000000'; }
       if (!isset($value['dc2_banner_overlay_opacity'])) { $value['dc2_banner_overlay_opacity'] = '0.3'; }

       if (!isset($value['dc2_banner_font_color'])) { $value['dc2_banner_font_color'] = '#ffffff'; }

       if (!isset($value['dc2_banner_url'])) { $value['dc2_banner_url'] = ''; }
       if (!isset($value['dc2_banner_target'])) { $value['dc2_banner_target'] = 1; }

?>

  <h3 class="cb_content_headline"><?php _e('Designed content', 'tcd-w'); ?>2<span><?php if(!empty($value['dc2_catch'])){?>：<?php echo esc_textarea( strip_tags( $value['dc2_catch']) ); ?><?php } ?></span></h3>
  <div class="cb_content">

   <p><label><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][show_dc2]" type="checkbox" value="1" <?php checked( $value['show_dc2'], 1 ); ?>><?php _e('Display designed content', 'tcd-w'); ?></label></p>

   <h4 class="theme_option_headline2"><?php _e('Catchphrase', 'tcd-w');  ?></h4>
   <textarea class="large-text cb-repeater-label" cols="50" rows="3" name="dp_options[contents_builder][<?php echo $cb_index; ?>][dc2_catch]"><?php echo esc_textarea(  $value['dc2_catch'] ); ?></textarea>
   <ul class="option_list">
    <li class="cf">
     <span class="label"><?php _e('Font size', 'tcd-w'); ?></span>
     <div class="font_size_option">
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="dp_options[contents_builder][<?php echo $cb_index; ?>][dc2_catch_font_size]" value="<?php echo esc_attr( $value['dc2_catch_font_size'] ); ?>" />
       <span class="icon icon_pc"></span>
      </label>
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="dp_options[contents_builder][<?php echo $cb_index; ?>][dc2_catch_font_size_mobile]" value="<?php echo esc_attr( $value['dc2_catch_font_size_mobile'] ); ?>" />
       <span class="icon icon_sp"></span>
      </label>
     </div>
    </li>
    <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][dc2_catch_font_color]" value="<?php echo esc_attr( $value['dc2_catch_font_color'] ); ?>" data-default-color="#58330d" class="c-color-picker"></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Description', 'tcd-w');  ?></h4>
   <textarea class="large-text" cols="50" rows="3" name="dp_options[contents_builder][<?php echo $cb_index; ?>][dc2_desc]"><?php echo esc_textarea(  $value['dc2_desc'] ); ?></textarea>
   <ul class="option_list">
    <li class="cf">
     <span class="label"><?php _e('Font size', 'tcd-w'); ?></span>
     <div class="font_size_option">
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="dp_options[contents_builder][<?php echo $cb_index; ?>][dc2_desc_font_size]" value="<?php echo esc_attr( $value['dc2_desc_font_size'] ); ?>" />
       <span class="icon icon_pc"></span>
      </label>
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="dp_options[contents_builder][<?php echo $cb_index; ?>][dc2_desc_font_size_mobile]" value="<?php echo esc_attr( $value['dc2_desc_font_size_mobile'] ); ?>" />
       <span class="icon icon_sp"></span>
      </label>
     </div>
    </li>
   </ul>

   <div class="sub_box cf">
    <h3 class="theme_option_subbox_headline"><?php _e('Banner content', 'tcd-w'); ?></h3>
    <div class="sub_box_content">
     <h4 class="theme_option_headline2"><?php _e('Headline', 'tcd-w');  ?></h4>
     <input class="large-text" type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][dc2_banner_headline]" value="<?php esc_attr_e( $value['dc2_banner_headline'] ); ?>" />
     <ul class="option_list">
      <li class="cf">
       <span class="label"><?php _e('Font size', 'tcd-w'); ?></span>
       <div class="font_size_option">
        <label class="font_size_label number_option">
         <input class="hankaku input_font_size" type="number" name="dp_options[contents_builder][<?php echo $cb_index; ?>][dc2_banner_headline_font_size]" value="<?php echo esc_attr( $value['dc2_banner_headline_font_size'] ); ?>" />
         <span class="icon icon_pc"></span>
        </label>
        <label class="font_size_label number_option">
         <input class="hankaku input_font_size" type="number" name="dp_options[contents_builder][<?php echo $cb_index; ?>][dc2_banner_headline_font_size_mobile]" value="<?php echo esc_attr( $value['dc2_banner_headline_font_size_mobile'] ); ?>" />
         <span class="icon icon_sp"></span>
        </label>
       </div>
      </li>
     </ul>
     <h4 class="theme_option_headline2"><?php _e('Sub heading', 'tcd-w');  ?></h4>
     <input class="large-text" type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][dc2_banner_sub_title]" value="<?php esc_attr_e( $value['dc2_banner_sub_title'] ); ?>" />
     <ul class="option_list">
      <li class="cf">
       <span class="label"><?php _e('Font size', 'tcd-w'); ?></span>
       <div class="font_size_option">
        <label class="font_size_label number_option">
         <input class="hankaku input_font_size" type="number" name="dp_options[contents_builder][<?php echo $cb_index; ?>][dc2_banner_sub_title_font_size]" value="<?php echo esc_attr( $value['dc2_banner_sub_title_font_size'] ); ?>" />
         <span class="icon icon_pc"></span>
        </label>
        <label class="font_size_label number_option">
         <input class="hankaku input_font_size" type="number" name="dp_options[contents_builder][<?php echo $cb_index; ?>][dc2_banner_sub_title_font_size_mobile]" value="<?php echo esc_attr( $value['dc2_banner_sub_title_font_size_mobile'] ); ?>" />
         <span class="icon icon_sp"></span>
        </label>
       </div>
      </li>
     </ul>
     <h4 class="theme_option_headline2"><?php _e('Description', 'tcd-w');  ?></h4>
     <textarea class="large-text" cols="50" rows="3" name="dp_options[contents_builder][<?php echo $cb_index; ?>][dc2_banner_desc]"><?php echo esc_textarea(  $value['dc2_banner_desc'] ); ?></textarea>
     <ul class="option_list">
      <li class="cf">
       <span class="label"><?php _e('Font size', 'tcd-w'); ?></span>
       <div class="font_size_option">
        <label class="font_size_label number_option">
         <input class="hankaku input_font_size" type="number" name="dp_options[contents_builder][<?php echo $cb_index; ?>][dc2_banner_desc_font_size]" value="<?php echo esc_attr( $value['dc2_banner_desc_font_size'] ); ?>" />
         <span class="icon icon_pc"></span>
        </label>
        <label class="font_size_label number_option">
         <input class="hankaku input_font_size" type="number" name="dp_options[contents_builder][<?php echo $cb_index; ?>][dc2_banner_desc_font_size_mobile]" value="<?php echo esc_attr( $value['dc2_banner_desc_font_size_mobile'] ); ?>" />
         <span class="icon icon_sp"></span>
        </label>
       </div>
      </li>
     </ul>
     <h4 class="theme_option_headline2"><?php _e('Other setting', 'tcd-w');  ?></h4>
     <ul class="option_list">
     <li class="cf">
     	<span class="label"><?php _e('Link URL', 'tcd-w'); ?></span>
	     <div class="admin_link_option">
	      <input type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][dc2_banner_url]" value="<?php echo esc_attr( $value['dc2_banner_url'] ); ?>">
	      <input id="dc2_banner_target<?php echo $cb_index; ?>" class="admin_link_option_target" name="dp_options[contents_builder][<?php echo $cb_index; ?>][dc2_banner_target]" type="checkbox" value="1" <?php checked( $value['dc2_banner_target'], 1 ); ?>>
	      <label for="dc2_banner_target<?php echo $cb_index; ?>">&#xe92a;</label>
	     </div>
     </li>
      <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][dc2_banner_font_color]" value="<?php echo esc_attr( $value['dc2_banner_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
     </ul>
     <h4 class="theme_option_headline2"><?php _e('Image', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf">
       <span class="label">
        <?php _e('Image', 'tcd-w'); ?>
        <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '1000', '300'); ?></span>
       </span>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js dc2_banner_image">
         <input type="hidden" value="<?php echo esc_attr( $value['dc2_banner_image'] ); ?>" id="dc2_banner_image-<?php echo $cb_index; ?>" name="dp_options[contents_builder][<?php echo $cb_index; ?>][dc2_banner_image]" class="cf_media_id">
         <div class="preview_field"><?php if($value['dc2_banner_image']){ echo wp_get_attachment_image($value['dc2_banner_image'], 'medium'); }; ?></div>
         <div class="buttton_area">
          <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$value['dc2_banner_image']){ echo 'hidden'; }; ?>">
         </div>
        </div>
       </div>
      </li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e( 'Overlay', 'tcd-w' ); ?></h4>
     <p class="displayment_checkbox"><label><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][dc2_banner_use_overlay]" type="checkbox" value="1" <?php checked( $value['dc2_banner_use_overlay'], 1 ); ?>><?php _e( 'Use overlay', 'tcd-w' ); ?></label></p>
     <div style="<?php if($value['dc2_banner_use_overlay'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
       <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-w'); ?></span><input type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][dc2_banner_overlay_color]" value="<?php echo esc_attr( $value['dc2_banner_overlay_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
       <li class="cf">
        <span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[contents_builder][<?php echo $cb_index; ?>][dc2_banner_overlay_opacity]" value="<?php echo esc_attr( $value['dc2_banner_overlay_opacity'] ); ?>" />
        <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
         <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
        </div>
       </li>
      </ul>
     </div>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .sub_box_content -->
   </div><!-- END .sub_box -->

<?php
     // キャンペーン一覧　-------------------------------------------------------------
     } elseif ($cb_content_select == 'campaign_list') {

       if (!isset($value['show_campaign'])) { $value['show_campaign'] = 1; }

       if (!isset($value['campaign_post_type'])) { $value['campaign_post_type'] = 'campaign'; }

       if (!isset($value['campaign_headline'])) { $value['campaign_headline'] = ''; }
       if (!isset($value['campaign_headline_font_size'])) { $value['campaign_headline_font_size'] = '38'; }
       if (!isset($value['campaign_headline_font_size_mobile'])) { $value['campaign_headline_font_size_mobile'] = '20'; }

       if (!isset($value['campaign_sub_title'])) { $value['campaign_sub_title'] = ''; }
       if (!isset($value['campaign_sub_title_font_size'])) { $value['campaign_sub_title_font_size'] = '18'; }
       if (!isset($value['campaign_sub_title_font_size_mobile'])) { $value['campaign_sub_title_font_size_mobile'] = '15'; }

       if (!isset($value['campaign_headline_font_color'])) { $value['campaign_headline_font_color'] = '#ffffff'; }

       if (!isset($value['campaign_num'])) { $value['campaign_num'] = '6'; }
       if (!isset($value['campaign_title_font_size'])) { $value['campaign_title_font_size'] = '16'; }
       if (!isset($value['campaign_title_font_size_mobile'])) { $value['campaign_title_font_size_mobile'] = '14'; }
       if (!isset($value['campaign_title_font_color'])) { $value['campaign_title_font_color'] = '#ffffff'; }
       if (!isset($value['campaign_border_color'])) { $value['campaign_border_color'] = '#ffffff'; }
       if (!isset($value['campaign_border_color_opacity'])) { $value['campaign_border_color_opacity'] = '0.5'; }

       if (!isset($value['campaign_bg_type'])) { $value['campaign_bg_type'] = 'type1'; }
       if (!isset($value['campaign_video'])) { $value['campaign_video'] = false; }
       if (!isset($value['campaign_video_image'])) { $value['campaign_video_image'] = false; }
       if (!isset($value['campaign_image'])) { $value['campaign_image'] = false; }
       if (!isset($value['campaign_use_overlay'])) { $value['campaign_use_overlay'] = ''; }
       if (!isset($value['campaign_overlay_color'])) { $value['campaign_overlay_color'] = '#000000'; }
       if (!isset($value['campaign_overlay_opacity'])) { $value['campaign_overlay_opacity'] = '0.3'; }

       if (!isset($value['show_campaign_button'])) { $value['show_campaign_button'] = 1; }
       if (!isset($value['campaign_button_label'])) { $value['campaign_button_label'] = __('Archive', 'tcd-w'); }
       if (!isset($value['campaign_button_font_color'])) { $value['campaign_button_font_color'] = '#ffffff'; }
       if (!isset($value['campaign_button_border_color'])) { $value['campaign_button_border_color'] = '#ffffff'; }
       if (!isset($value['campaign_button_border_opacity'])) { $value['campaign_button_border_opacity'] = '0.5'; }
       if (!isset($value['campaign_button_font_color_hover'])) { $value['campaign_button_font_color_hover'] = '#ffffff'; }
       if (!isset($value['campaign_button_bg_color_hover'])) { $value['campaign_button_bg_color_hover'] = '#472805'; }
       if (!isset($value['campaign_button_border_color_hover'])) { $value['campaign_button_border_color_hover'] = '#472805'; }

?>

  <h3 class="cb_content_headline"><?php _e('Carousel content', 'tcd-w'); ?><span><?php if(!empty($value['campaign_headline'])){?>：<?php echo esc_textarea( strip_tags( $value['campaign_headline']) ); ?><?php } ?></span></h3>
  <div class="cb_content">

   <p><label><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][show_campaign]" type="checkbox" value="1" <?php checked( $value['show_campaign'], 1 ); ?>><?php _e('Display carousel content', 'tcd-w'); ?></label></p>

   <h4 class="theme_option_headline2"><?php _e('Headline', 'tcd-w');  ?></h4>
   <input class="large-text cb-repeater-label" type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][campaign_headline]" value="<?php esc_attr_e( $value['campaign_headline'] ); ?>" />
   <ul class="option_list">
    <li class="cf">
     <span class="label"><?php _e('Font size', 'tcd-w'); ?></span>
     <div class="font_size_option">
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="dp_options[contents_builder][<?php echo $cb_index; ?>][campaign_headline_font_size]" value="<?php echo esc_attr( $value['campaign_headline_font_size'] ); ?>" />
       <span class="icon icon_pc"></span>
      </label>
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="dp_options[contents_builder][<?php echo $cb_index; ?>][campaign_headline_font_size_mobile]" value="<?php echo esc_attr( $value['campaign_headline_font_size_mobile'] ); ?>" />
       <span class="icon icon_sp"></span>
      </label>
     </div>
    </li>
    <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][campaign_headline_font_color]" value="<?php echo esc_attr( $value['campaign_headline_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Sub heading', 'tcd-w');  ?></h4>
   <input class="large-text" type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][campaign_sub_title]" value="<?php esc_attr_e( $value['campaign_sub_title'] ); ?>" />
   <ul class="option_list">
    <li class="cf">
     <span class="label"><?php _e('Font size', 'tcd-w'); ?></span>
     <div class="font_size_option">
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="dp_options[contents_builder][<?php echo $cb_index; ?>][campaign_sub_title_font_size]" value="<?php echo esc_attr( $value['campaign_sub_title_font_size'] ); ?>" />
       <span class="icon icon_pc"></span>
      </label>
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="dp_options[contents_builder][<?php echo $cb_index; ?>][campaign_sub_title_font_size_mobile]" value="<?php echo esc_attr( $value['campaign_sub_title_font_size_mobile'] ); ?>" />
       <span class="icon icon_sp"></span>
      </label>
     </div>
    </li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Post list', 'tcd-w');  ?></h4>
   <ul class="option_list">
    <li class="cf">
     <span class="label"><?php _e('Post type', 'tcd-w');  ?></span>
     <div class="standard_radio_button">
      <input id="campaign_post_type1_<?php echo $cb_index; ?>" type="radio" name="dp_options[contents_builder][<?php echo $cb_index; ?>][campaign_post_type]" value="post" <?php checked( $value['campaign_post_type'], 'post' ); ?>>
      <label for="campaign_post_type1_<?php echo $cb_index; ?>"><?php _e('Blog', 'tcd-w'); ?></label>
      <input id="campaign_post_type2_<?php echo $cb_index; ?>" type="radio" name="dp_options[contents_builder][<?php echo $cb_index; ?>][campaign_post_type]" value="news" <?php checked( $value['campaign_post_type'], 'news' ); ?>>
      <label for="campaign_post_type2_<?php echo $cb_index; ?>"><?php echo esc_html($news_label); ?></label>
      <input id="campaign_post_type3_<?php echo $cb_index; ?>" type="radio" name="dp_options[contents_builder][<?php echo $cb_index; ?>][campaign_post_type]" value="campaign" <?php checked( $value['campaign_post_type'], 'campaign' ); ?>>
      <label for="campaign_post_type3_<?php echo $cb_index; ?>"><?php echo esc_html($campaign_label); ?></label>
     </div>
    </li>
    <li class="cf"><span class="label"><?php _e('Number of post to display', 'tcd-w');  ?></span>
     <select name="dp_options[contents_builder][<?php echo $cb_index; ?>][campaign_num]">
      <?php for($i=4; $i<= 12; $i++): ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($i); ?>" <?php selected( $value['campaign_num'], $i ); ?>><?php echo esc_html($i); ?></option>
      <?php endfor; ?>
     </select>
    </li>
    <li class="cf">
     <span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span>
     <div class="font_size_option">
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="dp_options[contents_builder][<?php echo $cb_index; ?>][campaign_title_font_size]" value="<?php echo esc_attr( $value['campaign_title_font_size'] ); ?>" />
       <span class="icon icon_pc"></span>
      </label>
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="dp_options[contents_builder][<?php echo $cb_index; ?>][campaign_title_font_size_mobile]" value="<?php echo esc_attr( $value['campaign_title_font_size_mobile'] ); ?>" />
       <span class="icon icon_sp"></span>
      </label>
     </div>
    </li>
    <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][campaign_title_font_color]" value="<?php echo esc_attr( $value['campaign_title_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
    <li class="cf"><span class="label"><?php _e('Border color', 'tcd-w'); ?></span><input type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][campaign_border_color]" value="<?php echo esc_attr( $value['campaign_border_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
    <li class="cf">
     <span class="label"><?php _e('Transparency of border', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[contents_builder][<?php echo $cb_index; ?>][campaign_border_color_opacity]" value="<?php echo esc_attr( $value['campaign_border_color_opacity'] ); ?>" />
     <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
      <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
     </div>
    </li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Button', 'tcd-w');  ?></h4>
   <p class="displayment_checkbox"><label><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][show_campaign_button]" type="checkbox" value="1" <?php checked( $value['show_campaign_button'], 1 ); ?>><?php _e( 'Display button', 'tcd-w' ); ?></label></p>
   <div style="<?php if($value['show_campaign_button'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
    <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
     <li class="cf"><span class="label"><?php _e('label', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][campaign_button_label]" value="<?php echo esc_attr( $value['campaign_button_label'] ); ?>" /></li>
     <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][campaign_button_font_color]" value="<?php echo esc_attr( $value['campaign_button_font_color'] ); ?>" data-default-color="#58330c" class="c-color-picker"></li>
     <li class="cf"><span class="label"><?php _e('Border color', 'tcd-w'); ?></span><input type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][campaign_button_border_color]" value="<?php echo esc_attr( $value['campaign_button_border_color'] ); ?>" data-default-color="#59340e" class="c-color-picker"></li>
     <li class="cf">
      <span class="label"><?php _e('Transparency of border', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[contents_builder][<?php echo $cb_index; ?>][campaign_button_border_opacity]" value="<?php echo esc_attr( $value['campaign_button_border_opacity'] ); ?>" />
      <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
       <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
      </div>
     </li>
     <li class="cf"><span class="label"><?php _e('Font color on mouse over', 'tcd-w'); ?></span><input type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][campaign_button_font_color_hover]" value="<?php echo esc_attr( $value['campaign_button_font_color_hover'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
     <li class="cf"><span class="label"><?php _e('Background color on mouse over', 'tcd-w'); ?></span><input type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][campaign_button_bg_color_hover]" value="<?php echo esc_attr( $value['campaign_button_bg_color_hover'] ); ?>" data-default-color="#472805" class="c-color-picker"></li>
     <li class="cf"><span class="label"><?php _e('Border color on mouse over', 'tcd-w'); ?></span><input type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][campaign_button_border_color_hover]" value="<?php echo esc_attr( $value['campaign_button_border_color_hover'] ); ?>" data-default-color="#472805" class="c-color-picker"></li>
    </ul>
   </div>

   <h4 class="theme_option_headline2"><?php _e('Background', 'tcd-w'); ?></h4>
   <ul class="design_radio_button horizontal cf">
    <li>
     <input type="radio" class="campaign_bg_type_type1" id="campaign_bg_type<?php echo $cb_index; ?>_type1" name="dp_options[contents_builder][<?php echo $cb_index; ?>][campaign_bg_type]" value="type1" <?php checked( $value['campaign_bg_type'], 'type1' ); ?> />
     <label for="campaign_bg_type<?php echo $cb_index; ?>_type1"><?php _e('Image', 'tcd-w'); ?></label>
    </li>
    <li>
     <input type="radio" class="campaign_bg_type_type2" id="campaign_bg_type<?php echo $cb_index; ?>_type2" name="dp_options[contents_builder][<?php echo $cb_index; ?>][campaign_bg_type]" value="type2" <?php checked( $value['campaign_bg_type'], 'type2' ); ?> />
     <label for="campaign_bg_type<?php echo $cb_index; ?>_type2"><?php _e('Video', 'tcd-w'); ?></label>
    </li>
   </ul>

   <div class="campaign_bg_type1_area" style="<?php if($value['campaign_bg_type'] == 'type1') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
    <h4 class="theme_option_headline2"><?php _e('Background image', 'tcd-w');  ?></h4>
    <ul class="option_list">
     <li class="cf">
      <span class="label">
       <?php _e('Image', 'tcd-w'); ?>
       <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '1450', '616'); ?></span>
      </span>
      <div class="image_box cf">
       <div class="cf cf_media_field hide-if-no-js campaign_image">
        <input type="hidden" value="<?php echo esc_attr( $value['campaign_image'] ); ?>" id="campaign_image-<?php echo $cb_index; ?>" name="dp_options[contents_builder][<?php echo $cb_index; ?>][campaign_image]" class="cf_media_id">
        <div class="preview_field"><?php if($value['campaign_image']){ echo wp_get_attachment_image($value['campaign_image'], 'medium'); }; ?></div>
        <div class="buttton_area">
         <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
         <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$value['campaign_image']){ echo 'hidden'; }; ?>">
        </div>
       </div>
      </div>
     </li>
    </ul>
   </div><!-- END .campaign_bg_type1_area -->

   <div class="campaign_bg_type2_area" style="<?php if($value['campaign_bg_type'] == 'type2') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
    <h4 class="theme_option_headline2"><?php _e('Video', 'tcd-w');  ?></h4>
    <div class="theme_option_message2">
     <p><?php _e('Please upload MP4 format file.', 'tcd-w');  ?></p>
     <p><?php _e('Web browser takes few second to load the data of video so we recommend to use loading screen if you want to display video.', 'tcd-w'); ?></p>
    </div>
    <div class="image_box cf">
     <div class="cf cf_media_field hide-if-no-js campaign_video">
      <input type="hidden" value="<?php echo esc_attr( $value['campaign_video'] ); ?>" id="campaign_video-<?php echo $cb_index; ?>" name="dp_options[contents_builder][<?php echo $cb_index; ?>][campaign_video]" class="cf_media_id">
      <div class="preview_field preview_field_video">
       <?php if($value['campaign_video']){ ?>
       <h4><?php _e( 'Uploaded MP4 file', 'tcd-w' ); ?></h4>
       <p><?php echo esc_url(wp_get_attachment_url($value['campaign_video'])); ?></p>
       <?php }; ?>
      </div>
      <div class="buttton_area">
       <input type="button" value="<?php _e('Select MP4 file', 'tcd-w'); ?>" class="cfmf-select-video button">
       <input type="button" value="<?php _e('Remove MP4 file', 'tcd-w'); ?>" class="cfmf-delete-video button <?php if(!$value['campaign_video']){ echo 'hidden'; }; ?>">
      </div>
     </div>
    </div>
    <h4 class="theme_option_headline2"><?php _e('Substitute image', 'tcd-w');  ?></h4>
    <div class="theme_option_message2">
     <p><?php _e('If the mobile device can\'t play video this image will be displayed instead.', 'tcd-w');  ?></p>
    </div>
    <div class="image_box cf">
     <div class="cf cf_media_field hide-if-no-js campaign_video_image">
      <input type="hidden" value="<?php echo esc_attr( $value['campaign_video_image'] ); ?>" id="campaign_video_image-<?php echo $cb_index; ?>" name="dp_options[contents_builder][<?php echo $cb_index; ?>][campaign_video_image]" class="cf_media_id">
      <div class="preview_field"><?php if($value['campaign_video_image']){ echo wp_get_attachment_image($value['campaign_video_image'], 'medium'); }; ?></div>
      <div class="buttton_area">
       <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
       <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$value['campaign_video_image']){ echo 'hidden'; }; ?>">
      </div>
     </div>
    </div>
   </div><!-- END .campaign_bg_type2_area -->

   <h4 class="theme_option_headline2"><?php _e( 'Overlay', 'tcd-w' ); ?></h4>
   <p class="displayment_checkbox"><label><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][campaign_use_overlay]" type="checkbox" value="1" <?php checked( $value['campaign_use_overlay'], 1 ); ?>><?php _e( 'Use overlay', 'tcd-w' ); ?></label></p>
   <div style="<?php if($value['campaign_use_overlay'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
    <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
     <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-w'); ?></span><input type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][campaign_overlay_color]" value="<?php echo esc_attr( $value['campaign_overlay_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
     <li class="cf">
      <span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[contents_builder][<?php echo $cb_index; ?>][campaign_overlay_opacity]" value="<?php echo esc_attr( $value['campaign_overlay_opacity'] ); ?>" />
      <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
       <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
      </div>
     </li>
    </ul>
   </div>

<?php
     // 新着ブログ　-------------------------------------------------------------
     } elseif ($cb_content_select == 'recent_blog_list') {

       if (!isset($value['show_blog'])) { $value['show_blog'] = 1; }

       if (!isset($value['recent_blog_post_type'])) { $value['recent_blog_post_type'] = 'post'; }

       if (!isset($value['recent_blog_headline'])) { $value['recent_blog_headline'] = ''; }
       if (!isset($value['recent_blog_headline_font_size'])) { $value['recent_blog_headline_font_size'] = '38'; }
       if (!isset($value['recent_blog_headline_font_size_mobile'])) { $value['recent_blog_headline_font_size_mobile'] = '22'; }
       if (!isset($value['recent_blog_headline_font_color'])) { $value['recent_blog_headline_font_color'] = '#58330d'; }

       if (!isset($value['recent_blog_sub_title'])) { $value['recent_blog_sub_title'] = ''; }
       if (!isset($value['recent_blog_sub_title_font_size'])) { $value['recent_blog_sub_title_font_size'] = '18'; }
       if (!isset($value['recent_blog_sub_title_font_size_mobile'])) { $value['recent_blog_sub_title_font_size_mobile'] = '12'; }

       if (!isset($value['recent_blog_num'])) { $value['recent_blog_num'] = '6'; }
       if (!isset($value['recent_blog_title_font_size'])) { $value['recent_blog_title_font_size'] = '16'; }
       if (!isset($value['recent_blog_title_font_size_mobile'])) { $value['recent_blog_title_font_size_mobile'] = '14'; }
       if (!isset($value['recent_blog_show_date'])) { $value['recent_blog_show_date'] = 1; }
       if (!isset($value['recent_blog_show_category'])) { $value['recent_blog_show_category'] = 1; }

       if (!isset($value['show_recent_blog_button'])) { $value['show_recent_blog_button'] = 1; }
       if (!isset($value['recent_blog_button_label'])) { $value['recent_blog_button_label'] = __('Archive', 'tcd-w'); }
       if (!isset($value['recent_blog_button_font_color'])) { $value['recent_blog_button_font_color'] = '#58330c'; }
       if (!isset($value['recent_blog_button_border_color'])) { $value['recent_blog_button_border_color'] = '#59340e'; }
       if (!isset($value['recent_blog_button_font_color_hover'])) { $value['recent_blog_button_font_color_hover'] = '#ffffff'; }
       if (!isset($value['recent_blog_button_bg_color_hover'])) { $value['recent_blog_button_bg_color_hover'] = '#472805'; }
       if (!isset($value['recent_blog_button_border_color_hover'])) { $value['recent_blog_button_border_color_hover'] = '#472805'; }

?>

  <h3 class="cb_content_headline"><?php _e('Content list1 (Image + Title)', 'tcd-w'); ?><span><?php if(!empty($value['recent_blog_headline'])){?>：<?php echo esc_textarea( strip_tags( $value['recent_blog_headline']) ); ?><?php } ?></span></h3>
  <div class="cb_content">

   <p><label><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][show_blog]" type="checkbox" value="1" <?php checked( $value['show_blog'], 1 ); ?>><?php _e('Display content list', 'tcd-w'); ?></label></p>

   <h4 class="theme_option_headline2"><?php _e('Headline', 'tcd-w');  ?></h4>
   <input class="large-text cb-repeater-label" type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][recent_blog_headline]" value="<?php esc_attr_e( $value['recent_blog_headline'] ); ?>" />
   <ul class="option_list">
    <li class="cf">
     <span class="label"><?php _e('Font size', 'tcd-w'); ?></span>
     <div class="font_size_option">
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="dp_options[contents_builder][<?php echo $cb_index; ?>][recent_blog_headline_font_size]" value="<?php echo esc_attr( $value['recent_blog_headline_font_size'] ); ?>" />
       <span class="icon icon_pc"></span>
      </label>
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="dp_options[contents_builder][<?php echo $cb_index; ?>][recent_blog_headline_font_size_mobile]" value="<?php echo esc_attr( $value['recent_blog_headline_font_size_mobile'] ); ?>" />
       <span class="icon icon_sp"></span>
      </label>
     </div>
    </li>
    <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][recent_blog_headline_font_color]" value="<?php echo esc_attr( $value['recent_blog_headline_font_color'] ); ?>" data-default-color="#58330d" class="c-color-picker"></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Sub heading', 'tcd-w');  ?></h4>
   <input class="large-text" type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][recent_blog_sub_title]" value="<?php esc_attr_e( $value['recent_blog_sub_title'] ); ?>" />
   <ul class="option_list">
    <li class="cf">
     <span class="label"><?php _e('Font size', 'tcd-w'); ?></span>
     <div class="font_size_option">
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="dp_options[contents_builder][<?php echo $cb_index; ?>][recent_blog_sub_title_font_size]" value="<?php echo esc_attr( $value['recent_blog_sub_title_font_size'] ); ?>" />
       <span class="icon icon_pc"></span>
      </label>
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="dp_options[contents_builder][<?php echo $cb_index; ?>][recent_blog_sub_title_font_size_mobile]" value="<?php echo esc_attr( $value['recent_blog_sub_title_font_size_mobile'] ); ?>" />
       <span class="icon icon_sp"></span>
      </label>
     </div>
    </li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Post list', 'tcd-w');  ?></h4>
   <ul class="option_list">
    <li class="cf">
     <span class="label"><?php _e('Post type', 'tcd-w');  ?></span>
     <div class="standard_radio_button">
      <input id="recent_blog_post_type1_<?php echo $cb_index; ?>" type="radio" name="dp_options[contents_builder][<?php echo $cb_index; ?>][recent_blog_post_type]" value="post" <?php checked( $value['recent_blog_post_type'], 'post' ); ?>>
      <label for="recent_blog_post_type1_<?php echo $cb_index; ?>"><?php _e('Blog', 'tcd-w'); ?></label>
      <input id="recent_blog_post_type2_<?php echo $cb_index; ?>" type="radio" name="dp_options[contents_builder][<?php echo $cb_index; ?>][recent_blog_post_type]" value="news" <?php checked( $value['recent_blog_post_type'], 'news' ); ?>>
      <label for="recent_blog_post_type2_<?php echo $cb_index; ?>"><?php echo esc_html($news_label); ?></label>
      <input id="recent_blog_post_type3_<?php echo $cb_index; ?>" type="radio" name="dp_options[contents_builder][<?php echo $cb_index; ?>][recent_blog_post_type]" value="campaign" <?php checked( $value['recent_blog_post_type'], 'campaign' ); ?>>
      <label for="recent_blog_post_type3_<?php echo $cb_index; ?>"><?php echo esc_html($campaign_label); ?></label>
     </div>
    </li>
    <li class="cf"><span class="label"><?php _e('Number of post to display', 'tcd-w');  ?></span>
     <select name="dp_options[contents_builder][<?php echo $cb_index; ?>][recent_blog_num]">
      <?php for($i=3; $i<= 12; $i++): ?>
      <?php if( $i % 3 == 0 ){ ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($i); ?>" <?php selected( $value['recent_blog_num'], $i ); ?>><?php echo esc_html($i); ?></option>
      <?php }; ?>
      <?php endfor; ?>
     </select>
    </li>
    <li class="cf">
     <span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span>
     <div class="font_size_option">
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="dp_options[contents_builder][<?php echo $cb_index; ?>][recent_blog_title_font_size]" value="<?php echo esc_attr( $value['recent_blog_title_font_size'] ); ?>" />
       <span class="icon icon_pc"></span>
      </label>
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="dp_options[contents_builder][<?php echo $cb_index; ?>][recent_blog_title_font_size_mobile]" value="<?php echo esc_attr( $value['recent_blog_title_font_size_mobile'] ); ?>" />
       <span class="icon icon_sp"></span>
      </label>
     </div>
    </li>
    <li class="cf"><span class="label"><?php _e('Display date', 'tcd-w');  ?></span><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][recent_blog_show_date]" type="checkbox" value="1" <?php checked( '1', $value['recent_blog_show_date'] ); ?> /></li>
    <li class="cf"><span class="label"><?php _e('Display category', 'tcd-w'); ?></span><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][recent_blog_show_category]" type="checkbox" value="1" <?php checked( '1', $value['recent_blog_show_category'] ); ?> /></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Button', 'tcd-w');  ?></h4>
   <p class="displayment_checkbox"><label><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][show_recent_blog_button]" type="checkbox" value="1" <?php checked( $value['show_recent_blog_button'], 1 ); ?>><?php _e( 'Display button', 'tcd-w' ); ?></label></p>
   <div style="<?php if($value['show_recent_blog_button'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
    <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
     <li class="cf"><span class="label"><?php _e('label', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][recent_blog_button_label]" value="<?php echo esc_attr( $value['recent_blog_button_label'] ); ?>" /></li>
     <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][recent_blog_button_font_color]" value="<?php echo esc_attr( $value['recent_blog_button_font_color'] ); ?>" data-default-color="#58330c" class="c-color-picker"></li>
     <li class="cf"><span class="label"><?php _e('Border color', 'tcd-w'); ?></span><input type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][recent_blog_button_border_color]" value="<?php echo esc_attr( $value['recent_blog_button_border_color'] ); ?>" data-default-color="#59340e" class="c-color-picker"></li>
     <li class="cf color_picker_bottom"><span class="label"><?php _e('Font color on mouse over', 'tcd-w'); ?></span><input type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][recent_blog_button_font_color_hover]" value="<?php echo esc_attr( $value['recent_blog_button_font_color_hover'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
     <li class="cf color_picker_bottom"><span class="label"><?php _e('Background color on mouse over', 'tcd-w'); ?></span><input type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][recent_blog_button_bg_color_hover]" value="<?php echo esc_attr( $value['recent_blog_button_bg_color_hover'] ); ?>" data-default-color="#472805" class="c-color-picker"></li>
     <li class="cf color_picker_bottom"><span class="label"><?php _e('Border color on mouse over', 'tcd-w'); ?></span><input type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][recent_blog_button_border_color_hover]" value="<?php echo esc_attr( $value['recent_blog_button_border_color_hover'] ); ?>" data-default-color="#472805" class="c-color-picker"></li>
    </ul>
   </div>

<?php
     // お知らせ　-------------------------------------------------------------
     } elseif ($cb_content_select == 'news_list') {

       if (!isset($value['show_news'])) { $value['show_news'] = 1; }

       if (!isset($value['news_post_type'])) { $value['news_post_type'] = 'news'; }

       if (!isset($value['news_headline'])) { $value['news_headline'] = ''; }
       if (!isset($value['news_headline_font_size'])) { $value['news_headline_font_size'] = '38'; }
       if (!isset($value['news_headline_font_size_mobile'])) { $value['news_headline_font_size_mobile'] = '22'; }
       if (!isset($value['news_headline_font_color'])) { $value['news_headline_font_color'] = '#58330d'; }

       if (!isset($value['news_sub_title'])) { $value['news_sub_title'] = ''; }
       if (!isset($value['news_sub_title_font_size'])) { $value['news_sub_title_font_size'] = '18'; }
       if (!isset($value['news_sub_title_font_size_mobile'])) { $value['news_sub_title_font_size_mobile'] = '12'; }

       if (!isset($value['news_num'])) { $value['news_num'] = 3; }
       if (!isset($value['news_date_color'])) { $value['news_date_color'] = '#593306'; }

       if (!isset($value['show_news_button'])) { $value['show_news_button'] = 1; }
       if (!isset($value['news_button_label'])) { $value['news_button_label'] = __('Archive', 'tcd-w'); }
       if (!isset($value['news_button_font_color'])) { $value['news_button_font_color'] = '#58330c'; }
       if (!isset($value['news_button_border_color'])) { $value['news_button_border_color'] = '#59340e'; }
       if (!isset($value['news_button_font_color_hover'])) { $value['news_button_font_color_hover'] = '#ffffff'; }
       if (!isset($value['news_button_bg_color_hover'])) { $value['news_button_bg_color_hover'] = '#472805'; }
       if (!isset($value['news_button_border_color_hover'])) { $value['news_button_border_color_hover'] = '#472805'; }

?>

  <h3 class="cb_content_headline"><?php _e('Content list2 (Title + Date)', 'tcd-w'); ?><span><?php if(!empty($value['news_headline'])){?>：<?php echo esc_textarea( strip_tags( $value['news_headline']) ); ?><?php } ?></span></h3>
  <div class="cb_content">

   <p><label><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][show_news]" type="checkbox" value="1" <?php checked( $value['show_news'], 1 ); ?>><?php _e('Display content list', 'tcd-w'); ?></label></p>

   <h4 class="theme_option_headline2"><?php _e('Headline', 'tcd-w');  ?></h4>
   <input class="large-tex cb-repeater-label" type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][news_headline]" value="<?php esc_attr_e( $value['news_headline'] ); ?>" />
   <ul class="option_list">
    <li class="cf">
     <span class="label"><?php _e('Font size', 'tcd-w'); ?></span>
     <div class="font_size_option">
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="dp_options[contents_builder][<?php echo $cb_index; ?>][news_headline_font_size]" value="<?php echo esc_attr( $value['news_headline_font_size'] ); ?>" />
       <span class="icon icon_pc"></span>
      </label>
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="dp_options[contents_builder][<?php echo $cb_index; ?>][news_headline_font_size_mobile]" value="<?php echo esc_attr( $value['news_headline_font_size_mobile'] ); ?>" />
       <span class="icon icon_sp"></span>
      </label>
     </div>
    </li>
    <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][news_headline_font_color]" value="<?php echo esc_attr( $value['news_headline_font_color'] ); ?>" data-default-color="#58330d" class="c-color-picker"></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Sub heading', 'tcd-w');  ?></h4>
   <input class="large-text" type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][news_sub_title]" value="<?php esc_attr_e( $value['news_sub_title'] ); ?>" />
   <ul class="option_list">
    <li class="cf">
     <span class="label"><?php _e('Font size', 'tcd-w'); ?></span>
     <div class="font_size_option">
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="dp_options[contents_builder][<?php echo $cb_index; ?>][news_sub_title_font_size]" value="<?php echo esc_attr( $value['news_sub_title_font_size'] ); ?>" />
       <span class="icon icon_pc"></span>
      </label>
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="dp_options[contents_builder][<?php echo $cb_index; ?>][news_sub_title_font_size_mobile]" value="<?php echo esc_attr( $value['news_sub_title_font_size_mobile'] ); ?>" />
       <span class="icon icon_sp"></span>
      </label>
     </div>
    </li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Post list', 'tcd-w');  ?></h4>
   <ul class="option_list">
    <li class="cf">
     <span class="label"><?php _e('Post type', 'tcd-w');  ?></span>
     <div class="standard_radio_button">
      <input id="news_post_type1_<?php echo $cb_index; ?>" type="radio" name="dp_options[contents_builder][<?php echo $cb_index; ?>][news_post_type]" value="post" <?php checked( $value['news_post_type'], 'post' ); ?>>
      <label for="news_post_type1_<?php echo $cb_index; ?>"><?php _e('Blog', 'tcd-w'); ?></label>
      <input id="news_post_type2_<?php echo $cb_index; ?>" type="radio" name="dp_options[contents_builder][<?php echo $cb_index; ?>][news_post_type]" value="news" <?php checked( $value['news_post_type'], 'news' ); ?>>
      <label for="news_post_type2_<?php echo $cb_index; ?>"><?php echo esc_html($news_label); ?></label>
      <input id="news_post_type3_<?php echo $cb_index; ?>" type="radio" name="dp_options[contents_builder][<?php echo $cb_index; ?>][news_post_type]" value="campaign" <?php checked( $value['news_post_type'], 'campaign' ); ?>>
      <label for="news_post_type3_<?php echo $cb_index; ?>"><?php echo esc_html($campaign_label); ?></label>
     </div>
    </li>
    <li class="cf"><span class="label"><?php _e('Number of post to display', 'tcd-w');  ?></span>
     <select name="dp_options[contents_builder][<?php echo $cb_index; ?>][news_num]">
      <?php for($i=3; $i<= 12; $i++): ?>
      <option style="padding-right: 10px;" value="<?php echo esc_attr($i); ?>" <?php selected( $value['news_num'], $i ); ?>><?php echo esc_html($i); ?></option>
      <?php endfor; ?>
     </select>
    </li>
    <li class="cf color_picker_bottom"><span class="label"><?php _e('Color of date', 'tcd-w'); ?></span><input type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][news_date_color]" value="<?php echo esc_attr( $value['news_date_color'] ); ?>" data-default-color="#593306" class="c-color-picker"></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Button', 'tcd-w');  ?></h4>
   <p class="displayment_checkbox"><label><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][show_news_button]" type="checkbox" value="1" <?php checked( $value['show_news_button'], 1 ); ?>><?php _e( 'Display button', 'tcd-w' ); ?></label></p>
   <div style="<?php if($value['show_news_button'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
    <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
     <li class="cf"><span class="label"><?php _e('label', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][news_button_label]" value="<?php echo esc_attr( $value['news_button_label'] ); ?>" /></li>
     <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][news_button_font_color]" value="<?php echo esc_attr( $value['news_button_font_color'] ); ?>" data-default-color="#58330c" class="c-color-picker"></li>
     <li class="cf"><span class="label"><?php _e('Border color', 'tcd-w'); ?></span><input type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][news_button_border_color]" value="<?php echo esc_attr( $value['news_button_border_color'] ); ?>" data-default-color="#59340e" class="c-color-picker"></li>
     <li class="cf color_picker_bottom"><span class="label"><?php _e('Font color on mouse over', 'tcd-w'); ?></span><input type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][news_button_font_color_hover]" value="<?php echo esc_attr( $value['news_button_font_color_hover'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
     <li class="cf color_picker_bottom"><span class="label"><?php _e('Background color on mouse over', 'tcd-w'); ?></span><input type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][news_button_bg_color_hover]" value="<?php echo esc_attr( $value['news_button_bg_color_hover'] ); ?>" data-default-color="#472805" class="c-color-picker"></li>
     <li class="cf color_picker_bottom"><span class="label"><?php _e('Border color on mouse over', 'tcd-w'); ?></span><input type="text" name="dp_options[contents_builder][<?php echo $cb_index; ?>][news_button_border_color_hover]" value="<?php echo esc_attr( $value['news_button_border_color_hover'] ); ?>" data-default-color="#472805" class="c-color-picker"></li>
    </ul>
   </div>


<?php
     // 自由入力欄　-------------------------------------------------------------
     } elseif ($cb_content_select == 'free_space') {

       if (!isset($value['show_free'])) { $value['show_free'] = 1; }

       if (!isset($value['free_space'])) {
         $value['free_space'] = '';
       }
?>
  <h3 class="cb_content_headline"><?php _e('Free space', 'tcd-w');  ?><span><?php if(!empty($value['free_space'])){?>：<?php echo esc_textarea( strip_tags( $value['free_space']) ); ?><?php } ?></span></h3>
  <div class="cb_content">

   <p><label><input name="dp_options[contents_builder][<?php echo $cb_index; ?>][show_free]" type="checkbox" value="1" <?php checked( $value['show_free'], 1 ); ?>><?php _e('Display free space', 'tcd-w'); ?></label></p>

   <h4 class="theme_option_headline2"><?php _e('Free space', 'tcd-w');  ?></h4>
   <?php
        wp_editor(
          $value['free_space'],
          'cb_wysiwyg_editor-' . $cb_index,
          array (
            'textarea_name' => 'dp_options[contents_builder][' . $cb_index . '][free_space]'
          )
       );
   ?>

<?php
     // ボタンの表示　-------------------------------------------------------------
     } else {
?>
  <h3 class="cb_content_headline"><?php echo esc_html($cb_content_select); ?></h3>
  <div class="cb_content">

<?php
     }
?>

   <ul class="button_list cf">
    <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
    <li><a href="#" class="button-ml close-content"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
   </ul>

  </div><!-- END .cb_content -->

</div><!-- END .cb_content_wrap -->

<?php

} // END the_cb_content_setting()

/**
 * クローン用のリッチエディター化処理をしないようにする
 * クローン後のリッチエディター化はjsで行う
 */
function cb_tiny_mce_before_init( $mceInit, $editor_id ) {
	if ( strpos( $editor_id, 'cb_cloneindex' ) !== false ) {
		$mceInit['wp_skip_init'] = true;
	}
	return $mceInit;
}
add_filter( 'tiny_mce_before_init', 'cb_tiny_mce_before_init', 10, 2 );

?>