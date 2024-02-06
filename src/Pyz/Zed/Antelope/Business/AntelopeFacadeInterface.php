<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\Antelope\Business;

use Generated\Shared\Transfer\AntelopeCollectionTransfer;
use Generated\Shared\Transfer\AntelopeCriteriaTransfer;

interface AntelopeFacadeInterface
{

    public function getAntelopeCollection(
        AntelopeCriteriaTransfer $antelopeCriteriaTransfer
    ): AntelopeCollectionTransfer;

}
