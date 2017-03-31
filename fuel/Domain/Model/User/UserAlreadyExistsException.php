<?php
namespace Fuel\Domain\Model\User;
use Throwable;

/**
 * Class UserAlreadyExistsException
 * @package Fuel\Domain\Model\User
 */
class UserAlreadyExistsException extends \Exception
{
    public function __construct(string $email)
    {
        parent::__construct(
            sprintf('El correo %s ya se encuentra registrado.', $email),
            110
        );
    }

    public function __invoke()
    {
        return ['message' => $this->getMessage(), 'code' => $this->getCode()];
    }
}