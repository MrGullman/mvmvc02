<?php $this->setSiteTitle($this->contact->displayName()) ?>
<?php $this->start('head') ?>
<?php $this->end() ?>
<?php $this->start('body') ?>
  <div class="col-md-8 offset-md-2 bg-light p-3">
    <a href="<?=PROOT?>contacts" class="btn btn-sm btn-info">Back</a>
    <h2 class="text-center"><?= $this->contact->displayName() ?></h2>
      <div class="row p-3">
        <div class="col-md-6">
          <p><strong>Email: </strong><?=$this->contact->email?></p>
          <p><strong>Cell Phone: </strong><?=$this->contact->cell_phone?></p>
          <p><strong>Home Phone: </strong><?=$this->contact->home_phone?></p>
          <p><strong>Work Phone: </strong><?=$this->contact->work_phone?></p>
        </div>
        <div class="col-md-6">
          <?= $this->contact->displayAddressLabel()?>
        </div>
      </div>
  </div>
<?php $this->end() ?>