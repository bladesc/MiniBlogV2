<?php include 'pageup.php' ?>

    <form action="index.php?pageadmin=gallery&action=update&id=<?= $this->data['galleries']['id'] ?>" method="post" enctype="multipart/form-data">
        <div>
            Nazwa:
            <input type="text" name="fName" value="<?= $this->data['galleries']['name'] ?>" required>
        </div>
        <div>
            Status
            <select name="fStatus">
                <option value="1" <?php if ($this->data['galleries']['status'] == 1): ?> selected <?php endif; ?>>
                    Aktywny
                </option>
                <option value="2" <?php if ($this->data['galleries']['status'] == 2): ?> selected <?php endif; ?>>
                    Nieaktywny
                </option>
            </select>
        </div>
        <div>
            Wybierz zdjecia:
            <input type="file" name="fFiles[]" multiple/>
        </div>
        <div>
            <input type="hidden" name="fId" value="<?= $this->data['galleries']['id'] ?>">
            <input type="submit" value="Submit">
        </div>
    </form>
<?php
print_r($this->data);
?>
<?php include 'pagedown.php' ?>