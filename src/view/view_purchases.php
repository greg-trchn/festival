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
            <?php for ($i = 0; $i < count($this->tickets); $i++) { ?>
                <tr>
                    <th scope="row"><b><?= $this->tickets[$i]['concerts_date'] ?></b></th>
                    <td><b><?= $this->tickets[$i]['artistes_name'] ?></b></td>
                    <td><?= $this->tickets[$i]['scenes_name'] ?></td>
                    <td><?= $this->tickets[$i]['concerts_price'] ?> €</td>
                    <td><?= $this->tickets[$i]['tickets_nbr'] ?></td>
                    <td><?= $this->tickets[$i]['tickets_nbr'] * $this->tickets[$i]['concerts_price'] ?> €</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</div>




<?php
include('src/view/footer.php');
?>