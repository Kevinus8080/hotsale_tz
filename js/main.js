let Form = $('#register');
const SHOWTIME = 200;
const HIDETIME = 100;
const successToast = new bootstrap.Toast($('#successToast'));
const errorToast = new bootstrap.Toast($('#errorToast'));

Form.find('input').on('click', (e) => {
    $(e.target).removeClass('is-invalid');
});

Form.on('submit', (e) => {
    e.preventDefault();
    e.stopPropagation();

    let error = false;

    // check email
    if (Form.find('#formEmail').val() === '') {
        modalError('#formEmail', 'Email не может быть пустым');
        error = true;
    } else if (Form.find('#formEmail').val().includes('@') === false) {
        modalError('#formEmail', `Email должен содержать '@'`);
        error = true;
    }
    // Check passwords
    if (Form.find('#formPassw').val() !== Form.find('#formRetypePassw').val()) {
        modalError('#formRetypePassw', 'Пароли не совпали!');
        error = true;
    }
    if (Form.find('#formPassw').val() === '') {
        modalError('#formPassw', 'Пароль не может быть пустым!');
        error = true;
    }

    if (error) {
        return;
    }

    $.ajax({
        url: '/api.php?action=register',
        type: 'post',
        data: Form.serialize(),
        beforeSend: () => {
            $('#errorAlert').hide(HIDETIME);
        }
    }).done( (data) => {
        console.log(data);
        if (data.error !== undefined) {
            switch (data.error) {
                case '':
                    $('#registerModal').modal('hide');
                    $('#successToast .toast-body').text('Пользователь успешно зарегистрирован');
                    successToast.show();
                    break;
                case 'USER_ALREADY_REGISTERED':
                    $('#errorAlert').text('Пользователь с таким email уже зарегистрирован');
                    $('#errorAlert').show(SHOWTIME);
                    break;
                case 'EMPTY_EMAIL':
                    modalError('#formEmail', 'Email не может быть пустым');
                    break;
                case 'EMPTY_PASSWORD':
                    modalError('#formPassw', 'Пароль не может быть пустым!');
                    break;
                case 'PASSWORDS_NOT_EQUALS':
                    modalError('#formRetypePassw', 'Пароли не совпали!');
                    break;
            }
        } else {
            $('#errorToast .toast-body').text('Что-то пошло не так, попробуйте позже');
            errorToast.show();
        }
    }).fail( (data) => {
        //Show error
        $('#errorToast .toast-body').text('Что-то пошло не так, попробуйте позже');
        errorToast.show();
    });
});

function modalError(id, message) {
    $(id).addClass('is-invalid');
    $(id + 'Error').text(message);
}

$('#regBtn').on('click', () => {
    $('#errorAlert').hide();
    $(Form.find('input')).each((key, el) => {
        $(el).val('');
    });
    $('#registerModal').modal('show');
});

