<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\AntelopeLocation\Persistence;

use Orm\Zed\AntelopeLocation\Persistence\PyzAntelopeLocationQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \Pyz\Zed\AntelopeLocation\AntelopeLocationConfig getConfig()
 * @method \Pyz\Zed\AntelopeLocation\Persistence\AntelopeLocationRepositoryInterface getRepository()
 * @method \Pyz\Zed\AntelopeLocation\Persistence\AntelopeLocationEntityManagerInterface getEntityManager()
 */
class AntelopeLocationPersistenceFactory extends AbstractPersistenceFactory
{
    public function createAntelopeLocationQuery(): PyzAntelopeLocationQuery
    {
        return PyzAntelopeLocationQuery::create();
    }
}
