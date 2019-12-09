<?php include 'layout/header.php' ?>
<?php include 'layout/navigation.php' ?>
<?php include 'layout/communicate.php' ?>
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
        </div>
        <div>
            <input type="submit" name="cSubmin" value="Dodaj">
        </div>
    </form>
<?php
print_r($this->data);
?>
<?php include 'layout/sidebar.php' ?>
<?php include 'layout/footer.php' ?>