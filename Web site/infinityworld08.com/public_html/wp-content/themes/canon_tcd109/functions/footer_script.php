<?php
     // 共通のスクリプト --------------------------------------------------------------------------
     function footer_common_script(){
       global $post;
       $options = get_design_plus_option();

       // メガメニュー -----------------------------------------
?>
(function($) {

  if( $('.megamenu_post_carousel').length ){
    let megamenu_post_carousel = new Swiper(".megamenu_post_carousel", {
      observer: true,
      observeParents: true,
      slidesPerView: 3,
      spaceBetween: '35px',
      navigation: {
        nextEl: ".megamenu_post_next",
        prevEl: ".megamenu_post_prev",
      }
    });
  };
  if( $('.megamenu_news_carousel').length ){
    let megamenu_news_carousel = new Swiper(".megamenu_news_carousel", {
      observer: true,
      observeParents: true,
      slidesPerView: 4,
      spaceBetween: '35px',
      navigation: {
        nextEl: ".megamenu_news_next",
        prevEl: ".megamenu_news_prev",
      }
    });
  };
<?php if($options['megamenu_c_item_list']){ ?>
  if( $('.megamenu_gallery_carousel').length ){
    let megamenu_gallery_carousel = new Swiper(".megamenu_gallery_carousel", {
      observer: true,
      observeParents: true,
      slidesPerView: 3,
      spaceBetween: '35px',
      navigation: {
        nextEl: ".megamenu_gallery_next",
        prevEl: ".megamenu_gallery_prev",
      }
    });
  };
<?php }; ?>
<?php if($options['megamenu_d_item_list']){ ?>
  if( $('.megamenu_service_carousel').length ){
    let megamenu_service_carousel = new Swiper(".megamenu_service_carousel", {
      observer: true,
      observeParents: true,
      slidesPerView: 4,
      spaceBetween: '35px',
      navigation: {
        nextEl: ".megamenu_service_next",
        prevEl: ".megamenu_service_prev",
      }
    });
  };
<?php }; ?>
})(jQuery);
<?php
       // フッターカルーセル --------------------
       $item_list = $options['footer_banner_list'];
       if($item_list){
?>
(function($) {
  var item_num;

  function adjustBannerWidth() {
    var windowWidth = $(window).width();
    var sliderWidth = windowWidth > 1300 ? Math.ceil(windowWidth / 4 * item_num) : 300 * item_num;

    $('#footer_banner_wrap .footer_banner').css('width', sliderWidth);
    $('#footer_banner_wrap').css('width', sliderWidth * 3);
  }

  item_num = $('#footer_banner_wrap .footer_banner .item').length;

  adjustBannerWidth();

  var debounceResize;
  $(window).resize(function() {
    clearTimeout(debounceResize);
    debounceResize = setTimeout(function() {
      $('#footer_banner_wrap .footer_banner').css('width', '');
      $('#footer_banner_wrap').css('width', '');
      adjustBannerWidth();
    }, 250);
  });

  var slider = $('#footer_banner_wrap .footer_banner');
  var animation_time = 30 * item_num;
  slider.clone().insertBefore(slider);
  slider.clone().insertAfter(slider);
  $('#footer_banner_wrap .footer_banner').css('animation-duration', animation_time + 's');
  $('#footer_banner_wrap .footer_banner:nth-child(2)').css('animation-delay', -animation_time / 1.5 + 's');
  $('#footer_banner_wrap .footer_banner:nth-child(3)').css('animation-delay', -animation_time / 3 + 's');

})(jQuery);
<?php
       };

       // トップページ ------------------------------
       if(is_front_page()) {

         // コンテンツビルダー ------------------------
         if ($options['contents_builder']) :
           $contents_builder = $options['contents_builder'];
           $content_count = 1;
           foreach($contents_builder as $content) :

             // 画像スライダー ------------------------
             if ( $content['type'] == 'image_slider' && $content['show_content'] ) {
               $image_slider_type = isset($content['layout']) ?  $content['layout'] : 'type1';
               $image_slider = isset($content['image_slider']) ?  $content['image_slider'] : '';
               $total_image_num = 0;
               if($image_slider){
                 $image_slider = !empty($image_slider) ? explode( ',', $image_slider ) : array();
                 foreach( $image_slider as $image_id ):
                   $slider_image = wp_get_attachment_image_src( $image_id, 'full' );
                   if($slider_image){
                     $total_image_num++;
                   };
                 endforeach;
?>
(function($) {

  if( $('#<?php echo 'cb_content_' . $content_count; ?> .sc_image_carousel_wrap').length ){

<?php if($image_slider_type == 'type2'){ ?>
    let sc_image_carousel_nav<?php echo $content_count; ?> = new Swiper("#<?php echo 'cb_content_' . $content_count; ?> .sc_image_carousel_nav", {
      slidesPerView: <?php echo esc_attr($total_image_num); ?>,
      watchSlidesProgress: true,
    });
<?php }; ?>

    let sc_image_carousel_wrap<?php echo $content_count; ?> = new Swiper("#<?php echo 'cb_content_' . $content_count; ?> .sc_image_carousel_wrap", {
<?php if($image_slider_type == 'type1'){ ?>
      effect:'fade',
      fadeEffect: {
        crossFade: true
      },
      loop: true,
      speed: 1000,
      slidesPerView: 1,
      autoplay: {
        delay: 2500,
        disableOnInteraction: false,
      },
      pagination: {
        el: '#<?php echo 'cb_content_' . $content_count; ?> .sc_image_carousel_pagination',
        clickable: true,
      },
<?php } else { ?>
      loop: true,
      speed: 600,
      slidesPerView: "auto",
      spaceBetween: '0',
      centeredSlides: true,
      grabCursor: true,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
      thumbs: {
        swiper: sc_image_carousel_nav<?php echo $content_count; ?>,
      }
<?php }; ?>
    });
  }

})(jQuery);
<?php
               };

             // デザインコンテンツ ------------------------
             } elseif ( $content['type'] == 'design_content' && $content['show_content'] ) {
?>
(function($) {

  if( $('#<?php echo 'cb_content_' . $content_count; ?> .dc_image_carousel_wrap').length ){
    let dc_image_carousel_wrap<?php echo $content_count; ?> = new Swiper("#<?php echo 'cb_content_' . $content_count; ?> .dc_image_carousel_wrap", {
      effect:'fade',
      autoHeight: true,
      fadeEffect: {
        crossFade: true
      },
      loop: true,
      speed: 600,
      slidesPerView: 1,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
      pagination: {
        el: '#<?php echo 'cb_content_' . $content_count; ?> .dc_image_carousel_pagination',
        clickable: true,
      },
    });
  }

})(jQuery);
<?php
             // コンテンツカルーセル ------------------------
             } elseif ( $content['type'] == 'content_carousel' && $content['show_content'] ) {
?>
(function($) {

  if( $('#<?php echo 'cb_content_' . $content_count; ?> .cb_content_carousel_wrap').length ){
    let cb_content_carousel_wrap<?php echo $content_count; ?> = new Swiper("#<?php echo 'cb_content_' . $content_count; ?> .cb_content_carousel_wrap", {
      slidesPerView: 'auto',
      grabCursor: true,
      resistanceRatio: 0,
      freeMode: {
        enabled: true,
        sticky: true,
        momentumBounce: true,
      },
      navigation: {
        nextEl: "#<?php echo 'cb_content_' . $content_count; ?> .cb_content_carousel_next",
        prevEl: "#<?php echo 'cb_content_' . $content_count; ?> .cb_content_carousel_prev",
      },
      breakpoints: {
        1100: {
          slidesPerView: 2,
          freeMode: {
            enabled: false,
            sticky: true,
            momentumBounce: false,
          }
        }
      },
    });
  }

})(jQuery);
<?php
             // 3カラム ------------------------
             } elseif ( $content['type'] == 'three_column' && $content['show_content'] ) {
?>
(function($) {

  if( $('#<?php echo 'cb_content_' . $content_count; ?> .three_column_carousel_wrap').length ){
    let three_column_carousel_wrap<?php echo $content_count; ?> = new Swiper("#<?php echo 'cb_content_' . $content_count; ?> .three_column_carousel_wrap", {
      slidesPerView: "auto",
      spaceBetween: '2px',
      grabCursor: true,
      resistanceRatio: 0,
      freeMode: {
        enabled: true,
        sticky: true,
        momentumBounce: true,
      },
      navigation: {
        nextEl: "#<?php echo 'cb_content_' . $content_count; ?> .three_column_carousel_next",
        prevEl: "#<?php echo 'cb_content_' . $content_count; ?> .three_column_carousel_prev",
      },
      breakpoints: {
        800: {
          slidesPerView: 3,
          spaceBetween: '3px',
          freeMode: {
            enabled: false,
            sticky: true,
            momentumBounce: false,
          }
        }
      },
    });
  }

})(jQuery);
<?php
             // ブログ一覧 ------------------------
             } elseif ( $content['type'] == 'blog_list' && $content['show_content'] ) {
               $show_category_list = isset($content['show_category_list']) ?  $content['show_category_list'] : 'display';
               $category_list = get_terms( 'category', array( 'hide_empty' => true ) );
               $category_total = count($category_list);
?>
(function($) {

<?php if($show_category_list == 'display' && $category_list && ! is_wp_error( $category_list ) && ($category_total > 1)){ ?>
  if( $('#<?php echo 'cb_content_' . $content_count; ?> .category_sort_button_slider').length ){

    let category_sort_button_slider<?php echo $content_count; ?> = new Swiper("#<?php echo 'cb_content_' . $content_count; ?> .category_sort_button_slider", {
      slidesPerView: 'auto',
      grabCursor: true,
      resistanceRatio: 0,
      observer: true,
      observeParents: true,
      freeMode: {
        enabled: true,
        sticky: true,
        momentumBounce: true,
      },
      navigation: {
        nextEl: "#<?php echo 'cb_content_' . $content_count; ?> .category_sort_button_next",
        prevEl: "#<?php echo 'cb_content_' . $content_count; ?> .category_sort_button_prev",
      },
      breakpoints: {
        1100: {
          slidesPerView: 5,
          freeMode: {
            enabled: false,
            sticky: true,
            momentumBounce: false,
          }
        }
      },
    });

    $('.category_sort_button a').on('click',function(e) {
      e.preventDefault();
      e.stopPropagation();
      $(this).closest('.category_sort_button_wrap').find('.item').removeClass('active_menu');
      $(this).parent().addClass('active_menu');
      var category_id = $(this).data('category-id');
      if(category_id){
        $(this).closest('.main_content').find('.index_post_list').removeClass('active');
        $(this).closest('.main_content').find('.' + category_id).addClass('active');
      }
    });

  };
<?php }; ?>

  if( $('#<?php echo 'cb_content_' . $content_count; ?> .index_post_carousel').length ){
    $('#<?php echo 'cb_content_' . $content_count; ?> .index_post_carousel').each(function(index, element) {
      var $this = $(this);
      var sliderId = $this.data('slider-id');
      new Swiper($this[0], {
        slidesPerView: 'auto',
        spaceBetween: '20px',
        observer: true,
        observeParents: true,
        freeMode: {
          enabled: true,
          sticky: true,
          momentumBounce: true,
        },
        breakpoints: {
          1100: {
            slidesPerView: 3,
            spaceBetween: '35px',
            freeMode: {
              enabled: false,
              sticky: true,
              momentumBounce: false,
            }
          }
        },
        navigation: {
          nextEl: '#<?php echo 'cb_content_' . $content_count; ?> .index_post_carousel_next[data-slider-id="' + sliderId + '"]',
          prevEl: '#<?php echo 'cb_content_' . $content_count; ?> .index_post_carousel_prev[data-slider-id="' + sliderId + '"]',
        },
      });
    });
  };

})(jQuery);
<?php
             // お知らせ ------------------------
             } elseif ( $content['type'] == 'news_list' && $content['show_content'] && $options['use_news']) {
?>
(function($) {

  if( $('#<?php echo 'cb_content_' . $content_count; ?> .cb_news_carousel').length ){
    let cb_news_carousel<?php echo $content_count; ?> = new Swiper("#<?php echo 'cb_content_' . $content_count; ?> .cb_news_carousel", {
      slidesPerView: 'auto',
      grabCursor: true,
      resistanceRatio: 0,
      freeMode: {
        enabled: true,
        sticky: true,
        momentumBounce: true,
      },
      navigation: {
        nextEl: "#<?php echo 'cb_content_' . $content_count; ?> .cb_news_carousel_next",
        prevEl: "#<?php echo 'cb_content_' . $content_count; ?> .cb_news_carousel_prev",
      },
      breakpoints: {
        1100: {
          slidesPerView: 2,
          freeMode: {
            enabled: false,
            sticky: true,
            momentumBounce: false,
          }
        }
      },
    });
  }

})(jQuery);
<?php
             };
             $content_count++;
           endforeach;
         endif; // END コンテンツビルダーここまで

         // ニュースティッカー
         if($options['show_header_news']){
           if($options['header_news_post_type'] == 'post' || ($options['use_news'] && $options['header_news_post_type'] == 'news')){
?>
(function($) {

  if( $('#news_ticker_carousel').length ){
    let news_ticker = new Swiper("#news_ticker_carousel", {
      effect:'fade',
      fadeEffect: {
        crossFade: true
      },
      loop: true,
      slidesPerView: 1,
      speed: 1700,
      autoplay: {
        delay: 5000
      }
    });
  }


})(jQuery);
<?php
           };
         }; // ニュースティッカーここまで

       }; // トップページここまで

       // ブログ詳細ページの関連記事 ------------------------------
       if( is_singular('post') && $options['blog_show_related_post'] ) {
         $item_num = 3;
         if ( ($options['single_blog_show_side_bar'] != 'hide' && is_active_sidebar('post_single_widget')) || ($options['single_blog_show_side_bar'] != 'hide' && is_active_sidebar('common_widget')) ) {
           $item_num = 2;
         }
?>
(function($) {
  if( $('#related_post_carousel').length ){
    let related_post_carousel = new Swiper("#related_post_carousel", {
      slidesPerView: 'auto',
      spaceBetween: '20px',
      freeMode: {
        enabled: true,
        sticky: true,
        momentumBounce: true,
      },
      breakpoints: {
        1100: {
          slidesPerView: <?php echo esc_attr($item_num); ?>,
          spaceBetween: '35px',
          freeMode: {
            enabled: false,
            sticky: true,
            momentumBounce: false,
          }
        }
      },
      navigation: {
        nextEl: ".related_post_next",
        prevEl: ".related_post_prev",
      },
    });
  };
})(jQuery);
<?php
     };

     // ウィジェット --------------------------------------------------
     $widgets = wp_get_sidebars_widgets();
     foreach ($widgets as $sidebar => $widget) :
       foreach ($widget as $widget_instance):
         list($id_base, $instance_id) = explode('-', $widget_instance);
         // お知らせスライダー
         if ($id_base === 'news_slider_widget') {
           if($options['use_news']){
?>
(function($) {

  if( $('#news_slider_widget-<?php echo esc_attr($instance_id); ?> .widget_news_carousel').length ){
    let news_slider_widget_<?php echo esc_attr($instance_id); ?> = new Swiper("#news_slider_widget-<?php echo esc_attr($instance_id); ?> .widget_news_carousel", {
      loop: true,
      speed: 600,
      slidesPerView: 1,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
      pagination: {
        el: '#news_slider_widget-<?php echo esc_attr($instance_id); ?> .widget_news_carousel_pagination',
        clickable: true,
      },
    });
  }


})(jQuery);
<?php
           }
         // 客室スライダー
         } elseif ($id_base === 'gallery_slider_widget') {
           if($options['use_gallery']){
?>
(function($) {

  if( $('#gallery_slider_widget-<?php echo esc_attr($instance_id); ?> .widget_gallery_carousel').length ){
    let gallery_slider_widget_<?php echo esc_attr($instance_id); ?> = new Swiper("#gallery_slider_widget-<?php echo esc_attr($instance_id); ?> .widget_gallery_carousel", {
      effect:'fade',
      fadeEffect: {
        crossFade: true
      },
      loop: true,
      speed: 600,
      slidesPerView: 1,
      autoplay: {
        delay: 5100,
        disableOnInteraction: false,
      },
      pagination: {
        el: '#gallery_slider_widget-<?php echo esc_attr($instance_id); ?> .widget_gallery_carousel_pagination',
        clickable: true,
      },
    });
  }


})(jQuery);
<?php
           }
         // サービススライダー
         } elseif ($id_base === 'service_slider_widget') {
           if($options['use_service']){
?>
(function($) {

  if( $('#service_slider_widget-<?php echo esc_attr($instance_id); ?> .widget_gallery_carousel').length ){
    let service_slider_widget_<?php echo esc_attr($instance_id); ?> = new Swiper("#service_slider_widget-<?php echo esc_attr($instance_id); ?> .widget_gallery_carousel", {
      effect:'fade',
      fadeEffect: {
        crossFade: true
      },
      loop: true,
      speed: 600,
      slidesPerView: 1,
      autoplay: {
        delay: 5200,
        disableOnInteraction: false,
      },
      pagination: {
        el: '#service_slider_widget-<?php echo esc_attr($instance_id); ?> .widget_gallery_carousel_pagination',
        clickable: true,
      },
    });
  }


})(jQuery);
<?php
           }
         }
       endforeach;
     endforeach;

     // ギャラリーカテゴリーページ -----------------------------------------------------------------------------
     if(is_tax('gallery_category')) {
       $query_obj = get_queried_object();
       $current_cat_id = $query_obj->term_id;
       $term_meta = get_option( 'taxonomy_' . $current_cat_id, array() );
       $image_slider = isset($term_meta['gallery_image_slider']) ?  $term_meta['gallery_image_slider'] : '';
       if($image_slider){
         $total_image_num = 0;
         $image_slider = !empty($image_slider) ? explode( ',', $image_slider ) : array();
           foreach( $image_slider as $image_id ):
             $slider_image = wp_get_attachment_image_src( $image_id, 'full' );
              if($slider_image){
                $total_image_num++;
              };
            endforeach;
?>
(function($) {

  if( $('.sc_image_carousel_wrap').length ){
    let sc_image_carousel_nav = new Swiper(".sc_image_carousel_nav", {
      slidesPerView: <?php echo esc_attr($total_image_num); ?>,
      watchSlidesProgress: true,
    });
    let sc_image_carousel_wrap = new Swiper(".sc_image_carousel_wrap", {
      loop: true,
      speed: 600,
      slidesPerView: "auto",
      spaceBetween: '0',
      centeredSlides: true,
      grabCursor: true,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
      thumbs: {
        swiper: sc_image_carousel_nav,
      }
    });
  }

})(jQuery);
<?php
       };
       $show_gallery_plan_list = isset($term_meta['show_gallery_plan_list']) ?  $term_meta['show_gallery_plan_list'] : '';
       if($show_gallery_plan_list == 1){
?>
(function($) {

  if( $('#related_post_carousel').length ){
    let related_post_carousel = new Swiper("#related_post_carousel", {
      slidesPerView: 'auto',
      spaceBetween: '20px',
      freeMode: {
        enabled: true,
        sticky: true,
        momentumBounce: true,
      },
      breakpoints: {
        1100: {
          slidesPerView: 3,
          spaceBetween: '35px',
          freeMode: {
            enabled: false,
            sticky: true,
            momentumBounce: false,
          }
        }
      },
      navigation: {
        nextEl: ".related_post_next",
        prevEl: ".related_post_prev",
      },
    });
  };

})(jQuery);
<?php
       };
     };

     // ギャラリー詳細ページ ------------------------------
     if( is_singular('gallery')) {
       $show_plan_list = get_post_meta($post->ID, 'show_plan_list', true) ?  get_post_meta($post->ID, 'show_plan_list', true) : '';
       if($show_plan_list == 1){
?>
(function($) {

  if( $('#related_post_carousel').length ){
    let related_post_carousel = new Swiper("#related_post_carousel", {
      slidesPerView: 'auto',
      spaceBetween: '20px',
      freeMode: {
        enabled: true,
        sticky: true,
        momentumBounce: true,
      },
      breakpoints: {
        1100: {
          slidesPerView: 3,
          spaceBetween: '35px',
          freeMode: {
            enabled: false,
            sticky: true,
            momentumBounce: false,
          }
        }
      },
      navigation: {
        nextEl: ".related_post_next",
        prevEl: ".related_post_prev",
      },
    });
  };

})(jQuery);
<?php
       };

       if($options['show_recent_gallery']){
?>
(function($) {

  if( $('#recent_gallery_carousel').length ){
    let recent_gallery_carousel = new Swiper("#recent_gallery_carousel", {
      slidesPerView: 'auto',
      spaceBetween: '0px',
      navigation: {
        nextEl: ".recent_gallery_next",
        prevEl: ".recent_gallery_prev",
      },
      breakpoints: {
        600: {
          slidesPerView: 'auto',
          spaceBetween: '20px',
        },
        1100: {
          slidesPerView: 2,
          spaceBetween: '50px',
          freeMode: {
            enabled: false,
            sticky: true,
            momentumBounce: false,
          }
        }
      },
    });
  };

})(jQuery);
<?php
       };
     }

     // サービス詳細ページ ------------------------------
     if( is_singular('service')) {
       $show_plan_list = get_post_meta($post->ID, 'show_plan_list', true) ?  get_post_meta($post->ID, 'show_plan_list', true) : '';
       if($show_plan_list == 1){
?>
(function($) {

  if( $('#related_post_carousel').length ){
    let related_post_carousel = new Swiper("#related_post_carousel", {
      slidesPerView: 'auto',
      spaceBetween: '20px',
      freeMode: {
        enabled: true,
        sticky: true,
        momentumBounce: true,
      },
      breakpoints: {
        1100: {
          slidesPerView: 3,
          spaceBetween: '35px',
          freeMode: {
            enabled: false,
            sticky: true,
            momentumBounce: false,
          }
        }
      },
      navigation: {
        nextEl: ".related_post_next",
        prevEl: ".related_post_prev",
      },
    });
  };

})(jQuery);
<?php
       }
     }

     // ブログアーカイブ・お知らせアーカイブ -----------------------------------------------------------------------------
     if(!is_front_page() && is_home() || is_category() || is_post_type_archive('news') || is_tax('news_category')) {
       $display_category_list = false;
       if( !is_front_page() && is_home() || is_category() ){
         if($options['archive_blog_show_category_list'] == 'display'){
           $display_category_list = true;
         }
       }
       if( is_post_type_archive('news') || is_tax('news_category') ){
         if($options['archive_news_show_category_list'] == 'display'){
           $display_category_list = true;
         }
       }
       if($display_category_list == true){
?>
(function($) {

  if( $('.category_sort_button_slider').length ){
    let category_sort_button_slider = new Swiper(".category_sort_button_slider", {
      slidesPerView: 'auto',
      grabCursor: true,
      resistanceRatio: 0,
      freeMode: {
        enabled: true,
        sticky: true,
        momentumBounce: true,
      },
      navigation: {
        nextEl: ".category_sort_button_next",
        prevEl: ".category_sort_button_prev",
      },
      breakpoints: {
        1100: {
          slidesPerView: 5,
          freeMode: {
            enabled: false,
            sticky: true,
            momentumBounce: false,
          }
        }
      },
    });
  };

  document.addEventListener("DOMContentLoaded", function() {
    if (window.location.hash) {
      var target = document.getElementById(window.location.hash.substring(1));
      if (target) {
        target.scrollIntoView({ behavior: "instant" });
      }
    }
  });

})(jQuery);

<?php
       };
     };

     // 固定ページ ------------------------------
     if( is_page() && get_post_meta($post->ID, 'hide_plan_list', true) != 'yes') {
?>
(function($) {

  if( $('#related_post_carousel').length ){
    let related_post_carousel = new Swiper("#related_post_carousel", {
      slidesPerView: 'auto',
      spaceBetween: '20px',
      freeMode: {
        enabled: true,
        sticky: true,
        momentumBounce: true,
      },
      breakpoints: {
        1100: {
          slidesPerView: 3,
          spaceBetween: '35px',
          freeMode: {
            enabled: false,
            sticky: true,
            momentumBounce: false,
          }
        }
      },
      navigation: {
        nextEl: ".related_post_next",
        prevEl: ".related_post_prev",
      },
    });
  };

})(jQuery);
<?php
     }

     }; // END footer common script

     //  ブラウザのスクロールに合わせたアニメーション -----------------------
     function inview_animaton(){
       global $post;
?>

  const targets = document.querySelectorAll('.inview');
  const options = {
    root: null,
    rootMargin: '-100px 0px',
    threshold: 0
  };
  const observer = new IntersectionObserver(intersect, options);
  targets.forEach(target => {
    observer.observe(target);
  });
  function intersect(entries) {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        $(entry.target).addClass('animate');
        observer.unobserve(entry.target);
      }
    });
  }


  const group_targets = document.querySelectorAll('.inview_group');
  const group_options = {
    root: null,
    rootMargin: '-100px 0px',
    threshold: 0
  };
  const group_observer = new IntersectionObserver(group_intersect, group_options);
  group_targets.forEach(target => {
    group_observer.observe(target);
  });
  function group_intersect(entries) {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        $(entry.target).addClass('animate');
        group_observer.unobserve(entry.target);
      }
    });
  }

