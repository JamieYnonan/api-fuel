<?php
namespace Fuel\Infrastructure\Domain\Model\User;

use Fuel\Domain\Model\User\{User, UserRepositoryInterface};
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
     * @return null|User
     */
    public function byEmail(string $email)
    {
        return $this->findOneBy(['email' => $email]);
    }

    /**
     * @param User $user
     */
    public function add(User $user)
    {
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }

    /**
     * @param User $user
     */
    public function update(User $user)
    {
        $this->getEntityManager()->flush();
    }
}