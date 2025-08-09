<?php
/*
 * ヘッダーの設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_header_dp_default_options' );


// Add label of logo tab
add_action( 'tcd_tab_labels', 'add_header_tab_label' );


// Add HTML of logo tab
add_action( 'tcd_tab_panel', 'add_header_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_header_theme_options_validate' );


// タブの名前
function add_header_tab_label( $tab_labels ) {
	$tab_labels['header'] = __( 'Header', 'tcd-canon' );
	return $tab_labels;
}


// 初期値
function add_header_dp_default_options( $dp_default_options ) {

  // メッセージ
	$dp_default_options['show_header_message'] = 'hide';
	$dp_default_options['header_message'] = __('Header message', 'tcd-canon');
  $dp_default_options['header_message_url'] = '';
  $dp_default_options['header_message_target'] = '';
  $dp_default_options['header_message_font_color'] = '#ffffff';
  $dp_default_options['header_message_bg_color'] = '#0a578c';

  // ボタン
	$dp_default_options['header_button_title1'] = __( 'Title', 'tcd-canon' );
	$dp_default_options['header_button_url1'] = '#';
	$dp_default_options['header_button_target1'] = '';
	$dp_default_options['header_button_color1'] = "#947d66";

	$dp_default_options['header_button_title2'] = __( 'Title', 'tcd-canon' );
	$dp_default_options['header_button_url2'] = '#';
	$dp_default_options['header_button_target2'] = '';
	$dp_default_options['header_button_color2'] = "#000000";

  // 検索
	$dp_default_options['header_search'] = 'display';

  // 言語ボタン
	for ( $i = 1; $i <= 4; $i++ ) {
		$dp_default_options['lang_button_title'.$i] = '';
		$dp_default_options['lang_button_url'.$i] = '';
		$dp_default_options['lang_button_target'.$i] = '';
	}

  // メガメニュー
  $dp_default_options['megamenu_new'] = array();
	$dp_default_options['megamenu_color_type'] = 'megamenu_light_color';

	$dp_default_options['megamenu_a_post_type'] = 'all_post';
	$dp_default_options['megamenu_a_post_order'] = 'date';
	$dp_default_options['megamenu_a_post_order_cutom'] = '';
	$dp_default_options['megamenu_a_post_num'] = '6';
	$dp_default_options['megamenu_a_category_id'] = '';
	$dp_default_options['megamenu_a_headline'] = '';
	$dp_default_options['megamenu_a_sub_title'] = '';

	$dp_default_options['megamenu_b_post_type'] = 'all_post';
	$dp_default_options['megamenu_b_post_order'] = 'date';
	$dp_default_options['megamenu_b_post_order_cutom'] = '';
	$dp_default_options['megamenu_b_post_num'] = '6';
	$dp_default_options['megamenu_b_category_id'] = '';
	$dp_default_options['megamenu_b_headline'] = '';
	$dp_default_options['megamenu_b_sub_title'] = '';

	$dp_default_options['megamenu_c_item_list'] = array();
	$dp_default_options['megamenu_c_headline'] = '';
	$dp_default_options['megamenu_c_sub_title'] = '';

	$dp_default_options['megamenu_d_item_list'] = array();
	$dp_default_options['megamenu_d_headline'] = '';
	$dp_default_options['megamenu_d_sub_title'] = '';

  // ドロワーメニュー
	$dp_default_options['show_drawer_search'] = 'display';
	$dp_default_options['drawer_menu_color_type'] = 'type1';

	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_header_tab_panel( $options ) {

  global $blog_label, $dp_default_options, $basic_display_options, $bool_options, $megamenu_color_type_options, $drawer_menu_color_options;
  $news_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-canon' );
  $gallery_label = $options['gallery_label'] ? esc_html( $options['gallery_label'] ) : __( 'Guest room', 'tcd-canon' );
  $service_label = $options['service_label'] ? esc_html( $options['service_label'] ) : __( 'Service', 'tcd-canon' );

  $main_color = $options['main_color'];

?>

<div id="tab-content-header" class="tab-content">


   <?php // メッセージ ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Header message', 'tcd-canon');  ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="front_page_image">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/image/header_message.jpg?2.1" alt="" title="" />
     </div>

     <div class="theme_option_message2">
      <p><?php _e('The "header message" will be displayed at the top of the site.', 'tcd-canon'); ?></br>
      <?php _e('If you are using LP template, you can set display setting individually from page edit screen.', 'tcd-canon'); ?></p>
     </div>

     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Header message', 'tcd-canon');  ?></span><?php echo tcd_basic_radio_button($options, 'show_header_message', $basic_display_options); ?></li>
      <li class="cf"><span class="label"><?php _e('Message', 'tcd-canon');  ?></span><textarea class="full_width" cols="50" rows="2" name="dp_options[header_message]"><?php echo esc_textarea( $options['header_message'] ); ?></textarea></li>
      <li class="cf">
       <span class="label"><?php _e('URL', 'tcd-canon'); ?></span>
       <div class="admin_link_option">
        <input type="text" name="dp_options[header_message_url]" placeholder="https://example.com/" value="<?php echo esc_attr( $options['header_message_url'] ); ?>">
        <input id="header_message_target" class="admin_link_option_target" name="dp_options[header_message_target]" type="checkbox" value="1" <?php checked( $options['header_message_target'], 1 ); ?>>
        <label for="header_message_target">&#xe920;</label>
       </div>
      </li>
      <li class="cf color_picker_bottom"><span class="label"><?php echo tcd_admin_label('color'); ?></span><input type="text" name="dp_options[header_message_font_color]" value="<?php echo esc_attr( $options['header_message_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
      <li class="cf color_picker_bottom"><span class="label"><?php echo tcd_admin_label('bg_color'); ?></span><input type="text" name="dp_options[header_message_bg_color]" value="<?php echo esc_attr( $options['header_message_bg_color'] ); ?>" data-default-color="#0a578c" class="c-color-picker"></li>
     </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
     </ul>

    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // 基本設定 ----------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Basic setting', 'tcd-canon');  ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="front_page_image">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/image/header.jpg" alt="" title="" />
     </div>

     <?php // ロゴ ----------------------------------------------------------------- ?>
     <h4 class="theme_option_headline_number"><span class="num">1</span><?php _e( 'Logo', 'tcd-canon' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('You can set Logo from "Basic Settings" Logo section.', 'tcd-canon'); ?></p>
     </div>

     <?php // 検索 ----------------------------------------------------------------- ?>
     <h4 class="theme_option_headline_number"><span class="num">2</span><?php _e( 'Search form', 'tcd-canon' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('Search targets can be set from "Basic setting" > "404 page / Search result page".', 'tcd-canon');  ?></p>
     </div>
     <?php echo tcd_basic_radio_button($options, 'header_search', $basic_display_options); ?>
     <br style="clear:both;">

     <?php // ボタン ----------------------------------------------------------------- ?>
     <div class="tab_parent">
      <h4 class="theme_option_headline_number"><span class="num">3</span><?php _e( 'Button', 'tcd-canon' ); ?></h4>
      <div class="theme_option_message2">
       <p><?php _e('Leave the "URL" field blank if you don\'t want to display button.', 'tcd-canon'); ?></p>
      </div>
      <div class="sub_box_tab">
       <?php for($i = 1; $i <= 2; $i++) : ?>
       <div class="tab<?php if($i == 1){ echo ' active'; }; ?>" data-tab="tab<?php echo $i; ?>"><span class="label"><?php printf(__('Button%s', 'tcd-canon'), $i); ?></span></div>
       <?php endfor; ?>
      </div>
      <?php for($i = 1; $i <= 2; $i++) : ?>
      <div class="sub_box_tab_content<?php if($i == 1){ echo ' active'; }; ?>" data-tab-content="tab<?php echo $i; ?>">
       <ul class="option_list">
        <li class="cf"><span class="label"><?php _e('Label', 'tcd-canon'); ?></span><input class="tab_label full_width" type="text" name="dp_options[header_button_title<?php echo $i; ?>]" value="<?php esc_attr_e( $options['header_button_title'.$i] ); ?>" /></li>
        <li class="cf">
         <span class="label"><?php _e('URL', 'tcd-canon'); ?></span>
         <div class="admin_link_option">
          <input type="text" name="dp_options[header_button_url<?php echo $i; ?>]" placeholder="https://example.com/" value="<?php echo esc_attr( $options['header_button_url'.$i] ); ?>">
          <input id="header_button_target<?php echo $i; ?>" class="admin_link_option_target" name="dp_options[header_button_target<?php echo $i; ?>]" type="checkbox" value="1" <?php checked( $options['header_button_target'.$i], 1 ); ?>>
          <label for="header_button_target<?php echo $i; ?>">&#xe920;</label>
         </div>
        </li>
        <li class="cf">
         <span class="label"><?php _e('Color', 'tcd-canon'); ?></span><input type="text" name="dp_options[header_button_color<?php echo $i; ?>]" value="<?php echo esc_attr( $options['header_button_color'.$i] ); ?>" data-default-color="#000000" class="c-color-picker">
        </li>
       </ul>
      </div><!-- END .sub_box_tab_content -->
      <?php endfor; ?>
     </div>

     <?php // グローバルメニュー ----------------------------------------------------------------- ?>
     <h4 class="theme_option_headline_number"><span class="num">4</span><?php _e( 'Global menu', 'tcd-canon' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('You can set menu from <a href="./nav-menus.php">custom menu</a> page.', 'tcd-canon'); ?></p>
     </div>

     <?php // 言語メニュー ----------------------------------------------------------------- ?>
     <div class="tab_parent">
      <h4 class="theme_option_headline_number"><span class="num">5</span><?php _e( 'Language button', 'tcd-canon' ); ?></h4>
      <div class="theme_option_message2">
       <p><?php _e('Leave the "URL" field blank if you don\'t want to display button.', 'tcd-canon'); ?></p>
      </div>
      <div class="sub_box_tab">
       <?php for($i = 1; $i <= 4; $i++) : ?>
       <div class="tab<?php if($i == 1){ echo ' active'; }; ?>" data-tab="tab<?php echo $i; ?>"><span class="label"><?php printf(__('Button%s', 'tcd-canon'), $i); ?></span></div>
       <?php endfor; ?>
      </div>
      <?php for($i = 1; $i <= 4; $i++) : ?>
      <div class="sub_box_tab_content<?php if($i == 1){ echo ' active'; }; ?>" data-tab-content="tab<?php echo $i; ?>">
       <ul class="option_list">
        <li class="cf"><span class="label"><?php _e('Country code / Language name', 'tcd-canon'); ?></span><input class="tab_label full_width" type="text" placeholder="<?php _e('EN / English etc', 'tcd-canon'); ?>" name="dp_options[lang_button_title<?php echo $i; ?>]" value="<?php esc_attr_e( $options['lang_button_title'.$i] ); ?>" /></li>
        <li class="cf">
         <span class="label"><?php _e('URL', 'tcd-canon'); ?></span>
         <div class="admin_link_option">
          <input type="text" name="dp_options[lang_button_url<?php echo $i; ?>]" placeholder="https://example.com/" value="<?php echo esc_attr( $options['lang_button_url'.$i] ); ?>">
          <input id="lang_button_target<?php echo $i; ?>" class="admin_link_option_target" name="dp_options[lang_button_target<?php echo $i; ?>]" type="checkbox" value="1" <?php checked( $options['lang_button_target'.$i], 1 ); ?>>
          <label for="lang_button_target<?php echo $i; ?>">&#xe920;</label>
         </div>
        </li>
       </ul>
      </div><!-- END .sub_box_tab_content -->
      <?php endfor; ?>
     </div>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
     </ul>

    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php
        // メガメニュー ----------------------------------------------------------------------------------
   ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Mega menu', 'tcd-canon');  ?></h3>
    <div class="theme_option_field_ac_content tab_parent">

     <div class="theme_option_message2">
      <p><?php _e('If any of the following pages are set to "Global Menu" on the <a href="./nav-menus.php" target="_blank">"Menu Screen"</a>, they can be displayed as mega menus.', 'tcd-canon'); ?></p>
      <p>
       <?php
            $blog_page_id = get_option( 'page_for_posts' );
            $news_archive_page_url = get_post_type_archive_link('news');
            if($blog_page_id){
              $blog_archive_page_url = get_page_link( $blog_page_id );
              printf(__('%s carousel - Please set <a href="%s" target="_blank">%s archive page</a> to parent menu. Post carousel will be automatically displayed.', 'tcd-canon'), __('Post','tcd-canon'), $blog_archive_page_url, __('Post','tcd-canon'));
            } else {
              printf(__('%s carousel - Please set %s archive page to parent menu. Post carousel will be automatically displayed.', 'tcd-canon'), __('Post','tcd-canon'), __('Post','tcd-canon'));
            }
            echo '<br>';
            printf(__('%s carousel - Please set <a href="%s" target="_blank">%s archive page</a> to parent menu. Post carousel will be automatically displayed.', 'tcd-canon'), $news_label, $news_archive_page_url, $news_label);
            echo '<br>';
            _e('Carousel (3columns) - Please set from theme option below.', 'tcd-canon');
            echo '<br>';
            _e('Carousel (4columns) - Please set from theme option below.', 'tcd-canon');
       ?>
      </p>
     </div>
     <ul class="megamenu_image clearfix">
      <li>
       <span><img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/megamenu1.jpg" alt="<?php printf(__('%s carousel', 'tcd-canon'), __('Post','tcd-canon')); ?>" title="" /></span>
       <p><?php printf(__('%s carousel', 'tcd-canon'), __('Post','tcd-canon')); ?></p>
      </li>
      <li>
       <span><img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/megamenu2.jpg" alt="<?php printf(__('%s carousel', 'tcd-canon'), $news_label); ?>" title="" /></span>
       <p><?php printf(__('%s carousel', 'tcd-canon'), $news_label); ?></p>
      </li>
      <li>
       <span><img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/megamenu3.jpg" alt="<?php _e('Carousel (3columns)', 'tcd-canon'); ?>" title="" /></span>
       <p><?php _e('Carousel (3columns)', 'tcd-canon'); ?></p>
      </li>
      <li>
       <span><img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/megamenu4.jpg" alt="<?php _e('Carousel (4columns)', 'tcd-canon'); ?>" title="" /></span>
       <p><?php _e('Carousel (4columns)', 'tcd-canon'); ?></p>
      </li>
     </ul>

     <?php
          $menu_locations = get_nav_menu_locations();
          $nav_menus = wp_get_nav_menus();
          $global_nav_items = array();
          if ( isset( $menu_locations['global-menu'] ) ) {
            foreach ( (array) $nav_menus as $menu ) {
              if ( $menu_locations['global-menu'] === $menu->term_id ) {
                $global_nav_items = wp_get_nav_menu_items( $menu );
                break;
              }
            }
          }
     ?>
     <h4 class="theme_option_headline2 megamenu_option"><?php _e('Menu type', 'tcd-canon'); ?></h4>
     <div class="theme_option_message2 megamenu_option">
      <p><?php _e('The menu items set in the <a href="./nav-menus.php" target="_blank">"Menu screen"</a> that can be turned into a mega menu are displayed below.', 'tcd-canon'); ?></p>
     </div>
     <ul class="option_list megamenu_option">
      <?php
           $i = 1;
           $megamenu_a_flag = true;
           $megamenu_b_flag = true;
           foreach ( $global_nav_items as $item ) :
             if ( $item->menu_item_parent ) continue;
             if( $megamenu_b_flag && ( $item->url == get_permalink(get_option('page_for_posts')) ) ){
               $value = isset( $options['megamenu_new'][$item->ID] ) ? $options['megamenu_new'][$item->ID] : 'dropdown';
               $megamenu_b_flag = false;
      ?>
      <li class="cf">
       <span class="label"><?php echo esc_html( $item->title ); ?></span>
       <div class="standard_radio_button">
        <input id="use_megamenu_a_yes_<?php echo $item->ID . $i; ?>" type="radio" name="dp_options[megamenu_new][<?php echo $item->ID; ?>]" value="use_megamenu_a" <?php checked( $value, 'use_megamenu_a' ); ?>>
        <label for="use_megamenu_a_yes_<?php echo $item->ID . $i; ?>"><?php printf(__('%s carousel', 'tcd-canon'), __('Post','tcd-canon')); ?></label>
        <input id="use_megamenu_a_no_<?php echo $item->ID . $i; ?>" type="radio" name="dp_options[megamenu_new][<?php echo $item->ID; ?>]" value="dropdown" <?php checked( $value, 'dropdown' ); ?> >
        <label for="use_megamenu_a_no_<?php echo $item->ID . $i; ?>"><?php _e('Normal menu', 'tcd-canon'); ?></label>
       </div>
      </li>
      <?php
             } elseif( $megamenu_a_flag && ( ($item->object == 'news' && $item->type == 'post_type_archive') || $item->url == get_post_type_archive_link('news') ) ){
               $value = isset( $options['megamenu_new'][$item->ID] ) ? $options['megamenu_new'][$item->ID] : 'dropdown';
               $megamenu_a_flag = false;
      ?>
      <li class="cf">
       <span class="label"><?php echo esc_html( $item->title ); ?></span>
       <div class="standard_radio_button">
        <input id="use_megamenu_b_yes_<?php echo $item->ID . $i; ?>" type="radio" name="dp_options[megamenu_new][<?php echo $item->ID; ?>]" value="use_megamenu_b" <?php checked( $value, 'use_megamenu_b' ); ?>>
        <label for="use_megamenu_b_yes_<?php echo $item->ID . $i; ?>"><?php printf(__('%s carousel', 'tcd-canon'), $news_label); ?></label>
        <input id="use_megamenu_b_no_<?php echo $item->ID . $i; ?>" type="radio" name="dp_options[megamenu_new][<?php echo $item->ID; ?>]" value="dropdown" <?php checked( $value, 'dropdown' ); ?>>
        <label for="use_megamenu_b_no_<?php echo $item->ID . $i; ?>"><?php _e('Normal menu', 'tcd-canon'); ?></label>
       </div>
      </li>
      <?php
             } else {
               $value = isset( $options['megamenu_new'][$item->ID] ) ? $options['megamenu_new'][$item->ID] : 'dropdown';
      ?>
      <li class="cf">
       <span class="label"><?php echo esc_html( $item->title ); ?></span>
       <div class="standard_radio_button">
        <input id="use_megamenu_c_type1_<?php echo $item->ID . $i; ?>" type="radio" name="dp_options[megamenu_new][<?php echo $item->ID; ?>]" value="use_megamenu_c" <?php checked( $value, 'use_megamenu_c' ); ?>>
        <label for="use_megamenu_c_type1_<?php echo $item->ID . $i; ?>"><?php _e('Carousel (3columns)', 'tcd-canon'); ?></label>
        <input id="use_megamenu_c_type2_<?php echo $item->ID . $i; ?>" type="radio" name="dp_options[megamenu_new][<?php echo $item->ID; ?>]" value="use_megamenu_d" <?php checked( $value, 'use_megamenu_d' ); ?>>
        <label for="use_megamenu_c_type2_<?php echo $item->ID . $i; ?>"><?php _e('Carousel (4columns)', 'tcd-canon'); ?></label>
        <input id="use_megamenu_c_type3_<?php echo $item->ID . $i; ?>" type="radio" name="dp_options[megamenu_new][<?php echo $item->ID; ?>]" value="dropdown" <?php checked( $value, 'dropdown' ); ?>>
        <label for="use_megamenu_c_type3_<?php echo $item->ID . $i; ?>"><?php _e('Normal menu', 'tcd-canon'); ?></label>
       </div>
      </li>
      <?php
             };
             $i++;
           endforeach;
      ?>
     </ul>

     <h4 class="theme_option_headline2"><?php _e( 'Color', 'tcd-canon' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('Accent color set in basic setting menu will be used for dark color.', 'tcd-canon'); ?></p>
     </div>
     <?php echo tcd_admin_image_radio_button($options, 'megamenu_color_type', $megamenu_color_type_options) ?>

     <h4 class="theme_option_headline2"><?php _e( 'Carousel', 'tcd-canon' ); ?></h4>

     <div class="sub_box_tab">
      <div class="tab active" data-tab="tab1"><span class="label"><?php printf(__('%s carousel', 'tcd-canon'), __('Post', 'tcd-canon')); ?></span></div>
      <div class="tab" data-tab="tab2"><span class="label"><?php printf(__('%s carousel', 'tcd-canon'), $news_label); ?></span></div>
      <div class="tab" data-tab="tab3"><span class="label"><?php _e('Carousel (3columns)', 'tcd-canon'); ?></span></div>
      <div class="tab" data-tab="tab4"><span class="label"><?php _e('Carousel (4columns)', 'tcd-canon'); ?></span></div>
     </div>

     <div class="sub_box_tab_content active" data-tab-content="tab1">

     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Headline', 'tcd-canon');  ?></span><input class="full_width" type="text" name="dp_options[megamenu_a_headline]" value="<?php echo esc_attr($options['megamenu_a_headline']); ?>"></li>
      <li class="cf"><span class="label"><?php _e('Catchphrase', 'tcd-canon');  ?></span><input class="full_width" type="text" name="dp_options[megamenu_a_sub_title]" value="<?php echo esc_attr($options['megamenu_a_sub_title']); ?>"></li>
      <li class="cf post_list_type_normal_option"><span class="label"><?php _e('Number of post to display', 'tcd-canon'); ?></span><input class="hankaku" style="width:70px;" type="number" step="1" min="1" name="dp_options[megamenu_a_post_num]" value="<?php echo esc_attr( $options['megamenu_a_post_num'] ); ?>" /></li>
      <li class="cf">
       <span class="label"><?php _e('Post type', 'tcd-canon');  ?></span>
       <select class="post_list_type" name="dp_options[megamenu_a_post_type]">
        <option style="padding-right: 10px;" value="all_post" <?php selected( $options['megamenu_a_post_type'], 'all_post' ); ?>><?php _e('All post', 'tcd-canon'); ?></option>
        <option style="padding-right: 10px;" value="category_post" <?php selected( $options['megamenu_a_post_type'], 'category_post' ); ?>><?php _e('Category post', 'tcd-canon'); ?></option>
        <option style="padding-right: 10px;" value="recommend_post" <?php selected( $options['megamenu_a_post_type'], 'recommend_post' ); ?>><?php _e('Recommend post', 'tcd-canon'); ?>1</option>
        <option style="padding-right: 10px;" value="recommend_post2" <?php selected( $options['megamenu_a_post_type'], 'recommend_post2' ); ?>><?php _e('Recommend post', 'tcd-canon'); ?>2</option>
        <option style="padding-right: 10px;" value="recommend_post3" <?php selected( $options['megamenu_a_post_type'], 'recommend_post3' ); ?>><?php _e('Recommend post', 'tcd-canon'); ?>3</option>
        <option style="padding-right: 10px;" value="custom" <?php selected( $options['megamenu_a_post_type'], 'custom' ); ?>><?php _e('Custom', 'tcd-canon'); ?></option>
       </select>
      </li>
      <li class="cf post_list_type_category_option">
       <span class="label"><?php _e('Category', 'tcd-canon'); ?></span>
       <?php
            $category_list = get_terms( 'category', array( 'hide_empty' => true ) );
            if ( $category_list && ! is_wp_error( $category_list ) ) {
              $selected_value = $options['megamenu_a_category_id'];
              wp_dropdown_categories( array(
               'taxonomy' => 'category',
               'class' => 'category',
               'hierarchical' => true,
               'id' => '',
               'name' => 'dp_options[megamenu_a_category_id]',
               'selected' => $selected_value,
               'value_field' => 'term_id'
              ) );
            } else {
       ?>
       <p><?php _e('No category is registered', 'tcd-canon');  ?></p>
       <?php }; ?>
      </li>
      <li class="cf post_list_type_normal_option">
       <span class="label"><?php _e('Post order', 'tcd-canon');  ?></span>
       <div class="standard_radio_button">
        <input id="megamenu_a_post_order1" type="radio" name="dp_options[megamenu_a_post_order]" value="date" <?php checked( $options['megamenu_a_post_order'], 'date' ); ?>>
        <label for="megamenu_a_post_order1"><?php _e('Date', 'tcd-canon'); ?></label>
        <input id="megamenu_a_post_order2" type="radio" name="dp_options[megamenu_a_post_order]" value="rand" <?php checked( $options['megamenu_a_post_order'], 'rand' ); ?>>
        <label for="megamenu_a_post_order2"><?php _e('Random', 'tcd-canon'); ?></label>
       </div>
      </li>
      <li class="cf post_list_type_custom_option">
       <span class="label"><?php _e('ID of the article you want to display', 'tcd-canon');  ?><span class="recommend_desc"><?php _e('Enter article IDs separated by commas.<br>The ID can be found in the administration screen.<br><a href="https://tcd-theme.com/2017/01/check_pageid_categoryid.html#tcd_id" target="_blank">Click here to see the ID display section of the TCD theme.</a>', 'tcd-canon'); ?></span></span>
       <input type="text" placeholder="<?php _e( 'e.g.', 'tcd-canon' ); ?>1,3,10" class="full_width hankaku" name="dp_options[megamenu_a_post_order_cutom]" value="<?php echo esc_attr($options['megamenu_a_post_order_cutom']); ?>">
      </li>
     </ul>

     </div>

     <div class="sub_box_tab_content" data-tab-content="tab2">

     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Headline', 'tcd-canon');  ?></span><input class="full_width" type="text" name="dp_options[megamenu_b_headline]" value="<?php echo esc_attr($options['megamenu_b_headline']); ?>"></li>
      <li class="cf"><span class="label"><?php _e('Catchphrase', 'tcd-canon');  ?></span><input class="full_width" type="text" name="dp_options[megamenu_b_sub_title]" value="<?php echo esc_attr($options['megamenu_b_sub_title']); ?>"></li>
      <li class="cf post_list_type_normal_option"><span class="label"><?php _e('Number of post to display', 'tcd-canon'); ?></span><input class="hankaku" style="width:70px;" type="number" step="1" min="1" name="dp_options[megamenu_b_post_num]" value="<?php echo esc_attr( $options['megamenu_b_post_num'] ); ?>" /></li>
      <li class="cf">
       <span class="label"><?php _e('Post type', 'tcd-canon');  ?></span>
       <select class="post_list_type" name="dp_options[megamenu_b_post_type]">
        <option style="padding-right: 10px;" value="all_post" <?php selected( $options['megamenu_b_post_type'], 'all_post' ); ?>><?php _e('All post', 'tcd-canon'); ?></option>
        <option style="padding-right: 10px;" value="category_post" <?php selected( $options['megamenu_b_post_type'], 'category_post' ); ?>><?php _e('Category post', 'tcd-canon'); ?></option>
        <option style="padding-right: 10px;" value="recommend_post" <?php selected( $options['megamenu_b_post_type'], 'recommend_post' ); ?>><?php _e('Recommend post', 'tcd-canon'); ?>1</option>
        <option style="padding-right: 10px;" value="recommend_post2" <?php selected( $options['megamenu_b_post_type'], 'recommend_post2' ); ?>><?php _e('Recommend post', 'tcd-canon'); ?>2</option>
        <option style="padding-right: 10px;" value="recommend_post3" <?php selected( $options['megamenu_b_post_type'], 'recommend_post3' ); ?>><?php _e('Recommend post', 'tcd-canon'); ?>3</option>
        <option style="padding-right: 10px;" value="custom" <?php selected( $options['megamenu_b_post_type'], 'custom' ); ?>><?php _e('Custom', 'tcd-canon'); ?></option>
       </select>
      </li>
      <li class="cf post_list_type_category_option">
       <span class="label"><?php _e('Category', 'tcd-canon'); ?></span>
       <?php
            $category_list = get_terms( 'news_category', array( 'hide_empty' => true ) );
            if ( $category_list && ! is_wp_error( $category_list ) ) {
              $selected_value = $options['megamenu_b_category_id'];
              wp_dropdown_categories( array(
               'taxonomy' => 'news_category',
               'class' => 'category',
               'hierarchical' => true,
               'id' => '',
               'name' => 'dp_options[megamenu_b_category_id]',
               'selected' => $selected_value,
               'value_field' => 'term_id'
              ) );
            } else {
       ?>
       <p><?php _e('No category is registered', 'tcd-canon');  ?></p>
       <?php }; ?>
      </li>
      <li class="cf post_list_type_normal_option">
       <span class="label"><?php _e('Post order', 'tcd-canon');  ?></span>
       <div class="standard_radio_button">
        <input id="megamenu_b_post_order1" type="radio" name="dp_options[megamenu_b_post_order]" value="date" <?php checked( $options['megamenu_b_post_order'], 'date' ); ?>>
        <label for="megamenu_b_post_order1"><?php _e('Date', 'tcd-canon'); ?></label>
        <input id="megamenu_b_post_order2" type="radio" name="dp_options[megamenu_b_post_order]" value="rand" <?php checked( $options['megamenu_b_post_order'], 'rand' ); ?>>
        <label for="megamenu_b_post_order2"><?php _e('Random', 'tcd-canon'); ?></label>
       </div>
      </li>
      <li class="cf post_list_type_custom_option">
       <span class="label"><?php _e('ID of the article you want to display', 'tcd-canon');  ?><span class="recommend_desc"><?php _e('Enter article IDs separated by commas.<br>The ID can be found in the administration screen.<br><a href="https://tcd-theme.com/2017/01/check_pageid_categoryid.html#tcd_id" target="_blank">Click here to see the ID display section of the TCD theme.</a>', 'tcd-canon'); ?></span></span>
       <input type="text" placeholder="<?php _e( 'e.g.', 'tcd-canon' ); ?>1,3,10" class="full_width hankaku" name="dp_options[megamenu_b_post_order_cutom]" value="<?php echo esc_attr($options['megamenu_b_post_order_cutom']); ?>">
      </li>
     </ul>

     </div>

     <div class="sub_box_tab_content" data-tab-content="tab3">

      <ul class="option_list">
       <li class="cf"><span class="label"><?php _e('Headline', 'tcd-canon');  ?></span><input class="full_width" type="text" name="dp_options[megamenu_c_headline]" value="<?php echo esc_attr($options['megamenu_c_headline']); ?>"></li>
       <li class="cf"><span class="label"><?php _e('Catchphrase', 'tcd-canon');  ?></span><input class="full_width" type="text" name="dp_options[megamenu_c_sub_title]" value="<?php echo esc_attr($options['megamenu_c_sub_title']); ?>"></li>
      </ul>

      <div class="theme_option_message2" style="margin-top:20px;">
       <p><?php _e('Click add new item button to start this option.<br />You can change order by dragging each headline of option field.', 'tcd-canon');  ?></p>
      </div>

      <?php //繰り返しフィールド ----- ?>
      <div class="repeater-wrapper">
       <input type="hidden" name="dp_options[megamenu_c_item_list]" value="">
       <div class="repeater sortable" data-delete-confirm="<?php _e( 'Delete?', 'tcd-canon' ); ?>">
        <?php
             if ( $options['megamenu_c_item_list'] ) :
               foreach ( $options['megamenu_c_item_list'] as $key => $value ) :
        ?>
        <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $key ); ?>">
         <h4 class="theme_option_subbox_headline"><?php _e( 'Item', 'tcd-canon' ); echo esc_attr( $key+1 ); ?></h4>
         <div class="sub_box_content">

          <ul class="option_list">
           <li class="cf">
            <span class="label">
             <?php _e('Image', 'tcd-canon'); ?>
             <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-canon'), '310', '130'); ?></span>
            </span>
            <div class="image_box cf">
             <div class="cf cf_media_field hide-if-no-js megamenu_c_item_list_image<?php echo esc_attr( $key ); ?>">
              <input type="hidden" value="<?php if($value['image']) { echo esc_attr( $value['image'] ); }; ?>" id="megamenu_c_item_list_image<?php echo esc_attr( $key ); ?>" name="dp_options[megamenu_c_item_list][<?php echo esc_attr( $key ); ?>][image]" class="cf_media_id">
              <div class="preview_field"><?php if($value['image']){ echo wp_get_attachment_image($value['image'], 'full'); }; ?></div>
              <div class="buttton_area">
               <input type="button" value="<?php _e('Select Image', 'tcd-canon'); ?>" class="cfmf-select-img button">
               <input type="button" value="<?php _e('Remove Image', 'tcd-canon'); ?>" class="cfmf-delete-img button <?php if(!$value['image']){ echo 'hidden'; }; ?>">
              </div>
             </div>
            </div>
           </li>
           <li class="cf"><span class="label"><?php _e('Catchphrase', 'tcd-canon'); ?></span><input class="repeater-label full_width" type="text" name="dp_options[megamenu_c_item_list][<?php echo esc_attr( $key ); ?>][title]" value="<?php echo esc_attr($value['title']); ?>" /></li>
           <li class="cf"><span class="label"><?php _e('Description', 'tcd-canon'); ?></span><textarea class="full_width" cols="50" rows="3" name="dp_options[megamenu_c_item_list][<?php echo esc_attr( $key ); ?>][desc]"><?php echo esc_textarea(  $value['desc'] ); ?></textarea></li>
           <li class="cf button_option">
            <span class="label"><?php _e('Link URL', 'tcd-canon'); ?></span>
            <div class="admin_link_option">
             <input type="text" name="dp_options[megamenu_c_item_list][<?php echo esc_attr( $key ); ?>][url]" placeholder="https://example.com/" value="<?php esc_attr_e( $value['url'] ); ?>">
             <input id="megamenu_c_item_list_target<?php echo esc_attr( $key ); ?>" class="admin_link_option_target" name="dp_options[megamenu_c_item_list][<?php echo esc_attr( $key ); ?>][target]" type="checkbox" value="1" <?php checked( $value['target'], 1 ); ?>>
             <label for="megamenu_c_item_list_target<?php echo esc_attr( $key ); ?>">&#xe920;</label>
            </div>
           </li>
          </ul>

          <ul class="button_list cf">
           <li style="float:right; margin:0;" class="delete-row"><a class="button-delete-row button-ml red_button" href="#"><?php echo __( 'Delete item', 'tcd-canon' ); ?></a></li>
          </ul>
         </div><!-- END .sub_box_content -->
        </div><!-- END .sub_box -->
        <?php
              endforeach;
            endif;
            $key = 'addindex';
            $value = array(
             'image' => false,
             'title' => '',
             'desc' => '',
             'url' => '',
             'target' => '',
            );
            ob_start();
        ?>
        <div class="sub_box repeater-item repeater-item-<?php echo $key; ?>">
         <h4 class="theme_option_subbox_headline"><?php _e( 'New item', 'tcd-canon' ); ?></h4>
         <div class="sub_box_content">

          <ul class="option_list">
           <li class="cf">
            <span class="label">
             <?php _e('Image', 'tcd-canon'); ?>
             <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-canon'), '310', '130'); ?></span>
            </span>
            <div class="image_box cf">
             <div class="cf cf_media_field hide-if-no-js megamenu_c_item_list_image<?php echo esc_attr( $key ); ?>">
              <input type="hidden" value="<?php if($value['image']) { echo esc_attr( $value['image'] ); }; ?>" id="megamenu_c_item_list_image<?php echo esc_attr( $key ); ?>" name="dp_options[megamenu_c_item_list][<?php echo esc_attr( $key ); ?>][image]" class="cf_media_id">
              <div class="preview_field"><?php if($value['image']){ echo wp_get_attachment_image($value['image'], 'full'); }; ?></div>
              <div class="buttton_area">
               <input type="button" value="<?php _e('Select Image', 'tcd-canon'); ?>" class="cfmf-select-img button">
               <input type="button" value="<?php _e('Remove Image', 'tcd-canon'); ?>" class="cfmf-delete-img button <?php if(!$value['image']){ echo 'hidden'; }; ?>">
              </div>
             </div>
            </div>
           </li>
           <li class="cf"><span class="label"><?php _e('Catchphrase', 'tcd-canon'); ?></span><input class="repeater-label full_width" type="text" name="dp_options[megamenu_c_item_list][<?php echo esc_attr( $key ); ?>][title]" value="<?php echo esc_attr($value['title']); ?>" /></li>
           <li class="cf"><span class="label"><?php _e('Description', 'tcd-canon'); ?></span><textarea class="full_width" cols="50" rows="3" name="dp_options[megamenu_c_item_list][<?php echo esc_attr( $key ); ?>][desc]"><?php echo esc_textarea(  $value['desc'] ); ?></textarea></li>
           <li class="cf button_option">
            <span class="label"><?php _e('Link URL', 'tcd-canon'); ?></span>
            <div class="admin_link_option">
             <input type="text" name="dp_options[megamenu_c_item_list][<?php echo esc_attr( $key ); ?>][url]" placeholder="https://example.com/" value="<?php esc_attr_e( $value['url'] ); ?>">
             <input id="megamenu_c_item_list_target<?php echo esc_attr( $key ); ?>" class="admin_link_option_target" name="dp_options[megamenu_c_item_list][<?php echo esc_attr( $key ); ?>][target]" type="checkbox" value="1" <?php checked( $value['target'], 1 ); ?>>
             <label for="megamenu_c_item_list_target<?php echo esc_attr( $key ); ?>">&#xe920;</label>
            </div>
           </li>
          </ul>

          <ul class="button_list cf">
           <li style="float:right; margin:0;" class="delete-row"><a class="button-delete-row button-ml red_button" href="#"><?php echo __( 'Delete item', 'tcd-canon' ); ?></a></li>
          </ul>
         </div><!-- END .sub_box_content -->
        </div><!-- END .sub_box -->
        <?php
             $clone = ob_get_clean();
        ?>
       </div><!-- END .repeater -->
       <a href="#" class="button button-secondary button-add-row" data-clone="<?php echo htmlspecialchars( $clone ); ?>"><?php _e( 'Add item', 'tcd-canon' ); ?></a>
      </div><!-- END .repeater-wrapper -->
      <?php //繰り返しフィールドここまで ----- ?>

     </div>

     <div class="sub_box_tab_content" data-tab-content="tab4">

      <ul class="option_list">
       <li class="cf"><span class="label"><?php _e('Headline', 'tcd-canon');  ?></span><input class="full_width" type="text" name="dp_options[megamenu_d_headline]" value="<?php echo esc_attr($options['megamenu_d_headline']); ?>"></li>
       <li class="cf"><span class="label"><?php _e('Catchphrase', 'tcd-canon');  ?></span><input class="full_width" type="text" name="dp_options[megamenu_d_sub_title]" value="<?php echo esc_attr($options['megamenu_d_sub_title']); ?>"></li>
      </ul>

      <div class="theme_option_message2" style="margin-top:20px;">
       <p><?php _e('Click add new item button to start this option.<br />You can change order by dragging each headline of option field.', 'tcd-canon');  ?></p>
      </div>

      <?php //繰り返しフィールド ----- ?>
      <div class="repeater-wrapper">
       <input type="hidden" name="dp_options[megamenu_d_item_list]" value="">
       <div class="repeater sortable" data-delete-confirm="<?php _e( 'Delete?', 'tcd-canon' ); ?>">
        <?php
             if ( $options['megamenu_d_item_list'] ) :
               foreach ( $options['megamenu_d_item_list'] as $key => $value ) :
        ?>
        <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $key ); ?>">
         <h4 class="theme_option_subbox_headline"><?php _e( 'Item', 'tcd-canon' ); echo esc_attr( $key+1 ); ?></h4>
         <div class="sub_box_content">

          <ul class="option_list">
           <li class="cf">
            <span class="label">
             <?php _e('Image', 'tcd-canon'); ?>
             <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-canon'), '222', '170'); ?></span>
            </span>
            <div class="image_box cf">
             <div class="cf cf_media_field hide-if-no-js megamenu_d_item_list_image<?php echo esc_attr( $key ); ?>">
              <input type="hidden" value="<?php if($value['image']) { echo esc_attr( $value['image'] ); }; ?>" id="megamenu_d_item_list_image<?php echo esc_attr( $key ); ?>" name="dp_options[megamenu_d_item_list][<?php echo esc_attr( $key ); ?>][image]" class="cf_media_id">
              <div class="preview_field"><?php if($value['image']){ echo wp_get_attachment_image($value['image'], 'full'); }; ?></div>
              <div class="buttton_area">
               <input type="button" value="<?php _e('Select Image', 'tcd-canon'); ?>" class="cfmf-select-img button">
               <input type="button" value="<?php _e('Remove Image', 'tcd-canon'); ?>" class="cfmf-delete-img button <?php if(!$value['image']){ echo 'hidden'; }; ?>">
              </div>
             </div>
            </div>
           </li>
           <li class="cf"><span class="label"><?php _e('Catchphrase', 'tcd-canon'); ?></span><input class="repeater-label full_width" type="text" name="dp_options[megamenu_d_item_list][<?php echo esc_attr( $key ); ?>][title]" value="<?php echo esc_attr($value['title']); ?>" /></li>
           <li class="cf"><span class="label"><?php _e('Sub title', 'tcd-canon'); ?></span><input class="full_width" type="text" name="dp_options[megamenu_d_item_list][<?php echo esc_attr( $key ); ?>][sub_title]" value="<?php echo esc_attr($value['sub_title']); ?>" /></li>
           <li class="cf"><span class="label"><?php _e('Description', 'tcd-canon'); ?></span><textarea class="full_width" cols="50" rows="3" name="dp_options[megamenu_d_item_list][<?php echo esc_attr( $key ); ?>][desc]"><?php echo esc_textarea(  $value['desc'] ); ?></textarea></li>
           <li class="cf button_option">
            <span class="label"><?php _e('Link URL', 'tcd-canon'); ?></span>
            <div class="admin_link_option">
             <input type="text" name="dp_options[megamenu_d_item_list][<?php echo esc_attr( $key ); ?>][url]" placeholder="https://example.com/" value="<?php esc_attr_e( $value['url'] ); ?>">
             <input id="megamenu_d_item_list_target<?php echo esc_attr( $key ); ?>" class="admin_link_option_target" name="dp_options[megamenu_d_item_list][<?php echo esc_attr( $key ); ?>][target]" type="checkbox" value="1" <?php checked( $value['target'], 1 ); ?>>
             <label for="megamenu_d_item_list_target<?php echo esc_attr( $key ); ?>">&#xe920;</label>
            </div>
           </li>
          </ul>

          <ul class="button_list cf">
           <li style="float:right; margin:0;" class="delete-row"><a class="button-delete-row button-ml red_button" href="#"><?php echo __( 'Delete item', 'tcd-canon' ); ?></a></li>
          </ul>
         </div><!-- END .sub_box_content -->
        </div><!-- END .sub_box -->
        <?php
              endforeach;
            endif;
            $key = 'addindex';
            $value = array(
             'image' => false,
             'title' => '',
             'sub_title' => '',
             'desc' => '',
             'url' => '',
             'target' => '',
            );
            ob_start();
        ?>
        <div class="sub_box repeater-item repeater-item-<?php echo $key; ?>">
         <h4 class="theme_option_subbox_headline"><?php _e( 'New item', 'tcd-canon' ); ?></h4>
         <div class="sub_box_content">

          <ul class="option_list">
           <li class="cf">
            <span class="label">
             <?php _e('Image', 'tcd-canon'); ?>
             <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-canon'), '222', '170'); ?></span>
            </span>
            <div class="image_box cf">
             <div class="cf cf_media_field hide-if-no-js megamenu_d_item_list_image<?php echo esc_attr( $key ); ?>">
              <input type="hidden" value="<?php if($value['image']) { echo esc_attr( $value['image'] ); }; ?>" id="megamenu_d_item_list_image<?php echo esc_attr( $key ); ?>" name="dp_options[megamenu_d_item_list][<?php echo esc_attr( $key ); ?>][image]" class="cf_media_id">
              <div class="preview_field"><?php if($value['image']){ echo wp_get_attachment_image($value['image'], 'full'); }; ?></div>
              <div class="buttton_area">
               <input type="button" value="<?php _e('Select Image', 'tcd-canon'); ?>" class="cfmf-select-img button">
               <input type="button" value="<?php _e('Remove Image', 'tcd-canon'); ?>" class="cfmf-delete-img button <?php if(!$value['image']){ echo 'hidden'; }; ?>">
              </div>
             </div>
            </div>
           </li>
           <li class="cf"><span class="label"><?php _e('Catchphrase', 'tcd-canon'); ?></span><input class="repeater-label full_width" type="text" name="dp_options[megamenu_d_item_list][<?php echo esc_attr( $key ); ?>][title]" value="<?php echo esc_attr($value['title']); ?>" /></li>
           <li class="cf"><span class="label"><?php _e('Sub title', 'tcd-canon'); ?></span><input class="full_width" type="text" name="dp_options[megamenu_d_item_list][<?php echo esc_attr( $key ); ?>][sub_title]" value="<?php echo esc_attr($value['sub_title']); ?>" /></li>
           <li class="cf"><span class="label"><?php _e('Description', 'tcd-canon'); ?></span><textarea class="full_width" cols="50" rows="3" name="dp_options[megamenu_d_item_list][<?php echo esc_attr( $key ); ?>][desc]"><?php echo esc_textarea(  $value['desc'] ); ?></textarea></li>
           <li class="cf button_option">
            <span class="label"><?php _e('Link URL', 'tcd-canon'); ?></span>
            <div class="admin_link_option">
             <input type="text" name="dp_options[megamenu_d_item_list][<?php echo esc_attr( $key ); ?>][url]" placeholder="https://example.com/" value="<?php esc_attr_e( $value['url'] ); ?>">
             <input id="megamenu_d_item_list_target<?php echo esc_attr( $key ); ?>" class="admin_link_option_target" name="dp_options[megamenu_d_item_list][<?php echo esc_attr( $key ); ?>][target]" type="checkbox" value="1" <?php checked( $value['target'], 1 ); ?>>
             <label for="megamenu_d_item_list_target<?php echo esc_attr( $key ); ?>">&#xe920;</label>
            </div>
           </li>
          </ul>

          <ul class="button_list cf">
           <li style="float:right; margin:0;" class="delete-row"><a class="button-delete-row button-ml red_button" href="#"><?php echo __( 'Delete item', 'tcd-canon' ); ?></a></li>
          </ul>
         </div><!-- END .sub_box_content -->
        </div><!-- END .sub_box -->
        <?php
             $clone = ob_get_clean();
        ?>
       </div><!-- END .repeater -->
       <a href="#" class="button button-secondary button-add-row" data-clone="<?php echo htmlspecialchars( $clone ); ?>"><?php _e( 'Add item', 'tcd-canon' ); ?></a>
      </div><!-- END .repeater-wrapper -->
      <?php //繰り返しフィールドここまで ----- ?>

     </div>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-canon' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-canon' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // ドロワーメニューの設定 ------------------------------------------------------------ ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Drawer menu', 'tcd-canon');  ?></h3>
    <div class="theme_option_field_ac_content tab_parent">

     <div class="front_page_image">
      <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/image/drawer_menu.jpg?1.4" alt="" title="" />
     </div>

     <h4 class="theme_option_headline2"><?php _e( 'Color', 'tcd-canon' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('Accent color set in basic setting menu will be used for dark color.', 'tcd-canon'); ?></p>
     </div>
     <?php echo tcd_admin_image_radio_button($options, 'drawer_menu_color_type', $drawer_menu_color_options) ?>

     <?php // メニュー ----------------------------------------------------------------- ?>
     <h4 class="theme_option_headline_number"><span class="num">1</span><?php _e( 'Button', 'tcd-canon' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php echo __('Please set button from "Header > Basic setting".', 'tcd-canon'); ?></p>
     </div>

     <?php // メニュー ----------------------------------------------------------------- ?>
     <h4 class="theme_option_headline_number"><span class="num">2</span><?php _e( 'Menu', 'tcd-canon' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php echo __('Please set menu from <a href="./nav-menus.php" target="_blank">"Menu Screen"</a> in theme menu.', 'tcd-canon'); ?></p>
     </div>

     <?php // 検索フォーム ----------------------------------------------------------------- ?>
     <h4 class="theme_option_headline_number"><span class="num">3</span><?php _e( 'Search form', 'tcd-canon' ); ?></h4>
     <?php echo tcd_basic_radio_button($options, 'show_drawer_search', $basic_display_options); ?>
     <br style="clear:both;">

     <?php // 検索窓・SNSアイコン ----------------------------------------------------------------- ?>
     <h4 class="theme_option_headline_number"><span class="num">4</span><?php _e( 'SNS icon', 'tcd-canon' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('You can set SNS icon from "Basic Settings" SNS section.', 'tcd-canon'); ?></p>
     </div>

     <?php // 言語ボタン ----------------------------------------------------------------- ?>
     <h4 class="theme_option_headline_number"><span class="num">5</span><?php _e( 'Language button', 'tcd-canon' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php echo __('Please set language button from "Basic setting".', 'tcd-canon'); ?></p>
     </div>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-canon' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-canon' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->

</div><!-- END .tab-content -->

<?php
} // END add_header_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_header_theme_options_validate( $input ) {

  global $dp_default_options, $logo_type_options;

  // メッセージ
  $input['show_header_message'] = wp_filter_nohtml_kses( $input['show_header_message'] );
  $input['header_message'] = wp_filter_nohtml_kses( $input['header_message'] );
  $input['header_message_url'] = wp_filter_nohtml_kses( $input['header_message_url'] );
  $input['header_message_target'] = wp_filter_nohtml_kses( $input['header_message_target'] );
  $input['header_message_font_color'] = sanitize_hex_color( $input['header_message_font_color'] );
  $input['header_message_bg_color'] = sanitize_hex_color( $input['header_message_bg_color'] );


  // ドロワーメニュー
  $input['drawer_menu_color_type'] = wp_filter_nohtml_kses( $input['drawer_menu_color_type'] );
  $input['show_drawer_search'] = wp_filter_nohtml_kses( $input['show_drawer_search'] );


  // ボタン
  for ( $i = 1; $i <= 2; $i++ ) {
    $input['header_button_title'.$i] = wp_kses_post( $input['header_button_title'.$i] );
    $input['header_button_url'.$i] = wp_filter_nohtml_kses( $input['header_button_url'.$i] );
    $input['header_button_target'.$i] = ! empty( $input['header_button_target'.$i] ) ? 1 : 0;
    $input['header_button_color'.$i] = wp_filter_nohtml_kses( $input['header_button_color'.$i] );
  }


  // 検索
  $input['header_search'] = wp_filter_nohtml_kses( $input['header_search'] );


  // 言語ボタン
  for ( $i = 1; $i <= 4; $i++ ) {
    $input['lang_button_title'.$i] = wp_kses_post( $input['lang_button_title'.$i] );
    $input['lang_button_url'.$i] = wp_filter_nohtml_kses( $input['lang_button_url'.$i] );
    $input['lang_button_target'.$i] = ! empty( $input['lang_button_target'.$i] ) ? 1 : 0;
  }


  // メガメニュー
  $new_megamenu_options = array(
    'dropdown' => array('value' => 'dropdown'),
    'use_megamenu_a' => array('value' => 'use_megamenu_a'),
    'use_megamenu_b' => array('value' => 'use_megamenu_b'),
    'use_megamenu_c' => array('value' => 'use_megamenu_c'),
    'use_megamenu_d' => array('value' => 'use_megamenu_d'),
  );
  foreach ( array_keys( $input['megamenu_new'] ) as $index ) {
    if ( ! array_key_exists( $input['megamenu_new'][$index], $new_megamenu_options ) ) {
      $input['megamenu_new'][$index] = null;
    }
  }
  $input['megamenu_color_type'] = wp_filter_nohtml_kses( $input['megamenu_color_type'] );


  // メガメニューA
  $input['megamenu_a_post_type'] = wp_filter_nohtml_kses( $input['megamenu_a_post_type'] );
  $input['megamenu_a_post_order'] = wp_filter_nohtml_kses( $input['megamenu_a_post_order'] );
  $input['megamenu_a_post_order_cutom'] = wp_filter_nohtml_kses( $input['megamenu_a_post_order_cutom'] );
  $input['megamenu_a_post_num'] = wp_filter_nohtml_kses( $input['megamenu_a_post_num'] );
  $input['megamenu_a_category_id'] = wp_filter_nohtml_kses( $input['megamenu_a_category_id'] );
  $input['megamenu_a_headline'] = wp_filter_nohtml_kses( $input['megamenu_a_headline'] );
  $input['megamenu_a_sub_title'] = wp_filter_nohtml_kses( $input['megamenu_a_sub_title'] );


  // メガメニューB
  $input['megamenu_b_post_type'] = wp_filter_nohtml_kses( $input['megamenu_b_post_type'] );
  $input['megamenu_b_post_order'] = wp_filter_nohtml_kses( $input['megamenu_b_post_order'] );
  $input['megamenu_b_post_order_cutom'] = wp_filter_nohtml_kses( $input['megamenu_b_post_order_cutom'] );
  $input['megamenu_b_post_num'] = wp_filter_nohtml_kses( $input['megamenu_b_post_num'] );
  $input['megamenu_b_category_id'] = wp_filter_nohtml_kses( $input['megamenu_b_category_id'] );
  $input['megamenu_b_headline'] = wp_filter_nohtml_kses( $input['megamenu_b_headline'] );
  $input['megamenu_b_sub_title'] = wp_filter_nohtml_kses( $input['megamenu_b_sub_title'] );


  // メガメニューC
  $megamenu_c_item_list = array();
  if ( isset( $input['megamenu_c_item_list'] ) && is_array( $input['megamenu_c_item_list'] ) ) {
    foreach ( $input['megamenu_c_item_list'] as $key => $value ) {
      $megamenu_c_item_list[] = array(
        'image' => isset( $input['megamenu_c_item_list'][$key]['image'] ) ? wp_filter_nohtml_kses( $input['megamenu_c_item_list'][$key]['image'] ) : '',
        'title' => isset( $input['megamenu_c_item_list'][$key]['title'] ) ? wp_filter_nohtml_kses( $input['megamenu_c_item_list'][$key]['title'] ) : '',
        'desc' => isset( $input['megamenu_c_item_list'][$key]['desc'] ) ? wp_filter_nohtml_kses( $input['megamenu_c_item_list'][$key]['desc'] ) : '',
        'url' => isset( $input['megamenu_c_item_list'][$key]['url'] ) ? wp_filter_nohtml_kses( $input['megamenu_c_item_list'][$key]['url'] ) : '',
        'target' => ! empty( $input['megamenu_c_item_list'][$key]['target'] ) ? 1 : 0,
      );
    }
  };
  $input['megamenu_c_item_list'] = $megamenu_c_item_list;
  $input['megamenu_c_headline'] = wp_filter_nohtml_kses( $input['megamenu_c_headline'] );
  $input['megamenu_c_sub_title'] = wp_filter_nohtml_kses( $input['megamenu_c_sub_title'] );


  // メガメニューD
  $megamenu_d_item_list = array();
  if ( isset( $input['megamenu_d_item_list'] ) && is_array( $input['megamenu_d_item_list'] ) ) {
    foreach ( $input['megamenu_d_item_list'] as $key => $value ) {
      $megamenu_d_item_list[] = array(
        'image' => isset( $input['megamenu_d_item_list'][$key]['image'] ) ? wp_filter_nohtml_kses( $input['megamenu_d_item_list'][$key]['image'] ) : '',
        'title' => isset( $input['megamenu_d_item_list'][$key]['title'] ) ? wp_filter_nohtml_kses( $input['megamenu_d_item_list'][$key]['title'] ) : '',
        'sub_title' => isset( $input['megamenu_d_item_list'][$key]['sub_title'] ) ? wp_filter_nohtml_kses( $input['megamenu_d_item_list'][$key]['sub_title'] ) : '',
        'desc' => isset( $input['megamenu_d_item_list'][$key]['desc'] ) ? wp_filter_nohtml_kses( $input['megamenu_d_item_list'][$key]['desc'] ) : '',
        'url' => isset( $input['megamenu_d_item_list'][$key]['url'] ) ? wp_filter_nohtml_kses( $input['megamenu_d_item_list'][$key]['url'] ) : '',
        'target' => ! empty( $input['megamenu_d_item_list'][$key]['target'] ) ? 1 : 0,
      );
    }
  };
  $input['megamenu_d_item_list'] = $megamenu_d_item_list;
  $input['megamenu_d_headline'] = wp_filter_nohtml_kses( $input['megamenu_d_headline'] );
  $input['megamenu_d_sub_title'] = wp_filter_nohtml_kses( $input['megamenu_d_sub_title'] );


  return $input;

};


?>