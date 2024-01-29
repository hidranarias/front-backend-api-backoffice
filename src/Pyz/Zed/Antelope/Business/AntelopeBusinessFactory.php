<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\Antelope\Business;

use Pyz\Zed\Antelope\Business\Deleter\AntelopeDeleter;
use Pyz\Zed\Antelope\Business\Deleter\AntelopeDeleterInterface;
use Pyz\Zed\Antelope\Business\Reader\AntelopeReader;
use Pyz\Zed\Antelope\Business\Reader\AntelopeReaderInterface;
use Pyz\Zed\Antelope\Business\Writer\AntelopeWriter;
use Pyz\Zed\Antelope\Business\Writer\AntelopeWriterInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \Pyz\Zed\Antelope\Persistence\AntelopeEntityManagerInterface getEntityManager()
 * @method \Pyz\Zed\Antelope\Persistence\AntelopeRepositoryInterface getRepository()
 * @method \Pyz\Zed\Antelope\AntelopeConfig getConfig()
 */
class AntelopeBusinessFactory extends AbstractBusinessFactory
{
    public function createAntelopeWriter(): AntelopeWriterInterface
    {
        return new AntelopeWriter(
            $this->getEntityManager(),
        );
    }

    public function createAntelopeReader(): AntelopeReaderInterface
    {
        return new AntelopeReader($this->getRepository());
    }

    public function createAntelopeDeleter(): AntelopeDeleterInterface
    {
        return new AntelopeDeleter($this->getEntityManager());
    }
}
