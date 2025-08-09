<?php $options = get_design_plus_option(); ?>

 <div id="return_top">
  <a href="#body"><span><?php _e('PAGE TOP', 'tcd-w'); ?></span></a>
 </div>

 <?php
      // Banner content --------------------------------------------------------------------
      if( $options['show_footer_banner1'] || $options['show_footer_banner2'] || $options['show_footer_banner3'] ) {
 ?>
 <div id="footer_banner" class="clearfix">
  <?php
       for ( $i = 1; $i <= 3; $i++ ) :
         if($options['show_footer_banner'.$i]) {
           $image = wp_get_attachment_image_src( $options['footer_banner_image'.$i], 'full' );
           if($image) {
  ?>
  <div class="item">
   <a class="link animate_background" href="<?php echo esc_url($options['footer_banner_url'.$i]); ?>">
    <div class="image_wrap">
     <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
    </div>
    <p class="title rich_font"><?php echo esc_html($options['footer_banner_title'.$i]); ?></p>
   </a>
  </div>
  <?php }; }; endfor; ?>
 </div><!-- END #footer_banner -->
 <?php }; ?>

 <footer id="footer">

  <div id="footer_top" style="background:<?php echo esc_attr($options['footer_bg_color']); ?>;">

   <?php if( $options['show_footer_logo']) { ?>
   <div id="footer_logo">
    <?php footer_logo(); ?>
   </div>
   <?php }; ?>

   <?php if($options['footer_company_info']){ ?>
   <p id="company_info"><?php echo wp_kses_post(nl2br($options['footer_company_info'])); ?></p>
   <?php }; ?>

   <?php
        // footer sns ------------------------------------
        $facebook = $options['footer_facebook_url'];
        $twitter = $options['footer_twitter_url'];
        $insta = $options['footer_instagram_url'];
        $tiktok = $options['footer_tiktok_url'];
        $pinterest = $options['footer_pinterest_url'];
        $youtube = $options['footer_youtube_url'];
        $contact = $options['footer_contact_url'];
        $show_rss = $options['footer_show_rss'];
   ?>
   <?php if($facebook || $twitter || $insta || $pinterest || $youtube || $contact || $show_rss || $tiktok) { ?>
   <ul id="footer_social_link" class="clearfix">
    <?php if($insta) { ?><li class="insta"><a href="<?php echo esc_url($insta); ?>" rel="nofollow" target="_blank" title="Instagram"><span>Instagram</span></a></li><?php }; ?>
    <?php if($tiktok) { ?><li class="tiktok"><a href="<?php echo esc_url($tiktok); ?>" rel="nofollow" target="_blank" title="TikTok"><span>TikTok</span></a></li><?php }; ?>
    <?php if($twitter) { ?><li class="twitter"><a href="<?php echo esc_url($twitter); ?>" rel="nofollow" target="_blank" title="X"><span>X</span></a></li><?php }; ?>
    <?php if($facebook) { ?><li class="facebook"><a href="<?php echo esc_url($facebook); ?>" rel="nofollow" target="_blank" title="Facebook"><span>Facebook</span></a></li><?php }; ?>
    <?php if($pinterest) { ?><li class="pinterest"><a href="<?php echo esc_url($pinterest); ?>" rel="nofollow" target="_blank" title="Pinterest"><span>Pinterest</span></a></li><?php }; ?>
    <?php if($youtube) { ?><li class="youtube"><a href="<?php echo esc_url($youtube); ?>" rel="nofollow" target="_blank" title="Youtube"><span>Youtube</span></a></li><?php }; ?>
    <?php if($contact) { ?><li class="contact"><a href="<?php echo esc_url($contact); ?>" rel="nofollow" target="_blank" title="Contact"><span>Contact</span></a></li><?php }; ?>
    <?php if($show_rss) { ?><li class="rss"><a href="<?php bloginfo('rss2_url'); ?>" rel="nofollow noopener" target="_blank" title="RSS"><span>RSS</span></a></li><?php }; ?>
   </ul>
   <?php }; ?>

   <?php if($options['show_footer_button']){ ?>
   <p id="footer_button" class="button_font"><a href="<?php echo esc_url($options['footer_button_url']); ?>" <?php if($options['footer_button_target']){ echo 'target="_blank"'; }; ?>><?php echo esc_html($options['footer_button_label']); ?></a></p>
   <?php }; ?>

  </div><!-- END #footer_top -->

  <?php if($options['footer_company_date']){ ?>
  <p id="company_date"><?php echo esc_html($options['footer_company_date']); ?></p>
  <?php }; ?>

  <?php // footer menu -------------------------------------------- ?>
  <?php if (has_nav_menu('footer-menu')) { ?>
  <div id="footer_menu" class="footer_menu">
   <?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'theme_location' => 'footer-menu' , 'container' => '' , 'depth' => '1') ); ?>
  </div>
  <?php }; ?>

  <p id="copyright" style="color:<?php echo esc_attr($options['copyright_font_color']); ?>; background:<?php echo esc_attr($options['copyright_bg_color']); ?>;"><?php echo wp_kses_post($options['copyright']); ?></p>

 </footer>

 <?php
      // footer bar for mobile device -------------------
      if( is_mobile() ) {
        if($options['footer_bar_display'] != 'type3') {
          get_template_part('template-parts/footer-bar');
        }
      };
 ?>

