<?php

namespace Pyz\Glue\AntelopeBackendApi\Controller;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeRestAttributesTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResourceTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Pyz\Glue\AntelopeBackendApi\AntelopeBackendApiConfig;
use Spryker\Glue\Kernel\Backend\Controller\AbstractBackendApiController;

/**
 * @method \Pyz\Glue\AntelopeBackendApi\AntelopeBackendApiFactory getFactory()
 */
class AntelopeResourceController extends AbstractBackendApiController
{
    public function getAction(
        string $id,
        GlueRequestTransfer $glueRequestTransfer
    ): GlueResponseTransfer {
        $antelopeTransfer = new AntelopeCriteriaTransfer();
        $antelopeTransfer->setIdAntelope($id);
        $antelopes = $this->getFactory()->getAntelopeFacade()->findAntelope($antelopeTransfer);
        return (new GlueResponseTransfer())
            ->addResource(
                (new GlueResourceTransfer())
                    ->setId($id)
                    ->setType(AntelopeBackendApiConfig::RESOURCE_MODULE)
                    ->setAttributes(
                        (new AntelopeRestAttributesTransfer())->fromArray($antelopes->toArray(), true)
                    )
            );
    }

    public function getAllAction(): GlueResponseTransfer
    {
        $antelopes = $this->getFactory()->getAntelopeFacade()->findAntelope($antelopeTransfer);
        return (
        new GlueResponseTransfer()
        )
            ->addResource(
                (new GlueResourceTransfer())
                    ->setType(AntelopeBackendApiConfig::RESOURCE_MODULE)
                    ->setAttributes(new AntelopeRestAttributesTransfer())
            );
    }

    public function postAction(
        AntelopeBackendApiAttributesTransfer $moduleRestAttributesTransfer,
        GlueRequestTransfer $glueRequestTransfer
    ): GlueResponseTransfer {
        return (new GlueResponseTransfer())
            ->addResource(
                (new GlueResourceTransfer())
                    ->setType(AntelopeBackendApiConfig::RESOURCE_MODULE)
                    ->setAttributes(new AntelopeRestAttributesTransfer())
            );
    }

}
