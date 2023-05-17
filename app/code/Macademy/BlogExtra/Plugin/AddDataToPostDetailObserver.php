<?php declare(strict_types=1);

namespace Macademy\BlogExtra\Plugin;

use Macademy\Blog\Observer\BlogPostDetailView;
use Magento\Framework\Event\Observer;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;

class AddDataToPostDetailObserver
{

    public function __construct(
        private TimezoneInterface $timezone,
    ) {}

    public function beforeExecute(
        BlogPostDetailView $subject,
        Observer $observer,
    ) {
        $request = $observer->getData('request');
        $request->setParam('datetime', $this->timezone->date());

        return[$observer];
    }
}
