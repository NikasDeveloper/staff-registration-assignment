<?php
/**
 * Created by PhpStorm.
 * User: nikas
 * Date: 23/04/2018
 * Time: 00:13
 */

use App\Models\Registration;
use PHPUnit\Framework\TestCase;
use Faker\Factory;

class RegistrationTest extends TestCase
{
  public function inputData()
  {
    return [
      [
        new Registration(
          "first name",
          "last name",
          "name@name.name",
          "+37061111111",
          "+37061111111",
          "comment"
        )
      ]
    ];
  }

  /**
   * @dataProvider inputData
   */
  public function testGetFirstName(Registration $registration)
  {
    $this->assertTrue("First Name" === $registration->getFirstName());
  }

  /**
   * @dataProvider inputData
   */
  public function testSetFirstName(Registration $registration)
  {
    $registration->setFirstName(" First NamEEE   ");
    $this->assertTrue("First Nameee" === $registration->getFirstName());
  }

  /**
   * @dataProvider inputData
   */
  public function testGetLastName(Registration $registration)
  {
    $this->assertTrue("Last Name" === $registration->getLastName());
  }

  /**
   * @dataProvider inputData
   */
  public function testSetLastName(Registration $registration)
  {
    $registration->setLastName(" LAST NAMEE ");
    $this->assertTrue("Last Namee" === $registration->getLastName());
  }

  /**
   * @dataProvider inputData
   */
  public function testGetEmail(Registration $registration)
  {
    $this->assertTrue("name@name.name" === $registration->getEmail());
  }

  /**
   * @dataProvider inputData
   */
  public function testSetEmail(Registration $registration)
  {
    $email = " Test@test.test ";
    $registration->setEmail($email);
    $this->assertTrue($registration->getEmail() === "test@test.test");
  }

  /**
   * @dataProvider inputData
   */
  public function testGetComment(Registration $registration)
  {
    $this->assertTrue($registration->getComment() === "comment");
  }

  /**
   * @dataProvider inputData
   */
  public function testSetComment(Registration $registration)
  {
    $registration->setComment("...");
    $this->assertTrue($registration->getComment() === "...");
    $comment = Factory::create()->password(1030, 1030);
    $registration->setComment($comment);
    $this->assertFalse($registration->getComment() === $comment);
    $this->assertTrue($registration->getComment() === substr($comment, 0, 1021) . "...");
  }
}
