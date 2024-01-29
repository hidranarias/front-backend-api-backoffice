<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\AntelopeType\Communication;

use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;

/**
 * @method \Pyz\Zed\AntelopeType\AntelopeTypeConfig getConfig()
 * @method \Pyz\Zed\AntelopeType\Persistence\AntelopeTypeRepositoryInterface getRepository()
 * @method \Pyz\Zed\AntelopeType\Business\AntelopeTypeFacadeInterface getFacade()
 * @method \Pyz\Zed\AntelopeType\Persistence\AntelopeTypeEntityManagerInterface getEntityManager()
 */
class AntelopeTypeCommunicationFactory extends AbstractCommunicationFactory
{
}
