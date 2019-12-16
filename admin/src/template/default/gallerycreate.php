<?php include 'pageup.php' ?>
    <form action="index.php?pageadmin=gallery&action=create" method="post" enctype="multipart/form-data">
        <div>
            Nazwa:
            <input type="text" name="fName" required>
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
            Wybierz zdjecia:
            <input type="file" name="fFiles[]" multiple/>
        </div>
        <div>
            <input type="submit" value="Submit">
        </div>
    </form>
<?php
print_r($this->data);
?>
<?php include 'pagedown.php' ?>