$(document).ready(function() {
    //mobile-menu
    $('#myTopnav i.menu').on('click', function() {
        $('#mySidenav').animate({'margin-left': 0}, 100);
    });
    $('#mySidenav a').on('click', function() {
        $('#mySidenav').animate({'margin-left': -250}, 100);
    });

    //Add to top button when scrolling
    $(window).scroll(function(){
        if($(this).scrollTop() > 100){
            $('#toTop').fadeIn();
            console.log('in');
        }else{
            $('#toTop').fadeOut();
            console.log('out');
        }
    });
    $('#toTop').on( 'click', function() {
        $('html, body').animate({scrollTop:0});
    });
});
