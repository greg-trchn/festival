<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <title>Festival - <?= $this->title ?></title>
</head>

<body>

  <nav class="navbar navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="<?=ROOT_HTTP?>">Festival de musique</a>
      <ul class="nav">
        <li class="nav-item">
          <a class="nav-link text-light" href="<?=ROOT_HTTP?>">Home</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link text-light" href="<?=ROOT_HTTP?>purchases">Mes achats</a>
        </li>
        <?php if (!isset($_SESSION['user_id'])) { ?>
          <li class="nav-item">
            <a class="nav-link text-light" href="<?=ROOT_HTTP?>register" rel="nofollow">Inscription</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="<?=ROOT_HTTP?>connexion" rel="nofollow">Connexion</a>
          </li>
        <?php } else { ?>
          <li class="nav-item">
            <b><a class="nav-link text-light" href="<?=ROOT_HTTP?>deconnexion" rel="nofollow">Deconnexion</a></b>
          </li>
        <?php } ?>
      </ul>
      <a href="<?=ROOT_HTTP?>cart" class="btn btn-info text-light" rel="nofollow">Votre panier (<?= ($_SESSION['cart']) ? count($_SESSION['cart']) : '0' ?>) <img style="width:30px;" src="src/public/img/shopping-cart.svg" alt="Caddy"></a>
    </div>
  </nav>

  <h1 style="margin:1em 0;" class="text-center"><?= $this->title ?></h1>

  <?php if ($this->alert) : ?>
    <div class="<?= $this->style ?> col text-center" style="margin-top:1.5em;" role="alert">
      <?= $this->alert; ?>
    </div>
  <?php endif ?>