<?php
namespace Fuel\Application\Service\Response;

/**
 * Interface ResponseServiceInterface
 * @package Fuel\Application\Service\Response
 */
interface ResponseServiceInterface
{
    /**
     * @return array
     */
    public function __invoke(): array;
}