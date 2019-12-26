<?php include 'pageup.php' ?>

    <h1><?= $this->translations->pl['h1GalleryEditing'] ?></h1>
    <form action="index.php?pageadmin=gallery&action=update&id=<?= $this->data['galleries']['id'] ?>" method="post" enctype="multipart/form-data">
        <?php include 'layout/validationErrors.php' ?>
        <div>
            <label for="fName"><?= $this->translations->pl['tableName'] ?></label>
            <input type="text" name="fName" id="fName" value="<?= $this->data['galleries']['name'] ?>" required>
        </div>
        <div>
            <label for="fStatus"><?= $this->translations->pl['tableStatus'] ?></label>
            <select name="fStatus" id="fStatus">
                <option value="1" <?php if ($this->data['galleries']['status'] == 1): ?> selected <?php endif; ?>>
                    <?= $this->translations->pl['blogStatusActive'] ?>
                </option>
                <option value="2" <?php if ($this->data['galleries']['status'] == 2): ?> selected <?php endif; ?>>
                    <?= $this->translations->pl['blogStatusInactive'] ?>
                </option>
            </select>
        </div>
        <div>
            <label for="fFiles"><?= $this->translations->pl['tableImages'] ?></label>
            <input type="file" name="fFiles[]" id="fFiles" multiple/>
        </div>
        <div>
            <input type="hidden" name="fId" value="<?= $this->data['galleries']['id'] ?>">
            <input type="submit" value="<?= $this->translations->pl['buttonChange'] ?>" class="button lightblue">
        </div>
    </form>

<?php include 'pagedown.php' ?>