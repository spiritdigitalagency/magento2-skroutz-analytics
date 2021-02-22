<?php

namespace Spirit\Skroutz\ViewModel;

class Config implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    const CONFIG_NAMESPACE = 'spirit_skroutz';
    
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $_scopeConfig;
    
    /**
     * Config constructor.
     *
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        $this->_scopeConfig = $scopeConfig;
    }
    
    /**
     * @param string $key
     *
     * @return mixed
     */
    public function getConfig(string $key)
    {
        return $this->_scopeConfig->getValue(
            self::CONFIG_NAMESPACE . "/$key",
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
    
    /**
     * @return boolean
     */
    public function getIsActive(): bool
    {
        return $this->getConfig('analytics/status') ?? false;
    }
    
    /**
     * @return string
     */
    public function getMerchantID(): string
    {
        return $this->getConfig('analytics/merchant_id') ?? '';
    }
    
    /**
     * @return string
     */
    public function getUniqueId(): string
    {
        return $this->getConfig('analytics/unique_id') ?? 'entity_id';
    }
    
    /**
     * @return bool
     */
    public function getVariationUniqueId(): bool
    {
        return $this->getConfig('analytics/variation_unique_id') ?? true;
    }
    
    /**
     * @return string
     */
    public function getReviewTheme(): string
    {
        if ($this->getConfig('reviews/status')) {
            return $this->getConfig('reviews/theme') ? 'inline' : 'extended';
        }
        
        return '';
    }
}
