<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bazar Sustentável</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Ubuntu&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/main.css">
    <script src="assets/main.js"></script>
</head>
<body>
    <?php
        include("components/header-interno.html");
    ?>

    <section class="area-login">
        <div class="center">
            <h2>Redefinir senha</h2>
        </div>
        

        <form method="POST">

            <label for="email">Nova senha:</label><br>
            <input type="password" name="senha" minlength="8" class="input-comum" placeholder="Informe uma senha com ao menos 8 dígitos"><br><br>
            <label for="senha">Confirme a senha:</label><br>
            <input type="password" name="senhaConfirma" minlength="8" class="input-comum" placeholder="Repita a senha anterior"><br><br>
            <input type="hidden" name="id" value="<?php echo $_GET["uid"] ?>">
            <input type="submit" value="Modificar" name="modificar" class="botao-form">    
            
            <?php

                if (isset($_REQUEST["modificar"]))
                {
                    include_once("class/Usuario.php");
                    $u = new Usuario();

                    if ($u->mudarSenha($_REQUEST["id"], $_REQUEST["senha"]) == true)
                    {
                       echo "<p>Senha alterada com sucesso.<p> <a href='login.php'>Clique aqui e acesse novamente</a>' ";
                       echo "
                        <script type='text/javascript'>
                            alert('Senha alterada com sucesso. Retorne e acesse novamente com a nova senha');
                            bloquearInput();
                        </script>
                            ";
                    }
                    else
                    {
                        echo "<p>Ocorreu um erro inesperado. Entre em contato com o administrador.</p>";
                    }
                    
                    // echo $u->mudarSenha($_REQUEST["id"], $_REQUEST["senha"]) == true
                    //     ? "<p>Senha alterada com sucesso.<p> <a href='login.php'>Clique aqui e acesse novamente</a>' "
                    //     : "<p>Ocorreu um erro inesperado. Entre em contato com o administrador.</p>";

                    
                }
            ?>

        </form>
    </section>
</body>
</html>