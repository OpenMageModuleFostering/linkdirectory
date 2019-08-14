<?php

class Magestore_Linkdirectory_Block_Adminhtml_Linkdirectory_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('linkdirectory_tabs');
      $this->setDestElementId('edit_form');
      $this->setTitle(Mage::helper('linkdirectory')->__('Item Information'));
  }

  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('linkdirectory')->__('Item Information'),
          'title'     => Mage::helper('linkdirectory')->__('Item Information'),
          'content'   => $this->getLayout()->createBlock('linkdirectory/adminhtml_linkdirectory_edit_tab_form')->toHtml(),
      ));
     
      return parent::_beforeToHtml();
  }
}