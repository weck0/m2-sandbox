<?php
namespace Cargo\Promo\Cron;

use Magento\Customer\Model\ResourceModel\Customer\CollectionFactory;
use Cargo\Promo\Helper\CouponHelper;
use Cargo\Promo\Helper\EmailHelper;

class SendCoupon
{
    protected $customerCollectionFactory;
    protected $couponHelper;
    protected $emailHelper;
    // add other necessary dependencies here

    public function __construct(
        CollectionFactory $customerCollectionFactory,
        CouponHelper $couponHelper,
        EmailHelper $emailHelper,
        // add other necessary dependencies here
    ) {
        $this->customerCollectionFactory = $customerCollectionFactory;
        $this->couponHelper = $couponHelper;
        $this->emailHelper = $emailHelper;
        // assign other dependencies
    }

    public function execute()
    {
        $today = date('m-d');
        $customers = $this->customerCollectionFactory->create()
            ->addAttributeToSelect('*')
            ->addAttributeToFilter('dob', ['like' => "%$today%"]);

        foreach ($customers as $customer) {
            // generate coupon code
            $couponCode = $this->couponHelper->generateCoupon();
            // send coupon code to customer's email
            $this->emailHelper->sendEmail($customer->getEmail(), $couponCode);
        }

        return $this;
    }
}
