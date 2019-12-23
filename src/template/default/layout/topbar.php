<div id="box-top-bar">
    <div class="box-page-body">
        <div class="align-right">
            <?php if ($this->data['loggedIn'] === true): ?>
                <div id="section-login-info">
                    Jesteś zalogowany: <span><?= $this->data['login'][1] ?></span>
                </div>
                <div id="section-logout">
                    <a href="index.php?page=index&action=logout" class="button small blue">Wyloguj</a>
                </div>
                <div id="section-change">
                    <a href="index.php?page=change" class="button small blue">Zmien haslo</a>
                </div>
            <?php else: ?>
                <div id="section-login-bar">
                    <a href="index.php?page=login" class="button small blue">Zaloguj</a>
                </div>
                <div id="section-register-bar">
                    <a href="index.php?page=register" class="button small blue">Zarejestruj</a>
                </div>

            <?php endif; ?>
            <div class="box-clear-foot"></div>
        </div>
        <div class="box-clear-foot"></div>
    </div>
</div>