<?php
namespace Fuel\Application\Service\User;

/**
 * Class UserRequest
 * @package Fuel\Application\Service\User
 */
class UserRequest
{
    /**
     * @var int
     */
    private $id;

    /**
     * UserRequest constructor.
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function id(): int
    {
        return $this->id;
    }
}