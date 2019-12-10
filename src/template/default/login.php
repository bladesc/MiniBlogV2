<?php include 'pageup.php' ?>

<div id="section-login">
    <form method="post" action="index.php?page=login&action=processLogin">
        <div>
            Email:
            <input type="email" name="fEmail">
        </div>
        <div>
            Password:
            <input type="password" name="fPassword">
        </div>
        <div>
            <input type="submit" name="fLogin">
        </div>
    </form>
</div>

<a href="index.php?page=register">Zarejestruj</a>
<a href="index.php?page=remind">Przypomnij haslo</a>
<?php print_r($this->data); ?>
<?php include 'pagedown.php' ?>
