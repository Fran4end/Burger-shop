<?php

namespace App\Models;

use PDO;

/**
 * Example user model
 *
 * PHP version 7.0
 */
class Utente extends \Core\Model
{

    /**
     * Get all the users as an associative array
     *
     * @return array
     */
    public static function getAll()
    {
        $db = static::getDB();
        $stmt = $db->query('SELECT * FROM utente');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /*public static function checkPassword($name, $password, $mail){
        $db = static::getDB();
        $stmt = $db->query('SELECT COUNT(id) FROM utente WHERE password=$password AND nome=$name');
        $exist = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        return ($exist==1);
    }*/
}