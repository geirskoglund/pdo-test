<?php
require_once "IPdoHelper.php";
require_once "PdoHelper.php";
require_once "BaseEntity.php";
require_once "IUser.php";
require_once "User.php";
require_once "BaseRepository.php";
require_once "IUserRepository.php";
require_once "UserRepository.php";
require_once "IFilter.php";
require_once "Filter.php";
require_once "FilterArray.php";
require_once "ISingleton.php";
require_once "Singleton.php";
require_once "IPdoFactory.php";
require_once "PdoFactory.php";
require_once "IRepositoryFactory.php";
require_once "RepositoryFactory.php";
require_once "IDiceConfig.php";
require_once "AppConfig.php";
require_once "Dice/Dice.php";
require_once "Dice/Loader/Xml.php";
require_once "DiceRules.php";

//require_once ".php";
$dice = new \Dice\Dice();
$conf = new AppConfig("app-settings.ini");
$diceRules = new DiceRules($conf, $dice); 
$diceRules->loadXmlRules();
$diceRules->loadDefaultRules();

$pdo = $dice->create("PDO");
$userRepo = $dice->create("UserRepository");

$id = 2837;
$user = $userRepo->getByMemberId($id);
var_dump($user);

die;

$allUsers = $userRepo->getAll();
var_dump($allUsers);