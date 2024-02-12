<?php

namespace Pyz\Zed\AntelopeType\Business;

use Pyz\Zed\AntelopeType\Business\Reader\AntelopeTypeReader;
use Pyz\Zed\AntelopeType\Business\Reader\AntelopeTypeReaderInterface;
use Pyz\Zed\AntelopeType\Business\Writer\AntelopeTypeWriter;
use Pyz\Zed\AntelopeType\Business\Writer\AntelopeTypeWriterInterface;
use Spryker\Zed\Kernel\Business\AbstractFacade;

class AntelopeTypeBusinessFactory extends AbstractFacade
{
    public function createAntelopeTypeReader(): AntelopeTypeReaderInterface
    {
        return new AntelopeTypeReader($this->getRepository());
    }

    public function createAntelopeTypeWriter(): AntelopeTypeWriterInterface
    {
        return new AntelopeTypeWriter($this->getEntityManager());
    }
}
