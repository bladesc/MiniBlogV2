<?php include 'pageup.php' ?>

    <h1>Przypomnij hasło</h1>
    <div id="section-login">
        <form method="post" action="index.php?page=remind&action=processRemind">
            <?php include 'layout/validationErrors.php' ?>
            <div>
                <label for="fEmail">Adres e-mail:</label>
                <input type="email" name="fEmail" id="fEmail" class="medium">
            </div>
            <div>
                <input type="submit" name="fRemind" value="Przypomnij" class="button lightgrey">
            </div>
        </form>
        <a href="index.php?page=login" class="standard">Zaloguj</a>
        <a href="index.php?page=register" class="standard">Zarejestruj</a>
    </div>


<?php include 'pagedown.php' ?>