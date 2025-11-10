var $window = $(window);
var $animation_elements = $('.animate');
var modalDismissed = $.cookie('alemba_modal');

$(document).ready(function() {
    
    //Checks if window is > 750px and removes 0.5x from banner paths if true
    if ($('.pageBanner').css('background-image')) {
        var clientWidth = $(window).width();
        if ( clientWidth > 750 ) {
            $('.pageBanner').each( function() {
                var imagePath = $(this).css('background-image');
                var newPath = imagePath.replace(/@0.5x|%400.5x/g, "");
                imgLoad(newPath, $(this));
            });
        }
    }
    
    //function to preload image before applying it as BG image
    function imgLoad(url, elem) {
       $.get(url, function(data){
           elem.css('background-image', url);
       });
    }
    
    // Toggle menu open / closed on mobile screens
    $('.mobile-menu-button').on('click', function() {
        $(this).toggleClass('open');
        $('#MAIN_NAV').slideToggle();
        $('html, body').toggleClass('noscroll')
    });
    
    // Add slideDown animation to Bootstrap dropdown when expanding.
    $('.dropdown').on('show.bs.dropdown', function() {
        $(this).find('.dropdown-menu').first().stop(true, true).slideDown();
        //add active class to li
        $(this).addClass('active');
        //freeze body scroll when menus are open
        if ($(this).parents('#MAIN_NAV').length) {
            $('html, body').css({
                overflow: 'hidden',
                height: '100%'
            });
        }
    });

    // Add slideUp animation to Bootstrap dropdown when collapsing.
    $('.dropdown').on('hide.bs.dropdown', function() {
        $(this).find('.dropdown-menu').first().stop(true, true).slideUp();
        $(this).removeClass('active');
        //un-freeze body scroll
        $('html, body').css({
            overflow: 'auto',
            height: 'auto'
        });
    });

    // Remove modals & popups (for close button onClick)
    
    removeModal = function(m) {
        $(m).removeClass('enter');
        setTimeout( function(){ 
            $(m).remove(); 
        }  , 500 ); 
    };
    
    setExitCookie = function() {
        $.cookie('alemba_modal', 'dismissed', {expires: 7, path: '/'}); // expires in 1 week
    };
    
    // Unhide the Popup if the page is loaded in a new window, or if the page is referred from a different domian
    
    if ($('#popup')) {
        
        if ( document.referrer === null || document.referrer.indexOf(window.location.hostname) < 0 ) {
        
            $('#popup').removeAttr("style");

        } else {
            $('#popup').remove();
        }
        
        setTimeout( function(){ 
            $('#popup').addClass('enter');
        }  , 3000 );
    }
    
    
    
    //Add class to .animate when scrolled into view
    
    $window.on('scroll resize', check_if_in_view);
    $window.trigger('scroll');
    
    function check_if_in_view() {
      var window_height = $window.height();
      var window_top_position = $window.scrollTop();
      var window_bottom_position = (window_top_position + window_height);
    
      $.each($animation_elements, function() {
        var $element = $(this);
        var element_height = $element.outerHeight();
        var element_top_position = $element.offset().top;
        var element_bottom_position = (element_top_position + element_height);
    
        //ANIMATIONS
        //check to see if this current container is within viewport
        if ((element_bottom_position >= window_top_position) && (element_top_position <= window_bottom_position)) {
            $(this).each(function(){
                $(this).addClass('animated');
            })
        } else {
            $(this).each(function(i){
                $(this).removeClass('animated')
            })
        }
      });
    }
    
    var mouseX = 0;
    var mouseY = 0;

    document.addEventListener("mousemove", function(e) {
        mouseX = e.clientX;
        mouseY = e.clientY;
    });

    
    //EXIT INTENT

    if(modalDismissed === null || modalDismissed === "" || modalDismissed === undefined) {
        setTimeout(function() {
            $(document).on("mouseout", checkExit);
        }, 5000);
    }
    function checkExit(evt) {
        if (mouseY < 100) {
            if (!evt.relatedTarget && !evt.toElement) {
                $(evt.currentTarget).off("mouseout");
                $('.modal-screen-overlay').removeAttr("style");
                setTimeout( function(){ 
                    $('.modal-screen-overlay').addClass('enter'); 
                }  , 10 ); 
            }
        }
    }
    
    //Add current URL to relevant form fields
    $(function(){
        var url = window.location.href;
        $('#CURRENT_URL').val(url);
    });
    
});