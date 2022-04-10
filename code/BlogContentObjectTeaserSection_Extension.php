<?php
namespace Schrattenholz\Blog;

use SilverStripe\ORM\DataExtension;
use SilverStripe\ORM\DataList;
use SilverStripe\Forms\DateField;
use SilverStripe\Forms\TextField;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Forms\TreeMultiselectField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Assets\Image;
use DateTime;
use SilverStripe\CMS\Model\SiteTree;
use Schrattenholz\Order\OrderConfig;
use SilverStripe\Core\Injector\Injector;
use Psr\Log\LoggerInterface;
class BlogContentObjectTeaserSection_Extension extends DataExtension{
	public function onAfterWrite(){
		Injector::inst()->get(LoggerInterface::class)->error('BlogContentObjectTeaserSection_Extension MainImageID='.$this->owner->Category()->ID);
		if(!$this->owner->Page()->TeaserImageID && $this->owner->MainImageID){
			
			$page=SiteTree::get_by_id($this->owner->PageID);
			$page->TeaserImageID=$this->owner->MainImageID;
			$page->write();
			$page->doPublish();
			
		}
		parent::onAfterWrite();
	}
}