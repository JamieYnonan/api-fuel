<?php
namespace Fuel\Application\Service\User;

use Fuel\Domain\Model\User\User;
use Fuel\Domain\Model\User\UserAlreadyExistsException;
use Fuel\Domain\Model\User\UserRepositoryInterface;

class SingUpUserService
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var string
     */
    private $tokenKey;

    public function __construct(
        UserRepositoryInterface $userRepository,
        string $tokenKey
    ) {
        $this->userRepository = $userRepository;
        $this->tokenKey = $tokenKey;
    }

    public function execute(SingUpUserRequest $request): array
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

        return (new SingUpResponse($user, $this->tokenKey))->__invoke();
    }
}