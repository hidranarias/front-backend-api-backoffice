<?php

declare(strict_types=1);

namespace Pyz\Glue\AntelopeTypesBackendApi\Plugin\GlueBackendApiApplication;

use Spryker\Glue\GlueApplication\Plugin\GlueApplication\Backend\AbstractResourcePlugin;
use Spryker\Glue\GlueJsonApiConventionExtension\Dependency\Plugin\JsonApiResourceInterface;
use Generated\Shared\Transfer\GlueResourceMethodCollectionTransfer;
use Generated\Shared\Transfer\GlueResourceMethodConfigurationTransfer;
use Pyz\Glue\AntelopeTypesBackendApi\AntelopeTypesBackendApiConfig;
use Pyz\Glue\AntelopeTypesBackendApi\Controller\AntelopeTypesResourceController;
use Pyz\Generated\AntelopeTypesBackendApi\Transfer\AntelopeTypesBackendApiAttributesTransfer;

class AntelopeTypesBackendApiResourcePlugin extends AbstractResourcePlugin implements JsonApiResourceInterface
{
    public function getType(): string
    {
        return AntelopeTypesBackendApiConfig::RESOURCE_ANTELOPE_TYPES;
    }

    public function getController(): string
    {
        return AntelopeTypesResourceController::class;
    }

    public function getDeclaredMethods(): GlueResourceMethodCollectionTransfer
    {
        return (new GlueResourceMethodCollectionTransfer())
            ->setGetCollection(
                (new GlueResourceMethodConfigurationTransfer())
                    ->setAttributes(AntelopeTypesBackendApiAttributesTransfer::class)
            )
            ->setGet(
                (new GlueResourceMethodConfigurationTransfer())
                    ->setAttributes(AntelopeTypesBackendApiAttributesTransfer::class)
            )
            ->setPost(
                (new GlueResourceMethodConfigurationTransfer())
                    ->setAttributes(AntelopeTypesBackendApiAttributesTransfer::class)
            )
            ->setPatch(
                (new GlueResourceMethodConfigurationTransfer())
                    ->setAttributes(AntelopeTypesBackendApiAttributesTransfer::class)
            );
    }
}