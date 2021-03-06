<?php
/**
 * 继承pdo的，模型基类
 */
namespace Core\Lib\Drive\Database;

use Core\Lib\Conf;

class PdoModel extends \PDO{
    //初始化，继承pdo应该是就可以直接用手册中的pdo中的方法了
    public function __construct()
    {
		$database = Conf::all('database');	
		$dsn='mysql:host='.$database['msyql_default']['DSN'].';dbname='.$database['msyql_default']['DBNAME'];
		$username=$database['msyql_default']['USERNAME'];
		$password=$database['msyql_default']['PASSWORD'];
		try{
			parent::__construct($dsn,$username,$password);
		}catch(\PDOException $e){
			p($e->getMessage());
		}
    }
}