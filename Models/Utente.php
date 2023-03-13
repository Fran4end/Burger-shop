<?php
use PDO;

/**
 * Example user model
 *
 * PHP version 7.0
 */
class Utente
{
    private $id;
    private $nome;
    private $password;
    private $salt;
    private $avatar;
    private $db;

    public function __construct($nome, $password){
        $this->db = QueryDB::getDB();
        $this->nome = $nome;
        $this->password = $password;
        $this->salt = 1;
        $this->avatar = 'https://e7.pngegg.com/pngimages/246/554
        /png-clipart-computer-icons-user-avatar-avatar-heroes-black-thumbnail.png';


    }
    public function getAll()
    {
        $stmt = $this->db->query('SELECT * FROM `utente`');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createUtente() {
        print_r($this);
        $stmt = $this->db->prepare("INSERT INTO `utente` ('nome','password','salt','avatar') VALUES (?, ?, ?, ?)");
        $parms = [$this->nome, $this->password, $this->salt, $this->avatar];
        $stmt->execute($parms);
        $this->id = $this->db->lastInsertId();
        return $this;
    }

    public function getUtenteById($id)
    {
        $stmt = $this->db->prepare('SELECT * FROM `utente` WHERE `id` = ?');
        $parms = [$id];
        $stmt->execute($parms);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo $res;
        $this->id = $res['id'];
        $this->nome = $res['nome']; 
        $this->password = $res['password']; 
        $this->salt = $res['salt'];
        $this->avatar = $res['avatar']; 
        return $this;
    }

    public function getNome() {
        return $this->nome;
    }
    public function getPassword() {
        return $this->password;
    }
    public function setAvatar($avatar) {
        $this->avatar = $avatar;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }
    public function setPassword($password) {
        $this->password = $password;
    }
}