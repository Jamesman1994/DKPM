$('.img_album').on('load', function () {
    $('#dkpm-register-form-btn').prop('disabled', true);
});

$('#img_album').on('click', '.image_album', function() {
    $(this).toggleClass('img_border');
});


/*function get_random_list() {
    for (var i = 0; i < 6; i++) {
        $('#img_album').append('<img id="sig'+i+'" class="image_album" src="https://source.unsplash.com/random/210x150?sig='+i+'">');
    }  
}*/

function get_random_list() {
    for (var i=0; i< 6; i++) {
        const response = fetch('https://source.unsplash.com/random/210x150?sig=' + i)
        .then((response) => {
            const url = new URL(response.url);
            $('#img_album').append('<input type="checkbox" name="image[]" value="'+url.pathname.replace('/photo-','')+'" id="'+url.pathname.replace('/','')+'" /><label for="'+url.pathname.replace('/','')+'"><img class="image_album" src="https://images.unsplash.com/photo-'+url.pathname.replace('/photo-','')+'?crop=entropy&cs=tinysrgb&fit=crop&fm=jpg&h=150&q=80&w=210" /></label>');
        })
    }
}
  
get_random_list();

dkpmForm.onsubmit = async (e) => {
    e.preventDefault();
    
    if (dkpmForm.checkValidity() && $('#user_email').val().length != 0 && $('#user_password').val().length >= 8 && $('#user_password').val().length <= 16 && $('#retype_password').val().length >= 8 && $('#retype_password').val().length <= 16) {
        const response = await fetch('http://dkpm.com/api/register_validation.php', {
            method: 'POST',
            body: new FormData(dkpmForm)
        });

        const result = await response.json();
        console.log(result);
    
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
            location.href = 'login.html';
        }
    } else {
        dkpmForm.reportValidity();
    }
    
};
  