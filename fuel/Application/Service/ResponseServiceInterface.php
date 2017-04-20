<?php
namespace Fuel\Application\Service;

/**
 * Interface ResponseServiceInterface
 * @package Fuel\Application\Service
 */
interface ResponseServiceInterface
{
    /**
     * @return array
     */
    public function __invoke(): array;
}