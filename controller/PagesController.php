<?php

/**
 * Class PagesController : Permet de stocker les variables afficher sur une pages
 */
class PagesController extends Controller {

    public function index() {
    }
    
    public function construct() {
        
    }
    
    public function view() {
        $this->loadModel('Categorie');
        $this->Categorie->find(array(
            'conditions' => 'id=1'
        ));
    }
}