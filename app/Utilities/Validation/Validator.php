<?php
/**
 * Created by PhpStorm.
 * User: nikas
 * Date: 22/04/2018
 * Time: 12:48
 */

namespace App\Utilities\Validation;

use App\Utilities\Interfaces\Validatable;
use Respect\Validation\Validator as v;

class Validator implements Validatable
{
  /**
   * @var integer
   */
  protected $minStringLength = null;

  /**
   * @var integer
   */
  protected $maxStringLength = 255;

  /**
   * @var integer
   */
  protected $maxTextLength = 1024;

  /**
   * @var array
   */
  protected $rules = [];

  /**
   * @var v
   */
  protected $validator = null;

  /**
   * Validator constructor.
   * @param array $rules
   */
  public function __construct()
  {
    $this->rules = [
      'name' => v::stringType()->notBlank()->alpha()->length($this->minStringLength, $this->minStringLength),
      'email' => v::stringType()->notBlank()->email()->length($this->minStringLength, $this->maxStringLength),
      'phone' => v::stringType()->notBlank()->phone(),
      'text' => v::stringType()->length($this->minStringLength, $this->maxTextLength)
    ];
  }

  /**
   * Check validity of item.
   * @param mixed $item
   * @return bool
   */
  public function validate($item): bool
  {
    return v::notEmpty()->validate($item);
  }
}