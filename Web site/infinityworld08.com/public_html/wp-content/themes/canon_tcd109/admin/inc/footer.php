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
	$tab_labels['footer'] = __( 'Footer', 'tcd-canon' );
	return $tab_labels;
}


// 初期値
function add_footer_dp_default_options( $dp_default_options ) {

	// バナー
	$dp_default_options['footer_banner_list'] = array(
    array(
      "image" => "",
      "title" => __( 'Title', 'tcd-homme' ),
      "url" => "#",
      "target" => "",
    ),
    array(
      "image" => "",
      "title" => __( 'Title', 'tcd-homme' ),
      "url" => "#",
      "target" => "",
    ),
    array(
      "image" => "",
      "title" => __( 'Title', 'tcd-homme' ),
      "url" => "#",
      "target" => "",
    ),
    array(
      "image" => "",
      "title" => __( 'Title', 'tcd-homme' ),
      "url" => "#",
      "target" => "",
    ),
  );

  // コピーライト
	$dp_default_options['copyright'] = 'Copyright &copy; ' . date('Y');

	// 住所
  $dp_default_options['footer_info'] = __( 'Footer information will be display here', 'tcd-canon' );

	// フッターバー
  $dp_default_options['footer_bar_type'] = 'type1';

  // アイコン付きメニュー
	$dp_default_options['footer_bar_btns'] = array();


	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_footer_tab_panel( $options ) {

  global $dp_default_options, $footer_bar_button_options, $web_icon_options, $footer_bar_type_options, $font_type_options, $logo_type_options, $bool_options;

?>

<div id="tab-content-footer" class="tab-content">


   <?php // バナーの設定 ------------------------------------------------------------ ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Banner', 'tcd-canon');  ?></h3>
    <div class="theme_option_field_ac_content tab_parent">

     <div class="front_page_image">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/image/footer_banner.jpg?1.1" alt="" title="" />
     </div>

      <div class="theme_option_message2">
       <p><?php _e('Click add new item button to start this option.<br />You can change order by dragging each headline of option field.', 'tcd-canon');  ?><br>
       <?php _e('If more than five banners are registered, a scrolling animation is applied.<br>Please leave the "URL" field blank if you don\'t want to display certain banner.', 'tcd-canon');  ?></p>
      </div>

      <?php //繰り返しフィールド ----- ?>
      <div class="repeater-wrapper">
       <input type="hidden" name="dp_options[footer_banner_list]" value="">
       <div class="repeater sortable" data-delete-confirm="<?php _e( 'Delete?', 'tcd-canon' ); ?>">
        <?php
             if ( $options['footer_banner_list'] ) :
               foreach ( $options['footer_banner_list'] as $key => $value ) :
        ?>
        <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $key ); ?>">
         <h4 class="theme_option_subbox_headline"><?php _e( 'Item', 'tcd-canon' ); echo esc_attr( $key+1 ); ?></h4>
         <div class="sub_box_content">

          <ul class="option_list">
           <li class="cf">
            <span class="label">
             <?php _e('Image', 'tcd-canon'); ?>
             <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-canon'), '362', '180'); ?></span>
            </span>
            <div class="image_box cf">
             <div class="cf cf_media_field hide-if-no-js footer_banner_list_image<?php echo esc_attr( $key ); ?>">
              <input type="hidden" value="<?php if($value['image']) { echo esc_attr( $value['image'] ); }; ?>" id="footer_banner_list_image<?php echo esc_attr( $key ); ?>" name="dp_options[footer_banner_list][<?php echo esc_attr( $key ); ?>][image]" class="cf_media_id">
              <div class="preview_field"><?php if($value['image']){ echo wp_get_attachment_image($value['image'], 'full'); }; ?></div>
              <div class="buttton_area">
               <input type="button" value="<?php _e('Select Image', 'tcd-canon'); ?>" class="cfmf-select-img button">
               <input type="button" value="<?php _e('Remove Image', 'tcd-canon'); ?>" class="cfmf-delete-img button <?php if(!$value['image']){ echo 'hidden'; }; ?>">
              </div>
             </div>
            </div>
           </li>
           <li class="cf"><span class="label"><?php _e('Title', 'tcd-canon'); ?></span><input class="repeater-label full_width" type="text" name="dp_options[footer_banner_list][<?php echo esc_attr( $key ); ?>][title]" value="<?php echo esc_attr($value['title']); ?>" /></li>
           <li class="cf button_option">
            <span class="label"><?php _e('Link URL', 'tcd-canon'); ?></span>
            <div class="admin_link_option">
             <input type="text" name="dp_options[footer_banner_list][<?php echo esc_attr( $key ); ?>][url]" placeholder="https://example.com/" value="<?php esc_attr_e( $value['url'] ); ?>">
             <input id="footer_banner_list_target<?php echo esc_attr( $key ); ?>" class="admin_link_option_target" name="dp_options[footer_banner_list][<?php echo esc_attr( $key ); ?>][target]" type="checkbox" value="1" <?php checked( $value['target'], 1 ); ?>>
             <label for="footer_banner_list_target<?php echo esc_attr( $key ); ?>">&#xe920;</label>
            </div>
           </li>
          </ul>

          <ul class="button_list cf">
           <li style="float:right; margin:0;" class="delete-row"><a class="button-delete-row button-ml red_button" href="#"><?php echo __( 'Delete item', 'tcd-canon' ); ?></a></li>
          </ul>
         </div><!-- END .sub_box_content -->
        </div><!-- END .sub_box -->
        <?php
              endforeach;
            endif;
            $key = 'addindex';
            $value = array(
             'image' => false,
             'title' => '',
             'url' => '',
             'target' => '',
            );
            ob_start();
        ?>
        <div class="sub_box repeater-item repeater-item-<?php echo $key; ?>">
         <h4 class="theme_option_subbox_headline"><?php _e( 'New item', 'tcd-canon' ); ?></h4>
         <div class="sub_box_content">

          <ul class="option_list">
           <li class="cf">
            <span class="label">
             <?php _e('Image', 'tcd-canon'); ?>
             <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-canon'), '362', '180'); ?></span>
            </span>
            <div class="image_box cf">
             <div class="cf cf_media_field hide-if-no-js footer_banner_list_image<?php echo esc_attr( $key ); ?>">
              <input type="hidden" value="<?php if($value['image']) { echo esc_attr( $value['image'] ); }; ?>" id="footer_banner_list_image<?php echo esc_attr( $key ); ?>" name="dp_options[footer_banner_list][<?php echo esc_attr( $key ); ?>][image]" class="cf_media_id">
              <div class="preview_field"><?php if($value['image']){ echo wp_get_attachment_image($value['image'], 'full'); }; ?></div>
              <div class="buttton_area">
               <input type="button" value="<?php _e('Select Image', 'tcd-canon'); ?>" class="cfmf-select-img button">
               <input type="button" value="<?php _e('Remove Image', 'tcd-canon'); ?>" class="cfmf-delete-img button <?php if(!$value['image']){ echo 'hidden'; }; ?>">
              </div>
             </div>
            </div>
           </li>
           <li class="cf"><span class="label"><?php _e('Catchphrase', 'tcd-canon'); ?></span><input class="repeater-label full_width" type="text" name="dp_options[footer_banner_list][<?php echo esc_attr( $key ); ?>][title]" value="<?php echo esc_attr($value['title']); ?>" /></li>
           <li class="cf button_option">
            <span class="label"><?php _e('Link URL', 'tcd-canon'); ?></span>
            <div class="admin_link_option">
             <input type="text" name="dp_options[footer_banner_list][<?php echo esc_attr( $key ); ?>][url]" placeholder="https://example.com/" value="<?php esc_attr_e( $value['url'] ); ?>">
             <input id="footer_banner_list_target<?php echo esc_attr( $key ); ?>" class="admin_link_option_target" name="dp_options[footer_banner_list][<?php echo esc_attr( $key ); ?>][target]" type="checkbox" value="1" <?php checked( $value['target'], 1 ); ?>>
             <label for="footer_banner_list_target<?php echo esc_attr( $key ); ?>">&#xe920;</label>
            </div>
           </li>
          </ul>

          <ul class="button_list cf">
           <li style="float:right; margin:0;" class="delete-row"><a class="button-delete-row button-ml red_button" href="#"><?php echo __( 'Delete item', 'tcd-canon' ); ?></a></li>
          </ul>
         </div><!-- END .sub_box_content -->
        </div><!-- END .sub_box -->
        <?php
             $clone = ob_get_clean();
        ?>
       </div><!-- END .repeater -->
       <a href="#" class="button button-secondary button-add-row" data-clone="<?php echo htmlspecialchars( $clone ); ?>"><?php _e( 'Add item', 'tcd-canon' ); ?></a>
      </div><!-- END .repeater-wrapper -->
      <?php //繰り返しフィールドここまで ----- ?>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-canon' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-canon' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // ウィジェットエリアの設定 ------------------------------------------------------------ ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Footer area', 'tcd-canon');  ?></h3>
    <div class="theme_option_field_ac_content tab_parent">

     <div class="front_page_image">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/image/footer.jpg?1.2" alt="" title="" />
     </div>

     <h4 class="theme_option_headline_number"><span class="num">1</span><?php _e( 'Logo', 'tcd-canon' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php echo __('You can set logo from "Basic Settings" logo section.', 'tcd-canon'); ?></p>
     </div>

     <h4 class="theme_option_headline_number"><span class="num">2</span><?php _e( 'Menu', 'tcd-canon' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php echo __('Please set menu from <a href="./nav-menus.php" target="_blank">"Menu Screen"</a> in theme menu.', 'tcd-canon'); ?></p>
     </div>

     <h4 class="theme_option_headline_number"><span class="num">3</span><?php _e( 'Information', 'tcd-canon' ); ?></h4>
     <textarea class="full_width" placeholder="<?php _e( 'Please enter a store name and address for use.', 'tcd-canon' ); ?>" cols="50" rows="3" name="dp_options[footer_info]"><?php echo esc_textarea(  $options['footer_info'] ); ?></textarea>

     <h4 class="theme_option_headline_number"><span class="num">4</span><?php _e( 'SNS icon', 'tcd-canon' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e( 'SNS icons can be set in basic settings. The specifications are displayed in the following locations.<br><br>Footer menu area (PC/Mobile)<br>Lower part of the drawer menu (Mobile only)', 'tcd-canon' ); ?></p>
     </div>

     <h4 class="theme_option_headline_number"><span class="num">5</span><?php _e( 'Copyright', 'tcd-canon' ); ?></h4>
     <input class="full_width" type="text" placeholder="<?php _e( 'e.g. &copy; 20xx Site name, etc.', 'tcd-canon' ); ?>" name="dp_options[copyright]" value="<?php echo esc_attr( $options['copyright'] ); ?>" />

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-canon' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-canon' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // フッターバーの設定 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e( 'Footer bar (mobile device only)', 'tcd-canon' ); ?></h3>
    <div class="theme_option_field_ac_content">

      <div class="theme_option_message2">
       <p><?php _e( 'Footer bar will only be displayed at mobile device.', 'tcd-canon' ); ?></p>
      </div>

      <h4 class="theme_option_headline2"><?php _e('Footer bar type', 'tcd-canon'); ?></h4>
      <?php echo tcd_admin_image_radio_button($options, 'footer_bar_type', $footer_bar_type_options) ?>

      <div class="theme_option_message2 footer_bar_not_type4_option">
        <p><?php _e( 'You can display the button with icon. (We recommend you to set max 4 buttons.)', 'tcd-canon' ); ?></p>
      </div>
      <div class="theme_option_message2 footer_bar_type4_option">
        <p><?php _e( 'Simple buttons without icons can be displayed. (We recommend you to set max 2 buttons.)', 'tcd-canon' ); ?></p>
      </div>

      <h4 class="theme_option_headline2"><?php _e('Settings for the contents of the footer bar', 'tcd-canon'); ?></h4>
      <div class="theme_option_message" style="margin-top:10px;">
       <p><?php _e( 'Click "Add item", and set the button for footer bar. You can drag the item to change their order.', 'tcd-canon' ); ?></p>
      </div>
        
      <div class="repeater-wrapper">
        <input type="hidden" name="dp_options[footer_bar_btns]" value="">
        <div class="repeater sortable" data-delete-confirm="<?php _e('Delete?', 'tcd-canon'); ?>">
          <?php
                if ( $options['footer_bar_btns'] ) :
                  foreach ( $options['footer_bar_btns'] as $key => $value ) :  
          ?>
          <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $key ); ?>">
            <h4 class="theme_option_subbox_headline"><?php echo esc_attr( $value['label'] ); ?></h4>
            <div class="sub_box_content">

              <h4 class="theme_option_headline2"><?php _e('Button type', 'tcd-canon'); ?></h4>
              <?php foreach ( $footer_bar_button_options as $option ) { ?>
              <span class="simple_radio_button spacer"></span>
              <input type="radio" id="footer_bar_btns_<?php echo esc_attr( $option['value'] ).'_'.esc_attr( $key ); ?>" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][type]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $value['type'], $option['value'] ); ?> />
              <label for="footer_bar_btns_<?php echo esc_attr( $option['value'] ).'_'.esc_attr( $key ); ?>"><?php echo esc_html( $option['label'] ); ?></label></br>
              <?php } ?>

              <div class="theme_option_message2 footer_bar_btns_type1_option" style="margin-top:20px;">
                <p><?php _e( 'You can set link URL.', 'tcd-canon' ); ?></p>
              </div>
              
              <div class="theme_option_message2 footer_bar_btns_type2_option" style="margin-top:20px;">
                <p><?php _e( 'Share buttons are displayed if you tap this button.', 'tcd-canon' ); ?></p>
              </div>
              
              <div class="theme_option_message2 footer_bar_btns_type3_option" style="margin-top:20px;">
                <p><?php _e( 'You can call this number.', 'tcd-canon' ); ?></p>
              </div>

              <h4 class="theme_option_headline2"><?php _e('Button setting', 'tcd-canon'); ?></h4>
              <ul class="option_list">
                <li class="cf"><span class="label"><?php _e('Label', 'tcd-canon'); ?></span><input class="full_width repeater-label" type="text" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][label]" value="<?php echo esc_attr( $value['label'] ); ?>"></li>
                <li class="cf footer_bar_btns_type1_option">
                 <span class="label"><?php _e('URL', 'tcd-canon'); ?></span>
                 <div class="admin_link_option">
                  <input type="text" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][url]" placeholder="https://example.com/" value="<?php esc_attr_e( $value['url'] ); ?>">
                  <input id="footer_bar_btns_target_<?php echo $key; ?>" class="admin_link_option_target" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][target]" type="checkbox" value="1" <?php checked( $value['target'], 1 ); ?>>
                  <label for="footer_bar_btns_target_<?php echo $key; ?>">&#xe920;</label>
                 </div>
                </li>
                <li class="cf footer_bar_btns_type3_option"><span class="label"><?php _e('Phone number', 'tcd-canon'); ?></span><input class="full_width" type="text" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][number]" value="<?php echo esc_attr( $value['number'] ); ?>" placeholder="000-0000-0000"></li>
                <li class="cf footer_bar_type4_option"><span class="label"><?php _e('Background color', 'tcd-canon'); ?></span><input class="c-color-picker" type="text" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][color]" value="<?php echo esc_attr( $value['color'] ); ?>" data-default-color="#000000"></li>
              </ul>

              <div class="footer_bar_not_type4_option footer_bar_icon_option">
               <h4 class="theme_option_headline2"><?php _e('Icon', 'tcd-canon'); ?></h4>
               <ul class="footer_bar_icon_type">
                <?php
                     foreach( $web_icon_options as $icon => $values ):
                       $icon_code = '&#x' . $icon;
                ?>
                <li>
                 <label>
                  <input type="radio" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][icon]" value="<?php echo $icon; ?>" <?php checked( $value['icon'], $icon ); ?> />
                  <span class="icon <?php echo esc_attr($values['label']); if($values['type'] == 'google'){ echo ' google_font'; }; ?>"><?php echo $icon_code; ?></span>
                 </label>
                </li>
                <?php endforeach; ?>
               </ul>
              </div>

              <ul class="button_list cf">
                <li><a class="close_sub_box button-ml" href="#"><?php _e('Close', 'tcd-canon'); ?></a></li>
                <li style="float:right; margin:0;" class="delete-row"><a class="button-delete-row button-ml red_button" href="#"><?php _e('Delete item', 'tcd-canon'); ?></a></li>
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
                  'target' => 0,
                  'number' => '',
                  'icon' => 'e937',
                  'color' => '#000000'
                );
                ob_start();
          ?>
          <div class="sub_box repeater-item repeater-item-<?php echo $key; ?>">
            <h4 class="theme_option_subbox_headline"><?php _e('New item', 'tcd-canon'); ?></h4>
            <div class="sub_box_content">

              <h4 class="theme_option_headline2"><?php _e('Button type', 'tcd-canon'); ?></h4>
              <?php foreach ( $footer_bar_button_options as $option ) { ?>
              <span class="simple_radio_button spacer"></span>
              <input type="radio" id="footer_bar_btns_<?php echo esc_attr( $option['value'] ).'_'.esc_attr( $key ); ?>" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][type]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $value['type'], $option['value'] ); ?> />
              <label for="footer_bar_btns_<?php echo esc_attr( $option['value'] ).'_'.esc_attr( $key ); ?>"><?php echo esc_html( $option['label'] ); ?></label></br>
              <?php } ?>

              <div class="theme_option_message2 footer_bar_btns_type1_option" style="margin-top:20px;">
                <p><?php _e( 'You can set link URL.', 'tcd-canon' ); ?></p>
              </div>
              
              <div class="theme_option_message2 footer_bar_btns_type2_option" style="margin-top:20px;">
                <p><?php _e( 'Share buttons are displayed if you tap this button.', 'tcd-canon' ); ?></p>
              </div>
              
              <div class="theme_option_message2 footer_bar_btns_type3_option" style="margin-top:20px;">
                <p><?php _e( 'You can call this number.', 'tcd-canon' ); ?></p>
              </div>

              <h4 class="theme_option_headline2"><?php _e('Button setting', 'tcd-canon'); ?></h4>
              <ul class="option_list">
                <li class="cf"><span class="label"><?php _e('Label', 'tcd-canon'); ?></span><input class="full_width repeater-label" type="text" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][label]" value=""></li>
                <li class="cf footer_bar_btns_type1_option">
                 <span class="label"><?php _e('URL', 'tcd-canon'); ?></span>
                 <div class="admin_link_option">
                  <input type="text" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][url]" placeholder="https://example.com/" value="<?php esc_attr_e( $value['url'] ); ?>">
                  <input id="footer_bar_btns_target_<?php echo $key; ?>" class="admin_link_option_target" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][target]" type="checkbox" value="1" <?php checked( $value['target'], 1 ); ?>>
                  <label for="footer_bar_btns_target_<?php echo $key; ?>">&#xe920;</label>
                 </div>
                </li>
                <li class="cf footer_bar_btns_type3_option"><span class="label"><?php _e('Phone number', 'tcd-canon'); ?></span><input class="full_width" type="text" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][number]" value="" placeholder="000-0000-0000"></li>
                <li class="cf footer_bar_type4_option"><span class="label"><?php _e('Background color', 'tcd-canon'); ?></span><input class="c-color-picker" type="text" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][color]" value="<?php echo esc_attr( $value['color'] ); ?>" data-default-color="#000000"></li>
              </ul>

              <div class="footer_bar_not_type4_option footer_bar_icon_option">
               <h4 class="theme_option_headline2"><?php _e('Icon', 'tcd-canon'); ?></h4>
               <ul class="footer_bar_icon_type">
                <?php
                     foreach( $web_icon_options as $icon => $values ):
                       $icon_code = '&#x' . $icon;
                ?>
                <li>
                 <label>
                  <input type="radio" name="dp_options[footer_bar_btns][<?php echo esc_attr( $key ); ?>][icon]" value="<?php echo $icon; ?>" <?php checked( $value['icon'], $icon ); ?> />
                  <span class="icon <?php echo esc_attr($values['label']); if($values['type'] == 'google'){ echo ' google_font'; }; ?>"><?php echo $icon_code; ?></span>
                 </label>
                </li>
                <?php endforeach; ?>
               </ul>
              </div>

              <ul class="button_list cf">
                <li><a class="close_sub_box button-ml" href="#"><?php _e('Close', 'tcd-canon'); ?></a></li>
                <li style="float:right; margin:0;" class="delete-row"><a class="button-delete-row button-ml red_button" href="#"><?php _e('Delete item', 'tcd-canon'); ?></a></li>
              </ul>
            </div>
          </div>
          <?php
                $clone = ob_get_clean();
          ?>
        </div><!-- END .repeater -->
        <a href="#" class="button button-secondary button-add-row" data-clone="<?php echo esc_attr( $clone ); ?>"><?php _e('Add item', 'tcd-canon'); ?></a>
      </div><!-- END .repeater-wrapper -->

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-canon' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php _e('Close', 'tcd-canon'); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->

