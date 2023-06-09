$(document).ready(function(){
    if (window.matchMedia("(min-width: 584px)").matches) {
        $(".hamburger").click(function(){
            $(".wrapper").toggleClass("active");
        });
    }
    $(".right_menu li .fas").click(function(){
            $(".profile_dd").toggleClass("active");
        });
});