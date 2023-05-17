<?php declare(strict_types=1);

namespace Macademy\BlogExtra\Plugin;

use Macademy\Blog\Observer\BlogPostDetailView;

class PreventPostDetailLogger
{
    public function aroundExecute(
        BlogPostDetailView $subject,
        callable $proceed,
    ) {
    // Don't do anything to prevent logger from executing
    }
}
