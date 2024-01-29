<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\AntelopeLocation\Business\Reader;

use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Pyz\Zed\AntelopeLocation\Persistence\AntelopeLocationRepositoryInterface;

class AntelopeLocationReader implements AntelopeLocationReaderInterface
{
    private AntelopeLocationRepositoryInterface $antelopeLocationRepository;

    /**
     * @param \Pyz\Zed\AntelopeLocation\Persistence\AntelopeLocationRepositoryInterface $antelopeLocationRepository
     */
    public function __construct(AntelopeLocationRepositoryInterface $antelopeLocationRepository)
    {
        $this->antelopeLocationRepository = $antelopeLocationRepository;
    }

    /**
     * @return void
     */
    public function findAntelopeLocation(AntelopeLocationCriteriaTransfer $antelopeLocationCriteriaTransfer): AntelopeLocationTransfer
    {
        $this->antelopeLocationRepository->findAntelopeLocation($antelopeLocationCriteriaTransfer);
    }
}
