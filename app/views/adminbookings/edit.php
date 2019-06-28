<?php $this->setSiteTitle('Edit Booking'); ?>

<?php $this->start('body'); ?>
  <div class="col-md-10 offset-md-1 bg-light p-3">
    <h2 class="text-center">Edit Booking</h2>
    <p class="text-center lead"><?= $this->booking->booking_nr; ?></p>
    <hr>
      <?= $this->partial('adminbookings', 'booking_form'); ?>
  </div>
<?php $this->end(); ?>