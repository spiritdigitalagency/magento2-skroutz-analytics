<?php
/**
 * Copyright © Spirit Digital Agency. All rights reserved.
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Spirit\Skroutz\Model\Config\Source;

use Magento\Catalog\Model\ResourceModel\Product\Attribute\CollectionFactory;
use Magento\Framework\Data\OptionSourceInterface;

/**
 * Product text attributes that can serve as the Skroutz Unique ID.
 */
class UniqueId implements OptionSourceInterface
{
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        CollectionFactory $collectionFactory
    ) {
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * Options for the admin select.
     *
     * @return array<int, array<string, mixed>>
     */
    public function toOptionArray(): array
    {
        $collection = $this->collectionFactory->create();
        $collection->addFieldToSelect(['attribute_code', 'frontend_label'])
            ->addVisibleFilter()
            ->addFieldToFilter('frontend_input', 'text')
            ->addFieldToFilter('attribute_code', ['nin' => ['meta_title', 'url_key']]);

        $options = [['value' => 'entity_id', 'label' => __('Product ID')]];
        foreach ($collection->getItems() as $attribute) {
            $options[] = [
                'value' => $attribute->getAttributeCode(),
                'label' => $attribute->getFrontendLabel(),
            ];
        }

        return $options;
    }
}
