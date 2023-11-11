pessoa = 0;

function retirarFuncionario(funcionario, id) {
    if (confirm(`Realmente deseja remover o funcionário do cpf: ${funcionario}?`)) {
        window.location = `remove_func.php?id_func=${id}`;
    } else {
        window.location = "menu.php";
    }
}

function editarFuncionario(cpf, id, nome, datanasc, salario, carteiratrabalho, nomesetor, turno, funcao) {
    if (confirm(`Realmente deseja alterar o funcionário do CPF: ${cpf}`)) {
        const url = `changingEmployee.php?id_func=${id}&nome=${nome}&datanasc=${datanasc}
        &salario=${salario}&carteiratrabalho=${carteiratrabalho}
        &nomesetor=${nomesetor}&turno=${turno}&funcao=${funcao}&cpf=${cpf}`;
        window.location.href = url;
    } else {
        window.location.href = "menu.php";
    }
}

function receberPessoa(id) {
    pessoa = id;
}

function editarLogin() {
    if (id_func !== null) {
        if (confirm(`Realmente deseja alterar seus dados?`)) {
            window.location = `changingLogin.php?id_func=${id_func}`;
        } else {
            window.location = "menu.php";
        }
    }
}