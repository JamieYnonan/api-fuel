<?php
namespace Fuel\Application\Service\User;

use Assert\Assertion;
use Fuel\Domain\Model\User\User;
use Fuel\Domain\Model\User\UserRepositoryInterface;

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

    public function execute(ChangePasswordUserRequest $request): User
    {
        $user = $this->userRepository->byId($request->id());

        Assertion::same(
            $request->newPassword(),
            $request->repeatNewPassword(),
            'No coinciden new password con repeat password'
        );

        $user->changePassword($request->newPassword());

        return $user;
    }
}