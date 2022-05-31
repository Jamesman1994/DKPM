$(function () {
    get_item_list();
});

async function get_item_list() {
    chrome.runtime.sendMessage({ sk4Lm6kOpd: 'GzD8yAEqFp' }, function (result) {
        $('#item_list').empty();
        var new_domain = "";

        if (result.error == true) {
            $('#item_list').append('<h1 id="item_message">' + chrome.i18n.getMessage('nothing_item') + '</h1>');
        } else if (result.error == false) {
            for (i = 0; i < result.list.length; i++) {
                if (result.list[i].domain != new_domain) {
                    $('#item_list').append('<div class="mode_text" style="margin-left: 20px;font-size:15px">'+ result.list[i].domain +'</div');
                }

                $('#item_list').append(
                    '<div class="item_card form_mode_background">' +
                        '<div class="item_card_icon">' +
                            '<img src="' + result.list[i].item_icon + '" class="item_card_image mode_background">' +
                        '</div>' +
                        '<div class="item_card_detail" title="' + chrome.i18n.getMessage('copy') + '">' +
                        '<div class="item_card_domain mode_text copy" title="' + chrome.i18n.getMessage('domain') + '" data-copy="' + result.list[i].domain + '">' + result.list[i].domain + '</div>' +
                        '<div class="item_card_username mode_text copy" title="' + chrome.i18n.getMessage('user_name') + '" data-copy="' + result.list[i].user_name + '">' + result.list[i].user_name + '</div>' +
                        '</div>' +
                        '<div class="item_card_button">' +
                            '<div class="fas fa-sign-in-alt item_card_button_text mode_text autologin" data-wygR7kdUJv="' + result.list[i].v0pgjk4wxh + '" title="' + chrome.i18n.getMessage('autologin') + '"></div>' +
                            '<div class="fas fa-address-card item_card_button_text mode_text autofill" data-y0vknvc9pw="' + result.list[i].v0pgjk4wxh + '" title="' + chrome.i18n.getMessage('autofill') + '"></div>' +
                            '<div class="fas fa-user-edit mode_text item_card_button_text edit_page" data-I9LlNglsk7="' + result.list[i].v0pgjk4wxh + '"></div>' +
                        '</div>' +
                    '</div>'
                );

                new_domain = result.list[i].domain;
            }

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

            $("img").bind("error",function(){
                $(this).attr("src","images/doorknock_48.png");
            });
        }
    });
}

$('.open_search').click(() => {
    $('#search_bar').toggleClass('toggle');
    setTimeout(() => {
        $('#search_bar').focus();
    }, 1000)
});

$('#go_to_add').click(() => {
    $('#add_page').toggleClass('toggle');
    $('#add_page_body').scrollTop(0);
    $('#tabbar-dkpm').toggleClass('toggle');
    $('#add_read_password').removeClass('fa-eye-slash').addClass('fa-eye');
    $('#user_password').prop('type', 'password');
    chrome.runtime.sendMessage({ sEjiW71yfN: 'aG8tgftjiL', 'type': 'add' }, function (result) {
        $('#url').val(result.url);
        $('#domain').val(new URL(result.url).hostname);
        $('#item_name').val(result.title);
        $('#item_icon').val(result.favIcon);
        $('#favIcon').attr('src', result.favIcon);
        $('#user_name').val('');
        $('#user_password').val('');
        $('#remarks').val('');
    });
});

$('div').on('click', '.edit_page', function () {
    $('#edit_page').toggleClass('toggle');
    $('#edit_page_body').scrollTop(0);
    $('#tabbar-dkpm').toggleClass('toggle');
    $('#edit_read_password').removeClass('fa-eye-slash').addClass('fa-eye');
    $('#edit_user_password').prop('type', 'password');

    chrome.runtime.sendMessage({ sEjiW71yfN: 'aG8tgftjiL', 'type': 'edit', 'tv8c7iu7ng': $(this).attr('data-I9LlNglsk7') }, function (result) {
        $('#edit_url').val(result.item.url);
        $('#edit_domain').val(result.item.domain);
        $('#edit_item_name').val(result.item.item_name);
        $('#edit_item_icon').val(result.item.item_icon);
        $('#edit_favIcon').attr('src', result.item.item_icon);
        $('#edit_user_name').val(result.item.user_name);
        $('#edit_user_password').val(result.item.password);
        $('#edit_remarks').val(result.item.remarks);
        $('#Lu1rwL65WU').val(result.item.u86wjzd0b4);
    });
});

