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
        <p>Cpf: </p>
        <input type="text" name="cpf"><br>
        <p>Idade: </p>
        <input type="text" name="idade"><br>
        <p>Carteira de Trabalho: </p>
        <input type="text" name="carteiratrab"><br>
        <p>Setor: </p>
        <input type="text" name="setor"><br>
        <p>Turno: </p>
        <input type="text" name="turno"><br>
        <p>Salário: </p>
        <input type="text" name="salario"><br><br>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>