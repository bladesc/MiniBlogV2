<?php include 'pageup.php' ?>

    <div id="box-entries">
        <?php foreach ($this->data['entries'] as $entry): ?>
            <div class="entry-entry">
                <div class="entry-info">
                    <div class="entry-author">
                        Autor: <span><?= $entry['nick'] ?></span>
                    </div>
                    <div class="entry-date">
                        Date <span><?= $entry['created_at'] ?></span>
                    </div>
                    <div class="entry-category">
                        Kategoria: <span><?= $entry['name'] ?></span>
                    </div>
                    <div class="box-clear-foot"></div>
                </div>
                <div class="entry-title">
                <span><?= $entry['title'] ?>
                </div>
                <div class="entry-desc">
                    <?php if (!empty($entry['photo_id'])): ?>
                        <div class="entry-image">
                <span>
                    <img src="<?= $this->data['imagePath'] . $entry['photo_id'] . '.' . $entry['ext'] ?>"
                         alt="<?= $entry['file_name'] . '.' . $entry['ext'] ?>">
                </span>
                        </div>
                    <?php endif; ?>
                    <div class="entry-content">
                        <?= \src\core\helper\Helper::cut($entry['content'], 700) ?>
                        <a class="button-text" href="index.php?page=entry&id=<?= $entry['id'] ?>">Czytaj więcej</a>
                    </div>
                    <div class="box-clear-foot"></div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
    <div id="box-paginator">
        <?= $this->data['paginator'] ?>
    </div>

<?php include 'pagedown.php' ?>