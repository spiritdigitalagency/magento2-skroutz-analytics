<?php

namespace Spirit\Skroutz\Block;

/**
 * Block class for order success page
 * @package  Spirit_Skroutz
 * @module   Skroutz
 * @author   Spirit Developer
 */
class Success extends \Magento\Framework\View\Element\Template {
	/**
	 * @var \Magento\Checkout\Model\Session
	 */
	protected $_checkoutSession;
	
	/**
	 * @var \Magento\Sales\Model\OrderFactory
	 */
	protected $_orderFactory;
	
	/**
	 * @var \Magento\Catalog\Model\Product
	 */
	protected $_product;
	
	/**
	 * @var \Magento\Sales\Model\Order
	 */
	protected $_order;
	
	/**
	 * @var \Spirit\Skroutz\Helper\Data
	 */
	protected $_helper;
	
	/**
	 * Success constructor.
	 *
	 * @param \Magento\Checkout\Model\Session $checkoutSession
	 * @param \Magento\Sales\Model\OrderFactory $orderFactory
	 * @param \Magento\Catalog\Model\Product $product
	 * @param \Spirit\Skroutz\Helper\Data $helper
	 * @param \Magento\Framework\View\Element\Template\Context $context
	 */
	public function __construct(
		\Magento\Checkout\Model\Session $checkoutSession,
		\Magento\Sales\Model\OrderFactory $orderFactory,
		\Magento\Catalog\Model\Product $product,
		\Spirit\Skroutz\Helper\Data $helper,
		\Magento\Framework\View\Element\Template\Context $context
	) {
		$this->_checkoutSession = $checkoutSession;
		$this->_orderFactory    = $orderFactory;
		$this->_product         = $product;
		$this->_helper          = $helper;
		
		$increment_id = $this->_checkoutSession->getLastRealOrderId();
		if ( $increment_id ) {
			$this->_order = $this->_orderFactory->create()->loadByIncrementId( $increment_id );
		}
//		$this->_order = $this->_orderFactory->create()->loadByIncrementId( '2000000063' );
		
		parent::__construct( $context );
	}
	
	/**
	 * @return integer|boolean
	 */
	public function getOrderId() {
		return $this->_order ? $this->_order->getId() : false;
	}
	
	/**
	 * @return float
	 */
	public function getTotal(): float {
		if ( ! $this->_order ) {
			return 0;
		}
		
		return number_format( $this->_order->getSubtotalInclTax() + $this->_order->getShippingInclTax(), 2 );
	}
	
	/**
	 * @return float
	 */
	public function getShippingCost(): float {
		if ( ! $this->_order ) {
			return 0;
		}
		
		return number_format( $this->_order->getShippingInclTax(), 2 );
	}
	
	/**
	 * @return float
	 */
	public function getTaxAmount(): float {
		if ( ! $this->_order ) {
			return 0;
		}
		
		return number_format( $this->_order->getTaxAmount(), 2 );
	}
	
	/**
	 * @return array
	 */
	public function getItems(): array {
		return $this->_order ? $this->_order->getAllVisibleItems() : [];
	}
	
	/**
	 * @param \Magento\Sales\Api\Data\OrderItemInterface $order_item
	 *
	 * @return mixed|null
	 */
	public function getProductId( $order_item ) {
		$variationUniqueId = $this->_helper->getVariationUniqueId();
		$productId         = $order_item->getProductId();
		if ( ! $variationUniqueId && $order_item->getParentItem() ) {
			$productId = $order_item->getParentItem()->getProductId();
		}
		$product = $this->_product->load( $productId );
		
		return $product->getData( $this->_helper->getUniqueId() );
	}
}
