<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\AntelopeType\Business\Reader;

use Generated\Shared\Transfer\AntelopeTypeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeTypeTransfer;
use Pyz\Zed\AntelopeType\Persistence\AntelopeTypeRepositoryInterface;

class AntelopeTypeReader implements AntelopeTypeReaderInterface
{
    private AntelopeTypeRepositoryInterface $antelopeTypeRepository;

    /**
     * @param \Pyz\Zed\AntelopeType\Persistence\AntelopeTypeRepositoryInterface $antelopeTypeRepository
     */
    public function __construct(AntelopeTypeRepositoryInterface $antelopeTypeRepository)
    {
        $this->antelopeTypeRepository = $antelopeTypeRepository;
    }

    /**
     * @return void
     */
    public function findAntelopeType(AntelopeTypeCriteriaTransfer $antelopeTypeCriteriaTransfer): AntelopeTypeTransfer
    {
        $this->antelopeTypeRepository->findAntelopeType($antelopeTypeCriteriaTransfer);
    }
}
