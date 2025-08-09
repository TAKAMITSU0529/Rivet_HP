<?php
/*
 * ヘッダーの設定
 */
use TCD\Helper\UI;
use TCD\Helper\Sanitization as San;

// Add default values
add_filter( 'before_getting_design_plus_option', 'add_header_dp_default_options' );


// Add label of logo tab
add_action( 'tcd_tab_labels', 'add_header_tab_label' );


// Add HTML of logo tab
add_action( 'tcd_tab_panel', 'add_header_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_header_theme_options_validate' );


// タブの名前
function add_header_tab_label( $tab_labels ) {
	$tab_labels['header'] = __( 'Header', 'tcd-w' );
	return $tab_labels;
}


// 初期値
function add_header_dp_default_options( $dp_default_options ) {

	// ヘッダーの設定
	$dp_default_options['header_fix'] = 'type1';
	$dp_default_options['mobile_header_fix'] = 'type1';

	// サイトの説明文の設定
	$dp_default_options['header_show_desc'] = 'type3';
	$dp_default_options['header_desc_font_size'] = '14';
	$dp_default_options['header_desc_font_type'] = 2;
	$dp_default_options['show_header_desc_mobile'] = 1;
	$dp_default_options['header_desc_mobile'] = '';
	$dp_default_options['header_desc_font_size_mobile'] = '11';
	$dp_default_options['header_desc_font_type_mobile'] = 2;

	// グローバルメニューの設定
	$dp_default_options['global_menu_font_type'] = 1;
	$dp_default_options['global_menu_font_color'] = '#ffffff';
	$dp_default_options['global_menu_bg_color'] = '#573312';
	$dp_default_options['global_menu_border_color'] = '#795c41';
	$dp_default_options['global_menu_font_color_hover'] = '#bfa898';
	$dp_default_options['global_menu_child_font_color'] = '#FFFFFF';
	$dp_default_options['global_menu_child_bg_color'] = '#000000';
	$dp_default_options['global_menu_child_bg_color_hover'] = '#462809';

	// ドロワーメニュー
	$dp_default_options['mobile_menu_font_color'] = '#ffffff';
	$dp_default_options['mobile_menu_font_hover_color'] = '#ffffff';
	$dp_default_options['mobile_menu_child_font_color'] = '#ffffff';
	$dp_default_options['mobile_menu_child_font_hover_color'] = '#ffffff';
	$dp_default_options['mobile_menu_bg_color'] = '#222222';
	$dp_default_options['mobile_menu_sub_menu_bg_color'] = '#333333';
	$dp_default_options['mobile_menu_bg_hover_color'] = '#ff7f00';
	$dp_default_options['mobile_menu_border_color'] = '#444444';
	for ( $i = 1; $i <= 3; $i++ ) {
		$dp_default_options['mobile_menu_ad_code' . $i] = '';
		$dp_default_options['mobile_menu_ad_image' . $i] = false;
		$dp_default_options['mobile_menu_ad_url' . $i] = '';
		$dp_default_options['mobile_menu_ad_target' . $i] = '';
	}

  // メガメニュー
	$dp_default_options['mega_menu_a_bg_color'] = '#000000';
	$dp_default_options['mega_menu_a_bg_opacity'] = '0.5';
	$dp_default_options['mega_menu_a_title_bg_color'] = '#341e09';
	$dp_default_options['mega_menu_a_title_bg_opacity'] = '0.5';
	$dp_default_options['mega_menu_a_title_font_size'] = '26';
	$dp_default_options['mega_menu_a_sub_title_font_size'] = '16';
	$dp_default_options['mega_menu_b_bg_color'] = '#000000';
	$dp_default_options['mega_menu_b_bg_opacity'] = '0.5';
	$dp_default_options['mega_menu_b_title_font_size'] = '14';
	$dp_default_options['mega_menu_b_title_bg_color'] = '#000000';
	$dp_default_options['mega_menu_b_title_bg_opacity'] = '0.8';


  // パンくずリンク
	$dp_default_options['bread_bg_color'] = '#ffffff';
	$dp_default_options['bread_bg_opacity'] = '0.2';

  //SNS
	$dp_default_options['header_facebook_url'] = '';
	$dp_default_options['header_twitter_url'] = '';
	$dp_default_options['header_instagram_url'] = '';
	$dp_default_options['header_pinterest_url'] = '';
	$dp_default_options['header_youtube_url'] = '';
	$dp_default_options['header_contact_url'] = '';
	$dp_default_options['header_tiktok_url'] = '';
	$dp_default_options['header_show_rss'] = 1;

  $dp_default_options['megamenu'] = array();

	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_header_tab_panel( $options ) {

  global $dp_default_options, $header_fix_options, $header_fix_options2, $megamenu_options, $site_desc_options, $font_type_options;
  $blog_label = __( 'Blog', 'tcd-w' );
  $menu_label = $options['menu_label'] ? esc_html( $options['menu_label'] ) : __( 'Campaign', 'tcd-w' );

?>

<div id="tab-content-header" class="tab-content">


   <?php // ヘッダーの設定 ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Header bar', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e('Display position', 'tcd-w'); ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Display position (PC)', 'tcd-w'); ?></span><?php echo tcd_basic_radio_button($options, 'header_fix', $header_fix_options); ?></li>
      <li class="cf"><span class="label"><?php _e('Display position (mobile)', 'tcd-w'); ?></span><?php echo tcd_basic_radio_button($options, 'mobile_header_fix', $header_fix_options); ?></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Site description', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Display setting', 'tcd-w');  ?></span>
       <select name="dp_options[header_show_desc]">
        <?php foreach ( $site_desc_options as $option ) { ?>
        <option style="padding-right: 10px;" value="<?php echo esc_attr( $option['value'] ); ?>" <?php selected( $options['header_show_desc'], $option['value'] ); ?>><?php echo esc_html($option['label']); ?></option>
        <?php } ?>
       </select>
      </li>
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[header_desc_font_size]" value="<?php echo esc_attr( $options['header_desc_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w'); ?></span>
      <?php echo UI\font_select( 'dp_options[header_desc_font_type]', $options['header_desc_font_type'] ); ?>
    </li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Site description (mobile)', 'tcd-w');  ?></h4>
     <p class="displayment_checkbox"><label><input name="dp_options[show_header_desc_mobile]" type="checkbox" value="1" <?php checked( $options['show_header_desc_mobile'], 1 ); ?>><?php _e( 'Display description in mobile size', 'tcd-w' ); ?></label></p>
     <div style="<?php if($options['show_header_desc_mobile'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
       <li class="cf"><span class="label"><?php _e('Site description', 'tcd-w'); ?></span><textarea class="full_width" cols="50" rows="3" name="dp_options[header_desc_mobile]"><?php echo esc_textarea(  $options['header_desc_mobile'] ); ?></textarea></li>
       <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[header_desc_font_size_mobile]" value="<?php echo esc_attr( $options['header_desc_font_size_mobile'] ); ?>" /><span>px</span></li>
       <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w'); ?></span>
       <?php echo UI\font_select( 'dp_options[header_desc_font_type_mobile]', $options['header_desc_font_type_mobile'] ); ?>
      </li>
      </ul>
     </div>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // グローバルメニュー ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Global menu', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e('Parent menu', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font type', 'tcd-w'); ?></span>
      <?php echo UI\font_select( 'dp_options[global_menu_font_type]', $options['global_menu_font_type'] ); ?>
    </li>
      <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[global_menu_font_color]" value="<?php echo esc_attr( $options['global_menu_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Font color on mouse over', 'tcd-w'); ?></span><input type="text" name="dp_options[global_menu_font_color_hover]" value="<?php echo esc_attr( $options['global_menu_font_color_hover'] ); ?>" data-default-color="#bfa898" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="dp_options[global_menu_bg_color]" value="<?php echo esc_attr( $options['global_menu_bg_color'] ); ?>" data-default-color="#573312" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Border color', 'tcd-w'); ?></span><input type="text" name="dp_options[global_menu_border_color]" value="<?php echo esc_attr( $options['global_menu_border_color'] ); ?>" data-default-color="#795c41" class="c-color-picker"></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Child menu', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[global_menu_child_font_color]" value="<?php echo esc_attr( $options['global_menu_child_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="dp_options[global_menu_child_bg_color]" value="<?php echo esc_attr( $options['global_menu_child_bg_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Background color on mouse over', 'tcd-w'); ?></span><input type="text" name="dp_options[global_menu_child_bg_color_hover]" value="<?php echo esc_attr( $options['global_menu_child_bg_color_hover'] ); ?>" data-default-color="#462809" class="c-color-picker"></li>
     </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // ドロワーメニュー ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Drawer menu', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content tab_parent">

     <div class="theme_option_message2">
      <p><?php _e('Drawer menu is a menu which will be displayed in mobile device, and will be slide in displayed when user click the menu button on right top of the screen.', 'tcd-w');  ?></p>
     </div>

     <h4 class="theme_option_headline2"><?php _e('Color', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font color of parent menu', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_menu_font_color]" value="<?php echo esc_attr( $options['mobile_menu_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Font color of parent menu on mouse over', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_menu_font_hover_color]" value="<?php echo esc_attr( $options['mobile_menu_font_hover_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Font color of child menu', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_menu_child_font_color]" value="<?php echo esc_attr( $options['mobile_menu_child_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Font color of child menu on mouse over', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_menu_child_font_hover_color]" value="<?php echo esc_attr( $options['mobile_menu_child_font_hover_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Background color of child menu', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_menu_sub_menu_bg_color]" value="<?php echo esc_attr( $options['mobile_menu_sub_menu_bg_color'] ); ?>" data-default-color="#333333" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_menu_bg_color]" value="<?php echo esc_attr( $options['mobile_menu_bg_color'] ); ?>" data-default-color="#222222" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Background color on mouse over', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_menu_bg_hover_color]" value="<?php echo esc_attr( $options['mobile_menu_bg_hover_color'] ); ?>" data-default-color="#ff7f00" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Border color', 'tcd-w'); ?></span><input type="text" name="dp_options[mobile_menu_border_color]" value="<?php echo esc_attr( $options['mobile_menu_border_color'] ); ?>" data-default-color="#444444" class="c-color-picker"></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Banner', 'tcd-w');  ?></h4>
     <div class="sub_box_tab">
      <div class="tab active" data-tab="tab1"><?php _e('Banner', 'tcd-w'); ?>1</div>
      <div class="tab" data-tab="tab2"><?php _e('Banner', 'tcd-w'); ?>2</div>
      <div class="tab" data-tab="tab3"><?php _e('Banner', 'tcd-w'); ?>3</div>
     </div>

     <?php for($i = 1; $i <= 3; $i++) : ?>
     <div class="sub_box_tab_content<?php if($i == 1){ echo ' active'; }; ?>" data-tab-content="tab<?php echo $i; ?>">

       <h4 class="theme_option_headline2"><?php _e('Banner code', 'tcd-w');  ?></h4>
       <p><?php _e('If you are using google adsense, enter all code below.', 'tcd-w');  ?></p>
       <textarea id="dp_options[mobile_menu_ad_code<?php echo $i; ?>]" class="large-text" cols="50" rows="10" name="dp_options[mobile_menu_ad_code<?php echo $i; ?>]"><?php echo esc_textarea( $options['mobile_menu_ad_code'.$i] ); ?></textarea>

       <div class="theme_option_message">
        <p><?php _e('If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w');  ?></p>
       </div>

       <h4 class="theme_option_headline2"><?php _e('Register banner image.', 'tcd-w'); ?></h4>
       <p><?php _e('Recommend image size. Width:300px Height:250px', 'tcd-w'); ?></p>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js mobile_menu_ad_image<?php echo $i; ?>">
         <input type="hidden" value="<?php echo esc_attr( $options['mobile_menu_ad_image'.$i] ); ?>" id="mobile_menu_ad_image<?php echo $i; ?>" name="dp_options[mobile_menu_ad_image<?php echo $i; ?>]" class="cf_media_id">
         <div class="preview_field"><?php if($options['mobile_menu_ad_image'.$i]){ echo wp_get_attachment_image($options['mobile_menu_ad_image'.$i], 'medium'); }; ?></div>
         <div class="buttton_area">
          <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['mobile_menu_ad_image'.$i]){ echo 'hidden'; }; ?>">
         </div>
        </div>
       </div>

       <h4 class="theme_option_headline2"><?php _e('Register affiliate code', 'tcd-w');  ?></h4>
       <div class="cf">
        <div class="admin_link_option" style="max-width:inherit !important;">
         <input type="text" name="dp_options[mobile_menu_ad_url<?php echo $i; ?>]" placeholder="https://example.com/" value="<?php esc_attr_e( $options['mobile_menu_ad_url'.$i] ); ?>">
         <input id="mobile_menu_ad_target<?php echo $i; ?>" class="admin_link_option_target" name="dp_options[mobile_menu_ad_target<?php echo $i; ?>]" type="checkbox" value="1" <?php checked( $options['mobile_menu_ad_target'.$i], 1 ); ?>>
         <label for="mobile_menu_ad_target<?php echo $i; ?>">&#xe92a;</label>
        </div>
       </div>

     </div>
     <?php endfor; ?>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // メガメニュー ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Mega menu', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="theme_option_message2">
      <p><?php _e( 'Set the display format of the sub menu of the global menu', 'tcd-w' ); ?></p>
      <p><?php _e( 'Dropdown menu - Display submenu in drop down.', 'tcd-w'); ?></p>
      <p><?php printf(__('Mega menu A - Display %s list.', 'tcd-w'),$menu_label); ?></p>
      <p><?php printf(__('Mega menu B - Display %s list.', 'tcd-w'),$blog_label); ?></p>
     </div>

     <ul class="megamenu_image clearfix">
      <?php
           foreach ( $megamenu_options as $option ) :
             if(isset($option['img'])){
      ?>
      <li>
       <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/<?php echo esc_attr($option['img']); ?>" alt="<?php echo esc_attr( $option['title'] ); ?>" title="" />
       <p><?php echo esc_html($option['title']); ?></p>
      </li>
      <?php }; endforeach; ?>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Menu type', 'tcd-w');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('Please create custom menu from <a href="./nav-menus.php">menu page</a> and set the position as <strong>"Global menu"</strong> before you use this option.', 'tcd-w');  ?></p>
     </div>
     <?php
          $menu_locations = get_nav_menu_locations();
          $nav_menus = wp_get_nav_menus();
          $global_nav_items = array();
          if ( isset( $menu_locations['global-menu'] ) ) {
            foreach ( (array) $nav_menus as $menu ) {
              if ( $menu_locations['global-menu'] === $menu->term_id ) {
                $global_nav_items = wp_get_nav_menu_items( $menu );
                break;
              }
            }
          }
          echo '<ul class="option_list">';
          foreach ( $global_nav_items as $item ) {
            if ( $item->menu_item_parent ) continue;
            $value = isset( $options['megamenu'][$item->ID] ) ? $options['megamenu'][$item->ID] : '';
            echo '<li class="cf"><span class="label">' . esc_html( $item->title ) . '</span>';
            echo '<select name="dp_options[megamenu][' . esc_attr( $item->ID ) . ']">';
            foreach ( $megamenu_options as $option ) {
              echo '<option value="' . esc_attr( $option['value'] ) . '" ' . selected( $option['value'], $value, false ) . '>' . esc_html( $option['label'] ) . '</option>';
            }
            echo '</select>';
            echo '</li>';
          }
          echo '</ul>' . "\n";
     ?>

     <h4 class="theme_option_headline2"><?php _e('Mega menu A', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="dp_options[mega_menu_a_bg_color]" value="<?php echo esc_attr( $options['mega_menu_a_bg_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
      <li class="cf">
       <span class="label"><?php _e('Transparency of background color', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[mega_menu_a_bg_opacity]" value="<?php echo esc_attr( $options['mega_menu_a_bg_opacity'] ); ?>" />
       <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
        <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
       </div>
      </li>
      <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mega_menu_a_title_font_size]" value="<?php esc_attr_e( $options['mega_menu_a_title_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Background color of title', 'tcd-w'); ?></span><input class="c-color-picker" type="text" name="dp_options[mega_menu_a_title_bg_color]" value="<?php echo esc_attr( $options['mega_menu_a_title_bg_color'] ); ?>" data-default-color="#341e09"></li>
      <li class="cf">
       <span class="label"><?php _e('Transparency of background color', 'tcd-w'); ?></span>
       <input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[mega_menu_a_title_bg_opacity]" value="<?php echo esc_attr( $options['mega_menu_a_title_bg_opacity'] ); ?>" />
       <div class="theme_option_message2">
        <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
       </div>
      </li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Mega menu B', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="dp_options[mega_menu_b_bg_color]" value="<?php echo esc_attr( $options['mega_menu_b_bg_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
      <li class="cf">
       <span class="label"><?php _e('Transparency of background color', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[mega_menu_b_bg_opacity]" value="<?php echo esc_attr( $options['mega_menu_b_bg_opacity'] ); ?>" />
       <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
        <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
       </div>
      </li>
      <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span><input class="font_size hankaku" type="text" name="dp_options[mega_menu_b_title_font_size]" value="<?php esc_attr_e( $options['mega_menu_b_title_font_size'] ); ?>" /><span>px</span></li>
      <li class="cf"><span class="label"><?php _e('Background color of title', 'tcd-w'); ?></span><input class="c-color-picker" type="text" name="dp_options[mega_menu_b_title_bg_color]" value="<?php echo esc_attr( $options['mega_menu_b_title_bg_color'] ); ?>" data-default-color="#000000"></li>
      <li class="cf">
       <span class="label"><?php _e('Transparency of background color', 'tcd-w'); ?></span>
       <input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[mega_menu_b_title_bg_opacity]" value="<?php echo esc_attr( $options['mega_menu_b_title_bg_opacity'] ); ?>" />
       <div class="theme_option_message2">
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


   <?php // パンくずリンクの設定 ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Breadcrumb link', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e('Color', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="dp_options[bread_bg_color]" value="<?php echo esc_attr( $options['bread_bg_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
      <li class="cf">
       <span class="label"><?php _e('Transparency of background color', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[bread_bg_opacity]" value="<?php echo esc_attr( $options['bread_bg_opacity'] ); ?>" />
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


   <?php // SNSボタンの設定 ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('SNS', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="theme_option_message2">
      <p><?php _e('Enter url of your Instagram, TikTok, X, Facebook, Pinterest, YouTube, and contact page. Please leave the field empty if you don\'t want to display certain sns button.', 'tcd-w');  ?></p>
     </div>

     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Instagram URL', 'tcd-w');  ?></span><input class="full_width" type="text" name="dp_options[header_instagram_url]" value="<?php esc_attr_e( $options['header_instagram_url'] ); ?>" /></li>
      <li class="cf"><span class="label"><?php _e('TikTok URL', 'tcd-w');  ?></span><input class="full_width" type="text" name="dp_options[header_tiktok_url]" value="<?php esc_attr_e( $options['header_tiktok_url'] ); ?>" /></li>
      <li class="cf"><span class="label"><?php _e('X URL', 'tcd-w');  ?></span><input class="full_width" type="text" name="dp_options[header_twitter_url]" value="<?php esc_attr_e( $options['header_twitter_url'] ); ?>" /></li>
      <li class="cf"><span class="label"><?php _e('Facebook URL', 'tcd-w');  ?></span><input class="full_width" type="text" name="dp_options[header_facebook_url]" value="<?php esc_attr_e( $options['header_facebook_url'] ); ?>" /></li>
      <li class="cf"><span class="label"><?php _e('Pinterest URL', 'tcd-w');  ?></span><input class="full_width" type="text" name="dp_options[header_pinterest_url]" value="<?php esc_attr_e( $options['header_pinterest_url'] ); ?>" /></li>
      <li class="cf"><span class="label"><?php _e('YouTube URL', 'tcd-w');  ?></span><input class="full_width" type="text" name="dp_options[header_youtube_url]" value="<?php esc_attr_e( $options['header_youtube_url'] ); ?>" /></li>
      <li class="cf"><span class="label"><?php _e('Your Contact page URL (You can use mailto:)', 'tcd-w');  ?></span><input class="full_width" type="text" name="dp_options[header_contact_url]" value="<?php esc_attr_e( $options['header_contact_url'] ); ?>" /></li>
     </ul>
     <hr />
     <p><label><input name="dp_options[header_show_rss]" type="checkbox" value="1" <?php checked( '1', $options['header_show_rss'] ); ?> /> <?php _e('Display RSS button', 'tcd-w');  ?></label></p>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


</div><!-- END .tab-content -->

<?php
} // END add_header_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_header_theme_options_validate( $input ) {

  global $dp_default_options, $header_fix_options, $header_fix_options2, $megamenu_options, $site_desc_options, $font_type_options;

  // ヘッダーの設定
  $input['header_fix'] = wp_filter_nohtml_kses( $input['header_fix'] );
  $input['mobile_header_fix'] = wp_filter_nohtml_kses( $input['mobile_header_fix'] );

  // サイトの説明文
  if ( ! isset( $input['header_show_desc'] ) )
    $input['header_show_desc'] = null;
  if ( ! array_key_exists( $input['header_show_desc'], $site_desc_options ) )
    $input['header_show_desc'] = null;
  $input['header_desc_font_size'] = wp_filter_nohtml_kses( $input['header_desc_font_size'] );
  $input['header_desc_font_type'] = San\choice( $input['header_desc_font_type'], [ '1', '2', '3' ] );

  if ( ! isset( $input['show_header_desc_mobile'] ) )
    $input['show_header_desc_mobile'] = null;
    $input['show_header_desc_mobile'] = ( $input['show_header_desc_mobile'] == 1 ? 1 : 0 );
  $input['header_desc_mobile'] = wp_filter_nohtml_kses( $input['header_desc_mobile'] );
  $input['header_desc_font_size_mobile'] = wp_filter_nohtml_kses( $input['header_desc_font_size_mobile'] );
  $input['header_desc_font_type_mobile'] = San\choice( $input['header_desc_font_type_mobile'], [ '1', '2', '3' ] );


  // グローバルメニューの設定
  $input['global_menu_font_type'] = San\choice( $input['global_menu_font_type'], [ '1', '2', '3' ] );

  $input['global_menu_font_color'] = wp_filter_nohtml_kses( $input['global_menu_font_color'] );
  $input['global_menu_font_color_hover'] = wp_filter_nohtml_kses( $input['global_menu_font_color_hover'] );
  $input['global_menu_bg_color'] = wp_filter_nohtml_kses( $input['global_menu_bg_color'] );
  $input['global_menu_border_color'] = wp_filter_nohtml_kses( $input['global_menu_border_color'] );
  $input['global_menu_child_font_color'] = wp_filter_nohtml_kses( $input['global_menu_child_font_color'] );
  $input['global_menu_child_bg_color'] = wp_filter_nohtml_kses( $input['global_menu_child_bg_color'] );
  $input['global_menu_child_bg_color_hover'] = wp_filter_nohtml_kses( $input['global_menu_child_bg_color_hover'] );

  // ドロワーメニューの設定
  $input['mobile_menu_font_color'] = wp_filter_nohtml_kses( $input['mobile_menu_font_color'] );
  $input['mobile_menu_font_hover_color'] = wp_filter_nohtml_kses( $input['mobile_menu_font_hover_color'] );
  $input['mobile_menu_child_font_color'] = wp_filter_nohtml_kses( $input['mobile_menu_child_font_color'] );
  $input['mobile_menu_child_font_hover_color'] = wp_filter_nohtml_kses( $input['mobile_menu_child_font_hover_color'] );
  $input['mobile_menu_bg_color'] = wp_filter_nohtml_kses( $input['mobile_menu_bg_color'] );
  $input['mobile_menu_sub_menu_bg_color'] = wp_filter_nohtml_kses( $input['mobile_menu_sub_menu_bg_color'] );
  $input['mobile_menu_bg_hover_color'] = wp_filter_nohtml_kses( $input['mobile_menu_bg_hover_color'] );
  $input['mobile_menu_border_color'] = wp_filter_nohtml_kses( $input['mobile_menu_border_color'] );
  for ( $i = 1; $i <= 3; $i++ ) {
    $input['mobile_menu_ad_code'.$i] = $input['mobile_menu_ad_code'.$i];
    $input['mobile_menu_ad_image'.$i] = wp_filter_nohtml_kses( $input['mobile_menu_ad_image'.$i] );
    $input['mobile_menu_ad_url'.$i] = wp_filter_nohtml_kses( $input['mobile_menu_ad_url'.$i] );
    $input['mobile_menu_ad_target'.$i] = ! empty( $input['mobile_menu_ad_target'.$i] ) ? 1 : 0;
  }

  // メガメニュー
  $input['mega_menu_a_bg_color'] = wp_filter_nohtml_kses( $input['mega_menu_a_bg_color'] );
  $input['mega_menu_a_bg_opacity'] = wp_filter_nohtml_kses( $input['mega_menu_a_bg_opacity'] );
  $input['mega_menu_a_title_font_size'] = wp_filter_nohtml_kses( $input['mega_menu_a_title_font_size'] );
  $input['mega_menu_a_sub_title_font_size'] = wp_filter_nohtml_kses( $input['mega_menu_a_sub_title_font_size'] );
  $input['mega_menu_a_title_bg_color'] = wp_filter_nohtml_kses( $input['mega_menu_a_title_bg_color'] );
  $input['mega_menu_a_title_bg_opacity'] = wp_filter_nohtml_kses( $input['mega_menu_a_title_bg_opacity'] );
  $input['mega_menu_b_bg_color'] = wp_filter_nohtml_kses( $input['mega_menu_b_bg_color'] );
  $input['mega_menu_b_bg_opacity'] = wp_filter_nohtml_kses( $input['mega_menu_b_bg_opacity'] );
  $input['mega_menu_b_title_font_size'] = wp_filter_nohtml_kses( $input['mega_menu_b_title_font_size'] );
  $input['mega_menu_b_title_bg_color'] = wp_filter_nohtml_kses( $input['mega_menu_b_title_bg_color'] );
  $input['mega_menu_b_title_bg_opacity'] = wp_filter_nohtml_kses( $input['mega_menu_b_title_bg_opacity'] );
  foreach ( array_keys( $input['megamenu'] ) as $index ) {
    if ( ! array_key_exists( $input['megamenu'][$index], $megamenu_options ) ) {
      $input['megamenu'][$index] = null;
    }
  }

  // パンくずリンク
  $input['bread_bg_color'] = wp_filter_nohtml_kses( $input['bread_bg_color'] );
  $input['bread_bg_opacity'] = wp_filter_nohtml_kses( $input['bread_bg_opacity'] );

  // フッターのSNSボタンの設定
  $input['header_facebook_url'] = wp_filter_nohtml_kses( $input['header_facebook_url'] );
  $input['header_twitter_url'] = wp_filter_nohtml_kses( $input['header_twitter_url'] );
  $input['header_instagram_url'] = wp_filter_nohtml_kses( $input['header_instagram_url'] );
  $input['header_pinterest_url'] = wp_filter_nohtml_kses( $input['header_pinterest_url'] );
  $input['header_youtube_url'] = wp_filter_nohtml_kses( $input['header_youtube_url'] );
  $input['header_contact_url'] = wp_filter_nohtml_kses( $input['header_contact_url'] );
  $input['header_tiktok_url'] = wp_filter_nohtml_kses( $input['header_tiktok_url'] );
  $input['header_show_rss'] = ! empty( $input['header_show_rss'] ) ? 1 : 0;

	return $input;

};


?>