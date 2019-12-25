<?php include 'pageup.php' ?>

    <h1>Dodawanie strony</h1>
    <form action="index.php?pageadmin=page&action=create" method="post">
        <?php include 'layout/validationErrors.php' ?>
        <h3>Dane podstawowe</h3>
        <div>
            <label for="fName">Nazwa kategorii</label>
            <input type="text" name="fName" id="fName" value="<?= $this->request->post()->get('fName') ?>" required>
        </div>
        <div>
            <label for="fUrl">Adres url strony</label>
            <input type="text" name="fUrl" id="fUrl" value="<?= $this->request->post()->get('fUrl') ?>" required>
        </div>
        <div>
            <label for="fStatus">Status</label>
            <select name="fStatus" id="fStatus">
                <option value="1" <?php if ($this->request->post()->get('fStatus') == 1): ?> selected <?php endif; ?>>
                    Aktywny
                </option>
                <option value="2" <?php if ($this->request->post()->get('fStatus') == 2): ?> selected <?php endif; ?>>
                    Nieaktywny
                </option>
            </select>
        </div>

        <div>
            <label for="fContent">Treść strony</label>
            <input type="text" name="fContent" id="fContent" value="<?= $this->request->post()->get('fContent') ?>">
        </div>
        <h3>Dane seo</h3>
        <div>
            <label for="fTitle">Seo tytuł</label>
            <input type="text" name="fTitle" id="fTitle" value="<?= $this->request->post()->get('fTitle') ?>">
        </div>
        <div>
            <label for="fDescription">Seo opis</label>
            <input type="text" name="fDescription" id="fDescription" value="<?= $this->request->post()->get('fDescription') ?>">
        </div>
        <div>
            <label for="fTags">Seo tagi</label>
            <input type="text" name="fTags" id="fTags" value="<?= $this->request->post()->get('fTags') ?>">
        </div>

        <div>
            <input type="submit" name="fSubmit" value="Dodaj" class="button lightblue">
        </div>
    </form>

<?php include 'pagedown.php' ?>