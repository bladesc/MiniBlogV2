<?php include 'pageup.php' ?>

    <div id="section-login">
        <form method="post" action="index.php?page=remind&action=processRemind">
            <div>
                Email:
                <input type="email" name="fEmail">
            </div>
            <div>
                <input type="submit" name="fRemind">
            </div>
        </form>
    </div>
    <a href="index.php?page=login">Zaloguj</a>
    <a href="index.php?page=register">Zarejestruj</a>

<?php print_r($this->data); ?>
<?php include 'pagedown.php' ?>