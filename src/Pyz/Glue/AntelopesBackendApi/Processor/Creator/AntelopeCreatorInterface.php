<?php

namespace Pyz\Glue\AntelopesBackendApi\Processor\Creator;

use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;

interface AntelopeCreatorInterface
{
    public function createAntelope(GlueRequestTransfer $glueRequestTransfer): GlueResponseTransfer;
}
