<?php
class Database 
{
	private static $dbName = 'test' ;
	private static $dbHost = 'localhost' ;
	private static $dbUsername = 'root';
	private static $dbUserPassword = '';
	
	private static $cont  = null;
	
	public function __construct(){
		die('DB Error!');
	}
	
	public static function connect(){
	   // one instance
       if ( null == self::$cont ){      
        try {
          self::$cont =  new PDO(
				"mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, 
				self::$dbUsername, 
				self::$dbUserPassword,
				array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
			);  
        }
        catch(PDOException $e) {
          die($e->getMessage());
        }
       } 
       return self::$cont;
	}
	
	public static function disconnect(){
		self::$cont = null;
	}
}
?>