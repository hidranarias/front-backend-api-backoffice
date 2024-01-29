<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\Antelope\Persistence;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;

interface AntelopeRepositoryInterface
{
    public function findAntelope(AntelopeCriteriaTransfer $antelopeCriteriaCriteriaTransfer): ?AntelopeTransfer;

    /**
     * @param \Generated\Shared\Transfer\AntelopeCriteriaTransfer $antelopeCriteriaTransfer
     *
     * @return array<\Generated\Shared\Transfer\AntelopeTransfer>
     */
    public function getAntelopes(AntelopeCriteriaTransfer $antelopeCriteriaTransfer): array;
}
