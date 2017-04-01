<?php
namespace Fuel\Application\Service\User;

/**
 * Class UpdateUserRequest
 * @package Fuel\Application\Service\User
 */
class UpdateUserRequest
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $lastName;

    /**
     * UpdateUserRequest constructor.
     * @param int $id
     * @param string $name
     * @param string $lastName
     */
    public function __construct(
        int $id,
        string $name,
        string $lastName
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->lastName = $lastName;
    }

    public function id(): int
    {
        return $this->id;
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
}