<?php
/**
 * Created by PhpStorm.
 * User: nikas
 * Date: 22/04/2018
 * Time: 11:28
 */

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once realpath(__DIR__ . '/../vendor/autoload.php');

$isDevMode = true;
$config = Setup::createAnnotationMetadataConfiguration([realpath(__DIR__ . '/../app')], $isDevMode);
$conn = [
  'driver' => 'pdo_sqlite',
  'path' => realpath(__DIR__ . '/../database/database.sqlite'),
];
$entityManager = EntityManager::create($conn, $config);