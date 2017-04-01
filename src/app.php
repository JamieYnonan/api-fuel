<?php

use Silex\Application;
use Silex\Provider\AssetServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\HttpFragmentServiceProvider;
use Symfony\Component\Yaml\Yaml;
use Silex\Provider\DoctrineServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Fuel\Infrastructure\Persistence\Doctrine\EntityManagerFactory;
use Fuel\Application\Service\User\SingUpUserService;
use Fuel\Application\Service\User\UpdateUserService;
use Fuel\Application\Service\User\ChangePasswordUserService;

$app = new Application();
$app->register(new ServiceControllerServiceProvider());
$app->register(new AssetServiceProvider());
$app->register(new HttpFragmentServiceProvider());
$app->register(new SessionServiceProvider());

$dirConfig = __DIR__ .'/../config/';

$app->register(
    new DoctrineServiceProvider(),
    Yaml::parse(file_get_contents($dirConfig . 'database.yml'))
);

$app['em'] = function ($app) {
    return (new EntityManagerFactory)->build($app['db']);
};

$app['user_repository'] = function ($app) {
    return $app['em']->getRepository('Fuel\Domain\Model\User\User');
};

$app['sign_up_user_application_service'] = function ($app) {
    return new SingUpUserService($app['user_repository']);
};

$app['update_user_application_service'] = function ($app) {
    return new UpdateUserService($app['user_repository']);
};

$app['change_password_user_application_service'] = function ($app) {
    return new ChangePasswordUserService($app['user_repository']);
};

return $app;
