<?php

namespace App\Repository;

use App\Classe\Search;
use App\Entity\Livre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Livre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Livre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Livre[]    findAll()
 * @method Livre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LivreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Livre::class);
    }

    /**
     * @return Livre[]
     */

    public function findWithSearchGenre(Search $search){
        $query = $this
            ->createQueryBuilder('l')
            ->select('g', 'l')
            ->join('l.genres', 'g');

        if (!empty($search->genres)) {
            $query = $query
                ->andWhere('g.id IN (:genres)')
                ->setParameter('genres', $search->genres);
        }

        return $query->getQuery()->getResult();
    }


    /**
     * @return Livre[]
     */
    public function findWithSearchAuteur(Search $search){
        $query = $this
            ->createQueryBuilder('l')
            ->select('a', 'l')
            ->join('l.auteurs', 'a');

        if (!empty($search->auteurs)) {
            $query = $query
                ->andWhere('a.id IN (:auteurs)')
                ->setParameter('auteurs', $search->auteurs);
        }

        return $query->getQuery()->getResult();
    }

    /**
     * @return Livre[]
     */
    public function findWithSearchMC(Search $search){
        $query = $this
            ->createQueryBuilder('l')
            ->select( 'l');

        if (!empty($search->string)) {
            $query = $query
                ->andWhere('l.titre LIKE :string')
                ->setParameter('string', "%{$search->string}%");
        }

        return $query->getQuery()->getResult();
    }

    /**
     * @return Livre[]
     */
    public function findWithSearchNote(Search $search){
        $query = $this
            ->createQueryBuilder('l')
            ->select( 'l');

        if (!empty($search->string)) {
            $query = $query
                ->andWhere('l.note = :string')
                ->setParameter('string', "{$search->string}");
        }

        return $query->getQuery()->getResult();
    }

    // /**
    //  * @return Livre[] Returns an array of Livre objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Livre
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
