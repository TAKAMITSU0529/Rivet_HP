<?php
/*
 * ギャラリーの設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_gallery_dp_default_options' );


// Add label of logo tab
add_action( 'tcd_tab_labels', 'add_gallery_tab_label' );


// Add HTML of logo tab
add_action( 'tcd_tab_panel', 'add_gallery_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_gallery_theme_options_validate' );


// タブの名前
function add_gallery_tab_label( $tab_labels ) {
  $options = get_design_plus_option();
  if($options['use_gallery']){
    $tab_label = $options['gallery_label'] ? esc_html( $options['gallery_label'] ) : __( 'Guest room', 'tcd-canon' );
  } else {
    $title = $options['gallery_label'] ? esc_html( $options['gallery_label'] ) : __( 'Guest room', 'tcd-canon' );
    $tab_label = __('(N/A) ', 'tcd-canon') . $title;
  }
  $tab_labels['gallery'] = $tab_label;
  return $tab_labels;
}


// 初期値
function add_gallery_dp_default_options( $dp_default_options ) {

	// 基本設定
	$dp_default_options['use_gallery'] = '1';
	$dp_default_options['gallery_label'] = __( 'Guest room', 'tcd-canon' );
	$dp_default_options['gallery_slug'] = 'room';
	$dp_default_options['gallery_use_category'] = 'yes';

	// アーカイブページ
	$dp_default_options['gallery_show_header'] = '1';
	$dp_default_options['archive_gallery_catch'] = __( 'Catchphrase', 'tcd-canon' );
	$dp_default_options['archive_gallery_desc'] = __( 'Description will be displayed here.', 'tcd-canon' );
	$dp_default_options['archive_gallery_desc_mobile'] = '';
	$dp_default_options['archive_gallery_header_image'] = false;
	$dp_default_options['archive_gallery_overlay_color'] = '#000000';
	$dp_default_options['archive_gallery_overlay_opacity'] = '0.3';
	$dp_default_options['archive_gallery_non_category_num'] = '6';
	$dp_default_options['archive_gallery_non_category_num_sp'] = '4';

  // カテゴリーページ
	$dp_default_options['archive_gallery_headline'] = __( 'Guest room type', 'tcd-canon' );
	$dp_default_options['archive_gallery_num'] = '4';
	$dp_default_options['archive_gallery_num_sp'] = '4';
	$dp_default_options['archive_gallery_post_list_order_new'] = array(
    array(
      "name" => 'plan_list',
    ),
    array(
      "name" => 'gallery_list',
    ),
  );

	// 詳細ページ
	$dp_default_options['show_recent_gallery'] = 1;
	$dp_default_options['recent_gallery_headline'] = __( 'Other guest room', 'tcd-canon' );
	$dp_default_options['recent_gallery_num'] = '6';
	$dp_default_options['recent_gallery_num_sp'] = '4';
	$dp_default_options['single_gallery_post_list_order_new'] = array(
    array(
      "name" => 'plan_list',
    ),
    array(
      "name" => 'gallery_list',
    ),
  );

	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_gallery_tab_panel( $options ) {

  global $dp_default_options, $font_type_options, $basic_display_options, $gallery_category_type_options, $blog_label;
  $gallery_label = $options['gallery_label'] ? esc_html( $options['gallery_label'] ) : __( 'Guest room', 'tcd-canon' );
  $service_label = $options['service_label'] ? esc_html( $options['service_label'] ) : __( 'Service', 'tcd-canon' );

?>

<div id="tab-content-gallery" class="tab-content">


   <?php // 有効化 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac active open custon_post_usage_option">
    <h3 class="theme_option_headline"><?php _e('Validation', 'tcd-canon');  ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="theme_option_message2 custon_post_usage_option_message" style="<?php if($options['use_gallery']){ echo 'display:none;'; } else { echo 'display:block;'; }; ?>">
      <p><?php printf(__('Currently, all function related to custom post "%s" have been disabled.<br>All areas that have already been set up will be hidden from the site.<br>Please use this option only if you don\'t want to use the custom post "%s" at all. (No archive page will be generated either).', 'tcd-canon'), $gallery_label, $gallery_label); ?></p>
     </div>
     <div class="theme_option_message2" style="<?php if($options['use_gallery']){ echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <p><?php printf(__('Please check off the checkbox if you don\'t want to use custom post "%s".', 'tcd-canon'), $gallery_label); ?></p>
     </div>
     <p><label><input class="custon_post_usage_option_checkbox" name="dp_options[use_gallery]" type="checkbox" value="1" <?php checked( 1, $options['use_gallery'] ); ?>><?php printf(__('Use custom post "%s"', 'tcd-canon'), $gallery_label); ?></label></p>

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
     <input type="text" name="dp_options[gallery_label]" value="<?php echo esc_attr( $options['gallery_label'] ); ?>" />

     <h4 class="theme_option_headline_number"><span class="num">2</span><?php _e('Slug', 'tcd-canon'); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('Please enter word by alphabet only.<br />After changing slug, please update permalink setting form <a href="./options-permalink.php"><strong>permalink option page</strong></a>.', 'tcd-canon'); ?></p>
     </div>
     <p><input class="hankaku" type="text" name="dp_options[gallery_slug]" value="<?php echo sanitize_title( $options['gallery_slug'] ); ?>" /></p>

     <h4 class="theme_option_headline2"><?php _e('Category', 'tcd-canon');  ?></h4>
     <div class="theme_option_message2 gallery_category_option">
      <p><?php _e('When using a category, Category page will be generated. Please set the category from the <a href="./edit-tags.php?taxonomy=gallery_category&post_type=gallery" target="_blank">category edit screen</a>.', 'tcd-canon'); ?></p>
     </div>
     <div class="theme_option_message2 gallery_non_category_option">
      <p><?php _e('When using a category, Category page will be generated. Please set the category from the category edit screen.', 'tcd-canon'); ?></p>
     </div>
     <div class="standard_radio_button" style="float:none; width:auto;">
      <input id="gallery_use_category_yes" type="radio" name="dp_options[gallery_use_category]" value="yes" <?php checked( $options['gallery_use_category'], 'yes' ); ?>>
      <label for="gallery_use_category_yes"><?php _e('Use', 'tcd-canon'); ?></label>
      <input id="gallery_use_category_no" type="radio" name="dp_options[gallery_use_category]" value="no" <?php checked( $options['gallery_use_category'], 'no' ); ?>>
      <label for="gallery_use_category_no"><?php _e('Don\'t use', 'tcd-canon'); ?></label>
     </div>
     <br style="clear:both;">

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
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/image/gallery_archive.jpg?1.3" alt="" title="" />
     </div>

     <p><label><input class="display_option" data-option-name="gallery_show_header" name="dp_options[gallery_show_header]" type="checkbox" value="1" <?php checked( $options['gallery_show_header'], 1 ); ?>><?php _e( 'Display header area', 'tcd-canon' ); ?></label></p>

     <ul class="option_list">
      <li class="cf" style="border-top:1px dotted #ccc;"><span class="label"><span class="num">1</span><?php _e('Catchphrase', 'tcd-canon'); ?></span><textarea class="full_width" cols="50" rows="3" name="dp_options[archive_gallery_catch]"><?php echo esc_textarea(  $options['archive_gallery_catch'] ); ?></textarea></li>
      <li class="cf"><span class="label"><span class="num">2</span><?php _e('Description', 'tcd-canon'); ?></span><textarea class="full_width" cols="50" rows="3" name="dp_options[archive_gallery_desc]"><?php echo esc_textarea(  $options['archive_gallery_desc'] ); ?></textarea></li>
      <li class="cf space"><span class="label"><?php _e('Description (mobile)', 'tcd-canon'); ?></span><textarea placeholder="<?php _e( 'Please indicate if you would like to display a short text for mobile sizes.', 'tcd-canon' ); ?>" class="full_width" cols="50" rows="3" name="dp_options[archive_gallery_desc_mobile]"><?php echo esc_textarea(  $options['archive_gallery_desc_mobile'] ); ?></textarea></li>
      <li class="cf gallery_show_header">
       <span class="label">
        <span class="num">3</span><?php _e('Image', 'tcd-canon'); ?>
        <span class="recommend_desc space"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-canon'), '1400', '600'); ?></span>
        <span class="recommend_desc space"><?php _e('This image will also be used in article page.', 'tcd-canon'); ?></span>
       </span>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js archive_gallery_header_image">
         <input type="hidden" value="<?php echo esc_attr( $options['archive_gallery_header_image'] ); ?>" id="archive_gallery_header_image" name="dp_options[archive_gallery_header_image]" class="cf_media_id">
         <div class="preview_field"><?php if($options['archive_gallery_header_image']){ echo wp_get_attachment_image($options['archive_gallery_header_image'], 'medium'); }; ?></div>
         <div class="buttton_area">
          <input type="button" value="<?php _e('Select Image', 'tcd-canon'); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e('Remove Image', 'tcd-canon'); ?>" class="cfmf-delete-img button <?php if(!$options['archive_gallery_header_image']){ echo 'hidden'; }; ?>">
         </div>
        </div>
       </div>
      </li>
      <li class="cf space gallery_show_header">
       <span class="label"><?php _e('Color of overlay', 'tcd-canon'); ?></span><input type="text" name="dp_options[archive_gallery_overlay_color]" value="<?php echo esc_attr( $options['archive_gallery_overlay_color'] ); ?>" data-default-color="#000000" class="c-color-picker">
      </li>
      <li class="cf space gallery_show_header">
       <span class="label"><?php _e('Transparency of overlay', 'tcd-canon'); ?></span><input class="hankaku" style="width:70px;" type="number" step="0.1" min="0" max="1" name="dp_options[archive_gallery_overlay_opacity]" value="<?php echo esc_attr( $options['archive_gallery_overlay_opacity'] ); ?>" />
       <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
        <p><?php _e('Please specify the number of 0 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-canon');  ?>
        <?php _e('Please enter 0 if you don\'t want to use overlay.', 'tcd-canon');  ?></p>
       </div>
      </li>
     </ul>

     <div class="gallery_non_category_option">
      <h4 class="theme_option_headline2"><?php printf(__('%s list', 'tcd-canon'), $gallery_label); ?></h4>
      <ul class="option_list">
       <li class="cf"><span class="label"><?php _e('Number of post to display', 'tcd-canon'); ?></span><?php echo tcd_display_post_num_option_type2($options, 'archive_gallery_non_category_num'); ?></li>
      </ul>
     </div>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-canon' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-canon' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <div class="gallery_category_option">

   <?php // カテゴリーページ ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Category page', 'tcd-canon'); ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="front_page_image">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/image/gallery_category_page.jpg" alt="" title="" />
     </div>

     <div class="theme_option_message2">
      <p><?php _e('You can change order by dragging each headline of option field.', 'tcd-canon');  ?><br>
     </div>

     <?php //並び替え ----- ?>
     <div class="repeater-wrapper">
      <input type="hidden" name="dp_options[archive_gallery_post_list_order_new]" value="">
      <div class="repeater sortable" data-delete-confirm="<?php _e( 'Delete this data?', 'tcd-beyond' ); ?>">
       <?php
            if ( $options['archive_gallery_post_list_order_new'] ) :
              foreach ( $options['archive_gallery_post_list_order_new'] as $key => $value ) :
                if($value['name'] == 'plan_list'){
       ?>
       <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $key ); ?>">
        <h4 class="theme_option_subbox_headline"><?php printf(__('%s list', 'tcd-canon'), $blog_label); ?></h4>
        <div class="sub_box_content">
         <div class="front_page_image">
          <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/image/plan_list.jpg" alt="" title="" />
         </div>
         <div class="theme_option_message2">
          <p>
           <?php printf(__('From each <a href="./edit-tags.php?taxonomy=gallery_category&post_type=gallery" target="_blank">%s category page</a>, please set %s list to be displayed for each category.', 'tcd-canon'), $gallery_label, $blog_label); ?><br>
           <?php printf(__('%s list will not be displayed if article is not registered.', 'tcd-canon'),$blog_label); ?>
          </p>
         </div>
         <input class="hide" type="hidden" name="dp_options[archive_gallery_post_list_order_new][<?php echo esc_attr( $key ); ?>][name]" value="plan_list" />
        </div><!-- END .sub_box_content -->
       </div><!-- END .sub_box -->
       <?php } elseif($value['name'] == 'gallery_list') { ?>
       <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $key ); ?>">
        <h4 class="theme_option_subbox_headline"><?php printf(__('%s list', 'tcd-canon'), $gallery_label); ?></h4>
        <div class="sub_box_content">
         <div class="front_page_image">
          <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/image/gallery_category_post_list.jpg" alt="" title="" />
         </div>
         <div class="theme_option_message2">
          <p><?php printf(__('Articles will be displayed in the same order as they appear in the <a href="./edit.php?post_type=%s" target="_blank">%s admin page</a>. They can be reordered by dragging and dropping.', 'tcd-canon'), 'gallery', $gallery_label); ?></p>
         </div>
         <ul class="option_list">
          <li class="cf"><span class="label"><span class="num">1</span><?php _e('Headline', 'tcd-canon');  ?></span><input class="full_width" type="text" placeholder="<?php _e( 'e.g.', 'tcd-canon' ); _e( 'Gallery type', 'tcd-canon' ); ?>" name="dp_options[archive_gallery_headline]" value="<?php echo esc_attr($options['archive_gallery_headline']); ?>"></li>
          <li class="cf"><span class="label"><span class="num">2</span><?php _e('Number of post to display', 'tcd-canon'); ?></span><?php echo tcd_display_post_num_option_type2($options, 'archive_gallery_num'); ?></li>
         </ul>
         <input class="hide" type="hidden" name="dp_options[archive_gallery_post_list_order_new][<?php echo esc_attr( $key ); ?>][name]" value="gallery_list" />
        </div><!-- END .sub_box_content -->
       </div><!-- END .sub_box -->
       <?php
                };
              endforeach;
            endif;
       ?>
      </div><!-- END .repeater -->
     </div><!-- END .repeater-wrapper -->
     <?php //繰り返しフィールドここまで ----- ?>


     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-canon' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-canon' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->

   </div>

   <?php // 詳細ページの設定 ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php printf(__('%s page', 'tcd-canon'), $gallery_label); ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="front_page_image">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/image/gallery_single_page.jpg" alt="" title="" />
     </div>

     <div class="theme_option_message2">
      <p><?php _e('You can change order by dragging each headline of option field.', 'tcd-canon');  ?><br>
     </div>

     <?php //並び替え ----- ?>
     <div class="repeater-wrapper">
      <input type="hidden" name="dp_options[single_gallery_post_list_order_new]" value="">
      <div class="repeater sortable" data-delete-confirm="<?php _e( 'Delete this data?', 'tcd-beyond' ); ?>">
       <?php
            if ( $options['single_gallery_post_list_order_new'] ) :
              foreach ( $options['single_gallery_post_list_order_new'] as $key => $value ) :
                if($value['name'] == 'plan_list'){
       ?>
       <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $key ); ?>">
        <h4 class="theme_option_subbox_headline"><?php printf(__('%s list', 'tcd-canon'), $blog_label); ?></h4>
        <div class="sub_box_content">
         <div class="front_page_image">
          <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/image/plan_list.jpg" alt="" title="" />
         </div>
         <div class="theme_option_message2">
          <p><?php printf(__('%1$s post to be displayed in %2$s page can be set on the <a href="./edit.php" target="_blank">edit screen</a> for each %3$s post.<br>If the article is not set, it will not be displayed.', 'tcd-canon'), $blog_label, $gallery_label, $blog_label); ?></p>
         </div>
         <input class="hide" type="hidden" name="dp_options[single_gallery_post_list_order_new][<?php echo esc_attr( $key ); ?>][name]" value="plan_list" />
        </div><!-- END .sub_box_content -->
       </div><!-- END .sub_box -->
       <?php } elseif($value['name'] == 'gallery_list') { ?>
       <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $key ); ?>">
        <h4 class="theme_option_subbox_headline"><?php printf(__('%s list', 'tcd-canon'), $gallery_label); ?></h4>
        <div class="sub_box_content">
         <div class="front_page_image">
          <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/image/gallery_recent.jpg" alt="" title="" />
         </div>
         <div class="theme_option_message2">
          <p><?php printf(__('Articles will be displayed in the same order as they appear in the <a href="./edit.php?post_type=%s" target="_blank">%s admin page</a>. They can be reordered by dragging and dropping.', 'tcd-canon'), 'gallery', $gallery_label); ?>
          <br><?php printf(__('If category is registered for an article, articles in the same category will be displayed in the %s list.', 'tcd-canon'), $gallery_label) ?><br>
         </div>
         <p class="displayment_checkbox"><label><input name="dp_options[show_recent_gallery]" type="checkbox" value="1" <?php checked( $options['show_recent_gallery'], 1 ); ?>><?php printf(__('Display %s list', 'tcd-canon'), $gallery_label); ?></label></p>
         <div style="<?php if($options['show_recent_gallery'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
          <ul class="option_list">
           <li class="cf" style="border-top:1px dotted #ccc;"><span class="label"><span class="num">1</span><?php _e('Headline', 'tcd-canon');  ?></span><input class="full_width" type="text" placeholder="<?php _e( 'e.g.', 'tcd-canon' ); _e( 'Other gallery', 'tcd-canon' ); ?>" name="dp_options[recent_gallery_headline]" value="<?php echo esc_attr($options['recent_gallery_headline']); ?>"></li>
           <li class="cf"><span class="label"><span class="num">2</span><?php _e('Number of post to display', 'tcd-canon'); ?></span><?php echo tcd_display_post_num_option_type2($options, 'recent_gallery_num'); ?></li>
          </ul>
         </div>
         <input class="hide" type="hidden" name="dp_options[single_gallery_post_list_order_new][<?php echo esc_attr( $key ); ?>][name]" value="gallery_list" />
        </div><!-- END .sub_box_content -->
       </div><!-- END .sub_box -->
       <?php
                };
              endforeach;
            endif;
       ?>
      </div><!-- END .repeater -->
     </div><!-- END .repeater-wrapper -->
     <?php //繰り返しフィールドここまで ----- ?>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-canon' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-canon' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


</div><!-- END .tab-content -->

<?php
} // END add_gallery_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_gallery_theme_options_validate( $input ) {

  global $dp_default_options, $font_type_options;

  //基本設定
  $input['use_gallery'] = wp_filter_nohtml_kses( $input['use_gallery'] );
  $input['gallery_slug'] = sanitize_title( $input['gallery_slug'] );
  $input['gallery_label'] = wp_filter_nohtml_kses( $input['gallery_label'] );
  $input['gallery_use_category'] = wp_filter_nohtml_kses( $input['gallery_use_category'] );

  // アーカイブ
  $input['gallery_show_header'] = wp_filter_nohtml_kses( $input['gallery_show_header'] );
  $input['archive_gallery_catch'] = wp_filter_nohtml_kses( $input['archive_gallery_catch'] );
  $input['archive_gallery_desc'] = wp_kses_post( $input['archive_gallery_desc'] );
  $input['archive_gallery_desc_mobile'] = wp_kses_post( $input['archive_gallery_desc_mobile'] );
  $input['archive_gallery_header_image'] = wp_filter_nohtml_kses( $input['archive_gallery_header_image'] );
  $input['archive_gallery_overlay_color'] = wp_filter_nohtml_kses( $input['archive_gallery_overlay_color'] );
  $input['archive_gallery_overlay_opacity'] = wp_filter_nohtml_kses( $input['archive_gallery_overlay_opacity'] );
  $input['archive_gallery_non_category_num'] = wp_filter_nohtml_kses( $input['archive_gallery_non_category_num'] );
  $input['archive_gallery_non_category_num_sp'] = wp_filter_nohtml_kses( $input['archive_gallery_non_category_num_sp'] );

  // プラン一覧
  $input['archive_gallery_headline'] = wp_filter_nohtml_kses( $input['archive_gallery_headline'] );
  $input['archive_gallery_num'] = wp_filter_nohtml_kses( $input['archive_gallery_num'] );
  $input['archive_gallery_num_sp'] = wp_filter_nohtml_kses( $input['archive_gallery_num_sp'] );

  $archive_gallery_post_list_order_new = array();
  if ( isset( $input['archive_gallery_post_list_order_new'] ) && is_array( $input['archive_gallery_post_list_order_new'] ) ) {
    foreach ( $input['archive_gallery_post_list_order_new'] as $key => $value ) {
      $archive_gallery_post_list_order_new[] = array(
        'name' => isset( $input['archive_gallery_post_list_order_new'][$key]['name'] ) ? wp_filter_nohtml_kses( $input['archive_gallery_post_list_order_new'][$key]['name'] ) : '',
      );
    }
  };
  $input['archive_gallery_post_list_order_new'] = $archive_gallery_post_list_order_new;


  //詳細ページ
  $input['show_recent_gallery'] = wp_filter_nohtml_kses( $input['show_recent_gallery'] );
  $input['recent_gallery_headline'] = wp_filter_nohtml_kses( $input['recent_gallery_headline'] );
  $input['recent_gallery_num'] = wp_filter_nohtml_kses( $input['recent_gallery_num'] );
  $input['recent_gallery_num_sp'] = wp_filter_nohtml_kses( $input['recent_gallery_num_sp'] );

  $single_gallery_post_list_order_new = array();
  if ( isset( $input['single_gallery_post_list_order_new'] ) && is_array( $input['single_gallery_post_list_order_new'] ) ) {
    foreach ( $input['single_gallery_post_list_order_new'] as $key => $value ) {
      $single_gallery_post_list_order_new[] = array(
        'name' => isset( $input['single_gallery_post_list_order_new'][$key]['name'] ) ? wp_filter_nohtml_kses( $input['single_gallery_post_list_order_new'][$key]['name'] ) : '',
      );
    }
  };
  $input['single_gallery_post_list_order_new'] = $single_gallery_post_list_order_new;

	return $input;

};


?>