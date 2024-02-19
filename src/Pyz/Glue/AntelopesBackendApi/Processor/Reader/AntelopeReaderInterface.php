<?php

namespace Pyz\Glue\AntelopesBackendApi\Processor\Reader;

use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;

interface AntelopeReaderInterface
{
    public function getAntelopeCollection(GlueRequestTransfer $glueRequestTransfer
    ): GlueResponseTransfer;

    public function getAntelope(GlueRequestTransfer $glueRequestTransfer): GlueResponseTransfer;
}
