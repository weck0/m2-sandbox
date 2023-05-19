<?php
namespace Blizzard\Warcraft\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Customer\Model\Session;
use Blizzard\Warcraft\Model\WarcraftFactory;
use Blizzard\Warcraft\Model\ResourceModel\Warcraft as WarcraftResource;
use Blizzard\Warcraft\Helper\Data;

class UpdateExperience implements ObserverInterface
{
    public function __construct(
        private Session $customerSession,
        private WarcraftFactory $warcraftFactory,
        private WarcraftResource $warcraftResource,
        private Data $helperData
    ) {
    }

    public function execute(Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();
        $customerId = $order->getCustomerId();
        $grandTotal = $order->getGrandTotal();

        // Calculate experience based on grand total
        $experience = $grandTotal * 100;

        // Load the customer character
        $customer_char = $this->warcraftFactory->create();
        $this->warcraftResource->load($customer_char, $customerId, 'customer_id');

        if ($customer_char->getId()) {
            // Update the customer character's experience
            $newExperience = $customer_char->getExperience() + $experience;
            $rankInfo = $this->helperData->getRankInfoByExperience($newExperience);
            $customer_char->setExperience($newExperience);
            $customer_char->setRank($rankInfo['name']);
            $customer_char->setPromotion($rankInfo['discount'] . '%');
            $this->warcraftResource->save($customer_char);
        }

        return $this;
    }
}
