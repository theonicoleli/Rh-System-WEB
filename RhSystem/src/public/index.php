<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/login.css">
    <title>Login</title>
</head>
<body>
    <div class="square">
        <form name="form" id="form" action="accessAccount.php" method="post">
            <p class="p titulo">Login</p>
            <p class="p login">Usuário</p>
            <input type="text" name="login" id="login" placeholder="Usuário">
            <p class="p senha">Senha</p>
            <input type="password" name="senha" id="senha" placeholder="Senha"><br>
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>
