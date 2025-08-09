<?php

function lp_meta_box() {
  $options = get_design_plus_option();
  add_meta_box(
    'lp_meta_box',//ID of meta box
    __('LP page', 'tcd-w'),//label
    'show_lp_meta_box',//callback function
    'page',// post type
    'normal',// context
    'high'// priority
  );
}
add_action('add_meta_boxes', 'lp_meta_box');

function show_lp_meta_box() {

  global $post;

  // ヘッダー -------------------------------------------------------
  $lp_header_title = get_post_meta($post->ID, 'lp_header_title', true);
  $lp_header_title_font_size = get_post_meta($post->ID, 'lp_header_title_font_size', true);
  if(empty($lp_header_title_font_size)){
    $lp_header_title_font_size = '38';
  }
  $lp_header_title_font_size_mobile = get_post_meta($post->ID, 'lp_header_title_font_size_mobile', true);
  if(empty($lp_header_title_font_size_mobile)){
    $lp_header_title_font_size_mobile = '20';
  }

  $lp_header_sub_title = get_post_meta($post->ID, 'lp_header_sub_title', true);
  $lp_header_sub_title_font_size = get_post_meta($post->ID, 'lp_header_sub_title_font_size', true);
  if(empty($lp_header_sub_title_font_size)){
    $lp_header_sub_title_font_size = '18';
  }
  $lp_header_sub_title_font_size_mobile = get_post_meta($post->ID, 'lp_header_sub_title_font_size_mobile', true);
  if(empty($lp_header_sub_title_font_size_mobile)){
    $lp_header_sub_title_font_size_mobile = '15';
  }
  $lp_header_font_color = get_post_meta($post->ID, 'lp_header_font_color', true);
  if(empty($lp_header_font_color)){
    $lp_header_font_color = '#ffffff';
  }
  $use_lp_header_overlay = get_post_meta($post->ID, 'use_lp_header_overlay', true);
  $lp_header_overlay_color = get_post_meta($post->ID, 'lp_header_overlay_color', true);
  if(empty($lp_header_overlay_color)){
    $lp_header_overlay_color = '#000000';
  }
  $lp_header_overlay_opacity = get_post_meta($post->ID, 'lp_header_overlay_opacity', true);
  if(empty($lp_header_overlay_opacity)){
    $lp_header_overlay_opacity = '0.3';
  }


  if(get_post_meta($post->ID, 'show_breadcrumb_link_flag', true)) {
    $show_breadcrumb_link = get_post_meta($post->ID, 'show_breadcrumb_link', true);
  } else {
    $show_breadcrumb_link = '1';
  }

  // コンテンツビルダー
  $lp_content = get_post_meta( $post->ID, 'lp_content', true );

  echo '<input type="hidden" name="lp_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

  //入力欄 ***************************************************************************************************************************************************************************************
?>

<div class="tcd_custom_field_wrap">

  <div class="theme_option_field cf theme_option_field_ac">
   <h3 class="theme_option_headline"><?php _e( 'Header', 'tcd-w' ); ?></h3>
   <div class="theme_option_field_ac_content">

    <h3 class="theme_option_headline2"><?php _e('Title', 'tcd-w'); ?></h3>
    <input class="full_width" type="text" name="lp_header_title" value="<?php echo esc_attr($lp_header_title); ?>" />
    <ul class="option_list">
     <li class="cf">
      <span class="label"><?php _e('Font size', 'tcd-w'); ?></span>
      <div class="font_size_option">
       <label class="font_size_label number_option">
        <input class="hankaku input_font_size" type="number" name="lp_header_title_font_size" value="<?php esc_attr_e( $lp_header_title_font_size ); ?>"><span class="icon icon_pc"></span>
       </label>
       <label class="font_size_label number_option">
        <input class="hankaku input_font_size_sp" type="number" name="lp_header_title_font_size_mobile" value="<?php esc_attr_e( $lp_header_title_font_size_mobile ); ?>"><span class="icon icon_sp"></span>
       </label>
      </div>
     </li>
     <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="lp_header_font_color" value="<?php echo esc_attr( $lp_header_font_color ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
    </ul>

    <h3 class="theme_option_headline2"><?php _e('Sub title', 'tcd-w'); ?></h3>
    <input class="full_width" type="text" name="lp_header_sub_title" value="<?php echo esc_attr($lp_header_sub_title); ?>" />
    <ul class="option_list">
     <li class="cf">
      <span class="label"><?php _e('Font size', 'tcd-w'); ?></span>
      <div class="font_size_option">
       <label class="font_size_label number_option">
        <input class="hankaku input_font_size" type="number" name="lp_header_sub_title_font_size" value="<?php esc_attr_e( $lp_header_sub_title_font_size ); ?>"><span class="icon icon_pc"></span>
       </label>
       <label class="font_size_label number_option">
        <input class="hankaku input_font_size_sp" type="number" name="lp_header_sub_title_font_size_mobile" value="<?php esc_attr_e( $lp_header_sub_title_font_size_mobile ); ?>"><span class="icon icon_sp"></span>
       </label>
      </div>
     </li>
    </ul>

    <h3 class="theme_option_headline2"><?php _e('Background image', 'tcd-w'); ?></h3>
    <ul class="option_list">
     <li class="cf">
      <span class="label">
       <?php _e('Background image', 'tcd-w'); ?>
       <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '1450', '430'); ?></span>
      </span>
      <?php mlcf_media_form('lp_header_image', __('Image', 'tcd-w') ); ?>
     </li>
    </ul>

    <h3 class="theme_option_headline2"><?php _e( 'Overlay', 'tcd-w' ); ?></h3>
    <p class="displayment_checkbox"><label><input name="use_lp_header_overlay" type="checkbox" value="1" <?php checked( $use_lp_header_overlay, 1 ); ?>><?php _e( 'Use overlay', 'tcd-w' ); ?></label></p>
    <div style="<?php if($use_lp_header_overlay == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
     <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
      <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-w'); ?></span><input type="text" name="lp_header_overlay_color" value="<?php echo esc_attr( $lp_header_overlay_color ); ?>" data-default-color="#000000" class="c-color-picker"></li>
      <li class="cf">
       <span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="lp_header_overlay_opacity" value="<?php echo esc_attr( $lp_header_overlay_opacity ); ?>" />
       <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
        <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
       </div>
      </li>
     </ul>
    </div>

    <h3 class="theme_option_headline2"><?php _e( 'Breadcrumb link', 'tcd-w' ); ?></h3>
    <p class="hidden"><input name="show_breadcrumb_link_flag" type="hidden" value="1"></p>
    <p><label><input name="show_breadcrumb_link" type="checkbox" value="1" <?php checked( $show_breadcrumb_link, 1 ); ?>><?php _e( 'Display breadcrumb link', 'tcd-w' ); ?></label></p>

    <ul class="button_list cf">
     <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
    </ul>
   </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->

 <div class="theme_option_message">
  <?php echo __( '<p>You can build contents freely with this function.</p><br /><p>STEP1: Click Add content button.<br />STEP2: Select content from dropdown menu.<br />STEP3: Input data and save the option.</p><br /><p>You can change order by dragging MOVE button and you can delete content by clicking DELETE button.</p>', 'tcd-w' ); ?>
 </div>


 <?php
      // コンテンツビルダーはここから -----------------------------------------------------------------
 ?>
 <div id="contents_builder_wrap">
  <div id="contents_builder">
   <p class="cb_message"><?php _e( 'Click Add content button to start content builder', 'tcd-w' ); ?></p>
<?php
if ( $lp_content && is_array( $lp_content ) ) :
	foreach( $lp_content as $key => $content ) :
		$cb_index = 'cb_' . $key . '_' . mt_rand( 0, 999999 );
