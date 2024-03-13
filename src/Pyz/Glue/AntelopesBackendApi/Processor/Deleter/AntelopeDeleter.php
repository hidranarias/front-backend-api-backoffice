<?php

namespace Pyz\Glue\AntelopesBackendApi\Processor\Deleter;

use Generated\Shared\Transfer\AntelopeCollectionTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Pyz\Glue\AntelopesBackendApi\AntelopesBackendApiConfig;
use Pyz\Glue\AntelopesBackendApi\Processor\Mapper\AntelopeMapper;
use Pyz\Glue\AntelopesBackendApi\Processor\ResponseBuilder\AntelopeResponseBuilderInterface;
use Pyz\Glue\AntelopesBackendApi\Processor\ResponseBuilder\ErrorResponseBuilderInterface;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;

class AntelopeDeleter implements AntelopeDeleterInterface
{
    public function __construct(
        private readonly AntelopeFacadeInterface $antelopeFacade,
        private readonly AntelopeMapper $antelopeMapper,

        private readonly AntelopeResponseBuilderInterface $antelopeResponseBuilder,
        private readonly ErrorResponseBuilderInterface $errorResponseBuilder

    ) {
    }

    public function deleteAntelope(

        GlueRequestTransfer $glueRequestTransfer
    ): GlueResponseTransfer {
        if (!$this->isRequestBodyValid($glueRequestTransfer)) {
            return $this->getGlueErrorResponseNotFound();
        }


        $idAntelope = (int)$glueRequestTransfer->getResource()?->getId();
        $antelopeTransfer = (new AntelopeTransfer())->setIdAntelope($idAntelope);
        $result = $this->antelopeFacade->deleteAntelope($antelopeTransfer);
        if (!$result) {
            return $this->getGlueErrorResponseNotFound();
        }
        $antelopeCollection = (new AntelopeCollectionTransfer());
        return $this->antelopeResponseBuilder->createAntelopeResponse($antelopeCollection);
    }


    protected function isRequestBodyValid(
        GlueRequestTransfer $glueRequestTransfer,
    ): bool {
        return (bool)$glueRequestTransfer->getResourceOrFail()?->getId();
    }


    public function getGlueErrorResponseNotFound(): GlueResponseTransfer
    {
        return $this->errorResponseBuilder->createErrorResponse(
            AntelopesBackendApiConfig::ANTELOPE_NOT_FOUND,
            AntelopesBackendApiConfig::ANTELOPE_NOT_FOUND_MSG
        );
    }
}
