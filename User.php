<?php
class User extends BaseEntity implements IUser
{
    private $username;
    private $password;
    private $full_name;
    private $email;
    
    public function getUsername(){
        return $this->username;
    }
    public function getPassword(){
        return $this->password;
    }
    public function getFullName(){
        return $this->full_name;
    }
    public function getEmail(){
        return $this->email;
    }
    
}