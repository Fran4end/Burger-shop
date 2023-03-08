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
        $this->nome = null;
        $this->password = null;
        $this->salt = 1;
        $this->avatar = 'https://e7.pngegg.com/pngimages/246/554/png-clipart-computer-icons-user-avatar-avatar-heroes-black-thumbnail.png';


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

    public function createUtente() {
        if(is_null($this->utente)||is_null($this->password)){
            return throw new Exception("The user is not inizializated");
        }
        $stmt = $this->db->prepare("INSERT INTO `utente` ('nome','password','salt','avatar') VALUES (?, ?, ?, ?)");
        $parms = [$this->nome, $this->password, $this->salt, $this->avatar];
        $stmt->execute($parms);
        $this->id = $this->db->lastInsertId();
        return $this;
    }

    public function setAvatar($id,$avatar) {
        $this->avatar = $nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }
    public function setPassword($password) {
        $this->password = $password;
    }
    public function getAvatar($id,$avatar) {
        return $this->avatar;
    }

    public function getNome($nome) {
        return $this->nome;
    }
    public function getPassword($password) {
        return $this->password;
    }





    /*public static function checkPassword($name, $password, $mail){
        $db = static::getDB();
        $stmt = $db->query('SELECT COUNT(id) FROM utente WHERE password=$password AND nome=$name');
        $exist = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        return ($exist==1);
    }*/


}