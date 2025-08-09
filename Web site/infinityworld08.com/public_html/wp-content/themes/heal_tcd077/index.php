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

<div id="blog_archive">

 <?php
      $catch = '';
      $desc = '';
      if (is_category()) {
        $catch = single_cat_title('', false);
      } elseif( is_tag() ) {
        $catch = single_tag_title('', false);
      } elseif (is_day()) {
        $catch = get_the_time(__('F jS, Y', 'tcd-w'));
      } elseif (is_month()) {
        $catch = get_the_time(__('F, Y', 'tcd-w'));
      } elseif (is_year()) {
        $catch = get_the_time(__('Y', 'tcd-w'));
      } elseif (is_author()) {
        global $wp_query;
        $curauth = $wp_query->get_queried_object();
        $author_id = $curauth->ID;
        $user_data = get_userdata($author_id);
        $author_name = $user_data->display_name;
        $catch = $author_name;
      } else {
        $catch = $options['blog_catch'];
        $desc = $options['blog_desc'];
      }
      if($catch || $desc) {
 ?>
 <div id="catch_area">
  <?php if($catch) { ?><h2 class="catch rich_font"><?php echo nl2br(esc_html($catch)); ?></h2><?php }; ?>
  <?php if($desc) { ?><p class="desc"><?php echo nl2br(esc_html($desc)); ?></p><?php }; ?>
 </div>
 <?php }; ?>

 <?php if ( have_posts() ) : ?>

 <div class="blog_list clearfix">
  <?php
       while ( have_posts() ) : the_post();
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
    <?php if ($options['show_archive_blog_category']) { ?>
    <li class="category">
        <?php
        $categories = get_the_category();
        if (!empty($categories)) {
            $category_name = $categories[0]->name; // 最初のカテゴリを取得
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
<?php if ($options['show_archive_blog_date']){ ?><li class="date"><time class="entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time></li><?php }; ?>
    </ul>
   </div>
  </article>
  <?php endwhile; ?>
 </div><!-- END .blog_list -->

 <?php get_template_part('template-parts/navigation'); ?>

 <?php else: ?>

 <p id="no_post"><?php _e('There is no registered post.', 'tcd-w');  ?></p>

 <?php endif; ?>

</div><!-- END #blog_archive -->

<?php get_footer(); ?>