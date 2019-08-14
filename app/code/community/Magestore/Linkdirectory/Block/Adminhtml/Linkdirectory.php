<?php
class Magestore_Linkdirectory_Block_Adminhtml_Linkdirectory extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {
    $this->_controller = 'adminhtml_linkdirectory';
    $this->_blockGroup = 'linkdirectory';
    $this->_headerText = Mage::helper('linkdirectory')->__('Item Manager');
    $this->_addButtonLabel = Mage::helper('linkdirectory')->__('Add Item');
    parent::__construct();
  }
}