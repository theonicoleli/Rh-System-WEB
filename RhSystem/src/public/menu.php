<?php
session_start();
include(__DIR__ . '/../bd/connectionBD.php');

function exibirImagemUsuario($conn)
{
    $sql = "SELECT login, imagem FROM Funcionarios WHERE login = '{$_SESSION['nome_usuario']}'";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        if (isset($row['imagem'])) {
            echo '<h1 class="title addfuncionario">';
            echo '<img class="imagemPessoa" src="data:image/png;base64,' . base64_encode($row["imagem"]) . '" style="width: 50px; height: 50px"/>';
            echo '</h1>';
        }
    }
}

function exibirBotaoAdicionar()
{
    if ($_SESSION["NomeSetor"] === "RH") {
        echo '<h1 class="title addfuncionario">';
        echo '<a href="addPessoa.php">Adicionar funcionários</a>';
        echo '</h1>';
    }
}

function exibirBotaoAlterarLogin($personId)
{
    echo '<h1 class="title alterarlogin" title="alterarLogin">';
    echo "<a href='changingLogin.php?id_func={$personId}'>Alterar Login</a>";
    echo '</h1>';
}

function exibirSelectTurno()
{
    if ($_SESSION["NomeSetor"] === "RH") {
        ?>
        <select class="turno" id="turnoSelect">
            <option value="1">TURNO</option>
            <option value="MANHA">MANHA</option>
            <option value="TARDE">TARDE</option>
            <option value="NOITE">NOITE</option>
        </select>
        <?php
    }
}

