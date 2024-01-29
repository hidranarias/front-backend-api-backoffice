<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\Antelope\Business;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \Pyz\Zed\Antelope\Business\AntelopeBusinessFactory getFactory()
 * @method \Pyz\Zed\Antelope\Persistence\AntelopeEntityManagerInterface getEntityManager()
 * @method \Pyz\Zed\Antelope\Persistence\AntelopeRepositoryInterface getRepository()
 */
class AntelopeFacade extends AbstractFacade implements AntelopeFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @param \Generated\Shared\Transfer\AntelopeTransfer $antelopeTransfer
     *
     * @return \Generated\Shared\Transfer\AntelopeTransfer
     * @api
     *
     */
    public function createAntelope(AntelopeTransfer $antelopeTransfer): AntelopeTransfer
    {
        return $this->getFactory()
            ->createAntelopeWriter()
            ->createAntelope($antelopeTransfer);
    }

    public function deleteAntelope(AntelopeTransfer $antelopeTransfer): bool
    {
        return $this->getFactory()->createAntelopeWriter()->deleteAntelope($antelopeTransfer);
    }

    public function findAntelope(AntelopeCriteriaTransfer $antelopeCriteriaTransfer): ?AntelopeTransfer
    {
        return $this->getFactory()->createAntelopeReader()->findAntelope($antelopeCriteriaTransfer);
    }

    /**
     * @return array<\Generated\Shared\Transfer\AntelopeTransfer> @return array<AntelopeTransfer>
     */
    public function filterByIdAntelope_In(AntelopeCriteriaTransfer $antelopeCriteriaTransfer): array
    {
        return $this->getFactory()->createAntelopeReader()
            ->getAntelopes($antelopeCriteriaTransfer);
    }
}