$('div').on('click', '.autofill', function () {
    chrome.runtime.sendMessage({ fmjk1e0uQk: 'leU8c810Cv', kz3BBRskF9: $(this).attr('data-y0vknvc9pw') });
});

$('div').on('click', '.autologin', function () {
    chrome.runtime.sendMessage({ pGUJ8O91jD: 'U4uOkq2IE5', o4SsFHMMh1: $(this).attr('data-wygR7kdUJv') });
});

$('#cancel_add_page').click(() => {
    $('#add_page').toggleClass('toggle');
    $('#tabbar-dkpm').toggleClass('toggle');
});

$('#cancel_edit_page').click(() => {
    $('#edit_page').toggleClass('toggle');
    $('#tabbar-dkpm').toggleClass('toggle');
});

$('#back_to_item, #add_go_to_generator, #edit_go_to_generator').click(() => {
    $('#generator_page').toggleClass('toggle');
})

$('#add_go_to_generator, #edit_go_to_generator').click(() => {
    generate_password(6);
})

$('#click_to_choose').click(() => {
    $('#generator_page').toggleClass('toggle');
    $('#user_password').val($('#random_password').text());
    $('#edit_user_password').val($('#random_password').text());
})

$('#add_check_password').click(function () {
    if ($('#user_password').val()) {
        chrome.runtime.sendMessage({ UM57B8TOMq: 'lsnh4BEp96', 'password': $('#user_password').val() }, function (result) {
            if (result.duplicate == true) {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: chrome.i18n.getMessage('duplicate'),
                    showConfirmButton: false,
                    timer: 1500
                })
            } else if (result.duplicate == false) {
                if (result.strength == "weak") {
                    strength = chrome.i18n.getMessage('weak')
                } else {
                    strength = chrome.i18n.getMessage('strong')
                }
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: chrome.i18n.getMessage('not_duplicate'),
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    Swal.fire({
                        position: 'center',
                        icon: 'info',
                        title: strength,
                        showConfirmButton: true
                    })
                })
            }
        });
    }
})

$('#edit_check_password').click(function () {
    if ($('#edit_user_password').val()) {
        chrome.runtime.sendMessage({ UM57B8TOMq: 'lsnh4BEp96', 'password': $('#edit_user_password').val() }, function (result) {
            if (result.duplicate == true) {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: chrome.i18n.getMessage('duplicate'),
                    showConfirmButton: false,
                    timer: 1500
                })
            } else if (result.duplicate == false) {
                if (result.strength == "weak") {
                    strength = chrome.i18n.getMessage('weak')
                } else {
                    strength = chrome.i18n.getMessage('strong')
                }
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: chrome.i18n.getMessage('not_duplicate'),
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    Swal.fire({
                        position: 'center',
                        icon: 'info',
                        title: strength,
                        showConfirmButton: true
                    })
                })
            }
        });
    }
})

$('#add_read_password').click(function () {
    if ($(this).hasClass('fa-eye')) {
        $(this).removeClass('fa-eye').addClass('fa-eye-slash');
        $('#user_password').prop('type', 'text');
    } else {
        $(this).removeClass('fa-eye-slash').addClass('fa-eye');
        $('#user_password').prop('type', 'password');
    }
})

$('#edit_read_password').click(function () {
    if ($(this).hasClass('fa-eye')) {
        $(this).removeClass('fa-eye').addClass('fa-eye-slash');
        $('#edit_user_password').prop('type', 'text');
    } else {
        $(this).removeClass('fa-eye-slash').addClass('fa-eye');
        $('#edit_user_password').prop('type', 'password');
    }
})

$('#search_bar').on('input', function () {
    const items_domain = $('.item_card_domain');
    const filter = $(this).val().toLowerCase();

    Array.from(items_domain).forEach(function (item) {
        const title = item.textContent;
        if (title.toLowerCase().indexOf(filter) != -1) {
            item.parentNode.parentNode.style.display = '';
        } else {
            item.parentNode.parentNode.style.display = 'none';
        }
    });
});

