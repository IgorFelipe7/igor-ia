<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Registrar</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <link rel="stylesheet" href="https://cdn.rawgit.com/michalsnik/aos/2.3.4/dist/aos.css" />
    <script src="https://cdn.rawgit.com/michalsnik/aos/2.3.4/dist/aos.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&family=Poppins:wght@900&display=swap" rel="stylesheet">
</head>
<body>

    <section class="register">
        <div class="register-form">
            <h1>Interaja com sua equipe e transforme suas ideias em realidade.</h1>
            <div class="inputs">
                <?php
                    if (isset($_GET['error'])) {
                        $error = $_GET['error'];
                        echo "<p style='color: red;'>$error</p>";
                    }

                    if (isset($_GET['success'])) {
                        $success = $_GET['success'];
                        echo "<p style='color: green;'>$success</p>";
                        header("refresh:3;url=../");
                    }
                ?>
                <form action="register.php" method="POST">
                    <div class="inputs-content-email">
                        <input type="text" placeholder="Nome" id="name" name="name" required>
                        <input type="text" placeholder="Email" id="email" name="email" required>
                    </div>
                    <div class="inputs-content-password">
                        <input type="password" placeholder="Senha" id="password" name="password" required>
                        <input type="password" placeholder="Repetir a Senha" id="password2" name="password2" required>
                    </div>
                    <div class="agree-terms">
                        <div class="remember">
                            <button></button>
                            <h3>Eu li e concordo com os <span>Termos de uso</span></h3>
                        </div>
                    </div>
                    <button id="register" type="submit" name="register">Criar uma conta</button>
                </form>
            </div>
            <span id="login-link">Já tem uma conta? <a href="../index.php">Login</a></span>
        </div>
        <div class="img-container"></div>
    </section>

</body>
</html>