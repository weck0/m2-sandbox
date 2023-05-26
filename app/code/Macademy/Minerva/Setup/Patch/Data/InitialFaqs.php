<?php declare(strict_types=1);

namespace Macademy\Minerva\Setup\Patch\Data;

use Magento\Framework\App\ResourceConnection;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Macademy\Minerva\Model\ResourceModel\Faq;

class InitialFaqs implements DataPatchInterface
{

    public function __construct(
        protected ModuleDataSetupInterface $moduleDataSetup,
        protected ResourceConnection $resourceConnection
    )
    {}

    public static function getDependencies()
    {
        return [];
    }

    public function getAliases()
    {
        return [];
    }

    public function apply(): self
    {
        $connection = $this->resourceConnection->getConnection();
        $data = [
            [
              'question' => 'What is your best selling item ?',
              'answer' => 'The item you buy',
              'is_published' => 1,
            ],
            [
                'question' => 'What is your customer support number',
                'answer' => '212-867-5309',
                'is_published' => 1,
            ],            [
                'question' => 'When will I get my order ?',
                'answer' => 'When it gets delivered, hmar!',
                'is_published' => 0,
            ],
        ];
        $connection->insertMultiple(Faq::MAIN_TABLE, $data);

        return $this;
    }
}
