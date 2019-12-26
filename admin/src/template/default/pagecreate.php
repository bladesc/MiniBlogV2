<?php include 'pageup.php' ?>

    <h1><?= $this->translations->pl['h1PagesAdding'] ?></h1>
    <form action="index.php?pageadmin=page&action=create" method="post">
        <?php include 'layout/validationErrors.php' ?>
        <h3><?= $this->translations->pl['h3BasicData'] ?></h3>
        <div>
            <label for="fName"><?= $this->translations->pl['tableName'] ?></label>
            <input type="text" name="fName" id="fName" value="<?= $this->request->post()->get('fName') ?>" required>
        </div>
        <div>
            <label for="fUrl"><?= $this->translations->pl['tableAddressUrl'] ?></label>
            <input type="text" name="fUrl" id="fUrl" value="<?= $this->request->post()->get('fUrl') ?>" required>
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
            <label for="fContent"><?= $this->translations->pl['tableContent'] ?></label>
            <input type="text" name="fContent" id="fContent" value="<?= $this->request->post()->get('fContent') ?>">
        </div>
        <h3><?= $this->translations->pl['h3SeoData'] ?></h3>
        <div>
            <label for="fTitle"><?= $this->translations->pl['tableSeoTitle'] ?></label>
            <input type="text" name="fTitle" id="fTitle" value="<?= $this->request->post()->get('fTitle') ?>">
        </div>
        <div>
            <label for="fDescription"><?= $this->translations->pl['tableSeoDescription'] ?></label>
            <input type="text" name="fDescription" id="fDescription" value="<?= $this->request->post()->get('fDescription') ?>">
        </div>
        <div>
            <label for="fTags"><?= $this->translations->pl['tableSeoTags'] ?></label>
            <input type="text" name="fTags" id="fTags" value="<?= $this->request->post()->get('fTags') ?>">
        </div>

        <div>
            <input type="submit" name="fSubmit" value="<?= $this->translations->pl['buttonAdd'] ?>" class="button lightblue">
        </div>
    </form>

<?php include 'pagedown.php' ?>