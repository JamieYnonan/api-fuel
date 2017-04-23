<?php
namespace Fuel\Application\Service;

/**
 * Class AbstractResponseException
 * @package Fuel\Application\Service
 */
class AbstractResponseException extends \InvalidArgumentException
{
    /**
     * @return array
     */
    public function __invoke()
    {
        return [
            'message' => $this->getMessage(),
            'code' => $this->getCode(),
            'data' => []
        ];
    }
}