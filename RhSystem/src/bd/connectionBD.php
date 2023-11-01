<?php
    $servername = "localhost";
    $username = "root";
    $password = "PUC@1234";
    $database = "PJBL";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    function autenticarUsuario($login, $senha) {
        global $conn;

        $login = $conn->real_escape_string($login);
        $senha = $conn->real_escape_string($senha);

        $query = "SELECT * FROM FUNCIONARIOS WHERE login = '$login' AND senha = '$senha'";
        $result = $conn->query($query);

        if ($result && $result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
?>
