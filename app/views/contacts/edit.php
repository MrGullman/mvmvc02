<?php $this->setSiteTitle('Edit Contact'); ?>
<?php $this->start('body'); ?>
<div class="col-md-8 offset-md-2 bg-light p-3">
  <h2 class="text-center">Edit Contact</h2>
  <hr>
  <div class="row">
    <?= $this->partial('contacts', 'form'); ?>
  </div>
</div>
<?php $this->end(); ?>