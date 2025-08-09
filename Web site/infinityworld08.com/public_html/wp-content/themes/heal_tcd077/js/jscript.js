jQuery(document).ready(function($){

  var $window = $(window);

      // inner link ---------------------------------
  $(':is(.post_content, .p-toc) a[href*=#]').click(function() {
    var speed = 1000,
        href = $(this).prop("href"),
        hrefPageUrl = href.split("#")[0],
        currentUrl = location.href,
        currentUrl = currentUrl.split("#")[0];
    if(hrefPageUrl == currentUrl){
      href = href.split("#");
      href = href.pop();
      href = "#" + href;
      var target = $(href == "#" || href == "" ? 'html' : href);
      if( target.length ){
        var position = target.offset().top - 30,
            body = 'html',
            userAgent = window.navigator.userAgent.toLowerCase(),
            header_height = $('html.pc .use_header_fix #header, html.mobile .use_mobile_header_fix #header').innerHeight() || 0;
        $(body).animate({ scrollTop: position - header_height }, speed, 'easeOutExpo');
      }
      return false;
    }
  });

  // mega menu -------------------------------------------------

  // mega menu post list animation
  $(document).on({mouseenter : function(){
    $(this).parent().siblings().removeClass('active')
    $(this).parent().addClass('active');
    var $content_id = "." + $(this).attr('class');
    $(".megamenu_blog_list .post_list").hide();
    $($content_id).show();
    return false;
  }}, '.megamenu_blog_list .menu_area a');

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
          $(sub_menu_wrap).stop().css('z-index','100').hide();
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
       if ($('html').hasClass('pc')) {
         $(this).parent().addClass('active_button');
         $(this).parent().find("ul").addClass('megamenu_child_menu');
         $(sub_menu_wrap).stop().css('z-index','200').show();
       }
     },
     function(){
       if ($('html').hasClass('pc')) {
         $(this).parent().removeClass('active_button');
         $(this).parent().find("ul").removeClass('megamenu_child_menu');
         hide_sub_menu_interval();
       }
     }
    );

    $(sub_menu_wrap).hover(
     function(){
      $(mega_menu_button).parent().addClass('active_button');
     },
     function(){
      $(mega_menu_button).parent().removeClass('active_button');
     }
    );


    $('#header').on('mouseout', sub_menu_wrap, function(){
     if ($('html').hasClass('pc')) {
       hide_sub_menu_interval();
     }
    });

  }); // end mega menu


  $("a").bind("focus",function(){if(this.blur)this.blur();});
  $("a.target_blank").attr("target","_blank");


  //return top button
  var return_top_button = $('#return_top');
  $('a',return_top_button).click(function() {
    var myHref= $(this).attr("href");
    var myPos = $(myHref).offset().top;
    $("html,body").animate({scrollTop : myPos}, 1000, 'easeOutExpo');
    return false;
  });


  //fixed footer content
  var fixedFooter = $('#fixed_footer_content');
  fixedFooter.removeClass('active');
  $(window).scroll(function () {
    if ($(this).scrollTop() > 330) {
      fixedFooter.addClass('active');
    } else {
      fixedFooter.removeClass('active');
    }
  });
  $('#fixed_footer_content .close').click(function() {
    $("#fixed_footer_content").hide();
    return false;
  });


  // comment button
  $("#comment_tab li").click(function() {
    $("#comment_tab li").removeClass('active');
    $(this).addClass("active");
    $(".tab_contents").hide();
    var selected_tab = $(this).find("a").attr("href");
    $(selected_tab).fadeIn();
    return false;
  });


  //category widget
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


  //custom drop menu widget
  $(".tcdw_custom_drop_menu li:has(ul)").addClass('parent_menu');
  $(".tcdw_custom_drop_menu li").hover(function(){
     $(">ul:not(:animated)",this).slideDown("fast");
     $(this).addClass("active");
  }, function(){
     $(">ul",this).slideUp("fast");
     $(this).removeClass("active");
  });


  //archive list widget
  if ($('.p-dropdown').length) {
    $('.p-dropdown__title').click(function() {
      $(this).toggleClass('is-active');
      $('+ .p-dropdown__list:not(:animated)', this).slideToggle();
    });
  }


  //search widget
  $('.widget_search #searchsubmit').wrap('<div class="submit_button"></div>');
  $('.google_search #searchsubmit').wrap('<div class="submit_button"></div>');


  //tab post list widget
  $('.widget_tab_post_list_button').on('click', 'a.tab1', function(){
    $(this).parents('.widget_tab_post_list_button').children('a.tab2').removeClass('active');
    $(this).addClass('active');
    $(this).parents('.widget_tab_post_list_button').next().show();
    $(this).parents('.widget_tab_post_list_button').next().next().hide();
    return false;
  });
  $('.widget_tab_post_list_button').on('click', 'a.tab2', function(){
    $(this).parents('.widget_tab_post_list_button').children('a.tab1').removeClass('active');
    $(this).addClass('active');
    $(this).parents('.widget_tab_post_list_button').next().hide();
    $(this).parents('.widget_tab_post_list_button').next().next().show();
    return false;
  });


  // search form
  $("#header_search_button").on('click',function() {
    if($('#header_search').hasClass("open")) {
      $('#header_search').removeClass("open");
      $(this).removeClass("active");
      $('#header_search:not(:animated)').slideUp("fast");
      return false;
    } else {
      $('#header_search').addClass("open");
      $(this).addClass("active");
      $('#header_search:not(:animated)').slideDown("fast");
      return false;
    };
  });


  //calendar widget
  $('.wp-calendar-table td').each(function () {
    if ( $(this).children().length == 0 ) {
      $(this).addClass('no_link');
      $(this).wrapInner('<span></span>');
    } else {
      $(this).addClass('has_link');
    }
  });

