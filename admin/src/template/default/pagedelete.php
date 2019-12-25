<?php include 'pageup.php' ?>

    <h1>Usuwanie strony</h1>
    <form action="index.php?pageadmin=page&action=delete&id=<?= $this->data['page']['id'] ?>" method="post">
        <?php include 'layout/validationErrors.php' ?>
        <div>
            Czy na pewno chesz usunac stone: <b><?= $this->data['page']['name'] ?></b>
        </div>
        <div>
            <input type="hidden" name="fId" value="<?= $this->data['page']['id'] ?>">
            <input type="submit" name="fDelete" value="Usun" class="button lightblue">
        </div>
    </form>

<?php include 'pagedown.php' ?>