<?php
namespace Fuel\Domain\Model\User;

use Firebase\JWT\JWT;

/**
 * Class ValidationToken
 * @package Fuel\Domain\Model\User
 */
class ValidationToken
{
    /**
     * @var string
     */
    private $tokenKey;

    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;

    /**
     * ValidationToken constructor.
     * @param string $tokenKey
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(
        string $tokenKey,
        UserRepositoryInterface $userRepository
    ) {
        $this->tokenKey = $tokenKey;
        $this->userRepository = $userRepository;
    }

    /**
     * @param string $token
     * @return \stdClass
     * @throws InvalidTokenException
     */
    public function validate(string $token): \stdClass
    {
        try {
            $data = JWT::decode(
                $token,
                $this->tokenKey,
                ['HS256']
            );

            $this->userRepository->byId($data->id);

            return $data;
        } catch (\Exception $e) {
            throw new InvalidTokenException();
        }
    }
}