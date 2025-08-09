(function($) {


  var $window = $(window);
  var $body = $('body');


  // メガメニュー -------------------------------------------------
  $('a.megamenu_button').parent().addClass('megamenu_parent');

  // mega menu basic animation
  $('[data-megamenu]').each(function() {

    var mega_menu_button = $(this);
    var sub_menu_wrap =  "#" + $(this).data("megamenu");
    var hide_sub_menu_timer;
    var hide_sub_menu_interval = function() {
      if (hide_sub_menu_timer) {
        clearInterval(hide_sub_menu_timer);
        hide_sub_menu_timer = null;
      }
      hide_sub_menu_timer = setInterval(function() {
        if (!$(mega_menu_button).is(':hover') && !$(sub_menu_wrap).is(':hover')) {
          $(sub_menu_wrap).stop().removeClass('active_mega_menu');
          if (!$('#global_menu li').hasClass('active') && !$('#global_menu li').hasClass('active_megamenu_button')) {
            $body.removeClass('active_header');
          }
          clearInterval(hide_sub_menu_timer);
          hide_sub_menu_timer = null;
        }
      }, 20);
    };

    mega_menu_button.hover(
     function(){
       if (hide_sub_menu_timer) {
         clearInterval(hide_sub_menu_timer);
         hide_sub_menu_timer = null;
       }
       $(this).parent().addClass('active_megamenu_button');
       $(this).parent().find("ul").addClass('megamenu_child_menu');
       $(sub_menu_wrap).stop().addClass('active_mega_menu');
       $body.addClass('active_header');
     },
     function(){
       $(this).parent().removeClass('active_megamenu_button');
       $(this).parent().find("ul").removeClass('megamenu_child_menu');
       $body.removeClass('active_header');
       hide_sub_menu_interval();
     }
    );

    $(sub_menu_wrap).hover(
      function(){
        $(mega_menu_button).parent().addClass('active_megamenu_button');
        $body.addClass('active_header');
      },
      function(){
        $(mega_menu_button).parent().removeClass('active_megamenu_button');
        $body.removeClass('active_header');
      }
    );


    $('#header').on('mouseout', sub_menu_wrap, function(){
      hide_sub_menu_interval();
    });

  }); // メガメニューここまで


  // グローバルメニュー
  $("#global_menu > ul > li:not(.megamenu_parent)").hover(function(){
    $(">ul:not(:animated)",this).slideDown("fast");
    $(this).addClass("active");
  }, function(){
    $(">ul",this).slideUp("fast");
    $(this).removeClass("active");
  });
  $("#global_menu > ul > li.menu-item-has-children").hover(function(){
    $body.addClass('active_header');
  }, function(){
    $body.removeClass('active_header');
  });


  // 言語ボタン
  if ($('#lang_button').length) {
    var child1Width = $('#lang_button .active_menu').outerWidth();
    var child2Width = $('#lang_button .sub_menu').outerWidth();
    var maxWidth = Math.max(child1Width, child2Width);
    $('#lang_button .active_menu').css('width', maxWidth + 'px');
    $('#lang_button .sub_menu').css('width', maxWidth + 'px');
    $("#lang_button").hover(function(){
      $("#lang_button .sub_menu:not(:animated)").slideDown("fast");
    }, function(){
      $("#lang_button .sub_menu").slideUp("fast");
    });
  }

  // 画面上部からスクロールが開始された時にbodyにstart_scrollを付ける
  let screen_scroll_observer = new IntersectionObserver((entries) => {
    if(entries[0].boundingClientRect.y < 0) {
      document.body.classList.add('start_scroll');
    } else {
      document.body.classList.remove('start_scroll');
    }
  }, {threshold: [0]});
  screen_scroll_observer.observe(document.querySelector('#js-body-start'));


  // 固定ヘッダーのスライドアニメーション
  if ($('#header').length) {
    // ページが読み込まれた際にスクロール位置を判定
    var first_scroll_position = false;
    window.addEventListener('load', function() {
      if (window.scrollY >= 300) {
        first_scroll_position = true;
        $('#header').css('animation', 'none');
      }
    });
    let lastScrollTop = 0;
    $(window).on('scroll', function() {
      let scrollTop = $(this).scrollTop();
      if (scrollTop > lastScrollTop) {
        // スクロールダウン
        if (scrollTop > 300) {
          $('body').addClass('header_fix');
          if(first_scroll_position == false){
            $('#header').css('animation', 'header_animation 0.3s ease forwards');
          }
        }
      } else {
        // スクロールアップ
        if (scrollTop <= 500 && scrollTop > 300) {
          $('#header').css('animation', 'header_animation_reverse 0.3s ease forwards');
          first_scroll_position = false;
        } else if (scrollTop <= 300) {
          $('body').removeClass('header_fix');
          $('#header').css('animation', '');
        }
      }
      lastScrollTop = scrollTop <= 0 ? 0 : scrollTop; // For Mobile or negative scrolling
    });
  }


  // サイドボタン
  if ($('#return_top').length) {
    const $returnTop = $('#return_top');
    const offset = -100;
    $(window).on('scroll', function() {
      const rect = $returnTop[0].getBoundingClientRect();
      if (rect.top <= window.innerHeight - offset) {
        $('body').addClass('hide_side_icon_button');
      } else {
        $('body').removeClass('hide_side_icon_button');
      }
    });
  }


  // ヘッダーの検索フォーム
  $("#header_search").hover(function(){
    $('#header_search .input_area input').focus();
  });
  $('#header_search .input_area input').on('input', function() {
    if ($(this).val().trim() !== '') {
      $('#header_search').addClass('active');
      $('html').addClass('non_scroll_padding');
    } else {
      $('#header_search').removeClass('active');
      $('html').removeClass('non_scroll_padding');
    }
  });


  // コメントタブ
  $("#comment_tab li").click(function() {
    $("#comment_tab li").removeClass('active');
    $(this).addClass("active");
    $(".tab_contents").hide();
    var selected_tab = $(this).find("a").attr("href");
    $(selected_tab).fadeIn();
    return false;
  });


  // デザインセレクトボックス
  $(".design_select_box select").on("click" , function() {
    $(this).closest('.design_select_box').toggleClass("open");
  });
  $(document).mouseup(function (e){
    var container = $(".design_select_box");
    if (container.has(e.target).length === 0) {
      container.removeClass("open");
    }
  });


  // アーカイブウィジェット　ドロップダウン
  if ($('.p-dropdown').length) {
    $('.p-dropdown__title').click(function() {
      $(this).toggleClass('is-active');
      $('+ .p-dropdown__list:not(:animated)', this).slideToggle();
    });
  }


  // カテゴリーウィジェット
  $(".tcd_category_list li:has(ul)").addClass('parent_menu');
  $(".tcd_category_list li.parent_menu > a").parent().prepend("<span class='child_menu_button'></span>");
  $(".tcd_category_list li .child_menu_button").on('click',function() {
     if($(this).parent().hasClass("open")) {
       $(this).parent().removeClass("active");
       $(this).parent().removeClass("open");
       $(this).parent().find('>ul:not(:animated)').slideUp("fast");
       return false;
     } else {
       $(this).parent().addClass("active");
       $(this).parent().addClass("open");
       $(this).parent().find('>ul:not(:animated)').slideDown("fast");
       return false;
     };
  });


  // 検索ウィジェット
  $('.widget_search #searchsubmit').wrap('<div class="submit_button"></div>');
  $('.google_search #searchsubmit').wrap('<div class="submit_button"></div>');


  // タブ記事ウィジェット
  $('.widget_tab_post_list_button').on('click', '.tab1', function(){
    $(this).siblings().removeClass('active');
    $(this).addClass('active');
    $(this).closest('.tab_post_list_widget').find('.widget_tab_post_list1').addClass('active');
    $(this).closest('.tab_post_list_widget').find('.widget_tab_post_list2').removeClass('active');
    $(this).closest('.tab_post_list_widget').find('.widget_tab_post_list3').removeClass('active');
    return false;
  });
  $('.widget_tab_post_list_button').on('click', '.tab2', function(){
    $(this).siblings().removeClass('active');
    $(this).addClass('active');
    $(this).closest('.tab_post_list_widget').find('.widget_tab_post_list1').removeClass('active');
    $(this).closest('.tab_post_list_widget').find('.widget_tab_post_list2').addClass('active');
    $(this).closest('.tab_post_list_widget').find('.widget_tab_post_list3').removeClass('active');
    return false;
  });
  $('.widget_tab_post_list_button').on('click', '.tab3', function(){
    $(this).siblings().removeClass('active');
    $(this).addClass('active');
    $(this).closest('.tab_post_list_widget').find('.widget_tab_post_list1').removeClass('active');
    $(this).closest('.tab_post_list_widget').find('.widget_tab_post_list2').removeClass('active');
    $(this).closest('.tab_post_list_widget').find('.widget_tab_post_list3').addClass('active');
    return false;
  });


  // カレンダーウィジェット
  $('.wp-calendar-table td').each(function () {
    if ( $(this).children().length == 0 ) {
      $(this).addClass('no_link');
      $(this).wrapInner('<span></span>');
    } else {
      $(this).addClass('has_link');
    }
  });


  // FAQリスト　ショートコード
  $('.faq_list .title').on('click', function() {
    var desc = $(this).next('.desc_area');
    var acc_height = desc.find('.desc').outerHeight(true);
    if($(this).hasClass('active')){
      desc.css('height', '');
      $(this).removeClass('active');
    }else{
      desc.css('height', acc_height);
      $(this).addClass('active');
    }
  });


  // タブコンテンツ　ショートコード
  $(".qt_tab_content_header .item").on('click',function() {
    $(this).siblings().removeClass('active');
    $(this).addClass('active');
    var target_content = $(this).data('tab-target');
    $(this).closest('.qt_tab_content_wrap').find(".qt_tab_content").removeClass('active');
    $(this).closest('.qt_tab_content_wrap').find(target_content).addClass('active');
    return false;
  });


  // クイックタグ - underline ------------------------------------------
  if ($('.q_underline').length) {
    var gradient_prefix = null;

    $('.q_underline').each(function(){
      var bbc = $(this).css('borderBottomColor');
      if (jQuery.inArray(bbc, ['transparent', 'rgba(0, 0, 0, 0)']) == -1) {
        if (gradient_prefix === null) {
          gradient_prefix = '';
          var ua = navigator.userAgent.toLowerCase();
          if (/webkit/.test(ua)) {
            gradient_prefix = '-webkit-';
          } else if (/firefox/.test(ua)) {
            gradient_prefix = '-moz-';
          } else {
            gradient_prefix = '';
          }
        }
        $(this).css('borderBottomColor', 'transparent');
        if (gradient_prefix) {
          $(this).css('backgroundImage', gradient_prefix+'linear-gradient(left, transparent 50%, '+bbc+ ' 50%)');
        } else {
          $(this).css('backgroundImage', 'linear-gradient(to right, transparent 50%, '+bbc+ ' 50%)');
        }
      }
    });

    $window.on('scroll.q_underline', function(){
      $('.q_underline:not(.is-active)').each(function(){
        if ($body.hasClass('show-serumtal')) {
          var left = $(this).offset().left;
          if (window.scrollX > left - window.innerHeight) {
            $(this).addClass('is-active');
          }
        } else {
          var top = $(this).offset().top;
          if (window.scrollY > top - window.innerHeight) {
            $(this).addClass('is-active');
          }
        }
      });
      if (!$('.q_underline:not(.is-active)').length) {
        $window.off('scroll.q_underline');
      }
    });
  }


// レスポンシブ ------------------------------------------------------------------------
const mql = window.matchMedia('screen and (min-width: 1300px)');
const checkBreakPoint = (event) => {

  if (event.matches) { // PC

    $("html").removeClass("mobile");
    $("html").addClass("pc");

  } else { // スマホ

    $("html").removeClass("pc");
    $("html").addClass("mobile");

    // ドロワーメニュー内の子メニューに開閉ボタンを追加
    $("#mobile_menu .child_menu_button").remove();
    $('#mobile_menu li > ul').parent().prepend("<span class='child_menu_button'><span class='icon'></span></span>");
    $("#mobile_menu .child_menu_button").on('click',function() {
      if($(this).parent().hasClass("open")) {
        $(this).parent().removeClass("open");
        var parent_menu = $(this).parent().find('>ul:not(:animated)');
        parent_menu.slideUp("fast");
        $('li',parent_menu).removeClass('animate');
        return false;
      } else {
        $(this).parent().addClass("open");
        var parent_menu = $(this).parent().find('>ul:not(:animated)');
        parent_menu.slideDown("fast");
        $('li',parent_menu).each(function(i){
          $(this).delay(i *100).queue(function(next) {
            $(this).addClass('animate');
            next();
          });
        });
        return false;
      };
    });

    // ドロワーメニューの開閉ボタン
    var menu_button = $('#drawer_menu_button');
    menu_button.off();
    menu_button.toggleClass("active",false);
    var scrollTop;

    // ドロワーメニューを開く
    menu_button.on('click', function(e) {
      e.preventDefault();
      e.stopPropagation();
      $('body').toggleClass('open_drawer_menu');
      $('#drawer_menu_overlay').one('click', function(e){
        if($('body').hasClass('open_drawer_menu')){
          $('body').removeClass('open_drawer_menu');
          return false;
        };
      });
    });

    // ドロワーメニューを閉じる
    $("#drawer_mneu_close_button").off();
    $("#drawer_mneu_close_button").on('click',function() {
      $('body').toggleClass("open_drawer_menu");
      return false;
    });

    // フッターバー
    var footerBar = $("#js-footer-bar");
    if( footerBar.length == 0 ) return;

    footerBar.find( '.js-footer-bar-share, #js-footer-bar-modal-overlay' ).on('click', function(e) {
      e.preventDefault();
      footerBar.find('#js-footer-bar-modal').toggleClass('is-active');		
      return false;
    });
    footerBar.find('#js-footer-bar-modal').on('touchmove', function(e) {
      e.preventDefault();
    });

    (new IntersectionObserver(function (entries) {
      if( entries[0].isIntersecting ){
        footerBar[0].classList.remove('is-active');
      } else {
        footerBar[0].classList.add('is-active');
      }
    })).observe(document.getElementById('js-body-start'));

  };

};
mql.addEventListener("change", checkBreakPoint);
checkBreakPoint(mql);


})(jQuery);