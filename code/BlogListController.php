<?php

namespace Schrattenholz\Blog;

use Page;
use PageController;
use SilverStripe\ORM\ArrayList;
use SilverStripe\ORM\DataList;
use SilverStripe\ORM\PaginatedList;

class BlogListController extends PageController{
	private static $allowed_actions = ['SortedBlogList'];

	protected function init()
	{
			
		parent::init();                                                                                            
			
			
		// You can include any CSS or JS required by your project here.
		// See: https://docs.silverstripe.org/en/developer_guides/templates/requirements/
	}

	public function SortedBlogList(){
		$nativeEntries=DataList::create('Page')->where('ParentID='.$this->ID)->Sort('Date','DESC');
		$collectedEntries=$this->owner->BlogEntries();
		$allEntries=new ArrayList();
		foreach($nativeEntries as $e){
			$allEntries->push($e);
		}
		foreach($collectedEntries as $e){
			$allEntries->push($e);
		}
		if(count($allEntries)>0){
			$pList=new PaginatedList($allEntries, $this->getRequest());
			$pList->setPageLength(9);
			return $pList;
			//return $allEntries;
		}else{
			return false;
		}
	}
		public function PaginatedProjects() {
		$list = DataList::create('Page')->where('ParentID='.$this->ID);
		$pList=new PaginatedList($list, $this->getRequest());			
		return $pList->setPageLength(1);
	}
	
}