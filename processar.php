<?php
if (isset($_GET['alerta'])) {
    $alerta = $_GET['alerta'];

    if ($alerta === 'success') {
        echo '<script>showAlert("Obrigado por se inscrever! Seu e-mail foi enviado com sucesso.", "success");</script>';
    } else if ($alerta === 'error') {
        echo '<script>showAlert("Ocorreu um erro. Por favor, tente novamente mais tarde.", "danger");</script>';
    }
}

// Verifica se o e-mail já está cadastrado
$existingEmailQuery = "SELECT * FROM email WHERE email = '$email'";
$existingEmailResult = $conn->query($existingEmailQuery);

if ($existingEmailResult->num_rows > 0) {
    echo '<script>showAlert("Este e-mail já está cadastrado.", "danger");</script>';
} else {
    // Insere o e-mail na tabela do banco de dados
    $insertQuery = "INSERT INTO email (email) VALUES ('$email')";

    if ($conn->query($insertQuery) === TRUE) {
        // Envio do e-mail com os dados
        $to = "augusto@rsprojeto.com";
        $subject = "Novo e-mail de inscrição";
        $message = "Um novo e-mail foi cadastrado: $email";
        $headers = "From: augusto@rsprojeto.com";

        if (mail($to, $subject, $message, $headers)) {
            echo '<script>showAlert("Obrigado por se inscrever! Seu e-mail foi enviado com sucesso.", "success");</script>';
        } else {
            echo '<script>showAlert("Obrigado por se inscrever! No entanto, ocorreu um erro ao enviar o e-mail.", "danger");</script>';
        }
    } else {
        echo '<script>showAlert("Erro ao inserir o e-mail: ' . $conn->error . '", "danger");</script>';
    }
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
// Obtém o e-mail enviado pelo formulário
$email = $_POST["email"];

// Valida o e-mail
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
// Redireciona para a página index com o parâmetro 'alerta' definido como 'erro'
header("Location: index.php?alerta=erro");
exit;
}

// Conecta ao banco de dados (substitua as informações de conexão com o seu próprio banco de dados)
$servername = "108.167.188.237";
$username = "eletr258";
$password = "THTBE1504lrlse!@#";
$dbname = "eletr258_eletrictel";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se a conexão foi estabelecida com sucesso
if ($conn->connect_error) {
die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Verifica se o e-mail já existe no banco de dados
$existingEmailQuery = "SELECT email FROM email WHERE email = '$email'";
$existingEmailResult = $conn->query($existingEmailQuery);

// Verifica se o e-mail já está cadastrado
if ($existingEmailResult->num_rows > 0) {
// Redireciona para a página index com o parâmetro 'alerta' definido como 'erro'
header("Location: index.php?alerta=erro");
exit;
}

// Insere o e-mail na tabela do banco de dados
$insertQuery = "INSERT INTO email (email) VALUES ('$email')";

if ($conn->query($insertQuery) === TRUE) {
// Envio do e-mail com os dados
$to = "augusto@rsprojeto.com";
$subject = "Novo e-mail de inscrição";
$message = "Um novo e-mail foi cadastrado: $email";
$headers = "From: augusto@rsprojeto.com";

if (mail($to, $subject, $message, $headers)) {
// Redireciona para a página index com o parâmetro 'alerta' definido como 'sucesso'
header("Location: index.php?alerta=sucesso");
exit;
} else {
// Redireciona para a página index com o parâmetro 'alerta' definido como 'erro'
header("Location: index.php?alerta=erro");
exit;
}
} else {
// Redireciona para a página index com o parâmetro 'alerta' definido como 'erro'
header("Location: index.php?alerta=erro");
exit;
}

// Verifica se o processamento foi bem-sucedido
if ($processamentoSucesso) {
// Redireciona para a página index com o parâmetro 'alerta' definido como 'sucesso'
header("Location: index.php?alerta=sucesso");
exit;
} else {
// Redireciona para a página index com o parâmetro 'alerta' definido como 'erro'
header("Location: index.php?alerta=erro");
exit;
}

// Fecha a conexão com o banco de dados
$conn->close();
}