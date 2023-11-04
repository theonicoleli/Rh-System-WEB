<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/changingEmployee.css">
    <title>Changing Employee</title>
</head>
<body>
    <?php
        session_start();

        include(__DIR__ . '/../bd/connectionBD.php');

        $personId = isset($_GET['id_func']) ? $_GET['id_func'] : '';
        $personName = $personDtNasc = $personSalario = $personCpf = $personCT = $personSetor = $personTurno = $personFuncao = '';

        if (isset($conn) && $conn) {
            $sql = "SELECT nome, datanasc, salario, cpf, carteiratrabalho, nomesetor, turno, funcao
                    FROM Funcionarios
                    WHERE ID_Func = ?";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $personId);
            $stmt->execute();
            $stmt->bind_result($personName, $personDtNasc, $personSalario, $personCpf, $personCT, 
            $personSetor, $personTurno, $personFuncao);
            $stmt->fetch();
            $stmt->close();
        } else {
            echo "Verifique sua conexão com o banco de dados.";
        }
    ?>
    <div class="square">
        <form name="form" id="form" action="savingEmployeeChanges.php" method="post">
            <input type="hidden" name="id_func" value="<?php echo $personId; ?>">
            <p class="p titulo">Alterando Funcionário</p>
            <p class="p nome">Nome </p>
            <input type="text" name="nome" value="<?php echo $personName;?>" placeholder="Nome"><br>
            <p class="p dtnasc">Data de Nascimento </p>
            <input type="date" name="datanasc" value="<?php echo $personDtNasc;?>" placeholder="Data de Nascimento"><br>
            <p class="p salario">Salário: </p>
            <input type="text" name="salario" value="<?php echo $personSalario;?>" placeholder="Salário"><br>
            <p class="p cpf">Cpf: </p>
            <input type="text" name="cpf" value="<?php echo $personCpf;?>" placeholder="Cpf"><br>
            <p class="p ct">Carteira de Trabalho: </p>
            <input type="text" name="carteiratrab" value="<?php echo $personCT;?>" placeholder="Carteira de trabalho"><br>
            <p class="p setor">Setor: </p>
            <input type="text" name="setor" value="<?php echo $personSetor;?>" placeholder="Setor"><br>
            <p class="p turno">Turno: </p>
            <input type="text" name="turno" value="<?php echo $personTurno;?>" placeholder="Turno"><br>
            <p class="p funcao">Função: </p>
            <input type="text" name="funcao" value="<?php echo $personFuncao;?>" placeholder="Função"><br><br>
            <input type="submit" value="Enviar">
        </form>
    </div>
</body>
</html>
