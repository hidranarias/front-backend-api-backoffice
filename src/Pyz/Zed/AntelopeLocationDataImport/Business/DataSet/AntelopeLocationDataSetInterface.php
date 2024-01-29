<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\AntelopeLocationDataImport\Business\DataSet;

interface AntelopeLocationDataSetInterface
{
    /**
     * @var string
     */
    public const COLUMN_LOCATION_NAME = 'location_name';

    /**
     * @var string
     */
    public const COLUMN_LATITUDE = 'latitude';

    /**
     * @var string
     */
    public const COLUMN_LONGITUDE = 'longitude';

    /**
     * @var string
     */
    public const COLUMN_DESCRIPTION = 'description';
}
