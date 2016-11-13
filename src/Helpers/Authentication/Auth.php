<?php
namespace Src\Helpers\Authentication;

use Doctrine\ORM\EntityRepository;
use Src\Entity\User;

class Auth
{
    /** @var EntityRepository */
    protected $userRepository;

    /**
     * @param EntityRepository $userRepository
     */
    public function __construct(EntityRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param string $email
     * @param string $password
     *
     * @return bool
     */
    public function attempt($email, $password)
    {
        $user = $this->userRepository->createQueryBuilder('user')
            ->where('user.email = :email')->setParameter('email', $email)
            ->getQuery()
            ->getOneOrNullResult()
        ;

        if (null === $user) {
            return false;
        }

        if (password_verify($password, $user->getPassword())) {
            $_SESSION['user'] = $user->getId();
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function check()
    {
        return isset($_SESSION['user']);
    }

    /**
     * @return null|User
     */
    public function user()
    {
        if ($this->check()) {
            $user = $this->userRepository->find($_SESSION['user']);
        } else {
            $user = null;
        }

        return $user;
    }

    /**
     * @return void
     */
    public function signout()
    {
        unset($_SESSION['user']);
    }
}