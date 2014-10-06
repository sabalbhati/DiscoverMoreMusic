(function($){
  //Defining the jQuery plugin
  $.fn.modal_box = function(prop){

    //default parameters

    var options = $.extend({
      height: "600",
      width: "300",
      title: "Put Your Title Here",
      description: "description here",
      top: "20%",
      left: "35%",
    },prop);

    return this.click(function(e){
      add_block_page();
      add_popup_box();
      add_styles();

      $('.modal_box').fadeIn("slow");
    });

    function add_styles(){
      $('.modal_box').css({
        'position': 'absolute',
        'left': options.left,
        'top': options.top,
        'display': 'none',
        'height': '400px',
        'width': '400px',
        'border':'1px solid #fff',
        'box-shadow': '0px 2px 7px #292929',
        '-moz-box-shadow': '0px 2px 7px #292929',
        '-webkit-box-shadow': '0px 2px 7px #292929',
        'border-radius':'10px',
        '-moz-border-radius':'10px',
        '-webkit-border-radius':'10px',
        'background': '#FFF',
        'z-index':'40',
      });

      $('.modal_close').css({
        'position':'relative',
        'top':'-10',
        'left':'10px',
        'float':'right',
        'display':'block',
        'height':'23px',
        'width': '23px',
        'z-index':'50',
        //'background-color' : '#333',
        'background-image': 'url(\"images/close.png\")'
      });

      var pageHeight = $(document).height();
      var pageWidth = $(window).width();

      $('.block_page').css({
        'position':'absolute',
        'top':'0',
        'left':'0',
        'background-color':'rgba(0,0,0,0.6)',
        'height':pageHeight,
        'width':pageWidth,
        'z-index':'10'
      });
    }

    function add_block_page(form){
      var block_page = $('<div class="block_page"></div>');

      $(block_page).appendTo('body');
    }

    function add_popup_box(){
      var pop_up = $('<div class="modal_box">' +
                      '<a href="#" class="modal_close"></a>' +
                      '<div class="inner_modal_box">' +
                        '<h2>' + 
                          options.title + 
                        '</h2>' +
                        '<p>'+ options.description + '</p>' +
                      '</div>' +
                    '</div>');
      $(pop_up).appendTo('.block_page');

      //close the model page if clicked
      $('.modal_close').click(function(){
        $('.block_page').fadeOut("slow", function(){
          this.remove();
        });
      
      });  // $('.block_page').fadeOut().remove();
    }
    return this;
  };
})(jQuery)

