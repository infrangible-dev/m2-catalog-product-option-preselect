<?php

declare(strict_types=1);

namespace Infrangible\CatalogProductOptionPreselect\Helper;

use FeWeDev\Base\Json;
use Magento\Catalog\Model\Product\Option;
use Magento\Catalog\Model\Product\Option\Value;

/**
 * @author      Andreas Knollmann
 * @copyright   2014-2025 Softwareentwicklung Andreas Knollmann
 * @license     http://www.opensource.org/licenses/mit-license.php MIT
 */
class Data
{
    /** @var Json */
    protected $json;

    public function __construct(Json $json)
    {
        $this->json = $json;
    }

    /**
     * @param Option[] $options
     */
    public function getOptionsJsonConfig(array $options): string
    {
        $config = $this->getOptionsJsonConfigData($options);

        return $this->json->encode($config);
    }

    /**
     * @param Option[] $options
     */
    public function getOptionsJsonConfigData(array $options): array
    {
        $config = [];

        foreach ($options as $option) {
            if ($option->getType() === 'drop_down' || $option->getType() === 'select2') {
                /** @var Value $optionValue */
                foreach ($option->getValues() as $optionValue) {
                    if ($optionValue->getData('preselect')) {
                        $config[] = [
                            'option_id'      => $option->getOptionId(),
                            'type'           => 'drop_down',
                            'option_type_id' => $optionValue->getOptionTypeId()
                        ];
                    }
                }
            }
        }

        return $config;
    }
}
