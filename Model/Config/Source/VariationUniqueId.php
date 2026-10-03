<?php
/**
 * Copyright © Spirit Digital Agency. All rights reserved.
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Spirit\Skroutz\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Which product of an ordered variation reports its Unique ID.
 */
class VariationUniqueId implements OptionSourceInterface
{
    /**
     * Options for the admin select.
     *
     * @return array<int, array<string, mixed>>
     */
    public function toOptionArray(): array
    {
        return [
            ['value' => 0, 'label' => __('Send variation Unique ID')],
            ['value' => 1, 'label' => __('Send parent Unique ID')],
        ];
    }
}
