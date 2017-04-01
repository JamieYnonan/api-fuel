<?php
namespace Fuel\Domain\Model\User;

use Fuel\Application\Service\Response\AbstractResponseException;
use Throwable;

class UserChangeEqualsNewPassword extends AbstractResponseException
{
    public function __construct()
    {
        parent::__construct(
            'No se puede actualizar la contraseña con una igual a la actual.',
            130
        );
    }
}