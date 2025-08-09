<?php

function menu_cf_meta_box() {
  $options = get_design_plus_option();
  $menu_label = $options['menu_label'] ? esc_html( $options['menu_label'] ) : __( 'Menu', 'tcd-w' );
  add_meta_box(
    'menu_cf_meta_box',//ID of meta box
    sprintf(__('%s setting', 'tcd-w'), $menu_label),
    'show_menu_cf_meta_box',//callback function
    'menu',// post type
    'normal',// context
    'high'// priority
  );
}
add_action('add_meta_boxes', 'menu_cf_meta_box');

function show_menu_cf_meta_box() {

  global $post;

  $menu_header_title = get_post_meta($post->ID, 'menu_header_title', true);
  $menu_header_sub_title = get_post_meta($post->ID, 'menu_header_sub_title', true);
  $menu_header_desc = get_post_meta($post->ID, 'menu_header_desc', true);

  // コンテンツビルダー
  $menu_cf = get_post_meta( $post->ID, 'menu_cf', true );

  echo '<input type="hidden" name="menu_cf_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

  //入力欄 ***************************************************************************************************************************************************************************************
?>

<div class="tcd_custom_field_wrap">

 <div class="theme_option_field cf theme_option_field_ac">
  <h3 class="theme_option_headline"><?php _e('Basic setting', 'tcd-w'); ?></h3>
  <div class="theme_option_field_ac_content">
   <h3 class="theme_option_headline2"><?php _e('Title', 'tcd-w'); ?></h3>
   <input class="full_width" type="text" name="menu_header_title" value="<?php echo esc_attr($menu_header_title); ?>" />
   <h3 class="theme_option_headline2"><?php _e('Sub title', 'tcd-w'); ?></h3>
   <input class="full_width" type="text" name="menu_header_sub_title" value="<?php echo esc_attr($menu_header_sub_title); ?>" />
   <h3 class="theme_option_headline2"><?php _e('Description for archive page', 'tcd-w'); ?></h3>
   <textarea class="large-text" cols="50" rows="3" name="menu_header_desc"><?php echo esc_textarea($menu_header_desc); ?></textarea>
   <h3 class="theme_option_headline2"><?php _e('Image for archive page', 'tcd-w'); ?></h3>
   <div class="theme_option_message2">
    <p>
     <?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '500', '300'); ?><br>
     <?php _e('This image will also be used in mega menu.', 'tcd-w'); ?>
    </p>
   </div>
   <?php mlcf_media_form('menu_archive_image', __('Image', 'tcd-w') ); ?>
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
if ( $menu_cf && is_array( $menu_cf ) ) :
	foreach( $menu_cf as $key => $content ) :
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
		the_page_cb_content_select( $cb_index, $content['cb_content_select'] );
		if ( ! empty( $content['cb_content_select'] ) ) :
			menu_cf_content_setting( $cb_index, $content['cb_content_select'], $content );
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
       <?php the_page_cb_content_select( 'cb_cloneindex' ); ?>
    </div><!-- END .cb_column -->
   </div><!-- END .cb_column_area -->
  </div><!-- END .cb_row -->
<?php
foreach ( page_cb_get_contents() as $key => $value ) :
	menu_cf_content_setting( 'cb_cloneindex', $key );
endforeach;
?>
 </div><!-- END #contents_builder-clone.hidden -->

</div><!-- END .tcd_custom_field_wrap -->
<?php
}

function save_menu_cf_meta_box( $post_id ) {

  // verify nonce
  if (!isset($_POST['menu_cf_meta_box_nonce']) || !wp_verify_nonce($_POST['menu_cf_meta_box_nonce'], basename(__FILE__))) {
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
  $cf_keys = array('menu_header_title','menu_header_sub_title','menu_header_desc','menu_archive_image');
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
	if ( ! empty( $_POST['menu_cf'] ) && is_array( $_POST['menu_cf'] ) ) {
		$cb_contents = page_cb_get_contents();
		$cb_data = array();

		foreach ( $_POST['menu_cf'] as $key => $value ) {
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

				$value['desc'] = $value['desc'];
				$value['desc_font_size'] = absint( $value['desc_font_size'] );
				$value['desc_font_size_mobile'] = absint( $value['desc_font_size_mobile'] );

				$value['image1'] = sanitize_text_field( $value['image1'] );
				$value['image2'] = sanitize_text_field( $value['image2'] );

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

				$value['desc'] = $value['desc'];
				$value['desc_font_size'] = absint( $value['desc_font_size'] );
				$value['desc_font_size_mobile'] = absint( $value['desc_font_size_mobile'] );

				$value['show_price_list1'] = ! empty( $value['show_price_list1'] ) ? 1 : 0;
				$price_list1 = array();
				if ( $value['price_list1'] && is_array( $value['price_list1'] ) ) {
					foreach( array_values( $value['price_list1'] ) as $repeater_value ) {
						$price_list1[] = array_merge( $cb_contents[$value['cb_content_select']]['price_list1_default'], $repeater_value );
					}
				}
				$value['price_list1'] = $price_list1;
				$value['price_list1_headline'] = sanitize_text_field( $value['price_list1_headline'] );
				$value['price_list1_headline_font_size'] = absint( $value['price_list1_headline_font_size'] );
				$value['price_list1_headline_font_size_mobile'] = absint( $value['price_list1_headline_font_size_mobile'] );
				$value['price_list1_headline_font_color'] = sanitize_hex_color( $value['price_list1_headline_font_color'] );
				$value['price_list1_headline_bg_color'] = sanitize_hex_color( $value['price_list1_headline_bg_color'] );

				$value['show_price_list2'] = ! empty( $value['show_price_list2'] ) ? 1 : 0;
				$price_list2 = array();
				if ( $value['price_list2'] && is_array( $value['price_list2'] ) ) {
					foreach( array_values( $value['price_list2'] ) as $repeater_value ) {
						$price_list2[] = array_merge( $cb_contents[$value['cb_content_select']]['price_list2_default'], $repeater_value );
					}
				}
				$value['price_list2'] = $price_list2;
				$value['price_list2_headline'] = sanitize_text_field( $value['price_list2_headline'] );
				$value['price_list2_headline_font_size'] = absint( $value['price_list2_headline_font_size'] );
				$value['price_list2_headline_font_size_mobile'] = absint( $value['price_list2_headline_font_size_mobile'] );
				$value['price_list2_headline_font_color'] = sanitize_hex_color( $value['price_list2_headline_font_color'] );
				$value['price_list2_headline_bg_color'] = sanitize_hex_color( $value['price_list2_headline_bg_color'] );

				$value['show_price_list3'] = ! empty( $value['show_price_list3'] ) ? 1 : 0;
				$price_list3 = array();
				if ( $value['price_list3'] && is_array( $value['price_list3'] ) ) {
					foreach( array_values( $value['price_list3'] ) as $repeater_value ) {
						$price_list3[] = array_merge( $cb_contents[$value['cb_content_select']]['price_list3_default'], $repeater_value );
					}
				}
				$value['price_list3'] = $price_list3;
				$value['price_list3_headline'] = sanitize_text_field( $value['price_list3_headline'] );
				$value['price_list3_headline_font_size'] = absint( $value['price_list3_headline_font_size'] );
				$value['price_list3_headline_font_size_mobile'] = absint( $value['price_list3_headline_font_size_mobile'] );
				$value['price_list3_headline_font_color'] = sanitize_hex_color( $value['price_list3_headline_font_color'] );
				$value['price_list3_headline_bg_color'] = sanitize_hex_color( $value['price_list3_headline_bg_color'] );

			// コンテンツ３
			} elseif ( 'content3' === $value['cb_content_select'] ) {

				$value['show_content'] = ! empty( $value['show_content'] ) ? 1 : 0;

				$value['headline'] = sanitize_text_field( $value['headline'] );
				$value['headline_font_size'] = absint( $value['headline_font_size'] );
				$value['headline_font_size_mobile'] = absint( $value['headline_font_size_mobile'] );
				$value['headline_font_color'] = sanitize_hex_color( $value['headline_font_color'] );
				$value['headline_bg_color'] = sanitize_hex_color( $value['headline_bg_color'] );

				$howto_list = array();
				if ( $value['howto_list'] && is_array( $value['howto_list'] ) ) {
					foreach( array_values( $value['howto_list'] ) as $repeater_value ) {
						$howto_list[] = array_merge( $cb_contents[$value['cb_content_select']]['howto_list_default'], $repeater_value );
					}
				}
				$value['howto_list'] = $howto_list;

			// コンテンツ４
			} elseif ( 'content4' === $value['cb_content_select'] ) {

				$value['show_content'] = ! empty( $value['show_content'] ) ? 1 : 0;

				$value['desc'] = $value['desc'];
				$value['desc_font_size'] = absint( $value['desc_font_size'] );
				$value['desc_font_size_mobile'] = absint( $value['desc_font_size_mobile'] );

			}

			$cb_data[] = $value;
		}

		if ( $cb_data ) {
			update_post_meta( $post_id, 'menu_cf', $cb_data );
		} else {
			delete_post_meta( $post_id, 'menu_cf' );
		}
	}
}
add_action('save_post', 'save_menu_cf_meta_box');


