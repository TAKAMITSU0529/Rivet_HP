<?php
     get_header();
     $options = get_design_plus_option();
     $blog_page_id = get_option( 'page_for_posts' );
     $blog_label = $blog_page_id ?  get_the_title($blog_page_id) : __( 'Post', 'tcd-canon' );
     $headline = $blog_label;
     $catch = $options['archive_blog_catch'];
     $image = wp_get_attachment_image_src($options['archive_blog_header_image'], 'full');
     $overlay_color = hex2rgb($options['archive_blog_overlay_color']);
     $overlay_color = implode(",",$overlay_color);
     $overlay_opacity = $options['archive_blog_overlay_opacity'];
     $desc = $options['archive_blog_desc'];
     $desc_mobile = $options['archive_blog_desc_mobile'];
     if (is_category()) {
       $query_obj = get_queried_object();
       $current_cat_id = $query_obj->term_id;
       $term_meta = get_option( 'taxonomy_' . $current_cat_id, array() );
       $catch = $query_obj->name;
       $desc = $query_obj->description;
       $desc_mobile = !empty($term_meta['desc_mobile']) ? $term_meta['desc_mobile'] : '';
     } elseif(is_tag()) {
       $query_obj = get_queried_object();
       $current_cat_id = $query_obj->term_id;
       $term_meta = get_option( 'taxonomy_' . $current_cat_id, array() );
       $catch = $query_obj->name;
       $desc = $query_obj->description;
       $desc_mobile = !empty($term_meta['desc_mobile']) ? $term_meta['desc_mobile'] : '';
     } elseif ( is_day() ) {
       $headline = sprintf( __( 'Archive for %s', 'tcd-canon' ), get_the_time( __( 'F jS, Y', 'tcd-canon' ) ) );
       $catch = '';
       $desc = '';
       $desc_mobile = '';
       $image = '';
     } elseif ( is_month() ) {
       $headline = sprintf( __( 'Archive for %s', 'tcd-canon' ), get_the_time( __( 'F, Y', 'tcd-canon') ) );
       $catch = '';
       $desc = '';
       $desc_mobile = '';
       $image = '';
     } elseif ( is_year() ) {
       $headline = sprintf( __( 'Archive for %s', 'tcd-canon' ), get_the_time( __( 'Y', 'tcd-canon') ) );
       $catch = '';
       $desc = '';
       $desc_mobile = '';
       $image = '';
     }
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

<?php if(is_category()){ get_template_part('template-parts/breadcrumb'); }; ?>

<section id="archive_blog">

 <?php if(!$image || !$options['blog_show_header']){ ?>
 <h1 id="page_headline"><?php echo wp_kses_post(nl2br($headline)); ?></h1>
 <?php }; ?>

 <?php if(!is_paged() && ($catch || $desc || $desc_mobile)){ ?>
 <div id="page_header_desc">
  <?php if(!is_paged() && $catch){ ?>
  <h2 class="catch inview"><?php echo wp_kses_post(nl2br($catch)); ?></h2>
  <?php }; ?>
  <?php if(!is_paged() && $desc){ ?>
  <div class="desc<?php if($desc_mobile){ echo ' pc'; }; ?> post_content inview"><p><?php echo wp_kses_post(nl2br($desc)); ?></p></div>
  <?php }; ?>
  <?php if(!is_paged() && $desc_mobile){ ?>
  <div class="desc mobile post_content inview"><p><?php echo wp_kses_post(nl2br($desc_mobile)); ?></p></div>
  <?php }; ?>
 </div>
 <?php }; ?>

<?php
// オプションが 'display' の場合、カテゴリーソートを表示
if ($options['archive_blog_show_category_list'] == 'display') {
 // 投稿アーカイブページかカテゴリーアーカイブページかをチェック
    if (is_home()) {
        // 投稿アーカイブページでは親カテゴリーのソートボタンを表示
        $category = get_terms('category', array('orderby' => 'id', 'order' => 'ASC', 'hide_empty' => true, 'parent' => 0));
    } elseif (is_category()) {
        // 現在表示しているカテゴリーIDを取得
        $current_category_id = get_queried_object_id();

        // 子カテゴリーを取得
        $category = get_terms('category', array('orderby' => 'id', 'order' => 'ASC', 'hide_empty' => true, 'parent' => $current_category_id));

        // 孫カテゴリーのチェック
        if (empty($category)) {
            $parent_category = get_term($current_category_id);
            $parent_id = $parent_category->parent;

            // 親カテゴリーが存在する場合、その親カテゴリーの子カテゴリーを取得
            if ($parent_id !== 0) {
                $category = get_terms('category', array('orderby' => 'id', 'order' => 'ASC', 'hide_empty' => true, 'parent' => $parent_id));

                // 孫カテゴリーが1つしかない場合はソートボタンを表示しない
                if (count($category) == 1 && is_category()) {
                    $category = null; // 孫カテゴリーが1つの場合はソートボタンを表示しない
                }
            } else {
                // 親カテゴリーが存在しない場合、全体の親カテゴリーリストを表示
                $category = get_terms('category', array('orderby' => 'id', 'order' => 'ASC', 'hide_empty' => true, 'parent' => 0));
            }
        }
    }

    // 現在アクティブなカテゴリーを判定
    $current_category_id = (is_category()) ? get_queried_object_id() : 0;

    // カテゴリーが取得できた場合のみ表示
    if (isset($category)) {
        $total_category = count($category);
?>
 <div class="category_sort_button_wrap inview<?php if($total_category < 6){ echo ' small_size'; }; ?>">
  <div class="category_sort_button_slider swiper">
   <div class="category_sort_button swiper-wrapper">
    <?php
         $i = 1;
         foreach ( $category as $cat ) :
           $cat_id = $cat->term_id;
           $cat_url = get_term_link($cat_id,'category');
    ?>
    <div class="item swiper-slide<?php if(is_category()){ if($cat_id == $current_cat_id){ echo ' active_menu'; }; }; ?>">
     <a href="<?php echo esc_url($cat_url); ?>#bread_crumb"><?php echo esc_html($cat->name); ?></a>
    </div>
    <?php $i++; endforeach; ?>
   </div>
  </div>
  <div class="category_sort_button_prev swiper-nav-button type2 swiper-button-prev"></div>
  <div class="category_sort_button_next swiper-nav-button type2 swiper-button-next"></div>
 </div>
 <?php
          };
        };
 ?>

 <?php if ( have_posts() ) : ?>

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
            if(is_category()){
              $cat_name = $query_obj->name;
              $cat_id = $query_obj->term_id;
              $cat_url = get_term_link($cat_id,'category');
       ?>
       <a class="category" href="<?php echo esc_url($cat_url); ?>"><?php echo esc_html($cat_name); ?></a>
       <?php
            } else {
              foreach ( $category as $cat ) :
                $cat_name = $cat->name;
                $cat_id = $cat->term_id;
                $cat_url = get_term_link($cat_id,'category');
       ?>
       <a class="category" href="<?php echo esc_url($cat_url); ?>"><?php echo esc_html($cat_name); ?></a>
       <?php
             endforeach;
           };
       ?>
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