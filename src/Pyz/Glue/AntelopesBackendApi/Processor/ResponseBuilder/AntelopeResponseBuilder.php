<?php

namespace Pyz\Glue\AntelopesBackendApi\Processor\ResponseBuilder;

use Generated\Shared\Transfer\AntelopeCollectionTransfer;
use Generated\Shared\Transfer\AntelopesBackendApiAttributesTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;
use Generated\Shared\Transfer\GlueResourceTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Pyz\Glue\AntelopeBackendApi\AntelopeBackendApiConfig;
use Pyz\Glue\AntelopesBackendApi\AntelopesBackendApiConfig;

class AntelopeResponseBuilder implements AntelopeResponseBuilderInterface
{

    public function createAntelopeResponse(AntelopeCollectionTransfer $antelopeCollectionTransfer
    ): GlueResponseTransfer {
        $response = new GlueResponseTransfer();
        foreach ($antelopeCollectionTransfer->getAntelopes() as $antelopeTransfer) {
            $resource = $this->mapAntelopeDtoToGlueResourceTransfer($antelopeTransfer);
            $response->addResource($resource);
        }
        return $response;
    }


    protected function mapAntelopeDtoToGlueResourceTransfer(AntelopeTransfer $antelopeTransfer
    ): GlueResourceTransfer {
        $resource = new GlueResourceTransfer();
        $attributes = $this->mapAntelopeDtoToAntelopeAttributesDto($antelopeTransfer);
        $resource->setAttributes($attributes);
        $resource->setType(AntelopesBackendApiConfig::RESOURCE_ANTELOPES);
        $resource->setId($antelopeTransfer->getIdAntelope());
        return $resource;
    }

    protected function mapAntelopeDtoToAntelopeAttributesDto(AntelopeTransfer $antelopeTransfer
    ): AntelopesBackendApiAttributesTransfer {
        return (new AntelopesBackendApiAttributesTransfer())->fromArray($antelopeTransfer->toArray(), true);
    }
}
