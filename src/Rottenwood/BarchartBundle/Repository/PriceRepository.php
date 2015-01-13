<?php

namespace Rottenwood\BarchartBundle\Repository;

use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

/**
 * Репозиторий запросов к сущности Цена
 */
class PriceRepository extends EntityRepository {

    /**
     * Поиск цены по ID, и ближайших от нее цен
     * @param $id
     * @param $limit
     * @return \Doctrine\Common\Collections\Collection
     */
    public function findPricesFromId($id, $limit = 1000000) {
        if (!$id) {
            $limit++;
        }

        $expr = Criteria::expr();
        $criteria = Criteria::create();
        $criteria->where($expr->andX($expr->gte('id', $id), $expr->lt('id', ($id + $limit))));

        return $this->matching($criteria);
    }

    /**
     * Поиск цен до определенного ID
     * @param $id
     * @return \Doctrine\Common\Collections\Collection
     */
    public function findPricesBeforeId($id, $orderBy = 'DESC') {
        $expr = Criteria::expr();
        $criteria = Criteria::create();
        $criteria->where($expr->lte('id', $id));
        $criteria->orderBy(['id' => $orderBy]);

        return $this->matching($criteria);
    }

    /**
     * Возвращает количество записей в таблице
     * @return mixed
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findHowManyPrices() {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select($qb->expr()->count('e'));
        $qb->from($this->_entityName, 'e');

        return $qb->getQuery()->getSingleResult();
    }

    /**
     * Запрос самой последней цены
     * @return double
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findLastPriceOfSymbol() {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('e.price');
        $qb->from($this->_entityName, 'e');
        $qb->orderBy('e.id', 'DESC');
        $qb->setMaxResults(1);

        $price = $qb->getQuery()->getSingleResult();

        return $price ? $price['price'] : null;
    }
}
