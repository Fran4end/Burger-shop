<?php
// use PDO;

/**
 * TESTED 100%
 */
class Panino
{

    private $id;
    private $nome;
    private $pronto;
    private $prezzo;
    private $ingredienti;
    private $db;

    public function __construct()
    {
        $this->db = QueryDB::getDB();
        $this->pronto = false;
        $this->prezzo = 0;
        $this->id = -1;
        $this->nome = 'panino';
    }

    /**
     * Get all the users as an associative array
     *
     * @return array
     */
    public function getAll()
    {
        $stmt = $this->db->query('SELECT * FROM `panino`');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Performs a query to the db and returns an array containing all the panini of a specific order. 
     *
     * @param int $id_order the id of the order
     * @return array an array containing all the Panini
     * @author ErosM04
     */
    public function getPaninoByOrder($id_ordine){
        $stmt = $this->db->prepare(
            "SELECT `panino`.`id`, `panino`.`nome`, `panino`.`pronto`, `panino`.`prezzo`
            FROM `panino`
            INNER JOIN `ordine` ON `panino`.`id_ordine` = `ordine`.`id`
            WHERE `ordine`.`id` = ?");
        $parms = [$id_ordine];
        
        $stmt->execute($parms);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createBurger($id_ordine)
    {
        if ($this->prezzo == 0) {
            throw new Exception("The burger is not initialized");
            return;
        }
        $stmt = $this->db->prepare("INSERT INTO `panino` (`id_ordine`,`nome`,`pronto`,`prezzo`) VALUES (?, ?, ?, ?)");
        $parms = [$id_ordine, $this->nome, false, $this->prezzo];
        $stmt->execute($parms);
        $this->id = $this->db->lastInsertId();
        return $this;
    }

    // This method requires the Panino id, so the Panino row in the db must exist,
    // therefor createBurger() must be called at least once before this method  
    public function addIngrediente($id_ingrediente, $id_ordine, $n = 1)
    {
        for ($i = 0; $i < $n; $i++) {
            $this->ingredienti[] = (new Ingrediente())->getIngredienteById($id_ingrediente);
        }

        $stmt = $this->db->prepare("INSERT INTO `preparazione` (`id_panino`,`id_ingrediente`, `quantità`, `id_ordine`) 
        VALUES (?, ?, ?, ?)");
        $parms = [$this->id, $id_ingrediente, $n, $id_ordine];
        return $stmt->execute($parms);
    }

    public function reset()
    {
        $this->ingredienti = [];
        $stmt = $this->db->prepare("DELETE FROM `preparazione` WHERE `id_panino`= ?");
        $parms = [$this->id];
        return $stmt->execute($parms);
    }

    public function delete()
    {
        $this->reset();
        $stmt = $this->db->prepare("DELETE FROM `panino` WHERE `id`= ?");
        $parms = [$this->id];
        return $stmt->execute($parms);
    }

    public function getPaninoById($id)
    {
        $stmt = $this->db->prepare('SELECT * FROM `panino` WHERE `id` = ?');
        $parms = [$id];
        $stmt->execute($parms);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo $res;
        $this->id = $res['id'];
        $this->nome = $res['nome'];
        $this->pronto = $res['pronto'];
        $this->prezzo = $res['prezzo'];
        $this->ingredienti = $res['ingredienti'];
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getNome()
    {
        return $this->nome;
    }

    public function getPrezzo()
    {
        return $this->prezzo;
    }

    public function getIngredienti()
    {
        return $this->ingredienti;
    }

    public function getPronto()
    {
        return $this->pronto;
    }

    public function setIngredienti($ingredienti = [])
    {
        $this->ingredienti = $ingredienti;
    }
    public function setPronto($id)
    {
        $stmt = $this->db->prepare("UPDATE `panino` SET `pronto`= ? WHERE `id` = ?");
        $parms = [true, $id];
        $stmt->execute($parms);
    }
    public function setNome($nome)
    {
        $this->nome = $nome;
    }
    public function setPrezzo($prezzo)
    {
        $this->prezzo = $prezzo;
    }

    //RETURNS JSON
    public function toJSON()
    {
        return json_encode(
            array(
                "Burger_ID" => $this->getId(),
                "Burger_Name" => $this->getNome(),
                "Burger_Price" => $this->getPrezzo(),
                "Ingredients" => $this->getIngredienti(),
                "Ready" => $this->getPronto()
            )
        );
    }
}