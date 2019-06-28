<?php
  use App\Models\Users;
  use Core\H;
?>
<?php $this->setSiteTitle('Bookings'); ?>
<?php $this->start('head'); ?>
<?php $this->end(); ?>
<?php $this->start('body'); ?>
<?php if(empty($this->bookings)) : ?>
  <div class="col-md-8 offset-md-2 p-3">
    <h2 class="text-center"><?= Users::currentUser()->displayUsername(); ?></h2>
    <p class="lead text-center">You dont have any bookings yet. Click the button below to add your first booking.</p>
    <div class="row justify-content-md-center">
      <a href="<?=PROOT?>adminbookings/add" class="btn btn-info text-center">Add Booking</a>
    </div>
  </div>
<?php else : ?>
  <div class="col-md-10 offset-md-1 p-3">
    <h2 class="text-center">Bookings</h2>
    <table class="table table-striped table-condensed table-bordered table-hover">
      <thead>
        <tr class="d-flex">
          <th class="col-3">Nr</th>
          <th class="col-3">Name</th>
          <th class="col-2">Phone</th>
          <th class="col-2">City</th>
          <th class="col-2"></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($this->bookings as $booking) : ?>
          <tr data-id="<?=$booking->id?>" class="d-flex">
            <td class="col-3">
              <a href="<?=PROOT?>adminbookings/details/<?=$booking->id?>">
                <?= $booking->booking_nr; ?>
              </a>
            </td>
            <td class="col-3"><?= $booking->name; ?></td>
            <td class="col-2"><?= $booking->phone1; ?></td>
            <td class="col-2"><?= $booking->city; ?></td>
            <td class="col-2 text-center">
              <a href="<?=PROOT?>adminbookings/edit/<?=$booking->id?>" class="btn btn-info btn-sm">
                <i class="fas fa-edit"></i>
              </a>
              <a href="#" class="btn btn-danger btn-sm" onclick="deleteBooking(<?=$booking->id?>)">
                <i class="fas fa-trash-alt"></i>
              </a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
<?php endif; ?>

<script>
function deleteBooking(id){
  if(window.confirm("Are you sure you want to delete this booking, It cannot be reversed!")){
    $.ajax({
      url: '<?=PROOT?>adminbookings/delete',
      method: 'POST',
      data : {id:id},
      success: function(resp){
        console.log(resp);
        var msgType = (resp.success) ? 'success' : 'danger';
        if(resp.success){
          $('tr[data-id="'+resp.model_id+'"]').remove();
        }
        alertMsg(resp.msg, msgType);
      }
    })
  }
}


</script>
<?php $this->end(); ?>