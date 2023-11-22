<?php
    session_start();
    
    if (!isset($_SESSION["uid"]))
    {
        header("Location: login.php");
    }
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bazar Sustentável</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Ubuntu&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/main.css">
</head>
<body>
    
    <?php

        include("components/header-interno.html");
        include("components/menu-adm.html");
    ?>

    <main>
        <section class="flex-container">
            <div class="forms-internos">

            <form method="POST">
                <h2>Cadastar novo usuário</h2>
                <label for="nome">Nome:</label><br>
                <input type="text" name="nome" placeholder="Digite o nome do cliente" minlength="3" class="input-comum"><br><br>
                <label for="email">E-mail:</label><br>
                <input type="email" name="email" placeholder="Digite o e-mail corporativo do cliente" minlength="3" class="input-comum"><br><br>
                <label for="perfil">Perfil:</label><br>
                <select name="perfil" class="input-comum">
                    <option value="">Selecione um perfil</option>
                    <option value="1">Cliente</option>
                    <option value="2">Colaborador</option>
                </select><br><br>
                <input type="submit" value="Cadastrar" name="cadastrar" class="botao-form">

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
            </div>

            <div class="lista-dados">
                <h2>Usuários cadastrados</h2>
            </div>
        </section>

    </main>        
    
</body>
</html>