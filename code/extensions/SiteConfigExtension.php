<?php

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\HeaderField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataExtension;
use SilverStripe\SiteConfig\SiteConfig;
use SilverStripe\View\Parsers\URLSegmentFilter;

class SiteConfigExtension extends DataExtension {

	private static $db = array(
		'TwitterLink' => 'Text',
		'Address1' => 'Text',
		'City' => 'Text',
		'State' => 'Text',
		'Zipcode' => 'Text',
		'PhoneLabel' => 'Text',
		'PhoneNumber' => 'Text',
		'PhoneLabelAlt' => 'Text',
		'PhoneNumberAlt' => 'Text',
		'Fax' => 'Text',
		'FacebookLink' => 'Text',
		'GroupSummary' => 'HTMLText',
		'EmailAddress' => 'Text',
		'VimeoLink' => 'Text',
		'LinkedInLink' => 'Text',
		'InstagramLink' => 'Text',
		'PinterestLink' => 'Text',
		'FlickrLink' => 'Text',
		'YouTubeLink' => 'Text',
		'TwitchLink' => 'Text',
		'Github' => 'Text',
		'Snapchat' => 'Text',
		'DisableDivisionBranding' => 'Boolean',
		'ShowExitButton' => 'Boolean',
		'UseDarkTheme' => 'Boolean',
		'ButtonTextOne' => 'Text',
		'ButtonUrlOne' => 'Text',
		'ButtonTextTwo' => 'Text',
		'ButtonUrlTwo' => 'Text',
		'ButtonTextThree' => 'Text',
		'ButtonUrlThree' => 'Text',
		'QuickLinkTitleOne' => 'Text',
		'QuickLinkTitleTwo' => 'Text',
		'QuickLinkTitleThree' => 'Text',
		'QuickLinkURLOne' => 'Text',
		'QuickLinkURLTwo' => 'Text',
		'QuickLinkURLThree' => 'Text',
		'Disclaimer' => 'HTMLText',

		'EnableUidsIowaBar' => 'Boolean',
		'UidsIowaBarContainerType' => 'Text',
	);

	private static $has_one = array(
		'PosterImage' => Image::class,
		'FooterLogo' => Image::class,
	);

	private static $owns = array(
		'PosterImage',
		'FooterLogo',
	);
	private static $defaults = array(
		'TypeKitID' => 'ggu1mkb',
	);

