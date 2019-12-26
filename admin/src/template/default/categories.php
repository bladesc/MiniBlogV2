<?php include 'pageup.php' ?>

<a href="index.php?pageadmin=category&action=prepareCreate" class="button lightblue addnew"><?= $this->translations->pl['buttonAddNew'] ?></a>
<h1><?= $this->translations->pl['h1CategoriesList'] ?></h1>
<table class="big">
    <thead>
    <tr>
        <td><?= $this->translations->pl['tableId'] ?></td>
        <td><?= $this->translations->pl['tableName'] ?></td>
        <td><?= $this->translations->pl['tableStatus'] ?></td>
        <td><?= $this->translations->pl['tableEdit'] ?></td>
        <td><?= $this->translations->pl['tableDelete'] ?></td>
    </tr>
    </thead>
    <?php foreach ($this->data['categories'] as $category): ?>
        <tbody>
        <tr>
            <td><?= $category['id'] ?></td>
            <td><?= $category['name'] ?></td>
            <td><?= $category['status'] ?></td>
            <td>
                <a href="index.php?pageadmin=category&action=prepareUpdate&id=<?= $category['id'] ?>"
                   class="button lightgrey"><?= $this->translations->pl['buttonChange'] ?><a/>
            </td>
            <td>
                <a href="index.php?pageadmin=category&action=prepareDelete&id=<?= $category['id'] ?>"
                   class="button lightgrey"><?= $this->translations->pl['buttonDelete'] ?><a/>
            </td>
        </tr>
        </tbody>
    <?php endforeach; ?>
</table>

<?php include 'pagedown.php' ?>



