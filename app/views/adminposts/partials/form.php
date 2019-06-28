<?php
  use Core\FH;
  use Core\H;
?>
<form action="<?=$this->formAction?>" method="POST" enctype="multipart/form-data">
  <?= FH::csrfInput(); ?>
  <!-- <?= FH::displayErrors($this->displayErrors)?> -->
  <div class="row p-3">
    <?= FH::inputBlock('text', 'Title', 'title', $this->posts->title, ['class'=>'form-control'], ['class'=>'form-group col-md-4'], $this->displayErrors); ?>
    <?= FH::selectBlock('Category', 'category_id', $this->posts->category_id, $this->category, ['class'=>'form-control'],['class'=>'form-group col-md-4'], $this->displayErrors); ?>
    <?= FH::textareaBlock('Post', 'post', $this->posts->post, ['class'=>'form-control'], ['class'=>'form-group col-md-12'], $this->displayErrors); ?>
  </div>

  <div class="row p-3">
    <?= FH::inputBlock('file',"Upload PostImages:",'postImages[]','',['class'=>'form-control-file','multiple'=>'multiple'],['class'=>'form-group col-md-6'], $this->displayErrors) ?>
  </div>

  <div class="col-md-12 text-right">
    <a href="<?=PROOT?>adminposts" class="btn btn-secondary">Cancel</a>
    <?= FH::submitTag('Save', ['class'=>'btn btn-info']) ?>
  </div>
</form>