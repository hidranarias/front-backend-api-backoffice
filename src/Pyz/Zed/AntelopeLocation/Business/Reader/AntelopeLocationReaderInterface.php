<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\AntelopeLocation\Business\Reader;

use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;

interface AntelopeLocationReaderInterface
{
    public function findAntelopeLocation(AntelopeLocationCriteriaTransfer $antelopeLocationCriteriaTransfer): AntelopeLocationTransfer;
}
