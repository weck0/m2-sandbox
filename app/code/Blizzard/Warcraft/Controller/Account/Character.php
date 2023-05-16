<?php

namespace Blizzard\Warcraft\Controller\Account;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Action\Context;
use Magento\Customer\Model\Session;
use Blizzard\Warcraft\Model\WarcraftFactory;
use Blizzard\Warcraft\Model\ResourceModel\Warcraft as WarcraftResource;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Message\ManagerInterface;

/**
 * Controller class for creating a character in the account section.
 */
class Character implements HttpGetActionInterface
{
    public function __construct(
        private Context $context,
        protected Session $customerSession,
        protected WarcraftFactory $warcraftFactory,
        protected WarcraftResource $warcraftResource,
        protected RedirectFactory $resultRedirectFactory,
        protected ManagerInterface $messageManager
    ) {}

    public function execute(): Redirect
    {
        if ($this->customerSession->isLoggedIn()) {
            $customerId = $this->customerSession->getCustomer()->getId();

            $character = $this->warcraftFactory->create();
            $warcraftResource = $this->warcraftResource;
            $this->warcraftResource->load($character, $customerId, 'customer_id');

            $data = [
                'customer_id' => $customerId,
                'experience' => 0,
                'promotion' => '0 %',
                'rank' => 'New'
            ];

            if (!$character->getId()) {
                $connection = $warcraftResource->getConnection();
                $connection->insert($warcraftResource->getMainTable(), $data);
                $this->messageManager->addSuccessMessage(__('Character created successfully.'));
            } else {
                $this->messageManager->addErrorMessage(__('Character already exists for this customer.'));
            }
        } else {
            $this->messageManager->addErrorMessage(__('You must be logged in to create a character.'));
        }

        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('warcraft/account');
        return $resultRedirect;
    }
}
