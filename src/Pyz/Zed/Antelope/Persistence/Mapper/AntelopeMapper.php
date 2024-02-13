<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\Antelope\Persistence\Mapper;

use Generated\Shared\Transfer\AntelopeCollectionResponseTransfer;
use Generated\Shared\Transfer\AntelopeCollectionTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;
use Orm\Zed\Antelope\Persistence\Base\PyzAntelope;
use Propel\Runtime\Collection\ObjectCollection;

class AntelopeMapper implements AntelopeMapperInterface
{
    public function mapAntelopeTransferToAntelopeEntity
    (

        AntelopeTransfer $antelopeTransfer,
        PyzAntelope $antelope,
    ): PyzAntelope {
        return $antelope->fromArray($antelopeTransfer->toArray());
    }

    public function mapEntityCollectionToEntityResponseTransfer(
        ObjectCollection $antelopeEntityCollection,
        AntelopeCollectionResponseTransfer $antelopeCollectionResponseTransfer
    ): AntelopeCollectionResponseTransfer {
        foreach ($antelopeEntityCollection as $antelopeEntity) {
            $antelopeCollectionResponseTransfer->addAntelope(
                $this->mapAntelopeEntityToAntelopeTransfer($antelopeEntity, new AntelopeTransfer())
            );
        }
        return $antelopeCollectionResponseTransfer;
    }

    public function mapAntelopeEntityToAntelopeTransfer
    (
        PyzAntelope $antelope,
        AntelopeTransfer $antelopeTransfer
    ): AntelopeTransfer {
        return $antelopeTransfer->fromArray($antelope->toArray(), true);
    }

    /**
     * @param ObjectCollection<PyzAntelope> $antelopeEntityCollection
     * @param AntelopeCollectionTransfer $antelopeCollectionTransfer
     * @return AntelopeCollectionTransfer
     */
    public function mapAntelopeEntityToAntelopeCollectionTransfer(
        ObjectCollection $antelopeEntityCollection,
        AntelopeCollectionTransfer $antelopeCollectionTransfer
    ): AntelopeCollectionTransfer {
        foreach ($antelopeEntityCollection as $antelopeEntity) {
            $antelopeCollectionTransfer->addAntelope(
                $this->mapAntelopeEntityToAntelopeTransfer($antelopeEntity, new AntelopeTransfer())
            );
        }
        return $antelopeCollectionTransfer;
    }
}
