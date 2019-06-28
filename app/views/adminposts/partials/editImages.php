<style>
  .edit-image-wrapper {
    background-color: #aeaeae;
    border-radius: 4px;
    box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.25);
  }

  .edit-image-wrapper img {
    height: 75px;
    width: auto;
  }

  .sortable-placeholder {
    background-color: #eee;
  }

  .deleteButton {
    position: absolute;
    top: 2px;
    right: 2px;
    color: crimson;
    cursor: pointer;
  }

  .deleteButton:hover {
    color: #aa0000;
  }
</style>

<div id="sortableImages" class="row align-items-center justify-content-start p-2">
  <?php foreach($this->images as $image) : ?>
    <div class="col flex-grow-0" id="image_<?=$image->id?>">
      <span class="deleteButton" onclick="deleteImage('<?=$image->id?>')"><i class="fas fa-times"></i></span>
      <div class="edit-image-wrapper" data-id="$image->id">
        <img src="<?=PROOT.$image->url?>" />
      </div>
    </div>
  <?php endforeach; ?>
</div>