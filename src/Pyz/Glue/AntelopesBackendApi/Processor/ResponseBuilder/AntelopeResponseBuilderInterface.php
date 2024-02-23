<?php

namespace Pyz\Glue\AntelopesBackendApi\Processor\ResponseBuilder;

use Generated\Shared\Transfer\AntelopeCollectionTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;

interface AntelopeResponseBuilderInterface
{
   
    public function createAntelopeResponse(AntelopeCollectionTransfer $antelopeCollectionResponseTransfer
    ): GlueResponseTransfer;

}
