<?php

class Magestore_Linkdirectory_Model_Category
{
    public function toOptionArray()
    {
        $categories = $this->getCategories();
		
		$listCategory = array();
		
		if(!count($categories))
			return;
			
		foreach($categories as $cat)
		{
			$cat = explode('+',$cat);
			
			if(isset($cat[0]) && isset($cat[1]))
			{
				$listCategory[] = array('value'=>$cat[0], 'label'=>$cat[1]);
			}
		}
		
		return $listCategory;
    }
	
	public function getCategories()
	{
		$server_url = Mage::helper('linkdirectory')->getServerUrl();
		
		$server_url  .= '/linkdirectory/service/getCategories';
		
		$categories = file_get_contents($server_url);
		
		$categories = explode('*',$categories);
		
		return $categories;
	}
}