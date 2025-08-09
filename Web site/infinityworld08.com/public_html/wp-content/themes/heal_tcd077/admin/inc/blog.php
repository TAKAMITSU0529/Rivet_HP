<?php
/*
 * ブログの設定
 */

 use TCD\Helper\UI;
 use TCD\Helper\Sanitization as San;

// Add default values
add_filter( 'before_getting_design_plus_option', 'add_blog_dp_default_options' );


//  Add label of blog tab
add_action( 'tcd_tab_labels', 'add_blog_tab_label' );


// Add HTML of blog tab
add_action( 'tcd_tab_panel', 'add_blog_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_blog_theme_options_validate' );


// タブの名前
function add_blog_tab_label( $tab_labels ) {
	$tab_labels['blog'] = __( 'Blog', 'tcd-w' );
	return $tab_labels;
}


// 初期値
function add_blog_dp_default_options( $dp_default_options ) {

	// 基本設定
	$dp_default_options['blog_label'] = __( 'Blog', 'tcd-w' );

	// ヘッダー
	$dp_default_options['blog_title'] = 'BLOG';
	$dp_default_options['blog_sub_title'] = '';
	$dp_default_options['blog_catch'] = __( 'Catchphrase', 'tcd-w' );
	$dp_default_options['blog_desc'] = __( 'Description will be displayed here.<br />Description will be displayed here.', 'tcd-w' );
	$dp_default_options['blog_title_font_size'] = '38';
	$dp_default_options['blog_title_font_size_mobile'] = '22';
	$dp_default_options['blog_sub_title_font_size'] = '18';
	$dp_default_options['blog_sub_title_font_size_mobile'] = '12';
	$dp_default_options['blog_catch_font_size'] = '38';
	$dp_default_options['blog_catch_font_size_mobile'] = '22';
	$dp_default_options['blog_desc_font_size'] = '16';
	$dp_default_options['blog_desc_font_size_mobile'] = '14';
	$dp_default_options['blog_title_color'] = '#FFFFFF';
	$dp_default_options['blog_catch_font_color'] = '#58330d';
	$dp_default_options['blog_bg_image'] = false;
	$dp_default_options['blog_use_overlay'] = 1;
	$dp_default_options['blog_overlay_color'] = '#000000';
	$dp_default_options['blog_overlay_opacity'] = '0.3';

	// アーカイブページ　記事一覧
	$dp_default_options['archive_blog_title_font_size'] = '16';
	$dp_default_options['archive_blog_title_font_size_mobile'] = '14';
	$dp_default_options['show_archive_blog_date'] = 1;
	$dp_default_options['show_archive_blog_category'] = 1;

	// 記事ページ
	$dp_default_options['single_blog_title_font_size'] = '28';
	$dp_default_options['single_blog_content_font_size'] = '16';
	$dp_default_options['single_blog_title_font_size_mobile'] = '20';
	$dp_default_options['single_blog_content_font_size_mobile'] = '14';
	$dp_default_options['show_date'] = 1;
	$dp_default_options['show_update'] = '';
	$dp_default_options['show_comment'] = 1;
	$dp_default_options['show_trackback'] = 1;
	$dp_default_options['show_next_post'] = 1;
	$dp_default_options['show_thumbnail'] = 1;
	$dp_default_options['show_sns_top'] = 1;
	$dp_default_options['show_sns_btm'] = 1;
	$dp_default_options['show_copy_top'] = 1;
	$dp_default_options['show_copy_btm'] = 1;
	$dp_default_options['show_author_profile'] = 1;
	$dp_default_options['pagenation_type'] = 'type1';
	$dp_default_options['show_meta_box'] = '';
	$dp_default_options['show_meta_category'] = 1;
	$dp_default_options['show_meta_tag'] = 1;
	$dp_default_options['show_meta_author'] = 1;
	$dp_default_options['show_meta_comment'] = 1;
  $dp_default_options['show_cate'] = 1;

	// 関連記事
	$dp_default_options['show_related_post'] = 1;
	$dp_default_options['related_post_headline'] = __( 'Related post', 'tcd-w' );
	$dp_default_options['related_post_headline_font_type'] = 1;
	$dp_default_options['related_post_headline_font_size'] = '16';
	$dp_default_options['related_post_headline_font_size_mobile'] = '14';
	$dp_default_options['related_post_headline_font_color'] = '#ffffff';
	$dp_default_options['related_post_headline_bg_color'] = '#58330d';
	$dp_default_options['related_post_num'] = '6';
	$dp_default_options['related_post_list_title_font_size'] = '14';
	$dp_default_options['related_post_list_title_font_size_mobile'] = '13';

	// 記事ページのバナー
	for ( $i = 1; $i <= 2; $i++ ) {
		$dp_default_options['single_top_ad_code' . $i] = '';
		$dp_default_options['single_top_ad_image' . $i] = false;
		$dp_default_options['single_top_ad_url' . $i] = '';
	}
	for ( $i = 1; $i <= 2; $i++ ) {
		$dp_default_options['single_bottom_ad_code' . $i] = '';
		$dp_default_options['single_bottom_ad_image' . $i] = false;
		$dp_default_options['single_bottom_ad_url' . $i] = '';
	}
	for ( $i = 1; $i <= 2; $i++ ) {
		$dp_default_options['single_shortcode_ad_code' . $i] = '';
		$dp_default_options['single_shortcode_ad_image' . $i] = false;
		$dp_default_options['single_shortcode_ad_url' . $i] = '';
	}
	for ( $i = 1; $i <= 2; $i++ ) {
		$dp_default_options['single_mobile_ad_code' . $i] = '';
		$dp_default_options['single_mobile_ad_image' . $i] = false;
		$dp_default_options['single_mobile_ad_url' . $i] = '';
	}

	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_blog_tab_panel( $options ) {

  global $dp_default_options, $pagenation_type_options, $font_type_options;
  $blog_label = $options['blog_label'] ? esc_html( $options['blog_label'] ) : __( 'Blog', 'tcd-w' );

?>

<div id="tab-content-blog" class="tab-content">

   <?php // 基本設定 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Basic setting', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">
     <h4 class="theme_option_headline2"><?php _e('Name of content', 'tcd-w');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('This name will also be used in breadcrumb link and page header.', 'tcd-w'); ?></p>
     </div>
     <input class="full_width" type="text" name="dp_options[blog_label]" value="<?php echo esc_attr($options['blog_label']); ?>" />
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // ヘッダーの設定 ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Header', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e('Title', 'tcd-w');  ?></h4>
     <input class="full_width" type="text" name="dp_options[blog_title]" value="<?php echo esc_attr($options['blog_title']); ?>" />
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'blog_title_font_size'); ?></li>
      <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[blog_title_color]" value="<?php echo esc_attr( $options['blog_title_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Sub title', 'tcd-w');  ?></h4>
     <input class="full_width" type="text" name="dp_options[blog_sub_title]" value="<?php echo esc_attr($options['blog_sub_title']); ?>" />
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'blog_sub_title_font_size'); ?></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Catchphrase', 'tcd-w');  ?></h4>
     <textarea class="large-text" cols="50" rows="3" name="dp_options[blog_catch]"><?php echo esc_textarea(  $options['blog_catch'] ); ?></textarea>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'blog_catch_font_size'); ?></li>
      <li class="cf"><span class="label"><?php _e('Font color', 'tcd-w'); ?></span><input type="text" name="dp_options[blog_catch_font_color]" value="<?php echo esc_attr( $options['blog_catch_font_color'] ); ?>" data-default-color="#58330d" class="c-color-picker"></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Description', 'tcd-w');  ?></h4>
     <textarea class="large-text" cols="50" rows="3" name="dp_options[blog_desc]"><?php echo esc_textarea(  $options['blog_desc'] ); ?></textarea>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'blog_desc_font_size'); ?></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Background image', 'tcd-w'); ?></h4>
     <ul class="option_list">
      <li class="cf">
       <span class="label">
        <?php _e('Background image', 'tcd-w'); ?>
        <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-w'), '1450', '430'); ?></span>
       </span>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js blog_bg_image">
         <input type="hidden" value="<?php echo esc_attr( $options['blog_bg_image'] ); ?>" id="blog_bg_image" name="dp_options[blog_bg_image]" class="cf_media_id">
         <div class="preview_field"><?php if($options['blog_bg_image']){ echo wp_get_attachment_image($options['blog_bg_image'], 'medium'); }; ?></div>
         <div class="buttton_area">
          <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['blog_bg_image']){ echo 'hidden'; }; ?>">
         </div>
        </div>
       </div>
      </li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e( 'Overlay', 'tcd-w' ); ?></h4>
     <p class="displayment_checkbox"><label><input name="dp_options[blog_use_overlay]" type="checkbox" value="1" <?php checked( $options['blog_use_overlay'], 1 ); ?>><?php _e( 'Use overlay', 'tcd-w' ); ?></label></p>
     <div style="<?php if($options['blog_use_overlay'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
       <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-w'); ?></span><input type="text" name="dp_options[blog_overlay_color]" value="<?php echo esc_attr( $options['blog_overlay_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
       <li class="cf">
        <span class="label"><?php _e('Transparency of overlay', 'tcd-w'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[blog_overlay_opacity]" value="<?php echo esc_attr( $options['blog_overlay_opacity'] ); ?>" />
        <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
         <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-w');  ?></p>
        </div>
       </li>
      </ul>
     </div>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // アーカイブページの設定 ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Archive page', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e('Font', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'archive_blog_title_font_size'); ?></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Display setting', 'tcd-w');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Display date', 'tcd-w');  ?></span><input name="dp_options[show_archive_blog_date]" type="checkbox" value="1" <?php checked( '1', $options['show_archive_blog_date'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('Display category', 'tcd-w');  ?></span><input name="dp_options[show_archive_blog_category]" type="checkbox" value="1" <?php checked( '1', $options['show_archive_blog_category'] ); ?> /></li>
     </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // 記事ページの設定 -------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php printf(__('%s page', 'tcd-w'), $blog_label); ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e('Font', 'tcd-w');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('Font size of content will be applied to page content too.', 'tcd-w'); ?></p>
     </div>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'single_blog_title_font_size'); ?></li>
      <li class="cf"><span class="label"><?php _e('Font size of content', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'single_blog_content_font_size'); ?></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Display setting', 'tcd-w');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('Please check the content displayed in the article.', 'tcd-w'); ?></p>
     </div>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Published date', 'tcd-w');  ?></span><input name="dp_options[show_date]" type="checkbox" value="1" <?php checked( '1', $options['show_date'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('Modified date', 'tcd-w');  ?></span><input name="dp_options[show_update]" type="checkbox" value="1" <?php checked( '1', $options['show_update'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('Categories', 'tcd-w');  ?></span><input name="dp_options[show_cate]" type="checkbox" value="1" <?php checked( '1', $options['show_cate'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('Featured image', 'tcd-w');  ?></span><input name="dp_options[show_thumbnail]" type="checkbox" value="1" <?php checked( '1', $options['show_thumbnail'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('Next previous post link', 'tcd-w');  ?></span><input name="dp_options[show_next_post]" type="checkbox" value="1" <?php checked( '1', $options['show_next_post'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('Comment', 'tcd-w');  ?></span><input name="dp_options[show_comment]" type="checkbox" value="1" <?php checked( '1', $options['show_comment'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('Trackbacks', 'tcd-w');  ?></span><input name="dp_options[show_trackback]" type="checkbox" value="1" <?php checked( '1', $options['show_trackback'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('Social button (under Featured image)', 'tcd-w');  ?></span><input name="dp_options[show_sns_top]" type="checkbox" value="1" <?php checked( '1', $options['show_sns_top'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('Social button (under post content)', 'tcd-w');  ?></span><input name="dp_options[show_sns_btm]" type="checkbox" value="1" <?php checked( '1', $options['show_sns_btm'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('"COPY Title&amp;URL" button under featured image', 'tcd-w');  ?></span><input name="dp_options[show_copy_top]" type="checkbox" value="1" <?php checked( '1', $options['show_copy_top'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('"COPY Title&amp;URL" button under post content', 'tcd-w');  ?></span><input name="dp_options[show_copy_btm]" type="checkbox" value="1" <?php checked( '1', $options['show_copy_btm'] ); ?> /></li>
      <li class="cf"><span class="label"><?php _e('Author profile', 'tcd-w');  ?></span><input name="dp_options[show_author_profile]" type="checkbox" value="1" <?php checked( '1', $options['show_author_profile'] ); ?> /></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Meta box', 'tcd-w');  ?></h4>
     <p class="displayment_checkbox"><label><input name="dp_options[show_meta_box]" type="checkbox" value="1" <?php checked( $options['show_meta_box'], 1 ); ?>><?php _e( 'Display meta box', 'tcd-w' ); ?></label></p>
     <div style="<?php if($options['show_meta_box'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
       <li class="cf"><span class="label"><?php _e('Author', 'tcd-w');  ?></span><input name="dp_options[show_meta_author]" type="checkbox" value="1" <?php checked( '1', $options['show_meta_author'] ); ?> /></li>
       <li class="cf"><span class="label"><?php _e('Categories', 'tcd-w');  ?></span><input name="dp_options[show_meta_category]" type="checkbox" value="1" <?php checked( '1', $options['show_meta_category'] ); ?> /></li>
       <li class="cf"><span class="label"><?php _e('Tags', 'tcd-w');  ?></span><input name="dp_options[show_meta_tag]" type="checkbox" value="1" <?php checked( '1', $options['show_meta_tag'] ); ?> /></li>
       <li class="cf"><span class="label"><?php _e('Comments', 'tcd-w');  ?></span><input name="dp_options[show_meta_comment]" type="checkbox" value="1" <?php checked( '1', $options['show_meta_comment'] ); ?> /></li>
      </ul>
     </div>

     <h4 class="theme_option_headline2"><?php _e( 'Pagenation', 'tcd-w' ); ?></h4>
     <ul class="design_radio_button image_radio_button cf">
      <?php foreach ( $pagenation_type_options as $option ) : ?>
      <li>
       <input type="radio" id="pagenation_type_<?php esc_attr_e( $option['value'] ); ?>" name="dp_options[pagenation_type]" value="<?php echo esc_attr( $option['value'] ); ?>" <?php checked( $option['value'], $options['pagenation_type'] ); ?>>
       <label for="pagenation_type_<?php esc_attr_e( $option['value'] ); ?>">
        <span><?php echo esc_html( $option['label'] ); ?></span>
        <img style="width:150px;" src="<?php bloginfo('template_url'); ?>/admin/img/<?php echo esc_attr($option['img']); ?>" alt="" title="" />
       </label>
      </li>
      <?php endforeach; ?>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Related post', 'tcd-w');  ?></h4>
     <p class="displayment_checkbox"><label><input name="dp_options[show_related_post]" type="checkbox" value="1" <?php checked( $options['show_related_post'], 1 ); ?>><?php _e( 'Display related post', 'tcd-w' ); ?></label></p>
     <div style="<?php if($options['show_related_post'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <div class="theme_option_message2">
       <p><?php _e('Headline setting will be applied to comment headline too.', 'tcd-w'); ?></p>
      </div>
      <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
       <li class="cf"><span class="label"><?php _e('Headline', 'tcd-w');  ?></span><input class="full_width" type="text" name="dp_options[related_post_headline]" value="<?php esc_attr_e( $options['related_post_headline'] ); ?>" /></li>
       <li class="cf"><span class="label"><?php _e('Font type of headline', 'tcd-w'); ?></span>
       <?php echo UI\font_select( 'dp_options[related_post_headline_font_type]', $options['related_post_headline_font_type'] ); ?>
       </li>
       <li class="cf"><span class="label"><?php _e('Font size of headline', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'related_post_headline_font_size'); ?></li>
       <li class="cf"><span class="label"><?php _e('Font color of headline', 'tcd-w'); ?></span><input type="text" name="dp_options[related_post_headline_font_color]" value="<?php echo esc_attr( $options['related_post_headline_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
       <li class="cf"><span class="label"><?php _e('Background color of headline', 'tcd-w'); ?></span><input type="text" name="dp_options[related_post_headline_bg_color]" value="<?php echo esc_attr( $options['related_post_headline_bg_color'] ); ?>" data-default-color="#58330d" class="c-color-picker"></li>
       <li class="cf"><span class="label"><?php _e('Number of post to display', 'tcd-w');  ?></span>
        <select name="dp_options[related_post_num]">
         <?php for($i=3; $i<= 12; $i++): ?>
         <?php if( $i % 3 == 0 ){ ?>
         <option style="padding-right: 10px;" value="<?php echo esc_attr($i); ?>" <?php selected( $options['related_post_num'], $i ); ?>><?php echo esc_html($i); ?></option>
         <?php }; ?>
         <?php endfor; ?>
        </select>
       </li>
       <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-w'); ?></span><?php echo tcd_font_size_option($options, 'related_post_list_title_font_size'); ?></li>
      </ul>
     </div>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // 広告の登録（アイキャッチ画像の下） -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Banner (Under featured image)', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content tab_parent">

     <div class="theme_option_message2">
      <p><?php _e('This banner will be displayed after featured image.', 'tcd-w');  ?></p>
     </div>

     <div class="sub_box_tab">
      <div class="tab active" data-tab="tab1"><?php _e('Left banner', 'tcd-w'); ?></div>
      <div class="tab" data-tab="tab2"><?php _e('Right banner', 'tcd-w'); ?></div>
     </div>

     <?php for($i = 1; $i <= 2; $i++) : ?>
     <div class="sub_box_tab_content<?php if($i == 1){ echo ' active'; }; ?>" data-tab-content="tab<?php echo $i; ?>">

       <h4 class="theme_option_headline2"><?php _e('Banner code', 'tcd-w');  ?></h4>
       <div class="theme_option_message2">
        <p><?php _e('If you are using google adsense, enter all code below.', 'tcd-w');  ?></p>
       </div>
       <textarea class="full_width" cols="50" rows="10" name="dp_options[single_top_ad_code<?php echo $i; ?>]"><?php echo esc_textarea( $options['single_top_ad_code'.$i] ); ?></textarea>

       <div class="theme_option_message">
        <p><?php _e('If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w');  ?></p>
       </div>

       <h4 class="theme_option_headline2"><?php _e('Register banner image.', 'tcd-w'); ?></h4>
       <div class="theme_option_message2">
        <p><?php _e('Recommend image size. Width:300px Height:250px', 'tcd-w'); ?></p>
       </div>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js single_top_ad_image<?php echo $i; ?>">
         <input type="hidden" value="<?php echo esc_attr( $options['single_top_ad_image'.$i] ); ?>" id="single_top_ad_image<?php echo $i; ?>" name="dp_options[single_top_ad_image<?php echo $i; ?>]" class="cf_media_id">
         <div class="preview_field"><?php if($options['single_top_ad_image'.$i]){ echo wp_get_attachment_image($options['single_top_ad_image'.$i], 'medium'); }; ?></div>
         <div class="buttton_area">
          <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['single_top_ad_image'.$i]){ echo 'hidden'; }; ?>">
         </div>
        </div>
       </div>

       <h4 class="theme_option_headline2"><?php _e('Register affiliate code', 'tcd-w');  ?></h4>
       <input class="full_width" type="text" name="dp_options[single_top_ad_url<?php echo $i; ?>]" value="<?php esc_attr_e( $options['single_top_ad_url'.$i] ); ?>" />

     </div>
     <?php endfor; ?>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // 広告の登録（記事本文の下） -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Banner (Under post content)', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content tab_parent">

     <div class="theme_option_message2">
      <p><?php _e('This banner will be displayed before related post.', 'tcd-w');  ?></p>
     </div>

     <div class="sub_box_tab">
      <div class="tab active" data-tab="tab1"><?php _e('Left banner', 'tcd-w'); ?></div>
      <div class="tab" data-tab="tab2"><?php _e('Right banner', 'tcd-w'); ?></div>
     </div>

     <?php for($i = 1; $i <= 2; $i++) : ?>
     <div class="sub_box_tab_content<?php if($i == 1){ echo ' active'; }; ?>" data-tab-content="tab<?php echo $i; ?>">

       <h4 class="theme_option_headline2"><?php _e('Banner code', 'tcd-w');  ?></h4>
       <div class="theme_option_message2">
        <p><?php _e('If you are using google adsense, enter all code below.', 'tcd-w');  ?></p>
       </div>
       <textarea class="full_width" cols="50" rows="10" name="dp_options[single_bottom_ad_code<?php echo $i; ?>]"><?php echo esc_textarea( $options['single_bottom_ad_code'.$i] ); ?></textarea>

       <div class="theme_option_message">
        <p><?php _e('If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w');  ?></p>
       </div>

       <h4 class="theme_option_headline2"><?php _e('Register banner image.', 'tcd-w'); ?></h4>
       <div class="theme_option_message2">
        <p><?php _e('Recommend image size. Width:300px Height:250px', 'tcd-w'); ?></p>
       </div>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js single_bottom_ad_image<?php echo $i; ?>">
         <input type="hidden" value="<?php echo esc_attr( $options['single_bottom_ad_image'.$i] ); ?>" id="single_bottom_ad_image<?php echo $i; ?>" name="dp_options[single_bottom_ad_image<?php echo $i; ?>]" class="cf_media_id">
         <div class="preview_field"><?php if($options['single_bottom_ad_image'.$i]){ echo wp_get_attachment_image($options['single_bottom_ad_image'.$i], 'medium'); }; ?></div>
         <div class="buttton_area">
          <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['single_bottom_ad_image'.$i]){ echo 'hidden'; }; ?>">
         </div>
        </div>
       </div>

       <h4 class="theme_option_headline2"><?php _e('Register affiliate code', 'tcd-w');  ?></h4>
       <input class="full_width" type="text" name="dp_options[single_bottom_ad_url<?php echo $i; ?>]" value="<?php esc_attr_e( $options['single_bottom_ad_url'.$i] ); ?>" />

     </div>
     <?php endfor; ?>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // 広告の登録（ショートコード） -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Banner (Short code)', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content tab_parent">

     <div class="theme_option_message2">
      <p><?php _e('Please copy and paste the short code inside the content to show this banner.', 'tcd-w'); ?></p>
     </div>

     <p><?php _e('Short code', 'tcd-w');  ?> : <input type="text" readonly="readonly" value="[s_ad]" /></p>

     <div class="sub_box_tab">
      <div class="tab active" data-tab="tab1"><?php _e('Left banner', 'tcd-w'); ?></div>
      <div class="tab" data-tab="tab2"><?php _e('Right banner', 'tcd-w'); ?></div>
     </div>

     <?php for($i = 1; $i <= 2; $i++) : ?>
     <div class="sub_box_tab_content<?php if($i == 1){ echo ' active'; }; ?>" data-tab-content="tab<?php echo $i; ?>">

       <h4 class="theme_option_headline2"><?php _e('Banner code', 'tcd-w');  ?></h4>
       <div class="theme_option_message2">
        <p><?php _e('If you are using google adsense, enter all code below.', 'tcd-w');  ?></p>
       </div>
       <textarea class="full_width" cols="50" rows="10" name="dp_options[single_shortcode_ad_code<?php echo $i; ?>]"><?php echo esc_textarea( $options['single_shortcode_ad_code'.$i] ); ?></textarea>

       <div class="theme_option_message">
        <p><?php _e('If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w');  ?></p>
       </div>

       <h4 class="theme_option_headline2"><?php _e('Register banner image.', 'tcd-w'); ?></h4>
       <div class="theme_option_message2">
        <p><?php _e('Recommend image size. Width:300px Height:250px', 'tcd-w'); ?></p>
       </div>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js single_shortcode_ad_image<?php echo $i; ?>">
         <input type="hidden" value="<?php echo esc_attr( $options['single_shortcode_ad_image'.$i] ); ?>" id="single_shortcode_ad_image<?php echo $i; ?>" name="dp_options[single_shortcode_ad_image<?php echo $i; ?>]" class="cf_media_id">
         <div class="preview_field"><?php if($options['single_shortcode_ad_image'.$i]){ echo wp_get_attachment_image($options['single_shortcode_ad_image'.$i], 'medium'); }; ?></div>
         <div class="buttton_area">
          <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['single_shortcode_ad_image'.$i]){ echo 'hidden'; }; ?>">
         </div>
        </div>
       </div>

       <h4 class="theme_option_headline2"><?php _e('Register affiliate code', 'tcd-w');  ?></h4>
       <input class="full_width" type="text" name="dp_options[single_shortcode_ad_url<?php echo $i; ?>]" value="<?php esc_attr_e( $options['single_shortcode_ad_url'.$i] ); ?>" />

     </div>
     <?php endfor; ?>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // 広告の登録（スマホ専用） -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Banner (Mobile device)', 'tcd-w');  ?></h3>
    <div class="theme_option_field_ac_content tab_parent">

     <div class="theme_option_message2">
      <p><?php _e('This banner will be displayed on mobile device.', 'tcd-w');  ?></p>
     </div>

     <div class="sub_box_tab">
      <div class="tab active" data-tab="tab1"><?php _e('Top banner', 'tcd-w'); ?></div>
      <div class="tab" data-tab="tab2"><?php _e('Bottom banner', 'tcd-w'); ?></div>
     </div>

     <?php for($i = 1; $i <= 2; $i++) : ?>
     <div class="sub_box_tab_content<?php if($i == 1){ echo ' active'; }; ?>" data-tab-content="tab<?php echo $i; ?>">

       <h4 class="theme_option_headline2"><?php _e('Banner code', 'tcd-w');  ?></h4>
       <div class="theme_option_message2">
        <p><?php _e('If you are using google adsense, enter all code below.', 'tcd-w');  ?></p>
       </div>
       <textarea class="full_width" cols="50" rows="10" name="dp_options[single_mobile_ad_code<?php echo $i; ?>]"><?php echo esc_textarea( $options['single_mobile_ad_code'.$i] ); ?></textarea>

       <div class="theme_option_message">
        <p><?php _e('If you are not using google adsense, you can register your banner image and affiliate code individually.', 'tcd-w');  ?></p>
       </div>

       <h4 class="theme_option_headline2"><?php _e('Register banner image.', 'tcd-w'); ?></h4>
       <div class="theme_option_message2">
        <p><?php _e('Recommend image size. Width:300px Height:250px', 'tcd-w'); ?></p>
       </div>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js single_mobile_ad_image<?php echo $i; ?>">
         <input type="hidden" value="<?php echo esc_attr( $options['single_mobile_ad_image'.$i] ); ?>" id="single_mobile_ad_image<?php echo $i; ?>" name="dp_options[single_mobile_ad_image<?php echo $i; ?>]" class="cf_media_id">
         <div class="preview_field"><?php if($options['single_mobile_ad_image'.$i]){ echo wp_get_attachment_image($options['single_mobile_ad_image'.$i], 'medium'); }; ?></div>
         <div class="buttton_area">
          <input type="button" value="<?php _e('Select Image', 'tcd-w'); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e('Remove Image', 'tcd-w'); ?>" class="cfmf-delete-img button <?php if(!$options['single_mobile_ad_image'.$i]){ echo 'hidden'; }; ?>">
         </div>
        </div>
       </div>

       <h4 class="theme_option_headline2"><?php _e('Register affiliate code', 'tcd-w');  ?></h4>
       <input class="full_width" type="text" name="dp_options[single_mobile_ad_url<?php echo $i; ?>]" value="<?php esc_attr_e( $options['single_mobile_ad_url'.$i] ); ?>" />

     </div>
     <?php endfor; ?>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-w' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-w' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


