<?php
/**
* A helper class for common pdo tasks.
*/
class PdoHelper
{
    private $pdo;
    private $sql;
    private $params = array();
    
    /**
    * @param PDO $pdo A PDO instance
    * @param $sql An sql prepared statement string, with placeholders (question marks) 
    */ 
    public function __construct(PDO $pdo, $sql)
	{
		$this->pdo = $pdo;
        $this->sql = $sql;
	}
    
    /**
    * Appends values to the parameter array
    * @param $params A parameter, or an array of parameters, for the prepared query. 
    */
    public function addParams($params)
	{
		foreach (func_get_args() as $param)
		{
			if(is_array($param))
				$this->params = array_merge($this->params,$param);
			else
				$this->params[] = $param;
		}
	}
    
    /**
    * Resets the parameter array
    */
    public function resetParams()
    {
        $params = array();
    }
    
    /**
    * Sets the sql string
    * @param $sql An sql prepared statement string, with placeholders (question marks)
    */
    public function setSql($sql)
    {
        $this->sql = $sql;
    }
    
    /**
    * Performs a raw query based on the sql and parameter values.
    * Assumes that the sql statement is an insert or update
    * @returns The last insert id
    */
    public function updateDb()
	{
        $this->pdo->prepare($this->sql)->execute($this->params);
		return $this->pdo->lastInsertId();
	}
    
    /**
    * Performs a raw query based on the sql and parameter values.
    * Assumes that the sql statement is a delete statement
    * @returns The number of affected rows
    */
    public function deleteFromDb()
    {
        $stmt = $this->pdo->prepare($this->sql);
        $stmt->execute($this->params);
        return $stmt->fetchColumn();
    }
    
    /**
    * Performs a raw query based on the sql and parameter values.
    * Assumes that the sql statement is a select statement
    * @param $entityName A string containing the name of the entity
    * @returns An instance of the given entity
    */
    public function getSingleEntity($entityName)
	{
        $stmt = $this->executeEntityStatement($entityName);
        return $stmt->fetch();
	}
    
    /**
    * Performs a raw query based on the sql and parameter values.
    * Assumes that the sql statement is a select statement
    * @param $entityName A string containing the name of the entity
    * @returns An array of instances of the given entity
    */
    public function getEntities($entityName)
	{
        $stmt = $this->executeEntityStatement($entityName);
        return $stmt->fetchAll();
	}
    
    private function executeEntityStatement($entityName)
    {
        $stmt = $this->pdo->prepare($this->sql);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $entityName); 
        $stmt->execute($this->params);
        return $stmt; 
    }    
    
    public static function CreatePdoInstance(Array $settings)
    {
        $host = $settings["host"];
        $db   = $settings["database"];
        $user = $settings["user"];
        $password =  $settings["password"];
        $charset = "utf8";

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        return new PDO($dsn, $user, $password, $opt);
    }
}