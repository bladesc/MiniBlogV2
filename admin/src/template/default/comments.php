<?php include 'pageup.php' ?>
    <h1><?= $this->translations->pl['h1CommentsList'] ?></h1>
    <table class="big">
        <thead>
        <tr>
            <td><?= $this->translations->pl['tableId'] ?></td>
            <td><?= $this->translations->pl['tableName'] ?></td>
            <td><?= $this->translations->pl['tableContent'] ?></td>
            <td><?= $this->translations->pl['tableIdEntry'] ?></td>
            <td><?= $this->translations->pl['tableEdit'] ?></td>
            <td><?= $this->translations->pl['tableDelete'] ?></td>
        </tr>
        </thead>

        <?php if (isset($this->data['comments'])) : ?>
            <?php foreach ($this->data['comments'] as $comment): ?>
                <tbody>
                <tr>
                    <td><?= $comment['id'] ?></td>
                    <td><?= $comment['user_id'] ?></td>
                    <td><?= \src\core\helper\Helper::cut($comment['content'], 10) ?></td>
                    <td><?= $comment['entry_id'] ?></td>
                    <td>
                        <a href="index.php?pageadmin=comment&action=prepareUpdate&id=<?= $comment['id'] ?>"
                           class="button lightgrey"><?= $this->translations->pl['buttonChange'] ?><a/>
                    </td>
                    <td>
                        <a href="index.php?pageadmin=comment&action=prepareDelete&id=<?= $comment['id'] ?>"
                           class="button lightgrey"><?= $this->translations->pl['buttonDelete'] ?><a/>
                    </td>
                </tr>
                </tbody>
            <?php endforeach; ?>
        <?php endif ?>
    </table>
<?php include 'pagedown.php' ?>