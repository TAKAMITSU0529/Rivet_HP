<?php
     function has_loading_screen(){
       $options = get_design_plus_option();
?>
<script>

 <?php if(wp_is_mobile()) { ?>
 jQuery(window).bind("pageshow", function(event) {
    if (event.originalEvent.persisted) {
      window.location.reload()
    }
 });
 <?php }; ?>

 jQuery(document).ready(function($){

  <?php if ( $options['show_load_screen'] == 'type4' && !isset($_COOKIE['first_visit']) ) { ?>
  $.cookie('first_visit', 'on', {
    path:'/'
  });
  <?php }; ?>

  <?php
       // front page : pause slider while load screen is displayed -----------------------------------
       if(is_front_page()) {
         if($options['index_header_content_type'] == 'type1') {
           echo "$('#index_slider').slick('slickPause');\n";
         }
       };
  ?>

  $(function(){
    <?php if ($options['load_icon'] == 'type4') { ?>
    $('#site_loader_logo').addClass('active');
    <?php }; ?>
    setTimeout(function(){
      if( $('#site_loader_overlay').is(':visible') ) {
        after_load();
      }
    }, <?php if($options['load_time']) { echo esc_html($options['load_time']); } else { echo '7000'; }; ?>);
  });

 });

<?php if ($options['load_icon'] != 'type4') { ?>
jQuery(window).on('load',function () {
  after_load();
});
<?php }; ?>

function after_load() {
  jQuery('#site_loader_overlay').delay(600).fadeOut(900);

  <?php
       // front page -----------------------------------
       if(is_front_page()) {
         if($options['index_header_content_type'] == 'type1') {
  ?>
  jQuery('#index_slider').slick('setPosition');
  jQuery('#index_slider').slick('slickPlay');
  jQuery('#index_slider .item1').addClass('animate');
  jQuery('#index_slider .caption.mobile').addClass('animate');
  <?php
         };
       };
       // 404 -----------------------------------
       if(is_404()) {
         echo "jQuery('#page_404_header').addClass('animate');\n";
       };
       // page builder -----------------------------------
       if(is_single() || is_page()) {
         if(page_builder_has_widget('pb-widget-slider')) {
  ?>
  jQuery('.pb_slider').slick('setPosition');
  <?php
         };
       };
  ?>
}

</script>
<?php } ?>
<?php
     // no loading ------------------------------------------------------------------------------------------------------------------
     function no_loading_screen(){
       $options = get_design_plus_option();
?>
<script>
jQuery(document).ready(function($){
  <?php
       // front page -----------------------------------
       if(is_front_page()) {
         if($options['index_header_content_type'] == 'type1') {
  ?>
  $('#index_slider .item1').addClass('animate');
  $('#index_slider .caption.mobile').addClass('animate');
  <?php
         };
       };

       // 404 -----------------------------------
       if(is_404()) {
         echo "$('#page_404_header').addClass('animate');\n";
       };
  ?>
});
</script>
<?php } ?>