<?php

namespace Pyz\Zed\AntelopeGui\Communication\Controller;

use Spryker\Service\UtilText\Model\Url\Url;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Pyz\Zed\AntelopeGui\Communication\AntelopeGuiCommunicationFactory getFactory()
 * @method \Pyz\Zed\AntelopeGui\Business\AntelopeGuiFacadeInterface getFacade()
 */
class EditController extends AbstractController
{
    protected const MESSAGE_ANTELOPE_UPDATED_SUCCESS = 'Antelope updated!';
    protected const URL_ANTELOPE_OVERVIEW = '/antelope-gui';
    protected const ID_ANTELOPE = 'idAntelope';
    protected const ANTELOPE_NOT_FOUND_MSG = 'Antelope not found';
    protected const MESSAGE_ANTELOPE_UPDATED_FAILURE = 'Problem saving antelope';


    public function indexAction(Request $request): ?array
    {
        $antelopeDataProvider = $this->getFactory()->createAntelopeDataProvider();
        $options = $antelopeDataProvider->getOptions();
        $idAntelope = $this->castId($request->get(static::ID_ANTELOPE, null));
        if (!$idAntelope) {
            $this->addErrorMessage(static::ANTELOPE_NOT_FOUND_MSG);

            return $this->redirectResponse(static::URL_ANTELOPE_OVERVIEW);
        }
        $data = $antelopeDataProvider->getData($idAntelope);

        $antelopeUpdateForm = $this->getFactory()
            ->createAntelopeUpdateForm($data, $options)
            ->handleRequest($request);

        if ($antelopeUpdateForm->isSubmitted() && $antelopeUpdateForm->isValid()) {
            $this->updateAntelope($antelopeUpdateForm);
        }

        return $this->viewResponse([
            'antelopeUpdateForm' => $antelopeUpdateForm->createView(),
            'backUrl' => $this->getAntelopeOverviewUrl(),
        ]);
        return $options;
    }

    private function updateAntelope($antelopeCreateForm): void
    {
        //dd($antelopeCreateForm->getData());
        $antelopeTransfer = $antelopeCreateForm->getData();
        $res = $this->getFactory()->getAntelopeFacade()->updateAntelope($antelopeTransfer);
        if ($res) {
            $this->addSuccessMessage(static::MESSAGE_ANTELOPE_UPDATED_SUCCESS);
        } else {
            $this->addErrorMessage(static::MESSAGE_ANTELOPE_UPDATED_FAILURE);
        }


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
