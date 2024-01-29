<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\AntelopeTypeDataImport\Business;

use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Generated\Shared\Transfer\DataImporterReportTransfer;

/**
 * @method \Pyz\Zed\AntelopeTypeDataImport\Business\AntelopeTypeDataImportBusinessFactory getFactory()
 */
interface AntelopeTypeDataImportFacadeInterface
{
    public function importAntelopeType(?DataImporterConfigurationTransfer $dataImporterConfigurationTransfer = null): DataImporterReportTransfer;
}
