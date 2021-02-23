<?php

namespace Spirit\Skroutz\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

class Badge extends Template implements BlockInterface
{
    
    /**
     * @var string
     */
    protected $_template = "widget/badge.phtml";
    
    /**
     * @var \Spirit\Skroutz\ViewModel\Config
     */
    protected $_helper;
    
    /**
     * Badge constructor.
     *
     * @param \Spirit\Skroutz\ViewModel\Config $helper
     * @param Template\Context $context
     */
    public function __construct(
        \Spirit\Skroutz\ViewModel\Config $helper,
        \Magento\Framework\View\Element\Template\Context $context
    ) {
        $this->_helper = $helper;
        
        parent::__construct($context);
    }
    
    /**
     * @return bool
     */
    public function getIsActive(): bool
    {
        return $this->_helper->getIsActive();
    }
}
