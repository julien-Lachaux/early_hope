<?php

/**
 * Class Controller : class parent des controllers
 */
class Controller {

    public  $request;
    private $vars       = array();
    public  $layout     = 'default';
    private $rendered   = false;

    /**
     * Controller constructor.
     * @param $request
     */
    public function __construct($request) {
        $this->request = $request;
    }

    /**
     * @param $view
     * @return bool
     */
    public function render($view) {
        if($this->rendered) {
            return false;
        }
        extract($this->vars);
        if(strpos($view,'/') === 0) {
            $view = ROOT.DS.'view'.$view.'.php';
        }else {
            $view = ROOT . DS . 'view' . DS . $this->request->controller . DS . $view . '.php';
        }
        ob_start();
        require($view);
        $content = ob_get_clean();
        require ROOT . DS . 'view' . DS . 'layout' . DS . $this->layout . '.php';
        $this->rendered = true;
    }

    /**
     * @param $key
     * @param null $value
     */
    public function set($key, $value = null) {
        if (is_array($key)) {
            $this->vars += $key;
        }else {
            $this->vars[$key] = $value;
        }
    }

    public function loadModel($name) {
        $file = ROOT . DS . 'model' . DS . $name . '.php';
        require_once($file);
        if(isset($this->$name)) {
            $this->$name = new $name();
        }
    }
}