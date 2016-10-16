<?php

interface IDiceConfig
{    
    public function getDbUser();
    public function getDbPassword();
    public function getDiceRulesetPath();
    public function getDbDsn();
}