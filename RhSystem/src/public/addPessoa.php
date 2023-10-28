<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Person</title>
</head>
<body>
    <h1 class="title newf">
        Adicionando novo funcionário:
    </h1>
    <form name="form" id="form" action="linkingNewPerson.php" method="post">
        <p>Nome: </p>
        <input type="text" name="nome"><br>
        <p>Data de Nascimento: </p>
        <input type="date" name="DataNasc" id="DataNasc"><br>
        <p>Salário: </p>
        <input type="text" name="salario"><br>
        <p>Cpf: </p>
        <input type="text" name="cpf"><br>
        <p>Carteira de Trabalho: </p>
        <input type="text" name="carteiratrab"><br>
        <p>Setor: </p>
        <input type="text" name="setor"><br>
        <p>Turno: </p>
        <input type="text" name="turno"><br>
        <p>Função: </p>
        <input type="text" name="funcao"><br><br>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>