<?php
$options = get_design_plus_option();
function relation_meta_box2() {
  $options = get_design_plus_option();
  $gallery_label = $options['gallery_label'] ? esc_html( $options['gallery_label'] ) : __( 'Guest room', 'tcd-canon' );
  $post_types = array ( 'post' );
  add_meta_box(
    'show_relation_meta_box2',//ID of meta box
    sprintf(__('Link %s', 'tcd-canon'), $gallery_label),//label
    'show_relation_meta_box2',//callback function
    $post_types,// post type
    'side',// context
  );
}
if($options['use_gallery']){
  add_action('add_meta_boxes', 'relation_meta_box2', 998);
}

function show_relation_meta_box2() {
  global $post, $blog_label;
  $options =  get_design_plus_option();

  $original_post = $post;

  $gallery_label = $options['gallery_label'] ? esc_html( $options['gallery_label'] ) : __( 'Guest room', 'tcd-canon' );

  $relation_gallery = get_post_meta($post->ID, 'relation_gallery', true);

  if (!is_array($relation_gallery)) {
    $relation_gallery = array();
  };

  echo '<input type="hidden" name="relation_meta_box2_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

  //入力欄 ***************************************************************************************************************************************************************************************
?>

 <div class="theme_option_message2" style="margin-top:15px;">
  <p><?php printf(__('Select the %s page where you would like this article to display.', 'tcd-canon'), $gallery_label); ?></p>
 </div>

<?php if($options['use_gallery']){ ?>
  <?php
       $args = array( 'post_status' => 'publish', 'post_type' => 'gallery', 'posts_per_page' => -1, 'orderby' => array('menu_order' => 'ASC', 'date' => 'DESC') );
       $post_list = new wp_query($args);
       if($post_list->have_posts()){
  ?>
  <div class="ralation_list">
   <ul>
    <?php while( $post_list->have_posts() ) : $post_list->the_post(); ?>
    <li><label><input type="checkbox" name="relation_gallery[]" value="<?php echo esc_attr($post->ID); ?>" <?php checked(in_array($post->ID, $relation_gallery)); ?>><span><?php the_title_attribute(); ?></span></label></li>
    <?php endwhile; wp_reset_postdata(); ?>
   </ul>
  </div>
  <?php } else { ?>
  <p><?php printf(__('Please register %s to use this option.', 'tcd-canon'), $gallery_label); ?></p>
  <?php }; ?>
<?php } else { ?>
  <input type="hidden" name="relation_gallery" value="<?php echo esc_attr($relation_gallery); ?>" />
<?php }; ?>

<?php
     $post = $original_post;
     setup_postdata($post);
}

function save_relation_meta_box2( $post_id ) {

  // verify nonce
  if (!isset($_POST['relation_meta_box2_nonce']) || !wp_verify_nonce($_POST['relation_meta_box2_nonce'], basename(__FILE__))) {
    return $post_id;
  }

  // check autosave
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return $post_id;
  }

  // save or delete
  if (isset($_POST['relation_gallery'])) {
    $relation_gallery = array_map('sanitize_text_field', $_POST['relation_gallery']);
    update_post_meta($post_id, 'relation_gallery', $relation_gallery);
  } else {
    delete_post_meta($post_id, 'relation_gallery');
  }

}
add_action('save_post', 'save_relation_meta_box2');


// 管理画面の絞り込み ----------------------------------------------------------------------------------------------------

// ギャラリーカテゴリー用のフィルタ
function add_gallery_category_custom_field_filter() {
  global $typenow;
  $options = get_design_plus_option();
  $gallery_label = $options['gallery_label'] ? esc_html( $options['gallery_label'] ) : __( 'Guest room', 'tcd-canon' );
  if ($typenow == 'post') {
    $category_list = get_terms( 'gallery_category', array( 'orderby' => 'order' ) );
    if ( $category_list && ! is_wp_error( $category_list ) ) {
      echo '<select name="gallery_category_custom_field_filter">';
      echo '<option value="">' . esc_html($gallery_label) . __( 'category', 'tcd-canon' ) . '</option>';
      foreach ( $category_list as $cat ){
        $cat_id = $cat->term_id;
        $cat_name = $cat->name;
        $selected = (isset($_GET['gallery_category_custom_field_filter']) && $_GET['gallery_category_custom_field_filter'] == $cat_id) ? ' selected="selected"' : '';
        echo '<option value="' . esc_attr($cat_id) . '"' . $selected . '>' . esc_html($cat_name) . '</option>';
      }
      echo '</select>';
    }
  }
}
add_action('restrict_manage_posts', 'add_gallery_category_custom_field_filter');


