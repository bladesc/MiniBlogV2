<?php include 'pageup.php' ?>

    <form action="index.php?pageadmin=page&action=create" method="post">
        Podstawowe
        <div>
            Nazwa
            <input type="text" name="fName" value="<?= $this->request->post()->get('fName') ?>" required>
        </div>
        <div>
            Url
            <input type="text" name="fUrl" value="<?= $this->request->post()->get('fUrl') ?>" required>
        </div>
        <div>
            Status
            <select name="fStatus">
                <option value="1" <?php if ($this->request->post()->get('fStatus') == 1): ?> selected <?php endif; ?>>
                    Aktywny
                </option>
                <option value="2" <?php if ($this->request->post()->get('fStatus') == 2): ?> selected <?php endif; ?>>
                    Nieaktywny
                </option>
            </select>
        </div>

        <div>
            Content
            <input type="text" name="fContent" value="<?= $this->request->post()->get('fContent') ?>">
        </div>
        Seo
        <div>
            Tytul:
            <input type="text" name="fTitle" value="<?= $this->request->post()->get('fTitle') ?>">
        </div>
        <div>
            Opis:
            <input type="text" name="fDescription" value="<?= $this->request->post()->get('fDescription') ?>">
        </div>
        <div>
            Meta tagi:
            <input type="text" name="fTags" value="<?= $this->request->post()->get('fTags') ?>">
        </div>

        <div>
            <input type="submit" name="fSubmit" value="Dodaj">
        </div>
    </form>
<?php
print_r($this->data);
?>
<?php include 'pagedown.php' ?>