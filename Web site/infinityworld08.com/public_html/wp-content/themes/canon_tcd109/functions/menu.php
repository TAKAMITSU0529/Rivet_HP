<?php
/**
 * Add data-megamenu attributes to the global navigation
 */
function nano_walker_nav_menu_start_el( $item_output, $item, $depth, $args ) {

  $options = get_design_plus_option();

  if ( 'global-menu' !== $args->theme_location ) return $item_output;

  if ( ! isset( $options['megamenu_new'][$item->ID] ) ) return $item_output;

  if ( 'dropdown' === $options['megamenu_new'][$item->ID] ) return $item_output;

  if ( 'use_megamenu_a' === $options['megamenu_new'][$item->ID] ) {
    return sprintf( '<a href="%s" class="megamenu_button megamenu_type1" data-megamenu="js-megamenu%d">%s</a>', $item->url, $item->ID, $item->title );
  }
  if ( 'use_megamenu_b' === $options['megamenu_new'][$item->ID] ) {
    return sprintf( '<a href="%s" class="megamenu_button megamenu_type2" data-megamenu="js-megamenu%d">%s</a>', $item->url, $item->ID, $item->title );
  }
  if ( 'use_megamenu_c' === $options['megamenu_new'][$item->ID] ) {
    return sprintf( '<a href="%s" class="megamenu_button megamenu_type3" data-megamenu="js-megamenu%d">%s</a>', $item->url, $item->ID, $item->title );
  }
  if ( 'use_megamenu_d' === $options['megamenu_new'][$item->ID] ) {
    return sprintf( '<a href="%s" class="megamenu_button megamenu_type4" data-megamenu="js-megamenu%d">%s</a>', $item->url, $item->ID, $item->title );
  }

}

add_filter( 'walker_nav_menu_start_el', 'nano_walker_nav_menu_start_el', 10, 4 );


// Mega menu A - Post carousel ---------------------------------------------------------------
function render_megamenu_a( $id, $megamenus ) {
  global $post;
  $options = get_design_plus_option();
  $headline = $options['megamenu_a_headline'];
  $catch = $options['megamenu_a_sub_title'];
?>
<div class="megamenu megamenu_a" id="js-megamenu<?php echo esc_attr( $id ); ?>">

 <?php if($headline || $catch){ ?>
 <div class="header">
  <div class="header_inner">
   <?php if($headline){ ?>
   <p class="headline"><?php echo esc_html($headline); ?></p>
   <?php }; ?>
   <?php if($catch){ ?>
   <p class="catch"><?php echo esc_html($catch); ?></p>
   <?php }; ?>
  </div>
 </div>
 <?php }; ?>

 <?php
      $post_type = $options['megamenu_a_post_type'] ? $options['megamenu_a_post_type'] : 'all_post';
      $post_order = $options['megamenu_a_post_order'] ? $options['megamenu_a_post_order'] : 'date';
      $post_category = get_terms( 'category', array('hide_empty' => true) );
      $category_id = intval($options['megamenu_a_category_id']);
      $post_num = $options['megamenu_a_post_num'] ? $options['megamenu_a_post_num'] : '8';
      if ( $post_type == 'category_post' && $post_category && $category_id) {
        $args = array( 'post_status' => 'publish', 'post_type' => 'post', 'posts_per_page' => $post_num, 'orderby' => $post_order, 'tax_query' => array( array( 'taxonomy' => 'category', 'field' => 'term_id', 'terms' => $category_id ), ) );
      } elseif ( $post_type == 'recommend_post' || $post_type == 'recommend_post2' || $post_type == 'recommend_post3' ) {
        $args = array('post_type' => 'post', 'posts_per_page' => $post_num, 'orderby' => $post_order, 'meta_key' => $post_type, 'meta_value' => 'on');
      } elseif ( $post_type == 'custom' ) {
        $post_ids = $options['megamenu_a_post_order_cutom'];
        $post_ids_array = array_map('intval', explode(',', $post_ids));
        $args = array( 'post_type' => 'post', 'posts_per_page' => $post_num, 'post__in' => $post_ids_array, 'orderby' => 'post__in' );
      } else {
        $args = array( 'post_type' => 'post', 'posts_per_page' => $post_num, 'orderby' => $post_order );
      }
      $post_list = new wp_query($args);
      if($post_list->have_posts()):
 ?>
 <div class="megamenu_post_carousel_wrap">
  <div class="megamenu_post_carousel swiper">
   <div class="post_list swiper-wrapper">
    <?php
         while( $post_list->have_posts() ) : $post_list->the_post();
           if(has_post_thumbnail()) {
             $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size2' );
           } elseif($options['no_image']) {
             $image = wp_get_attachment_image_src( $options['no_image'], 'full' );
           } else {
             $image = array();
             $image[0] = get_bloginfo('template_url') . "/img/no_image2.gif";
             $image[1] = '310';
             $image[2] = '200';
           }
    ?>
    <div class="item swiper-slide">
     <a class="animate_background" href="<?php the_permalink(); ?>">
      <div class="image_wrap">
       <img class="image" loading="lazy" src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
      </div>
      <div class="content">
       <p class="title"><span><?php the_title(); ?></span></p>
      </div>
     </a>
     <?php
          if ($post_category) {
            if ( $post_type == 'category_post' && $category_id) {
              $cat_name = get_cat_name($category_id);
              $cat_url = get_term_link($category_id,'category');
            } else {
              $post_category = wp_get_post_terms($post->ID, 'category');
              foreach ( $post_category as $cat ) :
                $cat_name = $cat->name;
                $cat_id = $cat->term_id;
                $cat_url = get_term_link($cat_id,'category');
                break;
              endforeach;
            }
     ?>
     <a class="category" href="<?php echo esc_url($cat_url); ?>"><?php echo esc_html($cat_name); ?></a>
     <?php }; ?>
    </div>
    <?php endwhile; wp_reset_query(); ?>
   </div>
  </div>
  <div class="megamenu_post_prev swiper-nav-button swiper-button-prev"></div>
  <div class="megamenu_post_next swiper-nav-button swiper-button-next"></div>
 </div>
 <?php endif; ?>

</div><!-- END .megamenu_a -->
<?php
};


