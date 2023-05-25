<?php
namespace Blizzard\Warcraft\Block\Order;

use Magento\Framework\View\Element\Template;
use Magento\Checkout\Model\Session as CheckoutSession;

/**
 * Custom block for displaying gained experience after placing an order.
 */
class Experience extends Template
{
    public function __construct(
        private CheckoutSession $checkoutSession
    ) {}

    public function getGainedExperience(): int
    {
        $order = $this->checkoutSession->getLastRealOrder();
        return $order->getGrandTotal() * 100;
    }

}
