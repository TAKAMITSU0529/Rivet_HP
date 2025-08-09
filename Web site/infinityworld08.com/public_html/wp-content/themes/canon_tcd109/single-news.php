<?php
     get_header();
     $options = get_design_plus_option();
     $term_meta = '';
     $category = wp_get_post_terms($post->ID, 'news_category');
     if ( $category && ! is_wp_error($category) ) {
       foreach ( $category as $cat ) :
         $cat_name = $cat->name;
         $cat_id = $cat->term_id;
         $term_meta = get_option( 'taxonomy_' . $cat_id, array() );
         $cat_url = get_term_link($cat_id,'news_category');
         break;
       endforeach;
     };
?>

<?php get_template_part('template-parts/breadcrumb'); ?>

<div id="main_content">

 <div id="main_col">

  <article id="article" class="inview">

   <?php
        if ( have_posts() ) : while ( have_posts() ) : the_post();
   ?>

   <?php if($page == '1') { // 1ページ目のみ表示 ?>

   <div id="single_news_header">

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

    <h1 class="title entry-title"><?php the_title(); ?></h1>

    <?php if ($category) { ?>
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

    <?php
         if($options['news_show_image'] == 'display' && has_post_thumbnail()) {
           $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
    ?>
    <div class="image">
     <img src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
    </div>
    <?php }; ?>

   </div><!-- END #single_news_header -->

   <?php
        // sns button top ------------------------------------------------------------------------------------------------------------------------
       if($options['single_news_show_sns'] == 'top' || $options['single_news_show_sns'] == 'both') {
   ?>
   <div class="single_share" id="single_share_top">
    <?php get_template_part('template-parts/share_button'); ?>
   </div>
   <?php }; ?>

   <?php
        // copy title&url button ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        if($options['single_news_show_copy'] == 'top' || $options['single_news_show_copy'] == 'both') {
   ?>
   <div class="single_copy_title_url" id="single_copy_title_url_top">
    <button class="single_copy_title_url_btn" data-clipboard-text="<?php echo esc_attr( strip_tags( get_the_title() ) . ' ' . get_permalink() ); ?>" data-clipboard-copied="<?php echo esc_attr( __( 'COPIED TITLE &amp; URL', 'tcd-canon' ) ); ?>"><?php _e( 'COPY TITLE &amp; URL', 'tcd-canon' ); ?></button>
   </div>
   <?php }; ?>

   <?php
        // 追加コンテンツ（上） ------------------------------------------------------------------------------------------------------------------------
        if(!is_mobile()) {
          if( $options['single_news_top_ad_code']) {
   ?>
   <div id="single_banner_top" class="post_content clearfix single_banner">
    <?php echo $options['single_news_top_ad_code']; ?>
   </div><!-- END #single_banner_top -->
   <?php
          };
        } else {
          if( $options['single_news_top_ad_code_mobile']) {
   ?>
   <div id="single_banner_top" class="post_content clearfix single_banner">
    <?php echo $options['single_news_top_ad_code_mobile']; ?>
   </div><!-- END #single_banner_top -->
   <?php
          };
        };
   ?>

   <?php }; // 1ページ目のみ表示ここまで ?>

   <?php // post content ------------------------------------------------------------------------------------------------------------------------ ?>
   <div class="post_content clearfix">
    <?php
         the_content();
         if ( ! post_password_required() ) {
           custom_wp_link_pages();
         }
    ?>
   </div>

   <?php
        // copy title&url button ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        if($options['single_news_show_copy'] == 'bottom' || $options['single_news_show_copy'] == 'both') {
   ?>
   <div class="single_copy_title_url" id="single_copy_title_url_btm">
    <button class="single_copy_title_url_btn" data-clipboard-text="<?php echo esc_attr( strip_tags( get_the_title() ) . ' ' . get_permalink() ); ?>" data-clipboard-copied="<?php echo esc_attr( __( 'COPIED TITLE &amp; URL', 'tcd-canon' ) ); ?>"><?php _e( 'COPY TITLE &amp; URL', 'tcd-canon' ); ?></button>
   </div>
   <?php }; ?>

  <?php
       // 追加コンテンツ（下） ------------------------------------------------------------------------------------------------------------------------
       if(!is_mobile()) {
         if( $options['single_news_bottom_ad_code'] ) {
  ?>
  <div id="single_banner_bottom" class="post_content clearfix single_banner">
   <?php echo $options['single_news_bottom_ad_code']; ?>
  </div><!-- END #single_banner_bottom -->
  <?php
         };
       } else {
         if( $options['single_news_bottom_ad_code_mobile'] ) {
  ?>
  <div id="single_banner_bottom" class="post_content clearfix single_banner">
   <?php echo $options['single_news_bottom_ad_code_mobile']; ?>
  </div><!-- END #single_banner_bottom -->
  <?php
         };
       };
  ?>

   <?php
        // sns button ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        if($options['single_news_show_sns'] == 'bottom' || $options['single_news_show_sns'] == 'both') {
   ?>
   <div class="single_share" id="single_share_bottom">
    <?php get_template_part('template-parts/share_button'); ?>
   </div>
   <?php }; ?>

   <?php
       // ページナビゲーション ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
   ?>
   <div id="next_prev_post2" class="inview">
    <?php next_prev_post_link2(); ?>
   </div>

   <?php endwhile; endif; ?>

  </article><!-- END #article -->

  <?php
       // 関連記事 --------------------
       if($options['show_related_news']){
         $post_num = $options['related_news_num'];
         if(is_mobile()){
           $post_num = $options['related_news_num_sp'];
         }
         $post_type = $options['related_news_type'];
         $post_order = $options['related_news_order'];
         if ( $post_type == 'recommend_post' || $post_type == 'recommend_post2' || $post_type == 'recommend_post3' ) {
           $args = array('post_type' => 'news', 'posts_per_page' => $post_num, 'orderby' => $post_order, 'meta_key' => $post_type, 'meta_value' => 'on');
         } elseif ( $post_type == 'custom' ) {
           $post_ids = $options['related_news_order_custom'];
           $post_ids_array = array_map('intval', explode(',', $post_ids));
           $args = array( 'post_type' => 'news', 'posts_per_page' => $post_num, 'post__in' => $post_ids_array, 'orderby' => 'post__in' );
         } else {
           $args = array( 'post_type' => 'news', 'posts_per_page' => $post_num, 'orderby' => $post_order );
         }
         $related_post_list = new wp_query($args);
         if($related_post_list->have_posts()):
  ?>
  <div id="related_news" class="inview">
   <?php if($options['related_news_headline']){ ?><h2 class="headline"><?php echo wp_kses_post(nl2br($options['related_news_headline'])); ?></h2><?php }; ?>
   <div class="post_list">
    <?php
         while( $related_post_list->have_posts() ) : $related_post_list->the_post();
           if($options['news_show_image'] == 'display'){
             if(has_post_thumbnail()) {
               $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size3' );
             } elseif($options['no_image']) {
               $image = wp_get_attachment_image_src( $options['no_image'], 'full' );
             } else {
               $image = array();
               $image[0] = get_bloginfo('template_url') . "/img/no_image2.gif";
               $image[1] = '620';
               $image[2] = '400';
             }
           };
    ?>
    <div class="item">
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
   </div><!-- END .post_list -->
  </div><!-- END #single_related_post -->
  <?php
         endif;
       };
  ?>

  <?php
       // フリースペース ------------------------------------------------------------------------------------------------------------------------
       if(!is_mobile()) {
         if( $options['single_news_recent_post_ad_code']) {
  ?>
  <div id="single_free_space" class="post_content clearfix">
   <?php echo $options['single_news_recent_post_ad_code']; ?>
  </div><!-- END #single_banner_related_post -->
  <?php
         };
       } else {
         if( $options['single_news_recent_post_ad_code_mobile']) {
  ?>
  <div id="single_free_space" class="post_content clearfix">
   <?php echo $options['single_news_recent_post_ad_code_mobile']; ?>
  </div><!-- END #single_banner_related_post -->
  <?php
         };
       };
  ?>

 </div><!-- END #main_col -->

 <?php
      // サイドウィジェット ------------------------
      if ($options['single_news_show_side_bar'] != 'hide' || is_mobile()) {
        get_sidebar();
      }
 ?>

</div><!-- END #main_content -->

<?php get_footer(); ?>