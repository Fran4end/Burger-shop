<?php

namespace App\Models;

use PDO;

/**
 * Example user model
 *
 * PHP version 7.0
 */
class Panino extends \Core\Model
{

    private $id;
    private $nome;
    private $pronto;
    private $prezzo;
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
        $stmt = $this->db->query('SELECT * FROM panino');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createBurger($id_ordine, $nome) {
        $stmt = $this->db->prepare("INSERT INTO panino('id_ordine','nome','pronto','prezzo') VALUES (?, ?, ?, ?)");
        $parms = [$id_ordine, $nome, false, $this->prezzo];
        $stmt->execute($parms);
        return $this;
        //devono essere inseriti poi gli ingredienti tramite classe ???
    }
}