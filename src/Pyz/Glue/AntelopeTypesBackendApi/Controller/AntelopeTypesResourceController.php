<?php
declare(strict_types=1);

namespace Pyz\Glue\AntelopeTypesBackendApi\Controller;

use Spryker\Glue\Kernel\Backend\Controller\AbstractController;
use Generated\Shared\Transfer\GlueRequestTransfer;
use Generated\Shared\Transfer\GlueResponseTransfer;

class AntelopeTypesResourceController extends AbstractController
{
    /**
     * @param \Generated\Shared\Transfer\GlueRequestTransfer $requestTransfer
     * @return \Generated\Shared\Transfer\GlueResponseTransfer
     */
    public function getCollectionAction(GlueRequestTransfer $requestTransfer): GlueResponseTransfer
    {
      return new GlueResponseTransfer();
        // TODO: Implement action logic.
    }

    /**
     * @param \Generated\Shared\Transfer\GlueRequestTransfer $requestTransfer
     * @return \Generated\Shared\Transfer\GlueResponseTransfer
     */
    public function getAction(GlueRequestTransfer $requestTransfer): GlueResponseTransfer
    {
      return new GlueResponseTransfer();
        // TODO: Implement action logic.
    }

}