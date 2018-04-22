<?php
/**
 * Created by PhpStorm.
 * User: nikas
 * Date: 22/04/2018
 * Time: 11:51
 */

require_once realpath(__DIR__ . "/../bootstrap/bootstrap.php");

use App\Models\Registration;
use App\Utilities\Validation\RegistrationValidator as Validator;
use League\Csv\Reader;

$registrations = [];
$filePath = realpath(__DIR__ . "/../import/data.csv");
$validator = new Validator();

try {
  $records = Reader::createFromPath($filePath, 'r')->setDelimiter(';')->jsonSerialize();

  foreach ($records as $record) {
    $registration = new Registration(...$record);

    if (!$validator->validate($registration)) {
      dump($registration);
      dump("Invalid import format.");
      $entityManager->rollback();
      exit(0);
    }

    $dbRecord = $entityManager->getRepository(Registration::class)
      ->findOneBy(['email' => $registration->getEmail()]);

    if ($dbRecord) {
      $dbRecord->setFirstName($registration->getFirstName());
      $dbRecord->setLastName($registration->getLastName());
      $dbRecord->setFirstPhoneNumber($registration->getFirstPhoneNumber());
      $dbRecord->setSecondPhoneNumber($registration->getSecondPhoneNumber());
      $dbRecord->setComment($registration->getComment());
    } else {
      $entityManager->persist($registration);
    }

    array_push($registrations, $dbRecord ? $dbRecord : $registration);
  }

  $entityManager->flush();
  dump("Import finished.");

} catch (\Exception $e) {
}