// Mega menu B - News carousel ---------------------------------------------------------------
function render_megamenu_b( $id, $megamenus ) {
  global $post;
  $options = get_design_plus_option();
  $headline = $options['megamenu_b_headline'];
  $catch = $options['megamenu_b_sub_title'];
?>
<div class="megamenu megamenu_b" id="js-megamenu<?php echo esc_attr( $id ); ?>">

 <?php if($headline || $catch){ ?>
 <div class="header">
  <div class="header_inner">
   <?php if($headline){ ?>
   <p class="headline"><?php echo esc_html($headline); ?></p>
   <?php }; ?>
   <?php if($catch){ ?>
   <p class="catch"><?php echo esc_html($catch); ?></p>
   <?php }; ?>
  </div>
 </div>
 <?php }; ?>

 <?php
      $post_type = $options['megamenu_b_post_type'] ? $options['megamenu_b_post_type'] : 'all_post';
      $post_order = $options['megamenu_b_post_order'] ? $options['megamenu_b_post_order'] : 'date';
      $post_category = get_terms( 'news_category', array('hide_empty' => true) );
      $category_id = intval($options['megamenu_b_category_id']);
      $post_num = $options['megamenu_b_post_num'] ? $options['megamenu_b_post_num'] : '8';
      if ( $post_type == 'category_post' && $post_category && $category_id) {
        $args = array( 'post_status' => 'publish', 'post_type' => 'news', 'posts_per_page' => $post_num, 'orderby' => $post_order, 'tax_query' => array( array( 'taxonomy' => 'news_category', 'field' => 'term_id', 'terms' => $category_id ), ) );
      } elseif ( $post_type == 'recommend_post' || $post_type == 'recommend_post2' || $post_type == 'recommend_post3' ) {
        $args = array('post_type' => 'news', 'posts_per_page' => $post_num, 'orderby' => $post_order, 'meta_key' => $post_type, 'meta_value' => 'on');
      } elseif ( $post_type == 'custom' ) {
        $post_ids = $options['megamenu_b_post_order_cutom'];
        $post_ids_array = array_map('intval', explode(',', $post_ids));
        $args = array( 'post_type' => 'news', 'posts_per_page' => $post_num, 'post__in' => $post_ids_array, 'orderby' => 'post__in' );
      } else {
        $args = array( 'post_type' => 'news', 'posts_per_page' => $post_num, 'orderby' => $post_order );
      }
      $post_list = new wp_query($args);
      if($post_list->have_posts()):
 ?>
 <div class="megamenu_news_carousel_wrap">
  <div class="megamenu_news_carousel swiper">
   <div class="post_list swiper-wrapper">
    <?php
         while( $post_list->have_posts() ) : $post_list->the_post();
           if($options['news_show_image'] == 'display'){
             if(has_post_thumbnail()) {
               $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size1' );
             } elseif($options['no_image']) {
               $image = wp_get_attachment_image_src( $options['no_image'], 'full' );
             } else {
               $image = array();
               $image[0] = get_bloginfo('template_url') . "/img/no_image1.gif";
               $image[1] = '180';
               $image[2] = '180';
             }
           }
    ?>
    <a class="item animate_background swiper-slide" href="<?php the_permalink(); ?>">
     <?php if($options['news_show_image'] == 'display'){ ?>
     <div class="image_wrap">
      <img class="image" loading="lazy" src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
     </div>
     <?php }; ?>
     <div class="date_list">
      <time class="date entry-date published" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
     </div>
     <p class="title"><span><?php the_title(); ?></span></p>
    </a>
    <?php endwhile; wp_reset_query(); ?>
   </div>
  </div>
  <div class="megamenu_news_prev swiper-nav-button swiper-button-prev"></div>
  <div class="megamenu_news_next swiper-nav-button swiper-button-next"></div>
 </div>
 <?php endif; ?>

</div><!-- END .megamenu_b -->
<?php
};


