<?php
    // session_start();

    
    if(!isset($_COOKIE["uid"])) {
        echo "
            <script type='text/javascript'>
                alert('Sua autenticação expirou. Acesse novamente.');
            </script>
                ";
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

    if ($_COOKIE["perfil"] == 2)
    {
        include("components/menu-adm.html");
    }

    ?>

    <main>
        <section class="flex-container">
            <div class="forms-internos">
            <h2>Adicionar categoria</h2>

            <form method="POST">
                
                <label for="nome">Nome:</label><br>
                <input type="text" name="nome" placeholder="Digite o nome do categoria" minlength="3" class="input-comum" required><br><br>
                <label for="email">Valor unitário:</label><br>
                <input type="number" name="valor" min="1" placeholder="Digite o valor de cada item da categoria" class="input-comum" required><br><br>
                <input type="submit" value="Cadastrar" name="cadastrar" class="botao-form" onclick="return confirmacao()">

                <?php
                    if (isset($_REQUEST["cadastrar"]))
                    {
                        include_once("class/Categoria.php");
                        $u = new Categoria();
                        $u->create($_REQUEST["nome"], $_REQUEST["valor"]);

                        echo $u->inserirCategoria() == true
                            ? "<p>Categoria cadastrada</p>
                                <script type='text/javascript'>
                                alert('Categoria cadastrada.');
                                </script>"
                            : "<p>Ocorreu um erro inesperado. Favor entrar em contato com o administrador.</p>";

                    }
                ?>
            </form>
            </div>

            <div class="lista-dados">
                <h2>Usuários cadastrados</h2>
                
                <?php
                    include_once("class/Categoria.php");
                    $u = new Categoria();
                    $lista = $u->listarCategoria();

                    if ($lista != 0)
                    {
                        echo "<table>
                                <tr>
                                    <th>Código</th>
                                    <th>Nome</th>
                                    <th>Valor unitário</th>
                                </tr>
                        ";

                        foreach($lista as $i)
                        {
                            echo "<tr>";
                            echo "<td>" . $i["idCategoria"] . "</td>";
                            echo "<td>" . $i["nome"] . "</td>";
                            echo "<td>" . $i["valor"] . "</td>";               
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