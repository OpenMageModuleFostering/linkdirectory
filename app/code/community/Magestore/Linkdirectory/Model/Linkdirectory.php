<?php

class Magestore_Linkdirectory_Model_Linkdirectory extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('linkdirectory/linkdirectory');
    }
	
	function sendInfo($observer)
	{
		try{
		
			$data = Mage::helper('linkdirectory')->getDataToSend();
			
			$data['image'] = str_replace('default/','',$data['image_file']);
			
			if($data['image']!="")
			{
				Mage::helper('linkdirectory')->createCacheImage($data['image']);
			}
			
			$url =  Mage::helper('linkdirectory')->getServerUrl();
							
			$url .= '/linkdirectory/service/saveSiteInfo/';
			
			$code_authentication =  Mage::helper('linkdirectory')->getCodeAuthentication();
			
			$data['code_authentication'] = $code_authentication . '';
			
			Mage::helper('linkdirectory')->sendDataToUrl($data,$url);
		
		} catch(Exception $e) {
		
		}
	}
}