<?php
/**
 * Add custom columns (ID, thumbnails)
 */
function manage_columns( $columns ) {

  global $post_type;
  $options = get_design_plus_option();

  // Make new column array with ID column and featured image column
  $new_columns = array();

  foreach ( $columns as $column_name => $column_display_name ) {

    // タイトルの前にIDを追加
    if ( isset( $columns['title'] ) && $column_name == 'title' ) {
      $new_columns['post_id'] = 'ID';
    }

    // 日付の前に以下の項目を追加
    if ( isset( $columns['date'] ) && $column_name == 'date' ) {

      if( $post_type === 'news' ){
        $new_columns['news_category'] = __( 'Category', 'tcd-canon' );
        $new_columns['recommend_news'] = __( 'Recommend post', 'tcd-canon' );
      }

      if( $post_type === 'gallery' && $options['gallery_use_category'] == 'yes' ){
        $new_columns['gallery_category'] = __( 'Category', 'tcd-canon' );
      }

      $new_columns['new_post_thumb'] = __( 'Featured Image', 'tcd-canon' );

    }

    $new_columns[$column_name] = $column_display_name;

  }

  return $new_columns;
}
add_filter( 'manage_posts_columns', 'manage_columns', 5 ); // For post, news, event and special


/**
 * おすすめ記事を追加
 */
function manage_post_posts_columns( $columns ) {

  $options =  get_design_plus_option();
  $service_label = $options['service_label'] ? esc_html( $options['service_label'] ) : __( 'Service', 'tcd-canon' );
  $gallery_label = $options['gallery_label'] ? esc_html( $options['gallery_label'] ) : __( 'Guest room', 'tcd-canon' );

  $new_columns = array();
  foreach ( $columns as $column_name => $column_display_name ) {
    if ( isset( $columns['new_post_thumb'] ) && $column_name == 'new_post_thumb' ) {
      $new_columns['recommend_post'] = __( 'Recommend post', 'tcd-canon' );
      $new_columns['related_gallery_category'] = sprintf(__('Linked %s category', 'tcd-canon'), $gallery_label);
      $new_columns['related_gallery'] = sprintf(__('Linked %s', 'tcd-canon'), $gallery_label);
      $new_columns['related_service'] = sprintf(__('Linked %s', 'tcd-canon'), $service_label);
    }
    $new_columns[$column_name] = $column_display_name;
  }
  return $new_columns;

}
add_filter( 'manage_post_posts_columns', 'manage_post_posts_columns' ); // Only for post


/**
 * Output the content of custom columns (ID, featured image, recommend post and event date)
 */
function add_column( $column_name, $post_id ) {

  $options = get_design_plus_option();

  switch ( $column_name ) {

    case 'new_post_thumb' : // アイキャッチ画像
      $post_thumbnail_id = get_post_thumbnail_id( $post_id );
      if ( $post_thumbnail_id ) {
        $post_thumbnail_img = wp_get_attachment_image_src( $post_thumbnail_id, 'size1' );
        echo '<img width="70" src="' . esc_attr( $post_thumbnail_img[0] ) . '">';
      }
      break;

    case 'recommend_post' : // おすすめ記事
      if ( get_post_meta( $post_id, 'recommend_post', true ) ) { echo '<p>' . __( 'Recommend post', 'tcd-canon' ) . '1</p>'; }
      if ( get_post_meta( $post_id, 'recommend_post2', true ) ) { echo '<p>' . __( 'Recommend post', 'tcd-canon' ) . '2</p>'; }
      if ( get_post_meta( $post_id, 'recommend_post3', true ) ) { echo '<p>' . __( 'Recommend post', 'tcd-canon' ) . '3</p>'; }
      break;

    case 'related_gallery_category' : // 関連ギャラリーカテゴリー
      if ( get_post_meta( $post_id, 'relation_gallery_category', true ) ) {
        $item_list = get_post_meta( $post_id, 'relation_gallery_category', true );
        foreach ( $item_list as $key => $value ) :
          $category = get_term($value, 'gallery_category');
          if($category){
            $category_name = $category->name;
            $cat_id = $category->term_id;
            $category_link = get_edit_term_link($cat_id, 'gallery_category');
            if($category_name && $category_link){
              echo "<p><a href='" . esc_url($category_link) . "' target='_blank'>" . esc_html($category_name) . "</a></p>\n";
            }
          }
        endforeach;
      }
      break;

    case 'related_gallery' : // 関連ギャラリー
      if ( get_post_meta( $post_id, 'relation_gallery', true ) ) {
        $item_list = get_post_meta( $post_id, 'relation_gallery', true );
        foreach ( $item_list as $key => $value ) :
          echo "<p><a href='" . esc_url(get_edit_post_link($value)) . "' target='_blank'>" . esc_html(get_the_title($value)) . "</a></p>\n";
        endforeach;
      }
      break;

    case 'related_service' : // 関連レストラン
      if ( get_post_meta( $post_id, 'relation_service', true ) ) {
        $item_list = get_post_meta( $post_id, 'relation_service', true );
        foreach ( $item_list as $key => $value ) :
          echo "<p><a href='" . esc_url(get_edit_post_link($value)) . "' target='_blank'>" . esc_html(get_the_title($value)) . "</a></p>\n";
        endforeach;
      }
      break;

    case 'recommend_news' : // おすすめ記事 お知らせ用
      if ( get_post_meta( $post_id, 'recommend_post', true ) ) { echo '<p>' . __( 'Recommend post', 'tcd-canon' ) . '1</p>'; }
      if ( get_post_meta( $post_id, 'recommend_post2', true ) ) { echo '<p>' . __( 'Recommend post', 'tcd-canon' ) . '2</p>'; }
      if ( get_post_meta( $post_id, 'recommend_post3', true ) ) { echo '<p>' . __( 'Recommend post', 'tcd-canon' ) . '3</p>'; }
      break;

    case 'news_category' :
      if ( $news_category = get_the_terms( $post_id, 'news_category' ) ) {
        foreach ( $news_category as $cats ) {
          printf( '<a href="%s">%s</a>', esc_url( get_edit_term_link( $cats, 'news_category' ) ), $cats->name );
        }
      }
      break;

    case 'gallery_category' :
      if($options['gallery_use_category'] == 'yes'){
        if ( $gallery_category = get_the_terms( $post_id, 'gallery_category' ) ) {
          foreach ( $gallery_category as $cats ) {
            printf( '<a href="%s">%s</a>', esc_url( get_edit_term_link( $cats, 'gallery_category' ) ), $cats->name );
          }
        }
      }
      break;

  }

}
add_action( 'manage_posts_custom_column', 'add_column', 10, 2 ); // For post
add_action( 'manage_pages_custom_column', 'add_column', 10, 2 ); // For page


/**
 * Enable sorting of the ID column
 */
function custom_quick_edit_sortable_columns( $sortable_columns ) {
  $sortable_columns['post_id'] = 'ID';
  return $sortable_columns;
}
//add_filter( 'manage_edit-post_sortable_columns', 'custom_quick_edit_sortable_columns' ); // For post
//add_filter( 'manage_edit-news_sortable_columns', 'custom_quick_edit_sortable_columns' ); // For news
add_filter( 'manage_edit-page_sortable_columns', 'custom_quick_edit_sortable_columns' ); // For page





?>