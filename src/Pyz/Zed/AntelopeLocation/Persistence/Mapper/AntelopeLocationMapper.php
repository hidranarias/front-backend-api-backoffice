<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\AntelopeLocation\Persistence\Mapper;

use Generated\Shared\Transfer\AntelopeLocationCollectionTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Orm\Zed\AntelopeLocation\Persistence\PyzAntelopeLocation;
use Propel\Runtime\Collection\ObjectCollection;

class AntelopeLocationMapper implements AntelopeLocationMapperInterface
{
    /**
     * @param array<PyzAntelopeLocation> $antelopeCollectionEntities
     * @param AntelopeLocationCollectionTransfer $antelopeCollectionTransfer
     * @return AntelopeLocationCollectionTransfer
     */
    public function mapAntelopeLocationEntityCollectionToAntelopeCollectionTransfer(
        ObjectCollection $antelopeCollectionEntities,
        AntelopeLocationCollectionTransfer $antelopeLocationCollectionTransfer
    ): AntelopeLocationCollectionTransfer {
        foreach ($antelopeCollectionEntities as $antelopeLocationEntity) {
            $antelopeLocationTransfer = $this->mapAntelopeLocationEntityToAntelopeLocationTransfer(
                $antelopeLocationEntity,
                new AntelopeLocationTransfer()
            );
            $antelopeLocationCollectionTransfer->addAntelopeLocation($antelopeLocationTransfer);
        }
        return $antelopeLocationCollectionTransfer;
    }

    public function mapAntelopeLocationEntityToAntelopeLocationTransfer(
        PyzAntelopeLocation $antelopeLocationEntity,
        AntelopeLocationTransfer $antelopeLocationTransfer
    ): AntelopeLocationTransfer {
        return $antelopeLocationTransfer->fromArray($antelopeLocationEntity->toArray());
    }
}
