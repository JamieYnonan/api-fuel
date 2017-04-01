<?php
namespace Fuel\Application\Service\Response;

/**
 * Class AbstractResponseException
 * @package Fuel\Application\Service\Response
 */
class AbstractResponseException extends \InvalidArgumentException
{
    /**
     * @return array
     */
    public function __invoke()
    {
        return ['message' => $this->getMessage(), 'code' => $this->getCode()];
    }
}