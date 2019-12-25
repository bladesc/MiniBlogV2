<?php include 'pageup.php' ?>

    <h1>Usuwanie Komentarza</h1>
    <form action="index.php?pageadmin=comment&action=delete&id=<?= $this->data['comments']['id'] ?>" method="post">
        <?php include 'layout/validationErrors.php' ?>
        <div>
            Czy na pewno chesz usunac komentarz: <b><?= $this->data['comments']['id'] ?></b>
        </div>
        <div>
            <input type="hidden" name="fId" value="<?= $this->data['comments']['id'] ?>">
            <input type="submit" name="fDelete" value="Usun" class="button lightblue">
        </div>
    </form>

<?php include 'pagedown.php' ?>