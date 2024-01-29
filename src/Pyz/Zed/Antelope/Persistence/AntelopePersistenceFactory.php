<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\Antelope\Persistence;

use Orm\Zed\Antelope\Persistence\PyzAntelopeQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \Pyz\Zed\Antelope\AntelopeConfig getConfig()
 * @method \Pyz\Zed\Antelope\Persistence\AntelopeRepositoryInterface getRepository()
 * @method \Pyz\Zed\Antelope\Persistence\AntelopeEntityManagerInterface getEntityManager()
 */
class AntelopePersistenceFactory extends AbstractPersistenceFactory
{
    public function createAntelopeQuery(): PyzAntelopeQuery
    {
        return PyzAntelopeQuery::create();
    }
}
