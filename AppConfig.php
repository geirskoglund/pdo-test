<?php

class AppConfig implements IDiceConfig
{
    private $settings;
    
    public function __construct($iniFilePath)
    {
        $this->settings = parse_ini_file($iniFilePath);
    }
    
    public function getDbHost()
    {
        return $this->settings["host"];
    }
    public function getDbDatabse()
    {
        return $this->settings["database"];
    }
    public function getDbUser()
    {
        return $this->settings["user"];
    }
    public function getDbPassword()
    {
        return $this->settings["password"];
    }
    public function getDbCharset()
    {
        return $this->settings["char_set"];
    }
    public function getDiceRulesetPath()
    {
        return $this->settings["dice_rules_xml"];
    }
    public function getDbDsn()
    {
        return "mysql:host={$this->settings['host']};dbname={$this->settings['database']};charset={$this->settings['char_set']}";
    }
}