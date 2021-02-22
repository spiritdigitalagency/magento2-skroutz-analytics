<?php

namespace Spirit\Skroutz\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class Reviews implements OptionSourceInterface
{
    
    /**
     * @return array[]
     */
    public function toOptionArray(): array
    {
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
