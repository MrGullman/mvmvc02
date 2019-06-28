<?php
  use Core\FH;
  use Core\H;
?>

<form action="<?= $this->contactAction ?>" method="POST" class="form">
<?= FH::csrfInput(); ?>
<div class="row p-3">
  <?= FH::inputBlock('text', 'Email', 'email', isset($this->contact->email) ? $this->contact->email : '', ['class'=>'form-control'], ['class'=>'form-group col-md-6'], $this->displayErrors); ?>
  <?= FH::inputBlock('text', 'Subject', 'subject', isset($this->contact->subject) ? $this->contact->subject : '', ['class'=>'form-control'], ['class'=>'form-group col-md-6'], $this->displayErrors); ?>
  <?= FH::textareaBlock('Body', 'body', isset($this->contact->body) ? $this->contact->body : '', ['class'=>'form-control'], ['class'=>'form-group col-md-12'], $this->displayErrors ); ?>

  <div class="col-md-12 text-right">
    <a href="<?=PROOT?>home" class="btn btn-secondary">Cancel</a>
    <?= FH::submitTag('Send', ['class'=>'btn btn-info']) ?>
  </div>
</div>
</form>