<?php
declare(strict_types=1);

namespace Pyz\Glue\HidranBackendApi\Controller;

use Spryker\Glue\Kernel\Backend\Controller\AbstractController;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
/**
 * @method \Pyz\Glue\HidranBackendApi\HidranBackendApiFactory getFactory()
 */
class HidranResourceController extends AbstractController
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