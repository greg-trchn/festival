<?php
include('src/view/header.php');
?>

<div itemscope itemtype="https://schema.org/MusicEvent" class="container">

    <table class="table">
        <thead>
            <tr>
                <th scope="col">
                    <span style="float:left;margin-right:1em;width:20px;display:flex;flex-direction:column;">
                        <a href='?page=home&sort=artistes_name&tri=asc'><img style="margin-top:-15px;" src="src/public/img/sort-up-solid.svg" alt=""></a>
                        <a href='?page=home&sort=artistes_name&tri=desc'><img style="margin-top:-15px;" src="src/public/img/sort-down-solid.svg" alt=""></a>
                    </span>Artisites
                </th>
                <th scope="col">
                    <span style="float:left;margin-right:1em;width:20px;display:flex;flex-direction:column;">
                        <a href='?page=home&sort=scenes_name&tri=asc'><img style="margin-top:-15px;" src="src/public/img/sort-up-solid.svg" alt=""></a>
                        <a href='?page=home&sort=scenes_name&tri=desc'><img style="margin-top:-15px;" src="src/public/img/sort-down-solid.svg" alt=""></a>
                    </span>Scènes
                </th>
                <th scope="col">
                    <span style="float:left;margin-right:1em;width:20px;display:flex;flex-direction:column;">
                        <a href='?page=home&sort=concerts_date&tri=asc'><img style="margin-top:-15px;" src="src/public/img/sort-up-solid.svg" alt=""></a>
                        <a href='?page=home&sort=concerts_date&tri=desc'><img style="margin-top:-15px;" src="src/public/img/sort-down-solid.svg" alt=""></a>
                    </span>Dates
                </th>
                <th scope="col">
                    <span style="float:left;margin-right:1em;width:20px;display:flex;flex-direction:column;">
                        <a href='?page=home&sort=concerts_price&tri=asc'><img style="margin-top:-15px;" src="src/public/img/sort-up-solid.svg" alt=""></a>
                        <a href='?page=home&sort=concerts_price&tri=desc'><img style="margin-top:-15px;" src="src/public/img/sort-down-solid.svg" alt=""></a>
                    </span>Prix
                </th>
                <th class="text-center" scope="col">Réservation<br /><br /></th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 0; $i < count($this->concerts); $i++) { ?>
                <tr>
                    <th scope="row"><?= $this->concerts[$i]['artistes_id'] ?># <b itemprop="performer"><?= $this->concerts[$i]['artistes_name'] ?></b></th>
                    <td><b itemprop="location"><?= $this->concerts[$i]['scenes_name'] ?></b><br />
                        <span class="badge badge-primary badge-pill">50 / <?= $this->concerts[$i]['concerts_stock'] ?> place(s) disponible(s)</span></td>
                    <td><?= $this->concerts[$i]['concerts_id'] ?># <span itemprop="startDate"><?= $this->concerts[$i]['concerts_date'] ?></span></td>
                    <td itemscope itemtype="https://schema.org/PriceSpecification"><span itemprop="price"><?= $this->concerts[$i]['concerts_price'] ?></span> €</td>
                    <td class='text-center'>
                        <form method="post" action="">
                            <input type="number" name="nbrTickets" min="1" max="99" maxlength="2" size="2">
                            <input type="hidden" name="concerts_id" value="<?= $this->concerts[$i]['concerts_id'] ?>">
                            <button type="submit" class="btn btn-info m-auto btn-sm">Réserver</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</div>




<?php
include('src/view/footer.php');
?>