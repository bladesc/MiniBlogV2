<?php include 'pageup.php' ?>

    <a href="index.php?pageadmin=gallery&action=prepareCreate" class="button lightblue addnew"><?= $this->translations->pl['buttonAddNew'] ?></a>
    <h1><?= $this->translations->pl['h1GalleryList'] ?></h1>
    <table class="big">
        <thead>
        <tr>
            <td><?= $this->translations->pl['tableId'] ?></td>
            <td><?= $this->translations->pl['tableTitle'] ?></td>
            <td><?= $this->translations->pl['tableContent'] ?></td>
            <td><?= $this->translations->pl['tableStatus'] ?></td>
            <td><?= $this->translations->pl['tableDateC'] ?></td>
            <td><?= $this->translations->pl['tableCode'] ?></td>
            <td><?= $this->translations->pl['tableNick'] ?></td>
            <td><?= $this->translations->pl['tableEdit'] ?></td>
            <td><?= $this->translations->pl['tableDelete'] ?></td>
        </tr>
        </thead>
        <?php if (isset($this->data['galleries'])) : ?>
            <?php foreach ($this->data['galleries'] as $gallery): ?>
                <tbody>
                <tr>
                    <td><?= $gallery['id'] ?></td>
                    <td><?= $gallery['name'] ?></td>
                    <td><?= $gallery['status'] ?></td>
                    <td><?= $gallery['created_at'] ?></td>
                    <td><?= $gallery['updated_at'] ?></td>
                    <td>
                        <%gallery=<?= $gallery['id'] ?>%>
                    </td>
                    <td>
                        <a href="index.php?pageadmin=gallery&action=show&id=<?= $gallery['id'] ?>"
                           class="button lightgrey"><?= $this->translations->pl['buttonShow'] ?><a/>
                    </td>
                    <td>
                        <a href="index.php?pageadmin=gallery&action=prepareUpdate&id=<?= $gallery['id'] ?>"
                           class="button lightgrey"><?= $this->translations->pl['buttonChange'] ?><a/>
                    </td>
                    <td>
                        <a href="index.php?pageadmin=gallery&action=prepareDelete&id=<?= $gallery['id'] ?>"
                           class="button lightgrey"><?= $this->translations->pl['buttonDelete'] ?><a/>
                    </td>
                </tr>
                </tbody>
            <?php endforeach; ?>
        <?php endif ?>
    </table>

<?php include 'pagedown.php' ?>