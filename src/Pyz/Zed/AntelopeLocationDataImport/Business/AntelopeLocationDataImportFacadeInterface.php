<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\AntelopeLocationDataImport\Business;

use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Generated\Shared\Transfer\DataImporterReportTransfer;

/**
 * @method \Pyz\Zed\AntelopeLocationDataImport\Business\AntelopeLocationDataImportBusinessFactory getFactory()
 */
interface AntelopeLocationDataImportFacadeInterface
{
    public function importAntelopeLocation(?DataImporterConfigurationTransfer $dataImporterConfigurationTransfer = null): DataImporterReportTransfer;
}
