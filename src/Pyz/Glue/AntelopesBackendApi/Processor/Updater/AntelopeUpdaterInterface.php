<?php

namespace Pyz\Glue\AntelopesBackendApi\Processor\Updater;

use Generated\Shared\Transfer\AntelopesBackendApiAttributesTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;

interface AntelopeUpdaterInterface
{
    public function updateAntelope(
        AntelopesBackendApiAttributesTransfer $backendApiAttributesTransfer,
        GlueRequestTransfer $glueRequestTransfer,


    ): GlueResponseTransfer;
}
