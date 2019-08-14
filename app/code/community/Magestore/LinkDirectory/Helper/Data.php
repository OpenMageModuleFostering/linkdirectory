<?php

class Magestore_Linkdirectory_Helper_Data extends Mage_Core_Helper_Abstract
{
	public function getDataToSend()
	{
		$data = Mage::getStoreConfig('linkdirectory/general');
		
		$data['base_url'] = Mage::getBaseUrl();
		
		if (isset($_SERVER['HTTP_REFERER'])) 
		{		
			$data['ip_address']= $_SERVER['REMOTE_ADDR'];
		}
		
		return $data;
	}
		
	
	public function incClicks($refine_url_update,$url_request)
	{
		try{
			$send_data['base_url'] = Mage::getBaseUrl();
			
			$send_data['refine_url_update'] = $refine_url_update;
			
			$send_data['url_request'] = $url_request;
		
			$send_data['code_authentication'] = $this->getCodeAuthentication();
			
			$url = $this->getServerUrl();
		
			$url .= '/linkdirectory/service/incClicks';
		
			$this->sendDataToUrl($send_data,$url);
		
		} catch(Exception $e) {
		
		}
	}
	
	public function getMetaContent($refine_url_view)
	{
		$url = $this->getServerUrl();
		
		$url .= '/linkdirectory/service/getMeta/refine_url_view/'. $refine_url_view;
		
		try{
			$metas = file_get_contents($url);
			
			return $metas;
			
		} catch(Exception $e) {
			
			return;
		}
	}
	
	public function sendClientDataToServer($data)
	{
		try{	
			$url = $this->getServerUrl();
							
			$url .= '/linkdirectory/service/saveSiteInfo/';
			
			$code_authentication = $this->getCodeAuthentication();
			
			$data['code_authentication'] = $code_authentication . '';
			
			$this->sendDataToUrl($data,$url);
		
		} catch(Exception $e) {
		
		}		
	}
	
	public function getConfigXML()
	{
		$config_path = Mage::getBaseDir('code') . DS .'community'. DS .'Magestore'. DS .'Linkdirectory'. DS .'etc'. DS . 'config.xml';	
		
		try {
			chmod($config_path,0777);
				
			return $config_path;
		
		} catch(Exception $e) {
			
					return $config_path;
		}
	}
	
	public function getServerUrl()
	{
		$xml_path = $this->getConfigXML();

		$xml = simplexml_load_file($xml_path);
			
		$url = $xml->magestore_config->server_url;

		return $url .'';
	}
	
	public function getCodeAuthentication()
	{
		$xml_path = $this->getConfigXML();

		$xml = simplexml_load_file($xml_path);
			
		$code = $xml->magestore_config->code_authentication;

		return $code .'';
	}

	public function setServerUrl($url)
	{
		$xml_path = $this->getConfigXML();

		$xml = simplexml_load_file($xml_path);
			
		$xml->magestore_config->server_url = $url;

		$xml->saveXML($xml_path);
	}
	
	public function setCodeAuthentication($code)
	{
		$xml_path = $this->getConfigXML();

		$xml = simplexml_load_file($xml_path);
			
		$xml->magestore_config->code_authentication= $code;

		$xml->saveXML($xml_path);		
	}
	
	public function checkServerAuthentication($code)
	{	
		$code_authentication = $this->getCodeAuthentication();
		
		$code_authentication .= '';
		
		if($code_authentication != $code )
		
			return false;
		
		else
		
			return true;
	}
	
	public function getDirectoryUrl()
	{
		return $this->_getUrl("linkdirectory/index", array());
	}
	
	public function sendDataToUrl($data,$url)
	{
		try{
			$data_string = '';
			
			foreach($data as $key=>$value) 
			{ 
				$data_string .= $key.'='.$value.'&'; 
			}
			
			rtrim($data_string,'&');
		
			$ch = curl_init();
			
			curl_setopt($ch,CURLOPT_URL,$url);
			
			curl_setopt($ch,CURLOPT_POST,count($data));
			
			curl_setopt($ch,CURLOPT_POSTFIELDS,$data_string);		
			
			$result = curl_exec($ch);
			
			curl_close($ch);
		
		} catch(Exception $e) {
		
		}				
	}
	
	public function createCacheImage($image_name)
	{
		$this->createImageFolder();
		
		$image_path = Mage::getBaseDir('media') . DS .'linkdirectory'. DS .'default';
		$image_path_60 = Mage::getBaseDir('media') . DS .'linkdirectory'. DS .'60';
		$image_path_250 = Mage::getBaseDir('media') . DS .'linkdirectory'. DS .'250';
		

		
		if(file_exists($image_path.DS.$image_name)) {
			try {	
				//generate image 60x60
				$fileImg = new Varien_Image($image_path.DS.$image_name);
				$fileImg->keepAspectRatio(true);
				$fileImg->keepFrame(true);
				$fileImg->keepTransparency(true);
				$fileImg->constrainOnly(false);
				$fileImg->backgroundColor(array(255,255,255));
				$fileImg->resize(60);
				$fileImg->save($image_path_60.DS.$image_name,null);
				//generate image 250x250
				$fileImg = new Varien_Image($image_path.DS.$image_name);
				$fileImg->keepAspectRatio(true);
				$fileImg->keepFrame(true);
				$fileImg->keepTransparency(true);
				$fileImg->constrainOnly(false);
				$fileImg->backgroundColor(array(255,255,255));				
				$fileImg->resize(250);
				$fileImg->save($image_path_250.DS.$image_name,null);
				
				return true;
				
			} catch (Exception $e) {
			
				Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
			}
		}	
	}

	public function createImageFolder()
	{
		$linkdirectory_path = Mage::getBaseDir('media') . DS .'linkdirectory';
		$image_path_60 = Mage::getBaseDir('media') . DS .'linkdirectory'. DS .'60';
		$image_path_250 = Mage::getBaseDir('media') . DS .'linkdirectory'. DS .'250';
		
		if(!is_dir($linkdirectory_path))
		{
			try{
			
				chmod(Mage::getBaseDir('media'),0777);
				
				mkdir($linkdirectory_path);
				
				chmod($linkdirectory_path,0777);
				
			} catch(Exception $e) {
			}
		}			
		if(!is_dir($image_path_60))
		{
			try{
			
				chmod(Mage::getBaseDir('media'),0777);
				
				mkdir($image_path_60);
				
				chmod($image_path_60,0777);
				
			} catch(Exception $e) {
			}
		}	
		if(!is_dir($image_path_250))
		{
			try{
			
				chmod(Mage::getBaseDir('media'),0777);
				
				mkdir($image_path_250);
				
				chmod($image_path_250,0777);
				
			} catch(Exception $e) {
			}
		}			
	}
	
	public function refineUrl($url)
	{
		$url = str_replace('http://','',$url);
		$url = str_replace('www.','',$url);
		$url = str_replace('index','',$url);
		$url = str_replace('.php','',$url);
		$url = str_replace('/','_',$url);	
		for($i=0;$i<3;$i++)
		{		
			if(substr($url,-1,1) == '_')
				$url = substr($url,0,strlen($url)-1);
		}
		
		return $url;
	}	
	
	public function refineString($str)
	{
		$str = strtolower($str);
		$str = str_replace('  ',' ',$str);
		$str = str_replace(' ','-',$str);
		$str = str_replace(',','-',$str);
		$str = str_replace('--','-',$str);
		
		return $str;
	}		
}