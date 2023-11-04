<?php
include(__DIR__ . '/../bd/connectionBD.php');

session_start();

$personId = isset($_POST['id_func']) ? $_POST['id_func'] : '';

if (isset($conn) && $conn) {
    $sql = "SELECT nome, datanasc, salario, cpf, carteiratrabalho, nomesetor, turno, funcao
            FROM Funcionarios
            WHERE ID_FUNC = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $personId);
    $stmt->execute();
    $stmt->bind_result($personNome, $personDtNasc, $personSalario, $personCpf, $personCt, $personSetor, $personTurno, $personFuncao);
    $stmt->fetch();
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $personNome = isset($_POST['nome']) && !empty($_POST['nome']) ? $_POST['nome'] : $personNome;
    $personDtNasc = isset($_POST['datanasc']) && !empty($_POST['datanasc']) ? $_POST['datanasc'] : $personDtNasc;
    $personSalario = isset($_POST['salario']) && !empty($_POST['salario']) ? $_POST['salario'] : $personSalario;
    $personCpf = isset($_POST['cpf']) && !empty($_POST['cpf']) ? $_POST['cpf'] : $personCpf;
    $personCt = isset($_POST['ct']) && !empty($_POST['ct']) ? $_POST['ct'] : $personCt;
    $personSetor = isset($_POST['setor']) && !empty($_POST['setor']) ? $_POST['setor'] : $personSetor;
    $personTurno = isset($_POST['turno']) && !empty($_POST['turno']) ? $_POST['turno'] : $personTurno;
    $personFuncao = isset($_POST['funcao']) && !empty($_POST['funcao']) ? $_POST['funcao'] : $personFuncao;

}

if (isset($conn) && $conn) {
    $sql = "UPDATE Funcionarios
            SET nome = ?, datanasc = ?, salario = ?,
            cpf = ?, carteiratrabalho = ?, nomesetor = ?,
            turno = ?, funcao = ?
            WHERE ID_FUNC = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssi", $personNome, $personDtNasc, $personSalario, $personCpf, $personCt, $personSetor, $personTurno, $personFuncao, $personId);

    if ($stmt->execute()) {
        ?>
        <script>
            alert("Informações do funcionário alteradas com sucesso!");
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
