<?php

function staff_cf_meta_box() {
  $options = get_design_plus_option();
  $staff_label = $options['staff_label'] ? esc_html( $options['staff_label'] ) : __( 'Staff', 'tcd-w' );
  add_meta_box(
    'staff_cf_meta_box',//ID of meta box
    sprintf(__('%s setting', 'tcd-w'), $staff_label),
    'show_staff_cf_meta_box',//callback function
    'staff',// post type
    'normal',// context
    'high'// priority
  );
}
add_action('add_meta_boxes', 'staff_cf_meta_box');

function show_staff_cf_meta_box() {
  global $post, $font_type_options;;

  // schedule js
  wp_enqueue_script( 'admin-staff-schedule', get_template_directory_uri() . '/admin/js/staff-schedule.js', array(), version_num(), true );

  $staff_sub_title = get_post_meta($post->ID, 'staff_sub_title', true);
  $staff_position = get_post_meta($post->ID, 'staff_position', true);
  $staff_instagram = get_post_meta($post->ID, 'staff_instagram', true);
  $staff_tiktok = get_post_meta($post->ID, 'staff_tiktok', true);
  $staff_twitter = get_post_meta($post->ID, 'staff_twitter', true);
  $staff_facebook = get_post_meta($post->ID, 'staff_facebook', true);

  $staff_catch = get_post_meta($post->ID, 'staff_catch', true);
  $staff_catch_font_size = get_post_meta($post->ID, 'staff_catch_font_size', true);
  if(empty($staff_catch_font_size)){
    $staff_catch_font_size = '22';
  };
  $staff_catch_font_size_mobile = get_post_meta($post->ID, 'staff_catch_font_size_mobile', true);
  if(empty($staff_catch_font_size_mobile)){
    $staff_catch_font_size_mobile = '18';
  };
  $staff_catch_color = get_post_meta($post->ID, 'staff_catch_color', true);
  if(empty($staff_catch_color)){
    $staff_catch_color = '#d4bc9c';
  };

  $staff_desc = get_post_meta($post->ID, 'staff_desc', true);
  $staff_desc_font_size = get_post_meta($post->ID, 'staff_desc_font_size', true);
  if(empty($staff_desc_font_size)){
    $staff_desc_font_size = '16';
  };
  $staff_desc_font_size_mobile = get_post_meta($post->ID, 'staff_desc_font_size_mobile', true);
  if(empty($staff_desc_font_size_mobile)){
    $staff_desc_font_size_mobile = '14';
  };
  $staff_desc_color = get_post_meta($post->ID, 'staff_desc_color', true);
  if(empty($staff_desc_color)){
    $staff_desc_color = '#ffffff';
  };

  $staff_desc_bg_color = get_post_meta($post->ID, 'staff_desc_bg_color', true);
  if(empty($staff_desc_bg_color)){
    $staff_desc_bg_color = '#000000';
  };


  // 基本設定 -------------------------------------------------------
  $staff_content_headline_font_size = get_post_meta($post->ID, 'staff_content_headline_font_size', true);
  if(empty($staff_content_headline_font_size)){
    $staff_content_headline_font_size = '18';
  };
  $staff_content_headline_font_size_mobile = get_post_meta($post->ID, 'staff_content_headline_font_size_mobile', true);
  if(empty($staff_content_headline_font_size_mobile)){
    $staff_content_headline_font_size_mobile = '15';
  };
  $staff_content_desc_font_size = get_post_meta($post->ID, 'staff_content_desc_font_size', true);
  if(empty($staff_content_desc_font_size)){
    $staff_content_desc_font_size = '16';
  };
  $staff_content_desc_font_size_mobile = get_post_meta($post->ID, 'staff_content_desc_font_size_mobile', true);
  if(empty($staff_content_desc_font_size_mobile)){
    $staff_content_desc_font_size_mobile = '14';
  };
  $staff_content_headline_font_color = get_post_meta($post->ID, 'staff_content_headline_font_color', true);
  if(empty($staff_content_headline_font_color)){
    $staff_content_headline_font_color = '#58330d';
  };
  $staff_content_headline_border_color = get_post_meta($post->ID, 'staff_content_headline_border_color', true);
  if(empty($staff_content_headline_border_color)){
    $staff_content_headline_border_color = '#ae9982';
  };


  // コンテンツ１ -------------------------------------------------------
  $show_staff_content1 = get_post_meta($post->ID, 'show_staff_content1', true);

  $staff_content1_headline = get_post_meta($post->ID, 'staff_content1_headline', true);
  $staff_content1_desc = get_post_meta($post->ID, 'staff_content1_desc', true);


  // コンテンツ２ -------------------------------------------------------
  $show_staff_content2 = get_post_meta($post->ID, 'show_staff_content2', true);

  $staff_content2_headline = get_post_meta($post->ID, 'staff_content2_headline', true);
  $staff_content2_desc = get_post_meta($post->ID, 'staff_content2_desc', true);


  $staff_content2_menu_list = get_post_meta($post->ID, 'staff_content2_menu_list', true);
  $staff_content2_menu_list_font_color = get_post_meta($post->ID, 'staff_content2_menu_list_font_color', true);
  if(empty($staff_content2_menu_list_font_color)){
    $staff_content2_menu_list_font_color = '#000000';
  };
  $staff_content2_menu_list_bg_color = get_post_meta($post->ID, 'staff_content2_menu_list_bg_color', true);
  if(empty($staff_content2_menu_list_bg_color)){
    $staff_content2_menu_list_bg_color = '#f7f7f7';
  };
  $staff_content2_menu_list_border_color = get_post_meta($post->ID, 'staff_content2_menu_list_border_color', true);
  if(empty($staff_content2_menu_list_border_color)){
    $staff_content2_menu_list_border_color = '#dddddd';
  };


  // コンテンツ３ -------------------------------------------------------
  $show_staff_content3 = get_post_meta($post->ID, 'show_staff_content3', true);

  $staff_content3_headline = get_post_meta($post->ID, 'staff_content3_headline', true);
  $staff_content3_desc = get_post_meta($post->ID, 'staff_content3_desc', true);

  $staff_schedule = get_post_meta($post->ID, 'staff_schedule', true);

  $staff_content3_header_font_color = get_post_meta($post->ID, 'staff_content3_header_font_color', true);
  if(empty($staff_content3_header_font_color)){
    $staff_content3_header_font_color = '#ffffff';
  };
  $staff_content3_header_bg_color = get_post_meta($post->ID, 'staff_content3_header_bg_color', true);
  if(empty($staff_content3_header_bg_color)){
    $staff_content3_header_bg_color = '#ad9983';
  };


  // コンテンツ４ -------------------------------------------------------
  $show_staff_content4 = get_post_meta($post->ID, 'show_staff_content4', true);
  $staff_content4_free_space = get_post_meta($post->ID, 'staff_content4_free_space', true);


  // 並び替え
  $page_content_order = get_post_meta($post->ID, 'page_content_order', true);
  if(empty($page_content_order)) {
    $page_content_order = array('content1','content2','content3','content4');
  }

  echo '<input type="hidden" name="staff_cf_custom_fields_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

  //入力欄 ***************************************************************************************************************************************************************************************
?>
<div class="tcd_custom_field_wrap">

 <div class="theme_option_field cf theme_option_field_ac">
  <h3 class="theme_option_headline"><?php _e('Header', 'tcd-w'); ?></h3>
  <div class="theme_option_field_ac_content">

   <h3 class="theme_option_headline2"><?php _e('Sub title', 'tcd-w'); ?></h3>
   <input class="full_width" type="text" name="staff_sub_title" value="<?php echo esc_attr($staff_sub_title); ?>" />

   <h3 class="theme_option_headline2"><?php _e('Position', 'tcd-w'); ?></h3>
   <input class="full_width" type="text" name="staff_position" value="<?php echo esc_attr($staff_position); ?>" />

   <h3 class="theme_option_headline2"><?php _e('SNS button', 'tcd-w'); ?></h3>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Instagram URL', 'tcd-w');  ?></span><input class="full_width" type="text" name="staff_instagram" value="<?php echo esc_attr($staff_instagram); ?>" /></li>
    <li class="cf"><span class="label"><?php _e('TikTok URL', 'tcd-w');  ?></span><input class="full_width" type="text" name="staff_tiktok" value="<?php echo esc_attr($staff_tiktok); ?>" /></li>
    <li class="cf"><span class="label"><?php _e('X URL', 'tcd-w');  ?></span><input class="full_width" type="text" name="staff_twitter" value="<?php echo esc_attr($staff_twitter); ?>" /></li>
    <li class="cf"><span class="label"><?php _e('Facebook URL', 'tcd-w');  ?></span><input class="full_width" type="text" name="staff_facebook" value="<?php echo esc_attr($staff_facebook); ?>" /></li>
   </ul>

   <h3 class="theme_option_headline2"><?php _e('Catchphrase', 'tcd-w'); ?></h3>
   <textarea class="full_width" cols="50" rows="4" name="staff_catch"><?php echo esc_textarea( $staff_catch ); ?></textarea>
   <ul class="option_list">
    <li class="cf">
     <span class="label"><?php _e('Font size', 'tcd-w'); ?></span>
     <div class="font_size_option">
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="staff_catch_font_size" value="<?php esc_attr_e( $staff_catch_font_size ); ?>"><span class="icon icon_pc"></span>
      </label>
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size_sp" type="number" name="staff_catch_font_size_mobile" value="<?php esc_attr_e( $staff_catch_font_size_mobile ); ?>"><span class="icon icon_sp"></span>
      </label>
     </div>
    </li>
    <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="staff_catch_color" value="<?php echo esc_attr($staff_catch_color); ?>" data-default-color="#d4bc9c" class="c-color-picker"></li>
   </ul>

   <h3 class="theme_option_headline2"><?php _e('Description', 'tcd-w'); ?></h3>
   <textarea class="full_width" cols="50" rows="4" name="staff_desc"><?php echo esc_textarea( $staff_desc ); ?></textarea>
   <ul class="option_list">
    <li class="cf">
     <span class="label"><?php _e('Font size', 'tcd-w'); ?></span>
     <div class="font_size_option">
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size" type="number" name="staff_desc_font_size" value="<?php esc_attr_e( $staff_desc_font_size ); ?>"><span class="icon icon_pc"></span>
      </label>
      <label class="font_size_label number_option">
       <input class="hankaku input_font_size_sp" type="number" name="staff_desc_font_size_mobile" value="<?php esc_attr_e( $staff_desc_font_size_mobile ); ?>"><span class="icon icon_sp"></span>
      </label>
     </div>
    </li>
    <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="staff_desc_color" value="<?php echo esc_attr($staff_desc_color); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
   </ul>

   <h3 class="theme_option_headline2"><?php _e('Background color of description area', 'tcd-w'); ?></h3>
   <p><input type="text" name="staff_desc_bg_color" value="<?php echo esc_attr($staff_desc_bg_color); ?>" data-default-color="#000000" class="c-color-picker"></p>

   <ul class="button_list cf">
    <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
   </ul>
  </div><!-- END .theme_option_field_ac_content -->
 </div><!-- END .theme_option_field -->

  <div class="theme_option_field cf theme_option_field_ac">
   <h3 class="theme_option_headline"><?php _e( 'Content', 'tcd-w' ); ?></h3>
   <div class="theme_option_field_ac_content">

    <h3 class="theme_option_headline2"><?php _e('Headline', 'tcd-w'); ?></h3>
    <ul class="option_list">
     <li class="cf">
      <span class="label"><?php _e('Font size', 'tcd-w'); ?></span>
      <div class="font_size_option">
       <label class="font_size_label number_option">
        <input class="hankaku input_font_size" type="number" name="staff_content_headline_font_size" value="<?php esc_attr_e( $staff_content_headline_font_size ); ?>"><span class="icon icon_pc"></span>
       </label>
       <label class="font_size_label number_option">
        <input class="hankaku input_font_size_sp" type="number" name="staff_content_headline_font_size_mobile" value="<?php esc_attr_e( $staff_content_headline_font_size_mobile ); ?>"><span class="icon icon_sp"></span>
       </label>
      </div>
     </li>
     <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="staff_content_headline_font_color" value="<?php echo esc_attr($staff_content_headline_font_color); ?>" data-default-color="#58330d" class="c-color-picker"></li>
     <li class="cf"><span class="label"><?php _e('Border color', 'tcd-w'); ?></span><input type="text" name="staff_content_headline_border_color" value="<?php echo esc_attr($staff_content_headline_border_color); ?>" data-default-color="#ae9982" class="c-color-picker"></li>
    </ul>

    <h3 class="theme_option_headline2"><?php _e('Description', 'tcd-w'); ?></h3>
    <ul class="option_list">
     <li class="cf">
      <span class="label"><?php _e('Font size', 'tcd-w'); ?></span>
      <div class="font_size_option">
       <label class="font_size_label number_option">
        <input class="hankaku input_font_size" type="number" name="staff_content_desc_font_size" value="<?php esc_attr_e( $staff_content_desc_font_size ); ?>"><span class="icon icon_pc"></span>
       </label>
       <label class="font_size_label number_option">
        <input class="hankaku input_font_size_sp" type="number" name="staff_content_desc_font_size_mobile" value="<?php esc_attr_e( $staff_content_desc_font_size_mobile ); ?>"><span class="icon icon_sp"></span>
       </label>
      </div>
     </li>
    </ul>

    <ul class="button_list cf">
     <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
    </ul>
   </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->

 <div class="theme_option_message">
  <p><?php _e('You can change order by dragging each headline of option field.', 'tcd-w');  ?></p>
 </div>

 <?php // 並び替え ----- ?>
 <div class="theme_option_field_order" style="margin-bottom:15px;">
 <?php foreach((array) $page_content_order as $page_content) : ?>

 <?php // コンテンツ１ ----------------------------------------------------- ?>
 <?php if ($page_content == 'content1') : ?>
  <div class="theme_option_field cf theme_option_field_ac">
   <h3 class="theme_option_headline"><?php _e('Headline content', 'tcd-w'); ?></h3>
   <div class="theme_option_field_ac_content">

    <p><label for="show_staff_content1"><input type="checkbox" name="show_staff_content1" value="1" <?php checked( $show_staff_content1, 1 ); ?>><?php _e('Display headline content', 'tcd-w'); ?></label></p>

    <h3 class="theme_option_headline2"><?php _e('Headline', 'tcd-w'); ?></h3>
    <input class="full_width" type="text" name="staff_content1_headline" value="<?php echo esc_attr($staff_content1_headline); ?>" />

    <h3 class="theme_option_headline2"><?php _e('Description', 'tcd-w'); ?></h3>
    <?php wp_editor( $staff_content1_desc, 'staff_content1_desc', array( 'textarea_name' => 'staff_content1_desc', 'textarea_rows' => 10 )); ?>

    <ul class="button_list cf">
     <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
    </ul>

    <input type="hidden" name="page_content_order[]" value="content1" />
   </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->
 <?php endif; ?>


 <?php // コンテンツ２ ----------------------------------------------------- ?>
 <?php if ($page_content == 'content2') : ?>
  <div class="theme_option_field cf theme_option_field_ac">
   <h3 class="theme_option_headline"><?php _e('Four column table content', 'tcd-w'); ?></h3>
   <div class="theme_option_field_ac_content">

    <p><label for="show_staff_content2"><input type="checkbox" name="show_staff_content2" value="1" <?php checked( $show_staff_content2, 1 ); ?>><?php _e('Display four column table content', 'tcd-w'); ?></label></p>

    <div class="theme_option_message2">
     <p><?php _e('The menu item will be displayed in 4 column in PC, and 2 column in mobile device size.', 'tcd-w'); ?></p>
    </div>

    <h3 class="theme_option_headline2"><?php _e('Headline', 'tcd-w'); ?></h3>
    <input class="full_width" type="text" name="staff_content2_headline" value="<?php echo esc_attr($staff_content2_headline); ?>" />

    <?php // メニュー一覧 ---------- ?>
    <h3 class="theme_option_headline2"><?php _e('Menu list', 'tcd-w'); ?></h3>
    <ul class="option_list">
     <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="staff_content2_menu_list_font_color" value="<?php echo esc_attr($staff_content2_menu_list_font_color); ?>" data-default-color="#000000" class="c-color-picker"></li>
     <li class="cf"><span class="label"><?php _e('Background color', 'tcd-w'); ?></span><input type="text" name="staff_content2_menu_list_bg_color" value="<?php echo esc_attr($staff_content2_menu_list_bg_color); ?>" data-default-color="#f7f7f7" class="c-color-picker"></li>
     <li class="cf"><span class="label"><?php _e('Border color', 'tcd-w'); ?></span><input type="text" name="staff_content2_menu_list_border_color" value="<?php echo esc_attr($staff_content2_menu_list_border_color); ?>" data-default-color="#dddddd" class="c-color-picker"></li>
    </ul>

    <div class="theme_option_message2">
     <p><?php _e('You can change order by dragging each item.', 'tcd-w'); ?></p>
    </div>

    <?php //繰り返しフィールド ----- ?>
    <div class="repeater-wrapper">
     <div class="repeater sortable" data-delete-confirm="<?php _e( 'Delete?', 'tcd-w' ); ?>">
      <?php
           if ( $staff_content2_menu_list ) :
             foreach ( $staff_content2_menu_list as $key => $value ) :
      ?>
      <div class="sub_box repeater-item repeater-item-<?php echo $key; ?>">
       <h4 class="theme_option_subbox_headline"><?php _e( 'New item', 'tcd-w' ); ?></h4>
       <div class="sub_box_content">
        <h4 class="theme_option_headline2"><?php _e( 'Menu', 'tcd-w' ); ?></h4>
        <p><input class="repeater-label full_width" type="text" name="staff_content2_menu_list[<?php echo esc_attr( $key ); ?>][title]" value="<?php echo esc_attr( isset( $staff_content2_menu_list[$key]['title'] ) ? $staff_content2_menu_list[$key]['title'] : '' ); ?>" style="width:100%" /></p>
        <p class="delete-row right-align"><a href="#" class="button button-secondary button-delete-row"><?php _e( 'Delete item', 'tcd-w' ); ?></a></p>
       </div><!-- END .sub_box_content -->
      </div><!-- END .sub_box -->
      <?php
             endforeach;
           endif;
           $key = 'addindex';
           ob_start();
      ?>
      <div class="sub_box repeater-item repeater-item-<?php echo $key; ?>">
       <h4 class="theme_option_subbox_headline"><?php _e( 'New item', 'tcd-w' ); ?></h4>
       <div class="sub_box_content">
        <h4 class="theme_option_headline2"><?php _e( 'Menu', 'tcd-w' ); ?></h4>
        <p><input class="repeater-label full_width" type="text" name="staff_content2_menu_list[<?php echo esc_attr( $key ); ?>][title]" value="<?php echo esc_attr( isset( $staff_content2_menu_list[$key]['title'] ) ? $staff_content2_menu_list[$key]['title'] : '' ); ?>" style="width:100%" /></p>
        <p class="delete-row right-align"><a href="#" class="button button-secondary button-delete-row"><?php _e( 'Delete item', 'tcd-w' ); ?></a></p>
       </div><!-- END .sub_box_content -->
      </div><!-- END .sub_box -->
      <?php
           $clone = ob_get_clean();
      ?>
     </div><!-- END .repeater -->
     <a href="#" class="button button-secondary button-add-row" data-clone="<?php echo esc_attr( $clone ); ?>"><?php _e( 'Add item', 'tcd-w' ); ?></a>
    </div><!-- END .repeater-wrapper -->
    <?php // 繰り返しフィールドここまで ----- ?>

    <h3 class="theme_option_headline2"><?php _e('Description', 'tcd-w'); ?></h3>
    <?php wp_editor( $staff_content2_desc, 'staff_content2_desc', array( 'textarea_name' => 'staff_content2_desc', 'textarea_rows' => 10 )); ?>

    <ul class="button_list cf">
     <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
    </ul>
    <input type="hidden" name="page_content_order[]" value="content2" />
   </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->
 <?php endif; ?>


 <?php // コンテンツ３ ----------------------------------------------------- ?>
 <?php if ($page_content == 'content3') : ?>
  <div class="theme_option_field cf theme_option_field_ac">
   <h3 class="theme_option_headline"><?php _e('Scedule content', 'tcd-w'); ?></h3>
   <div class="theme_option_field_ac_content">

    <p><label for="show_staff_content3"><input type="checkbox" name="show_staff_content3" value="1" <?php checked( $show_staff_content3, 1 ); ?>><?php _e('Display scedule content', 'tcd-w'); ?></label></p>

    <h3 class="theme_option_headline2"><?php _e('Headline', 'tcd-w'); ?></h3>
    <input class="full_width" type="text" name="staff_content3_headline" value="<?php echo esc_attr($staff_content3_headline); ?>" />

    <?php // メニュー一覧 ---------- ?>
    <h3 class="theme_option_headline2"><?php _e('Schedule list', 'tcd-w'); ?></h3>
    <ul class="option_list">
     <li class="cf"><span class="label"><?php _e('Font color of list header', 'tcd-w'); ?></span><input type="text" name="staff_content3_header_font_color" value="<?php echo esc_attr($staff_content3_header_font_color); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
     <li class="cf"><span class="label"><?php _e('Background color of list header', 'tcd-w'); ?></span><input type="text" name="staff_content3_header_bg_color" value="<?php echo esc_attr($staff_content3_header_bg_color); ?>" data-default-color="#ad9983" class="c-color-picker"></li>
    </ul>

    <h3 class="theme_option_headline2"><?php _e('Schedule list', 'tcd-w'); ?></h3>
    <div id="schedule_calendar" data-post-id="<?php echo esc_attr( $post->ID ); ?>">
     <?php echo get_admin_staff_schedule_calender( $post->ID ); ?>
    </div>

    <h3 class="theme_option_headline2"><?php _e('Description', 'tcd-w'); ?></h3>
    <?php wp_editor( $staff_content3_desc, 'staff_content3_desc', array( 'textarea_name' => 'staff_content3_desc', 'textarea_rows' => 10 )); ?>

    <ul class="button_list cf">
     <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
    </ul>
    <input type="hidden" name="page_content_order[]" value="content3" />
   </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->
 <?php endif; ?>


 <?php // コンテンツ４ ----------------------------------------------------- ?>
 <?php if ($page_content == 'content4') : ?>
  <div class="theme_option_field cf theme_option_field_ac">
   <h3 class="theme_option_headline"><?php _e('Free space', 'tcd-w'); ?></h3>
   <div class="theme_option_field_ac_content">

    <p><label for="show_staff_content4"><input id="show_staff_content4" type="checkbox" name="show_staff_content4" value="1" <?php checked( $show_staff_content4, 1 ); ?>><?php _e('Display free space', 'tcd-w'); ?></label></p>

    <h3 class="theme_option_headline2"><?php _e('Free space setting', 'tcd-w'); ?></h3>
    <?php wp_editor( $staff_content4_free_space, 'staff_content4_free_space', array( 'textarea_name' => 'staff_content4_free_space', 'textarea_rows' => 10 )); ?>

    <ul class="button_list cf">
     <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
    </ul>
    <input type="hidden" name="page_content_order[]" value="content4" />
   </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->
 <?php endif; ?>


 <?php endforeach; // 並び替えここまで ?>
 </div><!-- END .theme_option_field_order -->

</div><!-- END .tcd_custom_field_wrap -->

<?php
}

