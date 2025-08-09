<div id="side_col">
<?php
     $sidebar = '';

     if ( is_singular('campaign') || is_post_type_archive('campaign')) {
       $sidebar = 'campaign_widget';
     } elseif ( is_singular('news') || is_post_type_archive('news')) {
       $sidebar = 'news_widget';
     } elseif ( is_page() ) {
       $sidebar = 'page_widget';
     } else {
       $sidebar = 'blog_widget';
     }

     if ( is_mobile() ) {
       $sidebar .= '_mobile';
     }

     if ( is_active_sidebar( $sidebar ) ) {
       dynamic_sidebar( $sidebar );
     } elseif ( is_active_sidebar( 'common_widget' ) ) {
       dynamic_sidebar( 'common_widget' );
     }
?>
</div>