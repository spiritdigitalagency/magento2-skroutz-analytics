<?php
/**
 * Copyright © Spirit Digital Agency. All rights reserved.
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Spirit\Skroutz\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Reviews widget themes.
 */
class Reviews implements OptionSourceInterface
{
    /**
     * Options for the admin select.
     *
     * @return array<int, array<string, mixed>>
     */
    public function toOptionArray(): array
    {
        return [
            ['value' => 0, 'label' => __('Inline')],
            ['value' => 1, 'label' => __('Extended')],
        ];
    }
}
