<?php
/*
 * サービスの設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_service_dp_default_options' );


// Add label of logo tab
add_action( 'tcd_tab_labels', 'add_service_tab_label' );


// Add HTML of logo tab
add_action( 'tcd_tab_panel', 'add_service_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_service_theme_options_validate' );


// タブの名前
function add_service_tab_label( $tab_labels ) {
  $options = get_design_plus_option();
  if($options['use_service']){
    $tab_label = $options['service_label'] ? esc_html( $options['service_label'] ) : __( 'Service', 'tcd-canon' );
  } else {
    $title = $options['service_label'] ? esc_html( $options['service_label'] ) : __( 'Service', 'tcd-canon' );
    $tab_label = __('(N/A) ', 'tcd-canon') . $title;
  }
  $tab_labels['service'] = $tab_label;
  return $tab_labels;
}


// 初期値
function add_service_dp_default_options( $dp_default_options ) {

	// 基本設定
	$dp_default_options['use_service'] = '1';
	$dp_default_options['service_label'] = __( 'Service', 'tcd-canon' );
	$dp_default_options['service_slug'] = 'restaurant';

	// アーカイブページ
	$dp_default_options['service_show_header'] = '1';
	$dp_default_options['archive_service_catch'] = __( 'Catchphrase', 'tcd-canon' );
	$dp_default_options['archive_service_desc'] = __( 'Description will be displayed here.', 'tcd-canon' );
	$dp_default_options['archive_service_desc_mobile'] = '';
	$dp_default_options['archive_service_header_image'] = false;
	$dp_default_options['archive_service_overlay_color'] = '#000000';
	$dp_default_options['archive_service_overlay_opacity'] = '0.3';

	$dp_default_options['archive_service_num'] = '5';
	$dp_default_options['archive_service_num_sp'] = '5';

  // 詳細ページ
	$dp_default_options['service_post_list_layout'] = 'type4';
	$dp_default_options['service_post_list_layout_mobile'] = 'type4';

	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_service_tab_panel( $options ) {

  global $dp_default_options, $font_type_options, $basic_display_options, $service_category_type_options, $blog_label;
  $service_label = $options['service_label'] ? esc_html( $options['service_label'] ) : __( 'Service', 'tcd-canon' );
  $gallery_label = $options['gallery_label'] ? esc_html( $options['gallery_label'] ) : __( 'Guest room', 'tcd-canon' );

?>

<div id="tab-content-service" class="tab-content">


   <?php // 有効化 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac active open custon_post_usage_option">
    <h3 class="theme_option_headline"><?php _e('Validation', 'tcd-canon');  ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="theme_option_message2 custon_post_usage_option_message" style="<?php if($options['use_service']){ echo 'display:none;'; } else { echo 'display:block;'; }; ?>">
      <p><?php printf(__('Currently, all function related to custom post "%s" have been disabled.<br>All areas that have already been set up will be hidden from the site.<br>Please use this option only if you don\'t want to use the custom post "%s" at all. (No archive page will be generated either).', 'tcd-canon'), $service_label, $service_label); ?></p>
     </div>
     <div class="theme_option_message2" style="<?php if($options['use_service']){ echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <p><?php printf(__('Please check off the checkbox if you don\'t want to use custom post "%s".', 'tcd-canon'), $service_label); ?></p>
     </div>
     <p><label><input class="custon_post_usage_option_checkbox" name="dp_options[use_service]" type="checkbox" value="1" <?php checked( 1, $options['use_service'] ); ?>><?php printf(__('Use custom post "%s"', 'tcd-canon'), $service_label); ?></label></p>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-canon' ); ?>" /></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // 基本設定 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Common setting', 'tcd-canon');  ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="front_page_image">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/image/content_name_url.jpg" alt="" title="" />
     </div>

     <h4 class="theme_option_headline_number"><span class="num">1</span><?php _e('Name of content', 'tcd-canon'); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('This name will also be used in breadcrumb link.', 'tcd-canon'); ?></p>
     </div>
     <input type="text" name="dp_options[service_label]" value="<?php echo esc_attr( $options['service_label'] ); ?>" />

     <h4 class="theme_option_headline_number"><span class="num">2</span><?php _e('Slug', 'tcd-canon'); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('Please enter word by alphabet only.<br />After changing slug, please update permalink setting form <a href="./options-permalink.php"><strong>permalink option page</strong></a>.', 'tcd-canon'); ?></p>
     </div>
     <p><input class="hankaku" type="text" name="dp_options[service_slug]" value="<?php echo sanitize_title( $options['service_slug'] ); ?>" /></p>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-canon' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-canon' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // アーカイブページ ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Archive page', 'tcd-canon'); ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="front_page_image">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/image/service_archive.jpg?1.3" alt="" title="" />
     </div>

     <p><label><input class="display_option" data-option-name="service_show_header" name="dp_options[service_show_header]" type="checkbox" value="1" <?php checked( $options['service_show_header'], 1 ); ?>><?php _e( 'Display header area', 'tcd-canon' ); ?></label></p>

     <ul class="option_list">
      <li class="cf" style="border-top:1px dotted #ccc;"><span class="label"><span class="num">1</span><?php _e('Catchphrase', 'tcd-canon'); ?></span><textarea class="full_width" cols="50" rows="3" name="dp_options[archive_service_catch]"><?php echo esc_textarea(  $options['archive_service_catch'] ); ?></textarea></li>
      <li class="cf"><span class="label"><span class="num">2</span><?php _e('Description', 'tcd-canon'); ?></span><textarea class="full_width" cols="50" rows="3" name="dp_options[archive_service_desc]"><?php echo esc_textarea(  $options['archive_service_desc'] ); ?></textarea></li>
      <li class="cf space"><span class="label"><?php _e('Description (mobile)', 'tcd-canon'); ?></span><textarea placeholder="<?php _e( 'Please indicate if you would like to display a short text for mobile sizes.', 'tcd-canon' ); ?>" class="full_width" cols="50" rows="3" name="dp_options[archive_service_desc_mobile]"><?php echo esc_textarea(  $options['archive_service_desc_mobile'] ); ?></textarea></li>
      <li class="cf service_show_header">
       <span class="label">
        <span class="num">3</span><?php _e('Image', 'tcd-canon'); ?>
        <span class="recommend_desc space"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-canon'), '1450', '560'); ?></span>
        <span class="recommend_desc space"><?php _e('This image will also be used in article page.', 'tcd-canon'); ?></span>
       </span>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js archive_service_header_image">
         <input type="hidden" value="<?php echo esc_attr( $options['archive_service_header_image'] ); ?>" id="archive_service_header_image" name="dp_options[archive_service_header_image]" class="cf_media_id">
         <div class="preview_field"><?php if($options['archive_service_header_image']){ echo wp_get_attachment_image($options['archive_service_header_image'], 'medium'); }; ?></div>
         <div class="buttton_area">
          <input type="button" value="<?php _e('Select Image', 'tcd-canon'); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e('Remove Image', 'tcd-canon'); ?>" class="cfmf-delete-img button <?php if(!$options['archive_service_header_image']){ echo 'hidden'; }; ?>">
         </div>
        </div>
       </div>
      </li>
      <li class="cf space service_show_header">
       <span class="label"><?php _e('Color of overlay', 'tcd-canon'); ?></span><input type="text" name="dp_options[archive_service_overlay_color]" value="<?php echo esc_attr( $options['archive_service_overlay_color'] ); ?>" data-default-color="#000000" class="c-color-picker">
      </li>
      <li class="cf space service_show_header">
       <span class="label"><?php _e('Transparency of overlay', 'tcd-canon'); ?></span><input class="hankaku" style="width:70px;" type="number" step="0.1" min="0" max="1" name="dp_options[archive_service_overlay_opacity]" value="<?php echo esc_attr( $options['archive_service_overlay_opacity'] ); ?>" />
       <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
        <p><?php _e('Please specify the number of 0 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-canon');  ?>
        <?php _e('Please enter 0 if you don\'t want to use overlay.', 'tcd-canon');  ?></p>
       </div>
      </li>
     </ul>

     <h4 class="theme_option_headline2"><?php printf(__('%s list', 'tcd-canon'), $service_label); ?></h4>
     <div class="theme_option_message2">
      <p><?php printf(__('Articles will be displayed in the same order as they appear in the <a href="./edit.php?post_type=%s" target="_blank">%s admin page</a>. They can be reordered by dragging and dropping.', 'tcd-canon'), 'service', $service_label); ?></p>
     </div>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php echo tcd_admin_label('article_list_num'); ?></span><?php echo tcd_display_post_num_option_type2($options, 'archive_service_num'); ?></li>
     </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-canon' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-canon' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // 詳細ページ ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php printf(__('%s page', 'tcd-canon'), $service_label); ?></h3>
    <div class="theme_option_field_ac_content">

     <?php // サービス一覧 ----------------------------- ?>
     <div class="front_page_image">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/image/service_post_list.jpg" alt="" title="" />
     </div>

     <h4 class="theme_option_headline2"><?php printf(__('%s list', 'tcd-canon'), $service_label); ?></h4>

     <ul class="option_list">
      <li class="cf">
       <span class="label"><?php _e('Layout', 'tcd-canon');  ?></span>
       <div class="standard_radio_button">
        <input id="service_post_list_layout1" type="radio" name="dp_options[service_post_list_layout]" value="type1" <?php checked( $options['service_post_list_layout'], 'type1' ); ?>>
        <label for="service_post_list_layout1"><?php _e('Three column', 'tcd-canon'); ?></label>
        <input id="service_post_list_layout2" type="radio" name="dp_options[service_post_list_layout]" value="type2" <?php checked( $options['service_post_list_layout'], 'type2' ); ?>>
        <label for="service_post_list_layout2"><?php _e('Four column', 'tcd-canon'); ?></label>
        <input id="service_post_list_layout3" type="radio" name="dp_options[service_post_list_layout]" value="type3" <?php checked( $options['service_post_list_layout'], 'type3' ); ?>>
        <label for="service_post_list_layout3"><?php _e('Five column', 'tcd-canon'); ?></label>
       </div>
      </li>
      <li class="cf">
       <span class="label"><?php _e('Layout (mobile)', 'tcd-canon');  ?></span>
       <div class="standard_radio_button">
        <input id="service_post_list_layout_mobile1" type="radio" name="dp_options[service_post_list_layout_mobile]" value="type1" <?php checked( $options['service_post_list_layout_mobile'], 'type1' ); ?>>
        <label for="service_post_list_layout_mobile1"><?php _e('One column', 'tcd-canon'); ?></label>
        <input id="service_post_list_layout_mobile2" type="radio" name="dp_options[service_post_list_layout_mobile]" value="type2" <?php checked( $options['service_post_list_layout_mobile'], 'type2' ); ?>>
        <label for="service_post_list_layout_mobile2"><?php _e('Two column', 'tcd-canon'); ?></label>
        <input id="service_post_list_layout_mobile3" type="radio" name="dp_options[service_post_list_layout_mobile]" value="type3" <?php checked( $options['service_post_list_layout_mobile'], 'type3' ); ?>>
        <label for="service_post_list_layout_mobile3"><?php _e('Three column', 'tcd-canon'); ?></label>
       </div>
      </li>
     </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-canon' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-canon' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


</div><!-- END .tab-content -->

<?php
} // END add_service_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_service_theme_options_validate( $input ) {

  global $dp_default_options, $font_type_options;

  //基本設定
  $input['use_service'] = wp_filter_nohtml_kses( $input['use_service'] );
  $input['service_slug'] = sanitize_title( $input['service_slug'] );
  $input['service_label'] = wp_filter_nohtml_kses( $input['service_label'] );

  // アーカイブ
  $input['service_show_header'] = wp_filter_nohtml_kses( $input['service_show_header'] );
  $input['archive_service_catch'] = wp_filter_nohtml_kses( $input['archive_service_catch'] );
  $input['archive_service_desc'] = wp_kses_post( $input['archive_service_desc'] );
  $input['archive_service_desc_mobile'] = wp_kses_post( $input['archive_service_desc_mobile'] );
  $input['archive_service_header_image'] = wp_filter_nohtml_kses( $input['archive_service_header_image'] );
  $input['archive_service_overlay_color'] = wp_filter_nohtml_kses( $input['archive_service_overlay_color'] );
  $input['archive_service_overlay_opacity'] = wp_filter_nohtml_kses( $input['archive_service_overlay_opacity'] );

  $input['archive_service_num'] = wp_filter_nohtml_kses( $input['archive_service_num'] );
  $input['archive_service_num_sp'] = wp_filter_nohtml_kses( $input['archive_service_num_sp'] );

  // 詳細ページ
  $input['service_post_list_layout'] = wp_filter_nohtml_kses( $input['service_post_list_layout'] );
  $input['service_post_list_layout_mobile'] = wp_filter_nohtml_kses( $input['service_post_list_layout_mobile'] );

	return $input;

};


?>