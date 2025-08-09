<?php
/*
 * スタッフの設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_staff_dp_default_options' );


//  Add label of staff tab
add_action( 'tcd_tab_labels', 'add_staff_tab_label' );


// Add HTML of staff tab
add_action( 'tcd_tab_panel', 'add_staff_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_staff_theme_options_validate' );


// タブの名前
function add_staff_tab_label( $tab_labels ) {
  $options = get_design_plus_option();
  $tab_label = $options['staff_label'] ? esc_html( $options['staff_label'] ) : __( 'Staff', 'tcd-w' );
  $tab_labels['staff'] = $tab_label;
	return $tab_labels;
}


// 初期値
function add_staff_dp_default_options( $dp_default_options ) {

	// 基本設定
	$dp_default_options['staff_label'] = __( 'Staff', 'tcd-w' );
	$dp_default_options['staff_slug'] = 'staff';

	// ヘッダー
	$dp_default_options['staff_title'] = 'STAFF';
	$dp_default_options['staff_sub_title'] = '';
	$dp_default_options['staff_catch'] = __( 'Catchphrase', 'tcd-w' );
	$dp_default_options['staff_desc'] = __( 'Description will be displayed here.<br />Description will be displayed here.', 'tcd-w' );
	$dp_default_options['staff_title_font_size'] = '38';
	$dp_default_options['staff_title_font_size_mobile'] = '22';
	$dp_default_options['staff_sub_title_font_size'] = '18';
	$dp_default_options['staff_sub_title_font_size_mobile'] = '12';
	$dp_default_options['staff_catch_font_size'] = '38';
	$dp_default_options['staff_catch_font_size_mobile'] = '22';
	$dp_default_options['staff_catch_font_color'] = '#58330d';
	$dp_default_options['staff_desc_font_size'] = '16';
	$dp_default_options['staff_desc_font_size_mobile'] = '14';
	$dp_default_options['staff_title_color'] = '#FFFFFF';
	$dp_default_options['staff_bg_image'] = false;
	$dp_default_options['staff_use_overlay'] = 1;
	$dp_default_options['staff_overlay_color'] = '#000000';
	$dp_default_options['staff_overlay_opacity'] = '0.3';

	// スタッフ一覧
	$dp_default_options['archive_staff_title_font_size'] = '22';
	$dp_default_options['archive_staff_title_font_size_mobile'] = '18';
	$dp_default_options['archive_staff_sub_title_font_size'] = '14';
	$dp_default_options['archive_staff_sub_title_font_size_mobile'] = '10';
	$dp_default_options['archive_staff_desc_font_size'] = '16';
	$dp_default_options['archive_staff_desc_font_size_mobile'] = '14';
	$dp_default_options['archive_staff_overlay_color'] = '#000000';
	$dp_default_options['archive_staff_overlay_opacity'] = '0.8';

	// 詳細ページスタッフ一覧
	$dp_default_options['show_single_staff'] = 1;
	$dp_default_options['single_staff_headline'] = 'STAFF';
	$dp_default_options['single_staff_headline_font_size'] = '40';
	$dp_default_options['single_staff_headline_font_size_mobile'] = '22';
	$dp_default_options['single_staff_sub_headline'] = '';
	$dp_default_options['single_staff_sub_headline_font_size'] = '18';
	$dp_default_options['single_staff_sub_headline_font_size_mobile'] = '12';
	$dp_default_options['single_staff_headline_font_color'] = '#58330d';
	$dp_default_options['single_staff_num'] = '6';

	$dp_default_options['show_single_staff_button'] = 1;
	$dp_default_options['single_staff_button_label'] = __( 'Staff list', 'tcd-w' );
	$dp_default_options['single_staff_button_color'] = '#58330c';
	$dp_default_options['single_staff_button_border_color'] = '#59340e';
	$dp_default_options['single_staff_button_color_hover'] = '#ffffff';
	$dp_default_options['single_staff_button_bg_color_hover'] = '#59340e';
	$dp_default_options['single_staff_button_border_color_hover'] = '#59340e';

	// バナー
	$dp_default_options['single_staff_banner_url'] = '';
	$dp_default_options['single_staff_banner_title'] = '';
	$dp_default_options['single_staff_banner_sub_title'] = '';
	$dp_default_options['single_staff_banner_desc'] = '';
	$dp_default_options['single_staff_banner_title_font_size'] = '38';
	$dp_default_options['single_staff_banner_title_font_size_mobile'] = '22';
	$dp_default_options['single_staff_banner_sub_title_font_size'] = '18';
	$dp_default_options['single_staff_banner_sub_title_font_size_mobile'] = '12';
	$dp_default_options['single_staff_banner_desc_font_size'] = '16';
	$dp_default_options['single_staff_banner_desc_font_size_mobile'] = '14';
	$dp_default_options['single_staff_banner_title_color'] = '#FFFFFF';
	$dp_default_options['single_staff_banner_bg_image'] = false;
	$dp_default_options['single_staff_banner_use_overlay'] = 1;
	$dp_default_options['single_staff_banner_overlay_color'] = '#000000';
	$dp_default_options['single_staff_banner_overlay_opacity'] = '0.3';

	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_staff_tab_panel( $options ) {

  global $dp_default_options, $pagenation_type_options;
  $staff_label = $options['staff_label'] ? esc_html( $options['staff_label'] ) : __( 'Staff', 'tcd-w' );

?>

<div id="tab-content-staff" class="tab-content">

   <?php // 基本設定 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Basic setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e('Name of content', 'tcd-w');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('This name will also be used in breadcrumb link and page header.', 'tcd-w'); ?></p>
     </div>
     <input class="full_width" type="text" name="dp_options[staff_label]" value="<?php echo esc_attr( $options['staff_label'] ); ?>" />

     <h4 class="theme_option_headline2"><?php _e('Slug', 'tcd-w');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('Please enter word by alphabet only.<br />After changing slug, please update permalink setting form <a href="./options-permalink.php"><strong>permalink option page</strong></a>.', 'tcd-w'); ?></p>
     </div>
     <p><input class="hankaku full_width" type="text" name="dp_options[staff_slug]" value="<?php echo sanitize_title( $options['staff_slug'] ); ?>" /></p>

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
     <input class="full_width" type="text" name="dp_options[staff_title]" value="<?php echo esc_attr($options['staff_title']); ?>" />
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'staff_title_font_size'); ?></li>
      <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[staff_title_color]" value="<?php echo esc_attr( $options['staff_title_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Sub title', 'tcd-w');  ?></h4>
     <input class="full_width" type="text" name="dp_options[staff_sub_title]" value="<?php echo esc_attr($options['staff_sub_title']); ?>" />
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'staff_sub_title_font_size'); ?></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Catchphrase', 'tcd-w');  ?></h4>
     <textarea class="large-text" cols="50" rows="3" name="dp_options[staff_catch]"><?php echo esc_textarea(  $options['staff_catch'] ); ?></textarea>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'staff_catch_font_size'); ?></li>
      <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[staff_catch_font_color]" value="<?php echo esc_attr( $options['staff_catch_font_color'] ); ?>" data-default-color="#58330d" class="c-color-picker"></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Description', 'tcd-w');  ?></h4>
     <textarea class="large-text" cols="50" rows="3" name="dp_options[staff_desc]"><?php echo esc_textarea(  $options['staff_desc'] ); ?></textarea>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'staff_desc_font_size'); ?></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Background image', 'tcd-w'); ?></h4>
     <ul class="option_list">
      <li class="cf">
       <span class="label">
        <?php _e('Background image', 'tcd-w'); ?>
        <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '1450', '430'); ?></span>
       </span>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js staff_bg_image">
         <input type="hidden" value="<?php echo esc_attr( $options['staff_bg_image'] ); ?>" id="staff_bg_image" name="dp_options[staff_bg_image]" class="cf_media_id">
         <div class="preview_field"><?php if($options['staff_bg_image']){ echo wp_get_attachment_image($options['staff_bg_image'], 'medium'); }; ?></div>
         <div class="buttton_area">
          <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['staff_bg_image']){ echo 'hidden'; }; ?>">
         </div>
        </div>
       </div>
      </li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e( 'Overlay', 'tcd-w' ); ?></h4>
     <p class="displayment_checkbox"><label><input name="dp_options[staff_use_overlay]" type="checkbox" value="1" <?php checked( $options['staff_use_overlay'], 1 ); ?>><?php _e( 'Use overlay', 'tcd-w' ); ?></label></p>
     <div style="<?php if($options['staff_use_overlay'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
       <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-w'); ?></span><input type="text" name="dp_options[staff_overlay_color]" value="<?php echo esc_attr( $options['staff_overlay_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
       <li class="cf">
        <span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[staff_overlay_opacity]" value="<?php echo esc_attr( $options['staff_overlay_opacity'] ); ?>" />
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


   <?php // スタッフ一覧の設定 ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php printf(__('%s list', 'tcd-w'), $staff_label); ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="theme_option_message2">
      <p><?php _e('This options will be used in archive page and single page.', 'tcd-w'); ?></p>
     </div>

     <h4 class="theme_option_headline2"><?php _e( 'Font', 'tcd-w' ); ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'archive_staff_title_font_size'); ?></li>
      <li class="cf"><span class="label"><?php _e('Font size of sub title', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'archive_staff_sub_title_font_size'); ?></li>
      <li class="cf"><span class="label"><?php _e('Font size of description', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'archive_staff_desc_font_size'); ?></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e( 'Overlay', 'tcd-w' ); ?></h4>
     <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
      <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-w'); ?></span><input type="text" name="dp_options[archive_staff_overlay_color]" value="<?php echo esc_attr( $options['archive_staff_overlay_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
      <li class="cf">
       <span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[archive_staff_overlay_opacity]" value="<?php echo esc_attr( $options['archive_staff_overlay_opacity'] ); ?>" />
       <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
        <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
       </div>
      </li>
     </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // 詳細ページの設定 ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php printf(__('%s page', 'tcd-w'), $staff_label); ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php printf(__('%s list', 'tcd-w'), $staff_label); ?></h4>
     <p class="displayment_checkbox"><label><input name="dp_options[show_single_staff]" type="checkbox" value="1" <?php checked( $options['show_single_staff'], 1 ); ?>><?php printf(__('Display %s list', 'tcd-w'), $staff_label); ?></label></p>
     <div style="<?php if($options['show_single_staff'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
       <li class="cf"><span class="label"><?php _e('Headline', 'tcd-w');  ?></span><input class="full_width" type="text" name="dp_options[single_staff_headline]" value="<?php esc_attr_e( $options['single_staff_headline'] ); ?>" /></li>
       <li class="cf"><span class="label"><?php _e('Font size of headline', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'single_staff_headline_font_size'); ?></li>
       <li class="cf"><span class="label"><?php _e('Sub heading', 'tcd-w');  ?></span><input class="full_width" type="text" name="dp_options[single_staff_sub_headline]" value="<?php esc_attr_e( $options['single_staff_sub_headline'] ); ?>" /></li>
       <li class="cf"><span class="label"><?php _e('Font size of sub heading', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'single_staff_sub_headline_font_size'); ?></li>
       <li class="cf"><span class="label"><?php _e('Font color of headline', 'tcd-w'); ?></span><input type="text" name="dp_options[single_staff_headline_font_color]" value="<?php echo esc_attr( $options['single_staff_headline_font_color'] ); ?>" data-default-color="#58330d" class="c-color-picker"></li>
       <li class="cf"><span class="label"><?php _e('Number of post to display', 'tcd-w');  ?></span>
        <select name="dp_options[single_staff_num]">
         <?php for($i=3; $i<= 12; $i++): ?>
         <?php if( $i % 3 == 0 ){ ?>
         <option style="padding-right: 10px;" value="<?php echo esc_attr($i); ?>" <?php selected( $options['single_staff_num'], $i ); ?>><?php echo esc_html($i); ?></option>
         <?php }; ?>
         <?php endfor; ?>
        </select>
       </li>
      </ul>
      <p class="displayment_checkbox" style="border-top:1px dotted #ccc; padding-top:12px;"><label><input name="dp_options[show_single_staff_button]" type="checkbox" value="1" <?php checked( $options['show_single_staff_button'], 1 ); ?>><?php _e( 'Display archive page button', 'tcd-w' ); ?></label></p>
      <div style="<?php if($options['show_single_staff_button'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
       <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
        <li class="cf"><span class="label"><?php _e('label', 'tcd-w');  ?></span><input id="dp_options[single_staff_button_label]" class="full_width" type="text" name="dp_options[single_staff_button_label]" value="<?php esc_attr_e( $options['single_staff_button_label'] ); ?>" style="max-width:50%;" /></li>
        <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[single_staff_button_color]" value="<?php echo esc_attr( $options['single_staff_button_color'] ); ?>" data-default-color="#58330c" class="c-color-picker"></li>
        <li class="cf"><span class="label"><?php _e('Border color', 'tcd-w'); ?></span><input type="text" name="dp_options[single_staff_button_border_color]" value="<?php echo esc_attr( $options['single_staff_button_border_color'] ); ?>" data-default-color="#59340e" class="c-color-picker"></li>
        <li class="cf"><span class="label"><?php _e('Font color of on mouse over', 'tcd-w'); ?></span><input type="text" name="dp_options[single_staff_button_color_hover]" value="<?php echo esc_attr( $options['single_staff_button_color_hover'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
        <li class="cf"><span class="label"><?php _e('Background color on mouse over', 'tcd-w'); ?></span><input type="text" name="dp_options[single_staff_button_bg_color_hover]" value="<?php echo esc_attr( $options['single_staff_button_bg_color_hover'] ); ?>" data-default-color="#59340e" class="c-color-picker"></li>
        <li class="cf"><span class="label"><?php _e('Border color on mouse over', 'tcd-w'); ?></span><input type="text" name="dp_options[single_staff_button_border_color_hover]" value="<?php echo esc_attr( $options['single_staff_button_border_color_hover'] ); ?>" data-default-color="#59340e" class="c-color-picker"></li>
       </ul>
      </div>
     </div>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // バナーの設定 ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Banner content', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e('Title', 'tcd-w');  ?></h4>
     <input class="full_width" type="text" name="dp_options[single_staff_banner_title]" value="<?php echo esc_attr($options['single_staff_banner_title']); ?>" />
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'single_staff_banner_title_font_size'); ?></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Sub title', 'tcd-w');  ?></h4>
     <input class="full_width" type="text" name="dp_options[single_staff_banner_sub_title]" value="<?php echo esc_attr($options['single_staff_banner_sub_title']); ?>" />
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'single_staff_banner_sub_title_font_size'); ?></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Description', 'tcd-w');  ?></h4>
     <textarea class="large-text" cols="50" rows="3" name="dp_options[single_staff_banner_desc]"><?php echo esc_textarea(  $options['single_staff_banner_desc'] ); ?></textarea>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'single_staff_banner_desc_font_size'); ?></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Other setting', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[single_staff_banner_title_color]" value="<?php echo esc_attr( $options['single_staff_banner_title_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('URL', 'tcd-w');  ?></span><input class="full_width" type="text" name="dp_options[single_staff_banner_url]" value="<?php esc_attr_e( $options['single_staff_banner_url'] ); ?>" style="width:50%;" /></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Background image', 'tcd-w'); ?></h4>
     <ul class="option_list">
      <li class="cf">
       <span class="label">
        <?php _e('Background image', 'tcd-w'); ?>
        <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '1000', '300'); ?></span>
       </span>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js single_staff_banner_bg_image">
         <input type="hidden" value="<?php echo esc_attr( $options['single_staff_banner_bg_image'] ); ?>" id="single_staff_banner_bg_image" name="dp_options[single_staff_banner_bg_image]" class="cf_media_id">
         <div class="preview_field"><?php if($options['single_staff_banner_bg_image']){ echo wp_get_attachment_image($options['single_staff_banner_bg_image'], 'medium'); }; ?></div>
         <div class="buttton_area">
          <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['single_staff_banner_bg_image']){ echo 'hidden'; }; ?>">
         </div>
        </div>
       </div>
      </li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e( 'Overlay', 'tcd-w' ); ?></h4>
     <p class="displayment_checkbox"><label><input name="dp_options[single_staff_banner_use_overlay]" type="checkbox" value="1" <?php checked( $options['single_staff_banner_use_overlay'], 1 ); ?>><?php _e( 'Use overlay', 'tcd-w' ); ?></label></p>
     <div style="<?php if($options['single_staff_banner_use_overlay'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
       <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-w'); ?></span><input type="text" name="dp_options[single_staff_banner_overlay_color]" value="<?php echo esc_attr( $options['single_staff_banner_overlay_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
       <li class="cf">
        <span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[single_staff_banner_overlay_opacity]" value="<?php echo esc_attr( $options['single_staff_banner_overlay_opacity'] ); ?>" />
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


</div><!-- END .tab-content -->

<?php
} // END add_staff_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_staff_theme_options_validate( $input ) {

  global $dp_default_options, $pagenation_type_options, $staff_list_animation_type_options;

  // 基本設定
  $input['staff_label'] = wp_filter_nohtml_kses( $input['staff_label'] );

  //ヘッダーの設定
  $input['staff_title'] = wp_filter_nohtml_kses( $input['staff_title'] );
  $input['staff_sub_title'] = wp_filter_nohtml_kses( $input['staff_sub_title'] );
  $input['staff_catch'] = wp_filter_nohtml_kses( $input['staff_catch'] );
  $input['staff_desc'] = wp_filter_nohtml_kses( $input['staff_desc'] );
  $input['staff_title_font_size'] = wp_filter_nohtml_kses( $input['staff_title_font_size'] );
  $input['staff_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['staff_title_font_size_mobile'] );
  $input['staff_sub_title_font_size'] = wp_filter_nohtml_kses( $input['staff_sub_title_font_size'] );
  $input['staff_sub_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['staff_sub_title_font_size_mobile'] );
  $input['staff_catch_font_size'] = wp_filter_nohtml_kses( $input['staff_catch_font_size'] );
  $input['staff_catch_font_size_mobile'] = wp_filter_nohtml_kses( $input['staff_catch_font_size_mobile'] );
  $input['staff_catch_font_color'] = wp_filter_nohtml_kses( $input['staff_catch_font_color'] );
  $input['staff_desc_font_size'] = wp_filter_nohtml_kses( $input['staff_desc_font_size'] );
  $input['staff_desc_font_size_mobile'] = wp_filter_nohtml_kses( $input['staff_desc_font_size_mobile'] );
  $input['staff_title_color'] = wp_filter_nohtml_kses( $input['staff_title_color'] );
  $input['staff_bg_image'] = wp_filter_nohtml_kses( $input['staff_bg_image'] );
  if ( ! isset( $input['staff_use_overlay'] ) )
    $input['staff_use_overlay'] = null;
    $input['staff_use_overlay'] = ( $input['staff_use_overlay'] == 1 ? 1 : 0 );
  $input['staff_overlay_color'] = wp_filter_nohtml_kses( $input['staff_overlay_color'] );
  $input['staff_overlay_opacity'] = wp_filter_nohtml_kses( $input['staff_overlay_opacity'] );

  // アーカイブ
  $input['archive_staff_title_font_size'] = wp_filter_nohtml_kses( $input['archive_staff_title_font_size'] );
  $input['archive_staff_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['archive_staff_title_font_size_mobile'] );
  $input['archive_staff_sub_title_font_size'] = wp_filter_nohtml_kses( $input['archive_staff_sub_title_font_size'] );
  $input['archive_staff_sub_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['archive_staff_sub_title_font_size_mobile'] );
  $input['archive_staff_desc_font_size'] = wp_filter_nohtml_kses( $input['archive_staff_desc_font_size'] );
  $input['archive_staff_desc_font_size_mobile'] = wp_filter_nohtml_kses( $input['archive_staff_desc_font_size_mobile'] );
  $input['archive_staff_overlay_color'] = wp_filter_nohtml_kses( $input['archive_staff_overlay_color'] );
  $input['archive_staff_overlay_opacity'] = wp_filter_nohtml_kses( $input['archive_staff_overlay_opacity'] );

  // 詳細ページ
  if ( ! isset( $input['show_single_staff'] ) )
    $input['show_single_staff'] = null;
    $input['show_single_staff'] = ( $input['show_single_staff'] == 1 ? 1 : 0 );
  $input['single_staff_headline'] = wp_filter_nohtml_kses( $input['single_staff_headline'] );
  $input['single_staff_headline_font_size'] = wp_filter_nohtml_kses( $input['single_staff_headline_font_size'] );
  $input['single_staff_headline_font_size_mobile'] = wp_filter_nohtml_kses( $input['single_staff_headline_font_size_mobile'] );
  $input['single_staff_sub_headline'] = wp_filter_nohtml_kses( $input['single_staff_sub_headline'] );
  $input['single_staff_sub_headline_font_size'] = wp_filter_nohtml_kses( $input['single_staff_sub_headline_font_size'] );
  $input['single_staff_sub_headline_font_size_mobile'] = wp_filter_nohtml_kses( $input['single_staff_sub_headline_font_size_mobile'] );
  $input['single_staff_headline_font_color'] = wp_filter_nohtml_kses( $input['single_staff_headline_font_color'] );
  $input['single_staff_num'] = wp_filter_nohtml_kses( $input['single_staff_num'] );

  //ボタン
  if ( ! isset( $input['show_single_staff_button'] ) )
    $input['show_single_staff_button'] = null;
    $input['show_single_staff_button'] = ( $input['show_single_staff_button'] == 1 ? 1 : 0 );
  $input['single_staff_button_label'] = wp_filter_nohtml_kses( $input['single_staff_button_label'] );
  $input['single_staff_button_color'] = wp_filter_nohtml_kses( $input['single_staff_button_color'] );
  $input['single_staff_button_border_color'] = wp_filter_nohtml_kses( $input['single_staff_button_border_color'] );
  $input['single_staff_button_color_hover'] = wp_filter_nohtml_kses( $input['single_staff_button_color_hover'] );
  $input['single_staff_button_bg_color_hover'] = wp_filter_nohtml_kses( $input['single_staff_button_bg_color_hover'] );
  $input['single_staff_button_border_color_hover'] = wp_filter_nohtml_kses( $input['single_staff_button_border_color_hover'] );

  //バナーの設定
  $input['single_staff_banner_title'] = wp_filter_nohtml_kses( $input['single_staff_banner_title'] );
  $input['single_staff_banner_sub_title'] = wp_filter_nohtml_kses( $input['single_staff_banner_sub_title'] );
  $input['single_staff_banner_desc'] = wp_filter_nohtml_kses( $input['single_staff_banner_desc'] );
  $input['single_staff_banner_title_font_size'] = wp_filter_nohtml_kses( $input['single_staff_banner_title_font_size'] );
  $input['single_staff_banner_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['single_staff_banner_title_font_size_mobile'] );
  $input['single_staff_banner_sub_title_font_size'] = wp_filter_nohtml_kses( $input['single_staff_banner_sub_title_font_size'] );
  $input['single_staff_banner_sub_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['single_staff_banner_sub_title_font_size_mobile'] );
  $input['single_staff_banner_desc_font_size'] = wp_filter_nohtml_kses( $input['single_staff_banner_desc_font_size'] );
  $input['single_staff_banner_desc_font_size_mobile'] = wp_filter_nohtml_kses( $input['single_staff_banner_desc_font_size_mobile'] );
  $input['single_staff_banner_title_color'] = wp_filter_nohtml_kses( $input['single_staff_banner_title_color'] );
  $input['single_staff_banner_bg_image'] = wp_filter_nohtml_kses( $input['single_staff_banner_bg_image'] );
  if ( ! isset( $input['single_staff_banner_use_overlay'] ) )
    $input['single_staff_banner_use_overlay'] = null;
    $input['single_staff_banner_use_overlay'] = ( $input['single_staff_banner_use_overlay'] == 1 ? 1 : 0 );
  $input['single_staff_banner_overlay_color'] = wp_filter_nohtml_kses( $input['single_staff_banner_overlay_color'] );
  $input['single_staff_banner_overlay_opacity'] = wp_filter_nohtml_kses( $input['single_staff_banner_overlay_opacity'] );
  $input['single_staff_banner_url'] = wp_filter_nohtml_kses( $input['single_staff_banner_url'] );


	return $input;

};


?>