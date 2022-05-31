(function ($) {
    $(document).ready(function(){
        $('#dkpm-register-form-btn').prop('disabled', false);
        for (var i = 0; i < 4; i++) {
            const response = fetch('https://source.unsplash.com/random/210x150?sig=' + i)
            .then((response) => {
                const url = new URL(response.url);
                $('#img_album').append('<input type="checkbox" name="image[]" value="'+url.pathname.replace('/photo-','')+'" id="'+url.pathname.replace('/','')+'" required /><label for="'+url.pathname.replace('/','')+'"><img class="image_album" id="'+url.pathname.replace('/photo-','')+'" src="https://images.unsplash.com/photo-'+url.pathname.replace('/photo-','')+'?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=130&q=80&w=190" /></label>');
            })
        }
    });

    $('#refresh_album').click(function() {
        $('#img_album').empty();
        for (var j = 0; j < 4; j++) {
            const response = fetch('https://source.unsplash.com/random/210x150?sig=' + j)
            .then((response) => {
                const url = new URL(response.url);
                $('#img_album').append('<input type="checkbox" name="image[]" value="'+url.pathname.replace('/photo-','')+'" id="'+url.pathname.replace('/','')+'" required /><label for="'+url.pathname.replace('/','')+'"><img class="image_album" id="'+url.pathname.replace('/photo-','')+'" src="https://images.unsplash.com/photo-'+url.pathname.replace('/photo-','')+'?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=130&q=80&w=190" /></label>');
            })
        }
    });

    const Dvtc0nYemQ = [];

    $('#img_album').on('click', '.image_album', function() {
        $(this).toggleClass('img_border');
        if (Dvtc0nYemQ.includes($(this).attr('id'))) {
            var index = Dvtc0nYemQ.indexOf($(this).attr('id'));
            if (index >= 0) {
                Dvtc0nYemQ.splice(index, 1);
            }
        } else {
            Dvtc0nYemQ.push($(this).attr('id'));
        }
    });

    $('#dkpmRegisterForm').submit(async (e) => {
        e.preventDefault();

        if (document.getElementById("dkpmRegisterForm").checkValidity() && $('#user_email').val().length != 0 && $('#user_password').val().length >= 8 && $('#user_password').val().length <= 16 && $('#retype_password').val().length >= 8 && $('#retype_password').val().length <= 16 && Dvtc0nYemQ.length == 4) {
            //var image_array = [];

            //$('input:checkbox[name="image[]"]:checked').each(function(){
            //    image_array.push($(this).val());
            //});
            
            $('#loading_container').css('visibility','visible');

            chrome.runtime.sendMessage({'user_email': $('#user_email').val(), 'user_password': $('#user_password').val(), 'retype_password': $('#retype_password').val(), 'image': Dvtc0nYemQ, 'rihl1xkQng': 'uwlg82x0SU'},
                (result) => {
                    if (result.error) {
                        if (result.message == "permissions") {
                            $('#loading_container').css('visibility','hidden');
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                text: chrome.i18n.getMessage('permissions'),
                                showConfirmButton: false,
                                timer: 2000
                            }).then(() => {
                                location.reload();
                            });
                        } else if (result.message == "existed_account") {
                            $('#loading_container').css('visibility','hidden');
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                text: chrome.i18n.getMessage('existed_account'),
                                showConfirmButton: false,
                                timer: 2000
                            }).then(() => {
                                location.reload();
                            });
                        } else if (result.message == "wrong_image") {
                            $('#loading_container').css('visibility','hidden');
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                text: chrome.i18n.getMessage('wrong_image'),
                                showConfirmButton: false,
                                timer: 2000
                            }).then(() => {
                                location.reload();
                            });
                        } else if (result.message == "not_match_password") {
                            $('#loading_container').css('visibility','hidden');
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                text: chrome.i18n.getMessage('not_match_password'),
                                showConfirmButton: false,
                                timer: 2000
                            }).then(() => {
                                location.reload();
                            });
                        }
                    } else {
                        $('#loading_container').css('visibility','hidden');
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            text: chrome.i18n.getMessage('registration_success'),
                            showConfirmButton: false,
                            timer: 2000
                        }).then(() => {
                            location.reload();
                        });
                    }
                }
            );
        } else {
            $('#dkpmRegisterForm').reportValidity();
        }
    });

    $(".read-password-btn").click(function() {
        if ($(this).hasClass('fa-eye')) {
            $(".read-password-btn").removeClass('fa-eye').addClass('fa-eye-slash');
            $('#user_password').prop('type', 'text');
            $('#retype_password').prop('type', 'text');
        } else {
            $(".read-password-btn").removeClass('fa-eye-slash').addClass('fa-eye');
            $('#user_password').prop('type', 'password');
            $('#retype_password').prop('type', 'password');
        }
    });
})(jQuery);
  