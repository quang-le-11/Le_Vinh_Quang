<?php

namespace Magenest\Movie\Setup\Patch\Data;

use Magento\Eav\Model\Config;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use phpDocumentor\Reflection\DocBlock\Tags\Source;
use Psr\Log\LoggerInterface;

class RegionsAttributeAddressCustomer implements DataPatchInterface
{
    private $eavSetupFactory;
    private $eavConfig;
    private $logger;
    private $attributeResource;
    private $moduleDataSetup;

    public function __construct(
        EavSetupFactory                                   $eavSetupFactory,
        Config                                            $eavConfig,
        LoggerInterface                                   $logger,
        \Magento\Customer\Model\ResourceModel\Attribute   $attributeResource,
        \Magento\Framework\Setup\ModuleDataSetupInterface $moduleDataSetup
    ) {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->eavConfig = $eavConfig;
        $this->logger = $logger;
        $this->attributeResource = $attributeResource;
        $this->moduleDataSetup = $moduleDataSetup;
    }

    /**
     * @throws \Zend_Validate_Exception
     * @throws \Magento\Framework\Exception\AlreadyExistsException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        $eavSetup = $this->eavSetupFactory->create();

        $eavSetup->addAttribute('customer_address', 'vn_region', [
            'type' => 'int',
            'input' => 'select',
            'label' => 'Regions',
            'source' => \Magenest\Movie\Model\Attribute\Source\Region::class,
            'visible' => false,
            'required' => false,
            'user_defined' => true,
            'system' => false,
            'group' => 'General',
            'global' => true,
            'visible_on_front' => true,
        ]);

        $customAttribute = $this->eavConfig->getAttribute('customer_address', 'vn_region');

        $customAttribute->setData(
            'used_in_forms',
            [
                'adminhtml_customer_address',
                'customer_address_edit',
                'customer_register_address'
            ]
        );
        $this->attributeResource->save($customAttribute);
        $this->moduleDataSetup->getConnection()->endSetup();
    }

    public function getAliases()
    {
        return [];
    }

    public static function getDependencies()
    {
        return [];
    }
}
