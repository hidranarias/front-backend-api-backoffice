<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\AntelopeTypeDataImport\Business;

use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Pyz\Zed\AntelopeTypeDataImport\Business\DataImportStep\AntelopeTypeWriterStep;
use Pyz\Zed\AntelopeTypeDataImport\Business\DataImportStep\AntelopeTypeWriterStepInterface;
use Pyz\Zed\DataImport\Business\DataImportBusinessFactory;
use Spryker\Zed\DataImport\Business\Model\DataImporterInterface;

class AntelopeTypeDataImportBusinessFactory extends DataImportBusinessFactory
{
    public function createAntelopeTypeDataImport(
        ?DataImporterConfigurationTransfer $dataImporterConfigurationTransfer,
    ): DataImporterInterface {
        $dataImporter = $this->getCsvDataImporterFromConfig($dataImporterConfigurationTransfer);
        $dataSetStepBroker = $this->createTransactionAwareDataSetStepBroker();
        $dataSetStepBroker->addStep($this->createTypeWriterStep());
        $dataImporter->addDataSetStepBroker($dataSetStepBroker);

        return $dataImporter;
    }

    public function createTypeWriterStep(): AntelopeTypeWriterStepInterface
    {
        return new AntelopeTypeWriterStep();
    }
}
