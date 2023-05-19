<?php
namespace Blizzard\Warcraft\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;

class Index implements HttpGetActionInterface
{
    public function __construct(
        private PageFactory $resultPageFactory,
        private JsonFactory $resultJsonFactory
    ) {
    }

    public function execute(): ResultInterface
    {
        $result = $this->resultJsonFactory->create();
        $result->setData(['Cities' => ['stormwind', 'orgrimmar']]);
        return $result;
    }
}
