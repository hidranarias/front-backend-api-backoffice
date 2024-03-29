<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\AntelopeLocation\Business;

use Pyz\Zed\AntelopeLocation\Business\Reader\AntelopeLocationReader;
use Pyz\Zed\AntelopeLocation\Business\Reader\AntelopeLocationReaderInterface;
use Pyz\Zed\AntelopeLocation\Business\Writer\AntelopeLocationWriter;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \Pyz\Zed\AntelopeLocation\AntelopeLocationConfig getConfig()
 * @method \Pyz\Zed\AntelopeLocation\Persistence\AntelopeLocationRepositoryInterface getRepository()
 * @method \Pyz\Zed\AntelopeLocation\Persistence\AntelopeLocationEntityManagerInterface getEntityManager()
 */
class AntelopeLocationBusinessFactory extends AbstractBusinessFactory
{
    public function createAntelopeLocationReader(): AntelopeLocationReaderInterface
    {
        return new AntelopeLocationReader($this->getRepository());
    }

    public function createAntelopeLocationWriter(): AntelopeLocationWriterInterface
    {
        return new AntelopeLocationWriter($this->getEntityManager());
    }
}
