<?php require_once('header.php'); ?>
<?php

use Class\Post;
use Class\Note;

$error = null;
try {

    $query = $pdo->query('SELECT * from post');
    $posts = $query->fetchAll(PDO::FETCH_CLASS, 'Class\Post');
} catch (PDOException $e) {
    $error = $e->getMessage();
}
?>


<?php if ($error) :  ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php else : ?>
    <!-- <?php echo '"', __NAMESPACE__, '"'; ?> -->
    <?php foreach ($posts as $objPost) :  ?>
        <div class="container">
            <a href='edit.php?id=<?php echo $objPost->id; ?>'> <?php echo $objPost->name; ?></a>
            <span class="small"><?php echo $objPost->getDate(); ?></span>

            <p>
                <?php echo nl2br($objPost->getResume()); ?>
            <div class="small text-center"><?php echo $objPost->getTime(); ?></div>
            </p>

        </div>
    <?php endforeach ?>

<?php endif ?>

<?php
if ($auth->isConnect()) : ?>
    <div class="container">
        <a class="btn btn-secondary btn-lg" href="create.php">Ajouter un article</a>
    </div>
<?php endif; ?>
<?php
function Joli($tabs)
{
    $html = '';
    foreach ($tabs as $tab) {
        $html .= '<div class="container small">- ' . $tab->nom . ' a eu à l\'épreuve ';
        $html .= '' . $tab->epreuve . ' la note de';
        $html .= ' ' . $tab->note . '</div>';
    }
    return $html;
}
$notes = (new Note());
?>
<hr>

<div class="container bg-secondary text-white text-center p-3">

    <h4>Toute les Notes ordonnées</h4>
    <?php
    $json = $notes->getNotesOrder();
    echo Joli($json);
    ?>

    <h4>Seulement U5</h4>
    <?php
    $json = $notes->getBon('U5');
    echo Joli($json);
    ?>
    <h4>Seulement U5 order</h4>

    <?php
    $json = $notes->getBonOrder('U5');
    echo Joli($json);
    ?>
    <!-- <script>alert("Les session ne sont pas conformes" + document.cookie );</script> -->
</div>
<?php require_once 'footer.php'; ?>