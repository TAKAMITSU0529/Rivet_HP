<?php
     get_header();
     $options = get_design_plus_option();
     $headline = __( 'Search result', 'tcd-canon' );
     $catch = sprintf( __( 'Search result for %s', 'tcd-canon' ), get_search_query() );
     $image = wp_get_attachment_image_src($options['archive_blog_header_image'], 'full');
     $overlay_color = hex2rgb($options['archive_blog_overlay_color']);
     $overlay_color = implode(",",$overlay_color);
     $overlay_opacity = $options['archive_blog_overlay_opacity'];
     $desc = '';
     $desc_mobile = '';

     // 検索結果がある場合
     if ( isset($_GET['s']) && !empty($_GET['s']) && have_posts() ) :
       if($image && $options['blog_show_header']){
?>
<div id="page_header">
 <?php if($headline){ ?>
 <h1 class="headline"><span><?php echo wp_kses_post(nl2br($headline)); ?></span></h1>
 <?php }; ?>
 <div class="overlay" style="background:rgba(<?php echo esc_attr($overlay_color); ?>,<?php echo esc_attr($overlay_opacity); ?>);"></div>
 <img class="image" src="<?php echo esc_attr($image[0]); ?>" alt="" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>">
</div>
<?php }; ?>

<div id="archive_blog">

 <?php if(!$image || !$options['blog_show_header']){ ?>
 <h1 id="page_headline"><?php echo wp_kses_post(nl2br($headline)); ?></h1>
 <?php }; ?>

 <?php if(!is_paged() && $catch){ ?>
 <div id="page_header_desc">
  <h2 class="catch inview"><?php echo wp_kses_post(nl2br($catch)); ?></h2>
 </div>
 <?php }; ?>

 <div class="blog_list inview">
  <?php
       while ( have_posts() ) : the_post();
         if(has_post_thumbnail()) {
           $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size2' );
         } elseif($options['no_image']) {
           $image = wp_get_attachment_image_src( $options['no_image'], 'full' );
         } else {
           $image = array();
           $image[0] = get_bloginfo('template_url') . "/img/no_image2.gif";
           $image[1] = '620';
           $image[2] = '400';
         }
  ?>
  <div class="item">
   <a class="animate_background" href="<?php the_permalink(); ?>">
    <div class="image_wrap">
     <img loading="lazy" class="image" src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
    </div>
   </a>
   <div class="content">
    <div class="content_inner">
     <h2 class="title"><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></h2>
     <?php if($options['blog_show_date'] == 'display'){ ?>
     <div class="meta">
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
     </div>
     <?php }; ?>
    </div>
   </div>
  </div>
  <?php endwhile; ?>
 </div><!-- END .blog_list -->

 <?php get_template_part('template-parts/navigation'); ?>

</div><!-- END #archive_blog -->

<?php
     else:

     // 検索結果が無い場合、もしくはキーワードが空の場合 --------------------------------------------------------------------
     $headline = $options['search_result_headline'] ?  $options['search_result_headline'] : 'SEARCH';
     $bg_image = wp_get_attachment_image_src($options['search_result_bg_image'], 'full');
     $overlay_color = hex2rgb($options['search_result_overlay_color']);
     $overlay_opacity = $options['search_result_overlay_opacity'];
     $overlay_color = implode(",",$overlay_color);
?>

<div id="no_search_result"<?php if($bg_image){ echo ' class="has_image"'; }; ?>>

 <div class="content">

  <h2 class="headline"><?php echo nl2br(esc_html($headline)); ?></h2>

  <?php if ($options['search_result_desc']) { ?>
  <div class="desc post_content"><?php if(empty($_GET['s'])){ echo __( 'Search keyword is blank.', 'tcd-canon' ); } else { echo apply_filters('the_content', $options['search_result_desc'] ); }; ?></div>
  <?php } ?>

  <div class="search_form">
   <form role="search" method="get" action="<?php echo esc_url(home_url()); ?>">
    <div class="input_area"><input <?php if($options['search_result_placeholder']){ echo 'placeholder="' . esc_html($options['search_result_placeholder']) . '"'; }; ?> type="text" value="" name="s" autocomplete="off"></div>
    <div class="search_button"><label for="no_search_result_button"></label><input type="submit" id="no_search_result_button" value=""></div>
   </form>
  </div>

  <?php if ($options['search_result_display_post_tag']) { ?>
  <div class="tag_list">
   <?php wp_tag_cloud( array( 'smallest' => 14, 'largest' => 14, 'unit' => 'px', 'format' => 'list', 'include' => $options['search_result_post_tag_list'], 'number' => 0 ) ); ?>
  </div>
  <?php }; ?>

 </div>

 <?php if(!empty($bg_image) && $options['search_result_overlay_opacity'] != 0){ ?>
 <div class="overlay" style="background-color:rgba(<?php echo esc_attr($overlay_color); ?>,<?php echo esc_attr($overlay_opacity); ?>);"></div>
 <?php }; ?>

 <?php if(!empty($bg_image)) { ?>
 <div class="bg_image" style="background:url(<?php echo esc_attr($bg_image[0]); ?>) no-repeat center top; background-size:cover;"></div>
 <?php }; ?>

 <?php
      // コピーライト -------------------------------
      if($options['copyright']){
 ?>
 <p class="copyright"><span><?php echo wp_kses_post($options['copyright']); ?></span></p>
 <?php }; ?>

</div>

<?php endif; ?>

<?php get_footer(); ?>