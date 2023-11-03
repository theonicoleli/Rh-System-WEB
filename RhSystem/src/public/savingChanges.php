<?php
include(__DIR__ . '/../bd/connectionBD.php');

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_funcionario = $_POST["id_func"];
    $login = isset($_POST["login"]) ? $_POST["login"] : '';
    $senha = isset($_POST["senha"]) ? $_POST["senha"] : '';

    if (empty($id_funcionario) || empty($login) || empty($senha)) {
        echo "Por favor, preencha todos os campos obrigatórios.";
    } else {
        $sql = "UPDATE Funcionarios
                SET login = ?, senha = ?
                WHERE ID_FUNC = ?";

        if (isset($conn) && $conn) {
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssi", $login, $senha, $id_funcionario);

            if ($stmt->execute()) {
                ?>
                <script>
                    alert("Informações de login alteradas com sucesso!");
                    window.location.href = "menu.php";
                </script>
                <?php
                exit();
            } else {
                echo "Erro ao editar funcionário: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Erro na conexão com o banco de dados.";
        }
    }
} else {
    echo "A requisição não é do tipo POST.";
}
?>
