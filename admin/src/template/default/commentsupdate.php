<?php include 'pageup.php' ?>

    <h1><?= $this->translations->pl['h1CommentsEditing'] ?></h1>
    <form action="index.php?pageadmin=comment&action=update&id=<?= $this->data['comments']['id'] ?>" method="post">
        <?php include 'layout/validationErrors.php' ?>
        <div>
            <label for="fContent"><?= $this->translations->pl['comment'] ?></label>
            <input type="text" name="fContent" id="fContent" value="<?= $this->data['comments']['content'] ?>">
        </div>
        <div>
            <input type="hidden" name="fId" value="<?= $this->data['comments']['id'] ?>">
            <input type="submit" name="fSubmit" value="<?= $this->translations->pl['buttonChange'] ?>" class="button lightblue">
        </div>
    </form>

<?php include 'pagedown.php' ?>