<?php

namespace Pyz\Zed\AntelopeGui\Form\DataProvider;

use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;
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

    public function getData(): void
    {
        //return $this->antelopeFacade->
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

    public function getAntelopeTypes(): array
    {
        //TODO: implement
        //  $locationsCollection = $this->antelopeTypeFacade->getAntelopeLocationCollection();
        $res = [];
//        foreach ($locationsCollection->getAntelopeLocations() as $location) {
//            $res[$location->getLocationName()] = $location->getId();
//        }
//        ksort($res);
        return $res;
    }
}
