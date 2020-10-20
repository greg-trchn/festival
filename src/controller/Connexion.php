<?php

class Connexion
{


    public function __construct()
    {

        $this->title = 'Bienvenue, connectez-vous..';
        $this->button = 'Connexion';
        $this->model = new Model();
    }

    public function manage()
    {

        // connexion
        if (isset($_POST['users_email'])) {
            if (
                !empty($_POST['users_email'])
                && !empty($_POST['users_password'])
            ) {
                $this->profil = $this->model->getUserConnexion(
                    $_POST['users_email']
                );
                if (
                    $this->profil['users_email'] == false
                    || !password_verify(
                        $_POST['users_password'],
                        $this->profil['users_password']
                    )
                ) {
                    $this->alert = "Erreur de login ou mot de passe";
                    $this->style = 'alert alert-danger';
                } else {
                    // creation session
                    $this->alert = "Bravo vous êtes connecté";
                    $this->style = 'alert alert-success';
                    $_SESSION['user_id'] = $this->profil['users_id'];
                }
            } else {
                $this->alert = "Merci de remplir tous tous les champs SVP";
                $this->style = 'alert alert-danger';
            }
        }

        // si demande de deconnexion utilisateur
//        if ($_GET['page'] == 'deconnexion') {
        if(preg_match('#^' . BASE_URL . 'deconnexion' . '$#', $_SERVER['REDIRECT_URL'])) {
            $_SESSION['user_id'] = array();
            unset($_SESSION['user_id']);
            unset($_POST);
            unset($_GET);
            $this->alert = "Vous êtes déconnecté, connectez-vous à nouveau...";
            $this->style = 'alert alert-danger';
        }

        include('src/view/view_form.php');
    }
}
