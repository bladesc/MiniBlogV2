<?php include 'pageup.php' ?>

    <h1>Usuwanie galerii</h1>
    <form action="index.php?pageadmin=gallery&action=delete&id=<?= $this->data['galleries']['id'] ?>" method="post">
        <?php include 'layout/validationErrors.php' ?>
        <div>
            Czy na pewno chesz usunac kategorie: <b><?= $this->data['galleries']['id'] ?></b>

        </div>
        <div>
            <input type="hidden" name="fId" value="<?= $this->data['galleries']['id'] ?>">
            <input type="submit" name="fDelete" value="Usun" class="button lightblue">
        </div>
    </form>

<?php include 'pagedown.php' ?>