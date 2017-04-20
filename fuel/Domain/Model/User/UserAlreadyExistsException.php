<?php
namespace Fuel\Domain\Model\User;

use Fuel\Application\Service\AbstractResponseException;

/**
 * Class UserAlreadyExistsException
 * @package Fuel\Domain\Model\User
 */
class UserAlreadyExistsException extends AbstractResponseException
{
    /**
     * UserAlreadyExistsException constructor.
     * @param string $email
     */
    public function __construct(string $email)
    {
        parent::__construct(
            sprintf('El correo %s ya se encuentra registrado.', $email),
            310
        );
    }
}