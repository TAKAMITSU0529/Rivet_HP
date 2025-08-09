<?php $options = get_design_plus_option(); ?>

 <?php
      if(is_page()){ 
        $page_hide_footer = get_post_meta($post->ID, 'page_hide_footer', true) ?  get_post_meta($post->ID, 'page_hide_footer', true) : 'no';
      } else {
        $page_hide_footer = 'no';
      }

      if($page_hide_footer != 'yes'){
 ?>

 <?php
      // フッター --------------------------------------------------
 ?>

 <?php // ページ上部に戻るリンク ------------------------------- ?>
 <a id="return_top" href="#body"><span>RETURN TOP</span></a>

 <?php
      // バナー --------------------------------------------------
      $item_list = $options['footer_banner_list'];
        if($item_list){
          $item_total = 0;
          foreach ( $item_list as $key => $value ) :
            $image = isset($value['image']) ? $value['image'] : '';
            $url = isset($value['url']) ? $value['url'] : '';
            if($image && $url){
              $item_total++;
            }
          endforeach;
 ?>
 <div id="footer_banner_wrap"<?php if($item_total > 4){ echo ' class="use_animation"'; }; ?>>
  <div class="footer_banner">
   <?php
         foreach ( $item_list as $key => $value ) :
           $image = isset($value['image']) ? wp_get_attachment_image_src( $value['image'], 'full' ) : '';
           $title = isset($value['title']) ? $value['title'] : '';
           $url = isset($value['url']) ? $value['url'] : '';
           $target = isset($value['target']) ? $value['target'] : '';
           if($image && $url){
    ?>
   <a class="item animate_background" href="<?php echo esc_attr($url); ?>"<?php if($target){ echo ' target="_blank"'; }; ?>>
    <div class="image_wrap">
     <img loading="lazy" class="image" src="<?php echo esc_attr($image[0]); ?>" width="<?php echo esc_attr($image[1]); ?>" height="<?php echo esc_attr($image[2]); ?>" />
    </div>
    <?php if($title){ ?><span class="title"><?php echo esc_html($title); ?></span><?php }; ?>
   </a>
    <?php
           };
         endforeach;
    ?>
  </div>
 </div>
 <?php }; ?>

 <footer id="footer">

  <?php // ロゴ ---------------------------------------- ?>
  <?php footer_logo(); ?>

  <?php
       // メニュー --------------------------------------------
       if(!is_mobile()){
         if (has_nav_menu('footer-menu1') || has_nav_menu('footer-menu2') || has_nav_menu('footer-menu3') || has_nav_menu('footer-menu4')) {
  ?>
  <div id="footer_menu">
   <?php
        if(has_nav_menu('footer-menu1')){
          wp_nav_menu( array( 'sort_column' => 'menu_order', 'theme_location' => 'footer-menu1' , 'depth' => '1', 'container' => 'nav', 'container_id' => 'footer_nav1' ) );
        }
        if(has_nav_menu('footer-menu2')){
          wp_nav_menu( array( 'sort_column' => 'menu_order', 'theme_location' => 'footer-menu2' , 'depth' => '1', 'container' => 'nav', 'container_id' => 'footer_nav2' ) );
        }
        if(has_nav_menu('footer-menu3')){
          wp_nav_menu( array( 'sort_column' => 'menu_order', 'theme_location' => 'footer-menu3' , 'depth' => '1', 'container' => 'nav', 'container_id' => 'footer_nav3' ) );
        }
        if(has_nav_menu('footer-menu4')){
          wp_nav_menu( array( 'sort_column' => 'menu_order', 'theme_location' => 'footer-menu4' , 'depth' => '1', 'container' => 'nav', 'container_id' => 'footer_nav4' ) );
        }
   ?>
  </div>
  <?php
         };
       } else {
         if (has_nav_menu('footer-menu-mobile1') || has_nav_menu('footer-menu-mobile2')) {
  ?>
  <div id="footer_menu">
   <?php
        if(has_nav_menu('footer-menu-mobile1')){
          wp_nav_menu( array( 'sort_column' => 'menu_order', 'theme_location' => 'footer-menu-mobile1' , 'depth' => '1', 'container' => 'nav', 'container_id' => 'footer_nav1' ) );
        }
        if(has_nav_menu('footer-menu-mobile2')){
          wp_nav_menu( array( 'sort_column' => 'menu_order', 'theme_location' => 'footer-menu-mobile2' , 'depth' => '1', 'container' => 'nav', 'container_id' => 'footer_nav2' ) );
        }
   ?>
  </div>
  <?php
         };
       };
  ?>

  <?php
       // 住所 ----------------------------------------
       if($options['footer_info']){
  ?>
  <div id="footer_info">
   <p><?php echo wp_kses_post(nl2br($options['footer_info'])); ?></p>
  </div>
  <?php }; ?>

  <div id="footer_bottom">

   <?php
        // SNSボタン ------------------------------------
        if($options['show_sns_footer'] == 'display') {
          $facebook = $options['sns_button_facebook_url'];
          $twitter = $options['sns_button_twitter_url'];
          $insta = $options['sns_button_instagram_url'];
          $pinterest = $options['sns_button_pinterest_url'];
          $youtube = $options['sns_button_youtube_url'];
          $tiktok = $options['sns_button_tiktok_url'];
          $contact = $options['sns_button_contact_url'];
          $show_rss = $options['sns_button_show_rss'];
          $line = $options['sns_button_line_url'];
   ?>
   <ul id="footer_sns" class="sns_button_list clearfix color_<?php echo esc_attr($options['sns_button_color_type']); ?>">
    <?php if($line) { ?><li class="line"><a href="<?php echo esc_url($line); ?>" rel="nofollow noopener" target="_blank" title="LINE"><span>LINE</span></a></li><?php }; ?>
    <?php if($insta) { ?><li class="insta"><a href="<?php echo esc_url($insta); ?>" rel="nofollow noopener" target="_blank" title="Instagram"><span>Instagram</span></a></li><?php }; ?>
    <?php if($twitter) { ?><li class="twitter"><a href="<?php echo esc_url($twitter); ?>" rel="nofollow noopener" target="_blank" title="X"><span>X</span></a></li><?php }; ?>
    <?php if($facebook) { ?><li class="facebook"><a href="<?php echo esc_url($facebook); ?>" rel="nofollow noopener" target="_blank" title="Facebook"><span>Facebook</span></a></li><?php }; ?>
    <?php if($pinterest) { ?><li class="pinterest"><a href="<?php echo esc_url($pinterest); ?>" rel="nofollow noopener" target="_blank" title="Pinterest"><span>Pinterest</span></a></li><?php }; ?>
    <?php if($youtube) { ?><li class="youtube"><a href="<?php echo esc_url($youtube); ?>" rel="nofollow noopener" target="_blank" title="Youtube"><span>Youtube</span></a></li><?php }; ?>
    <?php if($tiktok) { ?><li class="tiktok"><a href="<?php echo esc_url($tiktok); ?>" rel="nofollow noopener" target="_blank" title="TikTok"><span>TikTok</span></a></li><?php }; ?>
    <?php if($contact) { ?><li class="contact"><a href="<?php echo esc_url($contact); ?>" rel="nofollow noopener" target="_blank" title="Contact"><span>Contact</span></a></li><?php }; ?>
    <?php if($show_rss == 'display') { ?><li class="rss"><a href="<?php echo esc_url(get_bloginfo('rss2_url')); ?>" rel="nofollow noopener" target="_blank" title="RSS"><span>RSS</span></a></li><?php }; ?>
   </ul>
   <?php }; ?>

   <?php
        // コピーライト -------------------------------
        if($options['copyright']){
   ?>
   <p id="copyright"><span><?php echo wp_kses_post($options['copyright']); ?></span></p>
   <?php }; ?>

  </div>

 </footer>

 <?php } else { ?>

 <?php
      // LPページ用　コピーライト -------------------------------
      if($options['copyright']){
 ?>
 <p id="copyright" class="lp_copyright"><span><?php echo wp_kses_post($options['copyright']); ?></span></p>
 <?php }; ?>

 <?php }; // hide footer ?>

