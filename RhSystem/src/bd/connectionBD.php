<?php
    $servername = "localhost:3306";
    $username = "root";
    $password = "PUC@1234";
    $database = "PJBL";

    $conn = new mysqli($servername, $username, $password, $database);
    if ($conn->connect_error) {
        die("Conexão falhou: ${$conn->connect_error}");
    }
?>