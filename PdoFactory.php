<?php

class PdoFactory extends Singleton
{
    private $pdo;
    
    protected function __construct()
    {
        $settings = parse_ini_file("app-settings.ini");
        
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
        $this->pdo = new PDO($dsn, $user, $password, $opt);
    }
    
    public function getMysqlPdo()
    {
        return $this->pdo;
    }

}