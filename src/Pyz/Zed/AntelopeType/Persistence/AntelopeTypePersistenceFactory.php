<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\AntelopeType\Persistence;

use Orm\Zed\AntelopeType\Persistence\PyzAntelopeTypeQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \Pyz\Zed\AntelopeType\AntelopeTypeConfig getConfig()
 * @method \Pyz\Zed\AntelopeType\Persistence\AntelopeTypeRepositoryInterface getRepository()
 * @method \Pyz\Zed\AntelopeType\Persistence\AntelopeTypeEntityManagerInterface getEntityManager()
 */
class AntelopeTypePersistenceFactory extends AbstractPersistenceFactory
{
    public function createAntelopeTypeQuery(): Criteria|PyzAntelopeTypeQuery
    {
        return PyzAntelopeTypeQuery::create();
    }
}
