<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\AntelopeLocationDataImport\Communication\Plugin;

use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Generated\Shared\Transfer\DataImporterReportTransfer;
use Pyz\Zed\AntelopeLocationDataImport\AntelopeLocationDataImportConfig;
use Spryker\Zed\DataImport\Dependency\Plugin\DataImportPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \Pyz\Zed\AntelopeLocationDataImport\Business\AntelopeLocationDataImportFacadeInterface getFacade()
 * @method \Pyz\Zed\AntelopeLocationDataImport\AntelopeLocationDataImportConfig getConfig()
 */
class AntelopeLocationDataImportPlugin extends AbstractPlugin implements DataImportPluginInterface
{
    public function import(?DataImporterConfigurationTransfer $dataImporterConfigurationTransfer = null): DataImporterReportTransfer
    {
        return $this->getFacade()->importAntelopeLocation($dataImporterConfigurationTransfer);
    }

    public function getImportType(): string
    {
        return AntelopeLocationDataImportConfig::IMPORT_TYPE_ANTELOPE;
    }
}
