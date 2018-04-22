<?php
/**
 * Created by PhpStorm.
 * User: nikas
 * Date: 22/04/2018
 * Time: 16:32
 */

namespace App\Utilities\Import;

use App\Utilities\Interfaces\Readable;
use League\Csv\Reader;

class CSVReader implements Readable
{
  /**
   * @var string
   */
  private $path;

  /**
   * @var string
   */
  private $openMode = 'r';

  /**
   * @var string
   */
  private $delimiter = ';';

  /**
   * @var array
   */
  private $records = [];

  /**
   * CSVReader constructor.
   * @param string $path
   * @param string $openMode
   * @param string $delimiter
   */
  public function __construct(string $path, string $openMode = 'r', string $delimiter = ';')
  {
    $this->path = $path;
    $this->openMode = $openMode;
  }

  /**
   * Read import file.
   * @return $this
   * @throws \Exception
   */
  public function read()
  {
    $this->records = Reader::createFromPath($this->path, $this->openMode)
      ->setDelimiter($this->delimiter)
      ->jsonSerialize();
    return $this;
  }

  /**
   * @return array
   */
  public function getRecords(): array
  {
    return $this->records;
  }
}