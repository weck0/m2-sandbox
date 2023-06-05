<?php

namespace Cargo\Promo\Helper;

use Magento\SalesRule\Model\Rule;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;

class CouponHelper extends AbstractHelper
{
    protected $coupon;

    public function __construct(
        Context $context,
        Rule $coupon
    ) {
        $this->coupon = $coupon;
        parent::__construct($context);
    }

    public function generateCoupon()
    {
        $couponCode = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10); // generate a random string

        $this->coupon->setName("Birthday Coupon $couponCode")
            ->setDescription('Birthday Coupon')
            ->setFromDate(date('Y-m-d'))
            ->setToDate(date('Y-m-d', strtotime("+1 month")))
            ->setUsesPerCustomer(1)
            ->setCustomerGroupIds([0, 1, 2, 3]) // an array of customer group IDs that you want to apply this coupon. (0, 1, 2, 3) means All group
            ->setIsActive(1)
            ->setSimpleAction(Rule::CART_FIXED_ACTION)
            ->setDiscountAmount(10) // Discount amount
            ->setDiscountQty(1)
            ->setStopRulesProcessing(0)
            ->setIsAdvanced(1)
            ->setProductIds('')
            ->setSortOrder(0)
            ->setSimpleFreeShipping('0')
            ->setApplyToShipping('0')
            ->setIsRss(0)
            ->setWebsiteIds([1]) // array of website IDs to which you want to apply the rule/coupon. In this case, it's the base website
            ->setCouponType(Rule::COUPON_TYPE_SPECIFIC)
            ->setCouponCode($couponCode)
            ->setUsesPerCoupon(1);

        $this->coupon->save();

        return $couponCode;
    }
}
