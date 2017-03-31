<?php
namespace Fuel\Application\Service\User;

use Fuel\Domain\Model\User\User;
use Fuel\Domain\Model\User\UserAlreadyExistsException;
use Fuel\Domain\Model\User\UserRepositoryInterface;

class SingUpUserService
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute($request)
    {
        $user = $this->userRepository->byEmail($request->email());
        if ($user !== null) {
            throw new UserAlreadyExistsException($request->email());
        }

        $user = new User(
            $request->email(),
            $request->name(),
            $request->lastName(),
            $request->password()
        );

        $this->userRepository->add($user);

        return $user;
    }
}