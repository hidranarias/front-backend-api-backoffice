<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\AntelopesBackendApi;

use Spryker\Glue\Kernel\AbstractBundleConfig;

class AntelopesBackendApiConfig extends AbstractBundleConfig
{
    /**
     * @var string
     */
    public const RESOURCE_ANTELOPES = 'antelopes';
    public const ANTELOPE_NOT_FOUND = '5401';
    //TODO: ADD a glossary key
    public const ANTELOPE_NOT_FOUND_MSG = 'Antelope not found';
}
