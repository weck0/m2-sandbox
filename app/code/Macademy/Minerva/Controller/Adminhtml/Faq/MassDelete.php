<?php declare(strict_types=1);

namespace Macademy\Minerva\Controller\Adminhtml\Faq;

use Macademy\Minerva\Model\ResourceModel\Faq as FaqResource;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Macademy\Minerva\Model\ResourceModel\Faq\CollectionFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;

class MassDelete extends Action implements HttpPostActionInterface
{
    const ADMIN_RESOURCE = 'Macademy_Minerva::faq_delete';

    /** @var CollectionFactory  */
    protected $collectionFactory;

    /** @var Filter  */
    protected $filter;

    /** @var FaqResource */
    protected $faqResource;


    public function __construct(
        Context $context,
        CollectionFactory $collectionFactory,
        Filter $filter,
        FaqResource $faqResource,
    )
    {
        parent::__construct($context);
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->faqResource = $faqResource;
    }

    public function execute(): Redirect
    {
        $collection = $this->collectionFactory->create();
        $items = $this->filter->getCollection($collection);
        $itemsSize = $items->getSize();

        foreach($items as $item){
            $this->faqResource->delete($item);
        }

        $this->messageManager->addSuccessMessage(__('A total of %1 records have been deleted.', $itemsSize));

        /** @var Redirect $redirect */
        $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);

        return $redirect->setPath('*/*');
    }
}
