<?php include 'pageup.php' ?>

    <h1><?= $this->translations->pl['h1CommentsDeleting'] ?></h1>
    <form action="index.php?pageadmin=comment&action=delete&id=<?= $this->data['comments']['id'] ?>" method="post">
        <?php include 'layout/validationErrors.php' ?>
        <div>
            <?= $this->translations->pl['deleteComment'] ?>: <b><?= $this->data['comments']['id'] ?></b>
        </div>
        <div>
            <input type="hidden" name="fId" value="<?= $this->data['comments']['id'] ?>">
            <input type="submit" name="fDelete" value="<?= $this->translations->pl['buttonDelete'] ?>" class="button lightblue">
        </div>
    </form>

<?php include 'pagedown.php' ?>