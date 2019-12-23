<?php if(isset($this->data['errors'])): ?>
    <div class="validation-box-errors">
        <?php foreach ($this->data['errors'] as $error): ?>
            <div class="validation-error">
                <?= $error ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
