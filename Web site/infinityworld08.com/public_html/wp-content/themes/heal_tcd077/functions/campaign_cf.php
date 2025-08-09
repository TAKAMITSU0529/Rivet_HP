<?php
function campaign_meta_box() {
  add_meta_box(
    'campaign_meta_box',//ID of meta box
    __('Label setting', 'tcd-w'),//label
    'show_campaign_meta_box',//callback function
    'campaign',// post type
    'normal',// context
    'high'// priority
  );
}
add_action('add_meta_boxes', 'campaign_meta_box');

function show_campaign_meta_box() {
  global $post;

  $campaign_label = get_post_meta($post->ID, 'campaign_label', true);
  $campaign_label_font_color = get_post_meta($post->ID, 'campaign_label_font_color', true);
  if(empty($campaign_label_font_color)){
    $campaign_label_font_color = '#ffffff';
  }
  $campaign_label_bg_color = get_post_meta($post->ID, 'campaign_label_bg_color', true);
  if(empty($campaign_label_bg_color)){
    $campaign_label_bg_color = '#eb7145';
  }

  echo '<input type="hidden" name="campaign_custom_fields_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

  //入力欄 ***************************************************************************************************************************************************************************************
?>
<div class="tcd_custom_fields">

  <div class="tcd_cf_content">
   <h3 class="tcd_cf_headline"><?php _e( 'Label', 'tcd-w' ); ?></h3>
   <input class="full_width" type="text" name="campaign_label" value="<?php echo esc_attr($campaign_label); ?>" />
   <h3 class="tcd_cf_headline"><?php _e( 'Font color', 'tcd-w' ); ?></h3>
   <input type="text" name="campaign_label_font_color" value="<?php echo esc_attr( $campaign_label_font_color ); ?>" data-default-color="#ffffff" class="c-color-picker">
   <h3 class="tcd_cf_headline"><?php _e( 'Background color', 'tcd-w' ); ?></h3>
   <input type="text" name="campaign_label_bg_color" value="<?php echo esc_attr( $campaign_label_bg_color ); ?>" data-default-color="#eb7145" class="c-color-picker">
  </div><!-- END .content -->

</div><!-- END #tcd_custom_fields -->

<?php
}

function save_campaign_meta_box( $post_id ) {

  // verify nonce
  if (!isset($_POST['campaign_custom_fields_meta_box_nonce']) || !wp_verify_nonce($_POST['campaign_custom_fields_meta_box_nonce'], basename(__FILE__))) {
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
  $cf_keys = array('campaign_label','campaign_label_font_color','campaign_label_bg_color');
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
add_action('save_post', 'save_campaign_meta_box');



?>