// Mega menu C ---------------------------------------------------------------
function render_megamenu_c( $id, $megamenus ) {
  $options = get_design_plus_option();
  $headline = $options['megamenu_c_headline'];
  $catch = $options['megamenu_c_sub_title'];
?>
<div class="megamenu megamenu_c" id="js-megamenu<?php echo esc_attr( $id ); ?>">

 <?php if($headline || $catch){ ?>
 <div class="header">
  <div class="header_inner">
   <?php if($headline){ ?>
   <p class="headline"><?php echo esc_html($headline); ?></p>
   <?php }; ?>
   <?php if($catch){ ?>
   <p class="catch"><?php echo esc_html($catch); ?></p>
   <?php }; ?>
  </div>
 </div>
 <?php }; ?>

 <?php
      $item_list = $options['megamenu_c_item_list'];
        if($item_list){
 ?>
 <div class="megamenu_gallery_carousel_wrap">
  <div class="megamenu_gallery_carousel swiper">
   <div class="post_list swiper-wrapper">
    <?php
         foreach ( $item_list as $key => $value ) :
           $image = isset($value['image']) ? wp_get_attachment_image_src( $value['image'], 'full' ) : '';
           $title = isset($value['title']) ? $value['title'] : '';
           $desc = isset($value['desc']) ? $value['desc'] : '';
           $url = isset($value['url']) ? $value['url'] : '';
           $target = isset($value['target']) ? $value['target'] : '';
           if($image){
    ?>
    <div class="item swiper-slide">
     <a class="animate_background" href="<?php echo esc_url($url); ?>"<?php if($target){ echo ' target="_blank"'; }; ?>>
      <div class="image_wrap">
       <img class="image" loading="lazy" src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
      </div>
      <?php if($title){ ?>
      <p class="title"><?php echo esc_html($title); ?></p>
      <?php }; ?>
      <?php if($desc){ ?>
      <p class="desc"><span><?php echo wp_kses_post(nl2br($desc)); ?></span></p>
      <?php }; ?>
     </a>
    </div>
    <?php
           };
         endforeach;
    ?>
   </div><!-- END .post_list -->
  </div><!-- END .megamenu_gallery_carousel -->
  <div class="megamenu_gallery_prev swiper-nav-button swiper-button-prev"></div>
  <div class="megamenu_gallery_next swiper-nav-button swiper-button-next"></div>
 </div><!-- END .megamenu_gallery_carousel_wrap -->
 <?php }; ?>

</div><!-- END .megamenu_c -->
<?php
};


// Mega menu D ---------------------------------------------------------------
function render_megamenu_d( $id, $megamenus ) {
  global $post;
  $options = get_design_plus_option();
  $headline = $options['megamenu_d_headline'];
  $catch = $options['megamenu_d_sub_title'];
?>
<div class="megamenu megamenu_d" id="js-megamenu<?php echo esc_attr( $id ); ?>">

 <?php if($headline || $catch){ ?>
 <div class="header">
  <div class="header_inner">
   <?php if($headline){ ?>
   <p class="headline"><?php echo esc_html($headline); ?></p>
   <?php }; ?>
   <?php if($catch){ ?>
   <p class="catch"><?php echo esc_html($catch); ?></p>
   <?php }; ?>
  </div>
 </div>
 <?php }; ?>

 <?php
      $item_list = $options['megamenu_d_item_list'];
        if($item_list){
 ?>
 <div class="megamenu_service_carousel_wrap">
  <div class="megamenu_service_carousel swiper">
   <div class="post_list swiper-wrapper">
    <?php
         foreach ( $item_list as $key => $value ) :
           $image = isset($value['image']) ? wp_get_attachment_image_src( $value['image'], 'full' ) : '';
           $title = isset($value['title']) ? $value['title'] : '';
           $sub_title = isset($value['sub_title']) ? $value['sub_title'] : '';
           $desc = isset($value['desc']) ? $value['desc'] : '';
           $url = isset($value['url']) ? $value['url'] : '';
           $target = isset($value['target']) ? $value['target'] : '';
           if($image){
    ?>
    <a class="item animate_background swiper-slide" href="<?php echo esc_url($url); ?>"<?php if($target){ echo ' target="_blank"'; }; ?>>
     <div class="image_wrap">
      <img class="image" loading="lazy" src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
     </div>
     <?php if($sub_title){ ?>
     <p class="sub_title"><?php echo wp_kses_post(nl2br($sub_title)); ?></p>
     <?php }; ?>
     <?php if($title){ ?>
     <p class="title"><?php echo esc_html($title); ?></p>
     <?php }; ?>
     <?php if($desc){ ?>
     <p class="desc"><span><?php echo wp_kses_post(nl2br($desc)); ?></span></p>
     <?php }; ?>
    </a>
    <?php
           };
         endforeach;
    ?>
   </div>
  </div>
  <div class="megamenu_service_prev swiper-nav-button swiper-button-prev"></div>
  <div class="megamenu_service_next swiper-nav-button swiper-button-next"></div>
 </div>
 <?php }; ?>

</div><!-- END .megamenu_d -->
<?php
};


?>