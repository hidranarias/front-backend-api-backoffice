<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\AntelopeLocation\Persistence;

use Generated\Shared\Transfer\AntelopeLocationCollectionTransfer;
use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Pyz\Zed\AntelopeLocation\Persistence\Mapper\AntelopeLocationMapper;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \Pyz\Zed\AntelopeLocation\Persistence\AntelopeLocationPersistenceFactory getFactory()
 */
class AntelopeLocationRepository extends AbstractRepository implements AntelopeLocationRepositoryInterface
{
    public function findAntelopeLocation(AntelopeLocationCriteriaTransfer $antelopeLocationCriteriaTransfer
    ): ?AntelopeLocationTransfer {
        $antelopeLocationQuery = $this->getFactory()->createAntelopeLocationQuery();
        $locationName = $antelopeLocationCriteriaTransfer->getLocationName();
        $antelopeLocationEntity = $antelopeLocationQuery->filterByLocationName($locationName)->findOne();
        if (!$antelopeLocationEntity) {
            return null;
        }

        return (new AntelopeLocationTransfer())->fromArray($antelopeLocationEntity->toArray());
    }

    public function getAntelopeLocationCollection(?AntelopeLocationCriteriaTransfer $antelopeLocationCriteriaTransfer
    ): AntelopeLocationCollectionTransfer {
        $antelopeLocationQuery = $this->getFactory()->createAntelopeLocationQuery();
        $mapper = new AntelopeLocationMapper();
        $antelopeCollectionEntities = $antelopeLocationQuery->find();
        $antelopeLocationCollectionTransfer = new AntelopeLocationCollectionTransfer();
        return $mapper->mapAntelopeLocationEntityCollectionToAntelopeCollectionTransfer(
            $antelopeCollectionEntities,
            $antelopeLocationCollectionTransfer
        );
    }

    /**
     * @return array
     */
    public function getAntelopeLocation(): array
    {
    }
}
