<?php

namespace Pyz\Zed\AntelopeGui\Communication\Form\DataProvider;

use Generated\Shared\Transfer\AntelopeConditionsTransfer;
use Generated\Shared\Transfer\AntelopeCriteriaTransfer;
use Generated\Shared\Transfer\AntelopeTransfer;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;
use Pyz\Zed\AntelopeGui\Communication\Form\AntelopeCreateForm;
use Pyz\Zed\AntelopeLocation\Business\AntelopeLocationFacadeInterface;
use Pyz\Zed\AntelopeType\Business\AntelopeTypeFacadeInterface;

class AntelopeDataProvider
{
    /**
     * @param AntelopeFacadeInterface $antelopeFacade
     * @param AntelopeLocationFacadeInterface $antelopeLocationFacade
     * @param AntelopeTypeFacadeInterface $antelopeTypeFacade
     */
    public function __construct(
        protected AntelopeFacadeInterface $antelopeFacade,
        protected AntelopeLocationFacadeInterface $antelopeLocationFacade,
        protected AntelopeTypeFacadeInterface $antelopeTypeFacade
    ) {
    }

    public function getData(int $idAntelope): AntelopeTransfer
    {
        $antelopeCriteriaTransfer = new AntelopeCriteriaTransfer();
        $conditions = new AntelopeConditionsTransfer();
        $conditions->setIdAntelope($idAntelope);
        $antelopeCriteriaTransfer->setAntelopeConditions($conditions);
        return $this->antelopeFacade->
        getAntelopeCollection($antelopeCriteriaTransfer)
            ->getAntelopes()->getIterator()->current();
    }

    public function getOptions(): array
    {
        return [
            AntelopeCreateForm::ANTELOPE_LOCATIONS => $this->getAntelopeLocations(),
            AntelopeCreateForm::ANTELOPE_TYPES => $this->getAntelopeTypes()
        ];
    }

    /**
     * @return array<string,int>
     */
    public function getAntelopeLocations(): array
    {
        $locationsCollection = $this->antelopeLocationFacade->getAntelopeLocationCollection();
        $res = [];
        foreach ($locationsCollection->getAntelopeLocations() as $location) {
            $res[$location->getLocationName()] = $location->getId();
        }
        ksort($res);
        return $res;
    }

    /**
     * return array<string,int>
     */
    public function getAntelopeTypes(): array
    {
        $antelopeTypes = $this->antelopeTypeFacade->getAntelopeTypeCollection();
        $res = ['' => '-'];
        foreach ($antelopeTypes->getAntelopeTypes() as $type) {
            $res[$type->getTypeName()] = $type->getId();
        }
        ksort($res);
        return $res;
    }
}
