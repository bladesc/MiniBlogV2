<div id="box-comunicate">
    <?php if (isset($this->data['cPositive'])): ?>
    <div class="communicate positive">
        <?= $this->data['cPositive'] ?>
    </div>
    <?php endif; ?>
    <?php if (isset($this->data['cNegative'])): ?>
    <div class="coumicate negative">
        <?= $this->data['cNegative'] ?>
    </div>
    <?php endif; ?>
</div>