	public function updateCMSFields(FieldList $fields) {

		$fields->addFieldToTab('Root.Main', new UploadField('PosterImage', 'Default Social Media Share Image (1200 x 630)'));
		// $fields->addFieldToTab('Root.Main', new CheckboxField('UseDarkTheme', 'Use Dark Header Throughout Site'));
		$fields->addFieldToTab('Root.Main', new CheckboxField('DisableDivisionBranding', 'Disable Division Of Student Life Branding Elements'));

		// $fields->addFieldToTab('Root.Main', new CheckboxField('ShowExitButton', 'Show Exit Button'));
		$fields->addFieldToTab('Root.Main', new UploadField('FooterLogo', 'Custom Logo for use in footer'));

		$fields->addFieldToTab('Root.Main', new HTMLEditorField('GroupSummary', 'Group Summary'));

		$fields->addFieldToTab("Root.Main", new HeaderField('Address', 'Address', true));
		$fields->addFieldToTab('Root.Main', new TextField('Address1', 'Street Address'));
		$fields->addFieldToTab('Root.Main', new TextField('City', 'City'));
		$fields->addFieldToTab('Root.Main', new TextField('State', 'State'));
		$fields->addFieldToTab('Root.Main', new TextField('Zipcode', 'Zip Code'));
		$fields->addFieldToTab('Root.Main', new TextField('Fax', 'Fax Number'));
		$fields->addFieldToTab('Root.Main', new TextField('PhoneNumber', 'Main Phone Number'));
		$fields->addFieldToTab('Root.Main', new TextField('PhoneNumberAlt', 'Alternate Phone Number'));
		$fields->addFieldToTab('Root.Main', new TextField('EmailAddress', 'Email Address'));

		$fields->addFieldToTab("Root.Main", new HeaderField('FooterButtons', 'Footer Buttons'));
		$fields->addFieldToTab('Root.Main', new TextField('ButtonTextOne', 'Button Title'));
		$fields->addFieldToTab('Root.Main', new TextField('ButtonUrlOne', 'Button URL'));
		$fields->addFieldToTab('Root.Main', new TextField('ButtonTextTwo', 'Button Title'));
		$fields->addFieldToTab('Root.Main', new TextField('ButtonUrlTwo', 'Button URL'));
		$fields->addFieldToTab('Root.Main', new TextField('ButtonTextThree', 'Button Title'));
		$fields->addFieldToTab('Root.Main', new TextField('ButtonUrlThree', 'Button URL'));

		$fields->addFieldToTab("Root.Main", new HeaderField('SocialMedia', 'Social Media'));
		$fields->addFieldToTab('Root.Main', new TextField('TwitterLink', 'Twitter Account URL'));
		$fields->addFieldToTab('Root.Main', new TextField('FacebookLink', 'Facebook Account URL'));
		$fields->addFieldToTab('Root.Main', new TextField('VimeoLink', 'Vimeo Account URL'));
		$fields->addFieldToTab('Root.Main', new TextField('YouTubeLink', 'YouTube Account URL'));
		$fields->addFieldToTab('Root.Main', new TextField('LinkedInLink', 'LinkedIn Account URL'));
		$fields->addFieldToTab('Root.Main', new TextField('InstagramLink', 'Instagram Account URL'));
		$fields->addFieldToTab('Root.Main', new TextField('PinterestLink', 'Pinterest Account URL'));
		$fields->addFieldToTab('Root.Main', new TextField('FlickrLink', 'Flickr Account URL'));
		$fields->addFieldToTab('Root.Main', new TextField('Github', 'Github Account URL'));
		$fields->addFieldToTab('Root.Main', new TextField('Snapchat', 'Snapchat Username'));
		$fields->addFieldToTab('Root.Main', new TextField('TwitchLink', 'Twitch Account URL'));
		$fields->addFieldToTab('Root.Main', HTMLEditorField::create('Disclaimer', 'Additional disclaimer (shows in small text under social media)')->setRows(3));

		$fields->addFieldToTab("Root.IowaBar", new HeaderField('HeaderQuickLinks', 'Header Quick Links'));
		$fields->addFieldToTab('Root.IowaBar', new TextField('QuickLinkTitleOne', 'Quick Link Title'));
		$fields->addFieldToTab('Root.IowaBar', new TextField('QuickLinkURLOne', 'Quick Link URL'));

		$fields->addFieldToTab('Root.IowaBar', new TextField('QuickLinkTitleTwo', 'Quick Link Title'));
		$fields->addFieldToTab('Root.IowaBar', new TextField('QuickLinkURLTwo', 'Quick Link URL'));

		$fields->addFieldToTab('Root.IowaBar', new TextField('QuickLinkTitleThree', 'Quick Link Title'));
		$fields->addFieldToTab('Root.IowaBar', new TextField('QuickLinkURLThree', 'Quick Link URL'));

		$fields->addFieldToTab('Root.IowaBar', new CheckboxField('EnableUidsIowaBar', 'Enable new UIDS Iowa Bar (experimental)'));
		$fields->addFieldToTab('Root.IowaBar', TextField::create('UidsIowaBarContainerType', 'UIDS Iowa Bar container type')->setDescription('Default is container-xl, other options are container-fluid, container-lg, container-xl, etc.'));
		

		return $fields;
	}

	public function getTwitterHandle() {
		$config = SiteConfig::current_site_config();

		if ($url = $config->TwitterLink) {
			if (preg_match("/^https?:\/\/(www\.)?twitter\.com\/(#!\/)?(?<name>[^\/]+)(\/\w+)*$/", $url, $regs)) {
				return $regs['name'];
			}
		}

		return false;

	}
	public function getInstagramHandle() {
		$config = SiteConfig::current_site_config();

		if ($url = $config->InstagramLink) {

			if (preg_match("/(?:(?:http|https):\/\/)?(?:www\.)?(?:instagram\.com|instagr\.am)\/([A-Za-z0-9-_\.]+)/im", $url, $regs)) {
				return $regs[1];
			}
		}

		return false;

	}
	public function getFacebookHandle() {
		$config = SiteConfig::current_site_config();

		if ($url = $config->FacebookLink) {
			if (preg_match("/^https?:\/\/(www\.)?facebook\.com\/(#!\/)?(?<name>[^\/]+)(\/\w+)*$/", $url, $regs)) {
				return $regs['name'];
			}
		}

		return false;

	}
	public function UITrackingID() {
		$config = SiteConfig::current_site_config();

		$prefix = 'uiowa.edu.md-';
		$filter = URLSegmentFilter::create();
		$siteName = $config->Title;

		$filteredSiteName = $filter->filter($siteName);

		return $prefix . $filteredSiteName;

	}

}
