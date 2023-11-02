<?php
include(__DIR__ . '/../bd/connectionBD.php');

session_start();

if (isset($_GET['id_func'])) {

    $id_funcionario = $_GET['id_func'];

    $sql = "UPDATE FUNCIONARIOS WHERE ID_FUNC = $id_funcionario";

    if (isset($conn) && $conn) {

        if ($conn->query($sql) === TRUE) {
            header("Location: menu.php");
            exit();
        } else {
            echo "Erro ao excluir funcionário: " . $conn->error;
        }
    }
} else {
    echo "ID do funcionário não fornecida por URL.";
}
?>