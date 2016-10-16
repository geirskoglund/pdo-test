<?php

class DiceRules
{
    private $config;
    private $dice;
    
    public function __construct(IDiceConfig $config, \Dice\Dice $dice)
    {
        $this->config = $config;
        $this->dice = $dice;
    }
    
    public function loadXmlRules()
    {
        $xmlLoader = new \Dice\Loader\Xml;
        $xmlLoader->load($this->config->getDiceRulesetPath(), $this->dice);
    }
    
    public function loadDefaultRules()
    {
        $pdoRules = [
            "shared" => true,
            "constructParams" => [ 
                $this->config->getDbDsn(), 
                $this->config->getDbUser(), 
                $this->config->getDbPassword(),
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false
                ]
            ]
        ];

        $this->dice->addRule("PDO",$pdoRules);
        
        $genRules = [
            'substitutions' => [
                'IPdoHelper' => ['instance' => 'PdoHelper'],
                'IFilterArray' => ['instance' => 'FilterArray']
            ]
            
        ];
        $this->dice->addRule("*" , $genRules);
    }
}