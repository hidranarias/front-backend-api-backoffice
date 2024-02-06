<?php

namespace Pyz\Zed\Antelope\Communication\Table;

use Orm\Zed\Antelope\Persistence\PyzAntelopeQuery;
use Spryker\Zed\Gui\Communication\Table\AbstractTable;
use Spryker\Zed\Gui\Communication\Table\TableConfiguration;

class AntelopesTable extends AbstractTable
{

    public function __construct(protected PyzAntelopeQuery $antelopeQuery)
    {
    }

    protected function configure(TableConfiguration $config)
    {
        $config->setHeader([]);
    }

    protected function prepareData(TableConfiguration $config)
    {
        // TODO: Implement prepareData() method.
    }
}
