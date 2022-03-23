$(function() {
    $('.slider').removeClass('slider_transition');
    if (localStorage.getItem('mode') == "dark") {
        $('#dark_light_mode').prop('checked', true);
        $('body').addClass('dark_mode_background');
        $('p').addClass('dark_mode_text');
        $('.container').css("background-color", "#282828");
        $('.dkpm-login-form').css("background-color", "#282828");
        $('.terms').css("color", "#aaaaaa");
        $('.reminder').css("color", "#aaaaaa");
    } else {
        $('#dark_light_mode').prop('checked', false);
        $('body').removeClass('dark_mode_background');
        $('p').removeClass('dark_mode_text');
        $('.container').css("background-color", "white");
        $('.dkpm-login-form').css("background-color", "#f7f7f7");
        $('.terms').css("color", "black");
        $('.reminder').css("color", "black");
    }
});

$('img').on('dragstart', function(e) { 
    e.preventDefault(); 
});

$('a').on('dragstart', function(e) { 
    e.preventDefault(); 
});

$('#dark_light_mode').on('change', function()  {
    localStorage.removeItem('mode');

    $('.slider').addClass('slider_transition');

    if ($(this).is(':checked')) {
        localStorage.setItem('mode', 'dark');
        $('body').addClass('dark_mode_background');
        $('p').addClass('dark_mode_text');
        $('.container').css("background-color", "#282828");
        $('.dkpm-login-form').css("background-color", "#282828");
        $('.terms').css("color", "#aaaaaa");
        $('.reminder').css("color", "#aaaaaa");
    } else {
        localStorage.setItem('mode', 'light');
        $('body').removeClass('dark_mode_background');
        $('p').removeClass('dark_mode_text');
        $('.container').css("background-color", "white");
        $('.dkpm-login-form').css("background-color", "#f7f7f7");
        $('.terms').css("color", "black");
        $('.reminder').css("color", "black");
    }
})