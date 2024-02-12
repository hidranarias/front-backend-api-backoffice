<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\AntelopeType\Persistence\Mapper;

use Generated\Shared\Transfer\AntelopeTypeCollectionTransfer;
use Generated\Shared\Transfer\AntelopeTypeTransfer;
use Orm\Zed\AntelopeType\Persistence\Base\PyzAntelopeType;
use Propel\Runtime\Collection\ObjectCollection;

class AntelopeTypeMapper implements AntelopeTypeMapperInterface
{
    public function mapAntelopeTypeEntityCollectionToAntelopeTypeCollectionTransfer(
        ObjectCollection $antelopeTypes,
        AntelopeTypeCollectionTransfer $antelopeTypeCollectionTransfer
    ): AntelopeTypeCollectionTransfer {
        foreach ($antelopeTypes as $antelopeType) {
            $antelopeTransfer = $this->mapAntelopeTypeEntityToAntelopeTypeTransfer(
                $antelopeType,
                new AntelopeTypeTransfer()
            );
            $antelopeTypeCollectionTransfer->addAntelopeType($antelopeTransfer);
        }
        return $antelopeTypeCollectionTransfer;
    }

    public function mapAntelopeTypeEntityToAntelopeTypeTransfer(
        PyzAntelopeType $antelopeType,
        AntelopeTypeTransfer $antelopeTypeTransfer
    ): AntelopeTypeTransfer {
        return $antelopeTypeTransfer->fromArray($antelopeType->toArray());
    }
}
