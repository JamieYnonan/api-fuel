<?php
namespace Fuel\Infrastructure\Token;

use Fuel\Application\Service\AbstractResponseException;

/**
 * Class InvalidTokenException
 * @package Fuel\Domain\Model\User
 */
class InvalidTokenException extends AbstractResponseException
{
    /**
     * InvalidTokenException constructor.
     */
    public function __construct()
    {
        parent::__construct('El token es invalido.', 410);
    }
}