<?php

namespace App\Repository;

use Gedmo\Tree\Entity\Repository\NestedTreeRepository;

class CatalogRepository extends NestedTreeRepository
{
    public function getCatalogsTreeWithDocuments()
    {
        $qb = $this->createQueryBuilder('c');

        $qb->addSelect('d');
        $qb->leftJoin('c.documents', 'd');
        $qb->orderBy('c.root');
        $qb->addOrderBy('c.lft');

        return $this->buildTreeArray($qb->getQuery()->getArrayResult());
    }
}
