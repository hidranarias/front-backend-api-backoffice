<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\AntelopeType\Communication\Controller;

use Generated\Shared\Transfer\AntelopeTypeTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \Pyz\Zed\AntelopeType\Communication\AntelopeTypeCommunicationFactory getFactory()
 * @method \Pyz\Zed\AntelopeType\Business\AntelopeTypeFacadeInterface getFacade()
 * @method \Pyz\Zed\AntelopeType\Persistence\AntelopeTypeRepositoryInterface getRepository()
 */
class GatewayController extends AbstractGatewayController
{
    /**
     * @param \Generated\Shared\Transfer\AntelopeTypeTransfer $antelopeTypeTransfer
     *
     * @return \Generated\Shared\Transfer\AntelopeTypeTransfer $antelopeTypeTransfer
     */
    public function customAction(AntelopeTypeTransfer $antelopeTypeTransfer): AntelopeTypeTransfer
    {
        return $this->getFacade()
                ->customAction($antelopeTypeTransfer);
    }
}
