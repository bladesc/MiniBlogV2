
<?php if(isset($this->data['errors'])): ?>
    <div class="comunicate negative">
        <?php foreach ($this->data['errors'] as $error): ?>
            <div class="validation-error">
                <?= $error ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
