<?php include 'pageup.php' ?>
    <div id="section-gallery">
        gallery name : <?= $this->data['galleries']['name'] ?>
        <div id="gallery-gallery">
            <?php if (isset($this->data['images'])) : ?>
                <?php foreach ($this->data['images'] as $image): ?>
                    <div class="gallery-image">
                        <img src="<?= '../' . $this->config['blog']['galleryPath'] . $image['id'] . '.' . $image['ext'] ?>">
                    </div>
                <?php endforeach; ?>
            <?php endif ?>
            <div class="box-clear-foot"></div>
        </div>
        <?php
        print_r($this->data);
        ?>
    </div>
<?php include 'pagedown.php' ?>