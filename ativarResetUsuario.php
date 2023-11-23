<?php

    if (isset($_GET["uid"]))
    {
        include_once("class/Usuario.php");
        $u = new Usuario();
        $u->resetSenha($_GET["uid"]);
        echo "
            <script type='text/javascript'>
                alert('Senha redefinida com sucesso. O usuário deverá acessar novamente com a senha padrão.');
                window.history.back();
            </script>
                ";
    }
?>