<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/changingLogin.css">
    <title>Changing Login</title>
</head>
<body>
    <?php 
    session_start();

    include(__DIR__ . '/../bd/connectionBD.php');

    $personId = isset($_GET['id_func']) ? $_GET['id_func'] : '';
    $personLogin = $personSenha = '';

    if (isset($conn) && $conn) {
        $sql = "SELECT login, senha
                FROM Funcionarios 
                WHERE ID_FUNC = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $personId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $personLogin = $row['login'];
                $personSenha = $row['senha'];
            }
        } else {
            echo "Verifique sua conexão com o banco de dados.";
        }

        $stmt->close();
    } else {
        echo "Verifique sua conexão com o banco de dados.";
    }
    ?>
    
    <div class="square">
        <form name="form" id="form" action="savingChanges.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_func" value="<?php echo $personId; ?>">
            <label class="p titulo" for="Titulo">Alterando Login</label>

            <label class="p user" for="User">Usuário </label>
            <input type="text" name="login" id="login" value="<?php echo $personLogin;?>" placeholder="Usuário"><br>

            <label class="p senha" for="Senha">Senha </label>
            <input type="text" name="senha" id="senha" value="<?php echo $personSenha;?>" placeholder="Senha"><br>

            <label class="p imagem" for="Imagem">Imagem </label>
            <input type="file" name="imagem" id="imagem" placeholder="Imagem"><br>

            <input type="submit" value="Enviar">
        </form>
    </div>
</body>
</html>
