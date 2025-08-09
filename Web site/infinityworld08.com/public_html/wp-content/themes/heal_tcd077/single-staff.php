<?php
     get_header();
     $options = get_design_plus_option();
     $headline = $options['staff_title'];
     $headline_color = $options['staff_title_color'];
     $sub_title = $options['staff_sub_title'];
     $image_id = $options['staff_bg_image'];
     if(!empty($image_id)) {
       $image = wp_get_attachment_image_src($image_id, 'full');
     }
     $use_overlay = $options['staff_use_overlay'];
     if($use_overlay) {
       $overlay_color = hex2rgb($options['staff_overlay_color']);
       $overlay_color = implode(",",$overlay_color);
       $overlay_opacity = $options['staff_overlay_opacity'];
     }

     $page_header_font_type_raw = $options['page_header_font_type'];
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
?>
<div id="page_header" <?php if($image_id) { ?>style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"<?php }; ?>>
 <div class="headline_area rich_font_<?php echo esc_attr($page_header_font_type); ?>">
  <?php if($headline){ ?><div class="headline"><?php echo wp_kses_post(nl2br($headline)); ?></div><?php }; ?>
  <?php if($sub_title){ ?><p class="sub_title"><?php echo wp_kses_post(nl2br($sub_title)); ?></p><?php }; ?>
 </div>
 <?php get_template_part('template-parts/breadcrumb'); ?>
 <?php if($use_overlay) { ?><div class="overlay" style="background:rgba(<?php echo esc_html($overlay_color); ?>,<?php echo esc_html($overlay_opacity); ?>);"></div><?php }; ?>
</div>

<div id="staff_single">

 <?php
      // タイトルエリア
      $staff_sub_title = get_post_meta($post->ID, 'staff_sub_title', true);
      $staff_position = get_post_meta($post->ID, 'staff_position', true);
      $insta = get_post_meta($post->ID, 'staff_instagram', true);
      $tiktok = get_post_meta($post->ID, 'staff_tiktok', true);
      $twitter = get_post_meta($post->ID, 'staff_twitter', true);
      $facebook = get_post_meta($post->ID, 'staff_facebook', true);

 ?>
 <div id="staff_single_header">
  <div class="title_area">
   <?php if($staff_position) { ?><p class="position"><?php echo esc_html($staff_position); ?></p><?php }; ?>
   <h1 class="title rich_font"><?php the_title(); ?></h1>
   <?php if($staff_sub_title) { ?><p class="sub_title"><?php echo esc_html($staff_sub_title); ?></p><?php }; ?>
  </div>
  <?php if($facebook || $twitter || $insta || $tiktok) { ?>
  <ul id="staff_social_link" class="clearfix">
   <?php if($insta) { ?><li class="insta"><a href="<?php echo esc_url($insta); ?>" rel="nofollow" target="_blank" title="Instagram"><span>Instagram</span></a></li><?php }; ?>
   <?php if($tiktok) { ?><li class="tiktok"><a href="<?php echo esc_url($tiktok); ?>" rel="nofollow" target="_blank" title="TikTok"><span>TikTok</span></a></li><?php }; ?>
   <?php if($twitter) { ?><li class="twitter"><a href="<?php echo esc_url($twitter); ?>" rel="nofollow" target="_blank" title="X"><span>X</span></a></li><?php }; ?>
   <?php if($facebook) { ?><li class="facebook"><a href="<?php echo esc_url($facebook); ?>" rel="nofollow" target="_blank" title="Facebook"><span>Facebook</span></a></li><?php }; ?>
  </ul>
  <?php }; ?>
 </div>

 <?php
      // 画像エリア
      if(has_post_thumbnail()) {
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size1' );
        $staff_catch = get_post_meta($post->ID, 'staff_catch', true);
        $staff_desc = get_post_meta($post->ID, 'staff_desc', true);
        $staff_desc_bg_color = get_post_meta($post->ID, 'staff_desc_bg_color', true);
        if(empty($staff_desc_bg_color)){
          $staff_desc_bg_color = '#000000';
        };
 ?>
 <div id="staff_single_desc">
  <div class="image_wrap">
   <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
  </div>
  <div class="catch_area" style="background:<?php echo esc_attr($staff_desc_bg_color); ?>;">
   <div class="catch_area_inner">
    <?php if($staff_catch) { ?><p class="catch rich_font"><?php echo nl2br(esc_html($staff_catch)); ?></p><?php }; ?>
    <?php if($staff_desc) { ?><p class="desc rich_font"><?php echo nl2br(esc_html($staff_desc)); ?></p><?php }; ?>
   </div>
  </div>
 </div>
 <?php }; ?>

 <div id="staff_content_wrap">

 <?php
      // 並び替え
      $staff_content_headline_font_color = get_post_meta($post->ID, 'staff_content_headline_font_color', true);
        if(empty($staff_content_headline_font_color)){ $staff_content_headline_font_color = '#58330d'; };
      $staff_content_headline_border_color = get_post_meta($post->ID, 'staff_content_headline_border_color', true);
        if(empty($staff_content_headline_border_color)){ $staff_content_headline_border_color = '#ae9982'; };

      $page_content_order = get_post_meta($post->ID, 'page_content_order', true);
      if(empty($page_content_order)) {
        $page_content_order = array('content1','content2','content3','content4');
      }
      foreach((array) $page_content_order as $page_content) :

      // 資格 -----------------------------------------------------------------
      $show_staff_content1 = get_post_meta($post->ID, 'show_staff_content1', true);
      if( ($page_content == 'content1') && $show_staff_content1) {
        $staff_content1_headline = get_post_meta($post->ID, 'staff_content1_headline', true);
        $staff_content1_desc = get_post_meta($post->ID, 'staff_content1_desc', true);
 ?>
 <div id="staff_content1" class="staff_content">
  <?php if(!empty($staff_content1_headline)) { ?>
  <h2 class="headline rich_font" style="color:<?php echo esc_attr($staff_content_headline_font_color); ?>; border-top-color:<?php echo esc_attr($staff_content_headline_border_color); ?>;"><?php echo esc_html($staff_content1_headline); ?></h2>
  <?php }; ?>
  <?php if(!empty($staff_content1_desc)) { ?>
  <div class="post_content clearfix">
    <?php echo apply_filters('the_content', $staff_content1_desc ); ?>
  </div>
  <?php }; ?>
 </div><!-- END #staff_content1 -->
 <?php }; ?>


 <?php
      // メニュー一覧 -----------------------------------------------------------------
      $show_staff_content2 = get_post_meta($post->ID, 'show_staff_content2', true);
      if( ($page_content == 'content2') && $show_staff_content2) {
        $staff_content2_headline = get_post_meta($post->ID, 'staff_content2_headline', true);
        $staff_content2_desc = get_post_meta($post->ID, 'staff_content2_desc', true);
        $staff_content2_menu_list = get_post_meta($post->ID, 'staff_content2_menu_list', true);
        if(!empty($staff_content2_menu_list)){
          $list_font_color = get_post_meta($post->ID, 'staff_content2_menu_list_font_color', true);
            if(empty($list_font_color)){ $list_font_color = '#000000'; };
          $list_bg_color = get_post_meta($post->ID, 'staff_content2_menu_list_bg_color', true);
            if(empty($list_bg_color)){ $list_bg_color = '#f7f7f7'; };
          $list_border_color = get_post_meta($post->ID, 'staff_content2_menu_list_border_color', true);
            if(empty($list_border_color)){ $list_border_color = '#dddddd'; };
 ?>
 <div id="staff_content2" class="staff_content">
  <?php if(!empty($staff_content2_headline)) { ?>
  <h2 class="headline rich_font" style="color:<?php echo esc_attr($staff_content_headline_font_color); ?>; border-top-color:<?php echo esc_attr($staff_content_headline_border_color); ?>;"><?php echo esc_html($staff_content2_headline); ?></h2>
  <?php }; ?>
  <?php if(!empty($staff_content2_menu_list)) { ?>
  <ol class="staff_content2_menu_list clearfix">
   <?php
        foreach ( $staff_content2_menu_list as $key => $value ) :
          $title = $value['title'];
          if($title) {
   ?>
   <li style="color:<?php echo esc_attr($list_font_color); ?>; background:<?php echo esc_attr($list_bg_color); ?>; border-color:<?php echo esc_attr($list_border_color); ?>;"><?php echo esc_html($title); ?></li>
   <?php }; endforeach; ?>
  </ol>
  <?php }; ?>
  <?php if(!empty($staff_content2_desc)) { ?>
  <div class="post_content clearfix">
    <?php echo apply_filters('the_content', $staff_content2_desc ); ?>
  </div>
  <?php }; ?>
 </div><!-- END #staff_content2 -->
 <?php }; }; ?>


 <?php
      // スケジュール -----------------------------------------------------------------
      $show_staff_content3 = get_post_meta($post->ID, 'show_staff_content3', true);
      if( ($page_content == 'content3') && $show_staff_content3) {
        $staff_content3_headline = get_post_meta($post->ID, 'staff_content3_headline', true);
        $staff_content3_desc = get_post_meta($post->ID, 'staff_content3_desc', true);
        $staff_content3_header_font_color = get_post_meta($post->ID, 'staff_content3_header_font_color', true);
        $staff_content3_header_bg_color = get_post_meta($post->ID, 'staff_content3_header_bg_color', true);
 ?>
 <div id="staff_content3" class="staff_content">
  <?php if(!empty($staff_content3_headline)) { ?>
  <h2 class="headline rich_font" style="color:<?php echo esc_attr($staff_content_headline_font_color); ?>; border-top-color:<?php echo esc_attr($staff_content_headline_border_color); ?>;"><?php echo esc_html($staff_content3_headline); ?></h2>
  <?php }; ?>
  <div id="single_schedule" class="clearfix">
<?php
  $show_days = 7;
  $today_ts = strtotime( 'today', current_time( 'timestamp', false ) );
  for ( $i = 0; $i < $show_days; $i++ ) :
    $schedule_ts = $today_ts + $i * DAY_IN_SECONDS;
    $schedule_meta = get_post_meta( $post->ID, '_schedule_' . date( 'Ymd', $schedule_ts ), true );
    $date_label = sprintf(
      __( '%1$s %2$s %3$s', 'tcd-w' ),
      $wp_locale->get_month_abbrev( $wp_locale->get_month( date( 'n', $schedule_ts ) ) ),
      date( 'j', $schedule_ts ),
      $wp_locale->get_weekday_abbrev( $wp_locale->get_weekday( date( 'w', $schedule_ts ) ) )
    );
    if ( ! empty( $schedule_meta['memo'] ) ) :
      $memo = wpautop( $schedule_meta['memo'] );
      $memo = str_replace(array("\r\n", "\r", "\n"), '', $memo);
?>
   <div class="item"<?php if ( ! empty( $schedule_meta['bg_color'] ) && '#ffffff' != $schedule_meta['bg_color'] ) echo ' style="background-color: ' . esc_attr( $schedule_meta['bg_color'] ) . ';"' ?>>
    <div class="date" style="color:<?php echo esc_attr($staff_content3_header_font_color); ?>; background-color:<?php echo esc_attr($staff_content3_header_bg_color); ?>;"><?php echo esc_html( $date_label ); ?></div>
    <div class="memo"><?php echo $memo; ?></div>
   </div>
<?php
    else :
?>
   <div class="item empty">
    <div class="date" style="color:<?php echo esc_attr($staff_content3_header_font_color); ?>; background-color:<?php echo esc_attr($staff_content3_header_bg_color); ?>;"><?php echo esc_html( $date_label ); ?></div>
    <div class="memo">-</div>
   </div>
<?php
    endif;
  endfor;
?>
  </div>
  <?php if(!empty($staff_content3_desc)) { ?>
  <div class="post_content clearfix">
    <?php echo apply_filters('the_content', $staff_content3_desc ); ?>
  </div>
  <?php }; ?>
 </div><!-- END #staff_content3 -->
 <?php }; ?>

 <?php
      // free space -----------------------------------------------------------------
      $show_staff_content4 = get_post_meta($post->ID, 'show_staff_content4', true);
      if( ($page_content == 'content4') && $show_staff_content4) {
        $staff_content4_free_space = get_post_meta($post->ID, 'staff_content4_free_space', true);
 ?>
 <div id="staff_content4" class="staff_content">
  <?php if(!empty($staff_content4_free_space)) { ?>
  <div class="post_content clearfix">
    <?php echo apply_filters('the_content', $staff_content4_free_space ); ?>
  </div>
  <?php }; ?>
 </div><!-- END #staff_content4 -->
 <?php }; ?>

 <?php endforeach; // END 並び替え ?>

 </div><!-- END #staff_content -->

</div><!-- END #staff_single -->

<?php
     // スタッフ一覧 ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
     if ($options['show_single_staff'] || wp_get_attachment_image_src( $options['single_staff_banner_bg_image'], 'full' )){
?>
<div id="single_staff_list">
<?php
     if ($options['show_single_staff']){
       $post_num = $options['single_staff_num'];
       $args = array( 'post_type' => 'staff', 'posts_per_page' => $post_num);
       $staff_query = new wp_query($args);
       if($staff_query->have_posts()):
?>

 <?php
      $headline = $options['single_staff_headline'];
      $sub_heading = $options['single_staff_sub_headline'];
      if($headline || $sub_heading) {
 ?>
 <div class="headline_area">
  <?php if($headline) { ?><h2 class="headline rich_font"><?php echo nl2br(esc_html($headline)); ?></h2><?php }; ?>
  <?php if($sub_heading) { ?><p class="sub_title"><?php echo nl2br(esc_html($sub_heading)); ?></p><?php }; ?>
 </div>
 <?php }; ?>

 <div id="staff_list" class="clearfix">
  <?php
       while($staff_query->have_posts()): $staff_query->the_post();
         $staff_position = get_post_meta($post->ID, 'staff_position', true);
         $staff_catch = get_post_meta($post->ID, 'staff_catch', true);
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
     <div class="title_area">
      <?php if($staff_position) { ?><p class="sub_title"><?php echo esc_html($staff_position); ?></p><?php }; ?>
      <h3 class="title rich_font"><span><?php the_title(); ?></span></h3>
     </div>
     <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
    </div>
    <div class="desc">
     <?php if($staff_catch) { ?><p><span><?php echo esc_html($staff_catch); ?></span></p><?php }; ?>
    </div>
   </a>
  </article>
  <?php endwhile; ?>
 </div><!-- END #staff_list -->
 <?php endif; wp_reset_query(); ?>

 <?php if($options['show_single_staff_button']) { ?>
 <p class="button"><a href="<?php echo esc_url(get_post_type_archive_link('staff')); ?>"><?php echo esc_html($options['single_staff_button_label']); ?></a></p>
 <?php }; ?>
<?php }; ?>

 <?php
      // バナーコンテンツ
      $image = wp_get_attachment_image_src( $options['single_staff_banner_bg_image'], 'full' );
      if($image) {
 ?>
 <div id="staff_banner_content">
  <a class="link animate_background" href="<?php echo esc_url($options['single_staff_banner_url']); ?>">
   <div class="content">
    <?php if($options['single_staff_banner_title']) { ?>
    <div class="banner_headline rich_font"><?php echo nl2br(esc_html($options['single_staff_banner_title'])); if($options['single_staff_banner_sub_title']) { ?><span><?php echo nl2br(esc_html($options['single_staff_banner_sub_title'])); ?></span><?php }; ?></div>
    <?php }; ?>
    <?php if($options['single_staff_banner_desc']) { ?>
    <p class="banner_desc"><span><?php echo nl2br(esc_html($options['single_staff_banner_desc'])); ?></span></p>
    <?php }; ?>
   </div>
   <div class="image_wrap">
    <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
   </div>
   <?php
        if($options['single_staff_banner_use_overlay']) {
          $single_staff_banner_overlay_color = hex2rgb($options['single_staff_banner_overlay_color']);
          $single_staff_banner_overlay_color = implode(",",$single_staff_banner_overlay_color);
   ?>
   <div class="overlay" style="background:rgba(<?php echo esc_html($single_staff_banner_overlay_color); ?>,<?php echo esc_html($options['single_staff_banner_overlay_opacity']); ?>);"></div>
   <?php }; ?>
  </a>
 </div>
 <?php }; ?>

</div><!-- END #single_staff_list -->
<?php }; ?>

<?php get_footer(); ?>