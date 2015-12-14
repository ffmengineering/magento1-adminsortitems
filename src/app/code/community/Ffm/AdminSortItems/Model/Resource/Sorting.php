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
 * Sorting resource model
 *
 * @category    Ffm
 * @package     Ffm_AdminSortItems
 * @author      Sander Mangel <s.mangel@fitforme.nl>
 */
class Ffm_AdminSortItems_Model_Resource_Sorting extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('ffm_adminsortitems/sorting', 'entity_id');
    }
}