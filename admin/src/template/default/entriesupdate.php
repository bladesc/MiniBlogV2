<?php include 'pageup.php' ?>

    <form action="index.php?pageadmin=entry&action=update&id=<?= $this->data['entries']['id'] ?>" method="post" enctype="multipart/form-data">
        <div>
            Wprowadz nowa nazwe kategorii
            <input type="text" name="fTitle" value="<?= $this->data['entries']['title'] ?>">
            <input type="text" name="fContent" value="<?= $this->data['entries']['content'] ?>">
            <input type="hidden" name="fId" value="<?= $this->data['entries']['id'] ?>">
            <input type="text" name="fAuthor" value="1" hidden required>
            <select name="fCategory">
                <?php foreach ($this->data['categories'] as $category): ?>
                    <option value="<?= $category['id'] ?>"
                        <?php if ($this->data['entries']['category_id'] == $category['id']): ?>
                            selected
                        <?php endif; ?>
                    ><?= $category['name'] ?></option>
                <?php endforeach; ?>
            </select>
            Status
            <select name="fStatus">
                <option value="1" <?php if ($this->data['entries']['status'] == 1): ?> selected <?php endif; ?>>
                    Aktywny
                </option>
                <option value="2" <?php if ($this->data['entries']['status'] == 2): ?> selected <?php endif; ?>>
                    Nieaktywny
                </option>
            </select>
            Miniatura:
            <input type="file" name="fFiles">
        </div>
        <div>
            <input type="submit" name="fSubmit" value="Zmien">
        </div>
    </form>
<?php

print_r($this->data);
?>
<?php include 'pagedown.php' ?>