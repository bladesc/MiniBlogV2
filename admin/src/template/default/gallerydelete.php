<?php include 'pageup.php' ?>

    <h1><?= $this->translations->pl['h1GalleryDeleting'] ?></h1>
    <form action="index.php?pageadmin=gallery&action=delete&id=<?= $this->data['galleries']['id'] ?>" method="post">
        <?php include 'layout/validationErrors.php' ?>
        <div>
            <?= $this->translations->pl['deleteGallery'] ?>: <b><?= $this->data['galleries']['id'] ?></b>

        </div>
        <div>
            <input type="hidden" name="fId" value="<?= $this->data['galleries']['id'] ?>">
            <input type="submit" name="fDelete" value="<?= $this->translations->pl['buttonDelete'] ?>" class="button lightblue">
        </div>
    </form>

<?php include 'pagedown.php' ?>