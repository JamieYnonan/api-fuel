<?php
namespace Fuel\Domain\Model\User;

use Fuel\Application\Service\Response\AbstractResponseException;

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
        parent::__construct(
            'El token es invalido.',
            150
        );
    }
}