<?php

/**
 * Created by PhpStorm.
 * User: nikas
 * Date: 22/04/2018
 * Time: 17:55
 */

use App\Models\Registration;
use App\Utilities\Validation\RegistrationValidator as Validator;
use Faker\Factory;
use PHPUnit\Framework\TestCase;

class RegistrationValidatorTest extends TestCase
{
  /**
   * Class reflection to call private and protected methods.
   * @param $obj
   * @param $name
   * @param array $args
   * @return mixed
   * @throws ReflectionException
   */
  public static function callMethod($obj, $name, array $args)
  {
    $class = new \ReflectionClass($obj);
    $method = $class->getMethod($name);
    $method->setAccessible(true);
    return $method->invokeArgs($obj, $args);
  }

  /**
   * Data provider for test cases.
   * @return array
   */
  public function successData()
  {
    $dummyPhone = "+37061111111";
    $faker = Factory::create();
    $fakeData = [];
    for ($i = 0; $i < 10; $i++) array_push($fakeData, [
      $faker->firstName,
      $faker->lastName,
      $faker->email,
      $dummyPhone,
      $dummyPhone,
      $faker->sentence(10)
    ]);
    return $fakeData;
  }

  /**
   * @dataProvider successData
   */
  public function testCheckValidity(
    string $firstName,
    string $lastName,
    string $email,
    string $firstPhoneNumber,
    string $secondPhoneNumber,
    string $comment
  )
  {
    $registration = new Registration(
      $firstName,
      $lastName,
      $email,
      $firstPhoneNumber,
      $secondPhoneNumber,
      $comment
    );
    $validator = new Validator();
    $this->assertTrue($validator->validate($registration));
  }

  /**
   * Data provider for test cases.
   * @return array
   */
  public function failData()
  {
    $dummyPhone = "+37061111111";
    $faker = Factory::create();
    $fakeData = [];
    for ($i = 0; $i < 10; $i++) array_push($fakeData, [
      $faker->password(1000, 1000),
      $faker->password(1000, 1000),
      $faker->email,
      $dummyPhone,
      $dummyPhone,
      $faker->sentence(10)
    ]);
    return $fakeData;
  }

  /**
   * @dataProvider failData
   */
  public function testCheckValidityFail(
    string $firstName,
    string $lastName,
    string $email,
    string $firstPhoneNumber,
    string $secondPhoneNumber,
    string $comment
  )
  {
    $registration = new Registration(
      $firstName,
      $lastName,
      $email,
      $firstPhoneNumber,
      $secondPhoneNumber,
      $comment
    );
    $validator = new Validator();
    $this->assertFalse($validator->validate($registration));
  }
}