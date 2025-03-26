<?php

namespace Bis2Bis\BookPublishers\Setup\Patch\Data;

use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;

class AddPublisherAttribute implements DataPatchInterface, PatchRevertableInterface
{
    private $moduleDataSetup;
    private $eavSetupFactory;

    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory $eavSetupFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * Apply the patch to add the publisher attribute.
     */
    public function apply()
    {
        /** @var EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);

        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'publisher',
            [
                'type' => 'int',
                'label' => 'Editora',
                'input' => 'select',
                'source' => \Bis2Bis\BookPublishers\Model\Config\Source\PublisherOptions::class,
                'required' => false,
                'visible_on_front' => true,
                'used_in_product_listing' => true,
                'user_defined' => true,
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'is_filterable_in_search' => true,
                'is_filterable' => true,
                'is_comparable' => true,
                'is_visible_in_grid' => true,
                'is_used_in_grid' => true,
            ]
        );
    }

    /**
     * Revert the patch to remove the publisher attribute.
     */
    public function revert()
    {
        /** @var EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);

        $eavSetup->removeAttribute(\Magento\Catalog\Model\Product::ENTITY, 'publisher');
    }

    /**
     * Dependencies for this patch.
     *
     * @return array
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * Aliases for this patch.
     *
     * @return array
     */
    public function getAliases()
    {
        return [];
    }
}
