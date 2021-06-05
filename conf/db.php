<?php
/**

класс конфигурации базы данных (статическй класс)
**/

class DB {
	const USER="root";
	const PASSWORD ="root";
	const HOST = "localhost";
	const DATABASE = "leither_app";

	//один метод соединения с БД
	public static function connToDB() {
		$user = self::USER;
		$password=self::PASSWORD;  //обращение к коснтантам через селф
		$host = self::HOST;
		$db = self::DATABASE;

		$conn = new PDO("mysql:host=$host;dbname=$db; charset=UTF8", $user, $password); 
		return $conn;
	}
}