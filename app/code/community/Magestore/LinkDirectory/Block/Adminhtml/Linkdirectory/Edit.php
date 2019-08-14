<?php

class Magestore_Linkdirectory_Block_Adminhtml_Linkdirectory_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'linkdirectory';
        $this->_controller = 'adminhtml_linkdirectory';
        
        $this->_updateButton('save', 'label', Mage::helper('linkdirectory')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('linkdirectory')->__('Delete Item'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('linkdirectory_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'linkdirectory_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'linkdirectory_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if( Mage::registry('linkdirectory_data') && Mage::registry('linkdirectory_data')->getId() ) {
            return Mage::helper('linkdirectory')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('linkdirectory_data')->getTitle()));
        } else {
            return Mage::helper('linkdirectory')->__('Add Item');
        }
    }
}