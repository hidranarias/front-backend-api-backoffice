<?php

namespace Pyz\Zed\AntelopeGui\Communication\Controller;

use Spryker\Zed\Kernel\Communication\Controller\AbstractController;

/**
 * @method \Pyz\Zed\AntelopeGui\Communication\AntelopeGuiCommunicationFactory getFactory()
 * @method \Pyz\Zed\AntelopeGui\Business\AntelopeGuiFacadeInterface getFacade()
 */
class AntelopeBaseController extends AbstractController
{


    public function getAntelopeData(?int $idAntelope = null): array
    {
        $antelopeDataProvider = $this->getFactory()->createAntelopeDataProvider();
        $options['data']['locations'] = $antelopeDataProvider->getAntelopeLocations();
        $options['data']['types'] = $antelopeDataProvider->getAntelopeTypes();
        if ($idAntelope) {
            $options['data']['data'] = $antelopeDataProvider->getData($idAntelope);
        }
        return $options;
    }

}
