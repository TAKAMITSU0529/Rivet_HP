<?php

// カテゴリー編集用入力欄を出力 -------------------------------------------------------
function gallery_category_edit_extra_fields( $term ) {
  global $blog_label;
  $options = get_design_plus_option();
  $main_color = $options['main_color'];
  $gallery_label = $options['gallery_label'] ? esc_html( $options['gallery_label'] ) : __( 'Guest room', 'tcd-canon' );
	$term_meta = get_option( 'taxonomy_' . $term->term_id, array() );
	$term_meta = array_merge( array(
		'sub_title' => '',
		'desc' => '',
		'desc_mobile' => '',
    'gallery_image_slider' => '',
    'content' => '',
    'content_mobile' => '',
		'mega_desc' => '',
		'image' => null,
		'seo_title' => '',
		'seo_description' => '',
		'show_gallery_plan_list' => '',
		'gallery_plan_list_headline' => 'PLAN',
		'gallery_plan_list_sub_headline' => '',
		'gallery_plan_list_num' => '6',
		'gallery_plan_list_num_sp' => '3',
		'gallery_plan_list_order' => 'rand',
	), $term_meta );
?>
<tr class="form-field term-order-wrap">
 <th><label for="term-order"><?php _e('Title tag', 'tcd-canon'); ?></label></th>
 <td><input type="text" class="full_width" name="term_meta[seo_title]" value="<?php echo esc_attr($term_meta['seo_title']); ?>" ></td>
</tr><!-- END .form-field -->
<tr class="form-field term-order-wrap">
 <th><label for="term-order"><?php _e('Meta description tag', 'tcd-canon'); ?></label></th>
 <td>
  <textarea class="full_width word_count" cols="50" rows="4" name="term_meta[seo_description]"><?php echo esc_textarea(  $term_meta['seo_description'] ); ?></textarea>
  <p class="word_count_result" style="margin-top:10px;"><?php _e( 'Current character is : <span>0</span>', 'tcd-canon' ); ?></p>
 </td>
</tr><!-- END .form-field -->

<tr class="form-field">
 <th colspan="2">
  <div class="custom_category_meta">
   <h3 class="ccm_headline"><?php _e( 'Category page', 'tcd-canon' ); ?></h3>
   <div class="ccm_content clearfix">
    <div class="input_field">
     <div class="cb_image">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/image/gallery_category.jpg?1.1" alt="" title="" />
     </div>
     <ul class="option_list">
      <li class="cf">
       <span class="label">
        <span class="num">1</span><?php _e('Header image', 'tcd-canon'); ?>
        <span class="recommend_desc space"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-canon'), '1450', '560'); ?></span>
       </span>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js image">
         <input type="hidden" value="<?php if ( $term_meta['image'] ) echo esc_attr( $term_meta['image'] ); ?>" id="image" name="term_meta[image]" class="cf_media_id">
         <div class="preview_field"><?php if ( $term_meta['image'] ) echo wp_get_attachment_image( $term_meta['image'], 'medium'); ?></div>
         <div class="button_area">
          <input type="button" value="<?php _e( 'Select Image', 'tcd-canon' ); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e( 'Remove Image', 'tcd-canon' ); ?>" class="cfmf-delete-img button <?php if ( ! $term_meta['image'] ) echo 'hidden'; ?>">
         </div>
        </div>
       </div>
      </li>
      <li class="cf"><span class="label"><span class="num">2</span><?php _e('Sub title', 'tcd-canon'); ?></span><input type="text" class="full_width" name="term_meta[sub_title]" value="<?php echo esc_attr($term_meta['sub_title']); ?>" ></li>
      <li class="cf"><span class="label"><span class="num">3</span><?php _e('Description', 'tcd-canon'); ?></span><textarea class="full_width" cols="50" rows="5" name="term_meta[desc]"><?php echo esc_textarea(  $term_meta['desc'] ); ?></textarea></li>
      <li class="cf space"><span class="label"><?php _e('Description (mobile)', 'tcd-canon'); ?></span><textarea placeholder="<?php _e( 'Please indicate if you would like to display a short text for mobile sizes.', 'tcd-canon' ); ?>" class="full_width" cols="50" rows="5" name="term_meta[desc_mobile]"><?php echo esc_textarea(  $term_meta['desc_mobile'] ); ?></textarea></li>
      <li class="cf">
       <span class="label">
        <span class="num">4</span><?php _e('Image slider', 'tcd-canon'); ?>
        <span class="recommend_desc space"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-canon'), '1000', '500'); ?></span>
       </span>
       <div class="multi-media-uploader">
        <ul>
         <?php
              $display = 'none';
              $image_ids = explode( ',', $term_meta['gallery_image_slider'] );
              if ( $term_meta['gallery_image_slider'] && !empty( $image_ids ) ) {
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
        <a id="gallery_image_slider" href="#" class="js-multi-media-upload-button button">
         <?php _e( 'Select Image', 'tcd-canon' ); ?>
        </a>
        <input type="hidden" class="attechments-ids gallery_image_slider" name="term_meta[gallery_image_slider]" value="<?php echo esc_attr( implode( ',', $image_ids ) ); ?>" />
        <a href="#" class="js-multi-media-remove-button button" style="display:<?php echo $display; ?>;">
         <?php _e( 'Delete all images', 'tcd-canon' ); ?>
        </a>
       </div>
      </li>
      <li class="cf"><span class="label"><span class="num">5</span><?php _e('Description', 'tcd-canon'); ?></span><textarea class="full_width" cols="50" rows="10" name="term_meta[content]"><?php echo esc_textarea(  $term_meta['content'] ); ?></textarea></li>
      <li class="cf space"><span class="label"><?php _e('Description (mobile)', 'tcd-canon'); ?></span><textarea placeholder="<?php _e( 'Please indicate if you would like to display a short text for mobile sizes.', 'tcd-canon' ); ?>" class="full_width" cols="50" rows="10" name="term_meta[content_mobile]"><?php echo esc_textarea(  $term_meta['content_mobile'] ); ?></textarea></li>
     </ul>

     <h3 class="theme_option_headline2"><?php printf(__('%s list', 'tcd-canon'), $blog_label); ?></h3>

     <div class="cb_image middle">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/image/gallery_plan_list.jpg" alt="" title="" />
     </div>

     <div class="theme_option_message2" style="margin-top:15px;">
      <p><?php printf(__('%1$s post to be displayed in category page can be set on the <a href="./edit.php" target="_blank">edit screen</a> for each %2$s post.<br>If the article is not set, it will not be displayed.', 'tcd-canon'), $blog_label, $blog_label); ?></p>
     </div>

     <input type="hidden" value="none" name="term_meta[show_gallery_plan_list]">
     <p class="displayment_checkbox"><label><input name="term_meta[show_gallery_plan_list]" type="checkbox" value="1" <?php checked( $term_meta['show_gallery_plan_list'], 1 ); ?>><?php printf(__('Display %s list', 'tcd-canon'), $blog_label); ?></label></p>
     <div style="<?php if($term_meta['show_gallery_plan_list'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">

     <ul class="option_list">
      <li class="cf" style="border-top:1px dotted #ccc;"><span class="label"><span class="num">1</span><?php _e('Headline', 'tcd-canon');  ?></span><input class="full_width" type="text" placeholder="<?php _e( 'e.g.', 'tcd-canon' ); _e( 'Related post', 'tcd-canon' ); ?>" name="term_meta[gallery_plan_list_headline]" value="<?php echo esc_attr($term_meta['gallery_plan_list_headline']); ?>"></li>
      <li class="cf space"><span class="label"><?php _e('Subheading', 'tcd-canon');  ?></span><input class="full_width" type="text" name="term_meta[gallery_plan_list_sub_headline]" value="<?php echo esc_attr($term_meta['gallery_plan_list_sub_headline']); ?>"></li>
      <li class="cf post_list_type_normal_option">
       <span class="label"><span class="num">2</span><?php _e('Number of post to display', 'tcd-canon'); ?></span>
       <div class="display_post_num_option">
        <label for="gallery_plan_list_num"><input type="number" id="gallery_plan_list_num" name="term_meta[gallery_plan_list_num]" value="<?php echo esc_attr($term_meta['gallery_plan_list_num']); ?>" min="1"><span class="icon icon_pc"></span></label>
        <label for="gallery_plan_list_num_sp"><input type="number" id="gallery_plan_list_num_sp" name="term_meta[gallery_plan_list_num_sp]" value="<?php echo esc_attr($term_meta['gallery_plan_list_num_sp']); ?>" min="1"><span class="icon icon_sp"></span></label>
       </div>
      </li>
      <li class="cf space post_list_type_normal_option">
       <span class="label"><?php _e('Post order', 'tcd-canon');  ?></span>
       <div class="standard_radio_button">
        <input id="gallery_plan_list_order_date" type="radio" name="term_meta[gallery_plan_list_order]" value="date" <?php checked( $term_meta['gallery_plan_list_order'], 'date' ); ?>>
        <label for="gallery_plan_list_order_date"><?php _e('Date', 'tcd-canon'); ?></label>
        <input id="gallery_plan_list_order_rand" type="radio" name="term_meta[gallery_plan_list_order]" value="rand" <?php checked( $term_meta['gallery_plan_list_order'], 'rand' ); ?>>
        <label for="gallery_plan_list_order_rand"><?php _e('Random', 'tcd-canon'); ?></label>
       </div>
      </li>
     </ul>

     </div>

    </div><!-- END input_field -->
   </div><!-- END ccm_content -->
  </div><!-- END .custom_category_meta -->
 </th>
</tr><!-- END .form-field -->

<?php
}
add_action( 'gallery_category_edit_form_fields', 'gallery_category_edit_extra_fields' );


// データを保存 -------------------------------------------------------
function gallery_category_save_extra_fileds( $term_id ) {
  $new_meta = array();
  if ( isset( $_POST['term_meta'] ) ) {
		$current_term_id = $term_id;
		$cat_keys = array_keys( $_POST['term_meta'] );
		foreach ( $cat_keys as $key ) {
			if ( isset ( $_POST['term_meta'][$key] ) ) {
				$new_meta[$key] = $_POST['term_meta'][$key];
			}
		}
	}
  update_option( "taxonomy_$current_term_id", $new_meta );
}
add_action( 'edited_gallery_category', 'gallery_category_save_extra_fileds' );


