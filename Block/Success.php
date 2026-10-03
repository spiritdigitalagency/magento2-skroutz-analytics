<?php
/**
 * Copyright © Spirit Digital Agency. All rights reserved.
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Spirit\Skroutz\Block;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Checkout\Model\Session;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Serialize\Serializer\JsonHexTag;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Sales\Api\Data\OrderItemInterface;
use Magento\Sales\Model\Order;
use Spirit\Skroutz\ViewModel\Config;

/**
 * Skroutz Analytics ecommerce data of the order on the checkout success page.
 */
class Success extends Template
{
    /**
     * Magento payment method codes mapped to the paid_by types Skroutz recommends.
     */
    private const PAYMENT_TYPES = [
        'banktransfer' => 'bank_transfer',
        'cashondelivery' => 'cash_on_delivery',
    ];

    /**
     * @var Session
     */
    private $checkoutSession;

    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * @var Config
     */
    private $config;

    /**
     * @var JsonHexTag
     */
    private $json;

    /**
     * @var Order|null
     */
    private $order;

    /**
     * @param Context $context
     * @param Session $checkoutSession
     * @param ProductRepositoryInterface $productRepository
     * @param Config $config
     * @param JsonHexTag $json
     * @param array $data
     */
    public function __construct(
        Context $context,
        Session $checkoutSession,
        ProductRepositoryInterface $productRepository,
        Config $config,
        JsonHexTag $json,
        array $data = []
    ) {
        $this->checkoutSession = $checkoutSession;
        $this->productRepository = $productRepository;
        $this->config = $config;
        $this->json = $json;
        parent::__construct($context, $data);
    }

    /**
     * The order that was just placed, if any.
     *
     * @return Order|null
     */
    public function getOrder(): ?Order
    {
        if ($this->order === null) {
            $order = $this->checkoutSession->getLastRealOrder();
            $this->order = $order->getId() ? $order : null;
        }

        return $this->order;
    }

    /**
     * The addOrder payload as a JSON object that is safe to print inside a script tag.
     *
     * @return string
     */
    public function getOrderJson(): string
    {
        $order = $this->getOrder();
        $payment = $order->getPayment();
        $code = $payment ? (string)$payment->getMethod() : '';

        return $this->json->serialize([
            'order_id' => $order->getIncrementId(),
            'revenue' => $this->formatAmount($order->getGrandTotal()),
            'shipping' => $this->formatAmount($order->getShippingInclTax()),
            'tax' => $this->formatAmount($order->getTaxAmount()),
            'paid_by' => $this->getPaymentType($code),
            'paid_by_descr' => $payment ? (string)$payment->getAdditionalInformation('method_title') : '',
        ]);
    }

    /**
     * The addItem payloads, one JSON object per visible order item.
     *
     * @return string[]
     */
    public function getItemsJson(): array
    {
        $order = $this->getOrder();
        $items = [];
        foreach ($order->getAllVisibleItems() as $item) {
            $items[] = $this->json->serialize([
                'order_id' => $order->getIncrementId(),
                'product_id' => $this->getProductId($item, (int)$order->getStoreId()),
                'name' => $item->getName(),
                'price' => $this->formatAmount($item->getPriceInclTax()),
                'quantity' => (string)(float)$item->getQtyOrdered(),
            ]);
        }

        return $items;
    }

    /**
     * Skroutz expects a plain decimal: no thousands separator.
     *
     * @param mixed $amount
     * @return string
     */
    private function formatAmount($amount): string
    {
        return number_format((float)$amount, 2, '.', '');
    }

    /**
     * The paid_by type for a Magento payment method code.
     *
     * @param string $code
     * @return string
     */
    private function getPaymentType(string $code): string
    {
        if (strpos($code, 'paypal') !== false) {
            return 'paypal';
        }

        return self::PAYMENT_TYPES[$code] ?? $code;
    }

    /**
     * The product's Unique ID, as sent in the Skroutz XML feed.
     *
     * Configurable items carry the child SKU and the parent product id, so the
     * "variation" setting picks which of the two products is reported.
     *
     * @param OrderItemInterface $item
     * @param int $storeId
     * @return string
     */
    private function getProductId(OrderItemInterface $item, int $storeId): string
    {
        try {
            $product = $this->config->getVariationUniqueId()
                ? $this->productRepository->getById((int)$item->getProductId(), false, $storeId)
                : $this->productRepository->get((string)$item->getSku(), false, $storeId);
        } catch (NoSuchEntityException $e) {
            // ponytail: product deleted since the order was placed, the SKU is the best id left
            return (string)$item->getSku();
        }

        return (string)$product->getData($this->config->getUniqueId());
    }
}
