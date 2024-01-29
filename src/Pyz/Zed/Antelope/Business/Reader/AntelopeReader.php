<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\Antelope\Business\Reader;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;
use Pyz\Zed\Antelope\Persistence\AntelopeRepositoryInterface;

class AntelopeReader implements AntelopeReaderInterface
{
    private AntelopeRepositoryInterface $antelopeRepository;

    /**
     * @param \Pyz\Zed\Antelope\Persistence\AntelopeRepositoryInterface $antelopeRepository
     */
    public function __construct(AntelopeRepositoryInterface $antelopeRepository)
    {
        $this->antelopeRepository = $antelopeRepository;
    }

    /**
     * @param \Generated\Shared\Transfer\AntelopeCriteriaTransfer $antelopeCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\AntelopeCollectionTransfer|null
     */
    public function findAntelope(AntelopeCriteriaTransfer $antelopeCriteriaTransfer): ?AntelopeTransfer
    {
        return $this->antelopeRepository->findAntelope($antelopeCriteriaTransfer);
    }
}
