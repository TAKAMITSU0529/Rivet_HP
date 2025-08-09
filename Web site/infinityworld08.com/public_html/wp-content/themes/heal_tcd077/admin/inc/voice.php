<?php
/*
 * お客様の声の設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_voice_dp_default_options' );


//  Add label of voice tab
add_action( 'tcd_tab_labels', 'add_voice_tab_label' );


// Add HTML of voice tab
add_action( 'tcd_tab_panel', 'add_voice_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_voice_theme_options_validate' );


// タブの名前
function add_voice_tab_label( $tab_labels ) {
  $options = get_design_plus_option();
  $tab_label = $options['voice_label'] ? esc_html( $options['voice_label'] ) : __( 'Voice', 'tcd-w' );
  $tab_labels['voice'] = $tab_label;
	return $tab_labels;
}


// 初期値
function add_voice_dp_default_options( $dp_default_options ) {

	// 基本設定
	$dp_default_options['voice_label'] = __( 'Voice', 'tcd-w' );
	$dp_default_options['voice_slug'] = 'voice';

	// ヘッダー
	$dp_default_options['voice_title'] = 'VOICE';
	$dp_default_options['voice_sub_title'] = '';
	$dp_default_options['voice_catch'] = __( 'Catchphrase', 'tcd-w' );
	$dp_default_options['voice_desc'] = __( 'Description will be displayed here.<br />Description will be displayed here.', 'tcd-w' );
	$dp_default_options['voice_title_font_size'] = '38';
	$dp_default_options['voice_title_font_size_mobile'] = '20';
	$dp_default_options['voice_sub_title_font_size'] = '18';
	$dp_default_options['voice_sub_title_font_size_mobile'] = '15';
	$dp_default_options['voice_catch_font_size'] = '38';
	$dp_default_options['voice_catch_font_size_mobile'] = '20';
	$dp_default_options['voice_desc_font_size'] = '16';
	$dp_default_options['voice_desc_font_size_mobile'] = '14';
	$dp_default_options['voice_title_color'] = '#FFFFFF';
	$dp_default_options['voice_catch_font_color'] = '#58330d';
	$dp_default_options['voice_bg_image'] = false;
	$dp_default_options['voice_use_overlay'] = 1;
	$dp_default_options['voice_overlay_color'] = '#000000';
	$dp_default_options['voice_overlay_opacity'] = '0.3';

	// アーカイブページ
	$dp_default_options['archive_voice_title_font_color'] = '#58330d';
	$dp_default_options['archive_voice_title_font_size'] = '18';
	$dp_default_options['archive_voice_title_font_size_mobile'] = '16';
	$dp_default_options['archive_voice_content_font_size'] = '16';
	$dp_default_options['archive_voice_content_font_size_mobile'] = '12';
	$dp_default_options['archive_voice_num'] = '10';

	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_voice_tab_panel( $options ) {

  global $dp_default_options, $pagenation_type_options;
  $voice_label = $options['voice_label'] ? esc_html( $options['voice_label'] ) : __( 'Voice', 'tcd-w' );

?>

<div id="tab-content-voice" class="tab-content">

   <?php // 基本設定 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Basic setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e('Name of content', 'tcd-w');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('This name will also be used in breadcrumb link and page header.', 'tcd-w'); ?></p>
     </div>
     <input class="full_width" type="text" name="dp_options[voice_label]" value="<?php echo esc_attr( $options['voice_label'] ); ?>" />

     <h4 class="theme_option_headline2"><?php _e('Slug setting', 'tcd-w');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('Please enter word by alphabet only.<br />After changing slug, please update permalink setting form <a href="./options-permalink.php"><strong>permalink option page</strong></a>.', 'tcd-w'); ?></p>
     </div>
     <p><input class="hankaku full_width" type="text" name="dp_options[voice_slug]" value="<?php echo sanitize_title( $options['voice_slug'] ); ?>" /></p>

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
     <input class="full_width" type="text" name="dp_options[voice_title]" value="<?php echo esc_attr($options['voice_title']); ?>" />
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'voice_title_font_size'); ?></li>
      <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[voice_title_color]" value="<?php echo esc_attr( $options['voice_title_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Sub title', 'tcd-w');  ?></h4>
     <input class="full_width" type="text" name="dp_options[voice_sub_title]" value="<?php echo esc_attr($options['voice_sub_title']); ?>" />
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'voice_sub_title_font_size'); ?></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Catchphrase', 'tcd-w');  ?></h4>
     <textarea class="large-text" cols="50" rows="3" name="dp_options[voice_catch]"><?php echo esc_textarea(  $options['voice_catch'] ); ?></textarea>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'voice_catch_font_size'); ?></li>
      <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[voice_catch_font_color]" value="<?php echo esc_attr( $options['voice_catch_font_color'] ); ?>" data-default-color="#58330d" class="c-color-picker"></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Description', 'tcd-w');  ?></h4>
     <textarea class="large-text" cols="50" rows="3" name="dp_options[voice_desc]"><?php echo esc_textarea(  $options['voice_desc'] ); ?></textarea>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'voice_desc_font_size'); ?></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Background image', 'tcd-w'); ?></h4>
     <ul class="option_list">
      <li class="cf">
       <span class="label">
        <?php _e('Background image', 'tcd-w'); ?>
        <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '1450', '430'); ?></span>
       </span>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js voice_bg_image">
         <input type="hidden" value="<?php echo esc_attr( $options['voice_bg_image'] ); ?>" id="voice_bg_image" name="dp_options[voice_bg_image]" class="cf_media_id">
         <div class="preview_field"><?php if($options['voice_bg_image']){ echo wp_get_attachment_image($options['voice_bg_image'], 'medium'); }; ?></div>
         <div class="buttton_area">
          <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['voice_bg_image']){ echo 'hidden'; }; ?>">
         </div>
        </div>
       </div>
      </li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e( 'Overlay', 'tcd-w' ); ?></h4>
     <p class="displayment_checkbox"><label><input name="dp_options[voice_use_overlay]" type="checkbox" value="1" <?php checked( $options['voice_use_overlay'], 1 ); ?>><?php _e( 'Use overlay', 'tcd-w' ); ?></label></p>
     <div style="<?php if($options['voice_use_overlay'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
       <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-w'); ?></span><input type="text" name="dp_options[voice_overlay_color]" value="<?php echo esc_attr( $options['voice_overlay_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
       <li class="cf">
        <span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[voice_overlay_opacity]" value="<?php echo esc_attr( $options['voice_overlay_opacity'] ); ?>" />
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

     <h4 class="theme_option_headline2"><?php printf(__('%s list', 'tcd-w'), $voice_label); ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'archive_voice_title_font_size'); ?></li>
      <li class="cf"><span class="label"><?php _e('Font color of title', 'tcd-w'); ?></span><input type="text" name="dp_options[archive_voice_title_font_color]" value="<?php echo esc_attr( $options['archive_voice_title_font_color'] ); ?>" data-default-color="#58330d" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Font size of content', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'archive_voice_content_font_size'); ?></li>
      <li class="cf">
       <span class="label"><?php _e('Number of post to display', 'tcd-w'); ?></span>
       <select name="dp_options[archive_voice_num]">
        <?php for($i=6; $i<= 20; $i++): if( ($i % 2) == 0 ){ ?>
        <option style="padding-right: 10px;" value="<?php echo esc_attr($i); ?>" <?php selected( $options['archive_voice_num'], $i ); ?>><?php echo esc_html($i); ?></option>
        <?php }; endfor; ?>
       </select>
      </li>
     </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


</div><!-- END .tab-content -->

<?php
} // END add_voice_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_voice_theme_options_validate( $input ) {

  global $dp_default_options, $pagenation_type_options, $voice_list_animation_type_options;

  // 基本設定
  $input['voice_label'] = wp_filter_nohtml_kses( $input['voice_label'] );

  //ヘッダーの設定
  $input['voice_title'] = wp_filter_nohtml_kses( $input['voice_title'] );
  $input['voice_sub_title'] = wp_filter_nohtml_kses( $input['voice_sub_title'] );
  $input['voice_catch'] = wp_filter_nohtml_kses( $input['voice_catch'] );
  $input['voice_desc'] = wp_filter_nohtml_kses( $input['voice_desc'] );
  $input['voice_title_font_size'] = wp_filter_nohtml_kses( $input['voice_title_font_size'] );
  $input['voice_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['voice_title_font_size_mobile'] );
  $input['voice_sub_title_font_size'] = wp_filter_nohtml_kses( $input['voice_sub_title_font_size'] );
  $input['voice_sub_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['voice_sub_title_font_size_mobile'] );
  $input['voice_catch_font_size'] = wp_filter_nohtml_kses( $input['voice_catch_font_size'] );
  $input['voice_catch_font_size_mobile'] = wp_filter_nohtml_kses( $input['voice_catch_font_size_mobile'] );
  $input['voice_desc_font_size'] = wp_filter_nohtml_kses( $input['voice_desc_font_size'] );
  $input['voice_desc_font_size_mobile'] = wp_filter_nohtml_kses( $input['voice_desc_font_size_mobile'] );
  $input['voice_title_color'] = wp_filter_nohtml_kses( $input['voice_title_color'] );
  $input['voice_catch_font_color'] = wp_filter_nohtml_kses( $input['voice_catch_font_color'] );
  $input['voice_bg_image'] = wp_filter_nohtml_kses( $input['voice_bg_image'] );
  if ( ! isset( $input['voice_use_overlay'] ) )
    $input['voice_use_overlay'] = null;
    $input['voice_use_overlay'] = ( $input['voice_use_overlay'] == 1 ? 1 : 0 );
  $input['voice_overlay_color'] = wp_filter_nohtml_kses( $input['voice_overlay_color'] );
  $input['voice_overlay_opacity'] = wp_filter_nohtml_kses( $input['voice_overlay_opacity'] );

  // アーカイブ
  $input['archive_voice_title_font_size'] = wp_filter_nohtml_kses( $input['archive_voice_title_font_size'] );
  $input['archive_voice_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['archive_voice_title_font_size_mobile'] );
  $input['archive_voice_title_font_color'] = wp_filter_nohtml_kses( $input['archive_voice_title_font_color'] );
  $input['archive_voice_content_font_size'] = wp_filter_nohtml_kses( $input['archive_voice_content_font_size'] );
  $input['archive_voice_content_font_size_mobile'] = wp_filter_nohtml_kses( $input['archive_voice_content_font_size_mobile'] );
  $input['archive_voice_num'] = wp_filter_nohtml_kses( $input['archive_voice_num'] );

	return $input;

};


?>