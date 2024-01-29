<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\AntelopeLocation\Business\Writer;

use Pyz\Zed\AntelopeLocation\Persistence\AntelopeLocationEntityManagerInterface;

class AntelopeLocationWriter implements AntelopeLocationWriterInterface
{
    private AntelopeLocationEntityManagerInterface $antelopeLocationEntityManager;

    /**
     * @param \Pyz\Zed\AntelopeLocation\Persistence\AntelopeLocationEntityManagerInterface $antelopeLocationEntityManager
     */
    public function __construct(AntelopeLocationEntityManagerInterface $antelopeLocationEntityManager)
    {
        $this->antelopeLocationEntityManager = $antelopeLocationEntityManager;
    }
}
