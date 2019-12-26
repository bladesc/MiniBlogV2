<?php include 'pageup.php' ?>

    <h1><?= $this->translations->pl['h1CategoriesDeleting'] ?></h1>
    <form action="index.php?pageadmin=category&action=delete&id=<?= $this->data['categories']['id'] ?>" method="post">
        <?php include 'layout/validationErrors.php' ?>
        <div>
            <?= $this->translations->pl['deleteCat'] ?>: <b><?= $this->data['categories']['name'] ?></b>
        </div>
        <div>
            <input type="hidden" name="fId" value="<?= $this->data['categories']['id'] ?>">
            <input type="submit" name="fDelete" value="<?= $this->translations->pl['buttonDelete'] ?>" class="button lightblue">
        </div>
    </form>
<?php include 'pagedown.php' ?>