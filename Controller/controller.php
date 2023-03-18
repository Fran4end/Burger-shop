<?php

namespace Controller;

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Eros extends \Core\Controller
{

    /**
     * Show the index page
     *
     * @return void
     */
    public function indexAction()
    { //nei nomi non mettere "-" o scoppia
            var_dump($this);
            echo '<br>';
            echo $this->route_params['id'];

        //View::renderTemplate('eros/index.html', ['title' => $this->id, 'sm' => 'Titoletto']);
    }
}
