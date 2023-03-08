<?php

namespace App\Models;

use PDO;

/**
 * Example user model
 *
 * PHP version 7.0
 */
class Utente extends \Core\Model
{
    private $id;
    private $nome;
    private $password;
    private $salt;
    private $avatar;
    private $db;

    public function __construct(){
        $this->db = static::getDB();
    }
    /**
     * Get all the users as an associative array
     *
     * @return array
     */
    public function getAll()
    {
        $stmt = $this->db->query('SELECT * FROM `utente`');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createUtente($nome, $password) {
        $stmt = $this->db->prepare("INSERT INTO `panino` ('nome','password') VALUES (?, ?)");
        $parms = [$nome, $password];
        $stmt->execute($parms);
        $this->id = $this->lastInsertId();
        return $this;
    }

    public function setAvatar($id) {
        
    }





    /*public static function checkPassword($name, $password, $mail){
        $db = static::getDB();
        $stmt = $db->query('SELECT COUNT(id) FROM utente WHERE password=$password AND nome=$name');
        $exist = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        return ($exist==1);
    }*/


}