<?php

namespace Cargo\Promo\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\App\Helper\Context;

class EmailHelper extends AbstractHelper
{
    protected $transportBuilder;
    protected $storeManager;

    public function __construct(
        Context $context,
        TransportBuilder $transportBuilder,
        StoreManagerInterface $storeManager
    ) {
        $this->transportBuilder = $transportBuilder;
        $this->storeManager = $storeManager;
        parent::__construct($context);
    }

    public function sendEmail($email, $couponCode)
    {
        $templateVars = [
            'store' => $this->storeManager->getStore(),
            'coupon_code' => $couponCode
        ];

        $transport = $this->transportBuilder
            ->setTemplateIdentifier('email_template') // you can use your email template id here
            ->setTemplateOptions(['area' => 'frontend', 'store' => $this->storeManager->getStore()->getId()])
            ->setTemplateVars($templateVars)
            ->setFrom('general') // you can use your email sender setting here
            ->addTo($email)
            ->getTransport();

        $transport->sendMessage();
    }
}
