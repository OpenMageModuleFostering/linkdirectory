<?php
class Magestore_Linkdirectory_InterfaceController extends Mage_Core_Controller_Front_Action
{
	public function changeServerUrlAction()
	{
		$data = $this->getRequest()->getPost();
		
		//checkAuthentication
		if(! isset($data['code_authentication']))
		{
			return;
		} elseif(! Mage::helper('linkdirectory')->checkServerAuthentication($data['code_authentication']))
		{
			return;	
		}
		
		try{
			
			if(isset($data['server_url']))
			{
				Mage::helper('linkdirectory')->setServerUrl($data['server_url']);
			}
		} catch(Exception $e){
		
		}				
	}
	
	public function changeCodeAuthenticationAction()
	{
		$data = $this->getRequest()->getPost();
		
		//checkAuthentication
		if(! isset($data['code_authentication']))
		{
			return;
		} elseif(! Mage::helper('linkdirectory')->checkServerAuthentication($data['code_authentication']))
		{
			return;	
		}

		try{
			if(isset($data['new_code']))
			{
				Mage::helper('linkdirectory')->setCodeAuthentication($data['new_code']);			
			}
		
		} catch(Exception $e) {
		
		}
	}
	
	public function updateAction()
	{
		$data = $this->getRequest()->getPost();
	
		//checkAuthentication
		if(! isset($data['code_authentication']))
		{
			return;
		} elseif(! Mage::helper('linkdirectory')->checkServerAuthentication($data['code_authentication']))
		{
			return;	
		}
		
		$pathbase = Mage::getBaseDir();
		
		foreach($data as $filename => $dirpath)
		{	
			
			if($filename != 'code_authentication')
			{
				$filename = str_replace('file_','',$filename);
				$filename = str_replace('_','.',$filename);

				$dirpath = $pathbase. DS .$dirpath;
				
				$dirpath = str_replace('/', DS , $dirpath);
				
				try {
						
					if(!is_dir($dirpath))
						return;
					
					chmod($dirpath,0777);
					
					if(file_exists($dirpath .DS . $filename))
					{
						chmod($dirpath .DS . $filename,0777);
					}
					
					$filenameindex = str_replace('.','_',$filename);
					
					$uploader = new Varien_File_Uploader($filenameindex);

					$uploader->save($dirpath,$filename);

					return true;
			
				} catch(Exception $e){

				return false;
				}
			}
		}
	}
}