<?php 
class MySql{
		private static $pdo;
		public static function conectar(){

			if (self::$pdo == null){
					// code...
				
				try{
					self::$pdo = new PDO('mysql:host=localhost;dbname=mixsalgados','root','',array(PDO ::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
					self::$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
					}catch(Exception $e){
						echo '<h2>Erro ao se conectar com o banco de dados!</h2>';
						echo$e;

				}
			}return self::$pdo;
		}
	}
 ?>