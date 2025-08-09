<?php
/*
Template Name:Schedule page
*/
__('Schedule page', 'tcd-w');
?>
<?php
     get_header();
     $options = get_design_plus_option();
     $headline = get_post_meta($post->ID, 'schedule_header_title', true);
     $headline_color = get_post_meta($post->ID, 'schedule_header_font_color', true);
     if(empty($headline_color)){
       $headline_color = '#ffffff';
     }
     $sub_title = get_post_meta($post->ID, 'schedule_header_sub_title', true);
     $image_id = get_post_meta($post->ID, 'schedule_header_image', true);
     if(!empty($image_id)) {
       $image = wp_get_attachment_image_src($image_id, 'full');
     }
     $use_overlay = get_post_meta($post->ID, 'use_schedule_header_overlay', true);
     if($use_overlay) {
       $overlay_color = get_post_meta($post->ID, 'schedule_header_overlay_color', true);
       if(empty($overlay_color)) {
         $overlay_color = '#000000';
       }
       $overlay_color = hex2rgb($overlay_color);
       $overlay_color = implode(",",$overlay_color);
       $overlay_opacity = get_post_meta($post->ID, 'schedule_header_overlay_opacity', true);
       if(empty($overlay_opacity)) {
         $overlay_opacity = '0.5';
       }
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
  <?php if($headline){ ?><h1 class="headline"><?php echo wp_kses_post(nl2br($headline)); ?></h1><?php }; ?>
  <?php if($sub_title){ ?><p class="sub_title"><?php echo wp_kses_post(nl2br($sub_title)); ?></p><?php }; ?>
 </div>
 <?php get_template_part('template-parts/breadcrumb'); ?>
 <?php if($use_overlay) { ?><div class="overlay" style="background:rgba(<?php echo esc_html($overlay_color); ?>,<?php echo esc_html($overlay_opacity); ?>);"></div><?php }; ?>
</div>

<div id="schedule_page">

 <?php
      $catch = get_post_meta($post->ID, 'schedule_catch', true);
      $desc = get_post_meta($post->ID, 'schedule_desc', true);
      if($catch || $desc) {
 ?>
 <div id="catch_area">
  <?php if($catch) { ?><h2 class="catch rich_font"><?php echo nl2br(esc_html($catch)); ?></h2><?php }; ?>
  <?php if($desc) { ?><p class="desc"><?php echo nl2br(esc_html($desc)); ?></p><?php }; ?>
 </div>
 <?php }; ?>
<?php
  $staff_query = new WP_Query( array( 'post_type' => 'staff', 'posts_per_page' => -1 ) );
  if ( $staff_query->have_posts() ) :
    $show_days = 7;
    if ( ! empty( $_GET['schedule_date'] ) && preg_match('/^(\d{4})-(\d{2})-(\d{2})$/', $_GET['schedule_date'], $matches ) ) :
      $date_from_ts = mktime( 0, 0, 0, $matches[2], $matches[3], $matches[1] );
    else :
      $date_from_ts = strtotime( 'today', current_time( 'timestamp', false ) );
    endif;
    $date_to_ts = $date_from_ts + ( $show_days - 1 ) * DAY_IN_SECONDS;
    $date_from_label = sprintf(
      __( '%1$s %2$s', 'tcd-w' ),
      $wp_locale->get_month_abbrev( $wp_locale->get_month( date( 'n', $date_from_ts ) ) ),
      date( 'j', $date_from_ts )
    );
    $date_to_label = sprintf(
      __( '%1$s %2$s', 'tcd-w' ),
      $wp_locale->get_month_abbrev( $wp_locale->get_month( date( 'n', $date_to_ts ) ) ),
      date( 'j', $date_to_ts )
    );
    $prev_url = add_query_arg( 'schedule_date', date( 'Y-m-d', $date_from_ts - $show_days * DAY_IN_SECONDS ) );
    $next_url = add_query_arg( 'schedule_date', date( 'Y-m-d', $date_from_ts +$show_days * DAY_IN_SECONDS ) );
?>
 <div id="schedule_list">
  <h3 id="schedule_list_headline_pc"><a href="<?php echo esc_attr( $prev_url ); ?>" class="prev"></a><?php printf( __( '<span class="label">Schedule in</span>&nbsp;<span class="date">%s - %s</span>' , 'tcd-w' ), esc_html( $date_from_label ), esc_html( $date_to_label ) ); ?><a href="<?php echo esc_attr( $next_url ); ?>" class="next"></a></h3>
  <h3 id="schedule_list_headline_mobile"><a href="<?php echo esc_attr( $prev_url ); ?>" class="prev"></a><span class="date"><?php echo esc_html( $date_from_label ); ?></span><a href="<?php echo esc_attr( $next_url ); ?>" class="next"></a></h3>
  <div id="schedule_list_header">
   <div class="item_blank"></div>
<?php
    for ( $i = 0; $i < $show_days; $i++ ) :
      $schedule_ts = $date_from_ts + $i * DAY_IN_SECONDS;
      $date_label = sprintf(
        __( '%1$s %2$s %3$s', 'tcd-w' ),
        $wp_locale->get_month_abbrev( $wp_locale->get_month( date( 'n', $schedule_ts ) ) ),
        date( 'j', $schedule_ts ),
        $wp_locale->get_weekday_abbrev( $wp_locale->get_weekday( date( 'w', $schedule_ts ) ) )
      );
      $date_label_mobile = sprintf(
        __( '%1$s %2$s', 'tcd-w' ),
        $wp_locale->get_month_abbrev( $wp_locale->get_month( date( 'n', $schedule_ts ) ) ),
        date( 'j', $schedule_ts )
      );
?>
   <div class="item" data-mobile="<?php echo esc_attr( $date_label_mobile ); ?>"><?php echo esc_html( $date_label ); ?></div>
<?php
    endfor;
?>
  </div>
<?php
    while ( $staff_query->have_posts() ) :
      $staff_query->the_post();
      if( has_post_thumbnail() ) :
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size1' );
      elseif( $options['no_image2'] ) :
        $image = wp_get_attachment_image_src( $options['no_image2'], 'full' );
      else :
        $image = array( get_bloginfo('template_url') . '/img/common/no_image2.gif' );
      endif;
?>
  <div class="author_data">
   <div class="item item_author">
    <a class="link animate_background" href="<?php the_permalink(); ?>">
     <div class="image_wrap">
      <div class="title"><span><?php the_title(); ?></span></div>
      <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
     </div>
    </a>
   </div>
<?php
      for ( $i = 0; $i < $show_days; $i++ ) :
        $schedule_ts = $date_from_ts + $i * DAY_IN_SECONDS;
        $schedule_meta = get_post_meta( $post->ID, '_schedule_' . date( 'Ymd', $schedule_ts ), true );
        if ( ! empty( $schedule_meta['memo'] ) ) :
          $memo = wpautop( $schedule_meta['memo'] );
          $memo = str_replace(array("\r\n", "\r", "\n"), '', $memo);
?>
   <div class="item"<?php if ( ! empty( $schedule_meta['bg_color'] ) && '#ffffff' != $schedule_meta['bg_color'] ) echo ' style="background-color: ' . esc_attr( $schedule_meta['bg_color'] ) . ';"' ?>>
    <div class="memo"><?php echo $memo; ?></div>
   </div>
<?php
        else :
?>
   <div class="item empty">
    <div class="memo">-</div>
   </div>
<?php
        endif;
      endfor;

      // for mobile
      $schedule_meta = get_post_meta( $post->ID, '_schedule_' . date( 'Ymd', $date_from_ts ), true );
      if ( ! empty( $schedule_meta['memo'] ) ) :
        $memo = wpautop( $schedule_meta['memo'] );
        $memo = str_replace(array("\r\n", "\r", "\n"), '', $memo);
?>
   <div class="item_mobile"<?php if ( ! empty( $schedule_meta['bg_color'] ) && '#ffffff' != $schedule_meta['bg_color'] ) echo ' style="background-color: ' . esc_attr( $schedule_meta['bg_color'] ) . ';"' ?>>
    <div class="memo"><?php echo $memo; ?></div>
   </div>
<?php
      else :
?>
   <div class="item_mobile empty">
    <div class="memo">-</div>
   </div>
<?php
      endif;
?>
  </div><!-- END .author -->
<?php
    endwhile;
  endif;
  wp_reset_postdata();
?>
 </div>

 <?php
      $staff_schedule_desc = get_post_meta($post->ID, 'staff_schedule_desc', true);
      if($staff_schedule_desc) {
 ?>
 <p id="schedule_list_desc"><?php echo nl2br(esc_html($staff_schedule_desc)); ?></p>
 <?php }; ?>

 <?php
      // バナーコンテンツ
      $banner_image = wp_get_attachment_image_src( get_post_meta($post->ID, 'schedule_banner_image', true), 'full' );
      if($banner_image) {
        $schedule_banner_url = get_post_meta($post->ID, 'schedule_banner_url', true);
        $schedule_banner_title = get_post_meta($post->ID, 'schedule_banner_title', true);
        $schedule_banner_sub_title = get_post_meta($post->ID, 'schedule_banner_sub_title', true);
        $schedule_banner_desc = get_post_meta($post->ID, 'schedule_banner_desc', true);
 ?>
 <div id="staff_banner_content">
  <a class="link animate_background" href="<?php echo esc_url($schedule_banner_url); ?>">
   <div class="content">
    <?php if($schedule_banner_title) { ?>
    <h2 class="banner_headline rich_font"><?php echo nl2br(esc_html($schedule_banner_title)); if($schedule_banner_sub_title) { ?><span><?php echo nl2br(esc_html($schedule_banner_sub_title)); ?></span><?php }; ?></h2>
    <?php }; ?>
    <?php if($schedule_banner_desc) { ?>
    <p class="banner_desc"><span><?php echo nl2br(esc_html($schedule_banner_desc)); ?></span></p>
    <?php }; ?>
   </div>
   <div class="image_wrap">
    <div class="image" style="background:url(<?php echo esc_attr($banner_image[0]); ?>) no-repeat center center; background-size:cover;"></div>
   </div>
   <?php
        if(get_post_meta($post->ID, 'schedule_banner_use_overlay', true)) {
          $schedule_banner_overlay_color = get_post_meta($post->ID, 'schedule_banner_overlay_color', true);
            if(empty($schedule_banner_overlay_color)){ $schedule_banner_overlay_color = '#000000'; }
          $schedule_banner_overlay_color = hex2rgb($schedule_banner_overlay_color);
          $schedule_banner_overlay_color = implode(",",$schedule_banner_overlay_color);
          $schedule_banner_overlay_opacity = get_post_meta($post->ID, 'schedule_banner_overlay_opacity', true);
            if(empty($schedule_banner_overlay_opacity)){ $schedule_banner_overlay_opacity = '0.3'; }
   ?>
   <div class="overlay" style="background:rgba(<?php echo esc_html($schedule_banner_overlay_color); ?>,<?php echo esc_html($schedule_banner_overlay_opacity); ?>);"></div>
   <?php }; ?>
  </a>
 </div>
 <?php }; ?>

</div><!-- #schedule_page -->

<?php get_footer(); ?>