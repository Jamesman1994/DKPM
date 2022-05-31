(function ($) {
    $('#dkpm-forgot-password-btn').click(async (e) => {
        e.preventDefault();

        chrome.runtime.sendMessage({'pi4SHp9kbL': $('#x6Ia5ntokb').val(), 'pyz3P162Pj': 'eS034iVJOB'}, (result) => {
            if (result.error == false) {
                $('#img_container').css('display', 'block');
                $('#x6Ia5ntokb').attr('readonly', true);
                $('#dkpm-forgot-password-btn').css('display', 'none');
                for (var i=0; i < 6; i++) {
                    const url = new URL(result.image[i]);
                    $('#img_album').append('<input type="checkbox" name="image[]" value="'+url.pathname.replace('/photo-','')+'" id="'+url.pathname.replace('/','')+'" /><label for="'+url.pathname.replace('/','')+'"><img class="image_album" id="'+url.pathname.replace('/photo-','')+'" src="'+url+'" /></label>');
                }
            } else {
                if (result.message == "permissions") {
                    Swal.fire({
                        position: 'center',
                        title: chrome.i18n.getMessage('permissions'),
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        location.reload();
                    })
                } else if (result.message == "disconneted") {
                    Swal.fire({
                        position: 'center',
                        title: chrome.i18n.getMessage('disconneted'),
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        location.reload();
                    })
                } else if (result.message == "wrong_many_image") {
                    Swal.fire({
                        position: 'center',
                        title: chrome.i18n.getMessage('wrong_many_image'),
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        position: 'center',
                        title: chrome.i18n.getMessage('invalid_account'),
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        location.reload();
                    })
                }   
            }
        });
    });

    const jCw9Oteh5K = [];

    $('#img_album').on('click', '.image_album', function() {
        $(this).toggleClass('img_border');
        if (jCw9Oteh5K.includes($(this).attr('id'))) {
            var index = jCw9Oteh5K.indexOf($(this).attr('id'));
            if (index >= 0) {
                jCw9Oteh5K.splice(index, 1);
            }
        } else {
            jCw9Oteh5K.push($(this).attr('id'));
        }
    });

    $('#dkpm-forgot-password-validation-btn').click(async (e) => {
        e.preventDefault();

        if ($('#x6Ia5ntokb').val() && jCw9Oteh5K.length == 4) {
            $('#loading_container').css('visibility','visible');
            
            chrome.runtime.sendMessage({'uHgUc0Qc9m': $('#x6Ia5ntokb').val(), 'qu7q2ntinj': jCw9Oteh5K, 'e6PupyHdFX': 'kpHslY8HZh'}, (result) => {
                if (result.error == false) {
                    $('#loading_container').css('visibility','hidden');
                    Swal.fire({
                        position: 'center',
                        title: chrome.i18n.getMessage('forgot_validation_success'),
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        location.reload();
                    })
                } else if (result.message == "disconneted") {
                    $('#loading_container').css('visibility','hidden');
                    Swal.fire({
                        position: 'center',
                        title: chrome.i18n.getMessage('disconneted'),
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        location.reload();
                    })
                } else if (result.message == "permissions") {
                    $('#loading_container').css('visibility','hidden');
                    Swal.fire({
                        position: 'center',
                        title: chrome.i18n.getMessage('permissions'),
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        location.reload();
                    })
                } else if (result.message == "wrong_image") {
                    $('#loading_container').css('visibility','hidden');
                    Swal.fire({
                        position: 'center',
                        title: chrome.i18n.getMessage('forgot_validation_fail') + " " + result.times + " " + chrome.i18n.getMessage('chance'),
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        location.reload();
                    });
                } else if (result.message == "wrong_many_image") {
                    $('#loading_container').css('visibility','hidden');
                    Swal.fire({
                        position: 'center',
                        title: chrome.i18n.getMessage('wrong_many_image'),
                        icon: 'error',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        location.reload();
                    });
                }
            });
        } else {
            $('#loading_container').css('visibility','hidden');
            Swal.fire({
                position: 'center',
                title: chrome.i18n.getMessage('empty'),
                icon: 'error',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                location.reload();
            });
        }
    });
})(jQuery);