<?php include('../layouts/connexion.php') ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title><?=$title?></title>
        <link rel="stylesheet" href="../ressources/css/reset.css">
        <link rel="stylesheet" href="../ressources/css/style.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">
    </head>
    <body>
        <header>
            <ul class="header" style="background: linear-gradient(to right, #f54242, #d21919);">
                <li class="burger_logo">
                    <a href="/testPHP/admin" class="logo">TALK</a>
                </li>
                <li><a class="btnbackWebsite" href="../">Accéder au site</a></li>
                <?php                    
                    if(isset($_SESSION['login'])) {
                        echo '<li><a class="btnLogout" href="logout.php">Se déconnecter</a></li>';                        
                     }
                ?> 
            </ul>
        </header>