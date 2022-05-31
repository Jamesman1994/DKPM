(function ($) {
    $('#dkpmLoginForm').submit(async (e) => {
        e.preventDefault();

        if (document.getElementById("dkpmLoginForm").checkValidity() && $('#user_email').val().length != 0 && $('#user_password').val().length != 0) {
            chrome.runtime.sendMessage({ 'user_email': $('#user_email').val(), 'user_password': $('#user_password').val(), /*'user_token': $('[name=h-captcha-response]').val(),*/ A76ELG5q4o: 'PcQPiXxU3W' },
                (result) => {
                    if (result.error) {
                        if (result.message == "invalid_account") {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                text: chrome.i18n.getMessage('invalid_account'),
                                showConfirmButton: false,
                                timer: 2000
                            })
                        } else if (result.message == "inactivated_account") {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                text: chrome.i18n.getMessage('inactivated_account'),
                                showConfirmButton: false,
                                timer: 2000
                            })
                        } else if (result.message == "wrong_password") {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                text: chrome.i18n.getMessage('wrong_password'),
                                showConfirmButton: false,
                                timer: 2000
                            })
                        } else if (result.message == "wrong_many_password") {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                text: chrome.i18n.getMessage('wrong_many_password'),
                                showConfirmButton: false,
                                timer: 2000
                            })
                        }
                        //hcaptcha.reset();
                    } else if (!result.error) {
                        $('main').css('display', 'none');
                        $('#gate').css('display', 'block');
                        $('#right_gate_open').animate({ right: '-=250px' }, 2000);
                        $('#left_gate_open').animate({ left: '-=250px' }, 2000);
                        setTimeout(function () {
                            location.href = 'x4AnfkCRYK.html';
                        }, 2000);
                    }
                }
            );
        } else {
            $('#dkpmLoginForm').reportValidity();
        }
    });

    // add Class and remove Class
    $('.dkpm-input').each(function () {
        $(this).on('blur', function () {
            if ($(this).val().trim() != "") {
                $(this).addClass('has-val');
            }
            else {
                $(this).removeClass('has-val');
            }
        })
    })

    // validation
    var input = $('.validate-input .dkpm-input');

    $('.validate-form').on('submit', function () {
        /*var check = true;

        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                showValidate(input[i]);
                check=false;
            }
        }

        return check;*/
    });


    $('.validate-form .dkpm-input').each(function () {
        $(this).focus(function () {
            hideValidate(this);
        });
    });

    function validate(input) {
        if ($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
            if ($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                return false;
            }
        }
        else {
            if ($(input).val().trim() == '') {
                return false;
            }
        }
    }

    function showValidate(input) {
        var thisAlert = $(input).parent();
        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();
        $(thisAlert).removeClass('alert-validate');
    }

    $("#read-password-btn").click(function () {
        if ($(this).hasClass('fa-eye')) {
            $(this).removeClass('fa-eye').addClass('fa-eye-slash');
            $('#user_password').prop('type', 'text');
        } else {
            $(this).removeClass('fa-eye-slash').addClass('fa-eye');
            $('#user_password').prop('type', 'password');
        }
    });
})(jQuery);


