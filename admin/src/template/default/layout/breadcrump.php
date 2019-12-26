
    <div id="box-breadcrump">
        <?php
        $page = '';
        if ($this->request->query()->has('pageadmin')) {
            $page = $this->request->query()->get('pageadmin');
        }
        ?>

        <div>
            <ul>
                <li><a  href="index.php?pageadmin=admin">Home</a></li>
                <?php if(!empty($page)): ?>
                    <li><span><?= $page ?></span></li>
                <?php endif; ?>
                <div class="box-clear-foot"></div>
            </ul>
        </div>

    </div>

