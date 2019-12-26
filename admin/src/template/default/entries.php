<?php include 'pageup.php' ?>
    <a href="index.php?pageadmin=entry&action=prepareCreate" class="button lightblue addnew"><?= $this->translations->pl['buttonAddNew'] ?></a>
    <h1><?= $this->translations->pl['h1EntriesEditing'] ?></h1>
    <table class="big">
        <thead>
            <tr>
                <td><?= $this->translations->pl['tableId'] ?></td>
                <td><?= $this->translations->pl['tableTitle'] ?></td>
                <td><?= $this->translations->pl['tableContent'] ?></td>
                <td><?= $this->translations->pl['tableStatus'] ?></td>
                <td><?= $this->translations->pl['tableDateAt'] ?></td>
                <td><?= $this->translations->pl['tableCategory'] ?></td>
                <td><?= $this->translations->pl['tableNick'] ?></td>
                <td><?= $this->translations->pl['tableEdit'] ?></td>
                <td><?= $this->translations->pl['tableDelete'] ?></td>
            </tr>
        </thead>
        <?php if (isset($this->data['entries'])) : ?>
            <?php foreach ($this->data['entries'] as $category): ?>
            <tbody>
                <tr>
                    <td><?= $category['id'] ?></td>
                    <td><?= $category['title'] ?></td>
                    <td><?= \src\core\helper\Helper::cut($category['content'],10) ?></td>
                    <td><?= $category['status'] ?></td>
                    <td><?= $category['created_at'] ?></td>
                    <td><?= $category['name'] ?></td>
                    <td><?= $category['nick'] ?></td>
                    <td>
                        <a href="index.php?pageadmin=entry&action=prepareUpdate&id=<?= $category['id'] ?>" class="button lightgrey">Edytuj<a/>
                    </td>
                    <td>
                        <a href="index.php?pageadmin=entry&action=prepareDelete&id=<?= $category['id'] ?>" class="button lightgrey">Usun<a/>
                    </td>
                </tr>
            </tbody>
            <?php endforeach; ?>
        <?php endif ?>
    </table>
<?php include 'pagedown.php' ?>