</div><!-- END .tab-content -->

<?php
} // END add_footer_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_footer_theme_options_validate( $input ) {

  global $dp_default_options, $footer_bar_button_options, $web_icon_options, $footer_bar_type_options, $font_type_options, $logo_type_options;


  // バナー
  $footer_banner_list = array();
  if ( isset( $input['footer_banner_list'] ) && is_array( $input['footer_banner_list'] ) ) {
    foreach ( $input['footer_banner_list'] as $key => $value ) {
      $footer_banner_list[] = array(
        'image' => isset( $input['footer_banner_list'][$key]['image'] ) ? wp_filter_nohtml_kses( $input['footer_banner_list'][$key]['image'] ) : '',
        'title' => isset( $input['footer_banner_list'][$key]['title'] ) ? wp_filter_nohtml_kses( $input['footer_banner_list'][$key]['title'] ) : '',
        'url' => isset( $input['footer_banner_list'][$key]['url'] ) ? wp_filter_nohtml_kses( $input['footer_banner_list'][$key]['url'] ) : '',
        'target' => ! empty( $input['footer_banner_list'][$key]['target'] ) ? 1 : 0,
      );
    }
  };
  $input['footer_banner_list'] = $footer_banner_list;


  // 住所
  $input['footer_info'] = wp_kses_post($input['footer_info']);


  // コピーライト
  $input['copyright'] = wp_kses_post($input['copyright']);


  // スマホ用固定フッターバーの設定
  if ( ! isset( $input['footer_bar_type'] ) || ! array_key_exists( $input['footer_bar_type'], $footer_bar_type_options ) )
    $input['footer_bar_type'] = $dp_default_options['footer_bar_type'];

  $footer_bar_btns = array();
  if ( isset( $input['footer_bar_btns'] ) && is_array( $input['footer_bar_btns'] ) ) {
    foreach ( $input['footer_bar_btns'] as $key => $value ) {
      $footer_bar_btns[] = array(
        'type' => ( isset( $input['footer_bar_btns'][$key]['type'] ) && array_key_exists( $input['footer_bar_btns'][$key]['type'], $footer_bar_button_options ) ) ? $input['footer_bar_btns'][$key]['type'] : 'type1',
        'label' => isset( $input['footer_bar_btns'][$key]['label'] ) ? wp_filter_nohtml_kses( $input['footer_bar_btns'][$key]['label'] ) : '',
        'url' => isset( $input['footer_bar_btns'][$key]['url'] ) ? wp_filter_nohtml_kses( $input['footer_bar_btns'][$key]['url'] ) : '',
        'target' => ! empty( $input['footer_bar_btns'][$key]['target'] ) ? 1 : 0,
        'number' => isset( $input['footer_bar_btns'][$key]['number'] ) ? wp_filter_nohtml_kses( $input['footer_bar_btns'][$key]['number'] ) : '',
        'color' => isset( $input['footer_bar_btns'][$key]['color'] ) ? sanitize_hex_color( $input['footer_bar_btns'][$key]['color'] ) : '',
        'icon' => isset( $input['footer_bar_btns'][$key]['icon'] ) ? wp_filter_nohtml_kses( $input['footer_bar_btns'][$key]['icon'] ) : 'e937',
      );
    };
  };
  $input['footer_bar_btns'] = $footer_bar_btns;


	return $input;

};


?>