$('#confirm_to_add').click(function () {
    if ($('#item_name').val() && $('#user_password').val() && $('#user_name').val() && $('#domain').val() && $('#url').val()) {
        Swal.fire({
            title: chrome.i18n.getMessage('confirm_to_add') + '?',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: chrome.i18n.getMessage('yes'),
            cancelButtonText: chrome.i18n.getMessage('no')
        }).then((result) => {
            if (result.isConfirmed) {
                chrome.runtime.sendMessage({ N5SkXoQTOK: 'Lm3qj64l1p', 'item_name': $('#item_name').val(), 'item_icon': $('#item_icon').val(), 'user_name': $('#user_name').val(), 'user_password': $('#user_password').val(), 'domain': $('#domain').val(), 'url': $('#url').val(), 'remarks': $('#remarks').val() }, function (result) {
                    if (chrome.runtime.lastError || result.message == "wrong_domain") {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: chrome.i18n.getMessage('add_fail'),
                            showConfirmButton: false,
                            timer: 1500
                        })
                    } else if (result.error == false) {
                        Swal.fire({
                            position: 'center',
                            title: chrome.i18n.getMessage('add_success'),
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            $('#item_name').val('');
                            $('#item_icon').val('');
                            $('#user_password').val('');
                            $('#user_name').val('');
                            $('#domain').val('');
                            $('#url').val('');
                            $('#add_page').toggleClass('toggle');
                            $('#tabbar-dkpm').toggleClass('toggle');
                            get_item_list();
                        })
                    } else if (result.error == true && result.message == "duplicate") {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: chrome.i18n.getMessage('add_duplicate'),
                            showConfirmButton: false,
                            timer: 1500
                        })
                    } else if (result.error == true && result.message == "system_error") {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: chrome.i18n.getMessage('system_error'),
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                })
            }
        })
    } else {
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: chrome.i18n.getMessage('empty'),
            showConfirmButton: false,
            timer: 1500
        })
    }
})

$('#confirm_to_edit').click(function () {
    if ($('#edit_item_name').val() && $('#edit_item_icon').val() && $('#edit_user_password').val() && $('#edit_user_name').val() && $('#edit_domain').val() && $('#edit_url').val()) {
        Swal.fire({
            title: chrome.i18n.getMessage('confirm_to_edit') + '?',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: chrome.i18n.getMessage('yes'),
            cancelButtonText: chrome.i18n.getMessage('no')
        }).then((result) => {
            if (result.isConfirmed) {
                chrome.runtime.sendMessage({ xum3Vvl7Pw: 'I7kgE0XNP9', 'scyebl8g6r': $('#Lu1rwL65WU').val(), 'item_name': $('#edit_item_name').val(), 'user_name': $('#edit_user_name').val(), 'password': $('#edit_user_password').val(), 'domain': $('#edit_domain').val(), 'url': $('#edit_url').val(), 'remarks': $('#edit_remarks').val() }, function (result) {
                    if (chrome.runtime.lastError || result.message == "wrong_domain") {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: chrome.i18n.getMessage('edit_fail'),
                            showConfirmButton: false,
                            timer: 1500
                        })
                    } else if (result.error == false) {
                        Swal.fire({
                            position: 'center',
                            title: chrome.i18n.getMessage('edit_success'),
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            $('#edit_item_name').val('');
                            $('#edit_item_icon').val('');
                            $('#edit_user_password').val('');
                            $('#edit_user_name').val('');
                            $('#edit_domain').val('');
                            $('#edit_url').val('');
                            $('#edit_page').toggleClass('toggle');
                            $('#tabbar-dkpm').toggleClass('toggle');
                            get_item_list();
                        })
                    } else if (result.error == true && result.message == "duplicate") {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: chrome.i18n.getMessage('edit_duplicate'),
                            showConfirmButton: false,
                            timer: 1500
                        })
                    } else if (result.error == true && result.message == "system_error") {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: chrome.i18n.getMessage('system_error'),
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                })
            }
        })
    } else {
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: chrome.i18n.getMessage('empty'),
            showConfirmButton: false,
            timer: 1500
        })
    }
})

$('#back_to_generator').click(() => {
    $('#history_page').toggleClass('toggle');
    generate_password($('#rs-length').val())
});

$('#redirect_to_history').click(() => {
    $('#history_page').toggleClass('toggle');
    $('#history_list').scrollTop(0);
    get_history();
})

$('#delete_item').click(function () {
    Swal.fire({
        title: chrome.i18n.getMessage('confirm_to_add') + '?',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: chrome.i18n.getMessage('yes'),
        cancelButtonText: chrome.i18n.getMessage('no')
    }).then((result) => {
        if (result.isConfirmed) {
            chrome.runtime.sendMessage({ pyfVf9Szar: 'cNrpPOsnx8', 'dwt6y0seuq': $('#Lu1rwL65WU').val() }, function (result) {
                if (result.error == false) {
                    Swal.fire({
                        position: 'center',
                        title: chrome.i18n.getMessage('delete_success'),
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        $('#edit_page').toggleClass('toggle');
                        $('#tabbar-dkpm').toggleClass('toggle');
                        get_item_list();
                    })
                }
            })
        }
    })
})

