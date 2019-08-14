<?php

class Magestore_Linkdirectory_Model_Mysql4_Linkdirectory extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the linkdirectory_id refers to the key field in your database table.
        $this->_init('linkdirectory/linkdirectory', 'linkdirectory_id');
    }

}