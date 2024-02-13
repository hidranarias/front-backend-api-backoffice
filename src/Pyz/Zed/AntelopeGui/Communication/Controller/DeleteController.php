<?php

namespace Pyz\Zed\AntelopeGui\Communication\Controller;

use Spryker\Service\UtilText\Model\Url\Url;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Pyz\Zed\AntelopeGui\Communication\AntelopeGuiCommunicationFactory getFactory()
 * @method \Pyz\Zed\AntelopeGui\Business\AntelopeGuiFacadeInterface getFacade()
 */
class DeleteController extends AbstractController
{
    protected const MESSAGE_ANTELOPE_UPDATED_SUCCESS = 'Antelope deleted!';
    protected const URL_ANTELOPE_OVERVIEW = '/antelope-gui';
    protected const ID_ANTELOPE = 'idAntelope';
    protected const ANTELOPE_NOT_FOUND_MSG = 'Antelope not found';
    protected const MESSAGE_ANTELOPE_UPDATED_FAILURE = 'Problem deleting antelope';


    public function indexAction(Request $request): array|RedirectResponse
    {
        $antelopeDataProvider = $this->getFactory()->createAntelopeDataProvider();
        $options = $antelopeDataProvider->getOptions();
        $idAntelope = $this->castId($request->get(static::ID_ANTELOPE, null));
        if (!$idAntelope) {
            $this->addErrorMessage(static::ANTELOPE_NOT_FOUND_MSG);

            return $this->redirectResponse(static::URL_ANTELOPE_OVERVIEW);
        }
        $data = $antelopeDataProvider->getData($idAntelope);

        $antelopeDeleteForm = $this->getFactory()
            ->createAntelopeDeleteForm($data, $options)
            ->handleRequest($request);

        if ($antelopeDeleteForm->isSubmitted() && $antelopeDeleteForm->isValid()) {
            return $this->deleteAntelope($antelopeDeleteForm);
        }

        return $this->viewResponse([
            'antelopeDeleteForm' => $antelopeDeleteForm->createView(),
            'backUrl' => $this->getAntelopeOverviewUrl(),
        ]);
        return $options;
    }

    private function deleteAntelope($antelopeCreateForm): RedirectResponse
    {
        //dd($antelopeCreateForm->getData());
        $antelopeTransfer = $antelopeCreateForm->getData();
        $res = $this->getFactory()->getAntelopeFacade()->deleteAntelope($antelopeTransfer);
        if ($res) {
            $this->addSuccessMessage(static::MESSAGE_ANTELOPE_UPDATED_SUCCESS);
        } else {
            $this->addErrorMessage(static::MESSAGE_ANTELOPE_UPDATED_FAILURE);
        }
    

        return $this->redirectResponse($this->getAntelopeOverviewUrl());
    }


    /**
     * @return string
     */
    protected function getAntelopeOverviewUrl(): string
    {
        return Url::generate(static::URL_ANTELOPE_OVERVIEW);
    }

}
