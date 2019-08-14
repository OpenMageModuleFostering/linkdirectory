<?php

class Magestore_Linkdirectory_Block_Adminhtml_Linkdirectory_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('linkdirectory_form', array('legend'=>Mage::helper('linkdirectory')->__('Item information')));
     
      $fieldset->addField('title', 'text', array(
          'label'     => Mage::helper('linkdirectory')->__('Title'),
          'class'     => 'required-entry',
          'required'  => true,
          'name'      => 'title',
      ));

      $fieldset->addField('filename', 'file', array(
          'label'     => Mage::helper('linkdirectory')->__('File'),
          'required'  => false,
          'name'      => 'filename',
	  ));
		
      $fieldset->addField('status', 'select', array(
          'label'     => Mage::helper('linkdirectory')->__('Status'),
          'name'      => 'status',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('linkdirectory')->__('Enabled'),
              ),

              array(
                  'value'     => 2,
                  'label'     => Mage::helper('linkdirectory')->__('Disabled'),
              ),
          ),
      ));
     
      $fieldset->addField('content', 'editor', array(
          'name'      => 'content',
          'label'     => Mage::helper('linkdirectory')->__('Content'),
          'title'     => Mage::helper('linkdirectory')->__('Content'),
          'style'     => 'width:700px; height:500px;',
          'wysiwyg'   => false,
          'required'  => true,
      ));
     
      if ( Mage::getSingleton('adminhtml/session')->getLinkdirectoryData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getLinkdirectoryData());
          Mage::getSingleton('adminhtml/session')->setLinkdirectoryData(null);
      } elseif ( Mage::registry('linkdirectory_data') ) {
          $form->setValues(Mage::registry('linkdirectory_data')->getData());
      }
      return parent::_prepareForm();
  }
}