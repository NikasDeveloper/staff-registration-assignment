<?php
/**
 * Created by PhpStorm.
 * User: nikas
 * Date: 22/04/2018
 * Time: 11:51
 */

require_once realpath(__DIR__ . "/../bootstrap/bootstrap.php");

use App\Utilities\Import\CSVReader as Reader;
use App\Utilities\Import\Registration\ImportStrategy;

$filePath = realpath(__DIR__ . "/../import/data.csv");
$reader = new Reader($filePath);

try {
  $records = $reader->read()->getRecords();
  $strategy = new ImportStrategy($records, $entityManager);
  $strategy->import();
  dump("Import finished.");
} catch (\Exception $e) {
  dump($e->getMessage());
}