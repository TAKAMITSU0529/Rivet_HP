<?php
$options = get_design_plus_option();
function relation_meta_box3() {
  $options = get_design_plus_option();
  $service_label = $options['service_label'] ? esc_html( $options['service_label'] ) : __( 'Service', 'tcd-canon' );
  $post_types = array ( 'post' );
  add_meta_box(
    'show_relation_meta_box3',//ID of meta box
    sprintf(__('Link %s', 'tcd-canon'), $service_label),//label
    'show_relation_meta_box3',//callback function
    $post_types,// post type
    'side',// context
  );
}
if($options['use_service']){
  add_action('add_meta_boxes', 'relation_meta_box3', 999);
}

function show_relation_meta_box3() {
  global $post, $blog_label;
  $options =  get_design_plus_option();

  $original_post = $post;

  $service_label = $options['service_label'] ? esc_html( $options['service_label'] ) : __( 'Service', 'tcd-canon' );

  $relation_service = get_post_meta($post->ID, 'relation_service', true);

  if (!is_array($relation_service)) {
    $relation_service = array();
  };

  echo '<input type="hidden" name="relation_meta_box3_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

  //入力欄 ***************************************************************************************************************************************************************************************
?>

 <div class="theme_option_message2" style="margin-top:15px;">
  <p><?php printf(__('Select the %s page where you would like this article to display.', 'tcd-canon'), $service_label); ?></p>
 </div>

<?php if($options['use_service']){ ?>
  <?php
       $args = array( 'post_status' => 'publish', 'post_type' => 'service', 'posts_per_page' => -1, 'orderby' => array('menu_order' => 'ASC', 'date' => 'DESC') );
       $post_list = new wp_query($args);
       if($post_list->have_posts()){
  ?>
  <div class="ralation_list">
   <ul>
    <?php while( $post_list->have_posts() ) : $post_list->the_post(); ?>
    <li><label><input type="checkbox" name="relation_service[]" value="<?php echo esc_attr($post->ID); ?>" <?php checked(in_array($post->ID, $relation_service)); ?>><span><?php the_title_attribute(); ?></span></label></li>
    <?php endwhile; wp_reset_postdata(); ?>
   </ul>
  </div>
  <?php } else { ?>
  <p><?php printf(__('Please register %s to use this option.', 'tcd-canon'), $service_label); ?></p>
  <?php }; ?>
<?php } else { ?>
  <input type="hidden" name="relation_service" value="<?php echo esc_attr($relation_service); ?>" />
<?php }; ?>

<?php
     $post = $original_post;
     setup_postdata($post);
}

function save_relation_meta_box3( $post_id ) {

  // verify nonce
  if (!isset($_POST['relation_meta_box3_nonce']) || !wp_verify_nonce($_POST['relation_meta_box3_nonce'], basename(__FILE__))) {
    return $post_id;
  }

  // check autosave
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return $post_id;
  }

  // save or delete
  if (isset($_POST['relation_service'])) {
    $relation_service = array_map('sanitize_text_field', $_POST['relation_service']);
    update_post_meta($post_id, 'relation_service', $relation_service);
  } else {
    delete_post_meta($post_id, 'relation_service');
  }

}
add_action('save_post', 'save_relation_meta_box3');


?>