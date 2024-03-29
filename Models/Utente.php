<?php

require_once 'QueryDB.php';

/**
 * TESTED 100%
 */
class Utente
{
    private $id;
    private $nome;
    private $password;
    private $saldo;
    private $avatar;
    private $db;

    public function __construct($nome, $password)
    {
        $this->db = QueryDB::getDB();
        $this->nome = $nome;
        $this->password = $password;
        $this->saldo = 10000;
        $this->avatar = 'https://e7.pngegg.com/pngimages/246/554
        /png-clipart-computer-icons-user-avatar-avatar-heroes-black-thumbnail.png';
    }
    public function getAll()
    {
        $stmt = $this->db->query('SELECT * FROM `utente`');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createUtente()
    {
        print_r($this);
        $stmt = $this->db->prepare("INSERT INTO `utente` (`nome`,`password`,`saldo`,`avatar`) VALUES (?, ?, ?, ?)");
        $parms = [$this->nome, $this->password, $this->saldo, $this->avatar];
        $stmt->execute($parms);
        $this->id = $this->db->lastInsertId();
        return $this;
    }

    public function getUtenteByName($name)
    {
        $stmt = $this->db->prepare('SELECT * FROM `utente` WHERE `nome` = ?');
        $parms = [$name];
        $stmt->execute($parms);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
        if (empty($res)) {
            return $res;
        }
        $this->id = $res['id'];
        $this->nome = $res['nome'];
        $this->password = $res['password'];
        $this->saldo = $res['saldo'];
        $this->avatar = $res['avatar'];
        return $this;
    }

    public function getUtenteById($id)
    {
        $stmt = $this->db->prepare('SELECT * FROM `utente` WHERE `id` = ?');
        $parms = [$id];
        $stmt->execute($parms);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
        $this->id = $res['id'];
        $this->nome = $res['nome'];
        $this->password = $res['password'];
        $this->saldo = $res['saldo'];
        $this->avatar = $res['avatar'];
        return $this;
    }

    public function updateSaldo($saldo, $id)
    {
        $stmt = $this->db->prepare('SELECT `saldo` FROM `utente` WHERE `id` = ?');
        $parms = [$id];
        $stmt->execute($parms);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
        $stmt = $this->db->prepare("UPDATE `utente` SET `saldo`= ? WHERE `id` = ?");
        $parms = [$res['saldo'] + $saldo, $id];
        $stmt->execute($parms);
    }

    public function getId() {
        return $this->id;
    } 
    public function getNome()
    {
        return $this->nome;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function getSaldo()
    {
        return $this->saldo;
    }


    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }
    public function setNome($nome)
    {
        $this->nome = $nome;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function getAvatar()
    {
        return $this->avatar;
    }

    //RETURNS JSON
    public function toJSON()
    {
        return json_encode(
            array(
                "User_ID" => $this->id,
                "Username" => $this->getNome(),
                "Password" => $this->getPassword(),
                "Avatar" => $this->getAvatar(),
                "Saldo" => $this->getSaldo()
            )
        );
    }
}