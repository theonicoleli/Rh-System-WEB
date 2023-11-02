function retirarFuncionario(funcionario, id) {
    if (confirm(`Realmente deseja remover o funcionário do cpf: ${funcionario}?`)) {
        window.location = `remove_func.php?id_func=${id}`;
    } else {
        window.location = "menu.php";
    }
}

function editarFuncionario(funcionario, id) {
    if (confirm(`Realmente deseja alterar o funcionario do cpf: ${funcionario}`)) {
        window.location = `changingEmployee.php?id_func=${id}`;
    } else {
        window.location = "menu.php";
    }
}