/**
 * コンテンツビルダー コンテンツ一覧取得
 */
function page_cb_get_contents() {
	return array(
    // コンテンツ１
		'content1' => array(
			'name' => 'content1',
			'label' => __( 'Headline content', 'tcd-w' ),
			'default' => array(
				'show_content' => 1,
				'headline' => '',
				'headline_font_size' => 38,
				'headline_font_size_mobile' => 20,
				'headline_font_color' => '#593306',
				'sub_headline' => '',
				'sub_headline_font_size' => 18,
				'sub_headline_font_size_mobile' => 15,
				'desc' => '',
				'desc_font_size' => 16,
				'desc_font_size_mobile' => 14,
				'image1' => false,
				'image2' => false,
			)
		),
    // コンテンツ２
		'content2' => array(
			'name' => 'content2',
			'label' => __( 'Course list content', 'tcd-w' ),
			'default' => array(
				'show_content' => 1,
				'headline' => '',
				'headline_font_size' => 38,
				'headline_font_size_mobile' => 20,
				'headline_font_color' => '#593306',
				'sub_headline' => '',
				'sub_headline_font_size' => 18,
				'sub_headline_font_size_mobile' => 15,
				'desc' => '',
				'desc_font_size' => 14,
				'desc_font_size_mobile' => 12,
				'show_price_list1' => '',
				'price_list1' => array(),
				'price_list1_headline' => '',
				'price_list1_headline_font_size' => 22,
				'price_list1_headline_font_size_mobile' => 16,
				'price_list1_headline_font_color' => '#ffffff',
				'price_list1_headline_bg_color' => '#58330d',
				'show_price_list2' => '',
				'price_list2' => array(),
				'price_list2_headline' => '',
				'price_list2_headline_font_size' => 22,
				'price_list2_headline_font_size_mobile' => 16,
				'price_list2_headline_font_color' => '#ffffff',
				'price_list2_headline_bg_color' => '#ad9981',
				'show_price_list3' => '',
				'price_list3' => array(),
				'price_list3_headline' => '',
				'price_list3_headline_font_size' => 22,
				'price_list3_headline_font_size_mobile' => 16,
				'price_list3_headline_font_color' => '#ffffff',
				'price_list3_headline_bg_color' => '#ad9981',
			),
			'price_list1_default' => array(
				'time' => '',
				'content' => '',
				'price' => '',
			),
			'price_list2_default' => array(
				'time' => '',
				'content' => '',
				'price' => '',
			),
			'price_list3_default' => array(
				'content' => '',
				'price' => '',
			)
		),
    // コンテンツ３
		'content3' => array(
			'name' => 'content3',
			'label' => __( 'Flow content', 'tcd-w' ),
			'default' => array(
				'show_content' => 1,
				'headline' => '',
				'headline_font_size' => 22,
				'headline_font_size_mobile' => 16,
				'headline_font_color' => '#ffffff',
				'headline_bg_color' => '#58330d',
				'howto_list' => array(),
			),
			'howto_list_default' => array(
				'title' => '',
				'content' => '',
				'image' => false,
			)
		),
    // コンテンツ４
		'content4' => array(
			'name' => 'content4',
			'label' => __( 'Free space', 'tcd-w' ),
			'default' => array(
				'show_content' => 1,
				'desc' => '',
				'desc_font_size' => 14,
				'desc_font_size_mobile' => 12,
			)
		)
	);
}

/**
 * コンテンツビルダー用 コンテンツ選択プルダウン
 */
