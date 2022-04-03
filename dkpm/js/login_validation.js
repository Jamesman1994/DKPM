(function ($) {
    $('#user_password').keyup(function (event) {
        if (event.keyCode === 13) {
            event.preventDefault();
            dkpmForm.submit();
        }
    });

    dkpmForm.onsubmit = async (e) => {
        e.preventDefault();
        
        if (dkpmForm.checkValidity() && $('#user_email').val().length != 0 && $('#user_password').val().length != 0) {
            $('#hcaptcha_token').val($('[name=h-captcha-response]').val());

            const response = await fetch('http://dkpm.com/api/auth.php', {
                method: 'POST',
                body: new FormData(dkpmForm)
            });
    
            const result = await response.json();
        
            if (result.error) {
                if (result.status == "invalid") {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Invalid Email',
                        showConfirmButton: false,
                        timer: 1500
                    });
                } else {
                    if (result.status == "wrong") {
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Wrong Password',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                }
            } else {
                location.href = 'index.html';
            }
        } else {
            dkpmForm.reportValidity();
        }
    };

    // add Class and remove Class
    $('.dkpm-input').each(function(){
        $(this).on('blur', function(){
            if($(this).val().trim() != "") {
                $(this).addClass('has-val');
            }
            else {
                $(this).removeClass('has-val');
            }
        })    
    })
  
    // validation
    var input = $('.validate-input .dkpm-input');

    $('.validate-form').on('submit',function(){
        /*var check = true;

        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                showValidate(input[i]);
                check=false;
            }
        }

        return check;*/
    });


    $('.validate-form .dkpm-input').each(function(){
        $(this).focus(function(){
           hideValidate(this);
        });
    });

    function validate (input) {
        if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
            if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                return false;
            }
        }
        else {
            if($(input).val().trim() == ''){
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

    $("#read-password-btn").click(function() {
        if ($(this).hasClass('fa-eye')) {
            $(this).removeClass('fa-eye').addClass('fa-eye-slash');
            $('#user_password').prop('type', 'text');
        } else {
            $(this).removeClass('fa-eye-slash').addClass('fa-eye');
            $('#user_password').prop('type', 'password');
        }
    });
})(jQuery);


