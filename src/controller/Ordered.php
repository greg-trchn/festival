<?php

class Ordered
{


    public function __construct()
    {

        $this->title = 'Votre commande';
        $this->button = 'Valider';
        $this->model = new Model();
    }

    public function manage()
    {

        if (!isset($_SESSION['user_id'])) {
            header('Location:'.ROOT_HTTP . 'connexion');
        }

        
        include('src/view/view_ordered.php');
    }
}
