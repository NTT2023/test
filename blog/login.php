<?php
require_once('header.php'); ?>

<?php
$provider =  Linna\CsrfGuard\ProviderSimpleFactory::getProvider();

use Class\Auth;


$error = null;

if (isset($_POST['username'], $_POST['mdp'])) {

    $index = count($_SESSION['csrf_syncronizer_token']) - 1;

    if (($provider->validate($_POST['CSRF'])) && ($provider->validate(substr($_SESSION['csrf_syncronizer_token'][$index], 0, -8)))) {
        $auth = new Auth();
        $user = $auth->login($_POST['username'], $_POST['mdp']);
        if ($user) :
            header('Location: index.php');
            exit();
        else :
            $error = "Mauvais identifiant ou mot de passe !";
        endif;
    } else {
        $error = "Mauvais CRCF !";
        var_dump(substr($_SESSION['csrf_syncronizer_token'][$index], 0, -8));
        var_dump($_POST['CSRF']);
    }
}
?>
<?php if ($error) : ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>
<div class="container">
    <form action="" method="post">
        <input type="hidden" name="CSRF" value="<?php echo $provider->getToken(); ?>" />
        <div class="form-group">
            <input type="text" class="form-control" name="username" placeholder="Pseudo">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="mdp" placeholder="Mot de Passe">
        </div>

        <button class="btn btn-primary" type="submit">Se connecter</button>

    </form>
</div>

<?php require_once 'footer.php'; ?>