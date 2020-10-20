<?php
include('src/view/header.php');
?>


<div class="container">

    <table class="table">
        <thead>
            <tr>
                <th scope="col">
                    Date du concert
                </th>
                <th scope="col">
                    Artistes
                </th>
                <th scope="col">
                    Scènes
                </th>
                <th scope="col">
                    Prix Unitaire
                </th>
                <th scope="col">
                    Quantité
                </th>
                <th scope="col">
                    Montant Total
                </th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 0; $i < count($_SESSION['cart']); $i++) { ?>
                <tr>
                    <th scope="row"><b><?= $this->cart[$i]['concerts_date'] ?></b></th>
                    <td><b><?= $this->cart[$i]['artistes_name'] ?></b></td>
                    <td><?= $this->cart[$i]['scenes_name'] ?></td>
                    <td><?= $this->cart[$i]['concerts_price'] ?> €</td>
                    <td><a href="?page=cart&minus=1"><img style="width:15px;margin-top:-3px;margin-right:2px;" src="src/public/img/minus-circle-solid.svg" alt=""></a>
                        <?= $this->cart[$i]['nombre_tickets'] ?>
                        <a href="?page=cart&plus=1"><img style="width:15px;margin-top:-3px;margin-left:2px;" src="src/public/img/plus-circle-solid.svg" alt=""></a>
                    </td>

                    <td><?= $this->cart[$i]['concerts_price'] * $_SESSION['cart'][$i]['nbr_tickets'] ?> €</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <form method="POST" action="?page=ordered" class="text-center">
        <button type="submit" name="ordered" class="btn btn-info m-auto btn-lg">Passer votre commande</button>                    
    </form>


</div>




<?php
include('src/view/footer.php');
?>