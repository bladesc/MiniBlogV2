<?php include 'pageup.php' ?>

    <h1>Usuwanie użytkownika</h1>
    <form action="index.php?pageadmin=account&action=delete&id=<?= $this->data['accounts']['user_id'] ?>" method="post">
        <?php include 'layout/validationErrors.php' ?>
        <div>
            Czy na pewno chesz usunac uzytkownika: <b><?= $this->data['accounts']['user_email'] ?></b>
        </div>
        <div>
            <input type="hidden" name="fId" value="<?= $this->data['accounts']['user_id'] ?>">
            <input type="submit" name="fDelete" value="Usun" class="button lightblue">
        </div>
    </form>

<?php include 'pagedown.php' ?>