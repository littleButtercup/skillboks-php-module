<?php

namespace App\Repository;

use App\Entity\Tag;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Tag>
 *
 * @method Tag|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tag|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tag[]    findAll()
 * @method Tag[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TagRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tag::class);
    }

    /**
     * @param Tag $entity
     * @param bool $flush
     * @return void
     */
    public function add(Tag $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @param Tag $entity
     * @param bool $flush
     * @return void
     */
    public function remove(Tag $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @param string $search
     * @param bool $withDeletes
     */
    public function findTags(?string $search, bool $withDeletes = false)
    {
        $qb = $this->createQueryBuilder('c');

        $qb
            ->leftJoin('c.articles', 'a')
            ->addSelect('a');
        if ($search) {
            $qb
                ->andWhere('c.name LIKE :search OR a.title LIKE :search')
                ->setParameter('search', "%$search%");
        }

        if ($withDeletes) {
            $this->getEntityManager()->getFilters()->disable('softdeleteable');
        }

        return $qb->orderBy('c.createdAt', 'DESC');

    }
}