?>
   <div class="cb_row">
    <ul class="cb_button cf">
     <li><span class="cb_move"><?php _e( 'Move', 'tcd-w' ); ?></span></li>
     <li><span class="cb_delete"><?php _e( 'Delete', 'tcd-w' ); ?></span></li>
    </ul>
    <div class="cb_column_area cf">
     <div class="cb_column">
      <input type="hidden" class="cb_index" value="<?php echo $cb_index; ?>">
<?php
		lp_content_select( $cb_index, $content['cb_content_select'] );
		if ( ! empty( $content['cb_content_select'] ) ) :
			lp_content_content_setting( $cb_index, $content['cb_content_select'], $content );
		endif;
?>
     </div><!-- END .cb_column -->
    </div><!-- END .cb_column_area -->
   </div><!-- END .cb_row -->
<?php
	endforeach;
endif;
?>
  </div><!-- END #contents_builder -->
  <ul class="button_list cf" id="cb_add_row_buttton_area">
   <li><input type="button" value="<?php _e( 'Add content', 'tcd-w' ); ?>" class="button-ml add_row"></li>
  </ul>
 </div><!-- END #contents_builder_wrap -->

 <?php // コンテンツビルダー追加用 非表示 ?>
 <div id="contents_builder-clone" class="hidden">
  <div class="cb_row">
   <ul class="cb_button cf">
    <li><span class="cb_move"><?php _e( 'Move', 'tcd-w' ); ?></span></li>
    <li><span class="cb_delete"><?php _e( 'Delete', 'tcd-w' ); ?></span></li>
   </ul>
   <div class="cb_column_area cf">
    <div class="cb_column">
     <input type="hidden" class="cb_index" value="cb_cloneindex">
       <?php lp_content_select( 'cb_cloneindex' ); ?>
    </div><!-- END .cb_column -->
   </div><!-- END .cb_column_area -->
  </div><!-- END .cb_row -->
<?php
foreach ( lp_get_contents() as $key => $value ) :
	lp_content_content_setting( 'cb_cloneindex', $key );
endforeach;
?>
 </div><!-- END #contents_builder-clone.hidden -->

</div><!-- END .tcd_custom_field_wrap -->
<?php
}

