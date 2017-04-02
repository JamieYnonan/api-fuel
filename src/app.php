<?php

use Silex\Application;
use Silex\Provider\{
    AssetServiceProvider,
    ServiceControllerServiceProvider,
    HttpFragmentServiceProvider,
    DoctrineServiceProvider,
    MonologServiceProvider
};
use Symfony\Component\Yaml\Yaml;
use Fuel\Infrastructure\Persistence\Doctrine\EntityManagerFactory;
use Fuel\Application\Service\User\{
    SingUpUserService,
    UpdateUserService,
    ChangePasswordUserService
};
use Fuel\Domain\Model\User\ValidationToken;

$app = new Application();
$app->register(new ServiceControllerServiceProvider());
$app->register(new AssetServiceProvider());
$app->register(new HttpFragmentServiceProvider());

$dirConfig = __DIR__ .'/../config/';
$monologConfig = Yaml::parse(file_get_contents($dirConfig . 'monolog.yml'));

$app->register(
    new DoctrineServiceProvider(),
    Yaml::parse(file_get_contents($dirConfig . 'database.yml'))
);

$app->register(new MonologServiceProvider(), array(
    'monolog.logfile' => $monologConfig['monolog']['logfile'],
));

$app['config'] = function () use ($dirConfig) {
    return Yaml::parse(file_get_contents($dirConfig . 'config.yml'));
};

$app['em'] = function ($app) {
    return (new EntityManagerFactory)->build($app['db']);
};

$app['user_repository'] = function ($app) {
    return $app['em']->getRepository('Fuel\Domain\Model\User\User');
};

$app['sign_up_user_application_service'] = function ($app) {
    return new SingUpUserService(
        $app['user_repository'],
        $app['config']['config']['tokenKey']
    );
};

$app['update_user_application_service'] = function ($app) {
    return new UpdateUserService($app['user_repository']);
};

$app['change_password_user_application_service'] = function ($app) {
    return new ChangePasswordUserService($app['user_repository']);
};

$app['validation_token'] = function ($app) {
    return new ValidationToken(
        $app['config']['config']['tokenKey'],
        $app['user_repository']
    );
};

return $app;
