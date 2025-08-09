<?php
     get_header();
     $options = get_design_plus_option();

     $author_info = $wp_query->get_queried_object();
     $author_id = $author_info->ID;
     $author_data = get_userdata($author_id);
     $author_name = $author_data->display_name;

     $desc = $author_data->description;
     $facebook = $author_data->facebook_url;
     $twitter = $author_data->twitter_url;
     $insta = $author_data->instagram_url;
     $pinterest = $author_data->pinterest_url;
     $youtube = $author_data->youtube_url;
     $tiktok = $author_data->tiktok_url;
     $user_url = $author_data->user_url;
     $contact = $author_data->contact_url;
?>
<?php get_template_part('template-parts/breadcrumb'); ?>

<section id="archive_blog">

 <?php if(!is_paged()){ ?>
 <div id="author_archive_header" class="inview">

   <div class="name_area">
    <?php echo wp_kses_post(get_avatar($author_id, 300)); ?>
    <h1 class="name"><?php echo esc_html($author_name); ?></h1>
    <?php if($facebook || $twitter || $insta || $pinterest || $youtube || $contact || $user_url || $tiktok) { ?>
    <ul id="author_sns" class="sns_button_list color_<?php echo esc_attr($options['sns_button_color_type']); ?>">
     <?php if($user_url) { ?><li class="user_url"><a href="<?php echo esc_url($user_url); ?>" target="_blank"><span><?php echo esc_url($user_url); ?></span></a></li><?php }; ?>
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

   <?php if($desc) { ?>
   <div class="desc">
    <p><?php echo wp_kses_post(nl2br($desc)); ?></p>
   </div>
   <?php }; ?>

 </div><!-- END #author_archive_header -->
 <?php }; ?>

 <?php
      // ブログ一覧 -------------------------
      if ( have_posts() ) :
 ?>

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
  <?php endwhile; ?>
 </div><!-- END .blog_list -->

 <?php get_template_part('template-parts/navigation'); ?>

 <?php else: ?>

 <p id="no_post"><?php _e('There is no registered post.', 'tcd-canon');  ?></p>

 <?php endif; ?>

</section><!-- END #archive_blog -->

<?php get_footer(); ?>