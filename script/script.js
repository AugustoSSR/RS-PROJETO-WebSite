document.getElementById('signup-form').addEventListener('submit', function (event) {
    var emailInput = document.querySelector('input[name="email"]');
    var errorMessage = document.getElementById('email-error');

    if (!validateEmail(emailInput.value)) {
        errorMessage.textContent = 'Por favor, insira um e-mail válido.';
        showAlert('Por favor, insira um e-mail válido.', 'danger');
        event.preventDefault();
    } else {
        errorMessage.textContent = '';
        var formData = new FormData(this);

        fetch(this.action, {
            method: this.method,
            body: formData
        })
            .then(function (response) {
                if (response.ok) {
                    showAlert('Obrigado por se inscrever! Seu e-mail foi enviado com sucesso.', 'success');
                } else {
                    showAlert('Ocorreu um erro. Por favor, tente novamente mais tarde.', 'danger');
                }
            })
            .catch(function (error) {
                showAlert('Ocorreu um erro. Por favor, tente novamente mais tarde.', 'danger');
            });

        event.preventDefault();
    }
});

function validateEmail(email) {
    var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

function showAlert(message, type) {
    const alert = `
    <div class="alert alert-${type} alert-dismissible fade show" role="alert">
      ${message}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  `;
    document.querySelector('#alerts').innerHTML = alert;
}
