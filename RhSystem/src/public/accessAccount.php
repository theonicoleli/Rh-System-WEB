<?php
    session_start();

    include(__DIR__ . '/../bd/connectionBD.php');

    function getSetor($login) {
        global $conn;
        
        $login = $conn->real_escape_string($login);
        
        $query = "SELECT NomeSetor FROM FUNCIONARIOS WHERE login = '$login'";
        
        $result = $conn->query($query);
        
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['NomeSetor'];
        }
        
        return null;
    }

    function getCpf($login) {
        global $conn;
        
        $login = $conn->real_escape_string($login);
        
        $query = "SELECT NomeSetor FROM FUNCIONARIOS WHERE login = '$login'";
        
        $result = $conn->query($query);
        
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['cpf'];
        }
        
        return null;
    }

    $login = $_POST["login"];
    $senha = $_POST["senha"];

    if (autenticarUsuario($login, $senha)) {
        $_SESSION["logado"] = true;
        $_SESSION["nome_usuario"] = $login;

        $NomeSetor = getSetor($login);
        $_SESSION["NomeSetor"] = $NomeSetor;

        $cpf = getCpf($login);
        $_SESSION["cpf"] = $cpf;

        header("Location: index.php");
        exit();
    } else {
        echo "<script>alert('Verifique seu login e senha!'); history.go(-1);</script>";
        exit();
    }
?>
