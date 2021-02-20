<?php

namespace Spirit\Skroutz\Model\Config\Source;

class UniqueId implements \Magento\Framework\Data\OptionSourceInterface {
	
	/**
	 * @var \Magento\Catalog\Model\ResourceModel\Product\Attribute\CollectionFactory
	 */
	protected $collectionFactory;
	
	/**
	 * UniqueId constructor.
	 *
	 * @param \Magento\Catalog\Model\ResourceModel\Product\Attribute\CollectionFactory $collectionFactory
	 */
	public function __construct(
		\Magento\Catalog\Model\ResourceModel\Product\Attribute\CollectionFactory $collectionFactory
	) {
		$this->collectionFactory = $collectionFactory;
	}
	
	/**
	 * @return array[]
	 */
	public function toOptionArray(): array {
		$collection = $this->collectionFactory->create();
		$collection->addFieldToSelect( 'attribute_code' )
		           ->addFieldToSelect( 'frontend_label' )
		           ->addFieldToSelect( 'frontend_input' )
		           ->addVisibleFilter()
		           ->removePriceFilter()
		           ->addFieldToFilter( 'frontend_input', [ 'in' => [ 'text' ] ] )
		           ->addFieldToFilter( 'attribute_code', [ 'nin' => [ 'category_ids', 'tier_price', 'url_key' ] ] );
		$attributesArray  = [
			[
				'value' => 'entity_id',
				'label' => 'Product ID'
			]
		];
		foreach ( $collection->getItems() as $attribute ) {
			$attributeData = [
				'value' => $attribute->getAttributeCode(),
				'label' => $attribute->getFrontendLabel()
			];
			$attributesArray[] = $attributeData;
		}
		
		return $attributesArray;
	}
}
