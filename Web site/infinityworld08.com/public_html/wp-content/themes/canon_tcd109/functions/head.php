<?php
     function tcd_head() {
       $options = get_design_plus_option();
       global $post;
?>
<style id="current-page-style" type="text/css">
<?php
     // フォントの設定　------------------------------------------------------------------
     $headline_font_size = $options['headline_font_size'] ?  $options['headline_font_size'] : '22';
     $headline_font_size_sp = $options['headline_font_size_sp'] ?  $options['headline_font_size_sp'] : '18';
     $catch_font_size = $options['catch_font_size'] ?  $options['catch_font_size'] : '38';
     $catch_font_size_sp = $options['catch_font_size_sp'] ?  $options['catch_font_size_sp'] : '22';
     $single_title_font_size = $options['single_title_font_size'] ?  $options['single_title_font_size'] : '30';
     $single_title_font_size_sp = $options['single_title_font_size_sp'] ?  $options['single_title_font_size_sp'] : '20';
     $content_font_size = $options['content_font_size'] ?  $options['content_font_size'] : '16';
     $content_font_size_sp = $options['content_font_size_sp'] ?  $options['content_font_size_sp'] : '14';

     if($options['catch_font_type'] == 'type1'){
       $catch_font_type = 'Arial, "ヒラギノ角ゴ ProN W3", "Hiragino Kaku Gothic ProN", "メイリオ", Meiryo, sans-serif';
     } elseif($options['catch_font_type'] == 'type2'){
       $catch_font_type = 'Arial, "Hiragino Sans", "ヒラギノ角ゴ ProN", "Hiragino Kaku Gothic ProN", "游ゴシック", YuGothic, "メイリオ", Meiryo, sans-serif';
     } else {
       $catch_font_type = '"Times New Roman" , "游明朝" , "Yu Mincho" , "游明朝体" , "YuMincho" , "ヒラギノ明朝 Pro W3" , "Hiragino Mincho Pro" , "HiraMinProN-W3" , "HGS明朝E" , "ＭＳ Ｐ明朝" , "MS PMincho" , serif';
     }
     if($options['headline_font_type'] == 'type1'){
       $headline_font_type = 'Arial, "ヒラギノ角ゴ ProN W3", "Hiragino Kaku Gothic ProN", "メイリオ", Meiryo, sans-serif';
     } elseif($options['headline_font_type'] == 'type2'){
       $headline_font_type = 'Arial, "Hiragino Sans", "ヒラギノ角ゴ ProN", "Hiragino Kaku Gothic ProN", "游ゴシック", YuGothic, "メイリオ", Meiryo, sans-serif';
     } else {
       $headline_font_type = '"Times New Roman" , "游明朝" , "Yu Mincho" , "游明朝体" , "YuMincho" , "ヒラギノ明朝 Pro W3" , "Hiragino Mincho Pro" , "HiraMinProN-W3" , "HGS明朝E" , "ＭＳ Ｐ明朝" , "MS PMincho" , serif';
     }
     if($options['single_title_font_type'] == 'type1'){
       $single_title_font_type = 'Arial, "ヒラギノ角ゴ ProN W3", "Hiragino Kaku Gothic ProN", "メイリオ", Meiryo, sans-serif';
     } elseif($options['single_title_font_type'] == 'type2'){
       $single_title_font_type = 'Arial, "Hiragino Sans", "ヒラギノ角ゴ ProN", "Hiragino Kaku Gothic ProN", "游ゴシック", YuGothic, "メイリオ", Meiryo, sans-serif';
     } else {
       $single_title_font_type = '"Times New Roman" , "游明朝" , "Yu Mincho" , "游明朝体" , "YuMincho" , "ヒラギノ明朝 Pro W3" , "Hiragino Mincho Pro" , "HiraMinProN-W3" , "HGS明朝E" , "ＭＳ Ｐ明朝" , "MS PMincho" , serif';
     }
     if($options['content_font_type'] == 'type1'){
       $content_font_type = 'Arial, "ヒラギノ角ゴ ProN W3", "Hiragino Kaku Gothic ProN", "メイリオ", Meiryo, sans-serif';
     } elseif($options['content_font_type'] == 'type2'){
       $content_font_type = 'Arial, "Hiragino Sans", "ヒラギノ角ゴ ProN", "Hiragino Kaku Gothic ProN", "游ゴシック", YuGothic, "メイリオ", Meiryo, sans-serif';
     } else {
       $content_font_type = '"Times New Roman" , "游明朝" , "Yu Mincho" , "游明朝体" , "YuMincho" , "ヒラギノ明朝 Pro W3" , "Hiragino Mincho Pro" , "HiraMinProN-W3" , "HGS明朝E" , "ＭＳ Ｐ明朝" , "MS PMincho" , serif';
     }

     if($options['gallery_title_font_type'] == 'type1'){
       $gallery_title_font_type = 'Arial, "ヒラギノ角ゴ ProN W3", "Hiragino Kaku Gothic ProN", "メイリオ", Meiryo, sans-serif';
     } elseif($options['gallery_title_font_type'] == 'type2'){
       $gallery_title_font_type = 'Arial, "Hiragino Sans", "ヒラギノ角ゴ ProN", "Hiragino Kaku Gothic ProN", "游ゴシック", YuGothic, "メイリオ", Meiryo, sans-serif';
     } else {
       $gallery_title_font_type = '"Times New Roman" , "游明朝" , "Yu Mincho" , "游明朝体" , "YuMincho" , "ヒラギノ明朝 Pro W3" , "Hiragino Mincho Pro" , "HiraMinProN-W3" , "HGS明朝E" , "ＭＳ Ｐ明朝" , "MS PMincho" , serif';
     }
?>
:root {
  --catch_font_size: <?php echo esc_html($catch_font_size); ?>px;
  --catch_font_size_sp: <?php echo esc_html($catch_font_size_sp); ?>px;
  --catch_font_type:<?php echo wp_kses_post($catch_font_type); ?>;
  --headline_font_size: <?php echo esc_html($headline_font_size); ?>px;
  --headline_font_size_sp: <?php echo esc_html($headline_font_size_sp); ?>px;
  --headline_font_type:<?php echo wp_kses_post($headline_font_type); ?>;
  --single_title_font_size: <?php echo esc_html($single_title_font_size); ?>px;
  --single_title_font_size_sp: <?php echo esc_html($single_title_font_size_sp); ?>px;
  --single_title_font_type:<?php echo wp_kses_post($single_title_font_type); ?>;
  --content_font_size: <?php echo esc_html($content_font_size); ?>px;
  --content_font_size_sp: <?php echo esc_html($content_font_size_sp); ?>px;
  --content_font_type:<?php echo wp_kses_post($content_font_type); ?>;
  --font_family_type1: Arial, "ヒラギノ角ゴ ProN W3", "Hiragino Kaku Gothic ProN", "メイリオ", Meiryo, sans-serif;
  --font_family_type2: Arial, "Hiragino Sans", "ヒラギノ角ゴ ProN", "Hiragino Kaku Gothic ProN", "游ゴシック", YuGothic, "メイリオ", Meiryo, sans-serif;
  --font_family_type3: "Times New Roman" , "游明朝" , "Yu Mincho" , "游明朝体" , "YuMincho" , "ヒラギノ明朝 Pro W3" , "Hiragino Mincho Pro" , "HiraMinProN-W3" , "HGS明朝E" , "ＭＳ Ｐ明朝" , "MS PMincho" , serif;
  --gallery_title_font_type:<?php echo wp_kses_post($gallery_title_font_type); ?>;
}


<?php
     // ヘッダー -------------------------------------------------------------------------------

     // ロゴ
     $header_logo_font_size = $options['header_logo_font_size'] ?  $options['header_logo_font_size'] : '26';
     $header_logo_font_size_sp = $options['header_logo_font_size_sp'] ?  $options['header_logo_font_size_sp'] : '20';
?>
.logo_text { font-size:<?php echo esc_html($header_logo_font_size); ?>px; }
@media screen and (max-width:1200px) {
  .logo_text { font-size:<?php echo esc_html($header_logo_font_size_sp); ?>px; }
}
<?php
     // LPページ
     if(is_page_template('page-tcd-lp.php')){
       $header_style = get_post_meta($post->ID, 'header_style', true) ?  get_post_meta($post->ID, 'header_style', true) : 'type2';
       $header_catch_font_size = get_post_meta($post->ID, 'header_catch_font_size', true) ?  get_post_meta($post->ID, 'header_catch_font_size', true) : '42';
       $header_catch_font_size_sp = get_post_meta($post->ID, 'header_catch_font_size_sp', true) ?  get_post_meta($post->ID, 'header_catch_font_size_sp', true) : '20';
       $header_catch_font_color = get_post_meta($post->ID, 'header_catch_font_color', true) ?  get_post_meta($post->ID, 'header_catch_font_color', true) : '#ffffff';
       $header_sub_catch_font_size = get_post_meta($post->ID, 'header_sub_catch_font_size', true) ?  get_post_meta($post->ID, 'header_sub_catch_font_size', true) : '20';
       $header_sub_catch_font_size_sp = get_post_meta($post->ID, 'header_sub_catch_font_size_sp', true) ?  get_post_meta($post->ID, 'header_sub_catch_font_size_sp', true) : '14';
       $header_sub_catch_font_color = get_post_meta($post->ID, 'header_sub_catch_font_color', true) ?  get_post_meta($post->ID, 'header_sub_catch_font_color', true) : '#ffffff';
       $header_button_color = get_post_meta($post->ID, 'header_button_color', true) ?  get_post_meta($post->ID, 'header_button_color', true) : $options['main_color'];
       $header_button_color_light = adjustBrightness($header_button_color, 50);
       $page_content_width = get_post_meta($post->ID, 'page_content_width', true) ?  get_post_meta($post->ID, 'page_content_width', true) : '1000';
?>
.sc_image_carousel_container { max-width:<?php echo esc_attr($page_content_width); ?>px; }
.sc_image_carousel_container.layout_type2 .sc_image_carousel .item { max-width:<?php echo esc_attr($page_content_width); ?>px; }
<?php if($header_style == 'type1'){ ?>
@media screen and (min-width:1101px) {
  #lp_style1_content { max-width:<?php echo esc_attr($page_content_width + 100); ?>px; }
}
<?php } else { ?>
#page_header .content { width:<?php echo esc_attr($page_content_width); ?>px; max-width:<?php echo esc_attr($page_content_width); ?>px; }
<?php }; ?>
#page_header .catch { font-size:<?php echo esc_attr($header_catch_font_size); ?>px; color:<?php echo esc_attr($header_catch_font_color); ?>; }
#page_header .sub_catch { font-size:<?php echo esc_attr($header_sub_catch_font_size); ?>px; color:<?php echo esc_attr($header_sub_catch_font_color); ?>; }
#page_header .design_button { border-color:<?php echo esc_attr($header_button_color); ?>; background-color:<?php echo esc_attr($header_button_color); ?>; }
@media(hover: hover) {
  #page_header .design_button:hover { border-color:<?php echo esc_attr($header_button_color_light); ?>; background-color:<?php echo esc_attr($header_button_color_light); ?>; }
}
#page_contents .post_content { width:auto !important; max-width:<?php echo esc_attr($page_content_width); ?>px; }
@media screen and (max-width:1200px) {
  #page_header .catch { font-size:calc((<?php echo esc_attr($header_catch_font_size); ?>px + <?php echo esc_attr($header_catch_font_size_sp); ?>px) / 2); }
  #page_header .sub_catch { font-size:calc((<?php echo esc_attr($header_sub_catch_font_size); ?>px + <?php echo esc_attr($header_sub_catch_font_size_sp); ?>px) / 2); }
}
@media screen and (max-width:800px) {
  #page_header .catch { font-size:<?php echo esc_attr($header_catch_font_size_sp); ?>px; }
  #page_header .sub_catch { font-size:<?php echo esc_attr($header_sub_catch_font_size_sp); ?>px; }
}
<?php
     };
     // メッセージ -----------------------------------------------------------------------------------
     if(!is_404()){
       if( (is_front_page() && $options['show_header_message'] == 'display') || (!is_page() && $options['show_header_message'] == 'display') || (is_page() && !is_page_template('page-tcd-lp.php') && $options['show_header_message'] == 'display') || (is_page() && is_page_template('page-tcd-lp.php') && (get_post_meta($post->ID, 'hide_header_message', true)) == 'no') ) {
         $font_color = $options['header_message_font_color'];
         $bg_color = $options['header_message_bg_color'];
         if(is_page_template('page-tcd-lp.php') && get_post_meta($post->ID, 'header_message', true)){
           $font_color = get_post_meta($post->ID, 'header_message_font_color', true) ?  get_post_meta($post->ID, 'header_message_font_color', true) : '#ffffff';
           $bg_color = get_post_meta($post->ID, 'header_message_bg_color', true) ?  get_post_meta($post->ID, 'header_message_bg_color', true) : '#0a578c';
         }
?>
#header_message { background:<?php echo esc_attr($bg_color); ?>; color:<?php echo esc_attr($font_color); ?>; }
#header_message a { color:<?php echo esc_attr($font_color); ?> !important; }
<?php
       };
     };

     // サムネイルのホバーアニメーション設定　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
     if($options['hover_type']!="type5"){

       // ズームイン ------------------------------------------------------------------------------
       if($options['hover_type']=="type1"){
?>
@media(hover: hover) {
  .animate_background .image_wrap img { width:100%; height:100%; transition: transform  0.5s ease; }
  .animate_background:hover .image_wrap img { transform: scale(<?php echo $options['hover1_zoom']; ?>); }
}
<?php
     // ズームアウト ------------------------------------------------------------------------------
     } if($options['hover_type']=="type2"){
?>
@media(hover: hover) {
  .animate_background .image_wrap img { width:100%; height:100%; transition: transform  0.5s ease; transform: scale(<?php echo $options['hover2_zoom']; ?>); }
  .animate_background:hover .image_wrap img { transform: scale(1); }
}
<?php
     // スライド ------------------------------------------------------------------------------
     } elseif($options['hover_type']=="type3"){
       $hover3_bgcolor_hex = hex2rgb($options['hover3_bgcolor']);
       $hover3_bgcolor_hex = implode(",",$hover3_bgcolor_hex);
?>
@media(hover: hover) {
  .animate_background .image_wrap:before {
    content:''; display:block; position:absolute; top:0; left:0; z-index:10; width:100%; height:100%; pointer-events:none;
    opacity:0; background:rgba(<?php echo esc_attr($hover3_bgcolor_hex); ?>,<?php echo esc_attr($options['hover3_opacity']); ?>); transition: opacity 0.3s ease;
  }
  .animate_background:hover .image_wrap:before { opacity:1; }
  .animate_background .image_wrap img {
    width:calc(100% + 30px) !important; height:100%; max-width:inherit !important;
    <?php if($options['hover3_direct']=='type1'): ?>
    transform: translate(-15px, 0px); transition-property: opacity, translateX; transition: 0.5s;
    <?php else: ?>
    transform: translate(-15px, 0px); transition-property: opacity, translateX; transition: 0.5s;
    <?php endif; ?>
  }
  .animate_background:hover .image_wrap img {
    <?php if($options['hover3_direct']=='type1'): ?>
    transform: translate(0px, 0px);
    <?php else: ?>
    transform: translate(-30px, 0px);
    <?php endif; ?>
  }
}
<?php
     // フェードアウト ------------------------------------------------------------------------------
     } elseif($options['hover_type']=="type4"){
       $hover3_bgcolor_hex = hex2rgb($options['hover4_bgcolor']);
       $hover3_bgcolor_hex = implode(",",$hover3_bgcolor_hex);
?>
@media(hover: hover) {
  .animate_background .image_wrap:before {
    content:''; display:block; position:absolute; top:0; left:0; z-index:10; width:100%; height:100%; pointer-events:none;
    opacity:0; background:rgba(<?php echo esc_attr($hover3_bgcolor_hex); ?>,<?php echo esc_attr($options['hover4_opacity']); ?>); transition: opacity 0.3s ease;
  }
  .animate_background:hover .image_wrap:before { opacity:1; }
}
<?php }; }; // アニメーションここまで ?>

<?php
     // 色関連　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
     $main_color = $options['main_color'];
     $main_color_dark = adjustBrightness($main_color, -30);
     $main_color_light = adjustBrightness($main_color, 50);
     $main_color_hex = hex2rgb($main_color);
     $main_color_hex = implode(",",$main_color_hex);
     $content_link_color = $options['content_link_color'];
     $content_link_color_hover = hex2rgb($content_link_color);
     $content_link_color_hover = implode(",",$content_link_color_hover);
?>
:root {
  --main_color: <?php echo esc_html($main_color); ?>;
  --main_color_dark: <?php echo esc_html($main_color_dark); ?>;
  --main_color_light: <?php echo esc_html($main_color_light); ?>;
  --main_color_hex: <?php echo esc_html($main_color_hex); ?>;
  --content_link_color: <?php echo esc_html($content_link_color); ?>;
  --content_link_color_hover: rgba(<?php echo esc_html($content_link_color_hover); ?>,0.5);
}
<?php

     // クイックタグ　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
    if ( $options['use_quicktags'] ) :

    
    for ( $i = 2; $i <= 5; $i++ ){

    // 見出し
    $heading_font_size = $options['qt_h'.$i.'_font_size'];
    $heading_font_size_sp = $options['qt_h'.$i.'_font_size_sp'];
    $heading_text_align = $options['qt_h'.$i.'_text_align'];
    $heading_font_weight = $options['qt_h'.$i.'_font_weight'];
    if($heading_font_weight == '400'){
      $heading_font_weight = '500';
    }
    $heading_font_color = $options['qt_h'.$i.'_font_color'];
    $heading_bg_color = $options['qt_h'.$i.'_bg_color'];
    $heading_ignore_bg = $options['qt_h'.$i.'_ignore_bg'];
    $heading_border = 'qt_h'.$i.'_border_';
    $heading_border_color = $options['qt_h'.$i.'_border_color'];
    $heading_border_width = $options['qt_h'.$i.'_border_width'];
    $heading_border_style = $options['qt_h'.$i.'_border_style'];

?>
.styled_h<?php echo $i ?> {
  font-size:<?php echo esc_attr($heading_font_size); ?>px!important;
  text-align:<?php echo esc_attr($heading_text_align); ?>!important;
  font-weight:<?php echo esc_attr($heading_font_weight); ?>!important;
  color:<?php echo esc_attr($heading_font_color); ?>;
  border-color:<?php echo esc_attr($heading_border_color); ?>;
  border-width:<?php echo esc_attr($heading_border_width); ?>px;
  border-style:<?php echo esc_attr($heading_border_style); ?>;
<?php

  $border_potition = array('left', 'right', 'top', 'bottom');
  foreach( $border_potition as $position ):

    if($options[$heading_border.$position]){
      if($position == 'left' || $position == 'right'){
        echo 'padding-'.$position.':1em!important;'."\n".'padding-top:0.5em!important;'."\n".'padding-bottom:0.5em!important;'."\n";
      }else{
        echo 'padding-'.$position.':0.8em!important;'."\n";
      }
    }else{
      echo 'border-'.$position.':none;'."\n";
    }

  endforeach;

  if($heading_ignore_bg){
    echo 'background-color:transparent;'."\n";
  }else{
    echo 'background-color:'.esc_attr($heading_bg_color).';'."\n".'padding:0.8em 1em!important;'."\n";
  }

?>
}
@media screen and (max-width:800px) {
  .styled_h<?php echo $i ?> { font-size:<?php echo esc_attr($heading_font_size_sp); ?>px!important; }
}
<?php

    }

    // ボタン
    for ( $i = 1; $i <= 3; $i++ ) {
      $button_type = $options['qt_button'.$i.'_type'];
      $button_shape = $options['qt_button'.$i.'_border_radius'];
      $button_size = $options['qt_button'.$i.'_size'];
      $button_animation_type = $options['qt_button'.$i.'_animation_type'];
      $button_color = $options['qt_button'.$i.'_color'];
      $button_color_hover = $options['qt_button'.$i.'_color_hover'];

      $colors = array();
      $animations = array();

      switch ($button_shape){
        case 'flat': $shape = 'border-radius:0px;'; break;
        case 'rounded': $shape = 'border-radius:6px;'; break;
        case 'oval': $shape = 'border-radius:70px;'; break;
      }
      switch ($button_size){
        case 'small':
         $size = 'min-width:130px; height:40px;';
         $sp_size1 = 'min-width:130px;';
         $sp_size2 = 'min-width:130px;';
         break;
        case 'medium':
          $size = 'min-width:260px; height:60px;';
          $sp_size1 = 'min-width:260px;';
          $sp_size2 = 'min-width:220px; height:50px;';
          break;
        case 'large':
          $size = 'min-width:280px; height:70px;';
          $sp_size1 = 'min-width:280px;';
          $sp_size2 = 'min-width:220px;';
          break;
      }
      switch ($button_type){
        case 'type1': $colors = array('color:#fff !important; background-color:'.$button_color.';border:none;', 'background-color:'.$button_color_hover.' !important;', '' ); break;
        case 'type2': $colors = array('color:'.$button_color.' !important; border-color:'.$button_color.';', 'background-color:'.$button_color_hover.' !important;', 'color:#fff !important; border-color:'.$button_color_hover.' !important;'); break;
        case 'type3': $colors = array('color:#fff !important; border-color:'.$button_color.';','background-color:'.$button_color.';', 'color:'.$button_color_hover.' !important; border-color:'.$button_color_hover.'; !important' ); break;
      }
      switch ($button_animation_type){
        case 'animation_type1': $animations = ($button_type != 'type3') ? array('opacity:0;', 'opacity:1;') : array('opacity:1;', 'opacity:0;'); break;
        case 'animation_type2': $animations = ($button_type != 'type3') ? array('left:-100%;', 'left:0;') : array('left:0;', 'left:100%;'); break;
        case 'animation_type3': $animations = ($button_type != 'type3') ? array('left:calc(-100% - 110px);transform:skewX(45deg); width:calc(100% + 70px);', 'left:-35px;') : array('left:-35px;transform:skewX(45deg); width:calc(100% + 70px);', 'left:calc(100% + 50px);'); break;
      }
?>
.post_content a.q_custom_button<?php echo $i; ?> { <?php echo $size.$shape.$colors[0]; ?> }
.post_content a.q_custom_button<?php echo $i; ?>:before { <?php echo $colors[1].$animations[0]; ?> }
.post_content a.q_custom_button<?php echo $i; ?>:hover { <?php echo $colors[2]; ?> }
.post_content a.q_custom_button<?php echo $i; ?>:hover:before { <?php echo $animations[1]; ?> }
@media (max-width: 1100px) {
  .post_content a.q_custom_button<?php echo $i; ?> { <?php echo $sp_size1; ?> }
}
@media (max-width: 800px) {
  .post_content a.q_custom_button<?php echo $i; ?> { <?php echo $sp_size2; ?> }
}
<?php

    };

    // 囲み枠
    for ( $i = 1; $i <= 3; $i++ ) {

      $label_color = $options['qt_frame'.$i.'_label_color'];
      $bg_color = $options['qt_frame'.$i.'_content_bg_color'];
      $border_radius = $options['qt_frame'.$i.'_content_shape'];
      $border_width = $options['qt_frame'.$i.'_content_border_width'];
      $border_color = $options['qt_frame'.$i.'_content_border_color'];
      $border_style = $options['qt_frame'.$i.'_content_border_style'];


?>
.q_frame<?php echo $i; ?> {
  background:<?php echo esc_attr($bg_color); ?>;
  border-radius:<?php echo esc_attr($border_radius); ?>px;
  border-width:<?php echo esc_attr($border_width); ?>px;
  border-color:<?php echo esc_attr($border_color); ?>;
  border-style:<?php echo esc_attr($border_style); ?>;
}
.q_frame<?php echo $i; ?> .q_frame_label {
  color:<?php echo esc_attr($label_color); ?>;
}
<?php

    }

    // アンダーライン
    for ( $i = 1; $i <= 3; $i++ ) {

      $underline_color = $options['qt_underline'.$i.'_border_color'];
      $underline_font_weight = $options['qt_underline'.$i.'_font_weight'];
      if($underline_font_weight == '400'){
        $underline_font_weight = '500';
      }
      $underline_use_animation = $options['qt_underline'.$i.'_use_animation'];

?>
.q_underline<?php echo $i; ?> {
  font-weight:<?php echo esc_attr($underline_font_weight); ?>;
  background-image: -webkit-linear-gradient(left, transparent 50%, <?php echo esc_attr($underline_color); ?> 50%);
  background-image: -moz-linear-gradient(left, transparent 50%, <?php echo esc_attr($underline_color); ?> 50%);
  background-image: linear-gradient(to right, transparent 50%, <?php echo esc_attr($underline_color); ?> 50%);
  <?php if($underline_use_animation == 'no') echo 'background-position:-100% 0.8em;'; ?>
}
<?php

    }

    // 吹き出し
    for ( $i = 1; $i <= 4; $i++ ) {

      $sb_font_color = $options['qt_speech_balloon'.$i.'_font_color'];
      $sb_bg_color = $options['qt_speech_balloon'.$i.'_bg_color'];
      $sb_border_color = $options['qt_speech_balloon'.$i.'_border_color'];
      $sb_direction = ($i >= 3) ? 'left' : 'right';

?>
.speech_balloon<?php echo $i; ?> .speech_balloon_text_inner {
  color:<?php echo esc_attr($sb_font_color); ?>;
  background-color:<?php echo esc_attr($sb_bg_color); ?>;
  border-color:<?php echo esc_attr($sb_border_color); ?>;
}
.speech_balloon<?php echo $i; ?> .before { border-left-color:<?php echo esc_attr($sb_border_color); ?>; }
.speech_balloon<?php echo $i; ?> .after { border-right-color:<?php echo esc_attr($sb_bg_color); ?>; }
<?php

    }

    endif;

    // Google Maps
    $qt_gmap_marker_bg = $options['qt_gmap_marker_bg'];
?>
.qt_google_map .pb_googlemap_custom-overlay-inner { background:<?php echo esc_attr($qt_gmap_marker_bg); ?>; color:<?php echo esc_attr($options['qt_gmap_marker_color']); ?>; }
.qt_google_map .pb_googlemap_custom-overlay-inner::after { border-color:<?php echo esc_attr($qt_gmap_marker_bg); ?> transparent transparent transparent; }

<?php
     // ページ別　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■

     // トップページ -----------------------------------------------------------------------------
     if(is_front_page()){

       // ヘッダーコンテンツ -------------------------------------------------------------------------------------------------------------
       $index_slider_catch_font_size = $options['index_header_content_catch_font_size'] ?  $options['index_header_content_catch_font_size'] : '44';
       $index_slider_catch_font_size_sp = $options['index_header_content_catch_font_size_sp'] ?  $options['index_header_content_catch_font_size_sp'] : '24';
?>
.header_slider_content .catch { font-size:<?php echo esc_attr($index_slider_catch_font_size); ?>px; }
@media screen and (max-width:1200px) {
  .header_slider_content .catch { font-size:<?php echo esc_html(floor( ($index_slider_catch_font_size + $index_slider_catch_font_size_sp) / 2 ) ); ?>px; }
}
@media screen and (max-width:800px) {
  .header_slider_content .catch { font-size:<?php echo esc_attr($index_slider_catch_font_size_sp); ?>px; }
}
<?php
       if($options['show_header_content'] && $options['index_header_content_type'] == 'type1' && $options['index_header_content_height'] == 'type2'){
         $image_slider = !empty($options['index_slider']) ? explode( ',', $options['index_slider'] ) : array();
         $image = !empty($image_slider) ? wp_get_attachment_image_src( $image_slider[0], 'full' ) : '';
         $image_slider_sp = !empty($options['index_slider_sp']) ? explode( ',', $options['index_slider_sp'] ) : array();
         $image_sp = !empty($image_slider_sp) ? wp_get_attachment_image_src( $image_slider_sp[0], 'full' ) : '';
         if($image_slider && $image){
?>
#header_slider_container.height_type2 { height:auto; aspect-ratio:<?php echo esc_attr($image[1]); ?> / <?php echo esc_attr($image[2]); ?>; max-height:calc(100vh - 130px); }
@media screen and (max-width:1300px) {
  #header_slider_container.height_type2 { max-height:calc(100vh - 60px); }
}
<?php
         }
         if($image_slider_sp && $image_sp){
?>
@media screen and (max-width:800px) {
  #header_slider_container.height_type2 { min-height:unset; height:auto !important; max-height:calc(100vh - 60px) !important; max-height:calc(100svh - 60px) !important; aspect-ratio:<?php echo esc_attr($image_sp[1]); ?> / <?php echo esc_attr($image_sp[2]); ?>; }
}
<?php
         } else {
?>
@media screen and (max-width:800px) {
  #header_slider_container.height_type2 { min-height:unset !important; height:600px !important; max-height:calc(100vh - 60px) !important; aspect-ratio:unset; }
}
<?php
         }
       }

       // コンテンツビルダー -------------------------------------------------------------------------------------------------------------
       if ( $options['contents_builder'] ) {

         $contents_builder = $options['contents_builder'];
         if ($contents_builder) :
           $content_count = 1;
           foreach($contents_builder as $content) :

           // 施術 ---------------------------------------------------------
           if ( $content['type'] == 'gallery_list' && $content['show_content']) {
             if(!is_mobile() && $content['bg_type'] == 'type2') {
               $image = wp_get_attachment_image_src($content['image'], 'full');
               $image_mobile = wp_get_attachment_image_src($content['image_mobile'], 'full');
               if($image){
?>
.cb_gallery.num<?php echo $content_count; ?> { background-image:url(<?php echo esc_attr($image[0]); ?>); background-size:cover; background-repeat:no-repeat; background-position:center; }
<?php if($image_mobile){ ?>
@media screen and (max-width:800px) {
  .cb_gallery.num<?php echo $content_count; ?> { background-image:url(<?php echo esc_attr($image_mobile[0]); ?>); background-size:cover; background-repeat:no-repeat; background-position:center; }
}
<?php }; ?>
<?php
               };
             };
           };

           $content_count++;
           endforeach;
         endif;
       };// END コンテンツビルダーここまで

     }; //END page setting

     // ロード画面 -----------------------------------------
     if(
       $options['show_loading'] && is_front_page() && $options['loading_display_page'] == 'type1' && $options['loading_display_time'] == 'type1' && !isset($_COOKIE['first_visit']) ||
       $options['show_loading'] && is_front_page() && $options['loading_display_page'] == 'type1' && $options['loading_display_time'] == 'type2' ||
       $options['show_loading'] && $options['loading_display_page'] == 'type2' && $options['loading_display_time'] == 'type1' && !isset($_COOKIE['first_visit']) ||
       $options['show_loading'] && $options['loading_display_page'] == 'type2' && $options['loading_display_time'] == 'type2'
     ){
       get_template_part('functions/loader_css');
     };

     // カスタムCSS --------------------------------------------
     if($options['css_code']) {
       echo $options['css_code'];
     };
     if(is_single() || is_page()) {
       $custom_css = get_post_meta($post->ID, 'custom_css', true);
       if($custom_css) {
         echo "\n" . $custom_css;
       };
     }
?>
</style>

<?php
     // JavaScriptの設定はここから　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■

     // カスタムスクリプト--------------------------------------------
     if($options['script_code']) {
       echo $options['script_code'];
     };
     if(is_single() || is_page()) {
       $custom_script = get_post_meta($post->ID, 'custom_script', true);
       if($custom_script) {
         echo "\n" . $custom_script;
       };
     };
?>

<?php
     }; // END function tcd_head()
     add_action("wp_head", "tcd_head");
?>