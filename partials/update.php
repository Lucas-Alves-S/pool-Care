<?php
$pagina = $_GET['pagina'];
    switch($pagina){
        case 'user':
            include_once('./updates/usuario.php');
            break;
        case 'piscina':
            include_once('./updates/pisicna.php');
            break;
        case 'senha':
            include_once('./updates/senha.php');
            break;
    }
?>