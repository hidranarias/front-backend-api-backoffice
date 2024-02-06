<?php

namespace Pyz\Glue\AntelopeBackendApi\Plugin;

use Generated\Shared\Transfer\AntelopeRestAttributesTransfer;
use Generated\Shared\Transfer\GlueResourceMethodCollectionTransfer;
use Generated\Shared\Transfer\GlueResourceMethodConfigurationTransfer;
use Pyz\Glue\AntelopeBackendApi\AntelopeBackendApiConfig;
use Pyz\Glue\AntelopeBackendApi\Controller\AntelopeResourceController;
use Spryker\Glue\GlueApplication\Plugin\GlueApplication\Backend\AbstractResourcePlugin;

class AntelopeResource extends AbstractResourcePlugin
{

    public function getType(): string
    {
        return AntelopeBackendApiConfig::RESOURCE_MODULE;
    }

    public function getController(): string
    {
        return AntelopeResourceController::class;
    }

    public function getDeclaredMethods(): GlueResourceMethodCollectionTransfer
    {
        return (new GlueResourceMethodCollectionTransfer())
            ->setGet(new GlueResourceMethodConfigurationTransfer())
            ->setGetCollection(
                (new GlueResourceMethodConfigurationTransfer())->setAction('getAllAction')->setAttributes(
                    AntelopeRestAttributesTransfer::class
                )
            )
            ->setPost(
                (new GlueResourceMethodConfigurationTransfer())
                    ->setAction('postAction')->setAttributes(AntelopeRestAttributesTransfer::class),
            );
    }
}
