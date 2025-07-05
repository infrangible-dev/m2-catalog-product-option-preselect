<?php

declare(strict_types=1);

namespace Infrangible\CatalogProductOptionPreselect\Block\Product\View\Options;

use FeWeDev\Base\Json;
use Infrangible\Core\Helper\Registry;
use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\Product\Option;
use Magento\Catalog\Model\Product\Option\Value;
use Magento\Framework\View\Element\Template;

/**
 * @author      Andreas Knollmann
 * @copyright   2014-2025 Softwareentwicklung Andreas Knollmann
 * @license     http://www.opensource.org/licenses/mit-license.php MIT
 */
class Preselect extends Template
{
    /** @var Registry */
    protected $registryHelper;

    /** @var Json */
    protected $json;

    /** @var Product */
    private $product;

    public function __construct(Template\Context $context, Registry $registryHelper, Json $json, array $data = [])
    {
        parent::__construct(
            $context,
            $data
        );

        $this->registryHelper = $registryHelper;
        $this->json = $json;
    }

    public function getProduct(): Product
    {
        if (! $this->product) {
            if ($this->registryHelper->registry('current_product')) {
                $this->product = $this->registryHelper->registry('current_product');
            } else {
                throw new \LogicException('Product is not defined');
            }
        }

        return $this->product;
    }

    /**
     * @return Option[]|null
     */
    public function getOptions(): ?array
    {
        return $this->getProduct()->getOptions();
    }

    public function getOptionsConfig(): string
    {
        $config = [];

        foreach ($this->getOptions() as $option) {
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

        return $this->json->encode($config);
    }
}
