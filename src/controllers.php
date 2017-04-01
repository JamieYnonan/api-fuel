<?php

use Symfony\Component\HttpFoundation\Request;
use Fuel\Application\Service\User\SingUpUserRequest;
use Fuel\Application\Service\Response\ResponseCustomException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Fuel\Application\Service\Response\ResponseGeneralException;
use Fuel\Application\Service\User\UpdateUserRequest;
use Fuel\Application\Service\User\ChangePasswordUserRequest;

$app->post('users', function (Request $request) use ($app) {
    try {
        $response = $app['sign_up_user_application_service']->execute(
            new SingUpUserRequest(
                $request->get('email'),
                $request->get('name'),
                $request->get('last_name'),
                $request->get('password')
            )
        );

        return new JsonResponse($response);
    } catch (\InvalidArgumentException $e) {
        return ResponseCustomException::response($e);
    } catch (\Exception $e) {
        return ResponseGeneralException::response();
    }
});

$app->put('users', function (Request $request) use ($app) {
    try {

        $response = $app['update_user_application_service']->execute(
            new UpdateUserRequest(
                $request->get('id'),
                $request->get('name'),
                $request->get('last_name')
            )
        );

        return new JsonResponse($response);
    } catch (\InvalidArgumentException $e) {
        return ResponseCustomException::response($e);
    } catch (\Exception $e) {
        return ResponseGeneralException::response();
    }
});

$app->put('users/password', function (Request $request) use ($app) {
    try {
        $response = $app['change_password_user_application_service']->execute(
            new ChangePasswordUserRequest(
                $request->get('id'),
                $request->get('password'),
                $request->get('new_password'),
                $request->get('repeat_password')
            )
        );

        return new JsonResponse($response);
    } catch (\InvalidArgumentException $e) {
        return ResponseCustomException::response($e);
    } catch (\Exception $e) {
        return ResponseGeneralException::response();
    }
});

$app->error(function (\Exception $e, Request $request, $code) use ($app) {
    return ResponseGeneralException::response($code);
});
