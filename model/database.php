<?php

class database {
      
    public function __construct() {
    
}

    public function connectDb() {
        try {
            return new PDO('mysql:host=192.168.1.129;dbname=tp_user;charset=utf8', 'usr_user', 'usr_user', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (Exception $e) {
            die('Erreur :' . $e->getMessage());
        }
    }    
}
