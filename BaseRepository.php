<?php
abstract class BaseRepository
{
    protected $pdo;
    protected $entityName;
    protected $baseSelect;
    protected $pdoHelper;
    
    public function __construct(PDO $pdo, IPdoHelper $pdoHelper){
        $this->entityName = $this->entityName();
        $this->baseSelect = $this->baseSelect();
        $this->pdo = $pdo;
        $this->pdoHelper = $pdoHelper;
    }
    
    protected function getSql($whereClause = "")
    {
        return $this->baseSelect . "\n" . $whereClause;
    }
    
    protected function createPdoHelper($sql)
    {
        //$helper = $this->dice->create("PdoHelper");
        $this->pdoHelper->setSql($sql);
        $this->pdoHelper->resetParams();
        return $this->pdoHelper; //new PdoHelper($this->pdo, $sql);
    }
    
    protected abstract function entityName();
    protected abstract function baseSelect();
}