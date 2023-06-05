<?php declare(strict_types=1);

namespace Cargo\Promo\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Cargo\Promo\Helper\CouponHelper;

class Index implements HttpGetActionInterface
{
    /** @var PageFactory */
    private $pageFactory;

    /**
     * @var CouponHelper
     */
    private $couponHelper;

    /**
     * Index constructor.
     * @param PageFactory $pageFactory
     * @param CouponHelper $couponHelper
     */
    public function __construct(
        PageFactory $pageFactory,
        CouponHelper $couponHelper,
    ) {
        $this->pageFactory = $pageFactory;
        $this->couponHelper = $couponHelper;
    }

    /**
     * @return Page
     */
    public function execute(): Page
    {
        $this->couponHelper->generateCoupon();
        return $this->pageFactory->create();
    }
}
