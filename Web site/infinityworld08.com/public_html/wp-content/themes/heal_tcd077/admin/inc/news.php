<?php
/*
 * お知らせの設定
 */

 use TCD\Helper\UI;
 use TCD\Helper\Sanitization as San;

// Add default values
add_filter( 'before_getting_design_plus_option', 'add_news_dp_default_options' );


// Add label of logo tab
add_action( 'tcd_tab_labels', 'add_news_tab_label' );


// Add HTML of logo tab
add_action( 'tcd_tab_panel', 'add_news_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_news_theme_options_validate' );


// タブの名前
function add_news_tab_label( $tab_labels ) {
  $options = get_design_plus_option();
  $tab_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-w' );
  $tab_labels['news'] = $tab_label;
  return $tab_labels;
}


// 初期値
function add_news_dp_default_options( $dp_default_options ) {

	// 基本設定
	$dp_default_options['news_label'] = __( 'News', 'tcd-w' );
	$dp_default_options['news_slug'] = 'news';

	// ヘッダー
	$dp_default_options['news_title'] = 'NEWS';
	$dp_default_options['news_sub_title'] = '';
	$dp_default_options['news_title_font_size'] = '38';
	$dp_default_options['news_title_font_size_mobile'] = '20';
	$dp_default_options['news_sub_title_font_size'] = '18';
	$dp_default_options['news_sub_title_font_size_mobile'] = '15';
	$dp_default_options['news_title_color'] = '#FFFFFF';
	$dp_default_options['news_bg_image'] = false;
	$dp_default_options['news_use_overlay'] = 1;
	$dp_default_options['news_overlay_color'] = '#000000';
	$dp_default_options['news_overlay_opacity'] = '0.3';

	// アーカイブページ
	$dp_default_options['archive_news_title_font_size'] = '20';
	$dp_default_options['archive_news_title_font_size_mobile'] = '16';
	$dp_default_options['show_archive_news_date'] = 1;
	$dp_default_options['news_no_image'] = 'display';
	$dp_default_options['archive_news_num'] = '10';

	// 詳細ページ
	$dp_default_options['single_news_title_font_size'] = '28';
	$dp_default_options['single_news_content_font_size'] = '16';
	$dp_default_options['single_news_title_font_size_mobile'] = '20';
	$dp_default_options['single_news_content_font_size_mobile'] = '14';
	$dp_default_options['show_news_image'] = 1;
	$dp_default_options['show_news_date'] = 1;
	$dp_default_options['show_sns_top_news'] = 1;
	$dp_default_options['show_sns_btm_news'] = 1;
	$dp_default_options['show_copy_top_news'] = 1;
	$dp_default_options['show_copy_btm_news'] = 1;
	$dp_default_options['show_news_nav'] = 1;

	// 最新のお知らせ一覧
	$dp_default_options['show_recent_news'] = 1;
	$dp_default_options['recent_news_headline'] = __( 'Recent news', 'tcd-w' );
	$dp_default_options['recent_news_headline_font_type'] = 1;
	$dp_default_options['recent_news_headline_font_size'] = '20';
	$dp_default_options['recent_news_headline_font_size_mobile'] = '15';
	$dp_default_options['recent_news_headline_font_color'] = '#ffffff';
	$dp_default_options['recent_news_headline_bg_color'] = '#58330d';
	$dp_default_options['show_recent_news_date'] = 1;
	$dp_default_options['recent_news_num'] = '5';

	$dp_default_options['show_recent_news_link'] = 1;
	$dp_default_options['recent_news_link_label'] = __( 'News list', 'tcd-w' );
	$dp_default_options['recent_news_button_color'] = '#58330c';
	$dp_default_options['recent_news_button_border_color'] = '#59340e';
	$dp_default_options['recent_news_button_color_hover'] = '#ffffff';
	$dp_default_options['recent_news_button_bg_color_hover'] = '#59340e';
	$dp_default_options['recent_news_button_border_color_hover'] = '#59340e';

	// 広告
	for ( $i = 1; $i <= 2; $i++ ) {
		$dp_default_options['news_single_top_ad_code' . $i] = '';
		$dp_default_options['news_single_top_ad_image' . $i] = false;
		$dp_default_options['news_single_top_ad_url' . $i] = '';
	}
	for ( $i = 1; $i <= 2; $i++ ) {
		$dp_default_options['news_single_bottom_ad_code' . $i] = '';
		$dp_default_options['news_single_bottom_ad_image' . $i] = false;
		$dp_default_options['news_single_bottom_ad_url' . $i] = '';
	}
	for ( $i = 1; $i <= 2; $i++ ) {
		$dp_default_options['news_single_shortcode_ad_code' . $i] = '';
		$dp_default_options['news_single_shortcode_ad_image' . $i] = false;
		$dp_default_options['news_single_shortcode_ad_url' . $i] = '';
	}
	for ( $i = 1; $i <= 2; $i++ ) {
		$dp_default_options['news_single_mobile_ad_code' . $i] = '';
		$dp_default_options['news_single_mobile_ad_image' . $i] = false;
		$dp_default_options['news_single_mobile_ad_url' . $i] = '';
	}

	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_news_tab_panel( $options ) {

  global $dp_default_options, $no_image_options, $font_type_options;
  $news_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-w' );

?>

<div id="tab-content-news" class="tab-content">


   <?php // 基本設定 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Basic setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e('Name of content', 'tcd-w');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('This name will also be used in breadcrumb link.', 'tcd-w'); ?></p>
     </div>
     <input class="full_width" type="text" name="dp_options[news_label]" value="<?php echo esc_attr( $options['news_label'] ); ?>" />

     <h4 class="theme_option_headline2"><?php _e('Slug setting', 'tcd-w');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('Please enter word by alphabet only.<br />After changing slug, please update permalink setting form <a href="./options-permalink.php"><strong>permalink option page</strong></a>.', 'tcd-w'); ?></p>
     </div>
     <p><input class="hankaku full_width" type="text" name="dp_options[news_slug]" value="<?php echo sanitize_title( $options['news_slug'] ); ?>" /></p>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // ヘッダーの設定 ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Header', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e('Title', 'tcd-w');  ?></h4>
     <input class="full_width" type="text" name="dp_options[news_title]" value="<?php echo esc_attr($options['news_title']); ?>" />
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'news_title_font_size'); ?></li>
      <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[news_title_color]" value="<?php echo esc_attr( $options['news_title_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Sub title', 'tcd-w');  ?></h4>
     <input class="full_width" type="text" name="dp_options[news_sub_title]" value="<?php echo esc_attr($options['news_sub_title']); ?>" />
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'news_sub_title_font_size'); ?></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Background image', 'tcd-w'); ?></h4>
     <ul class="option_list">
      <li class="cf">
       <span class="label">
        <?php _e('Background image', 'tcd-w'); ?>
        <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '1450', '430'); ?></span>
       </span>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js news_bg_image">
         <input type="hidden" value="<?php echo esc_attr( $options['news_bg_image'] ); ?>" id="news_bg_image" name="dp_options[news_bg_image]" class="cf_media_id">
         <div class="preview_field"><?php if($options['news_bg_image']){ echo wp_get_attachment_image($options['news_bg_image'], 'medium'); }; ?></div>
         <div class="buttton_area">
          <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['news_bg_image']){ echo 'hidden'; }; ?>">
         </div>
        </div>
       </div>
      </li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e( 'Overlay', 'tcd-w' ); ?></h4>
     <p class="displayment_checkbox"><label><input name="dp_options[news_use_overlay]" type="checkbox" value="1" <?php checked( $options['news_use_overlay'], 1 ); ?>><?php _e( 'Use overlay', 'tcd-w' ); ?></label></p>
     <div style="<?php if($options['news_use_overlay'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
       <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-w'); ?></span><input type="text" name="dp_options[news_overlay_color]" value="<?php echo esc_attr( $options['news_overlay_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
       <li class="cf">
        <span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[news_overlay_opacity]" value="<?php echo esc_attr( $options['news_overlay_opacity'] ); ?>" />
        <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
         <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
        </div>
       </li>
      </ul>
     </div>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // アーカイブページの設定 ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Archive page', 'tcd-w'); ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php printf(__('%s list', 'tcd-w'), $news_label); ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'archive_news_title_font_size'); ?></li>
      <li class="cf">
       <span class="label"><?php _e('Number of post to display per page', 'tcd-w'); ?></span>
       <select name="dp_options[archive_news_num]">
        <?php for($i=10; $i<= 20; $i++): ?>
        <option style="padding-right: 10px;" value="<?php echo esc_attr($i); ?>" <?php selected( $options['archive_news_num'], $i ); ?>><?php echo esc_html($i); ?></option>
        <?php endfor; ?>
       </select>
      </li>
      <li class="cf"><span class="label"><?php _e('Display date', 'tcd-w'); ?></span><input name="dp_options[show_archive_news_date]" type="checkbox" value="1" <?php checked( '1', $options['show_archive_news_date'] ); ?> /></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('When the featured image is not registered', 'tcd-w');  ?></h4>
     <?php echo tcd_basic_radio_button($options, 'news_no_image', $no_image_options); ?>
     <br style="clear:both;">

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // 詳細ページの設定 ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php printf(__('%s page', 'tcd-w'), $news_label); ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e('Font', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'single_news_title_font_size'); ?></li>
      <li class="cf"><span class="label"><?php _e('Font size of content', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'single_news_content_font_size'); ?></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Display setting', 'tcd-w');  ?></h4>
     <ul class="option_list">
       <div class="theme_option_message2">
        <p><?php _e('Please check the content displayed in the article.', 'tcd-w'); ?></p>
       </div>
      <li class="cf"><span class="label"><?php _e('Published date', 'tcd-w');  ?></span><input name="dp_options[show_news_date]" type="checkbox" value="1" <?php checked( '1', $options['show_news_date'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('Featured image', 'tcd-w');  ?></span><input name="dp_options[show_news_image]" type="checkbox" value="1" <?php checked( '1', $options['show_news_image'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('Next previous post link', 'tcd-w');  ?></span><input name="dp_options[show_news_nav]" type="checkbox" value="1" <?php checked( '1', $options['show_news_nav'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('Social button (under featured image)', 'tcd-w');  ?></span><input name="dp_options[show_sns_top_news]" type="checkbox" value="1" <?php checked( '1', $options['show_sns_top_news'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('Social button (under post content)', 'tcd-w');  ?></span><input name="dp_options[show_sns_btm_news]" type="checkbox" value="1" <?php checked( '1', $options['show_sns_btm_news'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('"COPY Title&amp;URL" button under featured image', 'tcd-w');  ?></span><input name="dp_options[show_copy_top_news]" type="checkbox" value="1" <?php checked( '1', $options['show_copy_top_news'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('"COPY Title&amp;URL" button under post content', 'tcd-w');  ?></span><input name="dp_options[show_copy_btm_news]" type="checkbox" value="1" <?php checked( '1', $options['show_copy_btm_news'] ); ?> /></li>
     </ul>

     <h4 class="theme_option_headline2"><?php printf(__('Recent %s list', 'tcd-w'), $news_label); ?></h4>
     <p class="displayment_checkbox"><label><input name="dp_options[show_recent_news]" type="checkbox" value="1" <?php checked( $options['show_recent_news'], 1 ); ?>><?php printf(__('Display %s list', 'tcd-w'), $news_label); ?></label></p>
     <div style="<?php if($options['show_recent_news'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <ul class="option_list">
       <li class="cf"><span class="label"><?php _e('Headline', 'tcd-w');  ?></span><input class="full_width" type="text" name="dp_options[recent_news_headline]" value="<?php esc_attr_e( $options['recent_news_headline'] ); ?>" /></li>
       <li class="cf"><span class="label"><?php _e('Font type of headline', 'tcd-w'); ?></span>
       <?php echo UI\font_select( 'dp_options[recent_news_headline_font_type]', $options['recent_news_headline_font_type'] ); ?>
      </li>
       <li class="cf"><span class="label"><?php _e('Font size of headline', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'recent_news_headline_font_size'); ?></li>
       <li class="cf"><span class="label"><?php _e('Font color of headline', 'tcd-w'); ?></span><input type="text" name="dp_options[recent_news_headline_font_color]" value="<?php echo esc_attr( $options['recent_news_headline_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
       <li class="cf"><span class="label"><?php _e('Background color of headline', 'tcd-w'); ?></span><input type="text" name="dp_options[recent_news_headline_bg_color]" value="<?php echo esc_attr( $options['recent_news_headline_bg_color'] ); ?>" data-default-color="#58330d" class="c-color-picker"></li>
       <li class="cf">
        <span class="label"><?php _e('Number of post to display', 'tcd-w');  ?></span>
        <select name="dp_options[recent_news_num]">
         <?php for($i=5; $i<= 10; $i++): ?>
         <option style="padding-right: 10px;" value="<?php echo esc_attr($i); ?>" <?php selected( $options['recent_news_num'], $i ); ?>><?php echo esc_html($i); ?></option>
         <?php endfor; ?>
        </select>
       </li>
       <li class="cf"><span class="label"><?php _e('Display date', 'tcd-w'); ?></span><input name="dp_options[show_recent_news_date]" type="checkbox" value="1" <?php checked( '1', $options['show_recent_news_date'] ); ?> /></li>
      </ul>
      <p class="displayment_checkbox" style="border-top:1px dotted #ccc; padding-top:12px;"><label><input name="dp_options[show_recent_news_link]" type="checkbox" value="1" <?php checked( $options['show_recent_news_link'], 1 ); ?>><?php _e( 'Display archive page button', 'tcd-w' ); ?></label></p>
      <div style="<?php if($options['show_recent_news_link'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
       <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
        <li class="cf"><span class="label"><?php _e('label', 'tcd-w');  ?></span><input class="full_width" type="text" name="dp_options[recent_news_link_label]" value="<?php esc_attr_e( $options['recent_news_link_label'] ); ?>" style="max-width:50%;" /></li>
        <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[recent_news_button_color]" value="<?php echo esc_attr( $options['recent_news_button_color'] ); ?>" data-default-color="#58330c" class="c-color-picker"></li>
        <li class="cf"><span class="label"><?php _e('Border color', 'tcd-w'); ?></span><input type="text" name="dp_options[recent_news_button_border_color]" value="<?php echo esc_attr( $options['recent_news_button_border_color'] ); ?>" data-default-color="#59340e" class="c-color-picker"></li>
        <li class="cf"><span class="label"><?php _e('Font color of on mouse over', 'tcd-w'); ?></span><input type="text" name="dp_options[recent_news_button_color_hover]" value="<?php echo esc_attr( $options['recent_news_button_color_hover'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
        <li class="cf"><span class="label"><?php _e('Background color on mouse over', 'tcd-w'); ?></span><input type="text" name="dp_options[recent_news_button_bg_color_hover]" value="<?php echo esc_attr( $options['recent_news_button_bg_color_hover'] ); ?>" data-default-color="#59340e" class="c-color-picker"></li>
        <li class="cf"><span class="label"><?php _e('Border color on mouse over', 'tcd-w'); ?></span><input type="text" name="dp_options[recent_news_button_border_color_hover]" value="<?php echo esc_attr( $options['recent_news_button_border_color_hover'] ); ?>" data-default-color="#59340e" class="c-color-picker"></li>
       </ul>
      </div>
     </div>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // 広告の登録（アイキャッチ画像の下） -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Banner (Under featured image)', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content tab_parent">

     <div class="theme_option_message2">
      <p><?php _e('This banner will be displayed after featured image.', 'tcd-w');  ?></p>
     </div>

     <div class="sub_box_tab">
      <div class="tab active" data-tab="tab1"><?php _e('Left banner', 'tcd-w'); ?></div>
      <div class="tab" data-tab="tab2"><?php _e('Right banner', 'tcd-w'); ?></div>
     </div>

     <?php for($i = 1; $i <= 2; $i++) : ?>
     <div class="sub_box_tab_content<?php if($i == 1){ echo ' active'; }; ?>" data-tab-content="tab<?php echo $i; ?>">

       <h4 class="theme_option_headline2"><?php _e('Banner code', 'tcd-w');  ?></h4>
       <p><?php _e('If you are using google adsense, enter all code below.', 'tcd-w');  ?></p>
       <textarea id="dp_options[news_single_top_ad_code<?php echo $i; ?>]" class="large-text" cols="50" rows="10" name="dp_options[news_single_top_ad_code<?php echo $i; ?>]"><?php echo esc_textarea( $options['news_single_top_ad_code'.$i] ); ?></textarea>

       <div class="theme_option_message">
        <p><?php _e('If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w');  ?></p>
       </div>

       <h4 class="theme_option_headline2"><?php _e('Register banner image.', 'tcd-w'); ?></h4>
       <p><?php _e('Recommend image size. Width:300px Height:250px', 'tcd-w'); ?></p>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js news_single_top_ad_image<?php echo $i; ?>">
         <input type="hidden" value="<?php echo esc_attr( $options['news_single_top_ad_image'.$i] ); ?>" id="news_single_top_ad_image<?php echo $i; ?>" name="dp_options[news_single_top_ad_image<?php echo $i; ?>]" class="cf_media_id">
         <div class="preview_field"><?php if($options['news_single_top_ad_image'.$i]){ echo wp_get_attachment_image($options['news_single_top_ad_image'.$i], 'medium'); }; ?></div>
         <div class="buttton_area">
          <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['news_single_top_ad_image'.$i]){ echo 'hidden'; }; ?>">
         </div>
        </div>
       </div>

       <h4 class="theme_option_headline2"><?php _e('Register affiliate code', 'tcd-w');  ?></h4>
       <input id="dp_options[news_single_top_ad_url<?php echo $i; ?>]" class="regular-text" type="text" name="dp_options[news_single_top_ad_url<?php echo $i; ?>]" value="<?php esc_attr_e( $options['news_single_top_ad_url'.$i] ); ?>" />

     </div>
     <?php endfor; ?>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->

   <?php // 広告の登録（記事本文の下） -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Banner (Under post content)', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content tab_parent">

     <div class="theme_option_message2">
      <p><?php _e('This banner will be displayed before recent news list.', 'tcd-w');  ?></p>
     </div>

     <div class="sub_box_tab">
      <div class="tab active" data-tab="tab1"><?php _e('Left banner', 'tcd-w'); ?></div>
      <div class="tab" data-tab="tab2"><?php _e('Right banner', 'tcd-w'); ?></div>
     </div>

     <?php for($i = 1; $i <= 2; $i++) : ?>
     <div class="sub_box_tab_content<?php if($i == 1){ echo ' active'; }; ?>" data-tab-content="tab<?php echo $i; ?>">

       <h4 class="theme_option_headline2"><?php _e('Banner code', 'tcd-w');  ?></h4>
       <p><?php _e('If you are using google adsense, enter all code below.', 'tcd-w');  ?></p>
       <textarea id="dp_options[news_single_bottom_ad_code<?php echo $i; ?>]" class="large-text" cols="50" rows="10" name="dp_options[news_single_bottom_ad_code<?php echo $i; ?>]"><?php echo esc_textarea( $options['news_single_bottom_ad_code'.$i] ); ?></textarea>

       <div class="theme_option_message">
        <p><?php _e('If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w');  ?></p>
       </div>

       <h4 class="theme_option_headline2"><?php _e('Register banner image.', 'tcd-w'); ?></h4>
       <p><?php _e('Recommend image size. Width:300px Height:250px', 'tcd-w'); ?></p>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js news_single_bottom_ad_image<?php echo $i; ?>">
         <input type="hidden" value="<?php echo esc_attr( $options['news_single_bottom_ad_image'.$i] ); ?>" id="news_single_bottom_ad_image<?php echo $i; ?>" name="dp_options[news_single_bottom_ad_image<?php echo $i; ?>]" class="cf_media_id">
         <div class="preview_field"><?php if($options['news_single_bottom_ad_image'.$i]){ echo wp_get_attachment_image($options['news_single_bottom_ad_image'.$i], 'medium'); }; ?></div>
         <div class="buttton_area">
          <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['news_single_bottom_ad_image'.$i]){ echo 'hidden'; }; ?>">
         </div>
        </div>
       </div>

       <h4 class="theme_option_headline2"><?php _e('Register affiliate code', 'tcd-w');  ?></h4>
       <input id="dp_options[news_single_bottom_ad_url<?php echo $i; ?>]" class="regular-text" type="text" name="dp_options[news_single_bottom_ad_url<?php echo $i; ?>]" value="<?php esc_attr_e( $options['news_single_bottom_ad_url'.$i] ); ?>" />

     </div>
     <?php endfor; ?>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->

   <?php // 広告の登録（ショートコード） -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Banner (Short code)', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content tab_parent">

     <div class="theme_option_message2">
      <p><?php _e('Please copy and paste the short code inside the content to show this banner.', 'tcd-w'); ?></p>
     </div>

     <p><?php _e('Short code', 'tcd-w');  ?> : <input type="text" readonly="readonly" value="[news_s_ad]" /></p>

     <div class="sub_box_tab">
      <div class="tab active" data-tab="tab1"><?php _e('Left banner', 'tcd-w'); ?></div>
      <div class="tab" data-tab="tab2"><?php _e('Right banner', 'tcd-w'); ?></div>
     </div>

     <?php for($i = 1; $i <= 2; $i++) : ?>
     <div class="sub_box_tab_content<?php if($i == 1){ echo ' active'; }; ?>" data-tab-content="tab<?php echo $i; ?>">

       <h4 class="theme_option_headline2"><?php _e('Banner code', 'tcd-w');  ?></h4>
       <p><?php _e('If you are using google adsense, enter all code below.', 'tcd-w');  ?></p>
       <textarea id="dp_options[news_single_shortcode_ad_code<?php echo $i; ?>]" class="large-text" cols="50" rows="10" name="dp_options[news_single_shortcode_ad_code<?php echo $i; ?>]"><?php echo esc_textarea( $options['news_single_shortcode_ad_code'.$i] ); ?></textarea>

       <div class="theme_option_message">
        <p><?php _e('If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w');  ?></p>
       </div>

       <h4 class="theme_option_headline2"><?php _e('Register banner image.', 'tcd-w'); ?></h4>
       <p><?php _e('Recommend image size. Width:300px Height:250px', 'tcd-w'); ?></p>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js news_single_shortcode_ad_image<?php echo $i; ?>">
         <input type="hidden" value="<?php echo esc_attr( $options['news_single_shortcode_ad_image'.$i] ); ?>" id="news_single_shortcode_ad_image<?php echo $i; ?>" name="dp_options[news_single_shortcode_ad_image<?php echo $i; ?>]" class="cf_media_id">
         <div class="preview_field"><?php if($options['news_single_shortcode_ad_image'.$i]){ echo wp_get_attachment_image($options['news_single_shortcode_ad_image'.$i], 'medium'); }; ?></div>
         <div class="buttton_area">
          <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['news_single_shortcode_ad_image'.$i]){ echo 'hidden'; }; ?>">
         </div>
        </div>
       </div>

       <h4 class="theme_option_headline2"><?php _e('Register affiliate code', 'tcd-w');  ?></h4>
       <input id="dp_options[news_single_shortcode_ad_url<?php echo $i; ?>]" class="regular-text" type="text" name="dp_options[news_single_shortcode_ad_url<?php echo $i; ?>]" value="<?php esc_attr_e( $options['news_single_shortcode_ad_url'.$i] ); ?>" />

     </div>
     <?php endfor; ?>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->

   <?php // 広告の登録（スマホ専用） -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Banner (Mobile device)', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content tab_parent">

     <div class="theme_option_message2">
      <p><?php _e('This banner will be displayed on mobile device.', 'tcd-w');  ?></p>
     </div>

     <div class="sub_box_tab">
      <div class="tab active" data-tab="tab1"><?php _e('Top banner', 'tcd-w'); ?></div>
      <div class="tab" data-tab="tab2"><?php _e('Bottom banner', 'tcd-w'); ?></div>
     </div>

     <?php for($i = 1; $i <= 2; $i++) : ?>
     <div class="sub_box_tab_content<?php if($i == 1){ echo ' active'; }; ?>" data-tab-content="tab<?php echo $i; ?>">

       <h4 class="theme_option_headline2"><?php _e('Banner code', 'tcd-w');  ?></h4>
       <p><?php _e('If you are using google adsense, enter all code below.', 'tcd-w');  ?></p>
       <textarea id="dp_options[news_single_mobile_ad_code<?php echo $i; ?>]" class="large-text" cols="50" rows="10" name="dp_options[news_single_mobile_ad_code<?php echo $i; ?>]"><?php echo esc_textarea( $options['news_single_mobile_ad_code'.$i] ); ?></textarea>

       <div class="theme_option_message">
        <p><?php _e('If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w');  ?></p>
       </div>

       <h4 class="theme_option_headline2"><?php _e('Register banner image.', 'tcd-w'); ?></h4>
       <p><?php _e('Recommend image size. Width:300px Height:250px', 'tcd-w'); ?></p>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js news_single_mobile_ad_image<?php echo $i; ?>">
         <input type="hidden" value="<?php echo esc_attr( $options['news_single_mobile_ad_image'.$i] ); ?>" id="news_single_mobile_ad_image<?php echo $i; ?>" name="dp_options[news_single_mobile_ad_image<?php echo $i; ?>]" class="cf_media_id">
         <div class="preview_field"><?php if($options['news_single_mobile_ad_image'.$i]){ echo wp_get_attachment_image($options['news_single_mobile_ad_image'.$i], 'medium'); }; ?></div>
         <div class="buttton_area">
          <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['news_single_mobile_ad_image'.$i]){ echo 'hidden'; }; ?>">
         </div>
        </div>
       </div>

       <h4 class="theme_option_headline2"><?php _e('Register affiliate code', 'tcd-w');  ?></h4>
       <input id="dp_options[news_single_mobile_ad_url<?php echo $i; ?>]" class="regular-text" type="text" name="dp_options[news_single_mobile_ad_url<?php echo $i; ?>]" value="<?php esc_attr_e( $options['news_single_mobile_ad_url'.$i] ); ?>" />

     </div>
     <?php endfor; ?>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


</div><!-- END .tab-content -->

<?php
} // END add_news_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_news_theme_options_validate( $input ) {

  global $dp_default_options, $no_image_options, $font_type_options;

  //基本設定
  $input['news_slug'] = sanitize_title( $input['news_slug'] );
  $input['news_label'] = wp_filter_nohtml_kses( $input['news_label'] );

  //ヘッダーの設定
  $input['news_title'] = wp_filter_nohtml_kses( $input['news_title'] );
  $input['news_sub_title'] = wp_filter_nohtml_kses( $input['news_sub_title'] );
  $input['news_title_font_size'] = wp_filter_nohtml_kses( $input['news_title_font_size'] );
  $input['news_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['news_title_font_size_mobile'] );
  $input['news_sub_title_font_size'] = wp_filter_nohtml_kses( $input['news_sub_title_font_size'] );
  $input['news_sub_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['news_sub_title_font_size_mobile'] );
  $input['news_title_color'] = wp_filter_nohtml_kses( $input['news_title_color'] );
  $input['news_bg_image'] = wp_filter_nohtml_kses( $input['news_bg_image'] );
  if ( ! isset( $input['news_use_overlay'] ) )
    $input['news_use_overlay'] = null;
    $input['news_use_overlay'] = ( $input['news_use_overlay'] == 1 ? 1 : 0 );
  $input['news_overlay_color'] = wp_filter_nohtml_kses( $input['news_overlay_color'] );
  $input['news_overlay_opacity'] = wp_filter_nohtml_kses( $input['news_overlay_opacity'] );

  // アーカイブ
  $input['archive_news_title_font_size'] = wp_filter_nohtml_kses( $input['archive_news_title_font_size'] );
  $input['archive_news_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['archive_news_title_font_size_mobile'] );
  $input['archive_news_num'] = wp_filter_nohtml_kses( $input['archive_news_num'] );
  if ( ! isset( $input['show_archive_news_date'] ) )
    $input['show_archive_news_date'] = null;
    $input['show_archive_news_date'] = ( $input['show_archive_news_date'] == 1 ? 1 : 0 );
  if ( ! isset( $input['news_no_image'] ) )
    $input['news_no_image'] = null;
  if ( ! array_key_exists( $input['news_no_image'], $no_image_options ) )
    $input['news_no_image'] = null;

  //詳細ページ
  $input['single_news_title_font_size'] = wp_filter_nohtml_kses( $input['single_news_title_font_size'] );
  $input['single_news_content_font_size'] = wp_filter_nohtml_kses( $input['single_news_content_font_size'] );
  $input['single_news_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['single_news_title_font_size_mobile'] );
  $input['single_news_content_font_size_mobile'] = wp_filter_nohtml_kses( $input['single_news_content_font_size_mobile'] );
  if ( ! isset( $input['show_news_date'] ) )
    $input['show_news_date'] = null;
    $input['show_news_date'] = ( $input['show_news_date'] == 1 ? 1 : 0 );
  if ( ! isset( $input['show_news_nav'] ) )
    $input['show_news_nav'] = null;
    $input['show_news_nav'] = ( $input['show_news_nav'] == 1 ? 1 : 0 );
  if ( ! isset( $input['show_news_image'] ) )
    $input['show_news_image'] = null;
    $input['show_news_image'] = ( $input['show_news_image'] == 1 ? 1 : 0 );
  if ( ! isset( $input['show_sns_top_news'] ) )
    $input['show_sns_top_news'] = null;
    $input['show_sns_top_news'] = ( $input['show_sns_top_news'] == 1 ? 1 : 0 );
  if ( ! isset( $input['show_sns_btm_news'] ) )
    $input['show_sns_btm_news'] = null;
    $input['show_sns_btm_news'] = ( $input['show_sns_btm_news'] == 1 ? 1 : 0 );
  if ( ! isset( $input['show_copy_top_news'] ) )
    $input['show_copy_top_news'] = null;
    $input['show_copy_top_news'] = ( $input['show_copy_top_news'] == 1 ? 1 : 0 );
  if ( ! isset( $input['show_copy_btm_news'] ) )
    $input['show_copy_btm_news'] = null;
    $input['show_copy_btm_news'] = ( $input['show_copy_btm_news'] == 1 ? 1 : 0 );


  // 最新のお知らせ一覧
  if ( ! isset( $input['show_recent_news'] ) )
    $input['show_recent_news'] = null;
    $input['show_recent_news'] = ( $input['show_recent_news'] == 1 ? 1 : 0 );
  $input['recent_news_headline'] = wp_filter_nohtml_kses( $input['recent_news_headline'] );
  $input['recent_news_headline_font_type'] = San\choice( $input['recent_news_headline_font_type'], [ '1', '2', '3' ] );

  $input['recent_news_headline_font_size'] = wp_filter_nohtml_kses( $input['recent_news_headline_font_size'] );
  $input['recent_news_headline_font_size_mobile'] = wp_filter_nohtml_kses( $input['recent_news_headline_font_size_mobile'] );
  $input['recent_news_headline_font_color'] = wp_filter_nohtml_kses( $input['recent_news_headline_font_color'] );
  $input['recent_news_headline_bg_color'] = wp_filter_nohtml_kses( $input['recent_news_headline_bg_color'] );
  if ( ! isset( $input['show_recent_news_date'] ) )
    $input['show_recent_news_date'] = null;
    $input['show_recent_news_date'] = ( $input['show_recent_news_date'] == 1 ? 1 : 0 );
  $input['recent_news_num'] = wp_filter_nohtml_kses( $input['recent_news_num'] );

  if ( ! isset( $input['show_recent_news_link'] ) )
    $input['show_recent_news_link'] = null;
    $input['show_recent_news_link'] = ( $input['show_recent_news_link'] == 1 ? 1 : 0 );
  $input['recent_news_link_label'] = wp_filter_nohtml_kses( $input['recent_news_link_label'] );
  $input['recent_news_button_color'] = wp_filter_nohtml_kses( $input['recent_news_button_color'] );
  $input['recent_news_button_border_color'] = wp_filter_nohtml_kses( $input['recent_news_button_border_color'] );
  $input['recent_news_button_color_hover'] = wp_filter_nohtml_kses( $input['recent_news_button_color_hover'] );
  $input['recent_news_button_bg_color_hover'] = wp_filter_nohtml_kses( $input['recent_news_button_bg_color_hover'] );
  $input['recent_news_button_border_color_hover'] = wp_filter_nohtml_kses( $input['recent_news_button_border_color_hover'] );

  // 広告
  for ( $i = 1; $i <= 2; $i++ ) {
    $input['news_single_top_ad_code'.$i] = $input['news_single_top_ad_code'.$i];
    $input['news_single_top_ad_image'.$i] = wp_filter_nohtml_kses( $input['news_single_top_ad_image'.$i] );
    $input['news_single_top_ad_url'.$i] = wp_filter_nohtml_kses( $input['news_single_top_ad_url'.$i] );
  }
  for ( $i = 1; $i <= 2; $i++ ) {
    $input['news_single_bottom_ad_code'.$i] = $input['news_single_bottom_ad_code'.$i];
    $input['news_single_bottom_ad_image'.$i] = wp_filter_nohtml_kses( $input['news_single_bottom_ad_image'.$i] );
    $input['news_single_bottom_ad_url'.$i] = wp_filter_nohtml_kses( $input['news_single_bottom_ad_url'.$i] );
  }
  for ( $i = 1; $i <= 2; $i++ ) {
    $input['news_single_shortcode_ad_code'.$i] = $input['news_single_shortcode_ad_code'.$i];
    $input['news_single_shortcode_ad_image'.$i] = wp_filter_nohtml_kses( $input['news_single_shortcode_ad_image'.$i] );
    $input['news_single_shortcode_ad_url'.$i] = wp_filter_nohtml_kses( $input['news_single_shortcode_ad_url'.$i] );
  }
  for ( $i = 1; $i <= 2; $i++ ) {
    $input['news_single_mobile_ad_code'.$i] = $input['news_single_mobile_ad_code'.$i];
    $input['news_single_mobile_ad_image'.$i] = wp_filter_nohtml_kses( $input['news_single_mobile_ad_image'.$i] );
    $input['news_single_mobile_ad_url'.$i] = wp_filter_nohtml_kses( $input['news_single_mobile_ad_url'.$i] );
  }

	return $input;

};


?>
