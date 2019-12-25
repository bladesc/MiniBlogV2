<?php include 'pageup.php' ?>

    <h1>Dodawanie kategorii</h1>
    <form action="index.php?pageadmin=category&action=create" method="post">
        <?php include 'layout/validationErrors.php' ?>
        <div>
            <label for="fName">Nazwa kategorii</label>
            <input type="text" name="fName" id="fName" value="<?= $this->request->post()->get('fName') ?>">
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
            <input type="submit" name="fSubmit" value="Dodaj" class="button lightblue">
        </div>
    </form>
<?php include 'pagedown.php' ?>