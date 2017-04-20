<?php
namespace Fuel\Application\Service;

use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class ResponseGeneralException
 * @package Fuel\Application\Service
 */
class ResponseGeneralException
{
    /**
     * @return JsonResponse
     */
    public static function response()
    {
        return new JsonResponse(
            [
                'message' => 'Ocurrio un problema',
                'code' => 400
            ],
            400
        );
    }
}