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
            <div class="flex-secundario">
            <div class="forms-internos">
            <h2>Cadastar novo usuário</h2>

            <form method="POST">
                
                <label for="nome">Nome:</label><br>
                <input type="text" name="nome" placeholder="Digite o nome do cliente" minlength="3" class="input-comum" required><br><br>
                <label for="email">Telefone:</label><br>
                <input type="text" name="email" placeholder="Digite o telefone do usuário (sem DDD)" minlength="3" class="input-comum" required><br><br>
                <label for="perfil">Perfil:</label><br>
                <select name="perfilUsuario" class="input-comum">
                    <option value="">Selecione um perfil</option>
                    <option value="1">Cliente</option>
                    <option value="2">Colaborador</option>
                </select><br><br>
                <label for="perfil">Unidade:</label><br>
                <select name="unidade" class="input-comum">
                    <option value="">Selecione a UE</option>
                    <option value="SAN">SAN</option>
                    <option value="BER">BER</option>
                </select><br><br>
                <input type="submit" value="Cadastrar" name="cadastrar" class="botao-form" onclick="return confirmacao()">

                <?php
                    if (isset($_REQUEST["cadastrar"]))
                    {
                        include_once("class/Usuario.php");
                        $u = new Usuario();
                        $u->create($_REQUEST["nome"], $_REQUEST["email"], $_REQUEST["perfilUsuario"], $_REQUEST["unidade"]);

                        echo $u->inserirUsuario() == true
                            ? "<p>Usuário cadastrado</p>
                                <script type='text/javascript'>
                                alert('Usuário cadastrado.');
                                </script>"
                            : "<p>Ocorreu um erro inesperado. Favor entrar em contato com o administrador.</p>";

                    }
                ?>
            </form>
            </div>

            <div class="forms-internos">
            <h2>Atualizar usuário</h2>

            <form method="GET">
                
                <label for="nome">Código:</label><br>
                <input type="text" name="codigo" placeholder="Digite o código do cliente" minlength="1" class="input-comum" style="width: 40%;">
                <input type="submit" value="Buscar" name="buscar" class="botao-form" onclick="return confirmacao()">
                <br><br>

                <?php
                    if (isset($_REQUEST["buscar"]))
                    {
                        include_once("class/Usuario.php");
                        $u = new Usuario();
                        $u->buscarUsuario($_REQUEST["codigo"]);

                        if ($u == 0)
                        {

                        }
                        else
                        {
                            header("Location: atualizarUsuario.php?uid=" . $_GET["codigo"]);
                        }
                    }
                       
                ?>
            </form>
            </div>
    
            </div>
            
            <div class="lista-dados">
                <h2>Usuários cadastrados</h2>
                
                <?php
                    include_once("class/Usuario.php");
                    $u = new Usuario();
                    $lista = $u->listarUsuarios();

                    if ($lista != 0)
                    {
                        echo "<table>
                                <tr>
                                    <th>Código</th>
                                    <th>Nome</th>
                                    <th>Telefone</th>
                                    <th>UE</th>
                                    <th>Saldo</th>
                                </tr>
                        ";

                        foreach($lista as $i)
                        {
                            echo "<tr>";
                            echo "<td>" . $i["idUsuario"] . "</td>";
                            echo "<td>" . $i["nome"] . "</td>";
                            echo "<td>" . $i["email"] . "</td>";
                            echo "<td>" . $i["unidade"] . "</td>";
                            echo "<td>" . $i["saldo"] . "</td>";
                            echo "<td> <a href='ativarResetUsuario.php?uid=" . $i["idUsuario"] . "' onclick='return confirmacao()'>Redefinir senha</a></td>";                    
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