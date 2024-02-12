<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\AntelopeType\Business;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeTypeCollectionTransfer;
use Generated\Shared\Transfer\AntelopeTypeTransfer;

interface AntelopeTypeFacadeInterface
{

    public function getAntelopeTypeCollection(?AntelopeCriteriaTransfer $antelopeCriteriaTransfer = null
    ): AntelopeTypeCollectionTransfer;

    public function createAntelopeType(): AntelopeTypeTransfer;
}
