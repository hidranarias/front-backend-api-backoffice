<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\AntelopeLocationDataImport\Business\DataImportStep;

use Orm\Zed\AntelopeLocation\Persistence\PyzAntelopeLocationQuery;
use Pyz\Zed\AntelopeLocationDataImport\Business\DataSet\AntelopeLocationDataSetInterface;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\PublishAwareStep;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

class AntelopeLocationWriterStep extends PublishAwareStep implements DataImportStepInterface, AntelopeLocationWriterStepInterface
{
    /**
     * @return void
     */
    public function execute(DataSetInterface $dataSet): void
    {
        $antelopeLocationEntity = PyzAntelopeLocationQuery::create();
        $locationName = $dataSet[AntelopeLocationDataSetInterface::COLUMN_LOCATION_NAME];
        $latitude = $dataSet[AntelopeLocationDataSetInterface::COLUMN_LATITUDE];
        $longitude = $dataSet[AntelopeLocationDataSetInterface::COLUMN_LONGITUDE];
        $description = $dataSet[AntelopeLocationDataSetInterface::COLUMN_DESCRIPTION];

        $antelopeLocation = $antelopeLocationEntity->filterByLocationName($locationName)
            ->findOneOrCreate();

        if ($antelopeLocation->isNew() || $antelopeLocation->isModified()) {
            $antelopeLocation->setLatitude($latitude);
            $antelopeLocation->setLongitude($longitude);
            $antelopeLocation->setDescription($description);
            $antelopeLocation->save();
        }
    }
}
