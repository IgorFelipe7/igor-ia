<?php

include_once '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['name'], $_POST['email'], $_POST['password'], $_POST['password2'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password2 = $_POST['password2'];

        if ($password != $password2) {
            header("Location: index.php?error=As senhas não coincidem.");
            exit();
        } else {
            if (strlen($password) < 8) {
                header("Location: index.php?error=A senha deve ter pelo menos 8 caracteres.");
                exit();
            }

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            if ($conexao->connect_error) {
                die("Erro ao conectar ao banco de dados: " . $conexao->connect_error);
            }

            $stmt = $conexao->prepare("SELECT * FROM users WHERE email=?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                header("Location: index.php?error=Usuário já existe.");
                exit();
            } else {
                $sql = "INSERT INTO users(nome, email, senha) VALUES (?, ?, ?)";
                $stmt = $conexao->prepare($sql);
                $stmt->bind_param("sss", $name, $email, $hashed_password);

                if ($stmt->execute()) {
                    header("Location: index.php?success=Cadastro realizado com sucesso!");
                    exit();
                } else {
                    echo "Erro ao cadastrar: " . $stmt->error;
                }
            }

            $stmt->close();
            $conexao->close();
        }
    } else {
        header("Location: index.php?error=Todos os campos devem ser preenchidos.");
        exit();
    }
}

?>
