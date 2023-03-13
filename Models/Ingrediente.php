<?php
include 'QueryDB.php';
/**
 * Example user model
 *
 * PHP version 7.0
 */
class Ingrediente
{

    /**
     * Get all the users as an associative array
     *
     * @return array
     */
    private $id;
    private $prezzo;
    private $immagine;
    private $nome;
    private $db;

    public function __construct(){
        $this->db = QueryDB::getDB();
    }
    public static function getAll()
    {
        $db = QueryDB::getDB();
        $stmt = $db->query('SELECT * FROM ingrediente');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getIngredienteById($id)
    {
        $stmt = $this->db->prepare('SELECT * FROM `ingrediente` WHERE `id` = ?');
        $parms = [$id];
        $stmt->execute($parms);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo $res;
        $this->id = $res['id'];
        $this->nome = $res['nome']; 
        $this->prezzo = $res['prezzo']; 
        $this->immagine = $res['immagine']; 
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($newId)
    {
        $this->id = $newId;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($newNome)
    {
        $this->nome = $newNome;
    }
    
    public function getPrezzo()
    {
        return $this->prezzo;
    }

    public function setPrezzo($newPrezzo)
    {
        $this->prezzo = $newPrezzo;
    }

    public function getImmagine()
    {
        return $this->immagine;
    }

    public function setImmagine($newImmagine)
    {
        $this->immagine = $newImmagine;
    }
}