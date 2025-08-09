<?php
     get_header();
     $options = get_design_plus_option();
     $headline = $options['blog_title'];
     $headline_color = $options['blog_title_color'];
     $sub_title = $options['blog_sub_title'];
     $image_id = $options['blog_bg_image'];
     if(!empty($image_id)) {
       $image = wp_get_attachment_image_src($image_id, 'full');
     }
     $use_overlay = $options['blog_use_overlay'];
     if($use_overlay) {
       $overlay_color = hex2rgb($options['blog_overlay_color']);
       $overlay_color = implode(",",$overlay_color);
       $overlay_opacity = $options['blog_overlay_opacity'];
     }

     $page_header_font_type_raw = $options['page_header_font_type'];
     $related_post_headline_font_type_raw = $options['related_post_headline_font_type'];
     $map = [
      'type1' => 1,
      'type2' => 1,
      'type3' => 2,
      '1'     => 1,
      '2'     => 2,
      '3'     => 3,
      1       => 1,
      2       => 2,
      3       => 3,
    ];
    
    // 不明な値は 1 にフォールバック
    $page_header_font_type = $map[$page_header_font_type_raw] ?? 1;
    $related_post_headline_font_type = $map[$related_post_headline_font_type_raw] ?? 1;
?>
<div id="page_header" <?php if($image_id) { ?>style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"<?php }; ?>>
 <div class="headline_area rich_font_<?php echo esc_attr($page_header_font_type); ?>">
  <?php if($headline){ ?><div class="headline"><?php echo wp_kses_post(nl2br($headline)); ?></div><?php }; ?>
  <?php if($sub_title){ ?><p class="sub_title"><?php echo wp_kses_post(nl2br($sub_title)); ?></p><?php }; ?>
 </div>
 <?php get_template_part('template-parts/breadcrumb'); ?>
 <?php if($use_overlay) { ?><div class="overlay" style="background:rgba(<?php echo esc_html($overlay_color); ?>,<?php echo esc_html($overlay_opacity); ?>);"></div><?php }; ?>
</div>

<div id="main_contents" class="clearfix">

 <div id="main_col" class="clearfix">

  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

  <article id="article">

   <div id="post_title_area">
    <h1 class="title rich_font entry-title"><?php the_title(); ?></h1>
    <?php if ( $options['show_date'] || $options['show_cate'] ){ ?>
    <ul class="post_meta clearfix">
     <?php if ( $options['show_date'] ){ ?><li class="date"><time class="entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time></li><?php }; ?>
     <?php
        if ($options['show_date'] && $options['show_update']){
          $post_date = get_the_time('Ymd');
          $modified_date = get_the_modified_date('Ymd');
          if($post_date < $modified_date){
     ?>
     <li class="update"><time class="entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_modified_time('Y.m.d'); ?></time></li>
     <?php } } ?>
     <?php if ( $options['show_cate'] ){ ?><li class="category"><?php the_category(' '); ?></li><?php }; ?>
    </ul>
    <?php }; ?>
   </div>

   <?php if($page == '1') { // ***** only show on first page ***** ?>

   <?php
        // featured image ------------------------------------------------------------------------------------------------------------------------
        if($options['show_thumbnail'] && has_post_thumbnail()) {
          $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size3' );
   ?>
   <div id="post_image">
    <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
   </div>
   <?php }; ?>

   <?php
        // sns button top ------------------------------------------------------------------------------------------------------------------------
        if($options['show_sns_top']) {
   ?>
   <div class="single_share clearfix" id="single_share_top">
    <?php get_template_part('template-parts/sns-btn-top'); ?>
   </div>
   <?php }; ?>

   <?php
        // copy title&url button ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        if($options['show_copy_top']) {
   ?>
   <div class="single_copy_title_url" id="single_copy_title_url_top">
    <button class="single_copy_title_url_btn" data-clipboard-text="<?php echo esc_attr( strip_tags( get_the_title() ) . ' ' . get_permalink() ); ?>" data-clipboard-copied="<?php echo esc_attr( __( 'COPIED Title&amp;URL', 'tcd-w' ) ); ?>"><?php _e( 'COPY Title&amp;URL', 'tcd-w' ); ?></button>
   </div>
   <?php }; ?>

   <?php
        // banner top ------------------------------------------------------------------------------------------------------------------------
        if(!is_mobile()) {
          if( $options['single_top_ad_code1'] || $options['single_top_ad_image1'] || $options['single_top_ad_code2'] || $options['single_top_ad_image2'] ) {
   ?>
   <div id="single_banner_top" class="single_banner_area clearfix<?php if( !$options['single_top_ad_code2'] && !$options['single_top_ad_image2'] ) { echo ' one_banner'; }; ?>">
    <?php if ($options['single_top_ad_code1']) { ?>
    <div class="single_banner single_banner_left">
     <?php echo $options['single_top_ad_code1']; ?>
    </div>
    <?php } else { ?>
    <?php $single_image1 = wp_get_attachment_image_src( $options['single_top_ad_image1'], 'full' ); ?>
    <div class="single_banner single_banner_left">
     <a href="<?php echo esc_url( $options['single_top_ad_url1'] ); ?>" target="_blank"><img src="<?php echo esc_attr($single_image1[0]); ?>" alt="" title="" /></a>
    </div>
    <?php }; ?>
    <?php if ($options['single_top_ad_code2']) { ?>
    <div class="single_banner single_banner_right">
     <?php echo $options['single_top_ad_code2']; ?>
    </div>
    <?php } else { ?>
    <?php $single_image2 = wp_get_attachment_image_src( $options['single_top_ad_image2'], 'full' ); ?>
    <div class="single_banner single_banner_right">
     <a href="<?php echo esc_url( $options['single_top_ad_url2'] ); ?>" target="_blank"><img src="<?php echo esc_attr($single_image2[0]); ?>" alt="" title="" /></a>
    </div>
    <?php }; ?>
   </div><!-- END #single_banner_area -->
   <?php
          };
        };
   ?>

   <?php }; // ***** END only show on first page ***** ?>

   <?php // post content ------------------------------------------------------------------------------------------------------------------------ ?>
   <div class="post_content clearfix">
    <?php
         the_content();
         if ( ! post_password_required() ) {
           $pagenation_type = get_post_meta($post->ID, 'pagenation_type', true);
           if($pagenation_type == 'type3') {
             $pagenation_type = $options['pagenation_type'];
           };
           if ( $pagenation_type == 'type2' ) {
             if ( $page < $numpages && preg_match( '/href="(.*?)"/', _wp_link_page( $page + 1 ), $matches ) ) :
    ?>
    <div id="p_readmore">
     <a class="button" href="<?php echo esc_url( $matches[1] ); ?>#article"><?php _e( 'Read more', 'tcd-w' ); ?></a>
     <p class="num"><?php echo $page . ' / ' . $numpages; ?></p>
    </div>
    <?php
             endif;
           } else {
             custom_wp_link_pages();
           }
         }
    ?>
   </div>

   <?php
        // Author profile ------------------------------------------------------------------------------------------------------------------------------
        if($options['show_author_profile']) {
           $author_id = get_the_author_meta('ID');
           $user_data = get_userdata($author_id);
           $show_author = $user_data->show_author;
           if($show_author) {
             $sub_title = $user_data->user_sub_title;
             $desc = $user_data->description;
             $facebook = $user_data->facebook_url;
             $tiktok = $user_data->tiktok_url;
             $twitter = $user_data->twitter_url;
             $insta = $user_data->instagram_url;
             $pinterest = $user_data->pinterest_url;
             $youtube = $user_data->youtube_url;
             $contact = $user_data->contact_url;
             $author_url = get_author_posts_url($author_id);
   ?>
   <div class="author_profile clearfix">
    <a class="avatar animate_image square" href="<?php echo esc_url($author_url); ?>"><?php echo wp_kses_post(get_avatar($author_id, 300)); ?></a>
    <div class="info clearfix">
     <div class="title_area clearfix">
      <div class="name rich_font"><a href="<?php echo esc_url($author_url); ?>"><?php echo esc_html($user_data->display_name); ?></a><?php if($sub_title) { ?><span><?php echo esc_html($sub_title); ?></span><?php }; ?></div>
      <a class="archive_link" href="<?php echo esc_url($author_url); ?>"><span><?php _e("Post list","tcd-w"); ?></span></a>
     </div>
     <?php if($desc) { ?>
     <div class="desc post_content clearfix">
      <?php echo do_shortcode( wpautop(wp_kses_post($desc)) ); ?>
     </div>
     <?php }; ?>
     <?php if($facebook || $twitter || $insta || $pinterest || $youtube || $contact || $tiktok) { ?>
     <ul class="author_link clearfix">
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
   </div><!-- END .author_profile -->
   <?php }; }; ?>

   <?php
        // sns button ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        if($options['show_sns_btm']) {
   ?>
   <div class="single_share clearfix" id="single_share_bottom">
    <?php get_template_part('template-parts/sns-btn-btm'); ?>
   </div>
   <?php }; ?>

   <?php
        // copy title&url button ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        if($options['show_copy_btm']) {
   ?>
   <div class="single_copy_title_url" id="single_copy_title_url_bottom">
    <button class="single_copy_title_url_btn" data-clipboard-text="<?php echo esc_attr( strip_tags( get_the_title() ) . ' ' . get_permalink() ); ?>" data-clipboard-copied="<?php echo esc_attr( __( 'COPIED Title&amp;URL', 'tcd-w' ) ); ?>"><?php _e( 'COPY Title&amp;URL', 'tcd-w' ); ?></button>
   </div>
   <?php }; ?>

   <?php
        // meta ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        if ($options['show_meta_box']) {
   ?>
   <ul id="post_meta_bottom" class="clearfix">
    <?php if ($options['show_meta_author']) : ?><li class="post_author"><?php _e("Author","tcd-w"); ?>: <?php if (function_exists('coauthors_posts_links')) { coauthors_posts_links(', ',', ','','',true); } else { the_author_posts_link(); }; ?></li><?php endif; ?>
    <?php if ($options['show_meta_category']){ ?><li class="post_category"><?php the_category(', '); ?></li><?php }; ?>
    <?php if ($options['show_meta_tag']): ?><?php the_tags('<li class="post_tag">',', ','</li>'); ?><?php endif; ?>
    <?php if ($options['show_meta_comment']) : if (comments_open()){ ?><li class="post_comment"><?php _e("Comment","tcd-w"); ?>: <a href="#comment_headline"><?php comments_number( '0','1','%' ); ?></a></li><?php }; endif; ?>
   </ul>
   <?php }; ?>

  <?php
       // page nav ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
       if ($options['show_next_post']) :
  ?>
  <div id="next_prev_post" class="clearfix">
   <?php next_prev_post_link(); ?>
  </div>
  <?php endif; ?>

   <?php
        // banner bottom ------------------------------------------------------------------------------------------------------------------------
        if(!is_mobile()) {
          if( $options['single_bottom_ad_code1'] || $options['single_bottom_ad_image1'] || $options['single_bottom_ad_code2'] || $options['single_bottom_ad_image2'] ) {
   ?>
   <div id="single_banner_bottom" class="single_banner_area clearfix<?php if( !$options['single_bottom_ad_code2'] && !$options['single_bottom_ad_image2'] ) { echo ' one_banner'; }; ?>">
    <?php if ($options['single_bottom_ad_code1']) { ?>
    <div class="single_banner single_banner_left">
     <?php echo $options['single_bottom_ad_code1']; ?>
    </div>
    <?php } else { ?>
    <?php $single_image1 = wp_get_attachment_image_src( $options['single_bottom_ad_image1'], 'full' ); ?>
    <div class="single_banner single_banner_left">
     <a href="<?php echo esc_url( $options['single_bottom_ad_url1'] ); ?>" target="_blank"><img src="<?php echo esc_attr($single_image1[0]); ?>" alt="" title="" /></a>
    </div>
    <?php }; ?>
    <?php if ($options['single_bottom_ad_code2']) { ?>
    <div class="single_banner single_banner_right">
     <?php echo $options['single_bottom_ad_code2']; ?>
    </div>
    <?php } else { ?>
    <?php $single_image2 = wp_get_attachment_image_src( $options['single_bottom_ad_image2'], 'full' ); ?>
    <div class="single_banner single_banner_right">
     <a href="<?php echo esc_url( $options['single_bottom_ad_url2'] ); ?>" target="_blank"><img src="<?php echo esc_attr($single_image2[0]); ?>" alt="" title="" /></a>
    </div>
    <?php }; ?>
   </div><!-- END #single_banner_area -->
   <?php
          };
        };
   ?>

   <?php
        // mobile banner ------------------------------------------------------------------------------------------------------------------------
        if(is_mobile()) {
   ?>
   <?php if( $options['single_mobile_ad_code1'] || $options['single_mobile_ad_image1'] ) { ?>
   <div id="mobile_banner_top" class="single_banner_area one_banner">
    <?php if ($options['single_mobile_ad_code1']) { ?>
    <div class="single_banner">
     <?php echo $options['single_mobile_ad_code1']; ?>
    </div>
    <?php } else { ?>
    <?php $single_mobile_image = wp_get_attachment_image_src( $options['single_mobile_ad_image1'], 'full' ); ?>
    <div class="single_banner">
     <a href="<?php echo esc_url( $options['single_mobile_ad_url1'] ); ?>" target="_blank"><img src="<?php echo esc_attr($single_mobile_image[0]); ?>" alt="" title="" /></a>
    </div>
    <?php }; ?>
   </div><!-- END #single_banner_area_top -->
   <?php }; ?>
   <?php }; ?>

   <?php
        // mobile banner ------------------------------------------------------------------------------------------------------------------------
        if(is_mobile()) {
   ?>
   <?php if( $options['single_mobile_ad_code2'] || $options['single_mobile_ad_image2'] ) { ?>
   <div id="mobile_banner_bottom" class="single_banner_area one_banner">
    <?php if ($options['single_mobile_ad_code2']) { ?>
    <div class="single_banner">
     <?php echo $options['single_mobile_ad_code2']; ?>
    </div>
    <?php } else { ?>
    <?php $single_mobile_image = wp_get_attachment_image_src( $options['single_mobile_ad_image2'], 'full' ); ?>
    <div class="single_banner">
     <a href="<?php echo esc_url( $options['single_mobile_ad_url2'] ); ?>" target="_blank"><img src="<?php echo esc_attr($single_mobile_image[0]); ?>" alt="" title="" /></a>
    </div>
    <?php }; ?>
   </div><!-- END #single_banner_area_bottom -->
   <?php }; ?>
   <?php }; // END if mobile ?>

  </article><!-- END #article -->

  <?php endwhile; endif; ?>

  <?php
       // related post ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
       if ($options['show_related_post']){
         $categories = get_the_category($post->ID);
         if ($categories) {
           $category_ids = array();
           foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
           $num_post = $options['related_post_num'];
           $args = array( 'category__in' => $category_ids, 'post__not_in' => array($post->ID), 'showposts'=> $num_post, 'orderby' => 'rand');
           $blog_list = new wp_query($args);
           if($blog_list->have_posts()):
  ?>
  <div id="related_post">
   <h2 class="headline rich_font_<?php echo esc_attr($related_post_headline_font_type); ?>"><?php echo esc_html($options['related_post_headline']); ?></h2>
   <div class="related_post clearfix">
    <?php
         while( $blog_list->have_posts() ) : $blog_list->the_post();
           if(has_post_thumbnail()) {
             $image = wp_get_attachment_image_src( get_post_thumbnail_id( $blog_list->ID ), 'size1' );
           } elseif($options['no_image2']) {
             $image = wp_get_attachment_image_src( $options['no_image2'], 'full' );
           } else {
             $image = array();
             $image[0] = esc_url(get_bloginfo('template_url')) . "/img/common/no_image2.gif";
           }
    ?>
    <article class="item">
     <a class="link animate_background" href="<?php the_permalink(); ?>">
      <div class="image_wrap">
       <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
      </div>
     </a>
     <div class="title_area">
      <h3 class="title"><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></h3>
     </div>
    </article>
    <?php endwhile; wp_reset_query(); ?>
   </div><!-- END .recipe_list1 -->
  </div><!-- END #related_post -->
  <?php
          endif;
        };
      };
  ?>

  <?php
       // comment ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
       if ($options['show_comment']) { comments_template('', true); };
  ?>

 </div><!-- END #main_col -->

 <?php get_sidebar(); ?>

</div><!-- END #main_contents -->

<?php get_footer(); ?>
