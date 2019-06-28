<?php use Core\H; ?>

<?php $this->start('head'); ?>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.css">
  <script type="text/javascript" src="<?=PROOT?>assets/js/moment.min.js?v=<?=VERSION?>"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
<?php $this->end() ?>
<?php $this->start('body'); ?>
  <h1>Dashboard</h1>
  <!-- <?php foreach($this->posts->data as $post) : ?>
    <?= $post->fname . ' ' . $post->lname .','; ?>
  <?php endforeach; ?>
  <?= $this->links; ?> -->
<?php $this->end(); ?>