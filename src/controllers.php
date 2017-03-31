<?php

use Symfony\Component\HttpFoundation\Request;
use Fuel\Application\Service\User\SingUpUserRequest;
use Fuel\Application\Service\Response\ResponseCustomException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Fuel\Application\Service\Response\ResponseGeneralException;

$app->post('users', function (Request $request) use ($app) {
    try {
        $user = $app['sign_up_user_application_service']->execute(
            new SingUpUserRequest(
                $request->get('email'),
                $request->get('name'),
                $request->get('last_name'),
                $request->get('password')
            )
        );

        return new JsonResponse($app['serializer']->serialize($user, 'json'));
    } catch (\Fuel\Domain\Model\User\UserAlreadyExistsException $e) {
        return ResponseCustomException::response($e);
    } catch (\Assert\InvalidArgumentException $e) {
        return ResponseCustomException::response($e);
    } catch (\Exception $e) {
        return ResponseGeneralException::response();
    }
});

$app->error(function (\Exception $e, Request $request, $code) use ($app) {
    return ResponseGeneralException::response($code);
});
