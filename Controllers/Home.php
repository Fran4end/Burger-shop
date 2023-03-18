<?php

namespace App\Controllers;

use App\Models\Utente;
use \Core\View;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Home extends \Core\Controller
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    {
        $utente = new Utente('Francesco', '1234');
        $utente->setAvatar('https://ps.w.org/user-avatar-reloaded/assets/icon-256x256.png?rev=2540745');
        $utente->createUtente();
        View::renderTemplate('Home/index.html');
    }
}
