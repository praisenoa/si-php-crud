<?php include('connexion.php') ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>TALK - Site de discussion en ligne</title>
        <link rel="stylesheet" href="ressources/css/reset.css">
        <link rel="stylesheet" href="ressources/css/style.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">
    </head>
    <body>
        <header>
            <ul class="header">
                <li class="burger_logo">
                    <a href="/testPHP/" class="logo">TALK</a>
                    <div>
                    </div>
                </li>
                <li class="search">
                    <form action="#" method="get">
                        <input type="text" class="search_input" maxlength="30" placeholder="Recherche (nom,catégorie ...)">
                    </form>
                </li>
                <a href="admin" class="connect_btn">
                    <li class="connect">
                        <p class="connect_txt">Espace Admin</p>
                    </li>
                </a>
            </ul>
        </header>