</div><!-- #container -->


<?php
     // モバイル用ドロワーメニュー --------------------------------------------
     if (has_nav_menu('global-menu')) {
?>
<div id="drawer_menu" class="color_<?php echo esc_attr($options['drawer_menu_color_type']); ?>">

 <div class="header">
  <div id="drawer_mneu_close_button"></div>
 </div>

 <?php
      // ボタン --------------------------------------------------
      if( $options['header_button_url1'] || $options['header_button_url2']){
 ?>
 <div id="drawer_header_button">
  <?php
       for ( $i = 1; $i <= 2; $i++ ) :
         $url = $options['header_button_url'.$i];
         if($url){
           $title = $options['header_button_title'.$i];
           $target = $options['header_button_target'.$i];
  ?>
  <a href="<?php echo esc_attr($url); ?>"<?php if($target){ echo ' target="_blank"'; }; ?>><?php echo esc_html($title); ?></a>
  <?php }; endfor; ?>
 </div>
 <?php }; ?>

 <?php // メニュー  ?>
 <?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'theme_location' => 'global-menu' , 'container' => 'div', 'container_id' => 'mobile_menu'  ) ); ?>

 <?php
      // 検索フォーム --------------------------------------------------------------------
      if( $options['show_drawer_search'] == 'display') {
 ?>
 <div id="drawer_menu_search">
  <form role="search" method="get" action="<?php echo esc_url(home_url()); ?>">
   <div class="input_area"><input type="text" value="" name="s" autocomplete="off"></div>
   <div class="button_area"><label for="drawer_menu_search_button"></label><input id="drawer_menu_search_button" type="submit" value=""></div>
  </form>
 </div>
 <?php }; ?>

 <?php
      // SNSボタン ------------------------------------
      if($options['show_sns_mobile'] == 'display') {
        $facebook = $options['sns_button_facebook_url'];
        $twitter = $options['sns_button_twitter_url'];
        $insta = $options['sns_button_instagram_url'];
        $pinterest = $options['sns_button_pinterest_url'];
        $youtube = $options['sns_button_youtube_url'];
        $tiktok = $options['sns_button_tiktok_url'];
        $contact = $options['sns_button_contact_url'];
        $show_rss = $options['sns_button_show_rss'];
        $line = $options['sns_button_line_url'];
 ?>
 <ul id="mobile_sns" class="sns_button_list clearfix color_<?php echo esc_attr($options['sns_button_color_type']); ?>">
  <?php if($line) { ?><li class="line"><a href="<?php echo esc_url($line); ?>" rel="nofollow noopener" target="_blank" title="Line"><span>Line</span></a></li><?php }; ?>
  <?php if($insta) { ?><li class="insta"><a href="<?php echo esc_url($insta); ?>" rel="nofollow noopener" target="_blank" title="Instagram"><span>Instagram</span></a></li><?php }; ?>
  <?php if($twitter) { ?><li class="twitter"><a href="<?php echo esc_url($twitter); ?>" rel="nofollow noopener" target="_blank" title="X"><span>X</span></a></li><?php }; ?>
  <?php if($facebook) { ?><li class="facebook"><a href="<?php echo esc_url($facebook); ?>" rel="nofollow noopener" target="_blank" title="Facebook"><span>Facebook</span></a></li><?php }; ?>
  <?php if($pinterest) { ?><li class="pinterest"><a href="<?php echo esc_url($pinterest); ?>" rel="nofollow noopener" target="_blank" title="Pinterest"><span>Pinterest</span></a></li><?php }; ?>
  <?php if($youtube) { ?><li class="youtube"><a href="<?php echo esc_url($youtube); ?>" rel="nofollow noopener" target="_blank" title="Youtube"><span>Youtube</span></a></li><?php }; ?>
  <?php if($tiktok) { ?><li class="tiktok"><a href="<?php echo esc_url($tiktok); ?>" rel="nofollow noopener" target="_blank" title="TikTok"><span>TikTok</span></a></li><?php }; ?>
  <?php if($contact) { ?><li class="contact"><a href="<?php echo esc_url($contact); ?>" rel="nofollow noopener" target="_blank" title="Contact"><span>Contact</span></a></li><?php }; ?>
  <?php if($show_rss == 'display') { ?><li class="rss"><a href="<?php echo esc_url(get_bloginfo('rss2_url')); ?>" rel="nofollow noopener" target="_blank" title="RSS"><span>RSS</span></a></li><?php }; ?>
 </ul>
 <?php }; ?>

 <?php
      // 言語ボタン --------------------------------------------------
      if( $options['lang_button_url1'] || $options['lang_button_url2'] || $options['lang_button_url3'] || $options['lang_button_url4']){
 ?>
 <ul id="drawer_lang_button">
  <?php
       for ( $i = 1; $i <= 4; $i++ ) :
         $url = $options['lang_button_url'.$i];
         if($url){
           $title = $options['lang_button_title'.$i];
           $target = $options['lang_button_target'.$i];
  ?>
  <li><a href="<?php echo esc_attr($url); ?>"<?php if($target){ echo ' target="_blank"'; }; ?>><?php echo esc_html($title); ?></a></li>
  <?php
         };
       endfor;
  ?>
 </ul>
 <?php }; ?>

