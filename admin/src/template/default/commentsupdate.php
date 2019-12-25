<?php include 'pageup.php' ?>

    <h1>Edycja Komentarza</h1>
    <form action="index.php?pageadmin=comment&action=update&id=<?= $this->data['comments']['id'] ?>" method="post">
        <?php include 'layout/validationErrors.php' ?>
        <div>
            <label for="fContent">Komentarz</label>
            <input type="text" name="fContent" id="fContent" value="<?= $this->data['comments']['content'] ?>">
        </div>
        <div>
            <input type="hidden" name="fId" value="<?= $this->data['comments']['id'] ?>">
            <input type="submit" name="fSubmit" value="Zmien" class="button lightblue">
        </div>
    </form>

<?php include 'pagedown.php' ?>