<?php
$pagina = $_GET['pagina'];
    switch($pagina){
        case 'user':
            include_once('./updates/user.php');
            break;
        case 'piscina':
            include_once('./updates/pisicna.php');
            break;
        case 'senha':
            include_once('./updates/senha.php');
            break;
        case 'profissional':
            include_once('./updates/profissional.php');
            break;
    }
?>