<?php include 'pageup.php' ?>

    <form action="index.php?pageadmin=page&action=update&id=<?= $this->data['pages']['id'] ?>" method="post">
        Podstawowe
        <div>
            Nazwa
            <input type="text" name="fName" value="<?= $this->data['pages']['name'] ?>" required>
        </div>
        <div>
            Url
            <input type="text" name="fUrl" value="<?= $this->data['pages']['url'] ?>" required>
        </div>
        <div>
            Status
            <select name="fStatus">
                <option value="1" <?php if ($this->data['pages']['status'] == 1): ?> selected <?php endif; ?>>
                    Aktywny
                </option>
                <option value="2" <?php if ($this->data['pages']['status'] == 2): ?> selected <?php endif; ?>>
                    Nieaktywny
                </option>
            </select>
        </div>

        <div>
            Content
            <input type="text" name="fContent" value="<?= $this->data['pages']['content'] ?>">
        </div>
        Seo
        <div>
            Tytul:
            <input type="text" name="fTitle" value="<?= $this->data['pages']['title'] ?>">
        </div>
        <div>
            Opis:
            <input type="text" name="fDescription" value="<?= $this->data['pages']['description'] ?>">
        </div>
        <div>
            Meta tagi:
            <input type="text" name="fTags" value="<?= $this->data['pages']['tag'] ?>">
        </div>

        <div>
            <input type="submit" name="fSubmit" value="Dodaj">
        </div>
    </form>
<?php
print_r($this->data);
?>
<?php include 'pagedown.php' ?>