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
    private $token;
    private $db;

    public function __construct($nome, $password)
    {
        $this->db = QueryDB::getDB();
        $this->nome = $nome;
        $this->password = $password;
        $this->saldo = 10000;
        $this->token = uniqid($nome);
    }
    public function getAll()
    {
        $stmt = $this->db->query('SELECT * FROM `utente`');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createUtente()
    {
        $stmt = $this->db->prepare("INSERT INTO `utente` (`nome`,`password`,`saldo`,`token`) VALUES (?, ?, ?, ?)");
        $parms = [$this->nome, $this->password, $this->saldo, $this->token];
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
            throw new Exception("Error User Not Found", 1);
        }
        $this->id = $res['id'];
        $this->nome = $res['nome'];
        $this->password = $res['password'];
        $this->saldo = $res['saldo'];
        $this->token = $res['token'];
        return $this;
    }

    public function getUtenteByToken($token)
    {
        $stmt = $this->db->prepare('SELECT * FROM `utente` WHERE `token` = ?');
        $parms = [$token];
        $stmt->execute($parms);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
        if (empty($res)) {
            throw new Exception("Error User Not Found", 1);
        }
        $this->id = $res['id'];
        $this->nome = $res['nome'];
        $this->password = $res['password'];
        $this->saldo = $res['saldo'];
        $this->token = $res['token'];
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
        $this->token = $res['token'];
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


    public function setToken($token)
    {
        $this->token = $token;
    }
    public function setNome($nome)
    {
        $this->nome = $nome;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function getToken()
    {
        return $this->token;
    }

    //RETURNS JSON
    public function toJSON()
    {
        return json_encode(
            array(
                "User_ID" => $this->id,
                "Username" => $this->getNome(),
                "Password" => $this->getPassword(),
                "Token" => $this->getToken(),
                "Saldo" => $this->getSaldo()
            )
        );
    }
}