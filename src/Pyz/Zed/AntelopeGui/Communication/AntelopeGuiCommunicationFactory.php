<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\AntelopeGui\Communication;

use Generated\Shared\Transfer\AntelopeTransfer;
use Orm\Zed\Antelope\Persistence\PyzAntelopeQuery;
use Pyz\Zed\Antelope\Business\AntelopeFacadeInterface;
use Pyz\Zed\AntelopeGui\AntelopeGuiDependencyProvider;
use Pyz\Zed\AntelopeGui\Communication\Form\AntelopeCreateForm;
use Pyz\Zed\AntelopeGui\Communication\Form\AntelopeDeleteForm;
use Pyz\Zed\AntelopeGui\Communication\Form\AntelopeUpdateForm;
use Pyz\Zed\AntelopeGui\Communication\Form\DataProvider\AntelopeDataProvider;
use Pyz\Zed\AntelopeGui\Communication\Table\AntelopeTable;
use Pyz\Zed\AntelopeLocation\Business\AntelopeLocationFacadeInterface;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use Symfony\Component\Form\FormInterface;

/**
 * @method \Pyz\Zed\AntelopeGui\AntelopeGuiConfig getConfig()
 */
class AntelopeGuiCommunicationFactory extends AbstractCommunicationFactory
{
    public function createAntelopeTable(): AntelopeTable
    {
        return new AntelopeTable($this->getAntelopeQuery());
    }

    public function getAntelopeQuery(): PyzAntelopeQuery
    {
        return $this->getProvidedDependency(AntelopeGuiDependencyProvider::PROPEL_QUERY_ANTELOPE);
    }

    public function createAntelopeCreateForm(AntelopeTransfer $antelopeTransfer, array $options = []): FormInterface
    {
        return $this->getFormFactory()->create(AntelopeCreateForm::class, $antelopeTransfer, $options);
    }

    public function createAntelopeDeleteForm(AntelopeTransfer $antelopeTransfer, array $options = []): FormInterface
    {
        return $this->getFormFactory()->create(AntelopeDeleteForm::class, $antelopeTransfer, $options);
    }

    public function createAntelopeUpdateForm(AntelopeTransfer $antelopeTransfer, array $options = []): FormInterface
    {
        return $this->getFormFactory()->create(AntelopeUpdateForm::class, $antelopeTransfer, $options);
    }

    public function createAntelopeDataProvider(): AntelopeDataProvider
    {
        return new AntelopeDataProvider(
            $this->getAntelopeFacade(),
            $this->getAntelopeLocationFacade(), $this->getAntelopeTypeFacade()
        );
    }

    public function getAntelopeFacade(): AntelopeFacadeInterface
    {
        return $this->getProvidedDependency(AntelopeGuiDependencyProvider::FACADE_ANTELOPE);
    }

    public function getAntelopeLocationFacade(): AntelopeLocationFacadeInterface
    {
        return $this->getProvidedDependency(AntelopeGuiDependencyProvider::FACADE_ANTELOPE_LOCATION);
    }

    public function getAntelopeTypeFacade()
    {
        return $this->getProvidedDependency(AntelopeGuiDependencyProvider::FACADE_ANTELOPE_TYPE);
    }


}
