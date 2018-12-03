// JavaScript Document
$(".ddd").on("click", function () {

    var $button = $(this);
    var oldValue = $button.closest('.sp-quantity').find("input.quntity-input").val();

    if ($button.text() == "+") {
        var newVal = parseFloat(oldValue) + 1;
    } else {
        // Don't allow decrementing below zero
        if (oldValue > 0) {
            var newVal = parseFloat(oldValue) - 1;
        } else {
            newVal = 0;
        }
    }

    $button.closest('.sp-quantity').find("input.quntity-input").val(newVal);

});




$('.thumbnails .zoom').click(function(e){
      e.preventDefault();

      var photo_fullsize =  $(this).find('img').attr('src');

      $('.woocommerce-main-image img').attr('src', photo_fullsize);

    });




//remove placeholder on focus js start here

$("input").each(
            function(){
                $(this).data('holder',$(this).attr('placeholder'));
                $(this).focusin(function(){
                    $(this).attr('placeholder','');
                });
                $(this).focusout(function(){
                    $(this).attr('placeholder',$(this).data('holder'));
                });
                
        });
		
		$("textarea").each(
            function(){
                $(this).data('holder',$(this).attr('placeholder'));
                $(this).focusin(function(){
                    $(this).attr('placeholder','');
                });
                $(this).focusout(function(){
                    $(this).attr('placeholder',$(this).data('holder'));
                });
                
        });
		
	
//multilever dropdown js start here	
		
$(document).ready(function(){
    $('#cat_toggle > ul > li.has-sub > p,.shop_toggle li.has-sub > p').append('<span class="holder"></span>');
    $('.dropdown-submenu a.test').on("click", function(e){
        $(this).next('ul').toggle();
        e.stopPropagation();
        e.preventDefault();
    });

    $('#cat_toggle li.has-sub > p, .shop_toggle li.has-sub > p').on('click', function(){
       var element = $(this).parent('li');
        if (element.hasClass('open')) {

           element.removeClass('open');

           element.find('li').removeClass('open');

           element.find('ul').slideUp();

       }
          else {
            element.find('.holder:before').css('content', '-')
            element.addClass('open');
            element.children('ul').slideDown();
            element.siblings('li').children('ul').slideUp();
            element.siblings('li').removeClass('open');
            element.siblings('li').find('li').removeClass('open');
            element.siblings('li').find('ul').slideUp();
          }
    });

});		