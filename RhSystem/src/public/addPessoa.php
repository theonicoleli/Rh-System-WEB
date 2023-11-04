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
        <form name="form" id="form" action="linkingNewPerson.php" method="post" enctype="multipart/form-data">
            <label class="p titulo" for="Titulo">Novo funcionário</label>

            <label class="p nome" for="Nome">Nome </label>
            <input type="text" name="nome" placeholder="Nome">

            <label class="p dtnasc" for="DtNasc">Data de Nascimento </label>
            <input type="date" name="DataNasc" id="DataNasc" placeholder="Data de Nascimento">

            <label class="p salario" for="Salario">Salário </label>
            <input type="text" name="salario" placeholder="Salário">

            <label class="p cpf" for="Cpf">Cpf </label>
            <input type="text" name="cpf" placeholder="Cpf">

            <label class="p ct" for="Ct">Carteira de Trabalho </label>
            <input type="text" name="carteiratrab" placeholder="Carteira de Trabalho">

            <label class="p setor" for="Setor">Setor </label>
            <input type="text" name="setor" placeholder="Setor">

            <label class="p turno" for="Turno">Turno </label>
            <input type="text" name="turno" placeholder="Turno">

            <label class="p funcao" for="Funcao">Função </label>
            <input type="text" name="funcao" placeholder="Função">

            <label class="p imagem" for="Imagem">Imagem</label>
            <input type="file" name="imagem">
            
            <input type="submit" value="Enviar">
        </form>
    </div>
</body>
</html>