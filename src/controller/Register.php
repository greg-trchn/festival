<?php


class Register
{

    public function __construct()
    {

        $this->title = 'Inscrivez-vous pour acheter un billet';
        $this->button = 'Inscription';
        $this->model = new Model();
    }

    public function manage()
    {

        // inscription
        if (isset($_POST['users_firstname'])) {
            if (
                !empty($_POST['users_firstname'])
                && !empty($_POST['users_lastname'])
                && !empty($_POST['users_password'])
                && !empty($_POST['users_email'])
            ) {
                $this->profil = $this->model->getUserConnexion(
                    $_POST['users_email']
                );

                $this->passwordHash = password_hash($_POST['users_password'], PASSWORD_DEFAULT);
                if ($this->profil['users_email'] == $_POST['users_email']) {
                    $this->alert = "Adresse email déjà utilisée";
                    $this->style = 'alert alert-danger';
                } else {
                    $this->profil = $this->model->setAddUser(
                        $_POST['users_firstname'],
                        $_POST['users_lastname'],
                        $this->passwordHash,
                        $_POST['users_email']

                    );
                    if ($this->profil == true) {
                        $this->alert = "Inscription réussi !";
                        $this->style = 'alert alert-success';
                    }
                }
            } else {
                $this->alert = "Merci de remplir tous les champs SVP";
                $this->style = 'alert alert-danger';
            }

            
        }

        include('src/view/view_form.php');
    }
}
