<?php
/**
 * Created by PhpStorm.
 * User: nikas
 * Date: 22/04/2018
 * Time: 17:09
 */

namespace App\Utilities\Import\Registration;

use App\Models\Registration;
use App\Utilities\Interfaces\Importable;
use App\Utilities\Validation\RegistrationValidator as Validator;
use Doctrine\ORM\EntityManager;
use Exception;

class ImportStrategy implements Importable
{
  /**
   * @var array
   */
  private $records = [];

  /**
   * @var Validator
   */
  private $validator = [];

  /**
   * @var EntityManager
   */
  private $entityManager = null;

  /**
   * ImportStrategy constructor.
   * @param array $records
   * @param EntityManager $entityManager
   */
  public function __construct(array $records, EntityManager $entityManager)
  {
    $this->records = $records;
    $this->validator = new Validator();
    $this->entityManager = $entityManager;
  }

  /**
   * @return bool
   * @throws Exception
   */
  private function checkRecordsValidity(): bool
  {
    foreach ($this->records as $record) {
      if (!$this->validator->validate(new Registration(...$record))) {
        throw new Exception('Invalid import data - fix records.', 422);
      }
    }
    return true;
  }

  /**
   * @param Registration $registration
   * @return Registration|object
   */
  private function mergeWithDB(Registration $registration): Registration
  {
    $dbRecord = $this->entityManager->getRepository(Registration::class)
      ->findOneBy(['email' => $registration->getEmail()]);

    if ($dbRecord) {
      $dbRecord->setFirstName($registration->getFirstName());
      $dbRecord->setLastName($registration->getLastName());
      $dbRecord->setFirstPhoneNumber($registration->getFirstPhoneNumber());
      $dbRecord->setSecondPhoneNumber($registration->getSecondPhoneNumber());
      $dbRecord->setComment($registration->getComment());
      return $dbRecord;
    } else {
      return $registration;
    }
  }

  /**
   * Import data to database.
   * @return bool
   * @throws Exception
   */
  public function import(): bool
  {
    $this->checkRecordsValidity();
    foreach ($this->records as $record) {
      $registration = $this->mergeWithDB(new Registration(...$record));
      if (!$registration->getId()) {
        $this->entityManager->persist($registration);
      }
    }
    $this->entityManager->flush();
    return true;
  }
}