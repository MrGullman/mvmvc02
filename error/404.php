<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="<?=PROOT?>assets/css/error.css">
  <title>Error 404</title>
</head>
<body>
<div class="error-container">
  <div class="img-container">
    <img src="<?= PROOT . "assets/img/404_img.jpg"; ?>" alt="">
  </div>
  <div class="text-container">
    <h1><?php echo SITE_TITLE ?></h1>
    <p>Hoppsan nu blev något galet!</p>
    <h2>404</h2>
    <h3>Sidan Kunde Inte Hittas</h3>
    <a href="<?=PROOT?>home" class="btn btn-info mt-3">Tillbaka</a>
  </div>
</div>
</body>
</html>