// テキストウィジェットとHTMLウィジェットにエディターのクラスを追加する
$('.widget_text .textwidget').addClass('post_content');

// アーカイブとカテゴリーのセレクトボックスにselect_wrapのクラスを追加する
  $('.widget_archive select').wrap('<div class="select_wrap"></div>');
  $('.widget_categories form').wrap('<div class="select_wrap"></div>');


  // schedule list ajax --------------------------------------------------
  if ($('#schedule_list').length) {
    var $schedule_list;
    var schedule_mobile_offset = 0;
    var switch_schedule_mobile = function( offset ) {
      var $offset_dates = $schedule_list.find('#schedule_list_header > .item');
      $schedule_list.find('#schedule_list_headline_mobile .date').text($offset_dates.eq(offset).attr('data-mobile'));

      $schedule_list.find('.author_data').each(function(){
        var $item_mobile = $(this).find('.item_mobile').removeAttr('style');
        var $date_item = $(this).find('.item:not(.item_author)').eq(offset);
        var date_item_style = $date_item.attr('style');
        var bg_color = date_item_style ? date_item_style.match(/background\-color\: ?([^;]+);?$/) : null;
        if ($date_item.hasClass('empty')) {
          $item_mobile.addClass('empty');
        } else {
          $item_mobile.removeClass('empty');
          if (bg_color) {
            $item_mobile.css('backgroundColor', bg_color[1]);
          }
        }
        $item_mobile.html($date_item.html());
      });
    };

    $('#schedule_list').on('click', '.prev, .next', function(){
      $schedule_list = $(this).closest('#schedule_list');
      if ($schedule_list.hasClass('is-ajaxing')) return false;

      var is_schedule_mobile = $(this).closest('#schedule_list_headline_mobile').length;
      var is_schedule_mobile_prev = false;
      if ( is_schedule_mobile ) {
        var offset_length = $schedule_list.find('#schedule_list_header > .item').length;

        if ($(this).hasClass('prev')) {
          schedule_mobile_offset--;
          is_schedule_mobile_prev = true;
        } else {
          schedule_mobile_offset++;
        }

        // PCでの表示日付内ならモバイル表示内容を差し替え
        if (schedule_mobile_offset >= 0 && schedule_mobile_offset < offset_length) {
          switch_schedule_mobile( schedule_mobile_offset );
          return false;
        }
      }

      // Ajax
      $schedule_list.addClass('is-ajaxing');
      $.ajax({
        url: this.href,
        type: 'GET',
        complete: function() {
          $schedule_list.removeClass('is-ajaxing');
        },
        success: function(html) {
          var $data = $($.parseHTML(html));
          $schedule_list.html($data.find('#schedule_list').html());

          if (window.lazyLoadInstance) {
            lazyLoadInstance.update();
          }

          // mobile offset
          if (is_schedule_mobile_prev) {
            schedule_mobile_offset = $schedule_list.find('#schedule_list_header > .item').length - 1;
            switch_schedule_mobile( schedule_mobile_offset );
          } else {
            schedule_mobile_offset = 0;
          }
        }
      });

      return false;
    });
  }

