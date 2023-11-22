<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<form method="POST">
    <label for="nome">Nome:</label>
    <input type="text" name="nome" placeholder="Digite o nome do cliente" minlength="3">
    <label for="email">E-mail:</label>
    <input type="email" name="email" placeholder="Digite o e-mail corporativo do cliente" minlength="3">
    <label for="perfil">Perfil:</label>
    <select name="perfil">
        <option value="">Selecione um perfil</option>
        <option value="1">Cliente</option>
        <option value="2">Colaborador</option>
    </select>
    <input type="submit" value="Cadastrar" name="cadastrar">

    <?php
        if (isset($_REQUEST["cadastrar"]))
        {
            include_once("class/Usuario.php");
            $u = new Usuario();
            $u->create($_REQUEST["nome"], $_REQUEST["email"], $_REQUEST["perfil"]);

            echo $u->inserirUsuario() == true
                ? "<p>Usuário cadastrado</p>"
                : "<p>Ocorreu um erro inesperado. Favor entrar em contato com o administrador.</p>";

        }
    ?>
</form>
</body>
</html>