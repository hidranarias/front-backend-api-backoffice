<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\Antelope\Persistence;

use Generated\Shared\Transfer\AntelopeTransfer;
use Orm\Zed\Antelope\Persistence\PyzAntelope;
use Pyz\Zed\Antelope\Persistence\Mapper\AntelopeMapper;
use Pyz\Zed\Antelope\Persistence\Mapper\AntelopeMapperInterface;
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
        $antelopeEntity = $this->createAntelopeMapper()
            ->mapAntelopeDtoToAntelope(new PyzAntelope(),
                $antelopeTransfer);
        $antelopeEntity->delete();
        return $antelopeEntity->isDeleted();
    }

    public function createAntelopeMapper(): AntelopeMapperInterface
    {
        return new AntelopeMapper();
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
