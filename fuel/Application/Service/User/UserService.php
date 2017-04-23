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
class UserService
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
     * @param UserRequest $request
     * @throws UserUpdateWithPreviousValuesException
     * @return array
     */
    public function execute(UserRequest $request): array
    {
        $user = $this->userRepository->byId($request->id());

        return [
            'message' => 'Datos del usuario.',
            'code' => 0,
            'data' => [
                'id' => $user->id(),
                'email' => $user->email(),
                'name' => $user->name(),
                'last_name' => $user->lastName(),
                'updated_at' => $user->updatedAt(),
                'created_at' => $user->createdAt()
            ]
        ];
    }
}