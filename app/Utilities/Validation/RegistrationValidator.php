<?php
/**
 * Created by PhpStorm.
 * User: nikas
 * Date: 22/04/2018
 * Time: 12:23
 */

namespace App\Utilities\Validation;

use Respect\Validation\Validator as v;

class RegistrationValidator extends Validator
{
  /**
   * RegistrationValidator constructor.
   */
  public function __construct()
  {
    parent::__construct();
    $this->validator = v::attribute('firstName', $this->rules['name'])
      ->attribute('lastName', $this->rules['name'])
      ->attribute('email', $this->rules['email'])
      ->attribute('firstPhoneNumber', $this->rules['phone'])
      ->attribute('secondPhoneNumber', v::optional($this->rules['phone']))
      ->attribute('comment', v::optional($this->rules['text']));
  }

  /**
   * @param \App\Models\Registration $item
   * @return bool
   */
  public function validate($item): bool
  {
    return $this->validator->validate($item);
  }
}