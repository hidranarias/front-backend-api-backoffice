    <?php

    declare(strict_types=1);

    namespace Pyz\Glue\AntelopeTypesBackendApi\Business;

    use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

    class AntelopeTypesBackendApiBusinessFactory extends AbstractBusinessFactory
    {
        /**
         * @return \AntelopeTypeMapperInterface
         */
        public function createAntelopeTypeMapper(): AntelopeTypeMapperInterface
        {
            return new AntelopeTypeMapper();
        }

        /**
         * @return \AntelopeTypeReaderInterface
         */
        public function createAntelopeTypesReader(): AntelopeTypeReaderInterface
        {
            return new AntelopeTypeReader();
        }

        /**
         * @return \AntelopeTypeResponseBuilderInterface
         */
        public function createAntelopeTypeResponseBuilder(): AntelopeTypeResponseBuilderInterface
        {
            return new AntelopeTypeResponseBuilder();
        }
}
