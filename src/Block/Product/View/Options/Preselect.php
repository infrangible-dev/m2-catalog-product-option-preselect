<?php

declare(strict_types=1);

namespace Infrangible\CatalogProductOptionPreselect\Block\Product\View\Options;

use Infrangible\CatalogProductOptionPreselect\Helper\Data;
use Infrangible\Core\Helper\Registry;
use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\Product\Option;
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

    /** @var Data */
    protected $helper;

    /** @var Product */
    private $product;

    public function __construct(Template\Context $context, Registry $registryHelper, Data $helper, array $data = [])
    {
        parent::__construct(
            $context,
            $data
        );

        $this->registryHelper = $registryHelper;
        $this->helper = $helper;
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
        return $this->helper->getOptionsJsonConfig($this->getOptions());
    }
}
