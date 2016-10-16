<?php
class Singleton implements ISingleton
{
    protected static $instance = null;

    protected function __construct()
    {
        //Thou shalt not construct that which is unconstructable!
    }

    protected function __clone()
    {
        //Me not like clones! Me smash clones!
    }

    public static function Instance()
    {
        if (!isset(static::$instance)) {
            static::$instance = new static;
        }
        return static::$instance;
    }
}