// responsive ------------------------------------------------------------------------
var mql = window.matchMedia('screen and (min-width: 1151px)');
function checkBreakPoint(mql) {

 if(mql.matches){ //PC

   $("html").removeClass("mobile");
   $("html").addClass("pc");

   $("#menu_button").css("display","none");

   var parent_menu_pos = $("#global_menu > ul").offset();
   parent_menu_position_length = parent_menu_pos.left + 1000;
   parent_menu_position_length2 = parent_menu_pos.left + 780;
   var child_menu_pos = '';
   var child_menu_position_length = '';

   $('a.megamenu_button').parent().addClass('megamenu_parent');

   $("#global_menu li:not(.megamenu_parent)").hover(function(){
     $(">ul:not(:animated)",this).slideDown("fast");
     $(this).addClass("active");
     child_menu_pos = $(">ul",this).offset();
     if(child_menu_pos) {
       child_menu_position_length = child_menu_pos.left + 220;
       if(child_menu_position_length > parent_menu_position_length){
         $(this).addClass("type2");
       }
       if(child_menu_position_length > parent_menu_position_length2){
         $('li.menu-item-has-children',this).addClass("type2");
       }
     }
   }, function(){
     $(">ul",this).slideUp("fast");
     $(this).removeClass("active");
   });

 } else { //smart phone

   $("html").removeClass("pc");
   $("html").addClass("mobile");

   $("#header").removeClass("animate");
   $("#header").removeClass("animate2");

   // perfect scroll
   if ($('#drawer_menu').length) {
     if(! $(body).hasClass('mobile_device') ) {
       new SimpleBar($('#drawer_menu')[0]);
     };
   };

   // side menu
   $("#mobile_menu .child_menu_button").remove();
   $('#mobile_menu li > ul').parent().prepend("<span class='child_menu_button'><span class='icon'></span></span>");
   $("#mobile_menu .child_menu_button").on('click',function() {
     if($(this).parent().hasClass("open")) {
       $(this).parent().removeClass("open");
       $(this).parent().find('>ul:not(:animated)').slideUp("fast");
       return false;
     } else {
       $(this).parent().addClass("open");
       $(this).parent().find('>ul:not(:animated)').slideDown("fast");
       return false;
     };
   });

   // drawer menu button
   var menu_button = $('#menu_button');
   menu_button.off();
   menu_button.removeAttr('style');
   menu_button.toggleClass("active",false);

  // open drawer menu
   menu_button.on('click', function(e) {

      e.preventDefault();
      e.stopPropagation();
      $('html').toggleClass('open_menu');

      // fix position for ios
      var topPosition = $(window).scrollTop();
      $('body').css({'position':'fixed','top': - topPosition});

      $('#container').one('click', function(e){
        if($('html').hasClass('open_menu')){
          $('html').removeClass('open_menu');

          // clear fix position for ios
          $('body').css({'position':'','top': ''});
          $(window).scrollTop(topPosition);

          return false;
        };
      });

   });
   
   // ページ内リンクをクリックしたらメニューを閉じる
$('#drawer_menu li a[href*="#"]').on('click', function () {
  if ($('html').hasClass('open_menu')) {
      $('html').removeClass('open_menu');

      // clear fix position for ios
      var topPosition = -parseInt($('body').css('top'), 10) || 0;
      $('body').css({ 'position': '', 'top': '' });
      $(window).scrollTop(topPosition);
  }
});
 };
};
mql.addListener(checkBreakPoint);
checkBreakPoint(mql);

 // ページ内リンクのスムーススクロール
$('#drawer_menu li a[href*="#"],#global_menu li a[href*="#"]').on('click', function () {
  var target = $(this.hash);
  $('html, body').animate({
      scrollTop: target.offset().top-60
  }, 500, function() {
      var scrollPosition = $(document).scrollTop();
      console.log('スクロール位置: ' + scrollPosition);
  });
});

});