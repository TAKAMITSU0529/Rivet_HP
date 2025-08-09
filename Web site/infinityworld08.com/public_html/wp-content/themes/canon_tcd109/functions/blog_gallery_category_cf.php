<?php
$options = get_design_plus_option();
function relation_meta_box1() {
  $options = get_design_plus_option();
  $gallery_label = $options['gallery_label'] ? esc_html( $options['gallery_label'] ) : __( 'Guest room', 'tcd-canon' );
  $post_types = array ( 'post' );
  add_meta_box(
    'show_relation_meta_box1',//ID of meta box
    sprintf(__('Link %s category', 'tcd-canon'), $gallery_label),//label
    'show_relation_meta_box1',//callback function
    $post_types,// post type
    'side',// context
  );
}
if($options['use_gallery']){
  add_action('add_meta_boxes', 'relation_meta_box1', 997);
}

function show_relation_meta_box1() {
  global $post, $blog_label;
  $options =  get_design_plus_option();

  $gallery_label = $options['gallery_label'] ? esc_html( $options['gallery_label'] ) : __( 'Guest room', 'tcd-canon' );

  $relation_gallery_category = get_post_meta($post->ID, 'relation_gallery_category', true);

  if (!is_array($relation_gallery_category)) {
    $relation_gallery_category = array();
  };

  echo '<input type="hidden" name="relation_meta_box1_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

  //入力欄 ***************************************************************************************************************************************************************************************
?>

 <div class="theme_option_message2" style="margin-top:15px;">
  <p><?php printf(__('Select the %s category where you would like this article to display.', 'tcd-canon'), $gallery_label); ?></p>
 </div>

<?php if($options['use_gallery']){ ?>
  <?php
      $category_list = get_terms( 'gallery_category', array( 'orderby' => 'order' ) );
      if ( $category_list && ! is_wp_error( $category_list ) ) {
  ?>
  <div class="ralation_list">
   <ul>
    <?php
         foreach ( $category_list as $cat ):
           $cat_id = $cat->term_id;
           $cat_name = $cat->name;
    ?>
    <li><label><input type="checkbox" name="relation_gallery_category[]" value="<?php echo esc_attr($cat_id); ?>" <?php checked(in_array($cat_id, $relation_gallery_category)); ?>><span><?php echo esc_html($cat_name); ?></span></label></li>
    <?php endforeach; ?>
   </ul>
  </div>
  <?php }; ?>
<?php } else { ?>
  <input type="hidden" name="relation_gallery_category" value="<?php echo esc_attr($relation_gallery_category); ?>" />
<?php }; ?>

<?php
}

function save_relation_meta_box1( $post_id ) {

  // verify nonce
  if (!isset($_POST['relation_meta_box1_nonce']) || !wp_verify_nonce($_POST['relation_meta_box1_nonce'], basename(__FILE__))) {
    return $post_id;
  }

  // check autosave
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return $post_id;
  }

  // save or delete
  if (isset($_POST['relation_gallery_category'])) {
    $relation_gallery_category = array_map('sanitize_text_field', $_POST['relation_gallery_category']);
    update_post_meta($post_id, 'relation_gallery_category', $relation_gallery_category);
  } else {
    delete_post_meta($post_id, 'relation_gallery_category');
  }

}
add_action('save_post', 'save_relation_meta_box1');


?>