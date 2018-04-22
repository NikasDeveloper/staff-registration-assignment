<?php
/**
 * Created by PhpStorm.
 * User: nikas
 * Date: 22/04/2018
 * Time: 11:53
 */

use App\Models\Registration;
use App\Utilities\Validation\RegistrationValidator as Validator;
use Faker\Factory as Faker;

require_once realpath(__DIR__ . "/../bootstrap/bootstrap.php");

$faker = Faker::create();
$dummyPhone = "+37061111111";
$validator = new Validator();
$registration = new Registration(
  $faker->firstName,
  $faker->lastName,
  $faker->email,
  $dummyPhone,
  $dummyPhone,
  $faker->sentence(10)
);

if ($validator->validate($registration)) {
  try {
    $entityManager->persist($registration);
    $entityManager->flush();
    dump($registration);
  } catch (Exception $e) {
    dump("Failed to create entity.");
  }
} else {
  dump([$registration, "Fix data."]);
}


