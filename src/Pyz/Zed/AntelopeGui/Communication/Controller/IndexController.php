<?php

declare(strict_types=1);

namespace Pyz\Zed\AntelopeGui\Communication\Controller;

use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @method \Pyz\Zed\AntelopeGui\Communication\AntelopeGuiCommunicationFactory getFactory()
 * @method \Pyz\Zed\AntelopeGui\Business\AntelopeGuiFacadeInterface getFacade()
 */
class IndexController extends AbstractController
{
    public function indexAction()
    {
        $table = $this->getFactory()->createAntelopeTable();
        return $this->viewResponse(['antelopeTable' => $table->render()]);
    }


    public function tableAction(): JsonResponse
    {
        $table = $this->getFactory()
            ->createAntelopeTable();

        return $this->jsonResponse($table->fetchData());
    }
}
