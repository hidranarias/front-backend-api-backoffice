<?php

namespace Pyz\Glue\AntelopesBackendApi\Processor\ResponseBuilder;

use Generated\Shared\Transfer\AntelopeCollectionTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;

interface AntelopeResponseBuilderInterface
{
    /**
     * @param AntelopeCollectionTransfer $antelopeCollectionResponseTransfer
     * @return GlueResponseTransfer
     */
    public function createAntelopeResponse(AntelopeCollectionTransfer $antelopeCollectionResponseTransfer
    ): GlueResponseTransfer;

}
