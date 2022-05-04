<?php

namespace Magenest\Movie\Setup;

use Magento\Customer\Model\Customer;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Customer\Setup\CustomerSetupFactory;

class UpgradeData implements UpgradeDataInterface
{

    private $customerSetupFactory;

    /**
     * Constructor
     *
     * @param \Magento\Customer\Setup\CustomerSetupFactory $customerSetupFactory
     */
    public function __construct(
        CustomerSetupFactory $customerSetupFactory
    )
    {
        $this->customerSetupFactory = $customerSetupFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function upgrade(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface   $context
    ) {

        $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);

        if (version_compare($context->getVersion(), '1.0.0') < 0) {

            $customerSetup->addAttribute(\Magento\Customer\Model\Customer::ENTITY, 'customer_attribute_avatar', [
                'type' => 'varchar',
                'label' => 'Avatar',
                'input' => 'file',
                'source' => '',
                'required' => false,
                'visible' => true,
                'position' => 333,
                'system' => false,
                'backend' => ''
            ]);

            $attribute = $customerSetup->getEavConfig()->getAttribute('customer', 'customer_attribute_avatar')
                ->addData(['used_in_forms' => [
                    'adminhtml_customer',
                    'adminhtml_checkout',
                    'customer_account_create',
                    'customer_account_edit'
                ]
                ]);
            $attribute->save();
        }
    }
}
