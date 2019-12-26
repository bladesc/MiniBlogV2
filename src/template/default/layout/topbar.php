<div id="box-top-bar">
    <div class="box-page-body">
        <div class="align-right">
            <div id="section-language">
                <div>
                    <a href="index.php?page=index&action=language&lang=pl">PL</a>
                    <a href="index.php?page=index&action=language&lang=en">EN</a>
                </div>
            </div>
            <?php if ($this->data['loggedIn'] === true): ?>
                <div id="section-login-info">
                    <?= $this->translations->pl['topLogged'] ?>: <span><?= $this->data['login'][1] ?></span>
                </div>
                <div id="section-logout">
                    <a href="index.php?page=index&action=logout" class="button small blue"><?= $this->translations->pl['buttonLogout'] ?></a>
                </div>
                <div id="section-change">
                    <a href="index.php?page=change" class="button small blue"><?= $this->translations->pl['buttonChangePass'] ?></a>
                </div>
            <?php if($this->data['role'] === 1): ?>
                <div id="section-admin">
                    <a href="index.php?pageadmin=entry" class="button small lightblue"><?= $this->translations->pl['adminPage'] ?></a>
                </div>
            <?php endif; ?>
            <?php else: ?>
                <div id="section-login-bar">
                    <a href="index.php?page=login" class="button small blue"><?= $this->translations->pl['buttonLogin'] ?></a>
                </div>
                <div id="section-register-bar">
                    <a href="index.php?page=register" class="button small blue"><?= $this->translations->pl['buttonRegister'] ?></a>
                </div>

            <?php endif; ?>
            <div class="box-clear-foot"></div>
        </div>
        <div class="box-clear-foot"></div>
    </div>
</div>