</div><!-- #container -->

<?php // drawer menu -------------------------------------------- ?>
<div id="drawer_menu">
 <?php if (has_nav_menu('global-menu')) { ?>
 <nav>
  <?php wp_nav_menu( array( 'menu_id' => 'mobile_menu', 'sort_column' => 'menu_order', 'theme_location' => 'global-menu' , 'container' => '' ) ); ?>
 </nav>
 <?php }; ?>
 <div id="mobile_banner">
  <?php
       for($i=1; $i<= 3; $i++):
         if( $options['mobile_menu_ad_code'.$i] || $options['mobile_menu_ad_image'.$i] ) {
           if ($options['mobile_menu_ad_code'.$i]) {
  ?>
  <div class="banner">
   <?php echo $options['mobile_menu_ad_code'.$i]; ?>
  </div>
  <?php
       } else {
         $mobile_menu_image = wp_get_attachment_image_src( $options['mobile_menu_ad_image'.$i], 'full' );
  ?>
  <div class="banner">
   <a href="<?php echo esc_url( $options['mobile_menu_ad_url'.$i] ); ?>"<?php if($options['mobile_menu_ad_target'.$i] == 1) { ?> target="_blank"<?php }; ?>><img src="<?php echo esc_attr($mobile_menu_image[0]); ?>" alt="" title="" /></a>
  </div>
  <?php }; }; endfor; ?>
 </div><!-- END #header_mobile_banner -->
</div>

<?php
     // load script -----------------------------------------------------------
     if ($options['show_load_screen'] == 'type2') {
       if(is_front_page()){
         has_loading_screen();
       } else {
         no_loading_screen();
       }
     } elseif ($options['show_load_screen'] == 'type3') {
       if(is_front_page() || is_home() || is_archive() ){
         has_loading_screen();
       } else {
         no_loading_screen();
       }
     } elseif ($options['show_load_screen'] == 'type4') {
       if((is_front_page() || is_home() || is_archive()) && !isset($_COOKIE['first_visit']) ){
         has_loading_screen();
       } else {
         no_loading_screen();
       }
     } else {
       no_loading_screen();
     };
?>

<?php
     // share button ----------------------------------------------------------------------
     if ( is_single() && ( $options['show_sns_top'] || $options['show_sns_btm'] || $options['show_sns_top_news'] || $options['show_sns_btm_news']) ) :
       if ( 'type5' == $options['sns_type_top'] || 'type5' == $options['sns_type_btm'] ) :
         if ( $options['show_twitter_top'] || $options['show_twitter_btm'] ) :
?>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
<?php
         endif;
         if ( $options['show_fblike_top'] || $options['show_fbshare_top'] || $options['show_fblike_btm'] || $options['show_fbshare_btm'] ) :
?>
<!-- facebook share button code -->
<div id="fb-root"></div>
<script>
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<?php
         endif;
         if ( $options['show_hatena_top'] || $options['show_hatena_btm'] ) :
?>
<script type="text/javascript" src="//b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async"></script>
<?php
         endif;
         if ( $options['show_pocket_top'] || $options['show_pocket_btm'] ) :
?>
<script type="text/javascript">!function(d,i){if(!d.getElementById(i)){var j=d.createElement("script");j.id=i;j.src="https://widgets.getpocket.com/v1/j/btn.js?v=1";var w=d.getElementById(i);d.body.appendChild(j);}}(document,"pocket-btn-js");</script>
<?php
         endif;
         if ( ($options['show_pinterest_top'] && $options['sns_type_top'] == 'type5') || ($options['show_pinterest_btm'] && $options['sns_type_btm'] == 'type5') ) :
?>
<script async defer src="//assets.pinterest.com/js/pinit.js"></script>
<?php
         endif;
       endif;
     endif;
?>

<?php wp_footer(); ?>
<?php
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