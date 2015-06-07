<?php
require_once('database.php');

Class Effect{
    private $id;
    private $name;
    private $type;

    protected static $_table = 'effects';
    const IMAGE_PATH = 'images/';

    public function __construct($params){
        $this->id         = $params['id'];
        $this->name         = $params['name'];
        $this->type         = $params['type'];
    }

    /**
     * @return int
     */
    public function getId(){
        return $this->id;
    }

    /**
     * @return String
     */
    public function getName(){
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getType(){
        return $this->type;
    }

    /**
     * @param $id
     * @return bool|Effect
     */
    public static function getEffectById($id){
        if (!$id)
            return false;
        $pdo = Database::connect();
        $sql = "SELECT * FROM ".self::$_table." WHERE id=?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $row = $q->fetch();
        Database::disconnect();
        if (!$row)
            return false;
        $user = new self($row);
        $user->id = $row['id'];
        return $user;
    }

    public function getDbFields(){
        return array(
            'name'     => $this->name,
            'type'     => $this->type,
        );
    }

    /**
     * @return Effect[]
     */
    public static function findAll(){
        $pdo = Database::connect();
        $sql = "SELECT * FROM ".self::$_table;
        $q = $pdo->prepare($sql);
        $q->execute();
        $effects = array();
        while ($row = $q->fetch()){
            $effects[] = new Effect($row);
        }
        return $effects;
    }

    /**
     * Saves Effect object to DB
     */
    public function save(){
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if ($this->id){
            $sql = "UPDATE ".self::$_table."
					SET name=?, type=?
					WHERE id=".$this->id;
        } else {
            $sql = "INSERT INTO ".self::$_table." (name, type) VALUES(?, ?)";
        }
        $q = $pdo->prepare($sql);

        $q->execute(array($this->name, $this->type));
        $id = $pdo->lastInsertId();
        Database::disconnect();
    }

}