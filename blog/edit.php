<?php require_once('header.php'); ?>
<?php
$error = null;
$success = null;

try {
    if (isset($_POST['name'], $_POST['content'])) {
        if (isset($_POST['Sauvegarder'])) {
            $query = $pdo->prepare('UPDATE post SET name= :name, content= :content WHERE id= :id');
            $query->execute(['name' => $_POST['name'], 'content' => $_POST['content'], 'id' => $_GET['id']]);
            $success = "Votre article a été mis à jour";
        }
        if (isset($_POST['Supprimer'])) {
            $query = $pdo->prepare('DELETE FROM post WHERE id= :id');
            $query->execute(['id' => $_GET['id']]);
            header("location:" . $_SERVER['HTTP_REFERER']);
        }
    }
    $query = $pdo->prepare('SELECT * from post WHERE id= :id');
    $query->execute(['id' => $_GET['id']]);
    $count = $query->rowCount();
    $post = $query->fetchObject('Class\Post');
} catch (PDOException $e) {
    $error = $e->getMessage();
}
?>
<div class="container">
    <p>
        <a href="index.php">Revenir au listing</a>
    </p>
    <?php if ($success) : ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
    <?php endif ?>
    <?php if ($error) :  ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php else : ?>
        <?php if ($post) : ?>
            <?php if ($auth->isConnect()) : ?>
                <div class="container">
                    <form action="" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" value="<?php echo htmlentities($post->name); ?>">
                        </div>
                        <div class="form-group">
                            <textarea name="content" id="" cols="30" rows="10" class="form-control"><?php echo htmlentities($post->content); ?></textarea>
                        </div><br>
                        <button type="submit" class="btn btn-primary" name="Sauvegarder">Sauvegarder</button>
                        <br><br>
                        <button type="submit" class="btn bg-danger text-white" name="Supprimer">Supprimer</button>
                    </form>

                </div>
            <?php else : ?>
                <div class="form-group">
                    <?php echo htmlentities($post->name); ?>
                </div>
                <div class="form-group">
                    <?php echo htmlentities($post->content); ?>
                </div>


            <?php endif ?>
        <?php else : ?>
            <div class="alert alert-danger">L'article n'éxiste plus</div>
        <?php endif ?>

    <?php endif ?>
</div>

<?php require_once 'footer.php'; ?>