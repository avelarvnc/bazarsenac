<?php

    if (isset($_COOKIE['uid'])) {
        unset($_COOKIE['uid']);
        setcookie('uid', '', time() - 3600, '/'); // empty value and old timestamp
    }

    if (isset($_COOKIE['unome'])) {
        unset($_COOKIE['unome']);
        setcookie('unome', '', time() - 3600, '/'); // empty value and old timestamp
    }

    if (isset($_COOKIE['perfil'])) {
        unset($_COOKIE['perfil']);
        setcookie('perfil', '', time() - 3600, '/'); // empty value and old timestamp
    }
    
    header("Location: index.php");
?>