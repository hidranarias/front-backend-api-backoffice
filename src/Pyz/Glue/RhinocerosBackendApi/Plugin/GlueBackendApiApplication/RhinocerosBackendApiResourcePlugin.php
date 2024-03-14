<?php

declare(strict_types=1);

namespace Pyz\Glue\RhinocerosBackendApi\Plugin\GlueBackendApiApplication;

use Spryker\Glue\GlueApplication\Plugin\GlueApplication\Backend\AbstractResourcePlugin;
use Spryker\Glue\GlueJsonApiConventionExtension\Dependency\Plugin\JsonApiResourceInterface;
use Generated\Shared\Transfer\GlueResourceMethodCollectionTransfer;
use Generated\Shared\Transfer\GlueResourceMethodConfigurationTransfer;
use Pyz\Glue\RhinocerosBackendApi\RhinocerosBackendApiConfig;
use Pyz\Glue\RhinocerosBackendApi\Controller\RhinocerosResourceController;
use Pyz\Generated\RhinocerosBackendApi\Transfer\RhinocerosBackendApiAttributesTransfer;

class RhinocerosBackendApiResourcePlugin extends AbstractResourcePlugin implements JsonApiResourceInterface
{
    public function getType(): string
    {
        return RhinocerosBackendApiConfig::RESOURCE_RHINOCEROS;
    }

    public function getController(): string
    {
        return RhinocerosResourceController::class;
    }

    public function getDeclaredMethods(): GlueResourceMethodCollectionTransfer
    {
        return (new GlueResourceMethodCollectionTransfer())
            ->setGetCollection(
                (new GlueResourceMethodConfigurationTransfer())
                    ->setAttributes(RhinocerosBackendApiAttributesTransfer::class)
            )
            ->setGet(
                (new GlueResourceMethodConfigurationTransfer())
                    ->setAttributes(RhinocerosBackendApiAttributesTransfer::class)
            )
            ->setPost(
                (new GlueResourceMethodConfigurationTransfer())
                    ->setAttributes(RhinocerosBackendApiAttributesTransfer::class)
            )
            ->setPatch(
                (new GlueResourceMethodConfigurationTransfer())
                    ->setAttributes(RhinocerosBackendApiAttributesTransfer::class)
            );
    }
}