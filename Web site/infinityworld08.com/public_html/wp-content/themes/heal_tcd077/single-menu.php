<?php
     get_header();
     $options = get_design_plus_option();
     $headline = get_post_meta($post->ID, 'menu_header_title', true);
     $headline_color = $options['menu_title_color'];
     $sub_title = get_post_meta($post->ID, 'menu_header_sub_title', true);
     if(has_post_thumbnail()) {
       $image_id = get_post_thumbnail_id( $post->ID );
     } else {
       $image_id = $options['menu_bg_image'];
     }
     if(!empty($image_id)) {
       $image = wp_get_attachment_image_src($image_id, 'full');
     }
     $use_overlay = $options['menu_use_overlay'];
     if($use_overlay) {
       $overlay_color = hex2rgb($options['menu_overlay_color']);
       $overlay_color = implode(",",$overlay_color);
       $overlay_opacity = $options['menu_overlay_opacity'];
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

<div id="menu_single">

 <div id="menu_content_wrap">

  <?php
       // コンテンツビルダー
       $menu_cf = get_post_meta( $post->ID, 'menu_cf', true );
       if ( $menu_cf && is_array( $menu_cf ) ) :
         foreach( $menu_cf as $key => $content ) :

         // コンテンツ１ -----------------------------------------------------------------
         if ( ($content['cb_content_select'] == 'content1') && $content['show_content']) {

           $image1 = $content['image1'];
           if(!empty($image1)) {
             $image1 = wp_get_attachment_image_src($image1, 'full');
           }
           $image2 = $content['image2'];
           if(!empty($image2)) {
             $image2 = wp_get_attachment_image_src($image2, 'full');
           }
  ?>
  <div class="menu_content menu_content1 num<?php echo esc_attr($key); ?>">
   <?php if(!empty($content['headline'])) { ?>
   <h2 class="headline rich_font"><?php echo esc_html($content['headline']); ?><?php if(!empty($content['sub_headline'])) { ?><span><?php echo esc_html($content['sub_headline']); ?></span><?php }; ?></h2>
   <?php }; ?>
   <?php if(!empty($content['desc'])) { ?>
   <div class="post_content clearfix">
    <?php echo apply_filters('the_content', $content['desc'] ); ?>
   </div>
   <?php }; ?>
   <?php if($image1 || $image2){ ?>
   <div class="image_area clearfix">
    <?php if($image1){ ?><img src="<?php echo esc_attr($image1[0]); ?>" alt="" title="" /><?php }; ?>
    <?php if($image2){ ?><img src="<?php echo esc_attr($image2[0]); ?>" alt="" title="" /><?php }; ?>
   </div>
   <?php }; ?>
  </div><!-- END .menu_content1 -->

  <?php
       // コンテンツ２ -----------------------------------------------------------------
       } elseif ( ($content['cb_content_select'] == 'content2') && $content['show_content']) {
  ?>
  <div class="menu_content menu_content2 num<?php echo esc_attr($key); ?>">
   <?php if(!empty($content['headline'])) { ?>
   <h2 class="headline rich_font"><?php echo esc_html($content['headline']); ?><?php if(!empty($content['sub_headline'])) { ?><span><?php echo esc_html($content['sub_headline']); ?></span><?php }; ?></h2>
   <?php }; ?>

   <?php if (!empty($content['price_list1']) && !empty($content['show_price_list1']) && is_array( $content['price_list1'] ) ) : ?>
   <div class="menu_price_list1">
    <?php if(!empty($content['price_list1_headline'])) { ?>
    <h3 class="list_headline rich_font"><?php echo esc_html($content['price_list1_headline']); ?></h3>
    <?php }; ?>
    <table class="menu_price_list clearfix">
     <?php
          foreach ( $content['price_list1'] as $key => $value ) :
            $item_time = $value['time'];
            $item_content = $value['content'];
            $item_price = $value['price'];
     ?>
     <tr>
      <td class="col1"><?php if($item_time) { echo '<p>' . esc_html($item_time) . '</p>'; }; ?></td>
      <td class="col2"><?php if($item_content) { echo '<p>' . esc_html($item_content) . '</p>'; }; ?></td>
      <td class="col3"><?php if($item_price) { echo '<p>' . esc_html($item_price) . '</p>'; }; ?></td>
     </tr>
     <?php endforeach; ?>
    </table>
   </div>
   <?php endif; ?>

   <?php if (!empty($content['price_list2']) && !empty($content['show_price_list2']) && is_array( $content['price_list2'] ) ) : ?>
   <div class="menu_price_list2">
    <?php if(!empty($content['price_list2_headline'])) { ?>
    <h3 class="list_headline rich_font"><?php echo esc_html($content['price_list2_headline']); ?></h3>
    <?php }; ?>
    <table class="menu_price_list clearfix">
     <?php
          foreach ( $content['price_list2'] as $key => $value ) :
            $item_time = $value['time'];
            $item_content = $value['content'];
            $item_price = $value['price'];
     ?>
     <tr>
      <td class="col1"><?php if($item_time) { echo '<p>' . esc_html($item_time) . '</p>'; }; ?></td>
      <td class="col2"><?php if($item_content) { echo '<p>' . esc_html($item_content) . '</p>'; }; ?></td>
      <td class="col3"><?php if($item_price) { echo '<p>' . esc_html($item_price) . '</p>'; }; ?></td>
     </tr>
     <?php endforeach; ?>
    </table>
   </div>
   <?php endif; ?>

   <?php if (!empty($content['price_list3']) && !empty($content['show_price_list3']) && is_array( $content['price_list3'] ) ) : ?>
   <div class="menu_price_list3">
    <?php if(!empty($content['price_list3_headline'])) { ?>
    <h3 class="list_headline rich_font"><?php echo esc_html($content['price_list3_headline']); ?></h3>
    <?php }; ?>
    <table class="menu_price_list type2 clearfix">
     <?php
          foreach ( $content['price_list3'] as $key => $value ) :
            $item_content = $value['content'];
            $item_price = $value['price'];
     ?>
     <tr>
      <td class="col1"><?php if($item_content) { echo '<p>' . esc_html($item_content) . '</p>'; }; ?></td>
      <td class="col2"><?php if($item_price) { echo '<p>' . esc_html($item_price) . '</p>'; }; ?></td>
     </tr>
     <?php endforeach; ?>
    </table>
   </div>
   <?php endif; ?>

   <?php if(!empty($content['desc'])) { ?>
   <div class="post_content clearfix">
    <?php echo apply_filters('the_content', $content['desc'] ); ?>
   </div>
   <?php }; ?>

  </div><!-- END .menu_content2 -->

  <?php
       // コンテンツ３ -----------------------------------------------------------------
       } elseif ( ($content['cb_content_select'] == 'content3') && $content['show_content'] ) {
  ?>
  <div class="menu_content menu_content3 num<?php echo esc_attr($key); ?>">
   <?php if(!empty($content['headline'])) { ?>
   <h2 class="list_headline rich_font"><?php echo esc_html($content['headline']); ?></h2>
   <?php }; ?>

   <?php if (!empty($content['howto_list']) && is_array( $content['howto_list'] ) ) : ?>
   <div class="menu_howto_list clearfix">
    <?php
         foreach ( $content['howto_list'] as $key => $value ) :
           $item_title = $value['title'];
           $item_content = $value['content'];
           $item_image = $value['image'];
           if(!empty($item_image)) {
             $item_image = wp_get_attachment_image_src($item_image, 'full');
           }
    ?>
    <div class="item clearfix">
     <?php if($item_image){ ?><div class="image" style="background:url(<?php echo esc_attr($item_image[0]); ?>) no-repeat center center; background-size:cover;"></div><?php }; ?>
     <?php if($item_title || $item_content){ ?>
     <div class="title_area">
      <div class="title_area_inner">
       <?php if($item_title){ ?><h3 class="title rich_font"><?php echo esc_html($item_title); ?></h3><?php }; ?>
       <?php if($item_content){ ?><p class="desc"><?php echo wp_kses_post(nl2br($item_content)); ?></p><?php }; ?>
      </div>
     </div>
     <?php }; ?>
    </div>
    <?php endforeach; ?>
   </div>
   <?php endif; ?>

  </div><!-- END .menu_content3 -->

  <?php
       // コンテンツ４ -----------------------------------------------------------------
       } elseif ( ($content['cb_content_select'] == 'content4') && $content['show_content'] ) {
  ?>
  <div class="menu_content menu_content4 num<?php echo esc_attr($key); ?>">

   <?php if(!empty($content['desc'])) { ?>
   <div class="post_content clearfix">
    <?php echo apply_filters('the_content', $content['desc'] ); ?>
   </div>
   <?php }; ?>

  </div><!-- END .menu_content4 -->

  <?php
           };
         endforeach; // END 並び替え
       endif;
  ?>

 </div><!-- END #menu_content_wrap -->

</div><!-- END #menu_single -->

<?php
     // メニュー一覧 ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
     if ($options['single_show_menu_list']){
?>
<div id="single_menu_list">

 <?php
      $headline = $options['single_menu_list_headline'];
      $sub_heading = $options['single_menu_list_sub_headline'];
      if($headline || $sub_heading) {
 ?>
 <?php if($headline) { ?><h2 class="headline rich_font"><?php echo nl2br(esc_html($headline)); ?><?php if($sub_heading) { ?><span><?php echo nl2br(esc_html($sub_heading)); ?></span><?php }; ?></h2><?php }; ?>
 <?php }; ?>

  <?php
       $post_num = $options['single_menu_list_num'];
       $args = array( 'post_type' => 'menu', 'posts_per_page' => $post_num );
       $menu_list_query = new wp_query($args);
       if($menu_list_query->have_posts()):
  ?>
  <div class="menu_list clearfix">
   <?php
        while($menu_list_query->have_posts()): $menu_list_query->the_post();
          $menu_header_title = get_post_meta($post->ID, 'menu_header_title', true);
          $menu_header_sub_title = get_post_meta($post->ID, 'menu_header_sub_title', true);
          $image = get_post_meta($post->ID, 'menu_archive_image', true);
          if($image) {
            $image = wp_get_attachment_image_src( $image, 'full' );
          } elseif($options['no_image1']) {
            $image = wp_get_attachment_image_src( $options['no_image1'], 'full' );
          } else {
            $image = array();
            $image[0] = esc_url(get_bloginfo('template_url')) . "/img/common/no_image1.gif";
          }
   ?>
   <article class="item">
    <a class="clearfix animate_background" href="<?php the_permalink(); ?>">
     <div class="image_wrap">
      <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
     </div>
     <div class="title_area rich_font">
      <?php if($menu_header_title || $menu_header_sub_title) { ?>
      <h3 class="title"><?php if($menu_header_title){ echo esc_html($menu_header_title); }; ?><?php if($menu_header_sub_title){ echo '<span>' . esc_html($menu_header_sub_title) . '</span>'; }; ?></h3>
      <?php }; ?>
     </div>
    </a>
   </article>
   <?php endwhile; ?>
  </div><!-- END .menu_list -->
  <?php endif; ?>

</div><!-- END #single_menu_list -->
<?php }; ?>

<?php get_footer(); ?>