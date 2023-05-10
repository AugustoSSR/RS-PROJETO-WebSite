<!DOCTYPE html>
<html>

<head>
    <title>Seja o primeiro a saber!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <div class="container">
        <div class="form-container">
            <div class="logo">
                <img src="./img/logo.png" alt="Logo" width="150">
            </div>
            <h1>Seja o primeiro a saber!</h1>
            <p>Inscreva-se para receber atualizações por e-mail.</p>
            <form action="processar.php" method="post" id="signup-form">
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Seu e-mail" required>
                </div>
                <div class="error-message" id="email-error"></div>
                <button class="btn btn-primary" type="submit">Inscrever</button>
            </form>
        </div>
    </div>


    <div class="container" id="alerts">
        <!-- Alertas serão adicionados aqui -->
    </div>

    <script src="./script/script.js"></script>
</body>

</html>