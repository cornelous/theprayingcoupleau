var $ = jQuery.noConflict();
$(document).ready(function() {

    "use strict";

    // Responsive video
    $(".hentry, .widget").fitVids();

    /*-----------------------------------------------------------------------------------*/
    /*  Superfish Menu
    /*-----------------------------------------------------------------------------------*/
    var example = $('ul.sf-menu').superfish({
        delay:       100,
        speed:       'fast',
        autoArrows:  false     
    });

    /*-----------------------------------------------------------------------------------*/
    /*  Responsive Menu
    /*-----------------------------------------------------------------------------------*/
    $('#primary-mobile-menu').sidr({
        name: 'sidr-existing-primary',
        source: '#primary-nav'    
    });
   
    $('#secondary-mobile-menu').sidr({
        name: 'sidr-existing-secondary',
        source: '#secondary-nav'
    });

    /*-----------------------------------------------------------------------------------*/
    /*  Header Search Form (Popup)
    /*-----------------------------------------------------------------------------------*/
    $('.header-search > .fa-search').click(function(){
        $('.search-form').slideDown('', function() {});
        $('.header-search > .fa-search').toggleClass('active');
        $('.header-search > .fa-times').toggleClass('active');
    });

    $('.header-search > .fa-times').click(function(){
        $('.search-form').slideUp('', function() {});
        $('.header-search > .fa-search').toggleClass('active');
        $('.header-search > .fa-times').toggleClass('active');
    });

    /*-----------------------------------------------------------------------------------*/
    /*  Match Height
    /*-----------------------------------------------------------------------------------*/
    $('.content-block-1 li').matchHeight();
    $('.content-block-3 .block').matchHeight();
    $('.content-block-4 .block').matchHeight();
    $('.carousel-loop li').matchHeight();  
    $('.grid .hentry').matchHeight();
    $('.column').matchHeight();

    /*-----------------------------------------------------------------------------------*/
    /*  News Ticker
    /*-----------------------------------------------------------------------------------*/
    var newsTicker = jQuery('li.news-item');
    var tickerTimeId = 0;
    var currentNews = 0;
    var olderNews = 0;
    var sumNews = jQuery(newsTicker).size();

    function newsTickerInit(){
        jQuery(newsTicker).eq(0).fadeIn();
        newsTickerClick();
        tickerTimeId = setInterval(autoTicherScroll,6000);
    }
    newsTickerInit();

    function newsTickerClick(){
        jQuery(newsTicker).each(function(index){
            if(!jQuery(this).children('a').is(':hidden')){
                currentNews = index;
            }
        });
        jQuery('a.headline-prev').click(function(e){
            e.preventDefault();
            clearInterval(tickerTimeId);
            olderNews = currentNews;
            if(currentNews == 0){
                currentNews = sumNews-1;
            }else{
                currentNews = currentNews-1;
            }
            jQuery(newsTicker).eq(olderNews).stop(true,true).fadeOut().queue(function(){
                jQuery(newsTicker).eq(currentNews).stop(true,true).fadeIn();
            });

            tickerTimeId = setInterval(autoTicherScroll,6000);
        });
        jQuery('a.headline-next').click(function(e){
            e.preventDefault();
            clearInterval(tickerTimeId);
            olderNews = currentNews;
            if(currentNews == sumNews-1){
                currentNews = 0;
            }else{
                currentNews = currentNews+1;
            }
            jQuery(newsTicker).eq(olderNews).stop(true,true).fadeOut().queue(function(){
                jQuery(newsTicker).eq(currentNews).stop(true,true).fadeIn();
            });
            tickerTimeId = setInterval(autoTicherScroll,6000);
        });
    }

    function autoTicherScroll(){
        olderNews = currentNews;
        if(currentNews == sumNews-1){
            currentNews = 0;
        }else{
            currentNews = currentNews+1;
        }
        jQuery(newsTicker).eq(olderNews).stop(true,true).fadeOut().queue(function(){
            jQuery(newsTicker).eq(currentNews).stop(true,true).fadeIn();
        });
    }
    
    /*-----------------------------------------------------------------------------------*/
    /*  Tabs
    /*-----------------------------------------------------------------------------------*/
    var $tabsNav    = $('.tabs-nav'),
        $tabsNavLis = $tabsNav.children('li'),
        $tabContent = $('.tab-content');

    $tabsNav.each(function() {
        var $this = $(this);

        $this.next().children('.tab-content').stop(true,true).hide()
                                             .first().show();

        $this.children('li').first().addClass('active').stop(true,true).show();
    });

    $tabsNavLis.on('click', function(e) {
        var $this = $(this);

        $this.siblings().removeClass('active').end()
             .addClass('active');

        $this.parent().next().children('.tab-content').stop(true,true).hide()
                                                      .siblings( $this.find('a').attr('href') ).fadeIn();

        e.preventDefault();
    });

    /*-----------------------------------------------------------------------------------*/
    /*   Carousel #0 / Featured Content
    /*-----------------------------------------------------------------------------------*/
    $('#carousel-0').jcarousel({
        wrap: 'circular',
        animation: {
            duration: 500
        }
    });

    $('#carousel-0').jcarouselAutoscroll({
        autostart: true,
        interval: 5000

    });

    $('.jcarousel-pagination-0')
        .on('jcarouselpagination:active', 'a', function() {
            $(this).addClass('active');
        })
        .on('jcarouselpagination:inactive', 'a', function() {
            $(this).removeClass('active');
        })
        .jcarouselPagination();
      
    $('#carousel-0 .jcarousel-control-prev')
        .on('jcarouselcontrol:active', function() {
            $(this).removeClass('inactive');
        })
        .on('jcarouselcontrol:inactive', function() {
            $(this).addClass('inactive');
        })
        .jcarouselControl({
            target: '-=1'
        });

    $('#carousel-0 .jcarousel-control-next')
        .on('jcarouselcontrol:active', function() {
            $(this).removeClass('inactive');
        })
        .on('jcarouselcontrol:inactive', function() {
            $(this).addClass('inactive');
        })
        .jcarouselControl({
            target: '+=1'
        });

    $('.jcarousel')
        .jcarousel({
            wrap: 'circular'                
        });

    $('.jcarousel-pagination-1')
        .on('jcarouselpagination:active', 'a', function() {
            $(this).addClass('active');
        })
        .on('jcarouselpagination:inactive', 'a', function() {
            $(this).removeClass('active');
        })
        .jcarouselPagination({
            target: "+=1"
        });

    /*-----------------------------------------------------------------------------------*/
    /*  Carousel #1 / Must See Videos
    /*-----------------------------------------------------------------------------------*/
    $('#carousel-1 .jcarousel-control-prev')
        .on('jcarouselcontrol:active', function() {
            $(this).removeClass('inactive');
        })
        .on('jcarouselcontrol:inactive', function() {
            $(this).addClass('inactive');
        })
        .jcarouselControl({
            target: '-=1'
        });

    $('#carousel-1 .jcarousel-control-next')
        .on('jcarouselcontrol:active', function() {
            $(this).removeClass('inactive');
        })
        .on('jcarouselcontrol:inactive', function() {
            $(this).addClass('inactive');
        })
        .jcarouselControl({
            target: '+=1'
        });                        

});


