jQuery(document).ready(function($) {

  if($('body').hasClass('widgets-php')) {

    var current_item;
    var target_id;
    $(document).on('click', '.tcd_widget_tab_content_headline', function(){
      $(this).toggleClass('active');
      $(this).next('.tcd_widget_tab_content').toggleClass('open');
    });


    // マテリアルアイコン
    $(document).on('change', '.footer_bar_icon_type input', function(event){
      var radioval = $(this).val();
      if (radioval == 'material_icon') {
        $(this).closest('.footer_bar_icon_option').find('.material_icon_option').show();
      } else {
        $(this).closest('.footer_bar_icon_option').find('.material_icon_option').hide();
      }
    });
    $('.material_icon input').each(function(){
      if ($(this).prop("checked")) {
        $(this).closest('.footer_bar_icon_option').find('.material_icon_option').show();
      } else {
        $(this).closest('.footer_bar_icon_option').find('.material_icon_option').hide();
      }
    });


    // 電話番号のチェックボックス
    function change_telephone_input(checkbox) {
      if($(checkbox).is(':checked')) {
        $(checkbox).closest('.tcd_widget_tab_content').find('.button_type_normal').hide();
        $(checkbox).closest('.tcd_widget_tab_content').find('.button_type_tel').show();
      } else {
        $(checkbox).closest('.tcd_widget_tab_content').find('.button_type_normal').show();
        $(checkbox).closest('.tcd_widget_tab_content').find('.button_type_tel').hide();
      }
    }
    $('.tel_checkbox').each(function() {
      change_telephone_input(this);
    });
    $(document).on('change', '.tel_checkbox', function(){
      change_telephone_input(this);
    });
    $(document).on( 'widget-added widget-updated', function(event, widget) {
      $(widget).find('.tel_checkbox').each(function() {
        change_telephone_input(this);
      });
    });


    // お知らせスライダー コンテンツタイプselectボックス
    function news_slider_content_type(select) {
      if ( $(select).val() == 'post' ) {
        $(select).closest('.widget-content').find('.normal_post_order1').show();
        $(select).closest('.widget-content').find('.normal_post_order2').hide();
        $(select).closest('.widget-content').find('.news_category_wrap').hide();
        $(select).closest('.widget-content').find('.display_setting_option').show();
        $(select).closest('.widget-content').find('.news_slider_post_type_wrap1').show();
        $(select).closest('.widget-content').find('.news_slider_post_type_wrap2').hide();
        if($(select).closest('.widget-content').find('.news_slider_post_type1').val() == 'custom_post'){
          $(select).closest('.widget-content').find('.news_slider_post_num_wrap').hide();
          $(select).closest('.widget-content').find('.normal_post_order1').hide();
          $(select).closest('.widget-content').find('.custom_post_order').show();
          $(select).closest('.widget-content').find('.blog_category_wrap').hide();
        } else if($(select).closest('.widget-content').find('.news_slider_post_type1').val() == 'category_post'){
          $(select).closest('.widget-content').find('.news_slider_post_num_wrap').show();
          $(select).closest('.widget-content').find('.normal_post_order1').show();
          $(select).closest('.widget-content').find('.custom_post_order').hide();
          $(select).closest('.widget-content').find('.blog_category_wrap').show();
        } else {
          $(select).closest('.widget-content').find('.news_slider_post_num_wrap').show();
          $(select).closest('.widget-content').find('.normal_post_order1').show();
          $(select).closest('.widget-content').find('.custom_post_order').hide();
          $(select).closest('.widget-content').find('.blog_category_wrap').hide();
        }
      } else {
        $(select).closest('.widget-content').find('.normal_post_order1').show();
        $(select).closest('.widget-content').find('.normal_post_order2').hide();
        $(select).closest('.widget-content').find('.blog_category_wrap').hide();
        $(select).closest('.widget-content').find('.display_setting_option').show();
        $(select).closest('.widget-content').find('.news_slider_post_type_wrap1').show();
        $(select).closest('.widget-content').find('.news_slider_post_type_wrap2').hide();
        if($(select).closest('.widget-content').find('.news_slider_post_type1').val() == 'custom_post'){
          $(select).closest('.widget-content').find('.news_slider_post_num_wrap').hide();
          $(select).closest('.widget-content').find('.normal_post_order1').hide();
          $(select).closest('.widget-content').find('.custom_post_order').show();
          $(select).closest('.widget-content').find('.news_category_wrap').hide();
        } else if($(select).closest('.widget-content').find('.news_slider_post_type1').val() == 'category_post'){
          $(select).closest('.widget-content').find('.news_slider_post_num_wrap').show();
          $(select).closest('.widget-content').find('.normal_post_order1').show();
          $(select).closest('.widget-content').find('.custom_post_order').hide();
          $(select).closest('.widget-content').find('.news_category_wrap').show();
        } else {
          $(select).closest('.widget-content').find('.news_slider_post_num_wrap').show();
          $(select).closest('.widget-content').find('.normal_post_order1').show();
          $(select).closest('.widget-content').find('.custom_post_order').hide();
          $(select).closest('.widget-content').find('.news_category_wrap').hide();
        }
      }
    }
    $('.news_slider_content_type').each(function() {
      news_slider_content_type(this);
    });
    $(document).on('change', '.news_slider_content_type', function(){
      news_slider_content_type(this);
    });
    $(document).on( 'widget-added widget-updated', function(event, widget) {
      $(widget).find('.news_slider_content_type').each(function() {
        news_slider_content_type(this);
      });
    });


    // お知らせスライダー　記事タイプselectボックス
    function news_slider_post_type(select) {
      if ( $(select).val() == 'category_post' ) {
        if($(select).closest('.widget-content').find('.news_slider_content_type').val() == 'post'){
          $(select).closest('.widget-content').find('.blog_category_wrap').show();
          $(select).closest('.widget-content').find('.news_category_wrap').hide();
        } else {
          $(select).closest('.widget-content').find('.blog_category_wrap').hide();
          $(select).closest('.widget-content').find('.news_category_wrap').show();
        }
        $(select).closest('.widget-content').find('.news_slider_post_num_wrap').show();
        $(select).closest('.widget-content').find('.normal_post_order1').show();
        $(select).closest('.widget-content').find('.normal_post_order2').hide();
        $(select).closest('.widget-content').find('.custom_post_order').hide();
      } else if ( $(select).val() == 'custom_post' ) {
        $(select).closest('.widget-content').find('.news_slider_post_num_wrap').hide();
        $(select).closest('.widget-content').find('.blog_category_wrap').hide();
        $(select).closest('.widget-content').find('.news_category_wrap').hide();
        $(select).closest('.widget-content').find('.normal_post_order1').hide();
        $(select).closest('.widget-content').find('.normal_post_order2').hide();
        $(select).closest('.widget-content').find('.custom_post_order').show();
      } else {
        $(select).closest('.widget-content').find('.news_slider_post_num_wrap').show();
        $(select).closest('.widget-content').find('.blog_category_wrap').hide();
        $(select).closest('.widget-content').find('.news_category_wrap').hide();
        $(select).closest('.widget-content').find('.normal_post_order1').show();
        $(select).closest('.widget-content').find('.normal_post_order2').hide();
        $(select).closest('.widget-content').find('.custom_post_order').hide();
      }
    }
    $('.news_slider_post_type1').each(function() {
      news_slider_post_type(this);
    });
    $(document).on('change', '.news_slider_post_type1', function(){
      news_slider_post_type(this);
    });
    $(document).on( 'widget-added widget-updated', function(event, widget) {
      $(widget).find('.news_slider_post_type1').each(function() {
        news_slider_post_type(this);
      });
    });


    // お知らせスライダー　記事タイプselectボックス2
    function news_slider_post_type2(select) {
      if($(select).closest('.widget-content').find('.news_slider_content_type').val() == 'service'){
        if ( $(select).val() == 'custom_post' ) {
          $(select).closest('.widget-content').find('.news_slider_post_num_wrap').hide();
          $(select).closest('.widget-content').find('.blog_category_wrap').hide();
          $(select).closest('.widget-content').find('.news_category_wrap').hide();
          $(select).closest('.widget-content').find('.normal_post_order1').hide();
          $(select).closest('.widget-content').find('.normal_post_order2').hide();
          $(select).closest('.widget-content').find('.custom_post_order').show();
        } else {
          $(select).closest('.widget-content').find('.news_slider_post_num_wrap').show();
          $(select).closest('.widget-content').find('.blog_category_wrap').hide();
          $(select).closest('.widget-content').find('.news_category_wrap').hide();
          $(select).closest('.widget-content').find('.normal_post_order1').hide();
          $(select).closest('.widget-content').find('.normal_post_order2').show();
          $(select).closest('.widget-content').find('.custom_post_order').hide();
        }
      }
    }
    $('.news_slider_post_type2').each(function() {
      news_slider_post_type2(this);
    });
    $(document).on('change', '.news_slider_post_type2', function(){
      news_slider_post_type2(this);
    });
    $(document).on( 'widget-added widget-updated', function(event, widget) {
      $(widget).find('.news_slider_post_type2').each(function() {
        news_slider_post_type2(this);
      });
    });


    // タブ記事　記事タイプselectボックス
    function tab_post_list_post_type(select) {
      if ( $(select).val() == 'category_post' ) {
        if($(select).closest('.tcd_widget_tab_content').find('.tab_post_list_content_type').val() == 'post'){
          $(select).closest('.tcd_widget_tab_content').find('.blog_category_wrap').show();
          $(select).closest('.tcd_widget_tab_content').find('.news_category_wrap').hide();
        } else {
          $(select).closest('.tcd_widget_tab_content').find('.blog_category_wrap').hide();
          $(select).closest('.tcd_widget_tab_content').find('.news_category_wrap').show();
        }
        $(select).closest('.tcd_widget_tab_content').find('.normal_post_order').show();
        $(select).closest('.tcd_widget_tab_content').find('.custom_post_order').hide();
      } else if ( $(select).val() == 'custom_post' ) {
        $(select).closest('.tcd_widget_tab_content').find('.blog_category_wrap').hide();
        $(select).closest('.tcd_widget_tab_content').find('.news_category_wrap').hide();
        $(select).closest('.tcd_widget_tab_content').find('.normal_post_order').hide();
        $(select).closest('.tcd_widget_tab_content').find('.custom_post_order').show();
      } else {
        $(select).closest('.tcd_widget_tab_content').find('.blog_category_wrap').hide();
        $(select).closest('.tcd_widget_tab_content').find('.news_category_wrap').hide();
        $(select).closest('.tcd_widget_tab_content').find('.normal_post_order').show();
        $(select).closest('.tcd_widget_tab_content').find('.custom_post_order').hide();
      }
    }
    $('.tab_post_list_post_type').each(function() {
      tab_post_list_post_type(this);
    });
    $(document).on('change', '.tab_post_list_post_type', function(){
      tab_post_list_post_type(this);
    });
    $(document).on( 'widget-added widget-updated', function(event, widget) {
      $(widget).find('.tab_post_list_post_type').each(function() {
        tab_post_list_post_type(this);
      });
    });


    // タブ記事　コンテンツタイプselectボックス
    function tab_post_list_content_type(select) {
      if ( $(select).val() == 'post' ) {
        if($(select).closest('.tcd_widget_tab_content').find('.tab_post_list_post_type').val() == 'category_post'){
          $(select).closest('.tcd_widget_tab_content').find('.blog_category_wrap').show();
          $(select).closest('.tcd_widget_tab_content').find('.news_category_wrap').hide();
        } else {
          $(select).closest('.tcd_widget_tab_content').find('.blog_category_wrap').hide();
          $(select).closest('.tcd_widget_tab_content').find('.news_category_wrap').hide();
        }
      } else {
        if($(select).closest('.tcd_widget_tab_content').find('.tab_post_list_post_type').val() == 'category_post'){
          $(select).closest('.tcd_widget_tab_content').find('.blog_category_wrap').hide();
          $(select).closest('.tcd_widget_tab_content').find('.news_category_wrap').show();
        } else {
          $(select).closest('.tcd_widget_tab_content').find('.blog_category_wrap').hide();
          $(select).closest('.tcd_widget_tab_content').find('.news_category_wrap').hide();
        }
      }
    }
    $('.tab_post_list_content_type').each(function() {
      tab_post_list_content_type(this);
    });
    $(document).on('change', '.tab_post_list_content_type', function(){
      tab_post_list_content_type(this);
    });
    $(document).on( 'widget-added widget-updated', function(event, widget) {
      $(widget).find('.tab_post_list_content_type').each(function() {
        tab_post_list_content_type(this);
      });
    });


  }

});


//カラーピッカー
(function($){
	function initColorPicker(widget) {
		widget.find('.color-picker').wpColorPicker( {
			change: _.throttle(function() { // For Customizer
				$(this).trigger('change');
			}, 3000 )
		});
	}
	function onFormUpdate(event, widget) {
		initColorPicker(widget);
	}
	$(document).on( 'widget-added widget-updated', onFormUpdate );
	$(document).ready( function() {
		$('#widgets-right .widget:has(.color-picker)').each(function(){
			initColorPicker($(this));
		});
	});
}(jQuery));

