<?php

namespace Magenest\Movie\Setup\Patch\Data;

use Magento\Eav\Model\Config;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Psr\Log\LoggerInterface;

class B2BAttributeCustomer implements DataPatchInterface
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
    )
    {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->eavConfig = $eavConfig;
        $this->logger = $logger;
        $this->attributeResource = $attributeResource;
        $this->moduleDataSetup = $moduleDataSetup;
    }

    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        $eavSetup = $this->eavSetupFactory->create();
        $eavSetup->addAttribute(\Magento\Customer\Model\Customer::ENTITY, 'custom_b2b', [
                'label' => 'Custom B2b',
                'type' => 'int',
                'input' => 'boolean',
                'source' => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
                'required' => false,
                'sort_order' => 100,
                'system' => false,
                'visible' => true,
                'user_defined' => false,
                'searchable' => true,
                'filterable' => true,
                'comparable' => true,
                'frontend_class' => '',
                'visible_on_front' => true,
                'is_used_in_grid' => true,
                'is_visible_in_grid' => true,
                'is_filterable_in_grid' => true,
                'unique' => false,
                'apply_to' => ''
            ]
        );
        $attributeSetId = $eavSetup->getDefaultAttributeSetId(\Magento\Customer\Model\Customer::ENTITY);
        $attributeGroupId = $eavSetup->getDefaultAttributeGroupId(\Magento\Customer\Model\Customer::ENTITY);

        $attribute = $this->eavConfig->getAttribute(\Magento\Customer\Model\Customer::ENTITY, 'telephone');
        $attribute->setData('attribute_set_id', $attributeSetId);
        $attribute->setData('attribute_group_id', $attributeGroupId);

        $attribute->setData('used_in_forms', [
            'adminhtml_customer',
            'adminhtml_customer_address',
            'frontend_customer',
            'customer_account_edit',
            'customer_address_edit',
            'customer_register_address',
            'customer_account_create'
        ]);
        $this->attributeResource->save($attribute);
        $this->moduleDataSetup->getConnection()->endSetup();
    }

    /**
     * @return array|string[]
     */
    public static function getDependencies(): array
    {
        return [];
    }

    public function getAliases()
    {
        return [];
    }
}
