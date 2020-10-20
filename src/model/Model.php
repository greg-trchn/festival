<?php

class Model
{

    private $bdd;

    public function __construct()
    {
//        $host = "localhost";
//        $user = "root";
//        $pswd = "mysql";
//        $dbName = "festival";

        try {
            $config = json_decode(
                file_get_contents(__DIR__ . '/../../config/' . ENV . '/db.json')
            );

            $this->bdd = new PDO(
//                'mysql:host=' . $host . ';dbname=' . $dbName . ';charset=utf8',
//                $user,
//                $pswd,
                $config->dsn,
                $config->user,
                $config->password,
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
            );
        } catch (Exception $e) {

            var_dump('ERROR BDD: ' . $e->getMessage());
        }
    }

    public function getUserConnexion($email)
    {
        try {
            $request = $this->bdd->prepare('SELECT * FROM users
            WHERE users_email = ?');

            $request->execute(array($email));
            return $request->fetch();
        } catch (Exception $e) {

            var_dump('ERROR TABLE : ' . $e->getMessage());
            return false;
        }
    }

    public function setAddUser(
        $users_firstname,
        $users_lastname,
        $users_password,
        $users_email
    ) {
        try {

            $request = $this->bdd->prepare('INSERT INTO users 
            (
            users_firstname,
            users_lastname,
            users_password,
            users_email
            ) 
            VALUE (?,?,?,?)');

            return $request->execute(array(
                $users_firstname,
                $users_lastname,
                $users_password,
                $users_email
            ));
        } catch (Exception $e) {

            var_dump('ERROR TABLE : ' . $e->getMessage());
            return false;
        }
    }

    public function getTicketsByUser($users_id)
    {
        try {
            $request = $this->bdd->prepare('SELECT tickets_nbr, concerts_price, concerts_date, scenes_name, artistes_name FROM `tickets`
            left join users on tickets.id_users = users.users_id
            left join concerts on concerts.concerts_id = tickets.id_concerts
            left join scenes on scenes.scenes_id = concerts.id_scenes
            left join artistes on artistes.artistes_id = concerts.id_artistes
            WHERE id_users = ?');

            $request->execute(array($users_id));

            return $request->fetchAll();
        } catch (Exception $e) {

            var_dump('ERROR TABLE : ' . $e->getMessage());
            return false;
        }
    }

    public function getConcertById($concert_id, $category="concerts_id")
    {
        try {
            $touslesID = '';
            if(count($concert_id) > 0 ) {
                $i = 0;
                $touslesID .= ' WHERE ';
                foreach($concert_id as $value){
                    if($i != 0){
                        $touslesID .= ' OR ';
                    }
                    $touslesID = $touslesID . $category . " = ? ";
                    $i++;
                }
            }
            
            $request = $this->bdd->prepare('SELECT * FROM concerts 
            LEFT JOIN artistes 
            on artistes.artistes_id = concerts.id_artistes 
            LEFT JOIN scenes 
            on scenes.scenes_id = concerts.id_scenes' .$touslesID);

            $request->execute($concert_id);

            return $request->fetchAll();
        } catch (Exception $e) {

            var_dump('ERROR TABLE : ' . $e->getMessage());
            return false;
        }
    }

    public function getConcerts($sort, $tri)
    {
        try {
            $request = $this->bdd->prepare('SELECT * FROM concerts 
            LEFT JOIN artistes 
            on artistes.artistes_id = concerts.id_artistes 
            LEFT JOIN scenes 
            on scenes.scenes_id = concerts.id_scenes ORDER by ' . $sort . ' ' . $tri);

            $request->execute(array());

            return $request->fetchAll();
        } catch (Exception $e) {

            var_dump('ERROR TABLE : ' . $e->getMessage());
            return false;
        }
    }


    // public function getConcerts_artists()
    // {
    //     try {
    //         $request = $this->bdd->prepare('SELECT * FROM scenes
    //         LEFT JOIN concerts on concerts.id_scenes = scenes.scenes_id 
    //         LEFT JOIN artistes on artistes.artistes_id = concerts.id_artistes');

    //         $request->execute(array());

    //         return $request->fetchAll();
    //     } catch (Exception $e) {

    //         var_dump('ERROR TABLE : ' . $e->getMessage());
    //         return false;
    //     }
    // }

    // public function getScenes()
    // {
    //     try {
    //         $request = $this->bdd->prepare('SELECT * FROM scenes');

    //         $request->execute(array());

    //         return $request->fetchAll();
    //     } catch (Exception $e) {

    //         var_dump('ERROR TABLE : ' . $e->getMessage());
    //         return false;
    //     }
    // }

    // public function getArtists($scenes_id)
    // {
    //     try {
    //         $request = $this->bdd->prepare('SELECT * FROM artistes 
    //         LEFT JOIN concerts 
    //         ON concerts.id_artistes = artistes.artistes_id 
    //         LEFT JOIN scenes 
    //         ON concerts.id_scenes = scenes.scenes_id 
    //         WHERE id_scenes = ? ');

    //         $request->execute(array($scenes_id));

    //         return $request->fetch();
    //     } catch (Exception $e) {

    //         var_dump('ERROR TABLE : ' . $e->getMessage());
    //         return false;
    //     }
    // }

    // public function getUserProfil($user_id)
    // {
    //     try {
    //         $request = $this->bdd->prepare('SELECT * FROM users
    //         WHERE user_id = ?');

    //         $request->execute(array($user_id));

    //         return $request->fetch();
    //     } catch (Exception $e) {

    //         var_dump('ERROR TABLE : ' . $e->getMessage());
    //         return false;
    //     }
    // }

    
    // SELECT * FROM `tickets` LEFT JOIN users ON tickets.id_users = users.users_id LEFT JOIN concerts ON tickets.id_concerts = concerts.concerts_id 
    // SELECT * FROM `scenes` 
    // LEFT JOIN concerts on concerts.id_scenes = scenes.scenes_id
    // right JOIN artistes on artistes.artistes_id = concerts.id_artistes

    // SELECT * FROM `artistes` LEFT JOIN concerts ON concerts.id_artistes = artistes.artistes_id LEFT JOIN scenes ON concerts.id_scenes = scenes.scenes_id WHERE id_scenes = 1 
}
