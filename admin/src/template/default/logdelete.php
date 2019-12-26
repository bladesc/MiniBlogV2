<?php include 'pageup.php' ?>

    <h1><?= $this->translations->pl['h1LogDeleting'] ?></h1>
    <form action="index.php?pageadmin=log&action=delete&id=<?= $this->data['logs']['id'] ?>" method="post">
        <?php include 'layout/validationErrors.php' ?>
        <div>
            <?= $this->translations->pl['deleteLog'] ?>: <b><?= $this->data['logs']['id'] ?></b>
            <input type="hidden" name="fId" value="<?= $this->data['logs']['id'] ?>">
        </div>
        <div>
            <input type="submit" name="fDelete" value="<?= $this->translations->pl['buttonDelete'] ?>" class="button lightblue">
        </div>
    </form>

<?php include 'pagedown.php' ?><?php
