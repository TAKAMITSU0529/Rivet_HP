<?php
/*
 * 基本設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_seo_dp_default_options' );


// Add label of seo tab
add_action( 'tcd_tab_labels', 'add_seo_tab_label' );


// Add HTML of seo tab
add_action( 'tcd_tab_panel', 'add_seo_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_seo_theme_options_validate' );


// タブの名前
function add_seo_tab_label( $tab_labels ) {
	$tab_labels['seo'] = __( 'SEO', 'tcd-w' );
	return $tab_labels;
}


// 初期値
function add_seo_dp_default_options( $dp_default_options ) {


	// Facebook OGPの設定
	$dp_default_options['use_ogp'] = 0;
	$dp_default_options['fb_app_id'] = '';
	$dp_default_options['ogp_image'] = '';

	// X Cardsの設定
	$dp_default_options['twitter_account_name'] = '';

	// 高速化の設定
	$dp_default_options['use_emoji'] = 1;
  $dp_default_options['twitter_cards_size'] = 'summary';


	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_seo_tab_panel( $options ) {

  global $dp_default_options, $twitter_image_options;

?>

<div id="tab-content-seo" class="tab-content">

   <?php // Use OGP tag ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('OGP', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
      <div class="theme_option_message2"><p><?php _e( 'OGP is a mechanism for correctly conveying page information.', 'tcd-w' ); ?></p></div>
      <p><label><input name="dp_options[use_ogp]" type="checkbox" value="1" <?php checked( 1, $options['use_ogp'] ); ?>  data-toggle=".toggle-ogp"><?php _e( 'Use OGP', 'tcd-w' ); ?></label></p>
      <div class="toggle-ogp" <?php if ( ! $options['use_ogp'] ) echo ' style="display: none;"' ?>>
       <h4 class="theme_option_headline2"><?php _e( 'OGP image', 'tcd-w' ); ?></h4>
       <div class="theme_option_message2">
        <p><?php _e( 'This image is displayed for OGP if the page does not have a thumbnail.', 'tcd-w' ); ?></p>
        <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '1200', '630'); ?></p>
       </div>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js">
         <input type="hidden" value="<?php echo esc_attr( $options['ogp_image'] ); ?>" id="ogp_image" name="dp_options[ogp_image]" class="cf_media_id">
         <div class="preview_field"><?php if ( $options['ogp_image'] ) { echo wp_get_attachment_image( $options['ogp_image'], 'medium'); } ?></div>
         <div class="button_area">
          <input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['ogp_image'] ) { echo 'hidden'; } ?>">
         </div>
        </div>
       </div>

       <h4 class="theme_option_headline2"><?php _e( 'Facebook OGP', 'tcd-w' ); ?></h4>
       <div class="theme_option_message2"><p><?php _e( 'In order to use Facebook Insights please set your app ID.', 'tcd-w' ); ?><br><a href="https://tcd-theme.com/2018/01/facebook_app_id.html" target="_blank"><?php _e( 'Information about Facebook app ID.', 'tcd-w' ); ?></a></p></div>
       <p><?php _e( 'Your app ID', 'tcd-w' ); ?> <input class="regular-text" type="text" name="dp_options[fb_app_id]" value="<?php echo esc_attr( $options['fb_app_id'] ); ?>"></p>

       <h4 class="theme_option_headline2"><?php _e( 'X Cards', 'tcd-w' ); ?></h4>
       <div class="theme_option_message2"><p><?php _e( 'This theme requires Facebook OGP settings to use X cards.', 'tcd-w' ); ?><br><a href="https://tcd-theme.com/2016/11/twitter-cards.html" target="_blank"><?php _e( 'Information about X Cards.', 'tcd-w' ); ?></a></p></div>
       <div class="theme_option_input">
         <ul class="option_list">
           <li class="cf"><span class="label"><?php _e( 'Your X account name (exclude @ mark)', 'tcd-w' ); ?></span><input class="regular-text" type="text" name="dp_options[twitter_account_name]" value="<?php echo esc_attr( $options['twitter_account_name'] ); ?>"></li>
           <li class="cf"><span class="label"><?php _e('X cards size', 'tcd-w'); ?></span><?php echo tcd_basic_radio_button( $options, 'twitter_cards_size', $twitter_image_options ); ?></li>
         </ul>
       </div>
      </div><!-- / toggle -->

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // 絵文字の設定 ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Acceleration', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <h4 class="theme_option_headline2"><?php _e( 'Emoji', 'tcd-w' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('We recommend to checkoff this option if you dont use any Emoji in your post content.', 'tcd-w'); ?><br><?php _e("You can only accelarate if your database doesn't support utf8mb4.", 'tcd-w'); ?></p>
     </div>
     <p><label><input id="dp_options[use_emoji]" name="dp_options[use_emoji]" type="checkbox" value="1" <?php checked( '1', $options['use_emoji'] ); ?> /> <?php _e('Use emoji', 'tcd-w');  ?></label></p>
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


</div><!-- END .tab-content -->

<?php
} // END add_seo_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_seo_theme_options_validate( $input ) {

  global $dp_default_options, $twitter_image_options;


  // Facebook OGPの設定
  if ( ! isset( $input['use_ogp'] ) )
    $input['use_ogp'] = null;
    $input['use_ogp'] = ( $input['use_ogp'] == 1 ? 1 : 0 );
  $input['ogp_image'] = wp_filter_nohtml_kses( $input['ogp_image'] );
 	$input['fb_app_id'] = wp_filter_nohtml_kses( $input['fb_app_id'] );


  // Twitter Cardsの設定
  $input['twitter_account_name'] = wp_filter_nohtml_kses( $input['twitter_account_name'] );


  // 高速化の設定
  $input['use_emoji'] = ! empty( $input['use_emoji'] ) ? 1 : 0;
  $input['twitter_cards_size'] = wp_filter_nohtml_kses( $input['twitter_cards_size'] );


	return $input;

};


?>