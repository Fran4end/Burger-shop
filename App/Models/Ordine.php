<?php

namespace App\Models;

use PDO;

/**
 * All methods working
 */
class Ordine extends \Core\Model
{   

    private $id;
    private $consegnato;
    private $pagato;
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
    public function getAll() {
        $stmt = $this->db->query('SELECT * FROM ordine');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createOrder($id_utente) {
        $stmt = $this->db->prepare("INSERT INTO `ordine`
        (`id_utente`, `pagato`, `consegnato`, `prezzo`) VALUES (?,?,?,?)", 
        [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $parms = [$id_utente, false, false, $this->prezzo];
        $stmt->execute($parms);
        return $this;
    }

    public function deleteOrder($id){
        $stmt = $this->db->prepare("DELETE FROM `ordine` WHERE `id` = ?");
        $parms = [$id];
        return $stmt->execute($parms);
    }

    public function getId() {
        return $this->id;
    }
    public function getConsegnato() {
        return $this->consegnato;
    }
    public function getPagato() {
        return $this->pagato;
    }
    public function getPrezzo() {
        return $this->prezzo;
    }

    public function setConsegnato($id) {
        $stmt = $this->db->prepare("UPDATE `ordine` SET `consegnato`= ? WHERE `id` = ?");
        $parms = [true, $id];
        $stmt->execute($parms);
    }
    public function setPagato($id) {
        $stmt = $this->db->prepare("UPDATE `ordine` SET `pagato`=? WHERE `id` = ?");
        $parms = [true, $id];
        $stmt->execute($parms);
    }
    public function setPrezzo($prezzo) {
        $this->prezzo = $prezzo;
    }
}