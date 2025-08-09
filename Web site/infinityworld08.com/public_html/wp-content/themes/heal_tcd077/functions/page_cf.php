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
     <input type="button" class="cfmf-select-img button" value="<?php _e('Select Image', 'tcd-w'); ?>" />
     <input type="button" class="cfmf-delete-img button<?php if (!$media_id) echo ' hidden'; ?>" value="<?php _e('Remove Image', 'tcd-w'); ?>" />
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
    'page_header_meta_box',//ID of meta box
    __('Header setting', 'tcd-w'),//label
    'show_page_header_meta_box',//callback function
    'page',// post type
    'normal',// context
    'high'// priority
  );
}
add_action('add_meta_boxes', 'page_header_meta_box');

function show_page_header_meta_box() {
  global $post;

  $page_title_font_size = get_post_meta($post->ID, 'page_title_font_size', true);
  if(empty($page_title_font_size)){
    $page_title_font_size = '38';
  }
  $page_title_font_size_mobile = get_post_meta($post->ID, 'page_title_font_size_mobile', true);
  if(empty($page_title_font_size_mobile)){
    $page_title_font_size_mobile = '22';
  }

  $page_sub_title = get_post_meta($post->ID, 'page_sub_title', true);
  $page_sub_title_font_size = get_post_meta($post->ID, 'page_sub_title_font_size', true);
  if(empty($page_sub_title_font_size)){
    $page_sub_title_font_size = '18';
  }
  $page_sub_title_font_size_mobile = get_post_meta($post->ID, 'page_sub_title_font_size_mobile', true);
  if(empty($page_sub_title_font_size_mobile)){
    $page_sub_title_font_size_mobile = '12';
  }

  $page_font_color = get_post_meta($post->ID, 'page_font_color', true);
  if(empty($page_font_color)){
    $page_font_color = '#FFFFFF';
  }

  $page_use_overlay = get_post_meta($post->ID, 'page_use_overlay', true);
  $page_overlay_color = get_post_meta($post->ID, 'page_overlay_color', true);
  if(empty($page_overlay_color)){
    $page_overlay_color = '#000000';
  }
  $page_overlay_opacity = get_post_meta($post->ID, 'page_overlay_opacity', true);
  if(empty($page_overlay_opacity)){
    $page_overlay_opacity = '0.3';
  }

  echo '<input type="hidden" name="page_header_custom_fields_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

  //入力欄 ***************************************************************************************************************************************************************************************
?>

<div class="tcd_custom_field_wrap">

  <div class="theme_option_field cf theme_option_field_ac">
   <h3 class="theme_option_headline"><?php _e( 'Header', 'tcd-w' ); ?></h3>
   <div class="theme_option_field_ac_content">

    <h3 class="theme_option_headline2"><?php _e('Sub title', 'tcd-w'); ?></h3>
    <input style="width:100%;" type="text" name="page_sub_title" value="<?php echo esc_attr($page_sub_title); ?>" />

    <h3 class="theme_option_headline2"><?php _e( 'Font', 'tcd-w' ); ?></h3>
    <ul class="option_list">
     <li class="cf">
      <span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span>
      <div class="font_size_option">
       <label class="font_size_label number_option">
        <input class="hankaku input_font_size" type="number" name="page_title_font_size" value="<?php esc_attr_e( $page_title_font_size ); ?>"><span class="icon icon_pc"></span>
       </label>
       <label class="font_size_label number_option">
        <input class="hankaku input_font_size_sp" type="number" name="page_title_font_size_mobile" value="<?php esc_attr_e( $page_title_font_size_mobile ); ?>"><span class="icon icon_sp"></span>
       </label>
      </div>
     </li>
     <li class="cf">
      <span class="label"><?php _e('Font size of sub title', 'tcd-w'); ?></span>
      <div class="font_size_option">
       <label class="font_size_label number_option">
        <input class="hankaku input_font_size" type="number" name="page_sub_title_font_size" value="<?php esc_attr_e( $page_sub_title_font_size ); ?>"><span class="icon icon_pc"></span>
       </label>
       <label class="font_size_label number_option">
        <input class="hankaku input_font_size_sp" type="number" name="page_sub_title_font_size_mobile" value="<?php esc_attr_e( $page_sub_title_font_size_mobile ); ?>"><span class="icon icon_sp"></span>
       </label>
      </div>
     </li>
    </ul>

    <h3 class="theme_option_headline2"><?php _e( 'Color', 'tcd-w' ); ?></h3>
    <ul class="option_list">
     <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="page_font_color" value="<?php echo esc_attr($page_font_color); ?>" data-default-color="#FFFFFF" class="c-color-picker"></li>
    </ul>

    <h3 class="theme_option_headline2"><?php _e( 'Background image', 'tcd-w' ); ?></h3>
    <ul class="option_list">
     <li class="cf">
      <span class="label">
       <?php _e('Background image', 'tcd-w'); ?>
       <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '1450', '500'); ?></span>
      </span>
      <?php mlcf_media_form('page_bg_image', __('Background image', 'tcd-w')); ?>
     </li>
    </ul>

    <h3 class="theme_option_headline2"><?php _e( 'Overlay', 'tcd-w' ); ?></h3>
    <p class="displayment_checkbox"><label for="page_use_overlay"><input id="page_use_overlay" type="checkbox" name="page_use_overlay" value="1" <?php if( $page_use_overlay == '1' ) { echo 'checked="checked"'; }; ?> /><?php _e( 'Use overlay', 'tcd-w' ); ?></label></p>
    <div class="blog_show_overlay" style="<?php if($page_use_overlay == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
     <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
      <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-w'); ?></span><input type="text" name="page_overlay_color" value="<?php echo esc_attr($page_overlay_color); ?>" data-default-color="#000000" class="c-color-picker" /></li>
      <li class="cf">
       <span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" type="text" name="page_overlay_opacity" value="<?php echo esc_attr($page_overlay_opacity); ?>" />
       <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
        <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
       </div>
      </li>
     </ul>
    </div>

    <ul class="button_list cf">
     <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
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
    'page_bg_image','page_use_overlay','page_overlay_color','page_overlay_opacity','page_title_font_size','page_title_font_size_mobile','page_sub_title_font_size','page_sub_title_font_size_mobile','page_font_color','page_sub_title'
  );
  foreach ($cf_keys as $cf_key) {
    $old = get_post_meta($post_id, $cf_key, true);

    if (isset($_POST[$cf_key])) {
      $new = $_POST[$cf_key];
    } else {
      $new = '';
    }

    if ($new && $new != $old) {
      update_post_meta($post_id, $cf_key, $new);
    } elseif ('' == $new && $old) {
      delete_post_meta($post_id, $cf_key, $old);
    }
  }

}
add_action('save_post', 'save_page_header_meta_box');



?>