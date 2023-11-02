<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/menu.js"></script>
    <link rel="stylesheet" href="styles/menu.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https:fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tilt+Neon&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <title>Pessoas Empresa</title>
</head>
<body>
    <div class="header div">
        <h1 class="title funcionarios">Funcionários</h1>
        <?php
        session_start();

        include(__DIR__ . '/../bd/connectionBD.php');

        if (isset($_SESSION["NomeSetor"])) {
            if ($_SESSION["NomeSetor"] === "RH") {
                ?>
                <h1 class="title addfuncionario">
                    <a href="addPessoa.php">
                        Adicionar funcionários
                    </a>
                </h1>
                <?php
            }
        }
        ?>
    </div> 

    <div class="body div">
        <?php
        if (isset($conn) && $conn) {

            $sql = "SELECT nome, datanasc, salario, cpf, carteiratrabalho, nomesetor, 
            turno, funcao, login, id_func FROM Funcionarios";

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
        if (isset($_SESSION["NomeSetor"])) {
            if ($_SESSION["NomeSetor"] !== "RH") {
                if ($num_rows > 0) {
                    ?>
                    <table class="tabela-funcionarios">
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <th>Nome: <?php echo $row['nome']; ?></th>
                            <?php
                            if (isset($row['login']) && $row['login'] == $_SESSION["nome_usuario"]) {
                                ?>
                                <th>Salário: <?php echo $row['salario']; ?></th>
                                <?php
                            } else {
                                ?>
                                <th>Salário: Não disponível</th>
                                <?php
                            }
                            ?>
                            <th>Data de Nascimento: <?php echo $row['datanasc']; ?></th>
                            <th>Setor: <?php echo $row['nomesetor']; ?></th>
                            <th>Turno: <?php echo $row['turno']; ?></th>
                            <th>Função: <?php echo $row['funcao']; ?></th>
                        </tr>
                        <?php
                    }
                    ?>
                    </table>
                    <?php
                }
            } else {
                $cpfUsuarioLogado = $_SESSION["cpf"];

                if ($num_rows > 0) {
                    ?>
                    <table class="tabela-funcionarios">
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <th>Nome: <?php echo $row['nome']; ?> </th>
                            <th>Data de Nascimento: <?php echo $row['datanasc']; ?> </th>
                            <th>Salário: <?php echo $row['salario']; ?> </th>
                            <th>Cpf: <?php echo $row['cpf']; ?> </th>
                            <th>Carteira de Trabalho: <?php echo $row['carteiratrabalho']; ?> </th>
                            <th>Setor: <?php echo $row['nomesetor']; ?> </th>
                            <th>Turno: <?php echo $row['turno']; ?> </th>
                            <th>Função: <?php echo $row['funcao']; ?> </th>
                            <th><button onclick="editarFuncionario('<?php echo $row['cpf']?>', '<?php echo $row['id_func']?>', '<?php echo $row['nome']?>',
                            '<?php echo $row['datanasc']?>', '<?php echo $row['salario']?>', '<?php echo $row['carteiratrabalho']?>', '<?php echo $row['nomesetor']?>',
                            '<?php echo $row['turno']?>', '<?php echo $row['funcao']?>' );">
                                <i class="fa-solid fa-pen"></i>
                            </button></th>
                            <th><button onclick="retirarFuncionario('<?php echo $row['cpf']?>', '<?php echo $row['id_func']?>');">
                                <i class="fa-solid fa-trash"></i>
                            </button></th>
                        </tr>
                        <?php
                    }
                    ?>
                    </table>
                    <?php
                }
            }
        } else {
            echo "NomeSetor não está definido na sessão.";
        }
        ?>
    </div>
</body>
</html>
