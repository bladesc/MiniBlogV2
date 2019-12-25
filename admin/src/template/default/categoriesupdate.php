<?php include 'pageup.php' ?>

    <h1>Edycja kategorii</h1>

    <h3>Stara nazwa: <?= $this->data['categories']['name'] ?></h3>
    <form action="index.php?pageadmin=category&action=update&id=<?= $this->data['categories']['id'] ?>" method="post">
        <?php include 'layout/validationErrors.php' ?>
        <div>
            <label for="fName">Nowa nazwa</label>
            <input type="text" name="fName" id="fName" value="<?= $this->data['categories']['name'] ?>">
        </div>
        <div>
            <label for="fStatus">Status</label>
            <select name="fStatus" id="fStatus">
                <option value="1" <?php if ($this->data['categories']['status'] == 1): ?> selected <?php endif; ?>>
                    Aktywny
                </option>
                <option value="2" <?php if ($this->data['categories']['status'] == 2): ?> selected <?php endif; ?>>
                    Nieaktywny
                </option>
            </select>
        </div>
        <div>
            <input type="hidden" name="fId" value="<?= $this->data['categories']['id'] ?>">
            <input type="submit" name="fUpdate" value="Edytuj" class="button lightblue">
        </div>
    </form>
<?php

print_r($this->data);
?>
<?php include 'pagedown.php' ?>