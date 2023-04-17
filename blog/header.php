<?php session_start(); ?>
<?php require '../vendor/autoload.php';


use Class\Auth;

$auth = new Auth();

use Class\myPdo;

$pdo = myPdo::Connect();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <h1 class="text-center"> <a href="index.php">Mon BLOG</a> </h1>
    <div class="navbar navbar-expand-lg bg-light">
        <div class="nav-item">
            <?php
            $user = ($auth->isConnect());
            if ($user) : ?>
                <div class="small"> Bonjour <?php echo $user->username; ?></div>
                <div class="small"> <a href="logout.php">Se déconnecter</a></div>
            <?php else : ?>
                <div class="small"> <a href="login.php">Se connecter</a></div>
            <?php endif; ?>

        </div>

    </div>