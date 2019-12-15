<?php include 'pageup.php' ?>

    <form action="index.php?pageadmin=category&action=create" method="post">
        <div>
            Wprowadz nazwe kategorii
            <input type="text" name="fName" value="<?= $this->request->post()->get('fName') ?>">
        </div>
        <div>
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
            <input type="submit" name="fSubmit" value="Dodaj">
        </div>
    </form>
<?php
print_r($this->data);
?>
<?php include 'pagedown.php' ?>