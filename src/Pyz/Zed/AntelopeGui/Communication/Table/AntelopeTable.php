<?php

namespace Pyz\Zed\AntelopeGui\Communication\Table;

use Orm\Zed\Antelope\Persistence\Map\PyzAntelopeTableMap;
use Orm\Zed\Antelope\Persistence\PyzAntelope;
use Orm\Zed\Antelope\Persistence\PyzAntelopeQuery;
use Orm\Zed\AntelopeLocation\Persistence\Map\PyzAntelopeLocationTableMap;
use Orm\Zed\AntelopeType\Persistence\Map\PyzAntelopeTypeTableMap;
use Propel\Runtime\Collection\ObjectCollection;
use Spryker\Zed\Gui\Communication\Table\AbstractTable;
use Spryker\Zed\Gui\Communication\Table\TableConfiguration;

class AntelopeTable extends AbstractTable
{

    protected const COL_ID_ANTELOPE = PyzAntelopeTableMap::COL_IDANTELOPE;
    protected const COL_NAME = PyzAntelopeTableMap::COL_NAME;
    protected const COL_COLOR = PyzAntelopeTableMap::COL_COLOR;
    protected const COL_LOCATION = PyzAntelopeLocationTableMap::COL_LOCATION_NAME;
    protected const COL_TYPE = PyzAntelopeTypeTableMap::COL_TYPE_NAME;
    protected PyzAntelopeQuery $antelopeQuery;

    public function __construct(PyzAntelopeQuery $antelopeQuery)
    {
        $this->antelopeQuery = $antelopeQuery
            ->innerJoinWithPyzAntelopeLocation()
            //->usePyzAntelopeLocationQuery()->withO
            ->innerJoinWithPyzAntelopeType();
    }

    protected function configure(TableConfiguration $config): TableConfiguration
    {
        $config->setHeader([
            static::COL_ID_ANTELOPE => 'Antelope ID',
            static::COL_NAME => 'Name',
            static::COL_COLOR => 'Color',
            static::COL_TYPE => 'Type',
            static::COL_LOCATION => 'Location'
        ]);

        $config->setSortable([
            static::COL_ID_ANTELOPE,
            static::COL_NAME,
            static::COL_COLOR,
            static::COL_TYPE,
        ]);

        $config->setSearchable([
            static::COL_NAME,
            static::COL_COLOR,
        ]);

        return $config;
    }

    protected function prepareData(TableConfiguration $config): array
    {
        $antelopeEntityCollection = $this->runQuery(
            $this->antelopeQuery,
            $config,
            true,
        );

        if (!$antelopeEntityCollection->count()) {
            return [];
        }

        return $this->mapReturns($antelopeEntityCollection);
    }

    private function mapReturns(array|ObjectCollection $antelopeEntityCollection)
    {
        $returns = [];
        /**
         * @var array<PyzAntelope> $antelopeEntityCollection
         */
        foreach ($antelopeEntityCollection as $item) {
            //  dd($item);
            $type = $item->getPyzAntelopeType();
            $location = $item->getPyzAntelopeLocation();
            //$item = $item->toArray();
            $rowData = [
                static::COL_COLOR => $item->getColor(),
                static::COL_NAME => $item->getName(),
                static::COL_TYPE => $type->getTypeName(),
                static::COL_ID_ANTELOPE => $item->getIdantelope(),
                static::COL_LOCATION => $location->getLocationName(),
            ];
            $returns[] = $rowData;
        }

        return $returns;
    }
}
