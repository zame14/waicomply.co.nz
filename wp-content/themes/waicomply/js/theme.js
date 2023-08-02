jQuery(function($) {
    $(".wc-search").click(function() {
        $(".search-form").toggleClass('show-search');
        $(this).toggleClass('fa-times');
    });
    $('.top').click(function(event){
        $('html, body').animate({
            scrollTop: 0
        }, 500);
        return false;
    });
    var waypoint = new Waypoint({
        element: document.getElementById('header'),
        handler: function() {
            $(".top").toggleClass('show');
        },
        offset: -800
    });
    var waypoint = new Waypoint({
        element: document.getElementById('page'),
        handler: function () {
            $("#header").toggleClass('fixed');
        },
        offset: -5
    });
});