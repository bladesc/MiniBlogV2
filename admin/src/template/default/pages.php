<?php include 'pageup.php' ?>
    <a href="index.php?pageadmin=page&action=prepareCreate" class="button lightblue addnew"><?= $this->translations->pl['buttonAddNew'] ?></a>
    <h1><?= $this->translations->pl['h1PagesEditing'] ?></h1>
    <table class="big">
        <thead>
        <tr>
            <td><?= $this->translations->pl['tableId'] ?></td>
            <td><?= $this->translations->pl['tableName'] ?></td>
            <td><?= $this->translations->pl['tableAddressUrl'] ?></td>
            <td><?= $this->translations->pl['tableContent'] ?></td>
            <td><?= $this->translations->pl['tableStatus'] ?></td>
            <td><?= $this->translations->pl['tableDateAt'] ?></td>
            <td><?= $this->translations->pl['tableDateAp'] ?></td>
            <td><?= $this->translations->pl['tableSeoTitle'] ?></td>
            <td><?= $this->translations->pl['tableSeoTags'] ?></td>
            <td><?= $this->translations->pl['tableSeoDescription'] ?></td>
            <td><?= $this->translations->pl['tableEdit'] ?></td>
            <td><?= $this->translations->pl['tableDelete'] ?></td>
        </tr>
        </thead>

        <?php foreach ($this->data['pages'] as $page): ?>
            <tbody>
            <tr>
                <td><?= $page['id'] ?></td>
                <td><?= $page['name'] ?></td>
                <td><?= $page['url'] ?></td>
                <td><?= \src\core\helper\Helper::cut($page['content'], 10) ?></td>
                <td><?= $page['status'] ?></td>
                <td><?= $page['created_at'] ?></td>
                <td><?= $page['updated_at'] ?></td>
                <td><?= \src\core\helper\Helper::cut($page['title'], 10) ?></td>
                <td><?= \src\core\helper\Helper::cut($page['description'], 10) ?></td>
                <td><?= $page['tag'] ?></td>
                <td>
                    <a href="index.php?pageadmin=page&action=prepareUpdate&id=<?= $page['id'] ?>"
                       class="button lightgrey"><?= $this->translations->pl['buttonChange'] ?><a/>
                </td>
                <td>
                    <a href="index.php?pageadmin=page&action=prepareDelete&id=<?= $page['id'] ?>"
                       class="button lightgrey"><?= $this->translations->pl['buttonDelete'] ?><a/>
                </td>
            </tr>
            </tbody>
        <?php endforeach; ?>
    </table>
<?php include 'pagedown.php' ?>