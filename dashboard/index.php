<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Login</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='../main.css'>
    <script src='main.js'></script>
    <link rel="stylesheet" href="https://cdn.rawgit.com/michalsnik/aos/2.3.4/dist/aos.css" />
    <script src="https://cdn.rawgit.com/michalsnik/aos/2.3.4/dist/aos.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&family=Poppins:wght@900&display=swap" rel="stylesheet">
</head>
<body>
    <section class="login" data-aos="slide-right" data-aos-duration="800">
        <div class="login-form">
            <h1>Inteligencia <span>Artificial</span></h1>
            <p>Entre no painel para criar experiências incríveis.</p>
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
                <form action="login.php" method="POST">
                    <input type="email" placeholder="Email" id="email" name="email">
                    <input type="password" placeholder="Senha" id="password" name="password">
                    <div class="remember-forgot">
                        <div class="remember">
                            <button></button>
                            <h3>Relembre</h3>
                        </div>
                        <a id="forgot" href="#">Esqueceu Senha?</a>
                    </div>
                    <button id="login" type="submit">Login</button>
                </form>
            </div>
            <span id="register-link">Não tem uma conta? <a href="register/index.php">Registre-se</a></span>
        </div>
        <div class="img-container"></div>
    </section>
    <script src="../main.js"></script>
</body>
</html>