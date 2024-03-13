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

interface AntelopeMapperInterface
{
    public function mapEntityCollectionToEntityResponseTransfer(
        ObjectCollection $antelopeEntityCollection,
        AntelopeCollectionResponseTransfer $antelopeCollectionResponseTransfer
    ): AntelopeCollectionResponseTransfer;

    public function mapAntelopeEntityToAntelopeTransfer
    (
        PyzAntelope $antelope,
        AntelopeTransfer $antelopeTransfer
    ): AntelopeTransfer;

    public function mapAntelopeEntityToAntelopeCollectionTransfer(
        ObjectCollection $antelopeEntityCollection,
        AntelopeCollectionTransfer $antelopeCollectionTransfer
    ): AntelopeCollectionTransfer;

    public function mapAntelopeDtoToAntelope(PyzAntelope $antelope, AntelopeTransfer $antelopeTransfer): PyzAntelope;
}
