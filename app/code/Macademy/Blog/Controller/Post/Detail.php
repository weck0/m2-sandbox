<?php declare(strict_types=1);

namespace Macademy\Blog\Controller\Post;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Event\ManagerInterface as EventMangager;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

class Detail implements HttpGetActionInterface
{
    public function __construct(
        private readonly PageFactory $pageFactory,
        private EventMangager $eventManager,
        private RequestInterface $request,
    ) {}

    public function execute(): Page
    {
        $this->eventManager->dispatch('macademy_blog_post_detail_view', [
            'request' => $this->request,
        ]);

        return $this->pageFactory->create();
    }
}
