$('#refresh_password').click(function () {
    if ($("input[name='type']:checked").val() == "password") {
        generate_password($('#rs-length').val());
    } else if ($("input[name='type']:checked").val() == "passphrase") {
        generate_passphrase($('#word_count').val(), $('#seperator').val());
    }
});

$('#rs-length').on('input', function () {
    if ($(this).val() <= 7) {
        $("#number_format").attr({ "max": $(this).val() });
        $("#symbol_format").attr({ "max": $(this).val() });
        $("#letter_format").attr({ "max": $(this).val() });
    }
    $('#rs-number').text($(this).val());
    generate_password($(this).val())
});

$("input[name='format']").change(function () {
    if ($("input[name='format']:checked").length < 1) {
        $('#format_lower').prop('checked', true);
    } else {
        generate_password($('#rs-length').val())
    }
});

$('#word_count').change(function () {
    generate_passphrase($(this).val(), $('#seperator').val());
});

$('#seperator').on('input', function () {
    generate_passphrase($('#word_count').val(), $(this).val());
});

$("input[name='format']").change(function () {
    if ($("input[name='format']:checked").length < 1) {
        $('#format_lower').prop('checked', true);
    } else {
        generate_password($('#rs-length').val())
    }
});

$("input[type='number'][id$='format']").change(function () {
    var max;
    if ($('#rs-length').val() <= 6) {
        max = 6;
    } else {
        max = 7;
    }

    if ($(this).attr('id') == 'letter_format') {
        $('#number_format').attr({ "max": max - $(this).val() - $('#symbol_format').val() })
        $('#symbol_format').attr({ "max": max - $(this).val() - $('#number_format').val() })
        if (!$('#format_lower').is(':checked')) {
            $('#format_lower').prop('checked', true);
        }
    }

    if ($(this).attr('id') == 'number_format') {
        $('#letter_format').attr({ "max": max - $(this).val() - $('#symbol_format').val() })
        $('#symbol_format').attr({ "max": max - $(this).val() - $('#letter_format').val() })
        if (!$('#format_number').is(':checked')) {
            $('#format_number').prop('checked', true);
        }
    }

    if ($(this).attr('id') == 'symbol_format') {
        $('#number_format').attr({ "max": max - $(this).val() - $('#letter_format').val() })
        $('#letter_format').attr({ "max": max - $(this).val() - $('#number_format').val() })
        if (!$('#format_symbol').is(':checked')) {
            $('#format_symbol').prop('checked', true);
        }
    }

    generate_password($('#rs-length').val());
});

async function generate_password(length) {
    var formats = [];
    $("input[name=format]:checked").each(function () {
        formats.push($(this).val());
    });

    chrome.runtime.sendMessage({ Fvc0Be6hzY: 'hqEYi65vgn', 'password_length': length, 'password_formats': formats, 'min_number': $('#number').val(), 'min_letter': $('#letter').val(), 'min_symbol': $('#symbol').val() }, function (result) {
        $('#random_password').text(result);
    });
}

generate_password(6);

async function generate_passphrase(length, seperator) {
    chrome.runtime.sendMessage({ r76SVAlxur: 'wM7BTvYfUy', 'passphrase_length': length, 'seperator': seperator }, function (result) {
        $('#random_password').text(result);
    });
}

async function get_history() {
    chrome.runtime.sendMessage({ d6sGMJGjsq: 'lkvrt6ErWP' }, function (result) {
        $('#history_message').text(chrome.i18n.getMessage('copy'));
        $('#history_list').empty();
        for (let i = 0; i < result.random_history.length; i++) {
            $('#history_list').append('<div class="container-dkpm form_mode_background history_card"><div style="width:90%"><div class="copy history_password mode_text" data-copy="' + result.random_history[i]["random_password"] + '">' + result.random_history[i]["random_password"] + '</div><div class="history_date">' + result.random_history[i]["record_time"] + '</div></div><div style="width:10%"><div></div>');
        }
        if (localStorage.getItem('mode') == "dark") {
            $('.mode_text').css("color", "#fff");
            $('.form_mode_background').css("background-color", "#000");
        } else {
            $('.mode_text').css("color", "#000");
            $('.form_mode_background').css("background-color", "#fff");
        }
    });
}

$('#clear_page').click(() => {
    if ($("#history_list").html().length > 0) {
        Swal.fire({
            title: chrome.i18n.getMessage('clear_question') + "?",
            showCancelButton: true,
            confirmButtonText: chrome.i18n.getMessage('yes'),
            cancelButtonText: chrome.i18n.getMessage('no')
        }).then((result) => {
            if (result.isConfirmed) {
                chrome.runtime.sendMessage({ Ak8JtAFjO7: 'xplck6g8PJ' }, function (result) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: chrome.i18n.getMessage('clear_success'),
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        $('#history_list').empty();
                        $('#history_message').text(chrome.i18n.getMessage('nothing_to_clear'));
                    });
                });
            }
        })
    }
});

$("input[name='type']").change(function () {
    if ($(this).val() == 'password') {
        $('#password').css('display', '');
        $('#passphrase').css('display', 'none');
        generate_password($('#rs-length').val());
        $('#refresh_text').text(chrome.i18n.getMessage('refresh_password'));
    } else if ($(this).val() == 'passphrase') {
        $('#password').css('display', 'none');
        $('#passphrase').css('display', '');
        generate_passphrase($('#word_count').val(), $('#seperator').val());
        $('#refresh_text').text(chrome.i18n.getMessage('refresh_passphrase'));
    }
});
