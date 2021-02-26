<?php 
namespace Schrattenholz\Blog;

use Page;

use SilverStripe\ORM\DataList;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\TreeMultiselectField;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\ArrayList;
use SilverStripe\Assets\Image;
use SilverStripe\AssetAdmin\Forms\UploadField;

class BlogList extends Page {
	private static $table_name='BlogList';
	private static $db=array(
		"NoEntryText"=>"HTMLText",
		"IntroText"=>"HTMLText",
		"ShowWholeContent"=>"Boolean",
		"ShowNoContent"=>"Boolean",
		"HideLabel"=>"Boolean",
		"NotClickable"=>"Boolean"
	);
	private static $has_one=[
		"Image"=>Image::class
		];
	private static $many_many=array(
		'BlogEntries'=>Page::class
	);
	function getCMSFields() {
		
		$fields = parent::getCMSFields();
		$fields->addFieldToTab('Root.BlogKonfig', new TreeMultiselectField('BlogEntries','Zusätzlich angezeigte Beiträge aus anderen Kategorien',Page::class));
		$fields->addFieldToTab('Root.BlogKonfig', new CheckboxField('ShowWholeContent','Kompletten Text des Inhaltsfeld anstatt Kurztext anzeigen'));
		$fields->addFieldToTab('Root.BlogKonfig', new UploadField('Image','Bild für im Feed'));
		$fields->addFieldToTab('Root.BlogKonfig', new CheckboxField('ShowNoContent','Keinen Fließtext anzeigen'));
		$fields->addFieldToTab('Root.BlogKonfig', new CheckboxField('HideLabel','Datumsanzeige deaktivieren'));
		$fields->addFieldToTab('Root.BlogKonfig', new CheckboxField('NotClickable','Verlinkung auf Unterseite deaktivieren'));
		$fields->addFieldToTab('Root.BlogKonfig',new HTMLEditorField('NoEntryText','Anzeige, wenn keine Inhalte vorliegen'));
		$fields->addFieldToTab('Root.BlogKonfig',new HTMLEditorField('IntroText','Anzeige vor den aufgelisteten Inhalten'));
		
		
		$fields->removeByName("Blog");
		return $fields;
	}
	/*
	function SortedBlogList(){
		$nativeEntries=DataList::create('Page')->where('ParentID='.$this->ID);
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
			return $pList->setPageLength(9);
			//return $allEntries;
		}else{
			return false;
		}
	}
	*/
	private static $owns=[
		"Image"
		];
	public function CoverImage(){
		if($this->Image()){
			return $this->Image();
		}else{
			return OrderConfig::get()->First()->ProductImage();
		}
	}
	public function CollectedEntries(){
		
		
		
	}
	/*
	function Children(){		
		return $this->owner->SortedBlogList();
	}
	*/
	
}