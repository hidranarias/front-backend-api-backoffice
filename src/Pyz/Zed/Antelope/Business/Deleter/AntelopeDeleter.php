<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Antelope\Business\Deleter;

use Generated\Shared\Transfer\AntelopeTransfer;
use Pyz\Zed\Antelope\Persistence\AntelopeEntityManagerInterface;

class AntelopeDeleter implements AntelopeDeleterInterface
{
    public function __construct(protected AntelopeEntityManagerInterface $antelopeEntityManager)
    {
    }

    public function deleteAntelope(AntelopeTransfer $antelopeTransfer): bool
    {
        return $this->antelopeEntityManager->deleteAntelope($antelopeTransfer);
    }
}
