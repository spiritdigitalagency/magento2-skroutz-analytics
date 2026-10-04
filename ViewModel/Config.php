<?php
/**
 * Copyright © Spirit Digital Agency. All rights reserved.
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Spirit\Skroutz\ViewModel;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Store\Model\ScopeInterface;

/**
 * Store scoped access to the Skroutz configuration.
 */
class Config implements ArgumentInterface
{
    public const CONFIG_NAMESPACE = 'spirit_skroutz';

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Whether Skroutz Analytics is enabled.
     *
     * @return bool
     */
    public function getIsActive(): bool
    {
        return (bool)$this->getConfig('analytics/status');
    }

    /**
     * Read a store scoped value under the module's config section.
     *
     * @param string $key
     * @return mixed
     */
    public function getConfig(string $key)
    {
        return $this->scopeConfig->getValue(
            self::CONFIG_NAMESPACE . '/' . $key,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * The Shop Account ID provided by Skroutz.
     *
     * @return string
     */
    public function getShopAccountID(): string
    {
        return trim((string)$this->getConfig('analytics/shop_account_id'));
    }

    /**
     * The product attribute used as Unique ID in the Skroutz XML feed.
     *
     * @return string
     */
    public function getUniqueId(): string
    {
        return (string)$this->getConfig('analytics/unique_id') ?: 'entity_id';
    }

    /**
     * Whether ordered variations report the Unique ID of their parent product.
     *
     * @return bool
     */
    public function getVariationUniqueId(): bool
    {
        return (bool)($this->getConfig('analytics/variation_unique_id') ?? true);
    }

    /**
     * The reviews widget theme, or an empty string when the widget is disabled.
     *
     * @return string
     */
    public function getReviewTheme(): string
    {
        if (!$this->getConfig('reviews/status')) {
            return '';
        }

        return $this->getConfig('reviews/theme') ? 'extended' : 'inline';
    }
}
