<?php
/**
 * Copyright © Spirit Digital Agency. All rights reserved.
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Spirit\Skroutz\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Widget\Block\BlockInterface;
use Spirit\Skroutz\ViewModel\Config;

/**
 * Placeholder for the Skroutz embedded partner badge.
 */
class Badge extends Template implements BlockInterface
{
    /**
     * @var string
     */
    protected $_template = 'Spirit_Skroutz::widget/badge.phtml';

    /**
     * @var Config
     */
    private $config;

    /**
     * @param Context $context
     * @param Config $config
     * @param array $data
     */
    public function __construct(
        Context $context,
        Config $config,
        array $data = []
    ) {
        $this->config = $config;
        parent::__construct($context, $data);
    }

    /**
     * Whether Skroutz Analytics, which renders the badge, is enabled.
     *
     * @return bool
     */
    public function getIsActive(): bool
    {
        return $this->config->getIsActive();
    }
}
