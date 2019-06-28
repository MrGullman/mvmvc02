<?php
  use App\Models\Users;
  use Core\H;
?>

<?php $this->setSiteTitle('Posts'); ?>
<?php $this->start('body'); ?>
<?php if(empty($this->posts)):?>
<div class="col-md-8 offset-md-2 p-3">
  <h2 class="text-center"><?= Users::currentUser()->displayUsername(); ?></h2>
  <p class="lead text-center">You dont have any post yet. Click the button below to add your first post.</p>
  <div class="row justify-content-md-center">
    <a href="<?=PROOT?>adminposts/add" class="btn btn-info text-center">Add Post</a>
  </div>
</div>
<?php else : ?>
<div class="col-md-8 offset-md-2 p-3">
<h2 class="text-center">Bookings</h2>
  <table class="table table-striped table-condensed table-bordered table-hover">
    <thead>
      <tr class="d-flex">
        <th class="col-8">Name</th>
        <th class="text-center col-2">Created At</th>
        <th class="col-2"></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach($this->posts as $post) : ?>
        <tr data-id="<?=$post->id?>" class="d-flex">
          <td class="col-8">
            <a href="<?=PROOT?>adminposts/details/<?=$post->id?>">
              <?= $post->title; ?>
            </a>
          </td>
          <td class="text-center col-2">
            <?= $post->showDate(); ?>
          </td>
          <td class="text-right col-2">
            <a href="<?=PROOT?>adminposts/edit/<?=$post->id?>" class="btn btn-info btn-sm">
              <i class="fas fa-edit"></i>
            </a>
            <a href="#" class="btn btn-danger btn-sm" onclick="deletePost(<?=$post->id?>)">
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
  function deletePost(id) {
    if(window.confirm("Are you sure you vant to delete this post, It cannot be reversed!")){
      $.ajax({
        url : '<?=PROOT?>adminposts/delete',
        method : 'POST',
        data : {id : id},
        success : function(resp){
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