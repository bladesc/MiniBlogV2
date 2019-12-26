<?php include 'pageup.php' ?>

    <h1><?= $this->translations->pl['h1PagesDeleting'] ?></h1>
    <form action="index.php?pageadmin=page&action=delete&id=<?= $this->data['page']['id'] ?>" method="post">
        <?php include 'layout/validationErrors.php' ?>
        <div>
            <?= $this->translations->pl['deletePage'] ?>: <b><?= $this->data['page']['name'] ?></b>
        </div>
        <div>
            <input type="hidden" name="fId" value="<?= $this->data['page']['id'] ?>">
            <input type="submit" name="fDelete" value="<?= $this->translations->pl['buttonDelete'] ?>" class="button lightblue">
        </div>
    </form>

<?php include 'pagedown.php' ?>