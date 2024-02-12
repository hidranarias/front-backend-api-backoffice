<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\AntelopeType\Persistence;

use Generated\Shared\Transfer\AntelopeTypeCollectionTransfer;
use Generated\Shared\Transfer\AntelopeTypeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeTypeTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \Pyz\Zed\AntelopeType\Persistence\AntelopeTypePersistenceFactory getFactory()
 */
class AntelopeTypeRepository extends AbstractRepository implements AntelopeTypeRepositoryInterface
{
    public function findAntelopeType(AntelopeTypeCriteriaTransfer $antelopeTypeCriteriaTransfer): ?AntelopeTypeTransfer
    {
        $antelopeTypeQuery = $this->getFactory()->createAntelopeTypeQuery();
        $name = $antelopeTypeCriteriaTransfer->getTypeName();
        $antelopeTypeEntity = $antelopeTypeQuery->filterByTypeName($name)->findOne();
        if (!$antelopeTypeEntity) {
            return null;
        }

        return (new AntelopeTypeTransfer())->fromArray($antelopeTypeEntity->toArray());
    }

    public function getAntelopeTypeCollection(?AntelopeTypeCriteriaTransfer $antelopeTypeCriteriaTransfer = null
    ): AntelopeTypeCollectionTransfer {
        $mapper = $this->getFactory()->createAntelopeTypeMapper();
        $antelopeTypeQuery = $this->getFactory()->createAntelopeTypeQuery();
        $antelopeTypeEntities = $antelopeTypeQuery->find();
        return $mapper->mapAntelopeTypeEntityCollectionToAntelopeTypeCollectionTransfer(
            $antelopeTypeEntities,
            new AntelopeTypeCollectionTransfer()
        );
    }

}
