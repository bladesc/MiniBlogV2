<div id="box-navigation">
    <div id="section-menu">
        <ul>
            <li>
                <a href="index.php"><?= $this->translations->pl['menuHomePage'] ?></a>
            </li>

            <?php foreach ($this->data['pages'] as $page): ?>
            <li>
                <a href="<?= $page['url'] ?>"><?= $page['name'] ?></a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>