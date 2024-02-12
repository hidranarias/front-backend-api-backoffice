<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\AntelopeType\Persistence;

use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \Pyz\Zed\AntelopeType\Persistence\AntelopeTypePersistenceFactory getFactory()
 */
class AntelopeTypeEntityManager extends AbstractEntityManager implements AntelopeTypeEntityManagerInterface
{
    /**
     * @return \Pyz\Zed\AntelopeType\Persistence\AntelopeTypeTransfer
     */
    public function createAntelopeType(): AntelopeTypeTransfer
    {
    }

    /**
     * @return \Pyz\Zed\AntelopeType\Persistence\AntelopeTypeResponseTransfer
     */
    public function deleteAntelopeType(): AntelopeTypeResponseTransfer
    {
    }
}
