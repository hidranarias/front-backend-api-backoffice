<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Glue\AntelopesBackendApi\Controller;

use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResourceTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
use Pyz\Glue\AntelopesBackendApi\AntelopesBackendApiConfig;
use Spryker\Glue\Kernel\Controller\AbstractController;

/**
 * @method \Pyz\Glue\AntelopesBackendApi\AntelopesBackendApiFactory getFactory()
 */
class AntelopesResourceController extends AbstractController
{
    public function getCollectionAction(GlueRequestTransfer $glueRequestTransfer): GlueResponseTransfer
    {
        $res = (new GlueResponseTransfer());
        $resource = new GlueResourceTransfer();
        $antelopeTransfer = new AntelopeCriteriaTransfer();
        $antelopeTransfer->setIdAntelope(1);
        $antelope = $this->getFactory()->getAntelopeFacade()->findAntelope($antelopeTransfer);
        $resource->setAttributes($antelope)
            ->setId('1')->setType(AntelopesBackendApiConfig::RESOURCE_ANTELOPES);

        return $res->addResource(
            $resource
        );
    }
}
