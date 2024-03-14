<?php
declare(strict_types=1);

namespace Pyz\Glue\RhinocerosBackendApi\Controller;

use Spryker\Glue\Kernel\Backend\Controller\AbstractController;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
/**
 * @method \Pyz\Glue\RhinocerosBackendApi\RhinocerosBackendApiFactory getFactory()
 */
class RhinocerosResourceController extends AbstractController
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