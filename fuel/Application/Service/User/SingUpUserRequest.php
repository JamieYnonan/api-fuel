<?php
namespace Fuel\Application\Service\User;

/**
 * Class SingUpUserRequest
 * @package Fuel\Application\Service\User
 */
class SingUpUserRequest
{
    /**
     * SingUpUserRequest constructor.
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
        $this->email = $email;
        $this->name = $name;
        $this->lastName = $lastName;
        $this->password = $password;
    }

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $password;

    /**
     * @return string
     */
    public function email(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function lastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function password(): string
    {
        return $this->password;
    }
}