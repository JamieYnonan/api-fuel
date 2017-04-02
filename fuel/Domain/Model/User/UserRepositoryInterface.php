<?php
namespace Fuel\Domain\Model\User;

/**
 * Interface UserRepositoryInterface
 * @package Fuel\Domain\Model\User
 */
interface UserRepositoryInterface
{
    public function byId(int $id): User;

    public function byEmail(string $email);

    public function add(User $user);

    public function update(User $user);
}