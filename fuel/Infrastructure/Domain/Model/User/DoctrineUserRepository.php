<?php
namespace Fuel\Infrastructure\Domain\Model\User;

use Fuel\Domain\Model\User\User;
use Fuel\Domain\Model\User\UserRepositoryInterface;
use Doctrine\ORM\EntityRepository;

/**
 * Class DoctrineUserRespository
 * @package Fuel\Infrastructure\Domain\Model\User
 */
class DoctrineUserRepository extends EntityRepository implements UserRepositoryInterface
{
    /**
     * @param int $id
     * @return User
     */
    public function byId(int $id): User
    {
        return $this->find($id);
    }

    /**
     * @param string $email
     * @return User
     */
    public function byEmail(string $email)
    {
        return $this->findOneBy(['email' => $email]);
    }

    /**
     * @param int $id
     * @param string $email
     * @return User
     */
    public function byJwt(int $id, string $email): User
    {
        return $this->findOneBy(['id' => $id, 'email' => $email]);
    }

    /**
     * @param User $user
     */
    public function add(User $user)
    {
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }
}