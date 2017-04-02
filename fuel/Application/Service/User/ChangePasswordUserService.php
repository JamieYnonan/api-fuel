<?php
namespace Fuel\Application\Service\User;

use Assert\Assertion;
use Fuel\Domain\Model\User\{
    OldPasswordNotEqualToAcutalException,
    UserRepositoryInterface
};

/**
 * Class ChangePasswordUserService
 * @package Fuel\Application\Service\User
 */
class ChangePasswordUserService
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * ChangePasswordUserService constructor.
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(ChangePasswordUserRequest $request): array
    {
        $user = $this->userRepository->byId($request->id());

        if (!$user->equalPassword($request->oldPassword())) {
            throw new OldPasswordNotEqualToAcutalException();
        }

        Assertion::same(
            $request->newPassword(),
            $request->repeatNewPassword(),
            'No coinciden new password con repeat password'
        );

        $user->changePassword($request->newPassword());

        $this->userRepository->update($user);

        return ['La contraseña se cambio correctamente!'];
    }
}