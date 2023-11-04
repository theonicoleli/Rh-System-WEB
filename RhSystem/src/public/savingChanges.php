<?php
include(__DIR__ . '/../bd/connectionBD.php');

session_start();

$personId = isset($_POST['id_func']) ? $_POST['id_func'] : '';
$personLogin = $personSenha = '';
$imagem_binario = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $personLogin = isset($_POST["login"]) ? $_POST["login"] : '';
    $personSenha = isset($_POST["senha"]) ? $_POST["senha"] : '';
    
    $imagem_info = $_FILES["imagem"];

    if ($imagem_info['size'] === 0) {

        if (isset($conn) && $conn) {
            $sql = "SELECT login, imagem FROM Funcionarios WHERE login = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $_SESSION['nome_usuario']);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $stmt->close();

            if (isset($row['imagem']) && $row['login'] == $_SESSION['nome_usuario']) {
                $imagem_binario = $row['imagem'];
            }
        }
    } else {
        $imagem_nome = $imagem_info["name"];
        $imagem_temp = $imagem_info["tmp_name"];
    
        $destino = __DIR__ . "/imagens/" . $imagem_nome;
        move_uploaded_file($imagem_temp, $destino);
    
        $imagem_binario = file_get_contents($destino);
    }
}

if (isset($conn) && $conn) {
    $sql = "UPDATE Funcionarios
            SET login = ?, senha = ?, imagem = ?
            WHERE ID_FUNC = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $personLogin, $personSenha, $imagem_binario, $personId);

    if ($stmt->execute()) {
        ?>
        <script>
            alert("Informações de login e imagem alteradas com sucesso!");
            window.location.href = "menu.php";
        </script>
        <?php
        exit();
    } else {
        echo "Erro ao editar funcionário: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Verifique sua conexão com o banco de dados.";
}
?>
