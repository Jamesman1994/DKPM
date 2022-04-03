
$(document).ready(function(){
    $('#dkpm-register-form-btn').prop('disabled', false);
    $('.loading-box').css('visibility','hidden');
});

$('#img_album').on('click', '.image_album', function() {
    $(this).toggleClass('img_border');
});

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

        if (result.error) {
            if (result.status == "repeat") {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'The email is already registered!',
                    showConfirmButton: false,
                    timer: 2000
                });
            } else if (result.status == "image_wrong") {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'You must choose at least one photo!',
                    showConfirmButton: false,
                    timer: 2000
                });
            } else if (result.status == "password_wrong") {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'The passwords are not the same!',
                    showConfirmButton: false,
                    timer: 2000
                });
            }
        } else {
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'The registration is successful, please go to the mailbox to activate the account!',
                showConfirmButton: false,
                timer: 2000
            });
        }
    } else {
        dkpmForm.reportValidity();
    }
};
  