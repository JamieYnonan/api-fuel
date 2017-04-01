<?php
namespace Fuel\Application\Service\User;

use function Assert\thatNullOr;
use Fuel\Domain\Model\User\UserRepositoryInterface;
use Fuel\Domain\Model\User\UserUpdateWithPreviousValues;

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
     * @return \Fuel\Domain\Model\User\User
     * @throws UserUpdateWithPreviousValues
     */
    public function execute(UpdateUserRequest $request)
    {
        $user = $this->userRepository->byId($request->id());

        if ($user->name() === $request->name() && $user->lastName() === $user->lastName()) {
            throw new UserUpdateWithPreviousValues();
        }

        $user->setName($request->name());
        $user->setLastName($request->lastName());

        $this->userRepository->update($user);

        return $user;
    }
}