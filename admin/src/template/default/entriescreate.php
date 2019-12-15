<?php include 'pageup.php' ?>

    <form action="index.php?pageadmin=entry&action=create" method="post">
        <div>
            Wprowadz nazwe wpisu
            <input type="text" name="fTitle" value="<?= $this->request->post()->get('fTitle') ?>">
            <input type="text" name="fContent" value="<?= $this->request->post()->get('fContent') ?>">
            <input type="text" name="fAuthor" value="1" hidden required>
            Wybierz kategorie
            <select name="fCategory">
                <?php foreach ($this->data['categories'] as $category): ?>
                    <option value="<?= $category['id'] ?>"
                        <?php if ($this->request->post()->get('fCategory') == $category['id']): ?>
                            selected
                        <?php endif; ?>
                    ><?= $category['name'] ?></option>
                <?php endforeach; ?>
            </select>
            Status
            <select name="fStatus">
                <option value="1" <?php if ($this->request->post()->get('fStatus') == 1): ?> selected <?php endif; ?>>
                    Aktywny
                </option>
                <option value="2" <?php if ($this->request->post()->get('fStatus') == 2): ?> selected <?php endif; ?>>
                    Nieaktywny
                </option>
            </select>
        </div>
        <div>
            <input type="submit" name="fSubmit" value="Dodaj">
        </div>
    </form>
<?php
print_r($this->data);
?>
<?php include 'pagedown.php' ?>