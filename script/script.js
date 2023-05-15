$(document).ready(function () {
    $('#contactForm').submit(function (e) {
        e.preventDefault();
        $('.error').remove();
        $('.success').remove();

        var name = $('#name').val().trim();
        var company = $('#company').val().trim();
        var email = $('#email').val().trim();
        var attachment = $('#attachment').val().trim();
        // Validação dos campos
        if (name === '') {
            $('#name').after('<div class="error">Por favor, digite seu nome.</div>');
        }

        if (company === '') {
            $('#company').after('<div class="error">Por favor, digite o nome da empresa.</div>');
        }

        if (email === '') {
            $('#email').after('<div class="error">Por favor, digite um endereço de e-mail válido.</div>');
            // email válido
        } else if (!isValidEmail(email)) {
            $('#email').after('<div class="error">Por favor, digite um endereço de e-mail válido.</div>');
        }

        // Verifica se há algum erro antes de enviar o formulário
        if ($('.error').length === 0) {
            var formData = new FormData(this);

            // Envia os dados do formulário para o arquivo PHP
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                success: function (response) {
                    if (response === 'success') {
                        $('#contactForm').append('<div class="success">O e-mail foi enviado com sucesso!</div>');
                        $('#name').val('');
                        $('#company').val('');
                        $('#email').val('');
                        $('#attachment').val('');
                        setTimeout(function () {
                            window.location.href = 'index.html';
                        }, 3000);
                    } else if (response === 'duplicate') {
                        $('#formAlerts').html('<div class="alert alert-danger">O e-mail já está cadastrado.</div>');
                    } else {
                        $('#formAlerts').html('<div class="alert alert-danger">Ocorreu um erro ao enviar o e-mail.</div>');
                    }
                },
                error: function () {
                    $('#formAlerts').html('<div class="alert alert-danger">Ocorreu um erro ao enviar o e-mail.</div>');
                },
                cache: false,
                contentType: false,
                processData: false
            });
        }
    });

    // Função para validar o formato do e-mail
    function isValidEmail(email) {
        var pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return pattern.test(email);
    }
});
