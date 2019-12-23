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
                    <?= $entry['content'] ?>
                </div>
                <div class="box-clear-foot"></div>
            </div>
        </div>
    <?php endforeach ?>
</div>

<div id="box-comments">
    <?php foreach ($this->data['comments'] as $comment): ?>
        <div class="comment-comment">
            <div class="comment-additional">
                <div class="comment-author">
                    <?= $comment['nick'] ?>
                </div>
                <div class="comment-data">
                    <?= $comment['created_at'] ?>
                </div>
            </div>
            <div class="comment-content">
                <?= $comment['content'] ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php if ($this->data['loggedIn'] === true): ?>
    <div id="box-add-comment">
        <form action="<?= $this->request->server()->get('REQUEST_URI') ?>&action=addComment" method="post">
            <?php include 'layout/validationErrors.php' ?>
            <div>
                <label for="fComment">Komentarz</label>
                <textarea name="fComment" id="fComment" class="big">Napisz komentarz</textarea>
            </div>
            <div>
                <input type="hidden" required name="fAuthor" value="<?= $this->data['login'][0] ?>">
                <input type="hidden" required name="fEntryId" value="<?= $this->request->query()->get('id') ?>">
                <input type="submit" name="fSubmit" value="Dodaj" class="button lightgrey">
            </div>
        </form>
    </div>
<?php endif; ?>
<?php include 'pagedown.php' ?>
