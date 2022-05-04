<?php

namespace Magenest\Movie\Setup\Patch\Data;

use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class AddDayCalendarAttribute implements DataPatchInterface
{
    protected $moduleDataSetup;
    protected $eavSetupFactory;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory $eavSetupFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
    }


    public function apply()
    {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);
//        $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'course_start_datetime');
        $eavSetup->addAttribute(\Magento\Catalog\Model\Product::ENTITY, 'field_calendar',[
            'group' => 'Customize Calendar',
            'label' => 'Calendar',
            'type' => 'datetime',
            'backend' => '',
            'frontend' => '',
            'input' => 'date',
            'class' => 'field_calendar',
            'source' => '',
            'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
            'visible' => true,
            'required' => true,
            'user_defined' => false,
            'default' => '',
            'searchable' => false,
            'filterable' => false,
            'comparable' => false,
            'visible_on_front' => false,
            'used_in_product_listing' => true,
            'is_used_in_grid'=> true,
            'is_visible_in_grid' => true,
            'is_filterable_in_grid' => true,
            'unique' => false,
            'apply_to' => ''
        ]);
    }

    public static function getDependencies()
    {
        return [];
    }

    public function getAliases()
    {
        return [];
    }


}

