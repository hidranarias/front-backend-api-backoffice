<?php

namespace Pyz\Glue\AntelopesBackendApi\Processor\ResponseBuilder;

use Generated\Shared\Transfer\GlueErrorTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Pyz\Glue\AntelopesBackendApi\AntelopesBackendApiConfig;
use Symfony\Component\HttpFoundation\Response;

class ErrorResponseBuilder implements ErrorResponseBuilderInterface
{
    public function __construct(protected AntelopesBackendApiConfig $antelopesBackendApiConfig)
    {
    }

    public function createErrorResponse(int $code, string $message): GlueResponseTransfer
    {
        $error = (new GlueErrorTransfer())
            ->setStatus($code)
            ->setCode($code)->setMessage($message);
        return (new GlueResponseTransfer())->setHttpStatus(Response::HTTP_BAD_REQUEST)
            ->addError($error);
    }
}
