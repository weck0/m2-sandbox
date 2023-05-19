<?php
namespace Blizzard\Warcraft\Controller\Account;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\PageFactory;

class Index implements HttpGetActionInterface
{
    public function __construct(
        private PageFactory $resultPageFactory
    ) {}

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->set(__('Warcraft'));
        return $resultPage;
    }
}
