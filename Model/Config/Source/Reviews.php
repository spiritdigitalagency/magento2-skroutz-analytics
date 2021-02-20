<?php

namespace Spirit\Skroutz\Model\Config\Source;

class Reviews implements \Magento\Framework\Data\OptionSourceInterface {
	
	/**
	 * @return array[]
	 */
	public function toOptionArray(): array {
		return [
			[
				'value' => 0,
				'label' => 'Inline'
			],
			[
				'value' => 1,
				'label' => 'Extended'
			]
		];
	}
}
