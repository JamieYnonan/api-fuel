<?php
namespace Fuel\Application\Service\Response;

use Symfony\Component\HttpFoundation\JsonResponse;

class ResponseCustomException
{
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