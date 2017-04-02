<?php
namespace Fuel\Application\Service\User;

use Fuel\Domain\Model\User\{
    UserRepositoryInterface,
    UserUpdateWithPreviousValuesException
};

/**
 * Class UpdateUserService
 * @package Fuel\Application\Service\User
 */
class UpdateUserService
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * UpdateUserService constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param UpdateUserRequest $request
     * @throws UserUpdateWithPreviousValuesException
     * @return array
     */
    public function execute(UpdateUserRequest $request): array
    {
        $user = $this->userRepository->byId($request->id());

        if ($user->name() === $request->name() && $user->lastName() === $user->lastName()) {
            throw new UserUpdateWithPreviousValuesException();
        }

        $user->setName($request->name());
        $user->setLastName($request->lastName());

        $this->userRepository->update($user);

        return ['message' => 'Los datos fueron actualizados.'];
    }
}