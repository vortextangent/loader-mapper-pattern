<?php

include ('autoload.php');
use application\Factory;
use User\UserId;

$factory = new Factory();

$mapper = $factory->createUserMapper();

$userId = UserId::fromString('bce1ee52-cd2e-4eb7-a453-87fce154f899');

$user = $mapper->user($userId);

var_dump($user);