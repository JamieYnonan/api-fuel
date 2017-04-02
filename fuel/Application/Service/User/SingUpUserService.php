<?php
namespace Fuel\Application\Service\User;

use Fuel\Domain\Model\User\{User, UserAlreadyExistsException, UserRepositoryInterface};
use Firebase\JWT\JWT;

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
            'message' => 'El usuario se registro´ correctamente!',
            'token' => JWT::encode(
                [
                    'id' => $user->id()
                ],
                $this->tokenKey
            )
        ];
    }
}