<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title><?= $this->siteTitle(); ?></title>
  <link rel="stylesheet" href="<?=PROOT?>assets/css/materialize.min.css" media="screen,projection">
  <link rel="stylesheet" href="<?=PROOT?>assets/css/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="<?=PROOT?>assets/css/custom.css">

  <?= $this->content('head'); ?>
</head>
<body>
  <div class="container">
    <?= $this->content('body'); ?>
  </div>

  <script type="text/javascript" src="<?=PROOT?>assets/js/materialize.min.js"></script>
</body>
</html>