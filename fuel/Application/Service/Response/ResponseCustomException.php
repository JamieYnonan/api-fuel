<?php
namespace Fuel\Application\Service\Response;

use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class ResponseCustomException
 * @package Fuel\Application\Service\Response
 */
class ResponseCustomException
{
    /**
     * @param \Exception $exception
     * @return JsonResponse
     */
    public static function response(\Exception $exception)
    {
        return new JsonResponse(
            [
                'message' => $exception->getMessage(),
                'code' => $exception->getCode()
            ],
            400
        );
    }
}