</div><!-- END .tab-content -->

<?php
} // END add_blog_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_blog_theme_options_validate( $input ) {

  global $dp_default_options, $pagenation_type_options, $font_type_options;

  // 基本設定
  $input['blog_label'] = wp_filter_nohtml_kses( $input['blog_label'] );

  //ヘッダーの設定
  $input['blog_title'] = wp_filter_nohtml_kses( $input['blog_title'] );
  $input['blog_sub_title'] = wp_filter_nohtml_kses( $input['blog_sub_title'] );
  $input['blog_catch'] = wp_filter_nohtml_kses( $input['blog_catch'] );
  $input['blog_desc'] = wp_filter_nohtml_kses( $input['blog_desc'] );
  $input['blog_title_font_size'] = wp_filter_nohtml_kses( $input['blog_title_font_size'] );
  $input['blog_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['blog_title_font_size_mobile'] );
  $input['blog_sub_title_font_size'] = wp_filter_nohtml_kses( $input['blog_sub_title_font_size'] );
  $input['blog_sub_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['blog_sub_title_font_size_mobile'] );
  $input['blog_catch_font_size'] = wp_filter_nohtml_kses( $input['blog_catch_font_size'] );
  $input['blog_catch_font_size_mobile'] = wp_filter_nohtml_kses( $input['blog_catch_font_size_mobile'] );
  $input['blog_desc_font_size'] = wp_filter_nohtml_kses( $input['blog_desc_font_size'] );
  $input['blog_desc_font_size_mobile'] = wp_filter_nohtml_kses( $input['blog_desc_font_size_mobile'] );
  $input['blog_title_color'] = wp_filter_nohtml_kses( $input['blog_title_color'] );
  $input['blog_catch_font_color'] = wp_filter_nohtml_kses( $input['blog_catch_font_color'] );
  $input['blog_bg_image'] = wp_filter_nohtml_kses( $input['blog_bg_image'] );
  if ( ! isset( $input['blog_use_overlay'] ) )
    $input['blog_use_overlay'] = null;
    $input['blog_use_overlay'] = ( $input['blog_use_overlay'] == 1 ? 1 : 0 );
  $input['blog_overlay_color'] = wp_filter_nohtml_kses( $input['blog_overlay_color'] );
  $input['blog_overlay_opacity'] = wp_filter_nohtml_kses( $input['blog_overlay_opacity'] );

  // アーカイブページ　記事一覧
  $input['archive_blog_title_font_size'] = wp_filter_nohtml_kses( $input['archive_blog_title_font_size'] );
  $input['archive_blog_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['archive_blog_title_font_size_mobile'] );
  if ( ! isset( $input['show_archive_blog_date'] ) )
    $input['show_archive_blog_date'] = null;
    $input['show_archive_blog_date'] = ( $input['show_archive_blog_date'] == 1 ? 1 : 0 );
  if ( ! isset( $input['show_archive_blog_category'] ) )
    $input['show_archive_blog_category'] = null;
    $input['show_archive_blog_category'] = ( $input['show_archive_blog_category'] == 1 ? 1 : 0 );

  // 記事ページ
  $input['single_blog_title_font_size'] = wp_filter_nohtml_kses( $input['single_blog_title_font_size'] );
  $input['single_blog_content_font_size'] = wp_filter_nohtml_kses( $input['single_blog_content_font_size'] );
  $input['single_blog_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['single_blog_title_font_size_mobile'] );
  $input['single_blog_content_font_size_mobile'] = wp_filter_nohtml_kses( $input['single_blog_content_font_size_mobile'] );
  if ( ! isset( $input['show_date'] ) )
    $input['show_date'] = null;
    $input['show_date'] = ( $input['show_date'] == 1 ? 1 : 0 );
		if ( ! isset( $input['show_update'] ) )
	    $input['show_update'] = null;
	    $input['show_update'] = ( $input['show_update'] == 1 ? 1 : 0 );
  if ( ! isset( $input['show_cate'] ) )
    $input['show_cate'] = null;
    $input['show_cate'] = ( $input['show_cate'] == 1 ? 1 : 0 );
  if ( ! isset( $input['show_comment'] ) )
    $input['show_comment'] = null;
    $input['show_comment'] = ( $input['show_comment'] == 1 ? 1 : 0 );
  if ( ! isset( $input['show_trackback'] ) )
    $input['show_trackback'] = null;
    $input['show_trackback'] = ( $input['show_trackback'] == 1 ? 1 : 0 );
  if ( ! isset( $input['show_next_post'] ) )
    $input['show_next_post'] = null;
    $input['show_next_post'] = ( $input['show_next_post'] == 1 ? 1 : 0 );
  if ( ! isset( $input['show_thumbnail'] ) )
    $input['show_thumbnail'] = null;
    $input['show_thumbnail'] = ( $input['show_thumbnail'] == 1 ? 1 : 0 );
  if ( ! isset( $input['show_sns_top'] ) )
    $input['show_sns_top'] = null;
    $input['show_sns_top'] = ( $input['show_sns_top'] == 1 ? 1 : 0 );
  if ( ! isset( $input['show_sns_btm'] ) )
    $input['show_sns_btm'] = null;
    $input['show_sns_btm'] = ( $input['show_sns_btm'] == 1 ? 1 : 0 );
  if ( ! isset( $input['show_copy_top'] ) )
    $input['show_copy_top'] = null;
    $input['show_copy_top'] = ( $input['show_copy_top'] == 1 ? 1 : 0 );
  if ( ! isset( $input['show_copy_btm'] ) )
    $input['show_copy_btm'] = null;
    $input['show_copy_btm'] = ( $input['show_copy_btm'] == 1 ? 1 : 0 );
  if ( ! isset( $input['show_author_profile'] ) )
    $input['show_author_profile'] = null;
    $input['show_author_profile'] = ( $input['show_author_profile'] == 1 ? 1 : 0 );
  if ( ! isset( $input['show_meta_box'] ) )
    $input['show_meta_box'] = null;
    $input['show_meta_box'] = ( $input['show_meta_box'] == 1 ? 1 : 0 );
  if ( ! isset( $input['show_meta_category'] ) )
    $input['show_meta_category'] = null;
    $input['show_meta_category'] = ( $input['show_meta_category'] == 1 ? 1 : 0 );
  if ( ! isset( $input['show_meta_comment'] ) )
    $input['show_meta_comment'] = null;
    $input['show_meta_comment'] = ( $input['show_meta_comment'] == 1 ? 1 : 0 );
  if ( ! isset( $input['show_meta_tag'] ) )
    $input['show_meta_tag'] = null;
    $input['show_meta_tag'] = ( $input['show_meta_tag'] == 1 ? 1 : 0 );
  if ( ! isset( $input['show_meta_author'] ) )
    $input['show_meta_author'] = null;
    $input['show_meta_author'] = ( $input['show_meta_author'] == 1 ? 1 : 0 );

  // 関連記事
  if ( ! isset( $input['show_related_post'] ) )
    $input['show_related_post'] = null;
    $input['show_related_post'] = ( $input['show_related_post'] == 1 ? 1 : 0 );
  $input['related_post_headline'] = wp_filter_nohtml_kses( $input['related_post_headline'] );
  $input['related_post_headline_font_type'] = San\choice( $input['related_post_headline_font_type'], [ '1', '2', '3' ] );
  $input['related_post_headline_font_size'] = wp_filter_nohtml_kses( $input['related_post_headline_font_size'] );
  $input['related_post_headline_font_size_mobile'] = wp_filter_nohtml_kses( $input['related_post_headline_font_size_mobile'] );
  $input['related_post_headline_font_color'] = wp_filter_nohtml_kses( $input['related_post_headline_font_color'] );
  $input['related_post_headline_bg_color'] = wp_filter_nohtml_kses( $input['related_post_headline_bg_color'] );
  $input['related_post_num'] = wp_filter_nohtml_kses( $input['related_post_num'] );
  $input['related_post_list_title_font_size'] = wp_filter_nohtml_kses( $input['related_post_list_title_font_size'] );
  $input['related_post_list_title_font_size_mobile'] = wp_filter_nohtml_kses( $input['related_post_list_title_font_size_mobile'] );

  // 記事ページ　その他
  if ( ! isset( $input['pagenation_type'] ) ) $input['pagenation_type'] = null;
  if ( ! array_key_exists( $input['pagenation_type'], $pagenation_type_options ) ) $input['pagenation_type'] = null;

  // 記事ページのバナー広告
  for ( $i = 1; $i <= 2; $i++ ) {
    $input['single_top_ad_code'.$i] = $input['single_top_ad_code'.$i];
    $input['single_top_ad_image'.$i] = wp_filter_nohtml_kses( $input['single_top_ad_image'.$i] );
    $input['single_top_ad_url'.$i] = wp_filter_nohtml_kses( $input['single_top_ad_url'.$i] );
  }
  for ( $i = 1; $i <= 2; $i++ ) {
    $input['single_bottom_ad_code'.$i] = $input['single_bottom_ad_code'.$i];
    $input['single_bottom_ad_image'.$i] = wp_filter_nohtml_kses( $input['single_bottom_ad_image'.$i] );
    $input['single_bottom_ad_url'.$i] = wp_filter_nohtml_kses( $input['single_bottom_ad_url'.$i] );
  }
  for ( $i = 1; $i <= 2; $i++ ) {
    $input['single_shortcode_ad_code'.$i] = $input['single_shortcode_ad_code'.$i];
    $input['single_shortcode_ad_image'.$i] = wp_filter_nohtml_kses( $input['single_shortcode_ad_image'.$i] );
    $input['single_shortcode_ad_url'.$i] = wp_filter_nohtml_kses( $input['single_shortcode_ad_url'.$i] );
  }
  for ( $i = 1; $i <= 2; $i++ ) {
    $input['single_mobile_ad_code'.$i] = $input['single_mobile_ad_code'.$i];
    $input['single_mobile_ad_image'.$i] = wp_filter_nohtml_kses( $input['single_mobile_ad_image'.$i] );
    $input['single_mobile_ad_url'.$i] = wp_filter_nohtml_kses( $input['single_mobile_ad_url'.$i] );
  }


	return $input;

};


?>
