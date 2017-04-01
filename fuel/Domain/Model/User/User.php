<?php
namespace Fuel\Domain\Model\User;

use Assert\{Assertion, InvalidArgumentException};

/**
 * Class User
 * @package Fuelstation\Domain\Models\User
 */
class User
{
    const MIN_LENGTH_NAME_LN = 3;
    const MAX_LENGTH_NAME_LN = 45;
    const MIN_LENGTH_PASSWORD = 6;

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $lastName;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var \DateTime
     */
    protected $updatedAt;

    /**
     * User constructor.
     * @param string $email
     * @param string $name
     * @param string $lastName
     * @param string $password
     */
    public function __construct(
        string $email,
        string $name,
        string $lastName,
        string $password
    ) {
        $this->setEmail($email);
        $this->setName($name);
        $this->setLastName($lastName);
        $this->changePassword($password);
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    /**
     * @param string $email
     */
    protected function setEmail(string $email)
    {
        $email = trim($email);
        Assertion::email($email);
        $this->email = $email;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $this->assertNameOrLastName($name);
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName)
    {

        $this->lastName = $this->assertNameOrLastName($lastName);
    }

    /**
     * @param string $name
     * @return string
     * @throws InvalidArgumentException
     */
    private function assertNameOrLastName(string $name)
    {
        $name = trim($name);
        Assertion::betweenLength(
            $name,
            static::MIN_LENGTH_NAME_LN,
            static::MAX_LENGTH_NAME_LN
        );

        return $name;
    }

    /**
     * @param string $password
     * @throws UserChangeEqualsNewPassword
     * @throws InvalidArgumentException
     */
    public function changePassword(string $password)
    {
        $password = trim($password);
        Assertion::minLength($password, static::MIN_LENGTH_PASSWORD);
        if (password_verify($password, $this->password)) {
            throw new UserChangeEqualsNewPassword();
        }

        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * @return int
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function email()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function lastName()
    {
        return $this->lastName;
    }
}