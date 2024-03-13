<?php

declare(strict_types=1);

namespace Pyz\Glue\AntelopeTypeBackendApi\Plugin\GlueBackendApiApplication;

use Spryker\Glue\GlueApplication\Plugin\GlueApplication\Backend\AbstractResourcePlugin;
use Spryker\Glue\GlueJsonApiConventionExtension\Dependency\Plugin\JsonApiResourceInterface;
use Generated\Shared\Transfer\GlueResourceMethodCollectionTransfer;
use Generated\Shared\Transfer\GlueResourceMethodConfigurationTransfer;
use Pyz\Glue\AntelopeTypeBackendApi\AntelopeTypeBackendApiConfig;
use Pyz\Glue\AntelopeTypeBackendApi\Controller\AntelopeTypeResourceController;
use Pyz\Generated\AntelopeTypeBackendApi\Transfer\AntelopeTypeBackendApiAttributesTransfer;

class AntelopeTypeBackendApiResourcePlugin extends AbstractResourcePlugin implements JsonApiResourceInterface
{
    public function getType(): string
    {
        return AntelopeTypeBackendApiConfig::RESOURCE_ANTELOPE_TYPE;
    }

    public function getController(): string
    {
        return AntelopeTypeResourceController::class;
    }

    public function getDeclaredMethods(): GlueResourceMethodCollectionTransfer
    {
        return (new GlueResourceMethodCollectionTransfer())
            ->setGetCollection(
                (new GlueResourceMethodConfigurationTransfer())
                    ->setAttributes(AntelopeTypeBackendApiAttributesTransfer::class)
            )
            ->setGet(
                (new GlueResourceMethodConfigurationTransfer())
                    ->setAttributes(AntelopeTypeBackendApiAttributesTransfer::class)
            )
            ->setPost(
                (new GlueResourceMethodConfigurationTransfer())
                    ->setAttributes(AntelopeTypeBackendApiAttributesTransfer::class)
            )
            ->setPatch(
                (new GlueResourceMethodConfigurationTransfer())
                    ->setAttributes(AntelopeTypeBackendApiAttributesTransfer::class)
            );
    }
}