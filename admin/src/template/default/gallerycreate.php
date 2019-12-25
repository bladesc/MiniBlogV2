<?php include 'pageup.php' ?>

    <h1>Dodawanie galerii</h1>
    <form action="index.php?pageadmin=gallery&action=create" method="post" enctype="multipart/form-data">

        <?php include 'layout/validationErrors.php' ?>
        <div>
            <label for="fName">Nazwa galerii</label>
            <input type="text" id="fName" name="fName" required>
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
            <label for="fFiles">Zdjęcia</label>
            <input type="file" id="fFiles" name="fFiles[]" multiple/>
        </div>
        <div>
            <input type="submit" value="Dodaj" class="button lightblue">
        </div>
    </form>
<?php
print_r($this->data);
?>
<?php include 'pagedown.php' ?>