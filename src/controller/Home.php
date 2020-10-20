<?php

class Home
{


    public function __construct()
    {

        $this->title = 'Liste des concerts';
        $this->model = new Model();
    }

    public function manage()
    {

        // classement
        if (isset($_GET['sort']) && isset($_GET['tri'])) {
            $this->sort = $_GET['sort'];
            $this->tri = $_GET['tri'];
        } else {
            $this->sort = 'concerts_date';
            $this->tri = 'desc';
        }

        // req pour tous les concerts
        $this->concerts  = $this->model->getConcerts($this->sort, $this->tri);

        if (isset($_POST['nbrTickets'])) {

                if ($_SESSION['cart']) {

                    for ($i = 0; $i < count($_SESSION['cart']); $i++) {

                        if ($_SESSION['cart'][$i]['concert_id'] == $_POST['concerts_id']) {

                            $_SESSION['cart'][$i]['nbr_tickets'] += $_POST['nbrTickets'];
                            $nbr_tickets_egal = true;
                        }
                    }
                }

                if (!$nbr_tickets_egal) {
                    array_push(
                        $_SESSION['cart'],
                        array('nbr_tickets' => $_POST['nbrTickets'], 'concert_id' => $_POST['concerts_id'])
                    );

                    // $_SESSION['cart'][] =
                    //     array(
                    //         'nbr_tickets' => $_POST['nbrTickets'],
                    //         'concert_id' => $_POST['concerts_id']
                    //     );
                }
        }
        include('././src/view/view_list.php');
    }
}
