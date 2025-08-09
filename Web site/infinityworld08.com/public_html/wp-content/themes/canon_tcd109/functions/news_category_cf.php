<?php

// カテゴリー編集用入力欄を出力 -------------------------------------------------------
function news_category_edit_extra_fields( $term ) {
  $options = get_design_plus_option();
  $news_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-canon' );
	$term_meta = get_option( 'taxonomy_' . $term->term_id, array() );
	$term_meta = array_merge( array(
		'desc_mobile' => '',
		'seo_title' => '',
		'seo_description' => '',
	), $term_meta );
?>
<tr class="form-field term-order-wrap">
 <th><label for="term-order"><?php _e('Description(mobile)', 'tcd-canon'); ?></label></th>
 <td><textarea placeholder="<?php _e( 'Please indicate if you would like to display a short text for mobile sizes.', 'tcd-canon' ); ?>" cols="50" rows="5" name="term_meta[desc_mobile]"><?php echo esc_textarea(  $term_meta['desc_mobile'] ); ?></textarea></td>
</tr><!-- END .form-field -->
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
<?php
}
add_action( 'news_category_edit_form_fields', 'news_category_edit_extra_fields' );


// データを保存 -------------------------------------------------------
function news_category_save_extra_fileds( $term_id ) {
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
add_action( 'edited_news_category', 'news_category_save_extra_fileds' );


