<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\AntelopeType\Business\Writer;

use Pyz\Zed\AntelopeType\Persistence\AntelopeTypeEntityManagerInterface;

class AntelopeTypeWriter implements AntelopeTypeWriterInterface
{

    public function __construct(private readonly AntelopeTypeEntityManagerInterface $antelopeTypeEntityManager)
    {
    }
}
