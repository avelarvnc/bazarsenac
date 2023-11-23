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

    <main>
        <section class="flex-container">
            <div class="forms-internos">
            <h2>Registrar doação</h2>

            <form method="POST">
                <label for="categoria">Categoria:</label><br>
                <select name="categoria" class="input-comum">
                    <option value="0">Selecione uma categoria</option>
                    <?php
                        include_once("class/Categoria.php");
                        $c = new Categoria();
                        $lista = $c->listarCategoria();

                        foreach($lista as $item)
                        {
                            echo "<option value='" . $item["idCategoria"] . "'>" . $item["nome"] . " - Valor: " . $item["valor"] . " Senacoins </option>";
                        }
                    ?>
                </select><br><br>
                <label for="quantidade">Quantidade:</label><br>
                <input type="number" name="quantidade" min="1" placeholder="Informe a quantidade de itens doados" class="input-comum"><br><br>
                <input type="submit" value="Cadastrar" name="cadastrar" class="botao-form">

            </form>
            </div>

            <div class="lista-dados">
                <h2>Últimos itens doados</h2>
                
                <?php
        //             include_once("class/Usuario.php");
        //             $u = new Usuario();
        //             $lista = $u->listarUsuarios();

        //             if ($lista != 0)
        //             {
        //                 echo "<table>
        //                         <tr>
        //                             <th>Nome</th>
        //                             <th>E-mail</th>
        //                             <th>Saldo</th>
        //                         </tr>
        //                 ";

        //                 foreach($lista as $i)
        //                 {
        //                     echo "<tr>";
        //                     echo "<td>" . $i["nome"] . "</td>";
        //                     echo "<td>" . $i["email"] . "</td>";
        //                     echo "<td>" . $i["saldo"] . "</td>";
        //                     echo "<td> <a href='ativarResetUsuario.php?uid=" . $i["idUsuario"] . "' onclick='return confirmacao()'>Redefinir senha</a></td>";                    
        //                     echo "</tr>";
        //                 }

        //                 echo "</table>";
        //             }


        // ?>

            </div>
        </section>

    </main>        
    
</body>
</html>