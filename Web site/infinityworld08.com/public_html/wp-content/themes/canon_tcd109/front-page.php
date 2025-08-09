<?php
     $options = get_design_plus_option();
     get_header();
?>
<?php
     // 通常のコンテンツを読み込む ------------------------------------------------------------------------------
     if($options['index_content_type'] == 'type2'){
       if ( have_posts() ) : while ( have_posts() ) : the_post();
         $page_content_width = $options['page_content_width'] ?  $options['page_content_width'] : '1000';
?>
<article id="front_page_contents" class="layout_<?php echo esc_attr($options['page_content_width_type']); ?>">
 <div class="post_content clearfix"<?php if($options['page_content_width_type'] == 'type1'){ echo ' style="max-width:' . esc_attr($page_content_width) . 'px;"'; }; ?>>
  <?php
       the_content();
       if ( ! post_password_required() ) {
         custom_wp_link_pages();
       }
  ?>
 </div>
</article><!-- END #front_page_contents -->
<?php
        endwhile; endif;
     } else {
?>
<div id="content_builder">
<?php
     // コンテンツビルダー
     if ($options['contents_builder']) :
       $content_count = 1;
       $contents_builder = $options['contents_builder'];
       foreach($contents_builder as $content) :

         // 画像スライダー --------------------------------------------------------------------------------
         if ( $content['type'] == 'image_slider' && $content['show_content']) {
           $headline = isset($content['headline']) ?  $content['headline'] : '';
           $sub_title = isset($content['sub_title']) ?  $content['sub_title'] : '';
           $desc = isset($content['desc']) ?  $content['desc'] : '';
           $desc_mobile = isset($content['desc_mobile']) ?  $content['desc_mobile'] : '';
           $layout = isset($content['layout']) ?  $content['layout'] : 'type1';
           $image_slider = isset($content['image_slider']) ?  $content['image_slider'] : '';
           $button_label = isset($content['button_label']) ?  $content['button_label'] : '';
           $button_url = isset($content['button_url']) ?  $content['button_url'] : '';
           $button_target = isset($content['button_target']) ?  $content['button_target'] : '';
?>
<section class="cb_image_slider cb_white_bg num<?php echo $content_count; ?>" id="<?php echo 'cb_content_' . $content_count; ?>">

 <?php if($headline || $sub_title || $desc){ ?>
 <div class="cb_header inview">
  <?php if($headline){ ?>
  <h2 class="headline"><?php echo wp_kses_post(nl2br($headline)); ?></h2>
  <?php }; ?>
  <?php if($sub_title){ ?>
  <p class="sub_title"><?php echo wp_kses_post(nl2br($sub_title)); ?></p>
  <?php }; ?>
  <?php if($desc){ ?>
  <div class="desc"><p><?php if($desc_mobile){ echo '<span class="pc">'; }; ?><?php echo wp_kses_post(nl2br($desc)); ?><?php if($desc_mobile){ echo '</span><span class="mobile">' . wp_kses_post(nl2br($desc_mobile)) . '</span>'; }; ?></p></div>
  <?php }; ?>
 </div>
 <?php }; ?>

 <?php
      if($image_slider){
        $image_slider = !empty($image_slider) ? explode( ',', $image_slider ) : array();
        $total_slide = count($image_slider);
 ?>
 <div class="sc_image_carousel_container layout_<?php echo esc_attr($layout); ?> inview">
  <div class="sc_image_carousel_wrap swiper">
   <div class="sc_image_carousel swiper-wrapper">
    <?php
         foreach( $image_slider as $image_id ):
           $slider_image = wp_get_attachment_image_src( $image_id, 'full' );
           if($slider_image){
    ?>
    <div class="item swiper-slide">
     <img src="<?php echo esc_attr($slider_image[0]); ?>" alt="" width="<?php echo esc_attr($slider_image[1]); ?>" height="<?php echo esc_attr($slider_image[2]); ?>">
    </div>
    <?php
           };
         endforeach;
    ?>
   </div><!-- END .sc_image_carousel -->
  </div><!-- END .sc_image_carousel_wrap -->
  <?php if($layout == 'type1'){ ?>
  <div class='sc_image_carousel_pagination swiper-pagination'></div>
  <?php
       } else {
         if($total_slide != 1){
  ?>
  <div class="sc_image_carousel_nav swiper">
   <div class="swiper-wrapper">
    <?php
         foreach( $image_slider as $image_id ):
           $slider_image = wp_get_attachment_image_src( $image_id, 'full' );
           if($slider_image){
    ?>
    <div class="swiper-slide"></div>
    <?php
           };
         endforeach;
    ?>
   </div>
  </div>
  <?php
         };
       };
  ?>
 </div><!-- END .sc_image_carousel_container -->
 <?php }; ?>

 <?php if($button_label && $button_url){ ?>
 <div class="link_button inview">
  <a class="design_button" href="<?php echo esc_url($button_url); ?>"<?php if($button_target){ echo ' target="_blank"'; }; ?>><?php echo esc_html($button_label); ?></a>
 </div>
 <?php }; ?>

</section><!-- END .cb_image_slider -->

<?php
         // デザインコンテンツ --------------------------------------------------------------------------------
         } elseif ( $content['type'] == 'design_content' && $content['show_content'] ) {
           $headline = isset($content['headline']) ?  $content['headline'] : '';
           $sub_title = isset($content['sub_title']) ?  $content['sub_title'] : '';
           $desc = isset($content['desc']) ?  $content['desc'] : '';
           $desc_mobile = isset($content['desc_mobile']) ?  $content['desc_mobile'] : '';
           $catch= isset($content['catch']) ?  $content['catch'] : '';
           $desc2 = isset($content['desc2']) ?  $content['desc2'] : '';
           $layout = isset($content['layout']) ?  $content['layout'] : 'type1';
           $image_slider = isset($content['image_slider']) ?  $content['image_slider'] : '';
           $button_label = isset($content['button_label']) ?  $content['button_label'] : '';
           $button_url = isset($content['button_url']) ?  $content['button_url'] : '';
           $button_target = isset($content['button_target']) ?  $content['button_target'] : '';
?>
<section class="cb_design_content cb_white_bg num<?php echo $content_count; ?>" id="<?php echo 'cb_content_' . $content_count; ?>">

 <?php if($headline || $sub_title || $desc){ ?>
 <div class="cb_header inview">
  <?php if($headline){ ?>
  <h2 class="headline"><?php echo wp_kses_post(nl2br($headline)); ?></h2>
  <?php }; ?>
  <?php if($sub_title){ ?>
  <p class="sub_title"><?php echo wp_kses_post(nl2br($sub_title)); ?></p>
  <?php }; ?>
  <?php if($desc){ ?>
  <div class="desc"><p><?php if($desc_mobile){ echo '<span class="pc">'; }; ?><?php echo wp_kses_post(nl2br($desc)); ?><?php if($desc_mobile){ echo '</span><span class="mobile">' . wp_kses_post(nl2br($desc_mobile)) . '</span>'; }; ?></p></div>
  <?php }; ?>
 </div>
 <?php }; ?>

 <div class="main_content inview layout_<?php echo esc_attr($layout); ?>">

  <?php
       if($image_slider){
         $image_slider = !empty($image_slider) ? explode( ',', $image_slider ) : array();
  ?>
  <div class="dc_image_carousel_container">
   <div class="dc_image_carousel_wrap swiper">
    <div class="dc_image_carousel swiper-wrapper">
     <?php
          foreach( $image_slider as $image_id ):
            $slider_image = wp_get_attachment_image_src( $image_id, 'full' );
            if($slider_image){
     ?>
     <div class="item swiper-slide">
      <img src="<?php echo esc_attr($slider_image[0]); ?>" alt="" width="<?php echo esc_attr($slider_image[1]); ?>" height="<?php echo esc_attr($slider_image[2]); ?>">
     </div>
     <?php
            };
          endforeach;
     ?>
    </div><!-- END .dc_image_carousel -->
    <div class="dc_image_carousel_pagination swiper-pagination"></div>
   </div><!-- END .dc_image_carousel_wrap -->
  </div><!-- END .dc_image_carousel_container -->
  <?php }; ?>

  <?php if($catch || $desc2){ ?>
  <div class="content">
   <?php if($catch){ ?>
   <h3 class="catch"><?php echo wp_kses_post(nl2br($catch)); ?></h3>
   <?php }; ?>
   <?php if($desc2){ ?>
   <p class="desc"><?php echo wp_kses_post(nl2br($desc2)); ?></p>
   <?php }; ?>
  </div>
  <?php }; ?>

 </div>

 <?php if($button_label && $button_url){ ?>
 <div class="link_button inview">
  <a class="design_button" href="<?php echo esc_url($button_url); ?>"<?php if($button_target){ echo ' target="_blank"'; }; ?>><?php echo esc_html($button_label); ?></a>
 </div>
 <?php }; ?>

</section><!-- END .cb_design_content -->

<?php
         // コンテンツカルーセル --------------------------------------------------------------------------------
         } elseif ( $content['type'] == 'content_carousel' && $content['show_content'] ) {
           $headline = isset($content['headline']) ?  $content['headline'] : '';
           $sub_title = isset($content['sub_title']) ?  $content['sub_title'] : '';
           $desc = isset($content['desc']) ?  $content['desc'] : '';
           $desc_mobile = isset($content['desc_mobile']) ?  $content['desc_mobile'] : '';
           $item_list = isset($content['item_list']) ?  $content['item_list'] : '';
           $button_label = isset($content['button_label']) ?  $content['button_label'] : '';
           $button_url = isset($content['button_url']) ?  $content['button_url'] : '';
           $button_target = isset($content['button_target']) ?  $content['button_target'] : '';
?>
<section class="cb_content_carousel cb_white_bg num<?php echo $content_count; ?>" id="<?php echo 'cb_content_' . $content_count; ?>">

 <?php if($headline || $sub_title || $desc){ ?>
 <div class="cb_header inview">
  <?php if($headline){ ?>
  <h2 class="headline"><?php echo wp_kses_post(nl2br($headline)); ?></h2>
  <?php }; ?>
  <?php if($sub_title){ ?>
  <p class="sub_title"><?php echo wp_kses_post(nl2br($sub_title)); ?></p>
  <?php }; ?>
  <?php if($desc){ ?>
  <div class="desc"><p><?php if($desc_mobile){ echo '<span class="pc">'; }; ?><?php echo wp_kses_post(nl2br($desc)); ?><?php if($desc_mobile){ echo '</span><span class="mobile">' . wp_kses_post(nl2br($desc_mobile)) . '</span>'; }; ?></p></div>
  <?php }; ?>
 </div>
 <?php }; ?>

 <?php
      // コンテンツ一覧
      if (!empty($item_list)) {
 ?>
 <div class="cb_content_carousel_container inview">
  <div class="cb_content_carousel_wrap swiper">
   <div class="cb_content_carousel_main swiper-wrapper">
    <?php
         foreach ( $item_list as $key => $value ) :
           $image = isset($value['image']) ?  wp_get_attachment_image_src($value['image'], 'full') : '';
           $title = isset($value['title']) ?  $value['title'] : '';
           $sub_title = isset($value['sub_title']) ?  $value['sub_title'] : '';
           $url = isset($value['url']) ?  $value['url'] : '';
           $target = isset($value['target']) ?  $value['target'] : '';
           if($image){
    ?>
    <div class="item swiper-slide">
     <a class="animate_background<?php if(!$url){ echo ' no_link'; }; ?>" href="<?php if($url){ echo esc_url($url); } else { echo '#'; }; ?>"<?php if($target){ echo ' target="_blank"'; }; ?>>
      <div class="image_wrap">
       <img loading="lazy" class="image" src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
      </div>
      <div class="content">
       <?php if($sub_title){ ?>
       <p class="sub_title"><span><?php echo wp_kses_post(nl2br($sub_title)); ?></span></p>
       <?php }; ?>
       <?php if($title){ ?>
       <h3 class="title"><span><?php echo esc_html($title); ?></span></h3>
       <?php }; ?>
      </div>
     </a>
    </div>
    <?php
           };
          endforeach;
    ?>
   </div><!-- END .cb_content_carousel -->
  </div><!-- END .cb_content_carousel_wrap -->
  <div class="cb_content_carousel_prev swiper-nav-button swiper-button-prev"></div>
  <div class="cb_content_carousel_next swiper-nav-button swiper-button-next"></div>
 </div><!-- END .cb_content_carousel_container -->
 <?php }; ?>

 <?php if($button_label && $button_url){ ?>
 <div class="link_button inview">
  <a class="design_button" href="<?php echo esc_url($button_url); ?>"<?php if($button_target){ echo ' target="_blank"'; }; ?>><?php echo esc_html($button_label); ?></a>
 </div>
 <?php }; ?>

</section><!-- END .cb_content_carousel -->

<?php
         // 2コンテンツ --------------------------------------------------------------------------------
         } elseif ( $content['type'] == 'two_column' && $content['show_content'] ) {
           $headline = isset($content['headline']) ?  $content['headline'] : '';
           $sub_title = isset($content['sub_title']) ?  $content['sub_title'] : '';
           $desc = isset($content['desc']) ?  $content['desc'] : '';
           $desc_mobile = isset($content['desc_mobile']) ?  $content['desc_mobile'] : '';
           $item_list = isset($content['item_list']) ?  $content['item_list'] : '';
           $button_label = isset($content['button_label']) ?  $content['button_label'] : '';
           $button_url = isset($content['button_url']) ?  $content['button_url'] : '';
           $button_target = isset($content['button_target']) ?  $content['button_target'] : '';
?>
<section class="cb_two_column cb_white_bg num<?php echo $content_count; ?>" id="<?php echo 'cb_content_' . $content_count; ?>">

 <?php if($headline || $sub_title || $desc){ ?>
 <div class="cb_header inview">
  <?php if($headline){ ?>
  <h2 class="headline"><?php echo wp_kses_post(nl2br($headline)); ?></h2>
  <?php }; ?>
  <?php if($sub_title){ ?>
  <p class="sub_title"><?php echo wp_kses_post(nl2br($sub_title)); ?></p>
  <?php }; ?>
  <?php if($desc){ ?>
  <div class="desc"><p><?php if($desc_mobile){ echo '<span class="pc">'; }; ?><?php echo wp_kses_post(nl2br($desc)); ?><?php if($desc_mobile){ echo '</span><span class="mobile">' . wp_kses_post(nl2br($desc_mobile)) . '</span>'; }; ?></p></div>
  <?php }; ?>
 </div>
 <?php }; ?>

 <?php
      // コンテンツ一覧
      if (!empty($item_list)) {
 ?>
 <div class="item_list inview">
  <?php
       foreach ( $item_list as $key => $value ) :
         $image = isset($value['image']) ?  wp_get_attachment_image_src($value['image'], 'full') : '';
         $headline = isset($value['headline']) ?  $value['headline'] : '';
         $sub_title = isset($value['sub_title']) ?  $value['sub_title'] : '';
         $desc = isset($value['desc']) ?  $value['desc'] : '';
         $url = isset($value['url']) ?  $value['url'] : '';
         $target = isset($value['target']) ?  $value['target'] : '';
         if($image){
  ?>
  <a class="item animate_background<?php if(!$url){ echo ' no_link'; }; ?>" href="<?php if($url){ echo esc_url($url); } else { echo '#'; }; ?>"<?php if($target){ echo ' target="_blank"'; }; ?>>
   <div class="image_wrap">
    <img loading="lazy" class="image" src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
   </div>
   <div class="content">
    <?php if($headline || $sub_title){ ?>
    <h3 class="headline"><?php if($headline){ ?><span class="title"><?php echo esc_html($headline); ?></span><?php }; ?><?php if($sub_title){ ?><span class="sub_title"><?php echo wp_kses_post(nl2br($sub_title)); ?></span><?php }; ?></h3>
    <?php }; ?>
    <?php if($desc){ ?>
    <p class="desc"><?php echo wp_kses_post(nl2br($desc)); ?></p>
    <?php }; ?>
   </div>
  </a>
  <?php
         };
        endforeach;
  ?>
 </div><!-- END .item_list -->
 <?php }; ?>

 <?php if($button_label && $button_url){ ?>
 <div class="link_button inview">
  <a class="design_button" href="<?php echo esc_url($button_url); ?>"<?php if($button_target){ echo ' target="_blank"'; }; ?>><?php echo esc_html($button_label); ?></a>
 </div>
 <?php }; ?>

</section><!-- END .cb_two_column -->

<?php
         // 3コンテンツ --------------------------------------------------------------------------------
         } elseif ( $content['type'] == 'three_column' && $content['show_content'] ) {
           $headline = isset($content['headline']) ?  $content['headline'] : '';
           $sub_title = isset($content['sub_title']) ?  $content['sub_title'] : '';
           $desc = isset($content['desc']) ?  $content['desc'] : '';
           $desc_mobile = isset($content['desc_mobile']) ?  $content['desc_mobile'] : '';
           $item_list = isset($content['item_list']) ?  $content['item_list'] : '';
           $button_label = isset($content['button_label']) ?  $content['button_label'] : '';
           $button_url = isset($content['button_url']) ?  $content['button_url'] : '';
           $button_target = isset($content['button_target']) ?  $content['button_target'] : '';
?>
<section class="cb_three_column cb_white_bg num<?php echo $content_count; ?>" id="<?php echo 'cb_content_' . $content_count; ?>">

 <?php if($headline || $sub_title || $desc){ ?>
 <div class="cb_header inview">
  <?php if($headline){ ?>
  <h2 class="headline"><?php echo wp_kses_post(nl2br($headline)); ?></h2>
  <?php }; ?>
  <?php if($sub_title){ ?>
  <p class="sub_title"><?php echo wp_kses_post(nl2br($sub_title)); ?></p>
  <?php }; ?>
  <?php if($desc){ ?>
  <div class="desc"><p><?php if($desc_mobile){ echo '<span class="pc">'; }; ?><?php echo wp_kses_post(nl2br($desc)); ?><?php if($desc_mobile){ echo '</span><span class="mobile">' . wp_kses_post(nl2br($desc_mobile)) . '</span>'; }; ?></p></div>
  <?php }; ?>
 </div>
 <?php }; ?>

 <?php
      // コンテンツ一覧
      if (!empty($item_list)) {
 ?>
 <div class="three_column_carousel_container inview">
  <div class="three_column_carousel_wrap swiper">
   <div class="three_column_carousel swiper-wrapper">
    <?php
         foreach ( $item_list as $key => $value ) :
           $image = isset($value['image']) ?  wp_get_attachment_image_src($value['image'], 'full') : '';
           $title = isset($value['title']) ?  $value['title'] : '';
           $url = isset($value['url']) ?  $value['url'] : '';
           $target = isset($value['target']) ?  $value['target'] : '';
           if($image){
    ?>
    <div class="item swiper-slide">
     <a class="animate_background<?php if(!$url){ echo ' no_link'; }; ?>" href="<?php if($url){ echo esc_url($url); } else { echo '#'; }; ?>"<?php if($target){ echo ' target="_blank"'; }; ?>>
      <div class="image_wrap">
       <img loading="lazy" class="image" src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
      </div>
      <?php if($title){ ?>
      <h3 class="title"><?php echo esc_html($title); ?></h3>
      <?php }; ?>
     </a>
    </div>
    <?php
           };
          endforeach;
    ?>
   </div><!-- END .three_column_carousel -->
  </div><!-- END .three_column_carousel_wrap -->
  <div class="three_column_carousel_prev swiper-nav-button swiper-button-prev"></div>
  <div class="three_column_carousel_next swiper-nav-button swiper-button-next"></div>
 </div><!-- END .three_column_carousel_container -->
 <?php }; ?>

 <?php if($button_label && $button_url){ ?>
 <div class="link_button inview">
  <a class="design_button" href="<?php echo esc_url($button_url); ?>"<?php if($button_target){ echo ' target="_blank"'; }; ?>><?php echo esc_html($button_label); ?></a>
 </div>
 <?php }; ?>

</section><!-- END .cb_three_column -->

<?php
         // ブログ記事一覧 --------------------------------------------------------------------------------
         } elseif ( $content['type'] == 'blog_list' && $content['show_content'] ) {
           $headline = isset($content['headline']) ?  $content['headline'] : '';
           $sub_title = isset($content['sub_title']) ?  $content['sub_title'] : '';
           $desc = isset($content['desc']) ?  $content['desc'] : '';
           $desc_mobile = isset($content['desc_mobile']) ?  $content['desc_mobile'] : '';
           $button_label = isset($content['button_label']) ?  $content['button_label'] : '';
           $post_type = isset($content['post_type']) ?  $content['post_type'] : 'all_post';
           $post_num = isset($content['post_num']) ?  $content['post_num'] : 6;
           if(is_mobile()){
             $post_num = isset($content['post_num_sp']) ?  $content['post_num_sp'] : 6;
           };
           $show_category_list = isset($content['show_category_list']) ?  $content['show_category_list'] : 'display';
            $archive_link = get_permalink(get_option('page_for_posts'));
            $category_type = 'category';
            $show_update = $options['blog_show_update'];
            $post_order = isset($content['post_order']) ?  $content['post_order'] : 'date';
           /*if($post_type == 'post'){
           } else {
             $archive_link = get_post_type_archive_link('news');
             $category_type = 'news_category';
             $show_update = $options['news_show_update'];
           }*/
           if($show_category_list=="display"){
                $args = array( 'post_type' => 'post', 'orderby' => $post_order, 'posts_per_page' => $post_num);
           }else{
                $post_category = get_terms( 'category', array('orderby' => 'id', 'order' => 'ASC', 'hide_empty' => true) );
                $category_id = isset($content['category_id']) ?  $content['category_id'] : '';
                $category_id = intval($category_id);
                $post_order_custom = isset($content['post_order_custom']) ?  $content['post_order_custom'] : '';
                if ( $post_type == 'category_post' && $post_category) {
                    $args = array( 'post_status' => 'publish', 'post_type' => 'post', 'posts_per_page' => $post_num, 'orderby' => $post_order, 'tax_query' => array( array( 'taxonomy' => 'category', 'field' => 'term_id', 'terms' => $category_id ), ) );
                } elseif ( $post_type == 'recommend_post' || $post_type == 'recommend_post2' || $post_type == 'recommend_post3' ) {
                    $args = array('post_type' => 'post', 'posts_per_page' => $post_num, 'orderby' => $post_order, 'meta_key' => $post_type, 'meta_value' => 'on');
                } elseif ( $post_type == 'custom') {
                    $post_ids = $post_order_custom;
                    $post_ids_array = array_map('intval', explode(',', $post_ids));
                    $args = array( 'post_status' => 'publish', 'post_type' => 'post', 'posts_per_page' => $post_num, 'post__in' => $post_ids_array, 'orderby' => 'post__in' );
                } else {
                    $args = array( 'post_status' => 'publish', 'post_type' => 'post', 'posts_per_page' => $post_num, 'orderby' => $post_order );
                }
           }
?>
<section class="cb_blog_list num<?php echo $content_count; ?>" id="<?php echo 'cb_content_' . $content_count; ?>">

 <?php if($headline || $sub_title || $desc){ ?>
 <div class="cb_header inview">
  <?php if($headline){ ?>
  <h2 class="headline"><?php echo wp_kses_post(nl2br($headline)); ?></h2>
  <?php }; ?>
  <?php if($sub_title){ ?>
  <p class="sub_title"><?php echo wp_kses_post(nl2br($sub_title)); ?></p>
  <?php }; ?>
  <?php if($desc){ ?>
  <div class="desc"><p><?php if($desc_mobile){ echo '<span class="pc">'; }; ?><?php echo wp_kses_post(nl2br($desc)); ?><?php if($desc_mobile){ echo '</span><span class="mobile">' . wp_kses_post(nl2br($desc_mobile)) . '</span>'; }; ?></p></div>
  <?php }; ?>
 </div>
 <?php }; ?>

 <div class="main_content inview">

  <?php
       // カテゴリー一覧 --------------------------------------
       if($show_category_list == 'display'){
         $category_list = get_terms( $category_type, array( 'parent' => 0, 'hide_empty' => true ) );
         $category_total = count($category_list);
         if ( $category_list && ! is_wp_error( $category_list ) && ($category_total > 1) ) {
            $total_category = count($category_list);
  ?>
  <div class="category_sort_button_wrap inview<?php if($total_category < 6){ echo ' small_size'; }; ?>">
   <div class="category_sort_button_slider swiper">
    <div class="category_sort_button swiper-wrapper">
     <?php
          foreach ( $category_list as $cat ):
            $cat_id = $cat->term_id;
            $cat_name = $cat->name;
            $cat_url = get_term_link($cat_id,$category_type);
     ?>
     <div class="item swiper-slide">
      <a data-category-id="cat_<?php echo esc_attr($cat_id); ?>" href="<?php echo esc_url($cat_url); ?>"><?php echo esc_html($cat_name); ?></a>
     </div>
     <?php endforeach; ?>
    </div>
   </div>
   <div class="category_sort_button_prev swiper-nav-button type2 swiper-button-prev"></div>
   <div class="category_sort_button_next swiper-nav-button type2 swiper-button-next"></div>
  </div>
  <?php
         };
       };
  ?>

  <div class="index_post_list_wrap">

   <?php
        // 最新の記事一覧 ----------------------
        //$args = array( 'post_type' => $post_type, 'posts_per_page' => $post_num);
        $post_list = new wp_query($args);
        if($post_list->have_posts()):
   ?>
   <div class="index_post_list active<?php if($show_category_list == 'display'){ echo ' cat_all'; } ?>">
    <div class="index_post_list_inner">
     <div class="index_post_carousel_wrap">
      <div class="index_post_carousel swiper" data-slider-id="1">
       <div class="blog_list swiper-wrapper">
        <?php
             while( $post_list->have_posts() ) : $post_list->the_post();
               if(has_post_thumbnail()) {
                 $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size2' );
               } elseif($options['no_image']) {
                 $image = wp_get_attachment_image_src( $options['no_image'], 'full' );
               } else {
                 $image = array();
                 $image[0] = get_bloginfo('template_url') . "/img/no_image2.gif";
                 $image[1] = '720';
                 $image[2] = '460';
               }
        ?>
        <div class="item swiper-slide">
         <a class="animate_background" href="<?php the_permalink(); ?>">
          <div class="image_wrap">
           <img loading="lazy" class="image" src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
          </div>
         </a>
         <div class="content">
          <div class="content_inner">
           <h3 class="title"><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></h3>
           <div class="meta">
            <?php if($options['blog_show_date'] == 'display'){ ?>
            <div class="date_list">
             <time class="date entry-date published" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
             <?php
                    $post_date = get_the_time('Ymd');
                    $modified_date = get_the_modified_date('Ymd');
                    if($post_date < $modified_date && $options['blog_show_update'] == 'display'){
             ?>
             <time class="update entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_modified_date('Y.m.d'); ?></time>
             <?php }; ?>
            </div>
            <?php
                 };
                 $category = wp_get_post_terms($post->ID, 'category');
                 if ( $category && ! is_wp_error($category) ) {
            ?>
            <div class="category_list">
             <?php
                  foreach ( $category as $cat ) :
                    $cat_name = $cat->name;
                    $cat_id = $cat->term_id;
                    $cat_url = get_term_link($cat_id,'category');
             ?>
             <a class="category" href="<?php echo esc_url($cat_url); ?>"><?php echo esc_html($cat_name); ?></a>
             <?php endforeach; ?>
            </div>
            <?php }; ?>
           </div>
          </div>
         </div>
        </div>
        <?php endwhile; wp_reset_query(); ?>
       </div><!-- END .blog_list -->
      </div><!-- END .index_post_carousel -->
      <div class="index_post_carousel_prev swiper-nav-button swiper-button-prev" data-slider-id="1"></div>
      <div class="index_post_carousel_next swiper-nav-button swiper-button-next" data-slider-id="1"></div>
     </div><!-- END .index_post_carousel_wrap -->
    </div><!-- END index_post_list_inner -->
   </div><!-- END index_post_list -->
   <?php endif; ?>

   <?php
        // カテゴリー別　記事一覧 ---------------------------------------------------
        if ( $show_category_list == 'display' && $category_list && ! is_wp_error( $category_list ) && ($category_total > 1)) :
          $i = 2;
          foreach ( $category_list as $cat ):
            $cat_id = $cat->term_id;
            $cat_name = $cat->name;
            $cat_url = get_term_link($cat_id,$category_type);
            $args = array( 'post_type' => 'post', 'orderby' => $post_order, 'posts_per_page' => $post_num, 'tax_query' => array( array( 'taxonomy' => $category_type, 'field' => 'term_id', 'terms' => $cat_id ) ) );
            $post_list = new wp_query($args);
            if($post_list->have_posts()):
   ?>
   <div class="index_post_list cat_<?php echo esc_attr($cat_id); ?>">
    <div class="index_post_list_inner">
     <div class="index_post_carousel_wrap">
      <div class="index_post_carousel swiper" data-slider-id="<?php echo $i; ?>">
       <div class="blog_list swiper-wrapper">
        <?php
             while( $post_list->have_posts() ) : $post_list->the_post();
               if(has_post_thumbnail()) {
                 $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size2' );
               } elseif($options['no_image']) {
                 $image = wp_get_attachment_image_src( $options['no_image'], 'full' );
               } else {
                 $image = array();
                 $image[0] = get_bloginfo('template_url') . "/img/no_image2.gif";
                 $image[1] = '720';
                 $image[2] = '460';
               }
        ?>
        <div class="item swiper-slide">
         <a class="animate_background" href="<?php the_permalink(); ?>">
          <div class="image_wrap">
           <img loading="lazy" class="image" src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
          </div>
         </a>
         <div class="content">
          <div class="content_inner">
           <h3 class="title"><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></h3>
           <div class="meta">
            <?php if($options['blog_show_date'] == 'display'){ ?>
            <div class="date_list">
             <time class="date entry-date published" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
             <?php
                    $post_date = get_the_time('Ymd');
                    $modified_date = get_the_modified_date('Ymd');
                    if($post_date < $modified_date && $options['blog_show_update'] == 'display'){
             ?>
             <time class="update entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_modified_date('Y.m.d'); ?></time>
             <?php }; ?>
            </div>
            <?php
                 };
            ?>
            <div class="category_list">
             <a class="category" href="<?php echo esc_url($cat_url); ?>"><?php echo esc_html($cat_name); ?></a>
            </div>
           </div>
          </div>
         </div>
        </div>
        <?php endwhile; wp_reset_query(); ?>
       </div><!-- END .blog_list -->
      </div><!-- END .index_post_carousel -->
      <div class="index_post_carousel_prev swiper-nav-button swiper-button-prev" data-slider-id="<?php echo $i; ?>"></div>
      <div class="index_post_carousel_next swiper-nav-button swiper-button-next" data-slider-id="<?php echo $i; ?>"></div>
     </div><!-- END .index_post_carousel_wrap -->
    </div><!-- END index_post_list_inner -->
   </div><!-- END index_post_list -->
   <?php
            endif;
            wp_reset_postdata();
            $i++;
          endforeach;
        endif;
   ?>

  </div><!-- END .index_post_list_wrap -->

 </div><!-- END .main_content -->

 <?php if($button_label){ ?>
 <div class="link_button inview">
  <a class="design_button" href="<?php echo esc_url($archive_link); ?>"><?php echo esc_html($button_label); ?></a>
 </div>
 <?php }; ?>

</section><!-- END .cb_blog_list -->

<?php
         // お知らせ一覧 --------------------------------------------------------------------------------
         } elseif ( $content['type'] == 'news_list' && $content['show_content'] && $options['use_news']) {
           $headline = isset($content['headline']) ?  $content['headline'] : '';
           $sub_title = isset($content['sub_title']) ?  $content['sub_title'] : '';
           $desc = isset($content['desc']) ?  $content['desc'] : '';
           $desc_mobile = isset($content['desc_mobile']) ?  $content['desc_mobile'] : '';
           $button_label = isset($content['button_label']) ?  $content['button_label'] : '';
?>
<section class="cb_news_list cb_white_bg num<?php echo $content_count; ?>" id="<?php echo 'cb_content_' . $content_count; ?>">

 <?php if($headline || $sub_title || $desc){ ?>
 <div class="cb_header inview">
  <?php if($headline){ ?>
  <h2 class="headline"><?php echo wp_kses_post(nl2br($headline)); ?></h2>
  <?php }; ?>
  <?php if($sub_title){ ?>
  <p class="sub_title"><?php echo wp_kses_post(nl2br($sub_title)); ?></p>
  <?php }; ?>
  <?php if($desc){ ?>
  <div class="desc"><p><?php if($desc_mobile){ echo '<span class="pc">'; }; ?><?php echo wp_kses_post(nl2br($desc)); ?><?php if($desc_mobile){ echo '</span><span class="mobile">' . wp_kses_post(nl2br($desc_mobile)) . '</span>'; }; ?></p></div>
  <?php }; ?>
 </div>
 <?php }; ?>

 <?php
      $post_num = isset($content['post_num']) ?  $content['post_num'] : '6';
      if(is_mobile()){
        $post_num = isset($content['post_num_sp']) ?  $content['post_num_sp'] : '6';
      }
      $post_category = get_terms( 'news_category', array('orderby' => 'id', 'order' => 'ASC', 'hide_empty' => true) );
      $category_id = isset($content['category_id']) ?  $content['category_id'] : '';
      $category_id = intval($category_id);
      $post_order = isset($content['post_order']) ?  $content['post_order'] : 'date';
      $post_type = isset($content['post_type']) ?  $content['post_type'] : 'recent_post';
      $post_order_custom = isset($content['post_order_custom']) ?  $content['post_order_custom'] : '';
      if ( $post_type == 'category_post' && $post_category) {
        $args = array( 'post_status' => 'publish', 'post_type' => 'news', 'posts_per_page' => $post_num, 'orderby' => $post_order, 'tax_query' => array( array( 'taxonomy' => 'news_category', 'field' => 'term_id', 'terms' => $category_id ), ) );
      } elseif ( $post_type == 'recommend_post' || $post_type == 'recommend_post2' || $post_type == 'recommend_post3' ) {
        $args = array('post_type' => 'news', 'posts_per_page' => $post_num, 'orderby' => $post_order, 'meta_key' => $post_type, 'meta_value' => 'on');
      } elseif ( $post_type == 'custom') {
        $post_ids = $post_order_custom;
        $post_ids_array = array_map('intval', explode(',', $post_ids));
        $args = array( 'post_status' => 'publish', 'post_type' => 'news', 'posts_per_page' => $post_num, 'post__in' => $post_ids_array, 'orderby' => 'post__in' );
      } else {
        $args = array( 'post_status' => 'publish', 'post_type' => 'news', 'posts_per_page' => $post_num, 'orderby' => $post_order );
      }
      $post_list = new wp_query($args);
      if($post_list->have_posts()):
 ?>
 <div class="cb_news_carousel_wrap inview">
  <div class="cb_news_carousel swiper">
   <div class="news_list swiper-wrapper">
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
           };
    ?>
    <div class="item swiper-slide">
     <?php if($options['news_show_image'] == 'display'){ ?>
     <a class="animate_background" href="<?php the_permalink(); ?>">
      <div class="image_wrap">
       <img loading="lazy" class="image" src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
      </div>
     </a>
     <?php }; ?>
     <div class="content">
      <div class="date_list">
       <time class="date entry-date published" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
       <?php
            $post_date = get_the_time('Ymd');
            $modified_date = get_the_modified_date('Ymd');
            if($post_date < $modified_date && $options['news_show_update'] == 'display'){
       ?>
       <time class="update entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_modified_date('Y.m.d'); ?></time>
       <?php }; ?>
      </div>
      <h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
      <?php
           $category = wp_get_post_terms($post->ID, 'news_category');
           if ( $category && ! is_wp_error($category) ) {
      ?>
      <div class="category">
       <?php
            foreach ( $category as $cat ) :
              $cat_name = $cat->name;
              $cat_id = $cat->term_id;
              $cat_url = get_term_link($cat_id,'news_category');
       ?>
       <a href="<?php echo esc_url($cat_url); ?>"><?php echo esc_html($cat_name); ?></a>
       <?php endforeach; ?>
      </div>
      <?php }; ?>
     </div>
    </div>
    <?php endwhile; wp_reset_query(); ?>
   </div><!-- END .news_list -->
  </div><!-- END .cb_news_carousel -->
  <div class="cb_news_carousel_prev swiper-nav-button swiper-button-prev"></div>
  <div class="cb_news_carousel_next swiper-nav-button swiper-button-next"></div>
 </div><!-- END .cb_news_carousel_wrap -->
 <?php endif; wp_reset_query(); ?>

 <?php if($button_label){ ?>
 <div class="link_button inview">
  <a class="design_button" href="<?php echo esc_url(get_post_type_archive_link('news')); ?>"><?php echo esc_html($button_label); ?></a>
 </div>
 <?php }; ?>

</section><!-- END .cb_news_list -->

<?php
         // フリースペース -----------------------------------------------------
         } elseif ( $content['type'] == 'free_space' && $content['show_content'] ) {
           $headline = isset($content['headline']) ?  $content['headline'] : '';
           $sub_title = isset($content['sub_title']) ?  $content['sub_title'] : '';
           $desc = isset($content['desc']) ?  $content['desc'] : '';
           $desc_mobile = isset($content['desc_mobile']) ?  $content['desc_mobile'] : '';
           $content_width = isset($content['content_width']) ?  $content['content_width'] : 'type1';
           $free_space = isset($content['free_space']) ?  $content['free_space'] : '';
?>
<section class="cb_free_space cb_white_bg num<?php echo $content_count; ?><?php if($content_width == 'type2'){ echo ' wide_content'; }; ?> inview" id="<?php echo 'cb_content_' . $content_count; ?>">

 <?php if($headline || $sub_title || $desc){ ?>
 <div class="cb_header inview">
  <?php if($headline){ ?>
  <h2 class="headline"><?php echo wp_kses_post(nl2br($headline)); ?></h2>
  <?php }; ?>
  <?php if($sub_title){ ?>
  <p class="sub_title"><?php echo wp_kses_post(nl2br($sub_title)); ?></p>
  <?php }; ?>
  <?php if($desc){ ?>
  <div class="desc"><p><?php if($desc_mobile){ echo '<span class="pc">'; }; ?><?php echo wp_kses_post(nl2br($desc)); ?><?php if($desc_mobile){ echo '</span><span class="mobile">' . wp_kses_post(nl2br($desc_mobile)) . '</span>'; }; ?></p></div>
  <?php }; ?>
 </div>
 <?php }; ?>

 <?php if($free_space){ ?>
 <div class="post_content clearfix inview">
  <?php echo apply_filters('the_content', $free_space ); ?>
 </div>
 <?php }; ?>

</section><!-- END .cb_free_space -->
<?php
         };
       $content_count++;
       endforeach;
     endif;

// コンテンツビルダーここまで
?>
</div><!-- END #content_builder -->
<?php
      }; // END index_content_type
?>

<?php get_footer(); ?>