<?php include 'pageup.php' ?>
    <h1>Dodawanie wpisu</h1>
    <form action="index.php?pageadmin=entry&action=create" method="post" enctype="multipart/form-data">
        <?php include 'layout/validationErrors.php' ?>
        <div>
            <label for="fTitle">Tytuł</label>
            <input type="text" name="fTitle" class="medium" id="fTitle" value="<?= $this->request->post()->get('fTitle') ?>">
        </div>
        <div>
            <label for="fContent">Treść</label>
            <input type="text" name="fContent" class="medium" id="fContent" value="<?= $this->request->post()->get('fContent') ?>">
        </div>
        <div>
            <label for="fCategory">Kategoria</label>
            <select name="fCategory" id="fCategory">
                <?php foreach ($this->data['categories'] as $category): ?>
                    <option value="<?= $category['id'] ?>"
                        <?php if ($this->request->post()->get('fCategory') == $category['id']): ?>
                            selected
                        <?php endif; ?>
                    ><?= $category['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="fStatus">Status</label>
            <select name="fStatus" id="fStatus">
                <option value="1" <?php if ($this->request->post()->get('fStatus') == 1): ?> selected <?php endif; ?>>
                    Aktywny
                </option>
                <option value="2" <?php if ($this->request->post()->get('fStatus') == 2): ?> selected <?php endif; ?>>
                    Nieaktywny
                </option>
            </select>
        </div>
        <div>
            <label for="fFiles">Miniatura</label>
            <input type="file" name="fFiles" id="fFiles">
        </div>
        <div>
            <input type="text" name="fAuthor" value="1" hidden required>
            <input type="submit" name="fSubmit" value="Dodaj" class="button lightblue">
        </div>
    </form>
<?php include 'pagedown.php' ?>