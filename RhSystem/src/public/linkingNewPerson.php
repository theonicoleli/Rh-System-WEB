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
        $cpf = $_POST["cpf"];
        $idade = $_POST["idade"];
        $carteiratrab = $_POST["carteiratrab"];
        $setor = $_POST["setor"];
        $turno = $_POST["turno"];
        $salario = $_POST["salario"];
        $sql = "INSERT INTO Funcionario(nome, cpf, idade, carteiratrab, setor, turno, salario) VALUES('$nome', '$cpf',
        '$idade', '$carteiratrab', '$setor', '$turno', '$salario')";
        $result = $conn->query($sql);

        if ($result === TRUE) {
            ?>
            <script>
                alert('Usuário cadastrado com sucesso!!!');
                location.href = 'index.php';
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
    ?>
</body>
</html>