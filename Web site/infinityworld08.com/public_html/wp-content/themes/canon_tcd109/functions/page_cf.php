<?php

/* フォーム用 画像フィールド出力 */
function mlcf_media_form($cf_key, $label) {
	global $post;
	if (empty($cf_key)) return false;
	if (empty($label)) $label = $cf_key;

	$media_id = get_post_meta($post->ID, $cf_key, true);
?>
 <div class="image_box cf">
  <div class="cf cf_media_field hide-if-no-js <?php echo esc_attr($cf_key); ?>">
    <input type="hidden" class="cf_media_id" name="<?php echo esc_attr($cf_key); ?>" id="<?php echo esc_attr($cf_key); ?>" value="<?php echo esc_attr($media_id); ?>" />
    <div class="preview_field"><?php if ($media_id) the_mlcf_image($post->ID, $cf_key); ?></div>
    <div class="buttton_area">
     <input type="button" class="cfmf-select-img button" value="<?php _e('Select Image', 'tcd-canon'); ?>" />
     <input type="button" class="cfmf-delete-img button<?php if (!$media_id) echo ' hidden'; ?>" value="<?php _e('Remove Image', 'tcd-canon'); ?>" />
    </div>
  </div>
 </div>
<?php
}




/* 画像フィールドで選択された画像をimgタグで出力 */
function the_mlcf_image($post_id, $cf_key, $image_size = 'medium') {
	echo get_mlcf_image($post_id, $cf_key, $image_size);
}

/* 画像フィールドで選択された画像をimgタグで返す */
function get_mlcf_image($post_id, $cf_key, $image_size = 'medium') {
	global $post;
	if (empty($cf_key)) return false;
	if (empty($post_id)) $post_id = $post->ID;

	$media_id = get_post_meta($post_id, $cf_key, true);
	if ($media_id) {
		return wp_get_attachment_image($media_id, $image_size, $image_size);
	}

	return false;
}

/* 画像フィールドで選択された画像urlを返す */
function get_mlcf_image_url($post_id, $cf_key, $image_size = 'medium') {
	global $post;
	if (empty($cf_key)) return false;
	if (empty($post_id)) $post_id = $post->ID;

	$media_id = get_post_meta($post_id, $cf_key, true);
	if ($media_id) {
		$img = wp_get_attachment_image_src($media_id, $image_size);
		if (!empty($img[0])) {
			return $img[0];
		}
	}

	return false;
}

/* 画像フィールドで選択されたメディアのURLを出力 */
function the_mlcf_media_url($post_id, $cf_key) {
	echo get_mlcf_media_url($post_id, $cf_key);
}

/* 画像フィールドで選択されたメディアのURLを返す */
function get_mlcf_media_url($post_id, $cf_key) {
	global $post;
	if (empty($cf_key)) return false;
	if (empty($post_id)) $post_id = $post->ID;

	$media_id = get_post_meta($post_id, $cf_key, true);
	if ($media_id) {
		return wp_get_attachment_url($media_id);
	}

	return false;
}


// ヘッダーの設定 -------------------------------------------------------

function page_header_meta_box() {
  add_meta_box(
    'tcd_meta_box1',//ID of meta box
    __('Page setting', 'tcd-canon'),//label
    'show_page_header_meta_box',//callback function
    'page',// post type
    'normal',// context
    'high'// priority
  );
}
add_action('add_meta_boxes', 'page_header_meta_box');

