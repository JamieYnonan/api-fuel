<?php
namespace Fuel\Application\Service\User;

/**
 * Class UpdatePasswordUserRequest
 * @package Fuel\Application\Service\User
 */
class ChangePasswordUserRequest
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $newPassword;

    /**
     * @var string
     */
    private $repeatNewPassword;

    /**
     * UpdatePasswordUserRequest constructor.
     * @param int $id
     * @param string $password
     * @param string $newPassword
     * @param string $repeatNewPassword
     */
    public function __construct(int $id,
        string $password,
        string $newPassword,
        string $repeatNewPassword
    ) {
        $this->id = $id;
        $this->password = $password;
        $this->newPassword = $newPassword;
        $this->repeatNewPassword = $repeatNewPassword;
    }

    /**
     * @return int
     */
    public function id(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function password(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function newPassword(): string
    {
        return $this->newPassword;
    }

    /**
     * @return string
     */
    public function repeatNewPassword(): string
    {
        return $this->repeatNewPassword;
    }
}