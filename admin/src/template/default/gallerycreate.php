<?php include 'pageup.php' ?>

    <h1><?= $this->translations->pl['h1GalleryAdding'] ?></h1>
    <form action="index.php?pageadmin=gallery&action=create" method="post" enctype="multipart/form-data">

        <?php include 'layout/validationErrors.php' ?>
        <div>
            <label for="fName"><?= $this->translations->pl['tableName'] ?></label>
            <input type="text" id="fName" name="fName" required>
        </div>
        <div>
            <label for="fStatus"><?= $this->translations->pl['tableStatus'] ?></label>
            <select name="fStatus" id="fStatus">
                <option value="1" <?php if ($this->request->post()->get('fStatus') == 1): ?> selected <?php endif; ?>>
                    <?= $this->translations->pl['blogStatusActive'] ?>
                </option>
                <option value="2" <?php if ($this->request->post()->get('fStatus') == 2): ?> selected <?php endif; ?>>
                    <?= $this->translations->pl['blogStatusInactive'] ?>
                </option>
            </select>
        </div>
        <div>
            <label for="fFiles"><?= $this->translations->pl['tableImages'] ?></label>
            <input type="file" id="fFiles" name="fFiles[]" multiple/>
        </div>
        <div>
            <input type="submit" value="<?= $this->translations->pl['buttonAdd'] ?>" class="button lightblue">
        </div>
    </form>

<?php include 'pagedown.php' ?>