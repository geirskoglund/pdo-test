<?php
/**
* A helper class for common pdo tasks.
*/
interface IPdoHelper
{
    public function addParams($params);
    public function resetParams();
    public function setSql($sql);
    public function updateDb();
    public function deleteFromDb();
    public function getSingleEntity($entityName);
    public function getEntities($entityName);
}