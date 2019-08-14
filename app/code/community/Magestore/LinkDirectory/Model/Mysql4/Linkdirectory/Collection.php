<?php

class Magestore_Linkdirectory_Model_Mysql4_Linkdirectory_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('linkdirectory/linkdirectory');
    }
}