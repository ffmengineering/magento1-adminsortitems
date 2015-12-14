<?php
/**
 * Ffm_AdminSortItems extension
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the OSL 3.0 License
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/OSL-3.0
 *
 * @category       Ffm
 * @package        Ffm_AdminSortItems
 * @copyright      Copyright (c) 2015
 * @license        OSL 3.0 http://opensource.org/licenses/OSL-3.0
 */
/**
 * Adminhtml sorting block
 *
 * @category    Ffm
 * @package     Ffm_AdminSortItems
 * @author      Sander Mangel <s.mangel@fitforme.nl>
 */
class Ffm_AdminSortItems_Block_Adminhtml_Sorting extends Mage_Adminhtml_Block_Template
{
    /**
     * @return array
     * @throws Exception
     */
    public function getCurrentSorting()
    {
        $admin = Mage::getSingleton('admin/session')->getUser();

        $collection = Mage::getModel('ffm_adminsortitems/sorting')->getCollection()
            ->addFieldToFilter('admin_user_id', $admin->getId())
            ->addFieldToFilter('url', $this->getCurrentPath());

        $sortings = [];
        if ($collection->getSize()) {
            foreach ($collection as $_item) {
                $sortings[$_item->getIdentifier()] = $_item->getContent();
            }
        }

        return $sortings;
    }

    public function getActionUrl()
    {
        return Mage::helper("adminhtml")->getUrl("adminhtml/permissions/save");
    }

    public function getCurrentPath()
    {
        $path = "{$this->getRequest()->getModuleName()}_";
        $path .= "{$this->getRequest()->getControllerName()}_";
        $path .= "{$this->getRequest()->getActionName()}";

        return $path;
    }
}
