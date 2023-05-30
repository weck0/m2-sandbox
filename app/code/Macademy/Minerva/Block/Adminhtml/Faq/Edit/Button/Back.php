<?php declare(strict_types=1);

namespace Macademy\Minerva\Block\Adminhtml\Faq\Edit\Button;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class Back implements ButtonProviderInterface
{

    public function __construct(
        protected UrlInterface $url
    )
    {}

    /**
     * @return array
     */
    public function getButtonData() : array
    {
        $url = $this->url->getUrl('*/*/');

        return [
            'label' => __('Back'),
            'class' => 'back',
            'on_click' => sprintf("location.href = '%s';", $url),
        ];
    }
}
