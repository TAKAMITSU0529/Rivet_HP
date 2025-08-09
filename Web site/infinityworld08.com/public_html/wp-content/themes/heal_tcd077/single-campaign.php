<?php
     get_header();
     $options = get_design_plus_option();
     $headline = $options['campaign_title'];
     $headline_color = $options['campaign_title_color'];
     $sub_title = $options['campaign_sub_title'];
     $image_id = $options['campaign_bg_image'];
     if(!empty($image_id)) {
       $image = wp_get_attachment_image_src($image_id, 'full');
     }
     $use_overlay = $options['campaign_use_overlay'];
     if($use_overlay) {
       $overlay_color = hex2rgb($options['campaign_overlay_color']);
       $overlay_color = implode(",",$overlay_color);
       $overlay_opacity = $options['campaign_overlay_opacity'];
     }

     $page_header_font_type_raw = $options['page_header_font_type'];
     $related_campaign_headline_font_type_raw = $options['related_campaign_headline_font_type'];
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
    $related_campaign_headline_font_type = $map[$related_campaign_headline_font_type_raw] ?? 1;
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

   <?php
        $campaign_label = get_post_meta($post->ID, 'campaign_label', true);
        $campaign_label_font_color = get_post_meta($post->ID, 'campaign_label_font_color', true);
          if(empty($campaign_label_font_color)){ $campaign_label_font_color = '#ffffff'; }
        $campaign_label_bg_color = get_post_meta($post->ID, 'campaign_label_bg_color', true);
          if(empty($campaign_label_bg_color)){ $campaign_label_bg_color = '#eb7145'; }
   ?>
   <div id="campaign_title_area">
    <?php if($campaign_label){ ?><p class="label" style="background:<?php echo esc_html($campaign_label_bg_color); ?>; color:<?php echo esc_html($campaign_label_font_color); ?>;"><?php echo esc_html($campaign_label); ?></p><?php }; ?>
    <h1 class="title rich_font entry-title"><?php the_title(); ?></h1>
    <?php if ( $options['single_campaign_show_date'] ){ ?><p class="date"><time class="entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time></p><?php }; ?>
   </div>

   <?php if($page == '1') { // ***** only show on first page ***** ?>

   <?php
        // featured image ------------------------------------------------------------------------------------------------------------------------
        if(has_post_thumbnail()) {
          $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size3' );
   ?>
   <div id="campaign_post_image">
    <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
   </div>
   <?php }; ?>

   <?php
        // sns button top ------------------------------------------------------------------------------------------------------------------------
        if($options['show_sns_top_campaign']) {
   ?>
   <div class="single_share clearfix" id="single_share_top">
    <?php get_template_part('template-parts/sns-btn-top'); ?>
   </div>
   <?php }; ?>

   <?php
        // copy title&url button ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        if($options['show_copy_top_campaign']) {
   ?>
   <div class="single_copy_title_url" id="single_copy_title_url_top">
    <button class="single_copy_title_url_btn" data-clipboard-text="<?php echo esc_attr( strip_tags( get_the_title() ) . ' ' . get_permalink() ); ?>" data-clipboard-copied="<?php echo esc_attr( __( 'COPIED Title&amp;URL', 'tcd-w' ) ); ?>"><?php _e( 'COPY Title&amp;URL', 'tcd-w' ); ?></button>
   </div>
   <?php }; ?>

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
        if($options['show_sns_btm_campaign']) {
   ?>
   <div class="single_share clearfix" id="single_share_bottom">
    <?php get_template_part('template-parts/sns-btn-btm'); ?>
   </div>
   <?php }; ?>

   <?php
        // copy title&url button ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        if($options['show_copy_btm_campaign']) {
   ?>
   <div class="single_copy_title_url" id="single_copy_title_url_bottom">
    <button class="single_copy_title_url_btn" data-clipboard-text="<?php echo esc_attr( strip_tags( get_the_title() ) . ' ' . get_permalink() ); ?>" data-clipboard-copied="<?php echo esc_attr( __( 'COPIED Title&amp;URL', 'tcd-w' ) ); ?>"><?php _e( 'COPY Title&amp;URL', 'tcd-w' ); ?></button>
   </div>
   <?php }; ?>

   <?php
        // page nav ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        if ($options['show_next_post_campaign']) :
   ?>
   <div id="next_prev_post" class="clearfix">
    <?php next_prev_post_link(); ?>
   </div>
   <?php endif; ?>

  </article><!-- END #article -->

  <?php endwhile; endif; ?>

  <?php
       // related post ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
       if ($options['show_related_campaign']){
         $num_post = $options['related_campaign_num'];
         if($options['related_campaign_type'] == 'type1'){
           $args = array( 'post__not_in' => array($post->ID), 'post_type' => 'campaign', 'showposts'=> $num_post);
         } else {
           $args = array( 'post__not_in' => array($post->ID), 'post_type' => 'campaign', 'showposts'=> $num_post, 'orderby' => 'rand');
         }
         $campaign_list = new wp_query($args);
         if($campaign_list->have_posts()):
  ?>
  <div id="related_campaign_list">
   <h2 class="headline rich_font_<?php echo esc_attr($related_campaign_headline_font_type); ?>"><?php echo esc_html($options['related_campaign_headline']); ?></h2>
   <div id="campaign_list" class="clearfix">
    <?php
         while( $campaign_list->have_posts() ) : $campaign_list->the_post();
           $campaign_label = get_post_meta($post->ID, 'campaign_label', true);
           $campaign_label_bg_color = get_post_meta($post->ID, 'campaign_label_bg_color', true);
           $campaign_label_font_color = get_post_meta($post->ID, 'campaign_label_font_color', true);
           if(has_post_thumbnail()) {
             $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size1' );
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
       <?php if($campaign_label){ ?><p class="label" style="background:<?php echo esc_html($campaign_label_bg_color); ?>; color:<?php echo esc_html($campaign_label_font_color); ?>;"><?php echo esc_html($campaign_label); ?></p><?php }; ?>
       <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
      </div>
      <div class="title_area">
       <h3 class="title"><span><?php the_title(); ?></span></h3>
       <?php if ($options['show_archive_campaign_date']){ ?><p class="date"><time class="entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time></p><?php }; ?>
      </div>
     </a>
    </article>
    <?php endwhile; wp_reset_query(); ?>
   </div><!-- END #campaign_list -->
   <?php if($options['show_related_campaign_button']) { ?>
   <p class="button"><a href="<?php echo esc_url(get_post_type_archive_link('campaign')); ?>"><?php echo esc_html($options['related_campaign_button_label']); ?></a></p>
   <?php }; ?>
  </div><!-- END #related_campaign_list -->
  <?php
          endif;
        };
  ?>

 </div><!-- END #main_col -->

 <?php get_sidebar(); ?>

</div><!-- END #main_contents -->

<?php get_footer(); ?>