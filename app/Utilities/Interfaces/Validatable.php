<?php
/**
 * Created by PhpStorm.
 * User: nikas
 * Date: 22/04/2018
 * Time: 12:19
 */

namespace App\Utilities\Interfaces;

interface Validatable
{
  /**
   * Check validity of passed item.
   * @param mixed $item
   * @return bool
   */
  public function validate($item): bool;
}