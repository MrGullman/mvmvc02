<?php
  use Core\FH;
  use Core\H;
?>
<?php $this->setSiteTitle('Edit' . $this->post->title); ?>
<?php $this->start('head'); ?>
<script src="<?=PROOT?>vendor/tinymce/tinymce/tinymce.min.js"></script>
<script>
  tinymce.init({
    selector: '#post',
    branding: false,
    height: 300
  });
</script>
<?php $this->end(); ?>
<?php $this->start('body'); ?>
<div class="row align-items-center justify-content-center">
  <div class="col-md-8 bg-light p-3">
    <h2 class="text-center">Edit <?=$this->post->title?></h2>
    <form action="" method="POST" class="form" enctype="multipart/form-data">
      <?= FH::csrfInput() ?>
      <div class="row">
        <input type="hidden" id="images_sorted" name="images_sorted" value="" />
        <?= FH::inputBlock('text', 'Title', 'title', $this->post->title, ['class'=>'form-control'], ['class'=>'form-group col-md-4'], $this->displayErrors); ?>
        <?= FH::selectBlock('Category', 'category_id', $this->post->category_id, $this->category, ['class'=>'form-control'],['class'=>'form-group col-md-4'], $this->displayErrors); ?>
        <?= FH::textareaBlock('Post', 'post', $this->post->post, ['class'=>'form-control'], ['class'=>'form-group col-md-12'], $this->displayErrors); ?>
      </div>

      <?php $this->partial('adminposts','editImages') ?>
    </form>
  </div>
</div>


<?php $this->end(); ?>