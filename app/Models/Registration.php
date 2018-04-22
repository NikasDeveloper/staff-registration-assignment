<?php
/**
 * Created by PhpStorm.
 * User: nikas
 * Date: 22/04/2018
 * Time: 11:26
 */

namespace App\Models;

/**
 * @Entity @Table(name="registrations")
 **/
class Registration
{
  /**
   * @Id @Column(type="integer") @GeneratedValue
   * @var int
   */
  private $id = null;

  /**
   * @Column(type="string")
   * @var string
   */
  private $firstName = null;

  /**
   * @Column(type="string")
   * @var string
   */
  private $lastName = null;

  /**
   * @Column(type="string", unique=true)
   * @var string
   */
  private $email = null;

  /**
   * @Column(type="string")
   * @var string
   */
  private $firstPhoneNumber = null;

  /**
   * @Column(type="string", nullable=true)
   * @var string
   */
  private $secondPhoneNumber = null;

  /**
   * @Column(type="string", length=1024, nullable=true)
   * @var string
   */
  private $comment = null;


  /**
   * Registration constructor.
   * @param string $firstName
   * @param string $lastName
   * @param string $email
   * @param string $firstPhoneNumber
   * @param string|null $secondPhoneNumber
   * @param string|null $comment
   */
  public function __construct(
    string $firstName,
    string $lastName,
    string $email,
    string $firstPhoneNumber,
    string $secondPhoneNumber = null,
    string $comment = null
  ) {
    $this->setFirstName($firstName);
    $this->setLastName($lastName);
    $this->setEmail($email);
    $this->setFirstPhoneNumber($firstPhoneNumber);
    $this->setSecondPhoneNumber($secondPhoneNumber);
    $this->setComment($comment);
  }

  /**
   * @return int
   */
  public function getId(): int
  {
    return $this->id;
  }

  /**
   * @param int $id
   */
  public function setId(int $id): void
  {
    $this->id = $id;
  }

  /**
   * @return string
   */
  public function getFirstName(): string
  {
    return ucwords($this->firstName);
  }

  /**
   * @param string $firstName
   */
  public function setFirstName($firstName)
  {
    $this->firstName = trim(strtolower($firstName));
  }

  /**
   * @return string
   */
  public function getLastName(): string
  {
    return ucwords($this->lastName);
  }

  /**
   * @param string $lastName
   */
  public function setLastName(string $lastName)
  {
    $this->lastName = trim(strtolower($lastName));
  }

  /**
   * @return string
   */
  public function getEmail(): string
  {
    return $this->email;
  }

  /**
   * @param string $email
   */
  public function setEmail(string $email)
  {
    $this->email = trim(strtolower($email));
  }

  /**
   * @return string
   */
  public function getFirstPhoneNumber(): string
  {
    return $this->firstPhoneNumber;
  }

  /**
   * @param string $firstPhoneNumber
   */
  public function setFirstPhoneNumber(string $firstPhoneNumber)
  {
    $this->firstPhoneNumber = trim($firstPhoneNumber);
  }

  /**
   * @return string
   */
  public function getSecondPhoneNumber(): string
  {
    return $this->secondPhoneNumber;
  }

  /**
   * @param string|null $secondPhoneNumber
   */
  public function setSecondPhoneNumber(string $secondPhoneNumber)
  {
    $this->secondPhoneNumber = trim($secondPhoneNumber);
  }

  /**
   * @return string
   */
  public function getComment(): string
  {
    return $this->comment;
  }

  /**
   * @param string|null $comment
   */
  public function setComment($comment): void
  {
    $comment = trim($comment);
    $this->comment = strlen($comment) > 1024 ? substr($comment, 0, 1021) . "..." : $comment;
  }
}