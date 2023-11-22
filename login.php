<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Ubuntu&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/main.css">
</head>
<body>
    <?php
        include("components/header-externo.html");
    ?>

    <section class="area-login">
        <div class="center">
            <h2>Acesso a área restrita</h2><br><br>
        </div>
        

        <form action="">
            <label for="email">E-mail:</label><br>
            <input type="email" name="email" minlength="3" class="input-comum" placeholder="Informe seu e-mail coorporativo"><br><br>
            <label for="senha">Senha:</label><br>
            <input type="password" name="senha" minlength="3" class="input-comum" placeholder="Digite sua senha"><br><br>
            <input type="submit" value="Entrar" class="botao-form">            

        </form>
    </section>
</body>
</html>