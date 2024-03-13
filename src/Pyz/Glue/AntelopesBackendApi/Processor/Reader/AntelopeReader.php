<?php

namespace Pyz\Glue\AntelopesBackendApi\Processor\Reader;

use Generated\Shared\Transfer\AntelopeConditionsTransfer;
use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopesCriteriaTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Pyz\Glue\AntelopesBackendApi\Processor\ResponseBuilder\AntelopeResponseBuilderInterface;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;

class AntelopeReader implements AntelopeReaderInterface
{


    public function __construct(
        private readonly AntelopeFacadeInterface $antelopeFacade,
        private readonly AntelopeResponseBuilderInterface $antelopeResponseBuilder,
    ) {
    }

    public function getAntelope(GlueRequestTransfer $glueRequestTransfer): GlueResponseTransfer
    {
        $antelopeCriteriaTransfer = (new AntelopeCriteriaTransfer())
            ->setantelopeConditions(
                (new AntelopeConditionsTransfer())
                    ->setIdAntelope($glueRequestTransfer->getResourceOrFail()->getIdOrFail())
            );

        $antelopeCollection = $this->antelopeFacade
            ->getantelopeCollection($antelopeCriteriaTransfer);
        // dd($antelopeTransfers);
        return $this->antelopeResponseBuilder->createantelopeResponse($antelopeCollection);
    }

    public function getAntelopeCollection(GlueRequestTransfer $glueRequestTransfer): GlueResponseTransfer
    {
        $antelopeCriteriaTransfer = (new AntelopeCriteriaTransfer())
            ->setPagination($glueRequestTransfer->getPagination())
            ->setSortCollection($glueRequestTransfer->getSortings())
            ->setantelopeConditions((new AntelopeConditionsTransfer()));

        $antelopeCollection = $this->antelopeFacade
            ->getantelopeCollection($antelopeCriteriaTransfer);
        // dd($antelopeTransfers);
        return $this->antelopeResponseBuilder->createantelopeResponse($antelopeCollection);
    }


}
