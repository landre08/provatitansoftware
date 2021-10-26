<?php  

class Conexao {

	public static $instancia;

	public static function get_instance() {
        
		if(!isset(self::$instancia)) {
			self::$instancia = new \PDO("mysql:host=localhost;dbname=bd_titansoftware;", "landre", "acad", array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
			self::$instancia->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		}

		return self::$instancia;

	}

}

?>