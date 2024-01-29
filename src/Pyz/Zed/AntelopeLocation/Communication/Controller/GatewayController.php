<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\AntelopeLocation\Communication\Controller;

use Generated\Shared\Transfer\AntelopeLocationTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \Pyz\Zed\AntelopeLocation\Communication\AntelopeLocationCommunicationFactory getFactory()
 * @method \Pyz\Zed\AntelopeLocation\Business\AntelopeLocationFacadeInterface getFacade()
 * @method \Pyz\Zed\AntelopeLocation\Persistence\AntelopeLocationRepositoryInterface getRepository()
 */
class GatewayController extends AbstractGatewayController
{
    /**
     * @param \Generated\Shared\Transfer\AntelopeLocationTransfer $antelopeLocationTransfer
     *
     * @return \Generated\Shared\Transfer\AntelopeLocationTransfer $antelopeLocationTransfer
     */
    public function customAction(AntelopeLocationTransfer $antelopeLocationTransfer): AntelopeLocationTransfer
    {
        return $this->getFacade()
                ->customAction($antelopeLocationTransfer);
    }
}
