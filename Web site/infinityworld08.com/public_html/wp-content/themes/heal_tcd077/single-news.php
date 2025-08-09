<?php
     get_header();
     $options = get_design_plus_option();
     $headline = $options['news_title'];
     $headline_color = $options['news_title_color'];
     $sub_title = $options['news_sub_title'];
     $image_id = $options['news_bg_image'];
     if(!empty($image_id)) {
       $image = wp_get_attachment_image_src($image_id, 'full');
     }
     $use_overlay = $options['news_use_overlay'];
     if($use_overlay) {
       $overlay_color = hex2rgb($options['news_overlay_color']);
       $overlay_color = implode(",",$overlay_color);
       $overlay_opacity = $options['news_overlay_opacity'];
     }

     $page_header_font_type_raw = $options['page_header_font_type'];
     $recent_news_headline_font_type_raw = $options['recent_news_headline_font_type'];
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
    $recent_news_headline_font_type = $map[$recent_news_headline_font_type_raw] ?? 1;
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

  <article id="campaign_article">

   <div id="campaign_title_area">
    <h1 class="title rich_font entry-title"><?php the_title(); ?></h1>
    <?php if ( $options['show_news_date'] ){ ?><p class="date"><time class="entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time></p><?php }; ?>
   </div>

   <?php if($page == '1') { // ***** only show on first page ***** ?>

   <?php
        // featured image ------------------------------------------------------------------------------------------------------------------------
        if($options['show_news_image'] && has_post_thumbnail()) {
          $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size3' );
   ?>
   <div id="campaign_post_image">
    <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
   </div>
   <?php }; ?>

   <?php
        // sns button top ------------------------------------------------------------------------------------------------------------------------
        if($options['show_sns_top_news']) {
   ?>
   <div class="single_share clearfix" id="single_share_top">
    <?php get_template_part('template-parts/sns-btn-top'); ?>
   </div>
   <?php }; ?>

   <?php
        // copy title&url button ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        if($options['show_copy_top_news']) {
   ?>
   <div class="single_copy_title_url" id="single_copy_title_url_top">
    <button class="single_copy_title_url_btn" data-clipboard-text="<?php echo esc_attr( strip_tags( get_the_title() ) . ' ' . get_permalink() ); ?>" data-clipboard-copied="<?php echo esc_attr( __( 'COPIED Title&amp;URL', 'tcd-w' ) ); ?>"><?php _e( 'COPY Title&amp;URL', 'tcd-w' ); ?></button>
   </div>
   <?php }; ?>

   <?php
        // banner top ------------------------------------------------------------------------------------------------------------------------
        if(!is_mobile()) {
          if( $options['news_single_top_ad_code1'] || $options['news_single_top_ad_image1'] || $options['news_single_top_ad_code2'] || $options['news_single_top_ad_image2'] ) {
   ?>
   <div id="single_banner_top" class="single_banner_area clearfix<?php if( !$options['news_single_top_ad_code2'] && !$options['news_single_top_ad_image2'] ) { echo ' one_banner'; }; ?>">
    <?php if ($options['news_single_top_ad_code1']) { ?>
    <div class="single_banner single_banner_left">
     <?php echo $options['news_single_top_ad_code1']; ?>
    </div>
    <?php } else { ?>
    <?php $single_image1 = wp_get_attachment_image_src( $options['news_single_top_ad_image1'], 'full' ); ?>
    <div class="single_banner single_banner_left">
     <a href="<?php echo esc_url( $options['news_single_top_ad_url1'] ); ?>" target="_blank"><img src="<?php echo esc_attr($single_image1[0]); ?>" alt="" title="" /></a>
    </div>
    <?php }; ?>
    <?php if ($options['news_single_top_ad_code2']) { ?>
    <div class="single_banner single_banner_right">
     <?php echo $options['news_single_top_ad_code2']; ?>
    </div>
    <?php } else { ?>
    <?php $single_image2 = wp_get_attachment_image_src( $options['news_single_top_ad_image2'], 'full' ); ?>
    <div class="single_banner single_banner_right">
     <a href="<?php echo esc_url( $options['news_single_top_ad_url2'] ); ?>" target="_blank"><img src="<?php echo esc_attr($single_image2[0]); ?>" alt="" title="" /></a>
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
        // sns button ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        if($options['show_sns_btm_news']) {
   ?>
   <div class="single_share clearfix" id="single_share_bottom">
    <?php get_template_part('template-parts/sns-btn-btm'); ?>
   </div>
   <?php }; ?>

   <?php
        // copy title&url button ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        if($options['show_copy_btm_news']) {
   ?>
   <div class="single_copy_title_url" id="single_copy_title_url_bottom">
    <button class="single_copy_title_url_btn" data-clipboard-text="<?php echo esc_attr( strip_tags( get_the_title() ) . ' ' . get_permalink() ); ?>" data-clipboard-copied="<?php echo esc_attr( __( 'COPIED Title&amp;URL', 'tcd-w' ) ); ?>"><?php _e( 'COPY Title&amp;URL', 'tcd-w' ); ?></button>
   </div>
   <?php }; ?>

   <?php
        // banner bottom ------------------------------------------------------------------------------------------------------------------------
        if(!is_mobile()) {
          if( $options['news_single_bottom_ad_code1'] || $options['news_single_bottom_ad_image1'] || $options['news_single_bottom_ad_code2'] || $options['news_single_bottom_ad_image2'] ) {
   ?>
   <div id="single_banner_bottom" class="single_banner_area clearfix<?php if( !$options['news_single_bottom_ad_code2'] && !$options['news_single_bottom_ad_image2'] ) { echo ' one_banner'; }; ?>">
    <?php if ($options['news_single_bottom_ad_code1']) { ?>
    <div class="single_banner single_banner_left">
     <?php echo $options['news_single_bottom_ad_code1']; ?>
    </div>
    <?php } else { ?>
    <?php $single_image1 = wp_get_attachment_image_src( $options['news_single_bottom_ad_image1'], 'full' ); ?>
    <div class="single_banner single_banner_left">
     <a href="<?php echo esc_url( $options['news_single_bottom_ad_url1'] ); ?>" target="_blank"><img src="<?php echo esc_attr($single_image1[0]); ?>" alt="" title="" /></a>
    </div>
    <?php }; ?>
    <?php if ($options['news_single_bottom_ad_code2']) { ?>
    <div class="single_banner single_banner_right">
     <?php echo $options['news_single_bottom_ad_code2']; ?>
    </div>
    <?php } else { ?>
    <?php $single_image2 = wp_get_attachment_image_src( $options['news_single_bottom_ad_image2'], 'full' ); ?>
    <div class="single_banner single_banner_right">
     <a href="<?php echo esc_url( $options['news_single_bottom_ad_url2'] ); ?>" target="_blank"><img src="<?php echo esc_attr($single_image2[0]); ?>" alt="" title="" /></a>
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
   <?php if( $options['news_single_mobile_ad_code1'] || $options['news_single_mobile_ad_image1'] ) { ?>
   <div id="mobile_banner_top" class="single_banner_area one_banner">
    <?php if ($options['news_single_mobile_ad_code1']) { ?>
    <div class="single_banner">
     <?php echo $options['news_single_mobile_ad_code1']; ?>
    </div>
    <?php } else { ?>
    <?php $single_mobile_image = wp_get_attachment_image_src( $options['news_single_mobile_ad_image1'], 'full' ); ?>
    <div class="single_banner">
     <a href="<?php echo esc_url( $options['news_single_mobile_ad_url1'] ); ?>" target="_blank"><img src="<?php echo esc_attr($single_mobile_image[0]); ?>" alt="" title="" /></a>
    </div>
    <?php }; ?>
   </div><!-- END #single_banner_area_top -->
   <?php }; ?>
   <?php }; ?>

   <?php
        // mobile banner ------------------------------------------------------------------------------------------------------------------------
        if(is_mobile()) {
   ?>
   <?php if( $options['news_single_mobile_ad_code2'] || $options['news_single_mobile_ad_image2'] ) { ?>
   <div id="mobile_banner_bottom" class="single_banner_area one_banner">
    <?php if ($options['news_single_mobile_ad_code2']) { ?>
    <div class="single_banner">
     <?php echo $options['news_single_mobile_ad_code2']; ?>
    </div>
    <?php } else { ?>
    <?php $single_mobile_image = wp_get_attachment_image_src( $options['news_single_mobile_ad_image2'], 'full' ); ?>
    <div class="single_banner">
     <a href="<?php echo esc_url( $options['news_single_mobile_ad_url2'] ); ?>" target="_blank"><img src="<?php echo esc_attr($single_mobile_image[0]); ?>" alt="" title="" /></a>
    </div>
    <?php }; ?>
   </div><!-- END #single_banner_area_bottom -->
   <?php }; ?>
   <?php }; // END if mobile ?>

   <?php
        // page nav ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        if ($options['show_news_nav']) :
   ?>
   <div id="next_prev_post" class="clearfix">
    <?php next_prev_post_link(); ?>
   </div>
   <?php endif; ?>

  </article><!-- END #article -->

 <?php endwhile; endif; ?>

 <?php
       // recent news ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
      if ($options['show_recent_news']){
        $num_post = $options['recent_news_num'];
        $args = array('post_type' => 'news', 'showposts'=> $num_post);
        $news_list = new wp_query($args);
        if($news_list->have_posts()):
 ?>
 <div id="recent_news">
  <h3 class="headline rich_font_<?php echo esc_attr($options['recent_news_headline_font_type']); ?>"><?php echo esc_html($options['recent_news_headline']); ?></h3>
  <div class="post_list clearfix">
   <?php
        while( $news_list->have_posts() ) : $news_list->the_post();
          if(has_post_thumbnail()) {
             $image = wp_get_attachment_image_src( get_post_thumbnail_id( $news_list->ID ), 'size1' );
          }
   ?>
   <article class="item clearfix">
    <a class="link" href="<?php the_permalink(); ?>">
     <div class="title_area">
      <h3 class="title"><span><?php the_title(); ?></span></h3>
      <?php if ( $options['show_recent_news_date'] ){ ?><p class="date"><time class="entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time></p><?php }; ?>
     </div>
    </a>
   </article>
   <?php endwhile; wp_reset_query(); ?>
  </div>
  <?php if ($options['show_recent_news_link']){ ?>
  <p class="button"><a href="<?php echo esc_url(get_post_type_archive_link('news')); ?>"><?php echo esc_html($options['recent_news_link_label']); ?></a></p>
  <?php }; ?>
 </div><!-- END #recent_news -->
 <?php endif; }; ?>

 </div><!-- END #main_col -->

 <?php get_sidebar(); ?>

</div><!-- END #main_contents -->

<?php get_footer(); ?>