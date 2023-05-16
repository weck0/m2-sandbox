<?php declare(strict_types=1);

namespace Macademy\Blog\Setup\Patch\Data;

use Macademy\Blog\Api\PostRepositoryInterface;
use Macademy\Blog\Model\PostFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class PopulateBlogsPost1 implements DataPatchInterface {

    public function __construct(
        private ModuleDataSetupInterface $moduleDataSetup,
        private PostFactory $postFactory,
        private PostRepositoryInterface $postRepository,
    ) {}

    public static function getDependencies(): array
    {
        return [];
    }

    public function getAliases(): array
    {
        return [];
    }

    public function apply()
    {
        $this->moduleDataSetup->startSetup();
        $blog_posts = [
            [
                'title' => 'Today is sunny',
                'content' => 'I\'m feeling okay today, still learning a bunch of Magento 2 stuff, the formation is really good',
            ], [
                'title' => 'Today is sunny',
                'content' => 'I\'m feeling okay today, still learning a bunch of Magento 2 stuff, the formation is really good',
            ]
        ];
        foreach ($blog_posts as $data) {
            $post = $this->postFactory->create();
            $post->setData($data);
            $this->postRepository->save($post);
        }

        $this->moduleDataSetup->endSetup();
    }
}
