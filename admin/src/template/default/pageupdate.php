<?php include 'pageup.php' ?>

    <h1>Edycja strony</h1>
    <form action="index.php?pageadmin=page&action=update&id=<?= $this->data['page']['id'] ?>" method="post">
        <?php include 'layout/validationErrors.php' ?>
        <h3>Dane podstawowe</h3>
        <div>
            <label for="fName">Nazwa kategorii</label>
            <input type="text" name="fName" id="fName" value="<?= $this->data['page']['name'] ?>" required>
        </div>
        <div>
            <label for="fUrl">Adres url strony</label>
            <input type="text" name="fUrl" id="fUrl" value="<?= $this->data['page']['url'] ?>" required>
        </div>
        <div>
            <label for="fStatus">Status</label>
            <select name="fStatus" id="fStatus">
                <option value="1" <?php if ($this->data['page']['status'] == 1): ?> selected <?php endif; ?>>
                    Aktywny
                </option>
                <option value="2" <?php if ($this->data['page']['status'] == 2): ?> selected <?php endif; ?>>
                    Nieaktywny
                </option>
            </select>
        </div>

        <div>
            <label for="fContent">Treść strony</label>
            <input type="text" name="fContent" id="fContent" value="<?= $this->data['page']['content'] ?>">
        </div>
        <h3>Dane seo</h3>
        <div>
            <label for="fTitle">Seo tytuł</label>
            <input type="text" name="fTitle" id="fTitle" value="<?= $this->data['page']['title'] ?>">
        </div>
        <div>
            <label for="fDescription">Seo opis</label>
            <input type="text" name="fDescription" id="fDescription" value="<?= $this->data['page']['description'] ?>">
        </div>
        <div>
            <label for="fTags">Seo tagi</label>
            <input type="text" name="fTags" id="fTags" value="<?= $this->data['page']['tag'] ?>">
        </div>

        <div>
            <input type="submit" name="fSubmit" value="Dodaj" class="button lightblue">
        </div>
    </form>

<?php include 'pagedown.php' ?>