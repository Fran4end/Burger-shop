<?php
use FFI\Exception;
use PDO;

/**
 * All methods working
 */
class Ordine
{   

    private $id;
    private $consegnato;
    private $pagato;
    private $prezzo;
    private $db;

    public function __construct(){
        $this->db = QueryDB::getDB();
        $this->pagato = false;
        $this->prezzo = 0;
        $this->id = -1;
        $this->consegnato = false;
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
        if ($this->prezzo == 0) {
            return throw new Exception("The order is not initialized");
        }
        $stmt = $this->db->prepare("INSERT INTO `ordine`
        (`id_utente`, `pagato`, `consegnato`, `prezzo`) VALUES (?,?,?,?)", 
        [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $parms = [$id_utente, false, false, $this->prezzo];
        $stmt->execute($parms);
        $this->id = $this->db->lastInsertId();
        return $this;
    }

    public function deleteOrder($id){
        $stmt = $this->db->prepare("DELETE FROM `ordine` WHERE `id` = ?");
        $parms = [$id];
        return $stmt->execute($parms);
    }

    public function getOrdineById($id)
    {
        $stmt = $this->db->prepare('SELECT * FROM `ordine` WHERE `id` = ?');
        $parms = [$id];
        $stmt->execute($parms);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo $res;
        $this->id = $res['id'];
        $this->consegnato = $res['consegnato']; 
        $this->pagato = $res['pagato']; 
        $this->prezzo = $res['prezzo']; 
        return $this;
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

    //RETURNS JSON
    public function toJson(){
        return json_encode(
                        array("Order_ID" => $this->getId, 
                          "Price" => $this->getPrezzo, 
                          "Payed" => $this->getPagato, 
                          "Delivered" => $this->getConsegnato)
                        );
    }
}