<?php include 'pageup.php' ?>

    <h1>Podgląd galerii</h1>
    <div class="section-gallery">
        Galeria: <b><?= $this->data['galleries']['name'] ?></b>
        <div class="gallery-gallery">
            <?php if (isset($this->data['images'])) : ?>
                <?php foreach ($this->data['images'] as $image): ?>
                    <div class="gallery-image">
                        <img src="<?= '../' . $this->config['blog']['galleryPath'] . $image['id'] . '.' . $image['ext'] ?>">
                    </div>
                <?php endforeach; ?>
            <?php endif ?>
            <div class="box-clear-foot"></div>
        </div>

    </div>
<?php include 'pagedown.php' ?>