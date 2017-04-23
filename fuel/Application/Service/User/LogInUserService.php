<?php
namespace Fuel\Application\Service\User;

use Fuel\Domain\Model\User\{InvalidLogInException, UserRepositoryInterface};

class LogInUserService
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    private $jwtToken;

    /**
     * LogInUserService constructor.
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
     * @param LogInUserRequest $request
     * @return array
     */
    public function execute(LogInUserRequest $request): array
    {
        $user = $this->userRepository->byEmail($request->email());
        if ($user === null) {
            throw new InvalidLogInException();
        }

        if ($user->equalPassword($request->password()) === false) {
            throw new InvalidLogInException();
        }

        return [
            'message' => 'El usuario inicio sesión correctamente.',
            'code' => 0,
            'data' => [
                'id' => $user->id(),
                'token' => $this->jwtToken->encode(['id' => $user->id()])
            ]
        ];
    }
}