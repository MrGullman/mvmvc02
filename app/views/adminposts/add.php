<?php $this->setSiteTitle('Add Post'); ?>
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
  <h2 class="text-center">Add New Post</h2>
  <div class="row">
    <div class="col-md-10 offset-md-1 bg-light p-3">
      <?= $this->partial('adminposts', 'form'); ?>
    </div>
  </div>
<?php $this->end(); ?>