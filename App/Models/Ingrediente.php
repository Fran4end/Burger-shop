<?php

namespace App\Models;

use PDO;

/**
 * Example user model
 *
 * PHP version 7.0
 */
class Ingrediente extends \Core\Model
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
        $this->db = static::getDB();
    }
    public static function getAll()
    {
        $db = static::getDB();
        $stmt = $db->query('SELECT * FROM ingrediente');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getIngredienteById($id)
    {
        $stmt = $this->db->prepare('SELECT * FROM `ingrediente` WHERE `id` = ?');
        $parms = [$id];
        $stmt->execute($parms);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->id = $res['id'];
        $this->nome = $res['nome']; 
        $this->prezzo = $res['prezzo']; 
        $this->immagine = $res['immagine']; 
        return $this;
    }
}