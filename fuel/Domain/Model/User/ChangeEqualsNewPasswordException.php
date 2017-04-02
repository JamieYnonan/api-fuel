<?php
namespace Fuel\Domain\Model\User;

use Fuel\Application\Service\Response\AbstractResponseException;

/**
 * Class ChangeEqualsNewPasswordException
 * @package Fuel\Domain\Model\User
 */
class ChangeEqualsNewPasswordException extends AbstractResponseException
{
    /**
     * ChangeEqualsNewPasswordException constructor.
     */
    public function __construct()
    {
        parent::__construct(
            'No se puede actualizar la contraseña con una igual a la actual.',
            130
        );
    }
}