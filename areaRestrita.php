<?php
    session_start();
    
    if (!isset($_SESSION["uid"]))
    {
        header("Location: login.php");
    }
?>

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

        if ($_SESSION["perfil"] == 2)
        {
            include("components/menu-adm.html");
        }
        
    ?>

    <section class="area-login">
        <div class="center">
            <h1>Bazar Sustentável</h1>
            <p>Olá, <?php echo $_SESSION["unome"]; ?>!</p><br>
            <p>Você possui 
                <?php
                    include_once("class/Usuario.php");
                    $u = new Usuario();
                    $u->buscarUsuario($_SESSION["uid"]);
                    echo $u->getSaldo();
                ?>
            Senacoins.</p>
        </div>
        

        
        </form>
    </section>
</body>
</html>