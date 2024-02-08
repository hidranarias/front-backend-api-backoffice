<?php

use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;

class AntelopeDataProvider
{
    public function __construct(protected AntelopeFacadeInterface $antelopeFacade)
    {
    }

    public function getData()
    {
        //return $this->antelopeFacade->
    }

    public function getOptions()
    {
    }
}
