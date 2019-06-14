<?php
  use Core\FH;
  use Core\H;
?>

<form action="<?=$this->postAction?>" class="form" method="POST">
  <?= FH::csrfInput(); ?>

  <div class="row p-3">
    <?= FH::inputBlock('text', 'First Name', 'fname', $this->contact->fname, ['class'=>'form-control'], ['class'=>'form-group col-md-6'], $this->displayErrors) ?>
    <?= FH::inputBlock('text', 'Last Name', 'lname', $this->contact->lname, ['class'=>'form-control'], ['class'=>'form-group col-md-6'], $this->displayErrors) ?>
    <?= FH::inputBlock('text', 'Address', 'address', $this->contact->address, ['class'=>'form-control'], ['class'=>'form-group col-md-6'], $this->displayErrors) ?>
    <?= FH::inputBlock('text', 'Address 2', 'address2', $this->contact->address2, ['class'=>'form-control'], ['class'=>'form-group col-md-6'], $this->displayErrors) ?>
    <?= FH::inputBlock('text', 'Postal Code', 'postalcode', $this->contact->postalcode, ['class'=>'form-control'], ['class'=>'form-group col-md-2'], $this->displayErrors) ?>
    <?= FH::inputBlock('text', 'City', 'city', $this->contact->city, ['class'=>'form-control'], ['class'=>'form-group col-md-4'], $this->displayErrors) ?>
    <?= FH::inputBlock('text', 'Email', 'email', $this->contact->email, ['class'=>'form-control'], ['class'=>'form-group col-md-6'], $this->displayErrors) ?>
    <?= FH::inputBlock('text', 'Cell Phone', 'cell_phone', $this->contact->cell_phone, ['class'=>'form-control'], ['class'=>'form-group col-md-4'], $this->displayErrors) ?>
    <?= FH::inputBlock('text', 'Home Phone', 'home_phone', $this->contact->home_phone, ['class'=>'form-control'], ['class'=>'form-group col-md-4'], $this->displayErrors) ?>
    <?= FH::inputBlock('text', 'Work Phone', 'work_phone', $this->contact->work_phone, ['class'=>'form-control'], ['class'=>'form-group col-md-4'], $this->displayErrors) ?>
  </div>
  <div class="col-md-12 text-right">
    <a href="<?=PROOT?>contacts" class="btn btn-secondary">Cancel</a>
    <?= FH::submitTag('Save', ['class'=>'btn btn-info']) ?>
  </div>

</form>