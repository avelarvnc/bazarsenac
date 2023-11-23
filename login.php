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
        include("components/header-externo.html");
    ?>

    <section class="area-login">
        <div class="center">
            <h2>Acesso a área restrita</h2><br><br>
        </div>
        

        <form method="POST">
            <label for="email">E-mail:</label><br>
            <input type="email" name="email" minlength="3" class="input-comum" placeholder="Informe seu e-mail coorporativo" required><br><br>
            <label for="senha">Senha:</label><br>
            <input type="password" name="senha" minlength="3" class="input-comum" placeholder="Digite sua senha" required><br><br>
            <input type="submit" value="Entrar" name="entrar" class="botao-form">    
            
            <?php

                if (isset($_REQUEST["entrar"]))
                {
                    include_once("class/Usuario.php");
                    $u = new Usuario();
                    $u->setEmail($_REQUEST["email"]);
                    $u->setSenha($_REQUEST["senha"]);

                    $dados = $u->acessar();

                    if ($dados == -1)
                    {
                        echo "<p>Ocorreu um erro inesperado. Entre em contato com o administrador.</p>";
                    }
                    else if ($dados == 0)
                    {
                        echo "<p>Usuário e/ou senha incorreto(s). Favor tentar novamente.</p>";
                    }
                    else
                    {
                        if ($dados["situacao"] == 0)
                        {
                            header("Location: resetSenha.php?uid=" . $dados["idUsuario"]);
                        }
                        else
                        {
                            session_start();
                            $_SESSION["unome"] = $dados["nome"];
                            $_SESSION["uid"] = $dados["idUsuario"];
                            $_SESSION["perfil"] = $dados["perfil"];
                                                        
                            header("Location: areaRestrita.php");
                            
                        }
                    }
                }
            ?>

        </form>
    </section>
</body>
</html>