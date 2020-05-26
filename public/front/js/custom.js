$(document).ready(function() {
    //mobile-menu
    $('#myTopnav i.menu').on('click', function() {
        $('#mySidenav').animate({'margin-left': 0}, 100);
    });
    $('#mySidenav a').on('click', function() {
        $('#mySidenav').animate({'margin-left': -250}, 100);
    });

    //Add back to top button when scrolling
    $(window).scroll(function(){
        if ($(this).scrollTop() > 200){
            $('#toTop').fadeIn();
        } else {
            $('#toTop').fadeOut();
        }
    });
    $('#toTop').on( 'click', function() {
        $('html, body').animate({scrollTop:0});
    });

    //anchor smooth scrolling
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();

            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
});
