<?php include 'pageup.php' ?>

    <h1>Usuwanie kategorii</h1>
    <form action="index.php?pageadmin=category&action=delete&id=<?= $this->data['categories']['id'] ?>" method="post">
        <?php include 'layout/validationErrors.php' ?>
        <div>
            Czy na pewno chesz usunac kategorie: <b><?= $this->data['categories']['name'] ?></b>
        </div>
        <div>
            <input type="hidden" name="fId" value="<?= $this->data['categories']['id'] ?>">
            <input type="submit" name="fDelete" value="Usun" class="button lightblue">
        </div>
    </form>
<?php include 'pagedown.php' ?>