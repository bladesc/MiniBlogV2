<?php include 'pageup.php' ?>

    <form action="index.php?pageadmin=entry&action=create" method="post">
        <div>
            Wprowadz nazwe wpisu
            <input type="text" name="cTitle" value="<?= $this->request->post()->get('cTitle') ?>">
            <input type="text" name="cContent" value="<?= $this->request->post()->get('cContent') ?>">
            <input type="text" name="cAuthor" value="1" hidden required>
            Wybierz kategorie
            <select name="cCategory">
                <?php foreach ($this->data['categories'] as $category): ?>
                    <option value="<?= $category['id'] ?>"
                        <?php if ($this->request->post()->get('cCategory') == $category['id']): ?>
                            selected
                        <?php endif; ?>
                    ><?= $category['name'] ?></option>
                <?php endforeach; ?>
            </select>
            Status
            <select name="cStatus">
                <option value="1" <?php if ($this->request->post()->get('cStatus') == 1): ?> selected <?php endif; ?>>
                    Aktywny
                </option>
                <option value="2" <?php if ($this->request->post()->get('cStatus') == 2): ?> selected <?php endif; ?>>
                    Nieaktywny
                </option>
            </select>
        </div>
        <div>
            <input type="submit" name="cSubmin" value="Dodaj">
        </div>
    </form>
<?php
print_r($this->data);
?>
<?php include 'pagedown.php' ?>