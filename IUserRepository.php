<?php
interface IUserRepository
{
    public function getByMemberId($memberId);    
    public function getById($userId);
    public function getAll(FilterArray $filter = null);
}