</div>
<div id="drawer_menu_overlay"></div>
<?php }; ?>

<?php
     // フッターバー ----------------------------------------------------------
if(!is_page_template('page-tcd-lp.php')){
     do_action( 'tcd_footer_after', $options );
}
?>
<?php
     // share button ----------------------------------------------------------------------
     if ( (is_singular('post') && $options['single_blog_show_sns'] != 'hide') || (is_singular('news') && $options['single_news_show_sns'] != 'hide') ) :
       if ( $options['sns_share_design_type'] == 'type5') :
         if ( $options['show_sns_share_twitter'] ) :
?>
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
<?php
         endif;
         if ( $options['show_sns_share_fblike'] || $options['show_sns_share_fbshare'] ) :
?>
<div id="fb-root"></div>
<script>(function(d, s, id) { var js, fjs = d.getElementsByTagName(s)[0]; if (d.getElementById(id)) return; js = d.createElement(s); js.id = id; js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.5"; fjs.parentNode.insertBefore(js, fjs); }(document, 'script', 'facebook-jssdk'));</script>
<?php
         endif;
         if ( $options['show_sns_share_hatena'] ) :
?>
<script type="text/javascript" src="//b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async"></script>
<?php
         endif;
         if ( $options['show_sns_share_pocket'] ) :
?>
<script type="text/javascript">!function(d,i){if(!d.getElementById(i)){var j=d.createElement("script");j.id=i;j.src="https://widgets.getpocket.com/v1/j/btn.js?v=1";var w=d.getElementById(i);d.body.appendChild(j);}}(document,"pocket-btn-js");</script>
<?php
         endif;
         if ( $options['show_sns_share_pinterest'] ) :
?>
<script async defer src="//assets.pinterest.com/js/pinit.js"></script>
<?php
         endif;
         if ( $options['show_sns_share_line'] ) :
?>
<script src="https://www.line-website.com/social-plugins/js/thirdparty/loader.min.js" async="async" defer="defer"></script>
<?php
         endif;
       endif;
     endif;
?>

<?php wp_footer(); ?>
<?php
     // load script -----------------------------------------------------------
    if(
       $options['show_loading'] && is_front_page() && $options['loading_display_page'] == 'type1' && $options['loading_display_time'] == 'type1' && !isset($_COOKIE['first_visit']) ||
       $options['show_loading'] && is_front_page() && $options['loading_display_page'] == 'type1' && $options['loading_display_time'] == 'type2' ||
       $options['show_loading'] && $options['loading_display_page'] == 'type2' && $options['loading_display_time'] == 'type1' && !isset($_COOKIE['first_visit']) ||
       $options['show_loading'] && $options['loading_display_page'] == 'type2' && $options['loading_display_time'] == 'type2'
    ){
       show_loading_screen();
     } else {
       no_loading_screen();
     };

     // カスタムスクリプト--------------------------------------------
     if($options['footer_script_code']) {
       echo $options['footer_script_code'];
     };
     if(is_single() || is_page()) {
       global $post;
       $footer_custom_script = get_post_meta($post->ID, 'footer_custom_script', true);
       if($footer_custom_script) {
         echo $footer_custom_script;
       };
     };
?>
</body>
</html>