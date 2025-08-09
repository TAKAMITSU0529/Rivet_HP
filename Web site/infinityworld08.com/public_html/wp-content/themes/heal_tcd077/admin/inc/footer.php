<?php
/*
 * フッターの設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_footer_dp_default_options' );


// Add label of footer tab
add_action( 'tcd_tab_labels', 'add_footer_tab_label' );


// Add HTML of footer tab
add_action( 'tcd_tab_panel', 'add_footer_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_footer_theme_options_validate' );


// タブの名前
function add_footer_tab_label( $tab_labels ) {
	$tab_labels['footer'] = __( 'Footer', 'tcd-w' );
	return $tab_labels;
}


// 初期値
function add_footer_dp_default_options( $dp_default_options ) {

  //バナーの設定
	$dp_default_options['footer_banner_font_size'] = '22';
	$dp_default_options['footer_banner_font_size_mobile'] = '20';
	$dp_default_options['footer_banner_font_color'] = '#ffffff';
	$dp_default_options['footer_banner_bg_color'] = '#341e09';
	$dp_default_options['footer_banner_bg_opacity'] = '0.5';
	for ( $i = 1; $i <= 3; $i++ ) {
		$dp_default_options['show_footer_banner'.$i] = 1;
		$dp_default_options['footer_banner_image'.$i] = false;
		$dp_default_options['footer_banner_url'.$i] = '#';
		$dp_default_options['footer_banner_title'.$i] = __( 'Title', 'tcd-w' );
	}

  //会社情報の設定
	$dp_default_options['show_footer_logo'] = '';
	$dp_default_options['footer_company_info'] = __( 'Description will be displayed here.<br />Description will be displayed here.', 'tcd-w' );
	$dp_default_options['footer_company_date'] = __( 'Description will be displayed here.<br />Description will be displayed here.', 'tcd-w' );
	$dp_default_options['footer_bg_color'] = '#f4f0ec';

  //ボタン
	$dp_default_options['show_footer_button'] = 1;
	$dp_default_options['footer_button_label'] = __( 'Button', 'tcd-w' );
	$dp_default_options['footer_button_url'] = '#';
	$dp_default_options['footer_button_target'] = '';
	$dp_default_options['footer_button_font_color'] = '#58330c';
	$dp_default_options['footer_button_border_color'] = '#59340e';
	$dp_default_options['footer_button_font_color_hover'] = '#ffffff';
	$dp_default_options['footer_button_bg_color_hover'] = '#472805';
	$dp_default_options['footer_button_border_color_hover'] = '#472805';

  //SNS
	$dp_default_options['footer_facebook_url'] = '';
	$dp_default_options['footer_twitter_url'] = '';
	$dp_default_options['footer_instagram_url'] = '';
	$dp_default_options['footer_pinterest_url'] = '';
	$dp_default_options['footer_youtube_url'] = '';
	$dp_default_options['footer_contact_url'] = '';
	$dp_default_options['footer_show_rss'] = 1;
	$dp_default_options['footer_tiktok_url'] = '';

  //コピーライト
	$dp_default_options['copyright'] = 'Copyright &copy; 2019';
	$dp_default_options['copyright_font_color'] = '#ffffff';
	$dp_default_options['copyright_bg_color'] = '#58330d';

	// フッターの固定メニュー
	$dp_default_options['footer_bar_display'] = 'type3';
	$dp_default_options['footer_bar_tp'] = 0.8;
	$dp_default_options['footer_bar_bg'] = '#FFFFFF';
	$dp_default_options['footer_bar_border'] = '#DDDDDD';
	$dp_default_options['footer_bar_color'] = '#000000';
	$dp_default_options['footer_bar_btns'] = array(
		array(
			'type' => 'type1',
			'label' => '',
			'url' => '',
			'number' => '',
			'target' => 0,
			'icon' => 'file-text'
		)
	);

	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_footer_tab_panel( $options ) {

  global $dp_default_options, $footer_bar_display_options, $footer_bar_button_options, $footer_bar_icon_options;

?>

<div id="tab-content-footer" class="tab-content">


   <?php // バナーの設定 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Banner content', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content tab_parent">

     <h4 class="theme_option_headline2"><?php _e('Basic setting', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'footer_banner_font_size'); ?></li>
      <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[footer_banner_font_color]" value="<?php echo esc_attr( $options['footer_banner_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Background color of title', 'tcd-w'); ?></span><input class="c-color-picker" type="text" name="dp_options[footer_banner_bg_color]" value="<?php echo esc_attr( $options['footer_banner_bg_color'] ); ?>" data-default-color="#341e09"></li>
      <li class="cf">
       <span class="label"><?php _e('Transparency of background color', 'tcd-w'); ?></span>
       <input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[footer_banner_bg_opacity]" value="<?php echo esc_attr( $options['footer_banner_bg_opacity'] ); ?>" />
       <div class="theme_option_message2">
        <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
       </div>
      </li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Content', 'tcd-w');  ?></h4>

     <div class="sub_box_tab">
      <div class="tab active" data-tab="tab1"><?php _e('Content', 'tcd-w'); ?>1</div>
      <div class="tab" data-tab="tab2"><?php _e('Content', 'tcd-w'); ?>2</div>
      <div class="tab" data-tab="tab3"><?php _e('Content', 'tcd-w'); ?>3</div>
     </div>

     <?php for($i = 1; $i <= 3; $i++) : ?>
     <div class="sub_box_tab_content<?php if($i == 1){ echo ' active'; }; ?>" data-tab-content="tab<?php echo $i; ?>">

      <p class="displayment_checkbox"><label><input name="dp_options[show_footer_banner<?php echo $i; ?>]" type="checkbox" value="1" <?php checked( $options['show_footer_banner'.$i], 1 ); ?>><?php _e( 'Display banner content', 'tcd-w' ); ?></label></p>
      <div style="<?php if($options['show_footer_banner'.$i] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">

       <h4 class="theme_option_headline2"><?php _e('Title', 'tcd-w');  ?></h4>
       <textarea class="headline_label full_width" cols="50" rows="2" name="dp_options[footer_banner_title<?php echo $i; ?>]"><?php echo esc_textarea( $options['footer_banner_title'.$i] ); ?></textarea>

       <h4 class="theme_option_headline2"><?php _e('Image', 'tcd-w'); ?></h4>
       <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '480', '300'); ?></p>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js footer_banner_image<?php echo $i; ?>">
         <input type="hidden" value="<?php echo esc_attr( $options['footer_banner_image'.$i] ); ?>" id="footer_banner_image<?php echo $i; ?>" name="dp_options[footer_banner_image<?php echo $i; ?>]" class="cf_media_id">
         <div class="preview_field"><?php if($options['footer_banner_image'.$i]){ echo wp_get_attachment_image($options['footer_banner_image'.$i], 'medium'); }; ?></div>
         <div class="buttton_area">
          <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['footer_banner_image'.$i]){ echo 'hidden'; }; ?>">
         </div>
        </div>
       </div>

       <h4 class="theme_option_headline2"><?php _e('URL', 'tcd-w');  ?></h4>
       <input class="full_width" type="text" name="dp_options[footer_banner_url<?php echo $i; ?>]" value="<?php esc_attr_e( $options['footer_banner_url'.$i] ); ?>" />

      </div>

     </div>
     <?php endfor; ?>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // 会社情報 ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Company information', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e('Logo', 'tcd-w');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('Please register logo image from Logo option section.', 'tcd-w'); ?></p>
     </div>
     <p><label><input name="dp_options[show_footer_logo]" type="checkbox" value="1" <?php checked( '1', $options['show_footer_logo'] ); ?> /> <?php _e('Display logo', 'tcd-w');  ?></label></p>

     <h4 class="theme_option_headline2"><?php _e('Company information', 'tcd-w');  ?></h4>
     <textarea class="full_width" cols="50" rows="4" name="dp_options[footer_company_info]"><?php echo esc_textarea( $options['footer_company_info'] ); ?></textarea>
     <h4 class="theme_option_headline2"><?php _e('Button setting', 'tcd-w');  ?></h4>
     <p class="displayment_checkbox"><label><input name="dp_options[show_footer_button]" type="checkbox" value="1" <?php checked( $options['show_footer_button'], 1 ); ?>><?php _e( 'Display button', 'tcd-w' ); ?></label></p>
     <div style="<?php if($options['show_footer_button'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
       <li class="cf"><span class="label"><?php _e('label', 'tcd-w');  ?></span><input class="full_width" type="text" name="dp_options[footer_button_label]" value="<?php esc_attr_e( $options['footer_button_label'] ); ?>" /></li>
       <li class="cf button_option">
        <span class="label"><?php _e('URL', 'tcd-w'); ?></span>
        <div class="admin_link_option">
         <input type="text" name="dp_options[footer_button_url]" placeholder="https://example.com/" value="<?php esc_attr_e( $options['footer_button_url'] ); ?>">
         <input id="footer_button_target" class="admin_link_option_target" name="dp_options[footer_button_target]" type="checkbox" value="1" <?php checked( $options['footer_button_target'], 1 ); ?>>
         <label for="footer_button_target">&#xe92a;</label>
        </div>
       </li>
       <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[footer_button_font_color]" value="<?php echo esc_attr( $options['footer_button_font_color'] ); ?>" data-default-color="#58330c" class="c-color-picker"></li>
       <li class="cf"><span class="label"><?php _e('Border color', 'tcd-w'); ?></span><input type="text" name="dp_options[footer_button_border_color]" value="<?php echo esc_attr( $options['footer_button_border_color'] ); ?>" data-default-color="#59340e" class="c-color-picker"></li>
       <li class="cf"><span class="label"><?php _e('Font color of on mouse over', 'tcd-w'); ?></span><input type="text" name="dp_options[footer_button_font_color_hover]" value="<?php echo esc_attr( $options['footer_button_font_color_hover'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
       <li class="cf"><span class="label"><?php _e('Background color on mouse over', 'tcd-w'); ?></span><input type="text" name="dp_options[footer_button_bg_color_hover]" value="<?php echo esc_attr( $options['footer_button_bg_color_hover'] ); ?>" data-default-color="#472805" class="c-color-picker"></li>
       <li class="cf"><span class="label"><?php _e('Border color on mouse over', 'tcd-w'); ?></span><input type="text" name="dp_options[footer_button_border_color_hover]" value="<?php echo esc_attr( $options['footer_button_border_color_hover'] ); ?>" data-default-color="#472805" class="c-color-picker"></li>
      </ul>
     </div>

     <h4 class="theme_option_headline2"><?php _e('Background color of company information', 'tcd-w');  ?></h4>
     <input type="text" name="dp_options[footer_bg_color]" value="<?php echo esc_attr( $options['footer_bg_color'] ); ?>" data-default-color="#f4f0ec" class="c-color-picker">

     <h4 class="theme_option_headline2"><?php _e('Business days', 'tcd-w');  ?></h4>
     <input class="full_width" type="text" name="dp_options[footer_company_date]" value="<?php echo esc_attr($options['footer_company_date']); ?>" />

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // SNSボタンの設定 ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('SNS', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="theme_option_message2">
      <p><?php _e('Enter url of your Instagram, TikTok, X, Facebook, Pinterest, YouTube, and contact page. Please leave the field empty if you don\'t want to display certain sns button.', 'tcd-w');  ?></p>
     </div>

     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Instagram URL', 'tcd-w');  ?></span><input class="full_width" type="text" name="dp_options[footer_instagram_url]" value="<?php esc_attr_e( $options['footer_instagram_url'] ); ?>" /></li>
      <li class="cf"><span class="label"><?php _e('TikTok URL', 'tcd-w');  ?></span><input class="full_width" type="text" name="dp_options[footer_tiktok_url]" value="<?php esc_attr_e( $options['footer_tiktok_url'] ); ?>" /></li>
      <li class="cf"><span class="label"><?php _e('X URL', 'tcd-w');  ?></span><input class="full_width" type="text" name="dp_options[footer_twitter_url]" value="<?php esc_attr_e( $options['footer_twitter_url'] ); ?>" /></li>
      <li class="cf"><span class="label"><?php _e('Facebook URL', 'tcd-w');  ?></span><input class="full_width" type="text" name="dp_options[footer_facebook_url]" value="<?php esc_attr_e( $options['footer_facebook_url'] ); ?>" /></li>
      <li class="cf"><span class="label"><?php _e('Pinterest URL', 'tcd-w');  ?></span><input class="full_width" type="text" name="dp_options[footer_pinterest_url]" value="<?php esc_attr_e( $options['footer_pinterest_url'] ); ?>" /></li>
      <li class="cf"><span class="label"><?php _e('YouTube URL', 'tcd-w');  ?></span><input class="full_width" type="text" name="dp_options[footer_youtube_url]" value="<?php esc_attr_e( $options['footer_youtube_url'] ); ?>" /></li>
      <li class="cf"><span class="label"><?php _e('Your Contact page URL (You can use mailto:)', 'tcd-w');  ?></span><input class="full_width" type="text" name="dp_options[footer_contact_url]" value="<?php esc_attr_e( $options['footer_contact_url'] ); ?>" /></li>
     </ul>
     <hr />
     <p><label><input name="dp_options[footer_show_rss]" type="checkbox" value="1" <?php checked( '1', $options['footer_show_rss'] ); ?> /> <?php _e('Display RSS button', 'tcd-w');  ?></label></p>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // コピーライトの設定 ------------------------------------------------------------ ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Copyright', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="theme_option_message2">
      <p><?php _e('Please enter &copy; if you want to display copyright mark.', 'tcd-w');  ?></p>
     </div>

     <input class="full_width" type="text" name="dp_options[copyright]" value="<?php echo esc_attr($options['copyright']); ?>" />

     <h4 class="theme_option_headline2"><?php _e('Color', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[copyright_font_color]" value="<?php echo esc_attr( $options['copyright_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="dp_options[copyright_bg_color]" value="<?php echo esc_attr( $options['copyright_bg_color'] ); ?>" data-default-color="#58330d" class="c-color-picker"></li>
     </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // フッターバーの設定 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e( 'Footer bar (mobile device only)', 'tcd-w' ); ?></h3>
    <div class="theme_option_field_ac_content">

      <div class="theme_option_message2">
       <p><?php _e( 'Footer bar will only be displayed at mobile device.', 'tcd-w' ); ?>
      </div>

      <h4 class="theme_option_headline2"><?php _e('Display type', 'tcd-w'); ?></h4>
      <ul class="design_radio_button horizontal cf">
       <?php foreach ( $footer_bar_display_options as $option ) { ?>
       <li>
        <input type="radio" id="footer_bar_display_<?php esc_attr_e( $option['value'] ); ?>" name="dp_options[footer_bar_display]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $options['footer_bar_display'], $option['value'] ); ?> />
        <label for="footer_bar_display_<?php esc_attr_e( $option['value'] ); ?>"><?php echo $option['label']; ?></label>
       </li>
       <?php } ?>
      </ul>

      <h4 class="theme_option_headline2"><?php _e('Appearance', 'tcd-w'); ?></h4>
      <ul class="color_field">
       <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="dp_options[footer_bar_bg]" value="<?php echo esc_attr( $options['footer_bar_bg'] ); ?>" data-default-color="#FFFFFF" class="c-color-picker"></li>
       <li class="cf"><span class="label"><?php _e('Border color', 'tcd-w'); ?></span><input type="text" name="dp_options[footer_bar_border]" value="<?php echo esc_attr( $options['footer_bar_border'] ); ?>" data-default-color="#DDDDDD" class="c-color-picker"></li>
       <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[footer_bar_color]" value="<?php echo esc_attr( $options['footer_bar_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
       <li class="cf"><span class="label"><?php _e('Opacity of background', 'tcd-w'); ?></span><input id="dp_options[footer_bar_tp]" class="font_size hankaku" type="text" name="dp_options[footer_bar_tp]" value="<?php echo esc_attr( $options['footer_bar_tp'] ); ?>" /><p><?php _e('Please enter the number 0 - 1.0. (e.g. 0.8)', 'tcd-w'); ?></p></li>
      </ul>

      <h4 class="theme_option_headline2"><?php _e('Button', 'tcd-w'); ?></h4>
      <div class="theme_option_message2">
       <p><?php _e( 'You can display the button with icon in footer bar. (We recommend you to set max 4 buttons.)', 'tcd-w' ); ?><br><?php _e( 'You can select button types below.', 'tcd-w' ); ?></p>
      </div>
      <table class="table-border">
       <tr>
        <th><?php _e( 'Default', 'tcd-w' ); ?></th>
        <td><?php _e( 'You can set link URL.', 'tcd-w' ); ?></td>
       </tr>
       <tr>
        <th><?php _e( 'Share', 'tcd-w' ); ?></th>
        <td><?php _e( 'Share buttons are displayed if you tap this button.', 'tcd-w' ); ?></td>
       </tr>
       <tr>
        <th><?php _e( 'Telephone', 'tcd-w' ); ?></th>
        <td><?php _e( 'You can call this number.', 'tcd-w' ); ?></td>
       </tr>
      </table>

      <div class="theme_option_message2" style="margin-top:10px;">
       <p><?php _e( 'Click "Add item", and set the button for footer bar. You can drag the item to change their order.', 'tcd-w' ); ?></p>
      </div>

     <div class="repeater-wrapper">
      <input type="hidden" name="dp_options[footer_bar_btns]" value="">
      <div class="repeater sortable" data-delete-confirm="<?php _e( 'Delete?', 'tcd-w' ); ?>">
       <?php
            if ( $options['footer_bar_btns'] ) :
              foreach ( $options['footer_bar_btns'] as $key => $value ) :  
       ?>
       <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $key ); ?>">
        <h4 class="theme_option_subbox_headline"><?php echo esc_attr( $value['label'] ); ?></h4>
        <div class="sub_box_content">
         <ul class="option_list footer-bar-type">
          <li class="cf">
           <span class="label"><?php _e('Button type', 'tcd-w'); ?></span>
           <select name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][type]">
            <?php foreach( $footer_bar_button_options as $option ) : ?>
            <option value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $value['type'], $option['value'] ); ?>><?php esc_html_e( $option['label'], 'tcd-w' ); ?></option>
            <?php endforeach; ?>
           </select>
          </li>
          <li class="cf"><span class="label"><?php _e('Button label', 'tcd-w'); ?></span><input class="full_width repeater-label" type="text" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][label]" value="<?php echo esc_attr( $value['label'] ); ?>"></li>
          <li class="cf footer-bar-url" style="<?php if ( $value['type'] !== 'type1' ) { echo 'display: none;'; } ?>">
           <span class="label"><?php _e('URL', 'tcd-w'); ?></span>
           <div class="admin_link_option">
            <input type="text" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][url]" placeholder="https://example.com/" value="<?php esc_attr_e( $value['url'] ); ?>">
            <input id="footer_bar_btns_target_<?php echo $key; ?>" class="admin_link_option_target" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][target]" type="checkbox" value="1" <?php checked( $value['target'], 1 ); ?>>
            <label for="footer_bar_btns_target_<?php echo $key; ?>">&#xe92a;</label>
           </div>
          </li>
          <li class="cf footer-bar-number" style="<?php if ( $value['type'] !== 'type3' ) { echo 'display: none;'; } ?>"><span class="label"><?php _e('Phone number', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][number]" placeholder="000-0000-0000" value="<?php echo esc_attr( $value['number'] ); ?>"></li>
          <li class="cf">
           <span class="label"><?php _e('Button icon', 'tcd-w'); ?></span>
           <ul class="footer_bar_icon_type cf">
            <?php foreach( $footer_bar_icon_options as $option ) : ?>
            <li><label><input type="radio" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][icon]" value="<?php echo esc_attr($option['value']); ?>" <?php checked( $option['value'], $value['icon'] ); ?>><span class="icon icon-<?php echo esc_attr($option['value']); ?>"></span></label></li>
            <?php endforeach; ?>
            <li class="material_icon"><label><input type="radio" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][icon]" value="material_icon" <?php checked( 'material_icon', $value['icon'] ); ?>><span class="icon_label"><?php _e( 'Others', 'tcd-w' ); ?></span></label></li>
           </ul>
          </li>
          <li class="cf material_icon_option">
           <span class="label"><?php _e('Google material icon', 'tcd-w'); ?></span>
           <input class="full_width" type="text" placeholder="<?php _e( 'ex: e88a', 'tcd-w' ); ?>" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][material_icon]" value="<?php if(isset($value['material_icon'])){ echo esc_attr( $value['material_icon'] ); }; ?>">
           <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
            <p><?php _e('Please enter any icon code from Google Fonts.<br><a href="https://fonts.google.com/icons" target="_blank">Click here for a list of icons from Google Fonts.</a>', 'tcd-w'); ?></p>
           </div>
          </li>
         </ul>
         <ul class="button_list cf">
          <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
          <li class="delete-row"><a class="button-delete-row button-ml red_button" href="#"><?php echo __( 'Delete item', 'tcd-w' ); ?></a></li>
         </ul>
        </div>
       </div>
       <?php
              endforeach;
            endif;
            $key = 'addindex';
            $value = array(
              'type' => 'type1',
              'label' => '',
              'url' => '',
              'number' => '',
              'target' => 0,
              'icon' => 'twitter',
              'material_icon' => ''
            );
            ob_start();
       ?>
       <div class="sub_box repeater-item repeater-item-<?php echo $key; ?>">
        <h4 class="theme_option_subbox_headline"><?php _e( 'New item', 'tcd-w' ); ?></h4>
        <div class="sub_box_content">
         <ul class="option_list footer-bar-type">
          <li class="cf">
           <span class="label"><?php _e('Button type', 'tcd-w'); ?></span>
           <select name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][type]">
            <?php foreach( $footer_bar_button_options as $option ) : ?>
            <option value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $value['type'], $option['value'] ); ?>><?php esc_html_e( $option['label'], 'tcd-w' ); ?></option>
            <?php endforeach; ?>
           </select>
          </li>
          <li class="cf"><span class="label"><?php _e('Button label', 'tcd-w'); ?></span><input class="full_width repeater-label" type="text" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][label]" value=""></li>
          <li class="cf footer-bar-url" style="<?php if ( $value['type'] !== 'type1' ) { echo 'display: none;'; } ?>">
           <span class="label"><?php _e('URL', 'tcd-w'); ?></span>
           <div class="admin_link_option">
            <input type="text" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][url]" placeholder="https://example.com/" value="<?php esc_attr_e( $value['url'] ); ?>">
            <input id="footer_bar_btns_target_<?php echo $key; ?>" class="admin_link_option_target" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][target]" type="checkbox" value="1" <?php checked( $value['target'], 1 ); ?>>
            <label for="footer_bar_btns_target_<?php echo $key; ?>">&#xe92a;</label>
           </div>
          </li>
          <li class="cf footer-bar-number" style="display:none;"><span class="label"><?php _e('Phone number', 'tcd-w'); ?></span><input class="full_width" type="text" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][number]" placeholder="000-0000-0000" value=""></li>
          <li class="cf">
           <span class="label"><?php _e('Button icon', 'tcd-w'); ?></span>
           <ul class="footer_bar_icon_type cf">
            <?php foreach( $footer_bar_icon_options as $option ) : ?>
            <li><label><input type="radio" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][icon]" value="<?php echo esc_attr($option['value']); ?>" <?php checked( $option['value'], $value['icon'] ); ?>><span class="icon icon-<?php echo esc_attr($option['value']); ?>"></span></label></li>
            <?php endforeach; ?>
            <li class="material_icon"><label><input type="radio" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][icon]" value="material_icon" <?php checked( 'material_icon', $value['icon'] ); ?>><span class="icon_label"><?php _e( 'Others', 'tcd-w' ); ?></span></label></li>
           </ul>
          </li>
          <li class="cf material_icon_option" style="display:none;">
           <span class="label"><?php _e('Google material icon', 'tcd-w'); ?></span>
           <input class="full_width" type="text" placeholder="<?php _e( 'ex: e88a', 'tcd-w' ); ?>" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][material_icon]" value="<?php if(isset($value['material_icon'])){ echo esc_attr( $value['material_icon'] ); }; ?>">
           <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
            <p><?php _e('Please enter any icon code from Google Fonts.<br><a href="https://fonts.google.com/icons" target="_blank">Click here for a list of icons from Google Fonts.</a>', 'tcd-w'); ?></p>
           </div>
          </li>
         </ul>
         <ul class="button_list cf">
          <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
          <li class="delete-row"><a class="button-delete-row button-ml red_button" href="#"><?php echo __( 'Delete item', 'tcd-w' ); ?></a></li>
         </ul>
        </div>
       </div>
       <?php
            $clone = ob_get_clean();
       ?>
      </div><!-- END .repeater -->
      <a href="#" class="button button-secondary button-add-row" data-clone="<?php echo esc_attr( $clone ); ?>"><?php _e( 'Add item', 'tcd-w' ); ?></a>
     </div><!-- END .repeater-wrapper -->

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


</div><!-- END .tab-content -->

<?php
} // END add_footer_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_footer_theme_options_validate( $input ) {

  global $dp_default_options, $footer_bar_display_options, $footer_bar_button_options, $footer_bar_icon_options;

  // バナーの設定
  $input['footer_banner_font_size'] = wp_filter_nohtml_kses( $input['footer_banner_font_size'] );
  $input['footer_banner_font_size_mobile'] = wp_filter_nohtml_kses( $input['footer_banner_font_size_mobile'] );
  $input['footer_banner_font_color'] = wp_filter_nohtml_kses( $input['footer_banner_font_color'] );
  $input['footer_banner_bg_color'] = wp_filter_nohtml_kses( $input['footer_banner_bg_color'] );
  $input['footer_banner_bg_opacity'] = wp_filter_nohtml_kses( $input['footer_banner_bg_opacity'] );
  for ( $i = 1; $i <= 3; $i++ ) {
    if ( ! isset( $input['show_footer_banner'.$i] ) )
      $input['show_footer_banner'.$i] = null;
      $input['show_footer_banner'.$i] = ( $input['show_footer_banner'.$i] == 1 ? 1 : 0 );
    $input['footer_banner_title'.$i] = $input['footer_banner_title'.$i];
    $input['footer_banner_image'.$i] = wp_filter_nohtml_kses( $input['footer_banner_image'.$i] );
    $input['footer_banner_url'.$i] = wp_filter_nohtml_kses( $input['footer_banner_url'.$i] );
  }


  //会社情報
  if ( ! isset( $input['show_footer_logo'] ) )
    $input['show_footer_logo'] = null;
    $input['show_footer_logo'] = ( $input['show_footer_logo'] == 1 ? 1 : 0 );
  $input['footer_company_info'] = wp_filter_nohtml_kses( $input['footer_company_info'] );
  $input['footer_company_date'] = wp_filter_nohtml_kses( $input['footer_company_date'] );
  $input['footer_bg_color'] = wp_filter_nohtml_kses( $input['footer_bg_color'] );


  //ボタン
  if ( ! isset( $input['show_footer_button'] ) )
    $input['show_footer_button'] = null;
    $input['show_footer_button'] = ( $input['show_footer_button'] == 1 ? 1 : 0 );
  $input['footer_button_label'] = wp_filter_nohtml_kses( $input['footer_button_label'] );
  $input['footer_button_url'] = wp_filter_nohtml_kses( $input['footer_button_url'] );
  if ( ! isset( $input['footer_button_target'] ) )
    $input['footer_button_target'] = null;
    $input['footer_button_target'] = ( $input['footer_button_target'] == 1 ? 1 : 0 );
  $input['footer_button_font_color'] = wp_filter_nohtml_kses( $input['footer_button_font_color'] );
  $input['footer_button_border_color'] = wp_filter_nohtml_kses( $input['footer_button_border_color'] );
  $input['footer_button_font_color_hover'] = wp_filter_nohtml_kses( $input['footer_button_font_color_hover'] );
  $input['footer_button_border_color_hover'] = wp_filter_nohtml_kses( $input['footer_button_border_color_hover'] );


  //フッターのSNSボタンの設定
  $input['footer_facebook_url'] = wp_filter_nohtml_kses( $input['footer_facebook_url'] );
  $input['footer_twitter_url'] = wp_filter_nohtml_kses( $input['footer_twitter_url'] );
  $input['footer_instagram_url'] = wp_filter_nohtml_kses( $input['footer_instagram_url'] );
  $input['footer_pinterest_url'] = wp_filter_nohtml_kses( $input['footer_pinterest_url'] );
  $input['footer_youtube_url'] = wp_filter_nohtml_kses( $input['footer_youtube_url'] );
  $input['footer_contact_url'] = wp_filter_nohtml_kses( $input['footer_contact_url'] );
  $input['footer_tiktok_url'] = wp_filter_nohtml_kses( $input['footer_tiktok_url'] );
  if ( ! isset( $input['footer_show_rss'] ) )
    $input['footer_show_rss'] = null;
    $input['footer_show_rss'] = ( $input['footer_show_rss'] == 1 ? 1 : 0 );


  // コピーライト
  $input['copyright'] = wp_kses_post($input['copyright']);
  $input['copyright_font_color'] = wp_kses_post($input['copyright_font_color']);
  $input['copyright_bg_color'] = wp_kses_post($input['copyright_bg_color']);


  // スマホ用固定フッターバーの設定
  $footer_bar_btns = array();
  if ( ! isset( $input['repeater_footer_bar_btns'] ) && ! empty( $input['footer_bar_btns'] ) && is_array($input['footer_bar_btns'] ) ) :
    $input['repeater_footer_bar_btns'] = $input['footer_bar_btns'];
  endif;
  if ( isset( $input['repeater_footer_bar_btns'] ) ) :
	  foreach ( (array)$input['repeater_footer_bar_btns'] as $key => $value ) {
	    $footer_bar_btns[] = array(
	      'type' => ( isset( $input['repeater_footer_bar_btns'][$key]['type'] ) && array_key_exists( $input['repeater_footer_bar_btns'][$key]['type'], $footer_bar_button_options ) ) ? $input['repeater_footer_bar_btns'][$key]['type'] : 'type1',
	      'label' => isset( $input['repeater_footer_bar_btns'][$key]['label'] ) ? wp_filter_nohtml_kses( $input['repeater_footer_bar_btns'][$key]['label'] ) : '',
	      'url' => isset( $input['repeater_footer_bar_btns'][$key]['url'] ) ? wp_filter_nohtml_kses( $input['repeater_footer_bar_btns'][$key]['url'] ) : '',
	      'number' => isset( $input['repeater_footer_bar_btns'][$key]['number'] ) ? wp_filter_nohtml_kses( $input['repeater_footer_bar_btns'][$key]['number'] ) : '',
	      'target' => ! empty( $input['repeater_footer_bar_btns'][$key]['target'] ) ? 1 : 0,
	      'icon' => isset( $input['repeater_footer_bar_btns'][$key]['icon'] ) ? wp_filter_nohtml_kses( $input['repeater_footer_bar_btns'][$key]['icon'] ) : 'file-text',
        'material_icon' => isset( $input['repeater_footer_bar_btns'][$key]['material_icon'] ) ? wp_filter_nohtml_kses( $input['repeater_footer_bar_btns'][$key]['material_icon'] ) : ''
	    );
	  }
	  unset( $input['repeater_footer_bar_btns'] );
  endif;
  $input['footer_bar_btns'] = $footer_bar_btns;

	return $input;

};


?>