<?php
function service_meta_box() {
  $options = get_design_plus_option();
  $service_label = $options['service_label'] ? esc_html( $options['service_label'] ) : __( 'Service', 'tcd-canon' );
  add_meta_box(
    'service_meta_box',//ID of meta box
    sprintf(__('%s information', 'tcd-canon'), $service_label),//label
    'show_service_meta_box',//callback function
    'service',// post type
    'normal',// context
    'high'// priority
  );
}
add_action('add_meta_boxes', 'service_meta_box', 998);

function show_service_meta_box() {
  global $post, $blog_label;
  $options =  get_design_plus_option();
  $service_label = $options['service_label'] ? esc_html( $options['service_label'] ) : __( 'Service', 'tcd-canon' );

  $service_sub_title = get_post_meta($post->ID, 'service_sub_title', true);

  $image_slider = get_post_meta($post->ID, 'image_slider', true);
  $image_slider_type = get_post_meta($post->ID, 'image_slider_type', true) ?  get_post_meta($post->ID, 'image_slider_type', true) : 'type1';
  $display = 'none';
  $image_ids = explode( ',', $image_slider );

  // プラン一覧
  $show_plan_list = get_post_meta($post->ID, 'show_plan_list', true) ?  get_post_meta($post->ID, 'show_plan_list', true) : '';
  $plan_list_headline = get_post_meta($post->ID, 'plan_list_headline', true) ?  get_post_meta($post->ID, 'plan_list_headline', true) : 'PLAN';
  $plan_list_sub_headline = get_post_meta($post->ID, 'plan_list_sub_headline', true) ?  get_post_meta($post->ID, 'plan_list_sub_headline', true) : '';
  $plan_list_num = get_post_meta($post->ID, 'plan_list_num', true) ?  get_post_meta($post->ID, 'plan_list_num', true) : '6';
  $plan_list_num_sp = get_post_meta($post->ID, 'plan_list_num_sp', true) ?  get_post_meta($post->ID, 'plan_list_num_sp', true) : '4';
  $plan_list_order = get_post_meta($post->ID, 'plan_list_order', true) ?  get_post_meta($post->ID, 'plan_list_order', true) : 'date';

  echo '<input type="hidden" name="service_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

  //入力欄 ***************************************************************************************************************************************************************************************
?>
<div class="tcd_custom_field_wrap">

  <?php // 基本設定 --------------------------------------------------- ?>
  <div class="theme_option_field cf theme_option_field_ac">
   <h3 class="theme_option_headline"><?php _e( 'Basic setting', 'tcd-canon' ); ?></h3>
   <div class="theme_option_field_ac_content">

    <div class="cb_image">
     <img src="<?php bloginfo('template_url'); ?>/admin/img/image/service_sub_title.jpg" width="" height="" />
    </div>
    <ul class="option_list">
     <li class="cf"><span class="label"><?php _e('Sub title', 'tcd-canon'); ?></span><input type="text" class="full_width" name="service_sub_title" value="<?php echo esc_attr($service_sub_title); ?>" /></li>
    </ul>

    <?php // 画像スライダー ----------------------------------------------------------- ?>
    <h4 class="theme_option_headline2"><?php _e('Image slider', 'tcd-canon'); ?></h4>

    <div class="cb_image middle">
     <img src="<?php bloginfo('template_url'); ?>/admin/img/image/image_slider.jpg" width="" height="" />
    </div>

    <div class="theme_option_message2" style="margin-top:20px;">
     <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-canon'), '1000', '550'); ?><br>
     <?php _e('You can register multiple image by clicking images in media library.', 'tcd-canon'); ?><br>
     <?php _e('Please register more than 4 images if you want to display by layout TypeB.', 'tcd-canon'); ?></p>
     <p><?php _e('Please copy and paste the short code below where you want to display image slider.', 'tcd-canon'); ?></p>
     <p><?php _e( 'Short code', 'tcd-canon' ); ?> : <input style="background:#fff; width:200px;" onfocus='this.select();' type="text" value="[tcd_image_slider]" readonly></p>
    </div>

    <ul class="option_list">
     <li class="cf">
      <span class="label"><?php _e('Layout', 'tcd-canon');  ?></span>
      <div class="option_list_right_content item_list cf">
       <div class="item">
        <input class="tcd_admin_image_radio_button" id="image_slider_type1" type="radio" name="image_slider_type" value="type1"<?php if($image_slider_type == 'type1'){ echo ' checked="checked"'; }; ?>>
        <label for="image_slider_type1">
         <span class="image_wrap">
          <img src="<?php bloginfo('template_url'); ?>/admin/img/image/image_slider.jpg" alt="">
         </span>
         <span class="title_wrap">
          <span class="title"><?php _e('TypeA', 'tcd-canon');  ?></span>
         </span>
        </label>
       </div>
       <div class="item">
        <input class="tcd_admin_image_radio_button" id="image_slider_type2" type="radio" name="image_slider_type" value="type2"<?php if($image_slider_type == 'type2'){ echo ' checked="checked"'; }; ?>>
        <label for="image_slider_type2">
         <span class="image_wrap">
          <img src="<?php bloginfo('template_url'); ?>/admin/img/image/image_slider2.jpg" alt="">
         </span>
         <span class="title_wrap">
          <span class="title"><?php _e('TypeB', 'tcd-canon');  ?></span>
         </span>
        </label>
       </div>
      </div>
     </li>
     <li class="cf">
      <span class="label"><?php _e('Image slider', 'tcd-canon');  ?></span>
      <div class="multi-media-uploader">
       <ul>
        <?php
             if ( $image_slider && !empty( $image_ids ) ) {
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
       <a id="image_slider" href="#" class="js-multi-media-upload-button button">
        <?php _e( 'Select Image', 'tcd-canon' ); ?>
       </a>
       <input type="hidden" class="attechments-ids image_slider" name="image_slider" value="<?php echo esc_attr( implode( ',', $image_ids ) ); ?>" />
       <a href="#" class="js-multi-media-remove-button button" style="display:<?php echo $display; ?>;">
        <?php _e( 'Delete all images', 'tcd-canon' ); ?>
       </a>
      </div>
     </li>
    </ul>

    <?php // プラン一覧 ----------------------------------------------------------- ?>
    <h4 class="theme_option_headline2"><?php printf(__('%s list', 'tcd-canon'), $blog_label); ?></h4>

    <div class="cb_image middle">
     <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/image/gallery_plan_list.jpg" alt="" title="" />
    </div>

    <div class="theme_option_message2" style="margin-top:20px;">
     <p><?php printf(__('%1$s post to be displayed in this %2$s page can be set on the <a href="./edit.php" target="_blank">edit screen</a> for each %3$s post.<br>If the article is not set, it will not be displayed.', 'tcd-canon'), $blog_label, $service_label, $blog_label); ?></p>
    </div>

    <p class="displayment_checkbox"><label><input name="show_plan_list" type="checkbox" value="1" <?php checked( $show_plan_list, 1 ); ?>><?php printf(__('Display %s list', 'tcd-canon'), $blog_label); ?></label></p>
    <div style="<?php if($show_plan_list == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">

    <ul class="option_list">
     <li class="cf" style="border-top:1px dotted #ccc;"><span class="label"><span class="num">1</span><?php _e('Catchphrase', 'tcd-canon');  ?></span><input class="full_width" type="text" placeholder="<?php _e( 'e.g.', 'tcd-canon' ); _e( 'Related post', 'tcd-canon' ); ?>" name="plan_list_headline" value="<?php echo esc_attr($plan_list_headline); ?>"></li>
     <li class="cf space"><span class="label"><?php _e('Subheading', 'tcd-canon');  ?></span><input class="full_width" type="text" name="plan_list_sub_headline" value="<?php echo esc_attr($plan_list_sub_headline); ?>"></li>
     <li class="cf post_list_type_normal_option">
      <span class="label"><span class="num">2</span><?php _e('Number of post to display', 'tcd-canon'); ?></span>
      <div class="display_post_num_option">
       <label for="service_voice_num">
        <input class="hankaku" type="number" id="plan_list_num" name="plan_list_num" value="<?php esc_attr_e( $plan_list_num ); ?>"><span class="icon icon_pc"></span>
       </label>
       <label for="service_voice_num_sp">
        <input class="hankaku" type="number" id="plan_list_num_sp" name="plan_list_num_sp" value="<?php esc_attr_e( $plan_list_num_sp ); ?>"><span class="icon icon_sp"></span>
       </label>
      </div>
     </li>
     <li class="cf space post_list_type_normal_option">
      <span class="label"><?php _e('Post order', 'tcd-canon');  ?></span>
      <div class="standard_radio_button">
       <input id="plan_list_order_date" type="radio" name="plan_list_order" value="date" <?php checked( $plan_list_order, 'date' ); ?>>
       <label for="plan_list_order_date"><?php _e('Date', 'tcd-canon'); ?></label>
       <input id="plan_list_order_rand" type="radio" name="plan_list_order" value="rand" <?php checked( $plan_list_order, 'rand' ); ?>>
       <label for="plan_list_order_rand"><?php _e('Random', 'tcd-canon'); ?></label>
      </div>
     </li>
    </ul>

    </div>

    <ul class="button_list cf">
     <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-canon' ); ?></a></li>
    </ul>
   </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->


</div><!-- END .tcd_custom_field_wrap -->

<?php
}

function save_service_meta_box( $post_id ) {

  // verify nonce
  if (!isset($_POST['service_meta_box_nonce']) || !wp_verify_nonce($_POST['service_meta_box_nonce'], basename(__FILE__))) {
    return $post_id;
  }

  // check autosave
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return $post_id;
  }

  // save or delete
  $cf_keys = array(
    'service_sub_title','image_slider', 'image_slider_type',
    'show_plan_list','plan_list_headline','plan_list_sub_headline','plan_list_num','plan_list_num_sp','plan_list_order',
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

}
add_action('save_post', 'save_service_meta_box');


