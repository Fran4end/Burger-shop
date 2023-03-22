<?php
include 'QueryDB.php';

/**
 * TESTED 100%
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
    private $categoria;
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
        $res = $res[0];
        $this->id = $res['id'];
        $this->nome = $res['nome']; 
        $this->prezzo = $res['prezzo']; 
        $this->immagine = $res['immagine'];
        $this->categoria = $res['categoria'];
        return $res;
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

    public function getCategoria()
    {
        return $this->categoria;
    }

    public function setCategoria($cat)
    {
        $this->categoria = $cat;
    }

    public function setImmagine($newImmagine)
    {
        $this->immagine = $newImmagine;
    }

    //RETURNS JSON
    public function toJSON(){
        return json_encode(
                        array("Ingredient_ID" => $this->getId(), 
                            "Ingredient_Name" => $this->getNome(), 
                            "Image" => $this->getImmagine(), 
                            "Price" => $this->getPrezzo(),
                            "Category" => $this->getCategoria())
                        );
    }
<<<<<<< HEAD
}

$ingre = new Ingrediente();
$ingre ->__construct();
echo $ingre ->TabletoJSON();
?>
=======
}
>>>>>>> 3af3dbca12b1558e3c007df7064331670861f0bd
