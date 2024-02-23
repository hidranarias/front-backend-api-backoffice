<?php

namespace Pyz\Glue\AntelopesBackendApi\Processor\Updater;

use Generated\Shared\Transfer\AntelopeCollectionTransfer;
use Generated\Shared\Transfer\AntelopesBackendApiAttributesTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Pyz\Glue\AntelopesBackendApi\AntelopesBackendApiConfig;
use Pyz\Glue\AntelopesBackendApi\Processor\Mapper\AntelopeMapper;
use Pyz\Glue\AntelopesBackendApi\Processor\ResponseBuilder\AntelopeResponseBuilderInterface;
use Pyz\Glue\AntelopesBackendApi\Processor\ResponseBuilder\ErrorResponseBuilderInterface;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;

class AntelopeUpdater implements AntelopeUpdaterInterface
{
    public function __construct(
        private readonly AntelopeFacadeInterface $antelopeFacade,
        private readonly AntelopeMapper $antelopeMapper,

        private readonly AntelopeResponseBuilderInterface $antelopeResponseBuilder,
        private readonly ErrorResponseBuilderInterface $errorResponseBuilder

    ) {
    }

    public function updateAntelope(
        AntelopesBackendApiAttributesTransfer $antelopesBackendApiAttributesTransfer,
        GlueRequestTransfer $glueRequestTransfer
    ): GlueResponseTransfer {
        if (!$this->isRequestBodyValid($glueRequestTransfer, $antelopesBackendApiAttributesTransfer)) {
            return $this->errorResponseBuilder->createErrorResponse(
                AntelopesBackendApiConfig::ANTELOPE_NOT_FOUND,
                AntelopesBackendApiConfig::ANTELOPE_NOT_FOUND_MSG
            );
        }

        $serviceTransfer = $this->findService($antelopesBackendApiAttributesTransfer);
        if (!$serviceTransfer) {
            return $this->errorResponseBuilder->createErrorResponseFromErrorMessage(
                ServicePointsBackendApiConfig::GLOSSARY_KEY_VALIDATION_SERVICE_ENTITY_NOT_FOUND,
                $glueRequestTransfer->getLocale(),
            );
        }
        $antelopeTransfer = $this->antelopeMapper
            ->mapBackendAntelopeAttributesDtoToAntelopeDto($antelopesBackendApiAttributesTransfer,
                new AntelopeTransfer());
        $antelopeTransfer = $this->antelopeFacade->updateAntelope($antelopeTransfer);
        $antelopeCollection = (new AntelopeCollectionTransfer())->addAntelope($antelopeTransfer);
        return $this->antelopeResponseBuilder->createAntelopeResponse($antelopeCollection);
    }


    protected function isRequestBodyValid(
        GlueRequestTransfer $glueRequestTransfer,
        AntelopesBackendApiAttributesTransfer $backendApiAttributesTransfer
    ): bool {
        if (!$glueResourceTransfer = $glueRequestTransfer->getResource()) {
            return false;
        }

        $validRequest = $glueResourceTransfer->getId()
            && $glueResourceTransfer->getAttributes()
            && $backendApiAttributesTransfer->modifiedToArray();
        if (!$validRequest) {
            return false;
        }
        return true;
    }
}
