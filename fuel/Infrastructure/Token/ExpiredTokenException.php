<?php
namespace Fuel\Infrastructure\Token;

use Fuel\Application\Service\AbstractResponseException;

/**
 * Class InvalidTokenException
 * @package Fuel\Domain\Model\User
 */
class ExpiredTokenException extends AbstractResponseException
{
    /**
     * InvalidTokenException constructor.
     */
    public function __construct()
    {
        parent::__construct('El token ya ha expirado.', 420);
    }
}