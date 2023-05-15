<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $company = $_POST['company'];
    $email = $_POST['email'];

    // Verifica se o e-mail já está cadastrado no banco de dados
    include('database.php');

    $checkEmailQuery = "SELECT * FROM emails WHERE email = '$email'";
    $checkEmailResult = $conn->query($checkEmailQuery);

    if ($checkEmailResult->num_rows > 0) {
        // O e-mail já está cadastrado no banco de dados, não é necessário cadastrar novamente
        //echo 'duplicate';
        header('Location: ../index.php');
        exit;
    }

    // Salva o e-mail no banco de dados
    $insertEmailQuery = "INSERT INTO emails (email) VALUES ('$email')";

    if ($conn->query($insertEmailQuery) === TRUE) {
        // E-mail salvo com sucesso no banco de dados
    } else {
        // Erro ao salvar o e-mail no banco de dados
        //echo 'error';
        header('Location: ../index.php');
        exit;
    }

    // Envia o e-mail com as informações para o destinatário
    $to = 'augusto@rsprojeto.com';
    $subject = 'Novo contato';
    $message = "Nome: $name\nEmpresa: $company\nE-mail: $email";
    $headers = "From: $email";

    if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['attachment']['tmp_name'];
        $fileName = $_FILES['attachment']['name'];
        $fileType = $_FILES['attachment']['type'];
        $fileSize = $_FILES['attachment']['size'];

        $attachment = chunk_split(base64_encode(file_get_contents($file)));

        $boundary = md5(time());

        $headers .= "\r\nMIME-Version: 1.0\r\n";
        $headers .= "Content-Type: multipart/mixed; boundary=\"" . $boundary . "\"\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();

        $message = "--" . $boundary . "\r\n";
        $message .= "Content-Type: text/plain; charset=\"iso-8859-1\"\r\n";
        $message .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
        $message .= $message . "\r\n\r\n";

        $message .= "--" . $boundary . "\r\n";
        $message .= "Content-Type: " . $fileType . "; name=\"" . $fileName . "\"\r\n";
        $message .= "Content-Transfer-Encoding: base64\r\n";
        $message .= "Content-Disposition: attachment; filename=\"" . $fileName . "\"\r\n\r\n";
        $message .= $attachment . "\r\n\r\n";
        $message .= "--" . $boundary . "--";

        if (mail($to, $subject, $message, $headers)) {
            //echo 'success';
            header('Location: ../index.php');
        } else {
            //echo 'error';
            header('Location: ../index.php');
        }
    } else {
        //echo 'error';
        header('Location: ../index.php');
    }
} else {
    header('Location: ../index.php');
    exit;
}
