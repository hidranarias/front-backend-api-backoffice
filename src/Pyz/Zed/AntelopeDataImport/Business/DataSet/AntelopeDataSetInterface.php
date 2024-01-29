<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\AntelopeDataImport\Business\DataSet;

interface AntelopeDataSetInterface
{
    /**
     * @var string
     */
    public const COLUMN_NAME = 'name';

    /**
     * @var string
     */
    public const COLUMN_COLOR = 'color';

    /**
     * @var string
     */
    public const COLUMN_TYPE_ID = 'type_id';

    /**
     * @var string
     */
    public const COLUMN_LOCATION_ID = 'location_id';

    /**
     * @var string
     */
    public const COLUMN_AGE = 'age';

    /**
     * @var string
     */
    public const COLUMN_WEIGHT = 'weight';

    /**
     * @var string
     */
    public const COLUM_GENDER = 'gender';
}
