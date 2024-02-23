<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\Antelope\Persistence;

use Generated\Shared\Transfer\AntelopeTransfer;
use Orm\Zed\Antelope\Persistence\PyzAntelope;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \Pyz\Zed\Antelope\Persistence\AntelopePersistenceFactory getFactory()
 */
class AntelopeEntityManager extends AbstractEntityManager implements AntelopeEntityManagerInterface
{
    public function createAntelope(AntelopeTransfer $antelopeTransfer): AntelopeTransfer
    {
        $antelopeEntity = new PyzAntelope();
        $antelopeEntity->fromArray($antelopeTransfer->modifiedToArray());
        $antelopeEntity->save();

        return $antelopeTransfer->fromArray($antelopeEntity->toArray(), true);
    }

    public function deleteAntelope(AntelopeTransfer $antelopeTransfer): bool
    {
        $res = $this->getFactory()->createAntelopeQuery()->
        filterByIdantelope($antelopeTransfer->getIdAntelope())->delete();

        return (bool)$res;
    }

    public function updateAntelope($antelopeTransfer): AntelopeTransfer
    {
        $antelopeEntity = $this->getFactory()->createAntelopeQuery()
            ->filterByIdantelope($antelopeTransfer->getIdAntelope())->findOne();

        if (!$antelopeEntity) {
            return $antelopeTransfer;
        }
        $mapper = $this->getFactory()->createAntelopeMapper();
        $antelopeEntity = $mapper->mapAntelopeTransferToAntelopeEntity($antelopeTransfer, $antelopeEntity);
        $antelopeEntity->fromArray($antelopeTransfer->modifiedToArray());
        $antelopeEntity->save();
        return $mapper->mapAntelopeEntityToAntelopeTransfer($antelopeEntity, $antelopeTransfer);
    }


}
