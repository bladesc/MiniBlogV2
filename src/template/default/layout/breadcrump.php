<div class="box-page-body">
<div id="box-breadcrump">
    <?php
    $page = '';
    if ($this->request->query()->has('page')) {
        $page = $this->request->query()->get('page');
    } elseif ($this->request->query()->has('cmspage')) {
        $page = $this->request->query()->get('cmspage');
    }
    ?>

    <div>
        <ul>
            <li><a  href="index.php">Home</a></li>
            <?php if(!empty($page)): ?>
                <li><span><?= $page ?></span></li>
            <?php endif; ?>
            <div class="box-clear-foot"></div>
        </ul>
    </div>

</div>
</div>