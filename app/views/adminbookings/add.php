<?php $this->setSiteTitle('Add Booking'); ?>
<?php $this->start('head'); ?>
<?php $this->end(); ?>
<?php $this->start('body'); ?>
<h2 class="text-center">Add New Booking</h2>
<div class="row">
  <div class="col-md-10 offset-md-1 bg-light p-3">
    <?= $this->partial('adminbookings', 'booking_form'); ?>
  </div>
</div>
<?php $this->end(); ?>