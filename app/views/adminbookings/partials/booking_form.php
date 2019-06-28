<?php
  use Core\{FH,H};
?>

<form action="<?=$this->formAction?>" method="POST" class="form">
  <?= FH::csrfInput(); ?>
  <div class="row">
    <?= FH::inputBlock('text', 'Name', 'name', $this->booking->name, ['class'=>'form-control'], ['class'=>'form-group col-md-6'], $this->displayErrors); ?>
    <?= FH::inputBlock('text', 'Phone Primary', 'phone1', $this->booking->phone1, ['class'=>'form-control'], ['class'=>'form-group col-md-3'], $this->displayErrors); ?>
    <?= FH::inputBlock('text', 'Phone Secondary', 'phone2', $this->booking->phone2, ['class'=>'form-control'], ['class'=>'form-group col-md-3'], $this->displayErrors); ?>
  </div>
  <div class="row">
    <?= FH::inputBlock('text', 'Purpose', 'purpose', $this->booking->purpose, ['class'=>'form-control'], ['class'=>'form-group col-md-12'], $this->displayErrors); ?>
  </div>
  <div class="row">
    <?= FH::inputBlock('text', 'City', 'city', $this->booking->city, ['class'=>'form-control'], ['class'=>'form-group col-md-5'], $this->displayErrors); ?>
    <?= FH::inputBlock('text', 'Address', 'address', $this->booking->address, ['class'=>'form-control'], ['class'=>'form-group col-md-7'], $this->displayErrors); ?>
  </div>
  <div class="row">
    <?= FH::inputBlock('text', 'Email', 'email', $this->booking->email, ['class'=>'form-control'], ['class'=>'form-group col-md-6'], $this->displayErrors); ?>
    <?= FH::inputBlock('date', 'Date', 'date', $this->booking->date, ['class'=>'form-control'], ['class'=>'form-group col-md-3'], $this->displayErrors); ?>
    <?= FH::inputBlock('time', 'Time', 'time', $this->booking->time, ['class'=>'form-control'], ['class'=>'form-group col-md-3'], $this->displayErrors); ?>
  </div>
  <div class="row">
    <?= FH::inputBlock('text', 'Travle Supplement', 'travle_supplement', $this->booking->travle_supplement, ['class'=>'form-control'], ['class'=>'form-group col-md-12'], $this->displayErrors); ?>
  </div>
  <div class="row">
    <?= FH::textareaBlock('Outher', 'outher', $this->booking->outher, ['class'=>'form-control'], ['class'=>'form-group col-md-12'], $this->displayErrors); ?>
  </div>
  <div class="col-md-12 text-right">
    <a href="<?=PROOT?>adminbookings" class="btn btn-secondary">Cancel</a>
    <?= FH::submitTag('Save', ['class'=>'btn btn-info']) ?>
  </div>

</form>