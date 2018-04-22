<?php
/**
 * Created by PhpStorm.
 * User: nikas
 * Date: 22/04/2018
 * Time: 16:18
 */

namespace App\Utilities\Interfaces;

interface Importable
{
  /**
   * Import data from file to DB.
   * @return bool
   * @throws \Exception
   */
  public function import(): bool;
}