function show_page_header_meta_box() {

  global $post, $font_type_options, $blog_label;
  $options = get_design_plus_option();
  $main_color = $options['main_color'];

  // 表示設定
  $hide_page_header = get_post_meta($post->ID, 'hide_page_header', true) ?  get_post_meta($post->ID, 'hide_page_header', true) : 'no';
  $hide_page_header_image = get_post_meta($post->ID, 'hide_page_header_image', true) ?  get_post_meta($post->ID, 'hide_page_header_image', true) : 'no';
  $page_hide_footer = get_post_meta($post->ID, 'page_hide_footer', true) ?  get_post_meta($post->ID, 'page_hide_footer', true) : 'no';
  $hide_breadcrumb = get_post_meta($post->ID, 'hide_breadcrumb', true) ?  get_post_meta($post->ID, 'hide_breadcrumb', true) : 'yes';
  $hide_sidebar = get_post_meta($post->ID, 'hide_sidebar', true) ?  get_post_meta($post->ID, 'hide_sidebar', true) : 'hide';
  $hide_header_message = get_post_meta($post->ID, 'hide_header_message', true) ?  get_post_meta($post->ID, 'hide_header_message', true) : 'yes';
  $page_content_width = get_post_meta($post->ID, 'page_content_width', true) ?  get_post_meta($post->ID, 'page_content_width', true) : '1000';

  // 画像スライダー
  $image_slider = get_post_meta($post->ID, 'image_slider', true);
  $image_slider_type = get_post_meta($post->ID, 'image_slider_type', true) ?  get_post_meta($post->ID, 'image_slider_type', true) : 'type1';
  $display = 'none';
  $image_ids = explode( ',', $image_slider );

  // プラン一覧
  $hide_plan_list = get_post_meta($post->ID, 'hide_plan_list', true) ?  get_post_meta($post->ID, 'hide_plan_list', true) : 'yes';
  $plan_list_headline = get_post_meta($post->ID, 'plan_list_headline', true) ?  get_post_meta($post->ID, 'plan_list_headline', true) : 'PLAN';
  $plan_list_sub_headline = get_post_meta($post->ID, 'plan_list_sub_headline', true) ?  get_post_meta($post->ID, 'plan_list_sub_headline', true) : '';
  $plan_list_num = get_post_meta($post->ID, 'plan_list_num', true) ?  get_post_meta($post->ID, 'plan_list_num', true) : '6';
  $plan_list_num_sp = get_post_meta($post->ID, 'plan_list_num_sp', true) ?  get_post_meta($post->ID, 'plan_list_num_sp', true) : '4';
  $plan_list_type = get_post_meta($post->ID, 'plan_list_type', true) ?  get_post_meta($post->ID, 'plan_list_type', true) : 'all_post';
  $plan_list_order = get_post_meta($post->ID, 'plan_list_order', true) ?  get_post_meta($post->ID, 'plan_list_order', true) : 'date';
  $plan_list_order_custom = get_post_meta($post->ID, 'plan_list_order_custom', true) ?  get_post_meta($post->ID, 'plan_list_order_custom', true) : '';
  $plan_list_category_id = get_post_meta($post->ID, 'plan_list_category_id', true) ?  get_post_meta($post->ID, 'plan_list_category_id', true) : '';

  // LP専用
  $header_style = get_post_meta($post->ID, 'header_style', true) ?  get_post_meta($post->ID, 'header_style', true) : 'type2';
  $header_catch_layout = get_post_meta($post->ID, 'header_catch_layout', true) ?  get_post_meta($post->ID, 'header_catch_layout', true) : 'type3';

  $header_catch = get_post_meta($post->ID, 'header_catch', true);
  $header_catch_mobile = get_post_meta($post->ID, 'header_catch_mobile', true);
  $header_catch_font_type = get_post_meta($post->ID, 'header_catch_font_type', true) ?  get_post_meta($post->ID, 'header_catch_font_type', true) : 'type3';
  $header_catch_font_size = get_post_meta($post->ID, 'header_catch_font_size', true) ?  get_post_meta($post->ID, 'header_catch_font_size', true) : '42';
  $header_catch_font_size_sp = get_post_meta($post->ID, 'header_catch_font_size_sp', true) ?  get_post_meta($post->ID, 'header_catch_font_size_sp', true) : '20';
  $header_catch_font_color = get_post_meta($post->ID, 'header_catch_font_color', true) ?  get_post_meta($post->ID, 'header_catch_font_color', true) : '#ffffff';

  $header_sub_catch = get_post_meta($post->ID, 'header_sub_catch', true);
  $header_sub_catch_mobile = get_post_meta($post->ID, 'header_sub_catch_mobile', true);
  $header_sub_catch_font_type = get_post_meta($post->ID, 'header_sub_catch_font_type', true) ?  get_post_meta($post->ID, 'header_sub_catch_font_type', true) : 'type2';
  $header_sub_catch_font_size = get_post_meta($post->ID, 'header_sub_catch_font_size', true) ?  get_post_meta($post->ID, 'header_sub_catch_font_size', true) : '20';
  $header_sub_catch_font_size_sp = get_post_meta($post->ID, 'header_sub_catch_font_size_sp', true) ?  get_post_meta($post->ID, 'header_sub_catch_font_size_sp', true) : '14';
  $header_sub_catch_font_color = get_post_meta($post->ID, 'header_sub_catch_font_color', true) ?  get_post_meta($post->ID, 'header_sub_catch_font_color', true) : '#ffffff';

  $header_button_label = get_post_meta($post->ID, 'header_button_label', true);
  $header_button_url = get_post_meta($post->ID, 'header_button_url', true);
  $header_button_target = get_post_meta($post->ID, 'header_button_target', true);
  $header_button_color = get_post_meta($post->ID, 'header_button_color', true) ?  get_post_meta($post->ID, 'header_button_color', true) : $main_color;

  $header_overlay_color = get_post_meta($post->ID, 'header_overlay_color', true) ?  get_post_meta($post->ID, 'header_overlay_color', true) : '#000000';
  $header_overlay_color_opacity = get_post_meta($post->ID, 'header_overlay_color_opacity', true) ?  get_post_meta($post->ID, 'header_overlay_color_opacity', true) : '0.3';
  if($header_overlay_color_opacity == 'zero'){
    $header_overlay_color_opacity = '0';
  }
  $header_height = get_post_meta($post->ID, 'header_height', true) ?  get_post_meta($post->ID, 'header_height', true) : 'type1';
  $header_message = get_post_meta($post->ID, 'header_message', true);
  $header_message_url = get_post_meta($post->ID, 'header_message_url', true);
  $header_message_target = get_post_meta($post->ID, 'header_message_target', true);
  $header_message_font_color = get_post_meta($post->ID, 'header_message_font_color', true) ?  get_post_meta($post->ID, 'header_message_font_color', true) : '#ffffff';
  $header_message_bg_color = get_post_meta($post->ID, 'header_message_bg_color', true) ?  get_post_meta($post->ID, 'header_message_bg_color', true) : '#000000';
  $use_page_animation = get_post_meta($post->ID, 'use_page_animation', true) ?  get_post_meta($post->ID, 'use_page_animation', true) : 'yes';


  echo '<input type="hidden" name="page_header_custom_fields_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

  //入力欄 ***************************************************************************************************************************************************************************************
?>

<?php
     // ブロックエディタ用対策として隠しフィールドを用意　選択されているページテンプレートによってLPページ用入力欄を表示・非表示する
     if ( count( get_page_templates( $post ) ) > 0 && get_option( 'page_for_posts' ) != $post->ID ) :
       $template = ! empty( $post->page_template ) ? $post->page_template : false;
?>
<select name="hidden_page_template" id="hidden_page_template" style="display:none;">
 <option value="">Default Template</option>
 <?php page_template_dropdown( $template, 'page' ); ?>
</select>
<?php endif; ?>
<select name="hidden_parent_page" id="hidden_parent_page" style="display:none;">
 <option value="">No parent page</option>
 <?php
      $pages = get_pages();
      foreach ($pages as $page) {
 ?>
 <option value="<?php echo esc_attr($page->ID); ?>"<?php if($page->post_parent != 0){ echo ' selected="selected"'; }; ?>><?php echo esc_html($page->post_title); ?></option>
 <?php }; ?>
</select>

<div class="tcd_custom_field_wrap">

  <?php // 基本設定 --------------------------------------------------- ?>
  <div class="theme_option_field cf theme_option_field_ac" id="basic_page_setting">
   <h3 class="theme_option_headline"><?php _e( 'Display setting', 'tcd-canon' ); ?></h3>
   <div class="theme_option_field_ac_content">

    <div class="cb_image lp_template_option">
     <img src="<?php bloginfo('template_url'); ?>/admin/img/image/lp_page.jpg?1.1" width="" height="" />
    </div>

    <div class="cb_image normal_template_option">
     <div class="item">
      <img src="<?php bloginfo('template_url'); ?>/admin/img/image/page_sidebar.jpg" width="" height="" />
     </div>
     <div class="item">
      <img src="<?php bloginfo('template_url'); ?>/admin/img/image/page_plan_list.jpg" width="" height="" />
     </div>
    </div>

    <ul class="option_list">
     <li class="lp_template_option cf">
      <span class="label"><span class="num lp_template_option">1</span><?php _e('Header message', 'tcd-canon');  ?></span>
      <div class="standard_radio_button">
       <input type="radio" id="hide_header_message_no" name="hide_header_message" value="no"<?php checked( $hide_header_message, 'no' ); ?>>
       <label for="hide_header_message_no"><?php _e('Display', 'tcd-canon');  ?></label>
       <input type="radio" id="hide_header_message_yes" name="hide_header_message" value="yes"<?php checked( $hide_header_message, 'yes' ); ?>>
       <label for="hide_header_message_yes"><?php _e('Hide', 'tcd-canon');  ?></label>
      </div>
     </li>
     <li class="lp_template_option header_message_option cf space">
      <span class="label"><?php _e('Message', 'tcd-canon'); ?></span>
      <textarea class="full_width" cols="50" rows="2" name="header_message"><?php echo esc_textarea($header_message); ?></textarea>
     </li>
     <li class="lp_template_option header_message_option cf space">
      <span class="label"><?php _e('URL', 'tcd-canon'); ?></span>
      <div class="admin_link_option">
       <input type="text" name="header_message_url" placeholder="https://example.com/" value="<?php echo esc_attr( $header_message_url ); ?>">
       <input id="header_message_target" class="admin_link_option_target" name="header_message_target" type="checkbox" value="1" <?php checked( $header_message_target, 1 ); ?>>
       <label for="header_message_target">&#xe920;</label>
      </div>
     </li>
     <li class="lp_template_option header_message_option cf space">
      <span class="label"><?php _e('Font color', 'tcd-canon'); ?></span><input type="text" name="header_message_font_color" value="<?php echo esc_attr( $header_message_font_color ); ?>" data-default-color="#ffffff" class="c-color-picker">
     </li>
     <li class="lp_template_option header_message_option cf space">
      <span class="label"><?php _e('Background color', 'tcd-canon'); ?></span><input type="text" name="header_message_bg_color" value="<?php echo esc_attr( $header_message_bg_color ); ?>" data-default-color="#000000" class="c-color-picker">
     </li>
     <li class="lp_template_option cf">
      <span class="label"><span class="num lp_template_option">2</span><?php _e('Header bar', 'tcd-canon');  ?></span>
      <div class="standard_radio_button">
       <input type="radio" id="hide_page_header_no" name="hide_page_header" value="no"<?php checked( $hide_page_header, 'no' ); ?>>
       <label for="hide_page_header_no"><?php _e('Display', 'tcd-canon');  ?></label>
       <input type="radio" id="hide_page_header_yes" name="hide_page_header" value="yes"<?php checked( $hide_page_header, 'yes' ); ?>>
       <label for="hide_page_header_yes"><?php _e('Hide', 'tcd-canon');  ?></label>
      </div>
     </li>
     <li class="lp_template_option cf">
      <span class="label"><span class="num lp_template_option">3</span><?php _e('Header', 'tcd-canon');  ?></span>
      <div class="standard_radio_button">
       <input type="radio" id="hide_page_header_image_no" name="hide_page_header_image" value="no"<?php checked( $hide_page_header_image, 'no' ); ?>>
       <label for="hide_page_header_image_no"><?php _e('Display', 'tcd-canon');  ?></label>
       <input type="radio" id="hide_page_header_image_yes" name="hide_page_header_image" value="yes"<?php checked( $hide_page_header_image, 'yes' ); ?>>
       <label for="hide_page_header_image_yes"><?php _e('Hide', 'tcd-canon');  ?></label>
      </div>
     </li>
     <li class="cf lp_template_option">
      <span class="label"><span class="num">4</span><?php _e('Content width', 'tcd-canon');  ?></span>
      <input class="hankaku" style="width:100px;" type="number" min="1000" name="page_content_width" value="<?php echo esc_attr($page_content_width); ?>" /><span>px</span>
     </li>
     <li class="lp_template_option cf">
      <span class="label"><span class="num lp_template_option">5</span><?php _e('Footer', 'tcd-canon');  ?></span>
      <div class="standard_radio_button">
       <input type="radio" id="page_hide_footer_no" name="page_hide_footer" value="no"<?php checked( $page_hide_footer, 'no' ); ?>>
       <label for="page_hide_footer_no"><?php _e('Display', 'tcd-canon');  ?></label>
       <input type="radio" id="page_hide_footer_yes" name="page_hide_footer" value="yes"<?php checked( $page_hide_footer, 'yes' ); ?>>
       <label for="page_hide_footer_yes"><?php _e('Hide', 'tcd-canon');  ?></label>
      </div>
     </li>
     <li class="normal_template_option hide_border_option cf">
      <span class="label"><span class="num sidebar_option">1</span><?php _e('Breadcrumb link', 'tcd-canon');  ?></span>
      <div class="standard_radio_button">
       <input type="radio" id="hide_breadcrumb_no" name="hide_breadcrumb" value="no"<?php checked( $hide_breadcrumb, 'no' ); ?>>
       <label for="hide_breadcrumb_no"><?php _e('Display', 'tcd-canon');  ?></label>
       <input type="radio" id="hide_breadcrumb_yes" name="hide_breadcrumb" value="yes"<?php checked( $hide_breadcrumb, 'yes' ); ?>>
       <label for="hide_breadcrumb_yes"><?php _e('Hide', 'tcd-canon');  ?></label>
      </div>
     </li>
     <li class="sidebar_option cf">
      <span class="label"><span class="num">2</span><?php _e('Widget area', 'tcd-canon');  ?></span>
      <div class="standard_radio_button">
       <input type="radio" id="hide_sidebar_left" name="hide_sidebar" value="left"<?php checked( $hide_sidebar, 'left' ); ?>>
       <label for="hide_sidebar_left"><?php _e('Left', 'tcd-canon');  ?></label>
       <input type="radio" id="hide_sidebar_right" name="hide_sidebar" value="right"<?php checked( $hide_sidebar, 'right' ); ?>>
       <label for="hide_sidebar_right"><?php _e('Right', 'tcd-canon');  ?></label>
       <input type="radio" id="hide_sidebar_hide" name="hide_sidebar" value="hide"<?php checked( $hide_sidebar, 'hide' ); ?>>
       <label for="hide_sidebar_hide"><?php _e('Hide', 'tcd-canon');  ?></label>
      </div>
     </li>
     <li class="normal_template_option cf">
      <span class="label"><span class="num">3</span><?php printf(__('%s list', 'tcd-canon'), $blog_label);  ?></span>
      <div class="standard_radio_button">
       <input type="radio" id="hide_plan_list_no" name="hide_plan_list" value="no"<?php checked( $hide_plan_list, 'no' ); ?>>
       <label for="hide_plan_list_no"><?php _e('Display', 'tcd-canon');  ?></label>
       <input type="radio" id="hide_plan_list_yes" name="hide_plan_list" value="yes"<?php checked( $hide_plan_list, 'yes' ); ?>>
       <label for="hide_plan_list_yes"><?php _e('Hide', 'tcd-canon');  ?></label>
      </div>
     </li>
     <li class="cf lp_template_option">
      <span class="label"><?php _e('Animation', 'tcd-canon');  ?></span>
      <div class="standard_radio_button">
       <input type="radio" id="use_page_animation_yes" name="use_page_animation" value="yes"<?php checked( $use_page_animation, 'yes' ); ?>>
       <label for="use_page_animation_yes"><?php _e('Use', 'tcd-canon');  ?></label>
       <input type="radio" id="use_page_animation_no" name="use_page_animation" value="no"<?php checked( $use_page_animation, 'no' ); ?>>
       <label for="use_page_animation_no"><?php _e('Don\'t use', 'tcd-canon');  ?></label>
      </div>
     </li>
    </ul>

    <ul class="button_list cf">
     <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-canon' ); ?></a></li>
    </ul>
   </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->


  <?php // ページヘッダーの設定 --------------------------------------------------- ?>
  <div class="theme_option_field cf theme_option_field_ac" id="page_header_setting_area">
   <h3 class="theme_option_headline"><?php _e( 'Header', 'tcd-canon' ); ?></h3>
   <div class="theme_option_field_ac_content">

    <div class="cb_image">
     <img class="normal_template_option" src="<?php bloginfo('template_url'); ?>/admin/img/image/page_header.jpg?1.2" width="" height="" />
     <img class="lp_template_option" src="<?php bloginfo('template_url'); ?>/admin/img/image/page_lp_header.jpg?1.3" width="" height="" />
    </div>

    <div class="lp_template_option">

     <h4 class="theme_option_headline2"><?php _e('Style', 'tcd-canon');  ?></h4>
     <div id="lp_page_header_style" class="cf">
      <input class="tcd_admin_image_radio_button" id="header_style_type1" type="radio" name="header_style" value="type1" <?php checked( $header_style, 'type1' ); ?>>
      <label for="header_style_type1">
       <span class="image_wrap">
        <img src="<?php bloginfo('template_url'); ?>/admin/img/image/lp/header_style1.jpg?1.1" alt="">
       </span>
       <span class="title_wrap">
        <span class="title"><?php _e('Content width', 'tcd-canon');  ?></span>
       </span>
      </label>
      <input class="tcd_admin_image_radio_button" id="header_style_type2" type="radio" name="header_style" value="type2" <?php checked( $header_style, 'type2' ); ?>>
      <label for="header_style_type2">
       <span class="image_wrap">
        <img src="<?php bloginfo('template_url'); ?>/admin/img/image/lp/header_style2.jpg" alt="">
       </span>
       <span class="title_wrap">
        <span class="title"><?php _e('100% width', 'tcd-canon');  ?></span>
       </span>
      </label>
      <input class="tcd_admin_image_radio_button" id="header_style_type3" type="radio" name="header_style" value="type3" <?php checked( $header_style, 'type3' ); ?>>
      <label for="header_style_type3">
       <span class="image_wrap">
        <img src="<?php bloginfo('template_url'); ?>/admin/img/image/lp/header_style3.jpg" alt="">
       </span>
       <span class="title_wrap">
        <span class="title"><?php _e('Hero header', 'tcd-canon');  ?></span>
       </span>
      </label>
     </div>

    </div>

    <h4 class="theme_option_headline2 lp_template_option"><?php _e('Header image', 'tcd-canon');  ?></h4>
    <ul class="option_list">
     <li class="lp_template_option header_height_option cf">
      <span class="label"><?php _e('Header size', 'tcd-canon');  ?></span>
      <div class="standard_radio_button">
       <input id="header_height_type1" type="radio" name="header_height" value="type1" <?php checked( $header_height, 'type1' ); ?>>
       <label for="header_height_type1">600px</label>
       <input id="header_height_type2" type="radio" name="header_height" value="type2" <?php checked( $header_height, 'type2' ); ?>>
       <label for="header_height_type2"><?php _e('Original size', 'tcd-canon');  ?></label>
      </div>
     </li>
     <li class="cf hide_border_option">
      <span class="label">
       <?php _e('For PC and tablet', 'tcd-canon'); ?>
       <span class="recommend_desc normal_template_option space_fix"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-canon'), '1450', '560'); ?></span>
       <span class="recommend_desc lp_template_option header_style1_option"><?php _e('Recommend image size. Width:Content width, Height:600px.', 'tcd-canon'); ?></span>
       <span class="recommend_desc lp_template_option header_style2_option"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-canon'), '1450', '600'); ?></span>
       <span class="recommend_desc lp_template_option header_style3_option"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-canon'), '1450', '800'); ?></span>
      </span>
      <?php mlcf_media_form('header_image', __('Image', 'tcd-canon')); ?>
     </li>
     <li class="cf">
      <span class="label">
       <?php _e('For mobile', 'tcd-canon'); ?>
       <span class="recommend_desc normal_template_option space_fix"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-canon'), '750', '500'); ?></span>
       <span class="recommend_desc lp_template_option header_style1_option"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-canon'), '750', '500'); ?></span>
       <span class="recommend_desc lp_template_option header_style2_option"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-canon'), '750', '500'); ?></span>
       <span class="recommend_desc lp_template_option header_style3_option"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-canon'), '750', '1050'); ?></span>
      </span>
      <?php mlcf_media_form('header_image_mobile', __('Image', 'tcd-canon')); ?>
     </li>
     <li class="cf"><span class="label"><?php _e('Overlay color of image', 'tcd-canon'); ?></span><input type="text" name="header_overlay_color" value="<?php echo esc_attr( $header_overlay_color ); ?>" data-default-color="#000000" class="c-color-picker"></li>
     <li class="cf">
      <span class="label"><?php _e('Transparency of overlay', 'tcd-canon'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="header_overlay_color_opacity" value="<?php echo esc_attr( $header_overlay_color_opacity ); ?>" />
      <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
       <p><?php _e('Please specify the number of 0 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-canon');  ?><br>
       <?php _e('Please enter 0 if you don\'t want to use overlay.', 'tcd-canon');  ?></p>
      </div>
     </li>
    </ul>

    <div class="lp_template_option">

    <h4 class="theme_option_headline2"><?php _e('Layout', 'tcd-canon');  ?></h4>
    <div class="cb_image middle" id="page_catch_layout_image">
     <img class="type1<?php if($header_catch_layout == 'type1'){ echo ' active'; }; ?>" src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/image/lp/catch_layout1.jpg" alt="">
     <img class="type2<?php if($header_catch_layout == 'type2'){ echo ' active'; }; ?>" src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/image/lp/catch_layout2.jpg" alt="">
     <img class="type3<?php if($header_catch_layout == 'type3'){ echo ' active'; }; ?>" src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/image/lp/catch_layout3.jpg" alt="">
     <img class="type4<?php if($header_catch_layout == 'type4'){ echo ' active'; }; ?>" src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/image/lp/catch_layout4.jpg" alt="">
     <img class="type5<?php if($header_catch_layout == 'type5'){ echo ' active'; }; ?>" src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/image/lp/catch_layout5.jpg" alt="">
     <img class="type6<?php if($header_catch_layout == 'type6'){ echo ' active'; }; ?>" src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/image/lp/catch_layout6.jpg" alt="">
    </div>
    <ul class="option_list">
     <li class="cf">
      <span class="label"><?php _e('Layout', 'tcd-canon'); ?></span>
      <select id="header_catch_layout" name="header_catch_layout">
       <option style="padding-right: 10px;" value="type1" <?php selected( $header_catch_layout, 'type1' ); ?>><?php _e('Align left A', 'tcd-canon'); ?></option>
       <option style="padding-right: 10px;" value="type2" <?php selected( $header_catch_layout, 'type2' ); ?>><?php _e('Align left B', 'tcd-canon'); ?></option>
       <option style="padding-right: 10px;" value="type3" <?php selected( $header_catch_layout, 'type3' ); ?>><?php _e('Align center A', 'tcd-canon'); ?></option>
       <option style="padding-right: 10px;" value="type4" <?php selected( $header_catch_layout, 'type4' ); ?>><?php _e('Align center B', 'tcd-canon'); ?></option>
       <option style="padding-right: 10px;" value="type5" <?php selected( $header_catch_layout, 'type5' ); ?>><?php _e('Align right A', 'tcd-canon'); ?></option>
       <option style="padding-right: 10px;" value="type6" <?php selected( $header_catch_layout, 'type6' ); ?>><?php _e('Align right B', 'tcd-canon'); ?></option>
      </select>
     </li>
    </ul>

    <h4 class="theme_option_headline2"><?php _e('Main catchphrase', 'tcd-canon');  ?></h4>
    <ul class="option_list">
     <li class="cf"><span class="label"><?php _e('Main catchphrase', 'tcd-canon'); ?></span><textarea class="full_width" cols="50" rows="3" name="header_catch"><?php echo esc_textarea($header_catch); ?></textarea></li>
     <li class="cf"><span class="label"><?php _e('Main catchphrase (mobile)', 'tcd-canon'); ?></span><textarea placeholder="<?php _e( 'Please indicate if you would like to display a short text for mobile sizes.', 'tcd-canon' ); ?>" class="full_width" cols="50" rows="3" name="header_catch_mobile"><?php echo esc_textarea($header_catch_mobile); ?></textarea></li>
     <li class="cf">
      <span class="label"><?php _e('Font type', 'tcd-canon');  ?></span>
      <div class="standard_radio_button">
       <?php
            foreach ( $font_type_options as $option ) {
              if(strtoupper(get_locale()) == 'JA'){
                $label = $option['label'];
              } else {
                $label = $option['label_en'];
              }
       ?>
       <input id="header_catch_font_type<?php echo esc_attr($option['value']); ?>" type="radio" name="header_catch_font_type" value="<?php echo esc_attr($option['value']); ?>"<?php checked( $header_catch_font_type, $option['value'] ); ?>>
       <label for="header_catch_font_type<?php echo esc_attr($option['value']); ?>"><?php echo esc_html($option['label']); ?></label>
       <?php } ?>
      </div>
     </li>
     <li class="cf">
      <span class="label"><?php _e('Font size', 'tcd-canon'); ?></span>
      <div class="font_size_option">
       <label class="font_size_label number_option">
        <input class="hankaku input_font_size" type="number" name="header_catch_font_size" value="<?php esc_attr_e( $header_catch_font_size ); ?>"><span class="icon icon_pc"></span>
       </label>
       <label class="font_size_label number_option">
        <input class="hankaku input_font_size_sp" type="number" name="header_catch_font_size_sp" value="<?php esc_attr_e( $header_catch_font_size_sp ); ?>"><span class="icon icon_sp"></span>
       </label>
      </div>
     </li>
     <li class="cf"><span class="label"><?php _e('Font color', 'tcd-canon'); ?></span><input type="text" name="header_catch_font_color" value="<?php echo esc_attr( $header_catch_font_color ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
    </ul>

    <h4 class="theme_option_headline2"><?php _e('Sub catchphrase', 'tcd-canon');  ?></h4>
    <ul class="option_list">
     <li class="cf"><span class="label"><?php _e('Sub catchphrase', 'tcd-canon'); ?></span><textarea class="full_width" cols="50" rows="3" name="header_sub_catch"><?php echo esc_textarea($header_sub_catch); ?></textarea></li>
     <li class="cf"><span class="label"><?php _e('Sub catchphrase (mobile)', 'tcd-canon'); ?></span><textarea placeholder="<?php _e( 'Please indicate if you would like to display a short text for mobile sizes.', 'tcd-canon' ); ?>" class="full_width" cols="50" rows="3" name="header_sub_catch_mobile"><?php echo esc_textarea($header_sub_catch_mobile); ?></textarea></li>
     <li class="cf">
      <span class="label"><?php _e('Font type', 'tcd-canon');  ?></span>
      <div class="standard_radio_button">
       <?php
            foreach ( $font_type_options as $option ) {
              if(strtoupper(get_locale()) == 'JA'){
                $label = $option['label'];
              } else {
                $label = $option['label_en'];
              }
       ?>
       <input id="header_sub_catch_font_type<?php echo esc_attr($option['value']); ?>" type="radio" name="header_sub_catch_font_type" value="<?php echo esc_attr($option['value']); ?>"<?php checked( $header_sub_catch_font_type, $option['value'] ); ?>>
       <label for="header_sub_catch_font_type<?php echo esc_attr($option['value']); ?>"><?php echo esc_html($option['label']); ?></label>
       <?php } ?>
      </div>
     </li>
     <li class="cf">
      <span class="label"><?php _e('Font size', 'tcd-canon'); ?></span>
      <div class="font_size_option">
       <label class="font_size_label number_option">
        <input class="hankaku input_font_size" type="number" name="header_sub_catch_font_size" value="<?php esc_attr_e( $header_sub_catch_font_size ); ?>"><span class="icon icon_pc"></span>
       </label>
       <label class="font_size_label number_option">
        <input class="hankaku input_font_size_sp" type="number" name="header_sub_catch_font_size_sp" value="<?php esc_attr_e( $header_sub_catch_font_size_sp ); ?>"><span class="icon icon_sp"></span>
       </label>
      </div>
     </li>
     <li class="cf"><span class="label"><?php _e('Font color', 'tcd-canon'); ?></span><input type="text" name="header_sub_catch_font_color" value="<?php echo esc_attr( $header_sub_catch_font_color ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
    </ul>

    <h4 class="theme_option_headline2"><?php _e('Button', 'tcd-canon');  ?></h4>
    <ul class="option_list">
     <li class="cf button_option"><span class="label"><?php _e('Label', 'tcd-canon');  ?></span><input class="full_width" type="text" name="header_button_label" value="<?php esc_attr_e( $header_button_label ); ?>" /></li>
     <li class="cf button_option">
      <span class="label"><?php _e('Link URL', 'tcd-canon'); ?></span>
      <div class="admin_link_option">
       <input type="text" name="header_button_url" placeholder="https://example.com/" value="<?php esc_attr_e( $header_button_url ); ?>">
       <input id="header_button_target" class="admin_link_option_target" name="header_button_target" type="checkbox" value="1" <?php checked( $header_button_target, 1 ); ?>>
       <label for="header_button_target">&#xe920;</label>
      </div>
     </li>
     <li class="cf"><span class="label"><?php _e('Background color', 'tcd-canon'); ?></span><input type="text" name="header_button_color" value="<?php echo esc_attr( $header_button_color ); ?>" data-default-color="<?php echo esc_attr($main_color); ?>" class="c-color-picker"></li>
    </ul>

    </div><!-- END .lp_template_option -->

    <ul class="button_list cf">
     <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-canon' ); ?></a></li>
    </ul>
   </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->


  <?php // プラン一覧の設定 --------------------------------------------------- ?>
  <div class="theme_option_field cf theme_option_field_ac" id="page_plan_list_option">
   <h3 class="theme_option_headline"><?php printf(__('%s list', 'tcd-canon'), $blog_label); ?></h3>
   <div class="theme_option_field_ac_content">

    <div class="cb_image">
     <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/image/gallery_plan_list.jpg" alt="" title="" />
    </div>

    <ul class="option_list">
     <li class="cf"><span class="label"><span class="num">1</span><?php _e('Catchphrase', 'tcd-canon');  ?></span><input class="full_width" type="text" placeholder="<?php _e( 'e.g.', 'tcd-canon' ); _e( 'Related post', 'tcd-canon' ); ?>" name="plan_list_headline" value="<?php echo esc_attr($plan_list_headline); ?>"></li>
     <li class="cf space"><span class="label"><?php _e('Subheading', 'tcd-canon');  ?></span><input class="full_width" type="text" name="plan_list_sub_headline" value="<?php echo esc_attr($plan_list_sub_headline); ?>"></li>
     <li class="cf post_list_type_normal_option">
      <span class="label"><span class="num">2</span><?php _e('Number of post to display', 'tcd-canon'); ?></span>
      <div class="display_post_num_option">
       <label for="service_voice_num">
        <input class="hankaku" type="number" id="plan_list_num" name="plan_list_num" value="<?php esc_attr_e( $plan_list_num ); ?>"><span class="icon icon_pc"></span>
       </label>
       <label for="service_voice_num_sp">
        <input class="hankaku" type="number" id="plan_list_num_sp" name="plan_list_num_sp" value="<?php esc_attr_e( $plan_list_num_sp ); ?>"><span class="icon icon_sp"></span>
       </label>
      </div>
     </li>
     <li class="cf space">
      <span class="label"><?php _e('Post type', 'tcd-canon');  ?></span>
      <select class="post_list_type" name="plan_list_type">
       <option style="padding-right: 10px;" value="all_post" <?php selected( $plan_list_type, 'all_post' ); ?>><?php _e('All post', 'tcd-canon'); ?></option>
       <option style="padding-right: 10px;" value="category_post" <?php selected( $plan_list_type, 'category_post' ); ?>><?php _e('Category post', 'tcd-canon'); ?></option>
       <option style="padding-right: 10px;" value="recommend_post" <?php selected( $plan_list_type, 'recommend_post' ); ?>><?php _e('Recommend post', 'tcd-canon'); ?>1</option>
       <option style="padding-right: 10px;" value="recommend_post2" <?php selected( $plan_list_type, 'recommend_post2' ); ?>><?php _e('Recommend post', 'tcd-canon'); ?>2</option>
       <option style="padding-right: 10px;" value="recommend_post3" <?php selected( $plan_list_type, 'recommend_post3' ); ?>><?php _e('Recommend post', 'tcd-canon'); ?>3</option>
       <option style="padding-right: 10px;" value="custom" <?php selected( $plan_list_type, 'custom' ); ?>><?php _e('Custom', 'tcd-canon'); ?></option>
      </select>
     </li>
     <li class="cf space post_list_type_category_option">
      <span class="label"><?php _e('Category', 'tcd-canon'); ?></span>
      <?php
           $category_list = get_terms( 'category', array( 'hide_empty' => true ) );
           if ( $category_list && ! is_wp_error( $category_list ) ) {
             $selected_value = $plan_list_category_id;
             wp_dropdown_categories( array(
              'taxonomy' => 'category',
              'class' => 'category',
              'hierarchical' => true,
              'id' => '',
              'name' => 'plan_list_category_id',
              'selected' => $selected_value,
              'value_field' => 'term_id'
             ) );
           } else {
      ?>
      <p><?php _e('No category is registered', 'tcd-canon');  ?></p>
      <?php }; ?>
     </li>
     <li class="cf space post_list_type_normal_option">
      <span class="label"><?php _e('Post order', 'tcd-canon');  ?></span>
      <div class="standard_radio_button">
       <input id="plan_list_order_date" type="radio" name="plan_list_order" value="date" <?php checked( $plan_list_order, 'date' ); ?>>
       <label for="plan_list_order_date"><?php _e('Date', 'tcd-canon'); ?></label>
       <input id="plan_list_order_rand" type="radio" name="plan_list_order" value="rand" <?php checked( $plan_list_order, 'rand' ); ?>>
       <label for="plan_list_order_rand"><?php _e('Random', 'tcd-canon'); ?></label>
      </div>
     </li>
     <li class="cf space post_list_type_custom_option">
      <span class="label"><?php _e('ID of the article you want to display', 'tcd-canon');  ?><span class="recommend_desc"><?php _e('Enter article IDs separated by commas.<br>The ID can be found in the administration screen.<br><a href="https://tcd-theme.com/2017/01/check_pageid_categoryid.html#tcd_id" target="_blank">Click here to see the ID display section of the TCD theme.</a>', 'tcd-canon'); ?></span></span>
      <input type="text" placeholder="<?php _e( 'e.g.', 'tcd-canon' ); ?>1,3,10" class="full_width hankaku" name="plan_list_order_custom" value="<?php echo esc_attr($plan_list_order_custom); ?>">
     </li>
    </ul>

    <ul class="button_list cf">
     <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-canon' ); ?></a></li>
    </ul>
   </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->


  <?php // FAQの設定 --------------------------------------------------- ?>
  <div id="page_faq_option" class="theme_option_field cf theme_option_field_ac">
   <h3 class="theme_option_headline"><?php _e( 'FAQ', 'tcd-canon' ); ?></h3>
   <div class="theme_option_field_ac_content tab_parent">

    <div class="cb_image">
     <img src="<?php bloginfo('template_url'); ?>/admin/img/image/page_faq.jpg" width="" height="" />
    </div>

    <div class="sub_box_tab">
     <?php for($i = 1; $i <= 5; $i++) : ?>
     <div class="tab<?php if($i == 1){ echo ' active'; }; ?>" data-tab="tab<?php echo $i; ?>"><span class="label"><?php printf(__('FAQ list%s', 'tcd-canon'), $i); ?></span></div>
     <?php endfor; ?>
    </div>

    <?php
        for($i = 1; $i <= 5; $i++) :
          $faq_list = get_post_meta($post->ID, 'faq_list'.$i, true);
    ?>
    <div class="sub_box_tab_content<?php if($i == 1){ echo ' active'; }; ?>" data-tab-content="tab<?php echo $i; ?>">

     <div class="theme_option_message2">
      <p><?php _e('Please copy and paste the short code below where you want to display FAQ list.<br>Multiple FAQ lists can also be created, separated by content, etc.', 'tcd-canon'); ?></p>
      <p><?php _e( 'Short code', 'tcd-canon' ); ?> : <input style="background:#fff; width:200px;" onfocus='this.select();' type="text" value="[tcd_faq<?php echo $i; ?>]" readonly></p>
     </div>

     <?php //繰り返しフィールド ----- ?>
     <div class="repeater-wrapper">
      <div class="repeater sortable" data-delete-confirm="<?php echo tcd_admin_label('delete'); ?>">
        <?php
            if ( $faq_list ) :
              foreach ( $faq_list as $key => $value ) :
        ?>
        <div class="sub_box repeater-item repeater-item-<?php echo $key; ?>">
         <h4 class="theme_option_subbox_headline"><?php echo esc_html( ! empty( $faq_list[$key]['question'] ) ? $faq_list[$key]['question'] : tcd_admin_label('new_item') ); ?></h4>
         <div class="sub_box_content">
          <h4 class="theme_option_headline2"><?php _e( 'Question', 'tcd-canon' ); ?></h4>
          <p><input class="repeater-label full_width" type="text" name="faq_list<?php echo $i; ?>[<?php echo esc_attr( $key ); ?>][question]" value="<?php echo esc_attr( isset( $faq_list[$key]['question'] ) ? $faq_list[$key]['question'] : '' ); ?>" /></p>
          <h4 class="theme_option_headline2"><?php _e( 'Answer', 'tcd-canon' ); ?></h4>
          <textarea class="full_width" cols="50" rows="5" name="faq_list<?php echo $i; ?>[<?php echo esc_attr( $key ); ?>][answer]"><?php echo esc_attr( isset( $faq_list[$key]['answer'] ) ? $faq_list[$key]['answer'] : '' ); ?></textarea>
          <p class="delete-row right-align"><a href="#" class="button red_button button-delete-row"><?php echo tcd_admin_label('delete_item'); ?></a></p>
         </div><!-- END .sub_box_content -->
        </div><!-- END .sub_box -->
        <?php
              endforeach;
            endif;
            $key = 'addindex';
            ob_start();
        ?>
        <div class="sub_box repeater-item repeater-item-<?php echo $key; ?>">
         <h4 class="theme_option_subbox_headline"><?php echo esc_html( ! empty( $faq_list[$key]['question'] ) ? $faq_list[$key]['question'] : tcd_admin_label('new_item') ); ?></h4>
         <div class="sub_box_content">
          <h4 class="theme_option_headline2"><?php _e( 'Question', 'tcd-canon' ); ?></h4>
          <p><input class="repeater-label full_width" type="text" name="faq_list<?php echo $i; ?>[<?php echo esc_attr( $key ); ?>][question]" value="<?php echo esc_attr( isset( $faq_list[$key]['question'] ) ? $faq_list[$key]['question'] : '' ); ?>" /></p>
          <h4 class="theme_option_headline2"><?php _e( 'Answer', 'tcd-canon' ); ?></h4>
          <textarea class="full_width" cols="50" rows="5" name="faq_list<?php echo $i; ?>[<?php echo esc_attr( $key ); ?>][answer]"><?php echo esc_attr( isset( $faq_list[$key]['answer'] ) ? $faq_list[$key]['answer'] : '' ); ?></textarea>
          <p class="delete-row right-align"><a href="#" class="button red_button button-delete-row"><?php echo tcd_admin_label('delete_item'); ?></a></p>
         </div><!-- END .sub_box_content -->
        </div><!-- END .sub_box -->
        <?php
            $clone = ob_get_clean();
        ?>
       </div><!-- END .repeater -->
      <a href="#" class="button button-secondary button-add-row" data-clone="<?php echo esc_attr( $clone ); ?>"><?php echo tcd_admin_label('add_item'); ?></a>
     </div><!-- END .repeater-wrapper -->
     <?php //繰り返しフィールドここまで ----- ?>

    </div><!-- END .sub_box_tab_content -->
    <?php endfor; ?>

    <ul class="button_list cf">
      <li><a class="close_ac_content button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
    </ul>
   </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->


  <?php // 画像スライダー --------------------------------------------------- ?>
  <div class="theme_option_field cf theme_option_field_ac" id="page_image_slider_setting_area">
   <h3 class="theme_option_headline"><?php _e( 'Image slider', 'tcd-canon' ); ?></h3>
   <div class="theme_option_field_ac_content">

    <div class="cb_image">
     <img src="<?php bloginfo('template_url'); ?>/admin/img/image/image_slider.jpg" width="" height="" />
    </div>

    <div class="theme_option_message2">
     <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-canon'), '1000', '550'); ?><br>
     <?php _e('You can register multiple image by clicking images in media library.', 'tcd-canon'); ?><br>
     <?php _e('Please register more than 4 images if you want to display by layout TypeB.', 'tcd-canon'); ?></p>
     <p><?php _e('Please copy and paste the short code below where you want to display image slider.', 'tcd-canon'); ?></p>
     <p><?php _e( 'Short code', 'tcd-canon' ); ?> : <input style="background:#fff; width:200px;" onfocus='this.select();' type="text" value="[tcd_image_slider]" readonly></p>
    </div>

    <h4 class="theme_option_headline2"><?php _e('Layout', 'tcd-canon');  ?></h4>
    <div class="cf">
     <input class="tcd_admin_image_radio_button" id="image_slider_type1" type="radio" name="image_slider_type" value="type1"<?php if($image_slider_type == 'type1'){ echo ' checked="checked"'; }; ?>>
     <label for="image_slider_type1">
      <span class="image_wrap">
       <img src="<?php bloginfo('template_url'); ?>/admin/img/image/image_slider.jpg" alt="">
      </span>
      <span class="title_wrap">
       <span class="title"><?php _e('TypeA', 'tcd-canon');  ?></span>
      </span>
     </label>
     <input class="tcd_admin_image_radio_button" id="image_slider_type2" type="radio" name="image_slider_type" value="type2"<?php if($image_slider_type == 'type2'){ echo ' checked="checked"'; }; ?>>
     <label for="image_slider_type2">
      <span class="image_wrap">
       <img src="<?php bloginfo('template_url'); ?>/admin/img/image/image_slider2.jpg" alt="">
      </span>
      <span class="title_wrap">
       <span class="title"><?php _e('TypeB', 'tcd-canon');  ?></span>
      </span>
     </label>
    </div>

    <h4 class="theme_option_headline2"><?php _e('Image slider', 'tcd-canon');  ?></h4>
    <div class="multi-media-uploader" style="float:none; width:100%;">
     <ul>
      <?php
           if ( $image_slider && !empty( $image_ids ) ) {
             $display = 'inline-block';
             foreach ( $image_ids as $image_id ) {
               if ( $image_attributes = wp_get_attachment_image_src( $image_id, 'full' ) ) {
      ?>
      <li data-attechment-id="<?php echo $image_id; ?>">
       <div class="image"><img loading="lazy" src="<?php echo $image_attributes[0]; ?>" /></div>
       <span class="delete-img"></span>
      </li>
      <?php
              }
            }
          }
      ?>
     </ul>
     <a id="image_slider" href="#" class="js-multi-media-upload-button button">
      <?php _e( 'Select Image', 'tcd-canon' ); ?>
     </a>
     <input type="hidden" class="attechments-ids image_slider" name="image_slider" value="<?php echo esc_attr( implode( ',', $image_ids ) ); ?>" />
     <a href="#" class="js-multi-media-remove-button button" style="display:<?php echo $display; ?>;">
      <?php _e( 'Delete all images', 'tcd-canon' ); ?>
     </a>
    </div>

    <ul class="button_list cf">
     <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-canon' ); ?></a></li>
    </ul>
   </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->


</div><!-- END .tcd_custom_field_wrap -->

<?php
}

function save_page_header_meta_box( $post_id ) {

  // verify nonce
  if (!isset($_POST['page_header_custom_fields_meta_box_nonce']) || !wp_verify_nonce($_POST['page_header_custom_fields_meta_box_nonce'], basename(__FILE__))) {
    return $post_id;
  }

  // check autosave
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return $post_id;
  }

  // check permissions
  if ('page' == $_POST['post_type']) {
    if (!current_user_can('edit_page', $post_id)) {
      return $post_id;
    }
  } elseif (!current_user_can('edit_post', $post_id)) {
      return $post_id;
  }

  // save or delete
  $cf_keys = array(
    'header_image','header_image_mobile','header_overlay_color','header_overlay_color_opacity',
    'header_catch','header_catch_mobile','header_catch_font_type','header_catch_font_size','header_catch_font_size_sp','header_catch_font_color',
    'header_style','header_catch_layout','header_sub_catch','header_sub_catch_mobile','header_sub_catch_font_type','header_sub_catch_font_size','header_sub_catch_font_size_sp','header_sub_catch_font_color',
    'header_button_label','header_button_url','header_button_target','header_button_color',
    'hide_page_header','hide_page_header_image','hide_sidebar','page_hide_footer','hide_breadcrumb','hide_header_message','page_content_width','use_page_animation',
    'header_height','header_message','header_message_url','header_message_target','header_message_font_color','header_message_bg_color',
    'image_slider','image_slider_type','hide_plan_list','plan_list_headline','plan_list_sub_headline','plan_list_num','plan_list_num_sp','plan_list_type','plan_list_order','plan_list_order_custom','plan_list_category_id'
  );
  foreach ($cf_keys as $cf_key) {

    $old = get_post_meta($post_id, $cf_key, true);

    if (isset($_POST[$cf_key])) {
      $new = $_POST[$cf_key];
    } else {
      $new = '';
    }

    if($cf_key == 'header_overlay_color_opacity'){
      if ( $new == '0' ) {
        $new = 'zero';
      }
    }

    if ($new && $new != $old) {
      update_post_meta($post_id, $cf_key, $new);
    } elseif ('' == $new && $old) {
      delete_post_meta($post_id, $cf_key, $old);
    }

  }

  // repeater save or delete
  $cf_keys = array(
    'faq_list1','faq_list2','faq_list3','faq_list4','faq_list5',
  );
  foreach ( $cf_keys as $cf_key ) {
    $old = get_post_meta( $post_id, $cf_key, true );

    if ( isset( $_POST[$cf_key] ) && is_array( $_POST[$cf_key] ) ) {
      $new = array_values( $_POST[$cf_key] );
    } else {
      $new = false;
    }

    if ( $new && $new != $old ) {
      update_post_meta( $post_id, $cf_key, $new );
    } elseif ( ! $new && $old ) {
      delete_post_meta( $post_id, $cf_key, $old );
    }
  }

}
add_action('save_post', 'save_page_header_meta_box');



?>