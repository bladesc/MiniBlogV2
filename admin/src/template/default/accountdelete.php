<?php include 'pageup.php' ?>

    <h1><?= $this->translations->pl['h1deletingUser'] ?></h1>
    <form action="index.php?pageadmin=account&action=delete&id=<?= $this->data['accounts']['user_id'] ?>" method="post">
        <?php include 'layout/validationErrors.php' ?>
        <div>
            <?= $this->translations->pl['deleteCom'] ?>: <b><?= $this->data['accounts']['user_email'] ?></b>
        </div>
        <div>
            <input type="hidden" name="fId" value="<?= $this->data['accounts']['user_id'] ?>">
            <input type="submit" name="fDelete" value="<?= $this->translations->pl['buttonDelete'] ?>" class="button lightblue">
        </div>
    </form>

<?php include 'pagedown.php' ?>