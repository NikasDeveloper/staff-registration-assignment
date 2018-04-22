<?php
/**
 * Created by PhpStorm.
 * User: nikas
 * Date: 22/04/2018
 * Time: 11:27
 */

require_once realpath(__DIR__ . "/bootstrap/bootstrap.php");

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);