<?php
class Model {

    static $connections     = array();
    public $conf            = 'default';
    public $table           = false;
    public $db;

    public function __construct() {
        // connection a la bdd
        $conf = Conf::$databases[$this->conf];
        if(isset(Model::$connections[$this->conf])) {
            $this->db = $pdo;
            return true;
        }
        try {
            $pdo = new PDO('mysql:host='.$conf['host'].';dbname='.$conf['database'].';',
                $conf['login'],
                $conf['password'],
                array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
                );
            Model::$connections[$this->conf] = $pdo;
            $this->db = $pdo;
        }catch(PDOException $e) {
            if(Conf::$debug) {
                die($e->getMessage());
            }else {
                die('impossible de ce connecter a la base de donnee');
            }
        }

        // je cree des variables
        if($this->table === false) {
            $this->table = strtolower(get_class($this)) . 's';
        }
    }

    public function find() {
        $sql = 'SELECT * FROM '.$this->table.' as '.get_class($this).' ';
        if(isset($req['conditions'])) {
            $sql .= 'WHERE '.$req['conditions'];
        }
        $pre = $this->db->prepare($sql);
        $pre->execute();
        return $pre->fetchAll(PDO::FETCH_OBJ);
    }
}