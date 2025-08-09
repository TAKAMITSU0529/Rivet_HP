<?php
/*
 * ロゴの設定
 */
use TCD\Helper\UI;

// Add default values
add_filter( 'before_getting_design_plus_option', 'add_logo_dp_default_options' );


// Add label of logo tab
add_action( 'tcd_tab_labels', 'add_logo_tab_label' );


// Add HTML of logo tab
add_action( 'tcd_tab_panel', 'add_logo_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_logo_theme_options_validate' );


// タブの名前
function add_logo_tab_label( $tab_labels ) {
	$tab_labels['logo'] = __( 'Logo', 'tcd-w' );
	return $tab_labels;
}


// 初期値
function add_logo_dp_default_options( $dp_default_options ) {

  //ヘッダーロゴ
	$dp_default_options['use_logo_image'] = 'no';
	$dp_default_options['logo_font_size'] = '32';
	$dp_default_options['logo_font_size_mobile'] = '24';
	$dp_default_options['header_logo_image'] = false;
	$dp_default_options['header_logo_image_mobile'] = false;
	$dp_default_options['header_logo_retina'] = '';

  //フッターロゴ
	$dp_default_options['use_logo_image_footer'] = 'no';
	$dp_default_options['logo_font_size_footer'] = '32';
	$dp_default_options['logo_font_size_footer_mobile'] = '24';
	$dp_default_options['footer_logo_image'] = false;
	$dp_default_options['footer_logo_image_mobile'] = false;
	$dp_default_options['footer_logo_retina'] = '';

	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_logo_tab_panel( $options ) {

  global $dp_default_options, $logo_type_options, $site_desc_options;

?>

<div id="tab-content-logo" class="tab-content">


   <?php // ヘッダーのロゴの設定 ----------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Header logo', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e('Type of logo', 'tcd-w');  ?></h4>
     <?php echo tcd_admin_image_radio_button($options, 'use_logo_image', $logo_type_options) ?>

     <div id="header_logo_type1_area">
     <?php echo UI\note(
          [
            sprintf(
              __( '<a href="%s" target="_blank" rel="noopener noreferrer">Site title</a> appears as a logo.','tcd-w' ),
              esc_url( admin_url( '/options-general.php#blogname' ) )
            ),
            __( 'The fonts in the font set (for logos) are reflected.','tcd-w' )
          ]
        ); ?>
      <h4 class="theme_option_headline2"><?php _e('Font', 'tcd-w');  ?></h4>
      <ul class="option_list">
       <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'logo_font_size'); ?></li>
      </ul>
     </div>

     <div id="header_logo_type2_area">
      <h4 class="theme_option_headline2"><?php _e('Image', 'tcd-w');  ?></h4>
      <div class="theme_option_message2">
       <p><?php printf(__('Maximum height is %s. We recommend to use the background transparent PNG image.', 'tcd-w'), '100'); ?><br />
       <?php _e('If you upload a logo image for retina display, please check the following check boxes','tcd-w'); ?></p>
      </div>
      <ul class="option_list">
       <li class="cf">
        <span class="label"><?php _e('Image', 'tcd-w'); ?></span>
        <div class="image_box cf">
         <div class="cf cf_media_field hide-if-no-js header_logo_image">
          <input type="hidden" value="<?php echo esc_attr( $options['header_logo_image'] ); ?>" id="header_logo_image" name="dp_options[header_logo_image]" class="cf_media_id">
          <div class="preview_field"><?php if($options['header_logo_image']){ echo wp_get_attachment_image($options['header_logo_image'], 'full'); }; ?></div>
          <div class="buttton_area">
           <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
           <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['header_logo_image']){ echo 'hidden'; }; ?>">
          </div>
         </div>
        </div>
       </li>
       <li class="cf">
        <span class="label">
         <?php _e('Image (mobile)', 'tcd-w'); ?>
         <span class="recommend_desc"><?php printf(__('Maximum height is %s. We recommend to use the background transparent PNG image.', 'tcd-w'), '50'); ?></span>
        </span>
        <div class="image_box cf">
         <div class="cf cf_media_field hide-if-no-js header_logo_image_mobile">
          <input type="hidden" value="<?php echo esc_attr( $options['header_logo_image_mobile'] ); ?>" id="header_logo_image_mobile" name="dp_options[header_logo_image_mobile]" class="cf_media_id">
          <div class="preview_field"><?php if($options['header_logo_image_mobile']){ echo wp_get_attachment_image($options['header_logo_image_mobile'], 'full'); }; ?></div>
          <div class="buttton_area">
           <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
           <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['header_logo_image_mobile']){ echo 'hidden'; }; ?>">
          </div>
         </div>
        </div>
       </li>
       <li class="cf"><span class="label"><?php _e('Use retina display image', 'tcd-w'); ?></span><label><input id="dp_options[header_logo_retina]" name="dp_options[header_logo_retina]" type="checkbox" value="1" <?php checked( '1', $options['header_logo_retina'] ); ?> /></label></li>
      </ul>
     </div>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // フッターのロゴのタイプ ----------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Footer logo', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e('Type of logo', 'tcd-w');  ?></h4>
     <?php echo tcd_admin_image_radio_button($options, 'use_logo_image_footer', $logo_type_options) ?>

     <div id="footer_logo_type1_area">
     <?php echo UI\note(
          [
            sprintf(
              __( '<a href="%s" target="_blank" rel="noopener noreferrer">Site title</a> appears as a logo.','tcd-w' ),
              esc_url( admin_url( '/options-general.php#blogname' ) )
            ),
            __( 'The fonts in the font set (for logos) are reflected.','tcd-w' )
          ]
        ); ?>
      <h4 class="theme_option_headline2"><?php _e('Font', 'tcd-w');  ?></h4>
      <ul class="option_list">
       <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'logo_font_size_footer'); ?></li>
      </ul>
     </div>

     <div id="footer_logo_type2_area">
      <h4 class="theme_option_headline2"><?php _e('Image', 'tcd-w');  ?></h4>
      <div class="theme_option_message2">
       <p><?php printf(__('Maximum height is %s. We recommend to use the background transparent PNG image.', 'tcd-w'), '140'); ?><br />
       <?php _e('If you upload a logo image for retina display, please check the following check boxes','tcd-w'); ?></p>
      </div>
      <ul class="option_list">
       <li class="cf">
        <span class="label"><?php _e('Image', 'tcd-w'); ?></span>
        <div class="image_box cf">
         <div class="cf cf_media_field hide-if-no-js footer_logo_image">
          <input type="hidden" value="<?php echo esc_attr( $options['footer_logo_image'] ); ?>" id="footer_logo_image" name="dp_options[footer_logo_image]" class="cf_media_id">
          <div class="preview_field"><?php if($options['footer_logo_image']){ echo wp_get_attachment_image($options['footer_logo_image'], 'full'); }; ?></div>
          <div class="buttton_area">
           <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
           <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['footer_logo_image']){ echo 'hidden'; }; ?>">
          </div>
         </div>
        </div>
       </li>
       <li class="cf">
        <span class="label">
         <?php _e('Image (mobile)', 'tcd-w'); ?>
         <span class="recommend_desc"><?php printf(__('Maximum height is %s. We recommend to use the background transparent PNG image.', 'tcd-w'), '50'); ?></span>
        </span>
        <div class="image_box cf">
         <div class="cf cf_media_field hide-if-no-js footer_logo_image_mobile">
          <input type="hidden" value="<?php echo esc_attr( $options['footer_logo_image_mobile'] ); ?>" id="footer_logo_image_mobile" name="dp_options[footer_logo_image_mobile]" class="cf_media_id">
          <div class="preview_field"><?php if($options['footer_logo_image_mobile']){ echo wp_get_attachment_image($options['footer_logo_image_mobile'], 'full'); }; ?></div>
          <div class="buttton_area">
           <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
           <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['footer_logo_image_mobile']){ echo 'hidden'; }; ?>">
          </div>
         </div>
        </div>
       </li>
       <li class="cf"><span class="label"><?php _e('Use retina display image', 'tcd-w'); ?></span><label><input id="dp_options[footer_logo_retina]" name="dp_options[footer_logo_retina]" type="checkbox" value="1" <?php checked( '1', $options['footer_logo_retina'] ); ?> /></label></li>
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
} // END add_logo_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_logo_theme_options_validate( $input ) {

  global $dp_default_options, $logo_type_options;

  // ヘッダーロゴ
  if ( ! isset( $input['use_logo_image'] ) )
    $input['use_logo_image'] = null;
  if ( ! array_key_exists( $input['use_logo_image'], $logo_type_options ) )
    $input['use_logo_image'] = null;
  $input['logo_font_size'] = wp_filter_nohtml_kses( $input['logo_font_size'] );
  $input['logo_font_size_mobile'] = wp_filter_nohtml_kses( $input['logo_font_size_mobile'] );
  $input['header_logo_image'] = wp_filter_nohtml_kses( $input['header_logo_image'] );
  $input['header_logo_image_mobile'] = wp_filter_nohtml_kses( $input['header_logo_image_mobile'] );
  $input['header_logo_retina'] = ! empty( $input['header_logo_retina'] ) ? 1 : 0;


  // フッターロゴ
  if ( ! isset( $input['use_logo_image_footer'] ) )
    $input['use_logo_image_footer'] = null;
  if ( ! array_key_exists( $input['use_logo_image_footer'], $logo_type_options ) )
    $input['use_logo_image_footer'] = null;
  $input['logo_font_size_footer'] = wp_filter_nohtml_kses( $input['logo_font_size_footer'] );
  $input['logo_font_size_footer_mobile'] = wp_filter_nohtml_kses( $input['logo_font_size_footer_mobile'] );
  $input['footer_logo_image'] = wp_filter_nohtml_kses( $input['footer_logo_image'] );
  $input['footer_logo_image_mobile'] = wp_filter_nohtml_kses( $input['footer_logo_image_mobile'] );
  $input['footer_logo_retina'] = ! empty( $input['footer_logo_retina'] ) ? 1 : 0;


	return $input;

};


?>