<?php include 'pageup.php' ?>

    <h1>Usuwanie logów</h1>
    <form action="index.php?pageadmin=log&action=delete&id=<?= $this->data['logs']['id'] ?>" method="post">
        <?php include 'layout/validationErrors.php' ?>
        <div>
            Czy na pewno chesz usunac log: <b><?= $this->data['logs']['id'] ?></b>
            <input type="hidden" name="fId" value="<?= $this->data['logs']['id'] ?>">
        </div>
        <div>
            <input type="submit" name="fDelete" value="Usun" class="button lightblue">
        </div>
    </form>

<?php include 'pagedown.php' ?><?php
