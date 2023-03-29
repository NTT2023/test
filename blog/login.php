<?php require_once('header.php'); ?>
<?php

use Class\Auth;

$error = null;
if (isset($_POST['username'], $_POST['mdp'])) {
    $auth = new Auth();
    $user = $auth->login($_POST['username'], $_POST['mdp']);
    if ($user) :
        header('Location: index.php');
        exit();
    else :
        $error = "Mauvais identifiant ou mot de passe !";
    endif;
}

?>
<?php if ($error) : ?>
<div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>
<div class="container">
    <form action="" method="post">

        <div class="form-group">
            <input type="text" class="form-control" name="username" placeholder="Pseudo">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="mdp" placeholder="Mot de Passe">
        </div>

        <button class="btn btn-primary" type="submit">Se connecter</button>

    </form>
</div>
<?php var_dump($_SESSION); ?>
<?php require_once 'footer.php'; ?>