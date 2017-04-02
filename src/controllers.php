<?php

use Symfony\Component\HttpFoundation\{Request, JsonResponse};
use Fuel\Application\Service\Response\{
    ResponseCustomException,
    ResponseGeneralException
};
use Fuel\Application\Service\User\{
    SingUpUserRequest,
    UpdateUserRequest,
    ChangePasswordUserRequest
};


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
        $data = $app['validation_token']->validate(
            $request->headers->get('token')
        );

        $response = $app['update_user_application_service']->execute(
            new UpdateUserRequest(
                $data->id,
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
        $data = $app['validation_token']->validate(
            $request->headers->get('token')
        );

        $response = $app['change_password_user_application_service']->execute(
            new ChangePasswordUserRequest(
                $data->id,
                $request->get('old_password'),
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