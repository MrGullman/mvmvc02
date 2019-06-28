<?php use Core\H; ?>

<?php $this->setSiteTitle($this->booking->booking_nr); ?>
<?php $this->start('head'); ?>
<?php $this->end(); ?>
<?php $this->start('body'); ?>
<div class="col-md-8 offset-md-2 bg-light p-3">
  <a href="<?=PROOT?>adminbookings/index" class="btn btn-sm btn-dark">Back</a>
  <h2 class="text-center">Booking</h2>
  <p class="lead text-center"><?=$this->booking->booking_nr?></p>
  <hr>
  <h4 class="text-info font-weight-normal">Booking Info</h4>
  <div class="row p-2">
    <div class="col-md-6">

      <p class="mb-0"><strong>Name: </strong><?= $this->booking->name; ?></p>
      <p class="mb-0"><strong>Phone: </strong><?= $this->booking->phone1; ?> <?= isset($this->booking->phone2) ? ', ' . $this->booking->phone2 : ''; ?></p>
      <p class="mb-0"><strong>Email: </strong><?= $this->booking->email; ?></p>
    </div>
    <div class="col-md-6">
      <p class="mb-0"><strong>City: </strong><?= $this->booking->city; ?></p>
      <p class="mb-0"><strong>Address: </strong><?= $this->booking->address; ?></p>
      <p class="mb-0"><strong>Purpose: </strong><?= $this->booking->purpose; ?></p>
    </div>
  </div>
  <hr>
  <h4 class="text-info font-weight-normal">Booking Time</h4>
  <div class="row p-2">
    <div class="col-md-6">

      <p class="mb-0"><strong>Date: </strong><?= $this->booking->date; ?></p>
    </div>
    <div class="col-md-6">
      <p class="mb-0"><strong>Time: </strong><?= date("h:i",strtotime($this->booking->time)); ?></p>
    </div>
  </div>
  <hr>
  <h4 class="text-info font-weight-normal">Booking Whats Included</h4>
  <div class="row p-2">
    <div class="col-md-12">
      <p class="mb-0"><strong>Travle Supplement: </strong><?= $this->booking->travle_supplement; ?></p>
    </div>
    <div class="col-md-12">
      <p class="mb-0"><strong>Outher: </strong><?= $this->booking->outher; ?></p>
    </div>
  </div>
  <div class="row p-2">
    <div class="col-md-12 text-right">
      <?php if(isset($this->booking->pdf)) : ?>
        <a href="<?=PROOT?>adminbookings/openPdf/<?=$this->booking->id?>" class="btn btn-primary btn-sm">
          <i class="far fa-file-pdf"></i> Booking Pdf
        </a>
      <?php endif; ?>
      <a href="<?=PROOT?>adminbookings/edit/<?=$this->booking->id?>" class="btn btn-info btn-sm">
        <i class="fas fa-edit"></i> Edit
      </a>
      <a href="#" class="btn btn-secondary btn-sm" onclick="createPdf(<?=$this->booking->id?>)">
        <i class="far fa-file-pdf"></i> Create PDF
      </a>
    </div>
  </div>
</div>

<script>
function createPdf(id){
  $.ajax({
    url: '<?=PROOT?>adminbookings/createPdf',
    method: 'POST',
    data : {id:id},
    success: function(resp){
      console.log(resp);
      var msgType = (resp.success) ? 'success' : 'danger';
      // if(resp.success){
      //   $('tr[data-id="'+resp.model_id+'"]').remove();
      // }
      alertMsg(resp.msg, msgType);
      if(resp.success == true){
        location.reload();
      }
    }
  })
}


</script>
<?php $this->end(); ?>