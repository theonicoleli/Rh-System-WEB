<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User data</title>
</head>
<body>
    <?php
    include(__DIR__ . '/../bd/connectionBD.php');

    $nome = $_POST["nome"];
    $dtNascimento = $_POST["DataNasc"];
    $salario = $_POST["salario"];
    $cpf = $_POST["cpf"];
    $carteiratrab = $_POST["carteiratrab"];
    $setor = strtoupper($_POST["setor"]);
    $turno = strtoupper($_POST["turno"]);
    $funcao = $_POST["funcao"];

    $sql = "INSERT INTO Funcionarios(nome, DataNasc, salario, cpf, carteiratrabalho, nomesetor, turno, funcao) VALUES('$nome', '$dtNascimento',
    '$salario', '$cpf', '$carteiratrab', '$setor', '$turno', '$funcao')";

    try {
        $result = $conn->query($sql);

        if ($result === TRUE) {
            ?>
            <script>
                alert('Usuário cadastrado com sucesso!!!');
                location.href = 'menu.php';
            </script>
            <?php
        } else {
            ?>
            <script>
                alert('Algo não deu certo...');
                history.go(-1);
            </script>
            <?php
        }
    } catch (Exception $e) {
        ?>
        <script>
            alert('Erro: <?php echo $e->getMessage(); ?>');
            history.go(-1);
        </script>
        <?php
    }
    ?>
</body>
</html>
