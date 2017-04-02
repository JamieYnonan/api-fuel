<?php
namespace Fuel\Application\Service\User;

use Fuel\Application\Service\Response\ResponseServiceInterface;
use Fuel\Domain\Model\User\User;
use Firebase\JWT\JWT;

class SingUpResponse implements ResponseServiceInterface
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var string
     */
    private $tokenKey;

    /**
     * SingUpResponse constructor.
     * @param User $user
     * @param string $tokenKey
     */
    public function __construct(User $user, string $tokenKey)
    {
        $this->user = $user;
        $this->tokenKey = $tokenKey;
    }

    /**
     * @return array
     */
    public function __invoke(): array
    {
        return [
            'message' => 'El usuario se registro´ correctamente!',
            'token' => JWT::encode(
                [
                    'id' => $this->user->id()
                ],
                $this->tokenKey
            )
        ];
    }
}