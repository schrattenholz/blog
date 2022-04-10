<?php
use Schrattenholz\Blog\BlogContentObjectTeaserSection_Extension;
if(class_exists("Schrattenholz\ContentObject\CO_TeaserSection")){	
	Schrattenholz\ContentObject\CO_TeaserSection::add_extension(BlogContentObjectTeaserSection_Extension::class);
}
