<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\AntelopeDataImport\Business\DataImportStep;

use Orm\Zed\Antelope\Persistence\PyzAntelopeQuery;
use Pyz\Zed\AntelopeDataImport\Business\DataSet\AntelopeDataSetInterface;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\PublishAwareStep;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

class AntelopeWriterStep extends PublishAwareStep implements DataImportStepInterface, AntelopeWriterStepInterface
{
    /**
     * @return void
     */
    public function execute(DataSetInterface $dataSet): void
    {
        $antelopeEntity = PyzAntelopeQuery::create();
        $name = $dataSet[AntelopeDataSetInterface::COLUMN_NAME];
        $color = trim($dataSet[AntelopeDataSetInterface::COLUMN_COLOR]);
        $typeId = (int)$dataSet[AntelopeDataSetInterface::COLUMN_TYPE_ID];
        $locationId = (int)$dataSet[AntelopeDataSetInterface::COLUMN_LOCATION_ID];
        $age = (int)$dataSet[AntelopeDataSetInterface::COLUMN_AGE];
        $weight = (float)$dataSet[AntelopeDataSetInterface::COLUMN_WEIGHT];
        $gender = $dataSet[AntelopeDataSetInterface::COLUM_GENDER];

        $antelope = $antelopeEntity->filterByName($name)
            ->findOneOrCreate();

        if ($antelope->isNew() || $antelope->isModified()) {
            $antelope->setColor($color);
            $antelope->setTypeId($typeId);
            $antelope->setLocationId($locationId);
            $antelope->setAge($age);
            $antelope->setWeight($weight);
            $antelope->setGender($gender);
            $antelope->save();
        }
    }
}
