<?php
use Core\H;
// H::dnd($this);
?>

<?php $this->start('head') ?>
<?php $this->end() ?>
<?php $this->start('body') ?>
<h2 class="text-center">Contacts Page</h2>
<div class="col-md-8 offset-md-2 p-3">
  <table class="table table-sm table-striped table-condensed table-bordered table-hover">
    <thead>
      <th>Name</th>
      <th>Email</th>
      <th>Cell Phone</th>
      <th></th>
    </thead>
    <tbody>
      <?php foreach($this->contacts as $contact) : ?>
        <tr>
          <td>
            <a href="<?=PROOT?>contacts/details/<?=$contact->id?>">
            <?= $contact->displayName(); ?>
            </a>
          </td>
          <td>
            <?= $contact->email; ?>
          </td>
          <td>
            <?= $contact->cell_phone; ?>
          </td>
          <td>
            <a href="<?=PROOT?>contacts/edit/<?=$contact->id?>" class="btn btn-info btn-sm">
              <i class="fas fa-edit"></i>
            </a>
            <a href="<?=PROOT?>contacts/delete/<?=$contact->id?>" class="btn btn-danger btn-sm" onclick="if(!confirm('Are you sure?')){return false;}">
              <i class="fas fa-trash-alt"></i>
            </a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>


<?php $this->end() ?>