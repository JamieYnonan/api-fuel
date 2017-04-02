<?php

use Symfony\Component\HttpFoundation\{Request, JsonResponse};
use Fuel\Application\Service\Response\{
    ResponseCustomException,
    ResponseGeneralException
};
use Fuel\Application\Service\User\{
    SingUpUserRequest,
    UpdateUserRequest,
    ChangePasswordUserRequest,
    LogInUserRequest,
    UserRequest
};


$app->post('/users', function (Request $request) use ($app) {
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
        $app['monolog']->error($e->getMessage());
        return ResponseCustomException::response($e);
    } catch (\Exception $e) {
        $app['monolog']->error($e->getMessage());
        return ResponseGeneralException::response();
    }
});

$app->put('/users/{id}', function (Request $request, int $id) use ($app) {
    try {
        $data = $app['validation_token']->validate(
            $request->headers->get('token')
        );

        $response = $app['update_user_application_service']->execute(
            new UpdateUserRequest(
                $id,
                $request->get('name'),
                $request->get('last_name')
            )
        );

        return new JsonResponse($response);
    } catch (\InvalidArgumentException $e) {
        $app['monolog']->error($e->getMessage());
        return ResponseCustomException::response($e);
    } catch (\Exception $e) {
        $app['monolog']->error($e->getMessage());
        return ResponseGeneralException::response();
    }
});

$app->get('/users/{id}', function (Request $request, int $id) use ($app) {
    try {
        $data = $app['validation_token']->validate(
            $request->headers->get('token')
        );

        $response = $app['user_application_service']->execute(new UserRequest($id));

        return new JsonResponse($response);
    } catch (\InvalidArgumentException $e) {
        $app['monolog']->error($e->getMessage());
        return ResponseCustomException::response($e);
    } catch (\Exception $e) {
        $app['monolog']->error($e->getMessage());
        return ResponseGeneralException::response();
    }
});

$app->put('/users/password', function (Request $request) use ($app) {
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
        $app['monolog']->error($e->getMessage());
        return ResponseCustomException::response($e);
    } catch (\Exception $e) {
        $app['monolog']->error($e->getMessage());
        return ResponseGeneralException::response();
    }
});

$app->post('/login', function (Request $request) use ($app) {
    try {
        $response = $app['log_in_user_application_service']->execute(
            new LogInUserRequest(
                $request->get('email'),
                $request->get('password')
            )
        );

        return new JsonResponse($response);
    } catch (\InvalidArgumentException $e) {
        $app['monolog']->error($e->getMessage());
        return ResponseCustomException::response($e);
    } catch (\Exception $e) {
        $app['monolog']->error($e->getMessage());
        return ResponseGeneralException::response();
    }
});

$app->error(function (\Exception $e, Request $request, $code) use ($app) {
    $app['monolog']->critical($e->getMessage());
    return ResponseGeneralException::response($code);
});