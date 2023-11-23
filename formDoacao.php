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
                <input type="number" name="quantidade" min="1" placeholder="Informe a quantidade de itens doados" class="input-comum" required><br><br>
                <label for="usuario">Código de cliente:</label>
                <input type="text" name="usuario" minlength="1" placeholder="Solicite o código do usuário" class="input-comum" required ><br><br>
                <input type="submit" value="Cadastrar" name="cadastrar" class="botao-form" onclick="return confirmacao()">

                <?php
                    if (isset($_REQUEST["cadastrar"]))
                    {
                        include_once("class/Item.php");
                        $i = new Item();
                        $i->create($_REQUEST["quantidade"], $_REQUEST["categoria"], $_REQUEST["usuario"]);

                        echo $i->inserirItem() == true
                            ? "<p>Item cadastrado</p>
                                <script type='text/javascript'>
                                alert('Item cadastrado.');
                                </script>"
                            : "<p>Ocorreu um erro inesperado. Favor entrar em contato com o administrador.</p>";

                    }
                ?>
                

            </form>
            </div>

            <div class="lista-dados">
                <h2>Top 3 doadores</h2>
                <?php
                    include_once("class/Item.php");
                    $i = new Item();
                    $lista = $i->rankingDoacao();

                    if ($lista != 0)
                    {
                        echo "<ol>";
                        foreach($lista as $i)
                        {
                            echo "<li>" . $i["nomeUsuario"] . " - Total de doações: " . $i["quantidade"] . "</li>";
                        }
                        echo "</ol>";

                    
                    }

                    ?>

                <h2>Últimos itens doados</h2>
                <p>(50 últimos registros)</p>
                
                <?php
                    include_once("class/Item.php");
                    $i = new Item();
                    $lista = $i->listarItens();

                    if ($lista != 0)
                    {
                        echo "<table>
                                <tr>
                                    <th>Categoria</th>
                                    <th>Quantidade</th>
                                    <th>Doador</th>
                                    <th>Data de entrega</th>
                                </tr>
                        ";

                        foreach($lista as $i)
                        {
                            echo "<tr>";
                            echo "<td>" . $i["nomeItem"] . "</td>";
                            echo "<td>" . $i["quantidade"] . "</td>";
                            echo "<td>" . $i["nomeUsuario"] . "</td>";
                            echo "<td>" . $i["dtEntrega"] . "</td>";             
                            echo "</tr>";
                        }

                        echo "</table>";
                    }


        ?>

            </div>
        </section>

    </main>        
    
</body>
</html>