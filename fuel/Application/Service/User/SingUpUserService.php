<?php
namespace Fuel\Application\Service\User;

use Fuel\Domain\Model\User\{
    User,
    UserAlreadyExistsException,
    UserRepositoryInterface
};

class SingUpUserService
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    private $jwtToken;

    /**
     * SingUpUserService constructor.
     * @param UserRepositoryInterface $userRepository
     * @param $jwtToken
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        $jwtToken
    ) {
        $this->userRepository = $userRepository;
        $this->jwtToken = $jwtToken;
    }

    /**
     * @param SingUpUserRequest $request
     * @return array
     */
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

        return [
            'message' => 'El usuario se registró correctamente.',
            'code' => 0,
            'data' => [
                'id' => $user->id(),
                'token' => $this->jwtToken->encode(['id' => $user->id()])
            ]
        ];
    }
}