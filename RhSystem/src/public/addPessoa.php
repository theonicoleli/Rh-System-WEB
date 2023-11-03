<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/addPerson.css">
    <title>Add Person</title>
</head>
<body>
    <div class="square">
        <form name="form" id="form" action="linkingNewPerson.php" method="post">
            <p class="p titulo">Novo funcionário</p>
            <p class="p nome">Nome </p>
            <input type="text" name="nome" placeholder="Nome"><br>
            <p class="p dtnasc">Data de Nascimento </p>
            <input type="date" name="DataNasc" id="DataNasc" placeholder="Data de Nascimento"><br>
            <p class="p salario">Salário: </p>
            <input type="text" name="salario" placeholder="Salário"><br>
            <p class="p cpf">Cpf: </p>
            <input type="text" name="cpf" placeholder="Cpf"><br>
            <p class="p ct">Carteira de Trabalho: </p>
            <input type="text" name="carteiratrab" placeholder="Carteira de Trabalho"><br>
            <p class="p setor">Setor: </p>
            <input type="text" name="setor" placeholder="Setor"><br>
            <p class="p turno">Turno: </p>
            <input type="text" name="turno" placeholder="Turno"><br>
            <p class="p funcao">Função: </p>
            <input type="text" name="funcao" placeholder="Função"><br><br>
            <input type="submit" value="Enviar">
        </form>
    </div>
</body>
</html>