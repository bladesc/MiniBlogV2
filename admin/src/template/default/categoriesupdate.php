<?php include 'pageup.php' ?>

    <h1><?= $this->translations->pl['h1CategoriesEditing'] ?></h1>

    <h3><?= $this->translations->pl['oldName'] ?>: <?= $this->data['categories']['name'] ?></h3>
    <form action="index.php?pageadmin=category&action=update&id=<?= $this->data['categories']['id'] ?>" method="post">
        <?php include 'layout/validationErrors.php' ?>
        <div>
            <label for="fName"><?= $this->translations->pl['newName'] ?></label>
            <input type="text" name="fName" id="fName" value="<?= $this->data['categories']['name'] ?>">
        </div>
        <div>
            <label for="fStatus"><?= $this->translations->pl['tableStatus'] ?></label>
            <select name="fStatus" id="fStatus">
                <option value="1" <?php if ($this->data['categories']['status'] == 1): ?> selected <?php endif; ?>>
                    <?= $this->translations->pl['blogStatusActive'] ?>
                </option>
                <option value="2" <?php if ($this->data['categories']['status'] == 2): ?> selected <?php endif; ?>>
                    <?= $this->translations->pl['blogStatusInactive'] ?>
                </option>
            </select>
        </div>
        <div>
            <input type="hidden" name="fId" value="<?= $this->data['categories']['id'] ?>">
            <input type="submit" name="fUpdate" value="<?= $this->translations->pl['buttonChange'] ?>" class="button lightblue">
        </div>
    </form>

<?php include 'pagedown.php' ?>