function exibirTabelaFuncionarios($conn, $sql, $turnoSelect)
{
    $result = $conn->query($sql);

    if ($result) {
        $num_rows = $result->num_rows;
    } else {
        $num_rows = 0;
    }

    echo "<h2>Número de registros: {$num_rows}</h2>";

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
                                <img class="imagemPessoa" src="data:image/png;base64,<?= base64_encode($row["imagem"]) ?>" style="width: 50px; height: 50px" />
                            </td>
                            <?php
                        } else {
                            ?>
                            <td>Imagem não disponível</td>
                            <?php
                        }
                        ?>
                        <td><?= $row['nome'] ?></td>
                        <td><?= $row['datanasc'] ?></td>
                        <?php
                        if (isset($row['login']) && $row['login'] == $_SESSION["nome_usuario"]) {
                            ?>
                            <td><?= $row['salario'] ?></td>
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
                            <td><?= $row['cpf'] ?></td>
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
                            <td><?= $row['carteiratrabalho'] ?></td>
                            <?php
                        } else {
                            ?>
                            <td>Não disponível</td>
                            <?php
                        }
                        ?>
                        <td><?= $row['nomesetor'] ?></td>
                        <td><?= $row['turno'] ?></td>
                        <td><?= $row['funcao'] ?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
            <?php
        }
    } else if ($_SESSION["NomeSetor"] === "RH" && isset($turnoSelect)) {
        $turno = $turnoSelect;

        if ($turno !== 1) {
            $sql = "SELECT nome, datanasc, salario, cpf, 
                    carteiratrabalho, nomesetor, turno, funcao, 
                    login, id_func, imagem FROM Funcionarios
                    WHERE turno = '{$turno}'";
            $result = $conn->query($sql);

            if ($result) {
                $num_rows = $result->num_rows;
            } else {
                $num_rows = 0;
            }
        } else {
            $sql = "SELECT nome, datanasc, salario, cpf, 
                    carteiratrabalho, nomesetor, turno, funcao, 
                    login, id_func, imagem FROM Funcionarios";
            $result = $conn->query($sql);

            if ($result) {
                $num_rows = $result->num_rows;
            } else {
                $num_rows = 0;
            }
        }

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
                        if ($row['turno'] !== "1") {
                            if ($row['imagem']) {
                                ?>
                                <td>
                                    <img class="imagemPessoa" src="data:image/png;base64,<?= base64_encode($row["imagem"]) ?>" style="width: 50px; height: 50px" />
                                </td>
                                <?php
                            } else {
                                ?>
                                <td>Imagem não disponível</td>
                                <?php
                            }
                            ?>
                            <td><?= $row['nome'] ?></td>
                            <td><?= $row['datanasc'] ?></td>
                            <td><?= $row['salario'] ?></td>
                            <td><?= $row['cpf'] ?></td>
                            <td><?= $row['carteiratrabalho'] ?></td>
                            <td><?= $row['nomesetor'] ?></td>
                            <td><?= $row['turno'] ?></td>
                            <td><?= $row['funcao'] ?></td>
                            <td>
                                <button onclick="editarFuncionario(
                                    '<?= $row['cpf'] ?>',
                                    '<?= $row['id_func'] ?>',
                                    '<?= $row['nome'] ?>',
                                    '<?= $row['datanasc'] ?>',
                                    '<?= $row['salario'] ?>',
                                    '<?= $row['carteiratrabalho'] ?>',
                                    '<?= $row['nomesetor'] ?>',
                                    '<?= $row['turno'] ?>',
                                    '<?= $row['funcao'] ?>'
                                );">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                            </td>
                            <td>
                                <button onclick="retirarFuncionario(
                                    '<?= $row['cpf'] ?>',
                                    '<?= $row['id_func'] ?>'
                                );">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
            <?php
        } else {
            echo "Nenhum funcionário encontrado";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="js/menu.js"></script>
    <link rel="stylesheet" href="styles/menu.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tilt+Neon&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Pessoas Empresa</title>
</head>
<body>

    <div class="header div">
        <?php
        if (isset($conn) && $conn) {
            $sql = "SELECT login, id_func FROM Funcionarios";
            $result = $conn->query($sql);

            while ($row = $result->fetch_assoc()) {
                if ((isset($row['login']) && $row['login'] == $_SESSION["nome_usuario"])) {
                    $personId = $row["id_func"];
                }
            }

            exibirImagemUsuario($conn);
            exibirBotaoAdicionar();
            exibirBotaoAlterarLogin($personId);
            exibirSelectTurno();
        }
        ?>
        <a class="title" href="index.php" title="Sair" 
            onclick="return confirm('Tem certeza que deseja se desconectar da sessão atual?')">Sair</a>
    </div>

    <?php
    if (isset($conn) && $conn) {
        $sql = "SELECT nome, datanasc, salario, cpf, carteiratrabalho, 
        nomesetor, turno, funcao, login, id_func, imagem FROM Funcionarios";
        ?>

        <script>
            $(document).ready(function() {
                let turnoSelecionado = localStorage.getItem('turnoSelect');
                
                if (turnoSelecionado) {
                    $("#turnoSelect").val(turnoSelecionado);
                }

                $("#turnoSelect").change(function() {
                    let turnoSelect = $(this).val();

                    localStorage.setItem('turnoSelect', turnoSelect);

                    $.post('menu.php', { turnoSelect: turnoSelect })
                        .done(function(response) {
                            console.log('Valor enviado com sucesso para o PHP.');
                            $("body").html(response);
                        })
                        .fail(function() {
                            console.error('Erro ao enviar o valor para o PHP.');
                        });
                });
            });
        </script>

        <?php
        if (isset($_POST['turnoSelect'])) {
            $turnosPermitidos = ['MANHA', 'TARDE', 'NOITE'];
            $turno = in_array($_POST['turnoSelect'], $turnosPermitidos) ? $_POST['turnoSelect'] : 1;
        } else {
            $turno = 1;
        }
    } else {
        echo "NomeSetor não está definido na sessão.";
    }
    ?>

    <div class="body div">
        <?php
        exibirTabelaFuncionarios($conn, $sql, $turno);
        ?>
    </div>


</body>
</html>
