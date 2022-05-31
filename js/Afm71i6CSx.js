$('#go_to_history').click(() => {
    $('#history_page').toggleClass('toggle');
    $('#tabbar-dkpm').toggleClass('toggle');
    $('#history_list').scrollTop(0);
    get_history();
});

$('#back_to_generator').click(() => {
    $('#history_page').toggleClass('toggle');
    $('#tabbar-dkpm').toggleClass('toggle');

    if ($("input[name='type']:checked").val() == "password") {
        generate_password($('#rs-length').val());
    } else if ($("input[name='type']:checked").val() == "passphrase") {
        generate_passphrase($('#word_count').val(), $('#seperator').val());
    }
});