function save_staff_cf_meta_box( $post_id ) {

  // verify nonce
  if (!isset($_POST['staff_cf_custom_fields_meta_box_nonce']) || !wp_verify_nonce($_POST['staff_cf_custom_fields_meta_box_nonce'], basename(__FILE__))) {
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
    'staff_sub_title','staff_position','staff_instagram','staff_twitter','staff_facebook','staff_tiktok','staff_desc_bg_color',
    'staff_catch','staff_catch_font_size','staff_catch_font_size_mobile','staff_catch_color',
    'staff_desc','staff_desc_font_size','staff_desc_font_size_mobile','staff_desc_color',
    'staff_content_headline_font_size','staff_content_headline_font_size_mobile','staff_content_desc_font_size','staff_content_desc_font_size_mobile','staff_content_headline_font_color','staff_content_headline_border_color',
    'show_staff_content1',
    'staff_content1_headline','staff_content1_desc',
    'show_staff_content2',
    'staff_content2_headline','staff_content2_desc',
    'staff_content2_menu_list_font_color','staff_content2_menu_list_bg_color','staff_content2_menu_list_border_color',
    'show_staff_content3',
    'staff_content3_headline','staff_content3_desc',
    'staff_content3_header_font_color','staff_content3_header_bg_color',
    'show_staff_content4',
    'staff_content4_free_space'
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

  // repeater save or delete
  $cf_keys = array( 'page_content_order', 'staff_content2_menu_list');
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
add_action('save_post', 'save_staff_cf_meta_box');


// 管理画面 カレンダー出力
function get_admin_staff_schedule_calender( $post_id, $year = null, $month = null ) {
	global $wp_locale;

	if ( ! $post_id || ! current_user_can( 'edit_post', $post_id ) )
		return false;

	$calendar_output = '';

	$current_ts = current_time( 'timestamp', false );
	$year = intval( $year );
	$month = intval( $month );

	if ( ! $year )
		$year = intval( date( 'Y', $current_ts ) );

	if ( ! $month )
		$month = intval( date( 'n', $current_ts ) );

	$month_first_day_ts = mktime( 0, 0, 0, $month, 1, $year );

	// week_begins = 0 stands for Sunday
	$week_begins = (int) get_option( 'start_of_week' );

	// calendar caption, WordPress標準の翻訳を使用
	$calendar_caption = sprintf( _x('%1$s %2$s', 'calendar caption'), $wp_locale->get_month( $month ), $year );

	$calendar_output .= '<input type="hidden" class="calender-nonce" value="' . esc_attr( wp_create_nonce( 'calender_nonce-' . $post_id ) ) . '">';
	$calendar_output .= '<input type="hidden" class="calender-year" value="' . $year . '">';
	$calendar_output .= '<input type="hidden" class="calender-month" value="' . $month . '">';
	$calendar_output .= '<h3 class="wp-clearfix"><a href="#" class="prev"></a><span class="date">' . esc_html( $calendar_caption ) . '</span><a href="#" class="next"></a></h3>';
	// table start
	$calendar_output .= '<table>';

	// thead
	$calendar_output .= '<tr>';
	$calendar_output .= '<thead>';

	$wd_names = array();
	for ( $i = 0; $i <= 6; $i++ ) {
		$wd_names[] = $wp_locale->get_weekday( ( $i + $week_begins ) % 7 );
	}
	foreach ( $wd_names as $wd_name ) {
		$calendar_output .= '<th scope="col">' . $wp_locale->get_weekday_abbrev( $wd_name ) . '</th>';
	}

	$calendar_output .= '</tr>';
	$calendar_output .= '</thead>';

	// tbody
	$calendar_output .= '<tbody>';
	$calendar_output .= '<tr>';
	$col = 0;

	// 1日より前の穴埋め
	$pad = calendar_week_mod( date( 'w', $month_first_day_ts ) - $week_begins );
	for ( $i = 1; $i <= $pad; $i++ ) {
		$calendar_output .= '<td><span class="num"></span></td>';
		$col++;
	}

	for ( $day = 1; $day <= date( 't', $month_first_day_ts ); $day++ ) {
		if ( 6 < $col ) {
			$calendar_output .= '</tr><tr>';
			$col = 0;
		}

		$meta_key = sprintf( '_schedule_%04d%02d%02d', $year, $month, $day );
		$meta = get_post_meta( $post_id, $meta_key, true );
		if ( ! $meta || ! is_array( $meta ) )
			$meta = array();
		$meta = array_merge( array(
			'bg_color' => '#ffffff',
			'memo' => ''
		), $meta );

		$calendar_output .= '<td data-day="' . $day . '" style="backgeound-color: ' . esc_attr( $meta['bg_color'] ) . ';">';
		$calendar_output .= '<div class="num">' . $day . '</div>';
		$calendar_output .= '<div class="color"><input class="schedule-color-picker schedule-bg-color" type="text" value="' . esc_attr( $meta['bg_color'] ) . '" data-default-color="#ffffff"></div>';
		$calendar_output .= '<div class="memo"><textarea class="large-text schedule-memo" rows="2">' . esc_textarea( $meta['memo'] ) . '</textarea></div>';
		$calendar_output .= '</td>';

		$col++;
	}

	// 最終日以降の穴埋め
	while ( 6 >= $col ) {
		$calendar_output .= '<td><span class="num"></span></td>';
		$col++;
	}

	$calendar_output .= '</tr>';
	$calendar_output .= '</tbody>';

	// table end
	$calendar_output .= '</table>';

	return $calendar_output;
}

// 管理画面 Ajaxでのカレンダー取得
function ajax_get_admin_staff_schedule_calender() {
	$json = array();

	if ( ! empty( $_POST['post_id'] ) && ! empty( $_POST['nonce'] ) && ! empty( $_POST['year'] ) && ! empty( $_POST['month'] ) && current_user_can( 'edit_post', $_POST['post_id'] ) ) {
		if ( wp_verify_nonce( $_POST['nonce'], 'calender_nonce-' . $_POST['post_id'] ) ) {
			$json['html'] = get_admin_staff_schedule_calender( $_POST['post_id'], $_POST['year'], $_POST['month'] ) ;
		} else {
			$json['message'] = __( 'Invalid nonce', 'tcd-w' );
		}
	} else {
		$json['message'] = __( 'Invalid request', 'tcd-w' );
	}

	wp_send_json( $json );
	exit;
}
add_action( 'wp_ajax_get_admin_schedule_calender', 'ajax_get_admin_staff_schedule_calender' );

// 管理画面 Ajaxでのスケジュール保存
function ajax_save_admin_schedule_calender() {
	$json = array();

	if ( ! empty( $_POST['post_id'] ) && ! empty( $_POST['nonce'] ) && ! empty( $_POST['year'] ) && ! empty( $_POST['month'] ) && ! empty( $_POST['day'] ) && isset( $_POST['bg_color'], $_POST['memo'] ) && current_user_can( 'edit_post', $_POST['post_id'] ) ) {
		if ( wp_verify_nonce( $_POST['nonce'], 'calender_nonce-' . $_POST['post_id'] ) ) {
			$meta_key = sprintf( '_schedule_%04d%02d%02d', absint( $_POST['year'] ), absint( $_POST['month'] ), absint( $_POST['day'] ) );
			$meta = array(
				'bg_color' => $_POST['bg_color'],
				'memo' => trim( $_POST['memo'] )
			);
			$result = update_post_meta( absint( $_POST['post_id'] ), $meta_key, $meta );
			if ( $result ) {
				$json['success'] = true;
			} else {
				$json['message'] = __( 'Failed to save schedule', 'tcd-w' );
			}
		} else {
			$json['message'] = __( 'Invalid nonce', 'tcd-w' );
		}
	} else {
		$json['message'] = __( 'Invalid request', 'tcd-w' );
	}

	wp_send_json( $json );
	exit;
}
add_action( 'wp_ajax_save_admin_schedule_calender', 'ajax_save_admin_schedule_calender' );
