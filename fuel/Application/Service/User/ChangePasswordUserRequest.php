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
    private $oldPassword;

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
     * @param string $oldPassword
     * @param string $newPassword
     * @param string $repeatNewPassword
     */
    public function __construct(
        int $id,
        string $oldPassword,
        string $newPassword,
        string $repeatNewPassword
    ) {
        $this->id = $id;
        $this->oldPassword = $oldPassword;
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
    public function oldPassword(): string
    {
        return $this->oldPassword;
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