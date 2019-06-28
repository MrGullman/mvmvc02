<?php $this->setSiteTitle('Contact ' . MENU_BRAND); ?>

<?php $this->start('body'); ?>
<h2 class="text-center">Contact Page</h2>
<div class="row">
  <div class="col-md-6 offset-md-3 bg-light p-3 mt-3">
    <?= $this->partial('home', 'contact_form'); ?>
  </div>
</div>
<?php $this->end(); ?>