<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tilt+Neon&display=swap" rel="stylesheet">
    <title>Pessoas Empresa</title>
</head>
<body>
    <div class="header div">
        <h1 class="title funcionarios">Funcionários</h1>
        <h1 class="title addfuncionario">
            <a href="addPessoa.php">
                Adicionar funcionários
            </a>
        </h1>
    </div>
    <div class="body div">
        <?php
        include(__DIR__ . '/../bd/connectionBD.php');

        if (isset($conn) && $conn) {
            $sql = "SELECT nome, cpf, idade, carteiratrab, setor, turno, salario FROM Funcionario";
            $result = $conn->query($sql);

            if ($result) {
                $num_rows = $result->num_rows;
            } else {
                $num_rows = 0;
            }
        } else {
            $num_rows = 0;
        }
        ?>
        <h1>Número de registros: <?php echo $num_rows; ?></h1>
        <?php
        if ($num_rows > 0) {
            ?>
            <table>
            <?php
            while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <th>Nome: <?php echo $row['nome']; ?> </td>
                    <th>Cpf: <?php echo $row['cpf']; ?> </td>
                    <th>Idade: <?php echo $row['idade']; ?> </td>
                    <th>Carteira de Trabalho: <?php echo $row['carteiratrab']; ?> </th>
                    <th>Setor: <?php echo $row['setor']; ?> </th>
                    <th>Turno: <?php echo $row['turno']; ?> </th>
                    <th>Salário: <?php echo $row['salario']; ?> </th>
                </tr>
                <?php
            }
            ?>
            </table>
            <?php
        }
        ?>
    </div>
</body>
</html>