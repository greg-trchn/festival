<?php

include('src/view/header.php');
?>

<div class="container">
    <form action="" method="POST">
        <?php if(($_GET['page'] == 'register')) { ?>

        <div class="form-group">
            <label>Prénom</label>
            <input type="text" class="form-control" name="users_firstname">
        </div>
        <div class="form-group">
            <label>Nom</label>
            <input type="text" class="form-control" name="users_lastname">
        </div>
        <?php } ?>

        <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" name="users_email">
        </div>
        <div class="form-group">
            <label>Mot de passe</label>
            <input type="password" class="form-control" name="users_password">
        </div>
        <button type="submit" class="btn btn-primary"><?= $this->button ?></button>
    </form>
</div>


<?php
include('src/view/footer.php');
