<?php
/**
 * Created by PhpStorm.
 * User: nikas
 * Date: 22/04/2018
 * Time: 11:51
 */

use Respect\Validation\Validator as v;

require_once realpath(__DIR__ . "/../bootstrap/bootstrap.php");

$id = $argv[1] ?? null;

if (!$id or !v::notEmpty()->intVal()->between(1, null)->validate($id)) {
  dump($id ? 'Id must be integer' : "No id passed");
  exit(0);
}

try {
  $registration = $entityManager->find('App\Models\Registration', $argv[1]);
  dump($registration);
} catch (\Exception $e) {
  dump("Something went wrong.");
}