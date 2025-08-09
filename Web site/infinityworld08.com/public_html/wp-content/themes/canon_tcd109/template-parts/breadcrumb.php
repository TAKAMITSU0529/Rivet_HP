<?php
     $options = get_design_plus_option();
     global $post;
     $blog_page_id = get_option( 'page_for_posts' );
     $blog_label = $blog_page_id ?  get_the_title($blog_page_id) : __( 'Post', 'tcd-canon' );
?>
<div id="bread_crumb">
 <ul itemscope itemtype="https://schema.org/BreadcrumbList">
 <?php
     // お知らせアーカイブ -----------------------
     if(is_post_type_archive('news')) {
 ?>
 <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-canon'); ?></span></a><meta itemprop="position" content="1"></li>
 <li class="last" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><span itemprop="name"><?php echo esc_html($options['news_label']); ?></span><meta itemprop="position" content="2"></li>
 <?php
     // お知らせカテゴリー -----------------------
     } elseif(is_tax('news_category')) {
       $query_obj = get_queried_object();
       $current_cat_id = $query_obj->term_id;
       $title = single_cat_title('', false);
 ?>
 <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-canon'); ?></span></a><meta itemprop="position" content="1"></li>
 <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_post_type_archive_link('news')); ?>"><span itemprop="name"><?php echo esc_html($options['news_label']); ?></span></a><meta itemprop="position" content="2"></li>
 <?php
        $i = 3;
        if($query_obj->parent!=0):
          $ancestors = array_reverse(get_ancestors( $query_obj -> term_id, 'news_category' ));
          foreach($ancestors as $ancestor):
            $taxonomy = get_term($ancestor);
 ?>
 <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_category_link($ancestor)); ?>"><span itemprop="name"><?php echo esc_html($taxonomy->name); ?></span></a><meta itemprop="position" content="<?php echo $i; ?>" /></li>
 <?php $i++; endforeach; ?>
 <?php endif; ?>
 <li class="last" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><span itemprop="name"><?php echo esc_html($title); ?></span><meta itemprop="position" content="<?php echo $i; ?>"></li>
 <?php
     // お知らせ詳細 -----------------------
     } elseif(is_singular('news')) {
       $category = wp_get_post_terms( $post->ID, 'news_category' , array( 'orderby' => 'term_order' ));
 ?>
 <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-canon'); ?></span></a><meta itemprop="position" content="1"></li>
 <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_post_type_archive_link('news')); ?>"><span itemprop="name"><?php echo esc_html($options['news_label']); ?></span></a><meta itemprop="position" content="2"></li>
 <?php if ( $category && ! is_wp_error($category) ) { ?>
 <li class="category" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
  <?php
       $count=1;
       foreach ($category as $cat) {
  ?>
  <a itemprop="item" href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"><span itemprop="name"><?php echo esc_html($cat->name); ?></span></a>
  <?php $count++; } ?>
  <meta itemprop="position" content="3">
 </li>
 <?php }; ?>
 <li class="last" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><span itemprop="name"><?php the_title_attribute(); ?></span><meta itemprop="position" content="<?php if ( $category ) { echo '4'; } else { echo '3'; }; ?>"></li>
 <?php
     // 客室アーカイブ -----------------------
     } elseif(is_post_type_archive('gallery')) {
 ?>
 <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-canon'); ?></span></a><meta itemprop="position" content="1"></li>
 <li class="last" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><span itemprop="name"><?php echo esc_html($options['gallery_label']); ?></span><meta itemprop="position" content="2"></li>
 <?php
     // 客室カテゴリー -----------------------
     } elseif(is_tax('gallery_category')) {
       $category_title = single_cat_title('', false);
 ?>
 <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-canon'); ?></span></a><meta itemprop="position" content="1"></li>
 <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_post_type_archive_link('gallery')); ?>"><span itemprop="name"><?php echo esc_html($options['gallery_label']); ?></span></a><meta itemprop="position" content="2"></li>
 <li class="last" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><span itemprop="name"><?php echo esc_html($category_title); ?></span><meta itemprop="position" content="3"></li>
 <?php
     // 客室詳細 -----------------------
     } elseif(is_singular('gallery')) {
       $category = wp_get_post_terms( $post->ID, 'gallery_category' , array( 'orderby' => 'term_order' ));
 ?>
 <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-canon'); ?></span></a><meta itemprop="position" content="1"></li>
 <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_post_type_archive_link('gallery')); ?>"><span itemprop="name"><?php echo esc_html($options['gallery_label']); ?></span></a><meta itemprop="position" content="2"></li>
 <?php if ( $options['gallery_use_category'] == 'yes' && $category && ! is_wp_error($category) ) { ?>
 <li class="category" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
  <?php
       $count=1;
       foreach ($category as $cat) {
  ?>
  <a itemprop="item" href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"><span itemprop="name"><?php echo esc_html($cat->name); ?></span></a>
  <?php $count++; } ?>
  <meta itemprop="position" content="3">
 </li>
 <?php }; ?>
 <li class="last" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><span itemprop="name"><?php the_title_attribute(); ?></span><meta itemprop="position" content="<?php if ( $options['gallery_use_category'] == 'yes' && $category ) { echo '4'; } else { echo '3'; }; ?>"></li>
 <?php
     // レストランアーカイブ -----------------------
     } elseif(is_post_type_archive('service')) {
 ?>
 <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-canon'); ?></span></a><meta itemprop="position" content="1"></li>
 <li class="last" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><span itemprop="name"><?php echo esc_html($options['service_label']); ?></span><meta itemprop="position" content="2"></li>
 <?php
     // レストラン詳細 -----------------------
     } elseif(is_singular('service')) {
 ?>
 <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-canon'); ?></span></a><meta itemprop="position" content="1"></li>
 <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_post_type_archive_link('service')); ?>"><span itemprop="name"><?php echo esc_html($options['service_label']); ?></span></a><meta itemprop="position" content="2"></li>
 <li class="last" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><span itemprop="name"><?php the_title_attribute(); ?></span><meta itemprop="position" content="3"></li>
 <?php
      // 検索結果 -----------------------
      } elseif(is_search()) {
 ?>
 <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-canon'); ?></span></a><meta itemprop="position" content="1"></li>
 <li class="last" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><span itemprop="name"><?php _e('Search result','tcd-canon'); ?></span><meta itemprop="position" content="2"></li>
 <?php
      // ブログアーカイブ -----------------------
      } elseif(is_home()) {
 ?>
 <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-canon'); ?></span></a><meta itemprop="position" content="1"></li>
 <li class="last" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><span itemprop="name"><?php echo esc_html($blog_label); ?></span><meta itemprop="position" content="2"></li>
 <?php
      // 投稿者ページ -----------------------
      } elseif(is_author()) {
        $author_info = $wp_query->get_queried_object();
        $author_name = $author_info->display_name;
        $title = $author_name;
        $title = sprintf( __( '%s\'s post list', 'tcd-canon' ), $title );
 ?>
 <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-canon'); ?></span></a><meta itemprop="position" content="1"></li>
 <li class="last" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><span itemprop="name"><?php echo esc_html($title); ?></span><meta itemprop="position" content="2"></li>
 <?php
      // カテゴリーアーカイブページ -----------------------
      } elseif(is_category()) {
        $query_obj = get_queried_object();
        $current_cat_id = $query_obj->term_id;
        $title = single_cat_title('', false);
 ?>
 <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-canon'); ?></span></a><meta itemprop="position" content="1"></li>
 <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>"><span itemprop="name"><?php echo esc_html($blog_label); ?></span></a><meta itemprop="position" content="2"></li>
 <?php
        $i = 3;
        if($query_obj->parent!=0):
          $ancestors = array_reverse(get_ancestors( $query_obj -> cat_ID, 'category' ));
          foreach($ancestors as $ancestor):
 ?>
 <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_category_link($ancestor)); ?>"><span itemprop="name"><?php echo esc_html(get_cat_name($ancestor)); ?></span></a><meta itemprop="position" content="<?php echo $i; ?>" /></li>
 <?php $i++; endforeach; ?>
 <?php endif; ?>
 <li class="last" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><span itemprop="name"><?php echo esc_html($title); ?></span><meta itemprop="position" content="<?php echo $i; ?>"></li>
 <?php
      // タグ, その他のアーカイブページ -----------------------
      } elseif(is_tag() || is_day() || is_month() || is_year()) {
        if (is_category()) {
          $title = single_cat_title('', false);
        } elseif( is_tag() ) {
          $title = single_tag_title('', false);
        } elseif (is_day()) {
          $title = sprintf(__('Archive for %s', 'tcd-canon'), get_the_time(__('F jS, Y', 'tcd-canon')) );
        } elseif (is_month()) {
          $title = sprintf(__('Archive for %s', 'tcd-canon'), get_the_time(__('F, Y', 'tcd-canon')) );
        } elseif (is_year()) {
          $title = sprintf(__('Archive for %s', 'tcd-canon'), get_the_time(__('Y', 'tcd-canon')) );
        };
 ?>
 <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-canon'); ?></span></a><meta itemprop="position" content="1"></li>
 <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>"><span itemprop="name"><?php echo esc_html($blog_label); ?></span></a><meta itemprop="position" content="2"></li>
 <li class="last" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><span itemprop="name"><?php echo esc_html($title); ?></span><meta itemprop="position" content="3"></li>
 <?php
      //  固定ページ -----------------------
      } elseif(is_page()) {
        $ancestors_ids = array_reverse(get_post_ancestors( $post ));
        $content_num = 2;
 ?>
 <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-canon'); ?></span></a><meta itemprop="position" content="1"></li>
 <?php
      if(!empty($ancestors_ids)){
        foreach($ancestors_ids as $page_id):
 ?>
 <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_permalink($page_id)); ?>"><span itemprop="name"><?php echo esc_html(get_the_title($page_id)); ?></span></a><meta itemprop="position" content="<?php echo esc_attr($content_num); ?>"></li>
 <?php
          $content_num++;
        endforeach;
      };
 ?>
 <li class="last" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><span itemprop="name"><?php the_title_attribute(); ?></span><meta itemprop="position" content="<?php echo esc_attr($content_num); ?>"></li>
 <?php
      //  添付画像ページ -----------------------
      } elseif(is_attachment()) {
 ?>
 <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-canon'); ?></span></a><meta itemprop="position" content="1"></li>
 <li class="last" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><span itemprop="name"><?php the_title_attribute(); ?></span><meta itemprop="position" content="2"></li>
 <?php
      // その他のページ（ブログ詳細ページ） -----------------------
      } else {
        $category = wp_get_post_terms( $post->ID, 'category' );
 ?>
 <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="home"><a itemprop="item" href="<?php echo esc_url(home_url('/')); ?>"><span itemprop="name"><?php _e('Home', 'tcd-canon'); ?></span></a><meta itemprop="position" content="1"></li>
 <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>"><span itemprop="name"><?php echo esc_html($blog_label); ?></span></a><meta itemprop="position" content="2"></li>
 <?php if ( $category && ! is_wp_error($category) ) { ?>
 <li class="category" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
  <?php
       $count=1;
       foreach ($category as $cat) {
  ?>
  <a itemprop="item" href="<?php echo esc_url(get_category_link($cat->term_id)); ?>"><span itemprop="name"><?php echo esc_html($cat->name); ?></span></a>
  <?php $count++; } ?>
  <meta itemprop="position" content="3">
 </li>
 <?php }; ?>
 <li class="last" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><span itemprop="name"><?php the_title_attribute(); ?></span><meta itemprop="position" content="<?php if ( $category ) { echo '4'; } else { echo '3'; }; ?>"></li>
 <?php }; ?>
 </ul>
</div>
