$(document).ready(function () {
    $(".first-list-element").addClass("active");

    $(".nav-item").click(function () {
        $(".nav-item").removeClass('active');
        $(this).addClass('active');
    });

    $("#toggler").click(function () {
        $("#wrap").toggleClass('toggled');

        var right = $('.sidebar').css("right");
        if (right == '0px')
        {
            $('.layer').fadeOut(1000);
        }
        else {        
            $(".layer").fadeIn( 1000);          
        }
    });

    $('.layer').click(function() {
        $('#wrap').removeClass('toggled');
        $('.layer').fadeOut();
    });

    $(".search-icon").click(function() {
       $(".search-input").slideToggle("slow");
    })


});