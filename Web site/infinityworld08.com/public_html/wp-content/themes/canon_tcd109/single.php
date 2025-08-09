<?php
     get_header();
     $options = get_design_plus_option();
     $blog_page_id = get_option( 'page_for_posts' );
     $term_meta = '';
     $category = wp_get_post_terms($post->ID, 'category');
     if ( $category && ! is_wp_error($category) ) {
       foreach ( $category as $cat ) :
         $cat_name = $cat->name;
         $cat_id = $cat->term_id;
         $term_meta = get_option( 'taxonomy_' . $cat_id, array() );
         $cat_url = get_term_link($cat_id,'category');
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

   <div id="single_post_header">

    <?php if ($category) { ?>
    <div class="category">
     <ul>
      <?php
           foreach ( $category as $cat ) :
             $cat_name = $cat->name;
             $cat_id = $cat->term_id;
             $cat_url = get_term_link($cat_id,'category');
      ?>
      <li><a href="<?php echo esc_url($cat_url); ?>"><?php echo esc_html($cat_name); ?></a></li>
      <?php endforeach; ?>
     </ul>
    </div>
    <?php }; ?>

    <h1 class="title entry-title"><?php the_title(); ?></h1>

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
    <?php }; ?>

    <?php
         if(has_post_thumbnail()) {
           $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
    ?>
    <div class="image">
     <img src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
    </div>
    <?php }; ?>

   </div><!-- END #single_post_header -->

   <?php
        // sns button top ------------------------------------------------------------------------------------------------------------------------
       if($options['single_blog_show_sns'] == 'top' || $options['single_blog_show_sns'] == 'both') {
   ?>
   <div class="single_share" id="single_share_top">
    <?php get_template_part('template-parts/share_button'); ?>
   </div>
   <?php }; ?>

   <?php
        // copy title&url button ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        if($options['single_blog_show_copy'] == 'top' || $options['single_blog_show_copy'] == 'both') {
   ?>
   <div class="single_copy_title_url" id="single_copy_title_url_top">
    <button class="single_copy_title_url_btn" data-clipboard-text="<?php echo esc_attr( strip_tags( get_the_title() ) . ' ' . get_permalink() ); ?>" data-clipboard-copied="<?php echo esc_attr( __( 'COPIED TITLE &amp; URL', 'tcd-canon' ) ); ?>"><?php _e( 'COPY TITLE &amp; URL', 'tcd-canon' ); ?></button>
   </div>
   <?php }; ?>

   <?php
        // 追加コンテンツ（上） ------------------------------------------------------------------------------------------------------------------------
        if(!is_mobile()) {
          if( $options['single_top_ad_code']) {
   ?>
   <div id="single_banner_top" class="post_content clearfix single_banner">
    <?php echo $options['single_top_ad_code']; ?>
   </div><!-- END #single_banner_top -->
   <?php
          };
        } else {
          if( $options['single_top_ad_code_mobile']) {
   ?>
   <div id="single_banner_top" class="post_content clearfix single_banner">
    <?php echo $options['single_top_ad_code_mobile']; ?>
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
        if($options['single_blog_show_copy'] == 'bottom' || $options['single_blog_show_copy'] == 'both') {
   ?>
   <div class="single_copy_title_url" id="single_copy_title_url_btm">
    <button class="single_copy_title_url_btn" data-clipboard-text="<?php echo esc_attr( strip_tags( get_the_title() ) . ' ' . get_permalink() ); ?>" data-clipboard-copied="<?php echo esc_attr( __( 'COPIED TITLE &amp; URL', 'tcd-canon' ) ); ?>"><?php _e( 'COPY TITLE &amp; URL', 'tcd-canon' ); ?></button>
   </div>
   <?php }; ?>

   <?php
        // 追加コンテンツ（下） ------------------------------------------------------------------------------------------------------------------------
        if(!is_mobile()) {
          if( $options['single_bottom_ad_code'] ) {
   ?>
   <div id="single_banner_bottom" class="post_content clearfix single_banner">
    <?php echo $options['single_bottom_ad_code']; ?>
   </div><!-- END #single_banner_bottom -->
   <?php
          };
        } else {
          if( $options['single_bottom_ad_code_mobile'] ) {
   ?>
   <div id="single_banner_bottom" class="post_content clearfix single_banner">
    <?php echo $options['single_bottom_ad_code_mobile']; ?>
   </div><!-- END #single_banner_bottom -->
   <?php
          };
        };
   ?>

   <?php
        // meta ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        if ( $options['single_blog_show_tag_list'] == 'display' && has_tag() ) {
          the_tags('<div id="post_tag_list">','','</div>');
        };
   ?>

   <?php
        // sns button ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        if($options['single_blog_show_sns'] == 'bottom' || $options['single_blog_show_sns'] == 'both') {
   ?>
   <div class="single_share" id="single_share_bottom">
    <?php get_template_part('template-parts/share_button'); ?>
   </div>
   <?php }; ?>

   <?php
        // Author profile ------------------------------------------------------------------------------------------------------------------------------
        $author_id = get_the_author_meta('ID');
        $user_data = get_userdata($author_id);
        $show_author = get_the_author_meta( 'show_author', $author_id );
        if(empty($show_author)){
          $show_author = '2';
        }
        if($show_author == '1') {
          $desc = $user_data->description;
          $facebook = $user_data->facebook_url;
          $twitter = $user_data->twitter_url;
          $insta = $user_data->instagram_url;
          $pinterest = $user_data->pinterest_url;
          $youtube = $user_data->youtube_url;
          $tiktok = $user_data->tiktok_url;
          $contact = $user_data->contact_url;
          $author_url = get_author_posts_url($author_id);
          $user_url = $user_data->user_url;
          $line = $user_data->line_url;
   ?>
   <div class="author_profile clearfix">
    <a class="avatar_area animate_background" href="<?php echo esc_url($author_url); ?>">
     <div class="image_wrap"><?php echo wp_kses_post(get_avatar($author_id, 300)); ?></div>
    </a>
    <div class="info">
     <div class="info_inner">
      <h2 class="name"><a href="<?php echo esc_url($author_url); ?>"><span class="author"><?php echo esc_html($user_data->display_name); ?></span></a></h2>
      <?php if($desc) { ?>
      <p class="desc"><span><?php echo wp_kses_post($desc); ?></span></p>
      <?php }; ?>
      <?php if($facebook || $twitter || $insta || $pinterest || $youtube || $contact || $user_url || $tiktok || $line) { ?>
      <ul id="author_sns" class="sns_button_list color_<?php echo esc_attr($options['sns_button_color_type']); ?>">
       <?php if($user_url) { ?><li class="user_url"><a href="<?php echo esc_url($user_url); ?>" target="_blank"><span><?php echo esc_url($user_url); ?></span></a></li><?php }; ?>
       <?php if($line) { ?><li class="line"><a href="<?php echo esc_url($line); ?>" rel="nofollow" target="_blank" title="LINE"><span>LINE</span></a></li><?php }; ?>
       <?php if($insta) { ?><li class="insta"><a href="<?php echo esc_url($insta); ?>" rel="nofollow" target="_blank" title="Instagram"><span>Instagram</span></a></li><?php }; ?>
       <?php if($tiktok) { ?><li class="tiktok"><a href="<?php echo esc_url($tiktok); ?>" rel="nofollow" target="_blank" title="TikTok"><span>TikTok</span></a></li><?php }; ?>
       <?php if($twitter) { ?><li class="twitter"><a href="<?php echo esc_url($twitter); ?>" rel="nofollow" target="_blank" title="X"><span>X</span></a></li><?php }; ?>
       <?php if($facebook) { ?><li class="facebook"><a href="<?php echo esc_url($facebook); ?>" rel="nofollow" target="_blank" title="Facebook"><span>Facebook</span></a></li><?php }; ?>
       <?php if($pinterest) { ?><li class="pinterest"><a href="<?php echo esc_url($pinterest); ?>" rel="nofollow" target="_blank" title="Pinterest"><span>Pinterest</span></a></li><?php }; ?>
       <?php if($youtube) { ?><li class="youtube"><a href="<?php echo esc_url($youtube); ?>" rel="nofollow" target="_blank" title="Youtube"><span>Youtube</span></a></li><?php }; ?>
       <?php if($contact) { ?><li class="contact"><a href="<?php echo esc_url($contact); ?>" rel="nofollow" target="_blank" title="Contact"><span>Contact</span></a></li><?php }; ?>
      </ul>
      <?php }; ?>
     </div>
    </div>
   </div><!-- END .author_profile -->
   <?php }; ?>

   <?php endwhile; endif; ?>

  </article><!-- END #article -->

  <?php
      // ページナビゲーション ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
  ?>
  <div id="next_prev_post" class="inview">
   <?php next_prev_post_link(); ?>
  </div>

  <?php
       // フリースペース ------------------------------------------------------------------------------------------------------------------------
       if(!is_mobile()) {
         if( $options['single_related_post_ad_code']) {
  ?>
  <div id="single_free_space" class="post_content clearfix">
   <?php echo $options['single_related_post_ad_code']; ?>
  </div><!-- END #single_banner_related_post -->
  <?php
         };
       } else {
         if( $options['single_related_post_ad_code_mobile']) {
  ?>
  <div id="single_free_space" class="post_content clearfix">
   <?php echo $options['single_related_post_ad_code_mobile']; ?>
  </div><!-- END #single_banner_related_post -->
  <?php
         };
       };
  ?>

  <?php
       // 関連記事 --------------------
       if($options['blog_show_related_post']){
         $post_num = $options['related_post_num'];
         if(is_mobile()){
           $post_num = $options['related_post_num_sp'];
         }
         $post_type = $options['related_post_type'];
         $post_order = $options['related_post_order'];
         $blog_label = $blog_page_id ?  get_the_title($blog_page_id) : __( 'Post', 'tcd-canon' );
         if ( $post_type == 'category_post' && $category) {
           $category_ids = array();
           if ( $category && ! is_wp_error($category) ) {
             foreach ( $category as $cat ) :
               $category_ids[] = $cat->term_id;
             endforeach;
           }
           $args = array( 'post_type' => 'post', 'post__not_in' => array($post->ID), 'posts_per_page'=> $post_num, 'orderby' => $post_order, 'tax_query' => array(array('taxonomy' => 'category', 'field' => 'term_id', 'terms' => $category_ids)) );
         } elseif ( $post_type == 'recommend_post' || $post_type == 'recommend_post2' || $post_type == 'recommend_post3' ) {
           $args = array('post_type' => 'post', 'posts_per_page' => $post_num, 'orderby' => $post_order, 'meta_key' => $post_type, 'meta_value' => 'on');
         } elseif ( $post_type == 'custom' ) {
           $post_ids = $options['related_post_order_custom'];
           $post_ids_array = array_map('intval', explode(',', $post_ids));
           $args = array( 'post_type' => 'post', 'posts_per_page' => $post_num, 'post__in' => $post_ids_array, 'orderby' => 'post__in' );
         } else {
           $args = array( 'post_type' => 'post', 'posts_per_page' => $post_num, 'orderby' => $post_order );
         }
         $related_post_list = new wp_query($args);
         if($related_post_list->have_posts()):
  ?>
  <div id="single_related_post" class="inview<?php if ( ($options['single_blog_show_side_bar'] == 'display' && is_active_sidebar('post_single_widget')) || ($options['single_blog_show_side_bar'] == 'display' && is_active_sidebar('common_widget')) ) { echo ' type2'; }; ?>">
   <?php if($options['related_post_headline']){ ?><h2 class="headline"><?php echo esc_html($options['related_post_headline']); ?></h2><?php }; ?>
   <?php if($options['related_post_sub_headline']){ ?><p class="sub_title"><?php echo esc_html($options['related_post_sub_headline']); ?></p><?php }; ?>
   <div id="related_post_carousel_wrap">
    <div id="related_post_carousel" class="swiper">
     <div class="blog_list swiper-wrapper">
      <?php
           while( $related_post_list->have_posts() ) : $related_post_list->the_post();
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
    </div><!-- END #related_post_carousel -->
    <div class="related_post_prev swiper-nav-button swiper-button-prev"></div>
    <div class="related_post_next swiper-nav-button swiper-button-next"></div>
   </div><!-- END #related_post_carousel_wrap -->
   <div class="link_button inview">
    <a class="design_button" href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>"><?php printf(__('%s list', 'tcd-canon'), $blog_label); ?></a>
   </div>
  </div><!-- END #single_related_post -->
  <?php
         endif;
       };
  ?>

  <?php
       // コメント ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
       if (comments_open() || pings_open()) { comments_template('', true); };
  ?>

 </div><!-- END #main_col -->

 <?php
      // サイドウィジェット ------------------------
      if ($options['single_blog_show_side_bar'] != 'hide' || is_mobile()) {
        get_sidebar();
      }
 ?>

</div><!-- END #main_content -->


<?php get_footer(); ?>