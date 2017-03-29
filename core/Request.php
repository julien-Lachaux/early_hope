<?php

/**
 * Class Request : permet de recuperer la requete de l'utilsateur (l'URL)
 */
class Request {

    public $url;

    /**
     * Request constructor.
     */
    public function __construct() {
        $this->url = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/pages/index';
    }
}