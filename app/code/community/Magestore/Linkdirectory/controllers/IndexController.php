<?php
class Magestore_Linkdirectory_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {		
		$this->loadLayout();     
		$this->renderLayout();
    }
	
	public function viewAction()
	{
		$refine_url_view = $this->getRequest()->getParam('link');
		
		$url_request = '';
		
		if(isset($_SERVER['HTTP_REFERER']) && isset($_SERVER['QUERY_STRING']))
		{
			$url_request= $_SERVER['HTTP_REFERER'] . $_SERVER['QUERY_STRING'];
		}

		Mage::helper('linkdirectory')->incClicks($refine_url_view,$url_request);
		
		$metas = Mage::helper('linkdirectory')->getMetaContent($refine_url_view);
		
		$metas = explode('***',$metas);
		
		$this->loadLayout(); 
		
		if(count($metas))
		{
			$block_head = $this->getLayout()->getBlock('head');
			
			if(isset($metas[0]) && ($metas[0] != ''))
				$block_head->setTitle($metas[0]);
		
			if(isset($metas[1]) && ($metas[1] != ''))
				$block_head->setKeywords($metas[1]);
				
			if(isset($metas[2]) && ($metas[2] != ''))
				$block_head->setDescription($metas[2]);				
		}	
		
		$this->renderLayout();		
	}
}