<?php
class Magestore_Linkdirectory_Block_Linkdirectory extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		return parent::_prepareLayout();
    }
    
     public function getLinkdirectory()     
    { 
		$link_id = $this->getRequest()->getParam('id');
			
		$link = Mage::getModel('linkdirectory/linkdirectory')->load($link_id);

		return $link->getData();
    }
	
	public function getListLinkHTML()
	{
			$data = $this->getRequest()->getPost();
			
			// prepare data to send
			if($this->getRequest()->getParam('title'))
				$data['title'] = $this->getRequest()->getParam('title');
				
			if($this->getRequest()->getParam('tag'))
				$data['tag'] = $this->getRequest()->getParam('tag');
				
			if($this->getRequest()->getParam('category'))
			{
				$listCategory = Mage::getModel('linkdirectory/category')->toOptionArray();
				foreach($listCategory as $cat)
				{
					if(Mage::helper('linkdirectory')->refineString($cat['label']) == $this->getRequest()->getParam('category'))
						$data['category_id'] = $cat['value'];
				}
			}			
			if($this->getRequest()->getParam('begin'))
				$data['begin'] = $this->getRequest()->getParam('begin');			
			
			$data['base_url'] = Mage::getBaseUrl();
			
			$data['code_authentication'] =  Mage::helper('linkdirectory')->getCodeAuthentication();
	
			//prepare url
			$url = Mage::helper('linkdirectory')->getServerUrl();
			
			$url .= '/linkdirectory/service/getHtmlLinks';
			
			Mage::helper('linkdirectory')->sendDataToUrl($data,$url);
	}
	
	public function getLinkDetailHTML()
	{
			$link = $this->getRequest()->getParam('link');
			
			if(!$link)
			{
				return;
			} 		
					
			$url = Mage::helper('linkdirectory')->getServerUrl();
			
			$url .= '/linkdirectory/service/getLinkDetailHTML';
			
			$data['base_url'] = Mage::getBaseUrl();
			
			$data['refine_url_view'] = $link;
			
			$data['code_authentication'] = Mage::helper('linkdirectory')->getCodeAuthentication();
						
			Mage::helper('linkdirectory')->sendDataToUrl($data,$url);
	}
	
}