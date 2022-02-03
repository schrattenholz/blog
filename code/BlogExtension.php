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
use Schrattenholz\Order\OrderConfig;
use SilverStripe\Core\Injector\Injector;
use Psr\Log\LoggerInterface;
class BlogExtension extends DataExtension{
	private static $db=array(
		'Date'=>'Date',
		'TeaserTitle'=>'Varchar(120)',
		'TeaserText'=>'Text'
	);
	private static $has_one=array(
		'TeaserImage'=>Image::class
	);
	private static $belongs_many_many=array(
		'BlogLists'=>BlogList::class
	);
	private static $owns=[
		"TeaserImage"
	];
	public function updateCMSFields(FieldList $fields) {

			$txt='Wird im Blog angezeigt';
			$date=new DateField('Date','Erscheinungsdatum');
			$fields->addFieldToTab('Root.Blog',$date);
			//$date->setConfig('showcalendar', 1);
			$fields->addFieldToTab('Root.Blog',new TextField('TeaserTitle',"Optionaler Titel für Teaser"));
			$fields->addFieldToTab('Root.Blog',new TextField('TeaserText',"Optionaler Text für Teaser"));
			$fields->addFieldToTab('Root.Blog', new TreeMultiselectField('BlogLists','Wird zusätzlich in folgenden Listen angezeigt',BlogList::class));
			$fields->addFieldToTab('Root.Blog', new UploadField('TeaserImage','Bild für die Anzeige in der Blogansicht'));

	
    }
	public function onAfterWrite()
{
    if ($this->owner->TeaserImageID) {
        $this->owner->TeaserImage()->publishSingle();
    }
}
	public function AllBlogLists(){
		return DataList::create('Page')->where('ID IS NOT '.$this->owner->ID." AND ClassName=BlogList");
	}
	public function onBeforeWrite(){
			if($this->owner->Date==""){
				$this->owner->setField('Date',$this->owner->Created);
			}
		//$this->owner->onBeforeWrite();
	}
	public function getCuttedText(){
		$string = strip_tags($this->owner->Content);
		if (strlen($string) > 100) {
			// truncate string
			$stringCut = substr($string, 0, 100);
			// make sure it ends in a word so assassinate doesn't become ass...
			$string = substr($stringCut, 0, strrpos($stringCut, ' ')).'...'; 
		}
		return $string;
	}
	function DateSummary(){
		$summary="";
		$start=new DateTime( $this->owner->Date);
		$datum=$start->format('d').".".$start->format('m').".".$start->format('Y');
		$summary=_t("Day.".$start->format("D"),$start->format("D")).", ".$datum;
		return $summary;
	}
	/*public function DefaultImage(){
		if($this->owner->TeaserImage()){
			return $this->owner->TeaserImage();
		}else{
			return OrderConfig::get()->First()->ProductImage();
		}
	}*/
	public function BasicExtension_DefaultImage($defaultImage){
		Injector::inst()->get(LoggerInterface::class)->error($this->owner->MenuTitle.'   BlogExtension.php BasicExtension_MainImage MainImage()->ID='.$this->owner->MainImage()->Filename);
		if($this->owner->TeaserImageID){
			//Injector::inst()->get(LoggerInterface::class)->error('BlogExtension.php BasicExtension_DefaultImage TeaserImage()->ID='.$this->owner->TeaserImage()->Filename);
			$defaultImage->DefaultImage= $this->owner->TeaserImage();
		}else if ($this->owner->MainImageID){
			$defaultImage->DefaultImage= $this->owner->MainImage();
		//	Injector::inst()->get(LoggerInterface::class)->error('BlogExtension.php BasicExtension_DefaultImage ImageID='.$defaultImage->ID);
		}else{
			//Injector::inst()->get(LoggerInterface::class)->error('BlogExtension.php BasicExtension_DefaultImage Dummy=');
			$defaultImage->DefaultImage= OrderConfig::get()->First()->ProductImage();
		}
		return $defaultImage;
	}
}