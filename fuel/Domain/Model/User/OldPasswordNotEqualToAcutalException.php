<?php
namespace Fuel\Domain\Model\User;

use Fuel\Application\Service\AbstractResponseException;

/**
 * Class UserAlreadyExistsException
 * @package Fuel\Domain\Model\User
 */
class OldPasswordNotEqualToAcutalException extends AbstractResponseException
{
    /**
     * OldPasswordNotEqualToAcutalException constructor.
     */
    public function __construct()
    {
        parent::__construct(
            'La contraseña ingresada no coincide con la actual.',
            340
        );
    }
}