<?php
/*
 * ブログの設定
 */


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
  global $blog_label;
	$tab_labels['blog'] = $blog_label;
	return $tab_labels;
}


// 初期値
function add_blog_dp_default_options( $dp_default_options ) {

	// 基本設定
	$dp_default_options['blog_show_date'] = 'display';
	$dp_default_options['blog_show_update'] = 'display';

	// アーカイブページ
	$dp_default_options['blog_show_header'] = '1';
	$dp_default_options['archive_blog_catch'] = __( 'Catchphrase', 'tcd-canon' );
	$dp_default_options['archive_blog_desc'] = __( 'Description will be displayed here.', 'tcd-canon' );
	$dp_default_options['archive_blog_desc_mobile'] = '';
	$dp_default_options['archive_blog_header_image'] = false;
	$dp_default_options['archive_blog_overlay_color'] = '#000000';
	$dp_default_options['archive_blog_overlay_opacity'] = '0.3';
	$dp_default_options['archive_blog_show_category_list'] = 'display';

	// 詳細ページ
	$dp_default_options['single_blog_show_sns'] = 'top';
	$dp_default_options['single_blog_show_copy'] = 'top';
	$dp_default_options['single_blog_show_tag_list'] = 'display';
	$dp_default_options['single_blog_show_side_bar'] = 'hide';

  // 関連記事
	$dp_default_options['blog_show_related_post'] = 1;
	$dp_default_options['related_post_headline'] = __( 'Related post', 'tcd-canon' );
	$dp_default_options['related_post_sub_headline'] = '';
	$dp_default_options['related_post_num'] = '3';
	$dp_default_options['related_post_num_sp'] = '3';
	$dp_default_options['related_post_type'] = 'category_post';
	$dp_default_options['related_post_order'] = 'rand';
	$dp_default_options['related_post_order_custom'] = '';

	// 記事ページの追加コンテンツ
	$dp_default_options['single_top_ad_code'] = '';
	$dp_default_options['single_top_ad_code_mobile'] = '';
	$dp_default_options['single_bottom_ad_code'] = '';
	$dp_default_options['single_bottom_ad_code_mobile'] = '';
	$dp_default_options['single_related_post_ad_code'] = '';
	$dp_default_options['single_related_post_ad_code_mobile'] = '';

	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_blog_tab_panel( $options ) {

  global $blog_label, $dp_default_options, $font_type_options, $basic_display_options, $single_page_display_options;

?>

<div id="tab-content-blog" class="tab-content">

   <?php // 基本設定 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Common setting', 'tcd-canon');  ?></h3>
    <div class="theme_option_field_ac_content">

     <?php
          $blog_page_id = get_option( 'page_for_posts' );
          if($blog_page_id) {
     ?>

     <div class="front_page_image">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/image/content_name_url.jpg" alt="" title="" />
     </div>

     <h4 class="theme_option_headline_number"><span class="num">1</span><?php _e('Name of content', 'tcd-canon'); ?></h4>
     <div class="theme_option_message2">
      <p><?php printf(__('Title that are set on the <a href="post.php?post=%s&action=edit" target="_blank">post page</a> will affect to breadcrumb link name.', 'tcd-canon'), $blog_page_id); ?></p>
     </div>

     <h4 class="theme_option_headline_number"><span class="num">2</span><?php _e('Slug', 'tcd-canon'); ?></h4>
     <div class="theme_option_message2">
      <p><?php printf(__('Permalinks that are set on the <a href="post.php?post=%s&action=edit" target="_blank">post page</a> will affect to blog page URL.', 'tcd-canon'), $blog_page_id); ?></p>
     </div>

     <?php } else { ?>

     <div class="theme_option_message2">
      <p><?php _e('After creating the blog page by <a href="./edit.php?post_type=page" target="_blank">static page</a>, please register the page as a blog from the <a href="./options-reading.php" target="_blank">display settings page</a>.', 'tcd-canon'); ?></p>
     </div>

     <?php }; ?>

     <h4 class="theme_option_headline2"><?php _e('Date', 'tcd-canon');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Date', 'tcd-canon');  ?></span><?php echo tcd_basic_radio_button($options, 'blog_show_date', $basic_display_options); ?></li>
      <li class="cf blog_show_update_option"><span class="label"><?php _e('Modified date', 'tcd-canon');  ?></span><?php echo tcd_basic_radio_button($options, 'blog_show_update', $basic_display_options); ?></li>
     </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-canon' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-canon' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // アーカイブページ ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Archive page', 'tcd-canon'); ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="front_page_image">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/image/blog_archive.jpg?1.2" alt="" title="" />
     </div>

     <div class="theme_option_message2" style="margin-top:20px;">
      <?php
           if($blog_page_id) {
             $blog_page_url = get_page_link( $blog_page_id );
             if($blog_page_url){
      ?>
      <p><?php _e('URL of the post archive page:', 'tcd-canon'); ?><a class="e_link" href="<?php echo esc_url($blog_page_url) ?>" target="_blank"><?php echo esc_url($blog_page_url) ?></a></p>
      <?php
             };
           } else {
      ?>
      <p><?php _e('The page for the post archive page is not set.', 'tcd-canon'); ?>
         <?php _e('Please refer to the <a href="https://tcd-theme.com/2022/07/wordpress-homepage.html" target="_blank">manual</a> to create and configure.', 'tcd-canon'); ?></p>
      <?php } ?>
      <p><?php printf(__('The number of posts displayed in %s archive page can be set from "Settings > Display Settings > Maximum number of posts per page".<br>Click <a href="./options-reading.php" target="_blank">here</a> for display settings', 'tcd-canon'), $blog_label); ?></p>
     </div>

     <p><label><input class="display_option" data-option-name="blog_show_header" name="dp_options[blog_show_header]" type="checkbox" value="1" <?php checked( $options['blog_show_header'], 1 ); ?>><?php _e( 'Display header area', 'tcd-canon' ); ?></label></p>

     <ul class="option_list">
      <li class="cf" style="border-top:1px dotted #ccc;"><span class="label"><span class="num">1</span><?php _e('Catchphrase', 'tcd-canon'); ?></span><textarea class="full_width" cols="50" rows="3" name="dp_options[archive_blog_catch]"><?php echo esc_textarea(  $options['archive_blog_catch'] ); ?></textarea></li>
      <li class="cf"><span class="label"><span class="num">2</span><?php _e('Description', 'tcd-canon'); ?></span><textarea class="full_width" cols="50" rows="3" name="dp_options[archive_blog_desc]"><?php echo esc_textarea(  $options['archive_blog_desc'] ); ?></textarea></li>
      <li class="cf space"><span class="label"><?php _e('Description (mobile)', 'tcd-canon'); ?></span><textarea placeholder="<?php _e( 'Please indicate if you would like to display a short text for mobile sizes.', 'tcd-canon' ); ?>" class="full_width" cols="50" rows="3" name="dp_options[archive_blog_desc_mobile]"><?php echo esc_textarea(  $options['archive_blog_desc_mobile'] ); ?></textarea></li>
      <li class="cf blog_show_header">
       <span class="label">
        <span class="num">3</span><?php _e('Image', 'tcd-canon'); ?>
        <span class="recommend_desc space"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-canon'), '1450', '560'); ?></span>
       </span>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js archive_blog_header_image">
         <input type="hidden" value="<?php echo esc_attr( $options['archive_blog_header_image'] ); ?>" id="archive_blog_header_image" name="dp_options[archive_blog_header_image]" class="cf_media_id">
         <div class="preview_field"><?php if($options['archive_blog_header_image']){ echo wp_get_attachment_image($options['archive_blog_header_image'], 'medium'); }; ?></div>
         <div class="buttton_area">
          <input type="button" value="<?php _e('Select Image', 'tcd-canon'); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e('Remove Image', 'tcd-canon'); ?>" class="cfmf-delete-img button <?php if(!$options['archive_blog_header_image']){ echo 'hidden'; }; ?>">
         </div>
        </div>
       </div>
      </li>
      <li class="cf space blog_show_header">
       <span class="label"><?php _e('Color of overlay', 'tcd-canon'); ?></span><input type="text" name="dp_options[archive_blog_overlay_color]" value="<?php echo esc_attr( $options['archive_blog_overlay_color'] ); ?>" data-default-color="#000000" class="c-color-picker">
      </li>
      <li class="cf space blog_show_header">
       <span class="label"><?php _e('Transparency of overlay', 'tcd-canon'); ?></span><input class="hankaku" style="width:70px;" type="number" step="0.1" min="0" max="1" name="dp_options[archive_blog_overlay_opacity]" value="<?php echo esc_attr( $options['archive_blog_overlay_opacity'] ); ?>" />
       <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
        <p><?php _e('Please specify the number of 0 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-canon');  ?>
        <?php _e('Please enter 0 if you don\'t want to use overlay.', 'tcd-canon');  ?></p>
       </div>
      </li>
      <li class="cf"><span class="label"><span class="num">4</span><?php _e('Category list', 'tcd-canon');  ?></span><?php echo tcd_basic_radio_button($options, 'archive_blog_show_category_list', $basic_display_options); ?></li>
     </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-canon' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-canon' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // 詳細ページの設定 -------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php printf(__('%s page', 'tcd-canon'), $blog_label); ?></h3>
    <div class="theme_option_field_ac_content tab_parent">

     <div class="front_page_image">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/image/blog_single.jpg" alt="" title="" />
     </div>

     <h4 class="theme_option_headline2"><?php _e('Display setting', 'tcd-canon');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('The content displayed in the right side widget area can be set from Appearance > <a href="./widgets.php" target="_blank">Widgets</a>.', 'tcd-canon');  ?></p>
     </div>

     <ul class="option_list">
      <li class="cf">
       <span class="label"><?php _e('Widget area', 'tcd-canon');  ?></span>
       <div class="standard_radio_button">
        <input type="radio" id="single_blog_show_side_bar_left" name="dp_options[single_blog_show_side_bar]" value="left"<?php checked( $options['single_blog_show_side_bar'], 'left' ); ?>>
        <label for="single_blog_show_side_bar_left"><?php _e('Left', 'tcd-canon');  ?></label>
        <input type="radio" id="single_blog_show_side_bar_right" name="dp_options[single_blog_show_side_bar]" value="right"<?php checked( $options['single_blog_show_side_bar'], 'right' ); ?>>
        <label for="single_blog_show_side_bar_right"><?php _e('Right', 'tcd-canon');  ?></label>
        <input type="radio" id="single_blog_show_side_bar_hide" name="dp_options[single_blog_show_side_bar]" value="hide"<?php checked( $options['single_blog_show_side_bar'], 'hide' ); ?>>
        <label for="single_blog_show_side_bar_hide"><?php _e('Hide', 'tcd-canon');  ?></label>
       </div>
      </li>
      <li class="cf"><span class="label"><span class="num">1</span><?php _e('"COPY Title&amp;URL" button', 'tcd-canon');  ?></span><?php echo tcd_basic_radio_button($options, 'single_blog_show_copy', $single_page_display_options); ?></li>
      <li class="cf"><span class="label"><span class="num">2</span><?php _e('Share button', 'tcd-canon');  ?></span><?php echo tcd_basic_radio_button($options, 'single_blog_show_sns', $single_page_display_options); ?></li>
      <li class="cf"><span class="label"><span class="num">3</span><?php _e('Tag cloud', 'tcd-canon');  ?></span><?php echo tcd_basic_radio_button($options, 'single_blog_show_tag_list', $basic_display_options); ?></li>
     </ul>

     <?php // 関連記事 ----------------------------- ?>
     <h4 class="theme_option_headline2"><?php _e('Related post', 'tcd-canon'); ?></h4>

     <div class="front_page_image middle">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/image/blog_related.jpg" alt="" title="" />
     </div>

     <p class="displayment_checkbox"><label><input name="dp_options[blog_show_related_post]" type="checkbox" value="1" <?php checked( $options['blog_show_related_post'], 1 ); ?>><?php _e( 'Display related post', 'tcd-canon' ); ?></label></p>
     <div style="<?php if($options['blog_show_related_post'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">

     <ul class="option_list">
      <li class="cf" style="border-top:1px dotted #ccc;"><span class="label"><span class="num">1</span><?php _e('Headline', 'tcd-canon');  ?></span><input class="full_width" type="text" placeholder="<?php _e( 'e.g.', 'tcd-canon' ); _e( 'Related post', 'tcd-canon' ); ?>" name="dp_options[related_post_headline]" value="<?php echo esc_attr($options['related_post_headline']); ?>"></li>
      <li class="cf space"><span class="label"><?php _e('Subheading', 'tcd-canon');  ?></span><input class="full_width" type="text" name="dp_options[related_post_sub_headline]" value="<?php echo esc_attr($options['related_post_sub_headline']); ?>"></li>
      <li class="cf post_list_type_normal_option"><span class="label"><span class="num">2</span><?php _e('Number of post to display', 'tcd-canon');  ?></span><?php echo tcd_display_post_num_option_type2($options, 'related_post_num'); ?></li>
      <li class="cf space">
       <span class="label"><?php _e('Post type', 'tcd-canon');  ?></span>
       <select class="post_list_type" name="dp_options[related_post_type]">
        <option style="padding-right: 10px;" value="all_post" <?php selected( $options['related_post_type'], 'all_post' ); ?>><?php _e('All post', 'tcd-canon'); ?></option>
        <option style="padding-right: 10px;" value="category_post" <?php selected( $options['related_post_type'], 'category_post' ); ?>><?php _e('Same category post', 'tcd-canon'); ?></option>
        <option style="padding-right: 10px;" value="recommend_post" <?php selected( $options['related_post_type'], 'recommend_post' ); ?>><?php _e('Recommend post', 'tcd-canon'); ?>1</option>
        <option style="padding-right: 10px;" value="recommend_post2" <?php selected( $options['related_post_type'], 'recommend_post2' ); ?>><?php _e('Recommend post', 'tcd-canon'); ?>2</option>
        <option style="padding-right: 10px;" value="recommend_post3" <?php selected( $options['related_post_type'], 'recommend_post3' ); ?>><?php _e('Recommend post', 'tcd-canon'); ?>3</option>
        <option style="padding-right: 10px;" value="custom" <?php selected( $options['related_post_type'], 'custom' ); ?>><?php _e('Custom', 'tcd-canon'); ?></option>
       </select>
      </li>
      <li class="cf space post_list_type_normal_option">
       <span class="label"><?php _e('Post order', 'tcd-canon');  ?></span>
       <div class="standard_radio_button">
        <input id="related_post_order_date" type="radio" name="dp_options[related_post_order]" value="date" <?php checked( $options['related_post_order'], 'date' ); ?>>
        <label for="related_post_order_date"><?php _e('Date', 'tcd-canon'); ?></label>
        <input id="related_post_order_rand" type="radio" name="dp_options[related_post_order]" value="rand" <?php checked( $options['related_post_order'], 'rand' ); ?>>
        <label for="related_post_order_rand"><?php _e('Random', 'tcd-canon'); ?></label>
       </div>
      </li>
      <li class="cf space post_list_type_custom_option">
       <span class="label"><?php _e('ID of the article you want to display', 'tcd-canon');  ?><span class="recommend_desc"><?php _e('Enter article IDs separated by commas.<br>The ID can be found in the administration screen.<br><a href="https://tcd-theme.com/2017/01/check_pageid_categoryid.html#tcd_id" target="_blank">Click here to see the ID display section of the TCD theme.</a>', 'tcd-canon'); ?></span></span>
       <input type="text" placeholder="<?php _e( 'e.g.', 'tcd-canon' ); ?>1,3,10" class="full_width hankaku" name="dp_options[related_post_order_custom]" value="<?php echo esc_attr($options['related_post_order_custom']); ?>">
      </li>
     </ul>

     </div>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-canon' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-canon' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // 追加コンテンツ -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Additional content', 'tcd-canon'); ?></h3>
    <div class="theme_option_field_ac_content tab_parent">

     <div class="theme_option_message2">
      <p><?php _e('Additional content can be placed above and below all articles. HTML can also be used, so please use it for affiliates as well.', 'tcd-canon');  ?></p>
     </div>

     <div class="sub_box_tab">
      <div class="tab active" data-tab="tab1"><span class="label"><?php _e('Above main content', 'tcd-canon'); ?></span></div>
      <div class="tab" data-tab="tab2"><span class="label"><?php _e('Below main content', 'tcd-canon'); ?></span></div>
      <div class="tab" data-tab="tab3"><span class="label"><?php _e('Below page navigation', 'tcd-canon'); ?></span></div>
     </div>

     <?php // メインコンテンツの上部 ----------------------- ?>
     <div class="sub_box_tab_content active" data-tab-content="tab1">

      <h4 class="theme_option_headline2"><?php _e('Free HTML area (PC)', 'tcd-canon');  ?></h4>
      <div class="theme_option_message2">
       <p><?php _e('This content will be displayed in PC only.', 'tcd-canon');  ?></p>
      </div>
      <textarea class="full_width" cols="50" rows="10" name="dp_options[single_top_ad_code]"><?php echo esc_textarea( $options['single_top_ad_code'] ); ?></textarea>

      <h4 class="theme_option_headline2"><?php _e('Free HTML area (mobile)', 'tcd-canon');  ?></h4>
      <div class="theme_option_message2">
       <p><?php _e('This content will be displayed in mobile device only.', 'tcd-canon');  ?></p>
      </div>
      <textarea class="full_width" cols="50" rows="10" name="dp_options[single_top_ad_code_mobile]"><?php echo esc_textarea( $options['single_top_ad_code_mobile'] ); ?></textarea>

     </div><!-- END .sub_box_tab_content -->

     <?php // メインコンテンツの下部 ----------------------- ?>
     <div class="sub_box_tab_content" data-tab-content="tab2">

      <h4 class="theme_option_headline2"><?php _e('Free HTML area (PC)', 'tcd-canon');  ?></h4>
      <div class="theme_option_message2">
       <p><?php _e('This content will be displayed in PC only.', 'tcd-canon');  ?></p>
      </div>
      <textarea class="full_width" cols="50" rows="10" name="dp_options[single_bottom_ad_code]"><?php echo esc_textarea( $options['single_bottom_ad_code'] ); ?></textarea>

      <h4 class="theme_option_headline2"><?php _e('Free HTML area (mobile)', 'tcd-canon');  ?></h4>
      <div class="theme_option_message2">
       <p><?php _e('This content will be displayed in mobile device only.', 'tcd-canon');  ?></p>
      </div>
      <textarea class="full_width" cols="50" rows="10" name="dp_options[single_bottom_ad_code_mobile]"><?php echo esc_textarea( $options['single_bottom_ad_code_mobile'] ); ?></textarea>

     </div><!-- END .sub_box_tab_content -->

     <?php // 関連記事の下部 ----------------------- ?>
     <div class="sub_box_tab_content" data-tab-content="tab3">

      <h4 class="theme_option_headline2"><?php _e('Free HTML area (PC)', 'tcd-canon');  ?></h4>
      <div class="theme_option_message2">
       <p><?php _e('This content will be displayed in PC only.', 'tcd-canon');  ?></p>
      </div>
      <textarea class="full_width" cols="50" rows="10" name="dp_options[single_related_post_ad_code]"><?php echo esc_textarea( $options['single_related_post_ad_code'] ); ?></textarea>

      <h4 class="theme_option_headline2"><?php _e('Free HTML area (mobile)', 'tcd-canon');  ?></h4>
      <div class="theme_option_message2">
       <p><?php _e('This content will be displayed in mobile device only.', 'tcd-canon');  ?></p>
      </div>
      <textarea class="full_width" cols="50" rows="10" name="dp_options[single_related_post_ad_code_mobile]"><?php echo esc_textarea( $options['single_related_post_ad_code_mobile'] ); ?></textarea>

     </div><!-- END .sub_box_tab_content -->

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-canon' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-canon' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


</div><!-- END .tab-content -->

<?php
} // END add_blog_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_blog_theme_options_validate( $input ) {

  global $dp_default_options, $font_type_options;

  // 基本設定
  $input['blog_show_date'] = wp_filter_nohtml_kses( $input['blog_show_date'] );
  $input['blog_show_update'] = wp_filter_nohtml_kses( $input['blog_show_update'] );


  // アーカイブ
  $input['blog_show_header'] = wp_filter_nohtml_kses( $input['blog_show_header'] );
  $input['archive_blog_catch'] = wp_filter_nohtml_kses( $input['archive_blog_catch'] );
  $input['archive_blog_desc'] = wp_kses_post( $input['archive_blog_desc'] );
  $input['archive_blog_desc_mobile'] = wp_kses_post( $input['archive_blog_desc_mobile'] );
  $input['archive_blog_header_image'] = wp_filter_nohtml_kses( $input['archive_blog_header_image'] );
  $input['archive_blog_overlay_color'] = wp_filter_nohtml_kses( $input['archive_blog_overlay_color'] );
  $input['archive_blog_overlay_opacity'] = wp_filter_nohtml_kses( $input['archive_blog_overlay_opacity'] );
  $input['archive_blog_show_category_list'] = wp_filter_nohtml_kses( $input['archive_blog_show_category_list'] );


  // 記事ページ
  $input['single_blog_show_side_bar'] = wp_filter_nohtml_kses( $input['single_blog_show_side_bar'] );
  $input['single_blog_show_sns'] = wp_filter_nohtml_kses( $input['single_blog_show_sns'] );
  $input['single_blog_show_copy'] = wp_filter_nohtml_kses( $input['single_blog_show_copy'] );
  $input['single_blog_show_tag_list'] = wp_filter_nohtml_kses( $input['single_blog_show_tag_list'] );


  // 関連記事
  $input['blog_show_related_post'] = wp_filter_nohtml_kses( $input['blog_show_related_post'] );
  $input['related_post_headline'] = wp_filter_nohtml_kses( $input['related_post_headline'] );
  $input['related_post_sub_headline'] = wp_filter_nohtml_kses( $input['related_post_sub_headline'] );
  $input['related_post_num'] = wp_filter_nohtml_kses( $input['related_post_num'] );
  $input['related_post_num_sp'] = wp_filter_nohtml_kses( $input['related_post_num_sp'] );
  $input['related_post_type'] = wp_filter_nohtml_kses( $input['related_post_type'] );
  $input['related_post_order'] = wp_filter_nohtml_kses( $input['related_post_order'] );
  $input['related_post_order_custom'] = wp_filter_nohtml_kses( $input['related_post_order_custom'] );


  // 記事ページの追加コンテンツ
  $input['single_top_ad_code'] = $input['single_top_ad_code'];
  $input['single_top_ad_code_mobile'] = $input['single_top_ad_code_mobile'];
  $input['single_bottom_ad_code'] = $input['single_bottom_ad_code'];
  $input['single_bottom_ad_code_mobile'] = $input['single_bottom_ad_code_mobile'];
  $input['single_related_post_ad_code'] = $input['single_related_post_ad_code'];
  $input['single_related_post_ad_code_mobile'] = $input['single_related_post_ad_code_mobile'];


	return $input;

};


?>