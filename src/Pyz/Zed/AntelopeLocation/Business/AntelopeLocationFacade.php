<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\AntelopeLocation\Business;

use Generated\Shared\Transfer\AntelopeLocationCollectionTransfer;
use Generated\Shared\Transfer\AntelopeLocationCriteriaTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \Pyz\Zed\AntelopeLocation\Business\AntelopeLocationBusinessFactory getFactory()
 * @method \Pyz\Zed\AntelopeLocation\Persistence\AntelopeLocationRepositoryInterface getRepository()
 * @method \Pyz\Zed\AntelopeLocation\Persistence\AntelopeLocationEntityManagerInterface getEntityManager()
 */
class AntelopeLocationFacade extends AbstractFacade implements AntelopeLocationFacadeInterface
{
    /**
     * @param AntelopeLocationCriteriaTransfer|null $antelopeLocationCriteriaTransfer
     * @return void
     */
    public function getAntelopeLocationCollection(
        ?AntelopeLocationCriteriaTransfer $antelopeLocationCriteriaTransfer = null
    ): AntelopeLocationCollectionTransfer {
        return $this->getFactory()->createAntelopeLocationReader()->getAntelopeLocationCollection(
            $antelopeLocationCriteriaTransfer
        );
    }


}
