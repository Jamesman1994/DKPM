$(function () {
    $('.slider').removeClass('slider_transition');
    if (localStorage.getItem('mode') == "dark") {
        $('#dark_light_mode').prop('checked', true);
        $('.mode_background').css("background-color", "#363636");
        $('.mode_text').css("color", "#fff");
        $('.form_mode_background').css("background-color", "#000");
    } else {
        $('#dark_light_mode').prop('checked', false);
        $('.mode_background').css("background-color", "#f7f7f7");
        $('.mode_text').css("color", "#000");
        $('.form_mode_background').css("background-color", "#fff");
    }
});

$('img').on('dragstart', (e) => {
    e.preventDefault();
});

$('a').on('dragstart', (e) => {
    e.preventDefault();
});

$('#dark_light_mode').on('change', function () {
    localStorage.removeItem('mode');

    $('.slider').addClass('slider_transition');

    if ($(this).is(':checked')) {
        localStorage.setItem('mode', 'dark');
        $('.mode_background').css("background-color", "#363636");
        $('.mode_text').css("color", "#fff");
        $('.form_mode_background').css("background-color", "#000");
    } else {
        localStorage.setItem('mode', 'light');
        $('.mode_background').css("background-color", "#f7f7f7");
        $('.mode_text').css("color", "#000");
        $('.form_mode_background').css("background-color", "#fff");
    }
})

$('#dkpm_logout').click(function () {
    Swal.fire({
        title: chrome.i18n.getMessage('confirm_to_logout') + '?',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: chrome.i18n.getMessage('yes'),
        cancelButtonText: chrome.i18n.getMessage('no')
    }).then((result) => {
        if (result.isConfirmed) {
            chrome.runtime.sendMessage({ q1Ceo9pQgx: 'HIgQfLk4gL' }, (result) => {
                if (!result.error) {
                    $('main').css('display', 'none');
                    $('#gate').css('display', 'block');
                    $('#right_gate_close').animate({ right: '+=240px' }, 2000);
                    $('#left_gate_close').animate({ left: '+=240px' }, 2000);
                    setTimeout(function () {
                        location.href = 'x4AnfkCRYK.html';
                    }, 2000);
                }
            });
        }
    });
})

$(document).on("click", ".copy", function () {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val($(this).text()).select();
    if (document.execCommand("copy")) {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top',
            showConfirmButton: false,
            timer: 1000,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'success',
            title: chrome.i18n.getMessage('copied')
        })
        $temp.remove();
    }
})





