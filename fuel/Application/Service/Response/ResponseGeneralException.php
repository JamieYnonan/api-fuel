<?php
namespace Fuel\Application\Service\Response;

use Symfony\Component\HttpFoundation\JsonResponse;

class ResponseGeneralException
{
    public static function response(int $code = 400)
    {
        return new JsonResponse(
            [
                'message' => 'Ocurrio un problema',
                'code' => $code
            ],
            400
        );
    }
}