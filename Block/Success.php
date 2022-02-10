<?php

namespace Spirit\Skroutz\Block;

use Magento\Catalog\Model\Product;
use Magento\Checkout\Model\Session;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Sales\Api\Data\OrderItemInterface;
use Magento\Sales\Model\Order;
use Magento\Sales\Model\OrderFactory;
use Spirit\Skroutz\ViewModel\Config;

class Success extends Template
{
    /**
     * @var Session
     */
    protected $_checkoutSession;

    /**
     * @var OrderFactory
     */
    protected $_orderFactory;

    /**
     * @var Product
     */
    protected $_product;

    /**
     * @var Order
     */
    protected $_order;

    /**
     * @var Config
     */
    protected $_helper;

    /**
     * Success constructor.
     *
     * @param Session $checkoutSession
     * @param OrderFactory $orderFactory
     * @param Product $product
     * @param Config $helper
     * @param Context $context
     */
    public function __construct(
        Session $checkoutSession,
        OrderFactory $orderFactory,
        Product $product,
        Config $helper,
        Context $context
    ) {
        $this->_checkoutSession = $checkoutSession;
        $this->_orderFactory    = $orderFactory;
        $this->_product         = $product;
        $this->_helper          = $helper;

        $increment_id = $this->_checkoutSession->getLastRealOrderId();
        if ($increment_id) {
            $this->_order = $this->_orderFactory->create()->loadByIncrementId($increment_id);
        }

        parent::__construct($context);
    }

    /**
     * @return integer|boolean
     */
    public function getOrderId()
    {
        return $this->_order ? $this->_order->getId() : false;
    }

    /**
     * @return Order
     */
    public function getOrder()
    {
        return $this->_order;
    }

    /**
     * @return float
     */
    public function getTotal()
    {
        if (! $this->_order) {
            return 0;
        }

        return number_format($this->_order->getSubtotalInclTax() + $this->_order->getShippingInclTax(), 2);
    }

    /**
     * @return float
     */
    public function getShippingCost()
    {
        if (! $this->_order) {
            return 0;
        }

        return number_format($this->_order->getShippingInclTax(), 2);
    }

    /**
     * @return float
     */
    public function getTaxAmount()
    {
        if (! $this->_order) {
            return 0;
        }

        return number_format($this->_order->getTaxAmount(), 2);
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->_order ? $this->_order->getAllVisibleItems() : [];
    }

    /**
     * @return string
     */
    public function getPaymentMethodTitle(): string
    {
        if (! $this->_order) {
            return '';
        }
        $payment = $this->_order->getPayment();
        $method = $payment->getMethodInstance();
        return ($payment && $method) ? $method->getTitle() : '';
    }

    /**
     * @return string
     */
    public function getPaymentMethodCode(): string
    {
        if (! $this->_order) {
            return '';
        }
        return $this->_order->getPayment() ? $this->_order->getPayment()->getMethod() : '';
    }

    /**
     * @param OrderItemInterface $order_item
     *
     * @return mixed|null
     */
    public function getProductId($order_item)
    {
        if (! $this->_helper->getVariationUniqueId()) {
            $product = $this->_product->loadByAttribute('sku', $order_item->getSku());
            return $product->getData($this->_helper->getUniqueId());
        }
        $product = $this->_product->loadByAttribute('entity_id', $order_item->getProductId());
        return $product->getData($this->_helper->getUniqueId());
    }
}
