<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\AntelopeTypeDataImport\Business\DataImportStep;

use Orm\Zed\AntelopeType\Persistence\PyzAntelopeTypeQuery;
use Pyz\Zed\AntelopeTypeDataImport\Business\DataSet\AntelopeTypeDataSetInterface;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\PublishAwareStep;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

class AntelopeTypeWriterStep extends PublishAwareStep implements DataImportStepInterface, AntelopeTypeWriterStepInterface
{
    /**
     * @return void
     */
    public function execute(DataSetInterface $dataSet): void
    {
        $antelopeTypeEntity = PyzAntelopeTypeQuery::create();
        $typeName = $dataSet[AntelopeTypeDataSetInterface::COLUMN_TYPE_NAME];
        $description = $dataSet[AntelopeTypeDataSetInterface::COLUMN_DESCRIPTION];

        $antelopeType = $antelopeTypeEntity->filterByTypeName($typeName)
            ->findOneOrCreate();

        if ($antelopeType->isNew() || $antelopeType->isModified()) {
            $antelopeType->setDescription($description);
            $antelopeType->save();
        }
    }
}
