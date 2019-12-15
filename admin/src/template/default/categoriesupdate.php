<?php include 'pageup.php' ?>

    Stara nazwa: <?= $this->data['categories']['name'] ?>
    <form action="index.php?pageadmin=category&action=update&id=<?= $this->data['categories']['id'] ?>" method="post">
        <div>
            Wprowadz nowa nazwe kategorii
            <input type="text" name="fName" value="<?= $this->data['categories']['name'] ?>">
            <input type="hidden" name="fId" value="<?= $this->data['categories']['id'] ?>">
        </div>
        <div>
            <select name="fStatus">
                <option value="1" <?php if ($this->data['categories']['status'] == 1): ?> selected <?php endif; ?>>
                    Aktywny
                </option>
                <option value="2" <?php if ($this->data['categories']['status'] == 2): ?> selected <?php endif; ?>>
                    Nieaktywny
                </option>
            </select>
        </div>
        <div>
            <input type="submit" name="fUpdate" value="Zmien">
        </div>
    </form>
<?php

print_r($this->data);
?>
<?php include 'pagedown.php' ?>