<?php
     };

     // ロード画面を表示する場合 -----------------------------------------------------------------
     function show_loading_screen(){
       $options = get_design_plus_option();
?>
<script>

<?php footer_common_script(); ?>

function after_load() {
  (function($) {

  $('body').addClass('end_loading');

  setTimeout(function(){
    $('body').addClass('start_first_animation');
    <?php inview_animaton(); ?>
  }, 700);

  <?php
       // トップページのヘッダーコンテンツ -----------------------------------
       if(is_front_page()) {
         if($options['show_header_content']){
  ?>
  setTimeout(function(){
    window.dispatchEvent(new Event('initHeaderSlider'));
  }, 700);
  <?php
         };
       };
  ?>

  })( jQuery );
}

(function($) {

  <?php if ( $options['loading_display_time'] == 'type1' && !isset($_COOKIE['first_visit']) ) { ?>
  $.cookie('first_visit', 'on', {
    path:'/'
  });
  <?php }; ?>

  $('#site_loader_overlay').addClass('start_loading');

  <?php if ($options['loading_type'] == 'type5') { ?>

  $('#site_loader_overlay_for_catchphrase').addClass('start_loading');

  setTimeout(function(){
    $('#loader_catch').addClass('animate');
  }, 200);

  setTimeout(function(){
    $('#site_loader_overlay_for_catchphrase').addClass('active');
    $('#site_loader_overlay').addClass('active');
  }, 2000);
  setTimeout(function(){
    after_load();
  }, 5000);

  <?php } else { ?>

  setTimeout(function(){
    after_load();
  }, <?php echo esc_attr($options['loading_time']); ?>);

  <?php }; ?>

})( jQuery );

</script>
<?php
     };

     // ロード画面を表示しない場合 ------------------------------------------------------------------------------------------------------------------
     function no_loading_screen(){
       $options = get_design_plus_option();
?>
<script>

<?php footer_common_script(); ?>

(function($) {

  jQuery(document).ready(function($){
    $('body').addClass('start_first_animation');
    <?php inview_animaton(); ?>
  });

  <?php
       // トップページのヘッダーコンテンツ -----------------------------------
       if(is_front_page()) {
         if($options['show_header_content']){
  ?>
  window.dispatchEvent(new Event('initHeaderSlider'));
  <?php
         };
       };
  ?>

})( jQuery );

</script>
<?php } ?>