<?php
namespace Fuel\Domain\Model\User;

use Fuel\Application\Service\Response\AbstractResponseException;

/**
 * Class UserUpdateWithPreviousValuesException
 * @package Fuel\Domain\Model\User
 */
class UserUpdateWithPreviousValuesException extends AbstractResponseException
{
    /**
     * UserUpdateWithPreviousValuesException constructor.
     */
    public function __construct()
    {
        parent::__construct(
            sprintf('Los datos a actualizar son los mismo que los actuales.'),
            120
        );
    }
}