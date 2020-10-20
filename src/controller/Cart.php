<?php

class Cart
{


    public function __construct()
    {

        $this->title = 'Votre panier';
        $this->button = 'Valider';
        $this->model = new Model();
    }

    public function manage()
    {

        $id =[];
        for ($i = 0; $i < count($_SESSION['cart']); $i++) {
            $id[] = $_SESSION['cart'][$i]['concert_id'];
            
        }

        $this->cart  = $this->model->getConcertById($id);

        for ($i = 0; $i < count($this->cart); $i++) {

            for($j=0;$j < count($_SESSION['cart']);$j++) {

                if($_SESSION['cart'][$j]['concert_id'] == $this->cart[$i]['concerts_id']) {

                    $this->cart[$i]['nombre_tickets'] = $_SESSION['cart'][$j]['nbr_tickets'];
                }
            }

        }

        
        // var_dump($_SESSION['cart']);
        // var_dump($this->cart);
        include('src/view/view_cart.php');

    }
}
