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

    $query = $pdo->query('SELECT * from post');
    $posts = $query->fetchAll();
} catch (PDOException $e) {
    $error = $e->getMessage();
}
?>


<?php if ($error) :  ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php else : ?>
    <!-- <?php echo '"', __NAMESPACE__, '"'; ?> -->
    <?php foreach ($posts as $post) :  ?>
        <?php $objPost = new Post($post->id, htmlentities($post->name), htmlentities($post->content), $post->date) ?>
        <div class="container">
            <a href='edit.php?id=<?php echo $objPost->id; ?>'> <?php echo $objPost->name; ?></a>
            <span class="small"><?php echo $objPost->getDate(); ?></span>
            <p>
            <?php echo nl2br($objPost->getResume()) ;?>
            <a href="pdf.php?name=<?php echo urlencode($objPost->name) ?>&content=<?php echo urlencode($objPost->content) ?>" target="_blank">Voir en PDF</a>
            </p>
            
        </div>
    <?php endforeach ?>

<?php endif ?>

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
<?php require_once 'footer.php'; ?>