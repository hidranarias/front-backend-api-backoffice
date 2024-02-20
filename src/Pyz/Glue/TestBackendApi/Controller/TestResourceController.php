<?php
declare(strict_types=1);

namespace Pyz\Glue\TestBackendApi\Controller;

use Spryker\Glue\Kernel\Backend\Controller\AbstractController;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;
/**
 * @method \Pyz\Glue\TestBackendApi\TestBackendApiFactory getFactory()
 */
class TestResourceController extends AbstractController
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