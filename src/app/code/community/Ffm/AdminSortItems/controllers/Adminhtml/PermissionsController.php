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
 * Admin Permissions Controller
 *
 * @category    Ffm
 * @package     Ffm_AdminSortItems
 * @author      Sander Mangel <s.mangel@fitforme.nl>
 */
class Ffm_AdminSortItems_Adminhtml_PermissionsController extends Mage_Adminhtml_Controller_Action
{

    /**
     * Save the choosen sorting
     *
     * @access public
     * @author Sander Mangel
     */
    public function saveAction()
    {

        if (!$this->getRequest()->isXmlHttpRequest() || !$this->getRequest()->getParam('isAjax')) {
            return false;
        }

        $post = $this->getRequest()->getPost();

        $admin = Mage::getSingleton('admin/session')->getUser();

        $collection = Mage::getModel('ffm_adminsortitems/sorting')->getCollection()
            ->addFieldToFilter('admin_user_id', $admin->getId())
            ->addFieldToFilter('url', $post['path'])
            ->addFieldToFilter('identifier', $post['identifier']);

        if ($collection->getSize()) {
            $storage = Mage::getModel('ffm_adminsortitems/sorting')->load($collection->getFirstItem()->getId());
            $storage->addData(['content' => $post['sorting']]);
        } else {
            $storage = Mage::getModel('ffm_adminsortitems/sorting');
            $storage->setData([
                'admin_user_id' => $admin->getId(),
                'url' => $post['path'],
                'identifier' => $post['identifier'],
                'content' => $post['sorting']
            ]);
        }

        try {
            $storage->save();
            $response = ['success' => true];
        } catch(Exception $e) {
            $response = ['success' => false, 'error' => $e->getMessage()];
        }

        $this->getResponse()->clearHeaders()->setHeader('Content-type','application/json',true);
        $this->getResponse()->setBody(Mage::helper('core')->jsonEncode($response));
        return;
    }

    /**
     * Check if admin has permissions to visit this controller
     *
     * @access protected
     * @return boolean
     * @author Sander Mangel
     */
    protected function _isAllowed()
    {
        return true;
    }
}
