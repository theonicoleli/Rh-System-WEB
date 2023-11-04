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
    <?php
        session_start();

        include(__DIR__ . '/../bd/connectionBD.php');

        if (isset($conn) && $conn) {
            $sql = "SELECT login, imagem FROM Funcionarios";
            $result = $conn->query($sql);
        }

        while ($row = $result->fetch_assoc()) {
            if (isset($row['imagem']) && $row['login'] == $_SESSION['nome_usuario']) {
                ?>
                <h1 class="title addfuncionario">
                    <img class="imagemPessoa" src="data:image/png;base64,<?= base64_encode($row["imagem"])?>" 
                    style="width: 50px; height: 50px"/>
                </h1>
                <?php
            }
        }
        ?>

        <h1 class="title funcionarios">Funcionários</h1>

        <?php
        if (isset($conn) && $conn) {
            $sql = "SELECT login, id_func FROM Funcionarios";
            $result = $conn->query($sql);
        }

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

        while ($row = $result->fetch_assoc()) {
            if ((isset($row['login']) && $row['login'] == $_SESSION["nome_usuario"])) {
                $personId = $row["id_func"];
            }
        }
        ?>
        
        <h1 class="title" title="alterarLogin">
            <a href="changingLogin.php?id_func=<?php echo $personId?>">
                Alterar Login
            </a>
        </h1>

        <a class="title" href="index.php" 
        title="Sair" 
        onclick="return confirm('Tem certeza que deseja se desconectar da sessão atual?')">Sair</a>
    </div> 

    <div class="body div">
        <?php
        if (isset($conn) && $conn) {
            $sql = "SELECT nome, datanasc, salario, cpf, 
            carteiratrabalho, nomesetor, turno, funcao, 
            login, id_func, imagem FROM Funcionarios";
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
        <h2>Número de registros: <?php echo $num_rows; ?></h2>

        <?php
        if (isset($_SESSION["NomeSetor"])) {
            if ($_SESSION["NomeSetor"] !== "RH") {
                if ($num_rows > 0) {
                    ?>
                    <table class="tabela-funcionarios">
                        <tr>
                            <th>Imagens</th>
                            <th>Nome</th>
                            <th>Data de Nascimento</th>
                            <th>Salário</th>
                            <th>Cpf</th>
                            <th>Carteira de Trabalho</th>
                            <th>Setor</th>
                            <th>Turno</th>
                            <th>Função</th>
                        </tr>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <?php
                            if ($row['imagem']) {
                                ?>
                                <td>
                                    <img class="imagemPessoa" src="data:image/png;base64,<?= base64_encode($row["imagem"])?>" 
                                    style="width: 50px; height: 50px"/>
                                </td>
                                <?php
                            } else {
                                ?>
                                <td>
                                    Imagem não disponível
                                </td>
                                <?php
                            }
                            ?>
                            <td><?php echo $row['nome']; ?></td>
                            <td><?php echo $row['datanasc']; ?></td>
                            <?php
                            if (isset($row['login']) && $row['login'] == $_SESSION["nome_usuario"]) {
                                ?>
                                <script>
                                    recebaPessoa(<?php echo $row['id_func']?>);
                                </script>
                                <td><?php echo $row['salario']; ?></td>
                                <?php
                            } else {
                                ?>
                                <td>Não disponível</td>
                                <?php
                            }
                            ?>
                            <?php
                            if (isset($row['login']) && $row['login'] == $_SESSION["nome_usuario"]) {
                                ?>
                                <td><?php echo $row['cpf']; ?></td>
                                <?php
                            } else {
                                ?>
                                <td>Não disponível</td>
                                <?php
                            }
                            ?>
                            <?php
                            if (isset($row['login']) && $row['login'] == $_SESSION["nome_usuario"]) {
                                ?>
                                <td><?php echo $row['carteiratrabalho']; ?></td>
                                <?php
                            } else {
                                ?>
                                <td>Não disponível</td>
                                <?php
                            }
                            ?>
                            <td><?php echo $row['nomesetor']; ?></td>
                            <td><?php echo $row['turno']; ?></td>
                            <td><?php echo $row['funcao']; ?></td>
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
                        <tr>
                            <th>Imagens</th>
                            <th>Nome</th>
                            <th>Data de Nascimento</th>
                            <th>Salário</th>
                            <th>Cpf</th>
                            <th>Carteira de Trabalho</th>
                            <th>Setor</th>
                            <th>Turno</th>
                            <th>Função</th>
                            <th>Editar</th>
                            <th>Excluir</th>
                        </tr>
                    <?php
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <?php
                            if ($row['imagem']) {
                                ?>
                                <td>
                                    <img class="imagemPessoa" src="data:image/png;base64,<?= base64_encode($row["imagem"])?>" 
                                    style="width: 50px; height: 50px"/>
                                </td>
                                <?php
                            } else {
                                ?>
                                <td>
                                    Imagem não disponível
                                </td>
                                <?php
                            }
                            ?>
                            <td><?php echo $row['nome']; ?></td>
                            <td><?php echo $row['datanasc']; ?></td>
                            <td><?php echo $row['salario']; ?></td>
                            <td><?php echo $row['cpf']; ?></td>
                            <td><?php echo $row['carteiratrabalho']; ?></td>
                            <td><?php echo $row['nomesetor']; ?></td>
                            <td><?php echo $row['turno']; ?></td>
                            <td><?php echo $row['funcao']; ?></td>
                            <td>
                                <button
                                    onclick="editarFuncionario(
                                        '<?php echo $row['cpf']?>',
                                        '<?php echo $row['id_func']?>',
                                        '<?php echo $row['nome']?>',
                                        '<?php echo $row['datanasc']?>',
                                        '<?php echo $row['salario']?>',
                                        '<?php echo $row['carteiratrabalho']?>',
                                        '<?php echo $row['nomesetor']?>',
                                        '<?php echo $row['turno']?>',
                                        '<?php echo $row['funcao']?>'
                                    );">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                            </td>
                            <td>
                                <button 
                                    onclick="retirarFuncionario(
                                        '<?php echo $row['cpf']?>', 
                                        '<?php echo $row['id_func']?>'
                                    );">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
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
