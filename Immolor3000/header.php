<?php include_once 'config.php'; ?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Immolor 3000 - <?= $page_title; ?></title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
    <style>
        td {
            cursor: pointer;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <div class="navbar-brand"><a href="index.php">IMMOLOR 3000 &nbsp</a> </div>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="index.php"><span class="glyphicon glyphicon-home"></span> Accueil </a></li>
            <li><a href="list.php">Nos offres</a></li>
            <li><a href="add.php"> Déposer une annonce</a> </li>
        </ul>
    </div>
</nav>
<!-- début du container (site centré) -->
<div class="container">


    <h2><?= $page_title ?></h2>
    <a href="list.php">Liste des offres</a> - <a href="add.php">Ajouter une offre</a>
    <hr>