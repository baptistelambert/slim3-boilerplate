<?php
namespace Src\Helpers\Validator\Rules;

use Doctrine\ORM\EntityRepository;
use Respect\Validation\Rules\AbstractRule;

class UsernameAvailable extends AbstractRule
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
     * {@inheritdoc}
     */
    public function validate($input)
    {
        $qb = $this->userRepository->createQueryBuilder('user')
            ->select( 'COUNT(user.id)' )
            ->where('LOWER(user.username) = :username')->setParameter('username', strtolower($input))
        ;

        return 0 === (int) $qb->getQuery()->getSingleScalarResult();
    }
}