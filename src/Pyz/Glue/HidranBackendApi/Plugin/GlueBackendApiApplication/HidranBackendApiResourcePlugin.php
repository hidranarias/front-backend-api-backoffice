<?php

declare(strict_types=1);

namespace Pyz\Glue\HidranBackendApi\Plugin\GlueBackendApiApplication;

use Spryker\Glue\GlueApplication\Plugin\GlueApplication\Backend\AbstractResourcePlugin;
use Spryker\Glue\GlueJsonApiConventionExtension\Dependency\Plugin\JsonApiResourceInterface;
use Generated\Shared\Transfer\GlueResourceMethodCollectionTransfer;
use Generated\Shared\Transfer\GlueResourceMethodConfigurationTransfer;
use Pyz\Glue\HidranBackendApi\HidranBackendApiConfig;
use Pyz\Glue\HidranBackendApi\Controller\HidranResourceController;
use Pyz\Generated\HidranBackendApi\Transfer\HidranBackendApiAttributesTransfer;

class HidranBackendApiResourcePlugin extends AbstractResourcePlugin implements JsonApiResourceInterface
{
    public function getType(): string
    {
        return HidranBackendApiConfig::RESOURCE_HIDRAN;
    }

    public function getController(): string
    {
        return HidranResourceController::class;
    }

    public function getDeclaredMethods(): GlueResourceMethodCollectionTransfer
    {
        return (new GlueResourceMethodCollectionTransfer())
            ->setGetCollection(
                (new GlueResourceMethodConfigurationTransfer())
                    ->setAttributes(HidranBackendApiAttributesTransfer::class)
            )
            ->setGet(
                (new GlueResourceMethodConfigurationTransfer())
                    ->setAttributes(HidranBackendApiAttributesTransfer::class)
            )
            ->setPost(
                (new GlueResourceMethodConfigurationTransfer())
                    ->setAttributes(HidranBackendApiAttributesTransfer::class)
            )
            ->setPatch(
                (new GlueResourceMethodConfigurationTransfer())
                    ->setAttributes(HidranBackendApiAttributesTransfer::class)
            );
    }
}