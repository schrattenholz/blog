<?php

namespace Schrattenholz\Blog;

use SilverStripe\ORM\DataExtension;
use SilverStripe\ORM\DataList;

class BlogControllerExtension extends DataExtension{	
	public function getLastBlogEntries(){
		return DataList::create("BlogEntry")->sort('Created');
	}
}