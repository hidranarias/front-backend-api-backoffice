<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\AntelopeType\Business;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeTypeCollectionTransfer;
use Generated\Shared\Transfer\AntelopeTypeTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \Pyz\Zed\AntelopeType\Persistence\AntelopeTypeRepositoryInterface getRepository()
 * @method \Pyz\Zed\AntelopeType\Business\AntelopeTypeBusinessFactory getFactory()
 * @method \Pyz\Zed\AntelopeType\Persistence\AntelopeTypeEntityManagerInterface getEntityManager()
 */
class AntelopeTypeFacade extends AbstractFacade implements AntelopeTypeFacadeInterface
{
    public function getAntelopeTypeCollection(?AntelopeCriteriaTransfer $antelopeCriteriaTransfer = null
    ): AntelopeTypeCollectionTransfer {
        return $this->getFactory()->createAntelopeTypeReader()->getAntelopeTypeCollection($antelopeCriteriaTransfer);
    }


    /**
     * {@inheritDoc}
     *
     * @return \Pyz\Zed\AntelopeType\Business\AntelopeTypeTRansfer
     * @api
     *
     */
    public function createAntelopeType(): AntelopeTypeTransfer
    {
        //TODO
        return new AntelopeTypeTransfer();
    }
}
