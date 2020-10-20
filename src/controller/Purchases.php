<?php

class Purchases
{


    public function __construct()
    {

        $this->title = "Ma liste d'achats";
        $this->button = 'Connexion';
        $this->model = new Model();
    }

    public function manage()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location:'.ROOT_HTTP . 'connexion');
        }

        $this->tickets = $this->model->getTicketsByUser($_SESSION['user_id']);

       
        



        include('src/view/view_purchases.php');
    }
}
