<?php
namespace Fuel\Infrastructure\Token;

use Firebase\JWT\JWT;

class Token
{
    /**
     * @var array
     */
    private $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function encode(array $data)
    {
        $now = new \DateTime;
        return JWT::encode(
            [
                'iat' => $now->getTimestamp(),
                'exp' => $now->modify('+1 month')->getTimestamp(),
                'jti' => $this->config['publicKey'],
                'data' => $data
            ],
            $this->config['privateKey'],
            $this->config['algorithm']['encode']
        );
    }

    /**
     * @param string $token
     * @return object
     */
    public function decode(string $token)
    {
        try {
            $data = JWT::decode(
                $token,
                $this->config['privateKey'],
                $this->config['algorithm']['decode']
            );
        } catch (\ExpiredException $e) {
            throw new ExpiredTokenException();
        } catch (\Exception $e) {
            throw new InvalidTokenException();
        }

        if ($data->jti != $this->config['publicKey']) {
            throw new InvalidTokenException();
        }

        return $data;
    }
}