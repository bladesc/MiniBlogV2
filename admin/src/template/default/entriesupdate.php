<?php include 'pageup.php' ?>

    <form action="index.php?pageadmin=entry&action=update&id=<?= $this->data['entries']['id'] ?>" method="post">
        <div>
            Wprowadz nowa nazwe kategorii
            <input type="text" name="cTitle" value="<?= $this->data['entries']['title'] ?>">
            <input type="text" name="cContent" value="<?= $this->data['entries']['content'] ?>">
            <input type="hidden" name="cId" value="<?= $this->data['entries']['id'] ?>">
            <input type="text" name="cAuthor" value="1" hidden required>
            <select name="cCategory">
                <?php foreach ($this->data['categories'] as $category): ?>
                    <option value="<?= $category['id'] ?>"
                        <?php if ($this->request->post()->get('cCategory') == $category['id']): ?>
                            selected
                        <?php endif; ?>
                    ><?= $category['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <input type="submit" name="cUpdate" value="Zmien">
        </div>
    </form>
<?php

print_r($this->data);
?>
<?php include 'pagedown.php' ?>