function save_lp_meta_box( $post_id ) {

  // verify nonce
  if (!isset($_POST['lp_meta_box_nonce']) || !wp_verify_nonce($_POST['lp_meta_box_nonce'], basename(__FILE__))) {
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
    'lp_header_title','lp_header_title_font_size','lp_header_title_font_size_mobile','lp_header_sub_title','lp_header_sub_title_font_size','lp_header_sub_title_font_size_mobile','lp_header_font_color','lp_header_image','lp_header_overlay_color','use_lp_header_overlay','lp_header_overlay_opacity','show_breadcrumb_link','show_breadcrumb_link_flag'
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

	// コンテンツビルダー 整形保存
	if ( ! empty( $_POST['lp_content'] ) && is_array( $_POST['lp_content'] ) ) {
		$cb_contents = lp_get_contents();
		$cb_data = array();

		foreach ( $_POST['lp_content'] as $key => $value ) {
			// クローン用はスルー
			if ( 'cb_cloneindex' === $key ) continue;

			// コンテンツデフォルト値に入力値をマージ
			if ( ! empty( $value['cb_content_select'] ) && isset( $cb_contents[$value['cb_content_select']]['default'] ) ) {
				$value = array_merge( (array) $cb_contents[$value['cb_content_select']]['default'], $value );
			}

			// コンテンツ１
			if ( 'content1' === $value['cb_content_select'] ) {

				$value['show_content'] = ! empty( $value['show_content'] ) ? 1 : 0;

				$value['headline'] = sanitize_text_field( $value['headline'] );
				$value['headline_font_size'] = absint( $value['headline_font_size'] );
				$value['headline_font_size_mobile'] = absint( $value['headline_font_size_mobile'] );
				$value['headline_font_color'] = sanitize_hex_color( $value['headline_font_color'] );

				$value['sub_headline'] = sanitize_text_field( $value['sub_headline'] );
				$value['sub_headline_font_size'] = absint( $value['sub_headline_font_size'] );
				$value['sub_headline_font_size_mobile'] = absint( $value['sub_headline_font_size_mobile'] );

				$value['catch'] = $value['catch'];
				$value['catch_font_size'] = absint( $value['catch_font_size'] );
				$value['catch_font_size_mobile'] = absint( $value['catch_font_size_mobile'] );
				$value['catch_font_color'] = sanitize_hex_color( $value['catch_font_color'] );

				$value['desc'] = $value['desc'];
				$value['desc_font_size'] = absint( $value['desc_font_size'] );
				$value['desc_font_size_mobile'] = absint( $value['desc_font_size_mobile'] );

				$value['image1'] = sanitize_text_field( $value['image1'] );
				$value['image2'] = sanitize_text_field( $value['image2'] );
				$value['image3'] = sanitize_text_field( $value['image3'] );
				$value['image4'] = sanitize_text_field( $value['image4'] );

				$value['image5'] = sanitize_text_field( $value['image5'] );
				$value['image6'] = sanitize_text_field( $value['image6'] );
				$value['image7'] = sanitize_text_field( $value['image7'] );
				$value['image8'] = sanitize_text_field( $value['image8'] );

			// コンテンツ２
			} elseif ( 'content2' === $value['cb_content_select'] ) {

				$value['show_content'] = ! empty( $value['show_content'] ) ? 1 : 0;

				$value['headline'] = sanitize_text_field( $value['headline'] );
				$value['headline_font_size'] = absint( $value['headline_font_size'] );
				$value['headline_font_size_mobile'] = absint( $value['headline_font_size_mobile'] );
				$value['headline_font_color'] = sanitize_hex_color( $value['headline_font_color'] );

				$value['sub_headline'] = sanitize_text_field( $value['sub_headline'] );
				$value['sub_headline_font_size'] = absint( $value['sub_headline_font_size'] );
				$value['sub_headline_font_size_mobile'] = absint( $value['sub_headline_font_size_mobile'] );

				$value['catch'] = sanitize_textarea_field($value['catch']);
				$value['catch_font_size'] = absint( $value['catch_font_size'] );
				$value['catch_font_size_mobile'] = absint( $value['catch_font_size_mobile'] );
				$value['catch_font_color'] = sanitize_hex_color( $value['catch_font_color'] );

				$value['desc'] = $value['desc'];
				$value['desc_font_size'] = absint( $value['desc_font_size'] );
				$value['desc_font_size_mobile'] = absint( $value['desc_font_size_mobile'] );

				$value['image1'] = sanitize_text_field( $value['image1'] );
				$value['image2'] = sanitize_text_field( $value['image2'] );
				$value['image3'] = sanitize_text_field( $value['image3'] );

				//アクセス情報
				$value['gmap_api_key'] = sanitize_text_field( $value['gmap_api_key'] );
				$value['gmap_marker_type'] = sanitize_text_field( $value['gmap_marker_type'] );
				$value['gmap_custom_marker_type'] = sanitize_text_field( $value['gmap_custom_marker_type'] );
				$value['gmap_marker_text'] = sanitize_text_field( $value['gmap_marker_text'] );
				$value['gmap_marker_color'] = sanitize_hex_color( $value['gmap_marker_color'] );
				$value['gmap_marker_img'] = sanitize_text_field( $value['gmap_marker_img'] );
				$value['gmap_marker_bg'] = sanitize_hex_color( $value['gmap_marker_bg'] );

				$value['access_address'] = sanitize_text_field( $value['access_address'] );
				$value['access_logo_retina'] = ! empty( $value['access_logo_retina'] ) ? 1 : 0;
				$value['access_logo_image'] = sanitize_text_field( $value['access_logo_image'] );
				$value['access_logo_retina_mobile'] = ! empty( $value['access_logo_retina_mobile'] ) ? 1 : 0;
				$value['access_logo_image_mobile'] = sanitize_text_field( $value['access_logo_image_mobile'] );
				$value['access_desc1'] = sanitize_textarea_field($value['access_desc1']);
				$value['access_saturation'] = sanitize_text_field( $value['access_saturation'] );

				$value['show_access_button'] = ! empty( $value['show_access_button'] ) ? 1 : 0;
				$value['access_button_label'] = sanitize_text_field( $value['access_button_label'] );
				$value['access_button_url'] = sanitize_text_field( $value['access_button_url'] );
				$value['access_button_font_color'] = sanitize_hex_color( $value['access_button_font_color'] );
				$value['access_button_bg_color'] = sanitize_hex_color( $value['access_button_bg_color'] );
				$value['access_button_border_color'] = sanitize_hex_color( $value['access_button_border_color'] );
				$value['access_button_font_color_hover'] = sanitize_hex_color( $value['access_button_font_color_hover'] );
				$value['access_button_bg_color_hover'] = sanitize_hex_color( $value['access_button_bg_color_hover'] );
				$value['access_button_border_color_hover'] = sanitize_hex_color( $value['access_button_border_color_hover'] );

				$value['access_date_headline'] = sanitize_text_field( $value['access_date_headline'] );
				$value['access_date_headline_color'] = sanitize_hex_color( $value['access_date_headline_color'] );
				$value['access_date'] = sanitize_textarea_field($value['access_date']);

				$value['access_tel_headline'] = sanitize_text_field( $value['access_tel_headline'] );
				$value['access_tel_color'] = sanitize_hex_color( $value['access_tel_color'] );
				$value['access_tel'] = sanitize_text_field( $value['access_tel'] );


			// コンテンツ３
			} elseif ( 'content3' === $value['cb_content_select'] ) {

				$value['show_content'] = ! empty( $value['show_content'] ) ? 1 : 0;

				$value['catch'] = sanitize_textarea_field($value['catch']);
				$value['catch_font_size'] = absint( $value['catch_font_size'] );
				$value['catch_font_size_mobile'] = absint( $value['catch_font_size_mobile'] );
				$value['catch_font_color'] = sanitize_hex_color( $value['catch_font_color'] );

				$value['desc'] = $value['desc'];
				$value['desc_font_size'] = absint( $value['desc_font_size'] );
				$value['desc_font_size_mobile'] = absint( $value['desc_font_size_mobile'] );

			}

			$cb_data[] = $value;
		}

		if ( $cb_data ) {
			update_post_meta( $post_id, 'lp_content', $cb_data );
		} else {
			delete_post_meta( $post_id, 'lp_content' );
		}
	}
}
add_action('save_post', 'save_lp_meta_box');


/**
 * コンテンツビルダー コンテンツ一覧取得
 */
function lp_get_contents() {
	return array(
    // コンテンツ１
		'content1' => array(
			'name' => 'content1',
			'label' => __( 'Text and Image list', 'tcd-w' ),
			'default' => array(
				'show_content' => 1,
				'headline' => '',
				'headline_font_size' => 40,
				'headline_font_size_mobile' => 24,
				'headline_font_color' => '#58330d',
				'sub_headline' => '',
				'sub_headline_font_size' => 18,
				'sub_headline_font_size_mobile' => 12,
				'catch' => '',
				'catch_font_size' => 38,
				'catch_font_size_mobile' => 20,
				'catch_font_color' => '#58330d',
				'desc' => '',
				'desc_font_size' => 16,
				'desc_font_size_mobile' => 14,
				'image1' => false,
				'image2' => false,
				'image3' => false,
				'image4' => false,
				'image5' => false,
				'image6' => false,
				'image7' => false,
				'image8' => false,
			)
		),
    // コンテンツ２
		'content2' => array(
			'name' => 'content2',
			'label' => __( 'Access information', 'tcd-w' ),
			'default' => array(
				'show_content' => 1,
				'headline' => '',
				'headline_font_size' => 40,
				'headline_font_size_mobile' => 24,
				'headline_font_color' => '#58330d',
				'sub_headline' => '',
				'sub_headline_font_size' => 18,
				'sub_headline_font_size_mobile' => 12,
				'catch' => '',
				'catch_font_size' => 38,
				'catch_font_size_mobile' => 20,
				'catch_font_color' => '#58330d',
				'desc' => '',
				'desc_font_size' => 16,
				'desc_font_size_mobile' => 14,
				'image1' => false,
				'image2' => false,
				'image3' => false,

				'gmap_api_key' => '',
				'gmap_marker_type' => 'type1',
				'gmap_custom_marker_type' => 'type1',
				'gmap_marker_text' => '',
				'gmap_marker_color' => '#ffffff',
				'gmap_marker_img' => false,
				'gmap_marker_bg' => '#000000',

				'access_address' => '',
				'access_logo_retina' => '',
				'access_logo_image' => false,
				'access_logo_retina_mobile' => '',
				'access_logo_image_mobile' => false,
				'access_desc1' => '',
				'access_saturation' => '-100',
				'show_access_button' => '',
				'access_button_label' => __( 'Display on large map', 'tcd-w' ),
				'access_button_url' => '',
				'access_button_font_color' => '#5b3401',
				'access_button_bg_color' => '#ffffff',
				'access_button_border_color' => '#5b3401',
				'access_button_font_color_hover' => '#ffffff',
				'access_button_bg_color_hover' => '#5b3401',
				'access_button_border_color_hover' => '#5b3401',
				'access_date_headline' => '',
				'access_date_headline_color' => '#593300',
				'access_date' => '',
				'access_tel_headline' => '',
				'access_tel_color' => '#593300',
				'access_tel' => '',
			)
		),
    // コンテンツ３
		'content3' => array(
			'name' => 'content3',
			'label' => __( 'Free space', 'tcd-w' ),
			'default' => array(
				'show_content' => 1,
				'catch' => '',
				'catch_font_size' => 38,
				'catch_font_size_mobile' => 20,
				'catch_font_color' => '#58330d',
				'desc' => '',
				'desc_font_size' => 16,
				'desc_font_size_mobile' => 14,
			)
		)
	);
}

/**
 * コンテンツビルダー用 コンテンツ選択プルダウン
 */
function lp_content_select( $cb_index = 'cb_cloneindex', $selected = null ) {
	$cb_contents = lp_get_contents();

	if ( $selected && isset( $cb_contents[$selected] ) ) {
		$add_class = ' hidden';
	} else {
		$add_class = '';
	}

	$out = '<select name="lp_content[' . esc_attr( $cb_index ) . '][cb_content_select]" class="cb_content_select' . $add_class . '">';
	$out .= '<option value="">' . __( 'Choose the content', 'tcd-w' ) . '</option>';

	foreach ( $cb_contents as $key => $value ) {
		$out .= '<option value="' . esc_attr( $key ) . '"' . selected( $key, $selected, false ) . '>' . esc_html( $value['label'] ) . '</option>';
	}

	$out .= '</select>';

	echo $out;
}

/**
 * コンテンツビルダー用 コンテンツ設定
 */
function lp_content_content_setting( $cb_index = 'cb_cloneindex', $cb_content_select = null, $value = array() ) {

  global $font_type_options, $free_space_options, $gmap_marker_type_options, $gmap_custom_marker_type_options;

	$cb_contents = lp_get_contents();

	// 不明なコンテンツの場合は終了
	if ( ! $cb_content_select || ! isset( $cb_contents[$cb_content_select] ) ) return false;

	// コンテンツデフォルト値に入力値をマージ
	if ( isset( $cb_contents[$cb_content_select]['default'] ) ) {
		$value = array_merge( (array) $cb_contents[$cb_content_select]['default'], $value );
	}
?>
  <div class="cb_content_wrap cf <?php echo esc_attr( $cb_content_select ); ?>">

  <?php
      // コンテンツ１ -------------------------------------------------------------------------
      if ( 'content1' === $cb_content_select ) :
  ?>
  <h3 class="cb_content_headline"><?php echo esc_html( $cb_contents[$cb_content_select]['label'] ); ?><span><?php if(!empty($value['headline'])){?>：<?php echo esc_textarea( strip_tags( $value['headline']) ); ?><?php } ?></span></h3>
  <div class="cb_content">

   <p class="hidden"><input name="lp_content[<?php echo $cb_index; ?>][show_content]" type="hidden" value="0"></p>
   <p><label><input name="lp_content[<?php echo $cb_index; ?>][show_content]" type="checkbox" value="1" <?php checked( $value['show_content'], 1 ); ?>><?php printf(__('Display %s', 'tcd-w'), $cb_contents[$cb_content_select]['label']); ?></label></p>

   <h4 class="theme_option_headline2"><?php _e('Headline', 'tcd-w');  ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Headline', 'tcd-w');  ?></span><input class="full_width" type="text" name="lp_content[<?php echo $cb_index; ?>][headline]" value="<?php echo esc_attr($value['headline']); ?>" /></li>
    <li class="cf">
     <span class="label"><?php _e('Font size of headline', 'tcd-w'); ?></span>
     <div class="font_size_option">
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="lp_content[<?php echo $cb_index; ?>][headline_font_size]" value="<?php echo esc_attr( $value['headline_font_size'] ); ?>" />
       <span class="icon icon_pc"></span>
      </label>
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="lp_content[<?php echo $cb_index; ?>][headline_font_size_mobile]" value="<?php echo esc_attr( $value['headline_font_size_mobile'] ); ?>" />
       <span class="icon icon_sp"></span>
      </label>
     </div>
    </li>
    <li class="cf"><span class="label"><?php _e('Sub heading', 'tcd-w');  ?></span><input class="full_width" type="text" name="lp_content[<?php echo $cb_index; ?>][sub_headline]" value="<?php echo esc_attr($value['sub_headline']); ?>" /></li>
    <li class="cf">
     <span class="label"><?php _e('Font size of sub heading', 'tcd-w'); ?></span>
     <div class="font_size_option">
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="lp_content[<?php echo $cb_index; ?>][sub_headline_font_size]" value="<?php echo esc_attr( $value['sub_headline_font_size'] ); ?>" />
       <span class="icon icon_pc"></span>
      </label>
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="lp_content[<?php echo $cb_index; ?>][sub_headline_font_size_mobile]" value="<?php echo esc_attr( $value['sub_headline_font_size_mobile'] ); ?>" />
       <span class="icon icon_sp"></span>
      </label>
     </div>
    </li>
    <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="lp_content[<?php echo $cb_index; ?>][headline_font_color]" value="<?php echo esc_attr( $value['headline_font_color'] ); ?>" data-default-color="#58330d" class="c-color-picker"></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Catchphrase', 'tcd-w');  ?></h4>
   <textarea class="large-text" cols="50" rows="2" name="lp_content[<?php echo $cb_index; ?>][catch]"><?php echo esc_textarea($value['catch']); ?></textarea>
   <ul class="option_list">
    <li class="cf">
     <span class="label"><?php _e('Font size', 'tcd-w'); ?></span>
     <div class="font_size_option">
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="lp_content[<?php echo $cb_index; ?>][catch_font_size]" value="<?php echo esc_attr( $value['catch_font_size'] ); ?>" />
       <span class="icon icon_pc"></span>
      </label>
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="lp_content[<?php echo $cb_index; ?>][catch_font_size_mobile]" value="<?php echo esc_attr( $value['catch_font_size_mobile'] ); ?>" />
       <span class="icon icon_sp"></span>
      </label>
     </div>
    </li>
    <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="lp_content[<?php echo $cb_index; ?>][catch_font_color]" value="<?php echo esc_attr( $value['catch_font_color'] ); ?>" data-default-color="#58330d" class="c-color-picker"></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Description', 'tcd-w');  ?></h4>
   <?php wp_editor( $value['desc'], 'cb_wysiwyg_editor-' . $cb_index, array ('textarea_name' => 'lp_content[' . $cb_index . '][desc]')); ?>
   <ul class="option_list">
    <li class="cf">
     <span class="label"><?php _e('Font size', 'tcd-w'); ?></span>
     <div class="font_size_option">
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="lp_content[<?php echo $cb_index; ?>][desc_font_size]" value="<?php echo esc_attr( $value['desc_font_size'] ); ?>" />
       <span class="icon icon_pc"></span>
      </label>
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="lp_content[<?php echo $cb_index; ?>][desc_font_size_mobile]" value="<?php echo esc_attr( $value['desc_font_size_mobile'] ); ?>" />
       <span class="icon icon_sp"></span>
      </label>
     </div>
    </li>
   </ul>

   <h3 class="theme_option_headline2"><?php _e('Image (Above catchphrase - first row)', 'tcd-w'); ?></h3>
   <div class="theme_option_message2">
    <p><?php printf(__('Recommend image size for two image. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '500', '300'); ?><br>
    <?php printf(__('Recommend image size for one image. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '1000', '300'); ?></p>
   </div>
   <div class="image_list">
    <div class="list_item">
     <h4 class="theme_option_headline4"><span><?php _e('Image', 'tcd-w'); ?>1</span></h4>
     <div class="image_box cf">
      <div class="cf cf_media_field hide-if-no-js">
       <input type="hidden" class="cf_media_id" name="lp_content[<?php echo $cb_index; ?>][image1]" id="image1-<?php echo $cb_index; ?>" value="<?php echo esc_attr( $value['image1'] ); ?>">
       <div class="preview_field"><?php if ( $value['image1'] ) echo wp_get_attachment_image( $value['image1'], 'medium' ); ?></div>
       <div class="buttton_area">
        <input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>">
        <input type="button" class="cfmf-delete-img button<?php if ( ! $value['image1'] ) echo ' hidden'; ?>" value="<?php _e( 'Remove Image', 'tcd-w'); ?>">
       </div>
      </div>
     </div>
    </div>
    <div class="list_item">
     <h4 class="theme_option_headline4"><span><?php _e('Image', 'tcd-w'); ?>2</span></h4>
     <div class="image_box cf">
      <div class="cf cf_media_field hide-if-no-js">
       <input type="hidden" class="cf_media_id" name="lp_content[<?php echo $cb_index; ?>][image2]" id="image2-<?php echo $cb_index; ?>" value="<?php echo esc_attr( $value['image2'] ); ?>">
       <div class="preview_field"><?php if ( $value['image2'] ) echo wp_get_attachment_image( $value['image2'], 'medium' ); ?></div>
       <div class="buttton_area">
        <input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>">
        <input type="button" class="cfmf-delete-img button<?php if ( ! $value['image2'] ) echo ' hidden'; ?>" value="<?php _e( 'Remove Image', 'tcd-w'); ?>">
       </div>
      </div>
     </div>
    </div>
   </div>

   <h3 class="theme_option_headline2"><?php _e('Image (Above catchphrase - second row)', 'tcd-w'); ?></h3>
   <div class="theme_option_message2">
    <p><?php printf(__('Recommend image size for two image. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '500', '300'); ?><br>
    <?php printf(__('Recommend image size for one image. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '1000', '300'); ?></p>
   </div>
   <div class="image_list">
    <div class="list_item">
     <h4 class="theme_option_headline4"><span><?php _e('Image', 'tcd-w'); ?>1</span></h4>
     <div class="image_box cf">
      <div class="cf cf_media_field hide-if-no-js">
       <input type="hidden" class="cf_media_id" name="lp_content[<?php echo $cb_index; ?>][image3]" id="image3-<?php echo $cb_index; ?>" value="<?php echo esc_attr( $value['image3'] ); ?>">
       <div class="preview_field"><?php if ( $value['image3'] ) echo wp_get_attachment_image( $value['image3'], 'medium' ); ?></div>
       <div class="buttton_area">
        <input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>">
        <input type="button" class="cfmf-delete-img button<?php if ( ! $value['image3'] ) echo ' hidden'; ?>" value="<?php _e( 'Remove Image', 'tcd-w'); ?>">
       </div>
      </div>
     </div>
    </div>
    <div class="list_item">
     <h4 class="theme_option_headline4"><span><?php _e('Image', 'tcd-w'); ?>2</span></h4>
     <div class="image_box cf">
      <div class="cf cf_media_field hide-if-no-js">
       <input type="hidden" class="cf_media_id" name="lp_content[<?php echo $cb_index; ?>][image4]" id="image4-<?php echo $cb_index; ?>" value="<?php echo esc_attr( $value['image4'] ); ?>">
       <div class="preview_field"><?php if ( $value['image4'] ) echo wp_get_attachment_image( $value['image4'], 'medium' ); ?></div>
       <div class="buttton_area">
        <input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>">
        <input type="button" class="cfmf-delete-img button<?php if ( ! $value['image4'] ) echo ' hidden'; ?>" value="<?php _e( 'Remove Image', 'tcd-w'); ?>">
       </div>
      </div>
     </div>
    </div>
   </div>

   <h3 class="theme_option_headline2"><?php _e('Image (Under description - first row)', 'tcd-w'); ?></h3>
   <div class="theme_option_message2">
    <p><?php printf(__('Recommend image size for two image. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '500', '300'); ?><br>
    <?php printf(__('Recommend image size for one image. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '1000', '300'); ?></p>
   </div>
   <div class="image_list">
    <div class="list_item">
     <h4 class="theme_option_headline4"><span><?php _e('Image', 'tcd-w'); ?>1</span></h4>
     <div class="image_box cf">
      <div class="cf cf_media_field hide-if-no-js">
       <input type="hidden" class="cf_media_id" name="lp_content[<?php echo $cb_index; ?>][image5]" id="image5-<?php echo $cb_index; ?>" value="<?php echo esc_attr( $value['image5'] ); ?>">
       <div class="preview_field"><?php if ( $value['image5'] ) echo wp_get_attachment_image( $value['image5'], 'medium' ); ?></div>
       <div class="buttton_area">
        <input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>">
        <input type="button" class="cfmf-delete-img button<?php if ( ! $value['image5'] ) echo ' hidden'; ?>" value="<?php _e( 'Remove Image', 'tcd-w'); ?>">
       </div>
      </div>
     </div>
    </div>
    <div class="list_item">
     <h4 class="theme_option_headline4"><span><?php _e('Image', 'tcd-w'); ?>2</span></h4>
     <div class="image_box cf">
      <div class="cf cf_media_field hide-if-no-js">
       <input type="hidden" class="cf_media_id" name="lp_content[<?php echo $cb_index; ?>][image6]" id="image6-<?php echo $cb_index; ?>" value="<?php echo esc_attr( $value['image6'] ); ?>">
       <div class="preview_field"><?php if ( $value['image6'] ) echo wp_get_attachment_image( $value['image6'], 'medium' ); ?></div>
       <div class="buttton_area">
        <input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>">
        <input type="button" class="cfmf-delete-img button<?php if ( ! $value['image6'] ) echo ' hidden'; ?>" value="<?php _e( 'Remove Image', 'tcd-w'); ?>">
       </div>
      </div>
     </div>
    </div>
   </div>

   <h3 class="theme_option_headline2"><?php _e('Image (Under description - second row)', 'tcd-w'); ?></h3>
   <div class="theme_option_message2">
    <p><?php printf(__('Recommend image size for two image. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '500', '300'); ?><br>
    <?php printf(__('Recommend image size for one image. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '1000', '300'); ?></p>
   </div>
   <div class="image_list">
    <div class="list_item">
     <h4 class="theme_option_headline4"><span><?php _e('Image', 'tcd-w'); ?>1</span></h4>
     <div class="image_box cf">
      <div class="cf cf_media_field hide-if-no-js">
       <input type="hidden" class="cf_media_id" name="lp_content[<?php echo $cb_index; ?>][image7]" id="image7-<?php echo $cb_index; ?>" value="<?php echo esc_attr( $value['image7'] ); ?>">
       <div class="preview_field"><?php if ( $value['image7'] ) echo wp_get_attachment_image( $value['image7'], 'medium' ); ?></div>
       <div class="buttton_area">
        <input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>">
        <input type="button" class="cfmf-delete-img button<?php if ( ! $value['image7'] ) echo ' hidden'; ?>" value="<?php _e( 'Remove Image', 'tcd-w'); ?>">
       </div>
      </div>
     </div>
    </div>
    <div class="list_item">
     <h4 class="theme_option_headline4"><span><?php _e('Image', 'tcd-w'); ?>2</span></h4>
     <div class="image_box cf">
      <div class="cf cf_media_field hide-if-no-js">
       <input type="hidden" class="cf_media_id" name="lp_content[<?php echo $cb_index; ?>][image8]" id="image8-<?php echo $cb_index; ?>" value="<?php echo esc_attr( $value['image8'] ); ?>">
       <div class="preview_field"><?php if ( $value['image8'] ) echo wp_get_attachment_image( $value['image8'], 'medium' ); ?></div>
       <div class="buttton_area">
        <input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>">
        <input type="button" class="cfmf-delete-img button<?php if ( ! $value['image8'] ) echo ' hidden'; ?>" value="<?php _e( 'Remove Image', 'tcd-w'); ?>">
       </div>
      </div>
     </div>
    </div>
   </div>

   <ul class="button_list cf">
    <li><a href="#" class="button-ml close-content"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
   </ul>
  </div><!-- END .cb_content -->

  <?php
       // コンテンツ２ -------------------------------------------------------------------------
       elseif ( 'content2' === $cb_content_select ) :

  ?>
  <h3 class="cb_content_headline"><?php echo esc_html( $cb_contents[$cb_content_select]['label'] ); ?><span><?php if(!empty($value['headline'])){?>：<?php echo esc_textarea( strip_tags( $value['headline']) ); ?><?php } ?></span></h3>
  <div class="cb_content">

   <p class="hidden"><input name="lp_content[<?php echo $cb_index; ?>][show_content]" type="hidden" value="0"></p>
   <p><label><input name="lp_content[<?php echo $cb_index; ?>][show_content]" type="checkbox" value="1" <?php checked( $value['show_content'], 1 ); ?>><?php printf(__('Display %s', 'tcd-w'), $cb_contents[$cb_content_select]['label']); ?></label></p>

   <h4 class="theme_option_headline2"><?php _e('Headline', 'tcd-w');  ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Headline', 'tcd-w');  ?></span><input class="full_width" type="text" name="lp_content[<?php echo $cb_index; ?>][headline]" value="<?php echo esc_attr($value['headline']); ?>" /></li>
    <li class="cf">
     <span class="label"><?php _e('Font size of headline', 'tcd-w'); ?></span>
     <div class="font_size_option">
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="lp_content[<?php echo $cb_index; ?>][headline_font_size]" value="<?php echo esc_attr( $value['headline_font_size'] ); ?>" />
       <span class="icon icon_pc"></span>
      </label>
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="lp_content[<?php echo $cb_index; ?>][headline_font_size_mobile]" value="<?php echo esc_attr( $value['headline_font_size_mobile'] ); ?>" />
       <span class="icon icon_sp"></span>
      </label>
     </div>
    </li>
    <li class="cf"><span class="label"><?php _e('Sub heading', 'tcd-w');  ?></span><input class="full_width" type="text" name="lp_content[<?php echo $cb_index; ?>][sub_headline]" value="<?php echo esc_attr($value['sub_headline']); ?>" /></li>
    <li class="cf">
     <span class="label"><?php _e('Font size of sub heading', 'tcd-w'); ?></span>
     <div class="font_size_option">
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="lp_content[<?php echo $cb_index; ?>][sub_headline_font_size]" value="<?php echo esc_attr( $value['sub_headline_font_size'] ); ?>" />
       <span class="icon icon_pc"></span>
      </label>
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="lp_content[<?php echo $cb_index; ?>][sub_headline_font_size_mobile]" value="<?php echo esc_attr( $value['sub_headline_font_size_mobile'] ); ?>" />
       <span class="icon icon_sp"></span>
      </label>
     </div>
    </li>
    <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="lp_content[<?php echo $cb_index; ?>][headline_font_color]" value="<?php echo esc_attr( $value['headline_font_color'] ); ?>" data-default-color="#58330d" class="c-color-picker"></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Catchphrase', 'tcd-w');  ?></h4>
   <textarea class="large-text" cols="50" rows="2" name="lp_content[<?php echo $cb_index; ?>][catch]"><?php echo esc_textarea($value['catch']); ?></textarea>
   <ul class="option_list">
    <li class="cf">
     <span class="label"><?php _e('Font size', 'tcd-w'); ?></span>
     <div class="font_size_option">
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="lp_content[<?php echo $cb_index; ?>][catch_font_size]" value="<?php echo esc_attr( $value['catch_font_size'] ); ?>" />
       <span class="icon icon_pc"></span>
      </label>
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="lp_content[<?php echo $cb_index; ?>][catch_font_size_mobile]" value="<?php echo esc_attr( $value['catch_font_size_mobile'] ); ?>" />
       <span class="icon icon_sp"></span>
      </label>
     </div>
    </li>
    <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="lp_content[<?php echo $cb_index; ?>][catch_font_color]" value="<?php echo esc_attr( $value['catch_font_color'] ); ?>" data-default-color="#58330d" class="c-color-picker"></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Description', 'tcd-w');  ?></h4>
   <?php wp_editor( $value['desc'], 'cb_wysiwyg_editor-' . $cb_index, array ('textarea_name' => 'lp_content[' . $cb_index . '][desc]')); ?>
   <ul class="option_list">
    <li class="cf">
     <span class="label"><?php _e('Font size', 'tcd-w'); ?></span>
     <div class="font_size_option">
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="lp_content[<?php echo $cb_index; ?>][desc_font_size]" value="<?php echo esc_attr( $value['desc_font_size'] ); ?>" />
       <span class="icon icon_pc"></span>
      </label>
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="lp_content[<?php echo $cb_index; ?>][desc_font_size_mobile]" value="<?php echo esc_attr( $value['desc_font_size_mobile'] ); ?>" />
       <span class="icon icon_sp"></span>
      </label>
     </div>
    </li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e( 'Google Maps', 'tcd-w' );  ?></h4>
   <div class="theme_option_message2">
    <p><?php _e('You can set styles of marker in Google maps, and select default marker or custom marker.', 'tcd-w');  ?></p>
   </div>

   <h4 class="theme_option_headline2"><?php _e('API key', 'tcd-w'); ?></h4>
   <input class="full_width" type="text" name="lp_content[<?php echo $cb_index; ?>][gmap_api_key]" value="<?php echo esc_attr($value['gmap_api_key']); ?>" />

   <h4 class="theme_option_headline2"><?php _e( 'Marker type', 'tcd-w' ); ?></h4>
   <ul class="design_radio_button image_radio_button cf">
    <?php foreach ( $gmap_marker_type_options as $option ) : ?>
    <li class="gmap_marker_type_button_<?php echo esc_attr( $option['value'] ); ?>">
     <input type="radio" id="gmap_marker_type_button_<?php echo esc_attr( $option['value'] ); ?>_<?php echo $cb_index; ?>" name="lp_content[<?php echo $cb_index; ?>][gmap_marker_type]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $value['gmap_marker_type'] ); ?>>
     <label for="gmap_marker_type_button_<?php echo esc_attr( $option['value'] ); ?>_<?php echo $cb_index; ?>">
      <span><?php echo esc_html( $option['label'] ); ?></span>
      <img src="<?php bloginfo('template_url'); ?>/admin/img/<?php echo esc_attr($option['img']); ?>" alt="" title="" />
     </label>
    </li>
    <?php endforeach; ?>
   </ul>

   <div class="gmap_marker_type2_area" style="<?php if($value['gmap_marker_type'] == 'type1'){ echo 'display:none;'; } else { echo 'display:block;'; }; ?>">

    <h4 class="theme_option_headline2"><?php _e( 'Custom marker type', 'tcd-w' ); ?></h4>
    <ul class="design_radio_button horizontal cf">
     <?php foreach ( $gmap_custom_marker_type_options as $option ) : ?>
     <li class="gmap_custom_marker_type_button_<?php echo esc_attr( $option['value'] ); ?>">
      <input type="radio" id="gmap_custom_marker_type_button_<?php echo esc_attr( $option['value'] ); ?>_<?php echo $cb_index; ?>" name="lp_content[<?php echo $cb_index; ?>][gmap_custom_marker_type]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $value['gmap_custom_marker_type'] ); ?>>
      <label for="gmap_custom_marker_type_button_<?php echo esc_attr( $option['value'] ); ?>_<?php echo $cb_index; ?>"><?php echo esc_html_e( $option['label'] ); ?></label>
     </li>
     <?php endforeach; ?>
    </ul>

    <div class="gmap_custom_marker_type1_area" style="<?php if ( $value['gmap_custom_marker_type'] == 'type1') { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
     <h4 class="theme_option_headline2"><?php _e( 'Custom marker text', 'tcd-w' ); ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Text', 'tcd-w'); ?></span><input class="full_width" type="text" name="lp_content[<?php echo $cb_index; ?>][gmap_marker_text]" value="<?php echo esc_attr( $value['gmap_marker_text'] ); ?>"></li>
      <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" class="c-color-picker" name="lp_content[<?php echo $cb_index; ?>][gmap_marker_color]" value="<?php echo esc_attr( $value['gmap_marker_color'] ); ?>" data-default-color="#ffffff"></li>
     </ul>
    </div>

    <div class="gmap_custom_marker_type2_area" style="<?php if ( $value['gmap_custom_marker_type'] == 'type1') { echo 'display:none;'; } else { echo 'display:block;'; }; ?>">
     <h4 class="theme_option_headline2"><?php _e( 'Custom marker image', 'tcd-w' ); ?></h4>
     <ul class="option_list">
      <li class="cf">
       <span class="label">
        <?php _e('Image', 'tcd-w'); ?>
        <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '60', '20'); ?></span>
       </span>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js">
         <input type="hidden" value="<?php echo esc_attr( $value['gmap_marker_img'] ); ?>" id="gmap_marker_img-<?php echo $cb_index; ?>" name="lp_content[<?php echo $cb_index; ?>][gmap_marker_img]" class="cf_media_id">
         <div class="preview_field"><?php if ( $value['gmap_marker_img'] ) { echo wp_get_attachment_image($value['gmap_marker_img'], 'medium' ); } ?></div>
         <div class="button_area">
          <input type="button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e( 'Remove Image', 'tcd-w' ); ?>" class="cfmf-delete-img button <?php if ( ! $value['gmap_marker_img'] ) { echo 'hidden'; } ?>">
         </div>
        </div>
       </div>
      </li>
     </ul>
    </div>

    <h4 class="theme_option_headline2"><?php _e( 'Background color of marker', 'tcd-w' ); ?></h4>
    <p><input type="text" class="c-color-picker" name="lp_content[<?php echo $cb_index; ?>][gmap_marker_bg]" data-default-color="#000000" value="<?php echo esc_attr( $value['gmap_marker_bg'] ); ?>"></p>

   </div>

   <h4 class="theme_option_headline2"><?php _e('Address of location', 'tcd-w'); ?></h4>
   <input class="full_width" type="text" name="lp_content[<?php echo $cb_index; ?>][access_address]" value="<?php echo esc_attr($value['access_address']); ?>" />

   <h4 class="theme_option_headline2"><?php _e('Saturation of map', 'tcd-w'); ?></h4>
   <div class="theme_option_message2">
    <p><?php _e( 'Please set the saturation of the map. If you set it to -100 the output map is monochrome.', 'tcd-w' ); ?></p>
   </div>
   <p class="range-output"><?php _e( 'Current value: ', 'tcd-w' ); ?><span><?php echo esc_html( $value['access_saturation'] ); ?></span></p>
   <input class="range" type="range" name="lp_content[<?php echo $cb_index; ?>][access_saturation]" value="<?php echo esc_attr($value['access_saturation']); ?>" min="-100" max="100" step="10" />

   <h4 class="theme_option_headline2"><?php _e('Logo', 'tcd-w'); ?></h4>
   <ul class="option_list">
    <li class="cf">
     <span class="label">
      <?php _e('Image', 'tcd-w'); ?>
     </span>
     <div class="image_box cf">
      <div class="cf cf_media_field hide-if-no-js">
       <input type="hidden" class="cf_media_id" name="lp_content[<?php echo $cb_index; ?>][access_logo_image]" id="access_logo_image-<?php echo $cb_index; ?>" value="<?php echo esc_attr( $value['access_logo_image'] ); ?>">
       <div class="preview_field"><?php if ( $value['access_logo_image'] ) echo wp_get_attachment_image( $value['access_logo_image'], 'medium' ); ?></div>
       <div class="buttton_area">
        <input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>">
        <input type="button" class="cfmf-delete-img button<?php if ( ! $value['access_logo_image'] ) echo ' hidden'; ?>" value="<?php _e( 'Remove Image', 'tcd-w'); ?>">
       </div>
      </div>
     </div>
    </li>
    <li class="cf">
     <span class="label">
      <?php _e('Use retina display logo image', 'tcd-w'); ?>
     </span>
     <label><input name="lp_content[<?php echo $cb_index; ?>][access_logo_retina]" type="checkbox" value="1" <?php checked( $value['access_logo_retina'], 1 ); ?>></label>
    </li>
    <li class="cf">
     <span class="label">
      <?php _e('Image (mobile)', 'tcd-w'); ?>
     </span>
     <div class="image_box cf">
      <div class="cf cf_media_field hide-if-no-js">
       <input type="hidden" class="cf_media_id" name="lp_content[<?php echo $cb_index; ?>][access_logo_image_mobile]" id="access_logo_image_mobile-<?php echo $cb_index; ?>" value="<?php echo esc_attr( $value['access_logo_image_mobile'] ); ?>">
       <div class="preview_field"><?php if ( $value['access_logo_image_mobile'] ) echo wp_get_attachment_image( $value['access_logo_image_mobile'], 'medium' ); ?></div>
       <div class="buttton_area">
        <input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>">
        <input type="button" class="cfmf-delete-img button<?php if ( ! $value['access_logo_image_mobile'] ) echo ' hidden'; ?>" value="<?php _e( 'Remove Image', 'tcd-w'); ?>">
       </div>
      </div>
     </div>
    </li>
    <li class="cf">
     <span class="label">
      <?php _e('Use retina display logo image', 'tcd-w'); ?>
     </span>
     <label><input name="lp_content[<?php echo $cb_index; ?>][access_logo_retina_mobile]" type="checkbox" value="1" <?php checked( $value['access_logo_retina_mobile'], 1 ); ?>></label>
    </li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Description (Under logo)', 'tcd-w'); ?></h4>
   <textarea class="full_width" cols="50" rows="2" name="lp_content[<?php echo $cb_index; ?>][access_desc1]"><?php echo esc_textarea($value['access_desc1']); ?></textarea>

   <h4 class="theme_option_headline2"><?php _e( 'Button', 'tcd-w' ); ?></h4>
   <p class="displayment_checkbox"><label><input name="lp_content[<?php echo $cb_index; ?>][show_access_button]" type="checkbox" value="1" <?php checked( $value['show_access_button'], 1 ); ?>><?php _e( 'Display button', 'tcd-w' ); ?></label></p>
   <div style="<?php if($value['show_access_button'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
    <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
     <li class="cf"><span class="label"><?php _e('label', 'tcd-w');  ?></span><input class="full_width" type="text" name="lp_content[<?php echo $cb_index; ?>][access_button_label]" value="<?php echo esc_attr($value['access_button_label']); ?>" /></li>
     <li class="cf"><span class="label"><?php _e('URL', 'tcd-w');  ?></span><input class="full_width" type="text" name="lp_content[<?php echo $cb_index; ?>][access_button_url]" value="<?php echo esc_url($value['access_button_url']); ?>" /></li>
     <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="lp_content[<?php echo $cb_index; ?>][access_button_font_color]" value="<?php echo esc_attr($value['access_button_font_color']); ?>" data-default-color="#5a3300" class="c-color-picker"></li>
     <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="lp_content[<?php echo $cb_index; ?>][access_button_bg_color]" value="<?php echo esc_attr($value['access_button_bg_color']); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
     <li class="cf"><span class="label"><?php _e('Border color', 'tcd-w'); ?></span><input type="text" name="lp_content[<?php echo $cb_index; ?>][access_button_border_color]" value="<?php echo esc_attr($value['access_button_border_color']); ?>" data-default-color="#5b3401" class="c-color-picker"></li>
     <li class="cf"><span class="label"><?php _e('Font color on mouse over', 'tcd-w'); ?></span><input type="text" name="lp_content[<?php echo $cb_index; ?>][access_button_font_color_hover]" value="<?php echo esc_attr($value['access_button_font_color_hover']); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
     <li class="cf"><span class="label"><?php _e('Background color on mouse over', 'tcd-w'); ?></span><input type="text" name="lp_content[<?php echo $cb_index; ?>][access_button_bg_color_hover]" value="<?php echo esc_attr($value['access_button_bg_color_hover']); ?>" data-default-color="#5b3401" class="c-color-picker"></li>
     <li class="cf"><span class="label"><?php _e('Border color on mouse over', 'tcd-w'); ?></span><input type="text" name="lp_content[<?php echo $cb_index; ?>][access_button_border_color_hover]" value="<?php echo esc_attr($value['access_button_border_color_hover']); ?>" data-default-color="#5b3401" class="c-color-picker"></li>
    </ul>
   </div>

   <h3 class="theme_option_headline2"><?php _e('Image', 'tcd-w'); ?></h3>
   <div class="theme_option_message2">
    <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '250', '250'); ?></p>
   </div>
   <div class="image_list three_col">
    <div class="list_item">
     <h4 class="theme_option_headline4"><span><?php _e('Image', 'tcd-w'); ?>1</span></h4>
     <div class="image_box cf">
      <div class="cf cf_media_field hide-if-no-js">
       <input type="hidden" class="cf_media_id" name="lp_content[<?php echo $cb_index; ?>][image1]" id="image1-<?php echo $cb_index; ?>" value="<?php echo esc_attr( $value['image1'] ); ?>">
       <div class="preview_field"><?php if ( $value['image1'] ) echo wp_get_attachment_image( $value['image1'], 'medium' ); ?></div>
       <div class="buttton_area">
        <input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>">
        <input type="button" class="cfmf-delete-img button<?php if ( ! $value['image1'] ) echo ' hidden'; ?>" value="<?php _e( 'Remove Image', 'tcd-w'); ?>">
       </div>
      </div>
     </div>
    </div>
    <div class="list_item">
     <h4 class="theme_option_headline4"><span><?php _e('Image', 'tcd-w'); ?>2</span></h4>
     <div class="image_box cf">
      <div class="cf cf_media_field hide-if-no-js">
       <input type="hidden" class="cf_media_id" name="lp_content[<?php echo $cb_index; ?>][image2]" id="image2-<?php echo $cb_index; ?>" value="<?php echo esc_attr( $value['image2'] ); ?>">
       <div class="preview_field"><?php if ( $value['image2'] ) echo wp_get_attachment_image( $value['image2'], 'medium' ); ?></div>
       <div class="buttton_area">
        <input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>">
        <input type="button" class="cfmf-delete-img button<?php if ( ! $value['image2'] ) echo ' hidden'; ?>" value="<?php _e( 'Remove Image', 'tcd-w'); ?>">
       </div>
      </div>
     </div>
    </div>
    <div class="list_item">
     <h4 class="theme_option_headline4"><span><?php _e('Image', 'tcd-w'); ?>3</span></h4>
     <div class="image_box cf">
      <div class="cf cf_media_field hide-if-no-js">
       <input type="hidden" class="cf_media_id" name="lp_content[<?php echo $cb_index; ?>][image3]" id="image3-<?php echo $cb_index; ?>" value="<?php echo esc_attr( $value['image3'] ); ?>">
       <div class="preview_field"><?php if ( $value['image3'] ) echo wp_get_attachment_image( $value['image3'], 'medium' ); ?></div>
       <div class="buttton_area">
        <input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>">
        <input type="button" class="cfmf-delete-img button<?php if ( ! $value['image3'] ) echo ' hidden'; ?>" value="<?php _e( 'Remove Image', 'tcd-w'); ?>">
       </div>
      </div>
     </div>
    </div>
   </div>

   <h4 class="theme_option_headline2"><?php _e( 'Date information under image', 'tcd-w' ); ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Headline', 'tcd-w');  ?></span><input class="full_width" type="text" name="lp_content[<?php echo $cb_index; ?>][access_date_headline]" value="<?php echo esc_attr($value['access_date_headline']); ?>" /></li>
    <li class="cf"><span class="label"><?php _e('Font color of headline', 'tcd-w'); ?></span><input type="text" name="lp_content[<?php echo $cb_index; ?>][access_date_headline_color]" value="<?php echo esc_attr($value['access_date_headline_color']); ?>" data-default-color="#593300" class="c-color-picker"></li>
    <li class="cf"><span class="label"><?php _e('Date information', 'tcd-w');  ?></span><textarea class="full_width" cols="50" rows="2" name="lp_content[<?php echo $cb_index; ?>][access_date]"><?php echo esc_textarea($value['access_date']); ?></textarea></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e( 'Telephone number', 'tcd-w' ); ?></h4>
   <div class="theme_option_message2">
    <p><?php _e('You can call telephone by tapping the phone number in smartphone.', 'tcd-w'); ?></p>
   </div>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Headline', 'tcd-w');  ?></span><input class="full_width" type="text" name="lp_content[<?php echo $cb_index; ?>][access_tel_headline]" value="<?php echo esc_attr($value['access_tel_headline']); ?>" /></li>
    <li class="cf"><span class="label"><?php _e('Telephone number', 'tcd-w');  ?></span><input class="full_width" type="text" name="lp_content[<?php echo $cb_index; ?>][access_tel]" value="<?php echo esc_attr($value['access_tel']); ?>" /></li>
    <li class="cf color_picker_bottom"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="lp_content[<?php echo $cb_index; ?>][access_tel_color]" value="<?php echo esc_attr($value['access_tel_color']); ?>" data-default-color="#593300" class="c-color-picker"></li>
   </ul>

   <ul class="button_list cf">
    <li><a href="#" class="button-ml close-content"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
   </ul>
  </div><!-- END .cb_content -->


  <?php
       // コンテンツ３ -------------------------------------------------------------------------
       elseif ( 'content3' === $cb_content_select ) :
  ?>
  <h3 class="cb_content_headline"><?php echo esc_html( $cb_contents[$cb_content_select]['label'] ); ?><span><?php if(!empty($value['catch'])){?>：<?php echo esc_textarea( strip_tags( $value['catch']) ); ?><?php } ?></span></h3>
  <div class="cb_content">

   <p class="hidden"><input name="lp_content[<?php echo $cb_index; ?>][show_content]" type="hidden" value="0"></p>
   <p><label><input name="lp_content[<?php echo $cb_index; ?>][show_content]" type="checkbox" value="1" <?php checked( $value['show_content'], 1 ); ?>><?php printf(__('Display %s', 'tcd-w'), $cb_contents[$cb_content_select]['label']); ?></label></p>

   <h4 class="theme_option_headline2"><?php _e('Catchphrase', 'tcd-w');  ?></h4>
   <textarea class="large-text" cols="50" rows="2" name="lp_content[<?php echo $cb_index; ?>][catch]"><?php echo esc_textarea($value['catch']); ?></textarea>
   <ul class="option_list">
    <li class="cf">
     <span class="label"><?php _e('Font size', 'tcd-w'); ?></span>
     <div class="font_size_option">
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="lp_content[<?php echo $cb_index; ?>][catch_font_size]" value="<?php echo esc_attr( $value['catch_font_size'] ); ?>" />
       <span class="icon icon_pc"></span>
      </label>
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="lp_content[<?php echo $cb_index; ?>][catch_font_size_mobile]" value="<?php echo esc_attr( $value['catch_font_size_mobile'] ); ?>" />
       <span class="icon icon_sp"></span>
      </label>
     </div>
    </li>
    <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="lp_content[<?php echo $cb_index; ?>][catch_font_color]" value="<?php echo esc_attr( $value['catch_font_color'] ); ?>" data-default-color="#58330d" class="c-color-picker"></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Description', 'tcd-w');  ?></h4>
   <?php wp_editor( $value['desc'], 'cb_wysiwyg_editor-' . $cb_index, array ('textarea_name' => 'lp_content[' . $cb_index . '][desc]')); ?>
   <ul class="option_list">
    <li class="cf">
     <span class="label"><?php _e('Font size', 'tcd-w'); ?></span>
     <div class="font_size_option">
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="lp_content[<?php echo $cb_index; ?>][desc_font_size]" value="<?php echo esc_attr( $value['desc_font_size'] ); ?>" />
       <span class="icon icon_pc"></span>
      </label>
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="lp_content[<?php echo $cb_index; ?>][desc_font_size_mobile]" value="<?php echo esc_attr( $value['desc_font_size_mobile'] ); ?>" />
       <span class="icon icon_sp"></span>
      </label>
     </div>
    </li>
   </ul>

   <ul class="button_list cf">
    <li><a href="#" class="button-ml close-content"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
   </ul>
  </div><!-- END .cb_content -->


  <?php
       // ボタンを表示 ----------------------------------------------------------------------------
       else :
  ?>
  <h3 class="cb_content_headline"><?php echo esc_html( $cb_content_select ); ?></h3>
  <div class="cb_content">
   <ul class="button_list cf">
    <li><a href="#" class="button-ml close-content"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
   </ul>
  </div>
  <?php endif; ?>

  </div><!-- END .cb_content_wrap -->
<?php
}

/**
 * クローン用のリッチエディター化処理をしないようにする
 * クローン後のリッチエディター化はjsで行う
 */
function menu_cb_tiny_mce_before_init_lp( $mceInit, $editor_id ) {
	if ( strpos( $editor_id, 'cb_cloneindex' ) !== false ) {
		$mceInit['wp_skip_init'] = true;
	}
	return $mceInit;
}
add_filter( 'tiny_mce_before_init', 'menu_cb_tiny_mce_before_init_lp', 10, 2 );






