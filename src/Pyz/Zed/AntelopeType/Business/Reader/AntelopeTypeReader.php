<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\AntelopeType\Business\Reader;

use Generated\Shared\Transfer\AntelopeTypeCollectionTransfer;
use Generated\Shared\Transfer\AntelopeTypeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeTypeTransfer;
use Pyz\Zed\AntelopeType\Persistence\AntelopeTypeRepositoryInterface;

class AntelopeTypeReader implements AntelopeTypeReaderInterface
{


    public function __construct(private readonly AntelopeTypeRepositoryInterface $antelopeTypeRepository)
    {
    }


    public function findAntelopeType(AntelopeTypeCriteriaTransfer $antelopeTypeCriteriaTransfer): AntelopeTypeTransfer
    {
        return $this->antelopeTypeRepository->findAntelopeType($antelopeTypeCriteriaTransfer);
    }

    public function getAntelopeTypeCollection(?AntelopeTypeCriteriaTransfer $antelopeTypeCriteriaTransfer = null
    ): AntelopeTypeCollectionTransfer {
        return $this->antelopeTypeRepository->getAntelopeTypeCollection($antelopeTypeCriteriaTransfer);
    }
}
