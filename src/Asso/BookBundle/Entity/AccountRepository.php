<?php

/*
 * This file is part of AssoBookBundle.
 *
 * AssoBookBundle is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * AssoBookBundle is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Asso\BookBundle\Entity;

use Asso\AbstractBundle\Entity\AbstractRepository;
use Asso\BookBundle\Entity\Account;

/**
 * AccountManager
 * @author winzou
 */
class AccountRepository extends AbstractRepository
{
    /**
     * Delete accounts linked to this wrap
     * @param string|array $wrap
     */
    public function deleteByWrap($wrap)
    {
        $wraps = (int) $wrap > 0 ? (array) $wrap : $wrap;

        $qb = $this->createQueryBuilder();
        $qb ->delete($this->_entityName, 'a')
            ->join('a.entries', 'e')
            ->where($qb->expr()->in('a.wrap', $wraps));

        return $qb->getQuery()->execute();
    }

    /**
     * Check if the wrap is already flushed
     * @see Asso\AbstractBundle\Entity\AbstractRepository::update()
     */
    public function update($account, $andFlush = true)
    {
        if( is_object($account->getWrap()) AND ! $account->getWrap()->getId() )
        {
            throw new \Exception('Wrap has to be flushed before adding an account.');
        }

        return parent::update($account, $andFlush);
    }

    /**
     * Return a querybuilder for EntityChoiceList
     * @param integer $wrap_id
     * @return Doctrine\ORM\QueryBuilder
     */
    public function getQueryChoicelist($wrap_id)
    {
        return $this
            ->createQueryBuilder('a')
            ->where('a.wrap = :wrap')
                ->setParameter('wrap', $wrap_id);
    }
}