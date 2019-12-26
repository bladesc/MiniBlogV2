<?php include 'pageup.php' ?>

    <h1><?= $this->translations->pl['h1PagesEditing'] ?></h1>
    <form action="index.php?pageadmin=page&action=update&id=<?= $this->data['page']['id'] ?>" method="post">
        <?php include 'layout/validationErrors.php' ?>
        <h3><?= $this->translations->pl['h3BasicData'] ?></h3>
        <div>
            <label for="fName"><?= $this->translations->pl['tableName'] ?></label>
            <input type="text" name="fName" id="fName" value="<?= $this->data['page']['name'] ?>" required>
        </div>
        <div>
            <label for="fUrl"><?= $this->translations->pl['tableAddressUrl'] ?></label>
            <input type="text" name="fUrl" id="fUrl" value="<?= $this->data['page']['url'] ?>" required>
        </div>
        <div>
            <label for="fStatus"><?= $this->translations->pl['tableStatus'] ?></label>
            <select name="fStatus" id="fStatus">
                <option value="1" <?php if ($this->data['page']['status'] == 1): ?> selected <?php endif; ?>>
                    <?= $this->translations->pl['blogStatusActive'] ?>
                </option>
                <option value="2" <?php if ($this->data['page']['status'] == 2): ?> selected <?php endif; ?>>
                    <?= $this->translations->pl['blogStatusInactive'] ?>
                </option>
            </select>
        </div>

        <div>
            <label for="fContent"><?= $this->translations->pl['tableContent'] ?></label>
            <input type="text" name="fContent" id="fContent" value="<?= $this->data['page']['content'] ?>">
        </div>
        <h3><?= $this->translations->pl['h3SeoData'] ?></h3>
        <div>
            <label for="fTitle"><?= $this->translations->pl['tableSeoTitle'] ?></label>
            <input type="text" name="fTitle" id="fTitle" value="<?= $this->data['page']['title'] ?>">
        </div>
        <div>
            <label for="fDescription"><?= $this->translations->pl['tableSeoDescription'] ?></label>
            <input type="text" name="fDescription" id="fDescription" value="<?= $this->data['page']['description'] ?>">
        </div>
        <div>
            <label for="fTags"><?= $this->translations->pl['tableSeoTags'] ?></label>
            <input type="text" name="fTags" id="fTags" value="<?= $this->data['page']['tag'] ?>">
        </div>

        <div>
            <input type="submit" name="fSubmit" value="<?= $this->translations->pl['buttonAdd'] ?>" class="button lightblue">
        </div>
    </form>

<?php include 'pagedown.php' ?>