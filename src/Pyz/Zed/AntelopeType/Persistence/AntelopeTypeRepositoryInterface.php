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

interface AntelopeTypeRepositoryInterface
{
    public function findAntelopeType(AntelopeTypeCriteriaTransfer $antelopeTypeCriteriaTransfer): ?AntelopeTypeTransfer;

    public function getAntelopeTypeCollection(?AntelopeTypeCriteriaTransfer $antelopeTypeCriteriaTransfer = null
    ): AntelopeTypeCollectionTransfer;

}
