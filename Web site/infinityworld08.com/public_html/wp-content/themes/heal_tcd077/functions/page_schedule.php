<?php

function schedule_meta_box() {
  add_meta_box(
    'schedule_meta_box',//ID of meta box
    __('Schedule page', 'tcd-w'),//label
    'show_schedule_meta_box',//callback function
    'page',// post type
    'normal',// context
    'high'// priority
  );
}
add_action('add_meta_boxes', 'schedule_meta_box');

function show_schedule_meta_box() {
  global $post, $font_type_options;;

  // ヘッダー -------------------------------------------------------
  $schedule_header_title = get_post_meta($post->ID, 'schedule_header_title', true);
  $schedule_header_title_font_size = get_post_meta($post->ID, 'schedule_header_title_font_size', true);
  if(empty($schedule_header_title_font_size)){
    $schedule_header_title_font_size = '38';
  }
  $schedule_header_title_font_size_mobile = get_post_meta($post->ID, 'schedule_header_title_font_size_mobile', true);
  if(empty($schedule_header_title_font_size_mobile)){
    $schedule_header_title_font_size_mobile = '22';
  }

  $schedule_header_sub_title = get_post_meta($post->ID, 'schedule_header_sub_title', true);
  $schedule_header_sub_title_font_size = get_post_meta($post->ID, 'schedule_header_sub_title_font_size', true);
  if(empty($schedule_header_sub_title_font_size)){
    $schedule_header_sub_title_font_size = '18';
  }
  $schedule_header_sub_title_font_size_mobile = get_post_meta($post->ID, 'schedule_header_sub_title_font_size_mobile', true);
  if(empty($schedule_header_sub_title_font_size_mobile)){
    $schedule_header_sub_title_font_size_mobile = '12';
  }
  $schedule_header_font_color = get_post_meta($post->ID, 'schedule_header_font_color', true);
  if(empty($schedule_header_font_color)){
    $schedule_header_font_color = '#ffffff';
  }
  $use_schedule_header_overlay = get_post_meta($post->ID, 'use_schedule_header_overlay', true);
  $schedule_header_overlay_color = get_post_meta($post->ID, 'schedule_header_overlay_color', true);
  if(empty($schedule_header_overlay_color)){
    $schedule_header_overlay_color = '#000000';
  }
  $schedule_header_overlay_opacity = get_post_meta($post->ID, 'schedule_header_overlay_opacity', true);
  if(empty($schedule_header_overlay_opacity)){
    $schedule_header_overlay_opacity = '0.3';
  }

  // キャッチコピー -----------------------------------------------
  $schedule_catch = get_post_meta($post->ID, 'schedule_catch', true);
  $schedule_catch_font_size = get_post_meta($post->ID, 'schedule_catch_font_size', true);
  if(empty($schedule_catch_font_size)){
    $schedule_catch_font_size = '38';
  }
  $schedule_catch_font_size_mobile = get_post_meta($post->ID, 'schedule_catch_font_size_mobile', true);
  if(empty($schedule_catch_font_size_mobile)){
    $schedule_catch_font_size_mobile = '22';
  }
  $schedule_catch_font_color = get_post_meta($post->ID, 'schedule_catch_font_color', true);
  if(empty($schedule_catch_font_color)){
    $schedule_catch_font_color = '#593306';
  }

  $schedule_desc = get_post_meta($post->ID, 'schedule_desc', true);
  $schedule_desc_font_size = get_post_meta($post->ID, 'schedule_desc_font_size', true);
  if(empty($schedule_desc_font_size)){
    $schedule_desc_font_size = '16';
  }
  $schedule_desc_font_size_mobile = get_post_meta($post->ID, 'schedule_desc_font_size_mobile', true);
  if(empty($schedule_desc_font_size_mobile)){
    $schedule_desc_font_size_mobile = '14';
  }

  $staff_schedule_desc = get_post_meta($post->ID, 'staff_schedule_desc', true);
  $staff_schedule_header_font_color = get_post_meta($post->ID, 'staff_schedule_header_font_color', true);
  if(empty($staff_schedule_header_font_color)){
    $staff_schedule_header_font_color = '#ffffff';
  };
  $staff_schedule_header_bg_color = get_post_meta($post->ID, 'staff_schedule_header_bg_color', true);
  if(empty($staff_schedule_header_bg_color)){
    $staff_schedule_header_bg_color = '#ad9983';
  };


  // バナーコンテンツ -----------------------------------------------
  $schedule_banner_url = get_post_meta($post->ID, 'schedule_banner_url', true);
  $schedule_banner_title = get_post_meta($post->ID, 'schedule_banner_title', true);
  $schedule_banner_sub_title = get_post_meta($post->ID, 'schedule_banner_sub_title', true);
  $schedule_banner_desc = get_post_meta($post->ID, 'schedule_banner_desc', true);
  $schedule_banner_title_font_size = get_post_meta($post->ID, 'schedule_banner_title_font_size', true);
  if(empty($schedule_banner_title_font_size)){
    $schedule_banner_title_font_size = '38';
  }
  $schedule_banner_title_font_size_mobile = get_post_meta($post->ID, 'schedule_banner_title_font_size_mobile', true);
  if(empty($schedule_banner_title_font_size_mobile)){
    $schedule_banner_title_font_size_mobile = '20';
  }
  $schedule_banner_sub_title_font_size = get_post_meta($post->ID, 'schedule_banner_sub_title_font_size', true);
  if(empty($schedule_banner_sub_title_font_size)){
    $schedule_banner_sub_title_font_size = '18';
  }
  $schedule_banner_sub_title_font_size_mobile = get_post_meta($post->ID, 'schedule_banner_sub_title_font_size_mobile', true);
  if(empty($schedule_banner_sub_title_font_size_mobile)){
    $schedule_banner_sub_title_font_size_mobile = '15';
  }
  $schedule_banner_desc_font_size = get_post_meta($post->ID, 'schedule_banner_desc_font_size', true);
  if(empty($schedule_banner_desc_font_size)){
    $schedule_banner_desc_font_size = '16';
  }
  $schedule_banner_desc_font_size_mobile = get_post_meta($post->ID, 'schedule_banner_desc_font_size_mobile', true);
  if(empty($schedule_banner_desc_font_size_mobile)){
    $schedule_banner_desc_font_size_mobile = '14';
  }
  $schedule_banner_title_color = get_post_meta($post->ID, 'schedule_banner_title_color', true);
  if(empty($schedule_banner_title_color)){
    $schedule_banner_title_color = '#ffffff';
  }
  $schedule_banner_use_overlay = get_post_meta($post->ID, 'schedule_banner_use_overlay', true);
  $schedule_banner_overlay_color = get_post_meta($post->ID, 'schedule_banner_overlay_color', true);
  if(empty($schedule_banner_overlay_color)){
    $schedule_banner_overlay_color = '#000000';
  }
  $schedule_banner_overlay_opacity = get_post_meta($post->ID, 'schedule_banner_overlay_opacity', true);
  if(empty($schedule_banner_overlay_opacity)){
    $schedule_banner_overlay_opacity = '0.3';
  }

  echo '<input type="hidden" name="schedule_custom_fields_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

  //入力欄 ***************************************************************************************************************************************************************************************
?>

<?php
     // WP5.0対策として隠しフィールドを用意　選択されているページテンプレートによってABOUT入力欄を表示・非表示する
     if ( count( get_page_templates( $post ) ) > 0 && get_option( 'page_for_posts' ) != $post->ID ) :
       $template = ! empty( $post->page_template ) ? $post->page_template : false;
?>
<select name="hidden_page_template" id="hidden_page_template" style="display:none;">
 <option value="default">Default Template</option>
 <?php page_template_dropdown( $template, 'page' ); ?>
</select>
<?php endif; ?>

<div class="tcd_custom_field_wrap">

  <div class="theme_option_field cf theme_option_field_ac">
   <h3 class="theme_option_headline"><?php _e( 'Header', 'tcd-w' ); ?></h3>
   <div class="theme_option_field_ac_content">

    <h3 class="theme_option_headline2"><?php _e('Title', 'tcd-w'); ?></h3>
    <input class="full_width" type="text" name="schedule_header_title" value="<?php echo esc_attr($schedule_header_title); ?>" />
    <ul class="option_list">
     <li class="cf">
      <span class="label"><?php _e('Font size', 'tcd-w'); ?></span>
      <div class="font_size_option">
       <label class="font_size_label number_option">
        <input class="hankaku input_font_size" type="number" name="schedule_header_title_font_size" value="<?php esc_attr_e( $schedule_header_title_font_size ); ?>"><span class="icon icon_pc"></span>
       </label>
       <label class="font_size_label number_option">
        <input class="hankaku input_font_size_sp" type="number" name="schedule_header_title_font_size_mobile" value="<?php esc_attr_e( $schedule_header_title_font_size_mobile ); ?>"><span class="icon icon_sp"></span>
       </label>
      </div>
     </li>
     <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="schedule_header_font_color" value="<?php echo esc_attr( $schedule_header_font_color ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
    </ul>

    <h3 class="theme_option_headline2"><?php _e('Sub title', 'tcd-w'); ?></h3>
    <input class="full_width" type="text" name="schedule_header_sub_title" value="<?php echo esc_attr($schedule_header_sub_title); ?>" />
    <ul class="option_list">
     <li class="cf">
      <span class="label"><?php _e('Font size', 'tcd-w'); ?></span>
      <div class="font_size_option">
       <label class="font_size_label number_option">
        <input class="hankaku input_font_size" type="number" name="schedule_header_sub_title_font_size" value="<?php esc_attr_e( $schedule_header_sub_title_font_size ); ?>"><span class="icon icon_pc"></span>
       </label>
       <label class="font_size_label number_option">
        <input class="hankaku input_font_size_sp" type="number" name="schedule_header_sub_title_font_size_mobile" value="<?php esc_attr_e( $schedule_header_sub_title_font_size_mobile ); ?>"><span class="icon icon_sp"></span>
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
      <?php mlcf_media_form('schedule_header_image', __('Image', 'tcd-w') ); ?>
     </li>
    </ul>

    <h3 class="theme_option_headline2"><?php _e( 'Overlay', 'tcd-w' ); ?></h3>
    <p class="displayment_checkbox"><label><input name="use_schedule_header_overlay" type="checkbox" value="1" <?php checked( $use_schedule_header_overlay, 1 ); ?>><?php _e( 'Use overlay', 'tcd-w' ); ?></label></p>
    <div style="<?php if($use_schedule_header_overlay == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
     <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
      <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-w'); ?></span><input type="text" name="schedule_header_overlay_color" value="<?php echo esc_attr( $schedule_header_overlay_color ); ?>" data-default-color="#000000" class="c-color-picker"></li>
      <li class="cf">
       <span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="schedule_header_overlay_opacity" value="<?php echo esc_attr( $schedule_header_overlay_opacity ); ?>" />
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

  <div class="theme_option_field cf theme_option_field_ac">
   <h3 class="theme_option_headline"><?php _e( 'Other setting', 'tcd-w' ); ?></h3>
   <div class="theme_option_field_ac_content">

    <h3 class="theme_option_headline2"><?php _e('Catchphrase', 'tcd-w'); ?></h3>
    <textarea class="large-text" cols="50" rows="3" name="schedule_catch"><?php echo esc_textarea(  $schedule_catch ); ?></textarea>
    <ul class="option_list">
     <li class="cf">
      <span class="label"><?php _e('Font size', 'tcd-w'); ?></span>
      <div class="font_size_option">
       <label class="font_size_label number_option">
        <input class="hankaku input_font_size" type="number" name="schedule_catch_font_size" value="<?php esc_attr_e( $schedule_catch_font_size ); ?>"><span class="icon icon_pc"></span>
       </label>
       <label class="font_size_label number_option">
        <input class="hankaku input_font_size_sp" type="number" name="schedule_catch_font_size_mobile_mobile" value="<?php esc_attr_e( $schedule_catch_font_size_mobile_mobile ); ?>"><span class="icon icon_sp"></span>
       </label>
      </div>
     </li>
     <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="schedule_catch_font_color" value="<?php echo esc_attr( $schedule_catch_font_color ); ?>" data-default-color="#593306" class="c-color-picker"></li>
    </ul>

    <h3 class="theme_option_headline2"><?php _e('Description', 'tcd-w'); ?></h3>
    <textarea class="large-text" cols="50" rows="3" name="schedule_desc"><?php echo esc_textarea(  $schedule_desc ); ?></textarea>
    <ul class="option_list">
     <li class="cf">
      <span class="label"><?php _e('Font size', 'tcd-w'); ?></span>
      <div class="font_size_option">
       <label class="font_size_label number_option">
        <input class="hankaku input_font_size" type="number" name="schedule_desc_font_size" value="<?php esc_attr_e( $schedule_desc_font_size ); ?>"><span class="icon icon_pc"></span>
       </label>
       <label class="font_size_label number_option">
        <input class="hankaku input_font_size_sp" type="number" name="schedule_desc_font_size_mobile" value="<?php esc_attr_e( $schedule_desc_font_size_mobile ); ?>"><span class="icon icon_sp"></span>
       </label>
      </div>
     </li>
    </ul>

    <h3 class="theme_option_headline2"><?php _e('Schedule calendar', 'tcd-w'); ?></h3>
    <ul class="option_list">
     <li class="cf"><span class="label"><?php _e('Font color of header', 'tcd-w'); ?></span><input type="text" name="staff_schedule_header_font_color" value="<?php echo esc_attr( $staff_schedule_header_font_color ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
     <li class="cf"><span class="label"><?php _e('Background color of header', 'tcd-w'); ?></span><input type="text" name="staff_schedule_header_bg_color" value="<?php echo esc_attr( $staff_schedule_header_bg_color ); ?>" data-default-color="#ad9983" class="c-color-picker"></li>
    </ul>

    <h3 class="theme_option_headline2"><?php _e('Description under schedule calendar', 'tcd-w'); ?></h3>
    <textarea class="large-text" cols="50" rows="3" name="staff_schedule_desc"><?php echo esc_textarea(  $staff_schedule_desc ); ?></textarea>

    <ul class="button_list cf">
     <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
    </ul>
   </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->

  <?php // バナーの設定 ----------------------------------------- ?>
  <div class="theme_option_field cf theme_option_field_ac">
   <h3 class="theme_option_headline"><?php _e('Banner content', 'tcd-w');  ?></h3>
   <div class="theme_option_field_ac_content">

    <h4 class="theme_option_headline2"><?php _e('Title', 'tcd-w');  ?></h4>
    <input class="full_width" type="text" name="schedule_banner_title" value="<?php echo esc_attr($schedule_banner_title); ?>" />
    <ul class="option_list">
     <li class="cf">
      <span class="label"><?php _e('Font size', 'tcd-w'); ?></span>
      <div class="font_size_option">
       <label class="font_size_label number_option">
        <input class="hankaku input_font_size" type="number" name="schedule_banner_title_font_size" value="<?php esc_attr_e( $schedule_banner_title_font_size ); ?>"><span class="icon icon_pc"></span>
       </label>
       <label class="font_size_label number_option">
        <input class="hankaku input_font_size_sp" type="number" name="schedule_banner_title_font_size_mobile" value="<?php esc_attr_e( $schedule_banner_title_font_size_mobile ); ?>"><span class="icon icon_sp"></span>
       </label>
      </div>
     </li>
    </ul>

    <h4 class="theme_option_headline2"><?php _e('Sub title', 'tcd-w');  ?></h4>
    <input class="full_width" type="text" name="schedule_banner_sub_title" value="<?php echo esc_attr($schedule_banner_sub_title); ?>" />
    <ul class="option_list">
     <li class="cf">
      <span class="label"><?php _e('Font size', 'tcd-w'); ?></span>
      <div class="font_size_option">
       <label class="font_size_label number_option">
        <input class="hankaku input_font_size" type="number" name="schedule_banner_sub_title_font_size" value="<?php esc_attr_e( $schedule_banner_sub_title_font_size ); ?>"><span class="icon icon_pc"></span>
       </label>
       <label class="font_size_label number_option">
        <input class="hankaku input_font_size_sp" type="number" name="schedule_banner_sub_title_font_size_mobile" value="<?php esc_attr_e( $schedule_banner_sub_title_font_size_mobile ); ?>"><span class="icon icon_sp"></span>
       </label>
      </div>
     </li>
    </ul>

    <h4 class="theme_option_headline2"><?php _e('Description', 'tcd-w');  ?></h4>
    <textarea class="large-text" cols="50" rows="3" name="schedule_banner_desc"><?php echo esc_textarea(  $schedule_banner_desc ); ?></textarea>
    <ul class="option_list">
     <li class="cf">
      <span class="label"><?php _e('Font size', 'tcd-w'); ?></span>
      <div class="font_size_option">
       <label class="font_size_label number_option">
        <input class="hankaku input_font_size" type="number" name="schedule_banner_desc_font_size" value="<?php esc_attr_e( $schedule_banner_desc_font_size ); ?>"><span class="icon icon_pc"></span>
       </label>
       <label class="font_size_label number_option">
        <input class="hankaku input_font_size_sp" type="number" name="schedule_banner_desc_font_size_mobile" value="<?php esc_attr_e( $schedule_banner_desc_font_size_mobile ); ?>"><span class="icon icon_sp"></span>
       </label>
      </div>
     </li>
    </ul>

    <h4 class="theme_option_headline2"><?php _e('Other setting', 'tcd-w');  ?></h4>
    <ul class="option_list">
     <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="schedule_banner_title_color" value="<?php echo esc_attr( $schedule_banner_title_color ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
     <li class="cf"><span class="label"><?php _e('URL', 'tcd-w');  ?></span><input class="full_width" type="text" name="schedule_banner_url" value="<?php esc_attr_e( $schedule_banner_url ); ?>" style="width:50%;" /></li>
    </ul>

    <h4 class="theme_option_headline2"><?php _e('Background image', 'tcd-w'); ?></h4>
    <ul class="option_list">
     <li class="cf">
      <span class="label">
       <?php _e('Background image', 'tcd-w'); ?>
       <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '1000', '300'); ?></span>
      </span>
      <?php mlcf_media_form('schedule_banner_image', __('Image', 'tcd-w') ); ?>
     </li>
    </ul>

    <h4 class="theme_option_headline2"><?php _e( 'Overlay', 'tcd-w' ); ?></h4>
    <p class="displayment_checkbox"><label><input name="schedule_banner_use_overlay" type="checkbox" value="1" <?php checked( $schedule_banner_use_overlay, 1 ); ?>><?php _e( 'Use overlay', 'tcd-w' ); ?></label></p>
    <div style="<?php if($schedule_banner_use_overlay == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
     <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
      <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-w'); ?></span><input type="text" name="schedule_banner_overlay_color" value="<?php echo esc_attr( $schedule_banner_overlay_color ); ?>" data-default-color="#000000" class="c-color-picker"></li>
      <li class="cf">
       <span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="schedule_banner_overlay_opacity" value="<?php echo esc_attr( $schedule_banner_overlay_opacity ); ?>" />
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

