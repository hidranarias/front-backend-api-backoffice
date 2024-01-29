<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Pyz\Zed\AntelopeLocation;

use Pyz\Shared\AntelopeLocation\AntelopeLocationConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class AntelopeLocationConfig extends AbstractBundleConfig
{
    /**
     * @return int
     */
    public function getExampleQueueChunkSize(): int
    {
        return $this->get(AntelopeLocationConstants::EXAMPLE_QUEUE_CHUNK_SIZE, 500);
    }
}
