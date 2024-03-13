<?php
declare(strict_types=1);

namespace Pyz\Glue\AntelopeTypeBackendApi\Controller;

use Spryker\Glue\Kernel\Backend\Controller\AbstractController;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
/**
 * @method \Pyz\Glue\AntelopeTypeBackendApi\AntelopeTypeBackendApiFactory getFactory()
 */
class AntelopeTypeResourceController extends AbstractController
{

    public function getCollectionAction(GlueRequestTransfer $requestTransfer): GlueResponseTransfer
    {
      return new GlueResponseTransfer();
        // TODO: Implement action logic.
    }


    public function getAction(GlueRequestTransfer $requestTransfer): GlueResponseTransfer
    {
      return new GlueResponseTransfer();
        // TODO: Implement action logic.
    }

}