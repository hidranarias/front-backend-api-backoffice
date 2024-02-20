<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

//declare(strict_types=1);

namespace Pyz\Zed\Antelope\Persistence;

use Generated\Shared\Transfer\AntelopeCollectionTransfer;
use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\PaginationTransfer;
use Orm\Zed\Antelope\Persistence\PyzAntelopeQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \Pyz\Zed\Antelope\Persistence\AntelopePersistenceFactory getFactory()
 */
class AntelopeRepository extends AbstractRepository implements AntelopeRepositoryInterface
{


    public function getAntelopeCollection(AntelopeCriteriaTransfer $antelopeCriteriaTransfer
    ): AntelopeCollectionTransfer {
        $antelopeCollectionTransfer = new AntelopeCollectionTransfer();
        $antelopeEntities = $this->getFactory()->createAntelopeQuery();

        $antelopeEntities->joinWithPyzAntelopeLocation()->joinWithPyzAntelopeType();//->select($columnArray);
        $this->applyAntelopeSearch($antelopeEntities, $antelopeCriteriaTransfer);
        $this->applyAntelopeSorting($antelopeEntities, $antelopeCriteriaTransfer);
        $paginationTransfer = $antelopeCriteriaTransfer->getPagination();

        if ($paginationTransfer !== null) {
            $this->applyPagination($antelopeEntities, $paginationTransfer);
            $antelopeCollectionTransfer->setPagination($paginationTransfer);
        }
        $objectCollection = $antelopeEntities->find();

        return $this->getFactory()->createAntelopeMapper()->mapAntelopeEntityToAntelopeCollectionTransfer(
            $objectCollection,
            $antelopeCollectionTransfer
        );
    }

    protected function applyAntelopeSearch(
        PyzAntelopeQuery $antelopeEntities,
        AntelopeCriteriaTransfer $antelopeCriteriaTransfer
    ): PyzAntelopeQuery {
        $antelopeConditions = $antelopeCriteriaTransfer->getAntelopeConditions();


        if ($antelopeConditions->getName() !== null) {
            $antelopeEntities->_or()->filterByName_Like(
                sprintf('%%%s%%', $antelopeConditions->getName())
            );
        }
        if ($antelopeConditions->getIdAntelope() !== null) {
            $antelopeEntities->_or()->filterByIdantelope($antelopeConditions->getIdAntelope());
        }
        if ($antelopeConditions->getAntelopeIds()) {
            $antelopeEntities->_or()->filterByIdantelope_In($antelopeConditions->getAntelopeIds());
        }
        if ($antelopeConditions->getIdLocation() !== null) {
            $antelopeEntities->_or()->filterByLocationId($antelopeConditions->getIdLocation());
        }
        if ($antelopeConditions->getIdType() !== null) {
            $antelopeEntities->_or()->filterByTypeId($antelopeConditions->getIdType());
        }

        return $antelopeEntities;
    }

    protected function applyAntelopeSorting(
        ModelCriteria $modelCriteria,
        AntelopeCriteriaTransfer $antelopeCriteriaTransfer
    ): ModelCriteria {
        foreach ($antelopeCriteriaTransfer->getSortCollection() as $sortTransfer) {
            $modelCriteria->orderBy(
                $sortTransfer->getFieldOrFail(),
                $sortTransfer->getIsAscending() ? Criteria::ASC : Criteria::DESC,
            );
        }

        return $modelCriteria;
    }

    protected function applyPagination(
        ModelCriteria $modelCriteria,
        PaginationTransfer $paginationTransfer
    ): ModelCriteria {
        if ($paginationTransfer->getOffset() !== null && $paginationTransfer->getLimit() !== null) {
            $paginationTransfer->setNbResults($modelCriteria->count());

            return $modelCriteria
                ->offset($paginationTransfer->getOffsetOrFail())
                ->setLimit($paginationTransfer->getLimitOrFail());
        }

        if ($paginationTransfer->getPage() !== null && $paginationTransfer->getMaxPerPage()) {
            $propelModelPager = $modelCriteria->paginate(
                $paginationTransfer->getPageOrFail(),
                $paginationTransfer->getMaxPerPageOrFail(),
            );

            $paginationTransfer->setNbResults($propelModelPager->getNbResults())
                ->setFirstIndex($propelModelPager->getFirstIndex())
                ->setLastIndex($propelModelPager->getLastIndex())
                ->setFirstPage($propelModelPager->getFirstPage())
                ->setLastPage($propelModelPager->getLastPage())
                ->setNextPage($propelModelPager->getNextPage())
                ->setPreviousPage($propelModelPager->getPreviousPage());

            return $propelModelPager->getQuery();
        }

        return $modelCriteria;
    }


}
