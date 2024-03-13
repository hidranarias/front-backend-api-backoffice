<?php

namespace Pyz\Glue\AntelopesBackendApi\Plugin\GlueBackendApiApplication;

use Generated\Shared\Transfer\AntelopesBackendApiAttributesTransfer;
use Generated\Shared\Transfer\GlueResourceMethodCollectionTransfer;
use Generated\Shared\Transfer\GlueResourceMethodConfigurationTransfer;
use Pyz\Glue\AntelopesBackendApi\AntelopesBackendApiConfig;
use Pyz\Glue\AntelopesBackendApi\Controller\AntelopesResourceController;
use Spryker\Glue\GlueApplication\Plugin\GlueApplication\Backend\AbstractResourcePlugin;
use Spryker\Glue\GlueJsonApiConventionExtension\Dependency\Plugin\JsonApiResourceInterface;

class AntelopesBackendApiResourcePlugin extends AbstractResourcePlugin implements JsonApiResourceInterface
{

    public function getType(): string
    {
        return AntelopesBackendApiConfig::RESOURCE_ANTELOPES;
    }

    public function getController(): string
    {
        return AntelopesResourceController::class;
    }

    public function getDeclaredMethods(): GlueResourceMethodCollectionTransfer
    {
        return (new GlueResourceMethodCollectionTransfer())
            ->setGetCollection(
                (new GlueResourceMethodConfigurationTransfer())
                    ->setAttributes(AntelopesBackendApiAttributesTransfer::class)
            )
            ->setGet(
                (new GlueResourceMethodConfigurationTransfer())->setAttributes(
                    AntelopesBackendApiAttributesTransfer::class
                )
            )
            ->setPost(
                (new GlueResourceMethodConfigurationTransfer())->setAttributes(
                    AntelopesBackendApiAttributesTransfer::class
                )
            )
            ->setPatch(
                (new GlueResourceMethodConfigurationTransfer())->setAttributes(
                    AntelopesBackendApiAttributesTransfer::class
                )
            )->setDelete(
                (new GlueResourceMethodConfigurationTransfer())
            );
    }
}
