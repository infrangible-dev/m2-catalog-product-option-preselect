<?php

declare(strict_types=1);

namespace Infrangible\CatalogProductOptionPreselect\Plugin\Catalog\Ui\DataProvider\Product\Form\Modifier;

use FeWeDev\Base\Arrays;
use Magento\Ui\Component\Form\Element\Checkbox;
use Magento\Ui\Component\Form\Element\DataType\Text;
use Magento\Ui\Component\Form\Field;

/**
 * @author      Andreas Knollmann
 * @copyright   2014-2025 Softwareentwicklung Andreas Knollmann
 * @license     http://www.opensource.org/licenses/mit-license.php MIT
 */
class CustomOptions
{
    public const FIELD_PRESELECT_NAME = 'preselect';

    /** @var Arrays */
    protected $arrays;

    public function __construct(Arrays $arrays)
    {
        $this->arrays = $arrays;
    }

    /**
     * @noinspection PhpUnusedParameterInspection
     */
    public function afterModifyMeta(
        \Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\CustomOptions $subject,
        array $meta
    ): array {
        return $this->arrays->addDeepValue(
            $meta,
            [
                \Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\CustomOptions::GROUP_CUSTOM_OPTIONS_NAME,
                'children',
                \Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\CustomOptions::GRID_OPTIONS_NAME,
                'children',
                'record',
                'children',
                \Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\CustomOptions::CONTAINER_OPTION,
                'children',
                \Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\CustomOptions::GRID_TYPE_SELECT_NAME,
                'children',
                'record',
                'children',
                static::FIELD_PRESELECT_NAME
            ],
            $this->getPreselectFieldConfig(130)
        );
    }

    protected function getPreselectFieldConfig(int $sortOrder): array
    {
        return [
            'arguments' => [
                'data' => [
                    'config' => [
                        'label'         => __('Preselect'),
                        'componentType' => Field::NAME,
                        'formElement'   => Checkbox::NAME,
                        'dataScope'     => static::FIELD_PRESELECT_NAME,
                        'dataType'      => Text::NAME,
                        'sortOrder'     => $sortOrder,
                        'value'         => '0',
                        'valueMap'      => [
                            'true'  => '1',
                            'false' => '0'
                        ]
                    ]
                ]
            ]
        ];
    }
}
