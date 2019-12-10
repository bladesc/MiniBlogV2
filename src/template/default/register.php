<?php include 'pageup.php' ?>

    <div id="section-register">
        <form method="post" action="index.php?page=register&action=create">
            <div>
                Name:
                <input type="text" name="fNick">
            </div>
            <div>
                Email:
                <input type="email" name="fEmail">
            </div>
            <div>
                Haslo:
                <input type="password" name="fPassword">
            </div>
            <div>
                Potwierdz haslo:
                <input type="password" name="fPasswordProve">
            </div>
            <div>
                <input type="submit" name="fAdd">
            </div>
        </form>
    </div>
<?php print_r($this->data); ?>
<?php include 'pagedown.php' ?>