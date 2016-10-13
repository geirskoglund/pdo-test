<?php
require_once "PdoHelper.php";
require_once "BaseEntity.php";
require_once "IUser.php";
require_once "User.php";
require_once "BaseRepository.php";
require_once "UserRepository.php";
require_once "IFilter.php";
require_once "Filter.php";
require_once "FilterArray.php";

$settings = parse_ini_file("app-settings.ini");
$pdo = PdoHelper::CreatePdoInstance($settings);

$id = 2837;

$userRepo = new UserRepository($pdo);
$users = $userRepo->getByMemberId($id);

var_dump($users);

$allUsers = $userRepo->getAll();
var_dump($allUsers);