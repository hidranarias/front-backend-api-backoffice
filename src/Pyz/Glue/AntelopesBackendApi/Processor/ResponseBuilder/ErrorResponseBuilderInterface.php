<?php

namespace Pyz\Glue\AntelopesBackendApi\Processor\ResponseBuilder;

use Generated\Shared\Transfer\GlueResponseTransfer;

interface ErrorResponseBuilderInterface
{
    public function createErrorResponse(int $code, string $message): GlueResponseTransfer;
}
