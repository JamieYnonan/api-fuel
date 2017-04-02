<?php
namespace Fuel\Domain\Model\User;

use Fuel\Application\Service\Response\AbstractResponseException;

/**
 * Class InvalidLogInException
 * @package Fuel\Domain\Model\User
 */
class InvalidLogInException extends AbstractResponseException
{
    /**
     * InvalidTokenException constructor.
     */
    public function __construct()
    {
        parent::__construct(
            'El email o password no son correctos.',
            160
        );
    }
}