<?php
abstract class BaseRepository
{
    protected $pdo;
    protected $entityName;
    protected $baseSelect;
    
    public function __construct($pdo){
        $this->entityName = $this->entityName();
        $this->baseSelect = $this->baseSelect();
        $this->pdo = $pdo;
    }
    
    protected function getSql($whereClause = "")
    {
        return $this->baseSelect . "\n" . $whereClause;
    }
    
    protected function createPdoHelper($sql)
    {
        return new PdoHelper($this->pdo, $sql);
    }
    
    protected abstract function entityName();
    protected abstract function baseSelect();
}