<?php
namespace Fuel\Application\Service\User;

use Fuel\Domain\Model\User\{InvalidLogInException, UserRepositoryInterface};
use Firebase\JWT\JWT;

class LogInUserService
{
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * @var string
     */
    private $tokenKey;

    /**
     * LogInUserService constructor.
     * @param UserRepositoryInterface $userRepository
     * @param string $tokenKey
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        string $tokenKey
    ) {
        $this->userRepository = $userRepository;
        $this->tokenKey = $tokenKey;
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

        $now = new \DateTime;

        return [
            'message' => 'El usuario inicio sesión correctamente.',
            'id' => $user->id(),
            'token' => JWT::encode(
                [
                    'iat' => $now->getTimestamp(),
                    'exp' => $now->modify('+1 moth')->getTimestamp(),
                    'jti' => base64_encode(random_bytes(32)),
                    'user_id' => $user->id()
                ],
                $this->tokenKey
            )
        ];
    }
}