// ギャラリー用のフィルタ
function add_gallery_custom_field_filter() {
  global $typenow;
  $options = get_design_plus_option();
  $gallery_label = $options['gallery_label'] ? esc_html( $options['gallery_label'] ) : __( 'Guest room', 'tcd-canon' );
  if ($typenow == 'post') {
    $args = array(
      'post_status' => 'publish',
      'post_type' => 'gallery',
      'posts_per_page' => -1,
      'orderby' => array('menu_order' => 'ASC', 'date' => 'DESC')
    );
    $post_list = new WP_Query($args);
    if ($post_list->have_posts()) {
      echo '<select name="gallery_custom_field_filter">';
      echo '<option value="">' . esc_html($gallery_label) . '</option>';
      while ($post_list->have_posts()) {
        $post_list->the_post();
        $selected = (isset($_GET['gallery_custom_field_filter']) && $_GET['gallery_custom_field_filter'] == get_the_ID()) ? ' selected="selected"' : '';
        echo '<option value="' . esc_attr(get_the_ID()) . '"' . $selected . '>' . esc_html(get_the_title()) . '</option>';
      }
      echo '</select>';
      wp_reset_postdata();
    }
  }
}
add_action('restrict_manage_posts', 'add_gallery_custom_field_filter');


// サービス用のフィルタ
function add_service_custom_field_filter() {
  global $typenow;
  $options = get_design_plus_option();
  $service_label = $options['service_label'] ? esc_html( $options['service_label'] ) : __( 'Service', 'tcd-canon' );
  if ($typenow == 'post') {
    $args = array(
      'post_status' => 'publish',
      'post_type' => 'service',
      'posts_per_page' => -1,
      'orderby' => array('menu_order' => 'ASC', 'date' => 'DESC')
    );
    $post_list = new WP_Query($args);
    if ($post_list->have_posts()) {
      echo '<select name="service_custom_field_filter">';
      echo '<option value="">' . esc_html($service_label) . '</option>';
      while ($post_list->have_posts()) {
        $post_list->the_post();
        $selected = (isset($_GET['service_custom_field_filter']) && $_GET['service_custom_field_filter'] == get_the_ID()) ? ' selected="selected"' : '';
        echo '<option value="' . esc_attr(get_the_ID()) . '"' . $selected . '>' . esc_html(get_the_title()) . '</option>';
      }
      echo '</select>';
      wp_reset_postdata();
    }
  }
}
add_action('restrict_manage_posts', 'add_service_custom_field_filter');


// クエリの変更
function filter_posts_by_gallery_and_service_custom_fields($query) {
  global $pagenow;
  $gallery_category_custom_field_value = isset($_GET['gallery_category_custom_field_filter']) ? $_GET['gallery_category_custom_field_filter'] : '';
  $gallery_custom_field_value = isset($_GET['gallery_custom_field_filter']) ? $_GET['gallery_custom_field_filter'] : '';
  $service_custom_field_value = isset($_GET['service_custom_field_filter']) ? $_GET['service_custom_field_filter'] : '';
  if (($gallery_category_custom_field_value || $gallery_custom_field_value || $service_custom_field_value) && $pagenow == 'edit.php' && $query->is_main_query()) {
    $meta_query = array('relation' => 'AND');
    if ($gallery_category_custom_field_value) {
      $meta_query[] = array(
        'key' => 'relation_gallery_category',
        'value' => '"' . $gallery_category_custom_field_value . '"',
        'compare' => 'LIKE'
      );
    }
    if ($gallery_custom_field_value) {
      $meta_query[] = array(
        'key' => 'relation_gallery',
        'value' => '"' . $gallery_custom_field_value . '"',
        'compare' => 'LIKE'
      );
    }
    if ($service_custom_field_value) {
      $meta_query[] = array(
        'key' => 'relation_service',
        'value' => '"' . $service_custom_field_value . '"',
        'compare' => 'LIKE'
      );
    }
    $query->set('meta_query', $meta_query);
  }
}
add_action('pre_get_posts', 'filter_posts_by_gallery_and_service_custom_fields');


?>