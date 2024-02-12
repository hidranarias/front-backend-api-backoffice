<?php

namespace Pyz\Zed\AntelopeGui\Communication\Controller;

use Generated\Shared\Transfer\AntelopeTransfer;
use Spryker\Service\UtilText\Model\Url\Url;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Pyz\Zed\AntelopeGui\Communication\AntelopeGuiCommunicationFactory getFactory()
 */
class CreateController extends AbstractController
{
    protected const MESSAGE_ANTELOPE_CREATED_SUCCESS = 'Antelope created!';
    protected const URL_ANTELOPE_OVERVIEW = '/antelope-gui';

    public function indexAction(Request $request): ?array
    {
        $options['data']['locations'] = $this->getFactory()
            ->createAntelopeDataProvider()->getAntelopeLocations();
        $options['data']['types'] = $this->getFactory()
            ->createAntelopeDataProvider()->getAntelopeTypes();

        $antelopeCreateForm = $this->getFactory()
            ->createAntelopeCreateForm(new AntelopeTransfer(), $options)
            ->handleRequest($request);

        if ($antelopeCreateForm->isSubmitted() && $antelopeCreateForm->isValid()) {
            $this->createAntelope($antelopeCreateForm);
        }

        return $this->viewResponse([
            'antelopeCreateForm' => $antelopeCreateForm->createView(),
            'backUrl' => $this->getAntelopeOverviewUrl(),
        ]);
    }


    private function createAntelope($antelopeCreateForm): void
    {
        //dd($antelopeCreateForm->getData());
        $antelopeTransfer = (new AntelopeTransfer())->fromArray($antelopeCreateForm->getData(), true);
        $this->getFactory()->getAntelopeFacade()->createAntelope($antelopeTransfer);
        $this->addSuccessMessage(static::MESSAGE_ANTELOPE_CREATED_SUCCESS);

        $this->redirectResponse($this->getAntelopeOverviewUrl());
    }

    /**
     * @return string
     */
    protected function getAntelopeOverviewUrl(): string
    {
        return Url::generate(static::URL_ANTELOPE_OVERVIEW);
    }
}