function save_schedule_meta_box( $post_id ) {

  // verify nonce
  if (!isset($_POST['schedule_custom_fields_meta_box_nonce']) || !wp_verify_nonce($_POST['schedule_custom_fields_meta_box_nonce'], basename(__FILE__))) {
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
    'schedule_header_title','schedule_header_title_font_size','schedule_header_title_font_size_mobile','schedule_header_sub_title','schedule_header_sub_title_font_size','schedule_header_sub_title_font_size_mobile','schedule_header_font_color','schedule_header_image','schedule_header_overlay_color','use_schedule_header_overlay','schedule_header_overlay_opacity',
    'schedule_catch','schedule_catch_font_size','schedule_catch_font_size_mobile','schedule_catch_font_color','schedule_desc','schedule_desc_font_size','schedule_desc_font_size_mobile',
    'staff_schedule_desc','staff_schedule_header_font_color','staff_schedule_header_bg_color',
    'schedule_banner_url','schedule_banner_title','schedule_banner_sub_title','schedule_banner_desc','schedule_banner_title_font_size','schedule_banner_title_font_size_mobile','schedule_banner_sub_title_font_size',
    'schedule_banner_sub_title_font_size_mobile','schedule_banner_desc_font_size','schedule_banner_desc_font_size_mobile','schedule_banner_title_color','schedule_banner_image','schedule_banner_use_overlay','schedule_banner_overlay_color','schedule_banner_overlay_opacity',
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
add_action('save_post', 'save_schedule_meta_box');




?>
