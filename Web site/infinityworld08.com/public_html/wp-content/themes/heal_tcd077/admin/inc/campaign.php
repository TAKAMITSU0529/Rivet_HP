<?php
/*
 * キャンペーンの設定
 */

 use TCD\Helper\UI;
 use TCD\Helper\Sanitization as San;

// Add default values
add_filter( 'before_getting_design_plus_option', 'add_campaign_dp_default_options' );


//  Add label of campaign tab
add_action( 'tcd_tab_labels', 'add_campaign_tab_label' );


// Add HTML of campaign tab
add_action( 'tcd_tab_panel', 'add_campaign_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_campaign_theme_options_validate' );


// タブの名前
function add_campaign_tab_label( $tab_labels ) {
  $options = get_design_plus_option();
  $tab_label = $options['campaign_label'] ? esc_html( $options['campaign_label'] ) : __( 'Campaign', 'tcd-w' );
  $tab_labels['campaign'] = $tab_label;
	return $tab_labels;
}


// 初期値
function add_campaign_dp_default_options( $dp_default_options ) {

	// 基本設定
	$dp_default_options['campaign_label'] = __( 'Campaign', 'tcd-w' );
	$dp_default_options['campaign_slug'] = 'campaign';

	// ヘッダー
	$dp_default_options['campaign_title'] = 'CAMPAIGN';
	$dp_default_options['campaign_sub_title'] = '';
	$dp_default_options['campaign_title_font_size'] = '38';
	$dp_default_options['campaign_title_font_size_mobile'] = '22';
	$dp_default_options['campaign_sub_title_font_size'] = '18';
	$dp_default_options['campaign_sub_title_font_size_mobile'] = '12';
	$dp_default_options['campaign_title_color'] = '#FFFFFF';
	$dp_default_options['campaign_bg_image'] = false;
	$dp_default_options['campaign_use_overlay'] = 1;
	$dp_default_options['campaign_overlay_color'] = '#000000';
	$dp_default_options['campaign_overlay_opacity'] = '0.3';

	// アーカイブページ
	$dp_default_options['archive_campaign_title_font_size'] = '20';
	$dp_default_options['archive_campaign_title_font_size_mobile'] = '16';
	$dp_default_options['show_archive_campaign_date'] = 1;
	$dp_default_options['archive_campaign_num'] = '10';

	// 記事ページ
	$dp_default_options['single_campaign_title_font_size'] = '28';
	$dp_default_options['single_campaign_content_font_size'] = '16';
	$dp_default_options['single_campaign_title_font_size_mobile'] = '20';
	$dp_default_options['single_campaign_content_font_size_mobile'] = '16';
	$dp_default_options['single_campaign_show_date'] = 1;
	$dp_default_options['show_sns_top_campaign'] = 1;
	$dp_default_options['show_sns_btm_campaign'] = 1;
	$dp_default_options['show_copy_top_campaign'] = '';
	$dp_default_options['show_copy_btm_campaign'] = '';
	$dp_default_options['show_next_post_campaign'] = 1;

	// 関連記事
	$dp_default_options['show_related_campaign'] = 1;
	$dp_default_options['related_campaign_headline'] = __( 'Related campaign', 'tcd-w' );
	$dp_default_options['related_campaign_headline_font_type'] = 1;
	$dp_default_options['related_campaign_headline_font_size'] = '16';
	$dp_default_options['related_campaign_headline_font_size_mobile'] = '14';
	$dp_default_options['related_campaign_headline_font_color'] = '#ffffff';
	$dp_default_options['related_campaign_headline_bg_color'] = '#58330d';
	$dp_default_options['related_campaign_num'] = '6';
	$dp_default_options['related_campaign_list_title_font_size'] = '14';
	$dp_default_options['related_campaign_list_title_font_size_mobile'] = '13';

	$dp_default_options['show_related_campaign_button'] = 1;
	$dp_default_options['related_campaign_button_label'] = __( 'Campaign list', 'tcd-w' );
	$dp_default_options['related_campaign_type'] = 'type2';
	$dp_default_options['related_campaign_button_color'] = '#58330c';
	$dp_default_options['related_campaign_button_border_color'] = '#59340e';
	$dp_default_options['related_campaign_button_color_hover'] = '#ffffff';
	$dp_default_options['related_campaign_button_bg_color_hover'] = '#59340e';
	$dp_default_options['related_campaign_button_border_color_hover'] = '#59340e';


	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_campaign_tab_panel( $options ) {

  global $dp_default_options, $font_type_options;
  $campaign_label = $options['campaign_label'] ? esc_html( $options['campaign_label'] ) : __( 'Campaign', 'tcd-w' );

?>

<div id="tab-content-campaign" class="tab-content">

   <?php // 基本設定 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Basic setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e('Name of content', 'tcd-w');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('This name will also be used in breadcrumb link and page header.', 'tcd-w'); ?></p>
     </div>
     <input class="full_width" type="text" name="dp_options[campaign_label]" value="<?php echo esc_attr( $options['campaign_label'] ); ?>" />

     <h4 class="theme_option_headline2"><?php _e('Slug', 'tcd-w');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('Please enter word by alphabet only.<br />After changing slug, please update permalink setting form <a href="./options-permalink.php"><strong>permalink option page</strong></a>.', 'tcd-w'); ?></p>
     </div>
     <p><input class="hankaku full_width" type="text" name="dp_options[campaign_slug]" value="<?php echo sanitize_title( $options['campaign_slug'] ); ?>" /></p>

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
     <input class="full_width" type="text" name="dp_options[campaign_title]" value="<?php echo esc_attr($options['campaign_title']); ?>" />
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'campaign_title_font_size'); ?></li>
      <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[campaign_title_color]" value="<?php echo esc_attr( $options['campaign_title_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Sub title', 'tcd-w');  ?></h4>
     <input class="full_width" type="text" name="dp_options[campaign_sub_title]" value="<?php echo esc_attr($options['campaign_sub_title']); ?>" />
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'campaign_sub_title_font_size'); ?></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Background image', 'tcd-w'); ?></h4>
     <ul class="option_list">
      <li class="cf">
       <span class="label">
        <?php _e('Background image', 'tcd-w'); ?>
        <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '1450', '430'); ?></span>
       </span>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js campaign_bg_image">
         <input type="hidden" value="<?php echo esc_attr( $options['campaign_bg_image'] ); ?>" id="campaign_bg_image" name="dp_options[campaign_bg_image]" class="cf_media_id">
         <div class="preview_field"><?php if($options['campaign_bg_image']){ echo wp_get_attachment_image($options['campaign_bg_image'], 'medium'); }; ?></div>
         <div class="buttton_area">
          <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['campaign_bg_image']){ echo 'hidden'; }; ?>">
         </div>
        </div>
       </div>
      </li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e( 'Overlay', 'tcd-w' ); ?></h4>
     <p class="displayment_checkbox"><label><input name="dp_options[campaign_use_overlay]" type="checkbox" value="1" <?php checked( $options['campaign_use_overlay'], 1 ); ?>><?php _e( 'Use overlay', 'tcd-w' ); ?></label></p>
     <div style="<?php if($options['campaign_use_overlay'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
       <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-w'); ?></span><input type="text" name="dp_options[campaign_overlay_color]" value="<?php echo esc_attr( $options['campaign_overlay_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
       <li class="cf">
        <span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[campaign_overlay_opacity]" value="<?php echo esc_attr( $options['campaign_overlay_opacity'] ); ?>" />
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

     <h4 class="theme_option_headline2"><?php printf(__('%s list', 'tcd-w'), $campaign_label); ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'archive_campaign_title_font_size'); ?></li>
      <li class="cf">
       <span class="label"><?php _e('Number of post to display', 'tcd-w'); ?></span>
       <select name="dp_options[archive_campaign_num]">
        <?php for($i=10; $i<= 20; $i++): ?>
        <option style="padding-right: 10px;" value="<?php echo esc_attr($i); ?>" <?php selected( $options['archive_campaign_num'], $i ); ?>><?php echo esc_html($i); ?></option>
        <?php endfor; ?>
       </select>
      </li>
      <li class="cf"><span class="label"><?php _e('Display date', 'tcd-w'); ?></span><input name="dp_options[show_archive_campaign_date]" type="checkbox" value="1" <?php checked( '1', $options['show_archive_campaign_date'] ); ?> /></li>
     </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // 記事ページの設定 -------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php printf(__('%s page', 'tcd-w'), $campaign_label); ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e('Font', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'single_campaign_title_font_size'); ?></li>
      <li class="cf"><span class="label"><?php _e('Font size of content', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'single_campaign_content_font_size'); ?></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Display setting', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Display date under title', 'tcd-w');  ?></span><input name="dp_options[single_campaign_show_date]" type="checkbox" value="1" <?php checked( '1', $options['single_campaign_show_date'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('Display social button under featured image', 'tcd-w');  ?></span><input name="dp_options[show_sns_top_campaign]" type="checkbox" value="1" <?php checked( '1', $options['show_sns_top_campaign'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('Display social button under post content', 'tcd-w');  ?></span><input name="dp_options[show_sns_btm_campaign]" type="checkbox" value="1" <?php checked( '1', $options['show_sns_btm_campaign'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('Display "COPY Title&amp;URL" button under featured image', 'tcd-w');  ?></span><input name="dp_options[show_copy_top_campaign]" type="checkbox" value="1" <?php checked( '1', $options['show_copy_top_campaign'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('Display "COPY Title&amp;URL" button under post content', 'tcd-w');  ?></span><input name="dp_options[show_copy_btm_campaign]" type="checkbox" value="1" <?php checked( '1', $options['show_copy_btm_campaign'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('Display next previous post link', 'tcd-w');  ?></span><input name="dp_options[show_next_post_campaign]" type="checkbox" value="1" <?php checked( '1', $options['show_next_post_campaign'] ); ?> /></li>
     </ul>

     <h4 class="theme_option_headline2"><?php printf(__('Related %s list', 'tcd-w'), $campaign_label); ?></h4>
     <p class="displayment_checkbox"><label><input name="dp_options[show_related_campaign]" type="checkbox" value="1" <?php checked( $options['show_related_campaign'], 1 ); ?>><?php printf(__('Display related %s list', 'tcd-w'), $campaign_label); ?></label></p>
     <div style="<?php if($options['show_related_campaign'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
       <li class="cf">
        <span class="label"><?php _e('Post order', 'tcd-w');  ?></span>
        <div class="standard_radio_button">
         <input id="related_campaign_type1" type="radio" name="dp_options[related_campaign_type]" value="type1" <?php checked( $options['related_campaign_type'], 'type1' ); ?>>
         <label for="related_campaign_type1"><?php _e('Date (DESC)', 'tcd-w'); ?></label>
         <input id="related_campaign_type2" type="radio" name="dp_options[related_campaign_type]" value="type2" <?php checked( $options['related_campaign_type'], 'type2' ); ?>>
         <label for="related_campaign_type2"><?php _e('Random', 'tcd-w'); ?></label>
        </div>
       </li>
       <li class="cf"><span class="label"><?php _e('Headline', 'tcd-w');  ?></span><input class="full_width" type="text" name="dp_options[related_campaign_headline]" value="<?php esc_attr_e( $options['related_campaign_headline'] ); ?>" /></li>
       <li class="cf"><span class="label"><?php _e('Font type of headline', 'tcd-w'); ?></span>
       <?php echo UI\font_select( 'dp_options[related_campaign_headline_font_type]', $options['related_campaign_headline_font_type'] ); ?>
       </li>
       <li class="cf"><span class="label"><?php _e('Font size of headline', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'related_campaign_headline_font_size'); ?></li>
       <li class="cf"><span class="label"><?php _e('Font color of headline', 'tcd-w'); ?></span><input type="text" name="dp_options[related_campaign_headline_font_color]" value="<?php echo esc_attr( $options['related_campaign_headline_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
       <li class="cf"><span class="label"><?php _e('Background color of headline', 'tcd-w'); ?></span><input type="text" name="dp_options[related_campaign_headline_bg_color]" value="<?php echo esc_attr( $options['related_campaign_headline_bg_color'] ); ?>" data-default-color="#58330d" class="c-color-picker"></li>
       <li class="cf"><span class="label"><?php _e('Number of post to display', 'tcd-w');  ?></span>
        <select name="dp_options[related_campaign_num]">
         <?php for($i=3; $i<= 12; $i++): ?>
         <?php if( $i % 3 == 0 ){ ?>
         <option style="padding-right: 10px;" value="<?php echo esc_attr($i); ?>" <?php selected( $options['related_campaign_num'], $i ); ?>><?php echo esc_html($i); ?></option>
         <?php }; ?>
         <?php endfor; ?>
        </select>
       </li>
       <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'related_campaign_list_title_font_size'); ?></li>
      </ul>

      <p class="displayment_checkbox" style="border-top:1px dotted #ccc; padding-top:12px;"><label><input name="dp_options[show_related_campaign_button]" type="checkbox" value="1" <?php checked( $options['show_related_campaign_button'], 1 ); ?>><?php _e( 'Display archive page button', 'tcd-w' ); ?></label></p>
      <div style="<?php if($options['show_related_campaign_button'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
       <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
        <li class="cf"><span class="label"><?php _e('label', 'tcd-w');  ?></span><input id="dp_options[related_campaign_button_label]" class="full_width" type="text" name="dp_options[related_campaign_button_label]" value="<?php esc_attr_e( $options['related_campaign_button_label'] ); ?>" style="max-width:50%;" /></li>
        <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[related_campaign_button_color]" value="<?php echo esc_attr( $options['related_campaign_button_color'] ); ?>" data-default-color="#58330c" class="c-color-picker"></li>
        <li class="cf"><span class="label"><?php _e('Border color', 'tcd-w'); ?></span><input type="text" name="dp_options[related_campaign_button_border_color]" value="<?php echo esc_attr( $options['related_campaign_button_border_color'] ); ?>" data-default-color="#59340e" class="c-color-picker"></li>
        <li class="cf color_picker_bottom"><span class="label"><?php _e('Font color of on mouse over', 'tcd-w'); ?></span><input type="text" name="dp_options[related_campaign_button_color_hover]" value="<?php echo esc_attr( $options['related_campaign_button_color_hover'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
        <li class="cf color_picker_bottom"><span class="label"><?php _e('Background color on mouse over', 'tcd-w'); ?></span><input type="text" name="dp_options[related_campaign_button_bg_color_hover]" value="<?php echo esc_attr( $options['related_campaign_button_bg_color_hover'] ); ?>" data-default-color="#59340e" class="c-color-picker"></li>
        <li class="cf color_picker_bottom"><span class="label"><?php _e('Border color on mouse over', 'tcd-w'); ?></span><input type="text" name="dp_options[related_campaign_button_border_color_hover]" value="<?php echo esc_attr( $options['related_campaign_button_border_color_hover'] ); ?>" data-default-color="#59340e" class="c-color-picker"></li>
       </ul>
      </div>
     </div>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


</div><!-- END .tab-content -->

<?php
} // END add_campaign_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_campaign_theme_options_validate( $input ) {

  global $dp_default_options, $font_type_options;

  // 基本設定
  $input['campaign_label'] = wp_filter_nohtml_kses( $input['campaign_label'] );

  //ヘッダーの設定
  $input['campaign_title'] = wp_filter_nohtml_kses( $input['campaign_title'] );
  $input['campaign_sub_title'] = wp_filter_nohtml_kses( $input['campaign_sub_title'] );
  $input['campaign_title_font_size'] = wp_filter_nohtml_kses( $input['campaign_title_font_size'] );
  $input['campaign_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['campaign_title_font_size_mobile'] );
  $input['campaign_sub_title_font_size'] = wp_filter_nohtml_kses( $input['campaign_sub_title_font_size'] );
  $input['campaign_sub_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['campaign_sub_title_font_size_mobile'] );
  $input['campaign_title_color'] = wp_filter_nohtml_kses( $input['campaign_title_color'] );
  $input['campaign_bg_image'] = wp_filter_nohtml_kses( $input['campaign_bg_image'] );
  if ( ! isset( $input['campaign_use_overlay'] ) )
    $input['campaign_use_overlay'] = null;
    $input['campaign_use_overlay'] = ( $input['campaign_use_overlay'] == 1 ? 1 : 0 );
  $input['campaign_overlay_color'] = wp_filter_nohtml_kses( $input['campaign_overlay_color'] );
  $input['campaign_overlay_opacity'] = wp_filter_nohtml_kses( $input['campaign_overlay_opacity'] );

  // アーカイブ
  $input['archive_campaign_title_font_size'] = wp_filter_nohtml_kses( $input['archive_campaign_title_font_size'] );
  $input['archive_campaign_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['archive_campaign_title_font_size_mobile'] );
  $input['archive_campaign_num'] = wp_filter_nohtml_kses( $input['archive_campaign_num'] );
  if ( ! isset( $input['show_archive_campaign_date'] ) )
    $input['show_archive_campaign_date'] = null;
    $input['show_archive_campaign_date'] = ( $input['show_archive_campaign_date'] == 1 ? 1 : 0 );

  // 記事ページ
  $input['single_campaign_title_font_size'] = wp_filter_nohtml_kses( $input['single_campaign_title_font_size'] );
  $input['single_campaign_content_font_size'] = wp_filter_nohtml_kses( $input['single_campaign_content_font_size'] );
  $input['single_campaign_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['single_campaign_title_font_size_mobile'] );
  $input['single_campaign_content_font_size_mobile'] = wp_filter_nohtml_kses( $input['single_campaign_content_font_size_mobile'] );
  if ( ! isset( $input['single_campaign_show_date'] ) )
    $input['single_campaign_show_date'] = null;
    $input['single_campaign_show_date'] = ( $input['single_campaign_show_date'] == 1 ? 1 : 0 );
  if ( ! isset( $input['show_sns_top_campaign'] ) )
    $input['show_sns_top_campaign'] = null;
    $input['show_sns_top_campaign'] = ( $input['show_sns_top_campaign'] == 1 ? 1 : 0 );
  if ( ! isset( $input['show_sns_btm_campaign'] ) )
    $input['show_sns_btm_campaign'] = null;
    $input['show_sns_btm_campaign'] = ( $input['show_sns_btm_campaign'] == 1 ? 1 : 0 );
  if ( ! isset( $input['show_copy_top_campaign'] ) )
    $input['show_copy_top_campaign'] = null;
    $input['show_copy_top_campaign'] = ( $input['show_copy_top_campaign'] == 1 ? 1 : 0 );
  if ( ! isset( $input['show_copy_btm_campaign'] ) )
    $input['show_copy_btm_campaign'] = null;
    $input['show_copy_btm_campaign'] = ( $input['show_copy_btm_campaign'] == 1 ? 1 : 0 );
  if ( ! isset( $input['show_next_post_campaign'] ) )
    $input['show_next_post_campaign'] = null;
    $input['show_next_post_campaign'] = ( $input['show_next_post_campaign'] == 1 ? 1 : 0 );


  // 関連記事
  if ( ! isset( $input['show_related_campaign'] ) )
    $input['show_related_campaign'] = null;
    $input['show_related_campaign'] = ( $input['show_related_campaign'] == 1 ? 1 : 0 );
  $input['related_campaign_type'] = wp_filter_nohtml_kses( $input['related_campaign_type'] );
  $input['related_campaign_headline'] = wp_filter_nohtml_kses( $input['related_campaign_headline'] );
  $input['related_campaign_headline_font_type'] = San\choice( $input['related_campaign_headline_font_type'], [ '1', '2', '3' ] );
  $input['related_campaign_headline_font_size'] = wp_filter_nohtml_kses( $input['related_campaign_headline_font_size'] );
  $input['related_campaign_headline_font_size_mobile'] = wp_filter_nohtml_kses( $input['related_campaign_headline_font_size_mobile'] );
  $input['related_campaign_headline_font_color'] = wp_filter_nohtml_kses( $input['related_campaign_headline_font_color'] );
  $input['related_campaign_headline_bg_color'] = wp_filter_nohtml_kses( $input['related_campaign_headline_bg_color'] );
  $input['related_campaign_num'] = wp_filter_nohtml_kses( $input['related_campaign_num'] );
  $input['related_campaign_list_title_font_size'] = wp_filter_nohtml_kses( $input['related_campaign_list_title_font_size'] );
  $input['related_campaign_list_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['related_campaign_list_title_font_size_mobile'] );


  //ボタン
  if ( ! isset( $input['show_related_campaign_button'] ) )
    $input['show_related_campaign_button'] = null;
    $input['show_related_campaign_button'] = ( $input['show_related_campaign_button'] == 1 ? 1 : 0 );
  $input['related_campaign_button_label'] = wp_filter_nohtml_kses( $input['related_campaign_button_label'] );
  $input['related_campaign_button_color'] = wp_filter_nohtml_kses( $input['related_campaign_button_color'] );
  $input['related_campaign_button_border_color'] = wp_filter_nohtml_kses( $input['related_campaign_button_border_color'] );
  $input['related_campaign_button_color_hover'] = wp_filter_nohtml_kses( $input['related_campaign_button_color_hover'] );
  $input['related_campaign_button_bg_color_hover'] = wp_filter_nohtml_kses( $input['related_campaign_button_bg_color_hover'] );
  $input['related_campaign_button_border_color_hover'] = wp_filter_nohtml_kses( $input['related_campaign_button_border_color_hover'] );


	return $input;

};


?>