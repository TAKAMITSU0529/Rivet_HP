<?php
     $options = get_design_plus_option();
     get_header();
?>
<div id="contents_builder">
<?php
     // コンテンツビルダー
     if (!empty($options['contents_builder'])) :
       $content_count = 1;
       foreach($options['contents_builder'] as $content) :

         // デザインコンテンツ１ --------------------------------------------------------------------------------
         if ( ($content['cb_content_select'] == 'design_content1') && $content['show_dc1'] ) {
           $image1 = wp_get_attachment_image_src( $content['dc1_image1'] ?? NULL, 'full' );
           $image2 = wp_get_attachment_image_src( $content['dc1_image2'] ?? NULL, 'full' );
           $image3 = wp_get_attachment_image_src( $content['dc1_image3'] ?? NULL, 'full' );
?>
<div id="cb_contents_num<?php echo $content_count; ?>" class="index_design_content1 cb_contents num<?php echo $content_count; ?>">

 <?php if($image1 || $image2 || $image3) { ?>
 <div class="image_list clearfix <?php echo esc_attr($content['dc1_image_type']); ?>">
  <?php if($image1){ ?><div class="image" style="background:url(<?php echo esc_attr($image1[0]); ?>) no-repeat center center; background-size:cover;"></div><?php }; ?>
  <?php if($image2 && ($content['dc1_image_type'] == 'type2') || ($content['dc1_image_type'] == 'type3')){ ?><div class="image" style="background:url(<?php echo esc_attr($image2[0]); ?>) no-repeat center center; background-size:cover;"></div><?php }; ?>
  <?php if($image3 && ($content['dc1_image_type'] == 'type3')){ ?><div class="image" style="background:url(<?php echo esc_attr($image3[0]); ?>) no-repeat center center; background-size:cover;"></div><?php }; ?>
 </div>
 <?php }; ?>

 <?php if($content['dc1_catch']) { ?>
 <h2 class="catch rich_font"><?php echo nl2br(esc_html($content['dc1_catch'])); ?></h2>
 <?php }; ?>

 <?php if($content['dc1_desc']) { ?>
 <p class="desc"><span><?php echo nl2br(esc_html($content['dc1_desc'])); ?></span></p>
 <?php }; ?>

 <?php if($content['show_dc1_button']) { ?>
 <p class="button button_font"><a href="<?php echo esc_url($content['dc1_button_url']); ?>"<?php if( isset($content['dc1_button_target']) && $content['dc1_button_target']){ echo ' target="_blank"'; }; ?>><?php echo esc_html($content['dc1_button_label']); ?></a></p>
 <?php }; ?>

</div><!-- END .index_design_content1 -->
<?php
     // デザインコンテンツ２ --------------------------------------------------------------------------------
     } elseif ( ($content['cb_content_select'] == 'design_content2') && $content['show_dc2'] ) {
?>
<div id="cb_contents_num<?php echo $content_count; ?>" class="index_design_content2 cb_contents num<?php echo $content_count; ?>">

 <?php if($content['dc2_catch']) { ?>
 <h2 class="catch rich_font"><?php echo nl2br(esc_html($content['dc2_catch'])); ?></h2>
 <?php }; ?>

 <?php if($content['dc2_desc']) { ?>
 <p class="desc"><span><?php echo nl2br(esc_html($content['dc2_desc'])); ?></span></p>
 <?php }; ?>

 <?php
      $image = wp_get_attachment_image_src( $content['dc2_banner_image'] ?? NULL, 'full' );
      if($image) {
 ?>
 <div class="banner_content">
  <a class="link animate_background" href="<?php echo esc_url($content['dc2_banner_url']); ?>"<?php if(isset($content['dc2_banner_target']) && $content['dc2_banner_target']){ echo ' target="_blank"'; }; ?>>
   <div class="content">
    <?php if($content['dc2_banner_headline']) { ?>
    <h3 class="banner_headline rich_font"><?php echo nl2br(esc_html($content['dc2_banner_headline'])); if($content['dc2_banner_sub_title']) { ?><span><?php echo nl2br(esc_html($content['dc2_banner_sub_title'])); ?></span><?php }; ?></h3>
    <?php }; ?>
    <?php if($content['dc2_banner_desc']) { ?>
    <p class="banner_desc"><span><?php echo nl2br(esc_html($content['dc2_banner_desc'])); ?></span></p>
    <?php }; ?>
   </div>
   <div class="image_wrap">
    <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
   </div>
   <?php
        if($content['dc2_banner_use_overlay']) {
          $dc2_banner_overlay_color = hex2rgb($content['dc2_banner_overlay_color']);
          $dc2_banner_overlay_color = implode(",",$dc2_banner_overlay_color);
   ?>
   <div class="overlay" style="background:rgba(<?php echo esc_html($dc2_banner_overlay_color); ?>,<?php echo esc_html($content['dc2_banner_overlay_opacity']); ?>);"></div>
   <?php }; ?>
  </a>
 </div>
 <?php }; ?>

</div><!-- END .index_design_content2 -->
<?php
     // キャンペーン一覧 --------------------------------------------------------------------------------
     } elseif ( ($content['cb_content_select'] == 'campaign_list') && $content['show_campaign'] ) {
       $image = wp_get_attachment_image_src( $content['campaign_image'] ?? NULL, 'full' );
       if($content['campaign_bg_type'] == 'type2') {
         $image = '';
         $video = $content['campaign_video'];
         if(!empty($video)) {
           if (!auto_play_movie()) {
             $video_image_id = $content['campaign_video_image'];
             if($video_image_id) {
               $image = wp_get_attachment_image_src($video_image_id, 'full');
             }
           }
         }
       }
?>
<div id="cb_contents_num<?php echo $content_count; ?>" class="index_campaign cb_contents num<?php echo $content_count; ?>" <?php if(!empty($image)) { ?>style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"<?php }; ?>>

 <div class="index_campaign_inner">

  <?php if($content['campaign_headline']) { ?>
  <h2 class="headline rich_font"><?php echo nl2br(esc_html($content['campaign_headline'])); if($content['campaign_sub_title']) { ?><span><?php echo nl2br(esc_html($content['campaign_sub_title'])); ?></span><?php }; ?></h2>
  <?php }; ?>

  <?php
       $post_num = $content['campaign_num'];
       $post_type = $content['campaign_post_type'];
       $args = array( 'post_type' => $post_type, 'posts_per_page' => $post_num );
       $campaign_query = new wp_query($args);
       if($campaign_query->have_posts()):
  ?>
  <div class="index_campaign_slider_wrap">
  <div class="index_campaign_slider owl-carousel">
   <?php while($campaign_query->have_posts()): $campaign_query->the_post(); ?>
   <article class="item">
    <p class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
   </article>
   <?php endwhile; ?>
  </div><!-- END .index_campaign_slider -->
  </div>
  <?php if($post_num > 4){ ?>
  <div class="slider_arrow slider_next_item"></div>
  <div class="slider_arrow slider_prev_item"></div>
  <?php }; ?>
  <?php
       if($content['show_campaign_button']) {
         if($post_type == 'post') {
  ?>
  <p class="button button_font"><a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>"><?php echo esc_html($content['campaign_button_label']); ?></a></p>
  <?php } else { ?>
  <p class="button button_font"><a href="<?php echo esc_url(get_post_type_archive_link($post_type)); ?>"><?php echo esc_html($content['campaign_button_label']); ?></a></p>
  <?php }; }; ?>
  <?php endif; wp_reset_query(); ?>

 </div><!-- END .index_campaign_inner -->

 <?php if($content['campaign_use_overlay']) { ?><div class="overlay"></div><?php }; ?>

 <?php
      // video -----------------------------------------------------
      if($content['campaign_bg_type'] == 'type2') {
        $video = $content['campaign_video'];
        if(!empty($video)) {
          if (auto_play_movie()) {
 ?>
 <video class="campaign_video" src="<?php echo esc_url(wp_get_attachment_url($content['campaign_video'])); ?>" playsinline autoplay loop muted></video>
 <?php }; }; }; ?>

</div><!-- END .index_campaign -->
<?php
         // 新着ブログ --------------------------------------------------------------------------------
         } elseif ( ($content['cb_content_select'] == 'recent_blog_list') && $content['show_blog'] ) {
?>
<div id="cb_contents_num<?php echo $content_count; ?>" class="index_blog cb_contents num<?php echo $content_count; ?>">

 <?php if($content['recent_blog_headline']) { ?>
 <h2 class="headline rich_font"><?php echo nl2br(esc_html($content['recent_blog_headline'])); if($content['recent_blog_sub_title']) { ?><span><?php echo nl2br(esc_html($content['recent_blog_sub_title'])); ?></span><?php }; ?></h2>
 <?php }; ?>

 <?php
      $post_num = $content['recent_blog_num'];
      $post_type = $content['recent_blog_post_type'];
      $args = array( 'post_type' => $post_type, 'posts_per_page' => $post_num );
      $blog_query = new wp_query($args);
      if($blog_query->have_posts()):
 ?>
 <div class="blog_list clearfix">
  <?php
       while($blog_query->have_posts()): $blog_query->the_post();
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
     <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
    </div>
   </a>
   <div class="title_area">
    <h3 class="title"><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></h3>
    <ul class="post_meta clearfix">
     <?php if ($content['recent_blog_show_date']){ ?><li class="date"><time class="entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time></li><?php }; ?>
     <?php if ($options['show_archive_blog_category']) { ?>
    <li class="category">
        <?php
        $categories = get_the_category();
        if (!empty($categories)) {
            $category_name = $categories[0]->name; 
            if( is_mobile()){ $text_count=9; }else{$text_count=12;}
            if (mb_strlen($category_name, 'UTF-8') > $text_count) {
                $trimmed_name = mb_substr($category_name, 0, $text_count, 'UTF-8') . '…';
            } else {
                $trimmed_name = $category_name;
            }
            echo '<a href="' . get_category_link($categories[0]->term_id) . '">' . esc_html($trimmed_name) . '</a>';
        }
        ?>
    </li>
<?php } ?>
    </ul>
   </div>
  </article>
  <?php endwhile; ?>
 </div><!-- END .blog_list -->
 <?php
      if($content['show_recent_blog_button']) {
         if($post_type == 'post') {
 ?>
 <p class="button button_font"><a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>"><?php echo esc_html($content['recent_blog_button_label']); ?></a></p>
 <?php } else { ?>
 <p class="button button_font"><a href="<?php echo esc_url(get_post_type_archive_link($post_type)); ?>"><?php echo esc_html($content['recent_blog_button_label']); ?></a></p>
 <?php }; }; ?>
 <?php endif; wp_reset_query(); ?>

</div><!-- END .index_blog -->
<?php
         // お知らせ --------------------------------------------------------------------------------
         } elseif ( ($content['cb_content_select'] == 'news_list') && $content['show_news'] ) {
?>
<div id="cb_contents_num<?php echo $content_count; ?>" class="index_news cb_contents num<?php echo $content_count; ?>">

 <?php if($content['news_headline']) { ?>
 <h2 class="headline rich_font"><?php echo nl2br(esc_html($content['news_headline'])); if($content['news_sub_title']) { ?><span><?php echo nl2br(esc_html($content['news_sub_title'])); ?></span><?php }; ?></h2>
 <?php }; ?>

 <?php
      $post_num = $content['news_num'];
      $post_type = $content['news_post_type'];
      $args = array( 'post_type' => $post_type, 'posts_per_page' => $post_num );
      $news_query = new wp_query($args);
      if($news_query->have_posts()):
 ?>
 <div class="news_list clearfix">
  <?php
       while($news_query->have_posts()): $news_query->the_post();
  ?>
  <article class="item">
   <a class="link clearfix" href="<?php the_permalink(); ?>">
    <p class="date" style="color:<?php echo esc_attr($content['news_date_color']); ?>;"><time class="entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time></p>
    <h3 class="title"><span><?php the_title(); ?></span></h3>
   </a>
  </article>
  <?php endwhile; ?>
 </div><!-- END .news_list -->
 <?php
      if($content['show_news_button']) {
         if($post_type == 'post') {
 ?>
 <p class="button button_font"><a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>"><?php echo esc_html($content['news_button_label']); ?></a></p>
 <?php } else { ?>
 <p class="button button_font"><a href="<?php echo esc_url(get_post_type_archive_link($post_type)); ?>"><?php echo esc_html($content['news_button_label']); ?></a></p>
 <?php }; }; ?>
 <?php endif; wp_reset_query(); ?>

</div><!-- END .index_news -->
<?php
         // free space -----------------------------------------------------
         } elseif ( ($content['cb_content_select'] == 'free_space') && $content['show_free'] ) {
           if (!empty($content['free_space'])) {
?>
<div id="cb_contents_num<?php echo $content_count; ?>" class="index_free_space cb_contents num<?php echo $content_count; ?>">
 <div class="post_content clearfix">
  <?php echo wpautop($content['free_space']); ?>
 </div>
</div><!-- END .cb_contents -->
<?php
           };
         };
       $content_count++;
       endforeach;
     endif;
// コンテンツビルダーここまで
?>
</div>
<?php get_footer(); ?>