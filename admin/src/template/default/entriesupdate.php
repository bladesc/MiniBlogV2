<?php include 'pageup.php' ?>

<h1><?= $this->translations->pl['h1EntriesEditing'] ?></h1>
    <form action="index.php?pageadmin=entry&action=update&id=<?= $this->data['entries']['id'] ?>" method="post" enctype="multipart/form-data">
        <?php include 'layout/validationErrors.php' ?>
        <div>
            <label for="fTitle"><?= $this->translations->pl['tableTitle'] ?></label>
            <input type="text" name="fTitle" class="medium" id="fTitle" value="<?= $this->data['entries']['title'] ?>">
        </div>
        <div>
            <label for="fContent"><?= $this->translations->pl['tableContent'] ?></label>
            <input type="text" name="fContent" class="medium" id="fContent" value="<?= $this->data['entries']['content'] ?>">
        </div>
        <div>
            <label for="fCategory"><?= $this->translations->pl['tableCategory'] ?></label>
            <select name="fCategory" id="fCategory">
                <?php foreach ($this->data['categories'] as $category): ?>
                    <option value="<?= $category['id'] ?>"
                        <?php if ($this->data['entries']['category_id'] == $category['id']): ?>
                            selected
                        <?php endif; ?>
                    ><?= $category['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="fStatus"><?= $this->translations->pl['tableStatus'] ?></label>
            <select name="fStatus" id="fStatus">
                <option value="1" <?php if ($this->data['entries']['status'] == 1): ?> selected <?php endif; ?>>
                    <?= $this->translations->pl['blogStatusActive'] ?>
                </option>
                <option value="2" <?php if ($this->data['entries']['status'] == 2): ?> selected <?php endif; ?>>
                    <?= $this->translations->pl['blogStatusInactive'] ?>
                </option>
            </select>
        </div>
        <div>
            <label for="fFiles"><?= $this->translations->pl['tableContent'] ?></label>
            <input type="file" name="fFiles" id="fFiles">
        </div>
        <div>
            <input type="hidden" name="fId" value="<?= $this->data['entries']['id'] ?>">
            <input type="text" name="fAuthor" value="1" hidden required>
            <input type="submit" name="fSubmit" value="<?= $this->translations->pl['buttonChange'] ?>" class="button lightblue">
        </div>
    </form>
<?php include 'pagedown.php' ?>