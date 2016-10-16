<?php

class RepositoryFactory implements IRepositoryFactory
{
    private $pdo;
    
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    
    public function getIUserRepository()
    {
        return new UserRepository($this->pdo);
    }
}