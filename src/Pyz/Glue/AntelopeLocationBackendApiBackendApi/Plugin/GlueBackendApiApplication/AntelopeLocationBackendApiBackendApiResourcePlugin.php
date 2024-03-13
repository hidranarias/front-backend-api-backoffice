<?php

declare(strict_types=1);

namespace Pyz\Glue\AntelopeLocationBackendApiBackendApi\Plugin\GlueBackendApiApplication;

use Spryker\Glue\GlueApplication\Plugin\GlueApplication\Backend\AbstractResourcePlugin;
use Spryker\Glue\GlueJsonApiConventionExtension\Dependency\Plugin\JsonApiResourceInterface;
use Generated\Shared\Transfer\GlueResourceMethodCollectionTransfer;
use Generated\Shared\Transfer\GlueResourceMethodConfigurationTransfer;
use Pyz\Glue\AntelopeLocationBackendApiBackendApi\AntelopeLocationBackendApiBackendApiConfig;
use Pyz\Glue\AntelopeLocationBackendApiBackendApi\Controller\AntelopeLocationResourceController;
use Pyz\Generated\AntelopeLocationBackendApiBackendApi\Transfer\AntelopeLocationBackendApiBackendApiAttributesTransfer;

class AntelopeLocationBackendApiBackendApiResourcePlugin extends AbstractResourcePlugin implements JsonApiResourceInterface
{
    public function getType(): string
    {
        return AntelopeLocationBackendApiBackendApiConfig::RESOURCE_ANTELOPE_LOCATION;
    }

    public function getController(): string
    {
        return AntelopeLocationResourceController::class;
    }

    public function getDeclaredMethods(): GlueResourceMethodCollectionTransfer
    {
        return (new GlueResourceMethodCollectionTransfer())
            ->setGetCollection(
                (new GlueResourceMethodConfigurationTransfer())
                    ->setAttributes(AntelopeLocationBackendApiBackendApiAttributesTransfer::class)
            )
            ->setGet(
                (new GlueResourceMethodConfigurationTransfer())
                    ->setAttributes(AntelopeLocationBackendApiBackendApiAttributesTransfer::class)
            )
            ->setPost(
                (new GlueResourceMethodConfigurationTransfer())
                    ->setAttributes(AntelopeLocationBackendApiBackendApiAttributesTransfer::class)
            )
            ->setPatch(
                (new GlueResourceMethodConfigurationTransfer())
                    ->setAttributes(AntelopeLocationBackendApiBackendApiAttributesTransfer::class)
            );
    }
}