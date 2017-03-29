<?php

class Router {

    /**
     * FONCTION : extrait des parametre de l'url
     * @param $url URL a parser
     * @param $request array tableau contenant les parametres
     * @return true
     */
    static function parse($url, $request) {
        $url = trim($url, '/');
        $params = explode('/', $url);
        $request->controller = isset($params[0]) ? $params[0] : 'pages';
        $request->action = isset($params[1]) ? $params[1] : 'index';
        $request->params = array_slice($params, 2);
        return true;
    }
}