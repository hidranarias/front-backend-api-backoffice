<?php

namespace Pyz\Glue\AntelopesBackendApi\Processor\Creator;

use Generated\Shared\Transfer\AntelopeCollectionTransfer;
use Generated\Shared\Transfer\AntelopeRestAttributesTransfer;
use Generated\Shared\Transfer\AntelopesBackendApiAttributesTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Pyz\Glue\AntelopesBackendApi\Processor\Mapper\AntelopeMapper;
use Pyz\Glue\AntelopesBackendApi\Processor\ResponseBuilder\AntelopeResponseBuilderInterface;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;

class AntelopeCreator implements AntelopeCreatorInterface
{
    public function __construct(
        private readonly AntelopeFacadeInterface $antelopeFacade,
        private readonly AntelopeMapper $antelopeMapper,

        private readonly AntelopeResponseBuilderInterface $antelopeResponseBuilder
    ) {
    }

    public function createAntelope(
        AntelopesBackendApiAttributesTransfer $backendApiAttributesTransfer,
        GlueRequestTransfer $glueRequestTransfer
    ): GlueResponseTransfer {
        /**
         * @var AntelopeRestAttributesTransfer $attributes
         */
        //  $antelopeRestAttributesTransfer = $glueRequestTransfer->getResourceOrFail()->getAttributes();

        $antelopeTransfer = $this->antelopeMapper
            ->mapBackendAntelopeAttributesDtoToAntelopeDto($backendApiAttributesTransfer,
                new AntelopeTransfer());
        $antelopeTransfer = $this->antelopeFacade->createAntelope($antelopeTransfer);
        $antelopeCollection = (new AntelopeCollectionTransfer())->addAntelope($antelopeTransfer);
        return $this->antelopeResponseBuilder->createAntelopeResponse($antelopeCollection);
    }
}
