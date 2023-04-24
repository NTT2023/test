<?php require_once('header.php'); ?>
<?php
use Class\Post;
$error = null;
try {
    if (isset($_POST['name'], $_POST['content'])) {
        $query = $pdo->prepare('INSERT INTO post (name, content, date) VALUES (:name, :content, :date)');
        $query->bindValue(':name',$_POST['name']);
        $query->bindValue(':content',$_POST['content']);
        $query->bindValue(':date',time());
        //$query->execute([':date' => $_POST['name'], 'content' => $_POST['content'], 'date' => time()]);
        $query->execute();
        header('Location: edit.php?id=' . $pdo->lastInsertId());
        exit();
    }

} catch (PDOException $e) {
    $error = $e->getMessage();
}
?>

<?php 
if($auth->isConnect()) : ?>
<div class="container">
    <form action="" method="post">
        <div class="form-group">
            <input type="text" class="form-control" name="name" value="" placeholder="Le titre du nouvelle article">
        </div>
        <div class="form-group">
            <textarea name="content" id="" cols="30" rows="10" class="form-control" placeholder="Votre article"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Sauvegarder</button>
    </form>
</div>
<?php endif; ?>
<?php 
function Joli($tabs) {
    $html = '';
    foreach ($tabs as $tab) {
        $html.= '<div class="container"><li>'. $tab->nom. ' a eu à l\'épreuve ';
        $html.= ''. $tab->epreuve. ' la note de';
        $html.= ' '. $tab->note. '</li></div><br>';

    }
    return $html;
}
?>

<?php require_once 'footer.php'; ?>