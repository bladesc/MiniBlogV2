<?php include 'pageup.php' ?>

    <h1>Edycja ustawień</h1>
    <form action="index.php?pageadmin=settings&action=update&id=<?= $this->data['settings']['id'] ?>" method="post">
        <?php include 'layout/validationErrors.php' ?>
        <div>
            <label for="fTitle">Tytuł</label>
            <input type="text" name="fTitle" id="fTitle" class="medium" value="<?= $this->data['settings']['title'] ?>">
        </div>
        <div>
            <label for="fDescription">Opis</label>
            <input type="text" name="fDescription" id="fDescription" value="<?= $this->data['settings']['description'] ?>">
        </div>
        <div>
            <label for="fMetaTags">Meta tagi (oddzielone przecinkami)</label>
            <input type="text" name="fMetaTags" id="fMetaTags" value="<?= $this->data['settings']['meta_tags'] ?>">
        </div>

        <div>
            <input type="hidden" name="fId" value="<?= $this->data['settings']['id'] ?>">
            <input type="submit" name="fSubmit" value="Edytuj" class="button lightblue">
        </div>
    </form>

<?php include 'pagedown.php' ?>