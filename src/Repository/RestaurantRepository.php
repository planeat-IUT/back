<?php

namespace App\Repository;

use App\Entity\Restaurant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Restaurant>
 *
 * @method Restaurant|null find($id, $lockMode = null, $lockVersion = null)
 * @method Restaurant|null findOneBy(array $criteria, array $orderBy = null)
 * @method Restaurant[]    findAll()
 * @method Restaurant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RestaurantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Restaurant::class);
    }

    public function findByFilters(array $filters): array
    {
        $queryBuilder = $this->createQueryBuilder('r');

        foreach ($filters as $key => $value) {
            switch ($key) {
                case 'click_collect':
                    $queryBuilder->andWhere('r.click_collect = :click_collect')
                        ->setParameter('click_collect', $value);
                    break;
                case 'type':
                    $queryBuilder->andWhere('r.type = :type')
                        ->setParameter('type', $value);
                    break;
                case 'prix':
                    $queryBuilder->andWhere('r.prix = :prix')
                        ->setParameter('prix', $value);
                    break;
                case 'a_decouvrir':
                    $queryBuilder->andWhere('r.a_decouvrir = :a_decouvrir')
                        ->setParameter('a_decouvrir', $value);
                    break;
            }
        }

        return $queryBuilder->getQuery()->getResult();
    }

    public function remove(Restaurant $restaurant): void
    {
        $this->_em->remove($restaurant);
        $this->_em->flush();
    }


//    /**
//     * @return Restaurant[] Returns an array of Restaurant objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Restaurant
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
