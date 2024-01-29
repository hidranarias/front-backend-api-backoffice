<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\AntelopeTypeDataImport\Business\DataImportStep;

use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

interface AntelopeTypeWriterStepInterface
{
    public function execute(DataSetInterface $dataSet): void;
}