function the_page_cb_content_select( $cb_index = 'cb_cloneindex', $selected = null ) {
	$cb_contents = page_cb_get_contents();

	if ( $selected && isset( $cb_contents[$selected] ) ) {
		$add_class = ' hidden';
	} else {
		$add_class = '';
	}

	$out = '<select name="menu_cf[' . esc_attr( $cb_index ) . '][cb_content_select]" class="cb_content_select' . $add_class . '">';
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
function menu_cf_content_setting( $cb_index = 'cb_cloneindex', $cb_content_select = null, $value = array() ) {

  global $font_type_options, $free_space_options;

	$cb_contents = page_cb_get_contents();

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

   <p class="hidden"><input name="menu_cf[<?php echo $cb_index; ?>][show_content]" type="hidden" value="0"></p>
   <p><label><input name="menu_cf[<?php echo $cb_index; ?>][show_content]" type="checkbox" value="1" <?php checked( $value['show_content'], 1 ); ?>><?php printf(__('Display %s', 'tcd-w'), $cb_contents[$cb_content_select]['label']); ?></label></p>

   <h4 class="theme_option_headline2"><?php _e('Headline', 'tcd-w');  ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Headline', 'tcd-w');  ?></span><input class="full_width" type="text" name="menu_cf[<?php echo $cb_index; ?>][headline]" value="<?php echo esc_attr($value['headline']); ?>" /></li>
    <li class="cf">
     <span class="label"><?php _e('Font size of headline', 'tcd-w'); ?></span>
     <div class="font_size_option">
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="menu_cf[<?php echo $cb_index; ?>][headline_font_size]" value="<?php echo esc_attr( $value['headline_font_size'] ); ?>" />
       <span class="icon icon_pc"></span>
      </label>
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="menu_cf[<?php echo $cb_index; ?>][headline_font_size_mobile]" value="<?php echo esc_attr( $value['headline_font_size_mobile'] ); ?>" />
       <span class="icon icon_sp"></span>
      </label>
     </div>
    </li>
    <li class="cf"><span class="label"><?php _e('Sub heading', 'tcd-w');  ?></span><input class="full_width" type="text" name="menu_cf[<?php echo $cb_index; ?>][sub_headline]" value="<?php echo esc_attr($value['sub_headline']); ?>" /></li>
    <li class="cf">
     <span class="label"><?php _e('Font size of sub heading', 'tcd-w'); ?></span>
     <div class="font_size_option">
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="menu_cf[<?php echo $cb_index; ?>][sub_headline_font_size]" value="<?php echo esc_attr( $value['sub_headline_font_size'] ); ?>" />
       <span class="icon icon_pc"></span>
      </label>
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="menu_cf[<?php echo $cb_index; ?>][sub_headline_font_size_mobile]" value="<?php echo esc_attr( $value['sub_headline_font_size_mobile'] ); ?>" />
       <span class="icon icon_sp"></span>
      </label>
     </div>
    </li>
    <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="menu_cf[<?php echo $cb_index; ?>][headline_font_color]" value="<?php echo esc_attr( $value['headline_font_color'] ); ?>" data-default-color="#593306" class="c-color-picker"></li>
   </ul>

   <h4 class="theme_option_headline2"><?php _e('Description', 'tcd-w');  ?></h4>
   <?php wp_editor( $value['desc'], 'cb_wysiwyg_editor-' . $cb_index, array ('textarea_name' => 'menu_cf[' . $cb_index . '][desc]')); ?>
   <ul class="option_list">
    <li class="cf">
     <span class="label"><?php _e('Font size', 'tcd-w'); ?></span>
     <div class="font_size_option">
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="menu_cf[<?php echo $cb_index; ?>][desc_font_size]" value="<?php echo esc_attr( $value['desc_font_size'] ); ?>" />
       <span class="icon icon_pc"></span>
      </label>
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="menu_cf[<?php echo $cb_index; ?>][desc_font_size_mobile]" value="<?php echo esc_attr( $value['desc_font_size_mobile'] ); ?>" />
       <span class="icon icon_sp"></span>
      </label>
     </div>
    </li>
   </ul>

   <h3 class="theme_option_headline2"><?php _e('Image list', 'tcd-w'); ?></h3>
   <div class="theme_option_message2">
    <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '499', '300'); ?></p>
   </div>
   <div class="image_list">
    <div class="list_item">
     <h4 class="theme_option_headline4"><span><?php _e('Image', 'tcd-w'); ?>1</span></h4>
     <div class="image_box cf">
      <div class="cf cf_media_field hide-if-no-js">
       <input type="hidden" class="cf_media_id" name="menu_cf[<?php echo $cb_index; ?>][image1]" id="image1-<?php echo $cb_index; ?>" value="<?php echo esc_attr( $value['image1'] ); ?>">
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
       <input type="hidden" class="cf_media_id" name="menu_cf[<?php echo $cb_index; ?>][image2]" id="image2-<?php echo $cb_index; ?>" value="<?php echo esc_attr( $value['image2'] ); ?>">
       <div class="preview_field"><?php if ( $value['image2'] ) echo wp_get_attachment_image( $value['image2'], 'medium' ); ?></div>
       <div class="buttton_area">
        <input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>">
        <input type="button" class="cfmf-delete-img button<?php if ( ! $value['image2'] ) echo ' hidden'; ?>" value="<?php _e( 'Remove Image', 'tcd-w'); ?>">
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

   <p class="hidden"><input name="menu_cf[<?php echo $cb_index; ?>][show_content]" type="hidden" value="0"></p>
   <p><label><input name="menu_cf[<?php echo $cb_index; ?>][show_content]" type="checkbox" value="1" <?php checked( $value['show_content'], 1 ); ?>><?php printf(__('Display %s', 'tcd-w'), $cb_contents[$cb_content_select]['label']); ?></label></p>

   <h4 class="theme_option_headline2"><?php _e('Headline', 'tcd-w');  ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Headline', 'tcd-w');  ?></span><input class="full_width" type="text" name="menu_cf[<?php echo $cb_index; ?>][headline]" value="<?php echo esc_attr($value['headline']); ?>" /></li>
    <li class="cf">
     <span class="label"><?php _e('Font size of headline', 'tcd-w'); ?></span>
     <div class="font_size_option">
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="menu_cf[<?php echo $cb_index; ?>][headline_font_size]" value="<?php echo esc_attr( $value['headline_font_size'] ); ?>" />
       <span class="icon icon_pc"></span>
      </label>
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="menu_cf[<?php echo $cb_index; ?>][headline_font_size_mobile]" value="<?php echo esc_attr( $value['headline_font_size_mobile'] ); ?>" />
       <span class="icon icon_sp"></span>
      </label>
     </div>
    </li>
    <li class="cf"><span class="label"><?php _e('Sub heading', 'tcd-w');  ?></span><input class="full_width" type="text" name="menu_cf[<?php echo $cb_index; ?>][sub_headline]" value="<?php echo esc_attr($value['sub_headline']); ?>" /></li>
    <li class="cf">
     <span class="label"><?php _e('Font size of sub heading', 'tcd-w'); ?></span>
     <div class="font_size_option">
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="menu_cf[<?php echo $cb_index; ?>][sub_headline_font_size]" value="<?php echo esc_attr( $value['sub_headline_font_size'] ); ?>" />
       <span class="icon icon_pc"></span>
      </label>
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="menu_cf[<?php echo $cb_index; ?>][sub_headline_font_size_mobile]" value="<?php echo esc_attr( $value['sub_headline_font_size_mobile'] ); ?>" />
       <span class="icon icon_sp"></span>
      </label>
     </div>
    </li>
    <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="menu_cf[<?php echo $cb_index; ?>][headline_font_color]" value="<?php echo esc_attr( $value['headline_font_color'] ); ?>" data-default-color="#593306" class="c-color-picker"></li>
   </ul>

   <?php // データ一覧1 ---------- ?>
   <h3 class="theme_option_headline2"><?php printf(__('Price list %s', 'tcd-w'), 1); ?></h3>
   <p class="displayment_checkbox"><label><input name="menu_cf[<?php echo $cb_index; ?>][show_price_list1]" type="checkbox" value="1" <?php checked( $value['show_price_list1'], 1 ); ?>><?php printf(__('Display price list %s', 'tcd-w'), 1); ?></label></p>
   <div style="<?php if($value['show_price_list1'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">

    <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
     <li class="cf"><span class="label"><?php _e('Headline', 'tcd-w');  ?></span><input class="full_width" type="text" name="menu_cf[<?php echo $cb_index; ?>][price_list1_headline]" value="<?php echo esc_attr($value['price_list1_headline']); ?>" /></li>
     <li class="cf">
      <span class="label"><?php _e('Font size of headline', 'tcd-w'); ?></span>
      <div class="font_size_option">
       <label class="font_size_label number_option">
        <input class="hankaku input_font_size" type="number" name="menu_cf[<?php echo $cb_index; ?>][price_list1_headline_font_size]" value="<?php echo esc_attr( $value['price_list1_headline_font_size'] ); ?>" />
        <span class="icon icon_pc"></span>
       </label>
       <label class="font_size_label number_option">
        <input class="hankaku input_font_size" type="number" name="menu_cf[<?php echo $cb_index; ?>][price_list1_headline_font_size_mobile]" value="<?php echo esc_attr( $value['price_list1_headline_font_size_mobile'] ); ?>" />
        <span class="icon icon_sp"></span>
       </label>
      </div>
     </li>
     <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="menu_cf[<?php echo $cb_index; ?>][price_list1_headline_font_color]" value="<?php echo esc_attr( $value['price_list1_headline_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
     <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="menu_cf[<?php echo $cb_index; ?>][price_list1_headline_bg_color]" value="<?php echo esc_attr( $value['price_list1_headline_bg_color'] ); ?>" data-default-color="#58330d" class="c-color-picker"></li>
    </ul>

    <div class="theme_option_message2">
     <p><?php _e( 'Click add new content button to add content.<br />You can change order by dragging item header.', 'tcd-w' ); ?></p>
    </div>

    <div class="repeater-wrapper">
     <div class="repeater sortable" data-delete-confirm="<?php _e( 'Delete?', 'tcd-w' ); ?>">
      <?php
           if ( $value['price_list1'] && is_array( $value['price_list1'] ) ) :
             foreach ( $value['price_list1'] as $repeater_key => $repeater_value ) :
               $repeater_value = array_merge( $cb_contents[$cb_content_select]['price_list1_default'], $repeater_value );
      ?>
      <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $repeater_key ); ?>">
       <h4 class="theme_option_subbox_headline"><?php _e( 'Contents', 'tcd-w' ); echo esc_html( $repeater_key + 1 ); ?></h4>
       <div class="sub_box_content">
        <h4 class="theme_option_headline2"><?php _e( 'Time', 'tcd-w' ); ?></h4>
        <p><input class="repeater-label full_width" type="text" name="menu_cf[<?php echo $cb_index; ?>][price_list1][<?php echo esc_attr( $repeater_key ); ?>][time]" value="<?php echo esc_attr( $repeater_value['time'] ); ?>"></p>
        <h4 class="theme_option_headline2"><?php _e( 'Contents', 'tcd-w' ); ?></h4>
        <textarea class="full_width" cols="50" rows="2" name="menu_cf[<?php echo $cb_index; ?>][price_list1][<?php echo esc_attr( $repeater_key ); ?>][content]"><?php echo esc_textarea( isset( $repeater_value['content'] ) ? $repeater_value['content'] : '' ); ?></textarea>
        <h4 class="theme_option_headline2"><?php _e( 'Price', 'tcd-w' ); ?></h4>
        <p><input class="full_width" type="text" name="menu_cf[<?php echo $cb_index; ?>][price_list1][<?php echo esc_attr( $repeater_key ); ?>][price]" value="<?php echo esc_attr( $repeater_value['price'] ); ?>"></p>
        <ul class="button_list cf">
         <li class="delete-row"><a class="button-delete-row button-ml red_button" href="#"><?php echo __( 'Delete content', 'tcd-w' ); ?></a></li>
         <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
        </ul>
       </div><!-- END .sub_box_content -->
      </div><!-- END .sub_box -->
      <?php
             endforeach;
           endif;

           $repeater_key = 'addindex';
           $repeater_value = $cb_contents[$cb_content_select]['price_list1_default'];
           ob_start();
      ?>
      <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $repeater_key ); ?>">
       <h4 class="theme_option_subbox_headline"><?php _e( 'New content', 'tcd-w' ); ?></h4>
       <div class="sub_box_content">
        <h4 class="theme_option_headline2"><?php _e( 'Time', 'tcd-w' ); ?></h4>
        <p><input class="repeater-label full_width" type="text" name="menu_cf[<?php echo $cb_index; ?>][price_list1][<?php echo esc_attr( $repeater_key ); ?>][time]" value="<?php echo esc_attr( $repeater_value['time'] ); ?>"></p>
        <h4 class="theme_option_headline2"><?php _e( 'Contents', 'tcd-w' ); ?></h4>
        <textarea class="full_width" cols="50" rows="2" name="menu_cf[<?php echo $cb_index; ?>][price_list1][<?php echo esc_attr( $repeater_key ); ?>][content]"><?php echo esc_textarea( isset( $repeater_value['content'] ) ? $repeater_value['content'] : '' ); ?></textarea>
        <h4 class="theme_option_headline2"><?php _e( 'Price', 'tcd-w' ); ?></h4>
        <p><input class="full_width" type="text" name="menu_cf[<?php echo $cb_index; ?>][price_list1][<?php echo esc_attr( $repeater_key ); ?>][price]" value="<?php echo esc_attr( $repeater_value['price'] ); ?>"></p>
        <ul class="button_list cf">
         <li class="delete-row"><a class="button-delete-row button-ml red_button" href="#"><?php echo __( 'Delete content', 'tcd-w' ); ?></a></li>
         <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
        </ul>
       </div><!-- END .sub_box_content -->
      </div><!-- END .sub_box -->
      <?php
           $clone = ob_get_clean();
      ?>
     </div><!-- END .repeater -->
     <a href="#" class="button button-secondary button-add-row" data-clone="<?php echo esc_attr( $clone ); ?>"><?php _e( 'Add content', 'tcd-w' ); ?></a>
    </div><!-- END .repeater-wrapper -->
   </div>
   <?php // データ一覧1ここまで ---------- ?>


   <?php // データ一覧2 ---------- ?>
   <h3 class="theme_option_headline2"><?php printf(__('Price list %s', 'tcd-w'), 2); ?></h3>
   <p class="displayment_checkbox"><label><input name="menu_cf[<?php echo $cb_index; ?>][show_price_list2]" type="checkbox" value="1" <?php checked( $value['show_price_list2'], 1 ); ?>><?php printf(__('Display price list %s', 'tcd-w'), 2); ?></label></p>
   <div style="<?php if($value['show_price_list2'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">

    <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
     <li class="cf"><span class="label"><?php _e('Headline', 'tcd-w');  ?></span><input class="full_width" type="text" name="menu_cf[<?php echo $cb_index; ?>][price_list2_headline]" value="<?php echo esc_attr($value['price_list2_headline']); ?>" /></li>
     <li class="cf">
      <span class="label"><?php _e('Font size of headline', 'tcd-w'); ?></span>
      <div class="font_size_option">
       <label class="font_size_label number_option">
        <input class="hankaku input_font_size" type="number" name="menu_cf[<?php echo $cb_index; ?>][price_list2_headline_font_size]" value="<?php echo esc_attr( $value['price_list2_headline_font_size'] ); ?>" />
        <span class="icon icon_pc"></span>
       </label>
       <label class="font_size_label number_option">
        <input class="hankaku input_font_size" type="number" name="menu_cf[<?php echo $cb_index; ?>][price_list2_headline_font_size_mobile]" value="<?php echo esc_attr( $value['price_list2_headline_font_size_mobile'] ); ?>" />
        <span class="icon icon_sp"></span>
       </label>
      </div>
     </li>
     <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="menu_cf[<?php echo $cb_index; ?>][price_list2_headline_font_color]" value="<?php echo esc_attr( $value['price_list2_headline_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
     <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="menu_cf[<?php echo $cb_index; ?>][price_list2_headline_bg_color]" value="<?php echo esc_attr( $value['price_list2_headline_bg_color'] ); ?>" data-default-color="#ad9981" class="c-color-picker"></li>
    </ul>

    <div class="theme_option_message2">
     <p><?php _e( 'Click add new content button to add content.<br />You can change order by dragging item header.', 'tcd-w' ); ?></p>
    </div>

    <div class="repeater-wrapper">
     <div class="repeater sortable" data-delete-confirm="<?php _e( 'Delete?', 'tcd-w' ); ?>">
      <?php
           if ( $value['price_list2'] && is_array( $value['price_list2'] ) ) :
             foreach ( $value['price_list2'] as $repeater_key => $repeater_value ) :
               $repeater_value = array_merge( $cb_contents[$cb_content_select]['price_list2_default'], $repeater_value );
      ?>
      <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $repeater_key ); ?>">
       <h4 class="theme_option_subbox_headline"><?php _e( 'Contents', 'tcd-w' ); echo esc_html( $repeater_key + 1 ); ?></h4>
       <div class="sub_box_content">
        <h4 class="theme_option_headline2"><?php _e( 'Time', 'tcd-w' ); ?></h4>
        <p><input class="repeater-label full_width" type="text" name="menu_cf[<?php echo $cb_index; ?>][price_list2][<?php echo esc_attr( $repeater_key ); ?>][time]" value="<?php echo esc_attr( $repeater_value['time'] ); ?>"></p>
        <h4 class="theme_option_headline2"><?php _e( 'Contents', 'tcd-w' ); ?></h4>
        <textarea class="full_width" cols="50" rows="2" name="menu_cf[<?php echo $cb_index; ?>][price_list2][<?php echo esc_attr( $repeater_key ); ?>][content]"><?php echo esc_textarea( isset( $repeater_value['content'] ) ? $repeater_value['content'] : '' ); ?></textarea>
        <h4 class="theme_option_headline2"><?php _e( 'Price', 'tcd-w' ); ?></h4>
        <p><input class="full_width" type="text" name="menu_cf[<?php echo $cb_index; ?>][price_list2][<?php echo esc_attr( $repeater_key ); ?>][price]" value="<?php echo esc_attr( $repeater_value['price'] ); ?>"></p>
        <ul class="button_list cf">
         <li class="delete-row"><a class="button-delete-row button-ml red_button" href="#"><?php echo __( 'Delete content', 'tcd-w' ); ?></a></li>
         <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
        </ul>
       </div><!-- END .sub_box_content -->
      </div><!-- END .sub_box -->
      <?php
             endforeach;
           endif;

           $repeater_key = 'addindex';
           $repeater_value = $cb_contents[$cb_content_select]['price_list2_default'];
           ob_start();
      ?>
      <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $repeater_key ); ?>">
       <h4 class="theme_option_subbox_headline"><?php _e( 'New content', 'tcd-w' ); ?></h4>
       <div class="sub_box_content">
        <h4 class="theme_option_headline2"><?php _e( 'Time', 'tcd-w' ); ?></h4>
        <p><input class="repeater-label full_width" type="text" name="menu_cf[<?php echo $cb_index; ?>][price_list2][<?php echo esc_attr( $repeater_key ); ?>][time]" value="<?php echo esc_attr( $repeater_value['time'] ); ?>"></p>
        <h4 class="theme_option_headline2"><?php _e( 'Contents', 'tcd-w' ); ?></h4>
        <textarea class="full_width" cols="50" rows="2" name="menu_cf[<?php echo $cb_index; ?>][price_list2][<?php echo esc_attr( $repeater_key ); ?>][content]"><?php echo esc_textarea( isset( $repeater_value['content'] ) ? $repeater_value['content'] : '' ); ?></textarea>
        <h4 class="theme_option_headline2"><?php _e( 'Price', 'tcd-w' ); ?></h4>
        <p><input class="full_width" type="text" name="menu_cf[<?php echo $cb_index; ?>][price_list2][<?php echo esc_attr( $repeater_key ); ?>][price]" value="<?php echo esc_attr( $repeater_value['price'] ); ?>"></p>
        <ul class="button_list cf">
         <li class="delete-row"><a class="button-delete-row button-ml red_button" href="#"><?php echo __( 'Delete content', 'tcd-w' ); ?></a></li>
         <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
        </ul>
       </div><!-- END .sub_box_content -->
      </div><!-- END .sub_box -->
      <?php
           $clone = ob_get_clean();
      ?>
     </div><!-- END .repeater -->
     <a href="#" class="button button-secondary button-add-row" data-clone="<?php echo esc_attr( $clone ); ?>"><?php _e( 'Add content', 'tcd-w' ); ?></a>
    </div><!-- END .repeater-wrapper -->
   </div>
   <?php // データ一覧2ここまで ---------- ?>


   <?php // データ一覧3 ---------- ?>
   <h3 class="theme_option_headline2"><?php printf(__('Price list %s', 'tcd-w'), 3); ?></h3>
   <p class="displayment_checkbox"><label><input name="menu_cf[<?php echo $cb_index; ?>][show_price_list3]" type="checkbox" value="1" <?php checked( $value['show_price_list3'], 1 ); ?>><?php printf(__('Display price list %s', 'tcd-w'), 3); ?></label></p>
   <div style="<?php if($value['show_price_list3'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">

    <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
     <li class="cf"><span class="label"><?php _e('Headline', 'tcd-w');  ?></span><input class="full_width" type="text" name="menu_cf[<?php echo $cb_index; ?>][price_list3_headline]" value="<?php echo esc_attr($value['price_list3_headline']); ?>" /></li>
     <li class="cf">
      <span class="label"><?php _e('Font size of headline', 'tcd-w'); ?></span>
      <div class="font_size_option">
       <label class="font_size_label number_option">
        <input class="hankaku input_font_size" type="number" name="menu_cf[<?php echo $cb_index; ?>][price_list3_headline_font_size]" value="<?php echo esc_attr( $value['price_list3_headline_font_size'] ); ?>" />
        <span class="icon icon_pc"></span>
       </label>
       <label class="font_size_label number_option">
        <input class="hankaku input_font_size" type="number" name="menu_cf[<?php echo $cb_index; ?>][price_list3_headline_font_size_mobile]" value="<?php echo esc_attr( $value['price_list3_headline_font_size_mobile'] ); ?>" />
        <span class="icon icon_sp"></span>
       </label>
      </div>
     </li>
     <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="menu_cf[<?php echo $cb_index; ?>][price_list3_headline_font_color]" value="<?php echo esc_attr( $value['price_list3_headline_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
     <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="menu_cf[<?php echo $cb_index; ?>][price_list3_headline_bg_color]" value="<?php echo esc_attr( $value['price_list3_headline_bg_color'] ); ?>" data-default-color="#ad9981" class="c-color-picker"></li>
    </ul>

    <div class="theme_option_message2">
     <p><?php _e( 'Click add new content button to add content.<br />You can change order by dragging item header.', 'tcd-w' ); ?></p>
    </div>

    <div class="repeater-wrapper">
     <div class="repeater sortable" data-delete-confirm="<?php _e( 'Delete?', 'tcd-w' ); ?>">
      <?php
           if ( $value['price_list3'] && is_array( $value['price_list3'] ) ) :
             foreach ( $value['price_list3'] as $repeater_key => $repeater_value ) :
               $repeater_value = array_merge( $cb_contents[$cb_content_select]['price_list3_default'], $repeater_value );
      ?>
      <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $repeater_key ); ?>">
       <h4 class="theme_option_subbox_headline"><?php _e( 'Contents', 'tcd-w' ); echo esc_html( $repeater_key + 1 ); ?></h4>
       <div class="sub_box_content">
        <h4 class="theme_option_headline2"><?php _e( 'Contents', 'tcd-w' ); ?></h4>
        <textarea class="repeater-label full_width" cols="50" rows="2" name="menu_cf[<?php echo $cb_index; ?>][price_list3][<?php echo esc_attr( $repeater_key ); ?>][content]"><?php echo esc_textarea( isset( $repeater_value['content'] ) ? $repeater_value['content'] : '' ); ?></textarea>
        <h4 class="theme_option_headline2"><?php _e( 'Price', 'tcd-w' ); ?></h4>
        <p><input class="full_width" type="text" name="menu_cf[<?php echo $cb_index; ?>][price_list3][<?php echo esc_attr( $repeater_key ); ?>][price]" value="<?php echo esc_attr( $repeater_value['price'] ); ?>"></p>
        <ul class="button_list cf">
         <li class="delete-row"><a class="button-delete-row button-ml red_button" href="#"><?php echo __( 'Delete content', 'tcd-w' ); ?></a></li>
         <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
        </ul>
       </div><!-- END .sub_box_content -->
      </div><!-- END .sub_box -->
      <?php
             endforeach;
           endif;

           $repeater_key = 'addindex';
           $repeater_value = $cb_contents[$cb_content_select]['price_list3_default'];
           ob_start();
      ?>
      <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $repeater_key ); ?>">
       <h4 class="theme_option_subbox_headline"><?php _e( 'New content', 'tcd-w' ); ?></h4>
       <div class="sub_box_content">
        <h4 class="theme_option_headline2"><?php _e( 'Contents', 'tcd-w' ); ?></h4>
        <textarea class="repeater-label full_width" cols="50" rows="2" name="menu_cf[<?php echo $cb_index; ?>][price_list3][<?php echo esc_attr( $repeater_key ); ?>][content]"><?php echo esc_textarea( isset( $repeater_value['content'] ) ? $repeater_value['content'] : '' ); ?></textarea>
        <h4 class="theme_option_headline2"><?php _e( 'Price', 'tcd-w' ); ?></h4>
        <p><input class="full_width" type="text" name="menu_cf[<?php echo $cb_index; ?>][price_list3][<?php echo esc_attr( $repeater_key ); ?>][price]" value="<?php echo esc_attr( $repeater_value['price'] ); ?>"></p>
        <ul class="button_list cf">
         <li class="delete-row"><a class="button-delete-row button-ml red_button" href="#"><?php echo __( 'Delete content', 'tcd-w' ); ?></a></li>
         <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
        </ul>
       </div><!-- END .sub_box_content -->
      </div><!-- END .sub_box -->
      <?php
           $clone = ob_get_clean();
      ?>
     </div><!-- END .repeater -->
     <a href="#" class="button button-secondary button-add-row" data-clone="<?php echo esc_attr( $clone ); ?>"><?php _e( 'Add content', 'tcd-w' ); ?></a>
    </div><!-- END .repeater-wrapper -->
   </div>
   <?php // データ一覧3ここまで ---------- ?>

   <h4 class="theme_option_headline2"><?php _e('Description', 'tcd-w');  ?></h4>
   <?php wp_editor( $value['desc'], 'cb_wysiwyg_editor-' . $cb_index, array ('textarea_name' => 'menu_cf[' . $cb_index . '][desc]')); ?>
   <ul class="option_list">
    <li class="cf">
     <span class="label"><?php _e('Font size', 'tcd-w'); ?></span>
     <div class="font_size_option">
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="menu_cf[<?php echo $cb_index; ?>][desc_font_size]" value="<?php echo esc_attr( $value['desc_font_size'] ); ?>" />
       <span class="icon icon_pc"></span>
      </label>
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="menu_cf[<?php echo $cb_index; ?>][desc_font_size_mobile]" value="<?php echo esc_attr( $value['desc_font_size_mobile'] ); ?>" />
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
       // コンテンツ３ -------------------------------------------------------------------------
       elseif ( 'content3' === $cb_content_select ) :
  ?>
  <h3 class="cb_content_headline"><?php echo esc_html( $cb_contents[$cb_content_select]['label'] ); ?><span><?php if(!empty($value['headline'])){?>：<?php echo esc_textarea( strip_tags( $value['headline']) ); ?><?php } ?></span></h3>
  <div class="cb_content">

   <p class="hidden"><input name="menu_cf[<?php echo $cb_index; ?>][show_content]" type="hidden" value="0"></p>
   <p><label><input name="menu_cf[<?php echo $cb_index; ?>][show_content]" type="checkbox" value="1" <?php checked( $value['show_content'], 1 ); ?>><?php printf(__('Display %s', 'tcd-w'), $cb_contents[$cb_content_select]['label']); ?></label></p>

   <h4 class="theme_option_headline2"><?php _e('Headline', 'tcd-w');  ?></h4>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Headline', 'tcd-w');  ?></span><input class="full_width" type="text" name="menu_cf[<?php echo $cb_index; ?>][headline]" value="<?php echo esc_attr($value['headline']); ?>" /></li>
    <li class="cf">
     <span class="label"><?php _e('Font size of headline', 'tcd-w'); ?></span>
     <div class="font_size_option">
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="menu_cf[<?php echo $cb_index; ?>][headline_font_size]" value="<?php echo esc_attr( $value['headline_font_size'] ); ?>" />
       <span class="icon icon_pc"></span>
      </label>
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="menu_cf[<?php echo $cb_index; ?>][headline_font_size_mobile]" value="<?php echo esc_attr( $value['headline_font_size_mobile'] ); ?>" />
       <span class="icon icon_sp"></span>
      </label>
     </div>
    </li>
    <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="menu_cf[<?php echo $cb_index; ?>][headline_font_color]" value="<?php echo esc_attr( $value['headline_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
    <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="menu_cf[<?php echo $cb_index; ?>][headline_bg_color]" value="<?php echo esc_attr( $value['headline_bg_color'] ); ?>" data-default-color="#58330d" class="c-color-picker"></li>
   </ul>

   <?php // 方法一覧 ---------- ?>
   <h3 class="theme_option_headline2"><?php _e('List', 'tcd-w'); ?></h3>
   <div class="theme_option_message2">
    <p><?php _e( 'Click add new content button to add content.<br />You can change order by dragging item header.', 'tcd-w' ); ?></p>
   </div>
   <div class="repeater-wrapper">
    <div class="repeater sortable" data-delete-confirm="<?php _e( 'Delete?', 'tcd-w' ); ?>">
     <?php
          if ( $value['howto_list'] && is_array( $value['howto_list'] ) ) :
            foreach ( $value['howto_list'] as $repeater_key => $repeater_value ) :
              $repeater_value = array_merge( $cb_contents[$cb_content_select]['howto_list_default'], $repeater_value );
     ?>
     <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $repeater_key ); ?>">
      <h4 class="theme_option_subbox_headline"><?php _e( 'Contents', 'tcd-w' ); echo esc_html( $repeater_key + 1 ); ?></h4>
      <div class="sub_box_content">
       <h4 class="theme_option_headline2"><?php _e( 'Title', 'tcd-w' ); ?></h4>
       <p><input class="repeater-label full_width" type="text" name="menu_cf[<?php echo $cb_index; ?>][howto_list][<?php echo esc_attr( $repeater_key ); ?>][title]" value="<?php echo esc_attr( $repeater_value['title'] ); ?>"></p>
       <h4 class="theme_option_headline2"><?php _e( 'Contents', 'tcd-w' ); ?></h4>
       <textarea class="full_width" cols="50" rows="2" name="menu_cf[<?php echo $cb_index; ?>][howto_list][<?php echo esc_attr( $repeater_key ); ?>][content]"><?php echo esc_textarea( isset( $repeater_value['content'] ) ? $repeater_value['content'] : '' ); ?></textarea>
       <h4 class="theme_option_headline2"><?php _e( 'Image', 'tcd-w' ); ?></h4>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js">
         <input type="hidden" class="cf_media_id" name="menu_cf[<?php echo $cb_index; ?>][howto_list][<?php echo esc_attr( $repeater_key ); ?>][image]" id="howto_list-<?php echo $cb_index; ?>-howto_list-<?php echo esc_attr( $repeater_key ); ?>-image" value="<?php echo esc_attr( $repeater_value['image'] ); ?>">
         <div class="preview_field"><?php if ( $repeater_value['image'] ) echo wp_get_attachment_image( $repeater_value['image'], 'medium' ); ?></div>
         <div class="buttton_area">
          <input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>">
          <input type="button" class="cfmf-delete-img button<?php if ( ! $repeater_value['image'] ) echo ' hidden'; ?>" value="<?php _e( 'Remove Image', 'tcd-w'); ?>">
         </div>
        </div>
       </div>
       <ul class="button_list cf">
        <li class="delete-row"><a class="button-delete-row button-ml red_button" href="#"><?php echo __( 'Delete content', 'tcd-w' ); ?></a></li>
        <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
       </ul>
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->
     <?php
            endforeach;
          endif;

          $repeater_key = 'addindex';
          $repeater_value = $cb_contents[$cb_content_select]['howto_list_default'];
          ob_start();
     ?>
     <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $repeater_key ); ?>">
      <h4 class="theme_option_subbox_headline"><?php _e( 'New content', 'tcd-w' ); ?></h4>
      <div class="sub_box_content">
       <h4 class="theme_option_headline2"><?php _e( 'Title', 'tcd-w' ); ?></h4>
       <p><input class="repeater-label full_width" type="text" name="menu_cf[<?php echo $cb_index; ?>][howto_list][<?php echo esc_attr( $repeater_key ); ?>][title]" value="<?php echo esc_attr( $repeater_value['title'] ); ?>"></p>
       <h4 class="theme_option_headline2"><?php _e( 'Contents', 'tcd-w' ); ?></h4>
       <textarea class="full_width" cols="50" rows="2" name="menu_cf[<?php echo $cb_index; ?>][howto_list][<?php echo esc_attr( $repeater_key ); ?>][content]"><?php echo esc_textarea( isset( $repeater_value['content'] ) ? $repeater_value['content'] : '' ); ?></textarea>
       <h4 class="theme_option_headline2"><?php _e( 'Image', 'tcd-w' ); ?></h4>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js">
         <input type="hidden" class="cf_media_id" name="menu_cf[<?php echo $cb_index; ?>][howto_list][<?php echo esc_attr( $repeater_key ); ?>][image]" id="howto_list-<?php echo $cb_index; ?>-howto_list-<?php echo esc_attr( $repeater_key ); ?>-image" value="<?php echo esc_attr( $repeater_value['image'] ); ?>">
         <div class="preview_field"><?php if ( $repeater_value['image'] ) echo wp_get_attachment_image( $repeater_value['image'], 'medium' ); ?></div>
         <div class="buttton_area">
          <input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-w' ); ?>">
          <input type="button" class="cfmf-delete-img button<?php if ( ! $repeater_value['image'] ) echo ' hidden'; ?>" value="<?php _e( 'Remove Image', 'tcd-w'); ?>">
         </div>
        </div>
       </div>
       <ul class="button_list cf">
        <li class="delete-row"><a class="button-delete-row button-ml red_button" href="#"><?php echo __( 'Delete content', 'tcd-w' ); ?></a></li>
        <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
       </ul>
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->
     <?php
          $clone = ob_get_clean();
     ?>
    </div><!-- END .repeater -->
    <a href="#" class="button button-secondary button-add-row" data-clone="<?php echo esc_attr( $clone ); ?>"><?php _e( 'Add content', 'tcd-w' ); ?></a>
   </div><!-- END .repeater-wrapper -->
   <?php // 方法一覧ここまで ---------- ?>


   <ul class="button_list cf">
    <li><a href="#" class="button-ml close-content"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
   </ul>
  </div><!-- END .cb_content -->

  <?php
       // コンテンツ４ -------------------------------------------------------------------------
       elseif ( 'content4' === $cb_content_select ) :
  ?>
  <h3 class="cb_content_headline"><?php echo esc_html( $cb_contents[$cb_content_select]['label'] ); ?><span><?php if(!empty($value['desc'])){?>：<?php echo esc_textarea( strip_tags( $value['desc']) ); ?><?php } ?></span></h3>
  <div class="cb_content">

   <p class="hidden"><input name="menu_cf[<?php echo $cb_index; ?>][show_content]" type="hidden" value="0"></p>
   <p><label><input name="menu_cf[<?php echo $cb_index; ?>][show_content]" type="checkbox" value="1" <?php checked( $value['show_content'], 1 ); ?>><?php printf(__('Display %s', 'tcd-w'), $cb_contents[$cb_content_select]['label']); ?></label></p>

   <h4 class="theme_option_headline2"><?php _e('Description', 'tcd-w');  ?></h4>
   <?php wp_editor( $value['desc'], 'cb_wysiwyg_editor-' . $cb_index, array ('textarea_name' => 'menu_cf[' . $cb_index . '][desc]')); ?>
   <ul class="option_list">
    <li class="cf">
     <span class="label"><?php _e('Font size', 'tcd-w'); ?></span>
     <div class="font_size_option">
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="menu_cf[<?php echo $cb_index; ?>][desc_font_size]" value="<?php echo esc_attr( $value['desc_font_size'] ); ?>" />
       <span class="icon icon_pc"></span>
      </label>
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="menu_cf[<?php echo $cb_index; ?>][desc_font_size_mobile]" value="<?php echo esc_attr( $value['desc_font_size_mobile'] ); ?>" />
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
function menu_cb_tiny_mce_before_init( $mceInit, $editor_id ) {
	if ( strpos( $editor_id, 'cb_cloneindex' ) !== false ) {
		$mceInit['wp_skip_init'] = true;
	}
	return $mceInit;
}
add_filter( 'tiny_mce_before_init', 'menu_cb_tiny_mce_before_init', 10, 2 );






