<?php include 'pageup.php' ?>

    <form action="index.php?pageadmin=settings&action=update&id=<?= $this->data['settings']['id'] ?>" method="post">

        <div>
            tytul
            <input type="text" name="fTitle" value="<?= $this->data['settings']['title'] ?>" required>
        </div>
        <div>
            Opis
            <input type="text" name="fDescription" value="<?= $this->data['settings']['description'] ?>" required>
        </div>
        <div>
            meta tagi
            <input type="text" name="fMetaTags" value="<?= $this->data['settings']['meta_tags'] ?>" required>
        </div>

        <div>
            <input type="hidden" name="fId" value="<?= $this->data['settings']['id'] ?>">
            <input type="submit" name="fSubmit" value="Dodaj">
        </div>
    </form>
<?php
print_r($this->data);
?>
<?php include 'pagedown.php' ?>